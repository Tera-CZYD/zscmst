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
  handleAccess('pageEdit', 'student club/edit', currentUser);

</script>

  <div class="row" id="pageEdit">
    <div class="col-lg-12 mt-3">
      <div class="card">
        <div class="card-body">
          <div class="header-title">EDIT STUDENT CLUB</div>
          <div class="clearfix"></div>
          <hr>
         <form id="form">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label> CONTROL NO. </label>
                  <input disabled type="text" class="form-control" ng-model="data.StudentClub.code">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label> SEARCH STUDENT </label><label style="font-size:10px;color:gray;" class="pull-right">Press Enter to search</label>
                  <input type="text" class="form-control search uppercase" placeholder="TYPE STUDENT HERE" ng-model="searchTxt" ng-enter="searchStudent({ search: searchTxt })">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label> STUDENT <i class="required">*</i></label>
                  <table class="table table-bordered">
                    <tr>
                      <td style="{{ data.StudentClub.student_name == undefined ? 'padding:15px':'padding:5px !important'}}" class="uppercase">{{ data.StudentClub.student_name }}</td>
                      <td style="{{ data.StudentClub.student_name == undefined ? 'padding:15px':'padding:5px !important'}}" class="w30px" ng-hide="data.StudentClub.student_name == undefined">
                        <button class="btn btn-xs btn-sm  btn-danger" ng-click="data.StudentClub.student_name = null; data.StudentClub.student_id = null;" ng-init="data.StudentClub.student_id = null"><i class="fa fa-times"></i></button>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="form-group">
                  <label> CLUB <i class="required">*</i></label>
                  <select selectize ng-model="data.StudentClub.club_id" ng-options="opt.id as opt.value for opt in clubs" ng-change="getClub(data.StudentClub.club_id)" data-validation-engine="validate[required]">
                    <option value=""></option>
                  </select>
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="form-group">
                  <label> DATE <i class="required">*</i></label>
                  <input type="text" class="form-control datepicker" autocomplete="false" ng-model="data.StudentClub.date" data-validation-engine="validate[required]">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label> POSITION <i class="required">*</i></label>
                  <input type="text" class="form-control uppercase" autocomplete="false" ng-model="data.StudentClub.position" data-validation-engine="validate[required]">
                </div>
              </div>


                </div>
              </div>
            </div>
          </form>
          <div class="clearfix"></div>
          <hr>
          <div class="row">
            <div class="col-md-12">
              <div class="pull-right">
                <button class="btn btn-primary btn-min" id="save" ng-click="update();"><i class="fa fa-save"></i> UPDATE </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<style type="text/css">
  th {
    white-space: nowrap;
  }

  td {
    white-space: nowrap;
  }
</style>