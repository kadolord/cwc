$(function(){

	$('.datepicker2').datepicker({
		todayBtn: "linked",
		format: 'yyyy/mm/dd',
	});
	var base_url = $("body").data('base_url'); //base_url come from php functions base_url();

	var dataTable = $('#table-grid').DataTable({
		"processing": true,
		"serverSide": true,
		"ajax":{
			url :base_url+"Main/settings_accounts_table", // json datasource
			type: "post",  // method  , by default get
			error: function(){  // error handling
				$(".table-grid-error").html("");
				$("#table-grid").append('<tbody class="table-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
				$("#table-grid_processing").css("display","none");
			}
		}
	});

	
	$('.search-input-text').on('keyup click', function(){   // for text boxes
		var i =$(this).attr('data-column');  // getting column index
		var v =$(this).val();  // getting search input value
		dataTable.columns(i).search(v).draw();
	});

	$('.search-input-select').on('change', function(){   // for select box
		var i =$(this).attr('data-column');  
		var v =$(this).val();  
		dataTable.columns(i).search(v).draw();
	});


	$('.searchPosition').change(function(){
		if ($(this).val() == "") {
			$('.searchFullname').prop("disabled", true);
			$('.searchContact').prop("disabled", true);
			$('.searchEmail').prop("disabled", true);
		}else{
			$('.searchFullname').prop("disabled", false);
			$('.searchContact').prop("disabled", false);
			$('.searchEmail').prop("disabled", false);
		}
	});

	///	josh

	$(".saveBtnAccounts").click(function(e){
		
		e.preventDefault();

		var thiss = $("#add_accountspersonalinfo-form");

		var serial = thiss.serialize();

		$.ajax({
			type:'post',
			url: base_url+'Main/save_info_accounts',
			data: serial,
			beforeSend:function(data){
				$(".cancelBtn, .saveBtnAccounts").prop('disabled', true); 
				$(".saveBtnAccounts").text("Please wait...");
				
			},
			success:function(data){
				$(".cancelBtn, .saveBtnAccounts").prop('disabled', false);
				$(".saveBtnAccounts").text("Add");
				if (data.success == 1) {
					dataTable.draw(); //refresh datatable
					$(thiss).find('input').val(""); // clean fields
					$('#register-gendermale').prop('checked',true);
					$('#register-gendermale').val('1');
					$('.info_position').val('').trigger('change');

					$.toast({
					    heading: 'Success',
					    text: data.message,
					    icon: 'success',
					    loader: false,  
					    stack: false,
					    position: 'top-center', 
					    bgColor: '#5cb85c',
						textColor: 'white',
						allowToastClose: false,
						hideAfter: 10000
					});
				}else{
					$.toast({
					    heading: 'Warning',
					    text: data.message,
					    icon: 'warning',
					    loader: false,   
					    stack: false,
					    position: 'top-center',  
					    bgColor: '#f0ad4e;',
						textColor: 'white'        
					});
				}
			}
		});
	});
	
	$('#table-grid').delegate(".btnDelete","click", function(){
		var user_id = $(this).data('value');

		$.ajax({
	  		type: 'post',
	  		url: base_url+'Main/getInfoAccountsUsingID',
	  		data:{'user_id':user_id},
	  		success:function(data){
	  			var res = data.result;
	  			if (data.success == 1) {
	  				$(".info_user_id").val(res[0].user_id); //user_id pk

	  				if (res[0].position_id == 1) { // admi;n

	  					$(".del_user_id").val(res[0].user_id);
	  					console.log($(".del_user_id").val());
						$(".del_email_id").val(res[0].admin_email);
						$(".del_position_id").val(res[0].position_id);
						$(".fullname_del").text(res[0].admin_first_name+' '+res[0].admin_last_name)

	  				}else if (res[0].position_id == 2){ // applicant
						
	  					$(".del_user_id").val(res[0].user_id);
						$(".del_email_id").val(res[0].email);
						$(".del_position_id").val(res[0].position_id);
						$(".fullname_del").text(res[0].first_name+' '+res[0].last_name)
	  				
	  				}else if (res[0].position_id == 3){ // branch_admin
						
	  					$(".del_user_id").val(res[0].user_id);
						$(".del_email_id").val(res[0].branch_admin_email);
						$(".del_position_id").val(res[0].position_id);
						$(".fullname_del").text(res[0].branch_admin_first_name+' '+res[0].branch_admin_last_name)
						
	  				}else if (res[0].position_id == 4){ // staff
						
	  					$(".del_user_id").val(res[0].user_id);
						$(".del_email_id").val(res[0].staff_email);
						$(".del_position_id").val(res[0].position_id);
						$(".fullname_del").text(res[0].staff_first_name+' '+res[0].staff_last_name)
	  				
	  				}else if (res[0].position_id == 5){ // branch staff
						
	  					$(".del_user_id").val(res[0].branch_staff_user_id);
						$(".del_email_id").val(res[0].branch_staff_email);
						$(".del_position_id").val(res[0].position_id);
						$(".fullname_del").text(res[0].branch_staff_first_name+' '+res[0].branch_staff_last_name)
	  				}
	  			}
	  		}
	  	});
		$('#deleteAccountsModal').modal('show');

	});

	$('#table-grid').delegate(".btnUpdate", "click", function(){
		$('#editAccountsModal').modal('show'); 
	});

	$('#table-grid').delegate(".btnView", "click", function(){
		$('#viewAccountsModal').modal('show');
	});

	$('#table-grid').delegate(".btnUpdate, .btnView", "click", function(){


	  	var user_id = $(this).data('value');

	  	$.ajax({
	  		type: 'post',
	  		url: base_url+'Main/getInfoAccountsUsingID',
	  		data:{'user_id':user_id},
	  		success:function(data){
	  			var res = data.result;
	  			if (data.success == 1) {
	  				$(".info_emailaddress2").val(data.email);
	  				$(".info_user_id").val(user_id); //user_id pk
	  				$(".del_user_id").val(user_id);
	  				console.log($(".info_user_id").val());
	  				$(".info_position_id").val(res[0].position_id);

	  				if (res[0].position_id == 1) { // admin
	  					$(".info_assigned_branch_container").css('display','none');
	  																		
	  					$(".info_fname").val(res[0].admin_first_name);
		  				$(".info_mname").val(res[0].admin_middle_name);
						$(".info_lname").val(res[0].admin_last_name);
						$(".info_bdate").val(moment(res[0].admin_birthdate).format('L'));
						$(".info_contact_number").val(res[0].admin_contact_num);
						$(".info_address").val(res[0].admin_address);
						// $(".info_country").val(res[0].country_id);
						$(".info_country").val(res[0].admin_country_id).trigger('change');//for select2
						// $(".info_city").val(res[0].city_id);
						$(".info_city").val(res[0].admin_city_id).trigger('change');//for select2
						$(".info_emailaddress").val(data.email);
					
						

						if (res[0].admin_gender_id == 2) { // female
							// info_gendermale
							$("#info_genderfemale").prop("checked",true);
							$("#info_gendermale").prop("checked",false);
							$("#info_genderfemaleV").prop("checked",true);
							$("#info_gendermaleV").prop("checked",false);
							
						}else{ // male
							$("#info_gendermale").prop("checked",true);
							$("#info_genderfemale").prop("checked",false);
							$("#info_genderfemaleV").prop("checked",false);
							$("#info_gendermaleV").prop("checked",true);
						}
	  				}else if (res[0].position_id == 2) { // applicant
	  					$(".info_assigned_branch_container").css('display','none');

	  					$(".info_fname").val(res[0].first_name);
		  				$(".info_mname").val(res[0].middle_name);
						$(".info_lname").val(res[0].last_name);
						$(".info_bdate").val(moment(res[0].birthdate).format('L'));
						$(".info_contact_number").val(res[0].contact_num);
						// $(".info_address").val(res[0].address);
						// $(".info_country").val(res[0].officer_country_id);
						// $(".info_city").val(res[0].officer_city_id);
						$(".info_country").val(res[0].country_id).trigger('change'); //for select2
						// $(".info_city").val(res[0].operator_city_id).trigger('change');//for select2
						$(".info_emailaddress").val(data.email);

						if (res[0].gender_id == 2) { // female
							// info_gendermale
							$("#info_genderfemale").prop("checked",true);
							$("#info_gendermale").prop("checked",false);
							$("#info_genderfemaleV").prop("checked",true);
							$("#info_gendermaleV").prop("checked",false);
						}else{ // male
							$("#info_gendermale").prop("checked",true);
							$("#info_genderfemale").prop("checked",false);
							$("#info_genderfemaleV").prop("checked",false);
							$("#info_gendermaleV").prop("checked",true);
						}

	  				}else if (res[0].position_id == 3) { // branch admin

	  					$(".info_assigned_branch_container").css('display','block');
	  					$(".info_assigned_branch").val(res[0].branch_admin_assigned_branch_id).trigger('change'); //for select2
	  					console.log(res[0].assigned_branch_id);

	  					$(".info_fname").val(res[0].branch_admin_first_name);
		  				$(".info_mname").val(res[0].branch_admin_middle_name);
						$(".info_lname").val(res[0].branch_admin_last_name);
						$(".info_bdate").val(moment(res[0].branch_admin_birthdate).format('L'));
						$(".info_contact_number").val(res[0].branch_admin_contact_num);
						// $(".info_address").val(res[0].branch_admin_address);
						// $(".info_country").val(res[0].offistaffofficer_city_id);
						$(".info_country").val(res[0].branch_admin_country_id).trigger('change'); //for select2
						// $(".info_city").val(res[0].city_id).trigger('change');//for select2
						$(".info_emailaddress").val(data.email);

						if (res[0].branch_admin_gender_id == 2) { // female
							// info_gendermale
							$("#info_genderfemale").prop("checked",true);
							$("#info_gendermale").prop("checked",false);
							$("#info_genderfemaleV").prop("checked",true);
							$("#info_gendermaleV").prop("checked",false);
						}else{ // male
							$("#info_gendermale").prop("checked",true);
							$("#info_genderfemale").prop("checked",false);
							$("#info_genderfemaleV").prop("checked",false);
							$("#info_gendermaleV").prop("checked",true);
						}
	  				}else if (res[0].position_id == 4) { // staff
	  					$(".info_assigned_branch_container").css('display','none');

	  					$(".info_fname").val(res[0].staff_first_name);
		  				$(".info_mname").val(res[0].staff_middle_name);
						$(".info_lname").val(res[0].staff_last_name);
						$(".info_bdate").val(moment(res[0].staff_birthdate).format('L'));
						$(".info_contact_number").val(res[0].staff_contact_num);
						// $(".info_address").val(res[0].staff_address);
						// $(".info_country").val(res[0].offistaffofficer_city_id);
						$(".info_country").val(res[0].staff_country_id).trigger('change'); //for select2
						// $(".info_city").val(res[0].city_id).trigger('change');//for select2
						$(".info_emailaddress").val(data.email);

						if (res[0].staff_gender_id == 2) { // female
							// info_gendermale
							$("#info_genderfemale").prop("checked",true);
							$("#info_gendermale").prop("checked",false);
							$("#info_genderfemaleV").prop("checked",true);
							$("#info_gendermaleV").prop("checked",false);
						}else{ // male
							$("#info_gendermale").prop("checked",true);
							$("#info_genderfemale").prop("checked",false);
							$("#info_genderfemaleV").prop("checked",false);
							$("#info_gendermaleV").prop("checked",true);
						}
	  				}else if (res[0].position_id == 5) { // branch staff
	  					$(".info_assigned_branch_container").css('display','block');

	  					$(".info_assigned_branch").val(res[0].assigned_branch_id).trigger('change'); //for select2
	  					console.log(res[0].assigned_branch_id);

	  					$(".info_fname").val(res[0].branch_staff_first_name);
		  				$(".info_mname").val(res[0].branch_staff_middle_name);
						$(".info_lname").val(res[0].branch_staff_last_name);
						$(".info_bdate").val(moment(res[0].branch_staff_birthdate).format('L'));
						$(".info_contact_number").val(res[0].branch_staff_contact_num);
						// $(".info_address").val(res[0].branch_staff_address);
						// $(".info_country").val(res[0].offistaffofficer_city_id);
						$(".info_country").val(res[0].branch_staff_country_id).trigger('change'); //for select2
						// $(".info_city").val(res[0].city_id).trigger('change');//for select2
						$(".info_emailaddress").val(data.email);

						if (res[0].branch_staff_gender_id == 2) { // female
							// info_gendermale
							$("#info_genderfemale").prop("checked",true);
							$("#info_gendermale").prop("checked",false);
							$("#info_genderfemaleV").prop("checked",true);
							$("#info_gendermaleV").prop("checked",false);
						}else{ // male
							$("#info_gendermale").prop("checked",true);
							$("#info_genderfemale").prop("checked",false);
							$("#info_genderfemaleV").prop("checked",false);
							$("#info_gendermaleV").prop("checked",true);
						}
	  				}

	  				$(".info_position").val(res[0].position_id).trigger('change');
	  				
					// info_gender
					// info_gender
	  			}
	  		}
	  	});
	});

	$(".goToEditModalAccountsBtn").click(function(e){
		e.preventDefault();
			$('#viewAccountsModal').modal('toggle');
			$('#editAccountsModal').modal('show'); 
	});

	$("#edit_accountspersonalinfo-form").submit(function(e){
		e.preventDefault();
		var serial = $(this).serialize();

		$.ajax({
			type:'post',
			url:base_url+'Main/edit_accounts_branch_admin',
			data:serial,
			success:function(data){
				if (data.success == 1) {
					$.toast({
					    heading: 'Success',
					    text: data.message,
					    icon: 'success',
					    loader: false,  
					    stack: false,
					    position: 'top-center', 
					    bgColor: '#5cb85c',
						textColor: 'white',
						allowToastClose: false,
						hideAfter: 4000
					});
					dataTable.draw(); //refresh table
					$('#editAccountsModal').modal('toggle'); //close modal
				}else{
					$.toast({
					    heading: 'Warning',
					    text: data.message,
					    icon: 'warning',
					    loader: false,   
					    stack: false,
					    position: 'top-center',  
					    bgColor: '#f0ad4e;',
						textColor: 'white'        
					});
				}
			}
		});
	});


	$('.deleteAccountBtn').click(function(e){
		e.preventDefault();

		var del_user_id = $(".info_user_id").val();
		var del_email_id = $(".del_email_id").val();
		var del_position_id = $(".del_position_id").val();

		$.ajax({
			type:'post',
			url:base_url+'Main/deleteAccounts',
			data:{'del_user_id':del_user_id, 'del_email_id':del_email_id, 'del_position_id':del_position_id},
			success:function(data){
				if (data.success == 1) {
					$.toast({
					    heading: 'Success',
					    text: data.message,
					    icon: 'success',
					    loader: false,  
					    stack: false,
					    position: 'top-center', 
					    bgColor: '#5cb85c',
						textColor: 'white',
						allowToastClose: false,
						hideAfter: 4000
					});
					dataTable.draw(); //refresh table
					$('#deleteAccountsModal').modal('toggle'); //close modal
				}else{
					$.toast({
					    heading: 'Warning',
					    text: data.message,
					    icon: 'warning',
					    loader: false,   
					    stack: false,
					    position: 'top-center',  
					    bgColor: '#f0ad4e;',
						textColor: 'white'        
					});
				}
			}
		});

	});

	$('.btnClickAddAccount').click(function(){
		$('.info_position').val('').trigger('change');
	});
	
});