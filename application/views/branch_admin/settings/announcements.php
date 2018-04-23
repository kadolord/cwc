<!-- change the data-num and data-subnum for numbering of navigation -->
<div class="content-inner" id="pageActive" data-num="3" data-namecollapse="#settings-collapse" data-labelname="Announcements"> 
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
            <li class="breadcrumb-item active">Announcements</li>
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
                                            
                                        </div>

                                        <div class="col-lg-3">
                                            
                                        </div>

                                        <div class="col-lg-3">
                                            
                                        </div>

                                        <div class="col-lg-3">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- <table class="table table-striped table-hover"> -->
                                <button data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#addAnnouncementModal" class="btn btn-primary btnUpdate btnTable btnClickAddAccount" name="update" style="right:20px; position: absolute; top:20px;">Create Announcement</button>
                            <div class="table-responsive">
                                <table class="table  table-striped table-hover table-bordered" id="table-grid"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Date Created</th>
                                            <th>Display Until</th>
                                            <th>Subject</th>
                                            <th>Posted by</th>
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

    <!-- <button type="button" data-toggle="modal" data-target="#addAccountsModal" class="btn btn-primary">Form in simple modal </button> -->
    <!-- Modal-->
    <div id="addAnnouncementModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-lg modal-lg-custom">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="exampleModalLabel" class="modal-title">Create Announcement</h4>
                    <!-- <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button> -->
                </div>
                <form class="form-horizontal personal-info-css" id="add_announcement-form">
                    <div class="modal-body">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Subject <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-10">
                                                    <input id="inputHorizontalSuccess" type="text" class="form-control form-control-success" name="info_subject">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Display Until <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-10">
                                                    <input id="inputHorizontalWarning" class="form-control form-control-warning datepicker2" name="info_display_date">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Content <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-10">
                                                    <textarea class="form-control form-control-warning" name="info_content"></textarea>
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
                                <button type="button" style="float:right" class="btn btn-success saveBtnAnnouncement">Add</button>
                                <button type="button" style="float:right; margin-right:10px;" class="btn btn-default cancelBtn" data-dismiss="modal" aria-label="Close">Close</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="viewAnnouncementModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-lg modal-lg-custom">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="exampleModalLabel" class="modal-title">View Announcement</h4>
                    <!-- <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button> -->
                </div>
                <form class="form-horizontal personal-info-css" id="view_announcement-form">
                    <div class="modal-body">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="">
                                        <div class="card-body">
                                            <div class="col-md-6 col-md-offset-3">
                                                <div>
                                                    <h2 class = "a_title"></h2>
                                                    <small class="a_posted_by"></small><br>
                                                    <small class="a_posted_on"></small><br>
                                                    <small class="a_posted_until"></small>
                                                </div>
                                                <hr>
                                                <div class = "a_content">
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
                                <button type="button" style="float:right" class="btn btn-primary goToEditModalAnnouncementBtn">Edit</button>
                                <button type="button" style="float:right; margin-right:10px;" class="btn btn-default cancelBtn" data-dismiss="modal" aria-label="Close">Back</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="editAnnouncementModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-lg modal-lg-custom">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="exampleModalLabel" class="modal-title">Edit Announcement</h4>
                    <!-- <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button> -->
                </div>
                <form class="form-horizontal personal-info-css" id="edit_announcement-form">
                    <div class="modal-body">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="">
                                        <div class="card-body">

                                            <div class="form-group row">
                                                <label class="col-md-2 form-control-label">Subject <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-4">
                                                    <input id="inputHorizontalSuccess" type="text" class="form-control form-control-success a_etitle" name="a_etitle">
                                                </div>

                                                 <label class="col-md-2 form-control-label">Posted on <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-3">
                                                    <input disabled id="inputHorizontalSuccess" type="text" class="form-control form-control-success a_eposted_on" name="a_eposted_on">
                                                </div>

                                            </div> 

                                            <div class="form-group row">

                                                <label class="col-md-2 form-control-label">Posted by <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-4">
                                                    <input disabled id="inputHorizontalSuccess" type="text" class="form-control form-control-success a_eposted_by" name="a_eposted_by">
                                                </div>

                                                <label class="col-md-2 form-control-label">Posted Until <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-4">
                                                    <input type="hidden" name="announcement_id" class="announcement_id">
                                                    <input id="inputHorizontalSuccess" class="form-control form-control-success a_eposted_until datepicker2" name="a_eposted_until" id='datepicker2'>
                                                </div>

                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-12 form-control-label">Content <span class="asterisk" style="color:red">*</span></label>
                                                <div class="col-md-12">
                                                    <textarea name='a_econtent' class='form-control form-control-success a_econtent'></textarea>
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
                                <button type="submit" style="float:right" class="btn btn-primary EditAnnouncementModalBtn">Save</button>
                                <button type="button" style="float:right; margin-right:10px;" class="btn btn-default cancelBtn" data-dismiss="modal" aria-label="Close">Close</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="deleteAnnouncementModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="exampleModalLabel" class="modal-title">Delete Announcement</h4>
                    <!-- <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button> -->
                </div>
                <form class="form-horizontal personal-info-css" id="delete_announcement-form">
                    <div class="modal-body">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p>Are you sure you want to delete this announcement?</p>
                                    <input type="hidden" class="del_announcement_id" name="del_announcement_id" value="">                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="form-group row">       
                            <div class="col-md-12">
                                <button type="submit" style="float:right" class="btn btn-primary deleteAnnouncementBtn">Delete</button>
                                <button type="button" style="float:right; margin-right:10px;" class="btn btn-default cancelBtn" data-dismiss="modal" aria-label="Close">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php $this->load->view('includes/footer');?> <!-- includes your footer -->
<script type="text/javascript" src="<?=base_url('assets/js/branch_admin/settings/announcement.js');?>"></script>

