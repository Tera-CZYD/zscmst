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
  handleAccess('pageAdd', 'affidavit of loss/add', currentUser);

</script>

  <div class="row" id="pageAdd">
    <div class="col-lg-12 mt-3">
      <div class="card">
        <div class="card-body">
          <div class="header-title">NEW AFFIDAVIT OF LOSS</div>
          <div class="clearfix"></div>
          <hr>
          <form id="form">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label> CONTROL NO. </label>
                  <input disabled type="text" class="form-control" ng-model="data.AffidavitOfLoss.code">
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
                      <td style="{{ data.AffidavitOfLoss.student_name == undefined ? 'padding:15px':'padding:5px !important'}}" class="uppercase">{{ data.AffidavitOfLoss.student_name }}</td>
                      <td style="{{ data.AffidavitOfLoss.student_name == undefined ? 'padding:15px':'padding:5px !important'}}" class="w30px" ng-hide="data.AffidavitOfLoss.student_name == undefined">
                        <button class="btn btn-xs btn-sm  btn-danger" ng-click="data.AffidavitOfLoss.student_name = null; data.AffidavitOfLoss.student_id = null;" ng-init="data.AffidavitOfLoss.student_id = null"><i class="fa fa-times"></i></button>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>

              <div class="col-md-6">
              <div class="form-group">
                <label> PROGRAM <i class="required">*</i></label>
                <select selectize ng-options="opt.id as opt.value for opt in college_programs" ng-model="data.AffidavitOfLoss.program_id" data-validation-engine="validate[required]">
                  <option value=""></option>
                </select>
              </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                  <label> FORM <i class="required">*</i></label>
                  <input type="text" class="form-control" autocomplete="false" ng-model="data.AffidavitOfLoss.form" data-validation-engine="validate[required]">
                </div>
              </div>
              
              
              <div class="col-md-6">
                <div class="form-group">
                  <label> DATE <i class="required">*</i></label>
                  <input type="text" class="form-control datepicker" autocomplete="false" ng-model="data.AffidavitOfLoss.date" data-validation-engine="validate[required]">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label> AMOUNT <i class="required">*</i></label>
                  <input type="text" class="form-control" autocomplete="false" ng-model="data.AffidavitOfLoss.amount" data-validation-engine="validate[required]">
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label> DESCRIPTION <i class="required">*</i></label>
                  <textarea class="form-control" autocomplete="false" ng-model="data.AffidavitOfLoss.description" data-validation-engine="validate[required]"></textarea>
                </div>
              </div>


              <div class="col-md-12">
              <div class="form-group">
                <label> REQUESTOR <i class="required">*</i></label><br>
                <label>
                  <input type="radio" ng-model="data.AffidavitOfLoss.claim" ng-value="false" value="0">
                  Claim
                </label>&nbsp; &nbsp;&nbsp; &nbsp;
                <label>
                  <input type="radio" ng-model="data.AffidavitOfLoss.claim" ng-value="true" value="1">
                  Authorized Person
                </label>
              </div>
            </div>

            <div class="col-md-12" ng-show="data.AffidavitOfLoss.claim">
              <div class="clearfix"></div><hr>
            </div>

            <div class="col-md-12" ng-show="data.AffidavitOfLoss.claim">
              <label>Authorization letter (JPEG or PNG)</label>
              <h5>• ID of the student should be attached in lower right corner of the authorization letter.</h5>
              <ul class="list-group mb-2">
                <div class="col-md-12">
                  <span class="btn btn-primary btn-min btn-file">
                    <i class="fa fa-upload"></i>UPLOAD PHOTO
                    <input ng-file-model="files" id="fileImage" name="picture" class="form-control" type="file" accept=" image/jpeg, image/png" ng-file>
                  </span>
                </div>
              </ul>
            <div class="clearfix"></div>
            <div id="upload_prev"></div> 
            
            <div class="col-md-12">
              <div class="clearfix"></div><hr>
            </div>
          </div>

              

                  </form>
                </div>
                   <div class="clearfix"></div>
                <hr>
                <div class="row">
                  <div class="col-md-12">
                    <div class="pull-right">
                      <button class="btn btn-primary btn-min" id="save" ng-click="save();"><i class="fa fa-save"></i> SAVE </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>

<div class="modal fade" id="searched-student-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">ADVANCE SEARCH</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <table class="table table-bordered vcenter table-striped table-condensed">
              <thead>
                <tr>
                  <th class="w30px">#</th>
                  <th class="text-center">STUDENT NUMBER</th>
                  <th class="text-center">NAME</th>
                  <th class="w30px"></th>
                </tr>
              </thead>
              <tbody>
                <tr ng-repeat="student in students">
                  <td>{{ (paginator.page - 1) * paginator.limit + $index + 1 }}</td>
                  <td class="uppercase text-center">{{ student.code }}</td>
                  <td class="uppercase text-center">{{ student.name }}</td>
                  <td>
                    <input icheck type="radio" ng-init="student.selected = false" ng-model="student.selected" name="iCheck" ng-selected="student.selected = true" ng-change="selectedStudent(student)">
                  </td>
                </tr>
              </tbody>
              <tfoot ng-show="paginator.pageCount > 0">
                <tr>
                  <td colspan="4" class="text-center">
                    <div class="clearfix"></div>
                    <div class="row">
                      <div class="col-md-12">
                        <ul class="pagination justify-content-center">
                          <li class="page-item">s
                            <a class="page-link" href="javascript:void(0)" ng-click="searchStudent({ page: 1 ,search: searchTxtStudent})"><sub>&laquo;&laquo;</sub></a>
                          </li>
                          <li class="page-item prevPage {{ !paginator.prevPage? 'disabled':'' }}">
                            <a class="page-link" href="javascript:void(0)" ng-click="searchStudent({ page: 1 ,search: searchTxtStudent})">&laquo;</a>
                          </li>
                          <li ng-repeat="page in pages" class="page-item {{ paginator.page == page.number ? 'active':''}}" >
                            <a class="page-link" href="javascript:void(0)" class="text-center" ng-click="searchStudent({ page: 1 ,search: searchTxtStudent})">{{ page.number }}</a>
                          </li>
                          <li class="page-item nextPage {{ !paginator.nextPage? 'disabled':'' }}">
                            <a class="page-link" href="javascript:void(0)" ng-click="searchStudent({ page: 1 ,search: searchTxtStudent})">&raquo;</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="javascript:void(0)" ng-click="searchStudent({ page: 1 ,search: searchTxtStudent})"><sub>&raquo;&raquo;</sub> </a>
                          </li>
                        </ul>
                        <div class="clearfix"></div>
                        <div class="text-center" ng-show="paginator.pageCount > 0">
                          <sup class="text-primary">Page {{ paginator.pageCount > 0 ? paginator.page : 0 }} out of {{ paginator.pageCount }}</sup>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>  
      </div> 

      <div class="modal-footer">
        <div class="pull-right">
          <button type="button" class="btn btn-danger btn-sm btn-min" data-dismiss="modal"><i class="fa fa-close"></i> CLOSE</button>
          <button type="button" class="btn btn-primary btn-sm btn-min" ng-click="studentData(employee.id)" data-dismiss="modal"><i class="fa fa-check"></i> OK</button>
        </div> 
        
      </div>
    </div>  
  </div><!-- /.modal-content -->
</div>

<style type="text/css">
  th {
    white-space: nowrap;
  }

  td {
    white-space: nowrap;
  }
</style>