<?php if (hasAccess('faculty management/add', $currentUser)): ?>
<div class="row">
  <div class="col-lg-12 mt-3">
    <div class="card">
      <div class="card-body">
        <div class="header-title">NEW PROGRAM ADVISER </div>
        <div class="clearfix"></div><hr>
        <form id="form">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label> CONTROL NO. </label>
                <input disabled type="text" class="form-control" ng-model="data.ProgramAdviser.code">
              </div>
            </div>  

            <div class="col-md-12">
              <div class="form-group">
                <label> PROGRAM <i class="required">*</i></label>
                <select selectize ng-options="opt.id as opt.value for opt in college_program" ng-model="data.ProgramAdviser.program_id" data-validation-engine="validate[required]">
                <option value=""></option></select>
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
                    <td style="{{ data.ProgramAdviser.student_name == undefined ? 'padding:15px':'padding:5px !important'}}" class="uppercase">{{ data.ProgramAdviser.student_name }}</td>
                    <td style="{{ data.ProgramAdviser.student_name == undefined ? 'padding:15px':'padding:5px !important'}}" class="w30px" ng-hide="data.ProgramAdviser.student_name == undefined">
                      <button class="btn btn-xs btn-sm  btn-danger" ng-click="data.ProgramAdviser.student_name = null; data.ProgramAdviser.student_id = null;" ng-init="data.ProgramAdviser.student_id = null"><i class="fa fa-times"></i></button>
                    </td>
                  </tr>
                </table>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label> AGE <i class="required">*</i></label>
                <input type="text" class="form-control" ng-model="data.ProgramAdviser.age" data-validation-engine="validate[required]">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label> EMAIL <i class="required">*</i></label>
                <input type="text" class="form-control" ng-model="data.ProgramAdviser.email" data-validation-engine="validate[required]">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label> CONTACT NO <i class="required">*</i></label>
                <input type="text" class="form-control" ng-model="data.ProgramAdviser.contact_no" data-validation-engine="validate[required]">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label> GENDER <i class="required">*</i></label>
                <select selectize ng-model="data.ProgramAdviser.gender" data-validation-engine="validate[required]">
                  <option value=""> </option>
                  <option value="Male">MALE</option>
                  <option value="Female">FEMALE</option>
                </select>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label> SECTION <i class="required">*</i></label>
                <select selectize ng-options="opt.id as opt.value for opt in section" ng-model="data.ProgramAdviser.section_id" data-validation-engine="validate[required]">
                <option value=""></option></select>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label> DATE <i class="required">*</i></label>
                <input type="text" class="form-control datepicker" autocomplete="false" ng-model="data.ProgramAdviser.date" data-validation-engine="validate[required]">
              </div>
            </div>

            <div class="clearfix"></div><hr>
            <div class="row">
              <div class="col-md-12">
                <div class="pull-right">
                  <button class="btn btn-primary btn-min" id = "save" ng-click="update();"><i class="fa fa-save"></i> SAVE </button>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </form>
</div>
<?php endif ?>
<?php echo $this->element('modals/search/searched-student-modal') ?>
<script>
$('#form').validationEngine('attach');
</script>


          

