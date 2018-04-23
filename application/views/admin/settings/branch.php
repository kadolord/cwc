<!-- change the data-num and data-subnum for numbering of navigation -->
<div class="content-inner" id="pageActive" data-num="4" data-namecollapse="#settings-collapse" data-labelname="Branch"> 
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Branch</h2>
        </div>
    </header>

    <!-- Breadcrumb-->
    <ul class="breadcrumb">
        <div class="container-fluid">
            <li class="breadcrumb-item active">Settings</li>
            <li class="breadcrumb-item active">Branch</li>
        </div>
    </ul>
    <section class="tables">   
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 no-padding">
                    <div class="card">
                        <div class="card-body">
                            <h1>Branch</h1><br>
                            <!-- <table class="table table-striped table-hover"> -->
                            <button data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#addAccountsModal" class="btn btn-primary btnUpdate btnTable btnClickAddAccount" name="update" style="right:20px; position: absolute; top:20px;">Add Branch</button>
                            <br><br><br>
                            <div class="table-responsive">
                                <table class="table  table-striped table-hover table-bordered" id="table-grid"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Branch ID</th>
                                            <th>Branch Name</th>
                                            <th>Branch Code</th>
                                            <th>Branch Address</th>
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
                    <h4 id="exampleModalLabel" class="modal-title">Add Branch</h4>
                    <!-- <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button> -->
                </div>
                <form class="form-horizontal personal-info-css" id="add_branchinfo-form">
                    <div class="modal-body">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="">
                                        <div class="card-body">
                                             <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Branch Name <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-4">
                                                    <input type="hidden" name="branch_id" class="branch_id">
                                                    <input required id="inputHorizontalSuccess" type="text" class="form-control form-control-success info_bname" name="info_bname">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Branch Code <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-4">
                                                    <input required id="inputHorizontalWarning" type="text" class="form-control form-control-warning info_bcode" name="info_bcode">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Branch Address <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-10">
                                                    <input required id="inputHorizontalWarning" type="text" class="form-control form-control-warning info_address" name="info_address">
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
                    <h4 id="exampleModalLabel" class="modal-title">View Branch</h4>
                    <!-- <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button> -->
                </div>
                <form class="form-horizontal personal-info-css" id="view_branchinfo-form">
                    <div class="modal-body">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Branch Name</label>
                                                <div class="col-md-4">
                                                    <input type="hidden" name="branch_id" class="branch_id">
                                                    <input disabled id="inputHorizontalSuccess" type="text" class="form-control form-control-success info_bname" name="info_bname">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Branch Code</label>
                                                <div class="col-md-4">
                                                    <input disabled id="inputHorizontalWarning" type="text" class="form-control form-control-warning info_bcode" name="info_bcode">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Branch Address</label>
                                                <div class="col-md-10">
                                                    <input disabled id="inputHorizontalWarning" type="text" class="form-control form-control-warning info_address" name="info_address">
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
                    <h4 id="exampleModalLabel" class="modal-title">Edit Branch</h4>
                    <!-- <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button> -->
                </div>
                <form class="form-horizontal personal-info-css" id="edit_view_branchinfo-form">
                    <div class="modal-body">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Branch Name <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-4">
                                                    <input type="hidden" name="branch_id" class="branch_id">
                                                    <input required id="inputHorizontalSuccess" type="text" class="form-control form-control-success info_bname" name="info_bname">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Branch Code <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-4">
                                                    <input required id="inputHorizontalWarning" type="text" class="form-control form-control-warning info_bcode" name="info_bcode">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Branch Address <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-10">
                                                    <input required id="inputHorizontalWarning" type="text" class="form-control form-control-warning info_address" name="info_address">
                                                </div>
                                            </div>

                                            <br>
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
                </div>
                <form class="form-horizontal personal-info-css" id="delete_accountspersonalinfo-form">
                    <div class="modal-body">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p>Are you sure you want to delete this record?</p>
                                    <input type="hidden" class="del_branch_id" name="del_branch_id" value="">                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="form-group row">       
                            <div class="col-md-12">
                                <button type="submit" style="float:right" class="btn btn-danger deleteAccountBtn">Delete</button>
                                <button type="button" style="float:right; margin-right:10px;" class="btn btn-default cancelBtn" data-dismiss="modal" aria-label="Close">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php $this->load->view('includes/footer');?> <!-- includes your footer -->
<script type="text/javascript" src="<?=base_url('assets/js/admin/settings/branch.js');?>"></script>

