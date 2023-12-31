<?php
namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;
use Cake\Controller\Controller;
use Cake\View\JsonView;
use Cake\I18n\Time;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include 'PHPMailer/Exception.php';

include 'PHPMailer/PHPMailer.php';

include 'PHPMailer/SMTP.php';



class StudentClearancesController extends AppController {
   
  public function initialize(): void{

    parent::initialize();
    
    $this->loadComponent('RequestHandler');

    $this->StudentClearances = TableRegistry::getTableLocator()->get('StudentClearances');

    $this->StudentClearanceSubs = TableRegistry::getTableLocator()->get('StudentClearanceSubs');

    $this->UserLogs = TableRegistry::getTableLocator()->get('UserLogs');

    $this->Students = TableRegistry::getTableLocator()->get('Students');

    $this->Employees = TableRegistry::getTableLocator()->get('Employees');

    $this->ApartelleRegistrations = TableRegistry::getTableLocator()->get('ApartelleRegistrations');

    $this->StudentEnrolledCourses = TableRegistry::getTableLocator()->get('StudentEnrolledCourses');

    $this->YearLevelTerms = TableRegistry::getTableLocator()->get('YearLevelTerms');

    $this->Students = TableRegistry::getTableLocator()->get('Students');

    $this->Settings = TableRegistry::getTableLocator()->get('Settings');

  }

  public function index(){   

    $page = $this->request->getQuery('page', 1);

    $conditions = [];

    $conditionsPrint = '';

    if ($this->request->getQuery('search')) {

      $search = $this->request->getQuery('search');

      $search = strtolower($search);

      $conditions['search'] = $search;

      $conditionsPrint .= '&search='.$search;

    }

    $conditions['date'] = '';

    if ($this->request->getQuery('date')) {

      $search_date = $this->request->getQuery('date');

      $conditions['date'] = " AND DATE(StudentClearance.date) = '$search_date'"; 

      $dates['date'] = $search_date;

      $conditionsPrint .= '&date='.$search_date;

    }  

    //advance search

    if ($this->request->getQuery('startdate')) {

      $start = $this->request->getQuery('startdate'); 

      $end = $this->request->getQuery('endDate');

      $conditions['date'] = " AND DATE(StudentClearance.date) >= '$start' AND DATE(StudentClearance.date) <= '$end'";

      $dates['startDate'] = $start;

      $dates['endDate']   = $end;

      $conditionsPrint .= '&startDate='.$start.'&endDate='.$end;

    }

    $conditions['course'] = '';

    if ($this->request->getQuery('course_id')) {

      $course_id = $this->request->getQuery('course_id');

      $conditions['course'] = " AND StudentEnrolledCourse.course_id = '$course_id'"; 

      $conditionsPrint .= '&course_id='.$course_id;

    }  

    $conditions['status'] = '';

    if ($this->request->getQuery('status')!=null) {

      $status = $this->request->getQuery('status');

      $conditions['status'] = "AND StudentEnrolledCourse.clearance_status = $status";
 
      $conditionsPrint .= '&status='.$this->request->getQuery('status');

    }

    // debug($conditions['status']);

    $conditions['faculty'] = '';

    $employees = [];

    if($this->Auth->user('employeeId')!=null){

      $employee_id = $this->Auth->user('employeeId');

      $employees = $this->Employees->find()

      ->contain([

          'AcademicRanks'=> [

              'conditions' => ['AcademicRanks.visible' => 1],

            ]

        ])

      ->where([

        'Employees.visible' => 1,

        'Employees.id' => $employee_id

      ])

      ->first();

      

      if($employees['academic_rank_id']!=1 && $employees['academic_rank_id']!=3){

        if (!empty($employee_id)) {

          $conditions['faculty'] = " AND StudentEnrolledCourse.faculty_id = $employee_id ";

        }

        $conditionsPrint .= '&faculty='.$employee_id;

      }

    }

    $conditions['college_program'] = '';

    if ($this->request->getQuery('college_program_id')!=null) {

      $college_program_id = $this->request->getQuery('college_program_id');

      $conditions['college_program'] = " AND StudentClearance.course_id = $college_program_id";

      $conditionsPrint .= '&college_program_id=' . $college_program_id;
      
    }

    $role_id = $this->Auth->user('roleId');

    $conditions['step'] = '';

    $step = 1;

    if($role_id!=null){

      if ($role_id==8){

        $conditions['step'] = " AND StudentClearance.step = 2 ";

        $step = 2;

      }else if ($role_id==23){

        $conditions['step'] = " AND StudentClearance.step = 3 ";

        $step = 3;

      }else if ($role_id==41){

        $conditions['step'] = " AND StudentClearance.step = 4 ";

        $step = 4;

      }else if ($role_id==12 && $employees['academic_rank_id'] == 3){

        $conditions['step'] = " AND StudentClearance.step = 5 ";

        $step = 5;

      }else if ($role_id==25){

        $conditions['step'] = " AND StudentClearance.step = 6 ";

        $step = 6;

      }else if ($role_id==12 && $employees['academic_rank_id'] == 1){

        $conditions['step'] = " AND StudentClearance.step = 7 ";

        $step = 7;

      }else if ($role_id==39){

        $conditions['step'] = " AND StudentClearance.step = 8 ";

        $step = 8;

      }

      $conditionsPrint .= '&step='.$step;

    }

    $current_sem = $this->Settings->find()

        ->select([

          'value'

        ])

        ->where([

          'id' => 25

        ])

        ->first();

    // filter current sem

    $conditions['sem'] = '';

    if ($current_sem['value']!=null) {

      $sem = $current_sem['value'];

      if( $sem == 1 ){

        $conditions['sem'] = " AND ( StudentClearance.year_term_id = 1 || StudentClearance.year_term_id = 4 || StudentClearance.year_term_id = 7 || StudentClearance.year_term_id = 10 || StudentClearance.year_term_id = 13 ) ";

      }else if( $sem == 2 ){

        $conditions['sem'] = " AND ( StudentClearance.year_term_id = 2 || StudentClearance.year_term_id = 5 || StudentClearance.year_term_id = 8 || StudentClearance.year_term_id = 11 || StudentClearance.year_term_id = 14 ) ";

      }else{

        $conditions['sem'] = " AND ( StudentClearance.year_term_id = 3 || StudentClearance.year_term_id = 6 || StudentClearance.year_term_id = 9 || StudentClearance.year_term_id = 12 || StudentClearance.year_term_id = 15 ) ";

      }

      $conditionsPrint .= '&sem=' . $sem;
      
    }

    $limit = 25;

    $tmpData = $this->StudentClearances->paginate($this->StudentClearances->getAllStudentClearance($conditions, $limit, $page), [

      'extra' => [

        'conditions' => $conditions

      ],

      'page' => $page,

      'limit' => $limit

    ]);

    $student_clearances = $tmpData['data'];

    $paginator = $tmpData['pagination'];

    $datas = [];

    // var_dump($conditions);
    foreach ($student_clearances as $data) {

      // var_dump($data);

      $datas[] = array(

          'id'            => $data['id'],
  
          'code'          => $data['code'],

          'student_name'  => $data['student_name'],

          'student_id'  => $data['student_id'],

          'semester'       => $data['semester'],

          'sa_number'       => $data['sa_number'],

          'year_level_term'       => $data['year_level_term'],

          'school_year'       => $data['school_year'],

          'remarks'       => $data['faculty_remark'],

          'status_faculty'       => $data['status_faculty'],

          'course'       => $data['name'],

          'fac' => $data['status_faculty'],

          'cash' => $data['status_cashier'],

          'lib' => $data['status_librarian'],

          'lab' => $data['status_laboratory'],

          'studAf' => $data['status_affairs'],

          'head' => $data['status_head'],

          'dean' => $data['status_dean'],

          'step' => $data['step'],


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

  public function add(){

    $this->autoRender = false;

    $requestData = $this->request->getData('StudentClearance');

    $requestData['date'] = isset($requestData['date']) ? date('Y-m-d', strtotime($requestData['date'])) : null;

    $data = $this->StudentClearances->newEmptyEntity();
   
    $data = $this->StudentClearances->patchEntity($data, $requestData); 

    $data =  $this->StudentClearances->save($data);

    if ($this->StudentClearances->save($data)) {

      $lastId = $data->id;

      $studentId = $requestData['student_id'];

      $courses = $this->StudentEnrolledCourses->find()

        ->where(['student_id' => $studentId])

        ->all();

        foreach ($courses as $course) {

            $data = [

              'clearance_id' => $lastId,

              'student_id' => $studentId,

              'enrolled_course_id' => $course['id'],

              'faculty_id' => $course['faculty_id'],

            ];

            $studentClearanceSubEntity = $this->StudentClearanceSubs->newEntity($data);

            $this->StudentClearanceSubs->save($studentClearanceSubEntity);
        }

      $response = array(

        'ok'  =>true,

        'msg' =>'Student Clearance has been successfully saved.',

        'data'=>$requestData

      );

      $userLogTable = TableRegistry::getTableLocator()->get('UserLogs');
        
      $userLogEntity = $userLogTable->newEntity([

          'action' => 'Add',

          'description' => 'Student Clearance Management',

          'code' => $requestData['code'],

          'created' => date('Y-m-d H:i:s'),

          'modified' => date('Y-m-d H:i:s')

      ]);
      
      $userLogTable->save($userLogEntity);

    }else {

      $response = array(

        'ok'  =>true,

        'data'=>$requestData,

        'msg' =>'Student Clearance cannot saved this time.',

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

    $data['StudentClearance'] = $this->StudentClearances->find()

      ->contain([

          'Students'=> [

              'conditions' => ['Students.visible' => 1],

            ],

          'CollegePrograms'=> [

              'conditions' => ['CollegePrograms.visible' => 1],

            ],

          'YearLevelTerms'=> [

              'conditions' => ['YearLevelTerms.visible' => 1],

            ]

        ])

      ->where([

        'StudentClearances.visible' => 1,

        'StudentClearances.id' => $id

      ])

      ->first();

      $data['Student'] = $data['StudentClearance']['student'];

      $data['CollegeProgram'] = $data['StudentClearance']['college_program'];

      $data['YearLevelTerm'] = $data['StudentClearance']['year_level_term'];


      unset($data['StudentClearance']['student']);

      unset($data['StudentClearance']['college_program']);

      unset($data['StudentClearance']['year_level_term']);

      $data['StudentClearance']['date'] = isset($data['StudentClearance']['date']) ? date('m/d/Y', strtotime($data['StudentClearance']['date'])) : null;

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

    $data = $this->StudentClearances->get($id); 

    $requestData = $this->getRequest()->getData('StudentClearance');

    $requestData['date'] = isset($requestData['date']) ? date('Y-m-d', strtotime($requestData['date'])) : NULL;

    $this->StudentClearances->patchEntity($data, $requestData); 

    if ($this->StudentClearances->save($data)) {

      $response = array(

        'ok'  =>true,

        'msg' =>'Student Clearance has been successfully updated.',

        'data'=>$requestData

      );
        
      $userLogTable = TableRegistry::getTableLocator()->get('UserLogs');
        
      $userLogEntity = $userLogTable->newEntity([

          'action' => 'Edit',

          'description' => 'Student Clearance',

          'code' => $requestData['code'],

          'created' => date('Y-m-d H:i:s'),

          'modified' => date('Y-m-d H:i:s')

      ]);
      
      $userLogTable->save($userLogEntity);

    }else {

      $response = array(

        'ok'  =>true,

        'data'=>$requestData,

        'msg' =>'Student Clearance cannot updated this time.',

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

    $data = $this->StudentClearances->get($id);

    $data->visible = 0;

    if ($this->StudentClearances->save($data)) {

      $response = [

        'ok' => true,

        'msg' => 'Student Clearance has been successfully deleted'

      ];

    } else {

      $response = [

        'ok' => false,

        'msg' => 'Student Clearance cannot be deleted at this time.'

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

  public function email($id = null){
    
    $this->autoRender = false;

    $app = $this->StudentClearances->get($id);

    $course_id = $this->getRequest()->getData('course_id');

    $studentId = $app['student_id'];

    $courses = $this->StudentEnrolledCourses->find()

      ->where([

        'student_id' => $studentId,

        'course_id' => $course_id

      ])

      ->first();

    $courses->clearance_remarks = $this->getRequest()->getData('remarks');

    $courses->clearance_status = 2;

    $student = $this->Students->get($app['student_id']);

    // $app->status_faculty = 2;

    // $app->faculty_id = $this->Auth->user('employeeId');

    // $app->remarks = $this->getRequest()->getData('remarks');

    if ($this->StudentEnrolledCourses->save($courses)) {

      //EMAIL VERIFICATION

        $name = @$student['first_name'].' '.@$student['middle_name'].' '.@$student['last_name'];

        $email = @$student['email'];

        $faculty = $this->Auth->user('first_name').' '.$this->Auth->user('last_name');

        // var_dump($faculty);

      if(isset($student['email'])){

        //EMAIL VERIFICATION
        if(isset($email)){

          if($email != ''){

            // fix value
        
            $mail = new PHPMailer(true);

                //Server settings
                // $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
                $mail->isSMTP(); // Send using SMTP
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'mycreativepandaii@gmail.com'; // Your Gmail email address
                $mail->Password = 'tkoahowwnzuzqczy'; // Your Gmail password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
                $mail->Port = 587; // TCP port to connect to

                //Recipients
                $mail->setFrom('mycreativepandaii@gmail.com', 'ZAMBOANGA STATE COLLEGE OF MARINE SCIENCES AND TECHNOLOGY'); // Sender's email and name
                $mail->addAddress($email, $name); // Recipient's email and name

                // Content
                $mail->isHTML(true); // Set email format to HTML
                $mail->Subject = 'STUDENT CLEARANCE';

              $_SESSION['name'] = @$name; 

              $_SESSION['faculty'] =  $faculty;

              $_SESSION['remarks'] = @$courses['clearance_remarks'];

              $_SESSION['subject'] = @$courses['course'];

              $_SESSION['id'] = $id; 

                 ob_start();

            include('Email/clearance-incomplete.ctp');

            $bodyContent = ob_get_contents();

            ob_end_clean();

            $mail->Body = $bodyContent;
                

            $mail->send();

          }

        }

      }

      //EMAIL VERIFICATION

      $response = array(

        'ok'   => true,

        'data' => $app,       

        'msg'  => 'Student has been successfully cleared.'

      );
          $userLogEntity = $this->UserLogs->newEntity([

          'action' => 'Student Clearances',

          'description' => 'Send Email'.@$app['StudentApplication']['first_name'].' '.@$app['StudentApplication']['last_name'],

          'created' => date('Y-m-d H:i:s'),

          'modified' => date('Y-m-d H:i:s')

        ]);

        $this->UserLogs->save($userLogEntity);

    } else {

      $response = array(

        'ok'   => false,

        'data' => $data,

        'msg'  =>'Unable to send email.'

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

  public function clearStudent($id = null){

    $this->autoRender = false;

    $app = $this->StudentClearances->get($id);

    $course_id = $this->getRequest()->getData('course_id');

    $studentId = $app['student_id'];

    $save = '';

    $student = $this->Students->get($app['student_id']);

    $employees = [];

    if($this->Auth->user('employeeId')!=null){

      $employee_id = $this->Auth->user('employeeId');

      $employees = $this->Employees->find()

        ->contain([

            'AcademicRanks'=> [

              'conditions' => ['AcademicRanks.visible' => 1],

            ]

          ])

        ->where([

          'Employees.visible' => 1,

          'Employees.id' => $employee_id

        ])

      ->first();

    }

    if($this->Auth->user('roleId')==12 && $employees['academic_rank_id'] != 1 && $employees['academic_rank_id'] != 3){

      $courses = $this->StudentEnrolledCourses->find()

        ->where([

          'student_id' => $studentId,

          'course_id' => $course_id,

          'visible'   => 1

        ])

      ->first();

      $courses->clearance_remarks = 'CLEARED';

      $courses->clearance_status = 1;

      $save = $this->StudentEnrolledCourses->save($courses);

    }else if($this->Auth->user('roleId')==8){

      $app->status_cashier = 1;

      $app->step = 3;

      $save = $this->StudentClearances->save($app);

    }else if($this->Auth->user('roleId')==23){

      $student_year = $student['year_term_id'];

      $apartelle = $this->ApartelleRegistrations->find()

        ->where([

          'student_id' => $studentId,

          'year_term_id' => $student_year,

          'visible'   => 1,

          'active' => 1

        ])

      ->count();

      if($apartelle>0){

        $app->status_librarian = 1;

        $app->step = 4;

      }else{

        $app->status_librarian = 1;

        $tmp = "UPDATE student_clearances SET status_apartelle = 1 WHERE id = " . $id;

        $connection = $this->StudentClearances->getConnection();

        $connection->execute($tmp)->fetchAll('assoc');

        $app->step = 5;

      }
      
      $save = $this->StudentClearances->save($app);

    }else if($this->Auth->user('roleId')==41){

      $app->status_apartelle = 1;

      $app->step = 5;

      $tmp = "UPDATE student_clearances SET status_apartelle = 1 WHERE id = " . $id;

      $connection = $this->StudentClearances->getConnection();

      $connection->execute($tmp)->fetchAll('assoc');

      $save = $this->StudentClearances->save($app);

    }else if($this->Auth->user('roleId')==0){

      $app->status_laboratory = 1;

      $app->step = 6;

      $save = $this->StudentClearances->save($app);

    }else if($this->Auth->user('roleId')==25){

      $app->status_affairs = 1;

      $app->step = 7;

      $save = $this->StudentClearances->save($app);

    }else if($this->Auth->user('roleId')==12 && $employees['academic_rank_id'] == 3){

      $app->status_laboratory = 1;

      $app->step = 6;

      $save = $this->StudentClearances->save($app);

    }else if($this->Auth->user('roleId')==12 && $employees['academic_rank_id'] == 1){

      $app->status_head = 1;

      $app->step = 8;

      $save = $this->StudentClearances->save($app);

    }else if($this->Auth->user('roleId')==39){

      $app->status_dean = 1;

      $app->step = 9;

      $save = $this->StudentClearances->save($app);

      //LAST STEP - UPDATE YEAR TERM OF STUDENT

        $year_term_id = $student['year_term_id'];

        $year_term = "

          SELECT 

            YearLevelTerm.*

          FROM  

            year_level_terms as YearLevelTerm

          WHERE 

            YearLevelTerm.visible = true AND 

            YearLevelTerm.id > $year_term_id

          ORDER BY 

            YearLevelTerm.id ASC 

          LIMIT 1

        ";

        $connection = $this->YearLevelTerms->getConnection();

        $result = $connection->execute($year_term)->fetchAll('assoc');

        $sutdentData = array();

        if(!empty($result)){

          $sutdentData['year_term_id'] = $result[0]['id'];

        }

        $sutdentData['id'] = $student['id'];

        $entity = $this->Students->newEntity($sutdentData);
        
        $this->Students->save($entity);

      //END 

    }

    if ($save) {

      if($this->Auth->user('roleId')==12 && $employees['academic_rank_id'] != 1 && $employees['academic_rank_id'] != 3){

        $tmp = $this->StudentEnrolledCourses->find()->where([

          'student_id' => $studentId,

          'clearance_status !=' => 1,

          'visible'   => 1

        ])->count();

        if($tmp==0){

          $app->status_faculty = 1;

          $app->step = 2;

          $this->StudentClearances->save($app);

        }

      }

      //EMAIL VERIFICATION

        $name = @$student['first_name'].' '.@$student['middle_name'].' '.@$student['last_name'];

        $email = @$student['email'];

        $faculty = $this->Auth->user('first_name').' '.$this->Auth->user('last_name');

      if(isset($student['email'])){

        //EMAIL VERIFICATION
 
        if($email != ''){

          // fix value
      
          $mail = new PHPMailer(true);

          //Server settings
          // $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
          $mail->isSMTP(); // Send using SMTP
          $mail->Host = 'smtp.gmail.com';
          $mail->SMTPAuth = true;
          $mail->Username = 'mycreativepandaii@gmail.com'; // Your Gmail email address
          $mail->Password = 'tkoahowwnzuzqczy'; // Your Gmail password
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
          $mail->Port = 587; // TCP port to connect to

          // Bypass SSL certificate verification
          $mail->SMTPOptions = [

            'ssl' => [

              'verify_peer' => false,

              'verify_peer_name' => false,

              'allow_self_signed' => true,

            ],

          ];

          //Recipients
          $mail->setFrom('mycreativepandaii@gmail.com', 'ZAMBOANGA STATE COLLEGE OF MARINE SCIENCES AND TECHNOLOGY'); // Sender's email and name
          $mail->addAddress($email, $name); // Recipient's email and name

          // Content
          $mail->isHTML(true); // Set email format to HTML
          $mail->Subject = 'STUDENT CLEARANCE';

          if($this->Auth->user('roleId')==12 && $employees['academic_rank_id'] != 1){

            $_SESSION['status'] = @$app['status_faculty'] == 1 ? 'CLEARED' : '';

          }else if($this->Auth->user('roleId')==8){

            $_SESSION['status'] = @$app['status_cashier'] == 1 ? 'CLEARED' : '';

          }else if($this->Auth->user('roleId')==23){

            $_SESSION['status'] = @$app['status_librarian'] == 1 ? 'CLEARED' : '';

          }else if($this->Auth->user('roleId')==41){

            $_SESSION['status'] = @$app['status_apartelle'] == 1 ? 'CLEARED' : '';

          }else if($this->Auth->user('roleId')==0){

            $_SESSION['status'] = @$app['status_laboratory'] == 1 ? 'CLEARED' : '';

          }else if($this->Auth->user('roleId')==25){

            $_SESSION['status'] = @$app['status_affairs'] == 1 ? 'CLEARED' : '';

          }else if($this->Auth->user('roleId')==12 && $employees['academic_rank_id'] == 1){

            $_SESSION['status'] = @$app['status_head'] == 1 ? 'CLEARED' : '';

          }else if($this->Auth->user('roleId')==39){

            $_SESSION['status'] = @$app['status_dean'] == 1 ? 'CLEARED' : '';

          }

          $_SESSION['name'] = @$name; 

          $_SESSION['faculty'] =  $faculty;

          $_SESSION['id'] = $id; 

          ob_start();

          include('Email/clearance-cleared.ctp');

          $bodyContent = ob_get_contents();

          ob_end_clean();

          $mail->Body = $bodyContent;

          $mail->send();

        }

      }

      //EMAIL VERIFICATION

      $response = array(

        'ok'   => true,

        'data' => $app,       

        'msg'  => 'Student has been successfully cleared.'

      );

      $userLogEntity = $this->UserLogs->newEntity([

        'action' => 'Student Clearances',

        'description' => 'Send Email'.@$app['StudentApplication']['first_name'].' '.@$app['StudentApplication']['last_name'],

        'created' => date('Y-m-d H:i:s'),

        'modified' => date('Y-m-d H:i:s')

      ]);

      $this->UserLogs->save($userLogEntity);

    } else {

      $response = array(

        'ok'   => false,

        'data' => $data,

        'msg'  =>'Unable to send email.'

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

}
