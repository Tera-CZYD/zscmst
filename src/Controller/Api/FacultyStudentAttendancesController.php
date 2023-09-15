<?php
namespace App\Controller\Api;

use App\Controller\AppController;
use App\Model\Table\UsersTable;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;
use Cake\Controller\Controller;
use Cake\View\JsonView;

class FacultyStudentAttendancesController extends AppController {
   
  public function initialize(): void{

    parent::initialize();
    
    $this->loadComponent('RequestHandler');

    $this->StudentEnrolledCourses = TableRegistry::getTableLocator()->get('StudentEnrolledCourses');

    $this->Courses = TableRegistry::getTableLocator()->get('Courses');

    $this->Attendances = TableRegistry::getTableLocator()->get('Attendances');

  }

  public function index(){   

    $page = $this->request->getQuery('page', 1);

    $conditionsPrint = '';

    $conditions = [];

    if ($this->request->getQuery('search')!=null) {

      $search = $this->request->getQuery('search');

      $search = strtolower($search);

      $conditions['search'] = $search;

      $conditionsPrint .= '&search='.$search;

    }

    $conditions['employeeId'] = '';

    if ($this->Auth->user('employeeId')!=null) {

      $employee_id = $this->Auth->user('employeeId');

      if ($employee_id!='') {

        $conditions['employeeId'] = "AND StudentEnrolledCourse.faculty_id = $employee_id";

      }

      $conditionsPrint .= '&per_faculty='.$employee_id;

    }

    // var_dump($conditions);

    $limit = 25;

    $tmpData = $this->StudentEnrolledCourses->paginate($this->StudentEnrolledCourses->getAllStudentEnrolledCourse($conditions, $limit, $page), [

      'extra' => [

        'conditions' => $conditions

      ],

      'page' => $page,

      'limit' => $limit

    ]);

    $tmp = $tmpData['data'];

    $paginator = $tmpData['pagination'];

    $datas = [];

    foreach ($tmp as $data) {

      $datas[] = array(

        'id'            => $data['id'],

        'course_id'     => $data['course_id'],

        'course_code'   => $data['course_code'],

        'course'        => $data['course'],

      );

    }

    $response = [

      'ok' => true,

      'data' => $datas,

      'paginator' => $paginator,

      'conditionsPrint' => $conditionsPrint,

    ];

    $this->response->withType('application/json');

    $this->response->getBody()->write(json_encode($response));

    return $this->response;

  }

  public function add(){

    $this->autoRender = false;

    $requestData = $this->request->getData('Club');

    $data = $this->StudentEnrolledCourses->newEmptyEntity();
   
    $data = $this->StudentEnrolledCourses->patchEntity($data, $requestData); 

    if ($this->StudentEnrolledCourses->save($data)) {

      $response = array(

        'ok'  =>true,

        'msg' =>'Club has been successfully saved.',

        'data'=>$requestData

      );

      $userLogTable = TableRegistry::getTableLocator()->get('UserLogs');
        
      $userLogEntity = $userLogTable->newEntity([

          'action' => 'Add',

          'description' => 'Club Management',

          'code' => $requestData['code'],

          'created' => date('Y-m-d H:i:s'),

          'modified' => date('Y-m-d H:i:s')

      ]);
      
      $userLogTable->save($userLogEntity);

    }else {

      $response = array(

        'ok'  =>true,

        'data'=>$requestData,

        'msg' =>'Club cannot saved this time.',

      );

    }

    $this->set(array(

      'response'=>$response,

      '_serialize'=>'response'

    ));

    $this->response->withType('application/json');

    $this->response->getBody()->write(json_encode($response));

    return $this->response;

  }

  public function view($id = null){

    $data['Club'] = $this->StudentEnrolledCourses->find()

      ->where([

        'visible' => 1,

        'id' => $id

      ])

      ->first();

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

  public function edit($id){

    $club = $this->StudentEnrolledCourses->get($id); 

    $requestData = $this->getRequest()->getData('Club');

    $requestData['date'] = isset($requestData['date']) ? date('Y-m-d', strtotime($requestData['date'])) : null;

    $this->StudentEnrolledCourses->patchEntity($club, $requestData); 

    if ($this->StudentEnrolledCourses->save($club)) {

      $response = array(

        'ok'  =>true,

        'msg' =>'Club has been successfully updated.',

        'data'=>$requestData

      );
        
      $userLogTable = TableRegistry::getTableLocator()->get('UserLogs');
        
      $userLogEntity = $userLogTable->newEntity([

          'action' => 'Edit',

          'description' => 'Club Management',

          'code' => $requestData['code'],

          'created' => date('Y-m-d H:i:s'),

          'modified' => date('Y-m-d H:i:s')

      ]);
      
      $userLogTable->save($userLogEntity);

    }else {

      $response = array(

        'ok'  =>true,

        'data'=>$requestData,

        'msg' =>'Club cannot updated this time.',

      );

    }

    $this->set(array(

      'response'=>$response,

      '_serialize'=>'response'

    ));

    $this->response->withType('application/json');

    $this->response->getBody()->write(json_encode($response));

    return $this->response;

  }

  public function delete($id){

    $this->autoRender = false;

    $this->request->allowMethod(['delete']);

    $data = $this->StudentEnrolledCourses->get($id);

    $data->visible = 0;

    if ($this->StudentEnrolledCourses->save($data)) {

      $response = [

        'ok' => true,

        'msg' => 'Club has been successfully deleted'

      ];

    } else {

      $response = [

        'ok' => false,

        'msg' => 'Club cannot be deleted at this time.'

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

  public function viewSection($id=null){

    $employee_id = $this->Auth->user('employeeId');

    $datas = $this->StudentEnrolledCourses->find()

      ->where([

        'visible' => 1,

        'course_id' => $id

      ])

      ->group('section_id') 

      ->order(['section_id' => 'ASC'])

      ->all();

    // var_dump($conditions);

    $response = [

      'ok' => true,

      'data' => $datas

    ];

    $this->set(array(

      'response'   => $response,

      '_serialize' => 'response'

    ));

    $this->response->withType('application/json');

    $this->response->getBody()->write(json_encode($response));

    return $this->response;

  }

  public function viewStudents($id=null,$course=null,$faculty=null){

    $employee_id = $this->Auth->user('employeeId');

    $datas = $this->StudentEnrolledCourses->find()

      ->contain([

        'Students' => [

          'conditions' => [

            'Students.visible' => 1

          ]

        ]

      ])

      ->where([

        'StudentEnrolledCourses.visible' => 1,

        'StudentEnrolledCourses.course_id' => $course,

        'StudentEnrolledCourses.section_id' =>  $id,

        'StudentEnrolledCourses.faculty_id' => $faculty

      ])

      ->all();

      $studentData = [];

      foreach ($datas as $data) {

          $studentData[] = $data->student; // Assuming 'student' is the correct association name

      }

      $attendance = $this->Attendances->find()

          ->where([

              'MONTH(date)' => date('m'),

              'YEAR(date)' => date('Y')

          ])

          ->orderAsc('date')

          ->all();

          $counter = 1;

          for($i = 0; i<)
          foreach($attendance as $d){

            $d['date'] = DATE_FORMAT($d['date'], 'j');

          }

    $courses = $this->Courses->get($course);



    $response = [

      'ok' => true,

      'data' => $datas,

      'course' => $courses,

      'students' => $studentData,

      'attendances' => $attendance

    ];

    $this->set(array(

      'response'   => $response,

      '_serialize' => 'response'

    ));

    $this->response->withType('application/json');

    $this->response->getBody()->write(json_encode($response));

    return $this->response;

  }

}
