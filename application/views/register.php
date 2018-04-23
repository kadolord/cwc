 	<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?=company_name();?></title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="robots" content="all,follow">
		<!-- Bootstrap CSS-->
		<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
		<!-- Google fonts - Roboto -->
		<link rel="stylesheet" href="<?=base_url('assets/css/google_fonts.css');?>">
		<!-- theme stylesheet--> <!-- we change the color theme by changing color.css -->
		<link rel="stylesheet" href="<?= base_url('assets/css/style.blue.css'); ?>" id="theme-stylesheet">
		<link rel="stylesheet" href="<?=base_url('assets/css/select2-materialize.css');?>">
		<!-- Custom stylesheet - for your changes-->
		<link rel="stylesheet" href="<?= base_url('assets/css/custom.css'); ?>">
		<!-- Favicon-->
		<link rel="shortcut icon" href="<?= base_url('assets/img/favicon.png'); ?>">
		<!-- Font Awesome CDN-->
		<!-- you can replace it by local Font Awesome-->
		<link rel="stylesheet" href="<?=base_url('assets/css/font-awesome.min.css');?>">
		<!-- Font Icons CSS-->
		<link rel="stylesheet" href="<?=base_url('assets/css/myfontastic.css');?>">
		<link rel="stylesheet" href="<?=base_url('assets/css/jquery.toast.css');?>">

		<!-- Bootstrap Datepicker CSS-->
	    <link rel="stylesheet" href="<?=base_url('assets/css/bootstrap-datepicker3.min.css');?>">
		
		<!-- Tweaks for older IEs--><!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
		<style type="text/css">
			input::first-letter{
			    text-transform: uppercase;
			}
		</style>
	</head>
<!-- 	<?php 
		$i = array_rand($images);
		$image = $images[$i]['bg_name'];
	?>	 -->
	<body data-base_url="<?=base_url();?>">
		<div class="page login-page register-page" style="background: url('<?=base_url()."assets/images/".$image;?>') no-repeat center center fixed">
			<div class="container no-padding" >
				<div class="form-holder">
					<div class="">
						<form id="register-form" method="post">
							<div class="step1 col-lg-12 bg-transparent2">
								<div class="content content-padding content-margin" style="text-align: justify; text-justify: inter-word;">
									<h3>About the Alien Legalization Program</h3>
									<p>The Philippines, by virtue of its sovereignity with the the right to allow or deny foreigners from entering its territory. The entry of aliens of aliens redounds to many economic, cultural and social benefits to the country including higher tourism arrivals and increased foreign direct investments.</p>

									<p>There are 5,316,320 aliens in the Philippines not living in their country of birth based on a 2015 United nations report. As of July 2017, the Philippines has a total population of 100, 981,437. And, based on International Organization for Migration of the United Nations, it is estimated that 5.01% of the country's population are composed of aliens living in the country. Based on such estimates, there are 5,059,169 aliens living in the Philippines as of July 2017.
									Out of the 5,059,169, the Bearue of Immigration estimates that 10% are illegal aliens or roughly 505,916 illegal and/or overstaying aliens in the Philippines.</p>

									<p>	The President under Section 9, Chapter 3, Title I, Book IV of the Executive Order No. 292 as ammended, otherwise known as the Revised Administrative  Code of 1987, subject to the provisions of law, is empowered to change the status of non-immigrant aliens by allowing them to acquire permanent residence status without the necessity of visa.</p>

									<p>The Department Order aims to create an immigration program (Alien Legalization Program), where foreigners can be granted legal residence status upon certain conditions which promote the domestic and international interests of the Philippines. The President under Section 9, Chapter 3, Title I, Book IV of Executive Order No. 2912, as ammended, otherwise known as the Revised Administrative Code of 1987, subject to the provisions of law, is empowered to change the status of non-immigrant aliens by allowing them to acquire permanent residence status without necessity of visa.</p>

									<p>	The President, under Section 17, Article VII of the 1987 Constitution, has the power and control over executive departments, bureaus and offices.</p><br>	

									<h4>Declaration of Policy</h4>
									<p>The State Shall control and regulate the admission and integration of aliens into its territory and body politics. Towards this end, aliens with unlawful residence status shall be integrated into the mainstream of Philipiines society to nation security and interest and in deference to internationality recognized human rights.</p><br>	

									<h4>Who are Covered by the Program?</h4>
									<p >	The Alien Legalization Program shall strictly apply to the following undocumented and/or illegal aliens residing in the Philippines.</p>
									<p style="margin-left: 40px">a. Aliens whose stay in the Philippines are otherwise undocumented and/or illegal under exisiting Laws and Rules and have availed in good faith of the benifits of the Alien Registration Program (ARP).</p>
									<p style="margin-left: 40px">b. Minor-dependents of undocumented and/or illegal aliens mentioned above.</p>
									<p style="margin-left: 40px">c. Dependents of aliens who hold Permanent Resident Visa who already reached the age of majority and are otherwise undocumented and/or illegals.</p>
									<p style="margin-left: 40px">d. Native born aliens of undocumented and/or illegal aliens mentioned in letter 'a'.</p>
									<p style="margin-left: 40px">e. Aliens who are not otherwise qualified to apply and register under the existing visas.</p>
									<p style="margin-left: 40px">f. Dependents of aliens under letter 'e'.</p><br>	

									<h4>What are the Requirements?</h4>
									<p>	Registration form that contains the following:</p>
									<p style="margin-left: 40px">1. Applicant's full name and one alias by which they may be known.</p>
									<p style="margin-left: 40px">2. Proof of their identity, good moral and financial capacity through affidavits from two (2) Filipino citizens of good reputation in their place of residence.</p>
									<p style="margin-left: 40px">3. History os stay in the Philippines.</p>
									<p style="margin-left: 40px">4. Residential address for the immediate past five (5) years.</p>
									<p style="margin-left: 40px">5. Four (4) passport size pictures</p>
								
									<p>	Payment of the integration fee with the BI:</p>
									<p style="margin-left: 40px">1.  A one-time payment of Php 200, 000.00 for the principal applicant upon filing of the registration forms with the BI.</p>
									<p style="margin-left: 40px">2. A single payment of Php 100, 000.00 for the applicants dependents.</p>

									<p>Medical Certificates</p>
									<p style="margin-left: 40px">1. Certifying that they are not afflicted with AIDS.</p>
									<p style="margin-left: 40px">2. Certifying that they are not under the influence of prohibited drugs.</p>
									<p style="margin-left: 40px">3. Certifying that they are psychologically and mentally healthy.</p>
									<hr>

	                                <div class="form-check text-right">
	                                    <input id="understoodCheck" type="checkbox" value="" class="checkbox-template termsCheckbox">
	                                    <label for="understoodCheck" class="form-check-label"><strong>I understand and agree</strong></label>
	                                </div>

									<div class="clearfix"></div>
				                        <div style="float: right; margin-left: 7px;"> 
											<button hidden id="buttonNext" class="btn btn-primary " data-page="0">Next <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
										</div>	
									<div style="float: left;"> 
			                            <a id="home" href="<?=base_url()."Main"?>" class="btn btn-primary">Home <i class="fa fa-home" aria-hidden="true"></i></a>
									</div>
								</div>
							</div>
						
							<div class="step2 col-lg-12 bg-transparent2 content-margin" style="display:none">
								<div class="form d-flex align-items-center">
									<div class="content">
										<h1>Registration Form</h1>
										<br>
											<div class="col-lg-12">
												<div class="row row-reg">
													<div class="col-lg-12">
														<div class="form-group">
															<label for="register-firstname" class="label-material">ACR I-CARD NUMBER (if any)</label>
															<input id="register-Icard" autofocus type="text" name="registerIcard" class="form-control col-lg-6 form-control-sm">
														</div>
													</div>

													<div class="col-lg-12">
														<div class="form-group">
															<h4 for="register-firstname" class="label-material"><strong>Personal Information</strong></h4>
														</div>
													</div>

													<div class="col-lg-3">
														<div class="form-group">
															<label for="register-middlename" class="label-material">First / Given Name<span class="text-danger">*</span></label>
															<input id="register-middlename" type="text" name="registerFirstname" class="form-control form-control-sm registerFirstname required_fields">
														</div>
													</div>

													<div class="col-lg-3">
														<div class="form-group">
															<label for="register-lastname" class="label-material">Middle Name</label>
															<input type="text" name="registerMiddlename" class="form-control form-control-sm">
														</div>
													</div>

													<div class="col-lg-3">
														<div class="form-group">
															<label for="register-firstname" class="label-material">Last Name <span class="text-danger">*</span></label>
															<input id="register-firstname" type="text" name="registerLastname" class="form-control form-control-sm registerLastname required_fields">
														</div>
													</div>
													<div class="col-lg-3">
														<div class="form-group">
															<label for="register-firstname" class="label-material">Name Extension</label>
															<input id="register-exttname" type="text" name="registerExtname" class="form-control form-control-sm registerExtname">
														</div>
													</div>

													<div class="col-lg-6">
														<div class="form-group">
															<label for="register-lastname" class="label-material">Alias 1</label>
															<input type="text" name="registerAlias1" class="form-control form-control-sm">
														</div>
													</div>

													<div class="col-lg-6">
														<div class="form-group">
															<label for="register-lastname" class="label-material">Alias 2</label>
															<input type="text" name="registerAlias2" class="form-control form-control-sm">
														</div>
													</div>

													<div class="col-lg-3">
														<div class="form-group">
															<label for="register-bday" class="label-material active">Birthdate <span class="text-danger">*</span></label>
															<input id="register-bday" type="text" name="registerBday" value="" class="form-control form-control-sm registerBday required_fields">
														</div>
													</div>

													<div class="col-lg-3">
														<div class="form-group">
															<label for="register-contactno" class="label-material">Age <span class="text-danger">*</span></label>
															<input readonly type="text" style="background-color:#FFFFFF" name="registerAge" class="form-control form-control-sm registerAge required_fields">
														</div>
													</div>

													<div class="col-lg-3">
														<div class="form-group">
															<label for="register-contactno" class="label-material">Gender <span class="text-danger">*</span></label>

															<div class="i-checks">
																<input id="register-gendermale" type="radio" value="1" name="registerGender" class="radio-template registerGender" checked>
																<label for="register-gendermale" style="width:80px;">Male</label>
														
																<input id="register-genderfemale" type="radio" value="2" name="registerGender" class="radio-template">
																<label for="register-genderfemale">Female</label>
															</div>
														</div>
													</div>

													<div class="col-lg-3">
														<div class="form-group">
															<label for="register-contactno" class="form-control-label">Civil Status <span class="text-danger">*</span></label>
															<select name="registerCivilstatus" class="form-control form-control-sm registerCivilstatus required_fields" id="register-civilstatus" required="">
																<option selected hidden value="">
																	Select Status
																</option>
																<?php
																foreach ($get_civil_status->result() as $gcs){
																?>
																	<option value="<?=$gcs->civil_status_id?>">
																		<?=$gcs->name?>
																	</option>
																<?php } ?>
															</select>
														</div>
													</div>

													<div class="col-lg-6">
														<div class="form-group">
															<label for="register-country" class="form-control-label col-form-label-sm">Country of Birth<span class="text-danger">*</span></label>
															<select name="registerCountry" class="form-control form-control-sm registerCountry required_fields" id="register-country">
																<option selected hidden value="">
																	Select Country
																</option>
																<?php
																	foreach ($get_country->result() as $gcountry){
																	?>
																		<?php if($gcountry->country != 'Philippines'): ?>
																			<option value="<?=$gcountry->country_id?>">
																				<?=$gcountry->country?>
																			</option>
																		<?php endif;  ?>
																<?php } ?>
															</select>
														</div>
													</div>

													<div class="col-lg-6">
														<div class="form-group">
															<label for="register-contactno" class="label-material">Citizenship / Nationality <span class="text-danger">*</span></label>
															<input type="text" name="registerCitizenship" class="form-control form-control-sm registerCitizenship required_fields">
														</div>
													</div>

													<div class="col-lg-4">
														<div class="form-group">
															<label for="register-contactno" class="label-material">Passport Number</label>
															<input type="text" name="registerPassport" class="form-control form-control-sm">
														</div>
													</div>

													<div class="col-lg-4">
														<div class="form-group">
															<label for="register-contactno" class="label-material">Date of Issuance</label>
															<input type="text" name="registerIssuanceDate" value="" class="form-control form-control-sm datepicker2">
														</div>
													</div>

													<div class="col-lg-4">
														<div class="form-group">
															<label for="register-contactno" class="label-material">Expiry Date</label>
															<input type="text" name="registerExpiryDate" value="" class="form-control form-control-sm datepicker2">
														</div>
													</div>

													<div class="col-lg-8">
														<div class="form-group">
															<label for="register-contactno" class="label-material">Place of Issuance</label>
															<input type="text" name="registerIssiuanceplace" class="form-control form-control-sm">
														</div>
													</div>

													<div class="col-lg-4">
														<div class="form-group">
															<label for="register-contactno" class="label-material">Date of Latest Arrival</label>
															<input type="text" value="" name="registerArrivalDate" class="form-control form-control-sm datepicker2">
														</div>
													</div>

													<div class="col-lg-12">
														<div class="form-group">
															<h5 for="register-firstname" class="label-material"><strong>Contact Number(s) in the Philippines</strong></h5>
														</div>
													</div>

													<div class="col-lg-4">
														<div class="form-group">
															<label for="register-contactno" class="label-material">Email Address<span class="text-danger">*</span></label>
															<input type="text" name="registerEmail" class="form-control form-control-sm registerEmail required_fields">
														</div>
													</div>
													<div class="col-lg-4">
														<div class="form-group">
															<label for="register-contactno" class="label-material editable">Landline</label>
															<input type="text" name="registerLandline" class="form-control form-control-sm">
														</div>
													</div>

													<div class="col-lg-4">
														<div class="form-group">
															<label for="register-contactno" class="label-material editable">Mobile Number</label>
															<input type="text" name="registerMobile" class="form-control form-control-sm">
														</div>
													</div>


													<div class="col-lg-12">
														<div class="form-group">
															<h5 for="register-firstname" class="label-material"><strong>Residential Address in the Philippines</strong></h5>
														</div>
													</div>

													<div class="col-lg-4">
														<div class="form-group">
															<label for="register-contactno" class="label-material">House/Unit No., Street</label>
															<input type="text" name="registerStreet" class="form-control form-control-sm editable">
														</div>
													</div>											

													<div class="col-lg-4">
														<div class="form-group">
															<label for="register-contactno" class="label-material">Subdivision / Village</label>
															<input type="text" name="registerVillage" class="form-control form-control-sm editable">
														</div>
													</div>

													<div class="col-lg-4">
														<div class="form-group">
															<label for="register-contactno" class="label-material">Barangay</label>
															<input type="text" name="registerBarangay" class="form-control form-control-sm editable">
														</div>
													</div>

													<div class="col-lg-4">
														<div class="form-group">
															<label for="register-contactno" class="label-material">Municipality / City</label>
															<input type="text" name="registerCity" class="form-control form-control-sm editable">
														</div>
													</div>

													<div class="col-lg-4">
														<div class="form-group">
															<label for="register-contactno" class="label-material">Province</label>
															<input type="text" name="registerProvince" class="form-control form-control-sm editable">
														</div>
													</div>

													<div class="col-lg-4">
														<div class="form-group">
															<label for="register-contactno" class="label-material">Zip Code</label>
															<input type="text" maxlength="4" name="registerZipcode" class="form-control form-control-sm editable">
														</div>
													</div>

													<div class="col-lg-12">
														<div class="form-group">
															<h5 for="register-firstname" class="label-material"><strong>Residential Address Abroad</strong></h5>
														</div>
													</div>

													<div class="col-lg-4">
														<div class="form-group">
															<label for="register-contactno" class="label-material">House/Unit No., Street</label>
															<input type="text" name="registerStreet2" class="form-control form-control-sm">
														</div>
													</div>											

													<div class="col-lg-4">
														<div class="form-group">
															<label for="register-contactno" class="label-material">Subdivision / Village</label>
															<input type="text" name="registerVillage2" class="form-control form-control-sm">
														</div>
													</div>

													<div class="col-lg-4">
														<div class="form-group">
															<label for="register-contactno" class="label-material">City</label>
															<input type="text" name="registerCity2" class="form-control form-control-sm">
														</div>
													</div>

													<div class="col-lg-4">
														<div class="form-group">
															<label for="register-contactno" class="label-material">State</label>
															<input type="text" name="registerState" class="form-control form-control-sm">
														</div>
													</div>

													<div class="col-lg-4">
														<div class="form-group">
															<label for="register-contactno" class="label-material">Country</label>
	                                                        <select name="registerCountry2" class="form-control form-control-sm registerCountry2" id="register-country2" required="">
	                                                            <option selected hidden disabled value="">
	                                                                Select Country
	                                                            </option>
	                                                            <?php
	                                                            foreach ($get_country->result() as $gcountry){
	                                                            ?>
	                                                                <?php if($gcountry->country != 'Philippines'): ?>
	                                                                <option value="<?=$gcountry->country_id?>">
	                                                                    <?=$gcountry->country?>
	                                                                </option>
	                                                            <?php endif;  ?>
	                                                            <?php } ?>
	                                                        </select>
															<!-- <input type="text" name="registerCountry2" class="form-control form-control-sm"> -->
														</div>
													</div>

													<div class="col-lg-4">
														<div class="form-group">
															<label for="register-contactno" class="label-material">Zip Code</label>
															<input type="text" name="registerZipcode2" class="form-control form-control-sm">
														</div>
													</div>
												</div>
											</div>

				                        	<div class="clearfix"></div>
				                        	<div style="float: right; margin-left: 7px;"> 
												<button id="buttonNext2" class="btn btn-primary">Next</button>
											</div>	
											<div style="float: right;"> 
					                            <button id="buttonBack1" type="button" class="btn btn-danger">Previous</button>
											</div>
										
									</div>
								</div>
							</div>

							<div class="step3 col-lg-6 bg-transparent2 content-margin offset-lg-3" style="display:none">
								<div class="form d-flex align-items-center">
									<div class="content">
										<h3>Login Details</h3>
										<div class="col-lg-12">
											<div class="form-group">
												<label for="register-lastname" class="label-material">Email<span class="text-danger">*</span></label>
												<input type="text" name="registerEmail2" class="form-control form-control-sm registerEmail2 required_fields2">
											</div>
										</div>

										<div class="col-lg-12">
											<div class="form-group">
												<label for="register-lastname" class="label-material">Password<span class="text-danger">*</span></label>
												<input type="password" name="registerPassword" class="form-control form-control-sm required_fields2">
											</div>
										</div>

										<div class="col-lg-12">
											<div class="form-group">
												<label for="register-bday" class="label-material active">Confirm Password<span class="text-danger">*</span></label>
												<input type="password" name="registerRepassword" class="form-control form-control-sm required_fields2">
											</div>
										</div>

										<div class="clearfix"></div>
				                        <div style="float: right; margin-left: 7px;"> 
											<button id="buttonRegister" class="btn btn-primary btnReg">Register</button>
										</div>	
										<div style="float: right;"> 
				                            <button id="buttonBack2" type="button" class="btn btn-danger">Previous</button>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
	
			<div class="copyrights text-center">
				<p><span style="background-color: rgba(0,0,0,.6); padding: 4px;border-radius: 7px;"">Powered by <a href="http://www.cloudpanda.ph/" class="external">Cloud Panda PH</a></span></p>

			</div>
		</div>


	<!-- Javascript files-->
	<script src="<?=base_url('assets/js/jquery.min.js');?>"></script>
	<script src="<?=base_url('assets/js/jquery-ui.js');?>"></script>
	<script src="<?=base_url('assets/js/tether.min.js');?>"></script>
	<script src="<?=base_url('assets/js/bootstrap.min.js');?>"></script>
	<script src="<?=base_url('assets/js/jquery.cookie.js');?>"> </script>
	<script src="<?=base_url('assets/js/jquery.validate.min.js');?>"></script>
	<script src="<?=base_url('assets/js/jquery.dataTables.js');?>"></script>
	<script src="<?=base_url('assets/js/select2.min.js');?>"></script>
	<script src="<?=base_url('assets/js/bootstrap-datepicker.min.js');?>"></script>
	<script src="<?=base_url('assets/js/accounting.min.js');?>"></script>
	<script src="<?=base_url('assets/js/moment.js');?>"></script>
	<script src="<?=base_url('assets/js/jquery.steps.js');?>"></script>
	<!-- custom script for your overall script -->
	<script src="<?=base_url('assets/js/custom.js');?>"></script>
	<!-- uncomment this if you need charts -->
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
	<script src="js/charts-home.js"></script> -->
	<!-- uncomment this if you need charts -->
	<script src="<?=base_url('assets/js/front.js');?>"></script>
	<script src="<?= base_url('assets/js/jquery.toast.js'); ?>"></script>
	<!-- Google Analytics: change UA-XXXXX-X to be your site's ID.-->
	<!---->
	<script>
	(function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
	function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
	e=o.createElement(i);r=o.getElementsByTagName(i)[0];
	e.src='<?=base_url('assets/js/analytics.js');?>';
	r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
	ga('create','UA-XXXXX-X');ga('send','pageview');
	</script>
	<script src="<?=base_url('assets/js/register.js');?>"></script>
	</body>


</html>