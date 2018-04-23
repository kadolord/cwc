<!-- change the data-num and data-subnum for numbering of navigation -->
<div class="content-inner" id="pageActive" data-num="2" data-namecollapse="#transaction-collapse" data-labelname="Applicants"> 
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Applicants</h2>
        </div>
    </header>

    <!-- Breadcrumb-->
    <ul class="breadcrumb">
        <div class="container-fluid">
            <li class="breadcrumb-item active">Transactions</li>
            <li class="breadcrumb-item active">Applicants</li>
        </div>
    </ul>
    <section class="tables">   
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 no-padding">
                    <div class="card">
                        <div class="">
                            <div class="card-header d-flex align-items-center">
                                <div class="col-lg-12">
                                    <h1>Applicants</h1><br>
                                    <br>
                                    <div class="row">
                                       <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label col-form-label-sm">Full Name</label>
                                                <input type="text" data-column="1"  class="form-control material_josh form-control-sm search-input-text searchFullname" placeholder="Full Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label col-form-label-sm">Country of Birth</label>
                                                <input type="text" data-column="2"  class="form-control material_josh form-control-sm search-input-text searchCountry" placeholder="Country">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label col-form-label-sm">Email Address</label>
                                                <input type="text" data-column="3"  class="form-control material_josh form-control-sm search-input-text searchEmail" placeholder="Email Address">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">       
                                        <div class="col-md-12">
                                           <button type="button" style="float:right; margin-right:10px;" class="btn btn-primary filterBtn">Filter</button>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="table-responsive table_applicant" style="display:none">
                                        <table class="table table-striped table-hover table-bordered" id="table-grid"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Full Name</th>
                                                    <th>ACR I-Card Number</th>
                                                    <th>Mobile Number</th>
                                                    <th>Email Address</th>
                                                    <th>Country of Birth</th>
                                                    <th width="85" style="text-align: center;">Action</th>
                                                </tr>
                                            </thead>
                                        </table>	
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="viewAccountsModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-lg modal-lg-custom">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="exampleModalLabel" class="modal-title">View Applicant Info</h4>
                    <!-- <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button> -->
                </div>
                <form class="form-horizontal personal-info-css" id="view_accountspersonalinfo-form">
                    <div class="modal-body">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="">
                                        <div class="card-body">
                                            <h5>Personal Information</h5>
                                            <br>
                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Applicant Name</label>
                                                <div class="col-md-3">
                                                    <input disabled id="inputHorizontalSuccess" type="text" class="form-control form-control-success" name="info_fname"><small class="form-text text-center">First Name </small>
                                                </div>
                                                <div class="col-md-2">
                                                    <input disabled id="inputHorizontalSuccess" type="text" class="form-control form-control-success"  name="info_mname"><small class="form-text  text-center">Middle Name</small>
                                                </div>
                                                <div class="col-md-3">
                                                    <input disabled id="inputHorizontalSuccess" type="text" class="form-control form-control-success" name="info_lname"><small class="form-text  text-center">Last Name </small>
                                                </div>
                                                <div class="col-md-2">
                                                    <input disabled id="inputHorizontalSuccess" type="text" class="form-control form-control-success"  name="info_xname"><small class="form-text  text-center">Name Extension</small>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Applicant No</label>
                                                <div class="col-md-4">
                                                    <input disabled id="inputHorizontalSuccess" type="text" class="form-control form-control-success"  name="info_applicant_no">
                                                </div>
                                                <label class="col-md-2 form-control-label">ACR I-Card No</label>
                                                <div class="col-md-4">
                                                    <input disabled id="inputHorizontalSuccess" type="text" class="form-control form-control-success" name="info_acr_no">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Alias 1</label>
                                                <div class="col-md-4">
                                                    <input disabled  id="inputHorizontalSuccess" type="text" class="form-control form-control-success" name="info_alias1">
                                                </div>

                                                <label class="col-md-2 form-control-label">Alias 2</label>
                                                <div class="col-md-4">
                                                    <input disabled  id="inputHorizontalSuccess" type="text" class="form-control form-control-success" name="info_alias2">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Birthdate </label>
                                                <div class="col-md-4">
                                                    <input disabled id="inputHorizontalWarning" type="text" class="form-control form-control-warning" name="info_bdate">
                                                </div> 

                                                <label class="col-md-2 form-control-label">Age </label>
                                                <div class="col-md-4">
                                                    <input disabled type="text" class="form-control form-control-sm" name="info_age" >
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Gender </label>
                                                <div class="col-md-4">
                                                    <input disabled type="text" class="form-control form-control-sm" name="info_gender">
                                                </div>
                                                <label class="col-md-2 form-control-label">Civil Status </label>
                                                <div class="col-md-4">
                                                    <input disabled type="text" class="form-control form-control-sm" name="info_civilstatus">
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Country of Birth</label>
                                                <div class="col-md-4">
                                                    <input disabled id="inputHorizontalWarning" type="text" class="form-control form-control-warning" name="info_birth_country">
                                                </div> 

                                                <label class="col-md-2 form-control-label">Citizenship / Nationality </label>
                                                <div class="col-md-4">
                                                      <input disabled type="text" name="info_nationality" class="form-control form-control-sm registerAge">
                                                </div>
                                            </div>
                                            <hr>

                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Passport No</label>
                                                <div class="col-md-4">
                                                    <input disabled id="inputHorizontalWarning" type="text" class="form-control form-control-warning info_passport_no"  name="info_passport_no">
                                                </div>
                                            </div>


                                            <div class="form-group row">

                                                <label class="col-md-2 form-control-label">Place of Issuance</label>
                                                <div class="col-md-4">
                                                      <input disabled type="text" name="info_issuance_place" class="form-control form-control-sm registerAge">
                                                </div>

                                                <label class="col-md-2 form-control-label">Date of Issuance</label>
                                                <div class="col-md-4">
                                                    <input disabled id="inputHorizontalWarning" type="text" class="form-control form-control-warning" name="info_issuance_date">
                                                </div> 
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Expiry Date </label>
                                                <div class="col-md-4">
                                                    <input disabled id="inputHorizontalWarning" type="text" class="form-control form-control-warning" name="info_expiry_date">
                                                </div> 

                                                <label class="col-md-2 form-control-label"> Date of Latest Arrival</label>
                                                <div class="col-md-4">
                                                    <input disabled id="inputHorizontalWarning" type="text" class="form-control form-control-warning" name="info_arrival_date">
                                                </div> 
                                            </div>
                                            <hr>
                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Email Address</label>
                                                <div class="col-md-4">
                                                    <input disabled id="inputHorizontalWarning" type="text" class="form-control form-control-warning" name="info_email">
                                                </div> 
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Mobile Number</label>
                                                <div class="col-md-4">
                                                    <input disabled id="inputHorizontalWarning" type="text" class="form-control form-control-warning editable"  name="info_mobile">
                                                </div> 

                                                <label class="col-md-2 form-control-label">Landline</label>
                                                <div class="col-md-4">
                                                    <input disabled id="inputHorizontalWarning" type="text" class="form-control form-control-warning editable" name="info_landline">
                                                </div> 

                                            </div>
                                            <hr>
                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Residential Address in the Philippines </label>
                                                <div class="col-md-3">
                                                    <input disabled id="inputHorizontalSuccess" type="text" class="form-control form-control-success editable"  name="info_ph_st"><small class="form-text">House/Unit No., Street </small>
                                                </div>
                                                <div class="col-md-3">
                                                    <input disabled id="inputHorizontalSuccess" type="text" class="form-control form-control-success editable" name="info_ph_village"><small class="form-text">Subdivision / Village</small>
                                                </div>
                                                <div class="col-md-4">
                                                    <input disabled id="inputHorizontalSuccess" type="text" class="form-control form-control-success editable" name="info_ph_brgy"><small class="form-text">Barangay</small>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label"></label>
                                                <div class="col-md-3">
                                                    <input disabled id="inputHorizontalSuccess" type="text" class="form-control form-control-success editable" name="info_ph_city"><small class="form-text">Municipality / City</small>
                                                </div>
                                                <div class="col-md-3">
                                                    <input disabled id="inputHorizontalSuccess" type="text" class="form-control form-control-success editable" name="info_ph_prov"><small class="form-text">Province</small>
                                                </div>
                                                <div class="col-md-4">
                                                    <input disabled id="inputHorizontalSuccess" type="text" class="form-control form-control-success editable" name="info_ph_zipcode"><small class="form-text">Zip Code</small>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Residential Address Abroad </label>
                                                <div class="col-md-3">
                                                    <input disabled id="inputHorizontalSuccess" type="text" class="form-control form-control-success editable" name="info_ab_st"><small class="form-text">House/Unit No., Street </small>
                                                </div>
                                                <div class="col-md-3">
                                                    <input disabled id="inputHorizontalSuccess" type="text" class="form-control form-control-success editable" name="info_ab_village"><small class="form-text">Subdivision / Village</small>
                                                </div>
                                                <div class="col-md-4">
                                                    <input disabled id="inputHorizontalSuccess" type="text" class="form-control form-control-success editable" name="info_ab_city"><small class="form-text">City</small>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label"></label>
                                                <div class="col-md-3">
                                                    <input disabled id="inputHorizontalSuccess" type="text" class="form-control form-control-success editable"  name="info_ab_state"><small class="form-text">State</small>
                                                </div>
                                                <div class="col-md-3">
                                                    <input disabled id="inputHorizontalSuccess" type="text" class="form-control form-control-success editable" name="info_ab_country">
                                                    <small class="form-text">Country</small>
                                                </div>
                                                <div class="col-md-4">
                                                    <input disabled  id="inputHorizontalSuccess" type="text" class="form-control form-control-success editable"  name="info_ab_zipcode"><small class="form-text">Zip Code</small>
                                                </div>
                                            </div>
                                            <hr>
                                            <h5>Uploaded Documents</h5>
                                            <br>
                                            <div class="uploaded_docs form-group row"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="form-group row">       
                            <div class="col-md-12">
                                <!-- <button type="button" style="float:right" class="btn btn-primary goToEditModalAccountsBtn">Edit</button> -->
                                <button type="button" style="float:right; margin-right:10px;" class="btn btn-default cancelBtn" data-dismiss="modal" aria-label="Close">Back</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="editAccountsModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-lg modal-lg-custom">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="exampleModalLabel" class="modal-title">Edit Accounts</h4>
                    <!-- <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button> -->
                </div>
                <form class="form-horizontal personal-info-css" id="edit_accountspersonalinfo-form">
                    <div class="modal-body">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Fullname <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-4">
                                                    <input type="hidden" name="info_user_id" class="info_user_id">
                                                    <input required id="inputHorizontalSuccess" type="text" class="form-control form-control-success info_fname" name="info_fname"><small class="form-text">First Name <span class="asterisk" style="color:red">*</span></small>
                                                </div>
                                                <div class="col-md-3">
                                                    <input id="inputHorizontalSuccess" type="text" class="form-control form-control-success info_mname" name="info_mname"><small class="form-text">Middle Name</small>
                                                </div>
                                                <div class="col-md-3">
                                                    <input required id="inputHorizontalSuccess" type="text" class="form-control form-control-success info_lname" name="info_lname"><small class="form-text">Last Name <span class="asterisk" style="color:red">*</span></small>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Birthdate <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-4">
                                                    <input required id="inputHorizontalWarning" type="text" class="form-control form-control-warning datepicker info_bdate" name="info_bdate" placeholder="mm/dd/yyyy">
                                                </div>

                                                <label class="col-md-2 form-control-label">Contact No. <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-4">
                                                    <input required id="inputHorizontalWarning" type="text" class="form-control form-control-warning info_contact_number" name="info_contact_number">
                                                </div>
                                            </div>

                            <!--                 <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Address <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-10">
                                                    <input required id="inputHorizontalWarning" type="text" class="form-control form-control-warning info_address" name="info_address">
                                                </div>
                                            </div> -->

                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Country <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-4">
                                                    <select required class="form-control select2 info_country" name="info_country">
                                                        <?php
                                                        foreach ($get_country->result() as $gcountry) { ?>
                                                                <option value="<?=$gcountry->country_id?>"><?=$gcountry->country?></option>
                                                        <?php } ?>
                                                        ?>
                                                        
                                                    </select>
                                                </div>

                                            </div>

                                            <!-- Male = 1 & Female = 2 -->
                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Gender <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-2">
                                                    <div class="i-checks martop12">
                                                        <input id="info_gendermale" type="radio" value="1" name="info_gender" class="radio-template info_gender">
                                                        <label for="info_gendermale">Male</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="i-checks martop12">
                                                        <input id="info_genderfemale" type="radio" value="2" name="info_gender" class="radio-template info_gender">
                                                        <label for="info_genderfemale">Female</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Email <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-4">
                                                    <input required id="inputHorizontalWarning" type="text" class="form-control form-control-warning emailAdd info_emailaddress" name="info_emailaddress">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="form-group row">       
                            <div class="col-md-12">
                                <button type="submit" style="float:right" class="btn btn-primary EditAccountsModalBtn">Save</button>
                                <button type="button" style="float:right; margin-right:10px;" class="btn btn-default cancelBtn" data-dismiss="modal" aria-label="Close">Close</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="deleteAccountsModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="exampleModalLabel" class="modal-title">Delete Accounts</h4>
                    <!-- <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button> -->
                </div>
                <form class="form-horizontal personal-info-css" id="delete_accountspersonalinfo-form">
                    <div class="modal-body">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p>Are you sure you want to delete this record <br>(<bold class="fullname_del"></bold>) ?</p>
                                    <input type="hidden" class="del_user_id" name="del_user_id" value="">

                                    <input type="hidden" class="del_email_id" name="del_email_id" value="">

                                    <input type="hidden" class="del_position_id" name="del_position_id" value="">
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="form-group row">       
                            <div class="col-md-12">
                                <button type="submit" style="float:right" class="btn btn-primary deleteAccountBtn">Delete</button>
                                <button type="button" style="float:right; margin-right:10px;" class="btn btn-default cancelBtn" data-dismiss="modal" aria-label="Close">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php $this->load->view('includes/footer');?> <!-- includes your footer -->
<script type="text/javascript" src="<?=base_url('assets/js/admin/settings/applicants.js');?>"></script>

