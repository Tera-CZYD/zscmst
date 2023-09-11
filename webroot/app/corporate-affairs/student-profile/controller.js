// app.controller('RegisteredStudentController', function($scope, RegisteredStudent,Select) {

//   $scope.today = Date.parse('today').toString('MM/dd/yyyy');

//   $('.datepicker').datepicker({
   
//     format: 'mm/dd/yyyy',
   
//     autoclose: true,
   
//     todayHighlight: true
  
//   });

//   $('.clockpicker').clockpicker({

//     donetext: 'Done',

//     twelvehour:  true,

//     placement: 'bottom',

//   });

//   Select.get({ code: 'year-term-list' },function(e){

//     $scope.year_terms = e.data;

//   });

//   $scope.load = function(options) {

//     options = typeof options !== 'undefined' ?  options : {};

//     RegisteredStudent.query(options, function(e) {

//       if (e.ok) {

//         $scope.datas = e.data;

//         $scope.conditionsPrint = e.conditionsPrint;

//         $scope.paginator = e.paginator;

//         $scope.pages = paginator($scope.paginator, 5);

//       }

//     });

//   }

//   // $scope.load();

//   $scope.getData = function(year_term_id){

//     $scope.year_term_id = year_term_id;

//     $scope.load({

//       year_term_id: $scope.year_term_id

//     });

//   }
  
//   $scope.reload = function(options) {
  
//     $scope.search = {};
 
//     $scope.searchTxt = '';
   
//     $scope.dateToday = null;
   
//     $scope.startDate = null;
   
//     $scope.endDate = null;

//     $scope.year_term_id = null;

//     $scope.load();

//   }

//   $scope.searchy = function(search) {

//     search = typeof search !== 'undefined' ? search : '';

//     if (search.length > 0){

//       $scope.load({

//         search        : search,

//         date          : $scope.dateToday,

//         startDate     : $scope.startDate,

//         endDate       : $scope.endDate,

//         year_term_id  : $scope.year_term_id,

//       });

//     }else{

//       $scope.load({

//         date          : $scope.dateToday,

//         startDate     : $scope.startDate,

//         endDate       : $scope.endDate,

//         year_term_id  : $scope.year_term_id,

//       });
    
//     }

//   }

//   $scope.advance_search = function() {

//     $scope.search = {};

//     $scope.advanceSearch = false;
 
//     $scope.position_id = null;
 
//     $scope.office_id = null;

//     $('.monthpicker').datepicker({

//       format: 'MM',

//       autoclose: true,

//       minViewMode: 'months',

//       maxViewMode: 'months'

//     });

//     $('.input-daterange').datepicker({

//       format: 'yyyy-mm-dd'

//     });

//     $('.datepicker').datepicker('setDate', '');

//     $('.monthpicker').datepicker('setDate', '');

//     $('.input-daterange').datepicker('setDate', '');

//     $('#advance-search-modal').modal('show');

//   }

//   $scope.searchFilter = function(search) {

//     $scope.filter = false;

//     $scope.advanceSearch = true;

//     $scope.searchTxt = '';

//     $scope.dateToday = null;

//     $scope.startDate = null;

//     $scope.endDate = null;

//     if (search.filterBy == 'today') {

//       $scope.dateToday = Date.parse('today').toString('yyyy-MM-dd');

//       $scope.today = Date.parse('today').toString('yyyy-MM-dd');

//       $scope.dateToday = $scope.today;

//     }else if (search.filterBy == 'date') {

//       $scope.dateToday = Date.parse(search.date).toString('yyyy-MM-dd');

//     }else if (search.filterBy == 'month') {

//       date = $('.monthpicker').datepicker('getDate');

//       year = date.getFullYear();

//       month = date.getMonth() + 1;

//       lastDay = new Date(year, month, 0);

//       if (month < 10) month = '0' + month;

//       $scope.startDate = year + '-' + month + '-01';

//       $scope.endDate = year + '-' + month + '-' + lastDay.getDate();

//     }else if (search.filterBy == 'this-month') {

//       date = new Date();

//       year = date.getFullYear();

//       month = date.getMonth() + 1;

//       lastDay = new Date(year, month, 0);

//       if (month < 10) month = '0' + month;

//       $scope.startDate = year + '-' + month + '-01';

//       $scope.endDate = year + '-' + month + '-' + lastDay.getDate();

//     }else if (search.filterBy == 'custom') {

//       $scope.startDate = Date.parse(search.startDate).toString('yyyy-MM-dd');

//       $scope.endDate =  Date.parse(search.endDate).toString('yyyy-MM-dd');

//     }

//     $scope.load({

//       date           : $scope.dateToday,

//       startDate      : $scope.startDate,

//       endDate        : $scope.endDate,

//       year_term_id   : $scope.year_term_id,

//     });

//     $('#advance-search-modal').modal('hide');

//   }

//   $scope.print = function(){

//     if ($scope.conditionsPrint !== '') {
    
//       printTable(base + 'print/registered_students?print=1' + $scope.conditionsPrint);

//     }else{

//       printTable(base + 'print/registered_students?print=1');

//     }

//   }

//   $scope.export = function(){

//     if ($scope.conditionsPrint !== undefined && $scope.conditionsPrint !== ''){

//       printTable(base + 'print/export_registered_students?print=1' + $scope.conditionsPrint);

//     }else{

//       printTable(base + 'print/export_registered_students?print=1');

//     }

//     // Select.get({code: 'daily-list-collection-export'}, function(e){});

//   }

// });

// app.controller('RegisteredStudentViewController', function($scope, $routeParams, RegisteredStudent, Select) {

//   $scope.id = $routeParams.id;

//   $scope.data = {};

//   // load 
//   $scope.load = function() {

//     RegisteredStudent.get({ id: $scope.id }, function(e) {

//       $scope.data = e.data;

//       console.log($scope.data);

//     });

//   }

//   $scope.load();  

//   $scope.print = function (id) {
  
//     printTable(base + "print/certificate_registrations/" + id);
  
//   };

// });