<!-- change the data-num and data-subnum for numbering of navigation -->
<div class="content-inner" id="pageActive" data-num="2" data-namecollapse="#transaction-collapse" data-labelname="Schedule"> 
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Schedule</h2>
        </div>
    </header>

    <!-- Breadcrumb-->
    <ul class="breadcrumb">
        <div class="container-fluid">
            <li class="breadcrumb-item active">Transactions</li>
            <li class="breadcrumb-item active">Schedule</li>
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
                                     <h1>Schedule</h1>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label class="form-control-label col-form-label-sm">Date</label>
                                                 <div class="row">

                                                    <div class="input-daterange input-group" id="datepicker">
                                                        <input type="text" data-column="0" class="input-sm form-control material_josh search-input-select searchDate searchDateFrom" name="start" value="<?=today_date();?>" />
                                                        <span class="input-group-addon" style="background-color:#fff0 ; border:none;">to</span>
                                                        <input type="text" data-column="1" class= "input-sm form-control material_josh search-input-select searchDate searchDateTo" name="end" value="<?=today_date();?>" />
                                                    </div>

                                                 </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                 <label class="form-control-label col-form-label-sm">Reference No</label>
                                                <input type="text" data-column="4"  class="form-control material_josh form-control-sm search-input-text searchAppNo" placeholder="Reference No">
                                            </div>
                                        </div> 

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-control-label col-form-label-sm">Applicant Name</label>
                                                <input type="text" data-column="3"  class="form-control material_josh form-control-sm search-input-text searchAppStatus" placeholder="Applicant Name">
                                            </div>
                                        </div>

                                        <!--<div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-control-label col-form-label-sm">Branch Code</label>
                                                <select data-column="2" class="form-control-sm search-input-select select2 searchBCode">
                                                    <option selected hidden value="">--Select Branch Code--</option>
                                                    <?php foreach ($get_branch_code->result() as $branch): ?>
                                                       
                                                        <option value="<?php echo $branch->branch_id; ?>"><?php echo $branch->branch_code; ?></option>
                                                     
                                                    <?php endforeach; ?>;
                                                </select>
                                            </div>
                                        </div> -->
                                    </div>
                                    <div class="form-group row">       
                                        <div class="col-md-12">
                                           <button type="button" style="float:right; margin-right:10px;" class="btn btn-primary filterBtn">Filter</button>
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="table-responsive">
                                        <table class="table  table-striped table-hover table-bordered" id="table-grid"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Application Reference No</th>
                                                    <th>Applicant Name</th>
                                                    <th>Schedule Date</th>
                                                    <th>Schedule Time</th>
                                                    <th>Branch Code</th>
                                                    <th width="83" style="text-align: center;">Action</th>
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


    <div id="viewAppointmentModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-lg modal-lg-custom">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="exampleModalLabel" class="modal-title">View Schedule</h4>
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
                                                <label class="col-md-2 form-control-label">Reference No</label>
                                                
                                                <div class="col-md-4">
                                                    <input disabled id="inputHorizontalWarning" type="text" class="form-control info_app_ref_no" name="info_app_ref_no">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Applicant Name</label>
                                                
                                                <div class="col-md-4">
                                                    <input disabled id="inputHorizontalWarning" type="text" class="form-control info_app_name" name="info_app_name">
                                                </div>
                                            </div>

                                             <div class="form-group row">
                                                 <label class="col-md-2 form-control-label">Branch Code</label>
                                                <div class="col-md-4">
                                                    <input disabled id="inputHorizontalWarning" type="text" class="form-control info_bcode" name="info_bcode">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Schedule Date</label>
                                                <div class="col-md-4">
                                                    <input disabled id="inputHorizontalWarning" type="text" class="form-control datepicker info_app_date" name="info_app_date" placeholder="mm/dd/yyyy">
                                                </div>
                                            </div>  

                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Schedule Time</label>
                                                <div class="col-md-4">
                                                     <input disabled id="inputHorizontalWarning" type="text" class="form-control form-control-success info_app_time" name="info_app_time">
                                                </div>
                                            </div>

                 <!--                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Schedule Status</label>
                                                <div class="col-md-4">
                                                     <input disabled id="inputHorizontalWarning" type="text" class="form-control form-control-success info_app_status" name="info_app_status">
                                                </div>

                                                <label class="col-md-2 form-control-label rejection_reason_div">Rejection Reason <span class="asterisk" style="color:red">*</span></label>
                                                 <div class="col-md-4 rejection_reason_div">
                                                         <input disabled id="inputHorizontalWarning" type="text" class="form-control form-control-success info_app_rej_reason" name="info_app_rej_reason">
                                                </div>
                                            </div>    -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group row">       
                            <div class="col-md-12">
                                <button type="button" style="float:right; margin-right:10px;" class="btn btn-default cancelBtn" data-dismiss="modal" aria-label="Close">Close</button>
                             <!--    <button type="button" style="float:right; margin-right:10px;" class="btn btn-primary goToEditModalAccountsBtn">Approve</button>
                                 <button type="submit" style="float:right; margin-right:10px;" class="btn btn-danger goToRejectModalAppointmentBtn">Reject</button> -->
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="approveAppoinmentModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="exampleModalLabel" class="modal-title">Approve Application</h4>
                    <!-- <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button> -->
                </div>
                <form class="form-horizontal personal-info-css" id="approve_appointmentinfo-form">
                    <div class="modal-body">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p>Do you want to APPROVE this appointment?</p>
                                    <input type="hidden" class="appr_appointment_id" name="appr_appointment_id" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="form-group row">       
                            <div class="col-md-12">
                                <button type="button" style="float:right; margin-right:10px;" class="btn btn-default cancelBtn" data-dismiss="modal" aria-label="Close">Cancel</button>
                                <button type="submit" style="float:right; margin-right:10px;" class="btn btn-primary approveApplicationBtn">Approve</button>
                               
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

     <div id="rejectAppointmentModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-m">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="exampleModalLabel" class="modal-title">Reject Appointment</h4>
                    <!-- <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button> -->
                </div>
                <form class="form-horizontal personal-info-css" id="reject_appointmentinfo-form">
                    <div class="modal-body">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p>Do you want to REJECT this appointment?</p>
                                    <input type="text" required class="material_josh form-control form-control-success rejection_reason" name="rejection_reason">
                                    <label for="rejection_reason" class="label-material">Please add reason for rejection <span class="text-danger">*</span></label>
                                    <input type="hidden" name="rej_appointment_id" class="rej_appointment_id">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="form-group row">       
                            <div class="col-md-12">
                                <button type="submit" style="float:right" class="btn btn-danger rejectApplicationBtn">Reject</button>
                                <button type="button" style="float:right; margin-right:10px;" class="btn btn-default cancelBtn" data-dismiss="modal" aria-label="Close">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="deleteAppointmentModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
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
                                    <p>Are you sure you want to delete this appointment?</p>
                                    <input type="hidden" class="del_appointment_id" name="del_appointment_id" value="">
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
<script type="text/javascript" src="<?=base_url('assets/js/branch_admin/transactions/appointment.js');?>"></script>

