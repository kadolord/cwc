$(function(){
	var base_url = $("body").data('base_url'); //base_url come from php functions base_url();

	var dataTable = $('#table-grid').DataTable({
		"processing": true,
		"serverSide": true,
		"columnDefs": [
			{ targets: [5], orderable: false, "sClass":"text-center"}
		],
		"ajax":{
			url :base_url+"Main/settings_applicants_table", // json datasource
			type: "post",  // method  , by default get
			error: function(){  // error handling
				$(".table-grid-error").html("");
				$("#table-grid").append('<tbody class="table-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
				$("#table-grid_processing").css("display","none");
			}
		}
	});
	
	$('.filterBtn').click(function(){

		if($('.searchEmail').val() != "" || $('.searchEmail').val() != "" || $('.searchFullname').val != ""){ 

			$(".table_applicant").show();
			var a =$('.searchFullname').attr('data-column');  // getting column index
			var b =$('.searchFullname').val();  // getting search input value
			var c =$('.searchCountry').attr('data-column');  // getting column index
			var d =$('.searchCountry').val();  // getting search input value
			var e =$('.searchEmail').attr('data-column');  // getting column index
			var f =$('.searchEmail').val();  // getting search input value
		
			dataTable.columns(a).search(b);
			dataTable.columns(c).search(d);
			dataTable.columns(e).search(f).draw();;
		}else{
			dataTable.columns(0).search("");
			dataTable.columns(1).search("");
			dataTable.columns(2).search("").draw();
		}
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
	

	$('#table-grid').delegate(".btnView", "click", function(){
		$('#viewAccountsModal').modal('show');
	});

	$('#table-grid').delegate(".btnView", "click", function(){


	  	var applicant_id = $(this).data('value');

	  	$.ajax({
	  		type: 'post',
	  		url: base_url+'Main/getInfoApplicantUsingID',
	  		data:{'applicant_id':applicant_id},
	  		success:function(data){
	  			var res = data.result;
	  			console.log(data.result)
	  			if (data.success == 1) {
  					$("input[name='info_fname']").val(res.first_name);
	  				$("input[name='info_mname']").val(res.middle_name);
					$("input[name='info_lname']").val(res.last_name);
					$("input[name='info_xname']").val(res.ext_name);
					$("input[name='info_applicant_no']").val(data.applicantno);
					$("input[name='info_acr_no']").val(res.icard_no);
					$("input[name='info_alias1']").val(res.alias1);
					$("input[name='info_alias2']").val(res.alias2);
					$("input[name='info_email']").val(res.email);
					$("input[name='info_bdate']").val(res.birthdate);
					$("input[name='info_age']").val(res.age);
					$("input[name='info_gender']").val(res.gender_id == 1 ? 'Male' : 'Female');
					$("input[name='info_civilstatus']").val(res.name);
					$("input[name='info_landline']").val(res.landline);
					$("input[name='info_mobile']").val(res.mobile_num);
					$("input[name='info_birth_country']").val(res.country);
					$("input[name='info_nationality']").val(res.nationality);
					$("input[name='info_passport_no']").val(res.passport_num);
					$("input[name='info_issuance_place']").val(res.place_of_isssuance);
					$("input[name='info_issuance_date']").val(res.issuance_date);
					$("input[name='info_expiry_date']").val(res.expiry_date);
					$("input[name='info_arrival_date']").val(res.latest_arrival_date);
					$("input[name='info_ph_st']").val(res.ph_street_no);
					$("input[name='info_ph_village']").val(res.ph_village);
					$("input[name='info_ph_brgy']").val(res.ph_barangay);
					$("input[name='info_ph_city']").val(res.ph_city);
					$("input[name='info_ph_prov']").val(res.ph_province);
					$("input[name='info_ph_zipcode']").val(res.ph_city);
					$("input[name='info_ab_st']").val(res.ab_street_no);
					$("input[name='info_ab_village']").val(res.ab_village);
					$("input[name='info_ab_city']").val(res.ph_zipcode);
					$("input[name='info_ab_state']").val(res.ab_state);
					$("input[name='info_ab_country']").val(res.country);
					$("input[name='info_ab_zipcode']").val(res.ab_zipcode);

					var html = ''
					var uploaded_doc = data.uploaded_docs;
					// console.log(data.uploaded_docs);
					// console.log(uploaded_doc.length);

					if(uploaded_doc.length == 0){
						html += "<div class='col-md-3'><p>No uploaded document</p></div>"
					}

					if (uploaded_doc.length != 0){
						for(var i = 0; i < uploaded_doc.length ; i++){

							if( uploaded_doc[i].uploaded_doc_ext != "pdf"){
								html += "<div class='col-md-2'>"
								html += "<p>" + uploaded_doc[i].requirement_description + "</p>";
								html += "<a target='_blank' href='";
								html += base_url+ "assets/img/applicant_documents/" + uploaded_doc[i].uploaded_doc + "'>";
								html += "<img class='img-fluid' width ='100' height ='90' src='";
								html += base_url+ "assets/img/applicant_documents/" + uploaded_doc[i].uploaded_doc;
								html += "'></a>";
								html += "</div>"
							}else{
								html += "<div class='col-md-2'>"
								html += "<p>" + uploaded_doc[i].requirement_description + "</p>";
								html += "<a target='_blank' href='";
								html += base_url+ "assets/img/applicant_documents/" + uploaded_doc[i].uploaded_doc + "'>";
								html += "<img class='img-fluid' width ='100' height ='90' src='";
								html += base_url+ "assets/images/pdf_icon.png";
								html += "'></a>";
								html += "</div>"
							}
						}
					}

					$('.uploaded_docs').html(html);
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
			url:base_url+'Main/edit_applicant_accounts',
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

		var del_user_id = $(".del_user_id").val();
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