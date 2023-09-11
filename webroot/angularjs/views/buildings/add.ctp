<div>
  <div class="row">
    <div class="col-lg-12 mt-3">
      <div class="card">
        <div class="card-body">
          <div class="header-title">NEW BUILDING</div>
          <div class="clearfix"></div><hr>
          <form id="form">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label> CODE <i class="required">*</i></label>
                  <input type="text" class="form-control" ng-model="data.Building.code" data-validation-engine="validate[required]" autocomplete="off">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label> NAME <i class="required">*</i></label>
                  <input type="text" class="form-control" ng-model="data.Building.name" data-validation-engine="validate[required]" autocomplete="off">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label> LOCATION <i class="required">*</i></label>
                  <input type="text" class="form-control" ng-model="data.Building.location" data-validation-engine="validate[required]" autocomplete="off">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label> DESCRIPTION <i class="required">*</i></label>
                  <textarea type="text" class="form-control" ng-model="data.Building.description" data-validation-engine="validate[required]" autocomplete="off"></textarea>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label> FLOORS <i class="required">*</i></label>
                  <input type="number" class="form-control" ng-model="data.Building.floors" number data-validation-engine="validate[required]" autocomplete="off">
                </div>
              </div>
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
</div>
<script>
$('#form').validationEngine('attach');
</script>


          

