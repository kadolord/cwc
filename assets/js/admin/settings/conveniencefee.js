$(function(){
	var base_url = $("body").data('base_url'); //base_url come from php functions base_url();

	$(".btnUpdate").click(function(e){
		e.preventDefault();
		$(".btnUpdate").hide();
		$(".btnCancel").show();
		$(".btnSaveChanges").show();
		$(".asterisk").prop('hidden', false	);

		$(".info_reg_debit").hide();
		$(".reg_debit").css("display", "block");

		$(".info_reg_credit").hide();
		$(".reg_credit").css("display", "block");

		$(".info_exp_debit").hide();
		$(".exp_debit").css("display", "block");

		$(".info_exp_credit").hide();
		$(".exp_credit").css("display", "block");

	})

	$(".btnCancel").click(function(e){
		e.preventDefault();
		$(".btnUpdate").show();
		$(".btnCancel").hide();
		$(".btnSaveChanges").hide();
		$(".asterisk").prop('hidden', true);


		$(".info_reg_debit").show();
		$(".reg_debit").css("display", "none");

		$(".info_reg_credit").show();
		$(".reg_credit").css("display", "none");

		$(".info_exp_debit").show();
		$(".exp_debit").css("display", "none");

		$(".info_exp_credit").show();
		$(".exp_credit").css("display", "none");
	});

	$(".btnSaveChanges").click(function(e){
		e.preventDefault();
		var thiss = $('#conveniencefee_form');
		var serial = thiss.serialize();
		console.log(serial);
		var reg_debit = $(".reg_debit").val();
		var reg_credit = $(".reg_credit").val();
		var exp_debit = $(".exp_debit").val();
		var exp_credit = $(".exp_credit").val();

		if(reg_debit == "" || reg_credit == "" ||exp_debit==""||  exp_credit=="" ){
			$.toast({
			    heading: 'Warning',
			    text: "Please fill up all required fields",
			    icon: 'warning',
			    loader: false,   
			    stack: false,
			    position: 'top-center',  
			    bgColor: '#f0ad4e;',
				textColor: 'white'        
			});
		}else{
			$.ajax({
				type:'post',
				url: base_url+'Main/update_conveniencefee',
				data: serial,
				beforeSend:function(data){
					$(".btnSaveChanges").prop('disabled', true); 
					$(".btnSaveChanges").text("Please wait...");
				},
				success:function(data){
					$(".btnSaveChanges").prop('disabled', false); 
					$(".btnSaveChanges").css('display', 'none'); 
					$(".btnSaveChanges").text("Save Changes");
					if (data.success == 1) {
						
						$(".btnUpdate").show();
						$(".btnCancel").hide();
						$(".btnSaveChanges").hide();
						$(".asterisk").prop('hidden', true);

						$(".info_reg_debit").show();
						$(".reg_debit").css("display", "none");

						$(".info_reg_credit").show();
						$(".reg_credit").css("display", "none");

						$(".info_exp_debit").show();
						$(".exp_debit").css("display", "none");

						$(".info_exp_credit").show();
						$(".exp_credit").css("display", "none");

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
							hideAfter: 1500
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
			
		}
		
	});
});