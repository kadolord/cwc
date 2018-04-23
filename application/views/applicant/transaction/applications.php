<!-- change the data-num and data-subnum for numbering of navigation -->
<style type="text/css">

    .datepicker3,
    .table-condensed {
    	width: 220px;
    	height: 220px;
    	font-size: x-small; 
    }

	 .datepicker3 td.day,
	 .datepicker3 td.new.day,
	 .datepicker3 td.old.day {
	   color: green;
	   font-weight: bold;
	}

	.datepicker3 td.day.disabled {
	  color: rgb(255,102,102);
	  /*background-color: rgba(255,255,255,.3);*/
	  font-weight: normal;
	}

    @media only screen and (max-width: 768px) {
    	.time_label{
    		margin-top:50px;
    	}
    }
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
    @media print{

    }
    .receipt_logo{
    	display: block;
    	margin-left: auto;
    	margin-right: auto;
    }
    .checkbox-template:checked::before, .radio-template:checked::before {
            background: #5cb85c;
    }
</style>
<div class="content-inner" id="pageActive" data-num="3" data-namecollapse="#application-collapse" data-labelname="Application"> 
	<!-- Page Header-->
	<header class="page-header">
		<div class="container-fluid">
			<h2 class="no-margin-bottom">Application</h2>
		</div>
	</header>

	<!-- Breadcrumb-->
	<ul class="breadcrumb">
		<div class="container-fluid">
			<li class="breadcrumb-item active">Application</li>
		</div>
	</ul>
	<?php if($isAlreadyApplied == true): ?>
		<section class="tables">   
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12 no-padding">
						<div class="card">
							<div class="card-header d-flex align-items-center">
								<h3>Application Details</h3>
							</div>
							<div class="card-body row" style="padding:50px">
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
												<img src="<?=$application_info->qr_code?>" class="img-fluid" style="width: 100px;height: 100px;float:right">
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<input type="hidden" class="application_id" name="application_id" value="<?=$application_info->id?>">
												<div class="form-group row no-margin-bottom">
													<label class="col-md-6 col-sm-6 form-control-label"><strong>Reference No:</strong></label>
													<label class="col-md-6 col-sm-6 form-control-label refNospan"><?=$application_info->reference_no?></label>
												</div>
												<div class="form-group row no-margin-bottom">
													<label class="col-md-6 col-sm-6 form-control-label"><strong>E-Receipt No:</strong></label>
													<label class="col-md-6 col-sm-6 form-control-label e-receipt_no"><?=$application_info->OR_NO?></label>
												</div>                                                                   
											</div>
										</div>
										<hr>
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<div class="form-group row no-margin-bottom">
													<label class="col-md-6 col-sm-6 form-control-label"><strong>Application Date:</strong></label>
													<label class="col-md-6 col-sm-6 form-control-label" data-value=""><?= date_format(date_create($application_info->application_date),"m/d/Y")?></label>
												</div>  
												<div class="form-group row no-margin-bottom">
													<label class="col-md-6 col-sm-6 form-control-label"><strong>Process Lane:</strong></label>
													<label class="col-md-6 col-sm-6 form-control-label sum_process_lane" data-value=""><?=$application_info->process?></label>
												</div>   
												<div class="form-group row no-margin-bottom">
													<label class="col-md-6 col-sm-6 form-control-label"><strong>Application Category:</strong></label>
													<label class="col-md-6 col-sm-6 form-control-label sum_app_cat" data-value=""><?=$application_info->description?></label>
												</div>   
											</div>
											<div class="col-md-6 col-sm-6">
												<div class="form-group row no-margin-bottom">
													<label class="col-md-3 col-sm-6 form-control-label"><strong>Branch:</strong></label>
													<label class="col-md-9 col-sm-6 form-control-label sum_branch_name" data-value=""><?=$application_info->branch_name?></label>
												</div>

												<div class="form-group row no-margin-bottom">
													<label class="col-md-6 col-sm-6 form-control-label"><strong>Appointment Date:</strong></label>
													<label class="col-md-6 col-sm-6 form-control-label sum_app_date" data-value=""><?=date_format(date_create($application_info->appointment_date),"m/d/Y")?></label>
												</div> 

												<div class="form-group row">
													<label class="col-md-6 col-sm-6 form-control-label"><strong>Time:</strong></label>
													<label class="col-md-6 col-sm-6 form-control-label sum_app_time" data-value=""><?=$application_info->timesched_description?></label>
												</div>
											</div>
										</div>
										<hr>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group row no-margin-bottom">
													<label class="col-md-3 col-sm-6 form-control-label"><strong>Applicant Name:</strong></label>
													<label class="col-md-6 col-sm-6 form-control-label sum_app_name" data-value=""><?=$application_info->first_name." ".$application_info->middle_name." ".$application_info->last_name." ".$application_info->ext_name?></label>
												</div>
												<div class="form-group row no-margin-bottom">
													<label class="col-md-3 col-sm-6 form-control-label"><strong>ACR I-Card No:</strong></label>
													<label class="col-md-6 col-sm-6 form-control-label sum_icard" data-value=""><?=$application_info->icard_no?></label>
												</div>

												<div class="form-group row no-margin-bottom">
													<label class="col-md-3 col-sm-6 form-control-label"><strong>Alias1:</strong></label>
													<label class="col-md-3 col-sm-6 form-control-label sum_alias1" data-value=""><?=$application_info->alias1?></label>

													<label class="col-md-3 col-sm-6 form-control-label"><strong>Alias2:</strong></label>
													<label class="col-md-3 col-sm-6 form-control-label sum_alias2" data-value=""><?=$application_info->alias2?></label>
												</div>

												<div class="form-group row no-margin-bottom"> 
													<label class="col-md-3 col-sm-6 form-control-label"><strong>Birthdate:</strong></label>
													<label class="col-md-3 col-sm-6 form-control-label sum_bday" data-value=""><?= date_format(date_create($applicant_info->birthdate),"m/d/Y")?></label>

													<label class="col-md-3 col-sm-6 form-control-label"><strong>Age:</strong></label>
													<label class="col-md-3 col-sm-6 form-control-label sum_age" data-value=""><?=$applicant_info->age?></label>
												</div>

												<div class="form-group row no-margin-bottom">
													<?php if($applicant_info->gender_id == 1):?> 
														<label class="col-md-3 col-sm-6 form-control-label"><strong>Gender:</strong></label>
														<label class="col-md-3 col-sm-6 form-control-label sum_gender" data-value="">Male</label>
													<?php else: ?>
														<label class="col-md-3 col-sm-6 form-control-label"><strong>Gender:</strong></label>
														<label class="col-md-3 col-sm-6 form-control-label sum_gender" data-value="">Female</label>
													<?php endif; ?>
													<label class="col-md-3 col-sm-6 form-control-label"><strong>Civil Status:</strong></label>
													<label class="col-md-3 col-sm-6 form-control-label sum_civilstatus" data-value=""><?=$application_info->name?></label>
												</div>

												<div class="form-group row no-margin-bottom">
													<label class="col-md-3 col-sm-6 form-control-label"><strong>Country of Birth:</strong></label>
													<label class="col-md-3 col-sm-6 form-control-label sum_country" data-value=""><?=$applicant_info->country?></label>

													<label class="col-md-3 col-sm-6 form-control-label"><strong>Nationality:</strong></label>
													<label class="col-md-3 col-sm-6 form-control-label sum_nationality" data-value=""><?=$application_info->nationality?></label>
												</div>
												<div class="form-group row no-margin-bottom">
													<label class="col-md-3 col-sm-6 form-control-label"><strong>Passport No:</strong></label>
													<label class="col-md-4 col-sm-6 form-control-label sum_passport" data-value=""><?=$application_info->passport_num?></label>
												</div>
												<div class="form-group row no-margin-bottom">
													<label class="col-md-3 col-sm-6 form-control-label"><strong>Place of Issuance:</strong></label>
													<label class="col-md-3 col-sm-6 form-control-label sum_issuance_place" data-value=""><?=$application_info->place_of_isssuance?></label>

													<label class="col-md-3 col-sm-6 form-control-label"><strong>Date of Issuance:</strong></label>
													<label class="col-md-3 col-sm-6 form-control-label sum_issuance_date" data-value=""><?=$application_info->issuance_date == null ? "" :date_format(date_create($application_info->issuance_date),"m/d/Y")?></label>
												</div>
												<div class="form-group row no-margin-bottom">
													<label class="col-md-3 col-sm-6 form-control-label"><strong>Expiry Date:</strong></label>
													<label class="col-md-3 col-sm-6 form-control-label sum_expiry_date" data-value=""><?=$application_info->expiry_date ==null ? "" :date_format(date_create($application_info->expiry_date),"m/d/Y")?></label>

													<label class="col-md-3 col-sm-6 form-control-label"><strong>Date of Latest Arrival:</strong></label>
													<label class="col-md-3 col-sm-6 form-control-label sum_arrival_date" data-value=""><?=$application_info->latest_arrival_date == null ?"" :date_format(date_create($application_info->latest_arrival_date),"m/d/Y")?></label>
												</div>                                                                
												<div class="form-group row no-margin-bottom">
													<label class="col-md-3 col-sm-6 form-control-label"><strong>Mobile:</strong></label>
													<label class="col-md-3 col-sm-6 form-control-label sum_mobile" data-value=""><?=$application_info->mobile_num?></label>

													<label class="col-md-3 col-sm-6 form-control-label"><strong>Landline:</strong></label>
													<label class="col-md-3 col-sm-6 form-control-label sum_landline" data-value=""><?=$application_info->landline?></label>
												</div>
												<hr>  
												<div class="form-group row no-margin-bottom">         
													<label class="col-md-6 col-sm-6 form-control-label"><strong>Residential Address in the Philippines:</strong></label>
													<label class="col-md-6 col-sm-6 form-control-label sum_ph_addrs" data-value="">
														<?=$application_info->ph_street_no." "." ".$application_info->ph_village.", ".$application_info->ph_barangay.", ".$application_info->ph_city.", ".$application_info->ph_province." ".$application_info->ph_zipcode?>
													</label>
												</div>                                                                
												<div class="form-group row no-margin-bottom">
													<label class="col-md-6 col-sm-6 form-control-label"><strong>Residential Address Abroad:</strong></label>
													<label class="col-md-6 col-sm-6 form-control-label sum_ab_addrs" data-value="">
														<?=$application_info->ab_street_no." "." ".$application_info->ab_village.", ".$application_info->ab_city.", ".$application_info->ab_state.", ".$application_info->country." ".$application_info->ab_zipcode?>
													</label>
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
											<label class="col-md-6 form-control-label or-label">E-RECEIPT#: </label>
											<label class="text-right col-md-6 form-control-label or_no or-label"><?=$application_info->OR_NO?></label>
										</div>
										<div class="form-group row">
											<label class="col-md-6 col-sm-5 form-control-label or-label">ISSUED DATE:</label>
											<label class="text-right col-md-6 col-sm-7 form-control-label or-label"><?=date_format(date_create($application_info->application_date),"m/d/Y")?></label>
										</div>

										<div class="form-group row no-margin-bottom">
											<label class="col-md-5 form-control-label or-label">PAYOR:</label>
											<label class="text-right col-md-7 form-control-label payor or-label"><?=$application_info->first_name." ".$application_info->middle_name." ".$application_info->last_name." ".$application_info->ext_name?></label>
										</div>

										<div class="form-group row">
											<label class="col-md-5 form-control-label or-label"></label>
											<label class="text-right col-md-7 form-control-label sum_country or-label"><?=$applicant_info->country?></label>
										</div>    

										<div class="form-group row no-margin-bottom ">
											<label class="col-md-6 form-control-label or-label ">ASSESSMENT</label>
											<label class="text-right col-md-6 form-control-label or-label ">AMOUNT</label>
										</div>   

										<div class="form-group row no-margin-bottom">
											<label class="col-md-6 form-control-label or-label">APPLICATION FEE:</label>
											<label class="text-right col-md-6 form-control-label rcpt_app_fee or-label  with-linebreak">&#8369; 10,000.00</label>
										</div>
										<div class="form-group row">
											<label class="col-md-5 form-control-label or-label">AMOUNT DUE: </label>
											<label class="text-right col-md-7 form-control-label rcpt_amount or-label">&#8369; 10,000.00</label>
										</div>
										<div class="form-group row">
											<label class="col-md-5 form-control-label or-label">REFERENCE#</label>
											<label class="text-right col-md-7 form-control-label refNospan or-label"><?=$application_info->reference_no?></label>
										</div>
									</div>
									<hr>

									<a class="btn btn-primary" href="<?=base_url().'Main/pdf_acrs_application/'.$application_info->reference_no?>">Download as PDF</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

	<?php else: ?>

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
																<h3 class="step_label">Step 1 of 5. Personal Information</h3>
																<div class="progress" style="margin-top: 10px;">
																	<!-- progress-bar-animated -->
																	<div class="progress-bar progress-bar-striped bg-success" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;  height: 25px; transition:none;"></div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-12" style="padding-bottom: 30px;">
											<div class="card-progress">
												<br>
												<div class="col-md-12">
												<!-- Personal Information-->
													<div class="step1">
														<form id="personal_info_form"> 
															<div class="form-group row">
																<label class="form-control-label col-md-2">Process Lane<span class="asterisk" style="color:red">*</span></label>
																<div class="col-md-6">
																	<select data-column="2" class="form-control app_process required_fields" name="app_process">
																		<?php foreach ($get_process->result() as $process): ?>
																			<?php if($process->process_id == 1): ?>
																				<option selected data-process_fee="<?=$process->processing_fee_debit?>" data-con_fee_debit="<?=$process->convenience_fee_debit?>" data-con_fee_credit="<?=$process->convenience_fee_credit?>" value="<?=$process->process_id?>"><?=$process->process; ?></option>
																			<?php else: ?>
																				<option data-process_fee="<?=$process->processing_fee_debit?>" data-con_fee_debit="<?=$process->convenience_fee_debit?>" data-con_fee_credit="<?=$process->convenience_fee_credit?>" value="<?=$process->process_id?>"><?=$process->process; ?></option>
																			<?php endif; ?>
																		<?php endforeach ?>;
																	</select>
																</div>
															</div>
															<div class="form-group row">
																<label class="form-control-label col-md-2">Application Category<span class="asterisk" style="color:red">*</span></label>
																<div class="col-md-6">
																	<select data-column="2" class="form-control app_type required_fields" name="">
																		<option value="" selected hidden>Select Application Category</option>
																		<?php foreach ($app_type->result() as $app): ?>
																			<option value="<?=$app->application_id?>"><?php echo $app->description; ?></option>
																		<?php endforeach ?>;
																	</select>
																</div>
															</div>
															<div class="form-group row">
																<label class="col-md-2 form-control-label">Applicant Name <span class="asterisk" style="color:red">*</span></label>
																<div class="col-md-3">
																	<input readonly required id="inputHorizontalSuccess" type="text" class="form-control form-control-success info_fname" value="<?=$applicant_info->first_name?>" name="info_fname"><small class="form-text">First Name <span class="asterisk" style="color:red">*</span></small>
																</div>
																<div class="col-md-2">
																	<input readonly id="inputHorizontalSuccess" type="text" class="form-control form-control-success info_mname" value="<?=$applicant_info->middle_name?>" name="info_mname"><small class="form-text ">Middle Name</small>
																</div>
																<div class="col-md-3">
																	<input readonly required id="inputHorizontalSuccess" type="text" class="form-control form-control-success info_lname" value="<?=$applicant_info->last_name?>" name="info_lname"><small class="form-text ">Last Name <span class="asterisk" style="color:red">*</span></small>
																</div>
																<div class="col-md-2">
																	<input readonly id="inputHorizontalSuccess" type="text" class="form-control form-control-success info_xname" value="<?=$applicant_info->ext_name?>" name="info_xname"><small class="form-text ">Name Extension</small>
																</div>
															</div>

															<div class="form-group row">
																<label class="col-md-2 form-control-label">ACR I-Card No</label>
																<div class="col-md-4">
																	<input id="inputHorizontalSuccess" type="text" class="form-control form-control-success info_acr_no" value="<?=$applicant_info->icard_no;?>" name="info_acr_no">
																</div>
															</div>

															<div class="form-group row">
																<label class="col-md-2 form-control-label">Alias 1</label>
																<div class="col-md-4">
																	<input readonly value="<?=$applicant_info->alias1?>" id="inputHorizontalSuccess" type="text" class="form-control form-control-success info_alias1" name="info_alias1">
																</div>

																<label class="col-md-2 form-control-label">Alias 2</label>
																<div class="col-md-4">
																	<input readonly value="<?=$applicant_info->alias2?>" id="inputHorizontalSuccess" type="text" class="form-control form-control-success info_alias2" name="info_alias2">
																</div>
															</div>

															<div class="form-group row">
																<label class="col-md-2 form-control-label">Birthdate <span class="asterisk" style="color:red">*</span></label>
																<div class="col-md-4">
																	<input required id="inputHorizontalWarning" type="text" class="form-control form-control-warning datepicker2 info_bdate required_fields" value="<?= date_format(date_create($applicant_info->birthdate),"m/d/Y")?>" name="info_bdate">
																</div> 

																<label class="col-md-2 form-control-label">Age <span class="asterisk" style="color:red">*</span></label>
																<div class="col-md-4">
																	<input readonly required value="<?=$applicant_info->age?>" type="number" class="form-control form-control-sm info_age" name="info_age" >
																</div>
															</div>

															<div class="form-group row">
																<label class="col-md-2 form-control-label">Gender <span class="asterisk" style="color:red">*</span></label>
																<?php if($applicant_info->gender_id == 1){ //male?> 
																<div class="col-md-2">
																	<div class="i-checks martop12">
																		<input id="register-gendermale" type="radio" value="1" name="info_gender" class="radio-template" checked data-name ="Male">
																		<label for="register-gendermale">Male</label>
																	</div>
																</div>
																<div class="col-md-2">
																	<div class="i-checks martop12">
																		<input id="register-genderfemale" type="radio" value="2" name="info_gender" class="radio-template" data-name ="Female">
																		<label for="register-genderfemale">Female</label>
																	</div>
																</div>
																<?php }else{?>

																<div class="col-md-2">
																	<div class="i-checks martop12">
																		<input id="register-gendermale" type="radio" value="1" name="info_gender" class="radio-template" data-name ="Male">
																		<label for="register-gendermale">Male</label>
																	</div>
																</div>
																<div class="col-md-2">
																	<div class="i-checks martop12">
																		<input id="register-genderfemale" type="radio" value="2" name="info_gender" class="radio-template" checked data-name ="Female">
																		<label for="register-genderfemale">Female</label>
																	</div>
																</div>

																<?php } ?>

																<label class="col-md-2 form-control-label">Civil Status <span class="asterisk" style="color:red">*</span></label>
																<div class="col-md-4">
																	<select name="info_civil_status" class= "form-control info_civil_status required_fields" id="register-civilstatus" required>
																		<option selected hidden value="">
																			Select Status
																		</option>
																		<?php foreach ($get_civil_status->result() as $gcs): ?>
																			<?php if($applicant_info->civil_status == $gcs->civil_status_id): ?>
																				<option selected value="<?=$gcs->civil_status_id?>">
																					<?=$gcs->name?>
																				</option>
																			<?php else: ?>
																				<option value="<?=$gcs->civil_status_id?>">
																					<?=$gcs->name?>
																				</option>
																			<?php endif; ?>
																		<?php endforeach; ?>
																	</select>
																</div>
															</div>


															<div class="form-group row">
																<label class="col-md-2 form-control-label">Country of Birth<span class="asterisk" style="color:red">*</span></label>
																<div class="col-md-4">
																	<select class="form-control info_birth_country required_fields" name="info_birth_country" required >
																		<?php
																		foreach ($get_country->result() as $gcountry) { ?>
																		<?php if($gcountry->country_id == $applicant_info->country_id){ ?>
																		<option selected value="<?=$gcountry->country_id?>"><?=$gcountry->country?></option>
																		<?php }else{ ?>
																		<option value="<?=$gcountry->country_id?>"><?=$gcountry->country?></option>
																		<?php } } ?>
																		?>
																	</select>
																</div>

																<label class="col-md-2 form-control-label">Citizenship / Nationality <span class="asterisk" style="color:red">*</span></label>
																<div class="col-md-4">
																	<input required value="<?=$applicant_info->nationality?>" type="text" name="info_nationality" class="form-control form-control-sm info_nationality required_fields">
																</div>
															</div>
															<hr>

															<div class="form-group row">
																<label class="col-md-2 form-control-label">Passport No</label>
																<div class="col-md-4">
																	<input value="<?=$applicant_info->passport_num?>" id="inputHorizontalWarning" type="text" class="form-control form-control-warning info_passport_no"  name="info_passport_no">
																</div>
															</div>


															<div class="form-group row">

																<label class="col-md-2 form-control-label">Place of Issuance</label>
																<div class="col-md-4">
																	<input value="<?=$applicant_info->place_of_isssuance?>" type="text" name="info_issuance_place" class="form-control form-control-sm info_issuance_place">
																</div>

																<label class="col-md-2 form-control-label">Date of Issuance</label>
																<div class="col-md-4">
																	<input id="inputHorizontalWarning" type="text" class="form-control form-control-warning datepicker2 info_issuance_date" value="<?= $applicant_info->issuance_date == null ? "" :date_format(date_create($applicant_info->issuance_date),"m/d/Y")?>" name="info_issuance_date">
																</div> 
															</div>

															<div class="form-group row">
																<label class="col-md-2 form-control-label">Expiry Date </label>
																<div class="col-md-4">
																	<input id="inputHorizontalWarning" type="text" class="form-control form-control-warning datepicker2 info_expiry_date" value="<?= $applicant_info->expiry_date == null ? "" :date_format(date_create($applicant_info->expiry_date),"m/d/Y")?>" name="info_expiry_date">
																</div> 

																<label class="col-md-2 form-control-label"> Date of Latest Arrival</label>
																<div class="col-md-4">
																	<input id="inputHorizontalWarning" type="text" class="form-control form-control-warning datepicker2 info_arrival_date" value="<?= $applicant_info->latest_arrival_date == null ? "" : date_format(date_create($applicant_info->latest_arrival_date),"m/d/Y")?>" name="info_arrival_date">
																</div> 
															</div>
															<hr>
															<div class="form-group row">
																<label class="col-md-2 form-control-label">Email</label>
																<div class="col-md-4">
																	<input readonly value="<?=$applicant_info->email?>" id="inputHorizontalWarning" type="text" class="form-control form-control-warning info_email" value="" name="info_email">
																</div> 
															</div>
															<div class="form-group row">
																<label class="col-md-2 form-control-label">Mobile</label>
																<div class="col-md-4">
																	<input value="<?=$applicant_info->mobile_num?>" id="inputHorizontalWarning" type="text" class="form-control form-control-warning editable info_mobile"  name="info_mobile">
																</div> 

																<label class="col-md-2 form-control-label">Landline</label>
																<div class="col-md-4">
																	<input value="<?=$applicant_info->landline?>" id="inputHorizontalWarning" type="text" class="form-control form-control-warning editable info_landline" name="info_landline">
																</div> 
															</div>
															<hr>
															<div class="form-group row">
																<label class="col-md-2 form-control-label">Residential Address in the Philippines </label>
																<div class="col-md-3">
																	<input value="<?=$applicant_info->ph_street_no?>" id="inputHorizontalSuccess" type="text" class="form-control form-control-success editable info_ph_st"  name="info_ph_st"><small class="form-text">House/Unit No., Street </small>
																</div>
																<div class="col-md-3">
																	<input value="<?=$applicant_info->ph_village?>"  id="inputHorizontalSuccess" type="text" class="form-control form-control-success editable info_ph_village" name="info_ph_village"><small class="form-text">Subdivision / Village</small>
																</div>
																<div class="col-md-4">
																	<input value="<?=$applicant_info->ph_barangay?>"  id="inputHorizontalSuccess" type="text" class="form-control form-control-success editable info_ph_brgy" name="info_ph_brgy"><small class="form-text">Barangay</small>
																</div>
															</div>
															<hr>
															<div class="form-group row">
																<label class="col-md-2 form-control-label"></label>
																<div class="col-md-3">
																	<input value="<?=$applicant_info->ph_city?>" id="inputHorizontalSuccess" type="text" class="form-control form-control-success editable info_ph_city" name="info_ph_city"><small class="form-text">Municipality / City</small>
																</div>
																<div class="col-md-3">
																	<input value="<?=$applicant_info->ph_province?>"  id="inputHorizontalSuccess" type="text" class="form-control form-control-success editable info_ph_prov" name="info_ph_prov"><small class="form-text">Province</small>
																</div>
																<div class="col-md-4">
																	<input value="<?=$applicant_info->ph_zipcode?>"  id="inputHorizontalSuccess" type="text" class="form-control form-control-success editable info_ph_zipcode" name="info_ph_zipcode"><small class="form-text">Zip Code</small>
																</div>
															</div>
															<br>
															<div class="form-group row">
																<label class="col-md-2 form-control-label">Residential Address Abroad </label>
																<div class="col-md-3">
																	<input value="<?=$applicant_info->ab_street_no?>"  id="inputHorizontalSuccess" type="text" class="form-control form-control-success editable info_ab_st" name="info_ab_st"><small class="form-text">House/Unit No., Street </small>
																</div>
																<div class="col-md-3">
																	<input value="<?=$applicant_info->ab_village?>"  id="inputHorizontalSuccess" type="text" class="form-control form-control-success editable info_ab_village" name="info_ab_village"><small class="form-text">Subdivision / Village</small>
																</div>
																<div class="col-md-4">
																	<input value="<?=$applicant_info->ab_city?>"  id="inputHorizontalSuccess" type="text" class="form-control form-control-success editable info_ab_city" name="info_ab_city"><small class="form-text">City</small>
																</div>
															</div>
															<div class="form-group row">
																<label class="col-md-2 form-control-label"></label>
																<div class="col-md-3">
																	<input value="<?=$applicant_info->ab_state?>"  id="inputHorizontalSuccess" type="text" class="form-control form-control-success editable info_ab_state"  name="info_ab_state"><small class="form-text">State</small>
																</div>
																<div class="col-md-3">
																	<select class="form-control editable info_ab_country" name="info_ab_country">
																		<option selected hidden value="0">Select Country</option>
																		<?php
																		foreach ($get_country->result() as $gcountry) { ?>
																		<?php if($gcountry->country_id == $applicant_info->ab_country){ ?>
																		<option selected value="<?=$gcountry->country_id?>"><?=$gcountry->country?></option>
																		<?php }else{ ?>
																		<option value="<?=$gcountry->country_id?>"><?=$gcountry->country?></option>
																		<?php } } ?>
																		?>
																	</select><small class="form-text">Country</small>
																</div>
																<div class="col-md-4">
																	<input value="<?=$applicant_info->ab_zipcode?>"  id="inputHorizontalSuccess" type="text" class="form-control form-control-success editable info_ab_zipcode"  name="info_ab_zipcode"><small class="form-text">Zip Code</small>
																</div>
															</div>
														</form>
														<hr>                                                               
													</div>
												<!-- Schedule Appoinment -->
													<div class="step2" style="display: none;">
														<div class="alert alert-warning">
															<i class="fa fa-warning" style="font-size:15px"> Important Reminder</i><br>
															<label label-form-control-label>Rescheduling will not be allowed. In case of sudden or unforeseen cancellation of office on the day of appointment, you may proceed as a walk-in applicant on the next working day. For concerns regarding online scheduling of appointment you may call XXX-XXX-XXX-XXX.</label>
														</div>
														<hr>
														<div class="form-group row">
															<label class="label-form-control-label col-md-2">Select Branch<span class="asterisk" style="color:red">*</span></label>
															<div class="col-md-4">
																<select data-column="2" class="form-control branch_name2 required_fields2" name="branch_name" id="branch_name">
																	<option value="" selected hidden>Select Branch</option>
																	<?php foreach($centers->result() as $gc){  ?>
																	<option value="<?=$gc->branch_id?>"><?=$gc->branch_name?></option>
																	<?php }?>
																</select>
															</div>
														</div>
														<br>
														<div class="form-group row sched_div">
															<label class="label-form-control-label col-md-2">Select Date<span class="asterisk" style="color:red">*</span></label>
															<div class="col-md-4 appointment-date datepicker3">
															</div>

															<label class="label-form-control-label col-md-2 time_label">Select Time<span class="asterisk" style="color:red">*</span></label>
															<div class="col-md-4">
																<select data-column="2" class="form-control search-input-select tba_appointment-time required_fields2" name="appointment_time"> 
																</select>
															</div>
															<input type="hidden" name="appointment_date" class="tba_appointment-date required_fields2">
														</div>
													</div>
												<!-- choose payment transaction -->
													<div class="step3" style="display: none;">
    													<div class="row">
    														<div class="box_creditcard col-lg-6" style="border: 1px solid #e6e6e6; text-align: center;">
    															<label for="creditcard_rBtn">
    																<img class="img-fluid" src="<?=base_url('assets/img/creditcard.jpg');?>">
    															</label>
    															<p style="background-color: #eceeef;padding:16px 10px 10px 10px;">
    																<input id="creditcard_rBtn" type="radio" value="1" name="payment_mode" class="radio-template" checked>
    																<label for="creditcard_rBtn" style="font-size: 1em;">Credit Card</label> 
    															</p>
    														</div>

    														<div class="box_debit col-lg-6" style="border: 1px solid #e6e6e6; text-align: center;">
    															<label for="debit_rBtn">
    																<img  class="img-fluid" src="<?=base_url('assets/img/debit_overthebank.jpg');?>">
    															</label>
    															<p style="background-color: #eceeef;padding:16px 10px 10px 10px;">
    																<input id="debit_rBtn" type="radio" value="2" name="payment_mode" class="radio-template">
    																<label for="debit_rBtn" style="font-size: 1em;">Debit Card or Over-the-Counter</label>
    															</p> 
    														</div>
    													</div>

    													<div class="form-group">
    														<label class="form-control-label col-form-label-sm">Card Name<span hidden class="asterisk" style="color:red">*</span></label>
    														<div class="col-md-14">
    															<input id="inputHorizontalWarning" type="text" class="form-control form-control-warning material_josh" value="" name="card_name">
    														</div>
    													</div>

    													<div class="form-group">
    														<label class="form-control-label col-form-label-sm">Card Number<span hidden class="asterisk" style="color:red">*</span></label>
    														<div class="col-md-14">
    															<input id="inputHorizontalWarning " type="text" class="form-control form-control-warning material_josh" value="" name="card_no">
    														</div>
    													</div>

    													<div class="form-group">
    														<label class="form-control-label col-form-label-sm">CVV No.<span hidden class="asterisk" style="color:red">*</span></label>
    														<div class="col-md-14">
    															<input id="inputHorizontalWarning " type="text" class="form-control form-control-warning material_josh" value="" name="cvv_no">
    														</div>
    													</div>
												    </div>
												<!-- Summary -->
    												<div class="step4" style="display: none;">
    													<h4>Appointment Details</h4>
    													<br>
    													<div class="form-group row">
    														<label class="col-md-2 form-control-label">Process Lane</label>
    														<label class="col-md-3 form-control-label sum_process_lane"></label>
    													</div>
    													<div class="form-group row">
    														<label class="col-md-2 form-control-label">Branch Name</label>
    														<label class="col-md-3 form-control-label sum_branch_name"></label>
    													</div>
    													<div class="form-group row">
    														<label class="col-md-2 form-control-label">Date</label>
    														<label class="col-md-3 form-control-label sum_app_date"></label>
    														<label class="col-md-2 form-control-label">Time</label>
    														<label class="col-md-3 form-control-label sum_app_time"></label>
    													</div>
    													<div class="form-group row">
    														<label class="col-md-2 form-control-label">Application Fee:</label>
    														<label class="col-md-3 form-control-label sum_app_fee"></label>

    														<label class="col-md-2 form-control-label">Convenience Fee:</label>
    														<label class="col-md-3 form-control-label sum_con_fee"></label>
    													</div>
    													<div class="form-group row">
    														<label class="col-md-2 form-control-label">Category:</label>
    														<label class="col-md-4 form-control-label sum_app_cat"></label>
    													</div>
    													<hr>
    													<h4>Personal Information</h4>
    													<br>
    													<div class="form-group row">
    														<label class="col-md-2 form-control-label">Applicant Name:</label>
    														<label class="col-md-3 form-control-label sum_app_name"></label>
    													</div>
    													<div class="form-group row">
    														<label class="col-md-2 form-control-label">ACR I-Card No:</label>
    														<label class="col-md-3 form-control-label sum_icard"></label>
    													</div>

    													<div class="form-group row">
    														<label class="col-md-2 form-control-label">Alias1:</label>
    														<label class="col-md-3 form-control-label sum_alias1"></label>

    														<label class="col-md-2 form-control-label">Alias2:</label>
    														<label class="col-md-3 form-control-label sum_alias2"></label>
    													</div>

    													<div class="form-group row"> 
    														<label class="col-md-2 form-control-label">Birthdate:</label>
    														<label class="col-md-3 form-control-label sum_bday"></label>

    														<label class="col-md-2 form-control-label">Age:</label>
    														<label class="col-md-3 form-control-label sum_age"></label>
    													</div>

    													<div class="form-group row">
    														<label class="col-md-2 form-control-label">Gender:</label>
    														<label class="col-md-3 form-control-label sum_gender"></label>

    														<label class="col-md-2 form-control-label">Civil Status:</label>
    														<label class="col-md-3 form-control-label sum_civilstatus"></label>
    													</div>

    													<div class="form-group row">
    														<label class="col-md-2 form-control-label">Country of Birth:</label>
    														<label class="col-md-3 form-control-label sum_country"></label>

    														<label class="col-md-2 form-control-label">Nationality:</label>
    														<label class="col-md-3 form-control-label sum_nationality"></label>
    													</div>
    													<div class="form-group row">
    														<label class="col-md-2 form-control-label">Passport No:</label>
    														<label class="col-md-4 form-control-label sum_passport"></label>
    													</div>
    													<div class="form-group row">
    														<label class="col-md-2 form-control-label">Place of Issuance:</label>
    														<label class="col-md-3 form-control-label sum_issuance_place"></label>

    														<label class="col-md-2 form-control-label">Date of Issuance:</label>
    														<label class="col-md-3 form-control-label sum_issuance_date"></label>
    													</div>
    													<div class="form-group row">
    														<label class="col-md-2 form-control-label">Expiry Date:</label>
    														<label class="col-md-3 form-control-label sum_expiry_date"></label>

    														<label class="col-md-2 form-control-label">Date of Latest Arrival:</label>
    														<label class="col-md-3 form-control-label sum_arrival_date"></label>
    													</div>                                                                
    													<div class="form-group row">
    														<label class="col-md-2 form-control-label">Mobile:</label>
    														<label class="col-md-3 form-control-label sum_mobile"></label>

    														<label class="col-md-2 form-control-label">Landline:</label>
    														<label class="col-md-3 form-control-label sum_landline"></label>
    													</div> 
    													<hr>
    													<div class="form-group row">                                                           
    														<label class="col-md-3 form-control-label">Residential Address in the Philippines:</label>
    														<label class="col-md-5 form-control-label sum_ph_addrs"></label>
    													</div>                                                                
    													<div class="form-group row">
    														<label class="col-md-3 form-control-label">Residential Address Abroad:</label>
    														<label class="col-md-5 form-control-label sum_ab_addrs"></label>
    													</div>
    													<hr>
    												</div>
                                                <!-- Success -->
    												<div class="step5" style="display:none">
    													<div class="row">
    														<div class="col-md-12">
    															<div class="alert alert-success row" role="alert">
    																<div class="form-group text-center">
    																	<br><br>
    																	<label for="reload-notes" class="label-material"><h3>You have successfully completed your application.</h3>
    																	</label>
                                                                        <p>A confirmation e-mail has been sent to <?=$applicant_info->email?></p>
    																</div>
                                                                </div>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-md-7 has-shadow" style="border:solid">
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
                                                                                    <div id="qrcode" style="width: 100px;height: 100px;"></div>
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
                                                                                </div>
                                                                            </div>
                                                                            <hr>
                                                                            <div class="row">
                                                                                <div class="col-md-6 col-sm-6">
                                                                                    <div class="form-group row no-margin-bottom">
                                                                                        <label class="col-md-6 col-sm-6 form-control-label"><strong>Application Date:</strong></label>
                                                                                        <label class="col-md-6 col-sm-6 form-control-label" data-value=""><?=today2()?></label>
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
                                                                                <label class="text-right col-md-6 col-sm-7 form-control-label or-label"><?=today2()?></label>
                                                                            </div>

                                                                            <div class="form-group row">
                                                                                <label class="col-md-5 form-control-label or-label">PAYOR:</label>
                                                                                <label class="text-right col-md-7 form-control-label payor or-label"></label>
                                                                            </div> 

                                                                            <div class="form-group row no-margin-bottom ">
                                                                                <label class="col-md-6 form-control-label or-label ">ASSESSMENT</label>
                                                                                <label class="text-right col-md-6 form-control-label or-label ">AMOUNT</label>
                                                                            </div>   

                                                                            <div class="form-group row no-margin-bottom">
                                                                                <label class="col-md-6 form-control-label or-label">APPLICATION FEE:</label>
                                                                                <label class="text-right col-md-6 form-control-label rcpt_app_fee or-label  with-linebreak">&#8369; 10,000.00</label>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label class="col-md-5 form-control-label or-label">AMOUNT DUE: </label>
                                                                                <label class="text-right col-md-7 form-control-label rcpt_amount or-label">&#8369; 10,000.00</label>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label class="col-md-5 form-control-label or-label">REFERENCE#</label>
                                                                                <label class="text-right col-md-7 form-control-label refNospan or-label"></label>
                                                                            </div>
                                                                        </div>
                                                                        <hr>
                                                                        <a class="btn btn-primary" id="btnPDF">Download as PDF</a>
                                                                    </div>
        														</div>
        													</div>
    												    </div>
                                                    </div>
                                                <!-- Buttons -->
    												<div class="col-lg-12">
    													<button style="float: right;" id="btnVioNext" class="btn btn-primary BtnNext" data-page="0">Next <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
    													<button hidden style="float: right;" id="btnVioNext2" class="btn btn-primary BtnNext2" data-page="0">Next <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
    													<button hidden style="float: right;" id="btnVioNext3" class="btn btn-primary BtnNext3" data-page="0">Next <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
    													<button hidden style="float: right; margin-right:10px;" id="btnVioBack" class="btn btn-danger BtnBack"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button>
    													<button hidden style="float: right; margin-right:10px;" id="btnVioBack2" class="btn btn-danger BtnBack2"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button>
    													<button hidden style="float: right;" id="btnVioProceed" class="btn btn-primary BtnProceed">Proceed <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
    													<button hidden style="float: right; margin-right:10px;" id="btnVioBack3" class="btn btn-danger BtnBack3"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button>
    													<button hidden style="float: right; margin-right:10px;" id="btnVioBack4" class="btn btn-danger BtnBack4"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button>
    												</div>
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

	<?php endif; ?>

	<?php $this->load->view('includes/footer');?> <!-- includes your footer -->

	<script type="text/javascript" src="<?=base_url('assets/js/applicant/application/jquery.qrcode.min.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/applicant/application/application2.js');?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/applicant/application/schedule.js');?>"></script>


