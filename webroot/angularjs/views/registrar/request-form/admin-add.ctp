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
  handleAccess('pageAdd', 'request form/add', currentUser);

</script>

  <div class="row" id="pageAdd">
    <div class="col-lg-12 mt-3">
      <div class="card">
        <div class="card-body">
          <div class="header-title">NEW REQUEST FORM</div>
          <div class="clearfix"></div>
          <hr>
          <form id="form">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label> SERIAL NUMBER </label>
                  <input type="text" class="form-control" ng-model="data.RequestForm.serial_number"> 
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label> CONTROL NO. </label>
                  <input disabled type="text" class="form-control" ng-model="data.RequestForm.code">
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
                      <td style="{{ data.RequestForm.student_name == undefined ? 'padding:15px':'padding:5px !important'}}" class="uppercase">{{ data.RequestForm.student_name }}</td>
                      <td style="{{ data.RequestForm.student_name == undefined ? 'padding:15px':'padding:5px !important'}}" class="w30px" ng-hide="data.RequestForm.student_name == undefined">
                        <button class="btn btn-xs btn-sm  btn-danger" ng-click="data.RequestForm.student_name = null; data.RequestForm.student_id = null;" ng-init="data.RequestForm.student_id = null"><i class="fa fa-times"></i></button>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label> OFFICIAL RECEIPT #: <i class="required">*</i></label>
                  <input type="text" class="form-control" autocomplete="false" ng-model="data.RequestForm.or_no" data-validation-engine="validate[required]"></input>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label> PROGRAM <i class="required">*</i></label>
                  <select selectize ng-model="data.RequestForm.program_id" ng-options="opt.id as opt.value for opt in college_program" ng-change="getCourse(data.RequestForm.program_id)" data-validation-engine="validate[required]">
                    <option value=""></option>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label> YEAR TERM </label>
                  <select selectize ng-model="data.RequestForm.year_term_id" ng-options="opt.id as opt.value for opt in year_terms" ng-change="getYear(data.RequestForm.year_term_id)" data-validation-engine="validate[required]">
                    <option value=""></option>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label> DATE <i class="required">*</i></label>
                  <input type="text" class="form-control datepicker" autocomplete="false" ng-model="data.RequestForm.date" data-validation-engine="validate[required]">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label> IDENTIFIER <i class="required">*</i></label>
                  <select selectize ng-model="data.RequestForm.identifier" autocomplete="false" data-validation-engine="validate[required]">
                    <option value=""></option>
                    <option value="Graduate">Graduate</option>
                    <option value="Enrolled">Enrolled</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label> REMARKS <i class="required">*</i></label>
                  <textarea rows="1" class="form-control" autocomplete="false" ng-model="data.RequestForm.remarks" data-validation-engine="validate[required]"></textarea>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group" ng-show="data.RequestForm.identifier != undefined">
                  <label> PURPOSE <i class="required">*</i></label>
                  <select selectize ng-model="data.RequestForm.purpose_id" ng-options="opt.id as opt.value for opt in purpose" ng-change="getPurpose(data.RequestForm.purpose_id)" data-validation-engine="validate[required]">
                    <option value=""></option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group" ng-show="data.RequestForm.purpose_id == 1">
                  <label> OTHERS <i class="required">*</i></label>
                  <textarea rows="1" class="form-control" autocomplete="false" ng-model="data.RequestForm.othersPurpose" data-validation-engine="validate[required]"></textarea>
                </div>
              </div>
              <div class="col-md-12 mt-4" ng-show="data.RequestForm.identifier != undefined">
                <div class="form-group">
                  <div class="row mt-4">
                    <div class="col-md-4">
                      <input icheck type="checkbox" class="form-control" autocomplete="false" ng-model="data.RequestForm.gwa"> With GWA
                    </div>
                    <div class="col-md-4">
                      <input icheck type="checkbox" class="form-control" autocomplete="false" ng-model="data.RequestForm.unit"> With Units
                    </div>
                    <div class="col-md-4">
                      <input icheck type="checkbox" class="form-control" autocomplete="false" ng-model="data.RequestForm.medium"> With of Instruction
                    </div>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <hr>
              <div class="col-md-12 mt-4">
                <div class="form-group">
                  <label> PLEASE CHECK NATURE OF REQUEST <i class="required">*</i></label>
                  <div class="row mt-4">
                    <div class="col-md-4">
                      <input icheck type="checkbox" class="form-control" autocomplete="false" ng-change="selectTorDiploma(data.RequestForm.otr)" ng-model="data.RequestForm.otr"> Transcript of Record (TOR)
                      &nbsp;<p ng-show="data.RequestForm.otr ==true">Price: 120.00/page</p>
                    </div>
                    <div class="col-md-4">
                      <input icheck type="checkbox" class="form-control" autocomplete="false" ng-model="data.RequestForm.cav"> Certification Authentication Verification (CAV)
                     &nbsp;<p ng-show="data.RequestForm.cav ==true">Price: 100.00</p>
                    </div>
                    <div class="col-md-4">
                      <input icheck type="checkbox" class="form-control" autocomplete="false" ng-model="data.RequestForm.cert"> Certification
                      <p ng-show="data.RequestForm.cert ==true">Price: 50.00</p>
                    </div>
                  </div>
                  <div class="row py-3" ng-show="data.RequestForm.otr !=true"></div>
                  <div class="row">
                    <div class="col-md-2 text-right" ng-show="data.RequestForm.otr ==true">
                      Number of Pages (TOR):
                    </div>
                    <div class="col-md-1" ng-show="data.RequestForm.otr ==true">
                      <input type="text" number="true" class="form-control" autocomplete="false" ng-model="data.RequestForm.otrVal">
                    </div>
                  </div>

                  <div class="row mt-4">
                    <div class="col-md-4">
                      <input icheck type="checkbox" class="form-control" autocomplete="false" ng-model="data.RequestForm.hon"> Honorable Dismissal
                      <p ng-show="data.RequestForm.hon ==true">Price: 100.00</p>
                    </div>
                    <div class="col-md-4">
                      <input icheck type="checkbox" class="form-control" autocomplete="false" ng-model="data.RequestForm.authGrad"> Authentication ( Graduate )
                      <p ng-show="data.RequestForm.authGrad ==true">Price: 50.00</p>
                    </div>
                    <div class="col-md-4">
                      <input icheck type="checkbox" class="form-control" autocomplete="false" ng-model="data.RequestForm.authUGrad"> Authentication ( UnderGraduate )
                      <p ng-show="data.RequestForm.authUGrad ==true">Price: 50.00</p>
                    </div>
                  </div>
                  <div class="row py-3"></div>
                  <div class="row mt-4">
                    <div class="col-md-4">
                      <input icheck type="checkbox" class="form-control" ng-value-true="true" autocomplete="false" ng-change="selectTorDiploma(data.RequestForm.dip)" ng-model="data.RequestForm.dip"> Diploma
                      <p ng-show="data.RequestForm.dip ==true">Price: 200.00</p>
                    </div>
                    <div class="col-md-4">
                      <input icheck type="checkbox" class="form-control" autocomplete="false" ng-model="data.RequestForm.rr"> Red Ribbon
                      <p ng-show="data.RequestForm.rr ==true">Price: 100.00</p>
                    </div>
                    <!-- <div class="col-md-4">
                      <input icheck type="checkbox" class="form-control" autocomplete="false" ng-model="data.RequestForm.lg"> List of Graduates
                      <p ng-show="data.RequestForm.lg ==true">Price: 50.00/copy</p>
                    </div> -->
                    <div class="col-md-2 mb-4">
                      <input icheck type="checkbox" class="form-control" ng-value-true="true" autocomplete="false" ng-model="data.RequestForm.other"> Others: <em>(please specify)</em>
                    </div>
                    <div class="col-md-2" ng-show="data.RequestForm.other == true">
                      <input type="text" class="form-control" autocomplete="false" ng-model="data.RequestForm.otherVal">
                    </div>
                  </div>
                  <!-- <div class="row">
                    <div class="col-md-10 text-right pb-4 mb-3" ng-show="data.RequestForm.lg !=true">
                    </div>
                    <div class="col-md-7"></div>
                    <div class="col-md-2 text-right" ng-show="data.RequestForm.lg ==true">
                      Photocopy:
                    </div>
                    <div class="col-md-1 py-0" ng-show="data.RequestForm.lg ==true">
                      <input type="text" number="true" class="form-control" autocomplete="false" ng-model="data.RequestForm.lgVal">
                    </div>
                  </div> -->
                  <!-- <div class="row mt-4">
                    <div class="col-md-2 mb-4">
                      <input icheck type="checkbox" class="form-control" ng-value-true="true" autocomplete="false" ng-model="data.RequestForm.other"> Others: <em>(please specify)</em>
                    </div>
                    <div class="col-md-2" ng-show="data.RequestForm.other ==true">
                      <input type="text" class="form-control" autocomplete="false" ng-model="data.RequestForm.otherVal">
                    </div>
                  </div> -->

                    <div class="clearfix"></div><hr>
                    
                    <div class="col-md-12">
                    <div class="form-group">
                      <label> REQUESTOR <i class="required">*</i></label><br>
                      <label>
                        <input type="radio" ng-model="data.RequestForm.claim" ng-value="false" value="false">
                        Claim
                      </label>&nbsp; &nbsp;&nbsp; &nbsp;
                      <label>
                        <input type="radio" ng-model="data.RequestForm.claim" ng-value="true" value="true">
                        Authorized Person
                      </label>
                    </div>
                  </div>

                  <div class="col-md-12" ng-show="data.RequestForm.claim">
                    <div class="clearfix"></div><hr>
                  </div>

                  <div class="col-md-12" ng-show="data.RequestForm.claim">
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

                </div>
              </div>
            </div>
          </form>
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
                    <input icheck type="radio" ng-init="student.selected = false" ng-model="student.selected" name="iCheck" ng-selected="student.selected = true" ng-change="selectedStudent(student)"/>
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
                          <li class="page-item">
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