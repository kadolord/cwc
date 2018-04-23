$(function(){

	var base_url = $("body").data('base_url'); //base_url come from php functions base_url();

	$('.gotoReschedStepModal').click(function(e){
		e.preventDefault();
		$('#reschedStepModal').modal('show');
		$('#confirmReschedModal').modal('toggle');

	});
	

	$('#table-grid').delegate(" .btnView", "click", function(){

	  	var app_id = $(this).data('value');
	  	$.ajax({
	  		type: 'post',
	  		url: base_url+'Main/getInfoTransactionApplicationUsingID',
	  		data:{'app_id':app_id},
	  		success:function(data){
	  			var res = data.result;
	  			
	  			if (data.success == 1) {

	  					$(".info_app_ref_number").val(res[0].reference_no);
		  				$(".info_app_date").val(res[0].application_date);
						$(".info_app_type").val(res[0].description);
						$(".info_app_fee").val(accounting.formatMoney(res[0].application_fee, "₱", 2));
						$(".info_app_req").val(res[0].requirement_description);
						$(".info_app_status").val(res[0].status_description);
						
						var html = ''
						for(var i = 0; i < res.length ; i++){
							html += "<img class='img-thumbnail img-fluid' src='";
							html += base_url+ "assets/img/applicant_requirements/" + res[i].uploaded_requirement;
							html += "'>";
						}
						$('.uploaded_images_container').html(html);
					


						if(res[0].application_status == 2){ //Rejected
							$('.rejection_reason_div').css('display', 'block');
							$(".info_app_rej_reason").val(res[0].rejection_reason);
						} else{
							$('.rejection_reason_div').css('display', 'none');
						}
	  				}
	  				dataTable.draw(); //refresh table
	  			}
	  	});
	});


		$(".BtnNext").click(function(e){
		e.preventDefault();
		// console.log(hasRequirement)
		  // var hasRequirement = $('input[type=file]').val();
		  	var hasSelectedBranchName  = $('.branch_name').val();
		  	var hasSelectedDate  = $('.appointment-date').val();
		  	var hasSelectedTime  = $('.appointment-time').val();

		  	var new_branch = $('.branch_name option:selected').text();
		  	var new_time = $('.appointment-time option:selected').text();

		if (hasSelectedBranchName != "" && hasSelectedDate != "" && hasSelectedTime != "" ) {

			$('.resched_branch').html(new_branch);
			$('.resched_date').html(hasSelectedDate);
			$('.resched_time').html(new_time);

			makeProgress(20,40);
			$('.step_label').text('Step 2 to 5'); //step 2
			$('.step1').css('overflow',"hidden");
			$('.step1').css('position',"absolute");
			$('.step1').hide('slide', {direction: 'left'}, 1000);
			$('.step2').stop().show('slide', {direction: 'right'}, 1000);

			// $(".BtnNext").prop("disabled",true);
			setTimeout(function(){
				$('.step1').css('overflow',"visible");
				$('.step1').css('position',"static");

			},2000);
		}
		  
		  else {
		    	$.toast({
			    heading: 'Warning',
			    text: 'Please fill up all required fields.',
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

	$(".select2").select2({});

	$(".BtnNext2").click(function(e){
		e.preventDefault();

			makeProgress(40,60);
			$('.step_label').text('Step 3 to 5'); //step 3
			
			
			$('.step2').css('overflow',"hidden");
			$('.step2').css('position',"absolute");
			$('.step2').hide('slide', {direction: 'left'}, 1000);
			$('.step3').stop().show('slide', {direction: 'right'}, 1000);

			// $(".BtnNext").prop("disabled",true);
			setTimeout(function(){
				$('.step2').css('overflow',"visible");
				$('.step2').css('position',"static");


			},2000);
	
	});

	$(".BtnNext3").click(function(e){
		e.preventDefault();

		makeProgress(60,80);
		$('.step_label').text('Step 4 to 5'); //step 4
		
		$('.step3').css('overflow',"hidden");
		$('.step3').css('position',"absolute");
		$('.step3').hide('slide', {direction: 'left'}, 1000);
		$('.step4').stop().show('slide', {direction: 'right'}, 1000);

		// $(".BtnNext").prop("disabled",true);
		setTimeout(function(){
			$('.step3').css('overflow',"visible");
			$('.step3').css('position',"static");


		},2000);
	});
	
	$(".BtnBack2").click(function(e){
		e.preventDefault();

		makeRollback(40,20);

		$('.step_label').text('Step 1 to 5'); //step 1
		$('.step2').hide('slide', {direction: 'right'}, 1000);
		$('.step1').stop().show('slide', {direction: 'left'}, 1000);

		$(".card-body").css("height","315px");
		setTimeout(function(){
			$(".card-body").css("height","auto");
		},1000);

		sum_of_amount = 0; //set to 0 the amount to prevent bubbles
		//console.log(sum_of_amount);

		$(".summary_totalamt").val(sum_of_amount);
		
	});

	$(".BtnBack3").click(function(e){
		e.preventDefault();

		makeRollback(60,40);

		$('.step_label').text('Step 2 to 5'); //step 2
		$('.step3').hide('slide', {direction: 'right'}, 1000);
		$('.step2').stop().show('slide', {direction: 'left'}, 1000);

		$(".card-body").css("height","315px");
		setTimeout(function(){
			$(".card-body").css("height","auto");
		},1000);
	});

	$(".BtnBack4").click(function(e){
		e.preventDefault();

		makeRollback(80,60);

		$('.step_label').text('Step 3 to 5'); //step 3
		$('.step4').hide('slide', {direction: 'right'}, 1000);
		$('.step3').stop().show('slide', {direction: 'left'}, 1000);

		$(".card-body").css("height","315px");
		setTimeout(function(){
			$(".card-body").css("height","auto");
		},1000);
	});

	$(".BtnProceed").click(function(e){
		e.preventDefault();
		$('.step_label').text('Step 5 to 5'); //step 5
		makeProgress(80,100);

		$('.step4').css('overflow',"hidden");
		$('.step4').css('position',"absolute");
		$('.step4').hide('slide', {direction: 'left'}, 1000);
		$('.step5').stop().show('slide', {direction: 'right'}, 1000);

		// $(".BtnNext").prop("disabled",true);
		setTimeout(function(){
			$('.step4').css('overflow',"visible");
			$('.step4').css('position',"static");
		},2000);

	});

	$(".BtnNext, .BtnBack, .BtnNext2, .BtnNext3, .BtnBack2, .BtnBack3, .BtnBack4, .BtnProceed").click(function(e){
		e.preventDefault();
		var text_label = $('.step_label').text();
		if (text_label == 'Step 1 to 5') {

			$(".label-top_up").text('E-Wallet Top Up');
			$(".BtnNext").prop("hidden",false);
			$(".BtnBack").prop("hidden",true);
			$(".BtnNext2").prop("hidden",true);
			$(".BtnBack2").prop("hidden",true);
			$(".BtnNext3").prop("hidden",true);
			$(".BtnBack4").prop("hidden",true);

			$(".BtnBack3").prop("hidden",true);
			$(".BtnProceed").prop("hidden",true);

		}else if (text_label == 'Step 2 to 5') {
			
			$(".label-top_up").text('Top Up Summary');
			$(".BtnNext").prop("hidden",true);
			$(".BtnBack").prop("hidden",true);
			$(".BtnNext3").prop("hidden",true);
			$(".BtnBack4").prop("hidden",true);

			$(".BtnNext2").prop("hidden",false);
			$(".BtnBack2").prop("hidden",false);

			$(".BtnBack3").prop("hidden",true);
			$(".BtnProceed").prop("hidden",true);
			

		}else if (text_label == 'Step 3 to 5') {

			$(".label-top_up").text('Settle Payment');
			$(".BtnNext").prop("hidden",true);
			$(".BtnBack").prop("hidden",true);
			$(".BtnNext2").prop("hidden",true);
			$(".BtnBack2").prop("hidden",true);
			$(".BtnNext3").prop("hidden",false);
			$(".BtnBack4").prop("hidden",true);

			$(".BtnBack3").prop("hidden",false);
			$(".BtnProceed").prop("hidden",true);

		}
		else if (text_label == 'Step 4 to 5') {

			$(".label-top_up").text('Top Up Completed');
			$(".BtnNext").prop("hidden",true);
			$(".BtnBack").prop("hidden",true);
			$(".BtnNext2").prop("hidden",true);
			$(".BtnBack2").prop("hidden",true);

			$(".BtnNext3").prop("hidden",true);
			$(".BtnBack3").prop("hidden",true);

			$(".BtnBack4").prop("hidden",false);
			$(".BtnProceed").prop("hidden",false);

		}else if (text_label == 'Step 5 to 5') {

			$(".label-top_up").text('Top Up Completed');
			$(".BtnNext").prop("hidden",true);
			$(".BtnBack").prop("hidden",true);
			$(".BtnNext2").prop("hidden",true);
			$(".BtnBack2").prop("hidden",true);
			
			$(".BtnNext3").prop("hidden",true);
			$(".BtnBack4").prop("hidden",true);
			$(".BtnBack3").prop("hidden",true);
			$(".BtnProceed").prop("hidden",true);

		}else{

			$(".BtnNext").prop("hidden",true);
			$(".BtnBack").prop("hidden",true);
			$(".BtnNext2").prop("hidden",true);
			$(".BtnBack2").prop("hidden",true);
			$(".BtnNext3").prop("hidden",true);
			$(".BtnBack4").prop("hidden",true);
			$(".BtnBack3").prop("hidden",true);
			$(".BtnProceed").prop("hidden",true);

		}
		
		$(".BtnNext").prop("disabled",true);
		$(".BtnBack").prop("disabled",true);
		$(".BtnNext2").prop("disabled",true);
		$(".BtnBack2").prop("disabled",true);

		$(".BtnNext3").prop("disabled",true);
		$(".BtnBack4").prop("disabled",true);
		$(".BtnBack3").prop("disabled",true);
		$(".BtnProceed").prop("disabled",true);

		setTimeout(function(data){
			$(".BtnNext").prop("disabled",false);
			$(".BtnBack").prop("disabled",false);
			$(".BtnNext2").prop("disabled",false);
			$(".BtnBack2").prop("disabled",false);
			$(".BtnNext3").prop("disabled",false);
			$(".BtnBack4").prop("disabled",false);
			$(".BtnBack3").prop("disabled",false);
			$(".BtnProceed").prop("disabled",false);
			
		},2000);
	});
		
	function getReferenceNo(length) {
		return Math.floor(Math.pow(10, length-1) + Math.random() * 9 * Math.pow(10, length-1));
	}

	function makeProgress(from, to){ //increase

		if(from < to){
			from = from + .20;
			$(".progress-bar").css("width", from + "%");

			
		}
		// Wait for sometime before running this script again
		setTimeout(function(){
			makeProgress(from, to);
		}, 1);
	}
	function makeRollback(from, to){ //decrease
		
		if(from > to){
			from = from - .20;
			$(".progress-bar").css("width", from + "%");

		}
		// Wait for sometime before running this script again
		setTimeout(function(){
			makeRollback(from, to);
		}, 1);
	}

	var generated_reference_no = getReferenceNo(9);

	//if last step in top_up
	$(".BtnProceed").click(function(e){
		
		e.preventDefault();

		var resched_fee = $(".resched_fee").data('value');
	  	var new_branch = $('.branch_name').val();
	  	var new_time = $('.appointment-time').val();
	  	var new_date  = $('.appointment-date').val();
	  	var reference_no  = $('.tbe_app_reference_no').val();

		// $(".refNospan").text(generated_reference_no); //create refno
		// $(".total_charge").text(accounting.formatMoney(amount, "₱", 2)); 

		// var fileInputs = $('.req_upload');

        var formData = new FormData();
        formData.append('resched_fee', resched_fee);
        formData.append('new_branch', new_branch);
        formData.append('new_date', new_date);
        formData.append('new_time', new_time);
        formData.append('reference_no', reference_no);

        $.ajax({
            method: 'post',
            url:base_url+'Main/resched_appointment',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(data){
            setTimeout(function () { 
				      location.reload();
				 }, 2 * 1000);
            }
        });
		
	});

	$('.finalCancelButton').click(function(e){
		e.preventDefault();
		$('#addApplicationModal').modal('toggle');
		makeRollback(1000,20);
		dataTable.draw();
	});

});
