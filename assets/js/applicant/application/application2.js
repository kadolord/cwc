$(function(){

	var base_url = $("body").data('base_url'); //base_url come from php functions base_url();
	var amount_receipt;
	var app_branch_name;
	var app_branch_id;
	var app_date;
	var app_time;
	var app_fee_raw;
	var con_fee_raw;
    var total_amount;
	

	$(".select2").select2({});

	$('.btnClickAddAccount').click(function(){
		$('.info_position').val('').trigger('change');
	});

	$('.uploaded_images').click(function(e){
		e.preventDefault();
		$('#uploadedImagesModal').modal('show');
	})

	$(".datepicker2").datepicker({});


	$(".BtnNext").click(function(e){
		e.preventDefault();
		var hasSelectedCategory  = $('.app_type').val();
		var app_fname  = $('.info_fname').val();
		var app_lname  = $('.info_lname').val();
		var app_birthday  = $('.info_bdate').val();
		var app_age  = $('.info_age').val();
		var app_civil_status  = $('.info_civil_status').val();
		var app_country  = $('.info_birth_country').val();
		var app_nationality  = $('.info_nationality').val();

        var error = 0;
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

		if (error == 1) {
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
		}else{

			makeProgress(20,40);
			$('.step_label').text('Step 2 of 5. Schedule Appointment'); //step 2
			$('.step1').css('overflow',"hidden");
			$('.step1').css('position',"absolute");
			$('.step1').hide('slide', {direction: 'left'}, 1000);
			$('.step2').stop().show('slide', {direction: 'right'}, 1000);

			setTimeout(function(){
				$('.step1').css('overflow',"visible");
				$('.step1').css('position',"static");

			},2000);

            //disable buttons
            $(".BtnNext").prop("hidden",true);
            $(".BtnNext2").prop("hidden",false);
            $(".BtnNext3").prop("hidden",true);
            $(".BtnProceed").prop("hidden",true);

            // $(".BtnBack").prop("hidden",false);
            $(".BtnBack2").prop("hidden",false);
            $(".BtnBack3").prop("hidden",true);
            $(".BtnBack4").prop("hidden",true);
        };
    });

	$(".BtnNext2").click(function(e){

		e.preventDefault();
		var tba_appointment_time = $('.tba_appointment-time option:selected').val();
		var tba_appointment_date = $('.tba_appointment-date').val();
		var tba_appointmen_branch = $('.branch_name2').val();

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

		if(error == 1){
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
		}else{
			makeProgress(40,60);
            $('.step_label').text('Step 3 of 5. Payment Details'); //step 3
            
            $('.step2').css('overflow',"hidden");
            $('.step2').css('position',"absolute");
            $('.step2').hide('slide', {direction: 'left'}, 1000);
            $('.step3').stop().show('slide', {direction: 'right'}, 1000);

            // $(".BtnNext").prop("disabled",true);
            setTimeout(function(){
            	$('.step2').css('overflow',"visible");
            	$('.step2').css('position',"static");
            },2000);

            //disable buttons
            $(".BtnNext").prop("hidden",true);
            $(".BtnNext2").prop("hidden",true);
            $(".BtnNext3").prop("hidden",false);
            $(".BtnProceed").prop("hidden",true);

            $(".BtnBack").prop("hidden",true);
            $(".BtnBack2").prop("hidden",true);
            $(".BtnBack3").prop("hidden",false);
            $(".BtnBack4").prop("hidden",true);
        }
    });


	$(".BtnNext3").click(function(e){
		e.preventDefault();
		var tba_appointment_time = $('.tba_appointment-time').val();
		var tba_appointment_date = $('.tba_appointment-date').val();
		var tba_appointmen_branch = $('.branch_name2').val();
		var app_type = $(".app_type :selected").text();

        //Payment Calculation
        app_fee_raw = $(".app_process option:selected").data("process_fee");

        // Determine Process Lane (1 = Regular | 2 = Express Lane)
        var process_lane = $(".app_process option:selected").val();

        // Determine Payment Mode (1 = Credit Card | 2  = Debit)
        var payment_mode = $("input[name='payment_mode']:checked").val();

        if(payment_mode == 1){ //Credit Card
        	con_fee_raw = $(".app_process option:selected").data("con_fee_credit");
        }else{ //Debit
        	con_fee_raw = $(".app_process option:selected").data("con_fee_debit");
        }

        amount_receipt = 10000;
        var app_fee = accounting.formatMoney(10000, "₱", 2);
        var con_fee = accounting.formatMoney(con_fee_raw, "₱", 2);
        total_amount = app_fee_raw + con_fee_raw;

        var app_type_val = $(".app_type :selected").val();
        var app_fname =  $('.info_fname').val();
        var app_mname = $('.info_mname').val(); 
        var app_lname = $('.info_lname').val();
        var app_xname = $('.info_xname').val();
        var app_acr_no = $('.info_acr_no').val();
        var app_alias1 = $('.info_alias1').val();
        var app_alias2 = $('.info_alias2').val();
        var app_bdate = $('.info_bdate').val();
        var app_age = $('.info_age').val();
        var app_gender = $("input[name='info_gender']:checked").data('name');
        var app_civil_status =  $(".info_civil_status option:selected").text();
        var app_birth_country = $('.info_birth_country option:selected').text();
        var app_nationality = $('.info_nationality').val();
        var app_passport_no = $('.info_passport_no').val();
        var app_issuance_place = $('.info_issuance_place').val();
        var app_issuance_date = $('.info_issuance_date').val();
        var app_expiry_date = $('.info_expiry_date').val();
        var app_arrival_date = $('.info_arrival_date').val();
        var app_mobile = $('.info_mobile').val();
        var app_landline = $('.info_landline').val();
        var app_ph_st = $('.info_ph_st').val();
        var app_ph_village = $('.info_ph_village').val();
        var app_ph_brgy = $('.info_ph_brgy').val();
        var app_ph_city = $('.info_ph_city').val();
        var app_ph_prov = $('.info_ph_prov').val();
        var app_ph_zipcode = $('.info_ph_zipcode').val();
        var app_ab_st = $('.info_ab_st').val();
        var app_ab_village = $('.info_ab_village').val();
        var app_ab_city = $('.info_ab_city').val();
        var app_ab_state = $('.info_ab_state').val(); 

        var app_ab_country = "";

        if($('.info_ab_country option:selected').val() != 0){
            app_ab_country = $('.info_ab_country option:selected').text();
        }

        var app_ab_zipcode = $('.info_ab_zipcode').val();
        var app_process_lane = $('.app_process option:selected').text();
        app_branch_name = $('#branch_name option:selected').text();
        app_date = $('.tba_appointment-date').val();
        app_time = $('.tba_appointment-time option:selected').text();
        app_branch_id = $('#branch_name option:selected').val();

        //Summary
        $(".sum_app_cat").text(app_type);
        $(".sum_con_fee").text(con_fee);
        $(".sum_app_fee").text(app_fee);
        $(".sum_app_name").text(app_fname + " " + app_mname + " "+ app_lname );
        $(".sum_icard").text(app_acr_no);
        $(".sum_alias1").text(app_alias1);
        $(".sum_alias2").text(app_alias2);
        $(".sum_bday").text(app_bdate);
        $(".sum_age").text(app_age);
        $(".sum_gender").text(app_gender);
        $(".sum_civilstatus").text(app_civil_status);
        $(".sum_country").text(app_birth_country);
        $(".sum_nationality").text(app_nationality);
        $(".sum_passport").text(app_passport_no);
        $(".sum_issuance_place").text(app_issuance_place);
        $(".sum_issuance_date").text(app_issuance_date);
        $(".sum_expiry_date").text(app_expiry_date);
        $(".sum_arrival_date").text(app_arrival_date);
        $(".sum_mobile").text(app_mobile);
        $(".sum_landline").text(app_landline);
        $(".sum_ph_addrs").text(app_ph_st + " " + app_ph_village + " " + app_ph_brgy + " " + app_ph_city + " " + app_ph_prov + " " + app_ph_zipcode);
        $(".sum_ab_addrs").text(app_ab_st + " " + app_ab_village + " " +  app_ab_city + " " + app_ab_state + " " + app_ab_country + " " + app_ab_zipcode);
        $(".sum_process_lane").text(app_process_lane);
        $(".sum_branch_name").text(app_branch_name);
        $(".sum_app_date").text(app_date);
        $(".sum_app_time").text(app_time);

        // For Receipt
        $(".rcpt_con_fee").text(con_fee); //for receipt
        $(".rcpt_app_fee").text(app_fee); //for receipt
        $(".payor").text(app_fname + " " + app_mname + " "+ app_lname +" "+ app_xname + " (" + app_birth_country + ")"); //for receipt
        $(".rcpt_amount").text(accounting.formatMoney(amount_receipt, "₱", 2)); //for receipt

        makeProgress(60,80);
        $('.step_label').text('Step 4 of 5. Application Summary'); //step 4 Summary
        $('.step3').css('overflow',"hidden");
        $('.step3').css('position',"absolute");
        $('.step3').hide('slide', {direction: 'left'}, 1000);
        $('.step4').stop().show('slide', {direction: 'right'}, 1000);

        // $(".BtnNext").prop("disabled",true);
        setTimeout(function(){
        	$('.step3').css('overflow',"visible");
        	$('.step3').css('position',"static");
        },2000);

        //Disable buttons
        $(".BtnNext").prop("hidden",true);
        $(".BtnNext2").prop("hidden",true);
        $(".BtnNext3").prop("hidden",true);
        $(".BtnProceed").prop("hidden",false);
        
        $(".BtnBack").prop("hidden",true);
        $(".BtnBack2").prop("hidden",true);
        $(".BtnBack3").prop("hidden",true);
        $(".BtnBack4").prop("hidden",false);
        
        
    });

$(".BtnProceed").click(function(e){
	e.preventDefault();
        $('.step_label').text('Step 5 of 5. Success'); //step 5
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

        //disable buttons
        $(".BtnNext").prop("hidden",true);
        $(".BtnNext2").prop("hidden",true);
        $(".BtnNext3").prop("hidden",true);
        $(".BtnProceed").prop("hidden",true);

        $(".BtnBack").prop("hidden",true);
        $(".BtnBack2").prop("hidden",true);
        $(".BtnBack3").prop("hidden",true);
        $(".BtnBack4").prop("hidden",true);

    });

$(".BtnBack2").click(function(e){
	e.preventDefault();

	makeRollback(40,20);

        $('.step_label').text('Step 1 of 5. Personal Information'); //step 1
        $('.step2').hide('slide', {direction: 'right'}, 1000);
        $('.step1').stop().show('slide', {direction: 'left'}, 1000);

        $(".card-body").css("height","315px");
        setTimeout(function(){
        	$(".card-body").css("height","auto");
        },1000);

        //disable buttons
        $(".BtnNext").prop("hidden",false);
        $(".BtnNext2").prop("hidden",true);
        $(".BtnNext3").prop("hidden",true);
        $(".BtnProceed").prop("hidden",true);

        $(".BtnBack").prop("hidden",true);
        $(".BtnBack2").prop("hidden",true);
        $(".BtnBack3").prop("hidden",true);
        $(".BtnBack4").prop("hidden",true);
        
    });

$(".BtnBack3").click(function(e){
	e.preventDefault();
	makeRollback(60,40);
        $('.step_label').text('Step 2 of 5. Schedule Appointment'); //step 2
        $('.step3').hide('slide', {direction: 'right'}, 1000);
        $('.step2').stop().show('slide', {direction: 'left'}, 1000);
        $(".card-body").css("height","315px");
        setTimeout(function(){
        	$(".card-body").css("height","auto");
        },1000);

        //disable buttons
        $(".BtnNext").prop("hidden",true);
        $(".BtnNext2").prop("hidden",false);
        $(".BtnNext3").prop("hidden",true);
        $(".BtnProceed").prop("hidden",true);

        $(".BtnBack").prop("hidden",true);
        $(".BtnBack2").prop("hidden",false);
        $(".BtnBack3").prop("hidden",true);
        $(".BtnBack4").prop("hidden",true);


    });

$(".BtnBack4").click(function(e){
	e.preventDefault();
	makeRollback(80,60);
        $('.step_label').text('Step 3 of 5. Payment Details'); //step 3
        $('.step4').hide('slide', {direction: 'right'}, 1000);
        $('.step3').stop().show('slide', {direction: 'left'}, 1000);
        $(".card-body").css("height","315px");
        setTimeout(function(){
        	$(".card-body").css("height","auto");
        },1000);


        //disable buttons
        $(".BtnNext").prop("hidden",true);
        $(".BtnNext2").prop("hidden",true);
        $(".BtnNext3").prop("hidden",false);
        $(".BtnProceed").prop("hidden",true);

        $(".BtnBack").prop("hidden",true);
        $(".BtnBack2").prop("hidden",true);
        $(".BtnBack3").prop("hidden",false);
        $(".BtnBack4").prop("hidden",true);

    });

    $(".BtnNext, .BtnBack, .BtnNext2, .BtnNexwt3, .BtnBack2, .BtnBack3, .BtnBack4, .BtnProceed").click(function(e){
    	e.preventDefault();

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

	//Last Step of Registration
	$(".BtnProceed").click(function(e){

		e.preventDefault();
		var reference_no = getReferenceNo(9);
        var qrcode_text ='';
        qrcode_text += reference_no;
        // var qrcode_text = base_url+'Main/view_application/'+reference_no;
		//For last page display
        $("#btnPDF").prop("href",base_url+"Main/pdf_acrs_application/"+reference_no ); //pdf LINK
		$(".refNospan").text(reference_no); //create refno
		$('#qrcode').qrcode({
			width: 128,
			height: 128,
			text: qrcode_text
		});

		$(".total_charge").text(accounting.formatMoney(total_amount, "₱", 2)); 

		//For Saving to Database

        //QR CODE Display
        var canvas = $('#qrcode canvas');
        var blob = canvas.get(0).toDataURL("image/png");
        var app_type = $('.app_type option:selected').val();
        var app_time_id = $('.tba_appointment-time option:selected').val();
        var process_lane = $(".app_process option:selected").val(); 
        var payment_mode = $("input[name='payment_mode']:checked").val();

        var formData = new FormData();
        formData.append('payment_mode', payment_mode);
        formData.append('process_lane', process_lane);
        formData.append('application_fee', app_fee_raw);
        formData.append('convenience_fee', con_fee_raw);
        formData.append('amount_receipt', amount_receipt);
        formData.append('total_amount', total_amount);
        formData.append('app_type_id', app_type);
        formData.append('reference_no',  reference_no);
        formData.append('app_branch_id',app_branch_id);
        formData.append('app_date',app_date);
        formData.append('app_time',app_time_id);
        formData.append('qrcode', blob);

        var formData2 = new FormData();
        var personalInfoForm = $('#personal_info_form').serializeArray();

        for(var i = 0; i < personalInfoForm.length; i++){
            var personalInfo = personalInfoForm[i];
            formData2.append(personalInfo.name, personalInfo.value);
        }

        $.ajax({
        	method: 'post',
        	url:base_url+'Main/create_application',
        	data: formData,
        	dataType: 'json',
        	contentType: false,
        	processData: false,
        	success: function(data){
        		$(".e-receipt_no").text(data.or_no);
                $("#btnClickAddApplication").css("display","none"); 
                //Update personal info
                $.ajax({
                    method: 'post',
                    url: base_url+'Main/editInfo_applicant',
                    data: formData2,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(data2){
                    }   
                });
        	}
        });
    });

	$('.finalCancelButton').click(function(e){
		e.preventDefault();
		$('#addApplicationModal').modal('toggle');
		makeRollback(1000,20);
		dataTable.draw();
	});

	//SCHEDULE

	$('#print_receipt').click(function(e){


		e.preventDefault();
		$('#official_receipt').printThis({
			loadCSS: base_url+'assets/css/print_receipt.css'
		});
	});

	$('.sample_barcode').keypress(function(){
		window.location.href = $(this).val();

	});

    //automatic age computation
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

    $('.info_bdate').on('changeDate', function(){
    	var date = $(this).val();
    	var age = getAge(date);
    	$('.info_age').val(age);
    }); 

});
