<!-- change the data-num and data-subnum for numbering of navigation -->
<div class="content-inner" id="pageActive" data-num="1" data-namecollapse="#profile-collapse-a" data-labelname="Personal Info">
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Personal Information</h2>
        </div>
    </header>
    <!-- Breadcrumb-->
    <ul class="breadcrumb">
        <div class="container-fluid">
        <li class="breadcrumb-item active">Profile</li>
        <li class="breadcrumb-item active">Personal Info</li>
        </div>
    </ul>
    <section class="tables">   
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 no-padding">
                    <div class="card">
                        <div class="card-body">
                            <form class="form-horizontal personal-info-css" id="personalinfo-form">
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label">Applicant Name <!-- <span hidden class="asterisk" style="color:red">*</span> --></label>
                                    <div class="col-md-3">
                                        <input readonly id="inputHorizontalSuccess" type="text" class="form-control form-control-success" value="<?=$applicant_info->first_name?>" name="info_fname"><small class="form-text text-center">First Name <span class="asterisk" style="color:red">*</span></small>
                                    </div>
                                    <div class="col-md-2">
                                        <input readonly id="inputHorizontalSuccess" type="text" class="form-control form-control-success" value="<?=$applicant_info->middle_name?>" name="info_mname"><small class="form-text  text-center">Middle Name</small>
                                    </div>
                                    <div class="col-md-3">
                                        <input readonly id="inputHorizontalSuccess" type="text" class="form-control form-control-success" value="<?=$applicant_info->last_name?>" name="info_lname"><small class="form-text  text-center">Last Name <span  class="asterisk" style="color:red">*</span></small>
                                    </div>                                    
                                    <div class="col-md-2">
                                        <input readonly id="inputHorizontalSuccess" type="text" class="form-control form-control-success" value="<?=$applicant_info->ext_name?>" name="info_xname"><small class="form-text  text-center">Extension Name</small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label">Applicant No</label>
                                    <div class="col-md-4">
                                        <input disabled id="inputHorizontalSuccess" type="text" class="form-control form-control-success" value="<?=en_dec('dec',$applicant_info->applicant_no);?>" name="info_applicant_no">
                                    </div>
                                    <label class="col-md-2 form-control-label">ACR I-Card No</label>
                                    <div class="col-md-4">
                                        <input id="inputHorizontalSuccess" type="text" class="form-control form-control-success" value="<?=$applicant_info->icard_no;?>" name="info_acr_no">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label">Alias 1</label>
                                    <div class="col-md-4">
                                        <input readonly value="<?=$applicant_info->alias1?>" id="inputHorizontalSuccess" type="text" class="form-control form-control-success" name="info_alias1">
                                    </div>

                                    <label class="col-md-2 form-control-label">Alias 2</label>
                                    <div class="col-md-4">
                                        <input readonly value="<?=$applicant_info->alias2?>" id="inputHorizontalSuccess" type="text" class="form-control form-control-success" name="info_alias2">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label">Birthdate <span class="asterisk" style="color:red">*</span></label>
                                    <div class="col-md-4">
                                        <input id="inputHorizontalWarning" type="text" class="form-control form-control-warning datepicker2 info_bdate" value="<?= date_format(date_create($applicant_info->birthdate),"m/d/Y")?>" name="info_bdate">
                                    </div> 

                                    <label class="col-md-2 form-control-label">Age <span class="asterisk" style="color:red">*</span></label>
                                    <div class="col-md-4">
                                          <input readonly value="<?=$applicant_info->age?>" type="number" class="form-control form-control-sm info_age" name="info_age" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label">Gender <span class="asterisk" style="color:red">*</span></label>
                                    <?php if($applicant_info->gender_id == 1){ //male?> 
                                    <div class="col-md-2">
                                        <div class="i-checks martop12">
                                            <input id="register-gendermale" type="radio" value="1" name="info_gender" class="radio-template" checked>
                                            <label for="register-gendermale">Male</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="i-checks martop12">
                                            <input id="register-genderfemale" type="radio" value="2" name="info_gender" class="radio-template">
                                            <label for="register-genderfemale">Female</label>
                                        </div>
                                    </div>
                                    <?php }else{?>

                                    <div class="col-md-2">
                                        <div class="i-checks martop12">
                                            <input id="register-gendermale" type="radio" value="1" name="info_gender" class="radio-template">
                                            <label for="register-gendermale">Male</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="i-checks martop12">
                                            <input id="register-genderfemale" type="radio" value="2" name="info_gender" class="radio-template" checked>
                                            <label for="register-genderfemale">Female</label>
                                        </div>
                                    </div>
                                    <?php } ?>

                                    <label class="col-md-2 form-control-label">Civil Status <span class="asterisk" style="color:red">*</span></label>
                                    <div class="col-md-4">
                                        <select name="info_civilstatus" class=" form-control registerCivilstatus" id="register-civilstatus" required="">
                                            <option selected hidden value="">
                                                Select Civil Status
                                            </option>
                                            <?php foreach ($get_civil_status->result() as $gcs): ?>
                                                <?php if($applicant_info->civil_status == $gcs->civil_status_id): ?>
                                                    <option selected value="<?=$gcs->civil_status_id?>">
                                                        <?=$gcs->name?>
                                                    </option>
                                                <?php else: ?>
                                                     <option value="<?=$gcs->civil_status_id?>">
                                                        <?=$gcs->name?>
                                                    </option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label">Country of Birth<span class="asterisk" style="color:red">*</span></label>
                                    <div class="col-md-4">
                                        <select class="form-control " name="info_birth_country">
                                            <?php foreach ($get_country->result() as $gcountry): ?>
                                                <?php if($gcountry->country != "Philippines"): ?>
                                                    <?php if($gcountry->country_id == $applicant_info->country_id): ?>
                                                        <option selected value="<?=$gcountry->country_id?>"><?=$gcountry->country?></option>
                                                    <?php else: ?>
                                                        <option value="<?=$gcountry->country_id?>"><?=$gcountry->country?></option>
                                                    <?php endif;?>
                                                <?php endif;?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <label class="col-md-2 form-control-label">Citizenship / Nationality <span class="asterisk" style="color:red">*</span></label>
                                    <div class="col-md-4">
                                          <input value="<?=$applicant_info->nationality?>" type="text" name="info_nationality" class="form-control form-control-sm registerAge">
                                    </div>
                                </div>
                                <hr>

                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label">Passport No</label>
                                    <div class="col-md-4">
                                        <input value="<?=$applicant_info->passport_num?>" id="inputHorizontalWarning" type="text" class="form-control form-control-warning info_passport_no"  name="info_passport_no">
                                    </div>
                                </div>


                                <div class="form-group row">

                                    <label class="col-md-2 form-control-label">Place of Issuance<!-- <span hidden class="asterisk" style="color:red">*</span> --></label>
                                    <div class="col-md-4">
                                          <input value="<?=$applicant_info->place_of_isssuance?>" type="text" name="info_issuance_place" class="form-control form-control-sm registerAge">
                                    </div>

                                    <label class="col-md-2 form-control-label">Date of Issuance</label>
                                    <div class="col-md-4">
                                        <input id="inputHorizontalWarning" type="text" class="form-control form-control-warning datepicker2" value="<?=$applicant_info->issuance_date?>" name="info_issuance_date">
                                    </div> 
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label">Expiry Date <!-- <span hidden class="asterisk" style="color:red">*</span> --></label>
                                    <div class="col-md-4">
                                        <input id="inputHorizontalWarning" type="text" class="form-control form-control-warning datepicker2" value="<?=$applicant_info->expiry_date?>" name="info_expiry_date">
                                    </div> 

                                    <label class="col-md-2 form-control-label"> Date of Latest Arrival<!-- <span hidden class="asterisk" style="color:red">*</span> --></label>
                                    <div class="col-md-4">
                                        <input id="inputHorizontalWarning" type="text" class="form-control form-control-warning datepicker2" value="<?=$applicant_info->latest_arrival_date?>" name="info_arrival_date">
                                    </div> 
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label">Email<span class="asterisk" style="color:red">*</span></label>
                                    <div class="col-md-4">
                                        <input readonly value="<?=$applicant_info->email?>" id="inputHorizontalWarning" type="email" class="form-control form-control-warning" name="info_email">
                                    </div> 
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label">Mobile<!-- <span hidden class="asterisk" style="color:red">*</span> --></label>
                                    <div class="col-md-4">
                                        <input value="<?=$applicant_info->mobile_num?>" id="inputHorizontalWarning" type="text" class="form-control form-control-warning editable"  name="info_mobile">
                                    </div> 

                                    <label class="col-md-2 form-control-label">Landline</label>
                                    <div class="col-md-4">
                                        <input value="<?=$applicant_info->landline?>" id="inputHorizontalWarning" type="text" class="form-control form-control-warning editable" name="info_landline">
                                    </div> 

                                </div>
                                <hr>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label">Residential Address in the Philippines <!-- <span hidden class="asterisk" style="color:red">*</span> --></label>
                                    <div class="col-md-3">
                                        <input value="<?=$applicant_info->ph_street_no?>" id="inputHorizontalSuccess" type="text" class="form-control form-control-success editable"  name="info_ph_st"><small class="form-text">House/Unit No., Street <!-- <span hidden class="asterisk" style="color:red">*</span> --></small>
                                    </div>
                                    <div class="col-md-3">
                                        <input value="<?=$applicant_info->ph_village?>"  id="inputHorizontalSuccess" type="text" class="form-control form-control-success editable" name="info_ph_village"><small class="form-text">Subdivision / Village</small>
                                    </div>
                                    <div class="col-md-4">
                                        <input value="<?=$applicant_info->ph_barangay?>"  id="inputHorizontalSuccess" type="text" class="form-control form-control-success editable" name="info_ph_brgy"><small class="form-text">Barangay<!-- <span hidden class="asterisk" style="color:red">*</span> --></small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label"><!-- <span hidden class="asterisk" style="color:red">*</span> --></label>
                                    <div class="col-md-3">
                                        <input value="<?=$applicant_info->ph_city?>" id="inputHorizontalSuccess" type="text" class="form-control form-control-success editable" name="info_ph_city"><small class="form-text">Municipality / City<!-- <span hidden class="asterisk" style="color:red">*</span> --></small>
                                    </div>
                                    <div class="col-md-3">
                                        <input value="<?=$applicant_info->ph_province?>"  id="inputHorizontalSuccess" type="text" class="form-control form-control-success editable" name="info_ph_prov"><small class="form-text">Province</small>
                                    </div>
                                    <div class="col-md-4">
                                        <input value="<?=$applicant_info->ph_zipcode?>" maxlength = "4" id="inputHorizontalSuccess" type="text" class="form-control form-control-success editable" name="info_ph_zipcode"><small class="form-text">Zip Code<!-- <span hidden class="asterisk" style="color:red">*</span> --></small>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label">Residential Address Abroad <!-- <span hidden class="asterisk" style="color:red">*</span> --></label>
                                    <div class="col-md-3">
                                        <input value="<?=$applicant_info->ab_street_no?>"  id="inputHorizontalSuccess" type="text" class="form-control form-control-success editable" name="info_ab_st"><small class="form-text">House/Unit No., Street <!-- <span hidden class="asterisk" style="color:red">*</span> --></small>
                                    </div>
                                    <div class="col-md-3">
                                        <input value="<?=$applicant_info->ab_village?>"  id="inputHorizontalSuccess" type="text" class="form-control form-control-success editable" name="info_ab_village"><small class="form-text">Subdivision / Village</small>
                                    </div>
                                    <div class="col-md-4">
                                        <input value="<?=$applicant_info->ab_city?>"  id="inputHorizontalSuccess" type="text" class="form-control form-control-success editable" name="info_ab_city"><small class="form-text">City<!-- <span hidden class="asterisk" style="color:red">*</span> --></small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label"><!-- <span hidden class="asterisk" style="color:red">*</span> --></label>
                                    <div class="col-md-3">
                                        <input value="<?=$applicant_info->ab_state?>"  id="inputHorizontalSuccess" type="text" class="form-control form-control-success editable"  name="info_ab_state"><small class="form-text">State<!-- <span hidden class="asterisk" style="color:red">*</span> --></small>
                                    </div>
                                    <div class="col-md-3">
                                        <select class="form-control  editable" name="info_ab_country">
                                            <option selected disabled hidden value="">Select Country</option>
                                            <?php foreach ($get_country->result() as $gcountry): ?>
                                                <?php if($gcountry->country != "Philippines"): ?>
                                                    <?php if($gcountry->country_id == $applicant_info->ab_country): ?>
                                                        <option selected value="<?=$gcountry->country_id?>"><?=$gcountry->country?></option>
                                                    <?php else: ?>
                                                        <option value="<?=$gcountry->country_id?>"><?=$gcountry->country?></option>
                                                    <?php endif;?>
                                                <?php endif;?>
                                            <?php endforeach; ?>
                                        </select><small class="form-text">Country</small>
                                    </div>
                                    <div class="col-md-4">
                                        <input value="<?=$applicant_info->ab_zipcode?>"  id="inputHorizontalSuccess" type="text" class="form-control form-control-success editable"  name="info_ab_zipcode"><small class="form-text">Zip Code<!-- <span hidden class="asterisk" style="color:red">*</span> --></small>
                                    </div>
                                </div>
                                <hr>

                                <div class="form-group row">       
                                    <div class="col-md-12">
                                        <!-- <input type="submit" style="float:right" value="Update" class="btn btn-primary"> -->
                                        <button type="button" style="float:right" class="btn btn-primary saveEditBtn ">Update</button>
                                       <!--  <button hidden type="button" style="float:right; margin-right:10px;" class="btn btn-danger cancelEditBtn">Cancel</button> -->
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-6">
                                    
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- add a br to eliminate whitespaces in the bottom -->
    <br><br><br><br><br>
<?php $this->load->view('includes/footer'); ?>

<script src="<?=base_url('assets/js/applicant/profile/applicant_information.js');?>"></script>
