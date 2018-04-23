
$(function(){
	var base_url = $("body").data('base_url'); //base_url come from php functions base_url();
	href="<?=base_url('Main/index');?>";

	$('.datepicker3').datepicker({
		startDate: '+1d',
		endDate: '+1d',
		weekStart: 0,
		daysOfWeekDisabled: [0,6],
		format: 'yyyy/mm/dd',
		autoclose: true, 
	    todayHighlight: true
	    // beforeShowDay: function (date){
	    // 	return false;
	    // }
	}).on('changeDate', function(e){
		if($('.branch_name2').val() == ""){
			$.toast({
			    heading: 'Warning',
			    text: "Please select Branch first",
			    icon: 'warning',
			    loader: false,   
			    stack: false,
			    position: 'top-center',  
			    bgColor: '#f0ad4e',
				textColor: 'white'        
			});
		}
	});

	var holidays = [];

	function initialize_datepicker(start_date,end_date,dates_with_sched){
		var start_date =start_date;
  		var end_date =end_date;
  		var dates_with_sched = dates_with_sched;

		$.ajax({
			type: 'get',
			url: base_url+'Main/get_holiday',
			success:function(data){

				var res = data.result;
				for(var x = 0; x < res.length; x++){
					holidays.push(res[x].holiday_date.replace(/(^|-)0+/g, "$1"));
				}
	  			trigger_datepicker2(holidays,start_date,end_date, dates_with_sched);
	  			trigger_datepicker3(holidays,start_date,end_date, dates_with_sched);
	  			
			}
	  	});
	}

  	$('.branch_name2').on('change', function() { //adding schedule limit
  			
  		var sched_branch_limit_id = $(this).val();
  		// $('.sched_div').prop('hidden',false);
	 	$.ajax({
			type: 'post',
			data: {'sched_branch_limit_id': sched_branch_limit_id },
			url: base_url+'Main/getInfoSchedLimitUsingBranchID',
			success:function(data){
				var res = data.result;
				var db_start_date = data.start_date;
				var db_end_date = data.end_date;
				var dates_with_sched = data.dates_with_sched;
				if(res.length != 0){
					var today = new Date();
					var dd = today.getDate();
					var mm = today.getMonth()+1; //January is 0!
					var yyyy = today.getFullYear();

					if(dd<10) {
					    dd = '0'+dd
					} 

					if(mm<10) {
					    mm = '0'+mm
					} 
					today = yyyy + '-' + mm + '-' + dd;
					
					// if(today> res[0].start_date)
					if(today > db_start_date)
					{
						start_date = today;
					}else{
						start_date = db_start_date;
						// start_date = res[0].start_date;
					}

					// end_date = res[0].end_date;
					end_date = db_end_date;
				} else{
					var today = new Date();
					var dd = today.getDate();
					var mm = today.getMonth()+1; //January is 0!
					var yyyy = today.getFullYear();

					if(dd<10) {
					    dd = '0'+dd
					} 

					if(mm<10) {
					    mm = '0'+mm
					} 
					today = yyyy + '-' + mm + '-' + dd;
					start_date = today;
					end_date = today;
					$.toast({
					    heading: 'Warning',
					    text: "There are no available schedule for this branch yet",
					    icon: 'warning',
					    loader: false,   
					    stack: false,
					    position: 'top-center',  
					    bgColor: '#f0ad4e',
						textColor: 'white'        
					});
				}
				
				initialize_datepicker(start_date,end_date, dates_with_sched);
			}
  		});	
	});

	$('.branch_name').on('change', function() { //adding schedule limit
  			
  		var sched_branch_limit_id = $(this).val();
	 	$.ajax({
			type: 'post',
			data: {'sched_branch_limit_id': sched_branch_limit_id },
			url: base_url+'Main/getInfoSchedLimitUsingBranchID',
			success:function(data){
				var res = data.result;
				
				if(res.length != 0){
					var today = new Date();
					var dd = today.getDate();
					var mm = today.getMonth()+1; //January is 0!
					var yyyy = today.getFullYear();

					if(dd<10) {
					    dd = '0'+dd
					} 

					if(mm<10) {
					    mm = '0'+mm
					} 
					today = yyyy + '-' + mm + '-' + dd;
					
					if(today> res[0].start_date){
						start_date = today;
					}else{
						start_date = res[0].start_date;
					}

					end_date = res[0].end_date;
				} else{
					var today = new Date();
					var dd = today.getDate();
					var mm = today.getMonth()+1; //January is 0!
					var yyyy = today.getFullYear();

					if(dd<10) {
					    dd = '0'+dd
					} 

					if(mm<10) {
					    mm = '0'+mm
					} 
					today = yyyy + '-' + mm + '-' + dd;
					start_date = today;
					var today2 = new Date();
					var dd = today2.getDate();
					var mm = today2.getMonth()+12; //January is 0!
					var yyyy = today2.getFullYear();

					if(dd<10) {
					    dd = '0'+dd
					} 

					if(mm<10) {
					    mm = '0'+mm
					} 
					today2 = yyyy + '-' + mm + '-' + dd;

					end_date = today2;
					$.toast({
					    heading: 'Warning',
					    text: "There are no available schedule for this branch yet",
					    icon: 'warning',
					    loader: false,   
					    stack: false,
					    position: 'top-center',  
					    bgColor: '#f0ad4e',
						textColor: 'white'        
					});
				}
				
				initialize_datepicker(start_date,end_date,dates_with_sched);
			}
  		});	
	});

  	function trigger_datepicker2(holidays, start_date,end_date, dates_with_sched){  

  		if($('.datepicker2').data('datepicker')){// or $('#user-date').data('datepicker')==null
		    $('.datepicker2').datepicker('remove');
		} 
		$('.tba_appointment-time').html('');
		$('.appointment-date').val('');

		$('.datepicker2').datepicker({
			startDate: start_date, 
  			endDate: end_date,
			daysOfWeekDisabled: [0,6], //disable weekends
			format: 'yyyy/mm/dd', //format
	    	autoclose: true, 
	        todayHighlight: true,
	        beforeShowDay:function(Date){ //disable holiday
				var curr_day = Date.getDate();
		        var curr_month = Date.getMonth()+1;
		        var curr_year = Date.getFullYear();        
		        var curr_date = curr_year+'-'+curr_month+'-'+curr_day;  
	        if (holidays.indexOf(curr_date)>-1) return false; 
			}
			}).on('changeDate', function(e){
					
				$renderHTML = '<option class="" value="" selected hidden>Select Available Time</option>';
	            $renderHTML += '<option class="opt_val" value="1"> 8:00 AM</option>';
	            $renderHTML += '<option class="opt_val" value="2"> 9:00 AM</option>';
	            $renderHTML += '<option class="opt_val" value="3"> 10:00 AM</option>';
	            $renderHTML += '<option class="opt_val" value="4"> 11:00 AM</option>';
	            $renderHTML += '<option class="opt_val" value="5"> 12:00 PM</option>';
	            $renderHTML += '<option class="opt_val" value="6"> 1:00 PM</option>';
	            $renderHTML += '<option class="opt_val" value="7"> 2:00 PM</option>';
	            $renderHTML += '<option class="opt_val" value="8"> 3:00 PM</option>';
	            $renderHTML += '<option class="opt_val" value="9"> 4:00 PM</option>';

				var date = e.format('mm/dd/yyyy');
				var branch_id = $(".branch_name option:selected").val();

				$.ajax({
				type:'post',
				url: base_url+'Main/get_available_appointment_date',
				data: {date, branch_id},
				beforeSend:function(data){
				
					$('.appointment-time').html( $renderHTML);
				},
				success:function(data){					
					if(data.unavailable_time == false){
						
						$(".opt_val").each(function(){
								$(this).prop('disabled',false);
							});
					}

					if(data.unavailable_time == true){
						var html = '<option selected="true" value="">No Slot Available</option>';
						$('.appointment-time').html(html);
						$.toast({
						    heading: 'Warning',
						    text: "This slot is not available for now",
						    icon: 'warning',
						    loader: false,   
						    stack: false,
						    position: 'top-center',  
						    bgColor: '#f0ad4e',
							textColor: 'white'        
						});
					}

					if(data.unavailable_time != null){

						var today = new Date();
						var dd = today.getDate();
						var mm = today.getMonth()+1; //January is 0!
						var yyyy = today.getFullYear();

						if(dd<10) {
						    dd = '0'+dd
						} 

						if(mm<10) {
						    mm = '0'+mm
						} 
						today2 = mm + '/' + dd + '/' + yyyy;

						// Today's time will not be available on the sched
						if(date == today2 ){
							var h = today.getHours();
							if(h > 16){
								var html = '<option selected="true" value="">No Slot Available</option>';
								$('.appointment-time').html(html);
							}else{
								var current_time = h-7;
								$(".opt_val").each(function(){
									if (current_time >= $(this).val()) {
										$(this).remove(); 
										// $(this).prop('disabled','disabled'); 
									}
								});
							}
						}

						for( var i = 0; i < data.unavailable_time.length; i++ ){
							$(".opt_val").each(function(){
								if (data.unavailable_time[i] == $(this).val()) {
									$(this).remove(); 
									// $(this).prop('disabled','disabled'); 
								}
							});
						}
					}					
				}

			});
		}); //adding holidays
	}

	function trigger_datepicker3(holidays, start_date, end_date, dates_with_sched){
	
		if($('.datepicker3').data('datepicker')){// or $('#user-date').data('datepicker')==null
		    $('.datepicker3').datepicker('remove');
		}  

		$('.appointment-time').html('');
		$('.appointment-date').html('');


		$('.datepicker3').datepicker({
			startDate: start_date,
  			endDate: end_date,
			format: 'yyyy/mm/dd',
	    	daysOfWeekDisabled: [0,6],
	    	autoclose: true, 
	        todayHighlight: true,
	        format: 'yyyy/mm/dd',
	        beforeShowDay:function(Date){
				var curr_day = Date.getDate();
		        var curr_month = Date.getMonth()+1;
		        var curr_year = Date.getFullYear();        
		        var curr_date = curr_year+'-'+curr_month+'-'+curr_day;
	        	if (holidays.indexOf(curr_date)>-1) return false; 
			}

			}).on('changeDate', function(e){
					
				$renderHTML = '<option class="" value="" selected hidden>Select Available Time</option>';
	            $renderHTML += '<option class="opt_val" value="1"> 8:00 AM</option>';
	            $renderHTML += '<option class="opt_val" value="2"> 9:00 AM</option>';
	            $renderHTML += '<option class="opt_val" value="3"> 10:00 AM</option>';
	            $renderHTML += '<option class="opt_val" value="4"> 11:00 AM</option>';
	            $renderHTML += '<option class="opt_val" value="5"> 12:00 PM</option>';
	            $renderHTML += '<option class="opt_val" value="6"> 1:00 PM</option>';
	            $renderHTML += '<option class="opt_val" value="7"> 2:00 PM</option>';
	            $renderHTML += '<option class="opt_val" value="8"> 3:00 PM</option>';
	            $renderHTML += '<option class="opt_val" value="9"> 4:00 PM</option>';

				var date = e.format('mm/dd/yyyy');
				$('.tba_appointment-date').val(date);
				var branch_id = $(".branch_name2 option:selected").val();
			
				$.ajax({
					type:'post',
					url: base_url+'Main/get_available_appointment_date',
					data: {date, branch_id},
					beforeSend:function(data){
						$('.tba_appointment-time').html( $renderHTML);
					},
					success:function(data){
						var res = data.unavailable_time;
						if(res == "false"){
							
							$(".opt_val").each(function(){
									
								$(this).prop('disabled',false);
								
							});
						}else if(res == "true"){
							var html = '<option selected="true" value="">No Slot Available</option>';
							$('.tba_appointment-time').html(html);
							$.toast({
							    heading: 'Warning',
							    text: "No Slot Available",
							    icon: 'warning',
							    loader: false,   
							    stack: false,
							    position: 'top-center',  
							    bgColor: '#f0ad4e',
								textColor: 'white',
								hideAfter: 1000        
							});
							
						}else{
							var today = new Date();
							var dd = today.getDate();
							var mm = today.getMonth()+1; //January is 0!
							var yyyy = today.getFullYear();

							if(dd<10) {
							    dd = '0'+dd
							} 

							if(mm<10) {
							    mm = '0'+mm
							} 
							today2 = mm + '/' + dd + '/' + yyyy;

							if(date == today2 ){
								var h = today.getHours();
								if(h > 16){
									var html = '<option selected="true" value="">No Slot Available</option>';
									$('.tba_appointment-time').html(html);
								}else{
									var current_time = h-7;
									$(".opt_val").each(function(){
										if (current_time >= $(this).val()) {
											$(this).remove(); 
											// $(this).prop('disabled','disabled'); 
										}
									});
								}
							}
							
							for( var i = 0; i < res.length; i++ ){
								$(".opt_val").each(function(){
									if (res[i] == $(this).val()) {
										$(this).remove(); 
										// $(this).prop('disabled','disabled'); 
									}
								});
							}
						}					
					}

			});
		});
	}

	$(".goToEditModalAccountsBtn").click(function(e){
		e.preventDefault();
		var center_id = $('.branch_name').val();
		$('.branch_name').val(center_id); 
		$('#editAppointmentModal').modal('show'); 
		$('#viewAppointmentModal').modal('toggle'); //close modal
	});

	$(".EditAccountsModalBtn").click(function(e){
		
		e.preventDefault();

		var thiss = $("#edit_appointmentinfo-form");

		var serial = thiss.serialize();


		$.ajax({
			type:'post',
			url: base_url+'Main/update_appointment',
			data: serial,
			beforeSend:function(data){
				$(".cancelBtn, .saveBtnAccounts").prop('disabled', true); 
				$(".saveBtnAccounts").text("Please wait...");
				
			},
			success:function(data){
				$(".cancelBtn, .saveBtnAccounts").prop('disabled', false);
				$(".saveBtnAccounts").text("Add");
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
						hideAfter: 5000
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

		$('#deleteAppointmentModal').modal('show');
		$(".del_appointment_id").val($(this).data('value'));

	});


	$('.deleteAppointmentBtn').click(function(e){
		e.preventDefault();

		var del_appointment_id = $(".del_appointment_id").val();

		$.ajax({
			type:'post',
			url:base_url+'Main/deleteAppointment',
			data:{'del_appointment_id':del_appointment_id},
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
					dataTable.draw();
					$("#btnClickAddAppointment").css("display","block");
					$('#deleteAppointmentModal').modal('toggle'); //close modal
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
			}, 
		});
	});

	$('#table-grid').delegate(" .btnView", "click", function(){
		$('#viewAppointmentModal').modal('show');
	})

	$('#table-grid').delegate(" .btnView", "click", function(){

	  	var app_id = $(this).data('value');
	  	$.ajax({
	  		type: 'post',
	  		url: base_url+'Main/getInfoTransactionAppointmentUsingID',
	  		data:{'app_id':app_id},
	  		success:function(data){
	  			var res = data.result;
	  			if (data.success == 1) {

	  					// for view
	  					$(".info_app_branch").val(res[0].branch_name);
		  				$(".info_app_date").val(res[0].appointment_datesched);
						$(".info_app_time").val(res[0].timesched_description);
						
						// for delete
						$(".del_appointment_id").val(res[0].appointment_id);

						// for edit
						$(".tbe_appointment_id").val(res[0].appointment_id);
						$(".branch_name").val(res[0].branch_id).trigger('change');//for select2
		  				$(".appointment-date").val(res[0].appointment_datesched);
						// $(".appointment-time").text(res[0].timesched_description);
	  				}
	  				dataTable.draw(); //refresh table
	  			}
	  	});
	});

	$('#btnSched').click(function(e){
		e.preventDefault();

		var html = "<p> You are trying to create an appointment in " + "<strong>" + $('.branch_name2 option:selected').text() + '</strong>'; 
		html += " at " + "<strong>" + $('.tba_appointment-time option:selected').text() + '</strong>';
		html += " on " + "<strong>" + $('.datepicker3').val() + '</strong>' + ".<br><br>";
		html += "Please click 'Save' to confirm application. </p>"
		
		$('#confirmAppointmentModal').modal('show'); //open modal
		$('.confirm_appointment').html(html);

	});

	$(".saveAppointmentBtn").click(function(e){

		e.preventDefault();

		var thiss = $("#schedForm");
		var serial = thiss.serialize();

		e.preventDefault();
		
		$.ajax({
			type:'post',
			url: base_url+'Main/schedule_appointment',
			data: serial,
			beforeSend:function(data){
				$(".saveAppointmentBtn").prop('disabled', true); 
				
			},
			success:function(data){
				$(".saveAppointmentBtn").prop('disabled', false);
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
						hideAfter: 10000
					});
					// dataTable.draw();
					// $("#btnClickAddAppointment").css("display","none");
					$('#confirmAppointmentModal').modal('toggle'); //close modal
					setTimeout(function () { 
					      location.reload();
					 }, 2 * 1000);
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

	$('.goToEditModalAppointmentBtn').click(function(e){
		e.preventDefault();
	});

	$('.goToEditModalAppointmentBtn').click(function(e){
		e.preventDefault();
		var serial = $('#edit_appointment-form').serialize();

		$.ajax({
			type:'post',
			url:base_url+'Main/edit_appointment',
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
					$('#editAppointmentModal').modal('toggle'); //close modal
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

	$('#goToReschedConfirmModal').click(function(e){
		e.preventDefault();
		$('#confirmReschedModal').modal('show'); //close modal

		var html = "<p> You are trying to reschedule your appointment at " + "<strong>" + $('.info_app_branch').val() + '</strong>'; 
		html += " at " + "<strong>" + $('.info_app_time').val() + '</strong>';
		html += " on " + "<strong>" + $('.info_app_date').val() + '</strong>' + ".<br><br>";
		html += "Please note that there will be corresponding Reschedule Fee everytime you try to change your scheduled appointment.<br><br> "
		html += "Click 'Proceed'  if you wish to continue on the reschedule process. </p>";

		$('#confirmResched').html(html);


	})


	
});