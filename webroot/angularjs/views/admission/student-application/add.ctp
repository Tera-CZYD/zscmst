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
  handleAccess('pageAdd', 'student application/add', currentUser);

</script>

<div class="row" id="pageAdd">
  <div class="col-lg-12 mt-3">
    <div class="card">
      <div class="card-body">
        <div class="header-title">NEW STUDENT APPLICATION</div>
        <div class="clearfix"></div><hr>
        <form id="form">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label> SERIAL NUMBER <i class="required">*</i></label>
                <input type="text" class="form-control" autocomplete="false" ng-model="data.StudentApplication.serial_number" data-validation-engine="validate[required]">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label> STUDENT ID NUMBER <i class="required">*</i></label>
                <input type="text" class="form-control" autocomplete="false" ng-model="data.StudentApplication.student_no" data-validation-engine="validate[required]" disabled>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Student Application Number<i class="required">*</i></label>
                <input type="text" class="form-control" id="application_no" ng-model="data.StudentApplication.application_no" autocomplete="off" data-validation-engine="validate[required]" disabled>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label> FIRST NAME <i class="required">*</i></label>
                <input type="text" class="form-control" autocomplete="false" ng-model="data.StudentApplication.first_name" data-validation-engine="validate[required]">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label> MIDDLE NAME </label>
                <input type="text" class="form-control" autocomplete="false" ng-model="data.StudentApplication.middle_name">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label> LAST NAME <i class="required">*</i></label>
                <input type="text" class="form-control" autocomplete="false" ng-model="data.StudentApplication.last_name" data-validation-engine="validate[required]">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label> AUXILLIARY NAME </label>
                <input type="text" class="form-control" autocomplete="false" ng-model="data.StudentApplication.auxilliary_name" >
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label> DATE OF BIRTH <i class="required">*</i></label>
                <input type="text" class="form-control datepicker" autocomplete="false" ng-model="data.StudentApplication.birth_date" data-validation-engine="validate[required]">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label> PLACE OF BIRTH <i class="required">*</i></label>
                <input type="text" class="form-control" autocomplete="false" ng-model="data.StudentApplication.birth_place" data-validation-engine="validate[required]">
              </div>
            </div>
              <div class="col-md-3">
              <div class="form-group">
                <label> NATIONALITY <i class="required">*</i></label>
                <input type="text" class="form-control" autocomplete="false" ng-model="data.StudentApplication.nationality" data-validation-engine="validate[required]">
              </div>
            </div>
              <div class="col-md-3">
              <div class="form-group">
                <label> ETHNIC GROUP </label>
                <input type="text" class="form-control" autocomplete="false" ng-model="data.StudentApplication.ethnic_group" >
              </div>
            </div>
              <div class="col-md-3">
              <div class="form-group">
                <label> RELIGION <i class="required">*</i></label>
                <input type="text" class="form-control" autocomplete="false" ng-model="data.StudentApplication.religion" data-validation-engine="validate[required]">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label> EMAIL <i class="required">*</i></label>
                <input type="text" class="form-control" autocomplete="false" ng-model="data.StudentApplication.email" data-validation-engine="validate[required]">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label> ADDRESS <i class="required">*</i></label>
                <input type="text" class="form-control" autocomplete="false" ng-model="data.StudentApplication.address" data-validation-engine="validate[required]">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label> CONTACT NO. <i class="required">*</i></label>
                <input type="text" class="form-control" autocomplete="false" ng-model="data.StudentApplication.contact_no" data-validation-engine="validate[required]">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label> GENDER <i class="required">*</i></label>
                <select class="form-control" ng-model="data.StudentApplication.gender" style="height: 45px" data-validation-engine="validate[required]" autocomplete="false">
                  <option></option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label> CIVIL STATUS <i class="required">*</i></label>
                <select class="form-control" ng-model="data.StudentApplication.civil_status" style="height: 45px" data-validation-engine="validate[required]" autocomplete="false">
                  <option></option>
                  <option value="Married">Married</option>
                  <option value="Single">Single</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label> NAME OF PARENTS OR GUARDIAN <i class="required">*</i></label>
                <input type="text" class="form-control" autocomplete="false" ng-model="data.StudentApplication.guardian_name" data-validation-engine="validate[required]">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label> RELATIONSHIP <i class="required">*</i></label>
                <input type="text" class="form-control" autocomplete="false" ng-model="data.StudentApplication.guardian_relationship" data-validation-engine="validate[required]">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label> CONTACT NO. PARENTS/GUARDIAN <i class="required">*</i></label>
                <input type="text" class="form-control" autocomplete="false" ng-model="data.StudentApplication.guardian_contact" data-validation-engine="validate[required]">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label> OCCUPATION OF PARENTS/GUARDIAN <i class="required">*</i></label>
                <input type="text" class="form-control" autocomplete="false" ng-model="data.StudentApplication.guardian_occupation" data-validation-engine="validate[required]">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label> COMPLETE ADDRESS OF PARENTS/GUARDIAN <i class="required">*</i></label>
                <input type="text" class="form-control" autocomplete="false" ng-model="data.StudentApplication.guardian_address" data-validation-engine="validate[required]">
              </div>
            </div>

            <div class="col-md-12">
              <div class="clearfix"></div><hr>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label> COLLEGE <i class="required">*</i></label>
                <select id="college" class="form-control" ng-model="data.StudentApplication.college_id" ng-options="opt.id as opt.value for opt in colleges" data-validation-engine="validate[required]" ng-change="getProgram(data.StudentApplication.college_id)">
                  <option value=""></option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label> PREFERRED PROGRAM <i class="required">*</i></label>
                <select id="college" class="form-control" ng-model="data.StudentApplication.preferred_program_id" ng-options="opt.id as opt.value for opt in programs">
                  <option value=""></option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label> SECONDARY PROGRAM <i class="required">*</i></label>
                <select id="college" class="form-control" ng-model="data.StudentApplication.secondary_program_id" ng-options="opt.id as opt.value for opt in programs">
                  <option value=""></option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label> LAST SCHOOL ATTENDED <i class="required">*</i></label>
                <input type="text" class="form-control" autocomplete="false" ng-model="data.StudentApplication.last_school" data-validation-engine="validate[required]">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label> LAST SCHOOL ATTENDED ADDRESS <i class="required">*</i></label>
                <input type="text" class="form-control" autocomplete="false" ng-model="data.StudentApplication.last_school_address" data-validation-engine="validate[required]">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label> 1ST SEMESTER GRADE OR GWA <i class="required">*</i></label>
                <input type="text" class="form-control" autocomplete="false" ng-model="data.StudentApplication.grade" data-validation-engine="validate[required]">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label> TYPE OF STUDENT <i class="required">*</i></label>
                <select class="form-control" ng-model="data.StudentApplication.student_type" style="height: 45px" data-validation-engine="validate[required]" autocomplete="false">
                  <option></option>
                  <option value="New">New</option>
                  <option value="Transferee">Transferee</option>
                </select>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label> HIGHSCHOOL CURRICULUM  <i class="required">*</i></label>
                <select class="form-control" ng-model="data.StudentApplication.curriculum" style="height: 45px" data-validation-engine="validate[required]" autocomplete="false">
                  <option></option>
                  <option value="ALS">ALS</option>
                  <option value="BEC">BEC</option>
                  <option value="K-12">K-12</option>
                </select>
              </div>
            </div>



            <div class="col-md-3">
              <div class="form-group">
                <label> YEAR GRADUATED <i class="required">*</i></label>
                <input type="text" class="form-control" autocomplete="false" ng-model="data.StudentApplication.year_graduated" data-validation-engine="validate[required]">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label> SCHOOL TYPE <i class="required">*</i></label>
                <input type="text" class="form-control" autocomplete="false" ng-model="data.StudentApplication.school_type" data-validation-engine="validate[required]">
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label> MEMBERSHIP SCHOOL CLUBS, ORGANIZATIONS OR FRATERNITIES <i class="required">*</i></label>
                <input type="text" class="form-control" autocomplete="false" ng-model="data.StudentApplication.frat" data-validation-engine="validate[required]">
              </div>
            </div>


            <div class="col-md-12">
              <div class="clearfix"></div><hr>
            </div>
            <div class="col-md-12">
              <ul class="list-group mb-2">
                <div class="col-md-12">
                  <span class="btn btn-primary btn-min btn-file">
                    <i class="fa fa-upload"></i>UPLOAD FILE
                    <input ng-file-model="files" id="applicationImage" multiple="multiple" name="picture" class="form-control" type="file">
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
        <div class="clearfix"></div><hr>
        <div class="row">
          <div class="col-md-12">
            <div class="pull-right">
              <button class="btn btn-primary btn-min" id = "save" ng-click="saveImages(files);save();"><i class="fa fa-save"></i> SAVE </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="alertModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <p id="alertMessage"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">OK</button>
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

<style type="text/css">
  .myRadio{
    height:20px; 
    width:20px;
  }
</style>

<style>

 .fileUpload {
  position: relative;
    overflow: hidden;
    margin: 10px 3px;
  }
  .fileUpload input.upload {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 20px;
    cursor: pointer;
    opacity: 0;
    background-color:#fff;
    filter: alpha(opacity=0);
  }

  .filenameupload {
    width:50%;  
    overflow-y:auto;
  }

  #upload_prev {
    font-size: 
    width: 50%;
    padding:0.5em 1em 1.5em 1em;
  }

  #upload_prev span {
    display: flex;
    padding: 0 5px;
    font-size:13px;
  }

  p.close {
    cursor: pointer;
  }

</style>

<script>
  $(document).on('click', '#close', function () {
    $(this).parents('span').remove();
  });

  // Get the alert modal element
  var alertModal = document.getElementById('alertModal');

  // Get the alert message element
  var alertMessage = document.getElementById('alertMessage');

  // Get the input element
  var input = document.getElementById('myInput');

  // Function to show the alert modal
  function showAlertModal(message) {
    alertMessage.textContent = message;
    $(alertModal).modal('show');
  }

  var errorMessage = 'Files should be 10MB or Less';

  document.getElementById('applicationImage').onchange = uploadOnChange;

  function uploadOnChange() {
    var filename = this.value;
    var lastIndex = filename.lastIndexOf("\\");
    
    if (lastIndex >= 0) {
      filename = filename.substring(lastIndex + 1);
    }
    
    var files = $('#applicationImage')[0].files;
    var validExtensions = ['jpg', 'jpeg', 'png', 'pdf'];

    for (var i = 0; i < files.length; i++) {
      var file = files[i];
      var fileExtension = file.name.split('.').pop().toLowerCase();

      if (file.size >= 1.25 * 1024 * 1024) {
        showAlertModal(errorMessage);
        return; // Stop processing if any file exceeds the size limit
      }

      if (validExtensions.indexOf(fileExtension) === -1) {
        showAlertModal('Invalid file type. Allowed types: JPEG, PNG, PDF');
        return; // Stop processing if any file has an invalid extension
      }

      $("#upload_prev").append('<span><u>' + '<div class="filenameupload">' + file.name + '</u></div>' + '<p id="close" class="btn btn-danger xbutton fa fa-times" style="background-color: red !important"></p></span>');
    }
  }
</script>
