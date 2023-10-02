<script type="text/javascript">

  function handleAccess(elementId, permissionCode, currentUser) {
    const element = document.getElementById(elementId);
    const accessGranted = hasAccess(permissionCode, currentUser);
    
    if (accessGranted) {
      element.classList.remove('d-none'); // Remove Bootstrap's "d-none" class to show the element
    } else {
      element.classList.add('d-none'); // Add Bootstrap's "d-none" class to hide the element
    }
  }

  // INCLUDE ALL PAGE PERMISSION

  handleAccess('pageAdd', 'appointment slip/add', currentUser);
  handleAccess('pagePrint', 'appointment slip/print', currentUser);
  handleAccess('pageView', 'appointment slip/view', currentUser);
  handleAccess('pageEdit', 'appointment slip/edit', currentUser);
  handleAccess('pageDelete', 'appointment slip/delete', currentUser);

</script>

<div class="row" id="pageIndex">
  <div class="col-lg-12 mt-3">
    <div class="card">
      <div class="card-body">
        <h4 class="header-title">APPOINTMENT SLIP</h4>
        <div class="col-md-4 col-xs-12 pull-right">
              <div class="input-group-prepend">
                <span class="dropleft float-right input-group-text" style="padding : 0;">
                  <a class="fa fa-filter" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 15px;"></a>
                  <div class="dropdown-menu">
                    <div ng-show="!data.CourseActivity.disable_admin_quiz_button">
                      <a class="dropdown-item text-dark" href="javascript:void(0)" ng-click="changeFilter('date')">DATE</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item text-dark" href="javascript:void(0)" ng-click="changeFilter('month')">MONTH</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item text-dark" href="javascript:void(0)" ng-click="changeFilter('customRange')">CUSTOM RANGE</a>
                    </div>
                  </div>
                </span>
                <input ng-show="selectedFilter == 'date'" type="text" class="form-control datepicker input-sm uppercase" ng-model="search.date" ng-change="searchFilter(search)" placeholder="FILTER BY DATE">
                <input ng-show="selectedFilter == 'month'" type="text" class="form-control monthpicker input-sm uppercase" ng-model="search.month" ng-change="searchFilter(search)" placeholder="FILTER BY MONTH">
                <div class="input-group input-daterange" style="margin-bottom: 0;" ng-show="selectedFilter == 'customRange'">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                  </div>
                  <input type="text" class="form-control input-sm uppercase" ng-model="search.startDate" ng-change="searchFilter(search)" placeholder="START DATE">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                  </div>
                  <input type="text" class="form-control input-sm uppercase" ng-model="search.endDate" ng-change="searchFilter(search)" placeholder="END DATE">
                </div>
              </div>
            </div>
        <div class="clearfix"></div><hr>
          <div class="col-lg-12">
            <!-- <div class="tab-content mt-3" id="myTabContent"> -->
              <div class="clearfix"></div>
              <!-- <div class="tab-pane fade show active" > -->
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-8 col-xs-12" style="margin-bottom: 2px;padding-left: 0px">
                      <a id="pageAdd" href="#/faculty/appointment-slip/add" class="btn btn-primary btn-sm btn-min"><i class="fa fa-plus"></i> ADD </a>
                      <button id="pagePrint" ng-click="printAppointment()" class="btn btn-print  btn-min"><i class="fa fa-print"></i> PRINT</button>
                      <button type="button" class="btn btn-warning  btn-min" ng-click="reload()"><i class="fa fa-refresh"></i> RELOAD </button>
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
                          <th class="w10px" style="width: 50px">#</th>
                          <th>CONTROL NO.</th>
                          <th>STUDENT NAME</th>
                          <th>DATE</th>
                          <th>TIME</th>
                          <th>LOCATION</th>
                          <th class="w90px"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr ng-repeat="data in appointments">
                          <td class="text-center">{{ (paginator.page - 1 ) * paginator.limit + $index + 1 }}</td>
                          <td class="text-center">{{ data.code }}</td>
                          <td class="text-left">{{ data.student_name }}</td>
                          <td class="text-center">{{ data.date }}</td>
                          <td class="text-center">{{ data.time }}</td>
                          <td class="text-left">{{ data.location }}</td>
                          <td>
                            <div class="btn-group btn-group-xs">
                              <a id="pageView" href="#/faculty/appointment-slip/view/{{ data.id }}" class="btn btn-success" title="VIEW"><i class="fa fa-eye"></i></a>
                              <a id="pageEdit" href="#/faculty/appointment-slip/edit/{{ data.id }}" class="btn btn-primary" title="EDIT"><i class="fa fa-edit"></i></a>
                              <a id="pageDelete" href="javascript:void(0)" ng-click="remove(data)" class="btn btn-danger" title="DELETE"><i class="fa fa-trash"></i></a>
                            </div>
                          </td> 
                        </tr>
                        <tr ng-show="appointments == null || appointments == ''">
                          <td colspan="12">No available data</td>
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
                        <a class="page-link" href="javascript:void(0)" ng-click="load({ page: 1, search: searchTxt })"><sub>&laquo;&laquo;</sub></a>
                      </li>
                      <li class="page-item prevPage {{ !paginator.prevPage? 'disabled':'' }}">
                        <a class="page-link" href="javascript:void(0)" ng-click="load({ page: paginator.page - 1, search: searchTxt })">&laquo;</a>
                      </li>
                      <li ng-repeat="page in pages" class="page-item {{ paginator.page == page.number ? 'active':''}}" >
                        <a class="page-link" href="javascript:void(0)" class="text-center" ng-click="load({ page: page.number, search: searchTxt })">{{ page.number }}</a>
                      </li>
                      <li class="page-item nextPage {{ !paginator.nextPage? 'disabled':'' }}">
                        <a class="page-link" href="javascript:void(0)" ng-click="load({ page: paginator.page + 1, search: searchTxt })">&raquo;</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="javascript:void(0)" ng-click="load({ page: paginator.pageCount, search: searchTxt })"><sub>&raquo;&raquo;</sub> </a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                    <div class="text-center" ng-show="paginator.pageCount > 0">
                      <sup class="text-primary">Page {{ paginator.pageCount > 0 ? paginator.page : 0 }} out of {{ paginator.pageCount }}</sup>
                    </div>
                  </div>
                </div>
              <!-- </div> -->
<!--               <div class="tab-pane fade show" id="appointment">
                <div class="col-md-12 pt-3">
                  <div class="row">
                    <div class="col-md-8 col-xs-12" style="margin-bottom: 2px;padding-left: 0px">
                      <a id="pageAddAppointment" href="#/guidance/appointment-slip/add" class="btn btn-primary btn-sm btn-min"><i class="fa fa-plus"></i> ADD </a>
                      <button id="pagePrintAppointment" ng-click="printAppointment()" class="btn btn-print  btn-min"><i class="fa fa-print"></i> PRINT</button>
                      <button type="button" class="btn btn-warning  btn-min" ng-click="reload()"><i class="fa fa-refresh"></i> RELOAD </button>
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
                          <th class="w10px" style="width: 50px">#</th>
                          <th>CONTROL NO.</th>
                          <th>STUDENT NAME</th>
                          <th>DATE</th>
                          <th>TIME</th>
                          <th>LOCATION</th>
                          <th class="w90px"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr ng-repeat="data in appointments">
                          <td class="text-center">{{ (paginatorAppointment.page - 1 ) * paginatorAppointment.limit + $index + 1 }}</td>
                          <td class="text-center">{{ data.code }}</td>
                          <td class="text-left">{{ data.student_name }}</td>
                          <td class="text-center">{{ data.date }}</td>
                          <td class="text-center">{{ data.time }}</td>
                          <td class="text-left">{{ data.location }}</td>
                          <td>
                            <div class="btn-group btn-group-xs">
                              <a id="pageViewAppointment" href="#/guidance/appointment-slip/view/{{ data.id }}" class="btn btn-success" title="VIEW"><i class="fa fa-eye"></i></a>
                              <a id="pageEditAppointment" href="#/guidance/appointment-slip/edit/{{ data.id }}" class="btn btn-primary" title="EDIT"><i class="fa fa-edit"></i></a>
                              <a id="pageDeleteAppointment" href="javascript:void(0)" ng-click="removeAppointment(data)" class="btn btn-danger" title="DELETE"><i class="fa fa-trash"></i></a>
                            </div>
                          </td> 
                        </tr>
                        <tr ng-show="appointments == null || appointments == ''">
                          <td colspan="6">No available data</td>
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
                        <a class="page-link" href="javascript:void(0)" ng-click="appointment({ page: 1, search: searchTxt })"><sub>&laquo;&laquo;</sub></a>
                      </li>
                      <li class="page-item prevPage {{ !paginatorAppointment.prevPage? 'disabled':'' }}">
                        <a class="page-link" href="javascript:void(0)" ng-click="appointment({ page: paginatorAppointment.page - 1, search: searchTxt })">&laquo;</a>
                      </li>
                      <li ng-repeat="page in pagesAppointment" class="page-item {{ paginatorAppointment.page == page.number ? 'active':''}}" >
                        <a class="page-link" href="javascript:void(0)" class="text-center" ng-click="appointment({ page: page.number, search: searchTxt })">{{ page.number }}</a>
                      </li>
                      <li class="page-item nextPage {{ !paginatorAppointment.nextPage? 'disabled':'' }}">
                        <a class="page-link" href="javascript:void(0)" ng-click="appointment({ page: paginatorAppointment.page + 1, search: searchTxt })">&raquo;</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="javascript:void(0)" ng-click="appointment({ page: paginatorAppointment.pageCount, search: searchTxt })"><sub>&raquo;&raquo;</sub> </a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                    <div class="text-center" ng-show="paginatorAppointment.pageCount > 0">
                      <sup class="text-primary">Page {{ paginatorAppointment.pageCount > 0 ? paginatorAppointment.page : 0 }} out of {{ paginatorAppointment.pageCount }}</sup>
                    </div>
                  </div>
                </div>
              </div> -->
            <!-- </div> -->
          </div>

        </div>
      </div>
    </div>
  </div>
</div>