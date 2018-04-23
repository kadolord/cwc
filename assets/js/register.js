$(function(){
	var base_url = $("body").data('base_url'); //base_url come from php functions base_url();
	$('.btnregCancel').click(function(e){
		e.preventDefault();
		window.location.href = ''+base_url+'/Main/index'+'';
	});

	$('#register-form').on('keyup keypress', function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) { 
            e.preventDefault();
            return false;
        }
    });

	href="<?=base_url('Main/index');?>"

	$('.datepicker2').datepicker({});
	$('.registerBday').datepicker({
		endDate: '+0d',
	});


	$(".btnReg").click(function(e){
		e.preventDefault();
		var serial = $('#register-form').serialize();
		var error = 0;
		$('.required_fields2').each(function(){ //loop all input field then validate
			if ($(this).val() == ""){
				$(this).css("border-color", "#d9534f"); //change all empty to color red
			}else{
				$(this).css("border-color", "#eee");  //rollback when not empty
			}
		});

		$('.required_fields2').each(function(){ //loop all input field then validate
			if ($(this).val() == ""){ // if empty show error
				error = 1; //update error to 1
				// $(this).css("border-color","#d9534f");
				$(this).focus();
				$.toast({
				    heading: 'Warning',
				    text: 'Please fill out this field',
				    icon: 'warning',
				    loader: false,   
				    stack: false,
				    position: 'top-center',     
				    bgColor: '#f0ad4e;',
					textColor: 'white'
				});

				return false; //focus first empty fields
			}
		});

		if(error == 0){
			
			$.ajax({
				type: 'post',
				url: base_url+'Main/register_user',
				data: serial,
				beforeSend:function(data){
					$('.btnReg').attr('disabled',true);
					$('.btnReg').text('Please wait...');
					$('#buttonBack2').attr('disabled',true);
				},
				success:function(data){
					if(data.success == 1) {
						$.toast({
						    heading: 'Success',
						    text: 'Successfully Registered! Please check your email for verification.',
						    icon: 'success',
						    loader: false,  
						    stack: false,
						    position: 'top-center', 
						    bgColor: '#5cb85c',
							textColor: 'white',
							allowToastClose: false,
							hideAfter: 10000
						});
						setTimeout(function() {
							window.location.href = ''+base_url+'/Main/index'+'';
							$('.btnReg').attr('disabled',false);
							$('#buttonBack2').attr('disabled',false);
						}, 5000);

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
						setTimeout(function() {
							$('.btnReg').attr('disabled',false);
							$('#buttonBack2').attr('disabled',false);
							$('.btnReg').text('Register');
						}, 3000);
					}
				}
			});
		}
		
	});

	$('#understoodCheck').click(function(e){
		
		if($(this).is(':checked')){
			$('#buttonNext').prop('hidden',false);
		}else{
			$('#buttonNext').prop('hidden',true);
		}
	});

	$('#buttonNext').click(function(e){
		e.preventDefault();
		var step1 = $('.step1');
		var step2 = $('.step2');
		step2.show(); 
        //hide the current fieldset with style
        step1.animate({opacity: 0}, {
            step: function(now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale current_fs down to 80%
                // scale = 1 - (1 - now) * 0.2;
                //2. bring next_fs from the right(50%)
                left = (now * 50)+"%";
                //3. increase opacity of next_fs to 1 as it moves in
                opacity = 1 - now;
                step1.css({
           			'position': 'absolute'
          		});
                step2.css({'left': left, 'opacity': opacity});
            }, 
            duration: 1500, 
            complete: function(){
                step1.hide();
                animating = false;
            }, 
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });
		
	});

	$('#buttonNext2').click(function(e){
		e.preventDefault();
		var error = 0;
		// var thiss = $("#register-form");
		$('.required_fields').each(function(){ //loop all input field then validate
			if ($(this).val() == ""){
				$(this).css("border-color", "#d9534f"); //change all empty to color red
			}else{
				$(this).css("border-color", "#eee");  //rollback when not empty
			}
		});

		$('.required_fields').each(function(){ //loop all input field then validate
			if ($(this).val() == ""){ // if empty show error
				error = 1; //update error to 1
				// $(this).css("border-color","#d9534f");
				$(this).focus();
				$.toast({
				    heading: 'Warning',
				    text: 'Please fill out this field',
				    icon: 'warning',
				    loader: false,   
				    stack: false,
				    position: 'top-center',     
				    bgColor: '#f0ad4e;',
					textColor: 'white'
				});

				return false; //focus first empty fields
			}
		});

		if(error == 0){
			var email = $('.registerEmail').val();
			$('.registerEmail2').val(email);
			e.preventDefault();
			var step1 = $('.step1');
			var step2 = $('.step2');
			var step3 = $('.step3');
			step3.show(); 
	        //hide the current fieldset with style
	        step2.animate({opacity: 0}, {
	            step: function(now, mx) {
	                //as the opacity of current_fs reduces to 0 - stored in "now"
	                //1. scale current_fs down to 80%
	                // scale = 1 - (1 - now) * 0.2;
	                //2. bring next_fs from the right(50%)
	                left = (now * 50)+"%";
	                //3. increase opacity of next_fs to 1 as it moves in
	                opacity = 1 - now;
	                step2.css({ 'position': 'absolute' });
	                step3.css({'left': left, 'opacity': opacity});
	            }, 
	            duration: 1500, 
	            complete: function(){
	                step2.hide();
	                animating = false;
	            }, 
	            //this comes from the custom easing plugin
	            easing: 'easeInOutBack'
	        });
		}else{
			$.toast({
			    heading: 'Warning',
			    text: 'Please fill up all required fields',
			    icon: 'warning',
			    loader: false,   
			    stack: false,
			    position: 'top-center',     
			    bgColor: '#f0ad4e;',
				textColor: 'white'
			});	
		}
	});

	$('#buttonBack1').click(function(e){

		e.preventDefault();
		var step1 = $('.step1');
		var step2 = $('.step2');
		var step3 = $('.step3');
		step1.show(); 
            //hide the current fieldset with style
            step2.animate({opacity: 0}, {
                step: function(now, mx) {
                    left = ((1-now) * 200)+"%";
                    opacity = 1 - now;
                    step2.css({'left': left});
                    step1.css({'opacity': opacity});
                }, 
                duration: 1500, 
                complete: function(){
                    animating = false;
                }, 
                //this comes from the custom easing plugin
                easing: 'easeInOutBack'
            });
	});

	$('#buttonBack2').click(function(e){
		e.preventDefault();
		var step1 = $('.step1');
		var step2 = $('.step2');
		var step3 = $('.step3');
		step2.show(); 
            //hide the current fieldset with style
            step3.animate({opacity: 0}, {
                step: function(now, mx) {
                    //as the opacity of current_fs reduces to 0 - stored in "now"
                    //1. scale previous_fs from 80% to 100%
                    // scale = 0.8 + (1 - now) * 0.2;
                    //2. take current_fs to the right(50%) - from 0%
                    left = ((1-now) * 200)+"%";
                    //3. increase opacity of previous_fs to 1 as it moves in
                    opacity = 1 - now;
                    step3.css({'left': left});
                    step2.css({'opacity': opacity});
                    step2.css({
           			'position': 'relative'
          		});
                }, 
                duration: 1500, 
                complete: function(){
                    // current_fs.hide();
                    animating = false;
                }, 
                //this comes from the custom easing plugin
                easing: 'easeInOutBack'
            });

	});

    function getAge(dateString) {
        var today = new Date();
        var birthDate = new Date(dateString);
        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        return age;
    }

    //automatic age computation
    $('.registerBday').on('changeDate', function(){
        var date = $(this).val();
        if(date == ""){
            $('.registerAge').val("");
        }else{
            var age = getAge(date);
            $('.registerAge').val(age);
        }
        
    });	

    $('.registerBday').on('blur', function(e){
        var date = $(this).val();
        if(date == ""){
            $('.registerAge').val("");
        }else{
            var age = getAge(date);
            $('.registerAge').val(age);
        }
    });


});