<?php

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;
use Cake\Controller\Controller;
use Cake\View\JsonView;

class AssessmentsController extends AppController {

  public function initialize(): void{

    parent::initialize();

    $this->loadComponent('RequestHandler');

    $this->loadComponent('Global');

    $this->Assessments = TableRegistry::getTableLocator()->get('Assessments');

    $this->AssessmentSubs = TableRegistry::getTableLocator()->get('AssessmentSubs');

    $this->StudentEnrollments = TableRegistry::getTableLocator()->get('StudentEnrollments');

    $this->StudentEnrolledCourses = TableRegistry::getTableLocator()->get('StudentEnrolledCourses');

    $this->BlockSectionCourses = TableRegistry::getTableLocator()->get('BlockSectionCourses');

    $this->Students = TableRegistry::getTableLocator()->get('Students');

    $this->UserLogs = TableRegistry::getTableLocator()->get('UserLogs');

  }

  public function index() {

    // default page 1

    $page = $this->request->getQuery('page', 1);

    // default conditions 

    $conditions = [];

    $conditionsPrint = '';

    if($this->request->getQuery('search')){

      $search = $this->request->getQuery('search');

      $search = strtolower($search);

      $conditions['search'] = $search;

      $conditionsPrint .= '&search='.$search;

    }

    $conditions['date'] = '';

    if ($this->request->getQuery('date')) {

      $search_date = $this->request->getQuery('date');

      $conditions['date'] = " AND DATE(Assessment.created) = '$search_date'"; 

      $conditionsPrint .= '&date='.$search_date;

    }  

    //advance search

    if ($this->request->getQuery('startDate')) {

      $start = $this->request->getQuery('startDate'); 

      $end = $this->request->getQuery('endDate');

      $conditions['date'] = " AND DATE(Assessment.created) >= '$start' AND DATE(Assessment.created) <= '$end'";

      $conditionsPrint .= '&startDate='.$start.'&endDate='.$end;

    }

    $conditions['status'] = '';

    if ($this->request->getQuery('status') != null) {

      $status = $this->request->getQuery('status');

      $conditions['status'] = "AND Assessment.approve = $status";
 
      $conditionsPrint .= '&status='.$this->request->getQuery('status');

    }
 
    $conditions['studentId'] = '';

    if ($this->request->getQuery('per_student') != null) {

      $per_student = $this->request->getQuery('per_student');
      
      $studentId = $this->Auth->user('studentId');

      $conditions['studentId'] = "AND Assessment.student_id = $studentId";

      $conditionsPrint .= '&per_student='.$per_student;

    }

    $limit = 25;

    $tmpData = $this->Assessments->paginate($this->Assessments->getAllAssessment($conditions, $limit, $page), [

      'extra' => [

        'conditions' => $conditions

      ],

      'page' => $page,

      'limit' => $limit

    ]);

    $assessments = $tmpData['data'];

    $paginator = $tmpData['pagination'];

    $datas = [];

      foreach ($assessments as $data) {

        $datas[] = array(

          'id'                => $data['id'],

          'code'              => $data['code'],

          'student_no'        => $data['student_no'],

          'student_name'      => $data['student_name'],

          'email'             => $data['email'],

          'contact_no'        => $data['contact_no'],

          'program'           => $data['program'],

          // 'approve'           => $data['approve'],


        );

      }


    $response = [

      'ok' => true,

      'data' => $datas,

      'paginator' => $paginator,

      'conditionsPrint' => $conditionsPrint

    ];

    $this->response->withType('application/json');

    $this->response->getBody()->write(json_encode($response));

    return $this->response;

  }


  public function view($id = null) {

    $data['Assessment'] = $this->Assessments->find()

      ->contain([

        'AssessmentSubs',

        'YearLevelTerms'

      ])

      ->where([

        'Assessments.visible' => 1,

        'Assessments.id' => $id

      ])

      ->first();

      $data = [

        'Assessment' => $data['Assessment'],

        'AssessmentSub' => $data['Assessment']->assessment_subs,

        'YearLevelTerm' => $data['Assessment']->year_level_term

      ];

      unset($data['Assessment']->assessment_subs);
      unset($data['Assessment']->year_level_term);

     $response = [

      'ok' => true,

      'data' => $data

    ];

    $this->set([

      'response' => $response,

      '_serialize' => 'response'

    ]);

    $this->response->withType('application/json');

    $this->response->getBody()->write(json_encode($response));

    return $this->response;

  }


  public function delete($id){

    $this->autoRender = false;

    $this->request->allowMethod(['delete']);

    $data = $this->Assessments->get($id);

    $sub = $this->AssessmentSubs->find()

      ->where([

        'assessment_id' => $id

      ])

      ->first();

    $sub->visible = 0;

    $data->visible = 0;

    if ($this->Assessments->save($data)) {

      $this->Assessments->save($sub);

      $response = [

        'ok' => true,

        'msg' => 'Assessment has been successfully deleted'

      ];

      $userLogTable = TableRegistry::getTableLocator()->get('UserLogs');
        
      $userLogEntity = $userLogTable->newEntity([

          'action' => 'Delete',

          'description' => 'Assessment Management',

          'code' => $data->code,

          'created' => date('Y-m-d H:i:s'),

          'modified' => date('Y-m-d H:i:s')

      ]);
      
      $userLogTable->save($userLogEntity);

    } else {

      $response = [

        'ok' => false,

        'msg' => 'Assessment cannot be deleted at this time.'

      ];

    }

    $this->set([

      'response' => $response,

      '_serialize' => 'response'

    ]);

    $this->response->withType('application/json');

    $this->response->getBody()->write(json_encode($response));

    return $this->response;

  }

  public function approve($id = null){

    $this->autoRender = false;

    $data = $this->Assessments->get($id);

    $scholarship_name = $this->request->getQuery('scholarship_name');

    $scholarship_id = $this->request->getQuery('scholarship_id');

    $data->approve = 1;

    $data->scholarship_id = $scholarship_id;

    $data->scholarship_name = $scholarship_name;

    $data->approve_by_id = $this->currentUser->id;

    if ($this->Assessments->save($data)) {

      $student_id = $data->student_id;

      $student = $this->Students->get($student_id);

      $student->scholarship_id = $scholarship_id;

      $student->scholarship_name = $scholarship_name;

      $this->Students->save($student);

      // $student_query = "UPDATE students SET scholarship_id = $scholarship_id, scholarship_name = $scholarship_name WHERE id = $student_id";

      // $student_con = $this->Students->getConnection();

      // $student_con->execute($student_query)->fetchAll('assoc');

      $year_term_id = $data->year_term_id;

      $tmp = "UPDATE student_enrollments SET assessed = 1 WHERE student_id = $student_id AND year_term_id = $year_term_id";

      $connection = $this->StudentEnrollments->getConnection();

      $connection->execute($tmp)->fetchAll('assoc');


      //UPDATE NUMBER OF ENROLLED STUDENTS

        $student_enrolled_courses = $this->StudentEnrolledCourses->find()

          ->where([

            'visible' => 1,

            'student_id' => $data->student_id,

            'year_term_id' => $data->year_term_id,

          ])

        ->all();

        if(!empty($student_enrolled_courses)){

          foreach ($student_enrolled_courses as $key => $value) {

            $block_section_course_id = $value['block_section_course_id'];
          
            $tmp = "UPDATE block_section_courses SET enrolled_students = IFNULL(enrolled_students,0) + 1 WHERE id = $block_section_course_id";

            $connection = $this->BlockSectionCourses->getConnection();

            $connection->execute($tmp)->fetchAll('assoc');

          }

        }

      //END 

      $response = [

        'ok' => true,

        'msg' => 'Assessment has been successfully approved'

      ];

    } else {

      $response = [

        'ok' => false,

        'msg' => 'Assessment cannot be approved at this time.'

      ];

    }

    $this->set([

      'response' => $response,

      '_serialize' => 'response'

    ]);

    $this->response->withType('application/json');

    $this->response->getBody()->write(json_encode($response));

    return $this->response;


  }   

}