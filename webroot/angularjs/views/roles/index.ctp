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
  handleAccess('pageIndex', 'role management/index', currentUser);
  handleAccess('pageAdd', 'role management/add', currentUser);
  handleAccess('pageView', 'role management/view', currentUser);
  handleAccess('pageEdit', 'role management/edit', currentUser);
  handleAccess('pageDelete', 'role management/delete', currentUser);

</script>

<div class="row" id="pageIndex">
  <div class="col-lg-12 mt-3">
    <div class="card">
      <div class="card-body">
        <h4 class="header-title">ROLE MANAGEMENT</h4>
        <div class="clearfix"></div><hr>
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-8 col-xs-12" style="margin-bottom: 2px;padding-left: 0px">
                <a id="pageAdd" href="#/roles/add" class="btn btn-primary btn-min"><i class="fa fa-plus"></i> ADD RECORD </a>
              <button type="button" class="btn btn-warning btn-min" ng-click="reload()"><i class="fa fa-refresh"></i> RELOAD </button>
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
                  <th class="w50px">#</th>
                  <th class="text-center"> ROLE </th>
                  <th id="action" style="width: 100px;"></th> 
                </tr>
              </thead>
              <tbody>
                <tr ng-repeat="data in datas">
                  <td>{{ (paginator.page - 1 ) * paginator.limit + $index + 1 }}</td>
                  <td class="text-center uppercase">{{ data.name }}</td>
                  <td>
                    <div class="btn-group btn-group-xs">
                      <a id="pageView" href="#/roles/view/{{ data.id }}" class="btn btn-success" title="VIEW"><i class="fa fa-eye"></i></a> 
                      <a id="pageEdit" href="#/roles/edit/{{ data.id }}" class="btn btn-primary" title="EDIT"><i class="fa fa-edit"></i></a>
                      <a id="pageDelete" href="javascript:void(0)" ng-click="remove(data)" class="btn btn-danger" title="DELETE"><i class="fa fa-trash"></i></a>
                    </div>
                  </td>
                </tr>
                <tr ng-show="datas == ''">
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
                <a class="page-link" href="javascript:void(0)" ng-click="load({ page: 1, search: searchTxt,date:dateToday,startDate: startDate,endDate: endDate, office_id: office_id, position_id: position_id,employmentStatusId : employmentStatusId})"><sub>&laquo;&laquo;</sub></a>
              </li>
              <li class="page-item prevPage {{ !paginator.prevPage? 'disabled':'' }}">
                <a class="page-link" href="javascript:void(0)" ng-click="load({ page: paginator.page - 1, search: searchTxt,date:dateToday,startDate: startDate,endDate: endDate, office_id: office_id, position_id: position_id,employmentStatusId : employmentStatusId })">&laquo;</a>
              </li>
              <li ng-repeat="page in pages" class="page-item {{ paginator.page == page.number ? 'active':''}}" >
                <a class="page-link" href="javascript:void(0)" class="text-center" ng-click="load({ page: page.number, search: searchTxt,date:dateToday,startDate: startDate,endDate: endDate, office_id: office_id, position_id: position_id,employmentStatusId : employmentStatusId })">{{ page.number }}</a>
              </li>
              <li class="page-item nextPage {{ !paginator.nextPage? 'disabled':'' }}">
                <a class="page-link" href="javascript:void(0)" ng-click="load({ page: paginator.page + 1, search: searchTxt,date:dateToday,startDate: startDate,endDate: endDate, office_id: office_id, position_id: position_id,employmentStatusId : employmentStatusId })">&raquo;</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="javascript:void(0)" ng-click="load({ page: paginator.pageCount, search: searchTxt,date:dateToday,startDate: startDate,endDate: endDate, office_id: office_id, position_id: position_id,employmentStatusId : employmentStatusId })"><sub>&raquo;&raquo;</sub> </a>
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