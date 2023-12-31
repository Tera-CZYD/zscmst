app.controller('ReferralSlipController', function($scope, $window, ReferralSlip, AppointmentSlip) {

  $scope.today = Date.parse('today').toString('MM/dd/yyyy');

  $('.datepicker').datepicker({
   
    format: 'mm/dd/yyyy',
   
    autoclose: true,
   
    todayHighlight: true
  
  });

  $scope.referral = function(options) {

    options = typeof options !== 'undefined' ?  options : {};

    ReferralSlip.query(options, function(e) {

      if (e.ok) {

        $scope.datas = e.data;

        $scope.conditionsPrint = e.conditionsPrint;

        $scope.paginator = e.paginator;

        $scope.pages = paginator($scope.paginator, 5);

      }

    });

  }

  $scope.appointment = function(options) {

    options = typeof options !== 'undefined' ?  options : {};

    AppointmentSlip.query(options, function(e) {

      if (e.ok) {

        $scope.appointments = e.data;

        $scope.conditionsPrintAppointment = e.conditionsPrint;

        $scope.paginatorAppointment = e.paginator;

        $scope.pagesAppointment = paginator($scope.paginatorAppointment, 5);

      }

    });

  }

  $scope.load = function(options) {

    $scope.referral(options);

    $scope.appointment(options);

  }

  $scope.scrollToTop = function() {

    $window.scrollTo(0, 0);

  };

  $scope.scrollToTop();

  $scope.load();

  $scope.reload = function(options) {
  
    $scope.search = {};
 
    $scope.searchTxt = '';
   
    $scope.dateToday = null;
   
    $scope.startDate = null;
   
    $scope.endDate = null;

    $scope.load();

  }

  $scope.searchy = function(search) {

    search = typeof search !== 'undefined' ? search : '';

    if (search.length > 0){

      $scope.load({

        search: search

      });

    }else{

      $scope.load();
    
    }

  }

  $scope.selectedFilter = 'date';

  $scope.changeFilter = function(type){

    $scope.search = {};

    $scope.selectedFilter = type;

    $('.monthpicker').datepicker({format: 'MM', autoclose: true, minViewMode: 'months',maxViewMode:'months'});
 
    $('.input-daterange').datepicker({
 
      format: 'mm/dd/yyyy'

    });

  }

  $scope.searchFilter = function(search) {
   
    $scope.searchTxt = '';

    $scope.dateToday = null;
   
    $scope.startDate = null;
   
    $scope.endDate = null;

    if ($scope.selectedFilter == 'date') {
    
      $scope.dateToday = Date.parse(search.date).toString('yyyy-MM-dd');
   
    }else if ($scope.selectedFilter == 'month') {
   
      date = $('.monthpicker').datepicker('getDate');
   
      year = date.getFullYear();
   
      month = date.getMonth() + 1;
   
      lastDay = new Date(year, month, 0);

      if (month < 10) month = '0' + month;
      
      $scope.startDate = year + '-' + month + '-01';
      
      $scope.endDate = year + '-' + month + '-' + lastDay.getDate();
    
    }else if ($scope.selectedFilter == 'customRange') {
    
      $scope.startDate = Date.parse(search.startDate).toString('yyyy-MM-dd');
    
      $scope.endDate = Date.parse(search.endDate).toString('yyyy-MM-dd');
    
    }

    $scope.load({

      date         : $scope.dateToday,

      startDate    : $scope.startDate,

      endDate      : $scope.endDate

    });
  
  }

  $scope.remove = function(data) {

    bootbox.confirm('Are you sure you want to remove '+ data.code +' ?', function(c) {

      if (c) {

        ReferralSlip.remove({ id: data.id }, function(e) {

          if (e.ok) {

            $.gritter.add({

              title: 'Successful!',

              text:  e.msg,

            });

            $scope.load();

          }

        });

      }

    });

  }

  $scope.removeAppointment = function(data) {

    bootbox.confirm('Are you sure you want to remove '+ data.code +' ?', function(c) {

      if (c) {

        AppointmentSlip.remove({ id: data.id }, function(e) {

          if (e.ok) {

            $.gritter.add({

              title: 'Successful!',

              text:  e.msg,

            });

            $scope.load();

          }

        });

      }

    });

  }

  $scope.printReferral = function(){

    date = "";
    
    if ($scope.conditionsPrint !== '') {
    

      printTable(base + 'print/referral_slip_management?print=1' + $scope.conditionsPrint);

    }else{

      printTable(base + 'print/referral_slip_management?print=1');

    }

  }

  $scope.printAppointment = function(){

    date = "";
    
    if ($scope.conditionsPrintAppointment !== '') {
    

      printTable(base + 'print/appointment_slip_management?print=1' + $scope.conditionsPrintAppointment);

    }else{

      printTable(base + 'print/appointment_slip_management?print=1');

    }

  }

});

app.controller('ReferralSlipAddController', function($scope, ReferralSlip, Select) {

 $('.datepicker').datepicker({

    format:'mm/dd/yyyy',

    autoclose: true,

    todayHighlight: true,

  });

  $('#form').validationEngine('attach');

  Select.get({code: 'referral-slip-code'}, function(e) {

    $scope.data.ReferralSlip.code = e.data;

  });

  Select.get({ code: 'year-term-list' },function(e){

    $scope.year_terms = e.data;

  });

   Select.get({code: 'college-program-list-all'}, function(e) {

    $scope.college_program = e.data;

  });
  
  $scope.searchStudent = function(options) {

    options = typeof options !== 'undefined' ?  options : {};

    options['code'] = 'search-student';

    Select.query(options, function(e) {

      $scope.students = e.data.result;

      $scope.student = {};
      
      // paginator

      $scope.paginator  = e.data.paginator;

      $scope.pages = paginator($scope.paginator, 10);

      $("#searched-student-modal").modal('show');

    });

  }

  $scope.selectedStudent = function(student) { 

    $scope.student = {

      id   : student.id,

      code : student.code,

      name : student.name,

      program_id : student.program_id,

      year_term_id : student.year_term_id

    }; 

  }

  $scope.studentData = function(id) {

    $scope.data.ReferralSlip.student_id = $scope.student.id;

    $scope.data.ReferralSlip.student_name = $scope.student.name;

    $scope.data.ReferralSlip.course_id = $scope.student.program_id;

    $scope.data.ReferralSlip.year_term_id = $scope.student.year_term_id;

  }

  $scope.save = function() {

    valid = $("#form").validationEngine('validate');
    
    if (valid) {

      ReferralSlip.save($scope.data, function(e) {

        if (e.ok) {

          $.gritter.add({

            title: 'Successful!',

            text:  e.msg,

          });

          window.location = '#/guidance/referral-slip';

        } else {

          $.gritter.add({

            title: 'Warning!',

            text:  e.msg,

          });

        }

      });

    }  

  }

});

app.controller('ReferralSlipViewController', function($scope, $routeParams, ReferralSlip) {

  $scope.id = $routeParams.id;

  $scope.data = {};

  // load 
  $scope.load = function() {

    ReferralSlip.get({ id: $scope.id }, function(e) { 

      $scope.data = e.data;

    });

  }

  $scope.load();  

  $scope.print = function(id){
  
    printTable(base + 'print/referral_slip/'+id);

  }

  // remove 
  $scope.remove = function(data) {

    bootbox.confirm('Are you sure you want to remove '+ data.code +' ?', function(c) {

      if (c) {

        ReferralSlip.remove({ id: data.id }, function(e) {

          if (e.ok) {

            $.gritter.add({

              title: 'Successful!',

              text:  e.msg,

            });

            window.location = "#/guidance/referral-slip";

          }

        });

      }

    });

  } 

});

app.controller('ReferralSlipEditController', function($scope, $routeParams, ReferralSlip, Select) {
  
  $scope.id = $routeParams.id;


  $("#form").validationEngine('attach');

  $('.datepicker').datepicker({

    format:    'mm/dd/yyyy',

    autoclose: true,

    todayHighlight: true,

  });


  // load 
  $scope.load = function() {

    ReferralSlip.get({ id: $scope.id }, function(e) {

      $scope.data = e.data;

    });

  }

  // Select.get({code: 'course-list'}, function(e) {

  //   $scope.course = e.data;

  // });

  Select.get({code: 'college-program-list-all'}, function(e) {

    $scope.college_program = e.data;

  });

  $scope.searchStudent = function(options) {

    options = typeof options !== 'undefined' ?  options : {};

    options['code'] = 'search-student';

    Select.query(options, function(e) {

      $scope.students = e.data.result;

      $scope.student = {};
      
      // paginator

      $scope.paginator  = e.data.paginator;

      $scope.pages = paginator($scope.paginator, 10);

      $("#searched-student-modal").modal('show');

    });

  }

  $scope.selectedStudent = function(student) { 

    $scope.student = {

      id   : student.id,

      code : student.code,

      name : student.name,

      program_id : student.program_id,

      year_term_id : student.year_term_id

    }; 

  }

  $scope.studentData = function(id) {

    $scope.data.ReferralSlip.student_id = $scope.student.id;

    $scope.data.ReferralSlip.student_name = $scope.student.name;

    $scope.data.ReferralSlip.course_id = $scope.student.program_id;

    $scope.data.ReferralSlip.year_term_id = $scope.student.year_term_id;

  }

  $scope.load();

  $scope.update = function() {

    valid = $("#form").validationEngine('validate');

    if (valid) {

      ReferralSlip.update({id:$scope.id}, $scope.data, function(e) {

        if (e.ok) {

          $.gritter.add({

            title: 'Successful!',

            text:  e.msg,

          });

          window.location = '#/guidance/referral-slip';

        } else {

          $.gritter.add({

            title: 'Warning!',

            text:  e.msg,
            
          });

        }
        
      }); 

    }

  }

});