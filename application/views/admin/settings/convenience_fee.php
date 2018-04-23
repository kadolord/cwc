<!-- change the data-num and data-subnum for numbering of navigation -->
<div class="content-inner" id="pageActive" data-num="4" data-namecollapse="#settings-collapse" data-labelname="Convenience Fee"> 
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Convenience Fee</h2>
        </div>
    </header>

    <!-- Breadcrumb-->
    <ul class="breadcrumb">
        <div class="container-fluid">
            <li class="breadcrumb-item active">Settings</li>
            <li class="breadcrumb-item active">Convenience Fee</li>
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
                                    <form id="conveniencefee_form">
                                        <h1>Convenience Fee</h1>
                                        <br><br>
                                        <h3>Regular</h3>
                                        <br>
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label class="form-control-label col-form-label-sm">Regular Debit<span hidden class="asterisk" style="color:red">*</span></label>
                                                    <input readonly type="text" class="form-control form-control-sm search-input-text info_reg_debit" placeholder="Regular Debit" min="1" name="info_reg_debit" value="<?='&#8369;'." ".number_format($reg_conveniencefee->convenience_fee_debit,2)?>">

                                                    <input required style="display:none" type="number" class="form-control form-control-sm reg_debit" placeholder="" min="1" name="reg_debit" value="<?=$reg_conveniencefee->convenience_fee_debit;?>">
                                                </div>
                                            </div>
                                            

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label class="form-control-label col-form-label-sm">Regular Credit<span hidden class="asterisk" style="color:red">*</span></label>
                                                    <input readonly type="text" class="form-control form-control-sm info_reg_credit" placeholder="Regular Credit" min="1" name="info_reg_credit" value="<?='&#8369;'." ".number_format($reg_conveniencefee->convenience_fee_credit,2)?>">

                                                    <input required style="display:none" type="number" class="form-control form-control-sm reg_credit" placeholder="" min="1" name="reg_credit" value="<?=$reg_conveniencefee->convenience_fee_credit;?>">
                                                </div>
                                            </div>
                                        </div>
                                        <h3>Express Lane</h3>
                                        <br>
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label class="form-control-label col-form-label-sm">Express Debit<span hidden class="asterisk" style="color:red">*</span></label>
                                                    <input readonly type="text" class="form-control form-control-sm info_exp_debit" placeholder="Express Debit" min="1" name="info_exp_debit" value="<?='&#8369;'." ".number_format($exp_conveniencefee->convenience_fee_debit,2)?>">

                                                    <input required style="display:none" type="number" class="form-control form-control-sm exp_debit" placeholder="" min="1" name="exp_debit" value="<?=$exp_conveniencefee->convenience_fee_debit;?>" >
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label class="form-control-label col-form-label-sm">Express Credit<span hidden class="asterisk" style="color:red">*</span></label>
                                                    <input readonly type="text" class="form-control form-control-sm search-input-text info_exp_credit" placeholder="Express Credit" min="1" name="info_exp_credit" value="<?='&#8369;'." ".number_format($exp_conveniencefee->convenience_fee_credit,2)?>">

                                                    <input required style="display:none" type="number" class="form-control form-control-sm search-input-text exp_credit" placeholder="" min="1" name="exp_credit" value="<?=$exp_conveniencefee->convenience_fee_credit;?>">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">       
                                            <div class="col-md-6">
                                                <button type="button" class="btn btn-primary btnUpdate" style="float:right">Update</button> 
                                                <button class='btn btn-success btnSaveChanges' style="display:none;float:right">Save Changes</button>
                                                <button class='btn btn-default btnCancel' style="display:none; margin-right:5px;float:right">Cancel</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php $this->load->view('includes/footer');?> <!-- includes your footer -->
<script type="text/javascript" src="<?=base_url('assets/js/admin/settings/conveniencefee.js');?>"></script>

