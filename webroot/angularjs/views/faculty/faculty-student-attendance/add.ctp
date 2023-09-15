<?php if (hasAccess('course/add', $currentUser)): ?>
<div class="row">
  <div class="col-lg-12 mt-3">
    <div class="card">
      <div class="card-body">
        <div class="header-title">NEW COURSE</div>
        <div class="clearfix"></div><hr>
        <form id="form">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label> YEAR OF IMPLEMENTATION  <i class="required">*</i></label>
                <input type="text" class="form-control yearpicker" autocomplete="off" ng-model="data.Course.year_implementation" data-validation-engine="validate[required]">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label> REFERENCE NUMBER <i class="required">*</i></label>
                <input type="text" class="form-control" ng-model="data.Course.code" data-validation-engine="validate[required]">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label> SCHOOL YEAR  <i class="required">*</i></label>
                <input type="text" class="form-control yearpicker" autocomplete="off" ng-model="data.Course.school_year" data-validation-engine="validate[required]">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label> TITLE <i class="required">*</i></label>
                <input type="text" class="form-control" ng-model="data.Course.title" data-validation-engine="validate[required]">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label> CATEGORY <i class="required">*</i></label>
                <select class="form-control" ng-model="data.Course.category" style="height: 45px" data-validation-engine="validate[required]" autocomplete="false">
                  <option value="Laboratory">Laboratory</option>
                  <option value="Lecture">Lecture</option>
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label> DESCRIPTION </i></label>
                <textarea type="text" class="form-control" ng-model="data.Course.description"></textarea>
              </div>
            </div>
            </div>
            <!-- <div class="col-md-12">
              <div class="clearfix"></div><hr>
              <table class="table table-bordered center">
                <tr>
                  <th></th>
                  <th class="text-center" style="width: 10%"> HOURS </th>
                  <th class="text-center" style="width: 10%"> UNITS </th>
                </tr>
                <tr>
                  <th class="text-left"> LECTURE </th>
                  <td class="text-center">
                    <input type="text" class="form-control text-center" numberdecimal ng-model="data.Course.lecture_hours" ng-change="getCreditHours()">
                  </td>
                  <td class="text-right">
                    <input type="text" class="form-control text-center" numberdecimal ng-model="data.Course.lecture_unit" ng-change="getCreditUnit()">
                  </td>
                </tr>
                <tr>
                  <th class="text-left"> LABORATORY </th>
                  <td class="text-center">
                    <input type="text" class="form-control text-center" numberdecimal ng-model="data.Course.laboratory_hours" ng-change="getCreditHours()">
                  </td>
                  <td class="text-right">
                    <input type="text" class="form-control text-center" numberdecimal ng-model="data.Course.laboratory_unit" ng-change="getCreditUnit()">
                  </td>
                </tr>
                <tr>
                  <th class="text-left"> CREDIT </th>
                  <td class="text-center">
                    <input type="text" class="form-control text-center" numberdecimal ng-model="data.Course.credit_hours">
                  </td>
                  <td class="text-right">
                    <input type="text" class="form-control text-center" numberdecimal ng-model="data.Course.credit_unit">
                  </td>
                </tr>
              </table>
            </div> -->
          </div>  
        </form>
        <div class="clearfix"></div><hr>
        <div class="row">
          <div class="col-md-12">
            <div class="pull-right">
              <button class="btn btn-primary btn-min" id = "save" ng-click="save();"><i class="fa fa-save"></i> SAVE </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endif ?>
<script>
$('#form').validationEngine('attach');
</script>


          
