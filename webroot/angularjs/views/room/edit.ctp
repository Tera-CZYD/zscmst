<?php if (hasAccess('room management/edit', $currentUser)): ?>
<div class="row">
  <div class="col-lg-12 mt-3">
    <div class="card">
      <div class="card-body">
        <div class="header-title">EDIT ROOM</div>
        <div class="clearfix"></div><hr>
        <form id="form">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label> CODE <i class="required">*</i></label>
                <input type="text" class="form-control" ng-model="data.Room.code" data-validation-engine="validate[required]">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label> NAME <i class="required">*</i></label>
                <input type="text" class="form-control" ng-model="data.Room.name" data-validation-engine="validate[required]">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label> SHORT NAME <i class="required">*</i></label>
                <input type="text" class="form-control" ng-model="data.Room.short_name" data-validation-engine="validate[required]">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label> BUILDING <i class="required">*</i></label>
                <select class="form-control" ng-model="data.Room.building_id" ng-options="opt.id as opt.value for opt in building"
                data-validation-engine="validate[required]">
                  <option value=""></option>
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label> ROOM TYPE <i class="required">*</i></label>
                <select class="form-control" ng-model="data.Room.room_type_id" ng-options="opt.id as opt.value for opt in room_type"
                data-validation-engine="validate[required]">
                  <option value=""></option>
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label> SIZE <i class="required">*</i></label>
                <input type="text" class="form-control" ng-model="data.Room.size" data-validation-engine="validate[required]">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label> CAPACITY <i class="required">*</i></label>
                <input type="number" class="form-control" ng-model="data.Room.capacity" number data-validation-engine="validate[required]">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label> REMARKS <i class="required">*</i></label>
                <input type="text" class="form-control" ng-model="data.Room.remarks" data-validation-engine="validate[required]">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label> ACTIVE ?<i class="required">*</i></label>
                <select class="form-control" ng-model="data.Room.active" data-validation-engine="validate[required]">
                  <option value=""></option>
                  <option value="1">TRUE</option>
                  <option value="0">FALSE</option>
                </select>
              </div>
            </div>
          </div>
        </form>
        <div class="clearfix"></div><hr>
        <div class="row">
          <div class="col-md-12">
            <div class="pull-right">
              <button class="btn btn-primary btn-min" id = "save" ng-click="update();"><i class="fa fa-save"></i> UPDATE </button>
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


          

