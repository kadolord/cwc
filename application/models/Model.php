<?php 

	class model extends CI_Model{

		//for background images
		public function getBgImages(){
			$sql = "SELECT * from imm_bg";
			return $this->db->query($sql);
		}

		//For transaction
		public function get_app_type(){
			$sql = "SELECT * FROM imm_application_type WHERE enabled = 1 ORDER BY application_id ASC";
			return $this->db->query($sql);
		}

		public function get_app_requirement(){
			$sql = "SELECT * FROM imm_application_requirements_type WHERE enabled = 1 ORDER BY requirement_id ASC";
			return $this->db->query($sql);
		}

		public function get_app_requirement2(){
			$sql = "SELECT * FROM imm_application_requirements_type ORDER BY requirement_id ASC";
			return $this->db->query($sql);
		}


		public function get_uploaded_docs($app_email){
			$sql = "SELECT * FROM imm_uploaded_docs upd 
					LEFT JOIN  imm_application_requirements_type apt ON upd.document_type_id = apt.requirement_id 
					WHERE upd.applicant_email = ? AND upd.enabled = 1 ORDER BY upd.document_type_id ASC";
			$data = array($app_email);
			return $this->db->query($sql,$data);
		}		

		public function get_oldest_uploaded_docs($app_email, $document_id){
			$sql = "SELECT * FROM imm_uploaded_docs  
					WHERE applicant_email = ? AND enabled = 1 AND document_type_id = ? ORDER BY date_updated ASC LIMIT 1";
			$data = array($app_email, $document_id);
			return $this->db->query($sql,$data);
		}

		public function get_app_id($app_type){
			$sql = "SELECT * FROM imm_application_type WHERE description = ? AND enabled = 1";
			$data = array($app_type);
			return $this->db->query($sql,$data);
		}

		public function get_holiday(){
			$sql = "SELECT holiday_date FROM imm_holiday WHERE enabled = 1";
			return $this->db->query($sql);
		}

		public function get_announcement(){
			$sql = "SELECT * FROM imm_announcements ann 
					LEFT JOIN imm_users us ON ann.posted_by = us.user_id
					LEFT JOIN imm_admin ad ON us.user_email = ad.admin_email
					LEFT JOIN imm_branch_admin bad ON us.user_email = bad.branch_admin_email
					WHERE ann.enabled = 1 AND ann.display_until >= CURRENT_DATE()
					ORDER BY ann.posted_on DESC";
			return $this->db->query($sql);
		}

		public function insertApplicationLog($applicant_email, $reference_no,$app_id,$app_branch_id,$app_date,$app_time,$total_fee_receipt, $total_fee,$bid_or_no,$qrcode,$process_lane,$payment_mode,$app_fee,$con_fee){
			
			$sql = "INSERT INTO imm_application_log (applicant_email, reference_no, application_type_id, app_branch_id , appointment_date, app_branch_time, total_amount_receipt,total_amount, OR_NO, qr_code,`process_lane`,`payment_mode`,`application_fee`,`convenience_fee`, application_date, date_created, date_updated) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$data = array($applicant_email, $reference_no,$app_id,$app_branch_id,$app_date,$app_time,$total_fee_receipt, $total_fee,$bid_or_no,$qrcode,$process_lane,$payment_mode,$app_fee,$con_fee, today(),todaytime(), todaytime());
			$this->db->query($sql, $data);

			//Update status of OR#s
			if($this->db->affected_rows() > 0){

				$sql2 ="UPDATE `imm_official_receipt` SET `reference_no`= ?,`isAvailable`= ?, `date_updated` =? WHERE or_no = ?";
				$data2 = array($reference_no,0,todaytime(),$bid_or_no);
				$this->db->query($sql2, $data2);
			}

		}

		public function get_country(){
			$sql = "SELECT * FROM imm_country WHERE enabled = 1 ORDER BY country ASC";
			return $this->db->query($sql);
		}

		public function get_civil_status(){
			$sql = "SELECT * FROM imm_civil_status WHERE enabled = 1";
			return $this->db->query($sql);
		}

		public function get_branch(){
			$sql = "SELECT * FROM imm_branch WHERE enabled = 1 ORDER BY branch_id ASC";
			return $this->db->query($sql);
		}

		public function get_status(){
			$sql = "SELECT * FROM imm_appointment_status WHERE enabled = 1 ORDER BY status_id ASC";
			return $this->db->query($sql);
		}
 
		public function checkEmailExist_applicant_except($info_emailaddress, $email_fk){
			$sql = "SELECT * FROM imm_applicant
					WHERE email = ? AND email != ? ";
					// AND enabled = 1
			$data = array($info_emailaddress, $email_fk);
			return $this->db->query($sql, $data);
		}
	
		public function checkEmailExist($registerEmail){
				$sql = "SELECT * FROM imm_users
						WHERE user_email = ?";
						// AND enabled = 1
				$data = array($registerEmail);
				return $this->db->query($sql, $data);
			}

		public function checkBCodeExist($bcode){
			$sql = "SELECT * FROM imm_branch
					WHERE branch_code = ?
					AND enabled = 1";
			$data = array($bcode);
			return $this->db->query($sql, $data);
		}

		public function checkIfRescheduleFeeAlreadySet(){
			$sql = "SELECT * FROM imm_reschedule_fee WHERE  enabled = 1";
			return $this->db->query($sql);
		}

		public function checkIfHolidayExist($hol_desc){
			$sql = "SELECT * FROM imm_holiday
					WHERE holiday_description = ?
					AND enabled = 1";
			$data = array($hol_desc);
			return $this->db->query($sql, $data);
		}

		public function checkIfCountryExist($country_name){
			$sql = "SELECT * FROM imm_country
					WHERE country = ?
					AND enabled = 1";
			$data = array($country_name);
			return $this->db->query($sql, $data);
		}

		public function checkIfHolidayExistExcept($hol_desc_tbe, $old_hol_desc){
			$sql = "SELECT * FROM imm_holiday
					WHERE holiday_description = ?
					AND holiday_description != ?";
			$data = array($hol_desc_tbe, $old_hol_desc);
			return $this->db->query($sql, $data);
		}

		public function checkIfCountryExistExcept($tbe_country_name, $old_country_name){
				$sql = "SELECT * FROM imm_country
						WHERE country = ?
						AND country != ?";
				$data = array($tbe_country_name, $old_country_name);
				return $this->db->query($sql, $data);
		}

		public function getReschedFee(){
			$sql = "SELECT * FROM imm_reschedule_fee where enabled = 1";
			return $this->db->query($sql);
		}

		public function getScheduleDetails($reference_no){
			$sql = "SELECT * FROM imm_appointment_log WHERE app_reference_no = ? AND enabled = 1";
			$data = array($reference_no);
			return $this->db->query($sql, $data);
		}

		public function checkApplicationExist($app_name){
				$sql = "SELECT * FROM imm_application_type
						WHERE description = ?
						AND enabled = 1";
				$data = array($app_name);
				return $this->db->query($sql, $data);
		}

		public function checkRequirementExist($req_name){
				$sql = "SELECT * FROM imm_application_requirements_type
						WHERE requirement_description = ?
						AND enabled = 1";
				$data = array($req_name);
				return $this->db->query($sql, $data);
		}

		public function checkBNameExist($bname){
				$sql = "SELECT * FROM imm_branch
						WHERE branch_name = ?
						AND enabled = 1";
				$data = array($bname);
				return $this->db->query($sql, $data);
		}

		public function checkEmailExist_usingPlayerID($info_emailaddress, $info_user_id){
			$sql = "SELECT * FROM imm_users
					WHERE user_email = ? AND user_id != ?";
					// AND enabled = 1
			$data = array($info_emailaddress, $info_user_id);
			return $this->db->query($sql, $data);
		}

		public function checkEmailExist_users_except($info_emailaddress, $email_fk){
			$sql = "SELECT * FROM imm_users
					WHERE user_email = ? AND email != ? ";
					// AND enabled = 1
			$data = array($info_emailaddress, $email_fk);
			return $this->db->query($sql, $data);
		}

		public function checkIfApplicantNoExist(){
			$applicant_no = generate_player_no();
			$applicant_no = en_dec('en',$applicant_no);
			$sql="SELECT * FROM imm_applicant WHERE applicant_no = ?";
			$data = array($applicant_no);
			$query = $this->db->query($sql, $data);

			if ($query->num_rows() > 0) {
				$applicant_no = $this->checkIfApplicantNoExist();
			}
			return $applicant_no;
		}

		// public function edit_accounts($info_user_id, $info_fname, $info_mname, $info_lname, $info_bdate, $info_contact_number, $info_country, $info_emailaddress, $info_gender){

		// 	$sql = "SELECT position_id, user_email FROM imm_users WHERE user_id = ?";
		// 	$data = array($info_user_id);
		// 	$query = $this->db->query($sql, $data);

		// 	$whereEmail = $query->row()->user_email;
		// 	if ($query->row()->position_id == 1) { // admin
		// 		$sql = "UPDATE `imm_admin` SET `admin_first_name`= ?,`admin_middle_name`= ?,`admin_last_name`= ?,`admin_country_id`= ?,`admin_email`= ?,`admin_contact_num`= ?,`admin_birthdate`= ?, `admin_gender_id`= ?,
		// 			`date_updated`= ? WHERE admin_email = ?";

		// 	}else if($query->row()->position_id == 2){ //applicant
		// 		$sql = "UPDATE `imm_applicants` SET `first_name`= ?,`middle_name`= ?,`last_name`= ?,`country_id`= ?,`email`= ?,`contact_num`= ?,`birthdate`= ?,`gender_id`= ?,
		// 			`date_updated`= ? WHERE email = ?";

		// 	}else if($query->row()->position_id == 3){ //branch admin
		// 		$sql = "UPDATE `imm_branch_admin` SET `branch_admin_first_name`= ?,`branch_admin_middle_name`= ?,`branch_admin_last_name`= ?,`branch_admin_country_id`= ?,`branch_admin_email`= ?,`branch_admin_contact_num`= ?,`branch_admin_birthdate`= ?,`branch_admin_gender_id`= ?, `date_updated`= ? WHERE branch_admin_email = ?";

		// 	}else if($query->row()->position_id == 4){ //staff
		// 		$sql = "UPDATE `imm_staff` SET `staff_first_name`= ?,`staff_middle_name`= ?,`staff_last_name`= ?,`staff_country_id`= ?,`staff_email`= ?,`staff_contact_num`= ?,`staff_birthdate`= ?,`staff_gender_id`= ?,
		// 			`date_updated`= ? WHERE staff_email = ?";
		// 	}else if($query->row()->position_id == 5){ //branch staff
		// 		$sql = "UPDATE `imm_branch_staff` SET `branch_staff_first_name`= ?,`branch_staff_middle_name`= ?,`branch_staff_last_name`= ?,`branch_staff_country_id`= ?,`branch_staff_email`= ?,`branch_staff_contact_num`= ?,`branch_staff_birthdate`= ?, `branch_staff_gender_id`= ?, `date_updated`= ? WHERE branch_staff_email = ?";
		// 	}
			

		// 	$data = array($info_fname, $info_mname, $info_lname, $info_country, $info_emailaddress, $info_contact_number, $info_bdate, $info_gender, todaytime(), $whereEmail);

		// 	$query = $this->db->query($sql, $data);

		// 	$sql = "UPDATE imm_users SET user_email = ? WHERE user_id = ?";
		// 	$data = array($info_emailaddress, $info_user_id);
		// 	$query = $this->db->query($sql, $data);
		// }

		// public function edit_accounts_branch($info_user_id, $info_fname, $info_mname, $info_lname, $info_bdate, $info_contact_number, $info_country, $info_emailaddress, $info_gender, $info_assigned_branch){

		// 	$sql = "SELECT position_id,user_email FROM imm_users WHERE user_id = ?";
		// 	$data = array($info_user_id);
		// 	$query = $this->db->query($sql, $data);


		// 	$whereEmail = $query->row()->user_email;
			
		// 	if($query->row()->position_id == 3){ //branch admin
		// 		$sql = "UPDATE `imm_branch_admin` SET `branch_admin_first_name`= ?,`branch_admin_middle_name`= ?,`branch_admin_last_name`= ?,`branch_admin_country_id`= ?,`branch_admin_email`= ?,`branch_admin_contact_num`= ?,`branch_admin_birthdate`= ?,`branch_admin_gender_id`= ?, `branch_admin_assigned_branch_id` = ?,
		// 			`date_updated`= ? WHERE branch_admin_email = ?";

		// 	}else if ($query->row()->position_id == 5) { // branch staff
		// 		$sql = "UPDATE `imm_branch_staff` SET `branch_staff_first_name`= ?,`branch_staff_middle_name`= ?,`branch_staff_last_name`= ?,`branch_staff_country_id`= ?,`branch_staff_email`= ?,`branch_staff_contact_num`= ?,`branch_staff_birthdate`= ?, `branch_staff_gender_id`= ?, `assigned_branch_id` = ?,
		// 			`date_updated`= ? WHERE branch_staff_email = ?";
		// 	}
		// 	$data = array($info_fname, $info_mname, $info_lname, $info_country, $info_emailaddress, $info_contact_number, $info_bdate, $info_gender,$info_assigned_branch, todaytime(), $whereEmail);

		// 	$query = $this->db->query($sql, $data);

		// 	$sql = "UPDATE imm_users SET user_email = ? WHERE user_id = ?";
		// 	$data = array($info_emailaddress, $info_user_id);
		// 	$query = $this->db->query($sql, $data);
		// }

		public function edit_accounts($info_user_id, $info_fname, $info_mname, $info_lname, $info_contact_number){

			$sql = "SELECT position_id, user_email FROM imm_users WHERE user_id = ?";
			$data = array($info_user_id);
			$query = $this->db->query($sql, $data);

			$whereEmail = $query->row()->user_email;
			if ($query->row()->position_id == 1) { // admin
				$sql = "UPDATE `imm_admin` SET `admin_first_name`= ?,`admin_middle_name`= ?,`admin_last_name`= ?,`admin_contact_num`= ?,`date_updated`= ? WHERE admin_email = ?";

			}else if($query->row()->position_id == 3){ //branch admin
				$sql = "UPDATE `imm_branch_admin` SET `branch_admin_first_name`= ?,`branch_admin_middle_name`= ?,`branch_admin_last_name`= ?,`branch_admin_contact_num`= ?,`date_updated`= ? WHERE branch_admin_email = ?";

			}else if($query->row()->position_id == 4){ //staff
				$sql = "UPDATE `imm_staff` SET `staff_first_name`= ?,`staff_middle_name`= ?,`staff_last_name`= ?,`staff_contact_num`= ?,	`date_updated`= ? WHERE staff_email = ?";

			}else if($query->row()->position_id == 5){ //branch staff
				$sql = "UPDATE `imm_branch_staff` SET `branch_staff_first_name`= ?,`branch_staff_middle_name`= ?,`branch_staff_last_name`= ?,`branch_staff_contact_num`= ?, `date_updated`= ? WHERE branch_staff_email = ?";
			}
			

			$data = array($info_fname, $info_mname, $info_lname, $info_contact_number, todaytime(), $whereEmail);

			$query = $this->db->query($sql, $data);

			// $sql = "UPDATE imm_users SET user_email = ? WHERE user_id = ?";
			// $data = array($info_emailaddress, $info_user_id);
			// $query = $this->db->query($sql, $data);
		}		

		public function edit_accounts_branch($info_user_id, $info_fname, $info_mname, $info_lname, $info_contact_number, $info_assigned_branch){

			$sql = "SELECT position_id,user_email FROM imm_users WHERE user_id = ?";
			$data = array($info_user_id);
			$query = $this->db->query($sql, $data);


			$whereEmail = $query->row()->user_email;
			
			if($query->row()->position_id == 3){ //branch admin
				$sql = "UPDATE `imm_branch_admin` SET `branch_admin_first_name`= ?,`branch_admin_middle_name`= ?,`branch_admin_last_name`= ?,`branch_admin_contact_num`= ?,`branch_admin_assigned_branch_id` = ?,
					`date_updated`= ? WHERE branch_admin_email = ?";

			}else if ($query->row()->position_id == 5) { // branch staff
				$sql = "UPDATE `imm_branch_staff` SET `branch_staff_first_name`= ?,`branch_staff_middle_name`= ?,`branch_staff_last_name`= ?,`branch_staff_contact_num`= ?, `assigned_branch_id` = ?,
					`date_updated`= ? WHERE branch_staff_email = ?";
			}
			$data = array($info_fname, $info_mname, $info_lname, $info_contact_number, $info_assigned_branch, todaytime(), $whereEmail);

			$query = $this->db->query($sql, $data);

			// $sql = "UPDATE imm_users SET user_email = ? WHERE user_id = ?";
			// $data = array($info_emailaddress, $info_user_id);
			// $query = $this->db->query($sql, $data);
		}

		public function branch_admin_edit_accounts($info_user_id, $info_fname, $info_mname, $info_lname, $info_contact_number,$info_emailaddress){

			$sql = "SELECT position_id,user_email FROM imm_users WHERE user_id = ?";
			$data = array($info_user_id);
			$query = $this->db->query($sql, $data);

			$whereEmail = $query->row()->user_email;
			
			if($query->row()->position_id == 3){ //branch admin
				$sql = "UPDATE `imm_branch_admin` SET `branch_admin_first_name`= ?,`branch_admin_middle_name`= ?,`branch_admin_last_name`= ?,`branch_admin_contact_num`= ?,`date_updated`= ? WHERE branch_admin_email = ?";

			}else if ($query->row()->position_id == 5) { // branch staff
				$sql = "UPDATE `imm_branch_staff` SET `branch_staff_first_name`= ?,`branch_staff_middle_name`= ?,`branch_staff_last_name`= ?,`branch_staff_contact_num`= ?, `date_updated`= ? WHERE branch_staff_email = ?";
			}
			$data = array($info_fname, $info_mname, $info_lname, $info_contact_number, todaytime(), $whereEmail);

			$query = $this->db->query($sql, $data);

		}


		public function edit_branch($info_branch_id, $info_bname, $info_bcode, $info_address){

			$sql = "UPDATE `imm_branch` SET `branch_name`= ?,`branch_code`= ?,`branch_address`= ?,
					`date_updated`= ? WHERE branch_id = ?";
			$data = array($info_bname, $info_bcode, $info_address, todaytime(), $info_branch_id);
			$query = $this->db->query($sql, $data);
		}

		public function edit_holiday($holiday_id, $holiday_desc, $holiday_date){

			$sql = "UPDATE `imm_holiday` SET `holiday_description`= ?,`holiday_date`= ?,
					`date_updated`= ? WHERE holiday_id = ?";
			$data = array($holiday_desc, $holiday_date, todaytime(), $holiday_id);
			$query = $this->db->query($sql, $data);
		} 

		public function edit_country($tbe_country_name,$tbe_country_id){

			$sql = "UPDATE `imm_country` SET `country`= ?,`date_updated`= ? WHERE country_id = ?";
			$data = array($tbe_country_name, todaytime(), $tbe_country_id);
			$query = $this->db->query($sql, $data);
		} 

		public function edit_sched_limit($tbe_sched_limit_id,$tbe_branch_id,$tbe_start_date,$tbe_end_date,$tbe_day_limit,$tbe_hour_limit){

			$sql = "UPDATE `imm_schedule_limit` SET `sched_limit_branch_id`= ?,`start_date`= ?,`end_date`= ?,`day_limit`= ?,
					`hour_limit`= ?, `date_updated` = ? WHERE sched_limit_id = ?";
			$data = array($tbe_branch_id, $tbe_start_date,$tbe_end_date,$tbe_day_limit,$tbe_hour_limit, todaytime(), $tbe_sched_limit_id);
			$query = $this->db->query($sql, $data);
		}

		public function edit_announcement($posted_until, $title ,$content, $announcement_id){

			$sql = "UPDATE `imm_announcements` SET `display_until`= ?,`subject`= ?,`content`= ?,
					`date_updated`= ? WHERE announcement_id = ?";
			$data = array($posted_until, $title , $content, todaytime(), $announcement_id);
			$query = $this->db->query($sql, $data);
		}

		public function edit_appointment($appointment_id, $branch_id ,$appointment_date,$appointment_time){

			$sql = "UPDATE `imm_appointment_log` SET `center_id`= ?,`appointment_datesched`= ?,`appointment_timesched_id`= ?,
					`date_updated`= ? WHERE appointment_id = ?";
			$data = array($branch_id, $appointment_date , $appointment_time, todaytime(), $appointment_id);
			$query = $this->db->query($sql, $data);
		}

		public function resched_appointment($appointment_ref_no, $branch_id ,$appointment_date, $appointment_time, $resched_fee, $isReschedCounter){

			$sql = "UPDATE `imm_appointment_log` SET `center_id`= ?,`appointment_datesched`= ?, `appointment_timesched_id`= ?,`is_rescheduled` = ?, `is_rescheduled_counter` = ?, `reschedule_fee` = ?, `date_updated`= ? WHERE app_reference_no = ?";
			$data = array($branch_id, $appointment_date, $appointment_time, 1, $isReschedCounter, $resched_fee, todaytime(), $appointment_ref_no);
			
		
			$query = $this->db->query($sql, $data);
		}

		public function edit_application($info_application_id, $info_aname){

			$sql = "UPDATE `imm_application_type` SET `description`= ?,
					`date_updated`= ? WHERE application_id = ?";
			$data = array($info_aname, todaytime(), $info_application_id);
			$query = $this->db->query($sql, $data);
		}

		public function edit_reschedule_fee($tbe_resched_id,$tbe_resched_limit,$tbe_resched_fee){

			$sql = "UPDATE `imm_reschedule_fee` SET `resched_limit`= ?,`resched_fee`= ?,`date_updated`= ? WHERE resched_id = ?";
			$data = array($tbe_resched_limit,$tbe_resched_fee, todaytime(), $tbe_resched_id);
			$query = $this->db->query($sql, $data);
		}


		public function edit_requirement($req_id, $req_desc){

			$sql = "UPDATE `imm_application_requirements_type` SET `requirement_description`= ?, `date_updated`= ? 
					WHERE requirement_id = ?";
			$data = array($req_desc, todaytime(), $req_id);
			$query = $this->db->query($sql, $data);
		}

		public function register_user_orig($registerFirstname, $registerMiddlename, $registerLastname, $registerBday, $registerContactno, $registerGender, $registerCountry, $registerEmail, $registerPassword, $registerRepassword){
			$applicant_no = $this->checkIfApplicantNoExist();

			if (!empty($applicant_no)) {
				$sql = "INSERT INTO `imm_applicants`(`first_name`, `middle_name`, `last_name`, `birthdate`, `gender_id`, `contact_num`, `email`, `country_id`, `applicant_no`, `date_created`, `date_updated`, `enabled`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
				$data = array($registerFirstname, $registerMiddlename, $registerLastname, $registerBday, $registerGender, $registerContactno, $registerEmail, $registerCountry, $applicant_no, todaytime(), todaytime(), 0);

				$this->db->query($sql, $data);

				$sql = "INSERT INTO `imm_users`(`user_email`, `password`, `position_id`, `date_created`, `date_updated`, `enabled`) VALUES (?, ?, ?, ?, ?, ?)";
				// 2 = Applicant
				$data = array($registerEmail,  $registerPassword, 2, todaytime(), todaytime(), 0); 
				$this->db->query($sql, $data);
			}
		}		

		public function register_user($registerIcard,$registerFirstname,$registerMiddlename,$registerLastname,$registerExtname,$registerAlias1,$registerAlias2,$registerBday,$registerAge,$registerGender,$registerCivilstatus,$registerCountry,$registerCitizenship,$registerPassport,$registerDateofIssuance,$registerExpiryDate,$registerIssiuanceplace,$registerEmail,$registerArrivalDate,$registerLandline,$registerMobile,$registerEmail2,$registerPassword,$registerRepassword,$registerStreet,$registerVillage,$registerBarangay,$registerCity,$registerProvince,$registerZipcode,$registerStreet2,$registerVillage2,$registerCity2,$registerState,$registerCountry2,$registerZipcode2){
			$applicant_no = $this->checkIfApplicantNoExist();

			if (!empty($applicant_no)) {
				$sql = "INSERT INTO `imm_applicant`(`applicant_no`,`icard_no`,`first_name`, `middle_name`, `last_name`,`ext_name`, `alias1`,`alias2`,`email`,`password`, `birthdate`, `age`, `gender_id`, `civil_status`, `landline`, `mobile_num`, `country_id`, `nationality`,`passport_num`, `place_of_isssuance`, `issuance_date`, `expiry_date`, `latest_arrival_date`,`ph_street_no`,`ph_village`,`ph_barangay`,`ph_city`,`ph_province`,`ph_zipcode`,`ab_street_no`,`ab_village`,`ab_city`,`ab_state`,`ab_country`,`ab_zipcode`,`date_created`, `date_updated`, `enabled`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
				$data = array($applicant_no, $registerIcard,$registerFirstname, $registerMiddlename,$registerLastname,$registerExtname,$registerAlias1,$registerAlias2,$registerEmail2,$registerPassword,$registerBday,$registerAge,$registerGender,$registerCivilstatus,$registerLandline,$registerMobile, $registerCountry,$registerCitizenship,$registerPassport,$registerIssiuanceplace,$registerDateofIssuance,$registerExpiryDate,$registerArrivalDate,$registerStreet,$registerVillage,$registerBarangay,$registerCity,$registerProvince,$registerZipcode,$registerStreet2,$registerVillage2,$registerCity2,$registerState,$registerCountry2,$registerZipcode2,todaytime(), todaytime(), 0);

				$this->db->query($sql, $data);

				$sql = "INSERT INTO `imm_users`(`user_email`, `password`, `position_id`, `date_created`, `date_updated`, `enabled`) VALUES (?, ?, ?, ?, ?, ?)";
				// 2 = Applicant
				$data = array($registerEmail2,  $registerPassword, 2, todaytime(), todaytime(), 0); 
				$this->db->query($sql, $data);
			}
		}

		public function verifyemailregistration($email){
			$sql = "UPDATE imm_applicant SET enabled = 1 WHERE md5(email) = ?";
			$data = array($email);
			$this->db->query($sql, $data);

			$sql = "UPDATE imm_users SET enabled = 1, date_activated = ? WHERE md5(user_email) = ?";
			$data = array(todaytime(), $email);
			$this->db->query($sql, $data);
		}

		public function checkemailAddressIfExitsmd5($emailAddress){
			$sql = "SELECT * FROM imm_users WHERE md5(user_email) = ? LIMIT 1";
			$data = array($emailAddress);
			return $this->db->query($sql, $data);	
		}

		public function resetpasswordUpdate($password, $emailAddress){
			$sql = "UPDATE imm_users SET password = ?, date_updated = ? WHERE md5(user_email) = ?";
			$data = array($password, todaytime(), $emailAddress);
			$this->db->query($sql, $data);
		}

		// public function validate_username($username){ // validate email if exist and get the info
		// 	$sql = "SELECT * FROM imm_users WHERE user_email = ? LIMIT 1";
		// 	$data = array($username);
		// 	return $this->db->query($sql, $data);
		// }

		public function validate_username($username){ // validate email if exist and get the info
			$sql = "SELECT * FROM imm_users WHERE user_email = ? AND position_id IN (2) LIMIT 1";
			$data = array($username);
			return $this->db->query($sql, $data);
		}

		public function validate_username_admin($username){ // validate email if exist and get the info
			$sql = "SELECT * FROM imm_users WHERE user_email = ? AND position_id IN (1,3,4,5) LIMIT 1";
			$data = array($username);
			return $this->db->query($sql, $data);
		}

		public function getAdminInfo($email){
			$sql = "SELECT * FROM imm_admin adm
					LEFT JOIN imm_users mus ON  adm.admin_email = mus.user_email
					LEFT JOIN imm_position spo ON mus.position_id = spo.position_id 
					WHERE mus.user_email = ? 
					AND mus.enabled = 1 
					AND spo.enabled = 1 LIMIT 1";
			$data = array($email);
			return $this->db->query($sql, $data);
		}

		public function getBranchAdminInfo($email){
			$sql = "SELECT * FROM imm_branch_admin bad
					LEFT JOIN imm_branch bra ON bra.branch_id = bad.branch_admin_assigned_branch_id
					LEFT JOIN imm_users sus ON  bad.branch_admin_email = sus.user_email
					LEFT JOIN imm_position spo ON sus.position_id = spo.position_id 
					WHERE sus.user_email = ? 
					AND sus.enabled = 1
					AND spo.enabled = 1 LIMIT 1";
			$data = array($email);
			return $this->db->query($sql, $data);
		}

		public function getApplicantInfo($email){
			$sql = "SELECT * FROM imm_applicant apl
					LEFT JOIN imm_users us ON  apl.email = us.user_email
					LEFT JOIN imm_position spo ON us.position_id = spo.position_id
					LEFT JOIN imm_country cty ON apl.country_id =  cty.country_id
					LEFT JOIN imm_civil_status cs ON apl.civil_status =  cs.civil_status_id
					WHERE us.user_email = ? 
					AND us.enabled = 1 
					AND spo.enabled = 1 LIMIT 1";
			$data = array($email);
			return $this->db->query($sql, $data);
		}

		public function getApplicantInfoUsingId($applicant_id){
			$sql = "SELECT * FROM imm_applicant apl
					LEFT JOIN imm_users us ON  apl.email = us.user_email
					LEFT JOIN imm_country cty ON apl.country_id =  cty.country_id
					LEFT JOIN imm_civil_status cs ON apl.civil_status =  cs.civil_status_id
					WHERE apl.applicant_id = ?	AND us.enabled = 1";
			$data = array($applicant_id);
			return $this->db->query($sql, $data);
		}

		public function getApplicationDetails($email){
			$sql = "SELECT * FROM imm_application_log apl
					LEFT JOIN imm_application_requirements_log aprl ON apl.reference_no = aprl.application_reference_no
					LEFT JOIN imm_application_requirements_type aprt ON aprl.requirement_id = aprt.requirement_id
					WHERE apl.applicant_email = ? 
					AND apl.enabled = 1 
					AND aprl.enabled = 1 LIMIT 1";
			$data = array($email);
			return $this->db->query($sql, $data);
		}

		public function getApplicationUploadedRequirements($reference_no){
			$sql = "SELECT * FROM imm_application_requirements_log aprl
					WHERE aprl.application_reference_no = ? 
					AND aprl.enabled = 1" ;
					
			$data = array($reference_no);
			return $this->db->query($sql, $data);
		}

		//for application 3-13-2018

		public function getBidOr(){
			$sql = "SELECT * FROM imm_official_receipt
					WHERE isAvailable = 1 
					AND enabled = 1 ORDER BY or_no ASC LIMIT 1" ;

			return $this->db->query($sql);
		}

		public function getCPOr(){
			$sql = "SELECT * FROM imm_cp_receipt
					WHERE isAvailable = 1 
					AND enabled = 1 ORDER BY cp_or_no ASC LIMIT 1" ;

			return $this->db->query($sql);
		}

		public function getProcessType(){
			$sql = "SELECT * FROM imm_application_process
					WHERE enabled = 1" ;

			return $this->db->query($sql);
		}


		public function checkIfApplicantHasAlreadyApplied($applicant_email){
			$sql = "SELECT * FROM imm_application_log apl
	 			WHERE apl.applicant_email = ?
	 			and enabled = ?";
	 			
	 			$data = array($applicant_email, 1);

	 			if( $this->db->query($sql, $data)->num_rows() > 0){
	 				return true;
	 			} else {
	 				return false;
	 			}
		}

		public function getApplicationInfoUsingEmail($applicant_email){
			$sql = "SELECT * FROM imm_application_log apl
			LEFT JOIN imm_application_type apt ON apl.application_type_id = apt.application_id
			LEFT JOIN imm_appointment_timesched ats ON apl.app_branch_time = ats.id
			LEFT JOIn imm_branch at ON apl.app_branch_id = at.branch_id
			LEFT JOIN imm_application_process apro ON apro.process_id = apl.process_lane
			LEFT JOIN imm_applicant app ON app.email = apl.applicant_email
			LEFT JOIN imm_civil_status cs ON cs.civil_status_id = app.civil_status
			LEFT JOIN imm_country cty ON cty.country_id = app.ab_country
	 		WHERE apl.applicant_email = ? AND apl.enabled = ?";

	 		$data = array($applicant_email, 1);
	 		return $this->db->query($sql, $data);
	 		
		}

		public function getApplicationInfoUsingRefNo($reference_no){
			$sql = "SELECT * FROM imm_application_log apl
			LEFT JOIN imm_application_type apt ON apl.application_type_id = apt.application_id
			LEFT JOIN imm_appointment_timesched ats ON apl.app_branch_time = ats.id
			LEFT JOIn imm_branch at ON apl.app_branch_id = at.branch_id
			LEFT JOIN imm_application_process apro ON apro.process_id = apl.process_lane
			LEFT JOIN imm_applicant app ON app.email = apl.applicant_email
			LEFT JOIN imm_civil_status cs ON cs.civil_status_id = app.civil_status
			LEFT JOIN imm_country cty ON cty.country_id = app.ab_country
	 		WHERE apl.reference_no = ? AND apl.enabled = ?";

	 		$data = array($reference_no, 1);
	 		return $this->db->query($sql, $data);
		}

		public function checkIfApplicantHasExistingAppointment($applicant_no){

				$sql = "SELECT * FROM imm_appointment_log apl
	 			LEFT JOIN imm_branch br on apl.center_id = br.branch_id
	 			-- LEFT JOIN imm_appointment_status aps on apl.appointment_status_id = aps.status_id
	 			LEFT JOIN imm_appointment_timesched apt on apl.appointment_timesched_id =  apt.id
	 			WHERE apl.applicant_no = ?
	 			AND apl.enabled = ?  LIMIT 1";
	 			$data = array($applicant_no, 1);  
	 			return  $this->db->query($sql, $data);

		}

		public function get_available_appointment_date($app_date, $app_center){

			$sql = "SELECT * FROM imm_application_log apl
					LEFT JOIN imm_appointment_timesched apt ON apl.app_branch_time = apt.id
					WHERE apl.appointment_date = ?
					AND apl.app_branch_id = ?
					AND apl.enabled = 1";
			$data = array($app_date, $app_center);
			return $this->db->query($sql, $data);

		}

		public function get_sched_limit($app_center){

			$sql = "SELECT * FROM imm_schedule_limit sl
					WHERE sl.sched_limit_branch_id = ?
					AND sl.enabled = 1";
			$data = array($app_center);
			return $this->db->query($sql, $data);
		}
		public function get_sched_limit_created_by_branch_admin($app_center){

			$sql = "SELECT * FROM imm_schedule_limit sl
					WHERE sl.sched_limit_branch_id = ?
					AND sl.enabled = 1 and sl.created_by = 3";
			$data = array($app_center);
			return $this->db->query($sql, $data);
		}

		public function getStaffInfo($email){
			$sql = "SELECT * FROM imm_staff st
					LEFT JOIN imm_users sus ON  st.staff_email = sus.user_email
					LEFT JOIN imm_position spo ON sus.position_id = spo.position_id 
					WHERE sus.user_email = ? 
					AND sus.enabled = 1 
					AND spo.enabled = 1 LIMIT 1";
			$data = array($email);
			return $this->db->query($sql, $data);
		}

		public function getBranchStaffInfo($email){
			$sql = "SELECT * FROM imm_branch_staff bst
					LEFT JOIN imm_users sus ON  bst.branch_staff_email = sus.user_email
					LEFT JOIN imm_position spo ON sus.position_id = spo.position_id 
					LEFT JOIN imm_branch bra ON bra.branch_id = bst.assigned_branch_id
					WHERE sus.user_email = ? 
					AND sus.enabled = 1 
					AND spo.enabled = 1 LIMIT 1";
			$data = array($email);
			return $this->db->query($sql, $data);
		}

		public function saveInfo_user($email_fk, $info_fname, $info_mname, $info_lname, $info_bdate, $info_contact_num, $info_country, $info_gender, $info_emailaddress){

			$sql = "UPDATE `imm_applicants` SET `first_name`= ?, `middle_name`= ?, `last_name`= ?, `birthdate`= ?, `gender_id`= ?, `contact_num`= ?, `country_id`= ?, `date_updated`= ? WHERE email = ? ";
			//walang kasamang email
			$data = array($info_fname, $info_mname, $info_lname, $info_bdate, $info_gender, $info_contact_num,
			 	$info_country, todaytime(), $email_fk);

			$this->db->query($sql,$data); 

			return $this->db->affected_rows();
		}


		public function editInfo_applicant($user_id,$info_email,$email_fk,$info_fname ,$info_mname,$info_lname,$info_xname,$info_acr_no,$info_alias1 ,$info_alias2 , $info_bdate,$info_age,$info_gender,$info_civilstatus,$info_birth_country,$info_nationality,$info_passport_no,$info_issuance_place,$info_issuance_date,$info_expiry_date,$info_arrival_date, $info_mobile_num, $info_landline, $info_ph_st, $info_ph_village, $info_ph_brgy, $info_ph_city, $info_ph_prov, $info_ph_zipcode, $info_ab_st, $info_ab_village, $info_ab_city, $info_ab_state, $info_ab_country, $info_ab_zipcode){

			$sql = "UPDATE `imm_applicant` SET `email`=?, `first_name` = ?, `middle_name`= ?,`last_name`= ?,`ext_name` =?,`icard_no`= ?, `alias1`= ?,`alias2`= ?,`birthdate`= ?,`age`= ?,`gender_id`= ?,`civil_status`= ?, `country_id`=? ,`nationality`=?, `passport_num`=?, `place_of_isssuance`=?,`issuance_date`=?, `expiry_date`=?, `latest_arrival_date`=?, `landline`= ?,`mobile_num`= ?,`ph_street_no`= ?,`ph_village`= ?,`ph_barangay`= ?,`ph_city`= ?,`ph_province`= ?,`ph_zipcode`= ?,`ab_street_no`= ?,`ab_village`= ?,`ab_city`= ?,`ab_state`= ?,`ab_country`= ?,`ab_zipcode`= ?,`date_updated`= ? WHERE email = ? ";

			$data = array($info_email,$info_fname ,$info_mname,$info_lname,$info_xname,$info_acr_no,$info_alias1 ,$info_alias2 , $info_bdate,$info_age,$info_gender,$info_civilstatus,$info_birth_country,$info_nationality,$info_passport_no,$info_issuance_place,$info_issuance_date,$info_expiry_date,$info_arrival_date, $info_mobile_num, $info_landline, $info_ph_st, $info_ph_village, $info_ph_brgy, $info_ph_city, $info_ph_prov, $info_ph_zipcode, $info_ab_st, $info_ab_village, $info_ab_city, $info_ab_state, $info_ab_country, $info_ab_zipcode, todaytime(), $email_fk);

			$this->db->query($sql,$data); 

			$sql2 = "UPDATE `imm_users` SET `user_email`=?  WHERE user_id = ? ";
			$data2 = array($info_email,$user_id);
			$this->db->query($sql2,$data2); 
			$this->session->set_userdata('email', $info_email);

			return $this->db->affected_rows();
		}

		// public function saveInfo_admin($email_fk, $info_fname, $info_mname, $info_lname, $info_bdate, $info_contact_num, $info_country, $info_gender, $info_emailaddress){

		// 	$sql = "UPDATE `imm_admin` SET `admin_first_name`= ?, `admin_middle_name`= ?, `admin_last_name`= ?, `admin_birthdate`= ?, `admin_gender_id`= ?, `admin_contact_num`= ?, `admin_country_id`= ?, `date_updated`= ? WHERE admin_email = ? ";
			
		// 	$data = array($info_fname, $info_mname, $info_lname, $info_bdate, $info_gender, $info_contact_num, $info_country, todaytime(), $email_fk );

		// 	$this->db->query($sql,$data); 

		// 	return $this->db->affected_rows();
		// }

		public function saveInfo_admin($email_fk, $info_fname, $info_mname, $info_lname, $info_contact_num, $info_emailaddress){

			$sql = "UPDATE `imm_admin` SET `admin_first_name`= ?, `admin_middle_name`= ?, `admin_last_name`= ?, `admin_contact_num`= ?, `date_updated`= ? WHERE admin_email = ? ";
			
			$data = array($info_fname, $info_mname, $info_lname, $info_contact_num, todaytime(), $email_fk );

			$this->db->query($sql,$data); 

			return $this->db->affected_rows();
		}

		// public function saveInfo_branch_admin($email_fk, $info_fname, $info_mname, $info_lname, $info_bdate, $info_contact_num, $info_country, $info_gender, $info_emailaddress){

		// 	$sql = "UPDATE `imm_branch_admin` SET `branch_admin_first_name`= ?, `branch_admin_middle_name`= ?, `branch_admin_last_name`= ?, `branch_admin_birthdate`= ?, `branch_admin_gender_id`= ?, `branch_admin_contact_num`= ?, `branch_admin_country_id`= ?, `date_updated`= ? WHERE branch_admin_email = ? ";
			
		// 	$data = array($info_fname, $info_mname, $info_lname, $info_bdate, $info_gender, $info_contact_num, $info_country, todaytime(), $email_fk );

		// 	$this->db->query($sql,$data); 

		// 	return $this->db->affected_rows();
		// }	

		public function saveInfo_branch_admin($email_fk, $info_fname, $info_mname, $info_lname, $info_contact_num, $info_emailaddress){

			$sql = "UPDATE `imm_branch_admin` SET `branch_admin_first_name`= ?, `branch_admin_middle_name`= ?, `branch_admin_last_name`= ?, `branch_admin_contact_num`= ?, `date_updated`= ? WHERE branch_admin_email = ? ";
			
			$data = array($info_fname, $info_mname, $info_lname, $info_contact_num, todaytime(), $email_fk );

			$this->db->query($sql,$data); 

			return $this->db->affected_rows();
		}

		// public function saveInfo_staff($email_fk, $info_fname, $info_mname, $info_lname, $info_bdate, $info_contact_num, $info_country, $info_gender, $info_emailaddress){

		// 	$sql = "UPDATE `imm_staff` SET `staff_first_name`= ?, `staff_middle_name`= ?, `staff_last_name`= ?, `staff_birthdate`= ?, `staff_gender_id`= ?, `staff_contact_num`= ?, `staff_country_id`= ?, `date_updated`= ? WHERE staff_email = ? ";
			
		// 	$data = array($info_fname, $info_mname, $info_lname, $info_bdate, $info_gender, $info_contact_num, $info_country, todaytime(), $email_fk );

		// 	$this->db->query($sql,$data); 

		// 	return $this->db->affected_rows();
		// }		

		public function saveInfo_staff($email_fk, $info_fname, $info_mname, $info_lname, $info_contact_num, $info_emailaddress){

			$sql = "UPDATE `imm_staff` SET `staff_first_name`= ?, `staff_middle_name`= ?, `staff_last_name`= ?, `staff_contact_num`= ?, `date_updated`= ? WHERE staff_email = ? ";
			
			$data = array($info_fname, $info_mname, $info_lname, $info_contact_num, todaytime(), $email_fk );

			$this->db->query($sql,$data); 

			return $this->db->affected_rows();
		}

		// public function saveInfo_branch_staff($email_fk, $info_fname, $info_mname, $info_lname, $info_bdate, $info_contact_num, $info_country, $info_gender, $info_emailaddress){

		// 	$sql = "UPDATE `imm_branch_staff` SET `branch_staff_first_name`= ?, `branch_staff_middle_name`= ?, `branch_staff_last_name`= ?, `branch_staff_birthdate`= ?, `branch_staff_gender_id`= ?, `branch_staff_contact_num`= ?, `branch_staff_country_id`= ?, `date_updated`= ? WHERE branch_staff_email = ? ";
			
		// 	$data = array($info_fname, $info_mname, $info_lname, $info_bdate, $info_gender, $info_contact_num, $info_country, todaytime(), $email_fk );

		// 	$this->db->query($sql,$data); 

		// 	return $this->db->affected_rows();
		// }		

		public function saveInfo_branch_staff($email_fk, $info_fname, $info_mname, $info_lname, $info_contact_num, $info_emailaddress){

			$sql = "UPDATE `imm_branch_staff` SET `branch_staff_first_name`= ?, `branch_staff_middle_name`= ?, `branch_staff_last_name`= ?, `branch_staff_contact_num`= ?, `date_updated`= ? WHERE branch_staff_email = ? ";
			
			$data = array($info_fname, $info_mname, $info_lname, $info_contact_num, todaytime(), $email_fk );

			$this->db->query($sql,$data); 

			return $this->db->affected_rows();
		}

		public function deleteAccounts ($del_user_id, $del_email_id, $del_position_id){

			if ($del_position_id == 1) { //admin
				$sql = "UPDATE `imm_admin` SET `enabled`= 0 WHERE admin_email = ?";
			}else if ($del_position_id == 2) { //applicant
				$sql = "UPDATE `imm_applicants` SET `enabled`= 0 WHERE email = ?";
			}else if ($del_position_id == 3) { //branch admin
				$sql = "UPDATE `imm_branch_admin` SET `enabled`= 0 WHERE branch_admin_email = ?";
			}else if ($del_position_id == 4) { //staff
				$sql = "UPDATE `imm_staff` SET `enabled`= 0 WHERE staff_email = ?";
			}else if ($del_position_id == 5) { //branch staff
				$sql = "UPDATE `imm_branch_staff` SET `enabled`= 0 WHERE branch_staff_email = ?";
			}

			$data = array($del_email_id);
			$query = $this->db->query($sql, $data);

			$sql = "UPDATE imm_users SET enabled = 0 WHERE user_id = ?";
			$data = array($del_user_id);

			$query = $this->db->query($sql, $data);

		}

		public function deleteAdminTransactionsApplications($del_app_id){

			$sql = "UPDATE `imm_application_log` SET `enabled`= 0 WHERE id = ?";
			$data = array($del_app_id);
			
			$query = $this->db->query($sql, $data);

		}

		public function deleteAnnouncement($del_announcement_id){

			$sql = "UPDATE `imm_announcements` SET `enabled`= 0 WHERE announcement_id = ?";
			$data = array($del_announcement_id);
			$query = $this->db->query($sql, $data);

		}

		public function deleteAdminTransactionsAppointment($del_app_id){

			$sql = "UPDATE `imm_appointment_log` SET `enabled`= 0 WHERE appointment_id = ?";
			$data = array($del_app_id);
			
			$query = $this->db->query($sql, $data);

		}

		public function confirmAppearanceAdminTransactionsApplications($app_ref_no){

			$sql = "UPDATE `imm_application_log` SET `application_status`= 1, `rejection_reason` = null WHERE reference_no = ?";
			$data = array($app_ref_no);
			
			$query = $this->db->query($sql, $data);
		}


		public function rejectAdminTransactionsApplications($rej_app_ref_no, $rejection_reason){

			$sql = "UPDATE `imm_application_log` SET `application_status`= 2, `rejection_reason` = ? ,`enabled` = ?, `date_updated` = ? WHERE reference_no = ?";
			$data = array( $rejection_reason,0, todaytime(), $rej_app_ref_no);
			$query = $this->db->query($sql, $data);
		}

		public function rejectAdminTransactionsAppointment($rej_app_id, $rejection_reason){

			$sql = "UPDATE `imm_appointment_log` SET `appointment_status_id`= 2, `rejection_reason` = ?,`enabled` = ?, `date_updated` = ? WHERE appointment_id = ?";
			$data = array( $rejection_reason,0, todaytime(), $rej_app_id);
			$query = $this->db->query($sql, $data);
		}

		public function approveAdminTransactionsAppointment($appr_app_id){

			$sql = "UPDATE `imm_appointment_log` SET `appointment_status_id`= 1, `rejection_reason` = null WHERE appointment_id = ?";
			$data = array($appr_app_id);
			
			$query = $this->db->query($sql, $data);
		}


		public function deleteBranch ($del_branch_id){
		
			$sql = "UPDATE `imm_branch` SET `enabled`= 0 WHERE branch_id = ?";
			$data = array($del_branch_id);
			$query = $this->db->query($sql, $data);

		}

		public function deleteHoliday ($del_holiday_id){
		
			$sql = "UPDATE `imm_holiday` SET `enabled`= 0 WHERE holiday_id = ?";
			$data = array($del_holiday_id);
			$query = $this->db->query($sql, $data);
		}

		public function deleteCountry ($del_country_id){
		
			$sql = "UPDATE `imm_country` SET `enabled`= 0 WHERE country_id = ?";
			$data = array($del_country_id);
			$query = $this->db->query($sql, $data);
		}

		public function delete_sched_limit ($del_sched_limit_id){
		
			$sql = "UPDATE `imm_schedule_limit` SET `enabled`= 0 WHERE sched_limit_id = ?";
			$data = array($del_sched_limit_id);
			$query = $this->db->query($sql, $data);

		}

		public function deleteAppointment ($del_appointment_id){
		
			$sql = "UPDATE `imm_appointment_log` SET `appointment_status_id` = 3, `enabled`= 0 WHERE appointment_id = ?";
			$data = array($del_appointment_id);
			$query = $this->db->query($sql, $data);
		}

		public function deleteApplication ($del_application_id){
		
			$sql = "UPDATE `imm_application_type` SET `enabled`= 0 WHERE application_id = ?";
			$data = array($del_application_id);
			$query = $this->db->query($sql, $data);
		}

		public function deleteRescheduleFee ($del_resched_id){
		
			$sql = "UPDATE `imm_reschedule_fee` SET `enabled`= 0 WHERE resched_id = ?";
			$data = array($del_resched_id);
			$query = $this->db->query($sql, $data);
		}


		public function cancelApplication ($del_application_id){
		
			$sql = "UPDATE `imm_application_log` SET `application_status`= 3, `enabled`= 0 WHERE id = ?";
			$data = array($del_application_id);
			$query = $this->db->query($sql, $data);
		}

		public function deleteRequirement ($del_requirement_id){
		
			$sql = "UPDATE `imm_application_requirements_type` SET `enabled`= 0 WHERE requirement_id = ?";
			$data = array($del_requirement_id);
			$query = $this->db->query($sql, $data);
		}

		public function save_info_branch($info_bname, $info_bcode, $info_address){

			$sql = "INSERT INTO `imm_branch`(`branch_name`, `branch_code`, `branch_address`, `date_created`, `date_updated`) VALUES (?, ?, ?, ?, ?)";
			$data = array($info_bname, $info_bcode, $info_address, todaytime(), todaytime());
			$this->db->query($sql,$data); 
		
		}

		public function save_holiday($info_hol_desc, $info_hol_date){

			$sql = "INSERT INTO `imm_holiday`(`holiday_description`, `holiday_date`, `date_created`, `date_updated`) VALUES (?, ?, ?, ?)";
			$data = array($info_hol_desc, $info_hol_date, todaytime(), todaytime());
			$this->db->query($sql,$data); 
		
		}

		public function save_country($country_name){

			$sql = "INSERT INTO `imm_country`(`country`, `date_created`, `date_updated`) VALUES (?, ?, ?)";
			$data = array($country_name, todaytime(), todaytime());
			$this->db->query($sql,$data); 
		
		}

		public function save_sched_limit($info_branch_id,$info_start_date,$info_end_date,$info_day_limit,$info_hour_limit,$created_by){

			$sql = "INSERT INTO `imm_schedule_limit`(`sched_limit_branch_id`,`start_date`,`end_date`,`day_limit`,`hour_limit`,`date_created`, `date_updated`,`created_by`) VALUES (?, ?, ?, ?,?,?,?,?)";
			$data = array($info_branch_id,$info_start_date,$info_end_date,$info_day_limit,$info_hour_limit,todaytime(),todaytime(),$created_by);
			$this->db->query($sql,$data); 
		}

		public function save_announcement($info_subject, $info_content, $info_display_date, $info_posted_by){

			$sql = "INSERT INTO `imm_announcements`(`subject`, `content`, `display_until`, `posted_by`, `posted_on`,`date_created`, `date_updated`) VALUES (?, ?, ?, ?, ?,?,?)";
			$data = array($info_subject, $info_content, $info_display_date, $info_posted_by, today(),todaytime(), todaytime());
			$this->db->query($sql,$data); 
		}

		public function save_info_application($info_aname){

			$sql = "INSERT INTO `imm_application_type`(`description`,`date_created`, `date_updated`) VALUES (?, ?, ?)";
			$data = array($info_aname, todaytime(), todaytime());
			$this->db->query($sql,$data); 
		
		}

		public function save_reschedule_fee($tba_resched_fee, $tba_resched_limit){

			$sql = "INSERT INTO `imm_reschedule_fee` (`resched_fee`, `resched_limit`, `date_created`, `date_updated`) VALUES (?, ?, ?, ?)";
			$data = array($tba_resched_fee, $tba_resched_limit, todaytime(), todaytime());
			$this->db->query($sql,$data); 
		
		}

		public function save_info_requirement($req_name){

			$sql = "INSERT INTO `imm_application_requirements_type` (`requirement_description`, `date_created`, `date_updated`) VALUES (?, ?, ?)";
			$data = array($req_name, todaytime(), todaytime());
			$this->db->query($sql,$data); 
		
		}

		// public function save_info_accounts($info_fname, $info_mname, $info_lname, $info_bdate, $info_contact_number, $info_country, $info_gender, $info_emailaddress, $password, $info_position, $branch_id){

		// 	if ($info_position == 1) { //admin
		// 		$sql = "INSERT INTO `imm_admin`(`admin_first_name`, `admin_middle_name`, `admin_last_name`, `admin_country_id`, `admin_email`, `admin_contact_num`, `admin_birthdate`, `admin_gender_id`, `date_created`, `date_updated`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

		// 		$data = array($info_fname, $info_mname, $info_lname, $info_country, $info_emailaddress, $info_contact_number, $info_bdate, $info_gender, todaytime(), todaytime());

		// 		$this->db->query($sql,$data); 

		// 		$sql = "INSERT INTO `imm_users`(`user_email`, `password`, `position_id`, `date_activated`, `date_created`, `date_updated`, `enabled`) VALUES (?, ?, ?, ?, ?, ?, ?)";

		// 		$data = array($info_emailaddress, $password, $info_position, todaytime(), todaytime(), todaytime(), 1);

		// 		$this->db->query($sql,$data); 

		// 	}else if ($info_position == 3) { // branch admin
		// 		$sql = "INSERT INTO `imm_branch_admin`(`branch_admin_first_name`, `branch_admin_middle_name`, `branch_admin_last_name`, `branch_admin_country_id`, `branch_admin_email`, `branch_admin_contact_num`, `branch_admin_birthdate`, `branch_admin_gender_id`, `date_created`, `date_updated`, `branch_admin_assigned_branch_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";

		// 		$data = array($info_fname, $info_mname, $info_lname, $info_country, $info_emailaddress, $info_contact_number, $info_bdate, $info_gender, todaytime(), todaytime(),$branch_id);

		// 		$this->db->query($sql,$data); 

		// 		$sql = "INSERT INTO `imm_users`(`user_email`, `password`, `position_id`, `date_activated`, `date_created`, `date_updated`, `enabled`) VALUES (?, ?, ?, ?, ?, ?, ?)";

		// 		$data = array($info_emailaddress, $password, $info_position, todaytime(), todaytime(), todaytime(), 1);

		// 		$this->db->query($sql,$data);

		// 	}else if ($info_position == 4) { //staff

		// 		$sql = "INSERT INTO `imm_staff`(`staff_first_name`, `staff_middle_name`, `staff_last_name`,`staff_country_id`, `staff_email`, `staff_contact_num`, `staff_birthdate`, `staff_gender_id`, `date_created`, `date_updated`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

		// 		$data = array($info_fname, $info_mname, $info_lname, $info_country, $info_emailaddress, $info_contact_number, $info_bdate, $info_gender, todaytime(), todaytime());

		// 		$this->db->query($sql,$data); 

		// 		$sql = "INSERT INTO `imm_users`(`user_email`, `password`, `position_id`, `date_created`, `date_updated`, `enabled`) VALUES (?, ?, ?, ?, ?, ?)";

		// 		$data = array($info_emailaddress, $password, $info_position, todaytime(), todaytime(), 1);

		// 		$this->db->query($sql,$data);

		// 	}else if ($info_position == 5) { //branch staff

		// 		$sql = "INSERT INTO `imm_branch_staff`(`branch_staff_first_name`, `branch_staff_middle_name`, `branch_staff_last_name`, `branch_staff_country_id`, `branch_staff_email`, `branch_staff_contact_num`, `branch_staff_birthdate`, `branch_staff_gender_id`, `date_created`, `date_updated`, `assigned_branch_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,?,?)";

		// 		$data = array($info_fname, $info_mname, $info_lname, $info_country, $info_emailaddress, $info_contact_number, $info_bdate, $info_gender, todaytime(), todaytime(), $branch_id);
		// 		$this->db->query($sql,$data); 
		// 	}
				
		// 		$sql = "INSERT INTO `imm_users`(`user_email`, `password`, `position_id`, `date_created`, `date_updated`, `enabled`) VALUES (?, ?, ?, ?, ?, ?)";

		// 		$data = array($info_emailaddress, $password, $info_position, todaytime(), todaytime(), 1);

		// 		$this->db->query($sql,$data);
		// }

		public function save_info_accounts($info_fname, $info_mname, $info_lname, $info_contact_number, $info_emailaddress, $password, $info_position, $branch_id){

			if ($info_position == 1) { //admin
				$sql = "INSERT INTO `imm_admin`(`admin_first_name`, `admin_middle_name`, `admin_last_name`, `admin_email`, `admin_contact_num`, `date_created`, `date_updated`) VALUES (?, ?, ?, ?, ?, ?, ?)";

				$data = array($info_fname, $info_mname, $info_lname, $info_emailaddress, $info_contact_number, todaytime(), todaytime());

				$this->db->query($sql,$data); 

				$sql = "INSERT INTO `imm_users`(`user_email`, `password`, `position_id`, `date_activated`, `date_created`, `date_updated`, `enabled`) VALUES (?, ?, ?, ?, ?, ?, ?)";

				$data = array($info_emailaddress, $password, $info_position, todaytime(), todaytime(), todaytime(), 1);

				$this->db->query($sql,$data); 

			}else if ($info_position == 3) { // branch admin
				$sql = "INSERT INTO `imm_branch_admin`(`branch_admin_first_name`, `branch_admin_middle_name`, `branch_admin_last_name`, `branch_admin_email`, `branch_admin_contact_num`, `date_created`, `date_updated`, `branch_admin_assigned_branch_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

				$data = array($info_fname, $info_mname, $info_lname, $info_emailaddress, $info_contact_number,todaytime(), todaytime(),$branch_id);

				$this->db->query($sql,$data); 

				$sql = "INSERT INTO `imm_users`(`user_email`, `password`, `position_id`, `date_activated`, `date_created`, `date_updated`, `enabled`) VALUES (?, ?, ?, ?, ?, ?, ?)";

				$data = array($info_emailaddress, $password, $info_position, todaytime(), todaytime(), todaytime(), 1);

				$this->db->query($sql,$data);

			}else if ($info_position == 4) { //staff

				$sql = "INSERT INTO `imm_staff`(`staff_first_name`, `staff_middle_name`, `staff_last_name`, `staff_email`, `staff_contact_num`, `date_created`, `date_updated`) VALUES ( ?, ?, ?, ?, ?, ?, ?)";

				$data = array($info_fname, $info_mname, $info_lname,$info_emailaddress, $info_contact_number, todaytime(), todaytime());

				$this->db->query($sql,$data); 

				$sql = "INSERT INTO `imm_users`(`user_email`, `password`, `position_id`, `date_created`, `date_updated`, `enabled`) VALUES (?, ?, ?, ?, ?, ?)";

				$data = array($info_emailaddress, $password, $info_position, todaytime(), todaytime(), 1);

				$this->db->query($sql,$data);	

			}else if ($info_position == 5) { //branch staff

				$sql = "INSERT INTO `imm_branch_staff`(`branch_staff_first_name`, `branch_staff_middle_name`, `branch_staff_last_name`, `branch_staff_email`, `branch_staff_contact_num`, `date_created`, `date_updated`, `assigned_branch_id`) VALUES (?, ?, ?, ?, ?, ?,?,?)";

				$data = array($info_fname, $info_mname, $info_lname, $info_emailaddress, $info_contact_number, todaytime(), todaytime(), $branch_id);
				$this->db->query($sql,$data); 
				
				$sql = "INSERT INTO `imm_users`(`user_email`, `password`, `position_id`, `date_created`, `date_updated`, `enabled`) VALUES (?, ?, ?, ?, ?, ?)";

				$data = array($info_emailaddress, $password, $info_position, todaytime(), todaytime(), 1);

				$this->db->query($sql,$data);
			}
		}


		public function checkPasswordUsingEmailFk($email_fk){
			$sql = "SELECT password FROM imm_users WHERE user_email = ? LIMIT 1";
			$data = array($email_fk);
			return $this->db->query($sql, $data);
		}

		public function saveChangePass_player($secNewpass, $email_fk){
			$sql = "UPDATE imm_users SET password = ?, date_updated = ? WHERE user_email = ? ";
			$data = array($secNewpass, todaytime(), $email_fk);
			$this->db->query($sql,$data); 
		}

		public function get_center(){
			$sql = "SELECT * FROM imm_branch WHERE enabled = 1 ORDER BY branch_name ASC";
			return $this->db->query($sql);
		}

		public function validate_applicant_email($email){ // validate the applicant's email if exist and get the info
			$sql = "SELECT * FROM imm_users WHERE user_email = ? LIMIT 1";
			$data = array($email);
			return $this->db->query($sql, $data);
		}

		public function upload_requirement($requirement, $application_ref,$requirement_id){

			$sql = "INSERT INTO `imm_application_requirements_log`(`application_reference_no`, `uploaded_requirement`,`requirement_id`, `date_created`, `date_updated`) VALUES (?, ?, ?, ?,?)";
				$data = array($application_ref, $requirement,$requirement_id, todaytime(), todaytime() );

				$this->db->query($sql, $data);
		}

		public function upload_document($document, $applicant_email,$document_id,$document_ext){

			$sql = "INSERT INTO `imm_uploaded_docs`(`applicant_email`, `uploaded_doc`,`uploaded_doc_ext`,`document_type_id`, `date_created`, `date_updated`) VALUES (?, ?, ?,?, ?,?)";
				$data = array($applicant_email, $document,$document_ext,$document_id, todaytime(), todaytime() );

				$this->db->query($sql, $data);
		}		

		public function replace_upload_document($document, $applicant_email, $old_uploaded_doc_id,$document_ext){

			$sql = "UPDATE `imm_uploaded_docs` SET `uploaded_doc`= ?,`uploaded_doc_ext`= ?, `date_updated`= ?  WHERE `uploaded_doc_id` = ?";
				$data = array($document, $document_ext,todaytime(), $old_uploaded_doc_id);

				$this->db->query($sql, $data);
		}

		public function schedule_appointment($applicant_no, $app_center, $app_date, $app_time, $reference_no){

			$sql = "INSERT INTO `imm_appointment_log`(`applicant_no`, `center_id`,`appointment_datesched`, `appointment_timesched_id`, `date_created`, `date_updated`, `app_reference_no`) VALUES (?,?,?,?,?,?,?)";
				$data = array($applicant_no, $app_center,$app_date,$app_time, todaytime(), todaytime(), $reference_no );
				$this->db->query($sql, $data);
		}

		public function update_appointment($app_center, $app_date, $app_time, $app_id){

			$sql = "UPDATE `imm_appointment_log` SET `center_id`= ?,`appointment_datesched`= ?,`appointment_timesched_id`= ?,
					`date_updated`= ? WHERE appointment_id = ?";
			$data = array($app_center, $app_date, $app_time, todaytime(), $app_id);
			$query = $this->db->query($sql, $data);
		}

		public function get_position(){
			$sql = "SELECT * FROM imm_position WHERE enabled = 1";
			return $this->db->query($sql);
		}

		public function getBranchManagerInfo($email){
			$sql = "SELECT * FROM imm_branch_admin bad
					LEFT JOIN imm_branch bra ON bra.branch_id = bad.branch_id
					LEFT JOIN imm_users sus ON  bad.branch_admin_email = sus.user_email
					LEFT JOIN imm_position spo ON sus.position_id = spo.position_id 
					WHERE sus.user_email = ? 
					AND sus.enabled = 1
					AND spo.enabled = 1 LIMIT 1";
			$data = array($email);
			return $this->db->query($sql, $data);
		}

		public function getInfoAccountsUsingID($user_id){
			$sql = "SELECT * FROM imm_users us 
					LEFT JOIN imm_admin ad ON us.user_email = ad.admin_email
					LEFT JOIN imm_branch_admin bad ON us.user_email = bad.branch_admin_email
					LEFT JOIN imm_applicant pl ON us.user_email = pl.email
					LEFT JOIN imm_staff st ON us.user_email = st.staff_email
					LEFT JOIN imm_branch_staff bst ON us.user_email = bst.branch_staff_email
					WHERE us.enabled = 1 AND us.user_id = ?";
			$data = array($user_id);

			return $this->db->query($sql, $data);
		}

		public function getInfoAnnouncementUsingID($announcement_id){
			$sql = "SELECT * FROM imm_announcements ann
					LEFT JOIN imm_users us on ann.posted_by = us.user_id
					LEFT JOIN imm_position pos ON us.position_id = pos.position_id 
					LEFT JOIN imm_admin ad ON ad.admin_email = us.user_email
					LEFT JOIN imm_branch_admin bad ON bad.branch_admin_email = us.user_email
					WHERE ann.announcement_id = ? AND ann.enabled = 1";
			$data = array($announcement_id);

			return $this->db->query($sql, $data);
		}

		public function getInfoBranchUsingID($branch_id){
			$sql = "SELECT * FROM imm_branch br 
					LEFT JOIN imm_branch_admin bad ON br.branch_id = bad.branch_admin_assigned_branch_id
					WHERE br.enabled = 1 AND br.branch_id = ?";
			$data = array($branch_id);

			return $this->db->query($sql, $data);
		}

		public function getInfoHolidayUsingID($holiday_id){
			$sql = "SELECT * FROM imm_holiday hol 
					WHERE hol.enabled = 1 AND hol.holiday_id = ?";
			$data = array($holiday_id);

			return $this->db->query($sql, $data);
		}

		public function getInfoCountryUsingID($country_id){
			$sql = "SELECT * FROM imm_country ctry
					WHERE ctry.enabled = 1 AND ctry.country_id = ?";
			$data = array($country_id);

			return $this->db->query($sql, $data);
		}

		public function getInfoSchedLimitUsingID($sched_limit_id){
			$sql = "SELECT * FROM imm_schedule_limit sl
					LEFT JOIN imm_branch bra on sl.sched_limit_branch_id = bra.branch_id
					WHERE sl.enabled = 1 AND sl.sched_limit_id = ?";
			$data = array($sched_limit_id);

			return $this->db->query($sql, $data);
		}

		public function getInfoSchedLimitUsingBranchID($sched_limit_branch_id){
			$sql = "SELECT * FROM imm_schedule_limit sl
					LEFT JOIN imm_branch bra on sl.sched_limit_branch_id = bra.branch_id
					WHERE sl.enabled = 1 AND sl.sched_limit_branch_id = ?";
			$data = array($sched_limit_branch_id);

			return $this->db->query($sql, $data);
		}

		public function getInfoSchedLimitUsingBranchIDExceptThisId($sched_limit_branch_id, $sched_limit_id){
			$sql = "SELECT * FROM imm_schedule_limit sl
					LEFT JOIN imm_branch bra on sl.sched_limit_branch_id = bra.branch_id
					WHERE sl.enabled = 1 AND sl.sched_limit_branch_id = ? AND sl.sched_limit_id != ? ";
			$data = array($sched_limit_branch_id,$sched_limit_id);

			return $this->db->query($sql, $data);
		}

		// public function getInfoTransactionApplicationUsingID($application_id){

		// 	$sql = "SELECT * FROM imm_application_log apl
		// 			LEFT JOIN imm_application_type apt ON apl.application_type_id = apt.application_id
		// 			LEFT JOIN imm_application_requirements_log aprl ON aprl.application_reference_no = apl.reference_no
		// 			LEFT JOIN imm_application_requirements_type aprt ON aprt.requirement_id = aprl.requirement_id
		// 			LEFT JOIN imm_appointment_status aps ON apl.application_status = aps.status_id
		// 			WHERE apl.id = ? AND apl.enabled = 1";

		// 	$data = array($application_id);

		// 	return $this->db->query($sql, $data);

		// }

		public function getInfoTransactionApplicationUsingID($application_id){

			$sql = "SELECT * FROM imm_application_log apl
					LEFT JOIN imm_applicants app on app.email = apl.applicant_email
					LEFT JOIN imm_application_type apt ON apl.application_type_id = apt.application_id
					LEFT JOIN imm_uploaded_docs upd ON upd.applicant_email = apl.applicant_email
					LEFT JOIN imm_application_requirements_type aprt ON aprt.requirement_id = upd.document_type_id
					LEFT JOIN imm_appointment_status aps ON apl.application_status = aps.status_id
					WHERE apl.id = ? AND apl.enabled = 1";

			$data = array($application_id);

			return $this->db->query($sql, $data);

		}

		public function getInfoTransactionAppointmentUsingID($appointment_id){
			
			$sql = "SELECT * FROM imm_appointment_log apl
					LEFT JOIN imm_appointment_timesched apt ON apl.appointment_timesched_id = apt.id
					LEFT JOIN imm_applicants app ON app.applicant_no = apl.applicant_no
					-- LEFT JOIN imm_appointment_status aps ON apl.appointment_status_id = aps.status_id
					LEFT JOIN imm_branch bra ON apl.center_id = bra.branch_id
					WHERE apl.appointment_id = ? and apl.enabled = 1";

			$data = array($appointment_id);
			return $this->db->query($sql, $data);

		}

		public function getInfoApplicationUsingID($app_id){
			$sql = "SELECT * FROM imm_application_type 
					WHERE enabled = 1 AND application_id = ?";
			$data = array($app_id);

			return $this->db->query($sql, $data);
		}

		public function getInfoRescheduleFeeUsingID($resched_id){
			$sql = "SELECT * FROM imm_reschedule_fee 
					WHERE enabled = 1 AND resched_id = ?";
			$data = array($resched_id);

			return $this->db->query($sql, $data);
		}

		public function getInfoRequirementUsingID($req_id){
			$sql = "SELECT * FROM imm_application_requirements_type 
					WHERE enabled = 1 AND requirement_id = ?";
			$data = array($req_id);

			return $this->db->query($sql, $data);
		}

		public function settings_accounts_table(){
			// storing  request (ie, get/post) global array to a variable  
			$requestData= $_REQUEST;

			$columns = array( 
				// datatable column index  => database column name for sorting
					0 => 'pos.position',
					1 => 'CONCAT(ad.admin_first_name, ad.admin_middle_name, ad.admin_last_name), CONCAT(bad.branch_admin_first_name, bad.branch_admin_middle_name, bad.branch_admin_last_name), CONCAT(bst.branch_staff_first_name, bst.branch_staff_middle_name, bst.branch_staff_last_name), CONCAT(st.staff_first_name, st.staff_middle_name, st.staff_last_name)',
					2 => 'ad.admin_contact_num , bad.branch_admin_contact_num, st.staff_contact_num, bst.branch_staff_contact_num',
					3 => 'us.user_email'
				);

			// getting total number records without any search
			$sql = "SELECT * FROM imm_users us
					LEFT JOIN imm_admin ad ON us.user_email = ad.admin_email
					LEFT JOIN imm_branch_admin bad ON us.user_email = bad.branch_admin_email
					LEFT JOIN imm_position pos ON us.position_id = pos.position_id 
					LEFT JOIN imm_staff st ON us.user_email = st.staff_email
					LEFT JOIN imm_branch_staff bst ON us.user_email = bst.branch_staff_email
					WHERE us.enabled = 1 AND us.position_id != 2 ";
			$query = $this->db->query($sql);
			$totalData = $query->num_rows();
			$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

			$sql = "SELECT * FROM imm_users us
					LEFT JOIN imm_admin ad ON us.user_email = ad.admin_email
					LEFT JOIN imm_branch_admin bad ON us.user_email = bad.branch_admin_email
					LEFT JOIN imm_position pos ON us.position_id = pos.position_id 
					LEFT JOIN imm_staff st ON us.user_email = st.staff_email
					LEFT JOIN imm_branch_staff bst ON us.user_email = bst.branch_staff_email
					WHERE us.enabled = 1 AND us.position_id != 2 ";

			// getting records as per search parameters
			if( !empty($requestData['columns'][0]['search']['value']) ){  //position
				$sql.=" AND us.position_id = '".preg_replace('/\s+/', '', $requestData['columns'][0]['search']['value'])."' ";
			}

			if ($requestData['columns'][0]['search']['value'] == 1) { // if admin then change the value for admin
				
				if( !empty($requestData['columns'][1]['search']['value']) ){   //name
					$sql.=" AND CONCAT(ad.admin_first_name, ad.admin_middle_name, ad.admin_last_name) LIKE '%".str_replace(' ', '', sanitize($requestData['columns'][1]['search']['value']))."%' ";
				}
				if( !empty($requestData['columns'][2]['search']['value']) ){  //contact
					$sql.=" AND ad.admin_contact_num LIKE '%".preg_replace('/\s+/', '', sanitize($requestData['columns'][2]['search']['value']))."%' ";
				}
				if( !empty($requestData['columns'][3]['search']['value']) ){ //email address
					$sql.=" AND us.user_email LIKE '%".preg_replace('/\s+/', '', sanitize($requestData['columns'][3]['search']['value']))."%' ";
				}

			}

			else if($requestData['columns'][0]['search']['value'] == 3){ // if branch admin then same in above

				if( !empty($requestData['columns'][1]['search']['value']) ){   //name
					$sql.=" AND CONCAT(bad.branch_admin_first_name, bad.branch_admin_middle_name, bad.branch_admin_last_name) LIKE '%".str_replace(' ', '', sanitize($requestData['columns'][1]['search']['value']))."%' ";
				}
				if( !empty($requestData['columns'][2]['search']['value']) ){  //contact
					$sql.=" AND bad.branch_admin_contact_num LIKE '%".preg_replace('/\s+/', '', sanitize($requestData['columns'][2]['search']['value']))."%' ";
				}
				if( !empty($requestData['columns'][3]['search']['value']) ){ //email address
					$sql.=" AND us.user_email LIKE '%".preg_replace('/\s+/', '', sanitize($requestData['columns'][3]['search']['value']))."%' ";
				}
			}else if($requestData['columns'][0]['search']['value'] == 4){ // if admin staff then same in above

				if( !empty($requestData['columns'][1]['search']['value']) ){   //name
					$sql.=" AND CONCAT(st.staff_first_name, st.staff_middle_name, st.staff_last_name) LIKE '%".str_replace(' ', '', sanitize($requestData['columns'][1]['search']['value']))."%' ";
				}
				if( !empty($requestData['columns'][2]['search']['value']) ){  //contact
					$sql.=" AND st.staff_contact_num LIKE '%".preg_replace('/\s+/', '', sanitize($requestData['columns'][2]['search']['value']))."%' ";
				}
				if( !empty($requestData['columns'][3]['search']['value']) ){ //email address
					$sql.=" AND us.user_email LIKE '%".preg_replace('/\s+/', '', sanitize($requestData['columns'][3]['search']['value']))."%' ";
				}
			}else if($requestData['columns'][0]['search']['value'] == 5){ // if branch admin staff then same in above

				if( !empty($requestData['columns'][1]['search']['value']) ){   //name
					$sql.=" AND CONCAT(bst.branch_staff_first_name, bst.branch_staff_middle_name, bst.branch_staff_last_name) LIKE '%".str_replace(' ', '', sanitize($requestData['columns'][1]['search']['value']))."%' ";
				}
				if( !empty($requestData['columns'][2]['search']['value']) ){  //contact
					$sql.=" AND bst.branch_staff_contact_num LIKE '%".preg_replace('/\s+/', '', sanitize($requestData['columns'][2]['search']['value']))."%' ";
				}
				if( !empty($requestData['columns'][3]['search']['value']) ){ //email address
					$sql.=" AND us.user_email LIKE '%".preg_replace('/\s+/', '', sanitize($requestData['columns'][3]['search']['value']))."%' ";
				}
			}    


			$query = $this->db->query($sql);
			$totalFiltered = $query->num_rows(); // when there is a search parameter then we have to modify total number filtered rows as per search result.
		
			$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";  // adding length
			
			$query = $this->db->query($sql);
			$data = array();

			foreach( $query->result_array() as $row ) {  // preparing an array for table tbody
				$nestedData=array(); 
				if ($row["position_id"] == 1) {
					$nestedData[] = $row["position"];
					$nestedData[] = $row["admin_first_name"].' '.$row["admin_middle_name"].' '.$row["admin_last_name"];
					$nestedData[] = $row["admin_contact_num"];
					$nestedData[] = $row["admin_email"];
					$nestedData[] = '<button data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="" class="btn btn-success btnView btnTable" name="update" data-value="'.$row['user_id'].'" id="'.$row['user_id'].'"><i class="fa fa-search"></i> View</button>  <button disabled class="btn btn-danger btnDelete btnTable" name="update" data-value="'.$row['user_id'].'" id="'.$row['user_id'].'"><i class="fa fa-trash-o"></i> Delete</button>';
					$data[] = $nestedData;
				}
				else if ($row["position_id"] == 3) { // branch_admih
					$nestedData[] = $row["position"];
					$nestedData[] = $row["branch_admin_first_name"].' '.$row["branch_admin_middle_name"].' '.$row["branch_admin_last_name"];
					$nestedData[] = $row["branch_admin_contact_num"];
					$nestedData[] = $row["branch_admin_email"];
					$nestedData[] = '<button data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="" class="btn btn-success btnView btnTable" name="update" data-value="'.$row['user_id'].'" id="'.$row['user_id'].'"><i class="fa fa-search"></i> View</button>  <button class="btn btn-danger btnDelete btnTable" name="update" data-value="'.$row['user_id'].'" id="'.$row['user_id'].'"><i class="fa fa-trash-o"></i> Delete</button>';
					$data[] = $nestedData;
				}else if ($row["position_id"] == 4) { // staff
					$nestedData[] = $row["position"];
					$nestedData[] = $row["staff_first_name"].' '.$row["staff_middle_name"].' '.$row["staff_last_name"];
					$nestedData[] = $row["staff_contact_num"];
					$nestedData[] = $row["staff_email"];
					$nestedData[] = '<button data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="" class="btn btn-success btnView btnTable" name="update" data-value="'.$row['user_id'].'" id="'.$row['user_id'].'"><i class="fa fa-search"></i> View</button>  <button class="btn btn-danger btnDelete btnTable" name="update" data-value="'.$row['user_id'].'" id="'.$row['user_id'].'"><i class="fa fa-trash-o"></i> Delete</button>';
					$data[] = $nestedData;
				}else if ($row["position_id"] == 5) { // branch staff
					$nestedData[] = $row["position"];
					$nestedData[] = $row["branch_staff_first_name"].' '.$row["branch_staff_middle_name"].' '.$row["branch_staff_last_name"];
					$nestedData[] = $row["branch_staff_contact_num"];
					$nestedData[] = $row["branch_staff_email"];
					$nestedData[] = '<button data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="" class="btn btn-success btnView btnTable" name="update" data-value="'.$row['user_id'].'" id="'.$row['user_id'].'"><i class="fa fa-search"></i> View</button>  <button class="btn btn-danger btnDelete btnTable" name="update" data-value="'.$row['user_id'].'" id="'.$row['user_id'].'"><i class="fa fa-trash-o"></i> Delete</button>';
					$data[] = $nestedData;
				}

				
			}

			$json_data = array(
				
				"recordsTotal"    => intval( $totalData ),  // total number of records
				"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
				"data"            => $data   // total data array
			);
			return $json_data;
		}

		public function settings_branch_admin_accounts_table($branch_id){
			// storing  request (ie, get/post) global array to a variable  
			$requestData= $_REQUEST;

			$columns = array( 
				// datatable column index  => database column name for sorting
					0 => 'position',
					1 => 'CONCAT(bst.branch_staff_first_name, bst.branch_staff_middle_name, bst.branch_staff_last_name), CONCAT(bad.branch_admin_first_name, bad.branch_admin_middle_name, bad.branch_admin_last_name)',
					2 => 'bad.branch_admin_contact_num, bst.branch_staff_contact_num',
					3 => 'us.user_email'
				);

			// getting total number records without any search
			$sql = "SELECT * FROM imm_users us
					LEFT JOIN imm_branch_admin bad ON us.user_email = bad.branch_admin_email
					LEFT JOIN imm_branch_staff bst ON us.user_email = bst.branch_staff_email
					LEFT JOIN imm_position pos ON us.position_id = pos.position_id 
					WHERE us.position_id IN (5,3) AND bad.branch_admin_assigned_branch_id = $branch_id OR bst.assigned_branch_id = $branch_id AND us.enabled = 1;";
			$query = $this->db->query($sql);
			$totalData = $query->num_rows();
			$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

			$sql = "SELECT * FROM imm_users us
					LEFT JOIN imm_branch_admin bad ON us.user_email = bad.branch_admin_email
					LEFT JOIN imm_branch_staff bst ON us.user_email = bst.branch_staff_email
					LEFT JOIN imm_position pos ON us.position_id = pos.position_id 
					WHERE us.position_id IN (5,3) AND bad.branch_admin_assigned_branch_id = $branch_id OR bst.assigned_branch_id = $branch_id AND us.enabled = 1;";

			// getting records as per search parameters
			if( !empty($requestData['columns'][0]['search']['value']) ){  //position
				$sql.=" AND us.position_id = '".preg_replace('/\s+/', '', $requestData['columns'][0]['search']['value'])."' ";
			}

			if  ($requestData['columns'][0]['search']['value'] == 3){ // if branch admin

				if( !empty($requestData['columns'][1]['search']['value']) ){   //name
					$sql.=" AND CONCAT(bad.branch_admin_first_name, bad.branch_admin_middle_name, bad.branch_admin_last_name) LIKE '%".str_replace(' ', '', sanitize($requestData['columns'][1]['search']['value']))."%' ";
				}
				if( !empty($requestData['columns'][2]['search']['value']) ){  //contact
					$sql.=" AND bad.branch_admin_contact_num LIKE '%".preg_replace('/\s+/', '', sanitize($requestData['columns'][2]['search']['value']))."%' ";
				}
				if( !empty($requestData['columns'][3]['search']['value']) ){ //email address
					$sql.=" AND us.user_email LIKE '%".preg_replace('/\s+/', '', sanitize($requestData['columns'][3]['search']['value']))."%' ";
				}
			}else if($requestData['columns'][0]['search']['value'] == 5){ // if branch admin staff then same in above

				if( !empty($requestData['columns'][1]['search']['value']) ){   //name
					$sql.=" AND CONCAT(bst.branch_staff_first_name, bst.branch_staff_middle_name, bst.branch_staff_last_name) LIKE '%".str_replace(' ', '', sanitize($requestData['columns'][1]['search']['value']))."%' ";
				}
				if( !empty($requestData['columns'][2]['search']['value']) ){  //contact
					$sql.=" AND bst.branch_staff_contact_num LIKE '%".preg_replace('/\s+/', '', sanitize($requestData['columns'][2]['search']['value']))."%' ";
				}
				if( !empty($requestData['columns'][3]['search']['value']) ){ //email address
					$sql.=" AND us.user_email LIKE '%".preg_replace('/\s+/', '', sanitize($requestData['columns'][3]['search']['value']))."%' ";
				}
			}    


			$query = $this->db->query($sql);
			$totalFiltered = $query->num_rows(); // when there is a search parameter then we have to modify total number filtered rows as per search result.

			$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";  // adding length
			// print_r($sql);
			// die();
			
			$query = $this->db->query($sql);


			$data = array();
			foreach( $query->result_array() as $row ) {  // preparing an array for table tbody
				$nestedData=array(); 
				if  ($row["position_id"] == 3 && $row["branch_admin_assigned_branch_id"]  == $branch_id) { // branch_admin
					$nestedData[] = $row["position"];
					$nestedData[] = $row["branch_admin_first_name"].' '.$row["branch_admin_middle_name"].' '.$row["branch_admin_last_name"];
					$nestedData[] = $row["branch_admin_contact_num"];
					$nestedData[] = $row["branch_admin_email"];
					$nestedData[] = '<button data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="" class="btn btn-success btnView btnTable" name="update" data-value="'.$row['user_id'].'" id="'.$row['user_id'].'"><i class="fa fa-search"></i> View</button>  <button class="btn btn-danger btnDelete btnTable" name="update" data-value="'.$row['user_id'].'" id="'.$row['user_id'].'"><i class="fa fa-trash-o"></i> Delete</button>';
					$data[] = $nestedData;
				}else if ($row["position_id"] == 5 && $row["assigned_branch_id"]  == $branch_id) { // branch staff
					$nestedData[] = $row["position"];
					$nestedData[] = $row["branch_staff_first_name"].' '.$row["branch_staff_middle_name"].' '.$row["branch_staff_last_name"];
					$nestedData[] = $row["branch_staff_contact_num"];
					$nestedData[] = $row["branch_staff_email"];
					$nestedData[] = '<button data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="" class="btn btn-success btnView btnTable" name="update" data-value="'.$row['user_id'].'" id="'.$row['user_id'].'"><i class="fa fa-search"></i> View</button>  <button class="btn btn-danger btnDelete btnTable" name="update" data-value="'.$row['user_id'].'" id="'.$row['user_id'].'"><i class="fa fa-trash-o"></i> Delete</button>';
					$data[] = $nestedData;
				}	
			}

			$json_data = array(
				
				"recordsTotal"    => intval( $totalData ),  // total number of records
				"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
				"data"            => $data   // total data array
			);

			return $json_data;
		}

		public function settings_applicants_table(){
			// storing  request (ie, get/post) global array to a variable  
			$requestData= $_REQUEST;

			$columns = array( 
				// datatable column index  => database column name for sorting
					0 => 'CONCAT(app.first_name, app.middle_name, app.last_name, app.ext_name)',
					1 => 'app.icard_no',
					2 => 'app.mobile_num',
					3 => 'app.email',
					4 => 'cty.country',
				);

			// getting total number records without any search
			$sql = "SELECT * FROM imm_applicant app
					LEFT JOIN  imm_users us ON us.user_email = app.email
					LEFT JOIN imm_country cty ON app.country_id = cty.country_id
					WHERE us.enabled = 1";
			$query = $this->db->query($sql);
			$totalData = $query->num_rows();
			$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

			$sql = "SELECT * FROM imm_applicant app
					LEFT JOIN  imm_users us ON us.user_email = app.email
					LEFT JOIN imm_country cty ON app.country_id = cty.country_id
					WHERE us.enabled = 1";

			// getting records as per search parameters
			
			if( $requestData['columns'][1]['search']['value'] != ""){   //name
				$sql.=" AND CONCAT(app.first_name, app.middle_name, app.last_name) LIKE '%".str_replace(' ', '', sanitize($requestData['columns'][1]['search']['value']))."%' ";
			}
			if( $requestData['columns'][2]['search']['value'] != "" ){  //country
				$sql.=" AND cty.country LIKE '%".preg_replace('/\s+/', '', sanitize($requestData['columns'][2]['search']['value']))."%' ";
			}
			if( $requestData['columns'][3]['search']['value'] != "" ){ //email address
				$sql.=" AND us.user_email LIKE '%".preg_replace('/\s+/', '',sanitize($requestData['columns'][3]['search']['value']))."%' ";
			}
			
			$query = $this->db->query($sql);
			$totalFiltered = $query->num_rows(); // when there is a search parameter then we have to modify total number filtered rows as per search result.

			$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";  // adding length

			// print_r($sql);
			// die();
			$query = $this->db->query($sql);
			// print_r($sql);
			// die();

			$data = array();
			foreach( $query->result_array() as $row ) {  // preparing an array for table tbody
				$nestedData=array(); 
				$nestedData[] = $row["first_name"].' '.$row["middle_name"].' '.$row["last_name"] .' '.$row["ext_name"];
				$nestedData[] = $row["icard_no"];
				$nestedData[] = $row["mobile_num"];
				$nestedData[] = $row["email"];
				$nestedData[] = $row["country"];
				$nestedData[] = '<button data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="" class="btn btn-success btnView btnTable" name="update" data-value="'.$row['applicant_id'].'" id="'.$row['applicant_id'].'"><i class="fa fa-search"></i> View</button>';
					$data[] = $nestedData;
				
			}

			$json_data = array(
				
				"recordsTotal"    => intval( $totalData ),  // total number of records
				"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
				"data"            => $data   // total data array
			);

			return $json_data;
		}

		public function settings_branch_table(){
			// storing  request (ie, get/post) global array to a variable  
			$requestData= $_REQUEST;

			$columns = array( 
				// datatable column index  => database column name for sorting
					0 => 'br.branch_id',
					1 => 'br.branch_name',
					2 => 'br.branch_code',
					3 => 'br.branch_address',
				);

			// getting total number records without any search
			$sql = "SELECT * FROM imm_branch br
					WHERE enabled = 1";
			$query = $this->db->query($sql);
			$totalData = $query->num_rows();
			$totalFiltered = $query->num_rows(); // when there is a search parameter then we have to modify total number filtered rows as per search result.

			$sql = "SELECT * FROM imm_branch br
					WHERE enabled = 1";

			
			$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
			$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";  // adding length
			$query = $this->db->query($sql);

			$data = array();
			foreach( $query->result_array() as $row ) {  // preparing an array for table tbody
				$nestedData=array(); 
				
					$nestedData[] = $row["branch_id"];
					$nestedData[] = $row["branch_name"];
					$nestedData[] = $row["branch_code"];
					$nestedData[] = $row["branch_address"];
					$nestedData[] = '<button data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="" class="btn btn-success btnView btnTable" name="update" data-value="'.$row['branch_id'].'" id="'.$row['branch_id'].'"><i class="fa fa-search"></i> View</button> <button class="btn btn-danger btnDelete btnTable" name="update" data-value="'.$row['branch_id'].'" id="'.$row['branch_id'].'"><i class="fa fa-trash-o"></i> Delete</button>';
					$data[] = $nestedData;
			}

			$json_data = array(
				
				"recordsTotal"    => intval( $totalData ),  // total number of records
				"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
				"data"            => $data   // total data array
			);

			return $json_data;
		}


		public function settings_applications_table(){
			// storing  request (ie, get/post) global array to a variable  
			$requestData= $_REQUEST;

			$columns = array( 
				// datatable column index  => database column name for sorting
					0 => 'at.application_id',
					1 => 'at.description',
					// 2 => 'at.bid_fee',
					// 3 => 'at.process_fee',
				);

			// getting total number records without any search
			$sql = "SELECT * FROM imm_application_type at
					WHERE enabled = 1";
			$query = $this->db->query($sql);
			$totalData = $query->num_rows();
			$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

			$sql = "SELECT * FROM imm_application_type at
					WHERE enabled = 1";

			$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
			$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";  // adding length
			$query = $this->db->query($sql);

			$data = array();
			foreach( $query->result_array() as $row ) {  // preparing an array for table tbody
				$nestedData=array(); 
				
					$nestedData[] = $row["application_id"];
					$nestedData[] = $row["description"];
					// $nestedData[] = "₱ ". number_format($row["application_fee"],2);
					// $nestedData[] = "₱ ". number_format($row["convenience_fee"],2);
					$nestedData[] = '<button data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="" class="btn btn-success btnView btnTable" name="update" data-value="'.$row['application_id'].'" id="'.$row['application_id'].'"><i class="fa fa-search"></i> View</button> <button class="btn btn-danger btnDelete btnTable" name="update" data-value="'.$row['application_id'].'" id="'.$row['application_id'].'"><i class="fa fa-trash-o"></i> Delete</button>';
					$data[] = $nestedData;
			}

			$json_data = array(
				
				"recordsTotal"    => intval( $totalData ),  // total number of records
				"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
				"data"            => $data   // total data array
			);

			return $json_data;
		}

		public function settings_applications_table2(){
			// storing  request (ie, get/post) global array to a variable  
			$requestData= $_REQUEST;
			$columns = array( 
				// datatable column index  => database column name for sorting
					0 => 'aprt.requirement_id',
					1 => 'aprt.requirement_description',
				);

			// getting total number records without any search
			$sql = "SELECT * FROM imm_application_requirements_type aprt
					WHERE enabled = 1";
			$query = $this->db->query($sql);
			$totalData = $query->num_rows();
			$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

			$sql = "SELECT * FROM imm_application_requirements_type aprt
					WHERE enabled = 1";
			$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
			$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";  // adding length
			$query = $this->db->query($sql);
			$data = array();
			foreach( $query->result_array() as $row ) {  // preparing an array for table tbody
				$nestedData=array(); 
				
					$nestedData[] = $row["requirement_id"];
					$nestedData[] = $row["requirement_description"];
					$nestedData[] = '<button data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#viewRequirementModal" class="btn btn-success btnView2 btnTable" name="update" data-value="'.$row['requirement_id'].'" id="'.$row['requirement_id'].'"><i class="fa fa-search"></i> View</button> <button class="btn btn-danger btnDelete2 btnTable" name="update" data-value="'.$row['requirement_id'].'" id="'.$row['requirement_id'].'"><i class="fa fa-trash-o"></i> Delete</button>';
					$data[] = $nestedData;
			}

			$json_data = array(
				
				"recordsTotal"    => intval( $totalData ),  // total number of records
				"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
				"data"            => $data   // total data array
			);

			return $json_data;
		}

		public function settings_reschedule_table(){
			// storing  request (ie, get/post) global array to a variable  
			$requestData= $_REQUEST;
			$columns = array( 
				// datatable column index  => database column name for sorting
					0 => 're.resched_limit',
					1 => 're.resched_fee',
				);

			// getting total number records without any search
			$sql = "SELECT * FROM imm_reschedule_fee re
					WHERE re.enabled = 1";
			$query = $this->db->query($sql);
			$totalData = $query->num_rows();
			$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

			$sql = "SELECT * FROM imm_reschedule_fee re
					WHERE re.enabled = 1";

			$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
			$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";  // adding length
			$query = $this->db->query($sql);

			$data = array();
			foreach( $query->result_array() as $row ) {  // preparing an array for table tbody
				$nestedData=array(); 
				
					$nestedData[] = $row["resched_limit"];
					$nestedData[] = "₱ ". number_format($row["resched_fee"],2);
					$nestedData[] = '<button data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="" class="btn btn-success btnView btnTable" name="update" data-value="'.$row['resched_id'].'" id="'.$row['resched_id'].'"><i class="fa fa-search"></i> View</button> <button class="btn btn-danger btnDelete btnTable" name="update" data-value="'.$row['resched_id'].'" id="'.$row['resched_id'].'"><i class="fa fa-trash-o"></i> Delete</button><input hidden type="text" class="table_count" value="'.$row['resched_id'].'">';
					$data[] = $nestedData;
			}

			$json_data = array(
				
				"recordsTotal"    => intval( $totalData ),  // total number of records
				"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
				"data"            => $data   // total data array
			);

			return $json_data;
		}

		public function transactions_application_table(){
			// storing  request (ie, get/post) global array to a variable  
			$requestData= $_REQUEST;

			$columns = array( 
				// datatable column index  => database column name for sorting
					0 => 'apl.applicant_email',
					1 => 'apl.reference_no',
					2 => 'at.branch_name',
					3 => 'apl.appointment_date',
					4 => 'ats.timesched_description',
					5 => 'apl.payment_status',
					6 => 'apt.description',
				);

			// getting total number records without any search
			$sql = "SELECT * FROM imm_application_log apl
				LEFT JOIN imm_application_type apt ON apl.application_type_id = apt.application_id
				LEFT JOIN imm_appointment_timesched ats ON apl.app_branch_time = ats.id
				LEFT JOIN imm_branch at ON apl.app_branch_id = at.branch_id
		 		WHERE  apl.enabled = 1";

			$query = $this->db->query($sql);
			$totalData = $query->num_rows();
			$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
			$today90 = date('Y-m-d', strtotime("+90 days"));

			if (empty($requestData['columns'][0]['search']['value'] == '') || $requestData['columns'][0]['search']['value'] == '' || $requestData['columns'][0]['search']['value'] == null) {

				$sql = "SELECT * FROM imm_application_log apl
					LEFT JOIN imm_application_type apt ON apl.application_type_id = apt.application_id
					LEFT JOIN imm_appointment_timesched ats ON apl.app_branch_time = ats.id
					LEFT JOIN imm_branch at ON apl.app_branch_id = at.branch_id
			 		WHERE  apl.enabled = 1";

				$sql.= " AND apl.appointment_date BETWEEN '". today(). "' AND '" .today() . "'" ;
			} else{

			}

			// getting records as per search parameters
			if( !empty($requestData['columns'][0]['search']['value']) ){  //Date Created

				$sql = "SELECT * FROM imm_application_log apl
					LEFT JOIN imm_application_type apt ON apl.application_type_id = apt.application_id
					LEFT JOIN imm_appointment_timesched ats ON apl.app_branch_time = ats.id
					LEFT JOIN imm_branch at ON apl.app_branch_id = at.branch_id
			 		WHERE  apl.enabled = 1";

				$fDate = date_format(date_create($requestData['columns'][0]['search']['value']),"Y-m-d");

				if( !empty($requestData['columns'][1]['search']['value']) ){
					$tDate = date_format(date_create($requestData['columns'][1]['search']['value']),"Y-m-d");
				}else{
					$tDate = $today90;
				}

				$sql.= " AND apl.appointment_date BETWEEN '". $fDate. "' AND '" .$tDate ."'" ;
			
			}

			if(!empty($requestData['columns'][2]['search']['value'])){ // Application Reference No

				$sql.=" AND apl.reference_no LIKE '%".str_replace(' ', '', sanitize($requestData['columns'][2]['search']['value']))."%'";		
			}

			// if(!empty($requestData['columns'][3]['search']['value'])){ // Application Status

			// 	// $sql.=" AND apl.application_status = ".str_replace(' ', '', sanitize($requestData['columns'][3]['search']['value']));
					
			// }

			$totalFiltered = $query->num_rows(); // when there is a search parameter then we have to modify total number filtered rows as per search result.
			$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";  // adding length

			$query = $this->db->query($sql);
			// print_r($query);
			// die();
			$data = array();
			foreach( $query->result_array() as $row ) {  // preparing an array for table tbody
				$nestedData=array(); 
				
					$nestedData[] = $row["applicant_email"];
					$nestedData[] = $row["reference_no"];
					$nestedData[] = $row["branch_name"];
					$nestedData[] = date_format(date_create($row["appointment_date"]),"m/d/Y");
					$nestedData[] = $row["timesched_description"];
					$nestedData[] = $row["description"];
					$nestedData[] = $row["payment_status"] == 1 ? "Paid" : "Pending Payment";
					$nestedData[] = '<button data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="" class="btn btn-success btnView btnTable" name="update" data-value="'.$row['reference_no'].'" id="'.$row['id'].'"><i class="fa fa-search"></i> View</button>';
					  // <button class="btn btn-danger btnDelete btnTable" name="update" data-value="'.$row['id'].'" id=	"'.$row['id'].'"><i class="fa fa-trash-o"></i> Delete</button>';
					$data[] = $nestedData;
				
			}

			$json_data = array(
				
				"recordsTotal"    => intval( $totalData ),  // total number of records
				"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
				"data"            => $data   // total data array
			);

			return $json_data;
		}

		public function applicant_transactions_application_table($applicant_email){
			// storing  request (ie, get/post) global array to a variable  
			$requestData= $_REQUEST;

			$columns = array( 
				// datatable column index  => database column name for sorting
					0 => 'apl.reference_no',
					1 => 'apl.application_date',
					2 => 'aps.status_description',
					3 => 'apl.application_fee',
					4 => 'apt.description',
					5 => 'aprt.requirement_description'
				);

			// getting total number records without any search
			$sql = "SELECT * FROM imm_application_log apl
					LEFT JOIN imm_application_type apt ON apl.application_type_id = apt.application_id
					LEFT JOIN imm_application_requirements_log aprl ON aprl.application_reference_no = apl.reference_no
					LEFT JOIN imm_application_requirements_type aprt ON aprt.requirement_id = aprl.requirement_id
					LEFT JOIN imm_appointment_status aps ON apl.application_status = aps.status_id
					WHERE apl.applicant_email = ? AND apl.enabled = 1";

			$data2 = array($applicant_email);
			$query = $this->db->query($sql,$data2);
			$totalData = $query->num_rows();
			$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
			$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT 1 "."   ";  // adding length

			$query = $this->db->query($sql,$data2);
			$rows = $query->result_array();
			$data = array();
			$nestedData=array(); 
			foreach($rows as $row){

				$nestedData[] = $row["reference_no"];
				$nestedData[] = $row["application_date"];
				$nestedData[] = $row["status_description"];
				$nestedData[] = "₱ ". number_format($row["application_fee"], 2);
				$nestedData[] = $row["description"];
				$nestedData[] = $row["requirement_description"];
				$nestedData[] = '<button data-toggle="modal" data-backdrop="static" data-keyboard="false" class="btn btn-success btnView btnTable" name="update" data-value="'.$row['id'].'" id="'.$row['id'].'"><i class="fa fa-search"></i> View</button>  <button class="btn btn-danger btnDelete btnTable" name="update" data-value="'.$row['id'].'" id="'.$row['id'].'"><i class="fa fa-trash-o"></i> Delete</button><input hidden type="text" class="table_count" value="'.$row['id'].'">';
				$data[] = $nestedData;
			}

			$json_data = array(
				"recordsTotal"    => intval( $totalData ),  // total number of records
				"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
				"data"            => $data   // total data array
			);

			return $json_data;
		}

		public function transactions_appointment_table(){
			// storing  request (ie, get/post) global array to a variable  
			$requestData= $_REQUEST;
			$columns = array( 
				// datatable column index  => database column name for sorting
					0 => 'apl.app_reference_no',
					1 => 'CONCAT(app.first_name, app.middle_name, app.last_name)',
					2 => 'apl.appointment_datesched',
					3 => 'apt.timesched_description',
					4 => 'bra.branch_code',
				);

			// getting total number records without any search
			$sql = "SELECT * FROM imm_appointment_log apl
					LEFT JOIN imm_branch bra ON apl.center_id = bra.branch_id
					LEFT JOIN imm_applicants app ON app.applicant_no = apl.applicant_no
					-- LEFT JOIN imm_appointment_status aps ON apl.appointment_status_id = aps.status_id
					LEFT JOIN imm_appointment_timesched apt on apl.appointment_timesched_id =  apt.id
					WHERE apl.enabled = 1";

			$query = $this->db->query($sql);
			$totalData = $query->num_rows();
			$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
			$today90 = date('Y-m-d', strtotime("+90 days"));

		
			if (empty($requestData['columns'][0]['search']['value']) || $requestData['columns'][0]['search']['value'] == '' || $requestData['columns'][0]['search']['value'] == null) {

				$sql = "SELECT * FROM imm_appointment_log apl
				LEFT JOIN imm_branch bra ON apl.center_id = bra.branch_id
				LEFT JOIN imm_applicants app ON app.applicant_no = apl.applicant_no
				-- LEFT JOIN imm_appointment_status aps ON apl.appointment_status_id = aps.status_id
				LEFT JOIN imm_appointment_timesched apt on apl.appointment_timesched_id =  apt.id
				WHERE apl.enabled = 1";

				$sql.= " AND apl.appointment_datesched BETWEEN '". today(). "' AND '" .$today90 . "'" ;

			} else{

			}

			if( !empty($requestData['columns'][0]['search']['value']) ){  //Date Created)
				$sql = "SELECT * FROM imm_appointment_log apl
				LEFT JOIN imm_branch bra ON apl.center_id = bra.branch_id
				LEFT JOIN imm_applicants app ON app.applicant_no = apl.applicant_no
				-- LEFT JOIN imm_appointment_status aps ON apl.appointment_status_id = aps.status_id
				LEFT JOIN imm_appointment_timesched apt on apl.appointment_timesched_id =  apt.id
				WHERE apl.enabled = 1";	

				$fDate = date_format(date_create($requestData['columns'][0]['search']['value']),"Y-m-d");

				if( !empty($requestData['columns'][1]['search']['value']) ){
					$tDate = date_format(date_create($requestData['columns'][1]['search']['value']),"Y-m-d");
				}else{
					$tDate = $today90;
				}
			
				$sql.= " AND apl.appointment_datesched BETWEEN '". $fDate. "' AND '" .$tDate . "'" ;
			}
				
			if(!empty($requestData['columns'][2]['search']['value'])){ // Branche Code

					$sql.=" AND apl.center_id  = ".str_replace(' ', '', sanitize($requestData['columns'][2]['search']['value']));
					//$query = $this->db->query($sql);
		
			}

			if(!empty($requestData['columns'][3]['search']['value'])){ // Applicant Name

					$sql.=" AND CONCAT(app.first_name, app.middle_name, app.last_name) LIKE '%".str_replace(' ', '', sanitize($requestData['columns'][3]['search']['value']))."%'";
					//$query = $this->db->query($sql);
			}	

			if(!empty($requestData['columns'][4]['search']['value'])){ // Reference Name

					$sql.=" AND apl.app_reference_no LIKE '%".str_replace(' ', '', sanitize($requestData['columns'][4]['search']['value']))."%'";
					//$query = $this->db->query($sql);
			}

			$totalFiltered = $query->num_rows(); // when there is a search parameter then we have to modify total number filtered rows as per search result.
			$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";  // adding length

			$query = $this->db->query($sql);
			// print_r($query);
			// die();

			$data = array();
			foreach( $query->result_array() as $row ) {  // preparing an array for table tbody
				$nestedData=array(); 
				
					$nestedData[] = $row["app_reference_no"];
					$nestedData[] = $row["first_name"] . " " .$row["middle_name"] . " ". $row["last_name"] ;
					$nestedData[] = $row["appointment_datesched"];
					$nestedData[] = $row["timesched_description"];
					$nestedData[] = $row["branch_code"];
					$nestedData[] = '<button data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="" class="btn btn-success btnView btnTable" name="update" data-value="'.$row['appointment_id'].'" appointment_id="'.$row['appointment_id'].'"><i class="fa fa-search"></i> View</button> ';
					$data[] = $nestedData;
				
			}

			$json_data = array(
				
				"recordsTotal"    => intval( $totalData ),  // total number of records
				"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
				"data"            => $data   // total data array
			);

			return $json_data;
		}

		public function branch_admin_transactions_appointment_table($branch_id){
			// storing  request (ie, get/post) global array to a variable  
			$requestData= $_REQUEST;
			$columns = array( 
				// datatable column index  => database column name for sorting
					0 => 'apl.applicant_no',
					1 => 'CONCAT(app.first_name, app.middle_name, app.last_name)',
					2 => 'apl.appointment_datesched',
					3 => 'apt.timesched_description',
					4 => 'bra.branch_code',
					5 => 'aps.status_description'
				);

			// getting total number records without any search
			$sql = "SELECT * FROM imm_appointment_log apl
					LEFT JOIN imm_branch bra ON apl.center_id = bra.branch_id
					LEFT JOIN imm_applicants app ON app.applicant_no = apl.applicant_no
					LEFT JOIN imm_appointment_timesched apt on apl.appointment_timesched_id =  apt.id
					WHERE apl.enabled = 1 AND apl.center_id = $branch_id";

			$query = $this->db->query($sql);
			$totalData = $query->num_rows();
			$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
			$today90 = date('Y-m-d', strtotime("+90 days"));

		
			if (empty($requestData['columns'][0]['search']['value']) || $requestData['columns'][0]['search']['value'] == '' || $requestData['columns'][0]['search']['value'] == null) {

				$sql = "SELECT * FROM imm_appointment_log apl
				LEFT JOIN imm_branch bra ON apl.center_id = bra.branch_id
				LEFT JOIN imm_applicants app ON app.applicant_no = apl.applicant_no
				LEFT JOIN imm_appointment_timesched apt on apl.appointment_timesched_id =  apt.id
				WHERE apl.enabled = 1 AND apl.center_id = $branch_id";

				$sql.= " AND apl.appointment_datesched BETWEEN '". today(). "' AND '" .$today90 . "'" ;

			}else{
				$sql = "SELECT * FROM imm_appointment_log apl
				LEFT JOIN imm_branch bra ON apl.center_id = bra.branch_id
				LEFT JOIN imm_applicants app ON app.applicant_no = apl.applicant_no
				LEFT JOIN imm_appointment_timesched apt on apl.appointment_timesched_id =  apt.id
				WHERE apl.enabled = 1 AND apl.center_id = $branch_id";
				$fDate = date_format(date_create($requestData['columns'][0]['search']['value']),"Y-m-d");

				if( !empty($requestData['columns'][1]['search']['value']) ){
					$tDate = date_format(date_create($requestData['columns'][1]['search']['value']),"Y-m-d");
				}else{
					$tDate = $today90;
				}

				$sql.= " AND apl.appointment_datesched BETWEEN '". $fDate. "' AND '" .$tDate . "'" ;
			}
				
			if(!empty($requestData['columns'][2]['search']['value'])){ // Reference No

					$sql.=" AND apl.app_reference_no LIKE '%".str_replace(' ', '', sanitize($requestData['columns'][2]['search']['value']))."%'";
					//$query = $this->db->query($sql);
		
			}			

			if(!empty($requestData['columns'][3]['search']['value'])){ // Applicant Name

					$sql.=" AND CONCAT(app.first_name, app.middle_name, app.last_name) LIKE '%".str_replace(' ', '', sanitize($requestData['columns'][3]['search']['value']))."%'";
					//$query = $this->db->query($sql);
		
			}

			$totalFiltered = $query->num_rows(); // when there is a search parameter then we have to modify total number filtered rows as per search result.
			$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";  // adding length

			$query = $this->db->query($sql);
			// print_r($query);
			// die();	

			$data = array();
			foreach( $query->result_array() as $row ) {  // preparing an array for table tbody
				$nestedData=array(); 
				
					$nestedData[] = $row["app_reference_no"];
					$nestedData[] = $row["first_name"] . " " .$row["middle_name"] . " ".$row["last_name"] ;
					$nestedData[] = $row["appointment_datesched"];
					$nestedData[] = $row["timesched_description"];
					$nestedData[] = $row["branch_code"];
					// $nestedData[] = $row["status_description"];
					$nestedData[] = '<button data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="" class="btn btn-success btnView btnTable" name="update" data-value="'.$row['appointment_id'].'" appointment_id="'.$row['appointment_id'].'"><i class="fa fa-search"></i> View</button>  <button class="btn btn-danger btnDelete btnTable" name="update" data-value="'.$row['appointment_id'].'" appointment_id="'.$row['appointment_id'].'"><i class="fa fa-trash-o"></i> Delete</button>';
					$data[] = $nestedData;
				
			}

			$json_data = array(
				
				"recordsTotal"    => intval( $totalData ),  // total number of records
				"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
				"data"            => $data   // total data array
			);

			return $json_data;
		}

		public function settings_announcement_table(){
			// storing  request (ie, get/post) global array to a variable  
			$requestData= $_REQUEST;

			$columns = array( 
				// datatable column index  => database column name for sorting
					0 => 'ann.posted_on',
					1 => 'ann.display_until',
					2 => 'ann.subject',
					3 => 'ann.posted_by'
				);

			// getting total number records without any search
			$sql = "SELECT * FROM imm_announcements ann
					LEFT JOIN imm_users us on ann.posted_by = us.user_id
					LEFT JOIN imm_position pos ON us.position_id = pos.position_id 
					LEFT JOIN imm_admin ad ON ad.admin_email = us.user_email
					LEFT JOIN imm_branch_admin bad On bad.branch_admin_email = us.user_email
					WHERE ann.enabled = 1";
			$query = $this->db->query($sql);
			$totalData = $query->num_rows();
			$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

			$sql = "SELECT * FROM imm_announcements ann
					LEFT JOIN imm_users us on ann.posted_by = us.user_id
					LEFT JOIN imm_position pos ON us.position_id = pos.position_id 
					LEFT JOIN imm_admin ad ON ad.admin_email = us.user_email
					LEFT JOIN imm_branch_admin bad ON bad.branch_admin_email = us.user_email
					WHERE ann.enabled = 1";

			// getting records as per search parameters



			$query = $this->db->query($sql);
			$totalFiltered = $query->num_rows(); // when there is a search parameter then we have to modify total number filtered rows as per search result.

			$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";  // adding length

			$query = $this->db->query($sql);

			$data = array();
			foreach( $query->result_array() as $row ) {  // preparing an array for table tbody
				$nestedData=array(); 
				if ($row["position_id"] == 1) {
					$nestedData[] = date_format(date_create($row["posted_on"]),"m/d/Y");
					$nestedData[] = date_format(date_create($row["display_until"]),"m/d/Y");
					$nestedData[] = $row["subject"];
					$nestedData[] = $row["admin_first_name"].' '.$row["admin_middle_name"].' '.$row["admin_last_name"] .' - Admin ';
					$nestedData[] = '<button data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="" class="btn btn-success btnView btnTable" name="update" data-value="'.$row['announcement_id'].'" id="'.$row['announcement_id'].'"><i class="fa fa-search"></i> View</button>  <button class="btn btn-danger btnDelete btnTable" name="update" data-value="'.$row['announcement_id'].'" id="'.$row['announcement_id'].'"><i class="fa fa-trash-o"></i> Delete</button>';
					$data[] = $nestedData;
				}

				if ($row["position_id"] == 3) {
					$nestedData[] = date_format(date_create($row["posted_on"]),"m/d/Y");
					$nestedData[] = date_format(date_create($row["display_until"]),"m/d/Y");
					$nestedData[] = $row["subject"];
					$nestedData[] = $row["branch_admin_first_name"].' '.$row["branch_admin_middle_name"].' '.$row["branch_admin_last_name"] .' - Branch Admin ';
					$nestedData[] = '<button data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="" class="btn btn-success btnView btnTable" name="update" data-value="'.$row['announcement_id'].'" id="'.$row['announcement_id'].'"><i class="fa fa-search"></i> View</button>  <button class="btn btn-danger btnDelete btnTable" name="update" data-value="'.$row['announcement_id'].'" id="'.$row['announcement_id'].'"><i class="fa fa-trash-o"></i> Delete</button>';
					$data[] = $nestedData;
				}
			}

			$json_data = array(
				
				"recordsTotal"    => intval( $totalData ),  // total number of records
				"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
				"data"            => $data   // total data array
			);

			return $json_data;
		}

		public function settings_schedule_table(){
			// storing  request (ie, get/post) global array to a variable  
			$requestData= $_REQUEST;

			$columns = array( 
				// datatable column index  => database column name for sorting
					0 => 'hol.holiday_description',
					1 => 'hol.holiday_date',
				);

			// getting total number records without any search
			$sql = "SELECT * FROM imm_holiday hol
					WHERE hol.enabled = 1";

			$query = $this->db->query($sql);
			$totalData = $query->num_rows();
			$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

			$sql = "SELECT * FROM imm_holiday hol
					WHERE hol.enabled = 1";

			// getting records as per search parameters

			$query = $this->db->query($sql);
			$totalFiltered = $query->num_rows(); // when there is a search parameter then we have to modify total number filtered rows as per search result.

			$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";  // adding length

			$query = $this->db->query($sql);

			$data = array();
			foreach( $query->result_array() as $row ) {  // preparing an array for table tbody
				$nestedData=array(); 
			
					$nestedData[] = $row["holiday_description"];
					$nestedData[] = date_format(date_create($row["holiday_date"]),"m/d/Y");
					$nestedData[] = '<button data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="" class="btn btn-success btnView btnTable" name="update" data-value="'.$row['holiday_id'].'" id="'.$row['holiday_id'].'"><i class="fa fa-search"></i> View</button>  <button class="btn btn-danger btnDelete btnTable" name="update" data-value="'.$row['holiday_id'].'" id="'.$row['holiday_id'].'"><i class="fa fa-trash-o"></i> Delete</button>';
					$data[] = $nestedData;
			}

			$json_data = array(
				
				"recordsTotal"    => intval( $totalData ),  // total number of records
				"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
				"data"            => $data   // total data array
			);

			return $json_data;
		}

		public function settings_country(){
			// storing  request (ie, get/post) global array to a variable  
			$requestData= $_REQUEST;

			$columns = array( 
				// datatable column index  => database column name for sorting
					0 => 'ctry.country_id',
					1 => 'ctry.country',
				);

			// getting total number records without any search
			$sql = "SELECT * FROM imm_country ctry
					WHERE ctry.enabled = 1";

			$query = $this->db->query($sql);
			$totalData = $query->num_rows();
			$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

			$sql = "SELECT * FROM imm_country ctry
					WHERE ctry.enabled = 1";

			// getting records as per search parameters

			$query = $this->db->query($sql);
			$totalFiltered = $query->num_rows(); // when there is a search parameter then we have to modify total number filtered rows as per search result.

			$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";  // adding length

			$query = $this->db->query($sql);

			$data = array();
			foreach( $query->result_array() as $row ) {  // preparing an array for table tbody
				$nestedData=array(); 
			
					$nestedData[] = $row["country_id"];
					$nestedData[] = $row["country"];
					$nestedData[] = '<button data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="" class="btn btn-success btnView btnTable" name="update" data-value="'.$row['country_id'].'" id="'.$row['country_id'].'"><i class="fa fa-search"></i> View</button>  <button class="btn btn-danger btnDelete btnTable" name="update" data-value="'.$row['country_id'].'" id="'.$row['country_id'].'"><i class="fa fa-trash-o"></i> Delete</button>';
					$data[] = $nestedData;
			}

			$json_data = array(
				
				"recordsTotal"    => intval( $totalData ),  // total number of records
				"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
				"data"            => $data   // total data array
			);

			return $json_data;
		}

		public function settings_schedule_limit_table(){
			// storing  request (ie, get/post) global array to a variable  
			$requestData= $_REQUEST;

			$columns = array( 
				// datatable column index  => database column name for sorting
					0 => 'sl.sched_limit_id',
					1 => 'bra.branch_code',
					2 => 'sl.start_date',
					3 => 'sl.end_date',
					4 => 'sl.day_limit',
					5 => 'sl.hour_limit',
				);

			// getting total number records without any search
			$sql = "SELECT * FROM imm_schedule_limit sl
					LEFT JOIN imm_branch bra on bra.branch_id = sl.sched_limit_branch_id
					WHERE sl.enabled = 1";

			$query = $this->db->query($sql);
			$totalData = $query->num_rows();
			$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

			$sql = "SELECT * FROM imm_schedule_limit sl
					LEFT JOIN imm_branch bra on bra.branch_id = sl.sched_limit_branch_id
					WHERE sl.enabled = 1";

			// getting records as per search parameters

			$query = $this->db->query($sql);
			$totalFiltered = $query->num_rows(); // when there is a search parameter then we have to modify total number filtered rows as per search result.

			$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";  // adding length

			$query = $this->db->query($sql);

			$data = array();
			foreach( $query->result_array() as $row ) {  // preparing an array for table tbody
				$nestedData=array(); 
			
					$nestedData[] = $row['sched_limit_id'];
					$nestedData[] = $row["branch_code"];
					$nestedData[] = date_format(date_create($row["start_date"]),"m/d/Y");
					$nestedData[] = date_format(date_create($row["end_date"]),"m/d/Y");
					$nestedData[] = $row["day_limit"];
					$nestedData[] = $row["hour_limit"];
					$nestedData[] = '<button data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="" class="btn btn-success btnView btnTable" name="update" data-value="'.$row['sched_limit_id'].'" id="'.$row['sched_limit_id'].'"><i class="fa fa-search"></i> View</button>  <button class="btn btn-danger btnDelete btnTable" name="update" data-value="'.$row['sched_limit_id'].'" id="'.$row['sched_limit_id'].'"><i class="fa fa-trash-o"></i> Delete</button>';
					$data[] = $nestedData;
			}

			$json_data = array(
				
				"recordsTotal"    => intval( $totalData ),  // total number of records
				"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
				"data"            => $data   // total data array
			);

			return $json_data;
		}

		public function settings_branch_schedule_limit_table($branch_id){
			// storing  request (ie, get/post) global array to a variable  
			$requestData= $_REQUEST;

			$columns = array( 
				// datatable column index  => database column name for sorting
					0 => 'sl.sched_limit_id',
					1 => 'bra.branch_code',
					2 => 'sl.start_date',
					3 => 'sl.end_date',
					4 => 'sl.day_limit',
					5 => 'sl.hour_limit',
				);

			// getting total number records without any search
			$sql = "SELECT * FROM imm_schedule_limit sl
					LEFT JOIN imm_branch bra on bra.branch_id = sl.sched_limit_branch_id
					WHERE sl.enabled = 1 AND sl.sched_limit_branch_id = ?";
			$data = array($branch_id);
			$query = $this->db->query($sql, $data);
			$totalData = $query->num_rows();
			$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

			$sql = "SELECT * FROM imm_schedule_limit sl
					LEFT JOIN imm_branch bra on bra.branch_id = sl.sched_limit_branch_id
					WHERE sl.enabled = 1 AND sl.sched_limit_branch_id = ?";

			// getting records as per search parameters

			$query = $this->db->query($sql, $data);
			$totalFiltered = $query->num_rows(); // when there is a search parameter then we have to modify total number filtered rows as per search result.

			$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";  // adding length

			$query = $this->db->query($sql, $data);

			$data = array();
			foreach( $query->result_array() as $row ) {  // preparing an array for table tbody
				$nestedData=array(); 
			
					$nestedData[] = $row['sched_limit_id'];
					$nestedData[] = $row["branch_code"];
					$nestedData[] = $row["start_date"];
					$nestedData[] = $row["end_date"];
					$nestedData[] = $row["day_limit"];
					$nestedData[] = $row["hour_limit"];
					$nestedData[] = '<button data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="" class="btn btn-success btnView btnTable" name="update" data-value="'.$row['sched_limit_id'].'" id="'.$row['sched_limit_id'].'"><i class="fa fa-search"></i> View</button>  <button class="btn btn-danger btnDelete btnTable" name="update" data-value="'.$row['sched_limit_id'].'" id="'.$row['sched_limit_id'].'"><i class="fa fa-trash-o"></i> Delete</button>';
					$data[] = $nestedData;
			}

			$json_data = array(
				
				"recordsTotal"    => intval( $totalData ),  // total number of records
				"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
				"data"            => $data   // total data array
			);

			return $json_data;
		}

		public function applicant_transactions_appointment_table($applicant_no){
			// storing  request (ie, get/post) global array to a variable  
			$requestData= $_REQUEST;

			$columns = array( 
				// datatable column index  => database column name for sorting
					0 => 'apl.appointment_id',
					1 => 'bra.branch_name',
					2 => 'apl.appointment_datesched',
					3 => 'apt.timesched_description',
					4 => 'aps.status_description',
				);

			// getting total number records without any search
			$sql = "SELECT * FROM imm_appointment_log apl
					LEFT JOIN imm_branch bra ON apl.center_id = bra.branch_id
					LEFT JOIN imm_applicants app ON app.applicant_no = apl.applicant_no
					-- LEFT JOIN imm_appointment_status aps ON apl.appointment_status_id = aps.status_id
					LEFT JOIN imm_appointment_timesched apt on apl.appointment_timesched_id =  apt.id
					WHERE apl.enabled = 1";

			$query = $this->db->query($sql);
			$totalData = $query->num_rows();
			$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

			$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT 1 "."   ";  // adding length

			$query = $this->db->query($sql);
			$row_count = 0;
			$data = array();
			foreach( $query->result_array() as $row ) {  // preparing an array for table tbody
				
				$row_count++;
				$nestedData=array(); 
				if($row["applicant_no"] == $applicant_no){

					$nestedData[] = $row["appointment_id"];
					$nestedData[] = $row["branch_name"];
					$nestedData[] = $row["appointment_datesched"];
					$nestedData[] = $row["timesched_description"];
					$nestedData[] = $row["status_description"];
					$nestedData[] = '<button data-toggle="modal" data-backdrop="static" data-keyboard="false" class="btn btn-success btnView btnTable" name="update" data-value="'.$row['appointment_id'].'" id="'.$row['appointment_id'].'"><i class="fa fa-search"></i> View</button>  <button class="btn btn-danger btnDelete btnTable" name="update" data-value="'.$row['appointment_id'].'" id="'.$row['appointment_id'].'"><i class="fa fa-trash-o"></i> Delete</button><input hidden type="text" class="table_count" value="'.$row['appointment_id'].'">';
					$data[] = $nestedData;
				}
			}

			$json_data = array(
				
				"recordsTotal"    => intval( $totalData ),  // total number of records
				"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
				"data"            => $data   // total data array
			);
			return $json_data;
		}

		public function generate_receipt($e_receipt){
			$sql = "INSERT INTO imm_official_receipt (`or_no`) VALUES (?)";
			$data = array($e_receipt);
			$this->db->query($sql, $data);
		}

		public function check_receipt_availability($e_receipt){
			$sql = "SELECT * FROM imm_official_receipt WHERE `or_no`=? and enabled = 1";
			$data = array($e_receipt);
			$query = $this->db->query($sql, $data);
			$is_duplicate = false;

			if ($query->num_rows() > 0) {
				$is_duplicate = true;
			}
			return $is_duplicate;
		}

		public function get_regular_convenience_fee(){

			$sql = "SELECT * FROM imm_application_process WHERE process_id = 1 AND enabled = 1";
			$query = $this->db->query($sql);
			return $query;
		}

		public function get_express_convenience_fee(){

			$sql = "SELECT * FROM imm_application_process WHERE process_id = 2 AND enabled = 1";
			$query = $this->db->query($sql);
			return $query;
		}

		public function update_conveniencefee($reg_debit, $reg_credit, $exp_debit, $exp_credit){

			$sql ="UPDATE `imm_application_process` SET `convenience_fee_debit`= ?,`convenience_fee_credit`= ?, `date_updated` =? WHERE process_id = ?";
			$data = array($reg_debit, $reg_credit,todaytime(),1); //regular
			$this->db->query($sql, $data);


			$sql2 ="UPDATE `imm_application_process` SET `convenience_fee_debit`= ?,`convenience_fee_credit`= ?, `date_updated` =? WHERE process_id = ?";
			$data2 = array($exp_debit, $exp_credit,todaytime(),2); //express
			$this->db->query($sql2, $data2);

		}

		public function update_applicationfee($reg_debit, $reg_credit, $exp_debit, $exp_credit){

			$sql ="UPDATE `imm_application_process` SET `processing_fee_debit`= ?,`processing_fee_credit`= ?, `date_updated` =? WHERE process_id = ?";
			$data = array($reg_debit, $reg_credit,todaytime(),1); //regular
			$this->db->query($sql, $data);


			$sql2 ="UPDATE `imm_application_process` SET `processing_fee_debit`= ?,`processing_fee_credit`= ?, `date_updated` =? WHERE process_id = ?";
			$data2 = array($exp_debit, $exp_credit,todaytime(),2); //express
			$this->db->query($sql2, $data2);

		}

}