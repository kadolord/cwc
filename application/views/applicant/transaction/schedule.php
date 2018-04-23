<!-- change the data-num and data-subnum for numbering of navigation -->
<div class="content-inner" id="pageActive" data-num="2" data-namecollapse="#transaction-collapse" data-labelname="Schedule / Reschedule"> 
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Schedule Appointment</h2>
        </div>
    </header>

    <!-- Breadcrumb-->
    <ul class="breadcrumb">
        <div class="container-fluid">
            <li class="breadcrumb-item active">Transaction</li>
            <li class="breadcrumb-item active">Schedule / Reschedule</li>
        </div>
    </ul>
    <?php if($hasAppointment == true): ?>
    <section class="tables">   
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 no-padding">
                    <div class="card">
                        <div class="card-header d-flex align-items-center">
                            <h3 class="h4">Scheduled Appointment Details</h3>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal personal-info-css" id="viewApplicationDetails">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-2 form-control-label">Reference No. </label>
                                            <div class="col-md-4">
                                                <input disabled id="inputHorizontalWarning" type="text" class="form-control info_app_ref_number" name="info_app_ref_number" value="<?php echo $appointment_info->app_reference_no; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 form-control-label">Appointment Date </label>
                                            <div class="col-md-4">
                                                <input disabled id="inputHorizontalWarning" type="text" class="form-control datepicker info_app_date" name="info_app_date" value = "<?php echo $appointment_info->appointment_datesched; ?>">
                                            </div>
                                        </div> 
                                         <div class="form-group row">
                                             <label class="col-md-2 form-control-label">Appointment Time</label>
                                            <div class="col-md-4">
                                                <input disabled id="inputHorizontalWarning" type="text" class="form-control info_app_time" value = "<?php echo $appointment_info->timesched_description; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-2 form-control-label">Appointment Branch Name</label>
                                            <div class="col-md-4">
                                                <input disabled id="inputHorizontalWarning" type="text" class="form-control info_app_branch" value = "<?php echo $appointment_info->branch_name; ?>">
                                            </div>
                                        </div> 
                                        <?php if($appointment_info->is_rescheduled_counter <= $resched_limit): ?>
                                        <div class="form-group row">       
                                            <div class="col-md-12">
                                                <button type="submit" style="float:right; margin-right:10px;" id= 'goToReschedConfirmModal' class="btnSched btn btn-primary">Reschedule</button>
                                            </div>
                                        </div>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <?php else: ?>

        <?php if($isAlreadyApplied): ?>

        <section class="tables">   
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card"><br>
                            <div class="d-flex align-items-center">
                                <div class="col-md-12">
                                    <form id='schedForm'>
                                        <div class="form-group row">
                                            <div class="col-md-5">
                                                <div class="form-group-material">
                                                    <label for="sec-oldpass" class="label-material">Select Branch</label>
                                                    <select data-column="2" class="form-control search-input-select select2 branch_name2" name="branch_name" id="branch_name">
                                                        <option value="" selected disabled hidden>-- Select Branch --</option>
                                                        <?php foreach($centers->result() as $gc){  ?>
                                                            <option value="<?=$gc->branch_id?>"><?=$gc->branch_name?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-3">
                                                <div class="form-group-material">
                                                    <label for="datepicker" class="label-material">Select Date</label>
                                                    <input type="text" name="appointment-date" required=""  class="input-material appointment-date datepicker3">
                                                </div>
                                            </div>
                                           
                                            <div class="col-md-4">
                                                <div class="form-group-material">
                                                    <label  class="label-material">Select Time</label><br>
                                                     <select data-column="2" class="form-control search-input-select select2 tba_appointment-time" name="appointment-time">
                                                    </select>
                                                </div>
                                            </div>
                                         </div> 

                                        <div class="form-group row">       
                                            <div class="col-md-12">
                                                <button type="submit" style="float:right; margin-right:10px;" id= 'btnSched'class="btnSched btn btn-primary">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php else: ?>
        <section class="tables">   
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class=""><br>
                            <div class="d-flex align-items-center">
                                <div class="col-md-12">
                                    <h4>You need to <a href="<?=base_url('Main/view_application/'.$token);?>">apply first</a> before you can schedule an appointment.</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
            
        <?php endif; ?>

    <?php endif; ?>


    <div id="confirmAppointmentModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-m">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="exampleModalLabel" class="modal-title">Confirm Appointment</h4>
                </div>
                <form class="form-horizontal personal-info-css" id="delete_appointmentinfo-form">
                    <div class="modal-body">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p class = "confirm_appointment"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group row">       
                            <div class="col-md-12">
                                <button type="submit" style="float:right" class="btn btn-primary saveAppointmentBtn">Save</button>
                                <button type="button" style="float:right; margin-right:10px;" class="btn btn-default cancelBtn" data-dismiss="modal" aria-label="Close">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="confirmReschedModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="exampleModalLabel" class="modal-title">Confirm Reschedule</h4>
                </div>
                <form class="form-horizontal personal-info-css" id="delete_appointmentinfo-form">
                    <div class="modal-body">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p id="confirmResched"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group row">       
                            <div class="col-md-12">
                                <button type="submit" style="float:right" class="btn btn-danger gotoReschedStepModal">Proceed</button>
                                <button type="button" style="float:right; margin-right:10px;" class="btn btn-default cancelBtn" data-dismiss="modal" aria-label="Close">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>    

    <div id="reschedStepModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="exampleModalLabel" class="modal-title">Reschedule Process</h4>
                     <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                </div>
                    <div class="modal-body">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <section class="tables">   
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-progress">
                                                            <div class="card-header d-flex align-items-center">
                                                                <div class="col-lg-12">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                                <h3 class="search_label" style="text-align: right;"></h3>
                                                                                <h3 class="step_label">Step 1 to 5</h3>
                                                                                <div class="progress" style="margin-top: 10px;">
                                                                                    <!-- progress-bar-animated -->
                                                                                    <div class="progress-bar progress-bar-striped bg-success" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 20%;  height: 25px; transition:none;"></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12" style="padding-bottom: 30px;">
                                                            <div class="card-progress">
                                                                <form id="reload-form" class="formViolator"> 
                                                                    <br>
                                                                    <div class="col-lg-12">
                                                                        <div class="step1">
                                                                            <div class="form-group">
                                                                                <label for="sec-oldpass" class="label-material">Select Branch<span class="asterisk" style="color:red">*</span></label>
                                                                                <select class="form-control search-input-select select2 branch_name" name="branch_name">
                                                                                   
                                                                                    <option value="" selected disabled hidden>-- Select Branch --</option>
                                                                                    <?php foreach($centers->result() as $gc):  ?>
                                                                                        <option value="<?=$gc->branch_id?>"><?=$gc->branch_name?></option>
                                                                                    <?php endforeach;?>
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="datepicker" class="label-material">Select Date<span class="asterisk" style="color:red">*</span></label>
                                                                                <input id="datepicker" type="text" name="appointment-date" required value="" class="input-material appointment-date datepicker2">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                 <label for="datepicker" class="label-material">Select Time<span class="asterisk" style="color:red">*</span></label><br>
                                                                                 <select data-column="2" class="form-control search-input-select select2 appointment-time" name="appointment-time">
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <!-- //choose payment transaction -->
                                                                        <div class="step2" style="display: none;">
                                                                            <style type="text/css">
                                                                                .checkbox-template:checked::before, .radio-template:checked::before {
                                                                                    background: #5cb85c;
                                                                                }
                                                                            </style>
                                                                            <div class="row">
                                                                                <div class="box_creditcard col-lg-6" style="border: 1px solid #e6e6e6; text-align: center;">
                                                                                    <label for="creditcard_rBtn">
                                                                                        <img class="img-fluid" src="<?=base_url('assets/img/creditcard.jpg');?>">
                                                                                    </label>
                                                                                    <p style="background-color: #eceeef;padding:16px 10px 10px 10px;">
                                                                                        <input id="creditcard_rBtn" type="radio" value="1" name="a" class="radio-template" checked>
                                                                                        <label for="creditcard_rBtn" style="font-size: 1em;">Credit Card</label> 
                                                                                    </p>
                                                                                </div>
                                                                                
                                                                                <div class="box_debit col-lg-6" style="border: 1px solid #e6e6e6; text-align: center;">
                                                                                    <label for="debit_rBtn">
                                                                                        <img  class="img-fluid" src="<?=base_url('assets/img/debit_overthebank.jpg');?>">
                                                                                    </label>
                                                                                    <p style="background-color: #eceeef;padding:16px 10px 10px 10px;">
                                                                                        <input id="debit_rBtn" type="radio" value="2" name="a" class="radio-template">
                                                                                        <label for="debit_rBtn" style="font-size: 1em;">Debit Card or Over-the-Counter</label>
                                                                                    </p>
                                                                                </div>
                                                                                
                                                                            </div>
                                                                            <br><br>
                                                                        </div>
                                                                        <!-- //end of choose payment transaction -->
                                                                        <div class="step3" style="display: none;">
                                                                            <div class="form-group-material">
                                                                                <br><br>
                                                                                <div class="form-group row">
                                                                                    <label class="col-md-4 form-control-label">Branch Location:</label>
                                                                                    <label class="col-md-24 form-control-label resched_branch" data-value=""></label>
                                                                                </div>

                                                                                <div class="form-group row">
                                                                                    <label class="col-md-4 form-control-label">New Schedule Date:</label>
                                                                                    <label class="col-md-4 form-control-label resched_date" data-value=""></label>
                                                                                </div> 
                                                                                <div class="form-group row">
                                                                                    <label class="col-md-4 form-control-label">New Schedule Time:</label>
                                                                                    <label class="col-md-4 form-control-label resched_time" data-value=""></label>
                                                                                </div> 

                                                                                <div class="form-group row">
                                                                                    <label class="col-md-4 form-control-label">Reschedule Fee:</label>
                                                                                    <label class="col-md-4 form-control-label resched_fee" data-value="<?=$resched_fee ?>"><?php echo "₱ ".number_format($resched_fee,2); ?></label>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="step4" style="display: none;">
                                                                            <div class="form-group">
                                                                                <label class="form-control-label col-form-label-sm">Payment Type</label>
                                                                                <select class="form-control material_josh" name="reload-amt">
                                                                                    <option value="">Debit Card</option>
                                                                                    <option value="">Credit Card</option>
                                                                                    <option value="">Over The Counter</option>
                                                                                </select>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label class="form-control-label col-form-label-sm">Card Name<span hidden class="asterisk" style="color:red">*</span></label>
                                                                                <div class="col-md-14">
                                                                                    <input id="inputHorizontalWarning" type="text" class="form-control form-control-warning material_josh" value="" name="info_address">
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label class="form-control-label col-form-label-sm">Card Number<span hidden class="asterisk" style="color:red">*</span></label>
                                                                                <div class="col-md-14">
                                                                                    <input id="inputHorizontalWarning " type="text" class="form-control form-control-warning material_josh" value="" name="info_address">
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label class="form-control-label col-form-label-sm">CVV No.<span hidden class="asterisk" style="color:red">*</span></label>
                                                                                <div class="col-md-14">
                                                                                    <input id="inputHorizontalWarning " type="text" class="form-control form-control-warning material_josh" value="" name="info_address">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="step5" style="display: none;">
                                                                            <div class="row">
                                                                                <div class="col-sm-12">
                                                                                    <div class="alert alert-success" role="alert">
                                                                                        <div class="form-group">
                                                                                            <br><br>
                                                                                           <label for="reload-notes" class="label-material"><h3>You have successfully rescheduled your appointment </h3>
                                                                                           </label>
                                                                                        </div>
                                                                                        <div class="form-group-material">
                                                                                            
                                                                                            <input type="hidden" class="tbe_app_reference_no" value="<?=$appointment_info->app_reference_no; ?>">

                                                                                            <div class="form-group row">
                                                                                                <label class="col-md-4 form-control-label">Branch Location:</label>
                                                                                                <label class="col-md-24 form-control-label resched_branch" data-value=""></label>
                                                                                            </div>

                                                                                            <div class="form-group row">
                                                                                                <label class="col-md-4 form-control-label">New Schedule Date:</label>
                                                                                                <label class="col-md-4 form-control-label resched_date" data-value=""></label>
                                                                                            </div> 
                                                                                            <div class="form-group row">
                                                                                                <label class="col-md-4 form-control-label">New Schedule Time:</label>
                                                                                                <label class="col-md-4 form-control-label resched_time" data-value=""></label>
                                                                                            </div> 

                                                                                            <div class="form-group row">
                                                                                                <label class="col-md-4 form-control-label">Reschedule Fee:</label>
                                                                                                <label class="col-md-4 form-control-label resched_fee" data-value="<?=$resched_fee ?>"><?php echo "₱ ".number_format($resched_fee,2); ?></label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-12">
                                                                        <button style="float: right;" id="btnVioNext" class="btn btn-primary BtnNext" data-page="0">Next <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                                                                        <button hidden style="float: right;" id="btnVioNext2" class="btn btn-primary BtnNext2" data-page="0">Next <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                                                                        <button hidden style="float: right;" id="btnVioNext3" class="btn btn-primary BtnNext3" data-page="0">Next <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                                                                        <button hidden style="float: right; margin-right:10px;" id="btnVioBack" class="btn btn-danger BtnBack"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button>
                                                                        <button hidden style="float: right; margin-right:10px;" id="btnVioBack2" class="btn btn-danger BtnBack2"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button>
                                                                        <button hidden style="float: right;" id="btnVioProceed" class="btn btn-primary BtnProceed">Save <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                                                                        <button hidden style="float: right; margin-right:10px;" id="btnVioBack3" class="btn btn-danger BtnBack3"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button>
                                                                        <button hidden style="float: right; margin-right:10px;" id="btnVioBack4" class="btn btn-danger BtnBack4"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                        
                    </div>
               
            </div>
        </div>
    </div>

<?php $this->load->view('includes/footer');?> <!-- includes your footer -->
<script type="text/javascript" src="<?=base_url('assets/js/applicant/application/schedule.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/applicant/application/reschedule.js');?>"></script>


