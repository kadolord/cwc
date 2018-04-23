<!-- change the data-num and data-subnum for numbering of navigation -->
<style type="text/css">
    .dataTables_filter{ display: none; }
</style>

<div class="content-inner" id="pageActive" data-num="4" data-namecollapse="#settings-collapse" data-labelname="Reschedule Fee And Limit"> 
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Reschedule Fee and Limit</h2>
        </div>
    </header>

    <!-- Breadcrumb-->
    <ul class="breadcrumb">
        <div class="container-fluid">
            <li class="breadcrumb-item active">Settings</li>
            <li class="breadcrumb-item active">Reschedule Fee And Limit</li>
        </div>
    </ul>
   <!--  <section class="tables">   
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h1>Reschedule Fee and Limit</h1><br>
                            <button data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#addReschedModal" class="btn btn-primary btnUpdate btnTable btnClickAddResched" id="btnClickAddResched" name="update" style="right:20px; position: absolute; top:20px;">Add Reschedule Fee and Limit</button>
                            <br><br><br>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-bordered" id="table-grid"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Reschedule Limit</th>
                                            <th>Reschedule Fee</th>
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
    </section> -->

    <?php if($resched_fee_already_set): ?>
            <section class="tables">   
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9 no-padding">
                    <div class="card">
                        <div class="card-body">
                            <h1>Reschedule Fee and Limit</h1><br>
                            <form class="form-horizontal personal-info-css" id="view_resched-form">
                                
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label">Reschedule Limit<span hidden class="asterisk" style="color:red">*</span></label>
                                    <div class="col-md-4">
                                        <input disabled required id="inputHorizontalWarning" type="text" class="form-control form-control-warning view_resched_limit" name="view_resched_limit" value="<?php echo $resched_fee_details->resched_limit; ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label">Reschedule Fee<span hidden class="asterisk" style="color:red">*</span></label>
                                    <div class="col-md-4">
                                        <input  disabled  id="inputHorizontalWarning" type="text" class="form-control form-control-warning view_resched_fee" name="view_resched_fee" value="<?php echo "₱ ".number_format($resched_fee_details->resched_fee,2); ?>">

                                        <input hidden required id="inputHorizontalWarning" type="number" class="form-control form-control-warning view_resched_fee2" name="view_resched_fee2" value="<?php echo $resched_fee_details->resched_fee; ?>">

                                        <input hidden required id="inputHorizontalWarning" type="text" class="form-control form-control-warning view_resched_id" name="view_resched_id" value="<?php echo $resched_fee_details->resched_id; ?>">
                                    </div>
                                </div>                                

                                <div class="form-group row">       
                                    <div class="col-md-12">
                                        <input type="submit" style="float:right" value="Update" class="btn btn-primary">
                                        <button hidden type="button" style="float:right" class="btn btn-success saveEditBtn ">Save</button>
                                        <button hidden type="button" style="float:right; margin-right:10px;" class="btn btn-default cancelEditBtn">Cancel</button>
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
        <form class="form-horizontal personal-info-css" id="add_resched-form">
            <div class="modal-body">
                <div class="">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="">
                                <div class="card-body">
                                    <div class="form-group row">    
                                        <label class="col-md-3 form-control-label">Reschedule Limit <span class="asterisk" style="color:red">*</span></label>
                                        <div class="col-md-9">
                                            <input required id="inputHorizontalWarning" type="number" class="form-control form-control-warning tba_resched_limit" name="tba_resched_limit">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label">Reschedule Fee <span class="asterisk" style="color:red">*</span></label>
                                        <div class="col-md-9">
                                            <input required id="inputHorizontalWarning" type="number" class="form-control form-control-warning tba_resched_fee" name="tba_resched_fee">
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
                        <button type="button" style="float:right" class="btn btn-success saveBtnResched">Add</button>
                        <button type="button" style="float:right; margin-right:10px;" class="btn btn-default cancelBtn" data-dismiss="modal" aria-label="Close">Close</button>
                    </div>
                </div>
            </div>
        </form>
    <?php endif; ?>

    <!-- Modal-->
    <div id="addReschedModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-lg modal-lg-custom">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="exampleModalLabel" class="modal-title">Add Reschedule Fee/Limit</h4>
                    <!-- <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button> -->
                </div>
                <form class="form-horizontal personal-info-css" id="add_resched-form">
                    <div class="modal-body">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="">
                                        <div class="card-body">
                                            <div class="form-group row">    
                                                <label class="col-md-3 form-control-label">Reschedule Limit <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-9">
                                                    <input required id="inputHorizontalWarning" type="number" class="form-control form-control-warning tba_resched_limit" name="tba_resched_limit">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label">Reschedule Fee <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-9">
                                                    <input required id="inputHorizontalWarning" type="number" class="form-control form-control-warning tba_resched_fee" name="tba_resched_fee">
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
                                <button type="button" style="float:right" class="btn btn-success saveBtnResched">Add</button>
                                <button type="button" style="float:right; margin-right:10px;" class="btn btn-default cancelBtn" data-dismiss="modal" aria-label="Close">Close</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="viewReschedModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-lg modal-lg-custom">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="exampleModalLabel" class="modal-title">View Reschedule Fee / Limit</h4>
                </div>
                <form class="form-horizontal personal-info-css" id="view_resched-form">
                    <div class="modal-body">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="">
                                        <div class="card-body">

                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label">Reschedule Limit</label>
                                                <div class="col-md-9">
                                                    <input disabled required id="inputHorizontalWarning" type="text" class="form-control form-control-warning view_resched_limit" name="view_resched_limit">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label">Reschedule Fee</label>
                                                <div class="col-md-9">
                                                    <input  disabled required id="inputHorizontalWarning" type="text" class="form-control form-control-warning view_resched_fee" name="view_resched_fee">
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
                                <button type="button" style="float:right" class="btn btn-primary goToEditModalReschedBtn">Edit</button>
                                <button type="button" style="float:right; margin-right:10px;" class="btn btn-default cancelBtn" data-dismiss="modal" aria-label="Close">Back</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="editReschedModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-lg modal-lg-custom">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="exampleModalLabel" class="modal-title">Edit Rechedule Fee / Limit</h4>
                    <!-- <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button> -->
                </div>
                <form class="form-horizontal personal-info-css" id="edit_resched-form">
                    <div class="modal-body">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label">Reschedule Limit <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-9">
                                                    <input type="hidden" name="tbe_resched_id" class="tbe_resched_id">
                                                    <input required id="inputHorizontalSuccess" type="number" class="form-control form-control-success tbe_resched_limit" name="tbe_resched_limit">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label">Reschedule Fee <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-9">
                                                    <input required id="inputHorizontalWarning" type="number" class="form-control form-control-warning tbe_resched_fee" name="tbe_resched_fee">
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

    <div id="deleteReschedModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="exampleModalLabel" class="modal-title">Delete Resched Limit / Fee</h4>
                </div>
                <form class="form-horizontal personal-info-css" id="delete_resched-form">
                    <div class="modal-body">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p>Are you sure you want to delete this record?</p>
                                    <input type="hidden" class="del_resched_id" name="del_resched_id" value="">                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="form-group row">       
                            <div class="col-md-12">
                                <button type="submit" style="float:right" class="btn btn-primary deleteReschedBtn">Delete</button>
                                <button type="button" style="float:right; margin-right:10px;" class="btn btn-default cancelBtn" data-dismiss="modal" aria-label="Close">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


<?php $this->load->view('includes/footer');?> <!-- includes your footer -->
<script type="text/javascript" src="<?=base_url('assets/js/admin/settings/reschedule.js');?>"></script>

