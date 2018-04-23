<style type="text/css">
    .dataTables_filter { display: none; }
</style>
<!-- change the data-num and data-subnum for numbering of navigation -->
<div class="content-inner" id="pageActive" data-num="3" data-namecollapse="#settings-collapse" data-labelname="Schedule Limit"> 
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Schedule Limit</h2>
        </div>
    </header>

    <!-- Breadcrumb-->
    <ul class="breadcrumb">
        <div class="container-fluid">
            <li class="breadcrumb-item active">Settings</li>
            <li class="breadcrumb-item active">Schedule Limit</li>
        </div>
    </ul>

    <section class="tables">   
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 no-padding">
                    <div class="card">
                        <div class="card-body">
                            <h1>Schedule Limit</h1><br>
                            <!-- <table class="table table-striped table-hover"> -->
                            <button data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#addScheduleLimitModal" class="btn btn-primary btnUpdate btnTable btnClickAddScheduleLimit" name="update" style="right:20px; position: absolute; top:20px;">Add Schedule Limit</button>
                            <br>
                            <div class="table-responsive">
                                <table class="table  table-striped table-hover table-bordered" id="table-grid2"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Schedule ID</th>
                                            <th>Branch Code</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Limit Per Day</th>
                                            <th>Limit Per Hour</th>
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

    <!-- Modal-->
    <div id="addHolidayModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-lg modal-lg-custom">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="exampleModalLabel" class="modal-title">Add Holiday</h4>
                    <!-- <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button> -->
                </div>
                <form class="form-horizontal personal-info-css" id="add_holiday-form">
                    <div class="modal-body">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="">
                                        <div class="card-body">
                                             <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Holiday Description <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-4">
                                                    <input type="hidden" name="branch_id" class="branch_id">
                                                    <input required id="inputHorizontalSuccess" type="text" class="form-control form-control-success info_bname" name="info_hol_desc">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Date <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-4">
                                                    <input required id="inputHorizontalWarning" class="form-control form-control-warning info_bcode datepicker_holiday" name="info_hol_date">
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
                                <button type="button" style="float:right" class="btn btn-success saveBtnHoliday">Add</button>
                                <button type="button" style="float:right; margin-right:10px;" class="btn btn-default cancelBtn" data-dismiss="modal" aria-label="Close">Close</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="viewHolidayModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-lg modal-lg-custom">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="exampleModalLabel" class="modal-title">View Holiday</h4>
                    <!-- <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button> -->
                </div>
                <form class="form-horizontal personal-info-css" id="view_holiday-form">
                    <div class="modal-body">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Holiday Description <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-4">
                                                    <input type="hidden" name="branch_id" class="branch_id">
                                                    <input disabled id="inputHorizontalSuccess" type="text" class="form-control form-control-success view_hol_desc" name="view_hol_desc">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Holiday Date <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-4">
                                                    <input disabled id="inputHorizontalWarning" type="text" class="form-control form-control-warning view_hol_date" name="view_hol_date">
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
                                <button type="button" style="float:right" class="btn btn-primary goToEditModalHolidayBtn">Edit</button>
                                <button type="button" style="float:right; margin-right:10px;" class="btn btn-default cancelBtn" data-dismiss="modal" aria-label="Close">Back</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="editHolidayModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-lg modal-lg-custom">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="exampleModalLabel" class="modal-title">Edit Holiday</h4>
                    <!-- <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button> -->
                </div>
                <form class="form-horizontal personal-info-css" id="edit_holiday-form">
                    <div class="modal-body">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Holiday Description <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-4">

                                                    <input type="hidden" class="hidden_holidays" data-holidays="<?=json_encode($holidays)?>">
                                                    <input type="hidden" name="holiday_id" class="holiday_id">
                                                    <input type="hidden" name="current_holiday_name" class="current_holiday_name">
                                                    <input required id="inputHorizontalSuccess" type="text" class="form-control form-control-success edit_hol_desc" name="edit_hol_desc">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Holiday Date <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-4">
                                                    <input required id="inputHorizontalWarning" type="text" class="form-control form-control-warning datepicker_holiday edit_hol_date" name="edit_hol_date">
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

    <div id="deleteHolidayModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="exampleModalLabel" class="modal-title">Delete Accounts</h4>
                    <!-- <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button> -->
                </div>
                <form class="form-horizontal personal-info-css" id="delete_holiday-form">
                    <div class="modal-body">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p>Are you sure you want to delete this record?</p>
                                    <input type="hidden" class="del_holiday_id" name="del_holiday_id" value="">                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="form-group row">       
                            <div class="col-md-12">
                                <button type="submit" style="float:right" class="btn btn-primary deleteHolidayBtn">Delete</button>
                                <button type="button" style="float:right; margin-right:10px;" class="btn btn-default cancelBtn" data-dismiss="modal" aria-label="Close">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="addScheduleLimitModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-lg modal-lg-custom">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="exampleModalLabel" class="modal-title">Add Schedule Limit</h4>
                </div>
                <form class="form-horizontal personal-info-css" id="add_schedlimit-form">
                    <div class="modal-body">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Branch Code</label>
                                                
                                                <div class="col-md-4 info_assigned_branch_container">
                                                   <?php
                                                    foreach ($get_branch->result() as $gbranch) { ?>
                                                        <?php if($gbranch->branch_id == $branch_admin_info->branch_admin_assigned_branch_id): ?>
                                                            <input disabled type="text" class="form-control form-control-success info_branch_code" name="info_branch_code" value="<?php echo $gbranch->branch_name; ?>">
                                                        <?php endif; ?>
                                                    <?php } ?>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Date<span class="asterisk" style="color:red">*</span></label>
                                                <div class="input-daterange input-group col-md-4" id="datepicker">
                                                    <input type="text" class="input-sm form-control material_josh search-input-select searchDate searchDateTo" name="start_date" value="<?=today_date();?>" />
                                                    <span class="input-group-addon" style="background-color:#fff0 ; border:none;">to</span>
                                                    <input type="text" class= "input-sm form-control material_josh search-input-select searchDate searchDateFrom" name="end_date" value="<?=today_date();?>" />
                                                </div>
                                            </div>      

                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Day Limit<span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-4">
                                                    <input required id="inputHorizontalSuccess" type="number" class="form-control form-control-success info_day_limit" name="info_day_limit" min="1">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Hour Limit<span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-4">
                                                    <input required id="inputHorizontalSuccess" type="number" class="form-control form-control-success info_hour_limit" id='info_hour_limit' name="info_hour_limit" min="1">
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
                                <button type="button" style="float:right" class="btn btn-success saveBtnSchedLimit">Add</button>
                                <button type="button" style="float:right; margin-right:10px;" class="btn btn-default cancelBtn" data-dismiss="modal" aria-label="Close">Close</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="viewSchedLimitModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-lg modal-lg-custom">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="exampleModalLabel" class="modal-title">View Schedule Limit</h4>
                    <!-- <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button> -->
                </div>
                <form class="form-horizontal personal-info-css" id="view_holiday-form">
                    <div class="modal-body">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="">
                                        <div class="card-body">
                                           <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Branch Code</label>
                                                
                                                <div class="col-md-4">
                                                    <select disabled class="form-control select2 view_branch_code" name="view_branch_code">
                                                       <?php
                                                        foreach ($get_branch->result() as $gbranch) { ?>
                                                            <option value="<?=$gbranch->branch_id?>"><?=$gbranch->branch_code?></option>
                                                        <?php } ?>
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Schedule Date</label>
                                                <div class="input-daterange input-group col-md-4" id="datepicker">
                                                    <span class="input-group-addon" style="background-color:#fff0 ; border:none;">from</span>
                                                    <input type="text" disabled class="input-sm form-control material_josh search-input-select searchDate searchDateTo view_start_date" name="view_start_date" value="" />
                                                    <span class="input-group-addon" style="background-color:#fff0 ; border:none;">to</span>
                                                    <input type="text" class= "input-sm form-control material_josh search-input-select searchDate searchDateFrom view_end_date" disabled name="view_end_date" value="" />
                                                </div>
                                            </div>      

                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Day Limit</label>
                                                <div class="col-md-4">
                                                    <input disabled id="inputHorizontalSuccess" type="number" class="form-control form-control-success view_day_limit" name="view_day_limit" min="1">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Hour Limit</label>
                                                <div class="col-md-4">
                                                    <input disabled id="inputHorizontalSuccess" type="number" class="form-control form-control-success view_hour_limit" id='view_hour_limit' name="view_hour_limit" min="1">
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
                                <button type="button" style="float:right" class="btn btn-primary goToEditModalSchedLimitBtn">Edit</button>
                                <button type="button" style="float:right; margin-right:10px;" class="btn btn-default cancelBtn" data-dismiss="modal" aria-label="Close">Back</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="editSchedLimitModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-lg modal-lg-custom">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="exampleModalLabel" class="modal-title">Edit Schedule Limit</h4>
                    <!-- <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button> -->
                </div>
                <form class="form-horizontal personal-info-css" id="edit_schedlimit-form">
                    <div class="modal-body">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="">
                                        <div class="card-body">
                                           <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Branch Code<span class="asterisk" style="color:red">*</span></label>
                                                
                                                <div class="col-md-4">
                                                    <input type="hidden" name="sched_limit_id" class="sched_limit_id">
                                                    <select disabled class="form-control select2 edit_branch_code" name="edit_branch_code">
                                                       <?php
                                                        foreach ($get_branch->result() as $gbranch) { ?>
                                                            <?php if($gbranch->branch_id == $branch_admin_info->branch_admin_assigned_branch_id): ?>
                                                             <option value="<?=$gbranch->branch_id?>"><?=$gbranch->branch_code?></option>
                                                            <?php endif; ?>
                                                        <?php } ?>
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Schedule Date<span class="asterisk" style="color:red">*</span></label>
                                                <div class="input-daterange input-group col-md-4" id="datepicker">
                                                    <span class="input-group-addon" style="background-color:#fff0 ; border:none;">from</span>
                                                    <input type="text" class="input-sm form-control material_josh search-input-select searchDate searchDateTo edit_start_date" name="edit_start_date" value="" />
                                                    <span class="input-group-addon" style="background-color:#fff0 ; border:none;">to</span>
                                                    <input type="text" class= "input-sm form-control material_josh search-input-select searchDate searchDateFrom edit_end_date" name="edit_end_date" value="" />
                                                </div>
                                            </div>      

                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Day Limit<span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-4">
                                                    <input required id="inputHorizontalSuccess" type="number" class="form-control form-control-success edit_day_limit" name="edit_day_limit" min="1">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Hour Limit<span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-4">
                                                    <input required id="inputHorizontalSuccess" type="number" class="form-control form-control-success edit_hour_limit" id='edit_hour_limit' name="edit_hour_limit" min="1">
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
                                <button type="submit" style="float:right" class="btn btn-primary EditSchedLimitModalBtn">Save</button>
                                <button type="button" style="float:right; margin-right:10px;" class="btn btn-default cancelBtn" data-dismiss="modal" aria-label="Close">Close</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="deleteSchedLimitModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="exampleModalLabel" class="modal-title">Delete Schedule Limit</h4>
                    <!-- <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button> -->
                </div>
                <form class="form-horizontal personal-info-css" id="delete_schedlimit-form">
                    <div class="modal-body">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p>Are you sure you want to delete this record?</p>
                                    <input type="hidden" class="del_sched_limit_id" name="del_sched_limit_id" value="">                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="form-group row">       
                            <div class="col-md-12">
                                <button type="submit" style="float:right" class="btn btn-primary deleteSchedLimitBtn">Delete</button>
                                <button type="button" style="float:right; margin-right:10px;" class="btn btn-default cancelBtn" data-dismiss="modal" aria-label="Close">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php $this->load->view('includes/footer');?> <!-- includes your footer -->
<script type="text/javascript" src="<?=base_url('assets/js/branch_admin/settings/schedule.js');?>"></script>

