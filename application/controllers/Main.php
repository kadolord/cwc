<?php 

class Main extends CI_Controller{

		//FOR TRANSACTION

	public function view_application($token = ''){

		$this->isLoggedIn();

		$data_applicant = array(
			'token' => $token,
			'app_type' => $this->model->get_app_type(),
			'app_requirement' =>$this->model->get_app_requirement(),
			'applicant_info' => $this->model->getApplicantInfo($this->session->userdata('email'))->row(),
			'isAlreadyApplied' => false,
			'get_civil_status' => $this->model->get_civil_status(),
			'get_country' => $this->model->get_country(),
			'centers' => $this->model->get_center(),
			'get_process' =>$this->model->getProcessType()
		);

			//check if applicant has existing application
		$query = $this->model->checkIfApplicantHasAlreadyApplied($this->session->userdata('email'));

			if(!$query){ // If no application
				$this->load->view('includes/header',$data_applicant);
				$this->load->view('applicant/transaction/applications', $data_applicant);
			} else{ // If already applied
				// Include details in data_applicant

				$data_applicant = array(
					'token' => $token,
					'app_type' => $this->model->get_app_type(),
					'app_requirement' =>$this->model->get_app_requirement(),
					'applicant_info' => $this->model->getApplicantInfo($this->session->userdata('email'))->row(),
					'isAlreadyApplied' => true,
					'application_info' =>$this->model->getApplicationInfoUsingEmail($this->session->userdata('email'))->row(),
					'get_civil_status' => $this->model->get_civil_status(),
					'get_process' =>$this->model->getProcessType()
				);

				$this->load->view('includes/header',$data_applicant);
				$this->load->view('applicant/transaction/applications', $data_applicant);
			}				
		}

		public function upload_document(){

			$F = array();
			$count_uploaded_files = count( $_FILES['images']['name'] );
			$document_id = sanitize($this->input->post('requirement_id'));
			$applicant_email = $this->session->userdata('email');

			$uploaded_docs = $this->model->get_uploaded_docs($applicant_email);

			$id_counter = 0;

			if($uploaded_docs->num_rows() > 0){
				$docs_uploaded = $uploaded_docs->result();
				foreach($docs_uploaded as $doc){
					if($doc->document_type_id ==  $document_id){
						$id_counter++;
					}
				}
			}

			$files = $_FILES;
			for( $i = 0; $i < $count_uploaded_files; $i++ )	{

				$filename = str_replace(' ', '_',$files['images']['name'][$i]);
				$tmp = explode('.', $filename);
				$document_ext = end($tmp);
				$raw_filename = microtime(true);
    			$document = str_replace(".","_",$raw_filename) . ".".$document_ext;

				$_FILES['userfile'] = [
					'name'     => $document,
					'type'     => $files['images']['type'][$i],
					'tmp_name' => $files['images']['tmp_name'][$i],
					'error'    => $files['images']['error'][$i],
					'size'     => $files['images']['size'][$i]
				];

				$F[] = $_FILES['userfile'];
		        //Upload requirements
				$config['upload_path'] = './assets/img/applicant_documents';
				$config['allowed_types'] = 'jpg|png|jpeg|pdf';
				$config['max_size'] = '2048';
				$config['remove_spaces'] = true;

				
				$this->load->library('upload',$config);

				if( ! $this->upload->do_upload() ){ 
					$data = array("success" => 0, 'message' => $this->upload->display_errors());
					
				}else{
			        // Here is where you do your CodeIgniter upload ...

					if($id_counter >= 2){
						$old_uploaded_doc_id = $this->model->get_oldest_uploaded_docs($applicant_email, $document_id)->row()->uploaded_doc_id;
						$this->model->replace_upload_document($document, $applicant_email, $old_uploaded_doc_id, $document_ext);
						$data = array("success" => 1, 'message' => 'Document Successfully Uploaded');
					}else{
						$this->model->upload_document($document, $applicant_email, $document_id, $document_ext);
						$data = array("success" => 1, 'message' => 'Document Successfully Uploaded');
					}
				}
				
			}
			generate_json($data);
		}

		public function create_application(){

			$process_lane = sanitize($this->input->post('process_lane'));
			$payment_mode = sanitize($this->input->post('payment_mode'));
			$app_fee = sanitize($this->input->post('application_fee'));
			$con_fee = sanitize($this->input->post('convenience_fee'));
			$total_fee = sanitize($this->input->post('total_amount'));
			$total_fee_receipt = sanitize($this->input->post('amount_receipt'));
			$app_id = sanitize($this->input->post('app_type_id'));
			$reference_no = sanitize($this->input->post('reference_no'));
			$app_branch_id = sanitize($this->input->post('app_branch_id'));
			$app_date = sanitize($this->input->post('app_date'));
			$app_time = sanitize($this->input->post('app_time'));
			$qrcode = sanitize($this->input->post('qrcode'));

			//get available OR #
			$bid_or_no = $this->model->getBidOr()->row()->or_no;

			$getApplicantInfo = $this->model->getApplicantInfo($this->session->userdata('email'))->row();
			$applicant_id = $getApplicantInfo->applicant_id;
            $applicant_name = $getApplicantInfo->first_name . " ". $getApplicantInfo->last_name. " ". $getApplicantInfo->ext_name;

			if ($applicant_id == ""){
				$this->logout();
			}else{
				$app_date = date_format(date_create($app_date),"Y-m-d");
				$applicant_email = $this->session->userdata('email');

				$this->model->insertApplicationLog($applicant_email, $reference_no,$app_id,$app_branch_id,$app_date,$app_time,$total_fee_receipt, $total_fee,$bid_or_no,$qrcode,$process_lane,$payment_mode,$app_fee,$con_fee);

				//Update OR Tables so OR# used will not be available
                // this code is for sending email
				$this->load->library('email');


				$token_email = en_dec('en','CloudPandaPHInc');
				$receivername = $applicant_name;
				$verify_href = base_url('Main/pdf_acrs_application/'.$reference_no);'';

				$subject = "Application Confirmation";
                        // Get full html:
				$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
				<meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
				<title>' . html_escape($subject) . '</title>
				<style type="text/css">
				body {
					font-family: Arial, Verdana, Helvetica, sans-serif;
					font-size: 16px;
				}
				</style>
				</head>
				<body>
				<table style="width:538px;background-color:#393836; box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.3);" align="center" cellspacing="0" cellpadding="0">
				<tbody>
				<tr>
				<td style="height:65px; background-color:#2f333e; border-bottom:1px solid #4d4b48;padding:0px; text-align:center; color:white; ">
				<h1 style="font-weight:lighter;">Alien Census Registration System</h1>
				</td>
				</tr>
				<tr>
				<td bgcolor="#eef5f9" style="">

				<table width="470" border="0" align="center" cellpadding="0" cellspacing="0" style="padding-left:5px;padding-right:5px;padding-bottom:10px">

				<tbody><tr bgcolor="white">
				<td style="padding-left:10px; padding-top:32px;padding-bottom:16px">
				<span style="font-size:24px;color:#292b2c;font-family:Arial,Helvetica,sans-serif;font-weight:bold; word-break: break-all;">
				Dear '.$receivername.',
				</span><br>
				</td>
				</tr>

				<tr bgcolor="white">
				<td style="padding:20px;font-size:12px;line-height:17px;color:#292b2c;font-family:Arial,Helvetica,sans-serif">
                <p>You have successfully completed your application for BoI Alien Census Registration System</p>
				<p>Your Reference Number is <strong>' .$reference_no.'</strong></p>
				<p><a style="color:#292b2c text-decoration:underline;" href="'.$verify_href.'">Click here to download your application form as PDF file.</a></p>
				</td>
				</tr>

				<tr>
				<td style="padding-top:16px;font-size:12px;line-height:17px;color:#292b2c;font-family:Arial,Helvetica,sans-serif">
				<p>This e-mail message is intended for the use of the individual or the entity to whom it is addressed and may contain information that is privileged, proprietary, confidential and exempt from disclosure. If you are not the intended recipient, you are notified that any dissemination, distribution or copying of this communication is strictly prohibited. If you have received this communication in error, please notify the sender and delete this e-mail message immediately.
                </p>
				</td>

				</tr>

				<tr>
				<td style="font-size:12px;color:#292b2c;padding-top:16px;padding-bottom:60px">
				<p>Thanks for using the Alien Census Registration System website
				The Cloud Panda PH Team
				<a style="color:#8f98a0" href="https://cloudpanda.ph/" target="_blank" data-saferedirecturl="https://cloudpanda.ph/">https://cloudpanda.ph</a><br>
				</p></td>
				</tr>

				</tbody></table>
				</td>
				</tr>
				<tr>
				<td bgcolor="white">

				<table width="460" height="55" border="0" align="center" cellpadding="0" cellspacing="0">

				<tbody><tr valign="top">
				<td width="110">
				<a href="https://cloudpanda.ph/">
				<img src="http://cloudpanda.cloudpanda.com.ph/apiv3/release/iphone/10/photo/root_swipe_header_elements_150195765219_image@iphone6plus.jpg?v=1501957847" alt="cloudpanda" width="55" hspace="0" vspace="0" border="0" align="top" class="CToWUd"></a>
				</td>
				<td width="350" >
				<div style="color:#292b2c; font-size:9px;font-family:Verdana,Arial,Helvetica,sans-serif; margin-top:22px; margin-left: 28px;">© Cloud Panda PH Inc. All rights reserved.</div>
				</td>
				</tr>

				</tbody></table>
				</td>
				</tr>
				</tbody>
				</table>
				</body>
				</html>';
                        // Also, for getting full html you may use the following internal method:
                        //$body = $this->email->full_html($subject, $message);

				$result = $this->email
				->from('support@cloudpanda.ph')
                                ->reply_to('')    // Optional, an account where a human being reads.
                                ->to($applicant_email)
                                ->subject($subject)
                                ->message($body)
                                ->send();
                 //end of sending email

                    $data = array('success' => 1, 'or_no' => $bid_or_no) ;
                }

                generate_json($data);
            }

            public function termsandcondition(){
            	$this->load->view('includes/terms_and_conditions');
            }

            public function checkIfApplicantHasExistingAppointment(){

            	$applicant_id = $this->session->userdata('user_id');
            	$query = $this->model->checkIfApplicantHasExistingAppointment($applicant_id);

            	echo json_encode($query);
            }

            public function view_schedule_appointment($token = ''){

            	$this->isLoggedIn();
            	$applicant_info = $this->model->getApplicantInfo($this->session->userdata('email'))->row();
            	$applicant_no = $applicant_info ->applicant_no;
            	$applicant_id = $applicant_info->user_id;
            	$reschedule_fee = $this->model->getReschedFee()->row()->resched_fee;
            	$reschedule_limit = $this->model->getReschedFee()->row()->resched_limit;


			// Check if applicant has existing appointment
			if($this->model->checkIfApplicantHasExistingAppointment($applicant_no)->num_rows() > 0){ //Has already scheduled appointment

				$data_applicant = array(
					'token' => $token,
					'centers' => $this->model->get_center(),
					'applicant_info' => $this->model->getApplicantInfo($this->session->userdata('email'))->row(),
					'appointment_info' => $this->model->checkIfApplicantHasExistingAppointment($applicant_no)->row(),
					'hasAppointment' => true,
					'resched_fee' => $reschedule_fee,
					'resched_limit' =>$reschedule_limit
				);

				$this->load->view('includes/header', $data_applicant);
				$this->load->view('applicant/transaction/schedule', $data_applicant);

			} else { // No appointment yet

			//Check if applicant has already applied

				$query = $this->model->checkIfApplicantHasAlreadyApplied($this->session->userdata('email'));
			if(!$query) { // If not yet

				$data_applicant = array(
					'token' => $token,
					'centers' => $this->model->get_center(),
					'applicant_info' => $this->model->getApplicantInfo($this->session->userdata('email'))->row(),
					'isAlreadyApplied' => false,
					'hasAppointment' => false,
					'resched_fee' => $reschedule_fee,
					'resched_limit' =>$reschedule_limit
				);
			} else { // If already applied

				$data_applicant = array(
					'token' => $token,
					'centers' => $this->model->get_center(),
					'applicant_info' => $this->model->getApplicantInfo($this->session->userdata('email'))->row(),
					'isAlreadyApplied' => true,
					'hasAppointment' => false,
					'resched_fee' => $reschedule_fee,
					'resched_limit' =>$reschedule_limit
				);
			}

			$this->load->view('includes/header',$data_applicant);
			$this->load->view('applicant/transaction/schedule', $data_applicant);

		}	
	}

	public function get_available_appointment_date(){

		$app_date = sanitize($this->input->post('date'));
		$app_branch_id = sanitize($this->input->post('branch_id'));
		$dates_with_sched = array();


		if ($app_date == "" || $app_branch_id == "") {
			$data = array("success" => 0, 'message' => 'Please select appointment branch.');
		}else{

			$app_date = date_format(date_create($app_date),"Y-m-d");
			$date_is_set = false;

			//getting the start and end date AND saving all the dates in an array
			$query = $this->model->get_sched_limit_created_by_branch_admin($app_branch_id)->result();
			if(count($query) > 0){
				foreach($query as $row){
					$begin = $row->start_date;
					$end = $row->end_date;

					for ($i = $begin; $i <= $end;$i->modify('+1 day')){
						array_push($dates_with_sched,  $i->format("Y-m-d"));
					}
				}
			}else{
				$query = $this->model->get_sched_limit($app_branch_id)->result();
				if(count($query) > 0){
					foreach($query as $row){
						$begin = $row->start_date;
						$end = $row->end_date;
						for ($i = new DateTime($begin); $i<= new DateTime($end) ;$i->modify('+1 day')){
							array_push($dates_with_sched,  $i->format("Y-m-d"));
						}
					}
				}
			}

			foreach($dates_with_sched as $date){
				if($app_date == $date){
					$date_is_set = true;
					break;
				}
			}


			if($date_is_set){

				//check if someone has already applied on that day and branch
				$query = $this->model->get_available_appointment_date($app_date, $app_branch_id);
				$sched_limit = $this->model->get_sched_limit($app_branch_id)->result();

				$applicant_applied = $query->num_rows(); //count number of applicants applied
				$applicant_counter = 0; //initialize applicant number

				if(count($sched_limit) > 0){
					$is_branch_sched_set = false;
					foreach ($sched_limit as $sched) {
						if($sched->created_by == 3){
							$is_branch_sched_set = true;
							$day_limit = $sched->day_limit;
							$hour_limit = $sched->hour_limit;
						}
					}

					if(!$is_branch_sched_set){
						foreach ($sched_limit as $sched) {
							$day_limit = $sched->day_limit;
							$hour_limit = $sched->hour_limit;
						}
					}
				}else{
					$day_limit = 0;
					$hour_limit = 0;
				}

				if($day_limit == 0){
					
					$unavailable_time = "true";
						// $unavailable_time = [1,2,3,4,5,6,7,8,9];
				}
				if($applicant_applied == 0 && $day_limit > 0){
				
					$unavailable_time = "false";
				}
				if($applicant_applied > 0 && $applicant_applied >= $day_limit){
				
					$unavailable_time = "true";
						// $unavailable_time = [1,2,3,4,5,6,7,8,9];
				}

				if($applicant_applied > 0 && $applicant_applied < $day_limit){
				
					foreach($query->result() as $result){
						$unavailable_time = array();
						if($result->app_branch_time == 1){
							$applicant_counter++;
							if($applicant_counter >= $hour_limit){
								array_push($unavailable_time,1 );
							}
						}else if($result->app_branch_time == 2){
							$applicant_counter++;
							if($applicant_counter >= $hour_limit){
								array_push($unavailable_time,2 );
							}
						}else if($result->app_branch_time == 3){
							$applicant_counter++;
							if($applicant_counter >= $hour_limit){
								array_push($unavailable_time,3 );
							}
						}else if($result->app_branch_time == 4){
							$applicant_counter++;
							if($applicant_counter >= $hour_limit){
								array_push($unavailable_time,4 );
							}
						}else if($result->app_branch_time == 5){
							$applicant_counter++;
							if($applicant_counter >= $hour_limit){
								array_push($unavailable_time,5 );
							}
						}else if($result->app_branch_time == 6){
							$applicant_counter++;
							if($applicant_counter >= $hour_limit){
								array_push($unavailable_time,6 );
							}
						}else if($result->app_branch_time == 7){
							$applicant_counter++;
							if($applicant_counter >= $hour_limit){
								array_push($unavailable_time,7 );
							}
						}else if($result->app_branch_time == 8){
							$applicant_counter++;
							if($applicant_counter >= $hour_limit){
								array_push($unavailable_time,8 );
							}
						}else if($result->app_branch_time == 9){
							$applicant_counter++;
							if($applicant_counter >= $hour_limit){
								array_push($unavailable_time,9 );
							}
						}
					}
			
				}

				$data = array("success" => 1, 'message' => 'Select available dates in the calendar!', 'unavailable_time' => $unavailable_time);
			}else{
				$unavailable_time = "true";
				$data = array("success" => 1, 'message' => 'Select available dates in the calendar!', 'unavailable_time' => $unavailable_time);
			}
			
		}

		generate_json($data);
	}

	public function schedule_appointment(){

		$applicant_info = $this->model->getApplicantInfo($this->session->userdata('email'))->row();
		$applicant_no = $applicant_info ->applicant_no;
		$reference_no = $this->model->getApplicationInfoUsingEmail($this->session->userdata('email'))->row()->reference_no;

		$email_fk = $this->session->userdata('email');

		$app_center = sanitize($this->input->post('branch_name'));
		$app_date = sanitize($this->input->post('appointment-date'));
		$app_time = sanitize($this->input->post('appointment-time'));


		if ($app_center == "" || $app_date == "" || $app_time == "" || $reference_no == "" ) {
			$data = array("success" => 0, 'message' => 'Please fill up all required fields.');
		}else{

			
			$app_date = date_format(date_create($app_date),"Y-m-d");

			$query = $this->model->schedule_appointment($applicant_no, $app_center, $app_date, $app_time, $reference_no);
			$data = array("success" => 1, 'message' => 'Successfully created appoinment!', 'affected rows' => $query);


		}

		generate_json($data);
	}

	public function update_appointment(){

		$app_id = sanitize($this->input->post('appointment_id'));
		$app_center = sanitize($this->input->post('branch_name'));
		$app_date = sanitize($this->input->post('appointment-date'));
		$app_time = sanitize($this->input->post('appointment-time'));
		

		if ($app_id == "" || $app_center == "" || $app_date == "" || $app_time == "" ) {

			$data = array("success" => 0, 'message' => 'Please fill up all required fields.');
		}else{

			$app_date = date_format(date_create($app_date),"Y-m-d");
			$query = $this->model->update_appointment($app_center, $app_date, $app_time, $app_id);
			$data = array("success" => 1, 'message' => 'Successfully updated appoinment!', 'affected rows' => $query);
		}
		generate_json($data);
	}

	public function view_upload_requirement($token = ''){

		$this->isLoggedIn();

		$data_admin = array(
				 // get data using email
			'token' => $token,
			'centers' => $this->model->get_center(),
			'admin_info' => $this->model->getAdminInfo($this->session->userdata('email'))->row()
		);

		$data_applicant = array(
			'token' => $token,
			'centers' => $this->model->get_center(),
			'applicant_info' => $this->model->getApplicantInfo($this->session->userdata('email'))->row()
		);

			if ($this->session->userdata('position_id') == '1') { // admin
				$this->load->view('includes/admin_header', $data_admin);
				$this->load->view('admin/profile/information', $data_admin);
			}else if ($this->session->userdata('position_id') == '2') { // applicant
				$this->load->view('includes/header', $data_applicant);
				$this->load->view('applicant/profile/upload_requirements', $data_applicant);
			}

		}

		// public function upload_requirement($token = ''){

		// 	$this->isLoggedIn();

		// 	//Upload requirements
		// 	$applicant_info = $this->model->getApplicantInfo($this->session->userdata('email'))->row();
		// 	$applicant_id = $applicant_info ->applicant_no;
		// 	$config['upload_path'] = './assets/img/applicant_requirements';
		// 	$config['allowed_types'] = 'gif|jpg|png|jpeg';

		// 	$this->load->library('upload',$config);

		// 	if( ! $this->upload->do_upload() ){
		// 		$errors = array('error' => $this->upload->display_errors());
		// 		$requirement = 'noimage.jpg';
		// 	}else{
		// 		$data = array('upload_data' => $this->upload->data());
		// 		$requirement = $_FILES['userfile']['name'];
		// 	}

		// 	$this->model->upload_requirement($requirement, $applicant_id);
		// 	$this->session->set_flashdata('upload_requirement', 'Your requirement has been uploaded');
		// 	$this->view_upload_requirement($token);

		// }

		function upload_requirements(){
			if($_FILES["files"]["name"] != ''){
				$output = '';
				$config["upload_path"] = './assets/img/applicant_requirements/';
				$config["allowed_types"] = 'gif|jpg|png';
				$this->load->library('upload',$config);
				$this->upload->initialize($config);
				for($i = 0; $i<count($_FILES["files"]["name"]);$i++){
					$_FILES["files"]["name"] = $_FILES["files"]["name"][$i];
					$_FILES["files"]["type"] = $_FILES["files"]["type"][$i];
					$_FILES["files"]["tmp_name"] = $_FILES["files"]["tmp_name"][$i];
					$_FILES["files"]["error"] = $_FILES["files"]["error"][$i];
					$_FILES["files"]["size"] = $_FILES["files"]["size"][$i];

					if($this->upload->do_upload('file')){
						$data = $this->upload->data();
						$output = '
						<div class="col-md-3">
						<img src="'.base_url().'assets/img/applicant_requirements/'.$data["file_name"].'" class = "img-responsive img-thumbnail">
						</div>';
					}
				}
				echo $output;
			}
		}

		public function index_orig(){

			$this->load->view('login');
		}

		public function index(){

			$images = $this->model->getBgImages()->result_array();
			$data = array('images'=> $images);
			$this->load->view('landing_page',$data);
		}

		public function sign_in(){
			$images = $this->model->getBgImages()->result_array();
			$data = array('images'=> $images);
			$this->load->view('login',$data);
		}
		

		public function register() {
			$images = $this->model->getBgImages()->result_array();
			$data = array(
				'get_country' => $this->model->get_country(),
				'get_civil_status' => $this->model->get_civil_status(),
				'images'=> $images,
			);

			$this->load->view('register', $data);
		}

		public function cp_login() {	

			if($this->session->userdata('isLoggedIn') == true) {

				$token_session = $this->session->userdata('token_session');
				$token = en_dec('en', $token_session);
				header("location:".base_url('Main/home/'.$token));

				// if ($this->session->userdata('position_id') == 1) { //admin
				// 	header("location:".base_url('Admin_controller/home/'.$token));
				// }
				// if ($this->session->userdata('position_id') == 5) { //staff admin
				// 	header("location:".base_url('Staffadmin_controller/home/'.$token));
				// }
			}
			$images = $this->model->getBgImages()->result_array();
			$data = array('images'=> $images);
			$this->load->view('cp_login',$data);
		}
		public function viewAgency(){
			
		}

		public function cp_login_admin(){

			$username = sanitize($this->input->post('loginEmail'));
			$password = sanitize($this->input->post('loginPassword'));

			$validate_username_admin = $this->model->validate_username_admin($username);

			if ($validate_username_admin->num_rows() > 0) { // check if email is exist

				$unverified_email = $validate_username_admin->row()->enabled; // check if unverified email

				if ($unverified_email == 0) {
					$data = array(
						'success' => 0,
						'message' => 'The email you\'ve entered is unverified account. Please Check your email and verified.'
					);
				}else{
					$hash_password = $validate_username_admin->row()->password;

					if (password_verify($password, $hash_password)) { //verify if password is valid
						//password is valid
						$userObj = $validate_username_admin->row(); //get the data for fetch
						$userData = array( // store in array
							'user_id'			=> $userObj->user_id,
							'email'  	=> $userObj->user_email,
							'position_id'     	=> $userObj->position_id,
							'enabled'     	=> $userObj->enabled,
							'isLoggedIn' 	=> true,
						);

						$this->session->set_userdata($userData); // set session

						$token_session = uniqid();
						$token_arr = array( // store token in array
							'token_session'	=> $token_session,
						);

						$this->session->set_userdata($token_arr);

						$token = en_dec('en', $token_session);

						$data = array(
							'success' => 1,
							'message' => 'login successfully',
							'token_session' => $token,
							'userData' => $userData
						);
					}else{
						// password is invalid
						$data = array(
							'success' => 0,
							'message' => 'The password you\'ve entered is not correct. Please try again.'
						);
					}
				}

			}else{
				$data = array(
					'success' => 0,
					'message' => 'The email you\'ve entered doesn\'t match any account. <a href="'.base_url('Main/register').'">Sign up for an account.</a>'
				);
			}
			
			generate_json($data);
		}

		public function login_orig(){

			$username = sanitize($this->input->post('loginEmail'));
			// $username = en_dec('en',en_dec('en',$username));
			
			$password 	= sanitize($this->input->post('loginPassword'));

			// print_r($username);
			// die();

			$validate_username = $this->model->validate_username($username);

			if ($validate_username->num_rows() > 0) { // check if email is exist

				$unverified_email = $validate_username->row()->enabled; // check if unverified email

				if ($unverified_email == 0) {
					$data = array(
						'success' => 0,
						'message' => 'The email you\'ve entered is unverified account. Please Check your email and verify.'
					);
				}else{
					$hash_password = $validate_username->row()->password;

					if (password_verify($password, $hash_password)) { //verify if password is valid
						//password is valid
						$userObj = $validate_username->row(); //get the data for fetch
						$userData = array( // store in array
							'user_id'			=> $userObj->user_id,
							'email'  			=> $userObj->user_email,
							'position_id'     	=> $userObj->position_id,
							'enabled'     		=> $userObj->enabled,
							'isLoggedIn' 		=> true,
						);

						$this->session->set_userdata($userData); // set session

						$token_session = uniqid();
						$token_arr = array( // store token in array
							'token_session'	=> $token_session,
						);

						$this->session->set_userdata($token_arr);

						$token = en_dec('en', $token_session);

						$data = array(
							'success' => 1,
							'message' => 'login successfully',
							'token_session' => $token
						);
					}else{
						// password is invalid
						$data = array(
							'success' => 0,
							'message' => 'The password you\'ve entered is not correct. Please try again.'
						);
					}
				}

			}else{
				$data = array(
					'success' => 0,
					'message' => 'The email you\'ve entered doesn\'t match any account. <a href="'.base_url('Main/register').'">Sign up for an account.</a>'
				);
			}
			
			generate_json($data);
		}

		public function login(){

			$username = sanitize($this->input->post('loginEmail'));
			// $username = en_dec('en',en_dec('en',$username));
			
			$password 	= sanitize($this->input->post('loginPassword'));

			// print_r($username);
			// die();

			$validate_username = $this->model->validate_username($username);

			if ($validate_username->num_rows() > 0) { // check if email is exist

				$unverified_email = $validate_username->row()->enabled; // check if unverified email

				if ($unverified_email == 0) {
					$data = array(
						'success' => 0,
						'message' => 'The email you\'ve entered is unverified account. Please Check your email and verify.'
					);
				}else{
					$hash_password = $validate_username->row()->password;

					if (password_verify($password, $hash_password)) { //verify if password is valid
						//password is valid
						$userObj = $validate_username->row(); //get the data for fetch
						$userData = array( // store in array
							'user_id'			=> $userObj->user_id,
							'email'  			=> $userObj->user_email,
							'position_id'     	=> $userObj->position_id,
							'enabled'     		=> $userObj->enabled,
							'isLoggedIn' 		=> true,
						);

						$this->session->sess_expiration = '3600';// expires in hour
						$this->session->set_userdata($userData); // set session

						$token_session = uniqid();
						$token_arr = array( // store token in array
							'token_session'	=> $token_session,
						);

						$this->session->set_userdata($token_arr);

						$token = en_dec('en', $token_session);

						$data = array(
							'success' => 1,
							'message' => 'login successfully',
							'token_session' => $token
						);
					}else{
						// password is invalid
						$data = array(
							'success' => 0,
							'message' => 'The password you\'ve entered is not correct. Please try again.'
						);
					}
				}

			}else{
				$data = array(
					'success' => 0,
					'message' => 'The email you\'ve entered doesn\'t match any account. <a href="'.base_url('Main/register').'">Sign up for an account.</a>'
				);
			}
			
			generate_json($data);
		}
		public function home($token = '') {

			$this->isLoggedIn();

			$announcements = $this->model->get_announcement();

			$data_admin = array(
				 // get data using email
				'token' => $token,
				'admin_info' => $this->model->getAdminInfo($this->session->userdata('email'))->row(),
				'announcements' => $announcements->result()
			);

			$data_applicant = array(
				 // get data using email
				'token' => $token,
				'applicant_info' => $this->model->getApplicantInfo($this->session->userdata('email'))->row(),
				'announcements' => $announcements->result()
			);

			$data_branch_admin = array(
				 // get data using email
				'token' => $token,
				'branch_admin_info' => $this->model->getBranchAdminInfo($this->session->userdata('email'))->row(),
				'announcements' => $announcements->result()
			);

			$data_staff = array(
				 // get data using email
				'token' => $token,
				'staff_info' => $this->model->getStaffInfo($this->session->userdata('email'))->row(),
				'announcements' => $announcements->result()
			);

			$data_branch_staff = array(
				 // get data using email
				'token' => $token,
				'branch_staff_info' => $this->model->getBranchStaffInfo($this->session->userdata('email'))->row(),
				'announcements' => $announcements->result()
			);


			if ($this->session->userdata('position_id') == '1') { // admin
				$this->load->view('includes/admin_header', $data_admin);
				$this->load->view('home', $data_admin);
			}

			if ($this->session->userdata('position_id') == '2') { // applicants
				$this->load->view('includes/header', $data_applicant);
				$this->load->view('home', $data_applicant);
			}

			if ($this->session->userdata('position_id') == '3') { // branch_admin
				$this->load->view('includes/branch_admin_header', $data_branch_admin);
				$this->load->view('home', $data_branch_admin);
			}

			if ($this->session->userdata('position_id') == '4') { // staff
				$this->load->view('includes/staff_header', $data_staff);
				$this->load->view('home', $data_staff);
			}

			if ($this->session->userdata('position_id') == '5') { // branch staff
				$this->load->view('includes/branch_staff_header', $data_branch_staff);
				$this->load->view('home', $data_branch_staff);
			}

			
		}


		public function isLoggedIn() {
			if($this->session->userdata('isLoggedIn') == false) {
				if(empty($this->session->userdata('position_id'))) { //kapag destroyed na ung session
					header("location:".base_url('Main/logout'));
				}
			}else{
				if(empty($this->session->userdata('position_id'))) {  //kapag destroyed na ung session
					header("location:".base_url('Main/logout'));
				}

				if ($this->session->userdata('position_id') == 1) { // admin
				# code...
				}
				if ($this->session->userdata('position_id') == 2) { // applicant
					# code...
				}
				if ($this->session->userdata('position_id') == 3) { // branch admin
					# code...
				}
				if ($this->session->userdata('position_id') == 4) { // staff
					# code...
				}
				if ($this->session->userdata('position_id') == 5) { // branch staff
					# code...
				}
				
			}
		}

		public function information($token = ''){ //applicant information
			$this->isLoggedIn();

			$data_admin = array(
				 // get data using email
				'token' => $token,
				'admin_info' => $this->model->getAdminInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),
				'get_civil_status'=> $this->model->get_civil_status(),
				
			);

			$data_applicant = array(
				'token' => $token,
				'applicant_info' => $this->model->getApplicantInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),
				'get_civil_status'=> $this->model->get_civil_status(),

			);

			$data_branch_admin = array(
				'token' => $token,
				'branch_admin_info' => $this->model->getBranchAdminInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),
				'get_civil_status'=> $this->model->get_civil_status(),

			);

			$data_staff = array(
				'token' => $token,
				'staff_info' => $this->model->getStaffInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),
				'get_civil_status'=> $this->model->get_civil_status(),
			);

			$data_branch_staff = array(
				'token' => $token,
				'branch_staff_info' => $this->model->getBranchStaffInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),
				'get_civil_status'=> $this->model->get_civil_status(),
			);


			if ($this->session->userdata('position_id') == '1') { // admin
				$this->load->view('includes/admin_header', $data_admin);
				$this->load->view('admin/profile/information', $data_admin);
			}else if ($this->session->userdata('position_id') == '2') { // applicant
				$this->load->view('includes/header', $data_applicant);
				$this->load->view('applicant/profile/information', $data_applicant);
			}else if ($this->session->userdata('position_id') == '3') { // branch admin
				$this->load->view('includes/branch_admin_header', $data_branch_admin);
				$this->load->view('branch_admin/profile/information', $data_branch_admin);
			}else if ($this->session->userdata('position_id') == '4') { // staff
				$this->load->view('includes/staff_header', $data_staff);
				$this->load->view('staff/profile/information', $data_staff);
			}else if ($this->session->userdata('position_id') == '5') { // branch staff
				$this->load->view('includes/branch_staff_header', $data_branch_staff);
				$this->load->view('branch_staff/profile/information', $data_branch_staff);
			}else{
				$this->logout();
			}
		}

		public function security($token = ''){ 
			$this->isLoggedIn();

			$data_admin = array(
				 // get data using email
				'token' => $token,
				'admin_info' => $this->model->getAdminInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),
				
			);

			$data_applicant = array(
				'token' => $token,
				'applicant_info' => $this->model->getApplicantInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),

			);

			$data_branch_admin = array(
				'token' => $token,
				'branch_admin_info' => $this->model->getBranchAdminInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),

			);

			$data_staff = array(
				'token' => $token,
				'staff_info' => $this->model->getStaffInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),

			);

			$data_branch_staff = array(
				'token' => $token,
				'branch_staff_info' => $this->model->getBranchStaffInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),

			);


			if ($this->session->userdata('position_id') == '1') { // admin
				$this->load->view('includes/admin_header', $data_admin);
				$this->load->view('admin/profile/security', $data_admin);

			}else if ($this->session->userdata('position_id') == '2') { // applicant
				$this->load->view('includes/header', $data_applicant);
				$this->load->view('applicant/profile/security', $data_applicant);

			}else if ($this->session->userdata('position_id') == '3') { // branch admin
				$this->load->view('includes/branch_admin_header', $data_branch_admin);
				$this->load->view('branch_admin/profile/security', $data_branch_admin);

			}else if ($this->session->userdata('position_id') == '4') { // staff
				$this->load->view('includes/staff_header', $data_staff);
				$this->load->view('staff/profile/security', $data_staff);

			}else if ($this->session->userdata('position_id') == '5') { // branch staff
				$this->load->view('includes/branch_staff_header', $data_branch_staff);
				$this->load->view('branch_staff/profile/security', $data_branch_staff);
			}else{
				$this->logout();
			}
		}

		public function settings_branch_table(){

			if ($this->session->userdata('position_id') == '1') { // admin
				$query = $this->model->settings_branch_table();
			}else logout();
			
			echo json_encode($query);
		}

		public function settings_schedule_table(){

			if ($this->session->userdata('position_id') == '1') { // admin
				$query = $this->model->settings_schedule_table();
			} else if ($this->session->userdata('position_id') == '3') { // branch admin
				$branch_admin_info = $this->model->getBranchAdminInfo($this->session->userdata('email'))->row();
				$branch_id = $branch_admin_info->branch_id;
				$query = $this->model->settings_schedule_table();
			} else logout();
			
			echo json_encode($query);
		}

		public function settings_country(){

			if ($this->session->userdata('position_id') == '1') { // admin
				$query = $this->model->settings_country();
			} else logout();
			
			echo json_encode($query);
		}

		public function settings_schedule_limit_table(){

			if ($this->session->userdata('position_id') == '1') { // admin
				$query = $this->model->settings_schedule_limit_table();
			} else if ($this->session->userdata('position_id') == '3') { // branch admin
				$branch_admin_info = $this->model->getBranchAdminInfo($this->session->userdata('email'))->row();
				$branch_id = $branch_admin_info->branch_id;
				$query = $this->model->settings_branch_schedule_limit_table($branch_id);
			} else logout();
			
			echo json_encode($query);
		}

		public function settings_accounts_table(){

			if ($this->session->userdata('position_id') == '1') { // admin
				$query = $this->model->settings_accounts_table();
			}
			if ($this->session->userdata('position_id') == '3') { // branch admin
				$branch_admin_info = $this->model->getBranchAdminInfo($this->session->userdata('email'))->row();
				$branch_id = $branch_admin_info->branch_id;
				$query = $this->model->settings_branch_admin_accounts_table($branch_id);
			}
			echo json_encode($query);
		}

		public function settings_announcement_table(){

			if ($this->session->userdata('position_id') == '1') { // admin
				$query = $this->model->settings_announcement_table();
			}
			if ($this->session->userdata('position_id') == '3') { // branch admin
				$branch_admin_info = $this->model->getBranchAdminInfo($this->session->userdata('email'))->row();
				$branch_id = $branch_admin_info->branch_id;
				$query = $this->model->settings_announcement_table($branch_id);
			}
			echo json_encode($query);
		}

		public function settings_applicants_table(){

			if ($this->session->userdata('position_id') == '1' || $this->session->userdata('position_id') == '4') { // staff
				$query = $this->model->settings_applicants_table();
			}
			if ($this->session->userdata('position_id') == '3' || $this->session->userdata('position_id') == '5') { // branch admin and branch staff
				// $branch_admin_info = $this->model->getBranchAdminInfo($this->session->userdata('email'))->row();
				// $branch_id = $branch_admin_info->branch_id;
				$query = $this->model->settings_applicants_table();
			}
			echo json_encode($query);
		}


		public function settings_reschedule_table(){

			if ($this->session->userdata('position_id') == '1' || $this->session->userdata('position_id') == '3'  ) { // admin or branch admin
				$query = $this->model->settings_reschedule_table();
			}else{
				logout();
			}
			echo json_encode($query);
		}

		
		public function settings_applications_table(){

			if ($this->session->userdata('position_id') == '1') { // admin or branch admin
				$query = $this->model->settings_applications_table();
			}else{
				logout();
			}
			
			echo json_encode($query);
		}

		public function settings_applications_table2(){

			if ($this->session->userdata('position_id') == '1' || $this->session->userdata('position_id') == '3'  ) { // admin or branch admin
				$query = $this->model->settings_applications_table2();
			}
			
			echo json_encode($query);
		}


		public function transactions_applications_table(){

			if ($this->session->userdata('position_id') == '1') { // admin
				$query = $this->model->transactions_application_table();
			}
			if ($this->session->userdata('position_id') == '3') { // branch admin
				$branch_admin_info = $this->model->getBranchAdminInfo($this->session->userdata('email'))->row();
				$branch_id = $branch_admin_info->branch_id;
				$query = $this->model->transactions_application_table();
			}
			if ($this->session->userdata('position_id') == '4') { // staff
				$query = $this->model->transactions_application_table();
			}
			if ($this->session->userdata('position_id') == '5') { // branch staff
				$branch_admin_info = $this->model->getBranchStaffInfo($this->session->userdata('email'))->row();
				$branch_id = $branch_admin_info->assigned_branch_id;
				$query = $this->model->transactions_application_table();
			}
			echo json_encode($query);
		}

		public function applicant_transactions_application_table(){

			$query = $this->model->applicant_transactions_application_table($this->session->userdata('email'));
			echo json_encode($query);
		}

		public function applicant_transactions_appointment_table(){

			$applicant_info = $this->model->getApplicantInfo($this->session->userdata('email'))->row();
			$applicant_no = $applicant_info ->applicant_no;

			$query = $this->model->applicant_transactions_appointment_table($applicant_no);
			echo json_encode($query);
		}

		public function transactions_appointment_table(){

			if ($this->session->userdata('position_id') == '1') { // admin
				$query = $this->model->transactions_appointment_table();
			}
			if ($this->session->userdata('position_id') == '3') { // branch admin
				$branch_admin_info = $this->model->getBranchAdminInfo($this->session->userdata('email'))->row();
				$branch_id = $branch_admin_info->branch_admin_assigned_branch_id;
				$query = $this->model->branch_admin_transactions_appointment_table($branch_id);
			}
			if ($this->session->userdata('position_id') == '4') { // staff
				$query = $this->model->transactions_appointment_table();
			}
			if ($this->session->userdata('position_id') == '5') { // branch staff
				$branch_admin_info = $this->model->getBranchStaffInfo($this->session->userdata('email'))->row();
				$branch_id = $branch_admin_info->assigned_branch_id;
				$query = $this->model->branch_admin_transactions_appointment_table($branch_id);
			}
			echo json_encode($query);
		}

		public function getInfoAccountsUsingID(){
			$user_id = sanitize($this->input->post('user_id'));
			
			if ($user_id > 0) {
				$query = $this->model->getInfoAccountsUsingID($user_id);
				// $data = array('success' => 1, 'result' => $query->result(), 'email' => en_dec('dec', en_dec('dec',$query->row()->user_email)));	
				$data = array('success' => 1, 'result' => $query->result(), 'email' => $query->row()->user_email);	
			}else{
				$data = array('success' => 0, 'result' => 'No data found!');
			}
			generate_json($data);
		}

		public function get_holiday(){
			$query = $this->model->get_holiday();
			$data = array('result' => $query->result());	
			generate_json($data);
		}

		public function getInfoApplicantUsingID(){
			$applicant_id = sanitize($this->input->post('applicant_id'));
			
			if ($applicant_id > 0) {
				$query = $this->model->getApplicantInfoUsingId($applicant_id)->row_array();
				$uploaded_docs = $this->model->get_uploaded_docs($query['email']);
				$data = array('success' => 1, 
					'result' => $query,
					'applicantno' => en_dec('dec', $query['applicant_no']),
					'uploaded_docs' => $uploaded_docs->result_array()
				);	
			}else{
				$data = array('success' => 0, 'result' => 'No data found!');
			}
			generate_json($data);
		}

		public function getInfoAnnouncementUsingID(){
			$announcement_id = sanitize($this->input->post('announcement_id'));

			if ($announcement_id > 0) {

				$query = $this->model->getInfoAnnouncementUsingID($announcement_id);
				$data = array('success' => 1, 'result' => $query->result());
			}else{

				$data = array('success' => 0, 'result' => 'No data found!');
			}
			generate_json($data);
		}

		public function getInfoBranchUsingID(){

			$branch_id = sanitize($this->input->post('branch_id'));

			if ($branch_id > 0) {

				$query = $this->model->getInfoBranchUsingID($branch_id);
				$data = array('success' => 1, 'result' => $query->result());
			}else{

				$data = array('success' => 0, 'result' => 'No data found!');
			}
			generate_json($data);
		}

		public function getInfoHolidayUsingID(){

			$holiday_id = sanitize($this->input->post('holiday_id'));

			if ($holiday_id > 0) {

				$query = $this->model->getInfoHolidayUsingID($holiday_id);
				$data = array('success' => 1, 'result' => $query->result());
			}else{

				$data = array('success' => 0, 'result' => 'No data found!');
			}
			generate_json($data);
		}

		public function getInfoCountryUsingID(){

			$country_id = sanitize($this->input->post('country_id'));

			if ($country_id > 0) {
				$query = $this->model->getInfoCountryUsingID($country_id);
				$data = array('success' => 1, 'result' => $query->result());
			}else{

				$data = array('success' => 0, 'result' => 'No data found!');
			}
			generate_json($data);
		}

		public function getInfoSchedLimitUsingID(){

			$sched_limit_id = sanitize($this->input->post('sched_limit_id'));

			if ($sched_limit_id > 0) {
				$query = $this->model->getInfoSchedLimitUsingID($sched_limit_id);
				$data = array('success' => 1, 'result' => $query->result());
			}else{

				$data = array('success' => 0, 'result' => 'No data found!');
			}
			generate_json($data);
		}

		public function getInfoSchedLimitUsingBranchID(){

			$sched_limit_branch_id = sanitize($this->input->post('sched_branch_limit_id'));

			$start_dates = array();
			$end_dates = array();
			$dates_with_sched = array();

			if ($sched_limit_branch_id > 0) {
				$query = $this->model->get_sched_limit_created_by_branch_admin($sched_limit_branch_id)->result();

				//getting the start and end date AND saving all the dates in an array
				if(count($query) > 0){
					foreach($query as $row){
						$begin = $row->start_date;
						$end = $row->end_date;

						array_push($start_dates, $begin);
						array_push($end_dates, $end);

						for ($i = $begin; $i <= $end;$i->modify('+1 day')){
							array_push($dates_with_sched,  $i->format("Y-m-d"));
						}
					
					}
					$start_date = min($start_dates);
					$end_date = max($end_dates);

					$data = array('success' => 1, 'result' => $query, 'start_date' => $start_date, 'end_date' => $end_date, 'dates_with_sched' => $dates_with_sched);
				}else{
					$start_date = "";
					$end_date ="";
					$query = $this->model->get_sched_limit($sched_limit_branch_id)->result();
					if(count($query) > 0){
						foreach($query as $row){
							$begin = $row->start_date;
							$end = $row->end_date;

							array_push($start_dates, $begin);
							array_push($end_dates, $end);

							for ($i = new DateTime($begin); $i<= new DateTime($end) ;$i->modify('+1 day')){
								array_push($dates_with_sched,  $i->format("Y-m-d"));
							}
						}
						$start_date = min($start_dates);
						$end_date = max($end_dates);
					}

					$data = array('success' => 1, 'result' => $query ,'start_date' => $start_date, 'end_date' => $end_date, 'dates_with_sched'=> $dates_with_sched);
				}
			}else{
				$data = array('success' => 0, 'result' => 'No data found!');
			}
			generate_json($data);
		}

		public function getInfoApplicationUsingID(){

			$app_id = sanitize($this->input->post('application_id'));

			if ($app_id  > 0) {
				$query = $this->model->getInfoApplicationUsingID($app_id);
				$data = array('success' => 1, 'result' => $query->result());
			}else{

				$data = array('success' => 0, 'result' => 'No data found!');
			}
			generate_json($data);
		}		

		public function getInfoRescheduleFeeUsingID(){

			$resched_id = sanitize($this->input->post('resched_id'));

			if ($resched_id  > 0) {
				$query = $this->model->getInfoRescheduleFeeUsingID($resched_id);
				$data = array('success' => 1, 'result' => $query->result());
			}else{
				$data = array('success' => 0, 'result' => 'No data found!');
			}
			generate_json($data);
		}

		public function getInfoScheduleUsingID(){

			$app_id = sanitize($this->input->post('application_id'));

			if ($app_id  > 0) {
				$query = $this->model->getInfoApplicationUsingID($app_id );
				$data = array('success' => 1, 'result' => $query->result());
			}else{

				$data = array('success' => 0, 'result' => 'No data found!');
			}
			generate_json($data);
		}

		public function getInfoRequirementUsingID(){

			$req_id = sanitize($this->input->post('requirement_id'));

			if ($req_id  > 0) {

				$query = $this->model->getInfoRequirementUsingID($req_id);
				$data = array('success' => 1, 'result' => $query->result());
			}else{

				$data = array('success' => 0, 'result' => 'No data found!');
			}
			generate_json($data);
		}

		// public function getInfoTransactionApplicationUsingID(){

		// 	$app_id = sanitize($this->input->post('app_id'));

		// 	if ($app_id  > 0) {
		// 		$query = $this->model->getInfoTransactionApplicationUsingID($app_id);
		// 		$email = $query->row()->applicant_email;
		// 		$data = array('success' => 1, 'result' => $query->result(), 'email' => $email);
		// 	}else{

		// 		$data = array('success' => 0, 'result' => 'No data found!');
		// 	}
		// 	generate_json($data);
		// }

		public function getInfoTransactionApplicationUsingID(){

			$app_id = sanitize($this->input->post('app_id'));

			if ($app_id  > 0) {
				$query = $this->model->getInfoTransactionApplicationUsingID($app_id);
				$email = $query->row()->applicant_email;
				$uploaded_docs = $this->model->get_uploaded_docs($email)->result_array();
				$data = array('success' => 1, 'result' => $query->result(), 'email' => $email, 'uploaded_docs' => $uploaded_docs );
			}else{

				$data = array('success' => 0, 'result' => 'No data found!');
			}
			generate_json($data);
		}

		public function getInfoTransactionApplicationUsingRefNo(){

			$app_ref_no = sanitize($this->input->post('app_ref_no'));
			if ($app_ref_no  > 0) {

				$query = $this->model->getApplicationInfoUsingRefNo($app_ref_no);
				$email = $query->row()->applicant_email;

				$data = array('success' => 1, 'result' => $query->result(), 'email' => $email, 'applicant_info' => $this->model->getApplicantInfo($email)->result());
			}else{
				$data = array('success' => 0, 'result' => 'No data found!');
			}

			generate_json($data);

		}

		public function getInfoTransactionAppointmentUsingID(){

			$app_id = sanitize($this->input->post('app_id'));

			if ($app_id  > 0) {
				$query = $this->model->getInfoTransactionAppointmentUsingID($app_id );
				// $contact_num = en_dec('dec', en_dec('dec',$query->row()->contact_num));
				// $first_name = en_dec('dec', en_dec('dec',$query->row()->first_name));
				// $middle_name = en_dec('dec', en_dec('dec',$query->row()->middle_name));
				// $last_name = en_dec('dec', en_dec('dec',$query->row()->last_name));
				// $last_name = en_dec('dec', en_dec('dec',$query->row()->last_name));

				$contact_num = $query->row()->contact_num;
				$first_name = $query->row()->first_name;
				$middle_name = $query->row()->middle_name;
				$last_name = $query->row()->last_name;
				$last_name = $query->row()->last_name;

				$data = array('success' => 1, 
					'result' => $query->result(),
					'email' => $query->row()->email,
					'contact_num' => $contact_num,
					'first_name' => $first_name,
					'middle_name' => $middle_name,
					'last_name' => $last_name
				);	
			}else{

				$data = array('success' => 0, 'result' => 'No data found!');
			}
			generate_json($data);
		}

		// public function edit_accounts(){

		// 	$info_user_id = sanitize($this->input->post('info_user_id'));
		// 	$info_position_id = sanitize($this->input->post('info_position_id'));
		// 	$info_assigned_branch = sanitize($this->input->post('info_assigned_branch'));
		// 	$info_fname = sanitize($this->input->post('info_fname'));
		// 	$info_mname = sanitize($this->input->post('info_mname'));
		// 	$info_lname = sanitize($this->input->post('info_lname'));
		// 	// $info_bdate = sanitize($this->input->post('info_bdate'));
		// 	// $info_bdate = date_format(date_create($info_bdate),"Y-m-d");
		// 	$info_contact_number = sanitize($this->input->post('info_contact_number'));
		// 	// $info_address = sanitize($this->input->post('info_address'));
		// 	// $info_country = sanitize($this->input->post('info_country'));
		// 	// $info_city = sanitize($this->input->post('info_city'));
		// 	$info_emailaddress = sanitize($this->input->post('info_emailaddress'));
		// 	// $info_gender = sanitize($this->input->post('info_gender'));

		// 	if ($info_user_id == "" || $info_fname == "" || $info_lname == "" || $info_contact_number == "" || $info_emailaddress == "") {
		// 		$data = array("success" => 0, 'message' => "Please fill up all required fields");
		// 	}else{
		// 		$checkEmailExist = $this->model->checkEmailExist_usingPlayerID($info_emailaddress, $info_user_id);
		// 		if ($checkEmailExist->num_rows() > 0) {
		// 			$data = array("success" => 0, 'message' => "Email already exist.");
		// 		}else{
		// 			// $info_emailaddress = en_dec('en',en_dec('en',$info_emailaddress));
		// 			$info_emailaddress =$info_emailaddress;
		// 			if($info_position_id == 3 || $info_position_id == 5){
		// 				if ($info_assigned_branch == ""){
		// 					$data = array("success" => 0, 'message' => "Please fill up all required fields");	
		// 				}else{
		// 					$query = $this->model->edit_accounts_branch($info_user_id, $info_fname, $info_mname, $info_lname, $info_contact_number, $info_emailaddress, $info_assigned_branch);
		// 					$data = array("success" => 1, 'message' => "Accounts Updated!");
		// 				}
		// 			} else{
		// 				$query = $this->model->edit_accounts($info_user_id, $info_fname, $info_mname, $info_lname, $info_contact_number, $info_emailaddress);
		// 				$data = array("success" => 1, 'message' => "Accounts Updated!");
		// 			}
		// 		}
		// 	}
		// 	generate_json($data);
		// }

		public function edit_accounts(){

			$info_user_id = sanitize($this->input->post('info_user_id'));
			$info_position_id = sanitize($this->input->post('info_position_id'));
			$info_assigned_branch = sanitize($this->input->post('info_assigned_branch'));
			$info_fname = sanitize($this->input->post('info_fname'));
			$info_mname = sanitize($this->input->post('info_mname'));
			$info_lname = sanitize($this->input->post('info_lname'));
			// $info_bdate = sanitize($this->input->post('info_bdate'));
			// $info_bdate = date_format(date_create($info_bdate),"Y-m-d");
			$info_contact_number = sanitize($this->input->post('info_contact_number'));
			// $info_address = sanitize($this->input->post('info_address'));
			// $info_country = sanitize($this->input->post('info_country'));
			// $info_city = sanitize($this->input->post('info_city'));
			// $info_emailaddress = sanitize($this->input->post('info_emailaddress'));
			// $info_gender = sanitize($this->input->post('info_gender'));

			if ($info_user_id == "" || $info_fname == "" || $info_lname == "" || $info_contact_number == "") {
				$data = array("success" => 0, 'message' => "Please fill up all required fields");
			}else{
				
				if($info_position_id == 3 || $info_position_id == 5){
					if ($info_assigned_branch == ""){
						$data = array("success" => 0, 'message' => "Please fill up all required fields");	
					}else{
						$query = $this->model->edit_accounts_branch($info_user_id, $info_fname, $info_mname, $info_lname, $info_contact_number, $info_assigned_branch);
						$data = array("success" => 1, 'message' => "Accounts Updated!");
					}
				} else{
					$query = $this->model->edit_accounts($info_user_id, $info_fname, $info_mname, $info_lname, $info_contact_number);
					$data = array("success" => 1, 'message' => "Accounts Updated!");
				}
			}
			
			generate_json($data);
		}


		public function edit_accounts_branch_admin(){

			$info_user_id = sanitize($this->input->post('info_user_id'));
			$info_fname = sanitize($this->input->post('info_fname'));
			$info_mname = sanitize($this->input->post('info_mname'));
			$info_lname = sanitize($this->input->post('info_lname'));
			$info_contact_number = sanitize($this->input->post('info_contact_number'));
			$info_emailaddress = sanitize($this->input->post('info_emailaddress2'));

			// $info_gender = sanitize($this->input->post('info_gender'));

			if ($info_user_id == "" || $info_fname == "" || $info_lname == "" || $info_contact_number == "" || $info_emailaddress == "") {
				$data = array("success" => 0, 'message' => "Please fill up all required fields");
			}else{
				
				$query = $this->model->branch_admin_edit_accounts($info_user_id, $info_fname, $info_mname, $info_lname, $info_contact_number, $info_emailaddress);
				$data = array("success" => 1, 'message' => "Account Updated!");
			}
			generate_json($data);
		}

		public function edit_applicant_accounts(){

			$info_user_id = sanitize($this->input->post('info_user_id'));
			$info_position_id = sanitize($this->input->post('info_position_id'));
			$info_assigned_branch = sanitize($this->input->post('info_assigned_branch'));
			// $info_fname = en_dec('en',en_dec('en',sanitize($this->input->post('info_fname'))));
			// $info_mname = en_dec('en',en_dec('en',sanitize($this->input->post('info_mname'))));
			// $info_lname = en_dec('en',en_dec('en',sanitize($this->input->post('info_lname'))));	

			$info_fname = sanitize($this->input->post('info_fname'));
			$info_mname = sanitize($this->input->post('info_mname'));
			$info_lname = sanitize($this->input->post('info_lname'));
			$info_bdate = sanitize($this->input->post('info_bdate'));
			$info_bdate = date_format(date_create($info_bdate),"Y-m-d");
			$info_contact_number = sanitize($this->input->post('info_contact_number'));
			// $info_address = sanitize($this->input->post('info_address'));
			$info_country = sanitize($this->input->post('info_country'));
			// $info_city = sanitize($this->input->post('info_city'));
			$info_emailaddress = sanitize($this->input->post('info_emailaddress'));
			$info_emailaddress2 = sanitize($this->input->post('info_emailaddress'));
			$info_gender = sanitize($this->input->post('info_gender'));

			if ($info_user_id == "" || $info_fname == "" || $info_lname == "" || $info_bdate == "" || $info_contact_number == "" || $info_country == "" || $info_emailaddress == "" || $info_gender == "") {
				$data = array("success" => 0, 'message' => "Please fill up all required fields");
			}else{
				$checkEmailExist = $this->model->checkEmailExist_usingPlayerID($info_emailaddress2, $info_user_id);
				if ($checkEmailExist->num_rows() > 0) {
					$data = array("success" => 0, 'message' => "Email already exist.");
				}else{
					$query = $this->model->edit_accounts($info_user_id, $info_fname, $info_mname, $info_lname, $info_bdate, $info_contact_number, $info_country, $info_emailaddress, $info_gender);
					$data = array("success" => 1, 'message' => "Accounts Updated!");
				}
			}
			generate_json($data);
		}


		public function edit_announcement(){

			$announcement_id = sanitize($this->input->post('announcement_id'));
			$posted_until = sanitize($this->input->post('a_eposted_until'));
			$title = sanitize($this->input->post('a_etitle'));
			$content = sanitize($this->input->post('a_econtent'));

			if ($posted_until == "" || $title == "" || $content  == "" || $announcement_id == "") {
				$data = array("success" => 0, 'message' => "Please fill up all required fields");
			}else {
				$query = $this->model->edit_announcement($posted_until, $title ,$content, $announcement_id);
				$data = array("success" => 1, 'message' => "Annoucement Updated!");
			}
			generate_json($data);
		}

		public function edit_appointment(){

			$appointment_id = sanitize($this->input->post('tbe_appointment_id'));
			$branch_id = sanitize($this->input->post('branch_name'));
			$appointment_date = sanitize($this->input->post('appointment-date'));
			$appointment_time = sanitize($this->input->post('appointment-time'));



			if ($branch_id == "" || $appointment_id == "" || $appointment_date  == "" || $appointment_time == "") {
				$data = array("success" => 0, 'message' => "Please fill up all required fields");
			}else {
				$appointment_date = date_format(date_create($appointment_date),"Y-m-d");
				$query = $this->model->edit_appointment($appointment_id, $branch_id ,$appointment_date,$appointment_time);
				$data = array("success" => 1, 'message' => "Appointment Updated!");
			}
			generate_json($data);
		}

		public function resched_appointment(){

			$reference_no = sanitize($this->input->post('reference_no'));
			$branch_id = sanitize($this->input->post('new_branch'));
			$appointment_date = sanitize($this->input->post('new_date'));
			$appointment_time = sanitize($this->input->post('new_time'));
			$resched_fee = sanitize($this->input->post('resched_fee'));
			$sched_details = $this->model->getScheduleDetails($reference_no)->row();

			$isReschedCounter = $sched_details->is_rescheduled_counter;

			$isReschedCounter++;

			if ($branch_id == "" || $reference_no == "" || $appointment_date  == "" || $appointment_time == "" || $resched_fee ="") {
				$data = array("success" => 0, 'message' => "Please fill up all required fields");
			}else {
				$appointment_date = date_format(date_create($appointment_date),"Y-m-d");
				$query = $this->model->resched_appointment($reference_no, $branch_id ,$appointment_date,$appointment_time,$resched_fee,$isReschedCounter);
				$data = array("success" => 1, 'message' => "Appointment Updated!");
			}
			generate_json($data);
		}

		public function edit_branch(){

			$info_branch_id = sanitize($this->input->post('branch_id'));
			$info_bname = sanitize($this->input->post('info_bname'));
			$info_bcode = sanitize($this->input->post('info_bcode'));
			$info_address = sanitize($this->input->post('info_address'));

			if ($info_branch_id == "" || $info_bname  == "" || $info_bcode == "" || $info_address == "") {
				$data = array("success" => 0, 'message' => "Please fill up all required fields");
			}else{

				$checkBCodeExist = $this->model->checkBCodeExist($info_branch_id);

				if ($checkBCodeExist->num_rows() > 0) {
					$data = array("success" => 0, 'message' => "Branch code already exist.");
				}else{
					$query = $this->model->edit_branch($info_branch_id,$info_bname,$info_bcode,$info_address );
					$data = array("success" => 1, 'message' => "Branch Updated!");
				}
				
			}
			generate_json($data);
		}

		public function edit_holiday(){

			$holiday_id = sanitize($this->input->post('holiday_id'));
			$holiday_desc = sanitize($this->input->post('edit_hol_desc'));
			$holiday_date = sanitize($this->input->post('edit_hol_date'));
			$old_holiday_desc = sanitize($this->input->post('current_holiday_name'));

			if ($holiday_id == "" || $holiday_desc  == "" || $holiday_date == "" || $old_holiday_desc == "") {
				$data = array("success" => 0, 'message' => "Please fill up all required fields");
			}else{

				$checkIfHolidayExist = $this->model->checkIfHolidayExistExcept($holiday_desc, $old_holiday_desc);

				if ($checkIfHolidayExist->num_rows() > 0) {
					$data = array("success" => 0, 'message' => "Holiday already exist.");
				}else{
					$holiday_date = date_format(date_create($holiday_date),"Y-m-d");
					$query = $this->model->edit_holiday($holiday_id,$holiday_desc,$holiday_date);
					$data = array("success" => 1, 'message' => "Holiday Updated!");
				}
			}
			generate_json($data);
		}

		public function edit_country(){

			$country_id = sanitize($this->input->post('country_id'));
			$country_name = sanitize($this->input->post('edit_country_name'));
			$old_country_name = sanitize($this->input->post('current_country_name'));

			if ($country_id == "" || $country_name  == "" || $old_country_name == "") {
				$data = array("success" => 0, 'message' => "Please fill up all required fields");
			}else{

				$checkIfCountryExist = $this->model->checkIfCountryExistExcept($country_name, $old_country_name);

				if ($checkIfCountryExist->num_rows() > 0) {
					$data = array("success" => 0, 'message' => "Country already exist.");
				}else{
					$query = $this->model->edit_country($country_name,$country_id);
					$data = array("success" => 1, 'message' => "Country Name Updated!");
				}
			}
			generate_json($data);
		}

		public function edit_sched_limit(){

			$admin_id = $this->session->userdata('position_id');

			if($admin_id == 1){
				$tbe_branch_id = sanitize($this->input->post('edit_branch_code'));
			}else if($admin_id == 3){
				$tbe_branch_id = $this->model->getBranchAdminInfo($this->session->userdata('email'))->row()->branch_admin_assigned_branch_id;
			}

			// if($this->session->userdata('position_id') == 1){
			// 	$tbe_branch_id = sanitize($this->input->post('edit_branch_code'));
			// }else if($this->session->userdata('position_id') == 3){
			// 	$tbe_branch_id = $this->model->getBranchAdminInfo($this->session->userdata('email'))->row()->branch_admin_assigned_branch_id;
			// }

			$tbe_sched_limit_id = sanitize($this->input->post('sched_limit_id'));
			$tbe_start_date = sanitize($this->input->post('edit_start_date'));
			$tbe_end_date = sanitize($this->input->post('edit_end_date'));
			$tbe_day_limit = sanitize($this->input->post('edit_day_limit'));
			$tbe_hour_limit = sanitize($this->input->post('edit_hour_limit'));

			if ($tbe_sched_limit_id == "" || $tbe_start_date  == "" || $tbe_end_date == "" || $tbe_day_limit == "" ||
				$tbe_hour_limit == "" || $tbe_day_limit == 0 || $tbe_hour_limit == 0 || $tbe_branch_id == "") {
				$data = array("success" => 0, 'message' => "Please fill up all required fields");
			}else{

				$tbe_start_date = date_format(date_create($tbe_start_date),"Y-m-d");
				$tbe_end_date = date_format(date_create($tbe_end_date),"Y-m-d");

				$info_start_date_ts = strtotime($tbe_start_date);
				$info_end_date_ts = strtotime($tbe_end_date);
				$query = $this->model->getInfoSchedLimitUsingBranchIDExceptThisId($tbe_branch_id, $tbe_sched_limit_id)->result_array();
				$go_save_the_date = true;

				for($i = 0; $i < count($query) ;$i++){

					$start_date = strtotime($query[$i]['start_date']);
					$end_date = strtotime($query[$i]['end_date']);
					$created_by = $query[$i]['created_by'];

					if($admin_id == $created_by){

						if($this->check_in_range($start_date,$end_date,$info_start_date_ts) || $this->check_in_range($start_date,$end_date,$info_end_date_ts)){ //If start date or end date is within the

							$data = array("success" => 0, 'message' => 'Dates given are already on the current schedule dates. Please select dates that are not within the set schedule');
								$go_save_the_date = false;
						}
					}
				}
				if($go_save_the_date){
					$query = $this->model->edit_sched_limit($tbe_sched_limit_id,$tbe_branch_id,$tbe_start_date,$tbe_end_date,$tbe_day_limit,$tbe_hour_limit);
					$data = array("success" => 1, 'message' => "Schedule Limit Updated!");
				}	
			}

			generate_json($data);
	}

	public function edit_application(){

		$info_application_id = sanitize($this->input->post('application_id'));
		$info_aname = sanitize($this->input->post('info_aname'));
		// $info_bfee = sanitize($this->input->post('info_bfee'));
		// $info_pfee = sanitize($this->input->post('info_pfee'));

		if ($info_application_id == "" || $info_aname  == "") {
			$data = array("success" => 0, 'message' => "Please fill up all required fields");
		}else{

			$query = $this->model->edit_application($info_application_id,$info_aname );
			$data = array("success" => 1, 'message' => "Application Category Updated!");
		}
		generate_json($data);
	}

	public function edit_reschedule_fee(){

		$tbe_resched_id = sanitize($this->input->post('view_resched_id'));
		$tbe_resched_limit = sanitize($this->input->post('view_resched_limit'));
		$tbe_resched_fee = sanitize($this->input->post('view_resched_fee2'));

		if ($tbe_resched_id == "" || $tbe_resched_limit  == "" || $tbe_resched_fee == "" ) {
			$data = array("success" => 0, 'message' => "Please fill up all required fields");
		}else{

			$query = $this->model->edit_reschedule_fee($tbe_resched_id,$tbe_resched_limit,$tbe_resched_fee);
			$data = array("success" => 1, 'message' => "Reschedule Fee/Limit Updated!");
		}
		generate_json($data);
	}


	public function edit_requirement(){

		$info_req_id = sanitize($this->input->post('info_req_id'));
		$info_desc = sanitize($this->input->post('info_req_desc'));

		if ($info_req_id == "" || $info_desc  == "") {
			$data = array("success" => 0, 'message' => "Please fill up all required fields");
		}else{

			$query = $this->model->edit_requirement($info_req_id, $info_desc );
			$data = array("success" => 1, 'message' => "Document Type Updated!");
		}
		generate_json($data);
	}

	public function deleteAccounts(){

		$del_user_id = sanitize($this->input->post('del_user_id'));
		$del_email_id = sanitize($this->input->post('del_email_id'));
		$del_position_id = sanitize($this->input->post('del_position_id'));

		if ($del_user_id == "" || $del_email_id == "" || $del_position_id == "") {
			$data = array("success" => 0, 'message' => "Something went wrong, Please Try again!");
		}else{
			$query = $this->model->deleteAccounts($del_user_id, $del_email_id, $del_position_id);

			$data = array("success" => 1, 'message' => "Accounts Deleted!" , "del_user_id" => $del_user_id);
		}

		generate_json($data);
	}

	public function deleteAnnouncement(){

		$del_announcement_id = sanitize($this->input->post('del_announcement_id'));

		if ($del_announcement_id == "" ) {
			$data = array("success" => 0, 'message' => "Something went wrong, Please Try again!");
		}else{
			$query = $this->model->deleteAnnouncement($del_announcement_id);

			$data = array("success" => 1, 'message' => "Announcement Deleted!" , "del_announcement_id" => $del_announcement_id);
		}

		generate_json($data);
	}

	public function deleteAdminTransactionsApplications(){

		$del_app_id = sanitize($this->input->post('del_app_id'));

		if ($del_app_id  == "") {
			$data = array("success" => 0, 'message' => "Something went wrong, Please Try again!");
		}else{
			$query = $this->model->deleteAdminTransactionsApplications($del_app_id);

			$data = array("success" => 1, 'message' => "Application Deleted!" , "$del_app_id" => $del_app_id);
		}
		generate_json($data);
	}

	public function deleteAdminTransactionsAppointment(){

		$del_app_id = sanitize($this->input->post('del_app_id'));

		if ($del_app_id  == "") {
			$data = array("success" => 0, 'message' => "Something went wrong, Please Try again!");
		}else{
			$query = $this->model->deleteAdminTransactionsAppointment($del_app_id);

			$data = array("success" => 1, 'message' => "Appointment Deleted!" , "$del_app_id" => $del_app_id);
		}
		generate_json($data);
	}

	public function confirmAppearanceAdminTransactionsApplications(){

		$app_ref_no = sanitize($this->input->post('app_ref_no'));
		$result = $this->model->getApplicationInfoUsingRefNo($app_ref_no)->row_array();

		if ($app_ref_no == "") {
			$data = array("success" => 0, 'message' => "Something went wrong, Please Try again!");
		}else{
			$query = $this->model->confirmAppearanceAdminTransactionsApplications($app_ref_no);
			$data = array("success" => 1, 'message' => "Successfully confirmed appearance" , "app_ref_no" => $app_ref_no, "application_info" => $result);
		}
		generate_json($data);
	}

	public function rejectAdminTransactionsApplications(){

		$rej_app_ref_no = sanitize($this->input->post('app_ref_no'));
		$rejection_reason = sanitize($this->input->post('rejection_reason'));

		if ($appr_app_ref_no   == "" || $rejection_reason == "" ) {
			$data = array("success" => 0, 'message' => "Something went wrong, Please Try again!");
		}else{
			$query = $this->model->rejectAdminTransactionsApplications($rej_app_ref_no, $rejection_reason);

			$data = array("success" => 1, 'message' => "Application Rejected!" , "rej_app_id" => $rej_app_ref_no);
		}
		generate_json($data);
	}

	public function rejectAdminTransactionsAppointment(){

		$rej_app_id = sanitize($this->input->post('rej_appointment_id'));
		$rejection_reason = sanitize($this->input->post('rejection_reason'));

		if ($rej_app_id   == "" || $rejection_reason == "" ) {
			$data = array("success" => 0, 'message' => "Something went wrong, Please Try again!");
		}else{
			$query = $this->model->rejectAdminTransactionsAppointment($rej_app_id, $rejection_reason);

			$data = array("success" => 1, 'message' => "Application Rejected!" , "$rej_app_id" => $rej_app_id);
		}
		generate_json($data);
	}

	public function approveAdminTransactionsAppointment(){

		$appr_app_id = sanitize($this->input->post('appr_appointment_id'));

		if ($appr_app_id   == "") {
			$data = array("success" => 0, 'message' => "Something went wrong, Please Try again!");
		}else{
			$query = $this->model->approveAdminTransactionsAppointment($appr_app_id);

			$data = array("success" => 1, 'message' => "Application Approved!" , "$appr_app_id" => $appr_app_id);
		}
		generate_json($data);
	}

	public function save_info_branch(){

		$info_bname = sanitize($this->input->post('info_bname'));
		$info_bcode = sanitize($this->input->post('info_bcode'));
		$info_address = sanitize($this->input->post('info_address'));

		if ($info_bname == "" || 
			$info_bcode == "" || 
			$info_address == "" ){

			$data = array("success" => 0, 'message' => 'Please fill up all required fields.');
	} else {

				$ifBCodeExist =  $this->model->checkBCodeExist($info_bcode); //check if branch code exist

				if ($ifBCodeExist->num_rows() > 0) { //if exists

					$data = array("success" => 0, 'message' => 'Branch code already exist.');

				}else{ //if not exist then go.

					$this->model->save_info_branch($info_bname,$info_bcode,$info_address);
					$data = array("success" => 1,  'message' => 'Branch successfully created.');
				}
			}
			generate_json($data);
		}

	public function save_holiday(){

		$info_hol_desc = sanitize($this->input->post('info_hol_desc'));
		$info_hol_date = sanitize($this->input->post('info_hol_date'));

		if ($info_hol_date == "" || $info_hol_desc == "" ){
			$data = array("success" => 0, 'message' => 'Please fill up all required fields.');
		} else {

			$ifHolidayExist =  $this->model->checkIfHolidayExist($info_hol_desc); //check if branch code exist

			if ($ifHolidayExist->num_rows() > 0) { //if exists

				$data = array("success" => 0, 'message' => 'Holiday already exist.');

			}else{ //if not exist then go.
				$info_hol_date = date_format(date_create($info_hol_date),"Y-m-d");
				$this->model->save_holiday($info_hol_desc,$info_hol_date);
				$data = array("success" => 1,  'message' => 'Holiday successfully created.');
			}
		}
		generate_json($data);
	}

	public function save_country(){

		$country_name = sanitize($this->input->post('tba_country_name'));

		if ($country_name == "" ){
			$data = array("success" => 0, 'message' => 'Please fill up all required fields.');
		} else {

			$ifCountryExist =  $this->model->checkIfCountryExist($country_name); //check if branch code exist

			if ($ifCountryExist->num_rows() > 0) { //if exists

				$data = array("success" => 0, 'message' => 'Country already exist.');

			}else{ //if not exist then go.

				$this->model->save_country($country_name);
				$data = array("success" => 1,  'message' => 'Country successfully created.');
			}
		}
		generate_json($data);
	}

	public function save_sched_limit(){

		$admin_id = $this->session->userdata('position_id');

		if($admin_id == 1){
			$info_branch_code = sanitize($this->input->post('info_branch_code'));
		}else if($admin_id == 3){
			$info_branch_code = $this->model->getBranchAdminInfo($this->session->userdata('email'))->row()->branch_admin_assigned_branch_id;
		}

		$info_start_date = sanitize($this->input->post('start_date'));
		$info_end_date = sanitize($this->input->post('end_date'));
		$info_day_limit = sanitize($this->input->post('info_day_limit'));
		$info_hour_limit = sanitize($this->input->post('info_hour_limit'));
		$created_by = $this->session->userdata('position_id');

		if ($info_branch_code == "" || $info_start_date == "" || $info_end_date == "" || $info_day_limit == "" || $info_hour_limit == ""){
			$data = array("success" => 0, 'message' => 'Please fill up all required fields.');
		}else {
			$info_start_date = date_format(date_create($info_start_date),"Y-m-d");
			$info_end_date = date_format(date_create($info_end_date),"Y-m-d");

			//Check if given dates are duplicate
			// convert  given dates to timestamp

			$info_start_date_ts = strtotime($info_start_date);
			$info_end_date_ts = strtotime($info_end_date);
			$query = $this->model->getInfoSchedLimitUsingBranchID($info_branch_code)->result_array();
			$go_save_the_date = true;

			for($i = 0; $i < count($query) ;$i++){

				$start_date = strtotime($query[$i]['start_date']);
				$end_date = strtotime($query[$i]['end_date']);
				$created_by = $query[$i]['created_by'];
				

				if($admin_id == $created_by){

					if($this->check_in_range($start_date,$end_date,$info_start_date_ts) || $this->check_in_range($start_date,$end_date,$info_end_date_ts)){ //If start date or end date is within the

						$data = array("success" => 0, 'message' => 'Dates given are already on the current schedule dates. Please select dates that are not within the set schedule');
							$go_save_the_date = false;
					}
				}
			}

			if($go_save_the_date){
				if ($info_day_limit < $info_hour_limit) {  //if day limit is lesser than hour limit
						$data = array("success" => 0, 'message' => 'Hour limit should be lesser than day limit');
				}else{ 
					$this->model->save_sched_limit($info_branch_code,$info_start_date,$info_end_date,$info_day_limit,$info_hour_limit,$created_by);
					$data = array("success" => 1,  'message' => 'Schedule limit successfully created.');
				}
			}
		}
		generate_json($data);
	}

	public function check_in_range($start_date, $end_date, $date_from_user)	{

		// Check that user date is between start & end
		return (($date_from_user >= $start_date) && ($date_from_user <= $end_date));
	}

	public function save_announcement(){

		$user_id = $this->session->userdata('user_id');

		$info_subject = sanitize($this->input->post('info_subject'));
		$info_content = sanitize($this->input->post('info_content'));
		$info_display_until= sanitize($this->input->post('info_display_date'));

		if ($info_subject == "" || 
			$info_content == "" || 
			$info_display_until == "" ){
				$data = array("success" => 0, 'message' => 'Please fill up all required fields.');
		} else {
			$this->model->save_announcement($info_subject,$info_content,$info_display_until,$user_id);
			$data = array("success" => 1,  'message' => 'Announcement successfully created.');
		}
		generate_json($data);
	}

	public function save_info_application(){

		$info_aname = sanitize($this->input->post('info_aname'));
		// $info_bfee = sanitize($this->input->post('info_bfee'));
		// $info_pfee = sanitize($this->input->post('info_pfee'));

		if ($info_aname== ""
			// $info_bfee  == "" || 
			// $info_pfee == "" 
			){

			$data = array("success" => 0, 'message' => 'Please fill up all required fields.');
		} else {

				$ifAppExist =  $this->model->checkApplicationExist($info_aname); //check if branch code exist

				if ($ifAppExist->num_rows() > 0) { //if exists

					$data = array("success" => 0, 'message' => 'Application Category already exist.');

				}else{ //if not exist then go.

					// $this->model->save_info_application($info_aname,$info_bfee,$info_pfee); this is old dont erase
					$this->model->save_info_application($info_aname);
					$data = array("success" => 1,  'message' => 'Application Category successfully created.');
				}
			}
			generate_json($data);
		}

		public function save_resched_fee(){

			$tba_resched_fee= sanitize($this->input->post('tba_resched_fee'));
			$tba_resched_limit= sanitize($this->input->post('tba_resched_limit'));

			if ($tba_resched_fee== "" || $tba_resched_limit  == ""){
				$data = array("success" => 0, 'message' => 'Please fill up all required fields.');
			} else {
				
				$this->model->save_reschedule_fee($tba_resched_fee,$tba_resched_limit);
				$data = array("success" => 1,  'message' => 'Reschedule Fee and Reschedule Limit successfully created.');
			}
			generate_json($data);
		}

		public function save_info_requirement(){

			$info_desc = sanitize($this->input->post('info_req_desc'));

			if ($info_desc== ""){
				
				$data = array("success" => 0, 'message' => 'Please fill up all required fields.');
			} else {

				$ifReqExist =  $this->model->checkRequirementExist($info_desc); //check if branch code exist

				if ($ifReqExist->num_rows() > 0) { //if exists

					$data = array("success" => 0, 'message' => 'Document Type already exist.');

				}else{ //if not exist then go.

					$this->model->save_info_requirement($info_desc);
					$data = array("success" => 1,  'message' => 'Document Type successfully created.');
				}
			}
			generate_json($data);
		}

		public function deleteBranch(){
			
			$del_branch_id = sanitize($this->input->post('del_branch_id'));

			if ($del_branch_id  == "") {
				$data = array("success" => 0, 'message' => "Something went wrong, Please Try again!");
			}else{
				$query = $this->model->deleteBranch($del_branch_id);

				$data = array("success" => 1, 'message' => "Branch Deleted!" , "del_branch_id" => $del_branch_id);
			}

			generate_json($data);
		}

		public function deleteHoliday(){
			
			$del_holiday_id = sanitize($this->input->post('del_holiday_id'));

			if ($del_holiday_id  == "") {
				$data = array("success" => 0, 'message' => "Something went wrong, Please Try again!");
			}else{
				$query = $this->model->deleteHoliday($del_holiday_id);

				$data = array("success" => 1, 'message' => "Holiday Deleted!" , "del_holiday_id" => $del_holiday_id);
			}

			generate_json($data);
		}

		public function deleteCountry(){
			
			$del_country_id = sanitize($this->input->post('del_country_id'));

			if ($del_country_id  == "") {
				$data = array("success" => 0, 'message' => "Something went wrong, Please Try again!");
			}else{
				$query = $this->model->deleteCountry($del_country_id);
				$data = array("success" => 1, 'message' => "Country Deleted!");
			}

			generate_json($data);
		}

		public function delete_sched_limit(){
			
			$del_sched_limit_id = sanitize($this->input->post('del_sched_limit_id'));

			if ($del_sched_limit_id  == "") {
				$data = array("success" => 0, 'message' => "Something went wrong, Please Try again!");
			}else{
				$query = $this->model->delete_sched_limit($del_sched_limit_id);

				$data = array("success" => 1, 'message' => "Schedule limit Deleted!" , "del_sched_limit_id" => $del_sched_limit_id);
			}

			generate_json($data);
		}

		public function deleteAppointment(){
			
			$del_appointment_id = sanitize($this->input->post('del_appointment_id'));

			if ($del_appointment_id  == "") {
				$data = array("success" => 0, 'message' => "Something went wrong, Please Try again!");
			}else{
				$query = $this->model->deleteAppointment($del_appointment_id);
				$data = array("success" => 1, 'message' => "Appointment Deleted!" , "del_appointment_id" => $del_appointment_id);
			}

			generate_json($data);
		}


		public function deleteApplication(){
			
			$del_application_id = sanitize($this->input->post('del_application_id'));

			if ($del_application_id  == "") {
				$data = array("success" => 0, 'message' => "Something went wrong, Please Try again!");
			}else{
				$query = $this->model->deleteApplication($del_application_id);
				$data = array("success" => 1, 'message' => "Application Category Deleted!" , "del_application_id" => $del_application_id);
			}
			generate_json($data);
		}

		public function deleteRescheduleFee(){
			
			$del_resched_id = sanitize($this->input->post('del_resched_id'));

			if ($del_resched_id  == "") {
				$data = array("success" => 0, 'message' => "Something went wrong, Please Try again!");
			}else{
				$query = $this->model->deleteRescheduleFee($del_resched_id);
				$data = array("success" => 1, 'message' => "Reschedule Fee/Limit Deleted!" , "del_resched_id" => $del_resched_id);
			}
			generate_json($data);
		}


		public function cancelApplication(){
			
			$del_application_id = sanitize($this->input->post('del_application_id'));

			if ($del_application_id  == "") {
				$data = array("success" => 0, 'message' => "Something went wrong, Please Try again!");
			}else{
				$query = $this->model->cancelApplication($del_application_id);

				$data = array("success" => 1, 'message' => "Application Cancelled!" , "del_application_id" => $del_application_id);
			}

			generate_json($data);
		}

		public function deleteRequirement(){
			
			$del_requirement_id = sanitize($this->input->post('del_requirement_id'));

			if ($del_requirement_id  == "") {
				$data = array("success" => 0, 'message' => "Something went wrong, Please Try again!");
			}else{
				$query = $this->model->deleteRequirement($del_requirement_id);

				$data = array("success" => 1, 'message' => "Document Type Deleted!" , "del_requirement_id" => $del_requirement_id);
			}

			generate_json($data);
		}

		public function save_info_accounts(){
			
			$info_fname = sanitize($this->input->post('info_fname'));
			$info_mname = sanitize($this->input->post('info_mname'));
			$info_lname = sanitize($this->input->post('info_lname'));
			$branch_id = sanitize($this->input->post('info_assigned_branch'));
			$info_contact_number = sanitize($this->input->post('info_contact_number'));
			$info_emailaddress = sanitize($this->input->post('info_emailaddress'));
			$info_position = sanitize($this->input->post('info_position'));

			if ($info_fname == "" || 
				$info_lname == "" || 
				$info_contact_number == "" ||  
				$info_emailaddress == "" ||
				$info_position == "" ) {
				
				$data = array("success" => 0, 'message' => 'Please fill up all required fields.');
		}else{

				$ifEmailExist =  $this->model->checkEmailExist($info_emailaddress); //check if email is exist

				if ($ifEmailExist->num_rows() > 0) { //if exists

					$data = array("success" => 0, 'message' => 'Email already exist.');

				}else { //if not exist then go.

					$Generate_random_password = Generate_random_password();

					$options = [
						'cost' => 12,
					];

					$password = password_hash($Generate_random_password, PASSWORD_BCRYPT, $options);

					$error = 0;

					if($this->session->userdata('position_id') == "3"){ //branch admin
						$operator_info = $this->model->getBranchAdminInfo($this->session->userdata('email'))->row();
						$branch_id = $operator_info->branch_admin_assigned_branch_id;

						if ($branch_id == 0) {
							$error = 1;
							$data = array("success" => 0, 'message' => 'You need to fill up branch information before you can create an account');
						}else{
							$query = $this->model->save_info_accounts($info_fname, $info_mname, $info_lname, $info_contact_number, $info_emailaddress, $password, $info_position, $branch_id);
						}

					}else if($this->session->userdata('position_id') == "1"){ //admin

						if($info_position == 3 || $info_position ==5){
							if($branch_id == ""){
								$data = array("success" => 0, 'message' => 'You need to fill up branch information before you can create an account');
							}
						}
						$query = $this->model->save_info_accounts($info_fname, $info_mname, $info_lname, $info_contact_number, $info_emailaddress, $password, $info_position, $branch_id);
					}else{
						$this->logout();
					}
					
					
					if ($error == 0) {
						$data = array("success" => 1, 'message' => 'Account Added! <br> Account Password is sent in the email address', 'affected rows' => $query);

						// this code is for sending email
						$this->load->library('email');

						$token_email = en_dec('en','CloudPandaPHInc');
						$receivername = $info_fname.' '.$info_lname;
						$verify_href = base_url('main');'';

						$subject = "Account Password";
						// Get full html:
						$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
						<html xmlns="http://www.w3.org/1999/xhtml">
						<head>
						<meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
						<title>' . html_escape($subject) . '</title>
						<style type="text/css">
						body {
							font-family: Arial, Verdana, Helvetica, sans-serif;
							font-size: 16px;
						}
						</style>
						</head>
						<body>
						<table style="width:538px;background-color:#393836; box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.3);" align="center" cellspacing="0" cellpadding="0">
						<tbody>
						<tr>
						<td style="height:65px; background-color:#2f333e; border-bottom:1px solid #4d4b48;padding:0px; text-align:center; color:white; ">
						<h1 style="font-weight:lighter;">Alien Census Registration System</h1>
						</td>
						</tr>
						<tr>
						<td bgcolor="#eef5f9" style="">

						<table width="470" border="0" align="center" cellpadding="0" cellspacing="0" style="padding-left:5px;padding-right:5px;padding-bottom:10px">

						<tbody><tr bgcolor="white">
						<td style="padding-left:10px; padding-top:32px;padding-bottom:16px">
						<span style="font-size:24px;color:#292b2c;font-family:Arial,Helvetica,sans-serif;font-weight:bold; word-break: break-all;">
						Dear '.$receivername.',
						</span><br>
						</td>
						</tr>

						<tr bgcolor="white">
						<td style="padding:20px;font-size:12px;line-height:17px;color:#292b2c;font-family:Arial,Helvetica,sans-serif">
						<p>Your Account\'s password is:</p>
						<h3>'.$Generate_random_password.'</h3>
						<p><a style="color:#292b2c text-decoration:underline;" href="'.$verify_href.'">Click here to login your account.</a></p>
						</td>
						</tr>

						<tr>
						<td style="padding-top:16px;font-size:12px;line-height:17px;color:#292b2c;font-family:Arial,Helvetica,sans-serif">
						<p>Knowing your password will enable you to: access your account and change your password if you logged in.</p>
						</td>

						</tr>

						<tr>
						<td style="font-size:12px;color:#292b2c;padding-top:16px;padding-bottom:60px">
						<p>Thanks for helping us maintain the security of your account.
						The Cloud Panda PH Team
						<a style="color:#8f98a0" href="https://cloudpanda.ph/" target="_blank" data-saferedirecturl="https://cloudpanda.ph/">https://cloudpanda.ph</a><br>
						</p></td>
						</tr>

						</tbody></table>
						</td>
						</tr>
						<tr>
						<td bgcolor="white">

						<table width="460" height="55" border="0" align="center" cellpadding="0" cellspacing="0">

						<tbody><tr valign="top">
						<td width="110">
						<a href="https://cloudpanda.ph/">
						<img src="http://cloudpanda.cloudpanda.com.ph/apiv3/release/iphone/10/photo/root_swipe_header_elements_150195765219_image@iphone6plus.jpg?v=1501957847" alt="cloudpanda" width="55" hspace="0" vspace="0" border="0" align="top" class="CToWUd"></a>
						</td>
						<td width="350" >
						<div style="color:#292b2c; font-size:9px;font-family:Verdana,Arial,Helvetica,sans-serif; margin-top:22px; margin-left: 28px;">© Cloud Panda PH Inc. All rights reserved.</div>
						</td>
						</tr>

						</tbody></table>
						</td>
						</tr>
						</tbody>
						</table>
						</body>
						</html>';
						// Also, for getting full html you may use the following internal method:
						//$body = $this->email->full_html($subject, $message);
						
						$result = $this->email
						->from('support@cloudpanda.ph')
						        ->reply_to('')    // Optional, an account where a human being reads.
						        ->to($info_emailaddress)
						        ->subject($subject)
						        ->message($body)
						        ->send();

						// var_dump($result);
						// echo '<br />';
						// echo $this->email->print_debugger();
						// exit;
						    }
						}
					}

					generate_json($data);
				}

		// public function save_info_accounts(){
		// 	$info_fname = sanitize($this->input->post('info_fname'));
		// 	$info_mname = sanitize($this->input->post('info_mname'));
		// 	$info_lname = sanitize($this->input->post('info_lname'));
		// 	$info_bdate = sanitize($this->input->post('info_bdate'));
		// 	$branch_id = sanitize($this->input->post('info_assigned_branch'));
		// 	$info_contact_number = sanitize($this->input->post('info_contact_number'));
		// 	$info_country = sanitize($this->input->post('info_country'));
		// 	$info_gender = sanitize($this->input->post('info_gender'));
		// 	$info_emailaddress = sanitize($this->input->post('info_emailaddress'));
		// 	$info_position = sanitize($this->input->post('info_position'));

		// 	if ($info_fname == "" || 
		// 		$info_lname == "" || 
		// 		$info_bdate == "" || 
		// 		$info_contact_number == "" || 
		// 		// $info_address == "" || 
		// 		$info_country == "" || 
		// 		// $info_city == "" || 
		// 		// $info_gender == "" || 
		// 		$info_emailaddress == "" ||
		// 		$info_position == "" ) {
				
		// 		$data = array("success" => 0, 'message' => 'Please fill up all required fields.');
		// 	}else{
		// 		if ($info_gender == 0) {
		// 			$info_gender == 1; // nawawala wala ung laman ni gender
		// 		}

		// 		$ifEmailExist =  $this->model->checkEmailExist($info_emailaddress); //check if email is exist

		// 		if ($ifEmailExist->num_rows() > 0) { //if exists

		// 			$data = array("success" => 0, 'message' => 'Email already exist.');

		// 		}else { //if not exist then go.

		// 			$info_bdate = date_format(date_create($info_bdate),"Y-m-d");
		// 			$info_emailaddress = en_dec('en',en_dec('en',$info_emailaddress));
		// 			$Generate_random_password = Generate_random_password();

		// 			$options = [
		// 		    'cost' => 12,
		// 			];

		// 			$password = password_hash($Generate_random_password, PASSWORD_BCRYPT, $options);

		// 			$error = 0;

		// 			if($this->session->userdata('position_id') == "3"){ //branch admin
		// 				$operator_info = $this->model->getBranchAdminInfo($this->session->userdata('email'))->row();
		// 				$branch_id = $operator_info->branch_admin_assigned_branch_id;

		// 				if ($branch_id == 0) {

		// 					$error = 1;

		// 					$data = array("success" => 0, 'message' => 'You need to fill up branch information before you can create an account');
		// 				}else{
		// 					$query = $this->model->save_info_accounts($info_fname, $info_mname, $info_lname, $info_bdate, $info_contact_number, $info_country, $info_gender, $info_emailaddress, $password, $info_position, $branch_id);
		// 				}

		// 			}else if($this->session->userdata('position_id') == "1"){ //admin

		// 				if($info_position == 3 || $info_position ==5){
		// 					if($branch_id == ""){
		// 						$data = array("success" => 0, 'message' => 'You need to fill up branch information before you can create an account');
		// 					}
		// 				}
		// 				$query = $this->model->save_info_accounts($info_fname, $info_mname, $info_lname, $info_bdate, $info_contact_number, $info_country, $info_gender, $info_emailaddress, $password, $info_position, $branch_id);
		// 			}else{
		// 				$this->logout();
		// 			}


		// 			if ($error == 0) {
		// 				$data = array("success" => 1, 'message' => 'Account Added! <br> Account Password is sent in the email address', 'affected rows' => $query);

		// 				// this code is for sending email
		// 				$this->load->library('email');

		// 				$token_email = en_dec('en','CloudPandaPHInc');
		// 				$receivername = $info_fname.' '.$info_lname;
		// 				$verify_href = base_url('main');'';

		// 				$subject = "Account Password";
		// 				// Get full html:
		// 				$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		// 				<html xmlns="http://www.w3.org/1999/xhtml">
		// 				<head>
		// 				    <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
		// 				    <title>' . html_escape($subject) . '</title>
		// 				    <style type="text/css">
		// 				        body {
		// 				            font-family: Arial, Verdana, Helvetica, sans-serif;
		// 				            font-size: 16px;
		// 				        }
		// 				    </style>
		// 				</head>
		// 				<body>
		// 					<table style="width:538px;background-color:#393836; box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.3);" align="center" cellspacing="0" cellpadding="0">
		// 						<tbody>
		// 							<tr>
		// 								<td style="height:65px; background-color:#2f333e; border-bottom:1px solid #4d4b48;padding:0px; text-align:center; color:white; ">
		// 						              <h1 style="font-weight:lighter;">Alien Census Registration System</h1>
		// 						        </td>
		// 							</tr>
		// 							<tr>
		// 								<td bgcolor="#eef5f9" style="">

		// 									<table width="470" border="0" align="center" cellpadding="0" cellspacing="0" style="padding-left:5px;padding-right:5px;padding-bottom:10px">

		// 										<tbody><tr bgcolor="white">
		// 											<td style="padding-left:10px; padding-top:32px;padding-bottom:16px">
		// 											<span style="font-size:24px;color:#292b2c;font-family:Arial,Helvetica,sans-serif;font-weight:bold; word-break: break-all;">
		// 												Dear '.$receivername.',
		// 											</span><br>
		// 											</td>
		// 										</tr>

		// 										<tr bgcolor="white">
		// 						                	<td style="padding:20px;font-size:12px;line-height:17px;color:#292b2c;font-family:Arial,Helvetica,sans-serif">
		// 						  						<p>Your Account\'s password is:</p>
		// 						  						<h3>'.$Generate_random_password.'</h3>
		// 						  						<p><a style="color:#292b2c text-decoration:underline;" href="'.$verify_href.'">Click here to login your account.</a></p>
		// 						    				</td>
		// 						    			</tr>

		// 										<tr>
		// 						                    <td style="padding-top:16px;font-size:12px;line-height:17px;color:#292b2c;font-family:Arial,Helvetica,sans-serif">
		// 						                        <p>Knowing your password will enable you to: access your account and change your password if you logged in.</p>
		// 						                    </td>

		// 						                </tr>

		// 										<tr>
		// 						                	<td style="font-size:12px;color:#292b2c;padding-top:16px;padding-bottom:60px">
		// 						                        <p>Thanks for helping us maintain the security of your account.
		// 						                        The Cloud Panda PH Team
		// 						                        <a style="color:#8f98a0" href="https://cloudpanda.ph/" target="_blank" data-saferedirecturl="https://cloudpanda.ph/">https://cloudpanda.ph</a><br>
		// 						                    </p></td>
		// 						                </tr>

		// 									</tbody></table>
		// 								</td>
		// 							</tr>
		// 							<tr>
		// 								<td bgcolor="white">

		// 										<table width="460" height="55" border="0" align="center" cellpadding="0" cellspacing="0">

		// 											<tbody><tr valign="top">
		// 												<td width="110">
		// 													<a href="https://cloudpanda.ph/">
		// 													<img src="http://cloudpanda.cloudpanda.com.ph/apiv3/release/iphone/10/photo/root_swipe_header_elements_150195765219_image@iphone6plus.jpg?v=1501957847" alt="cloudpanda" width="55" hspace="0" vspace="0" border="0" align="top" class="CToWUd"></a>
		// 												</td>
		// 												<td width="350" >
		// 													<div style="color:#292b2c; font-size:9px;font-family:Verdana,Arial,Helvetica,sans-serif; margin-top:22px; margin-left: 28px;">© Cloud Panda PH Inc. All rights reserved.</div>
		// 												</td>
		// 											</tr>

		// 										</tbody></table>
		// 								</td>
		// 							</tr>
		// 						</tbody>
		// 					</table>
		// 				</body>
		// 				</html>';
		// 				// Also, for getting full html you may use the following internal method:
		// 				//$body = $this->email->full_html($subject, $message);

		// 				$result = $this->email
		// 				        ->from('support@cloudpanda.ph')
		// 				        ->reply_to('')    // Optional, an account where a human being reads.
		// 				        ->to($info_emailaddress)
		// 				        ->subject($subject)
		// 				        ->message($body)
		// 				        ->send();

		// 				// var_dump($result);
		// 				// echo '<br />';
		// 				// echo $this->email->print_debugger();
		// 				// exit;
		// 			}
		// 		}
		// 	}

		// 	generate_json($data);
		// }




				public function logout() {
					$this->session->sess_destroy();
					$images = $this->model->getBgImages()->result_array();
					$data = array('images'=> $images);
					$this->load->view('login',$data);

				}

				public function cp_logout() {
					$this->session->sess_destroy();
					$images = $this->model->getBgImages()->result_array();
					$data = array('images'=> $images);
					$this->load->view('cp_login',$data);
				}

		// public function saveInfo_user(){

		// 	$email_fk = $this->session->userdata('email');
		// 	$info_fname = sanitize($this->input->post('info_fname'));
		// 	$info_mname = sanitize($this->input->post('info_mname'));
		// 	$info_lname = sanitize($this->input->post('info_lname'));
		// 	$info_bdate = sanitize($this->input->post('info_bdate'));
		// 	$info_contact_num = sanitize($this->input->post('info_contact_num'));
		// 	$info_country = sanitize($this->input->post('info_country'));
		// 	$info_gender = sanitize($this->input->post('info_gender'));
		// 	$info_emailaddress = sanitize($this->input->post('info_emailaddress'));

		// 	if ($info_fname == "" || 
		// 		$info_lname == "" || 
		// 		$info_contact_num == "" || 
		// 		$info_country == "" || 
		// 		$info_gender == "" ) {
		// 		// $info_emailaddress == "" ) {
				
		// 		$data = array("success" => 0, 'message' => 'Please fill up all required fields.');
		// 	}else{

		// 		$ifEmailExist =  $this->model->checkEmailExist_applicant_except($info_emailaddress, $email_fk); //check if email exist

		// 		if ($ifEmailExist->num_rows() > 0) { //if exists

		// 			$data = array("success" => 0, 'message' => 'Email already exist.');

		// 		}else{ //if not exist then go.

		// 			$info_bdate = date_format(date_create($info_bdate),"Y-m-d");

		// 			if ($this->session->userdata('position_id') == '1') { // admin
		// 			$query = $this->model->saveInfo_admin($email_fk, $info_fname, $info_mname, $info_lname, $info_bdate, $info_contact_num, $info_country, $info_gender, $info_emailaddress);

		// 			}else if ($this->session->userdata('position_id') == '2') { // applicant
		// 					$info_emailaddress = en_dec('en',en_dec('en',$info_emailaddress));
		// 					$info_fname = en_dec('en',en_dec('en',$info_fname));
		// 					$info_mname = en_dec('en',en_dec('en',$info_mname));
		// 					$info_lname = en_dec('en',en_dec('en',$info_lname));
		// 					$info_contact_num = en_dec('en',en_dec('en',$info_contact_num));

		// 			$query = $this->model->saveInfo_user($email_fk, $info_fname, $info_mname, $info_lname, $info_bdate, $info_contact_num, $info_country,$info_gender, $info_emailaddress);

		// 			}else if ($this->session->userdata('position_id') == '3') { // branch admin
		// 			$query = $this->model->saveInfo_branch_admin($email_fk, $info_fname, $info_mname, $info_lname, $info_bdate, $info_contact_num, $info_country,$info_gender, $info_emailaddress);

		// 			}else if ($this->session->userdata('position_id') == '4') { // staff
		// 			$query = $this->model->saveInfo_staff($email_fk, $info_fname, $info_mname, $info_lname, $info_bdate, $info_contact_num, $info_country,$info_gender, $info_emailaddress);

		// 			}else if ($this->session->userdata('position_id') == '5') { // branch staff
		// 			$query = $this->model->saveInfo_branch_staff($email_fk, $info_fname, $info_mname, $info_lname, $info_bdate, $info_contact_num, $info_country,$info_gender, $info_emailaddress);
		// 			}


		// 			$data = array("success" => 1, 'message' => 'Profile Information Updated!', 'affected rows' => $query);					
		// 		}
		// 	}

		// 	generate_json($data);
		// }


				public function saveInfo_user(){

					$email_fk = $this->session->userdata('email');
					$info_fname = sanitize($this->input->post('info_fname'));
					$info_mname = sanitize($this->input->post('info_mname'));
					$info_lname = sanitize($this->input->post('info_lname'));
					$info_contact_num = sanitize($this->input->post('info_contact_num'));
					$info_emailaddress = sanitize($this->input->post('info_emailaddress'));

					if ($info_fname == "" || 
						$info_lname == "" || 
						$info_contact_num == "" ) {


						$data = array("success" => 0, 'message' => 'Please fill up all required fields.');
				}else{

				$ifEmailExist =  $this->model->checkEmailExist_applicant_except($info_emailaddress, $email_fk); //check if email exist

				if ($ifEmailExist->num_rows() > 0) { //if exists

					$data = array("success" => 0, 'message' => 'Email already exist.');

				}else{ //if not exist then go.

					if ($this->session->userdata('position_id') == '1') { // admin
						$query = $this->model->saveInfo_admin($email_fk, $info_fname, $info_mname, $info_lname, $info_contact_num, $info_emailaddress);

					}else if ($this->session->userdata('position_id') == '3') { // branch admin
						$query = $this->model->saveInfo_branch_admin($email_fk, $info_fname, $info_mname, $info_lname, $info_contact_num,$info_emailaddress);

					}else if ($this->session->userdata('position_id') == '4') { // staff
						$query = $this->model->saveInfo_staff($email_fk, $info_fname, $info_mname, $info_lname, $info_contact_num, $info_emailaddress);

					}else if ($this->session->userdata('position_id') == '5') { // branch staff
						$query = $this->model->saveInfo_branch_staff($email_fk, $info_fname, $info_mname, $info_lname, $info_contact_num, $info_emailaddress);
					}


					$data = array("success" => 1, 'message' => 'Profile Information Updated!', 'affected rows' => $query);					
				}
			}

			generate_json($data);
		}

		public function editInfo_applicant(){ 
			$email_fk = $this->session->userdata('email');
			$user_id = $this->session->userdata('user_id');
			$info_email = sanitize($this->input->post('info_email')); //required
			$info_fname = sanitize($this->input->post('info_fname')); //required
			$info_mname = sanitize($this->input->post('info_mname'));
			$info_lname = sanitize($this->input->post('info_lname'));//required
			$info_xname = sanitize($this->input->post('info_xname'));
			$info_acr_no = sanitize($this->input->post('info_acr_no'));
			$info_alias1 = sanitize($this->input->post('info_alias1'));
			$info_alias2 = sanitize($this->input->post('info_alias2'));
			$info_bdate = sanitize($this->input->post('info_bdate'));//required
			$info_age = sanitize($this->input->post('info_age'));//required
			$info_gender = sanitize($this->input->post('info_gender'));//required
			$info_civilstatus = sanitize($this->input->post('info_civilstatus'));//required
			$info_birth_country = sanitize($this->input->post('info_birth_country'));//required
			$info_nationality = sanitize($this->input->post('info_nationality'));//required
			$info_passport_no = sanitize($this->input->post('info_passport_no'));
			$info_issuance_place = sanitize($this->input->post('info_issuance_place'));
			$info_issuance_date = sanitize($this->input->post('info_issuance_date'));
			$info_expiry_date = sanitize($this->input->post('info_expiry_date'));
			$info_arrival_date = sanitize($this->input->post('info_arrival_date'));

			$info_mobile_num = sanitize($this->input->post('info_mobile'));
			$info_landline = sanitize($this->input->post('info_landline'));

			$info_ph_st = sanitize($this->input->post('info_ph_st'));
			$info_ph_village = sanitize($this->input->post('info_ph_village'));
			$info_ph_brgy = sanitize($this->input->post('info_ph_brgy'));
			$info_ph_city = sanitize($this->input->post('info_ph_city'));
			$info_ph_prov = sanitize($this->input->post('info_ph_prov'));
			$info_ph_zipcode = sanitize($this->input->post('info_ph_zipcode'));			

			$info_ab_st = sanitize($this->input->post('info_ab_st'));
			$info_ab_village = sanitize($this->input->post('info_ab_village'));
			$info_ab_city = sanitize($this->input->post('info_ab_city'));
			$info_ab_state = sanitize($this->input->post('info_ab_state'));
			$info_ab_country = sanitize($this->input->post('info_ab_country'));
			$info_ab_zipcode = sanitize($this->input->post('info_ab_zipcode'));

			if($info_fname == "" || 
				$info_lname == "" || 
				$info_bdate == "" || 
				$info_gender == "" ||
				$info_age == "" || 
				$info_civilstatus == "" ||
				$info_birth_country == "" || 
				$info_nationality == "" ||
				$info_email == "") 
			{
				$data = array("success" => 0, 'message' => 'Please fill up all required fields');	
			}else{
				$ifEmailExist =  $this->model->checkEmailExist_applicant_except($info_email,$email_fk); //check if email is exist

				if ($ifEmailExist->num_rows() > 0) { //if exists
					$data = array("success" => 0, 'message' => 'Email entered is already taken');
				}
				else{
					$info_bdate = date_format(date_create($info_bdate),"Y-m-d"); 
					$info_issuance_date = date_format(date_create($info_issuance_date),"Y-m-d"); 
					$info_expiry_date = date_format(date_create($info_expiry_date),"Y-m-d"); 
					$info_arrival_date = date_format(date_create($info_arrival_date),"Y-m-d"); 

					$query = $this->model->editInfo_applicant($user_id,$info_email,$email_fk,$info_fname ,$info_mname,$info_lname,$info_xname,$info_acr_no,$info_alias1 ,$info_alias2 , $info_bdate,$info_age,$info_gender,$info_civilstatus,$info_birth_country,$info_nationality,$info_passport_no,$info_issuance_place,$info_issuance_date,$info_expiry_date,$info_arrival_date, $info_mobile_num, $info_landline, $info_ph_st, $info_ph_village, $info_ph_brgy, $info_ph_city, $info_ph_prov, $info_ph_zipcode, $info_ab_st, $info_ab_village, $info_ab_city, $info_ab_state, $info_ab_country, $info_ab_zipcode);



					$data = array("success" => 1, 'message' => 'Profile Information Updated!', 'affected rows' => $query);	
				}
			}
			generate_json($data);
		}

		public function accounts($token = ''){ //
			$this->isLoggedIn();

			$data_branch_admin = array(
				'token' => $token,
				'branch_admin_info' => $this->model->getBranchAdminInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),
				'get_position' => $this->model->get_position()
			);

			$data_admin = array(
				'token' => $token,
				'admin_info' => $this->model->getAdminInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),
				'get_branch' => $this->model->get_branch(),
				'get_position' => $this->model->get_position()
			);
			if ($this->session->userdata('position_id') == '1') { // admin
				$this->load->view('includes/admin_header', $data_admin);
				$this->load->view('admin/settings/accounts', $data_admin);
			}
			if ($this->session->userdata('position_id') == '3') { // branch admin
				$this->load->view('includes/branch_admin_header', $data_branch_admin);
				$this->load->view('branch_admin/settings/accounts', $data_branch_admin);
			}
		}

		public function generate_ereceipts($token = ''){ //
			$this->isLoggedIn();

			$data_branch_admin = array(
				'token' => $token,
				'branch_admin_info' => $this->model->getBranchAdminInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),
				'get_position' => $this->model->get_position()
			);

			$data_admin = array(
				'token' => $token,
				'admin_info' => $this->model->getAdminInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),
				'get_branch' => $this->model->get_branch(),
				'get_position' => $this->model->get_position()
			);
			if ($this->session->userdata('position_id') == '1') { // admin
				$this->load->view('includes/admin_header', $data_admin);
				$this->load->view('admin/settings/generate_receipts', $data_admin);
			}
			if ($this->session->userdata('position_id') == '3') { // branch admin
				$this->load->view('includes/branch_admin_header', $data_branch_admin);
				$this->load->view('branch_admin/settings/generate_ereceipts', $data_branch_admin);
			}
		}

        public function generate_receipt(){ 

            $prefix = $this->input->post('prefix');
            $start = $this->input->post('start');
            $end = $this->input->post('end');
            $html = "";
            if($start == "" || $end == ""){
                $data = array('success'=> 0, 'message'=> "Please fill up both Start and End");
            }else{
                for ($i=$start; $i <= $end; $i++) { 
                    $e_receipt = $prefix.$i;
                    //Check if receipt is not duplicate
                    $is_receipt_duplicate = $this->model->check_receipt_availability($e_receipt);
                    //If not duplicate, save
                    if(!$is_receipt_duplicate){
                        $this->model->generate_receipt($e_receipt);
                        $html .= $prefix.$i.",";
                    }else{
                        $html .= $prefix.$i." (duplicate)".",";
                    }
                }
                $data = array('success'=> 1, 'message'=> "Successfully generated E-Receipt", 'html'=>$html);
            }
            generate_json($data);
        }

        public function update_conveniencefee(){ 

            $reg_debit = $this->input->post('reg_debit');
            $reg_credit = $this->input->post('reg_credit');
            $exp_debit = $this->input->post('exp_debit');
            $exp_credit = $this->input->post('exp_credit');

            if($reg_debit == "" || $reg_credit == "" || $exp_debit =="" || $exp_credit== ""){
                $data = array('success'=> 0, 'message'=> "Please fill up all required fields");
            }else{
                $this->model->update_conveniencefee($reg_debit, $reg_credit,$exp_debit, $exp_credit);
                $data = array('success'=> 1, 'message'=> "Successfully updated Convenience Fee");
            }
            generate_json($data);
        }

        public function update_applicationfee(){ 

            $reg_debit = $this->input->post('reg_debit');
            $reg_credit = $this->input->post('reg_credit');
            $exp_debit = $this->input->post('exp_debit');
            $exp_credit = $this->input->post('exp_credit');

            if($reg_debit == "" || $reg_credit == "" || $exp_debit =="" || $exp_credit== ""){
                $data = array('success'=> 0, 'message'=> "Please fill up all required fields");
            }else{
                $this->model->update_applicationfee($reg_debit, $reg_credit,$exp_debit, $exp_credit);
                $data = array('success'=> 1, 'message'=> "Successfully updated Application Fee");
            }
            generate_json($data);
        }

        public function conveniencefee($token = ''){ 
            $this->isLoggedIn();
            $reg_conveniencefee = $this->model->get_regular_convenience_fee()->row();
            $exp_conveniencefee = $this->model->get_express_convenience_fee()->row();

            $data_branch_admin = array(
                'token' => $token,
                'branch_admin_info' => $this->model->getBranchAdminInfo($this->session->userdata('email'))->row(),
                'get_country' => $this->model->get_country(),
                'get_position' => $this->model->get_position(),
                'reg_conveniencefee' => $reg_conveniencefee,
                'exp_conveniencefee' => $exp_conveniencefee
            );

            $data_admin = array(
                'token' => $token,
                'admin_info' => $this->model->getAdminInfo($this->session->userdata('email'))->row(),
                'get_country' => $this->model->get_country(),
                'get_branch' => $this->model->get_branch(),
                'get_position' => $this->model->get_position(),
                'reg_conveniencefee' => $reg_conveniencefee,
                'exp_conveniencefee' => $exp_conveniencefee
            );
            if ($this->session->userdata('position_id') == '1') { // admin
                $this->load->view('includes/admin_header', $data_admin);
                $this->load->view('admin/settings/convenience_fee', $data_admin);
            }
            if ($this->session->userdata('position_id') == '3') { // branch admin
                $this->load->view('includes/branch_admin_header', $data_branch_admin);
                $this->load->view('branch_admin/settings/convenience_fee', $data_branch_admin);
            }
        }

		public function applicationfee($token = ''){ 
			$this->isLoggedIn();
			$reg_applicationfee = $this->model->get_regular_convenience_fee()->row();
			$exp_applicationfee = $this->model->get_express_convenience_fee()->row();

			$data_branch_admin = array(
				'token' => $token,
				'branch_admin_info' => $this->model->getBranchAdminInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),
				'get_position' => $this->model->get_position(),
				'reg_applicationfee' => $reg_applicationfee,
				'exp_applicationfee' => $exp_applicationfee
			);

			$data_admin = array(
				'token' => $token,
				'admin_info' => $this->model->getAdminInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),
				'get_branch' => $this->model->get_branch(),
				'get_position' => $this->model->get_position(),
				'reg_applicationfee' => $reg_applicationfee,
				'exp_applicationfee' => $exp_applicationfee
			);
			if ($this->session->userdata('position_id') == '1') { // admin
				$this->load->view('includes/admin_header', $data_admin);
				$this->load->view('admin/settings/application_fee', $data_admin);
			}
			if ($this->session->userdata('position_id') == '3') { // branch admin
				$this->load->view('includes/branch_admin_header', $data_branch_admin);
				$this->load->view('branch_admin/settings/application_fee', $data_branch_admin);
			}
		}

		public function documents($token = ''){ //applicant documents
			$this->isLoggedIn();
			$uploaded_docs = $this->model->get_uploaded_docs($this->session->userdata('email'));
			if($uploaded_docs->num_rows() > 0){
				$has_uploaded_docs = true;
				$docs_uploaded = $uploaded_docs->result();
				$uploaded_id = [];
				foreach($docs_uploaded as $doc){
					array_push($uploaded_id, $doc->document_type_id);
				}
				// $uploaded_id = array_unique($uploaded_id);
				$duplicate_id = array_diff_assoc($uploaded_id, array_unique($uploaded_id));
				$uploaded_id = array_unique($uploaded_id);
				// print_r($duplicate_id);
				// die();
				$data_applicant = array(
					'token' => $token,
					'applicant_info' => $this->model->getApplicantInfo($this->session->userdata('email'))->row(),
					'get_country' => $this->model->get_country(),
					'app_requirement' =>$this->model->get_app_requirement(),
					'app_requirement2' =>$this->model->get_app_requirement2(),
					'has_uploaded_docs' => $has_uploaded_docs,
					'docs_uploaded' => $docs_uploaded,
					'doc_ids' => $uploaded_id,
					'duplicate_ids' => $duplicate_id
				);
			}else{
				$has_uploaded_docs = false;
				$data_applicant = array(
					'token' => $token,
					'applicant_info' => $this->model->getApplicantInfo($this->session->userdata('email'))->row(),
					'get_country' => $this->model->get_country(),
					'app_requirement' =>$this->model->get_app_requirement(),
					'has_uploaded_docs' => $has_uploaded_docs,
					'duplicate_ids' => "",
					'docs_uploaded' => "",
				);
			}

			$this->load->view('includes/header', $data_applicant);
			$this->load->view('applicant/profile/documents', $data_applicant);
			
		}


		public function admin_appointment($token = ''){ //
			$this->isLoggedIn();

			$data_branch_admin = array(
				'token' => $token,
				'branch_admin_info' => $this->model->getBranchAdminInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),
				'get_position' => $this->model->get_position()
			);

			$data_admin = array(
				'token' => $token,
				'admin_info' => $this->model->getAdminInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),
				'get_position' => $this->model->get_position()
			);
			if ($this->session->userdata('position_id') == '1') { // admin
				$this->load->view('includes/admin_header', $data_admin);
				$this->load->view('admin/transactions/appointment', $data_admin);
			}
			if ($this->session->userdata('position_id') == '3') { // branch admin
				$this->load->view('includes/branch_admin_header', $data_branch_admin);
				$this->load->view('branch_admin/settings/accounts', $data_branch_admin);
			}
		}

		public function branch($token = ''){ //
			$this->isLoggedIn();

			$data_admin = array(
				'token' => $token,
				'admin_info' => $this->model->getAdminInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),
				'get_position' => $this->model->get_position()
			);


			if ($this->session->userdata('position_id') == '1') { // admin
				$this->load->view('includes/admin_header', $data_admin);
				$this->load->view('admin/settings/branch', $data_admin);
			}
		}

		public function country($token = ''){ //
			$this->isLoggedIn();

			$data_admin = array(
				'token' => $token,
				'admin_info' => $this->model->getAdminInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),
				'get_position' => $this->model->get_position()
			);

			if ($this->session->userdata('position_id') == '1') { // admin
				$this->load->view('includes/admin_header', $data_admin);
				$this->load->view('admin/settings/country', $data_admin);
			}
		}

		public function document_type($token = ''){ //
			$this->isLoggedIn();

			$data_admin = array(
				'token' => $token,
				'admin_info' => $this->model->getAdminInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),
				'get_position' => $this->model->get_position()
			);

			if ($this->session->userdata('position_id') == '1') { // admin
				$this->load->view('includes/admin_header', $data_admin);
				$this->load->view('admin/settings/document_type', $data_admin);
			}else{
				logout();
			}
		}

		public function schedule($token = ''){ //
			$this->isLoggedIn();

			$data_admin = array(
				'token' => $token,
				'get_branch' => $this->model->get_branch(),
				'admin_info' => $this->model->getAdminInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),
				'get_position' => $this->model->get_position(),
				'holidays' => $this->model->get_holiday()->result_array()
			);

			$data_branch_admin = array(
				'token' => $token,
				'get_branch' => $this->model->get_branch(),
				'branch_admin_info' => $this->model->getBranchAdminInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),
				'get_position' => $this->model->get_position(),
				'holidays' => $this->model->get_holiday()->result_array()
			);


			if ($this->session->userdata('position_id') == '1') { // admin
				$this->load->view('includes/admin_header', $data_admin);
				$this->load->view('admin/settings/schedule', $data_admin);
			}
			if ($this->session->userdata('position_id') == '3') { // branch admin
				$this->load->view('includes/branch_admin_header', $data_branch_admin);
				$this->load->view('branch_admin/settings/schedule', $data_branch_admin);
			}
		}

		public function holiday($token = ''){ //
			$this->isLoggedIn();

			$data_admin = array(
				'token' => $token,
				'get_branch' => $this->model->get_branch(),
				'admin_info' => $this->model->getAdminInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),
				'get_position' => $this->model->get_position(),
				'holidays' => $this->model->get_holiday()->result_array()
			);

			$data_branch_admin = array(
				'token' => $token,
				'get_branch' => $this->model->get_branch(),
				'branch_admin_info' => $this->model->getBranchAdminInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),
				'get_position' => $this->model->get_position(),
				'holidays' => $this->model->get_holiday()->result_array()
			);


			if ($this->session->userdata('position_id') == '1') { // admin
				$this->load->view('includes/admin_header', $data_admin);
				$this->load->view('admin/settings/holiday', $data_admin);
			}
			if ($this->session->userdata('position_id') == '3') { // branch admin
				$this->load->view('includes/branch_admin_header', $data_branch_admin);
				$this->load->view('branch_admin/settings/holiday', $data_branch_admin);
			}
		}

		public function reschedule_fee($token = ''){ //
			$this->isLoggedIn();
			//Check if reschedule fee is already set

			$isRescheduleFeeAlreadySet = $this->model->checkIfRescheduleFeeAlreadySet();

			if($isRescheduleFeeAlreadySet->num_rows() > 0){
				$data_admin = array(
					'token' => $token,
					'get_branch' => $this->model->get_branch(),
					'admin_info' => $this->model->getAdminInfo($this->session->userdata('email'))->row(),
					'get_country' => $this->model->get_country(),
					'get_position' => $this->model->get_position(),
					'holidays' => $this->model->get_holiday()->result_array(),
					'resched_fee_already_set' => true,
					'resched_fee_details' => $this->model->checkIfRescheduleFeeAlreadySet()->row()
				);
			}else{
				$data_admin = array(
					'token' => $token,
					'get_branch' => $this->model->get_branch(),
					'admin_info' => $this->model->getAdminInfo($this->session->userdata('email'))->row(),
					'get_country' => $this->model->get_country(),
					'get_position' => $this->model->get_position(),
					'holidays' => $this->model->get_holiday()->result_array(),
					'resched_fee_already_set' => false);
			}

			if ($this->session->userdata('position_id') == '1') { // admin
				$this->load->view('includes/admin_header', $data_admin);
				$this->load->view('admin/settings/reschedule_fee', $data_admin);
			}else{
				logout();
			}
		}


		public function applications($token = ''){ //
			$this->isLoggedIn();

			$data_admin = array(
				'token' => $token,
				'admin_info' => $this->model->getAdminInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),
				'get_position' => $this->model->get_position()
			);

			$data_branch_admin = array(
				'token' => $token,
				'branch_admin_info' => $this->model->getBranchAdminInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),
				'get_position' => $this->model->get_position()
			);

			if ($this->session->userdata('position_id') == '1') { // admin
				$this->load->view('includes/admin_header', $data_admin);
				$this->load->view('admin/settings/application', $data_admin);
			}

			if ($this->session->userdata('position_id') == '3') { // branch admin
				$this->load->view('includes/branch_admin_header', $data_branch_admin);
				$this->load->view('branch_admin/settings/application', $data_branch_admin);
			}
		}	

		public function announcements($token = ''){ //
			$this->isLoggedIn();

			$data_admin = array(
				'token' => $token,
				'admin_info' => $this->model->getAdminInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),
				'get_position' => $this->model->get_position()
			);

			$data_branch_admin = array(
				'token' => $token,
				'branch_admin_info' => $this->model->getBranchAdminInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),
				'get_position' => $this->model->get_position()
			);

			if ($this->session->userdata('position_id') == '1') { // admin
				$this->load->view('includes/admin_header', $data_admin);
				$this->load->view('admin/settings/announcements', $data_admin);
			}

			if ($this->session->userdata('position_id') == '3') { // branch admin
				$this->load->view('includes/branch_admin_header', $data_branch_admin);
				$this->load->view('branch_admin/settings/announcements', $data_branch_admin);
			}
		}

		public function applicants($token = ''){ //
			$this->isLoggedIn();

			$data_branch_admin = array(
				'token' => $token,
				'branch_admin_info' => $this->model->getBranchAdminInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),
				'get_position' => $this->model->get_position()
			);

			$data_admin = array(
				'token' => $token,
				'admin_info' => $this->model->getAdminInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),
				'get_position' => $this->model->get_position()
			);
			if ($this->session->userdata('position_id') == '1') { // admin
				$this->load->view('includes/admin_header', $data_admin);
				$this->load->view('admin/settings/applicants', $data_admin);
			}
			if ($this->session->userdata('position_id') == '3') { // branch admin
				$this->load->view('includes/branch_admin_header', $data_branch_admin);
				$this->load->view('branch_admin/settings/applicants', $data_branch_admin);
			}
		}

		public function view_admin_transactions_applications($token = ''){ 
			$this->isLoggedIn();

			$get_branch_code =  $this->model->get_branch();
			$get_app_status = $this->model->get_status();

			$data_branch_admin = array(
				'token' => $token,
				'branch_admin_info' => $this->model->getBranchAdminInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),
				'get_position' => $this->model->get_position(),
				'get_branch_code' => $get_branch_code,
				'get_app_status' => $get_app_status,
			);

			$data_admin = array(
				'token' => $token,
				'admin_info' => $this->model->getAdminInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),
				'get_position' => $this->model->get_position(),
				'get_branch_code' => $get_branch_code,
				'get_app_status' => $get_app_status,
			);

			$data_staff = array(
				'token' => $token,
				'staff_info' => $this->model->getStaffInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),
				'get_position' => $this->model->get_position(),
				'get_branch_code' => $get_branch_code,
				'get_app_status' => $get_app_status,
			);

			$data_branch_staff = array(
				'token' => $token,
				'branch_staff_info' => $this->model->getBranchStaffInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),
				'get_position' => $this->model->get_position(),
				'get_branch_code' => $get_branch_code,
				'get_app_status' => $get_app_status,
			);

			if ($this->session->userdata('position_id') == '1') { // admin
				$this->load->view('includes/admin_header', $data_admin);
				$this->load->view('admin/transactions/applications', $data_admin);
			}
			if ($this->session->userdata('position_id') == '3') { // branch admin
				$this->load->view('includes/branch_admin_header', $data_branch_admin);
				$this->load->view('branch_admin/transactions/applications', $data_branch_admin);
			}
			if ($this->session->userdata('position_id') == '4') { // staff
				$this->load->view('includes/staff_header', $data_staff);
				$this->load->view('staff/transactions/applications', $data_staff);
			}
			if ($this->session->userdata('position_id') == '5') { // branch staff
				$this->load->view('includes/branch_staff_header', $data_branch_staff);
				$this->load->view('branch_staff/transactions/applications', $data_branch_staff);
			}
		}

		public function view_admin_transactions_applicants($token = ''){ 
			$this->isLoggedIn();

			$data_branch_admin = array(
				'token' => $token,
				'branch_admin_info' => $this->model->getBranchAdminInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),
				'get_position' => $this->model->get_position()
			);

			$data_admin = array(
				'token' => $token,
				'admin_info' => $this->model->getAdminInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),
				'get_position' => $this->model->get_position()
			);

			$data_staff = array(
				'token' => $token,
				'staff_info' => $this->model->getStaffInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),
				'get_position' => $this->model->get_position()
			);

			$data_branch_staff = array(
				'token' => $token,
				'branch_staff_info' => $this->model->getBranchStaffInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),
				'get_position' => $this->model->get_position()
			);

			if ($this->session->userdata('position_id') == '1') { // admin
				$this->load->view('includes/admin_header', $data_admin);
				$this->load->view('admin/transactions/applicants', $data_admin);
			}
			if ($this->session->userdata('position_id') == '3') { // branch admin
				$this->load->view('includes/branch_admin_header', $data_branch_admin);
				$this->load->view('branch_admin/transactions/applicants', $data_branch_admin);
			}
			if ($this->session->userdata('position_id') == '4') { // staff
				$this->load->view('includes/staff_header', $data_staff);
				$this->load->view('staff/transactions/applicants', $data_staff);
			}
			if ($this->session->userdata('position_id') == '5') { // branch staff
				$this->load->view('includes/branch_staff_header', $data_branch_staff);
				$this->load->view('branch_staff/transactions/applicants', $data_branch_staff);
			}
		}

		public function view_admin_transactions_appointments($token = ''){ 
			$this->isLoggedIn();
			$get_branch_code =  $this->model->get_branch();
			$get_app_status = $this->model->get_status();

			$data_branch_admin = array(
				'token' => $token,
				'branch_admin_info' => $this->model->getBranchAdminInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),
				'get_position' => $this->model->get_position(),
				'get_branch_code' => $get_branch_code,
				'get_app_status' => $get_app_status,
			);

			$data_admin = array(
				'token' => $token,
				'admin_info' => $this->model->getAdminInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),
				'get_position' => $this->model->get_position(),
				'get_branch_code' => $get_branch_code,
				'get_app_status' => $get_app_status,
			);

			$data_staff = array(
				'token' => $token,
				'staff_info' => $this->model->getStaffInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),
				'get_position' => $this->model->get_position(),
				'get_branch_code' => $get_branch_code,
				'get_app_status' => $get_app_status,
			);

			$data_branch_staff = array(
				'token' => $token,
				'branch_staff_info' => $this->model->getBranchStaffInfo($this->session->userdata('email'))->row(),
				'get_country' => $this->model->get_country(),
				'get_position' => $this->model->get_position(),
				'get_branch_code' => $get_branch_code,
				'get_app_status' => $get_app_status,
			);

			if ($this->session->userdata('position_id') == '1') { // admin
				$this->load->view('includes/admin_header', $data_admin);
				$this->load->view('admin/transactions/appointment', $data_admin);
			}
			if ($this->session->userdata('position_id') == '3') { // branch admin
				$this->load->view('includes/branch_admin_header', $data_branch_admin);
				$this->load->view('branch_admin/transactions/appointment', $data_branch_admin);
			}
			if ($this->session->userdata('position_id') == '4') { // staff
				$this->load->view('includes/staff_header', $data_staff);
				$this->load->view('staff/transactions/appointment', $data_staff);
			}
			if ($this->session->userdata('position_id') == '5') { // branch staff
				$this->load->view('includes/branch_staff_header', $data_branch_staff);
				$this->load->view('branch_staff/transactions/appointment', $data_branch_staff);
			}
		}

		public function saveChangePass_user(){
			$email_fk = $this->session->userdata('email');

			$secOldpass = sanitize($this->input->post('secOldpass'));
			$secNewpass = sanitize($this->input->post('secNewpass'));
			$secRetypenewpass = sanitize($this->input->post('secRetypenewpass'));

			$checkPasswordUsingEmailFk = $this->model->checkPasswordUsingEmailFk($email_fk);

			$getOldpass_hash = $checkPasswordUsingEmailFk->row()->password;

			if (password_verify($secOldpass, $getOldpass_hash)){ //verify if password is valid
				//password is valid
				if ($secNewpass == $secRetypenewpass) {

					// for password decryption
					$options = [
						'cost' => 12,
					];

					$secNewpass = password_hash($secNewpass, PASSWORD_BCRYPT, $options);
					//for password decryption

					$query = $this->model->saveChangePass_player($secNewpass, $email_fk);

					$data = array('success' => 1, 'message' => 'Password Updated!');

				}else{
					$data = array('success' => 0, 'message' => 'New Password and Re-type Password is not the same.');
				}

			}else{
				$data = array('success' => 0, 'message' => 'Old Password is not correct.');
			}

			generate_json($data);
		}

		public function reset_password(){

			$emailAddress 	= sanitize($this->input->post('emailAddress'));
			
			$validate_applicant_email = $this->model->validate_applicant_email($emailAddress);

			if ($validate_applicant_email->num_rows() > 0) { // check if email is exist

				$unverified_email = $validate_applicant_email->row()->enabled; // check if unverified email

				if ($unverified_email == 0) {
					$data = array(
						'success' => 0,
						'message' => 'The email you\'ve entered is unverified account. Please Check your email and verified.'
					);
				}else{

					if ($validate_applicant_email->row()->position_id == 1) { //admin
						$getAdminInfo = $this->model->getAdminInfo($emailAddress);

						$fname = $getAdminInfo->row()->admin_first_name;
						$lname = $getAdminInfo->row()->admin_last_name;
					}else if ($validate_applicant_email->row()->position_id == 2) {//player
						$getApplicantInfo = $this->model->getApplicantInfo($emailAddress);
						
						$fname = $getApplicantInfo->row()->first_name;
						$lname = $getApplicantInfo->row()->last_name;
					}

					// this code is for sending email
					$this->load->library('email');

					$receivername = $fname.' '.$lname;
					$verify_href = base_url('Main/resetpassword/'.md5($emailAddress).'/'.sha1($emailAddress));

					$subject = "Reset Password";
					// Get full html:
					$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
					<html xmlns="http://www.w3.org/1999/xhtml">
					<head>
					<meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
					<title>' . html_escape($subject) . '</title>
					<style type="text/css">
					body {
						font-family: Arial, Verdana, Helvetica, sans-serif;
						font-size: 16px;
					}
					</style>
					</head>
					<body>
					<table style="width:538px;background-color:#393836; box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.3);" align="center" cellspacing="0" cellpadding="0">
					<tbody>
					<tr>
					<td style="height:65px; background-color:#2f333e; border-bottom:1px solid #4d4b48;padding:0px; text-align:center; color:white; ">
					<h1 style="font-weight:lighter;">Alien Census Registration System</h1>
					</td>
					</tr>
					<tr>
					<td bgcolor="#eef5f9" style="">

					<table width="470" border="0" align="center" cellpadding="0" cellspacing="0" style="padding-left:5px;padding-right:5px;padding-bottom:10px">

					<tbody><tr bgcolor="white">
					<td style="padding-left:10px; padding-top:32px;padding-bottom:16px">
					<span style="font-size:24px;color:#292b2c;font-family:Arial,Helvetica,sans-serif;font-weight:bold; word-break: break-all;">
					Dear '.$receivername.',
					</span><br>
					</td>
					</tr>

					<tr bgcolor="white">
					<td style="padding:20px;font-size:12px;line-height:17px;color:#292b2c;font-family:Arial,Helvetica,sans-serif">
					<p>In order to reset your account password, please follow this instructions.</p>
					<p><a style="color:#292b2c text-decoration:underline;" href="'.$verify_href.'">Click here to reset your account passsword.</a></p>
					</td>
					</tr>

					<tr>
					<td style="padding-top:16px;font-size:12px;line-height:17px;color:#292b2c;font-family:Arial,Helvetica,sans-serif">
					<p>Resetting your forgotten password in your account will enable you to: access your account and to recover access should you lose or forget your password.</p>
					</td>
					</tr>

					<tr>
					<td style="font-size:12px;color:#292b2c;padding-top:16px;padding-bottom:60px">
					<p>Thanks for helping us maintain the security of your account.
					The Cloud Panda PH Team
					<a style="color:#8f98a0" href="https://cloudpanda.ph/" target="_blank" data-saferedirecturl="https://cloudpanda.ph/">https://cloudpanda.ph</a><br>
					</p></td>
					</tr>

					</tbody></table>
					</td>
					</tr>
					<tr>
					<td bgcolor="white">
					<table width="460" height="55" border="0" align="center" cellpadding="0" cellspacing="0">

					<tbody><tr valign="top">
					<td width="110">
					<a href="https://cloudpanda.ph/">
					<img src="http://cloudpanda.cloudpanda.com.ph/apiv3/release/iphone/10/photo/root_swipe_header_elements_150195765219_image@iphone6plus.jpg?v=1501957847" alt="cloudpanda" width="55" hspace="0" vspace="0" border="0" align="top" class="CToWUd"></a>
					</td>
					<td width="350" >
					<div style="color:#292b2c; font-size:9px;font-family:Verdana,Arial,Helvetica,sans-serif; margin-top:22px; margin-left: 28px;">© Cloud Panda PH Inc. All rights reserved.</div>
					</td>
					</tr>

					</tbody></table>
					</td>
					</tr>
					</tbody>
					</table>
					</body>
					</html>';
					// Also, for getting full html you may use the following internal method:
					//$body = $this->email->full_html($subject, $message);
					
					$result = $this->email
					->from('support@cloudpanda.ph')
					        ->reply_to('')    // Optional, an account where a human being reads.
					        ->to($emailAddress)
					        ->subject($subject)
					        ->message($body)
					        ->send();

					// var_dump($result);
					// echo '<br />';
					// echo $this->email->print_debugger();
					// exit;
					//end of sending email

					        $data = array("success" => 1, 'message' => 'Email Sent! Please check your email for resetting password.');
					    }
					}else{

						$data = array("success" => 0, 'message' => 'The email you\'ve entered doesn\'t match any account. <a href="'.base_url('Main/register').'">Sign up for an account.</a>');
					}

					generate_json($data);
				}

				public function resetpassword($emailmd5 = "", $emailsha1 = ""){

					$checkemailAddressIfExitsmd5 = $this->model->checkemailAddressIfExitsmd5($emailmd5);
					$email = "";

					if ($checkemailAddressIfExitsmd5->num_rows() > 0) {
						$email = $checkemailAddressIfExitsmd5->row()->email;
					}

					$data_user = array(
				 // get data using email
						'emailmd5' => $emailmd5,
						'emailsha1' => $emailsha1,
						'email' => $email
					);

					$this->load->view('resetpassword', $data_user);
				}

				public function resetpasswordUpdate(){
					$resetpassPassword = sanitize($this->input->post('resetpassPassword'));
					$resetpassRepassword = sanitize($this->input->post('resetpassRepassword'));
					$emailAddress = sanitize($this->input->post('email'));

					$checkemailAddressIfExitsmd5 = $this->model->checkemailAddressIfExitsmd5($emailAddress);

					if ($resetpassPassword != $resetpassRepassword) {
						$data = array("success" => 0, "message" => "New Password and Re-type Password is not the same.");
					}

			if ($checkemailAddressIfExitsmd5->num_rows() > 0) { //check if email exist

				// for password decryption
				$options = [
					'cost' => 12,
				];

				$password = password_hash($resetpassPassword, PASSWORD_BCRYPT, $options);
				//for password decryption

				$this->model->resetpasswordUpdate($password, $emailAddress);

				$data = array("success" => 1, "message" => "Successfully Reset you password!");

			}else{
				$data = array("success" => 0, "message" => "Your Email Address is invalid");
			}
			

			generate_json($data);
		}

		public function verifyemailregistration($email = '', $token = ''){ //player information
		// $this->isLoggedIn();

			$token_fix = "CloudPandaPHInc";
			$token_email = en_dec('dec', $token);
			if ($token_email == $token_fix){ //verify if token is valid
				$data_ver = array(
					'token_email' => $token_email,
					'token_fix' => $token_fix
				);
				$this->model->verifyemailregistration($email);
				$this->load->view('verified', $data_ver);
			}
			else{
				$this->session->sess_destroy();
				$this->load->view('login');	
			}
		}


		// public function register_user_orig() { //register a user

		// 	$registerFirstname = sanitize($this->input->post('registerFirstname'));
		// 	$registerMiddlename = sanitize($this->input->post('registerMiddlename'));
		// 	$registerLastname = sanitize($this->input->post('registerLastname'));
		// 	$registerBday = sanitize($this->input->post('registerBday'));
		// 	$registerContactno = sanitize($this->input->post('registerContactno'));
		// 	$registerGender = sanitize($this->input->post('registerGender'));
		// 	$registerCountry = sanitize($this->input->post('registerCountry'));
		// 	$registerEmail = sanitize($this->input->post('registerEmail'));
		// 	$registerPassword = sanitize($this->input->post('registerPassword'));
		// 	$registerRepassword = sanitize($this->input->post('registerRepassword'));

		// 	if ($registerFirstname == "" || 
		// 		$registerLastname == "" || 
		// 		$registerBday == "" || 
		// 		$registerContactno == "" || 
		// 		$registerGender == "" || 
		// 		$registerCountry == "" || 
		// 		$registerEmail == "" || 
		// 		$registerPassword == "" || 
		// 		$registerRepassword  == "") {

		// 		$data = array("success" => 0, 'message' => 'Please fill up all required fields');
		// 	}else{

		// 		$ifEmailExist =  $this->model->checkEmailExist($registerEmail); //check if email is exist

		// 		if ($ifEmailExist->num_rows() > 0) { //if exists

		// 			$data = array("success" => 2, 'message' => 'Failed, email already exist');

		// 		}else{ //if not exist then go.

		// 			if ($registerPassword != $registerRepassword) { // not the same password to repass

		// 				$data = array("success" => 0, 'message' => 'Password and re-type password is not the same');

		// 			}else{ // if same pass to repass

		// 				// for password decryption
		// 				$options = [
		// 			    'cost' => 12,
		// 				];

		// 				$registerPassword = password_hash($registerPassword, PASSWORD_BCRYPT, $options);

		// 				//for password decryption

		// 				$registerBday = date_format(date_create($registerBday),"Y-m-d");

		// 				// pass to the model 
		// 				$query = $this->model->register_user($registerFirstname, $registerMiddlename, $registerLastname, $registerBday, $registerContactno, $registerGender, $registerCountry, $registerEmail, $registerPassword, $registerRepassword);

		// 				// this code is for sending email
		// 				$this->load->library('email');


		// 				$token_email = en_dec('en','CloudPandaPHInc');
		// 				$receivername = $registerFirstname.' '.$registerLastname;
		// 				$verify_href = base_url('Main/verifyemailregistration/'.md5($registerEmail).'/'.$token_email);'';

		// 				$subject = "Email verification";
		// 				// Get full html:
		// 				$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		// 				<html xmlns="http://www.w3.org/1999/xhtml">
		// 				<head>
		// 				    <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
		// 				    <title>' . html_escape($subject) . '</title>
		// 				    <style type="text/css">
		// 				        body {
		// 				            font-family: Arial, Verdana, Helvetica, sans-serif;
		// 				            font-size: 16px;
		// 				        }
		// 				    </style>
		// 				</head>
		// 				<body>
		// 					<table style="width:538px;background-color:#393836; box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.3);" align="center" cellspacing="0" cellpadding="0">
		// 						<tbody>
		// 							<tr>
		// 								<td style="height:65px; background-color:#2f333e; border-bottom:1px solid #4d4b48;padding:0px; text-align:center; color:white; ">
		// 						              <h1 style="font-weight:lighter;">Alien Census Registration System</h1>
		// 						        </td>
		// 							</tr>
		// 							<tr>
		// 								<td bgcolor="#eef5f9" style="">

		// 									<table width="470" border="0" align="center" cellpadding="0" cellspacing="0" style="padding-left:5px;padding-right:5px;padding-bottom:10px">

		// 										<tbody><tr bgcolor="white">
		// 											<td style="padding-left:10px; padding-top:32px;padding-bottom:16px">
		// 											<span style="font-size:24px;color:#292b2c;font-family:Arial,Helvetica,sans-serif;font-weight:bold; word-break: break-all;">
		// 												Dear '.$receivername.',
		// 											</span><br>
		// 											</td>
		// 										</tr>

		// 										<tr bgcolor="white">
		// 						                	<td style="padding:20px;font-size:12px;line-height:17px;color:#292b2c;font-family:Arial,Helvetica,sans-serif">
		// 						  						<p>In order to access your account, please verify your email address.</p>
		// 						  						<p><a style="color:#292b2c text-decoration:underline;" href="'.$verify_href.'">Click here to verify your email address.</a></p>
		// 						    				</td>
		// 						    			</tr>

		// 										<tr>
		// 						                    <td style="padding-top:16px;font-size:12px;line-height:17px;color:#292b2c;font-family:Arial,Helvetica,sans-serif">
		// 						                        <p>Verifying your email address will enable you to: access your account and to recover access should you lose or forget your password.</p>
		// 						                    </td>

		// 						                </tr>

		// 										<tr>
		// 						                	<td style="font-size:12px;color:#292b2c;padding-top:16px;padding-bottom:60px">
		// 						                        <p>Thanks for helping us maintain the security of your account.
		// 						                        The Cloud Panda PH Team
		// 						                        <a style="color:#8f98a0" href="https://cloudpanda.ph/" target="_blank" data-saferedirecturl="https://cloudpanda.ph/">https://cloudpanda.ph</a><br>
		// 						                    </p></td>
		// 						                </tr>

		// 									</tbody></table>
		// 								</td>
		// 							</tr>
		// 							<tr>
		// 								<td bgcolor="white">

		// 										<table width="460" height="55" border="0" align="center" cellpadding="0" cellspacing="0">

		// 											<tbody><tr valign="top">
		// 												<td width="110">
		// 													<a href="https://cloudpanda.ph/">
		// 													<img src="http://cloudpanda.cloudpanda.com.ph/apiv3/release/iphone/10/photo/root_swipe_header_elements_150195765219_image@iphone6plus.jpg?v=1501957847" alt="cloudpanda" width="55" hspace="0" vspace="0" border="0" align="top" class="CToWUd"></a>
		// 												</td>
		// 												<td width="350" >
		// 													<div style="color:#292b2c; font-size:9px;font-family:Verdana,Arial,Helvetica,sans-serif; margin-top:22px; margin-left: 28px;">© Cloud Panda PH Inc. All rights reserved.</div>
		// 												</td>
		// 											</tr>

		// 										</tbody></table>
		// 								</td>
		// 							</tr>
		// 						</tbody>
		// 					</table>
		// 				</body>
		// 				</html>';
		// 				// Also, for getting full html you may use the following internal method:
		// 				//$body = $this->email->full_html($subject, $message);

		// 				$result = $this->email
		// 				        ->from('support@cloudpanda.ph')
		// 				        ->reply_to('')    // Optional, an account where a human being reads.
		// 				        ->to($registerEmail)
		// 				        ->subject($subject)
		// 				        ->message($body)
		// 				        ->send();

		// 				// var_dump($result);
		// 				// echo '<br />';
		// 				// echo $this->email->print_debugger();
		// 				// exit;
		// 				//end of sending email

		// 				$data = array("success" => 1, 'message' => 'Successfully registered, Please check your email for verification.');
		// 			}
		// 		}
		// 	}
		// 	generate_json($data);
		// }	

		public function register_user() { //register a user

			//Personal Info
			$registerIcard = sanitize($this->input->post('registerIcard'));
			$registerFirstname = sanitize($this->input->post('registerFirstname'));
			$registerMiddlename = sanitize($this->input->post('registerMiddlename'));
			$registerLastname = sanitize($this->input->post('registerLastname'));
			$registerExtname = sanitize($this->input->post('registerExtname'));
			$registerAlias1 = sanitize($this->input->post('registerAlias1'));
			$registerAlias2 = sanitize($this->input->post('registerAlias2'));
			$registerBday = sanitize($this->input->post('registerBday'));
			$registerAge = sanitize($this->input->post('registerAge'));
			$registerGender = sanitize($this->input->post('registerGender'));
			$registerCivilstatus = sanitize($this->input->post('registerCivilstatus'));
			$registerCountry = sanitize($this->input->post('registerCountry'));
			$registerCitizenship = sanitize($this->input->post('registerCitizenship'));
			$registerPassport = sanitize($this->input->post('registerPassport'));
			$registerDateofIssuance = sanitize($this->input->post('registerDateofIssuance'));
			$registerExpiryDate = sanitize($this->input->post('registerExpiryDate'));
			$registerIssiuanceplace = sanitize($this->input->post('registerIssiuanceplace'));
			$registerEmail = sanitize($this->input->post('registerEmail'));
			$registerArrivalDate = sanitize($this->input->post('registerArrivalDate'));
			$registerLandline = sanitize($this->input->post('registerLandline'));
			$registerMobile = sanitize($this->input->post('registerMobile'));
			$registerLandline = sanitize($this->input->post('registerLandline'));
			$registerMobile = sanitize($this->input->post('registerMobile'));



			//Addrss Local
			$registerStreet = sanitize($this->input->post('registerStreet'));
			$registerVillage = sanitize($this->input->post('registerVillage'));
			$registerBarangay = sanitize($this->input->post('registerBarangay'));
			$registerCity = sanitize($this->input->post('registerCity'));
			$registerProvince = sanitize($this->input->post('registerProvince'));
			$registerZipcode = sanitize($this->input->post('registerZipcode'));
			
			//Address Abroad
			$registerStreet2 = sanitize($this->input->post('registerStreet2'));
			$registerVillage2 = sanitize($this->input->post('registerVillage2'));
			$registerCity2 = sanitize($this->input->post('registerCity2'));
			$registerState = sanitize($this->input->post('registerState'));
			$registerCountry2 = sanitize($this->input->post('registerCountry2'));
			$registerZipcode2 = sanitize($this->input->post('registerZipcode2'));

			//Login Credentials
			$registerEmail2 = sanitize($this->input->post('registerEmail2'));
			$registerPassword = sanitize($this->input->post('registerPassword'));
			$registerRepassword = sanitize($this->input->post('registerRepassword'));

			if ($registerFirstname == "" || 
				$registerLastname == "" || 
				$registerBday == "" || 
				$registerGender == "" ||
				$registerAge == "" || 
				$registerCountry == "" || 
				$registerEmail2 == "" || 
				$registerPassword == "" || 
				$registerCitizenship == "" || 
				$registerRepassword  == "") {
				
				$data = array("success" => 0, 'message' => 'Please fill up all required fields');
		}else{

				$ifEmailExist =  $this->model->checkEmailExist($registerEmail2); //check if email is exist

				if ($ifEmailExist->num_rows() > 0) { //if exists

					$data = array("success" => 2, 'message' => 'Failed, email already exist');

				}else{ //if not exist then go.

					if ($registerPassword != $registerRepassword) { // not the same password to repass

						$data = array("success" => 0, 'message' => 'Password and re-type password is not the same');

					}else{ // if same pass to repass

						// for password decryption
						$options = [
							'cost' => 12,
						];

						$registerPassword = password_hash($registerPassword, PASSWORD_BCRYPT, $options);

						//for password decryption
						$registerBday = date_format(date_create($registerBday),"Y-m-d");
                        if($registerDateofIssuance != "" ){
    						$registerDateofIssuance = date_format(date_create($registerDateofIssuance),"Y-m-d");
                        }else{
                        	$registerDateofIssuance = null;
                        }

                        if($registerExpiryDate != "" ){
                            $registerExpiryDate = date_format(date_create($registerExpiryDate),"Y-m-d");
                        }else{
                        	 $registerExpiryDate = null;
                        }
                        if($registerArrivalDate != ""){
                            $registerArrivalDate = date_format(date_create($registerArrivalDate),"Y-m-d");
                        }else{
                        	$registerArrivalDate = null;
                        }
                        
						
						// pass to the model 
						$query = $this->model->register_user($registerIcard,$registerFirstname,$registerMiddlename,$registerLastname,$registerExtname,$registerAlias1,$registerAlias2,$registerBday,$registerAge,$registerGender,$registerCivilstatus,$registerCountry,$registerCitizenship,$registerPassport,$registerDateofIssuance,$registerExpiryDate,$registerIssiuanceplace,$registerEmail,$registerArrivalDate,$registerLandline,$registerMobile,$registerEmail2,$registerPassword,$registerRepassword,$registerStreet,$registerVillage,$registerBarangay,$registerCity,$registerProvince,$registerZipcode,$registerStreet2,$registerVillage2,$registerCity2,$registerState,$registerCountry2,$registerZipcode2);

						// this code is for sending email
						$this->load->library('email');


						$token_email = en_dec('en','CloudPandaPHInc');
						$receivername = $registerFirstname.' '.$registerLastname;
						$verify_href = base_url('Main/verifyemailregistration/'.md5($registerEmail).'/'.$token_email);'';

						$subject = "Email verification";
						// Get full html:
						$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
						<html xmlns="http://www.w3.org/1999/xhtml">
						<head>
						<meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
						<title>' . html_escape($subject) . '</title>
						<style type="text/css">
						body {
							font-family: Arial, Verdana, Helvetica, sans-serif;
							font-size: 16px;
						}
						</style>
						</head>
						<body>
						<table style="width:538px;background-color:#393836; box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.3);" align="center" cellspacing="0" cellpadding="0">
						<tbody>
						<tr>
						<td style="height:65px; background-color:#2f333e; border-bottom:1px solid #4d4b48;padding:0px; text-align:center; color:white; ">
						<h1 style="font-weight:lighter;">Alien Census Registration System</h1>
						</td>
						</tr>
						<tr>
						<td bgcolor="#eef5f9" style="">

						<table width="470" border="0" align="center" cellpadding="0" cellspacing="0" style="padding-left:5px;padding-right:5px;padding-bottom:10px">

						<tbody><tr bgcolor="white">
						<td style="padding-left:10px; padding-top:32px;padding-bottom:16px">
						<span style="font-size:24px;color:#292b2c;font-family:Arial,Helvetica,sans-serif;font-weight:bold; word-break: break-all;">
						Dear '.$receivername.',
						</span><br>
						</td>
						</tr>

						<tr bgcolor="white">
						<td style="padding:20px;font-size:12px;line-height:17px;color:#292b2c;font-family:Arial,Helvetica,sans-serif">
						<p>In order to access your account, please verify your email address.</p>
						<p><a style="color:#292b2c text-decoration:underline;" href="'.$verify_href.'">Click here to verify your email address.</a></p>
						</td>
						</tr>

						<tr>
						<td style="padding-top:16px;font-size:12px;line-height:17px;color:#292b2c;font-family:Arial,Helvetica,sans-serif">
						<p>Verifying your email address will enable you to: access your account and to recover access should you lose or forget your password.</p>
						</td>

						</tr>

						<tr>
						<td style="font-size:12px;color:#292b2c;padding-top:16px;padding-bottom:60px">
						<p>Thanks for helping us maintain the security of your account.
						The Cloud Panda PH Team
						<a style="color:#8f98a0" href="https://cloudpanda.ph/" target="_blank" data-saferedirecturl="https://cloudpanda.ph/">https://cloudpanda.ph</a><br>
						</p></td>
						</tr>

						</tbody></table>
						</td>
						</tr>
						<tr>
						<td bgcolor="white">

						<table width="460" height="55" border="0" align="center" cellpadding="0" cellspacing="0">

						<tbody><tr valign="top">
						<td width="110">
						<a href="https://cloudpanda.ph/">
						<img src="http://cloudpanda.cloudpanda.com.ph/apiv3/release/iphone/10/photo/root_swipe_header_elements_150195765219_image@iphone6plus.jpg?v=1501957847" alt="cloudpanda" width="55" hspace="0" vspace="0" border="0" align="top" class="CToWUd"></a>
						</td>
						<td width="350" >
						<div style="color:#292b2c; font-size:9px;font-family:Verdana,Arial,Helvetica,sans-serif; margin-top:22px; margin-left: 28px;">© Cloud Panda PH Inc. All rights reserved.</div>
						</td>
						</tr>

						</tbody></table>
						</td>
						</tr>
						</tbody>
						</table>
						</body>
						</html>';
						// Also, for getting full html you may use the following internal method:
						//$body = $this->email->full_html($subject, $message);
						
						$result = $this->email
						->from('support@cloudpanda.ph')
						        ->reply_to('')    // Optional, an account where a human being reads.
						        ->to($registerEmail)
						        ->subject($subject)
						        ->message($body)
						        ->send();
						//end of sending email

						        $data = array("success" => 1, 'message' => 'Successfully registered, Please check your email for verification.');
						    }
						}
					}
					generate_json($data);
				}

	public function pdf_acrs_application($reference_no = "") {

	 	$row = $this->model->getApplicationInfoUsingRefNo($reference_no)->row(); //Application Info
	 	$row2 = $this->model->getApplicantInfo($row->applicant_email)->row();
	 	$this->load->library('fpdf_gen');
	 	$this->fpdf->SetLineWidth(0.2);
	 	$this->fpdf->SetLeftMargin(13);
	 	$this->fpdf->SetRightMargin(13);

		// logo
	 	$pic = base_url() ."assets/img/immigration_logo.png";
	 	$this->fpdf->Image($pic,10,10,30,30,'png');

		//Qrcode
	 	$pic = $row->qr_code;
	 	$this->fpdf->Image($pic,160,10,40,40,'png');

		$this->fpdf->Cell(10,5,"",0,1,'C');// space

		$this->fpdf->SetFont('Arial','B',12);
		$this->fpdf->Cell(28,5,"",0,0,'C');// margin
		$this->fpdf->Cell(89,8,"BUREAU OF IMMIGRATION",0,1,'L');
		$this->fpdf->Cell(28,5,"",0,0,'C');// margin
		$this->fpdf->SetFont('Arial','B',11);//font
		$this->fpdf->Cell(189,7,"Alien Census Registration System",0,1,'L');
		
		$this->fpdf->Cell(10,20,"",0,1,'C');// space

		$this->fpdf->SetFont('Arial','',10); //font
		$this->fpdf->Cell(189,4,"",0,1,'L'); //space

		$this->fpdf->Cell(31.5,6,"Reference No:",0,0,'L');
		$this->fpdf->Cell(31.5,6,$row->reference_no,0,1,'L');
		$this->fpdf->Cell(31.5,6,"E-Receipt No:",0,0,'L');
		$this->fpdf->Cell(31.5,6,$row->OR_NO,0,1,'L');

		$this->fpdf->Cell(189,8,"",0,1,'L'); //space
		$this->fpdf->Cell(37.8,6,"Application Date:",0,0,'L');
		$this->fpdf->Cell(37.8,6,date_format(date_create($row->application_date),"m/d/Y"),0,0,'L');
		$this->fpdf->Cell(25,6,"",0,0,'L');
		$this->fpdf->Cell(30.8,6,"Branch Name:",0,0,'L');
		$this->fpdf->Cell(44.8,6,$row->branch_name,0,1,'L');


		$this->fpdf->Cell(37.8,6,"Process Lane:",0,0,'L');
		$this->fpdf->Cell(37.8,6,$row->process,0,0,'L');
		$this->fpdf->Cell(25,6,"",0,0,'L');
		$this->fpdf->Cell(37.8,6,"Appointment Date:",0,0,'L');
		$this->fpdf->Cell(37.8,6,date_format(date_create($row->appointment_date),"m/d/Y"),0,1,'L');

		$this->fpdf->Cell(37.8,6,"Application Category:",0,0,'L');
		$this->fpdf->Cell(37.8,6,$row->description,0,0,'L');
		$this->fpdf->Cell(25,6,"",0,0,'L');
		$this->fpdf->Cell(37.8,6,"Time:",0,0,'L');
		$this->fpdf->Cell(37.8,6,$row->timesched_description,0,1,'L');

		$this->fpdf->Cell(10,10,"",0,1,'C');// space
		$this->fpdf->Cell(37.8,6,"Applicant Name",0,0,'L');
		$this->fpdf->Cell(50,6,$row->first_name." ".$row->middle_name." ".$row->last_name." ".$row->ext_name,0,1,'L');
		$this->fpdf->Cell(37.8,6,"ACR I-Card No:",0,0,'L');
		$this->fpdf->Cell(50,6,$row->icard_no,0,1,'L');

		$this->fpdf->Cell(10,5,"",0,1,'C');// space
		$this->fpdf->Cell(37.8,6,"Alias 1:",0,0,'L');
		$this->fpdf->Cell(37.8,6,$row->alias1,0,0,'L');
		$this->fpdf->Cell(25,6,"",0,0,'L');
		$this->fpdf->Cell(37.8,6,"Alias 2:",0,0,'L');
		$this->fpdf->Cell(37.8,6,$row->alias2,0,1,'L');

		$this->fpdf->Cell(37.8,6,"Birthdate:",0,0,'L');
		$this->fpdf->Cell(37.8,6,date_format(date_create($row->birthdate),"m/d/Y"),0,0,'L');
		$this->fpdf->Cell(25,6,"",0,0,'L');
		$this->fpdf->Cell(37.8,6,"Age:",0,0,'L');
		$this->fpdf->Cell(37.8,6,$row->age,0,1,'L');

		$gender = "";
		$row->gender_id ==1? $gender="Male" : $gender ="Female";

		$this->fpdf->Cell(37.8,6,"Gender:",0,0,'L');
		$this->fpdf->Cell(37.8,6,$gender,0,0,'L');
		$this->fpdf->Cell(25,6,"",0,0,'L');
		$this->fpdf->Cell(37.8,6,"Civil Status:",0,0,'L');
		$this->fpdf->Cell(37.8,6,$row->name,0,1,'L');

		$this->fpdf->Cell(37.8,6,"Country of Birth:",0,0,'L');
		$this->fpdf->Cell(37.8,6,$row2->country,0,0,'L');
		$this->fpdf->Cell(25,6,"",0,0,'L');
		$this->fpdf->Cell(37.8,6,"Nationality:",0,0,'L');
		$this->fpdf->Cell(37.8,6,$row->nationality,0,1,'L');

        $this->fpdf->Cell(10,5,"",0,1,'C');// space
        $this->fpdf->Cell(37.8,6,"Passport No:",0,0,'L');
        $this->fpdf->Cell(50,6,$row->passport_num,0,1,'L');

        $this->fpdf->Cell(37.8,6,"Place of Issuance:",0,0,'L');
        $this->fpdf->Cell(37.8,6,$row->place_of_isssuance,0,0,'L');
        $this->fpdf->Cell(25,6,"",0,0,'L');
        $this->fpdf->Cell(37.8,6,"Date of Issuance:",0,0,'L');
        $this->fpdf->Cell(37.8,6,date_format(date_create($row->issuance_date),"m/d/Y"),0,1,'L');		

        $this->fpdf->Cell(37.8,6,"Expiry Date:",0,0,'L');
        $this->fpdf->Cell(37.8,6,date_format(date_create($row->expiry_date),"m/d/Y"),0,0,'L');
        $this->fpdf->Cell(25,6,"",0,0,'L');
        $this->fpdf->Cell(37.8,6,"Date of Latest Arrival:",0,0,'L');
        $this->fpdf->Cell(37.8,6,date_format(date_create($row->latest_arrival_date),"m/d/Y"),0,1,'L');

        $this->fpdf->Cell(10,5,"",0,1,'C');// space
        $this->fpdf->Cell(37.8,6,"Mobile:",0,0,'L');
        $this->fpdf->Cell(37.8,6,$row->mobile_num,0,0,'L');
        $this->fpdf->Cell(25,6,"",0,0,'L');
        $this->fpdf->Cell(37.8,6,"Landline:",0,0,'L');
        $this->fpdf->Cell(37.8,6,$row->landline,0,1,'L');

        $this->fpdf->Cell(10,6,"",0,1,'C');// space
        $this->fpdf->Cell(189,6,"Residential Address in the Philippines:        ".$row->ph_village.", ".$row->ph_barangay.", ".$row->ph_city.", ".$row->ph_province." ".$row->ph_zipcode,0,1,'L');
        $this->fpdf->Cell(10,3,"",0,1,'C');// space
        $this->fpdf->Cell(189,6,"Residential Address Abroad:                       ".$row->ab_village.", ".$row->ab_city.", ".$row->ab_state.", ".$row->country." ".$row->ab_zipcode,0,1,'L');

        $this->fpdf->Cell(189,10,"",0,1,'C');// space
        $this->fpdf->SetDash(1,1); //SetDash
        $this->fpdf->Cell(189,5,"","B",1,'C');// space 

        $this->fpdf->SetDash(.5,1); //.5mm on, 1mm off
        $this->fpdf->Rect(15,220,80,110);

         $this->fpdf->Cell(10,5,"",0,1,'C');// space

        //Receipt

         // logo
	 	$pic = base_url() ."assets/img/immigration_logo.png";
	 	$this->fpdf->Image($pic,45,225,20,20,'png');
	 	
	 	$this->fpdf->SetFont('Arial','',9); //font
	 	$this->fpdf->Cell(50,28,"",0,1,'C');// space

	 	$this->fpdf->Cell(85,6,"BUREAU OF IMMIGRATION",0,1,'C');
	 
	 	$this->fpdf->SetFont('Arial','',8); //font
	 	$this->fpdf->Cell(85,5,"Alien Census Registration System",0,1,'C');
	 	$this->fpdf->Cell(85,5,"TIN: 999-994-949",0,1,'C');

	 	$this->fpdf->Cell(50,5,"",0,1,'C');// space
	 	$this->fpdf->SetFont('Arial','',9); //font
	 	$this->fpdf->Cell(85,5,"E-RECEIPT",0,1,'C');

	 	$this->fpdf->Cell(50,3,"",0,1,'C');// space
	 	$this->fpdf->SetFont('Arial','',8); //font

	 	$this->fpdf->Cell(4,5,"",0,0,'C');// margin
	 	$this->fpdf->Cell(34,5,"E-RECEIPT",0,0,'L');
	 	$this->fpdf->Cell(43,5,$row->OR_NO,0,1,'R');	 	

	 	$this->fpdf->Cell(4,5,"",0,0,'C');// margin
	 	$this->fpdf->Cell(34,5,"ISSUED DATE:",0,0,'L');
	 	$this->fpdf->Cell(43,5,date_format(date_create($row->application_date),"m/d/Y"),0,1,'R');

	 	$this->fpdf->Cell(43,2,"",0,1,'C');// space	 
	 	$this->fpdf->Cell(4,5,"",0,0,'C');// margin
	 	$this->fpdf->Cell(30,5,"PAYOR:",0,0,'L');
	 	$this->fpdf->Cell(47,5,$row->first_name." ".$row->middle_name." ".$row->last_name." ".$row->ext_name,0,1,'R');
	 	$this->fpdf->Cell(4,5,"",0,0,'C');// margin
	 	$this->fpdf->Cell(30,5,"",0,0,'C');
	 	$this->fpdf->Cell(47,5,$row2->country,0,1,'R');


	 	$this->fpdf->Cell(43,2,"",0,1,'C');// space	 	
	 	$this->fpdf->Cell(4,5,"",0,0,'C');// margin
	 	$this->fpdf->Cell(34,5,"ASSESSMENT",0,0,'L');
	 	$this->fpdf->Cell(43,5,"AMOUNT",0,1,'R');	

	 	//Peso Sign
	 	$a = '&#x20B1';
		$b = iconv('UTF-8', 'windows-1252', $a);
		$c = "PHP";

	 	$this->fpdf->Cell(4,5,"",0,0,'C');// margin
	 	$this->fpdf->Cell(34,5,"APPLICATION FEE:",0,0,'L');
	 	$this->fpdf->Cell(43,5,$c.' '.number_format($row->total_amount_receipt,2),"B",1,'R');	 	 	

	 	$this->fpdf->Cell(43,2,"",0,1,'C');// space	 
	 	$this->fpdf->Cell(4,5,"",0,0,'C');// margin
	 	$this->fpdf->Cell(34,5,"AMOUNT DUE:",0,0,'L');
	 	$this->fpdf->Cell(43,5,$c.' '.number_format($row->total_amount_receipt,2),0,1,'R');	 

	 	$this->fpdf->Cell(43,2,"",0,1,'C');// space	 
	 	$this->fpdf->Cell(4,5,"",0,0,'C');// margin
	 	$this->fpdf->Cell(34,5,"REFERENCE#:",0,0,'L');
	 	$this->fpdf->Cell(43,5,$row->reference_no,0,1,'R');	 



        echo $this->fpdf->Output('acrs_application.pdf','D');

    }	
}







 