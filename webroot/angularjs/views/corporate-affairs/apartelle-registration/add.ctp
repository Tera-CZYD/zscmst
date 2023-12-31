<div class="row">
  <div class="col-lg-12 mt-3">
    <div class="card">
      <div class="card-body">
        <div class="header-title">NEW APARTELLE/DORMITORY APPLICATION</div>
        <div class="clearfix"></div><hr>
        <form id="form">
          <div class="row">

            <div class="col-md-12">
              <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr class="bg-info">
                      <th class = "text-center" colspan="2">STUDENT INFORMATION</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th class="text-left" style="width: 15%"> STUDENT NUMBER </th>
                      <td class="text-left uppercase">{{ data.ApartelleRegistration.student_no }}</td>   
                    </tr>
                    <tr>
                      <th class="text-left"> STUDENT NAME </th>
                      <td class="text-left uppercase">{{ data.ApartelleRegistration.student_name }}</td>   
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="col-md-12">
              <div class="clearfix"></div><hr>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label> CONTROL No. </label>
                <input disabled type="text" class="form-control" ng-model="data.ApartelleRegistration.code">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label> NICK NAME <i class="required">*</i></label>
                <input type="text" class="form-control" autocomplete="false" ng-model="data.ApartelleRegistration.nick_name" data-validation-engine="validate[required]">
              </div>
            </div>
            
            <div class="col-md-3">
              <div class="form-group">
                <label> DATE OF BIRTH <i class="required">*</i></label>
                <input type="text" class="form-control datepicker" autocomplete="false" ng-model="data.ApartelleRegistration.date_of_birth" data-validation-engine="validate[required]">
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label> BIRTH PLACE <i class="required">*</i></label>
                <input type="text" class="form-control" autocomplete="false" ng-model="data.ApartelleRegistration.birth_place" data-validation-engine="validate[required]">
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label> ADDRESS <i class="required">*</i></label>
                <input type="text" class="form-control" autocomplete="false" ng-model="data.ApartelleRegistration.address" data-validation-engine="validate[required]">
              </div>
            </div>


            <div class="col-md-6">
              <div class="form-group">
                <label> PROGRAM <i class="required">*</i></label>
                <select selectize ng-model="data.ApartelleRegistration.program_id" ng-options="opt.id as opt.value for opt in college_program" ng-change="getCourse(data.ApartelleRegistration.program_id)" data-validation-engine="validate[required]">
                  <option value=""></option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label> YEAR TERM </label>
                <select selectize ng-model="data.ApartelleRegistration.year_term_id" ng-options="opt.id as opt.value for opt in year_terms" ng-change = "getYear(data.ApartelleRegistration.year_term_id)">
                  <option value=""></option>
                </select>
              </div>
            </div>

<!--             <div class="col-md-6">
                <div class="form-group">
                  <label> APARTELLE BUILDING <i class="required">*</i></label>
                  <select selectize ng-options="opt.id as opt.value for opt in apartelle" ng-model="data.ApartelleRegistration.apartelle_id" ng-change="getCapacity(ApartelleRegistration.apartelle_id)" data-validation-engine="validate[required]">
                  <option value=""></option></select>
                </div>
              </div> -->

            <div class="col-md-12">
              <div class="form-group">
                <label> FATHER NAME <i class="required">*</i></label>
                <input type="text" class="form-control" autocomplete="false" ng-model="data.ApartelleRegistration.father_name" data-validation-engine="validate[required]">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label> FATHER OCCUPATION <i class="required">*</i></label>
                <input type="text" class="form-control" autocomplete="false" ng-model="data.ApartelleRegistration.father_occupation" data-validation-engine="validate[required]">
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label> MOTHER NAME <i class="required">*</i></label>
                <input type="text" class="form-control" autocomplete="false" ng-model="data.ApartelleRegistration.mother_name" data-validation-engine="validate[required]">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label> MOTHER OCCUPATION <i class="required">*</i></label>
                <input type="text" class="form-control" autocomplete="false" ng-model="data.ApartelleRegistration.mother_occupation" data-validation-engine="validate[required]">
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label> GUARDIAN <i class="required">*</i></label>
                <input type="text" class="form-control" autocomplete="false" ng-model="data.ApartelleRegistration.guardian" data-validation-engine="validate[required]">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label> AGE <i class="required">*</i></label>
                <input type="text" class="form-control" autocomplete="false" ng-model="data.ApartelleRegistration.age" data-validation-engine="validate[required]">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label> SEX <i class="required">*</i></label>
                <select class="form-control" ng-model="data.ApartelleRegistration.sex" autocomplete="false" data-validation-engine="validate[required]" style="height: 44px">
                  <option value=""></option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label> RELIGION <i class="required">*</i></label>
                <input type="text" class="form-control" autocomplete="false" ng-model="data.ApartelleRegistration.religion" data-validation-engine="validate[required]">
              </div>
            </div>


            <div class="col-md-12">
              <div class="form-group">
                <p></p>
                 <p></p>
                <div class="header-title">(For those Not residing within 7 kilometers radius from the City Hall)</div>
                <p></p>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label> How often do you attend your religious duties? </label>
                      <input type="text" class="form-control" autocomplete="false" ng-model="data.ApartelleRegistration.religious_duties" data-validation-engine="validate[required]">
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label> Organizations where you are a member. </label>
                      <input type="text" class="form-control" autocomplete="false" ng-model="data.ApartelleRegistration.organization_member" data-validation-engine="validate[required]">
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label> Your forms of recreation. (List them) </label>
                      <input type="text" class="form-control" autocomplete="false" ng-model="data.ApartelleRegistration.recreation_list" data-validation-engine="validate[required]">
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label> Hobbies </label>
                      <input type="text" class="form-control" autocomplete="false" ng-model="data.ApartelleRegistration.hobbies" data-validation-engine="validate[required]">
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label> Type of reading material you enjoy. </label>
                      <input type="text" class="form-control" autocomplete="false" ng-model="data.ApartelleRegistration.reading_materials" data-validation-engine="validate[required]">
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label> Type of movies you enjoy. </label>
                      <input type="text" class="form-control" autocomplete="false" ng-model="data.ApartelleRegistration.movies" data-validation-engine="validate[required]">
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label> Games you play or you are interested in. </label>
                      <input type="text" class="form-control" autocomplete="false" ng-model="data.ApartelleRegistration.games" data-validation-engine="validate[required]">
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label> Do you have a boyfriend/gilfriend? </label> 
                      <select class="form-control" ng-model="data.ApartelleRegistration.bf_gf" autocomplete="false" data-validation-engine="validate[required]" style="height: 44px">
                        <option value=""></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-12" ng-show="data.ApartelleRegistration.bf_gf == 'Yes'">
                    <div class="form-group">
                      <label> Address of boyfriend/gilfriend. <i class="required">*</i></label>
                      <input type="text" class="form-control" autocomplete="false" ng-model="data.ApartelleRegistration.bf_gf_address" data-validation-engine="validate[required]">
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label> Do you kNow anybody in the College Community? </label>
                      <select class="form-control" ng-model="data.ApartelleRegistration.anybody_cm" autocomplete="false" data-validation-engine="validate[required]" style="height: 44px">
                        <option value=""></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-12" ng-show="data.ApartelleRegistration.anybody_cm == 'Yes'">
                    <div class="form-group">
                      <label> If Yes, Please write his/her complete name. <i class="required">*</i></label>
                      <input type="text" class="form-control" autocomplete="false" ng-model="data.ApartelleRegistration.anybody_cm_name" data-validation-engine="validate[required]">
                    </div>
                  </div>

                  <div class="col-md-12" ng-show="data.ApartelleRegistration.anybody_cm == 'Yes'">
                    <div class="form-group">
                      <label> If Yes, Please write his/her complete address. <i class="required">*</i></label>
                      <input type="text" class="form-control" autocomplete="false" ng-model="data.ApartelleRegistration.anybody_cm_address" data-validation-engine="validate[required]">
                    </div>
                  </div>

                  <div class="col-md-12" ng-show="data.ApartelleRegistration.anybody_cm == 'Yes'">
                    <div class="form-group">
                      <label> Relationship with the person. <i class="required">*</i></label>
                      <input type="text" class="form-control" autocomplete="false" ng-model="data.ApartelleRegistration.anybody_cm_relationship" data-validation-engine="validate[required]">
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label> Do you have relatives in the City? </label>
                      <select class="form-control" ng-model="data.ApartelleRegistration.city_relatives" autocomplete="false" data-validation-engine="validate[required]" style="height: 44px">
                        <option value=""></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-12" ng-show="data.ApartelleRegistration.city_relatives == 'Yes'">
                    <div class="form-group">
                      <label> If Yes, Please write his/her complete name. <i class="required">*</i></label>
                      <input type="text" class="form-control" autocomplete="false" ng-model="data.ApartelleRegistration.city_relatives_name" data-validation-engine="validate[required]">
                    </div>
                  </div>

                  <div class="col-md-12" ng-show="data.ApartelleRegistration.city_relatives == 'Yes'">
                    <div class="form-group">
                      <label> If Yes, Please write his/her complete address. <i class="required">*</i></label>
                      <input type="text" class="form-control" autocomplete="false" ng-model="data.ApartelleRegistration.city_relatives_address" data-validation-engine="validate[required]">
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label> Do you smoke? </label>
                      <select class="form-control" ng-model="data.ApartelleRegistration.smoking" autocomplete="false" data-validation-engine="validate[required]" style="height: 44px">
                        <option value=""></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-12" ng-show="data.ApartelleRegistration.smoking == 'Yes'">
                    <div class="form-group">
                      <label> Why? <i class="required">*</i></label>
                      <input type="text" class="form-control" autocomplete="false" ng-model="data.ApartelleRegistration.smoking_reason" data-validation-engine="validate[required]">
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label> Give your reason(s) for applying in the dormitory. </label>
                      <input type="text" class="form-control" autocomplete="false" ng-model="data.ApartelleRegistration.reasons" data-validation-engine="validate[required]">
                    </div>
                  </div>

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
<?php echo $this->element('modals/search/searched-student-modal') ?>

<!-- <style type="text/css">
  th {
    white-space: Nowrap;
  }
  td {
    white-space: Nowrap;
  }
</style>

<script>

  $(function() {
    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {

      if (input.files) {
          var filesAmount = input.files.length;

        for (i = 0; i < filesAmount; i++) {
          var reader = new FileReader();

          reader.onload = function(event) {
            $($.parseHTML('<img>'))
            .attr('src', event.target.result)
            .width(200)
            .height(200)
            .css("border-radius"," 2px")
            .css("margin-bottom"," 10px")
            .css("margin-top"," 10px")
            .css("margin-left"," 10px")
            .appendTo(placeToInsertImagePreview);
          }

          reader.readAsDataURL(input.files[i]);
        }
      }

    };

    $('#apartelleImage').on('change', function() {
        imagesPreview(this, 'div.gallery');
    });
  });

  function myFunction() {
    document.getElementById("asd").innerHTML = " " ;
  }
  
</script> -->