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
  handleAccess('pageEdit', 'consultation/edit', currentUser);

</script>

<div class="row" id="pageEdit">
  <div class="col-lg-12 mt-3">
    <div class="card">
      <div class="card-body">
        <div class="header-title">EDIT CONSULTATION</div>
        <div class="clearfix"></div>
        <hr>
          <form id="form">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label> CONTROL NO. </label>
                  <input disabled type="text" class="form-control" ng-model="data.Consultation.code">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label> CLASSIFICATION <i class="required">*</i></label>
                  <select class="form-control" autocomplete="false" ng-model="data.Consultation.classification" ng-change="getMember(data.Consultation.classification)" ng-init="data.Consultation.classification = 'Student'" data-validation-engine="validate[required]">
                    <option value="Student">Student</option>
                    <option value="Employee">Employee</option>
                  </select>
                </div>
              </div>

              <div class="col-md-6" ng-show="data.Consultation.classification == 'Student'">
                <div class="form-group">
                  <label> SEARCH STUDENT </label><label style="font-size:10px;color:gray;" class="pull-right">Press Enter to search</label>
                  <input type="text" class="form-control search uppercase" placeholder="TYPE STUDENT HERE" ng-model="searchTxt" ng-enter="searchStudent({ search: searchTxt })">
                </div>
              </div>
              <div class="col-md-6" ng-show="data.Consultation.classification == 'Student'">
                <div class="form-group">
                  <label> STUDENT <i class="required">*</i></label>
                  <table class="table table-bordered">
                    <tr>
                      <td style="{{ data.Consultation.student_name == undefined ? 'padding:15px':'padding:5px !important'}}" class="uppercase">{{ data.Consultation.student_name }}</td>
                      <td style="{{ data.Consultation.student_name == undefined ? 'padding:15px':'padding:5px !important'}}" class="w30px" ng-hide="data.Consultation.student_name == undefined">
                        <button class="btn btn-xs btn-sm  btn-danger" ng-click="data.Consultation.student_name = null; data.Consultation.student_id = null;" ng-init="data.Consultation.student_id = null"><i class="fa fa-times"></i></button>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>

              <div class="col-md-6" ng-show="data.Consultation.classification == 'Employee'">
                <div class="form-group">
                  <label> SEARCH EMPLOYEE </label><label style="font-size:10px;color:gray;" class="pull-right">Press Enter to search</label>
                  <input type="text" class="form-control search uppercase" placeholder="TYPE EMPLOYEE HERE" ng-model="searchTxt" ng-enter="searchEmployee({ search: searchTxt })">
                </div>
              </div>
              <div class="col-md-6" ng-show="data.Consultation.classification == 'Employee'">
                <div class="form-group">
                  <label> EMPLOYEE <i class="required">*</i></label>
                  <table class="table table-bordered">
                    <tr>
                      <td style="{{ data.Consultation.employee_name == undefined ? 'padding:15px':'padding:5px !important'}}" class="uppercase">{{ data.Consultation.employee_name }}</td>
                      <td style="{{ data.Consultation.employee_name == undefined ? 'padding:15px':'padding:5px !important'}}" class="w30px" ng-hide="data.Consultation.employee_name == undefined">
                        <button class="btn btn-xs btn-sm  btn-danger" ng-click="data.Consultation.employee_name = null; data.Consultation.employee_id = null;" ng-init="data.Consultation.employee_id = null"><i class="fa fa-times"></i></button>
                      </td>
                    </tr>  
                  </table>  
                </div>
              </div>
          
              <div class="col-md-4">
                <div class="form-group">
                  <label> DATE <i class="required">*</i></label>
                  <input type="text" class="form-control datepicker" autocomplete="off" ng-model="data.Consultation.date" data-validation-engine="validate[required]">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label> Age <i class="required">*</i></label>
                  <input number="text" class="form-control" autocomplete="off" ng-model="data.Consultation.age" data-validation-engine="validate[required]">
                </div>
              </div>
              <div class="col-md-4">
                  <div class="form-group">
                      <label> Sex <i class="required">*</i></label><br>
                      <label>
                          <input type="radio" ng-model="data.Consultation.sex" value="Male">
                          Male
                      </label>&nbsp; &nbsp;&nbsp; &nbsp;
                      <label>
                          <input type="radio" ng-model="data.Consultation.sex" value="Female">
                          Female
                      </label>
                  </div>
              </div>
                  <div class="col-md-6">
                      <div class="form-group">
                          <label> Address <i class="required">*</i></label>
                          <input type="text" class="form-control" autocomplete="off"
                              ng-model="data.Consultation.address" data-validation-engine="validate[required]">
                      </div>
                  </div>
                  <div class="col-md-3">
                      <div class="form-group">
                          <label> Height <i class="required">*</i></label>
                          <input type="text" class="form-control" autocomplete="off"
                              ng-model="data.Consultation.height" data-validation-engine="validate[required]">
                      </div>
                  </div>
                  <div class="col-md-3">
                      <div class="form-group">
                          <label> Weight <i class="required">*</i></label>
                          <input type="text" class="form-control" autocomplete="off"
                              ng-model="data.Consultation.weight" data-validation-engine="validate[required]">
                      </div>
                  </div>
                  <!-- <div class="col-md-12">
                      <div class="form-group">
                          <label> DESCRIPTION <i class="required">*</i></label>
                          <textarea class="form-control" autocomplete="false"
                              ng-model="data.MedicalCertificate.description"
                              data-validation-engine="validate[required]"></textarea>
                      </div>
                  </div> -->

                  <div class="col-md-6">
                    <div class="form-group">
                      <label> Name of Nurse <i class="required">*</i></label>
                      <select selectize ng-options="opt.id as opt.value for opt in nurse_profile" ng-change="getNurse(data.Consultation.nurse_id)" ng-model="data.Consultation.nurse_id" data-validation-engine="validate[required]">
                      <option value=""></option></select>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label> Nurse Remarks <i class="required">*</i></label>
                      <textarea class="form-control" autocomplete="off" ng-model="data.Consultation.nurse_remarks" data-validation-engine="validate[required]"></textarea>
                    </div>
                  </div>
                  
              </div>
              <div class="clearfix"></div>
              <hr>
              <div class="col-md-3 pull-left">
                  <a class="btn btn-warning btn-sm btn-block" id="save" ng-click="addSubs()">ADD
                      SUB INFORMATION</a><br />
              </div>

              <div class="clearfix"></div>

              <div class="col-md-12">
                  <table class="table table-bordered table-striped table-hover">
                      <thead>
                          <tr>
                              <th class="w30px text-center">#</th>
                              <th class="text-center">DATE</th>
                              <th class="text-center">CHIEF COMPLAINTS</th>
                              <th class="text-center">TREATMENTS</th>
                              <th class="text-center">REMARKS</th>

                          </tr>
                      </thead>
                      <tbody>
                          <tr ng-repeat="datax in data.ConsultationSub">
                              <td class="text-center">{{ $index + 1 }}</td>
                              <td class="text-center">{{ datax.date | date: 'MM/dd/yyyy'}}</td>
                              <td class="text-center">{{ datax.chief_complaints }}</td>
                              <td class="text-center">{{ datax.treatments }}</td>
                              <td class="text-center">{{ datax.remarks }}</td>
                              <td class="text-center">
                                  <div class="btn-group btn-group-xs">
                                      <a href="javascript:void(0)" ng-click="editSubs($index,datax)"
                                          class="btn btn-success" title="EDIT"><i class="fa fa-edit"></i></a>
                                      <a href="javascript:void(0)" ng-click="removeSubs($index)"
                                          class="btn btn-danger" title="DELETE"><i class="fa fa-trash"></i></a>
                                  </div>
                              </td>
                          </tr>
                      </tbody>

                      <tbody ng-if="data.ConsultationSub == ''">
                          <td colspan="6" class="text-center">No data available</td>
                      </tbody>
                  </table>
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
<div class="modal fade" id="searched-employee-modal">
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
                  <th class="text-center">EMPLOYEE NUMBER</th>
                  <th class="text-center">NAME</th>
                  <th class="w30px"></th>
                </tr>
              </thead>
              <tbody>
                <tr ng-repeat="employee in employees">
                  <td>{{ (paginator.page - 1) * paginator.limit + $index + 1 }}</td>
                  <td class="uppercase text-center">{{ employee.code }}</td>
                  <td class="uppercase text-center">{{ employee.name }}</td>
                  <td>
                    <input icheck type="radio" ng-init="employee.selected = false" ng-model="employee.selected" name="iCheck" ng-selected="employee.selected = true" ng-change="selectedEmployee(employee)">
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
          <button type="button" class="btn btn-primary btn-sm btn-min" ng-click="employeeData(employee.id)" data-dismiss="modal"><i class="fa fa-check"></i> OK</button>
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

<div class="modal fade add-beneficiary-modal" id="add-subs-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ADD SUB INFORMATION</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="add_subs">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label> DATE <i class="required">*</i></label>
                            <input type="text" class="form-control datepicker" autocomplete="off" ng-model="adata.date"
                                data-validation-engine="validate[required]">
                        </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group">
                        <label> CHIEF COMPLAINTS <i class="required">*</i></label>
                        <select selectize ng-model="adata.chief_complaint_id" ng-options="opt.id as opt.value for opt in ailments" data-validation-engine="validate[required]" ng-change="getAilment(adata.chief_complaint_id)">
                          <option value=""></option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group">
                        <label> TREATMENTS <i class="required">*</i></label>
                        <select selectize ng-model="adata.treatment_id" ng-options="opt.id as opt.value for opt in prescriptions" data-validation-engine="validate[required]" ng-change="getPrescription(adata.treatment_id)">
                          <option value=""></option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label> REMARKS <i class="required">*</i></label>
                            <textarea type="text" class="form-control" ng-model="adata.remarks"
                                data-validation-engine="validate[required]"></textarea>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm btn-min" data-dismiss="modal">CANCEL</button>
                <button type="button" class="btn btn-primary btn-sm btn-min" ng-click="saveSubs(adata)">SAVE</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade add-beneficiary-modal" id="edit-subs-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">EDIT SUB INFORMATION</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="edit_subs">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label> DATE <i class="required">*</i></label>
                            <input type="text" class="form-control datepicker" autocomplete="off" ng-model="adata.date"
                                data-validation-engine="validate[required]">
                        </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group">
                        <label> CHIEF COMPLAINTS <i class="required">*</i></label>
                        <select selectize ng-model="adata.chief_complaint_id" ng-options="opt.id as opt.value for opt in ailments" data-validation-engine="validate[required]" ng-change="getAilment(adata.chief_complaint_id)">
                          <option value=""></option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group">
                        <label> TREATMENTS <i class="required">*</i></label>
                        <select selectize ng-model="adata.treatment_id" ng-options="opt.id as opt.value for opt in prescriptions" data-validation-engine="validate[required]" ng-change="getPrescription(adata.treatment_id)">
                          <option value=""></option>
                        </select>
                      </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label> REMARKS <i class="required">*</i></label>
                            <textarea type="text" class="form-control" ng-model="adata.remarks"
                                data-validation-engine="validate[required]"></textarea>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm btn-min" data-dismiss="modal">CANCEL</button>
                <button type="button" class="btn btn-primary btn-sm btn-min" ng-click="updateSubs(adata)">SAVE</button>
            </div>
        </div>
    </div>
</div>