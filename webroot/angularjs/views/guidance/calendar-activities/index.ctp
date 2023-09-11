
<meta charset='utf-8' />

<link href='webroot/assets/plugins/fullcalendar-2.6.0/fullcalendar.css' rel='stylesheet' />

<link href='webroot/assets/plugins/fullcalendar-2.6.0/fullcalendar.print.css' rel='stylesheet' media='print' />

<script src='webroot/assets/plugins/fullcalendar-2.6.0/lib/moment.min.js'></script>

<script src='webroot/assets/plugins/fullcalendar-2.6.0/fullcalendar.min.js'></script>

<script>

var today = new Date();

var dd = today.getDate();

var mm = today.getMonth() + 1; //January is 0!

var yyyy = today.getFullYear();

if(dd<10) {

  dd = '0' + dd;

} 

if(mm < 10) {

  mm = '0' + mm

} 

today = yyyy+'/'+mm+'/'+dd;
    
$(document).ready(function() {

  $('#calendar').fullCalendar({

    header: {

    left: 'prev,next today',

    center: 'title',

    right: 'month,basicWeek,basicDay',

  },
  
  eventMouseover: function(calEvent, jsEvent) {

    var tooltip = '<div class="tooltipevent" style="width:100px;background:#ccc;position:absolute;z-index:10001;">' 

    + calEvent.title + '</div>';

      $("body").append(tooltip);

      $(this).mouseover(function(e) {

        $(this).css('z-index', 10000);

        $('.tooltipevent').fadeIn('500');

        $('.tooltipevent').fadeTo('10', 1.9);

      }).mousemove(function(e) {

        $('.tooltipevent').css('top', e.pageY + 10);

        $('.tooltipevent').css('left', e.pageX + 20);

      }); 

    },

    eventMouseout: function(calEvent, jsEvent) {

      $(this).css('z-index', 8);

      $('.tooltipevent').remove();

    },
    defaultDate: today,
    editable: true,
    eventLimit: true, 
    events: api + "select?code=calendar-activities",
    eventClick: function(event) {
      if (event.url) {
          window.open(event.url, "_blank");
          return false;
      }
    }

  });

});

</script>
<style>

  #calendar {
    max-width: 80%;
    margin: 0 auto;
    margin-top: 20px !important;

  }
  .btn.btn-default.red {
      background-color: red;
  }
  .btn.btn-default.green {
      background-color: green;
  }
  .btn.btn-default.orange {
      background-color: #3A87AD;
  }
  .btn.btn-default.blue {
      background-color: blue;
  }

</style>
<div class="row">
  <div class="col-lg-12 mt-3">
    <div class="card">
      <div class="card-body">
        <h4 class="header-title"> CALENDAR OF ACTIVITIES </h4>
        <div class="row">
          <div class="col-md-12">
            <div class="clearfix"></div><hr>
          </div>
          <!-- nav tab start -->
          <div class="col-lg-12">
            <ul class="nav nav-tabs" id="myTab" role="tablist" style="cursor: pointer;">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" data-target ="#calendarActivity" role="tab">CALENDAR</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" data-target ="#activity" role="tab">ACTIVITY</a>
              </li>
            </ul>
            <div class="tab-content mt-3" id="myTabContent">

              <div class="tab-pane fade show active" id="calendarActivity">
                <div class="clearfix"></div><hr>
                <div class="col-md-12">
                  <div id="calendar">
                  </div>
                </div>
              </div>
              <div class="tab-pane fade show" id="activity">
                <div class="clearfix"></div><hr>
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-8 col-xs-12" style="margin-bottom: 2px;padding-left: 0px">
                      <?php if (hasAccess('calendar of activities/add', $currentUser)): ?>
                        <a href="#/guidance/calendar-activities/add" class="btn btn-primary btn-sm btn-min"><i class="fa fa-plus"></i> ADD </a>
                      <?php endif ?>
                      <a href="javascript:void(0)" class="btn btn-success btn-sm btn-min" ng-click="advance_search()"><i class="fa fa-search"></i> ADVANCE SEARCH</a>
                      <?php if (hasAccess('calendar of activities/print', $currentUser)): ?>
                        <button type="button" class="btn btn-print btn-sm btn-min" ng-click="printActivity()"><i class="fa fa-print"></i> PRINT </button>
                      <?php endif ?>
                      <button type="button" class="btn btn-warning btn-sm btn-min" ng-click="reload()"><i class="fa fa-refresh"></i> RELOAD </button>
                    </div>
                    <div class="col-md-4 col-xs-12 pull-right">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                        <input type="text" class="form-control search" ng-enter="searchy(searchTxt)" placeholder="SEARCH HERE" ng-model="searchTxt">
                      </div>
                      <sup style="font-color:gray">Press Enter to search</sup> 
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div><hr>
                <div class="single-table mb-5">
                  <div class="table-responsive">
                    <table class="table table-bordered text-center">
                      <thead>
                        <tr class="bg-info">
                          <th class="w30px">#</th>
                          <th class="text-center"> CODE </th>
                          <th class="text-center"> TITLE </th>
                          <th class="text-center"> START DATE </th>
                          <th class="text-center"> END DATE </th>
                          <th class="text-center"> REMARKS </th>
                          <th class="text-center" style="width: 10%"></th> 
                        </tr>
                      </thead>
                      <tbody>
                        <tr ng-repeat="data in activities">
                          <td>{{ (paginator.page - 1 ) * paginator.limit + $index + 1 }}</td>
                          <td class="text-center">{{ data.code }}</td>
                          <td class="text-left uppercase">{{ data.title }}</td>
                          <td class="text-center">{{ data.startDate }}</td>
                          <td class="text-center">{{ data.endDate }}</td>
                          <td class="text-left uppercase">{{ data.remarks }}</td>
                          <td>
                            <div class="btn-group btn-group-xs">
                              <?php if (hasAccess('calendar of activities/view', $currentUser)): ?>
                              <a href="#/guidance/calendar-activities/view/{{ data.id }}" class="btn btn-success" title="VIEW"><i class="fa fa-eye"></i></a> 
                              <?php endif ?>
                              <?php if (hasAccess('calendar of activities/edit', $currentUser)): ?>
                              <a href="#/guidance/calendar-activities/edit/{{ data.id }}" class="btn btn-primary" title="EDIT"><i class="fa fa-edit"></i></a> 
                              <?php endif ?>
                              <?php if (hasAccess('calendar of activities/delete', $currentUser)): ?>
                              <a href="javascript:void(0)" ng-click="remove(data)" class="btn btn-danger" title="DELETE"><i class="fa fa-trash"></i></a>
                              <?php endif ?>
                            </div>
                          </td>
                        </tr>
                        <tr ng-show="activities == ''">
                          <td colspan="7" class="text-center">No available data</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="row">
                  <div class="col-md-12">
                    <ul class="pagination justify-content-center">
                      <li class="page-item">
                        <a class="page-link" href="javascript:void(0)" ng-click="getActivity({ page: 1, search: searchTxt,date:dateToday,startDate: startDate,endDate: endDate})"><sub>&laquo;&laquo;</sub></a>
                      </li>
                      <li class="page-item prevPage {{ !paginator.prevPage? 'disabled':'' }}">
                        <a class="page-link" href="javascript:void(0)" ng-click="getActivity({ page: paginator.page - 1, search: searchTxt,date:dateToday,startDate: startDate,endDate: endDate })">&laquo;</a>
                      </li>
                      <li ng-repeat="page in pages" class="page-item {{ paginator.page == page.number ? 'active':''}}" >
                        <a class="page-link" href="javascript:void(0)" class="text-center" ng-click="getActivity({ page: page.number, search: searchTxt,date:dateToday,startDate: startDate,endDate: endDate })">{{ page.number }}</a>
                      </li>
                      <li class="page-item nextPage {{ !paginator.nextPage? 'disabled':'' }}">
                        <a class="page-link" href="javascript:void(0)" ng-click="getActivity({ page: paginator.page + 1, search: searchTxt,date:dateToday,startDate: startDate,endDate: endDate })">&raquo;</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="javascript:void(0)" ng-click="getActivity({ page: paginator.pageCount, search: searchTxt,date:dateToday,startDate: startDate,endDate: endDate })"><sub>&raquo;&raquo;</sub> </a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                    <div class="text-center" ng-show="paginator.pageCount > 0">
                      <sup class="text-primary">Page {{ paginator.pageCount > 0 ? paginator.page : 0 }} out of {{ paginator.pageCount }}</sup>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endif ?>


<div class="modal fade" id="advance-search-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">ADVANCE SEARCH</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <div class="form-group">
            <label>FILTER BY</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-list-ul"></i></span>
              </div>
              <select class="form-control input-sm" ng-model="search.filterBy">
                <option value="date">DATE</option>
                <option value="today">TODAY</option>
                <option value="month">MONTH</option>
                <option value="this-month">THIS MONTH</option>
                <option value="custom-range">CUSTOM RANGE</option>
              </select>
            </div>
          </div>
        </div>
        <div ng-show="search.filterBy == 'custom-range'">
          <div class="col-md-12">
            <div class="input-group input-daterange mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
              </div>
              <input type="text" class="form-control input-sm uppercase" ng-model="search.startDate">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
              </div>
              <input type="text" class="form-control input-sm uppercase" ng-model="search.endDate">
            </div>
          </div>  
        </div>  
        <div ng-show="search.filterBy == 'month'">
          <div class="col-md-12">
            <div class="form-group">
              <label>MONTH</label>
                <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                </div>
                <input type="text" class="form-control monthpicker input-sm uppercase" ng-model="search.month">
              </div>
            </div>
          </div>
        </div>
        <div ng-show="search.filterBy == 'date'">
          <div class="col-md-12">
            <div class="form-group">
              <label>DATE</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                </div>
                <input type="text" class="form-control datepicker input-sm uppercase" ng-model="search.date">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <!-- <div class="btn-group btn-group-sm pull-right btn-min"> -->
          <button type="button" class="btn btn-danger btn-sm btn-min" data-dismiss="modal"> CANCEL</button>
          <button type="button" class="btn btn-primary btn-sm btn-min" ng-click="searchFilter(search)"> SEARCH</button>
        <!-- </div>  -->
      </div>
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div>