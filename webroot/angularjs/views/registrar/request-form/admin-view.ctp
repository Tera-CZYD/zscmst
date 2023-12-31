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
  handleAccess('pageView', 'request form/view', currentUser);
  handleAccess('pageEdit', 'request form/edit', currentUser);
  handleAccess('pageDelete', 'request form/delete', currentUser);
  handleAccess('pageApprove', 'request form/approve', currentUser);
  handleAccess('pagePrintForm', 'request form/print request form', currentUser); 

</script>

  <div class="row" id="pageView">
    <div class="col-lg-12 mt-3">
      <div class="card">
        <div class="card-body">
          <div class="header-title">REQUEST FORM INFORMATION</div>
          <div class="clearfix"></div>
          <hr>
          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
                <table class="table table-striped">

                  <tr>
                    <th class="text-right" style="width:15%"> SERIAL NUMBER : </th>
                    <td class="italic">{{ data.RequestForm.serial_number }}</td>
                  </tr>
                  <tr>
                    <th class="text-right" style="width:15%"> CONTROL NUMBER : </th>
                    <td class="italic">{{ data.RequestForm.code }}</td>
                  </tr>
                  <tr>
                    <th class="text-right"> OFFICIAL RECEIPT # : </th>
                    <td class="italic">{{ data.RequestForm.or_no }}</td>
                  </tr>
                  <tr>
                    <th class="text-right" style="width:15%"> STUDENT NAME : </th>
                    <td class="italic">{{ data.RequestForm.student_name }}</td>
                  </tr>
                  <tr>
                    <th class="text-right"> DATE : </th>
                    <td class="italic">{{ data.RequestForm.date }}</td>
                  </tr>
                  <tr>
                    <th class="text-right"> COURSE : </th>
                    <td class="italic">{{ data.CollegeProgram.code }} - {{ data.CollegeProgram.name }}</td>
                  </tr>
                  <tr>
                    <th class="text-right"> YEAR : </th>
                    <td class="italic">{{ data.RequestForm.year }}</td>
                  </tr>
                  <tr>
                    <th class="text-right"> IDENTIFIER : </th>
                    <td class="italic">{{ data.RequestForm.identifier }}</td>
                  </tr>
                  <tr ng-show="data.RequestForm.identifier != undefined">
                    <th class="text-right"> PURPOSE : </th>
                    <td class="italic">{{ data.RequestForm.purpose }}</td> 
                  </tr>
                  <tr>
                    <th class="text-right"> REMARKS : </th>
                    <td class="italic">{{ data.RequestForm.remarks }}</td>
                  </tr>
                  <tr>
                      <th class="text-right"> REQUESTOR : </th>
                      <td class="italic">{{ data.AffidavitOfLoss.claim == 0 ? 'CLAIM' : (data.AffidavitOfLoss.claim == 1 ? 'AUTHORIZED PERSON' : '') }}</td>
                  </tr>
                </table>
              </div>
            </div>



            <div class="clearfix"></div>
            <div class="col-md-12 mt-4" ng-show="data.RequestForm.identifier != undefined">
                <div class="form-group">
                  <div class="row mt-4">
                    <div class="col-md-4">
                      <input icheck type="checkbox" disabled class="form-control" autocomplete="false" ng-model="data.RequestForm.gwa"> With GWA
                    </div>
                    <div class="col-md-4">
                      <input icheck type="checkbox" disabled class="form-control" autocomplete="false" ng-model="data.RequestForm.unit"> With Units
                    </div>
                    <div class="col-md-4">
                      <input icheck type="checkbox" disabled class="form-control" autocomplete="false" ng-model="data.RequestForm.medium"> With of Instruction
                    </div>
                  </div>
                </div>
              </div>
            <div class="col mt-4">
              <div class="form-group">
                <label> PLEASE CHECK NATURE OF REQUEST <i class="required">*</i></label>
                <div class="row mt-4">
                  <div class="col-md-4">
                    <input icheck disabled type="checkbox" class="form-control" autocomplete="false" ng-model="data.RequestForm.otr"> Transcript of Record (TOR)
                  </div>
                  <div class="col-md-4">
                    <input icheck disabled type="checkbox" class="form-control" autocomplete="false" ng-model="data.RequestForm.cav"> Certification Authentication Verification (CAV)
                  </div>
                  <div class="col-md-4">
                    <input icheck disabled type="checkbox" class="form-control" autocomplete="false" ng-model="data.RequestForm.cert"> Certification
                  </div>
                </div>
                <div class="row py-3"  ng-show="data.RequestForm.otr !=true"></div>
                <div class="row" ng-show="data.RequestForm.otr ==true">
                  <div class="col-md-2 text-right">
                    Number of Pages (TOR):
                  </div>
                  <div class="col-md-1">
                    <input disabled type="text" number="true" class="form-control" autocomplete="false" ng-model="data.RequestForm.otrVal">
                  </div>
                </div>

                <div class="row mt-4">
                  <div class="col-md-4">
                    <input icheck disabled type="checkbox" class="form-control" autocomplete="false" ng-model="data.RequestForm.hon"> Honorable Dismissal
                  </div>
                  <div class="col-md-4">
                    <input icheck disabled type="checkbox" class="form-control" autocomplete="false" ng-model="data.RequestForm.authGrad"> Authentication ( Graduate )
                  </div>
                  <div class="col-md-4">
                    <input icheck disabled type="checkbox" class="form-control" autocomplete="false" ng-model="data.RequestForm.authUGrad"> Authentication ( UnderGraduate )
                  </div>
                </div>
                <div class="row py-3"></div>
                <div class="row mt-4">
                  <div class="col-md-4">
                    <input icheck disabled type="checkbox" class="form-control" ng-value-true="true" autocomplete="false" ng-model="data.RequestForm.dip"> Diploma
                  </div>
                  <div class="col-md-4">
                    <input icheck disabled type="checkbox" class="form-control" autocomplete="false" ng-model="data.RequestForm.rr"> Red Ribbon
                  </div>
                  <div class="col-md-4">
                    <input icheck disabled type="checkbox" class="form-control" autocomplete="false" ng-model="data.RequestForm.lg"> List of Graduates
                  </div>
                </div>
                <div class="row" ng-show="data.RequestForm.lg ==true">
                  <div class="col-md-7"></div>
                  <div class="col-md-2 text-right">
                    Photocopy:
                  </div>
                  <div class="col-md-1">
                    <input disabled type="text" number="true" class="form-control" autocomplete="false" ng-model="data.RequestForm.lgVal">
                  </div>
                </div>
                <div class="row mt-4">
                  <div class="col-md-2">
                    <input icheck disabled type="checkbox" class="form-control" ng-value-true="true" autocomplete="false" ng-model="data.RequestForm.other"> Others: <em>(please specify)</em>
                  </div>
                  <div class="col-md-2" ng-show="data.RequestForm.other ==true">
                    <input disabled type="text" class="form-control" autocomplete="false" ng-model="data.RequestForm.otherVal">
                  </div>
                </div>


              </div>
            </div>

            <div class="col-md-4" style="display: flex; justify-content: center;" ng-show="data.RequestForm.claim == 1">

                <a href="uploads/request-form/{{data.RequestForm.id}}/{{ data.RequestForm.image }}"><img src="uploads/request-form/{{data.RequestForm.id}}/{{ data.RequestForm.image }}" class="img-responsive" style="max-height: 50vh; max-width: 70%;" /></a>

            </div>


            <div class="col-md-12">
              <div class="clearfix"></div>
              <hr>
            </div>
            <div class="col-md-12">
              <div class="pull-right">
                  <a id="pageEdit" href="#/registrar/admin-request-form/edit/{{ data.RequestForm.id }}" class="btn btn-primary btn-min"><i class="fa fa-edit"></i> EDIT </a>
                <button id="pageApprove" href="javascript:void(0)" ng-click="approve(data.RequestForm)" ng-disabled="data.RequestForm.approve == 1" class="btn btn-warning  btn-min" ><i class="fa fa-check"></i> APPROVE </button>
                <button id="pagePaid" href="javascript:void(0)" ng-click="paid(data.RequestForm)" ng-disabled="data.RequestForm.approve == 2" class="btn btn-success  btn-min" ><i class="fa fa-check"></i> PAID </button>
                <button id="pagePrintForm" type="button" class="btn btn-info  btn-min" ng-click="print(data.RequestForm.id )"><i class="fa fa-print"></i> PRINT REQUEST FORM </button>
                <button id="pageDelete" class="btn btn-danger btn-min" ng-click="remove(data.RequestForm)"><i class="fa fa-trash"></i> DELETE </button>
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