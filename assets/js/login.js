$(function(){
	var base_url = $("body").data('base_url'); //base_url come from php functions base_url();
	
	$("#login-form").submit(function(e){
		e.preventDefault();
		var serial = $(this).serialize();

		var loginEmail = $("#login-username").val();
		var loginPassword = $("#login-password").val();

		if (loginEmail == '' || loginPassword == '') {
			
		}else{
			$.ajax({
				type: 'post',
				url: base_url+'Main/login',
				data: serial,
				beforeSend:function(data){
					$('.btnLogin').attr('disabled',true);
				},
				success:function(data){
					$('.btnLogin').attr('disabled',false);
					
					if(data.success == 1) {
						var userData = data.userData;
						var token = data.token_session;
						// if(data.visible == 1)
						window.location.href = ''+base_url+'Main/home/'+token;
						
					}else {
						$.toast({
						    heading: 'Warning',
						    text: data.message,
						    icon: 'warning',
						    loader: false,  
						    stack: false,
						    position: 'top-center', 
							allowToastClose: false,
							bgColor: '#f0ad4e;',
							textColor: 'white'  
						});
						// setTimeout(function() {
							
						// }, 5000);
					}
				}
			});
		}
		
	});

	$("#reset_passForm").submit(function(e){
		e.preventDefault();
		var serial = $(this).serialize();
		if ($(".emailAddreset").val() != "") {
		$.ajax({
			type: 'post',
			url: base_url+'Main/reset_password',
			data: serial,
			beforeSend:function(data){
				$('#resetPasswordBtn').attr('disabled',true);

				$('#resetPasswordBtn').val('Please wait...');
			},
			success:function(data){

				$('#resetPasswordBtn').attr('disabled',false);
				$('#resetPasswordBtn').val('Reset My Password');
				if (data.success == 1) {
					$('#resetPasswordBtn').attr('disabled',true);

					$.toast({
					    heading: 'Success',
					    text: data.message, //'Email Sent! Please check your email for resetting password.',
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
						allowToastClose: false,
						bgColor: '#f0ad4e;',
						textColor: 'white'  
					});
				}
			}
		});

		}else{
			$.toast({
			    heading: 'Warning',
			    text: 'Please Enter your valid email address',
			    icon: 'warning',
			    loader: false,  
			    stack: false,
			    position: 'top-center', 
				allowToastClose: false,
				bgColor: '#f0ad4e;',
				textColor: 'white'  
			});
		}
		
	});

	$('.js-example-basic-single').select2({
		placeholder: 'Select an option'
	});
});