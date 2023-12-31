app.controller('CollegeBlockController', function($scope, $window, CollegeBlock,Select) {

  $scope.today = Date.parse('today').toString('MM/dd/yyyy');

  $('.datepicker').datepicker({
   
    format: 'mm/dd/yyyy',
   
    autoclose: true,
   
    todayHighlight: true
  
  });

  Select.get({ code: 'academic-term-list' },function(e){

    $scope.academic_terms = e.data;

  });

  Select.get({ code: 'college-list' },function(e){

    $scope.colleges = e.data;

  });

  $scope.load = function(options) {

    options = typeof options !== 'undefined' ?  options : {};

    CollegeBlock.query(options, function(e) {

      if (e.ok) {

        $scope.datas = e.data;

        $scope.conditionsPrint = e.conditionsPrint;

        $scope.paginator = e.paginator;

        $scope.pages = paginator($scope.paginator, 5);

      }

    });

  }

  $scope.scrollToTop = function() {

    $window.scrollTo(0, 0);

  };

  $scope.scrollToTop();

  $scope.load();

  $scope.getDepartment = function(id){

    if(id !== undefined && id !== null && id !== ''){

      Select.get({ code: 'college-department-list',id : id },function(e){

        $scope.college_departments = e.data;

      });

    }else{

      $scope.college_departments = [];

      $scope.programs = [];

    }

  }

  $scope.getProgram = function(id){

    if(id !== undefined && id !== null && id !== ''){

      Select.get({ code: 'college-department-program-list',id : id },function(e){

        $scope.programs = e.data;

      });

    }else{

      $scope.programs = [];

    }

  }
  
  $scope.reload = function(options) {
  
    $scope.search = {};
 
    $scope.searchTxt = '';
   
    $scope.term_id = null;
   
    $scope.college_id = null;
   
    $scope.department_id = null;
   
    $scope.program_id = null;

    $scope.load();

  }

  $scope.searchy = function(search) {

    search = typeof search !== 'undefined' ? search : '';

    if (search.length > 0){

      $scope.load({

        search: search,

        term_id : $scope.term_id,

        college_id : $scope.college_id,

        department_id : $scope.department_id,

        program_id : $scope.program_id

      });

    } else {

      $scope.load({

        term_id : $scope.term_id,

        college_id : $scope.college_id,

        department_id : $scope.department_id,

        program_id : $scope.program_id

      });
    
    }

  }

  $scope.remove = function(data) {

    bootbox.confirm('Are you sure you want to delete ' + data.code +' ?', function(c) {

      if (c) {

        CollegeBlock.remove({ id: data.id }, function(e) {

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

  $scope.advanceSearch = false;
  
  $scope.advance_search = function() {
  
    $scope.search = {};
 
    $scope.advanceSearch = false;
 
    $('.monthpicker').datepicker({format: 'MM', autoclose: true, minViewMode: 'months',maxViewMode:'months'});
 
    $('.input-daterange').datepicker({format: 'mm/dd/yyyy'});

    $('#advance-search-modal').modal('show');

  }

  $scope.searchFilter = function(search) {
  
    $scope.filter = false;
   
    $scope.advanceSearch = true;
   
    $scope.term_id = null;
   
    $scope.college_id = null;
   
    $scope.department_id = null;
   
    $scope.program_id = null;

    if(search.term_id !== null && search.term_id !== '' && search.term_id !== undefined){

      $scope.term_id = search.term_id;

    }

    if(search.college_id !== null && search.college_id !== '' && search.college_id !== undefined){

      $scope.college_id = search.college_id;

    }

    if(search.department_id !== null && search.department_id !== '' && search.department_id !== undefined){

      $scope.department_id = search.department_id;

    }

    if(search.program_id !== null && search.program_id !== '' && search.program_id !== undefined){

      $scope.program_id = search.program_id;

    }

    $scope.load({

      term_id : $scope.term_id,

      college_id : $scope.college_id,

      department_id : $scope.department_id,

      program_id : $scope.program_id

    });

    $('#advance-search-modal').modal('hide');
  
  } 

  $scope.print = function(){

    date = "";
    
    if ($scope.conditionsPrint !== '') {
    

      printTable(base + 'print/college_blocks?print=1' + $scope.conditionsPrint);

    }else{

      printTable(base + 'print/college_blocks?print=1');

    }

  }

});

app.controller('CollegeBlockAddController', function($scope, CollegeBlock, Select) {

  $('#form').validationEngine('attach');

  $('.datepicker').datepicker({

    format:'mm/dd/yyyy',

    autoclose: true,

    todayHighlight: true,

  });

  $('.yearpicker').datepicker({

    format: "yyyy",

    autoclose: true,

    minViewMode: "years",

    pickTime: false

  });

  Select.get({ code: 'academic-term-list' },function(e){

    $scope.academic_terms = e.data;

  });

  Select.get({ code: 'college-list' },function(e){

    $scope.colleges = e.data;

  });

  Select.get({ code: 'year-term-list' },function(e){

    $scope.curriculums = e.data;

  });

  $scope.getDepartment = function(id){

    if(id !== undefined && id !== null && id !== ''){

      Select.get({ code: 'college-department-list',id : id },function(e){

        $scope.college_departments = e.data;

      });

    }else{

      $scope.college_departments = [];

      $scope.programs = [];

    }

  }

  $scope.getProgram = function(id){

    if(id !== undefined && id !== null && id !== ''){

      Select.get({ code: 'college-department-program-list',id : id },function(e){

        $scope.programs = e.data;

      });

    }else{

      $scope.programs = [];

    }

  }

  $scope.save = function() {

    valid = $("#form").validationEngine('validate');
    
    if (valid) {

      CollegeBlock.save($scope.data, function(e) {

        if (e.ok) {

          $.gritter.add({

            title: 'Successful!',

            text:  e.msg,

          });

          window.location = '#/college-block';

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

app.controller('CollegeBlockViewController', function($scope, $routeParams, DeleteSelected, CollegeBlock, Select) {

  $scope.id = $routeParams.id;

  $scope.data = {};

  // load 
  $scope.load = function() {

    CollegeBlock.get({ id: $scope.id }, function(e) {

      $scope.data = e.data;

    });

  }

  $scope.load();  

  // remove 
  $scope.remove = function(data) {

    bootbox.confirm('Are you sure you want to remove '+ data.code +' ?', function(c) {

      if (c) {

        CollegeBlock.remove({ id: data.id }, function(e) {

          if (e.ok) {

            $.gritter.add({

              title: 'Successful!',

              text:  e.msg,

            });

            window.location = "#/college-block";

          }

        });

      }

    });

  } 

});

app.controller('CollegeBlockEditController', function($scope, $routeParams, CollegeBlock, Select) {
  
  $scope.id = $routeParams.id;

  $("#form").validationEngine('attach');

  $('.datepicker').datepicker({

    format:    'mm/dd/yyyy',

    autoclose: true,

    todayHighlight: true,

  });

  $('.yearpicker').datepicker({

    format: "yyyy",

    autoclose: true,

    minViewMode: "years",

    pickTime: false

  });

  Select.get({ code: 'academic-term-list' },function(e){

    $scope.academic_terms = e.data;

  });

  Select.get({ code: 'college-list' },function(e){

    $scope.colleges = e.data;

  });

  Select.get({ code: 'year-term-list' },function(e){

    $scope.curriculums = e.data;

  });

  // load 
  $scope.load = function() {

    CollegeBlock.get({ id: $scope.id }, function(e) {

      $scope.data = e.data;

      $scope.getDepartment($scope.data.CollegeBlock.college_id);

      $scope.getProgram($scope.data.CollegeBlock.department_id);

    });

  }

  $scope.load();

  $scope.getDepartment = function(id){

    if(id !== undefined && id !== null && id !== ''){

      Select.get({ code: 'college-department-list',id : id },function(e){

        $scope.college_departments = e.data;

      });

    }else{

      $scope.college_departments = [];

      $scope.programs = [];

    }

  }

  $scope.getProgram = function(id){

    if(id !== undefined && id !== null && id !== ''){

      Select.get({ code: 'college-department-program-list',id : id },function(e){

        $scope.programs = e.data;

      });

    }else{

      $scope.programs = [];

    }

  }

  $scope.save = function() {

    valid = $("#form").validationEngine('validate');

    if (valid) {

      CollegeBlock.update({id:$scope.id}, $scope.data, function(e) {

        if (e.ok) {

          $.gritter.add({

            title: 'Successful!',

            text:  e.msg,

          });

          window.location = '#/college-block';

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