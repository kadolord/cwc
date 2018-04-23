$(function(){
	var base_url = $("body").data('base_url'); //base_url come from php functions base_url();
	$('.btnregCancel').click(function(e){
		e.preventDefault();
		window.location.href = ''+base_url+'/Main/index'+'';
	});

	href="<?=base_url('Main/index');?>"

	$("select").select2();
	$('.datepicker').datepicker({});

	$("#register-form").submit(function(e){
		e.preventDefault();
		var serial = $(this).serialize();

		if ($('.termsCheckbox').is(':checked')){
			$.ajax({
				type: 'post',
				url: base_url+'Main/register_user',
				data: serial,
				beforeSend:function(data){
					$('.btnReg').attr('disabled',true);
					$('.btnReg').text('Please wait...');
					$('.btnregCancel').attr('disabled',true);
				},
				success:function(data){
					$('.btnReg').text('Register');
					$('.btnReg').attr('disabled',false);
					$('.btnregCancel').attr('disabled',false);
					if(data.success == 1) {
						$('.btnReg').attr('disabled',true);
						$('.btnregCancel').attr('disabled',true);
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
						// $(".loginForm .alert").fadeIn();

						// setTimeout(function() {
						// 	$(".loginForm .alert").fadeOut();
						// }, 5000);
					}
				}
			});
		}else{
			$.toast({
			    heading: 'Warning',
			    text: 'Please check Terms and Conditions',
			    icon: 'warning',
			    loader: false,   
			    stack: false,
			    position: 'top-center',     
			    bgColor: '#f0ad4e;',
				textColor: 'white'
			});
		}
		
	});
	//edwin

	$('#understoodCheck').click(function(e){
		
		if($(this).is(':checked')){
			$('#buttonNext').prop('hidden',false);
		}else{
			$('#buttonNext').prop('hidden',true);
		}
	});

	$('#buttonNext').click(function(e){
		e.preventDefault();
			$('.step1').css('overflow',"hidden");
			$('.step1').css('position',"absolute");
			$('.step1').hide('slide', {direction: 'left'}, 1000);
			$('.step2').stop().show('slide', {direction: 'right'}, 1000);

			setTimeout(function(){
				$('.step1').css('overflow',"visible");
				$('.step1').css('position',"static");

			},2000);
	});

	$('#buttonNext2').click(function(e){
		e.preventDefault();
			$('.step2').css('overflow',"hidden");
			$('.step2').css('position',"absolute");
			$('.step2').hide('slide', {direction: 'left'}, 1000);
			$('.step3').stop().show('slide', {direction: 'right'}, 1000);

			setTimeout(function(){
				$('.step2').css('overflow',"visible");
				$('.step2').css('position',"static");

			},2000);
	});

	$('#buttonBack1').click(function(e){
		e.preventDefault();
			// $('.step1').css('overflow',"hidden");
			// $('.step1').css('position',"absolute");
			// $('.step1').hide('slide', {direction: 'right'}, 1000);
			// $('.step2').stop().show('slide', {direction: 'right'}, 1000);

			// setTimeout(function(){
			// 	$('.step1').css('overflow',"visible");
			// 	$('.step1').css('position',"static");

			// },2000);

		$('.step2').hide('slide', {direction: 'right'}, 1000);
		$('.step1').stop().show('slide', {direction: 'left'}, 1000);
		$(".card-body").css("height","315px");
		setTimeout(function(){
			$(".card-body").css("height","auto");
		},1000);
	});

	$('#buttonBack2').click(function(e){
		e.preventDefault();

		$('.step3').hide('slide', {direction: 'right'}, 1000);
		$('.step2').stop().show('slide', {direction: 'left'}, 1000);
		$(".card-body").css("height","315px");
		setTimeout(function(){
			$(".card-body").css("height","auto");
		},1000);
	});





});