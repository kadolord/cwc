<style type="text/css">
    .dataTables_filter { display: none; }
</style>
<!-- change the data-num and data-subnum for numbering of navigation -->
<div class="content-inner" id="pageActive" data-num="4" data-namecollapse="#settings-collapse" data-labelname="Schedule Limit"> 
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
   <!--  <section class="tables">   
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h1>Holiday</h1><br>
                            <button data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#addHolidayModal" class="btn btn-primary btnUpdate btnTable btnClickAddHoliday" name="update" style="right:20px; position: absolute; top:20px;">Add Holiday</button>
                            <br>
                            <div class="table-responsive">
                                <table class="table  table-striped table-hover table-bordered" id="table-grid"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Description</th>
                                            <th>Date</th>
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
    </section>   --> 
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
                                            <th width="175" style="text-align: center;">Action</th>
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

    <div id="addScheduleLimitModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
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
                                                <label class="col-md-3 form-control-label">Branch Code<span class="asterisk" style="color:red">*</span></label>
                                                
                                                <div class="col-md-9 info_assigned_branch_container">
                                                    <select class="form-control info_branch_code" name="info_branch_code">
                                                       <?php
                                                        foreach ($get_branch->result() as $gbranch) { ?>
                                                            <option value="<?=$gbranch->branch_id?>"><?=$gbranch->branch_code?></option>
                                                        <?php } ?>
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label">Date<span class="asterisk" style="color:red">*</span></label>
                                                <div class="input-daterange input-group col-md-9" id="datepicker">
                                                    <input type="text" class="input-sm form-control material_josh search-input-select searchDate searchDateTo" name="start_date" value="<?=today_date();?>" />
                                                    <span class="input-group-addon" style="background-color:#fff0 ; border:none;">to</span>
                                                    <input type="text" class= "input-sm form-control material_josh search-input-select searchDate searchDateFrom" name="end_date" value="<?=today_date();?>" />
                                                </div>
                                            </div>      

                                            <div class="form-group row">
                                                <label class="col-md-5 form-control-label">Day Limit<span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-7">
                                                    <input required id="inputHorizontalSuccess" type="number" class="form-control form-control-success info_day_limit" name="info_day_limit" min="1">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-5 form-control-label">Hour Limit<span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-7">
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
        <div role="document" class="modal-dialog">
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
                                                <label class="col-md-3 form-control-label">Branch Code<span class="asterisk" style="color:red">*</span></label>
                                                
                                                <div class="col-md-9">
                                                    <select disabled class="form-control view_branch_code" name="view_branch_code">
                                                       <?php
                                                        foreach ($get_branch->result() as $gbranch) { ?>
                                                            <option value="<?=$gbranch->branch_id?>"><?=$gbranch->branch_code?></option>
                                                        <?php } ?>
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label">Date<span class="asterisk" style="color:red">*</span></label>
                                                <div class="input-daterange input-group col-md-9" id="datepicker">
                                                    <input type="text" disabled class="input-sm form-control material_josh search-input-select searchDate searchDateTo view_start_date" name="view_start_date" value="" />
                                                    <span class="input-group-addon" style="background-color:#fff0 ; border:none;">to</span>
                                                    <input type="text" class= "input-sm form-control material_josh search-input-select searchDate searchDateFrom view_end_date" disabled name="view_end_date" value="" />
                                                </div>
                                            </div>      

                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label">Day Limit<span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-9">
                                                    <input disabled id="inputHorizontalSuccess" type="number" class="form-control form-control-success view_day_limit" name="view_day_limit" min="1">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label">Hour Limit<span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-9">
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
        <div role="document" class="modal-dialog">
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
                                                <label class="col-md-3 form-control-label">Branch Code<span class="asterisk" style="color:red">*</span></label>
                                                
                                                <div class="col-md-9">
                                                    <input type="hidden" name="sched_limit_id" class="sched_limit_id">
                                                    <select required class="form-control edit_branch_code" name="edit_branch_code">
                                                       <?php
                                                        foreach ($get_branch->result() as $gbranch) { ?>
                                                            <option value="<?=$gbranch->branch_id?>"><?=$gbranch->branch_code?></option>
                                                        <?php } ?>
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label">Date<span class="asterisk" style="color:red">*</span></label>
                                                <div class="input-daterange input-group col-md-9" id="datepicker">
                                                    <input type="text" class="input-sm form-control search-input-select searchDate searchDateTo edit_start_date" name="edit_start_date" value="" />
                                                    <span class="input-group-addon" style="background-color:#fff0 ; border:none;">to</span>
                                                    <input type="text" class= "input-sm form-control search-input-select searchDate searchDateFrom edit_end_date" name="edit_end_date" value="" />
                                                </div>
                                            </div>      

                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label">Day Limit<span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-9">
                                                    <input required id="inputHorizontalSuccess" type="number" class="form-control form-control-success edit_day_limit" name="edit_day_limit" min="1">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label">Hour Limit<span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-9">
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
                                <button type="submit" style="float:right" class="btn btn-danger deleteSchedLimitBtn">Delete</button>
                                <button type="button" style="float:right; margin-right:10px;" class="btn btn-default cancelBtn" data-dismiss="modal" aria-label="Close">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php $this->load->view('includes/footer');?> <!-- includes your footer -->
<script type="text/javascript" src="<?=base_url('assets/js/admin/settings/schedule.js');?>"></script>

