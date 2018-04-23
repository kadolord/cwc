<!-- change the data-num and data-subnum for numbering of navigation -->
<div class="content-inner" id="pageActive" data-num="3" data-namecollapse="#settings-collapse" data-labelname="Accounts"> 
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Accounts</h2>
        </div>
    </header>

    <!-- Breadcrumb-->
    <ul class="breadcrumb">
        <div class="container-fluid">
            <li class="breadcrumb-item active">Settings</li>
            <li class="breadcrumb-item active">Accounts</li>
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
                                    <br><br><br>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-control-label col-form-label-sm">Position</label>
                                                <select  data-column="0" class="form-control select2 search-input-select searchPosition">
                                                    <option selected="" value="">Select Position</option>
                                                    <?php
                                                    foreach ($get_position->result() as $gpos) { ?>
                                                            <?php if($gpos->position == "Applicant" || $gpos->position == "Admin" || $gpos->position == "Staff"){}else{?>
                                                            <option value="<?=$gpos->position_id?>"><?=$gpos->position?></option>
                                                            <?php } ?>
                                                    <?php } ?>
                                                    ?>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-control-label col-form-label-sm">Full Name</label>
                                                <input disabled type="text" data-column="1"  class="form-control material_josh form-control-sm search-input-text searchFullname" placeholder="Full Name">
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-control-label col-form-label-sm">Contact Number</label>
                                                <input disabled type="text" data-column="2"  class="form-control material_josh form-control-sm search-input-text searchContact" placeholder="Contact Number">
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-control-label col-form-label-sm">Email Address</label>
                                                <input disabled type="text" data-column="3"  class="form-control material_josh form-control-sm search-input-text searchEmail" placeholder="Email Address">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- <table class="table table-striped table-hover"> -->
                                <button data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#addAccountsModal" class="btn btn-primary btnUpdate btnTable btnClickAddAccount" name="update" style="right:20px; position: absolute; top:20px;">Add Account</button>
                            <div class="table-responsive">
                                <table class="table  table-striped table-hover table-bordered" id="table-grid"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Position</th>
                                            <th>Full Name</th>
                                            <th>Contact Number</th>
                                            <th>Email Address</th>
                                            <th width="185" style="text-align: center;">Action</th>
                                        </tr>
                                    </thead>
                                </table>	
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- <button type="button" data-toggle="modal" data-target="#addAccountsModal" class="btn btn-primary">Form in simple modal </button> -->
    <!-- Modal-->
    <div id="addAccountsModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-lg modal-lg-custom">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="exampleModalLabel" class="modal-title">Add Accounts</h4>
                    <!-- <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button> -->
                </div>
                <form class="form-horizontal personal-info-css" id="add_accountspersonalinfo-form">
                    <div class="modal-body">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="">
                                        <div class="card-body">

                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Position</label>
                                                <div class="col-md-4">
                                                    <input class="form-control form-control-success" value="Branch Staff" disabled>
                                                    <input type="hidden" name="info_position" value="5">
                                                   <!--  <select  class="form-control select2 info_position" name="info_position">
                                                        <option selected hidden disabled value="5">Branch Staff</option>
                                                    </select> -->
                                                </div>
                                            </div>

                                            <div class="form-group row">

                                                <label class="col-md-2 form-control-label">Fullname <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-4">
                                                    <input id="inputHorizontalSuccess" type="text" class="form-control form-control-success" name="info_fname"><small class="form-text">First Name <span class="asterisk" style="color:red">*</span></small>
                                                </div>
                                                <div class="col-md-3">
                                                    <input id="inputHorizontalSuccess" type="text" class="form-control form-control-success" name="info_mname"><small class="form-text">Middle Name</small>
                                                </div>
                                                <div class="col-md-3">
                                                    <input id="inputHorizontalSuccess" type="text" class="form-control form-control-success" name="info_lname"><small class="form-text">Last Name <span class="asterisk" style="color:red">*</span></small>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                              <!--   <label class="col-md-2 form-control-label">Birthdate <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-4">
                                                    <input id="inputHorizontalWarning" type="text" class="form-control form-control-warning datepicker_birdthdate" name="info_bdate" placeholder="mm/dd/yyyy">
                                                </div> -->

                                                <label class="col-md-2 form-control-label">Contact No. <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-4">
                                                    <input id="inputHorizontalWarning" type="text" class="form-control form-control-warning" name="info_contact_number">
                                                </div>
                                            </div>

                                      <!--       <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Address <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-10">
                                                    <input id="inputHorizontalWarning" type="text" class="form-control form-control-warning" name="info_address">
                                                </div>
                                            </div>
                                        -->
                                          <!--   <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Country <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-4">
                                                    <select class="form-control select2" name="info_country">
                                                        <option selected value="">-- Select Country --</option>
                                                        <?php
                                                        foreach ($get_country->result() as $gcountry) { ?>
                                                                <option value="<?=$gcountry->country_id?>"><?=$gcountry->country?></option>
                                                        <?php } ?>
                                                        ?>
                                                        
                                                    </select>
                                                </div>
                                            </div> -->

                                            <!-- Male = 1 & Female = 2 -->
                                   <!--          <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Gender <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-2">
                                                    <div class="i-checks martop12">
                                                        <input id="register-gendermale" type="radio" value="1" name="info_gender" class="radio-template" checked="">
                                                        <label for="register-gendermale">Male</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="i-checks martop12">
                                                        <input id="register-genderfemale" type="radio" value="2" name="info_gender" class="radio-template">
                                                        <label for="register-genderfemale">Female</label>
                                                    </div>
                                                </div>
                                            </div> -->

                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Email <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-4">
                                                    <!-- tinanggal ko muna sa editable  remove ung "_2" if isasama-->
                                                    <input id="inputHorizontalWarning" type="text" class="form-control form-control-warning emailAdd" name="info_emailaddress">
                                                </div>

<!--                                                 <label class="col-md-2 form-control-label">Position <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-4">
                                                    <select class="form-control select2 info_position" name="info_position">
                                                        <option selected value="">-- Select Position --</option>
                                                        <?php
                                                        foreach ($get_position->result() as $gpos) { ?>
                                                            <?php if($gpos->position != "Branch Staff" ){}else{?>
                                                                <option value="<?=$gpos->position_id?>"><?=$gpos->position?></option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                        ?>
                                                    </select>
                                                </div> -->
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
                                <button type="button" style="float:right" class="btn btn-success saveBtnAccounts">Add</button>
                                <button type="button" style="float:right; margin-right:10px;" class="btn btn-default cancelBtn" data-dismiss="modal" aria-label="Close">Close</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="viewAccountsModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-lg modal-lg-custom">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="exampleModalLabel" class="modal-title">View Accounts</h4>
                    <!-- <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button> -->
                </div>
                <form class="form-horizontal personal-info-css" id="view_accountspersonalinfo-form">
                    <div class="modal-body">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="">
                                        <div class="card-body">

                                            <div class="form-group row">
                                                <!-- <label class="col-md-2 form-control-label">Country</label>
                                                <div class="col-md-4">
                                                    <select disabled class="form-control select2 info_country" name="info_country">
                                                        <?php
                                                        foreach ($get_country->result() as $gcountry) { ?>
                                                                <option value="<?=$gcountry->country_id?>"><?=$gcountry->country?></option>
                                                        <?php } ?>
                                                        ?>
                                                        
                                                    </select>
                                                </div> -->

                                                <label class="col-md-2 form-control-label">Assigned Branch</label>
                                                <div class="col-md-4">
                                                    <input type="text" disabled name="assigned_branch_2" class="form-control form-control-warning assigned_branch" value="<?php echo $branch_admin_info->branch_name; ?>"> 
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Fullname</label>
                                                <div class="col-md-4">
                                                    <input disabled disabled id="inputHorizontalSuccess" type="text" class="form-control form-control-success info_fname" name="info_fname"><small class="form-text">First Name</small>
                                                </div>
                                                <div class="col-md-3">
                                                    <input disabled id="inputHorizontalSuccess" type="text" class="form-control form-control-success info_mname" name="info_mname"><small class="form-text">Middle Name</small>
                                                </div>
                                                <div class="col-md-3">
                                                    <input disabled id="inputHorizontalSuccess" type="text" class="form-control form-control-success info_lname" name="info_lname"><small class="form-text">Last Name</small>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <!-- <label class="col-md-2 form-control-label">Birthdate</label>
                                                <div class="col-md-4">
                                                    <input disabled id="inputHorizontalWarning" type="text" class="form-control form-control-warning datepicker info_bdate" name="info_bdate" placeholder="mm/dd/yyyy">
                                                </div> -->

                                                <label class="col-md-2 form-control-label">Contact No.</label>
                                                <div class="col-md-4">
                                                    <input disabled id="inputHorizontalWarning" type="text" class="form-control form-control-warning info_contact_number" name="info_contact_number">
                                                </div>
                                            </div>

                                 <!--            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Address</label>
                                                <div class="col-md-10">
                                                    <input disabled id="inputHorizontalWarning" type="text" class="form-control form-control-warning info_address" name="info_address">
                                                </div>
                                            </div> -->

                                           

                                            <!-- Male = 1 & Female = 2 -->
                                      <!--       <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Gender</label>
                                                <div class="col-md-2">
                                                    <div class="i-checks martop12">
                                                        <input disabled id="info_gendermaleV" type="radio" value="1" name="info_gender" class="radio-template info_gender">
                                                        <label for="info_gendermaleV">Male</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="i-checks martop12">
                                                        <input disabled id="info_genderfemaleV" type="radio" value="2" name="info_gender" class="radio-template info_gender">
                                                        <label for="info_genderfemaleV">Female</label>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <br>
                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Email</label>
                                                <div class="col-md-6">
                                                    <!-- tinanggal ko muna sa editable  remove ung "_2" if isasama-->
                                                    <input disabled id="inputHorizontalWarning" type="text" class="form-control form-control-warning emailAdd info_emailaddress" name="info_emailaddress">
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
                                <button type="button" style="float:right" class="btn btn-primary goToEditModalAccountsBtn">Edit</button>
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
                    <h4 id="exampleModalLabel" class="modal-title">Edit Account</h4>
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
                                                    <input type="hidden" name="info_position_id" class="info_position_id">
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
                                             <!--    <label class="col-md-2 form-control-label">Birthdate <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-4">
                                                    <input required id="inputHorizontalWarning" type="text" class="form-control form-control-warning datepicker info_bdate" name="info_bdate" placeholder="mm/dd/yyyy">
                                                </div> -->

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

                                    <!--         <div class="form-group row">
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

                                            </div> -->

                                            <!-- Male = 1 & Female = 2 -->
                                            <!-- <div class="form-group row">
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
                                            </div> -->
                                            <br>
                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Email</label>
                                                <div class="col-md-4">
                                                    <input disabled id="inputHorizontalWarning" type="text" class="form-control form-control-warning emailAdd info_emailaddress" name="info_emailaddress">
                                                    <input hidden id="inputHorizontalWarning" type="text" class="form-control form-control-warning emailAdd info_emailaddress2" name="info_emailaddress2">
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
                                <button type="submit" style="float:right" class="btn btn-primary EditAccountsModalBtn">Save Changes</button>
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
<script type="text/javascript" src="<?=base_url('assets/js/branch_admin/settings/accounts.js');?>"></script>
<script type="text/javascript">
    $(".datepicker_birdthdate").datepicker();
</script>

