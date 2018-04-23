<!-- change the data-num and data-subnum for numbering of navigation -->
<div class="content-inner" id="pageActive" data-num="4" data-namecollapse="#settings-collapse" data-labelname="Load E-Receipts"> 
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Load E-Receipts</h2>
        </div>
    </header>

    <!-- Breadcrumb-->
    <ul class="breadcrumb">
        <div class="container-fluid">
            <li class="breadcrumb-item active">Settings</li>
            <li class="breadcrumb-item active">Load E-Receipts</li>
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
                                    <h1>Load E-Receipts</h1>
                                    <br><br><br>
<!--                                      <div class="form-group row">
                                        <div class="col-lg-4">
                                            <select class="form-control select_receipt" name="select_receipt">
                                                <option value="" disabled selected hidden>Select Action</option>
                                                <option value="1">View E-Receipt List</option>
                                                <option value="2">Generate E-Receipt</option>
                                            </select>
                                        </div>
                                     </div> -->
                                    <div class="form-group row">
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label class="form-control-label col-form-label-sm">Prefix</label>
                                                <input type="text" class="form-control form-control-sm search-input-text prefix" placeholder="Prefix" onkeydown="upperCaseF(this)">
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-control-label col-form-label-sm">Start <span class="asterisk" style="color:red">*</span></label>
                                                <input type="number" class="form-control form-control-sm search-input-text start" placeholder="Start" min="1" name="start">
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-control-label col-form-label-sm">End <span class="asterisk" style="color:red">*</span></label>
                                                <input type="number" class="form-control form-control-sm search-input-text end" placeholder="End" min="1" name="end">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">       
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-primary bntGenerate">Load</button> 
                                            <button class='btn btn-primary btnClearReceipt' style="display:none">Clear</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body receipt_container" style="display:none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php $this->load->view('includes/footer');?> <!-- includes your footer -->
<script type="text/javascript" src="<?=base_url('assets/js/admin/settings/generate_ereceipts.js');?>"></script>

