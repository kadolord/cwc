<!-- change the data-num and data-subnum for numbering of navigation -->
<div class="content-inner" id="pageActive" data-num="2" data-namecollapse="#transaction-collapse" data-labelname="Application"> 
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Applications</h2>
        </div>
    </header>

    <!-- Breadcrumb-->
    <ul class="breadcrumb">
        <div class="container-fluid">
            <li class="breadcrumb-item active">Transactions</li>
            <li class="breadcrumb-item active">Applications</li>
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
                                     <h1>Applications</h1><br>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label col-form-label-sm">Date</label>
                                                 <div class="row">
                                                    <div class="input-daterange input-group" id="datepicker">
                                                        <input type="text" data-column="0" class="input-sm form-control material_josh search-input-select searchDate searchDateFrom" name="start" value="<?=today_date();?>" />
                                                        <span class="input-group-addon" style="background-color:#fff0 ; border:none;">to</span>
                                                        <input type="text" data-column="1" class= "input-sm form-control material_josh search-input-select searchDate2 searchDateTo" name="end" value="<?=today_date();?>" />
                                                    </div>
                                                 </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-control-label col-form-label-sm">Application Reference Number</label>
                                                <input type="text" data-column="2"  class="form-control material_josh form-control-sm search-input-text searchRefNum" placeholder="Reference Number">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label col-form-label-sm">Application Status</label>
                                                <select data-column="3" class="form-control-sm search-input-select select2 searchAppStatus">
                                                    <option selected  hidden value="">--Select Application Category--</option>
                                                    <?php foreach ($get_app_status->result() as $stat): ?>
                                                        <?php if( $stat->status_id == 0 || $stat->status_id == 1): ?>
                                                        <option value="<?php echo $stat->status_id; ?>"><?php echo $stat->status_description; ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>;
                                                </select>
                                               <!--  <input type="text" data-column="3"  class="form-control material_josh form-control-sm search-input-text searchAppStatus" placeholder="Application Status"> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">       
                                        <div class="col-md-12">
                                           <button type="button" style="float:right; margin-right:10px;" class="btn btn-primary filterBtn">Filter</button>
                                        </div>
                                    </div>
                                     <br>
                                    <div class="table-responsive">
                                        <table class="table  table-striped table-hover table-bordered" id="table-grid"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Applicant Email</th>
                                                    <th>Application Date</th>
                                                    <th>Application Reference No</th>
                                                    <th>Application Status</th>
                                                    <th>Application Type</th>
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
                <form class="form-horizontal personal-info-css" id="view_accountspersonalinfo-form">
                    <div class="modal-body">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="">
                                        <div class="card-body">

                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Reference No.</label>
                                                
                                                <div class="col-md-4">
                                                    <input disabled id="inputHorizontalWarning" type="text" class="form-control info_app_ref_number" name="info_app_ref_number">
                                                </div>
                                            </div>

                                            <div class="form-group row">

                                                <label class="col-md-2 form-control-label">Applicant Name</label>
                                                <div class="col-md-4">
                                                    <input disabled id="inputHorizontalWarning" type="text" class="form-control info_app_name" name="info_app_name">
                                                </div>

                                                <label class="col-md-2 form-control-label">Applicant Email</label>
                                                <div class="col-md-4">
                                                    <input disabled id="inputHorizontalWarning" type="text" class="form-control info_app_id" name="info_app_id">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Application Date</label>
                                                <div class="col-md-4">
                                                    <input disabled id="inputHorizontalWarning" type="text" class="form-control datepicker info_app_date" name="info_app_date" placeholder="mm/dd/yyyy">
                                                </div>
                                           
                                                 <label class="col-md-2 form-control-label">Application Fee</label>
                                                <div class="col-md-4">
                                                    <input disabled id="inputHorizontalWarning" type="text" class="form-control info_app_fee" name="info_app_fee">
                                                </div>
                                            </div>

                                     <!--        <div class="form-group row">
                                                 <label class="col-md-2 form-control-label">Submitted Requiremen</label>
                                                <div class="col-md-4">
                                                    <a href="" class='uploaded_images'><input id="inputHorizontalWarning" type="text" class="form-control info_app_req" name="info_app_req"></a>
                                                </div>
                                            </div>
 -->
                                            <div class="form-group row">
                                                
                                                    <label class="col-md-2 form-control-label">Application Status</label>
                                                    <div class="col-md-4">
                                                         <input disabled id="inputHorizontalWarning" type="text" class="form-control form-control-success info_app_status" name="info_app_status">
                                                    </div>
                                                    
                                                    <label class="col-md-2 form-control-label rejection_reason_div">Rejection Reason</label>
                                                    <div class="col-md-4 rejection_reason_div">
                                                         <input disabled id="inputHorizontalWarning" type="text" class="form-control form-control-success info_app_rej_reason" name="info_app_rej_reason">
                                                    </div>
                                                   
                                                <label class="col-md-2 form-control-label">Application Type</label>
                                                <div class="col-md-4">
                                                     <input disabled id="inputHorizontalWarning" type="text" class="form-control form-control-success info_app_type" name="info_app_type">
                                                </div>
                                            </div>  

                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Uploaded Documents</label>
                                            </div> 
                                            <hr> 

                                            <div class="form-group row uploaded_docs">
                                                
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
                                <button type="button" style="float:right; margin-right:10px;" class="btn btn-default cancelBtn" data-dismiss="modal" aria-label="Close">Back</button>
                                <button type="button" style="float:right; margin-right:10px;" class="btn btn-danger goToRejectModalApplicationBtn">Reject</button>
                                <button type="button" style="float:right; margin-right:10px;"  class="btn btn-primary goToEditModalAccountsBtn">Approve</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="uploadedImagesModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-lg modal-lg-custom">
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

    
    <div id="approveApplicationModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
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
                                    <p>Do you want to APPROVE this application?</p>
                                    <input type="hidden" id="inputHorizontalWarning" class="appr_application_id" name="appr_application_id" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="form-group row">       
                            <div class="col-md-12">
                                <button type="submit" style="float:right" class="btn btn-primary approveApplicationBtn">Approve</button>
                                <button type="button" style="float:right; margin-right:10px;" class="btn btn-default cancelBtn" data-dismiss="modal" aria-label="Close">Cancel</button>
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
                                    <p>Are you sure you want to delete this application <br>(<span class="reference_del"></span>) ?</p>
                                    <input type="hidden" class="del_application_id" name="del_application_id" value="">
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
<script type="text/javascript" src="<?=base_url('assets/js/admin/transactions/applications.js');?>"></script>

