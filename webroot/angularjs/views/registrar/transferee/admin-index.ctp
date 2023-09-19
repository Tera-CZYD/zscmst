<!-- <script type="text/javascript">

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
  handleAccess('pageIndex', 'transferee/index', currentUser);
  handleAccess('pageAdd', 'transferee/add', currentUser);
  handleAccess('pagePrint', 'transferee/print', currentUser);
  handleAccess('pageView', 'transferee/view', currentUser);
  handleAccess('pageEdit', 'transferee/edit', currentUser);
  handleAccess('pageDelete', 'transferee/delete', currentUser);

</script>
 -->
<div class="row" id="pageIndex">
  <div class="col-lg-12 mt-3">
    <div class="card">
      <div class="card-body">
        <h4 class="header-title">SCHOOL TRANSFER REQUEST</h4>
        <!-- <div class="clearfix"></div><hr> -->
        <!-- nav tab start --><!-- 
          <div class="col-lg-12">
            <ul class="nav nav-tabs" id="myTab" role="tablist" style="cursor: pointer;">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" data-target ="#pending" role="tab">PENDING</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" data-target ="#approved" role="tab">APPROVED</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" data-target ="#disapproved" role="tab">DISAPPROVED</a>
              </li>
            </ul> -->
            <div class="tab-content mt-3" id="myTabContent">
              <div class="tab-pane fade show active" id="pending">
                <div class="clearfix"></div><hr>
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-8 col-xs-12" style="margin-bottom: 2px;padding-left: 0px">
<<<<<<< HEAD
                        <a id="pageAdd" href="#/registrar/transferee/add" class="btn btn-primary  btn-min"><i class="fa fa-plus"></i> ADD</a>
                        <a href="javascript:void(0)" class="btn btn-success  btn-min" ng-click="advance_search()"><i class="fa fa-search"></i> ADVANCE SEARCH</a>
                        <button id="pagePrint" ng-click="print()" class="btn btn-danger  btn-min"><i class="fa fa-print"></i> PRINT</button>
=======
                      <?php if (hasAccess('transferee/add', $currentUser)): ?>
                        <a href="#/registrar/admin-transferee/add" class="btn btn-primary  btn-min"><i class="fa fa-plus"></i> ADD</a>
                      <?php endif ?>
                      <a href="javascript:void(0)" class="btn btn-success  btn-min" ng-click="advance_search()"><i class="fa fa-search"></i> ADVANCE SEARCH</a>
                      <?php if (hasAccess('transferee/print', $currentUser)): ?>
                        <button ng-click="print()" class="btn btn-danger  btn-min"><i class="fa fa-print"></i> PRINT</button>
                      <?php endif ?>
>>>>>>> ff4a922d572eefc3129fc29bd99e9172c07c3408
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
                      <thread>
                        <tr class="bg-info">
                          <th class="text-center w30px">#</th>
                          <th class="text-center"> STUDENT ID </th>
                          <th class="text-center"> STUDENT NAME </th>
                          <th class="text-center"> YEAR LEVEL </th>
                          <th class="text-center"> EMAIL </th>
                          <th class="text-center"> APPLICATION DATE </th>
                          <th class="w90px"></th>
                        </tr>
                      </thread>
                      <tbody>
                        <tr ng-repeat="data in datas">
                          <td class="text-center">{{ (paginator.page - 1 ) * paginator.limit + $index + 1 }}</td>
                          <td class="text-center">{{ data.student_no }}</td>
                          <td class="text-center">{{ data.full_name }}</td>
                          <td class="text-center">{{ data.year_level }}</td>
                          <td class="text-center">{{ data.email }}</td>
                          <td class="text-center">{{ data.date }}</td>
                          <td>
                            <div class="btn-group btn-group-xs">
                              <a id="pageView" href="#/registrar/admin-transferee/view/{{ data.id }}" class="btn btn-success" title="VIEW"><i class="fa fa-eye"></i></a> 
                              <a id="pageEdit" href="#/registrar/admin-transferee/edit/{{ data.id }}" class="btn btn-primary" ng-disabled = "data.status != 0" title="EDIT"><i class="fa fa-edit"></i></a> 
                              <a id="pageDelete" href="javascript:void(0)" ng-click="remove(data)" class="btn btn-danger" ng-disabled = "data.status != 0" title="DELETE"><i class="fa fa-trash"></i></a>
                            </div>
                          </td>
                        </tr>
                        <tr ng-show="datas == null || datas == ''">
                          <td colspan="8">No available data</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
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
              </div>

              <!-- <div class="tab-pane fade show" id="approved">
                <div class="clearfix"></div><hr>
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-8 col-xs-12" style="margin-bottom: 2px;padding-left: 0px">
                      <?php if (hasAccess('transferee/add', $currentUser)): ?>
                        <a href="#/transferee/add" class="btn btn-primary  btn-min"><i class="fa fa-plus"></i> ADD</a>
                      <?php endif ?>
                      <a href="javascript:void(0)" class="btn btn-success  btn-min" ng-click="advance_search()"><i class="fa fa-search"></i> ADVANCE SEARCH</a>
                      <?php if (hasAccess('transferee/print', $currentUser)): ?>
                        <button ng-click="printApproved()" class="btn btn-danger  btn-min"><i class="fa fa-print"></i> PRINT</button>
                      <?php endif ?>
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
                      <thread>
                        <tr class="bg-info">
                          <th class="text-center w30px">#</th>
                          <th class="text-center"> APPLICANT NAME </th>
                          <th class="text-center"> EMAIL </th>
                          <th class="text-center"> ADDRESS </th>
                          <th class="text-center"> CONTACT NO. </th>
                          <th class="text-center"> GENDER </th>
                          <th class="text-center"> APPLICATION DATE </th>
                          <th class="w90px"></th>
                        </tr>
                      </thread>
                      <tbody>
                        <tr ng-repeat="data in datasApproved">
                          <td class="text-center">{{ (paginatorApproved.page - 1 ) * paginatorApproved.limit + $index + 1 }}</td>
                          <td class="text-left">{{ data.full_name }}</td>
                          <td class="text-center">{{ data.email }}</td>
                          <td class="text-center">{{ data.address }}</td>
                          <td class="text-center">{{ data.contact_no }}</td>
                          <td class="text-center">{{ data.gender }}</td>
                          <td class="text-center">{{ data.application_date }}</td>
                          <td>
                            <div class="btn-group btn-group-xs">
                              <?php if (hasAccess('transferee/view', $currentUser)): ?>
                              <a href="#/admission/transferee/view/{{ data.id }}" class="btn btn-success" title="VIEW"><i class="fa fa-eye"></i></a> 
                              <?php endif ?>
                            </div>
                          </td>
                        </tr>
                        <tr ng-show="datasApproved == null || datasApproved == ''">
                          <td colspan="8">No available data</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <ul class="pagination justify-content-center">
                      <li class="page-item">
                        <a class="page-link" href="javascript:void(0)" ng-click="load({ page: 1, search: searchTxt })"><sub>&laquo;&laquo;</sub></a>
                      </li>
                      <li class="page-item prevPage {{ !paginatorApproved.prevPage? 'disabled':'' }}">
                        <a class="page-link" href="javascript:void(0)" ng-click="load({ page: paginatorApproved.page - 1, search: searchTxt })">&laquo;</a>
                      </li>
                      <li ng-repeat="page in pagesApproved" class="page-item {{ paginatorApproved.page == page.number ? 'active':''}}" >
                        <a class="page-link" href="javascript:void(0)" class="text-center" ng-click="load({ page: page.number, search: searchTxt })">{{ page.number }}</a>
                      </li>
                      <li class="page-item nextPage {{ !paginatorApproved.nextPage? 'disabled':'' }}">
                        <a class="page-link" href="javascript:void(0)" ng-click="load({ page: paginatorApproved.page + 1, search: searchTxt })">&raquo;</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="javascript:void(0)" ng-click="load({ page: paginatorApproved.pageCount, search: searchTxt })"><sub>&raquo;&raquo;</sub> </a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                    <div class="text-center" ng-show="paginatorApproved.pageCount > 0">
                      <sup class="text-primary">Page {{ paginatorApproved.pageCount > 0 ? paginatorApproved.page : 0 }} out of {{ paginatorApproved.pageCount }}</sup>
                    </div>
                  </div>
                </div>
              </div>

              <div class="tab-pane fade show" id="disapproved">
                <div class="clearfix"></div><hr>
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-8 col-xs-12" style="margin-bottom: 2px;padding-left: 0px">
                      <?php if (hasAccess('transferee/add', $currentUser)): ?>
                        <a href="#/admission/transferee/add" class="btn btn-primary  btn-min"><i class="fa fa-plus"></i> ADD</a>
                      <?php endif ?>
                      <a href="javascript:void(0)" class="btn btn-success  btn-min" ng-click="advance_search()"><i class="fa fa-search"></i> ADVANCE SEARCH</a>
                      <?php if (hasAccess('transferee/print', $currentUser)): ?>
                        <button ng-click="printDisapproved()" class="btn btn-danger  btn-min"><i class="fa fa-print"></i> PRINT</button>
                      <?php endif ?>
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
                      <thread>
                        <tr class="bg-info">
                          <th class="text-center w30px">#</th>
                          <th class="text-center"> APPLICANT NAME </th>
                          <th class="text-center"> EMAIL </th>
                          <th class="text-center"> ADDRESS </th>
                          <th class="text-center"> CONTACT NO. </th>
                          <th class="text-center"> GENDER </th>
                          <th class="text-center"> APPLICATION DATE </th>
                          <th class="w90px"></th>
                        </tr>
                      </thread>
                      <tbody>
                        <tr ng-repeat="data in datasDisapproved">
                          <td class="text-center">{{ (paginatorApproved.page - 1 ) * paginatorApproved.limit + $index + 1 }}</td>
                          <td class="text-left">{{ data.full_name }}</td>
                          <td class="text-center">{{ data.email }}</td>
                          <td class="text-center">{{ data.address }}</td>
                          <td class="text-center">{{ data.contact_no }}</td>
                          <td class="text-center">{{ data.gender }}</td>
                          <td class="text-center">{{ data.application_date }}</td>
                          <td>
                            <div class="btn-group btn-group-xs">
                              <?php if (hasAccess('transferee/view', $currentUser)): ?>
                              <a href="#/admission/stransferee/view/{{ data.id }}" class="btn btn-success" title="VIEW"><i class="fa fa-eye"></i></a> 
                              <?php endif ?>
                            </div>
                          </td>
                        </tr>
                        <tr ng-show="datasDisapproved == null || datasDisapproved == ''">
                          <td colspan="8">No available data</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <ul class="pagination justify-content-center">
                      <li class="page-item">
                        <a class="page-link" href="javascript:void(0)" ng-click="load({ page: 1, search: searchTxt })"><sub>&laquo;&laquo;</sub></a>
                      </li>
                      <li class="page-item prevPage {{ !paginatorDisapproved.prevPage? 'disabled':'' }}">
                        <a class="page-link" href="javascript:void(0)" ng-click="load({ page: paginatorDisapproved.page - 1, search: searchTxt })">&laquo;</a>
                      </li>
                      <li ng-repeat="page in pagesDisapproved" class="page-item {{ paginatorDisapproved.page == page.number ? 'active':''}}" >
                        <a class="page-link" href="javascript:void(0)" class="text-center" ng-click="load({ page: page.number, search: searchTxt })">{{ page.number }}</a>
                      </li>
                      <li class="page-item nextPage {{ !paginatorDisapproved.nextPage? 'disabled':'' }}">
                        <a class="page-link" href="javascript:void(0)" ng-click="load({ page: paginatorDisapproved.page + 1, search: searchTxt })">&raquo;</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="javascript:void(0)" ng-click="load({ page: paginatorDisapproved.pageCount, search: searchTxt })"><sub>&raquo;&raquo;</sub> </a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                    <div class="text-center" ng-show="paginatorDisapproved.pageCount > 0">
                      <sup class="text-primary">Page {{ paginatorDisapproved.pageCount > 0 ? paginatorDisapproved.page : 0 }} out of {{ paginatorDisapproved.pageCount }}</sup>
                    </div>
                  </div>
                </div>
              </div> -->

            </div>
          </div>  
      </div>
    </div>
  </div>
</div>

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