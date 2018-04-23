<style type="text/css">
    .dataTables_filter { display: none; }
</style>
<!-- change the data-num and data-subnum for numbering of navigation -->
<div class="content-inner" id="pageActive" data-num="4" data-namecollapse="#settings-collapse" data-labelname="Holiday"> 
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Holiday</h2>
        </div>
    </header>

    <!-- Breadcrumb-->
    <ul class="breadcrumb">
        <div class="container-fluid">
            <li class="breadcrumb-item active">Settings</li>
            <li class="breadcrumb-item active">Holiday</li>
        </div>
    </ul>
    <section class="tables">   
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 no-padding">
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
    <div id="addHolidayModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog">
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
                                                <label class="col-md-5 form-control-label">Holiday Description <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-7">
                                                    <input type="hidden" name="branch_id" class="branch_id">
                                                    <input required id="inputHorizontalSuccess" type="text" class="form-control form-control-success info_bname" name="info_hol_desc">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-5 form-control-label">Date <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-7">
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
        <div role="document" class="modal-dialog">
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
                                                <label class="col-md-5 form-control-label">Holiday Description</label>
                                                <div class="col-md-7">
                                                    <input type="hidden" name="branch_id" class="branch_id">
                                                    <input disabled id="inputHorizontalSuccess" type="text" class="form-control form-control-success view_hol_desc" name="view_hol_desc">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-5 form-control-label">Holiday Date</label>
                                                <div class="col-md-7">
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
        <div role="document" class="modal-dialog">
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
                                                <label class="col-md-5 form-control-label">Holiday Description <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-7">

                                                    <input type="hidden" class="hidden_holidays" data-holidays="<?=json_encode($holidays)?>">
                                                    <input type="hidden" name="holiday_id" class="holiday_id">
                                                    <input type="hidden" name="current_holiday_name" class="current_holiday_name">
                                                    <input required id="inputHorizontalSuccess" type="text" class="form-control form-control-success edit_hol_desc" name="edit_hol_desc">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-5 form-control-label">Holiday Date <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-7">
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
                                <button type="submit" style="float:right" class="btn btn-primary EditAccountsModalBtn">Save Changes</button>
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
                                <button type="submit" style="float:right" class="btn btn-danger deleteHolidayBtn">Delete</button>
                                <button type="button" style="float:right; margin-right:10px;" class="btn btn-default cancelBtn" data-dismiss="modal" aria-label="Close">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php $this->load->view('includes/footer');?> <!-- includes your footer -->
<script type="text/javascript" src="<?=base_url('assets/js/admin/settings/holiday.js');?>"></script>

