<style type="text/css">
    .or-label{
        font-size: 11px;
        font-family: Monospace, sans serif;
        font-color:black;
    }
    .with-linebreak{
        border-bottom: dotted black;
    }
    #official_receipt{
        padding: 30px ;
    }
    .form_logo{
        height: 100px;
        width: 100px;
    }
    .receipt_logo{
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    .backdrop{
        position: fixed;
        top: 0px;
        left: 0px;
        z-index: 999;
        height: 100%;
        width: 100%;
        background: rgba(0, 0, 0, 0.2);
        display: none;
    }
    .scan_barcode{
        height: 250px;
        width: 300px;
        background-color: white;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translateX(-50%) translateY(-50%);
    }
    .modal { overflow: auto !important; }

</style>
<!-- change the data-num and data-subnum for numbering of navigation -->
<div class="content-inner" id="pageActive" data-num="2" data-namecollapse="#transaction-collapse" data-labelname="Appointment Application"> 
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Appointment Application</h2>
        </div>
    </header>

    <!-- Breadcrumb-->
    <ul class="breadcrumb">
        <div class="container-fluid">
            <li class="breadcrumb-item active">Transactions</li>
            <li class="breadcrumb-item active">Appointment Application</li>
        </div>
    </ul>
    <section class="tables mouse_tracker">   
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 no-padding">
                    <div class="card">
                        <div class="">
                            <div class="card-header d-flex align-items-center">
                                <div class="col-lg-12">
                                    <h1>Appointment Application</h1>
                                    <button type="button" style="float:right; margin-right:10px;" class="btn btn-primary btnScanQrCode">Scan QR Code</button>
                                    <br><br>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label col-form-label-sm">Appoinment Date</label>
                                                 <div class="row">
                                                    <div class="input-daterange input-group" id="datepicker">
                                                        <input type="text" data-column="0" class="input-sm form-control material_josh search-input-select searchDate searchDateFrom" name="start" value="<?=today_date();?>" />
                                                        <span class="input-group-addon" style="background-color:#fff0 ; border:none; padding:10px !important;">to</span>
                                                        <input type="text" data-column="1" class= "input-sm form-control material_josh search-input-select searchDate2 searchDateTo" name="end" value="<?=today_date();?>" />
                                                    </div>
                                                 </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-control-label col-form-label-sm">Appointment Reference Number</label>
                                                <input type="text" data-column="2"  class="input-sm form-control material_josh form-control-sm search-input-text searchRefNum" placeholder="Reference Number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">       
                                        <div class="col-md-12">
                                           <button type="button" style="float:right; margin-right:10px;" class="btn btn-primary filterBtn">Filter</button>
                                        </div>
                                        <div class="col-md-12">
                                     
                                        </div>
                                    </div>
                                    <br>
                                    <div class="table-responsive table_applicant" style="display:none">
                                        <table class="table  table-striped table-hover table-bordered" id="table-grid"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%" >
                                            <thead>
                                                <tr>
                                                    <th>Email</th>
                                                    <th>Reference No</th>
                                                    <th>Appointment Branch</th>
                                                    <th>Appointment Date</th>
                                                    <th>Time</th>
                                                    <th>Category</th>
                                                    <th>Payment Status</th>
                                                    <th width="70" style="text-align: center;">Action</th>
                                                </tr>
                                            </thead>
                                        </table>	
                                    </div>
                                </div>
                                <div class="backdrop" id="backdrop">
                                    <div class="scan_barcode text-center" style="padding:20px;">
                                        <i class="fa fa-qrcode" style="font-size:120px;color:lightblue"></i>
                                        <h4>Scan QR Code from Application Form</h4>
                                        <br>
                                        <button class="btn btn-primary btnStopScan">Close</button>
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
                    <h4 id="exampleModalLabel" class="modal-title">View Applications</h4>
                    <!-- <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button> -->
                </div>
                    <div class="modal-body">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="">
                                        <div class="appearance_note alert alert-success" role="alert" style="display:none; padding:10px;margin-right:15px"></div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-8 has-shadow" style="border:solid">
                                                            <form class="form-horizontal personal-info-css" id="viewApplicationDetails" style="padding:10px">
                                                                <div class="row">
                                                                    <div class="col-md-9 col-sm-9">
                                                                        <div class="form-group row">
                                                                            <div class="col-md-3 col-sm-4">
                                                                                <img src="<?=base_url()."assets/img/immigration_logo.png"?>"  class ="form_logo">
                                                                            </div>
                                                                            <div class="col-md-9 col-sm-7">
                                                                                <h4 style="margin-top: 10px">Bureau of Immigration</h4>
                                                                                <h5 style="margin-top: 10px">Alien Census Registration System</h5>
                                                                            </div>    
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-3" style="padding:10px;">
                                                                        <img src="" class="img-fluid qr_code_img" style="width: 100px;height: 100px;float:right">
                                                                    </div> 
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6 col-sm-6">
                                                                        <div class="form-group row no-margin-bottom">
                                                                            <label class="col-md-6 col-sm-3 form-control-label"><strong>Reference No:</strong></label>
                                                                            <label class="col-md-6 col-sm-3 form-control-label refNospan"></label>
                                                                        </div>
                                                                        <div class="form-group row no-margin-bottom">
                                                                            <label class="col-md-6 col-sm-6 form-control-label"><strong>E-Receipt No:</strong></label>
                                                                            <label class="col-md-6 col-sm-6 form-control-label e-receipt_no"></label>
                                                                        </div> 
                                                                        <input type="hidden" class="app_id" name="app_id">                        
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-md-6 col-sm-6">
                                                                        <div class="form-group row no-margin-bottom">
                                                                            <label class="col-md-6 col-sm-6 form-control-label"><strong>Application Date:</strong></label>
                                                                            <label class="col-md-6 col-sm-6 form-control-label sum_application_date" data-value=""></label>
                                                                        </div>  
                                                                        <div class="form-group row no-margin-bottom">
                                                                            <label class="col-md-6 col-sm-6 form-control-label"><strong>Process Lane:</strong></label>
                                                                            <label class="col-md-6 col-sm-6 form-control-label sum_process_lane" data-value=""></label>
                                                                        </div>   
                                                                        <div class="form-group row no-margin-bottom">
                                                                            <label class="col-md-6 col-sm-6 form-control-label"><strong>Application Category:</strong></label>
                                                                            <label class="col-md-6 col-sm-6 form-control-label sum_app_cat" data-value=""></label>
                                                                        </div>   
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-6">
                                                                        <div class="form-group row no-margin-bottom">
                                                                            <label class="col-md-3 col-sm-6 form-control-label"><strong>Branch:</strong></label>
                                                                            <label class="col-md-9 col-sm-6 form-control-label sum_branch_name" data-value=""></label>
                                                                        </div>

                                                                        <div class="form-group row no-margin-bottom">
                                                                            <label class="col-md-6 col-sm-6 form-control-label"><strong>Appointment Date:</strong></label>
                                                                            <label class="col-md-6 col-sm-6 form-control-label sum_app_date" data-value=""></label>
                                                                        </div> 

                                                                        <div class="form-group row">
                                                                            <label class="col-md-6 col-sm-6 form-control-label"><strong>Time:</strong></label>
                                                                            <label class="col-md-6 col-sm-6 form-control-label sum_app_time" data-value=""></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group row no-margin-bottom">
                                                                            <label class="col-md-3 col-sm-6 form-control-label"><strong>Applicant Name:</strong></label>
                                                                            <label class="col-md-6 col-sm-6 form-control-label sum_app_name" data-value=""></label>
                                                                        </div>
                                                                        <div class="form-group row no-margin-bottom">
                                                                            <label class="col-md-3 col-sm-6 form-control-label"><strong>ACR I-Card No:</strong></label>
                                                                            <label class="col-md-6 col-sm-6 form-control-label sum_icard" data-value=""></label>
                                                                        </div>

                                                                        <div class="form-group row no-margin-bottom">
                                                                            <label class="col-md-3 col-sm-6 form-control-label"><strong>Alias1:</strong></label>
                                                                            <label class="col-md-3 col-sm-6 form-control-label sum_alias1" data-value=""></label>

                                                                            <label class="col-md-3 col-sm-6 form-control-label"><strong>Alias2:</strong></label>
                                                                            <label class="col-md-3 col-sm-6 form-control-label sum_alias2" data-value=""></label>
                                                                        </div>

                                                                        <div class="form-group row no-margin-bottom"> 
                                                                            <label class="col-md-3 col-sm-6 form-control-label"><strong>Birthdate:</strong></label>
                                                                            <label class="col-md-3 col-sm-6 form-control-label sum_bday" data-value=""></label>

                                                                            <label class="col-md-3 col-sm-6 form-control-label"><strong>Age:</strong></label>
                                                                            <label class="col-md-3 col-sm-6 form-control-label sum_age" data-value=""></label>
                                                                        </div>

                                                                        <div class="form-group row no-margin-bottom">
                                                                            <label class="col-md-3 col-sm-6 form-control-label"><strong>Gender:</strong></label>
                                                                            <label class="col-md-3 col-sm-6 form-control-label sum_gender" data-value=""></label>

                                                                            <label class="col-md-3 col-sm-6 form-control-label"><strong>Civil Status:</strong></label>
                                                                            <label class="col-md-3 col-sm-6 form-control-label sum_civilstatus" data-value=""></label>
                                                                        </div>

                                                                        <div class="form-group row no-margin-bottom">
                                                                            <label class="col-md-3 col-sm-6 form-control-label"><strong>Country of Birth:</strong></label>
                                                                            <label class="col-md-3 col-sm-6 form-control-label sum_country" data-value=""></label>

                                                                            <label class="col-md-3 col-sm-6 form-control-label"><strong>Nationality:</strong></label>
                                                                            <label class="col-md-3 col-sm-6 form-control-label sum_nationality" data-value=""></label>
                                                                        </div>
                                                                        <div class="form-group row no-margin-bottom">
                                                                            <label class="col-md-3 col-sm-6 form-control-label"><strong>Passport No:</strong></label>
                                                                            <label class="col-md-4 col-sm-6 form-control-label sum_passport" data-value=""></label>
                                                                        </div>
                                                                        <div class="form-group row no-margin-bottom">
                                                                            <label class="col-md-3 col-sm-6 form-control-label"><strong>Place of Issuance:</strong></label>
                                                                            <label class="col-md-3 col-sm-6 form-control-label sum_issuance_place" data-value=""></label>

                                                                            <label class="col-md-3 col-sm-6 form-control-label"><strong>Date of Issuance:</strong></label>
                                                                            <label class="col-md-3 col-sm-6 form-control-label sum_issuance_date" data-value=""></label>
                                                                        </div>
                                                                        <div class="form-group row no-margin-bottom">
                                                                            <label class="col-md-3 col-sm-6 form-control-label"><strong>Expiry Date:</strong></label>
                                                                            <label class="col-md-3 col-sm-6 form-control-label sum_expiry_date" data-value=""></label>

                                                                            <label class="col-md-3 col-sm-6 form-control-label"><strong>Date of Latest Arrival:</strong></label>
                                                                            <label class="col-md-3 col-sm-6 form-control-label sum_arrival_date" data-value=""></label>
                                                                        </div>                                                                
                                                                        <div class="form-group row no-margin-bottom">
                                                                            <label class="col-md-3 col-sm-6 form-control-label"><strong>Mobile:</strong></label>
                                                                            <label class="col-md-3 col-sm-6 form-control-label sum_mobile" data-value=""></label>

                                                                            <label class="col-md-3 col-sm-6 form-control-label"><strong>Landline:</strong></label>
                                                                            <label class="col-md-3 col-sm-6 form-control-label sum_landline" data-value=""></label>
                                                                        </div>
                                                                        <hr>  
                                                                        <div class="form-group row no-margin-bottom">         
                                                                            <label class="col-md-6 col-sm-6 form-control-label"><strong>Residential Address in the Philippines:</strong></label>
                                                                            <label class="col-md-6 col-sm-6 form-control-label sum_ph_addrs" data-value=""></label>
                                                                        </div>                                                                
                                                                        <div class="form-group row no-margin-bottom">
                                                                            <label class="col-md-6 col-sm-6 form-control-label"><strong>Residential Address Abroad:</strong></label>
                                                                            <label class="col-md-6 col-sm-6 form-control-label sum_ab_addrs" data-value=""></label>
                                                                        </div>
                                                                        <hr>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="col-md-4" >
                                                            <div id="official_receipt" style="border:solid">  
                                                                <div class="form-group row">
                                                                    <div class="receipt_logo">   
                                                                        <img src="<?=base_url()."assets/img/immigration_logo.png"?>" style="width: 100px; height: 100px;" class="" >
                                                                    </div>
                                                                </div>
                                                                <div class="form-group-row text-center">    
                                                                    <strong><p class="no-margin-bottom or-label" style="letter-spacing: 1px;font-size: 14px">BUREAU OF IMMIGRATION</p></strong>
                                                                    <strong><p class="no-margin-bottom or-label" style="letter-spacing: 1px;font-size: 12px">Alien Census Registration System</p></strong>
                                                                    <label class="or-addrs"></label>
                                                                    <label class="or-label">TIN: 999-994-949</label>
                                                                </div>
                                                                <hr>
                                                                <div class="form-group row text-center">
                                                                    <h4 class="form-control-label col-md-12 or-label" style="letter-spacing: 1.4px;font-size: 14px">E-RECEIPT</h4>
                                                                </div>                           
                                                                <div class="form-group row no-margin-bottom">
                                                                    <label class="col-md-6 form-control-label or-label">E-RECEIPT #:</label>
                                                                    <label class="text-right col-md-6 form-control-label e-receipt_no or_no or-label"></label>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-md-6 col-sm-5 form-control-label or-label">ISSUED DATE:</label>
                                                                    <label class="text-right col-md-6 col-sm-7 form-control-label or-label sum_application_date"></label>
                                                                </div>

                                                                <div class="form-group row no-margin-bottom ">
                                                                    <label class="col-md-5 form-control-label or-label">PAYOR:</label>
                                                                    <label class="text-right col-md-7 form-control-label payor or-label sum_app_name"></label>
                                                                </div>    

                                                                <div class="form-group row">
                                                                    <label class="col-md-5 form-control-label or-label"></label>
                                                                    <label class="text-right col-md-7 form-control-label payor or-label sum_country"></label>
                                                                </div>


                                                                <div class="form-group row no-margin-bottom ">
                                                                    <label class="col-md-6 form-control-label or-label ">ASSESSMENT</label>
                                                                    <label class="text-right col-md-6 form-control-label or-label ">AMOUNT</label>
                                                                </div>   

                                                                <div class="form-group row no-margin-bottom">
                                                                    <label class="col-md-6 form-control-label or-label">APPLICATION FEE:</label>
                                                                    <label class="text-right col-md-6 form-control-label rcpt_app_fee or-label with-linebreak rcpt_amount">&#8369; </label>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-md-5 form-control-label or-label">AMOUNT DUE: </label>
                                                                    <label class="text-right col-md-7 form-control-label rcpt_amount or-label">&#8369;</label>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-md-5 form-control-label or-label">REFERENCE#</label>
                                                                    <label class="text-right col-md-7 form-control-label refNospan or-label"></label>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                          <!--   <a class="btn btn-primary" id="btnPDF">Download as PDF</a> -->
                                                        </div>
                                                    </div>
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
                            <button type="button" style="float:right; margin-right:10px;" id="cancelBtn" class="btn btn-default cancelBtn" data-dismiss="modal" aria-label="Close">Back</button>
                            <button type="button" style="float:right; margin-right:10px;" class="btn btn-primary goToConfirmAppearanceModalBtn">Confirm Appearance</button>
                           <!--  <button type="button" style="float:right; margin-right:10px;" class="btn btn-danger goToRejectModalApplicationBtn">Reject</button>
                            <button type="button" style="float:right; margin-right:10px;"  class="btn btn-primary goToEditModalAccountsBtn">Approve</button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="uploadedImagesModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-m modal-m-custom">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="exampleModalLabel" class="modal-title">Uploaded Requirements</h4>
                    <!-- <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button> -->
                </div>

                <div class="modal-body">
                    <div class="">
                        <div class="row">
                            <div class="col-lg-12 text-center uploaded_images_container">
                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="form-group row">       
                        <div class="col-md-12">
                            <button type="button" style="float:right; margin-right:10px;" class="btn btn-default cancelBtn" data-dismiss="modal" aria-label="Close">Close</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    
    <div id="confirmAppearanceModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="exampleModalLabel" class="modal-title">Approve Application</h4>
                    <!-- <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button> -->
                </div>
                <form class="form-horizontal personal-info-css" id="approve_applicationinfo-form">
                    <div class="modal-body">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p>You are trying to confirm that this applicant has personally appeared in your office. Click "Confirm" to proceed.</p>
                                    <input type="hidden" id="inputHorizontalWarning" class="appr_application_id" name="appr_application_id" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="form-group row">       
                            <div class="col-md-12">
                                <button type="button" style="float:right;" class="btn btn-default closeConfirmApperanceModal" aria-label="Close">Cancel</button>
                                <button type="submit" style="float:right;margin-right:10px;" class="btn btn-primary confiemAppearanceBtn">Confirm</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

     <div id="rejectApplicationModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="exampleModalLabel" class="modal-title">Reject Application</h4>
                    <!-- <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button> -->
                </div>
                <form class="form-horizontal personal-info-css" id="reject_applicationinfo-form">
                    <div class="modal-body">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p>Do you want to REJECT this application?</p>
                                    <input type="text" required class="material_josh form-control form-control-success rejection_reason" name="rejection_reason">
                                    <label for="register-firstname" class="label-material">Please add reason for rejection <span class="text-danger">*</span></label>
                                    <input type="hidden" name="rej_application_id" class="rej_application_id">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="form-group row">       
                            <div class="col-md-12">
                                <button type="submit" style="float:right" class="btn btn-primary rejectApplicationBtn">Reject</button>
                                <button type="button" style="float:right; margin-right:10px;" class="btn btn-default cancelBtn" data-dismiss="modal" aria-label="Close">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php $this->load->view('includes/footer');?> <!-- includes your footer -->
<script type="text/javascript" src="<?=base_url('assets/js/admin/transactions/applications.js');?>"></script>

