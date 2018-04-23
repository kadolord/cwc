$(function(){
	var base_url = $("body").data('base_url'); //base_url come from php functions base_url();

	$('#datepicker').datepicker({
		format: 'yyyy/mm/dd'
	});


	var dataTable = $('#table-grid').DataTable({
		"processing": true,
		"serverSide": true,
		"columnDefs": [
			{ targets: [7], orderable: false, "sClass":"text-center"}
		],
		"ajax":{
			url :base_url+"Main/transactions_applications_table", // json datasource
			type: "post",  // method  , by default get
			error: function(){  // error handling
				$(".table-grid-error").html("");
				$("#table-grid").append('<tbody class="table-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
				$("#table-grid_processing").css("display","none");
			}
		}
	});

	$('.filterBtn').click(function(){

		if($('.searchAppStatus').val() != "" || $('.searchRefNum').val() != "" || $('.searchDate').val != "" || $('.searchDate2').val != ""){ //all

			$(".table_applicant").show();
			var c =$('.searchRefNum').attr('data-column');  // getting column index
			var d =$('.searchRefNum').val();  // getting search input value
			var e =$('.searchDate').attr('data-column');  
			var f =$('.searchDate').val();  

			var g =$('.searchDate2').attr('data-column');  
			var h =$('.searchDate2').val();  
		
			dataTable.columns(c).search(d);
			dataTable.columns(e).search(f);
			dataTable.columns(g).search(h).draw();
		}else{
			dataTable.columns(0).search("");
			dataTable.columns(1).search("");
			dataTable.columns(2).search("").draw();
		};
	});

	$('#table-grid').delegate(".btnView", "click", function(){
		
	});

	$('#table-grid').delegate(".btnView", "click", function(){

	  	var app_ref_no = $(this).data('value');
	  	$.ajax({
	  		type: 'post',
	  		url: base_url+'Main/getInfoTransactionApplicationUsingRefNo',
	  		data:{'app_ref_no':app_ref_no},
	  		beforSend:function(){
	  				$('#viewAccountsModal').modal('toggle');
	  			},
	  		success:function(data){
	  			var res = data.result; //application info
	  			var res1 = data.applicant_info; //applicant info
	  			if (data.success == 1) {

	  				console.log(res1);
	  				$(".app_id").val(res[0].reference_no); //appointment id for approval and rejection
	  				$(".qr_code_img").prop("src",res[0]["qr_code"]); //qrcode image

	  				$("#btnPDF").prop("href",base_url+"Main/pdf_acrs_application/"+res[0]['reference_no'] ); //pdf LINK
	  				$(".refNospan").text(res[0]['reference_no']);
	  				$(".e-receipt_no").text(res[0]['OR_NO']);
				    $(".sum_branch_name").text(res[0]['branch_name']);

			        var appointment_date = moment(res1[0]['appointment_date']).format('L');
			     	var application_date =  moment(res1[0]['application_date']).format('L');
			        var birthdate = moment(res1[0]['birthdate']).format('L');

			        if(res1[0]['issuance_date']!=null){
			        	var issuance_date = moment(res1[0]['issuance_date']).format('L');
			        }
			        if(res1[0]['latest_arrival_date']!=null){
			        	var latest_arrival_date =  moment(res1[0]['latest_arrival_date']).format('L');
			        }
			      	if(res1[0]['expiry_date']!=null){
			        	var expiry_date = moment(res1[0]['expiry_date']).format('L');
			        }

			     	var total_amount = accounting.formatMoney(res[0]['total_amount_receipt'], " ₱", 2);

			     	if(res[0]['application_status'] == 1){
			     		console.log(res[0]['application_status']);
	  					var note = "This person has been confirmed to have personally appeared at "+ res[0]['branch_name'] 
	  					+ " on "+ appointment_date+".";
	  					$(".appearance_note").html(note);
	  					$(".appearance_note").css('display','block');
	  					$(".goToConfirmAppearanceModalBtn").css('display','none');
	  				}
			  
			     	if(res1[0]['gender_id'] == 1){
			        	var gender = 'Male';
	  				}else{
	  					var gender = 'Female';
	  				}

				    $(".sum_app_date").text(appointment_date);
				    $(".sum_app_time").text(res[0]['timesched_description']);
				    $(".sum_application_date").text(application_date);
				    $(".sum_app_cat").text(res[0]['description']);
			        $(".sum_process_lane").text(res[0]['process']);
			        $(".sum_app_fee").text(res[0]['reference_no']);

			        $(".sum_app_name").text(res1[0]['first_name'] + " " + res1[0]['middle_name'] + " "+ res1[0]['last_name'] +" " +res1[0]['ext_name'] );
			        $(".sum_icard").text(res1[0]['icard_no']);
			        $(".sum_alias1").text(res1[0]['alias1']);
			        $(".sum_alias2").text(res1[0]['alias2']);
	  				$(".sum_bday").text(birthdate);
			        $(".sum_age").text(res1[0]['age']);
	  				$(".rcpt_amount").text(total_amount);

			        $(".sum_gender").text(gender);
			        $(".sum_civilstatus").text(res1[0]['name']);
			        $(".sum_country").text(res1[0]['country']);
			        $(".sum_nationality").text(res1[0]['nationality']);
			        $(".sum_passport").text(res1[0]['passport_num']);
			        $(".sum_issuance_place").text(res1[0]['place_of_isssuance']);
			        $(".sum_issuance_date").text(issuance_date);
			        $(".sum_expiry_date").text(expiry_date);
			        $(".sum_arrival_date").text(latest_arrival_date);
			        $(".sum_mobile").text(res1[0]['mobile_num']);
			        $(".sum_landline").text(res1[0]['landline']);
			        $(".sum_ph_addrs").text(res[0]['ph_street_no'] + ", " + res[0]['ph_village'] + ", " + res[0]['ph_barangay'] + ", " + res[0]['ph_city'] + ", " + res[0]['ph_province'] + " " + res[0]['ph_zipcode']);
			        $(".sum_ab_addrs").text(res[0]['ab_street_no'] + ",  " + res[0]['ab_village'] + ", " +  res[0]['ab_city'] + ", " + res[0]['ab_state'] + ", " + res[0]['country'] + " " + res[0]['ab_zipcode']);
			        $('#viewAccountsModal').modal('show');
	  			}	
	  		}
	  	});
	});

	//Scanning QRCODE

	var scanning = false;

	$('.btnScanQrCode').click(function(e){
		scanning = true;
		$(".backdrop").fadeTo(200, 1);
		var qrcode = "";
		 
	    $(document).keypress(function (e) { 
	        var code = (e.keyCode ? e.keyCode : e.which);
	        qrcode += String.fromCharCode(code);
	        if(code == 13){
	        	if(qrcode.length == 10){
	        		if(scanning){
			        	$.ajax({
					  		type: 'post',
					  		url: base_url+'Main/getInfoTransactionApplicationUsingRefNo',
					  		data:{'app_ref_no':qrcode},
					  		beforSend:function(){
				  				$('#viewAccountsModal').modal('toggle');
				  			},
					  		success:function(data){
					  			var res = data.result;
					  			var res1 = data.applicant_info;
					  			if (data.success == 1) {
					  				qrcode = "";
					  		
					  				$(".app_id").val(res[0].reference_no); //appointment id for approval and rejection
					  				$(".qr_code_img").prop("src",res[0].qr_code);

					  				$("#btnPDF").prop("href",base_url+"Main/pdf_acrs_application/"+res[0]['reference_no'] ); //pdf LINK
					  				$(".refNospan").text(res[0]['reference_no']);
					  				$(".e-receipt_no").text(res[0]['OR_NO']);
								    $(".sum_branch_name").text(res[0]['branch_name']);

							        var appointment_date = moment(res1[0]['appointment_date']).format('L');
							     	var application_date =  moment(res1[0]['application_date']).format('L');

								    $(".sum_app_date").text(appointment_date);
								    $(".sum_app_time").text(res[0]['timesched_description']);
								    $(".sum_application_date").text(application_date);

								    $(".sum_app_cat").text(res[0]['description']);
							        $(".sum_process_lane").text(res[0]['process']);
							        $(".sum_app_fee").text(res[0]['reference_no']);
							        $(".sum_app_name").text(res1[0]['first_name'] + " " + res1[0]['middle_name'] + " "+ res1[0]['last_name'] +" " +res1[0]['ext_name'] );
							        $(".sum_icard").text(res1[0]['icard_no']);
							        $(".sum_alias1").text(res1[0]['alias1']);
							        $(".sum_alias2").text(res1[0]['alias2']);

							        var birthdate = moment(res1[0]['birthdate']).format('L');
							        $(".sum_bday").text(birthdate);
							        $(".sum_age").text(res1[0]['age']);

							        if(res[0]['application_status'] == 1){
					  					var note = "This person has been confirmed to have personally appeared at "+ res[0]['branch_name'] 
					  					+ " on "	+ appointment_date +".";
					  					$(".appearance_note").html(note);
					  					$(".appearance_note").css('display','block');
					  					$(".goToConfirmAppearanceModalBtn").css('display','none');
					  				}

							        if(res1[0]['gender_id'] == 1){
							        	var gender = 'Male';
					  				}else{
					  					var gender = 'Female';
					  				}

					  				var total_amount = accounting.formatMoney(res[0]['total_amount_receipt'], " ₱", 2);
					  				$(".rcpt_amount").text(total_amount);

							        $(".sum_gender").text(gender);
							        $(".sum_civilstatus").text(res1[0]['name']);
							        $(".sum_country").text(res1[0]['country']);
							        $(".sum_nationality").text(res1[0]['nationality']);
							        $(".sum_passport").text(res1[0]['passport_num']);
							        $(".sum_issuance_place").text(res1[0]['place_of_isssuance']);

							        if(res1[0]['issuance_date']!=null){
							        	var issuance_date = moment(res1[0]['issuance_date']).format('L');
							        }
							        if(res1[0]['latest_arrival_date']!=null){
							        	var latest_arrival_date =  moment(res1[0]['latest_arrival_date']).format('L');
							        }
							      	if(res1[0]['expiry_date']!=null){
							        	var expiry_date = moment(res1[0]['expiry_date']).format('L');
							        }
							        
							        $(".sum_issuance_date").text(issuance_date);
							        $(".sum_expiry_date").text(expiry_date);
							        $(".sum_arrival_date").text(latest_arrival_date);

							        $(".sum_mobile").text(res1[0]['mobile_num']);
							        $(".sum_landline").text(res1[0]['landline']);
							        $(".sum_ph_addrs").text(res1[0]['ph_street_no'] + ", " + res1[0]['ph_village'] + ", " + res1[0]['ph_barangay'] + ", " + res1[0]['ph_city'] + ", " + res1[0]['ph_province'] + " " + res1[0]['ph_zipcode']);
							        $(".sum_ab_addrs").text(res1[0]['ab_street_no'] + ",  " + res1[0]['ab_village'] + ", " +  res1[0]['ab_city'] + ", " + res1[0]['ab_state'] + ", " + res1[0]['country'] + " " + res1[0]['ab_zipcode']);
							        $(".sum_process_lane").text(res1[0]['reference_no']);
							        $(".sum_branch_name").text(res1[0]['reference_no']);
							        $(".sum_app_date").text(res1[0]['reference_no']);
							        $(".sum_app_time").text(res1[0]['reference_no']);
							        $('#viewAccountsModal').modal('show');
					  			}
					  		}
					  	}); 
		        	}else{
		        		$.toast({
						    heading: 'Warning',
						    text: "Please click on 'SCAN QR CODE' button before scanning.",
						    icon: 'warning',
						    loader: false,   
						    stack: false,
						    position: 'top-center',  
						    bgColor: '#f0ad4e;',
							textColor: 'white'        
						});
						qrcode = "";
		        	}
		    	}else{
	    			$.toast({
					    heading: 'Warning',
					    text: "Invalid QR Code",
					    icon: 'warning',
					    loader: false,   
					    stack: false,
					    position: 'top-center',  
					    bgColor: '#f0ad4e;',
						textColor: 'white'        
					});
					qrcode = "";
		    	}
	        }   
	    });
		
	});

	$(".btnStopScan").click(function(e){
		e.preventDefault();
		$(".backdrop").fadeOut(200);
		scanning = false;
	});
	
	$('#table-grid').delegate(".btnDelete","click", function(){
		var app_id = $(this).data('value');
		$.ajax({
	  		type: 'post',
	  		url: base_url+'Main/getInfoTransactionApplicationUsingID',
	  		data:{'app_id':app_id},
	  		success:function(data){
	  			var res = data.result;
	  			if (data.success == 1) {
	  					// $(".del_app_id").val(res[0].applicant_id);
	  					$(".reference_del").html('Reference No. ' + res[0].reference_no);
	  					$(".del_application_id").val(app_id);
	  				}
	  			}
	  		});
		$('#deleteAccountsModal').modal('show');

	});


	$('.deleteAccountBtn').click(function(e){
		e.preventDefault();

		var del_app_id = $(".del_application_id").val();

		$.ajax({
			type:'post',
			url:base_url+'Main/deleteAdminTransactionsApplications',
			data: {'del_app_id':del_app_id},
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



	$(".goToEditModalAccountsBtn").click(function(e){
		e.preventDefault();
			$('#viewAccountsModal').modal('toggle');
			$('#approveApplicationModal').modal('show'); 
	});

	$(".goToRejectModalApplicationBtn").click(function(e){
		e.preventDefault();
			$('#viewAccountsModal').modal('toggle');
			$('#rejectApplicationModal').modal('show'); 
		
	});

	$('.uploaded_images').click(function(e){
		e.preventDefault();
		$('#uploadedImagesModal').modal('show');
	})


	$("#approve_applicationinfo-form").submit(function(e){
		e.preventDefault();
		var app_ref_no = $('.app_id').val();

		$.ajax({
			type:'post',
			url:base_url+'Main/confirmAppearanceAdminTransactionsApplications',
			data:{"app_ref_no":app_ref_no},
			success:function(data){
				if (data.success == 1) {
					var res = data.application_info;
					var note = "This person has been confirmed to have personally appeared at "+ res['branch_name'] 
  					+ " on " + moment(res['appointment_date']).format('L') +".";
  					$(".appearance_note").html(note);
  					$(".appearance_note").css('display','block');
  					$(".goToConfirmAppearanceModalBtn").css('display','none');
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
					$('#confirmAppearanceModal').modal('toggle'); //close modal
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

	$("#reject_applicationinfo-form").submit(function(e){
		e.preventDefault();
		var serial = $(this).serialize();
		var app_ref_no = $('.app_id').val();

		$.ajax({
			type:'post',
			url:base_url+'Main/rejectAdminTransactionsApplications',
			data:{serial,"app_ref_no":app_ref_no},
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
					$('#rejectApplicationModal').modal('toggle'); //close modal
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

	$("#cancelBtn").click(function(e){
		e.preventDefault();
		$('#viewAccountsModal').modal('toggle'); 
	});

	$(".goToConfirmAppearanceModalBtn").click(function(e){
		e.preventDefault();
		$('#confirmAppearanceModal').modal('show'); 
	})

	$(".closeConfirmApperanceModal").click(function(e){
		e.preventDefault();
		$('#confirmAppearanceModal').modal('toggle');
	})
	
});