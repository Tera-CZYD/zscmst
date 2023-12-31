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
  handleAccess('pageIndex', 'inventory bibliography/index', currentUser);
  handleAccess('pagePrint', 'inventory bibliography/print', currentUser);

</script>


<div class="row" id="pageIndex">
  <div class="col-lg-12 mt-3">
    <div class="card">
      <div class="card-body">
        <div class="col-md-8">
          <h4 class="header-title">INVENTORY BIBLIOGRAPHY</h4>
        </div>
        <div class="col-md-4">
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
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item text-dark" href="javascript:void(0)" ng-click="changeFilter('materialType')">MATERIAL TYPE</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item text-dark" href="javascript:void(0)" ng-click="changeFilter('collectionType')">COLLECTION TYPE</a>
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
            <select class="form-control input-sm uppercase" ng-model="search.material_type" ng-change="searchFilter(search)" data-validation-engine="validate[required]" ng-options="opt.id as opt.value for opt in material_types" ng-show="selectedFilter == 'materialType'">
              <option value=""></option>
            </select>
            <select class="form-control input-sm uppercase" ng-model="search.collection_type" ng-change="searchFilter(search)"  data-validation-engine="validate[required]" ng-options="opt.id as opt.value for opt in collection_types" ng-show="selectedFilter == 'collectionType'">
              <option value=""></option>
            </select>
          </div>
        </div>
        
        <div class="col-md-12">
          <div class="clearfix"></div><hr>
        </div>
       
      
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-8 col-xs-12" style="margin-bottom: 2px;padding-left: 0px">
              <button id="pagePrint" ng-click="print()" class="btn btn-print  btn-min"><i class="fa fa-print"></i> PRINT</button>
              <button id="pagePrint" type="button" class="btn btn-warning  btn-min" ng-click="reload()"><i class="fa fa-refresh"></i> RELOAD </button>
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
            <table class="table table-bordered text-center" id="myTable">
              <thread>
                <tr class="bg-info">
                  <th class="text-center w30px">#</th>
                  <th class="text-center"> CONTROL NO. </th>
                  <th class="text-center"> TITLE </th>
                  <th class="text-center"> AUTHOR </th>
                  <th class="text-center"> TERMS OF AVAILABILITY </th>
                  <th class="text-center"> QUANTITY </th>
                </tr>
              </thread>
              <tbody>
                <tr ng-repeat="data in datas">
                  <td class="text-center">{{ (paginator.page - 1 ) * paginator.limit + $index + 1 }}</td>
                  <td class="text-center"><a href="#/learning-resource-center/inventory-bibliography/view/{{ data.id }}" class="mydata" style="color:black;">{{ data.code }}</a></td>
                  <td class="text-center uppercase">{{ data.title }}</td>
                  <td class="text-center uppercase">{{ data.author }}</td>
                  <td class="text-center uppercase">{{ data.terms }}</td>
                  <td class="text-center">{{ data.quantity }}</td>
                </tr>
                <tr ng-show="datas == null || datas == ''">
                  <td colspan="7">No available data</td>
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
                <option value="material-type">MATERIAL TYPE</option>
                <option value="collection-type">COLLECTION TYPE</option>
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
      <div ng-show="search.filterBy == 'material-type'">
        <div class="col-md-12">
          <div class="form-group">
            <label>MATERIAL TYPE</label>
              <div class="input-group mb-3">
              <select class="form-control input-sm uppercase" ng-model="search.material_type" data-validation-engine="validate[required]" ng-options="opt.id as opt.value for opt in material_types">
                <option value=""></option>
              </select>
            </div>
          </div>
        </div><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>    
      </div>

      <div ng-show="search.filterBy == 'collection-type'">
        <div class="col-md-12">
          <div class="form-group">
            <label>COLLECTION TYPE</label>
              <div class="input-group mb-3">
              <select class="form-control input-sm uppercase" ng-model="search.collection_type" data-validation-engine="validate[required]" ng-options="opt.id as opt.value for opt in collection_types">
                <option value=""></option>
              </select>
            </div>
          </div>
        </div><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>    
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

<style>

  a.mydata {
     --c:linear-gradient(#000 0 0); /* update the color here */
  
    padding-bottom: .15em;
    background: var(--c), var(--c);
    background-size: .3em .1em;
    background-position:50% 100%;
    background-repeat: no-repeat;
    transition: .3s linear, background-size .3s .2s linear;    
  }
  a.mydata:hover {
    background-size: 40% .1em;
    background-position: 10% 100%, 90% 100%;    
  }
 
</style>