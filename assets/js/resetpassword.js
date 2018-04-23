$(function(){
	var base_url = $("body").data('base_url'); //base_url come from php functions base_url();
	var email =  $("body").data('email'); // get email

	$("#resetpass-form").submit(function(e){
		e.preventDefault();

		var resetpassPassword = $("#resetpass-password").val();
		var resetpassRepassword = $("#resetpass-repassword").val();

		if (resetpassPassword == '' || resetpassRepassword == '') {
			$.toast({
			    heading: 'Warning',
			    text: 'Please fill-up all fields',
			    icon: 'warning',
			    loader: false,  
			    stack: false,
			    position: 'top-center', 
				allowToastClose: false,
				bgColor: '#f0ad4e;',
				textColor: 'white'  
			});
		}else{
			if (resetpassPassword == resetpassRepassword) {
				
				$.ajax({
					type:'post',
					url: base_url+'Main/resetpasswordUpdate',
					data: {"resetpassPassword":resetpassPassword, "resetpassRepassword":resetpassRepassword, "email":email},
					beforeSend:function(data){
						$('.btnResetpass').attr('disabled',true);
					},
					success:function(data){
						$('.btnResetpass').attr('disabled',false);

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
				    text: 'New Password and Re-type Password is not the same.',
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
});