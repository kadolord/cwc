$(function(){
	var base_url = $("body").data('base_url'); //base_url come from php functions base_url();

	var dataTable = $('#table-grid').DataTable({
		"processing": true,
		"serverSide": true,
		"columnDefs": [
    		{ targets: 2, orderable: false, "sClass":"text-center" }
		],
		"ajax":{
			url :base_url+"Main/settings_schedule_table", // json datasource
			type: "post",  // method  , by default get
			error: function(){  // error handling
				$(".table-grid-error").html("");
				$("#table-grid").append('<tbody class="table-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
				$("#table-grid_processing").css("display","none");
			}
		}
	});


	var holidays = [];

	$.ajax({
		type: 'get',
		url: base_url+'Main/get_holiday',
		success:function(data){

			var res = data.result;
			for(var x = 0; x < res.length; x++){
				holidays.push(res[x].holiday_date.replace(/(^|-)0+/g, "$1"));
			}
  			trigger_datepicker(holidays)
		}
  	});

  	function trigger_datepicker(holidays){
  		$(".datepicker_holiday").datepicker({ 
	        autoclose: true, 
	        todayHighlight: true,
	        format: 'mm/dd/yyyy',
	        beforeShowDay:function(Date){
				var curr_day = Date.getDate();
		        var curr_month = Date.getMonth()+1;
		        var curr_year = Date.getFullYear();        
		        var curr_date = curr_year+'-'+curr_month+'-'+curr_day;  
	        if (holidays.indexOf(curr_date)>-1) return false; 
			}
	  	});
  	}
	

	$(".saveBtnHoliday").click(function(e){
		
		e.preventDefault();

		var thiss = $("#add_holiday-form");

		var serial = thiss.serialize();

		$.ajax({
			type:'post',
			url: base_url+'Main/save_holiday',
			data: serial,
			beforeSend:function(data){
				$(".cancelBtn, .saveBtnHoliday").prop('disabled', true); 
				$(".saveBtnHoliday").text("Please wait...");
				
			},
			success:function(data){
				$(".cancelBtn, .saveBtnHoliday").prop('disabled', false);
				$(".saveBtnHoliday").text("Add");
				if (data.success == 1) {
					$(thiss).find('input').val(""); // clean field
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
					$('#addHolidayModal').modal('toggle'); //close modal
					dataTable.draw(); //refresh table
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
		var holiday_id = $(this).data('value');

		$.ajax({
	  		type: 'post',
	  		url: base_url+'Main/getInfoHolidayUsingID',
	  		data:{'holiday_id':holiday_id},
	  		success:function(data){
	  			
	  			var res = data.result;
	  			if (data.success == 1) {
	  				$(".del_holiday_id").val(res[0].holiday_id); //user_id pk
	  			}
	  		}
	  	});
		$('#deleteHolidayModal').modal('show');

	});

	$('#table-grid').delegate(".btnView", "click", function(){
		$('#viewHolidayModal').modal('show');
	});

	$('#table-grid').delegate(".btnView", "click", function(){

	  	var holiday_id = $(this).data('value');

	  	$.ajax({
	  		type: 'post',
	  		url: base_url+'Main/getInfoHolidayUsingID',
	  		data:{'holiday_id':holiday_id},
	  		success:function(data){
	  			var res = data.result;
	  			if (data.success == 1) {
	  				dataTable.draw(); //refresh table

  					$(".view_hol_desc").val(res[0].holiday_description);
	  				$(".view_hol_date").val(moment(res[0].holiday_date).format("MM/DD/YYYY"));

	  				$(".edit_hol_desc").val(res[0].holiday_description);
	  				$(".edit_hol_date").val(moment(res[0].holiday_date).format("MM/DD/YYYY"));
	  				$(".holiday_id").val(res[0].holiday_id);
	  				$(".current_holiday_name").val(res[0].holiday_description);
	  			}
	  		}
	  	});
	});

	$(".goToEditModalHolidayBtn").click(function(e){
		e.preventDefault();
			$('#viewHolidayModal').modal('toggle');
			$('#editHolidayModal').modal('show'); 
	});

	$(".goToEditModalSchedLimitBtn").click(function(e){
		e.preventDefault();
			$('#viewSchedLimitModal').modal('toggle');
			$('#editSchedLimitModal').modal('show'); 
	});

	$("#edit_holiday-form").submit(function(e){
		e.preventDefault();
		var serial = $(this).serialize();

		$.ajax({
			type:'post',
			url:base_url+'Main/edit_holiday',
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
					$('#editHolidayModal').modal('toggle'); //close modal
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

	$('.deleteHolidayBtn').click(function(e){
		e.preventDefault();

		var del_holiday_id = $(".del_holiday_id").val();

		$.ajax({
			type:'post',
			url:base_url+'Main/deleteHoliday',
			data:{'del_holiday_id':del_holiday_id},
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
					$('#deleteHolidayModal').modal('toggle'); //close modal
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

	
});