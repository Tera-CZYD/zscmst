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
  handleAccess('pageIndex', 'request form/index', currentUser);
  handleAccess('pageAdd', 'request form/add', currentUser);
  handleAccess('pagePrint', 'request form/print', currentUser);
  handleAccess('pageView', 'request form/view', currentUser);
  handleAccess('pageEdit', 'request form/edit', currentUser);
  handleAccess('pageDelete', 'request form/delete', currentUser);

</script>

<div class="row" id="pageIndex">
  <div class="col-lg-12 mt-3">
    <div class="card">
      <div class="card-body">
        <h4 class="header-title">REQUEST FORM</h4>
        <div class="clearfix"></div><hr>
        <!-- nav tab start -->
          <div class="col-lg-12">

            <div class="col-md-8 col-xs-12">
              <ul class="nav nav-tabs" id="myTab" role="tablist" style="cursor: pointer;">
                <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" data-target ="#request" role="tab">REQUEST</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" data-target ="#approved" role="tab">APPROVED</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" data-target ="#paid" role="tab">PAID</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" data-target ="#paid_tor" role="tab">TRANSCRIPT OF RECORD</a>
                </li>
              </ul>
            </div>
            <div class="col-md-4 col-xs-12 pull-right">
              <div class="input-group-prepend">
                <span class="dropleft float-right input-group-text" style="padding : 0;">
                  <a class="fa fa-filter" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 15px;"></a>
                  <div class="dropdown-menu">
                    <div>
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
            <div class="tab-content mt-3" id="myTabContent">


          <div class="tab-pane fade show active" id="request">
            <div class="clearfix"></div><hr>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-8 col-xs-12" style="margin-bottom: 2px;padding-left: 0px">
                  <a id="pageAdd" href="#/registrar/admin-request-form/add" class="btn btn-primary  btn-min"><i class="fa fa-plus"></i> APPLY</a>
                  <!-- <a href="javascript:void(0)" class="btn btn-success  btn-min" ng-click="advance_search()"><i class="fa fa-search"></i> ADVANCE SEARCH</a> -->
                  <button id="pagePrint" ng-click="print()" class="btn btn-print  btn-min"><i class="fa fa-print"></i> PRINT</button>
                  <button type="button" class="btn btn-warning  btn-min" ng-click="reload()"><i class="fa fa-refresh"></i> RELOAD </button>
                  <!-- <?php if (hasAccess('request form/print', $currentUser)): ?>
                    <button ng-click="printForm()" class="btn btn-info btn-min"><i class="fa fa-print"></i> PRINT PRACTICUM FORM</button>
                  <?php endif ?>

                  <?php if (hasAccess('cog/print', $currentUser)): ?>
                    <button ng-click="printCOG()" class="btn btn-info btn-min"><i class="fa fa-print"></i> PRINT CERTIFICATE OF REGISTRATION FORM</button>
                  <?php endif ?>
                  <?php if (hasAccess('report rating/print', $currentUser)): ?>
                    <button ng-click="printReportRating()" class="btn btn-info btn-min"><i class="fa fa-print"></i> PRINT REPORT RATING FORM</button>
                  <?php endif ?>
                  <?php if (hasAccess('examinees attendance sheet/print', $currentUser)): ?>
                    <button ng-click="printEAS()" class="btn btn-info btn-min"><i class="fa fa-print"></i> PRINT EXAMINEES ATTENDANCE SHEET</button>
                  <?php endif ?> -->
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
                      <th class="text-center"> CONTROL NO. </th>
                      <th class="text-center"> STUDENT NAME </th>
                      <th class="text-center"> DATE </th>
                      <th class="text-center"> COURSE </th>
                      <th class="w90px"></th>
                    </tr>
                  </thread>
                  <tbody>
                    <tr ng-repeat="data in datas">
                      <td class="text-center">{{ (paginator.page - 1 ) * paginator.limit + $index + 1 }}</td>
                      <td class="text-center">{{ data.code }}</td>
                      <td class="text-left">{{ data.student_name }}</td>
                      <td class="text-center">{{ data.date }}</td>
                      <td class="text-center">{{ data.course }}</td>
                      <td>
                        <div class="btn-group btn-group-xs">
                          <a id="pageView" href="#/registrar/admin-request-form/view/{{ data.id }}" class="btn btn-success" title="VIEW"><i class="fa fa-eye"></i></a> 
                          <a id="pageEdit" href="#/registrar/admin-request-form/edit/{{ data.id }}" class="btn btn-primary" ng-disabled = "data.status != 0" title="EDIT"><i class="fa fa-edit"></i></a> 
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

          <div class="tab-pane fade show" id="approved">
            <div class="clearfix"></div><hr>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-8 col-xs-12" style="margin-bottom: 2px;padding-left: 0px">
                  <!-- <a href="javascript:void(0)" class="btn btn-success  btn-min" ng-click="advance_search()"><i class="fa fa-search"></i> ADVANCE SEARCH</a> -->
                    <button id="pagePrint" ng-click="printApproved()" class="btn btn-print  btn-min"><i class="fa fa-print"></i> PRINT</button>
                  <button type="button" class="btn btn-warning  btn-min" ng-click="reload()"><i class="fa fa-refresh"></i> RELOAD </button>
                  <!-- <?php if (hasAccess('request form/print', $currentUser)): ?>
                    <button ng-click="printForm()" class="btn btn-info btn-min"><i class="fa fa-print"></i> PRINT PRACTICUM FORM</button>
                  <?php endif ?>

                  <?php if (hasAccess('cog/print', $currentUser)): ?>
                    <button ng-click="printCOG()" class="btn btn-info btn-min"><i class="fa fa-print"></i> PRINT CERTIFICATE OF REGISTRATION FORM</button>
                  <?php endif ?>
                  <?php if (hasAccess('report rating/print', $currentUser)): ?>
                    <button ng-click="printReportRating()" class="btn btn-info btn-min"><i class="fa fa-print"></i> PRINT REPORT RATING FORM</button>
                  <?php endif ?>
                  <?php if (hasAccess('examinees attendance sheet/print', $currentUser)): ?>
                    <button ng-click="printEAS()" class="btn btn-info btn-min"><i class="fa fa-print"></i> PRINT EXAMINEES ATTENDANCE SHEET</button>
                  <?php endif ?> -->
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
                      <th class="text-center"> CONTROL NO. </th>
                      <th class="text-center"> STUDENT NAME </th>
                      <th class="text-center"> DATE </th>
                      <th class="text-center"> COURSE </th>
                      <th class="text-center"> DATE RETRIEVED </th>
                      <th class="text-center"> DATE COMPLETED </th>
                      <th class="text-center"> DATE RELEASED </th>
                      <th class="text-center"> DATE RETURNED </th>
                      <th class="w90px"></th>
                    </tr>
                  </thread>
                  <tbody>
                    <tr ng-repeat="data in datasApproved">
                      <td class="text-center">{{ (paginator.page - 1 ) * paginator.limit + $index + 1 }}</td>
                      <td class="text-center">{{ data.code }}</td>
                      <td class="text-left">{{ data.student_name }}</td>
                      <td class="text-center">{{ data.date }}</td>
                      <td class="text-center">{{ data.course }}</td>

                      <td class="text-right" ng-hide = "data.editmode">{{ data.date_retrieved }}</td>
                      <td class="text-right" ng-show="data.editmode">
                        <input type="date" class="form-control" value="{{ data.date_retrieved }}" ng-model="data.date_retrieved">
                      </td>

                      <td class="text-right" ng-hide = "data.editmode">{{ data.date_completed }}</td>
                      <td class="text-right" ng-show="data.editmode">
                        <input type="date" class="form-control" value="" ng-model="data.date_completed">
                      </td>

                      <td class="text-right" ng-hide = "data.editmode">{{ data.date_released }}</td>
                      <td class="text-right" ng-show="data.editmode">
                        <input type="date" class="form-control" value="" ng-model="data.date_released">
                      </td>

                      <td class="text-right" ng-hide = "data.editmode">{{ data.date_returned }}</td>
                      <td class="text-right" ng-show="data.editmode">
                        <input type="date" class="form-control" value="" ng-model="data.date_returned">
                      </td>
                      <td>
                        <div class="btn-group btn-group-xs">
                          <?php if (hasAccess('request form/view', $currentUser)): ?>
                          
                          <!-- <button type="submit" ng-hide="data.editmode" ng-click="data.editmode = true" class="btn btn-primary  btn-xs no-border-radius" title="EDIT VALUE"><i class="fa fa-pencil"></i></button> -->
                          <a href="javascript:void(0)" class="btn btn-warning" ng-hide="data.editmode" ng-click="data.editmode = true" title="EDIT DOCUMENT DATE"><i class="fa fa-pencil"></i></a> 
                       
                          <!-- <button type="submit" ng-show="data.editmode" ng-click="data.editmode = false;updateValue(data)" title="SAVE VALUE" class="btn btn-success no-border-radius btn-xs"><i class="fa fa-save"></i></button> -->
                          <a href="javascript:void(0)" class="btn btn-warning" ng-show="data.editmode" ng-click="data.editmode = false;updateValue(data)" title="UPDATE DOCUMENT DATE"><i class="fa fa-save"></i></a> 
                        
                          <?php endif ?>
                          <?php if (hasAccess('request form/view', $currentUser)): ?>
                          <a href="#/registrar/admin-request-form/view/{{ data.id }}" class="btn btn-success" title="VIEW"><i class="fa fa-eye"></i></a> 
                          <?php endif ?>
                          <!-- <?php if (hasAccess('request form/edit', $currentUser)): ?>
                          <a href="#/registrar/admin-request-form/edit/{{ data.id }}" class="btn btn-primary" ng-disabled = "data.status != 0" title="EDIT"><i class="fa fa-edit"></i></a> 
                          <?php endif ?>
                          <?php if (hasAccess('request form/delete', $currentUser)): ?>
                          <a href="javascript:void(0)" ng-click="remove(data)" class="btn btn-danger" ng-disabled = "data.status != 0" title="DELETE"><i class="fa fa-trash"></i></a>
                          <?php endif ?> -->
                        </div>
                      </td>
                    </tr>
                    <tr ng-show="datasApproved == null || datasApproved == ''">
                      <td colspan="12">No available data</td>
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

          <div class="tab-pane fade show" id="paid">
            <div class="clearfix"></div><hr>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-8 col-xs-12" style="margin-bottom: 2px;padding-left: 0px">
                  <!-- <a href="javascript:void(0)" class="btn btn-success  btn-min" ng-click="advance_search()"><i class="fa fa-search"></i> ADVANCE SEARCH</a> -->
                    <button id="pagePrint" ng-click="printPaid()" class="btn btn-print  btn-min"><i class="fa fa-print"></i> PRINT</button>
                  <button type="button" class="btn btn-warning  btn-min" ng-click="reload()"><i class="fa fa-refresh"></i> RELOAD </button>
                  <!-- <?php if (hasAccess('request form/print', $currentUser)): ?>
                    <button ng-click="printForm()" class="btn btn-info btn-min"><i class="fa fa-print"></i> PRINT PRACTICUM FORM</button>
                  <?php endif ?>

                  <?php if (hasAccess('cog/print', $currentUser)): ?>
                    <button ng-click="printCOG()" class="btn btn-info btn-min"><i class="fa fa-print"></i> PRINT CERTIFICATE OF REGISTRATION FORM</button>
                  <?php endif ?>
                  <?php if (hasAccess('report rating/print', $currentUser)): ?>
                    <button ng-click="printReportRating()" class="btn btn-info btn-min"><i class="fa fa-print"></i> PRINT REPORT RATING FORM</button>
                  <?php endif ?>
                  <?php if (hasAccess('examinees attendance sheet/print', $currentUser)): ?>
                    <button ng-click="printEAS()" class="btn btn-info btn-min"><i class="fa fa-print"></i> PRINT EXAMINEES ATTENDANCE SHEET</button>
                  <?php endif ?> -->
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
                      <th class="text-center"> CONTROL NO. </th>
                      <th class="text-center"> STUDENT NAME </th>
                      <th class="text-center"> DATE </th>
                      <th class="text-center"> COURSE </th>
                      <th class="w90px"></th>
                    </tr>
                  </thread>
                  <tbody>
                    <tr ng-repeat="data in datasPaid">
                      <td class="text-center">{{ (paginatorPaid.page - 1 ) * paginatorPaid.limit + $index + 1 }}</td>
                      <td class="text-center">{{ data.code }}</td>
                      <td class="text-left">{{ data.student_name }}</td>
                      <td class="text-center">{{ data.date }}</td>
                      <td class="text-center">{{ data.course }}</td>
                      <td>
                        <div class="btn-group btn-group-xs">
                          <a id="pageView" href="#/registrar/admin-request-form/view/{{ data.id }}" class="btn btn-success" title="VIEW"><i class="fa fa-eye"></i></a> 
                          <!-- <a id="pageEdit" href="#/registrar/admin-request-form/edit/{{ data.id }}" class="btn btn-primary" ng-disabled = "data.status != 0" title="EDIT"><i class="fa fa-edit"></i></a> 
                          <a id="pageDelete" href="javascript:void(0)" ng-click="remove(data)" class="btn btn-danger" ng-disabled = "data.status != 0" title="DELETE"><i class="fa fa-trash"></i></a> -->
                        </div>
                      </td>
                    </tr>
                    <tr ng-show="datasPaid == null || datasPaid == ''">
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
                  <li class="page-item prevPage {{ !paginatorPaid.prevPage? 'disabled':'' }}">
                    <a class="page-link" href="javascript:void(0)" ng-click="load({ page: paginatorPaid.page - 1, search: searchTxt })">&laquo;</a>
                  </li>
                  <li ng-repeat="page in pagesPaid" class="page-item {{ paginatorPaid.page == page.number ? 'active':''}}" >
                    <a class="page-link" href="javascript:void(0)" class="text-center" ng-click="load({ page: page.number, search: searchTxt })">{{ page.number }}</a>
                  </li>
                  <li class="page-item nextPage {{ !paginatorPaid.nextPage? 'disabled':'' }}">
                    <a class="page-link" href="javascript:void(0)" ng-click="load({ page: paginatorPaid.page + 1, search: searchTxt })">&raquo;</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="javascript:void(0)" ng-click="load({ page: paginatorPaid.pageCount, search: searchTxt })"><sub>&raquo;&raquo;</sub> </a>
                  </li>
                </ul>
                <div class="clearfix"></div>
                <div class="text-center" ng-show="paginatorPaid.pageCount > 0">
                  <sup class="text-primary">Page {{ paginatorPaid.pageCount > 0 ? paginatorPaid.page : 0 }} out of {{ paginatorPaid.pageCount }}</sup>
                </div>
              </div>
            </div>
          </div>

          <div class="tab-pane fade show" id="paid_tor">
            <div class="clearfix"></div><hr>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-8 col-xs-12" style="margin-bottom: 2px;padding-left: 0px">
                  <!-- <a href="javascript:void(0)" class="btn btn-success  btn-min" ng-click="advance_search()"><i class="fa fa-search"></i> ADVANCE SEARCH</a> -->
                    <button id="pagePrint" ng-click="printTor()" class="btn btn-print  btn-min"><i class="fa fa-print"></i> PRINT</button>
                  <button type="button" class="btn btn-warning  btn-min" ng-click="reload()"><i class="fa fa-refresh"></i> RELOAD </button>
                  <!-- <?php if (hasAccess('request form/print', $currentUser)): ?>
                    <button ng-click="printForm()" class="btn btn-info btn-min"><i class="fa fa-print"></i> PRINT PRACTICUM FORM</button>
                  <?php endif ?>

                  <?php if (hasAccess('cog/print', $currentUser)): ?>
                    <button ng-click="printCOG()" class="btn btn-info btn-min"><i class="fa fa-print"></i> PRINT CERTIFICATE OF REGISTRATION FORM</button>
                  <?php endif ?>
                  <?php if (hasAccess('report rating/print', $currentUser)): ?>
                    <button ng-click="printReportRating()" class="btn btn-info btn-min"><i class="fa fa-print"></i> PRINT REPORT RATING FORM</button>
                  <?php endif ?>
                  <?php if (hasAccess('examinees attendance sheet/print', $currentUser)): ?>
                    <button ng-click="printEAS()" class="btn btn-info btn-min"><i class="fa fa-print"></i> PRINT EXAMINEES ATTENDANCE SHEET</button>
                  <?php endif ?> -->
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
                      <th class="text-center"> CONTROL NO. </th>
                      <th class="text-center"> STUDENT NAME </th>
                      <th class="text-center"> DATE </th>
                      <th class="text-center"> COURSE </th>
                      <th class="w90px"></th>
                    </tr>
                  </thread>
                  <tbody>
                    <tr ng-repeat="data in datasTor">
                      <td class="text-center">{{ (paginatorTor.page - 1 ) * paginatorTor.limit + $index + 1 }}</td>
                      <td class="text-center">{{ data.code }}</td>
                      <td class="text-left">{{ data.student_name }}</td>
                      <td class="text-center">{{ data.date }}</td>
                      <td class="text-center">{{ data.course }}</td>
                      <td>
                        <div class="btn-group btn-group-xs">
                          <a id="pageView" href="#/registrar/admin-request-form/view/{{ data.id }}" class="btn btn-success" title="VIEW"><i class="fa fa-eye"></i></a> 
                          <!-- <a id="pageEdit" href="#/registrar/admin-request-form/edit/{{ data.id }}" class="btn btn-primary" ng-disabled = "data.status != 0" title="EDIT"><i class="fa fa-edit"></i></a> 
                          <a id="pageDelete" href="javascript:void(0)" ng-click="remove(data)" class="btn btn-danger" ng-disabled = "data.status != 0" title="DELETE"><i class="fa fa-trash"></i></a> -->
                        </div>
                      </td>
                    </tr>
                    <tr ng-show="datasTor == null || datasTor == ''">
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
                  <li class="page-item prevPage {{ !paginatorTor.prevPage? 'disabled':'' }}">
                    <a class="page-link" href="javascript:void(0)" ng-click="load({ page: paginatorTor.page - 1, search: searchTxt })">&laquo;</a>
                  </li>
                  <li ng-repeat="page in pagesTor" class="page-item {{ paginatorTor.page == page.number ? 'active':''}}" >
                    <a class="page-link" href="javascript:void(0)" class="text-center" ng-click="load({ page: page.number, search: searchTxt })">{{ page.number }}</a>
                  </li>
                  <li class="page-item nextPage {{ !paginatorTor.nextPage? 'disabled':'' }}">
                    <a class="page-link" href="javascript:void(0)" ng-click="load({ page: paginatorTor.page + 1, search: searchTxt })">&raquo;</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="javascript:void(0)" ng-click="load({ page: paginatorTor.pageCount, search: searchTxt })"><sub>&raquo;&raquo;</sub> </a>
                  </li>
                </ul>
                <div class="clearfix"></div>
                <div class="text-center" ng-show="paginatorTor.pageCount > 0">
                  <sup class="text-primary">Page {{ paginatorTor.pageCount > 0 ? paginatorTor.page : 0 }} out of {{ paginatorTor.pageCount }}</sup>
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