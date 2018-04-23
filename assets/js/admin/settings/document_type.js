$(function(){
	var base_url = $("body").data('base_url'); //base_url come from php functions base_url();

	var dataTable2 = $('#table-grid2').DataTable({
		"processing": true,
		"serverSide": true,
		"columnDefs": [
    		{ targets: 2, orderable: false, "sClass":"text-center" }
		],
		"ajax":{
			url :base_url+"Main/settings_applications_table2", // json datasource
			type: "post",  // method  , by default get
			error: function(){  // error handling
				$(".table-grid-error").html("");
				$("#table-grid2").append('<tbody class="table-grid2-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
				$("#table-grid_processing").css("display","none");
			}
		}
	});

	$(".saveBtnReq").click(function(e){
		
		e.preventDefault();

		var thiss = $("#add_reqinfo-form");

		var serial = thiss.serialize();

		$.ajax({
			type:'post',
			url: base_url+'Main/save_info_requirement',
			data: serial,
			beforeSend:function(data){
				$(".cancelBtn, .saveBtnReq").prop('disabled', true); 
				$(".saveBtnReq").text("Please wait...");
			},
			success:function(data){
				$(".cancelBtn, .saveBtnReq").prop('disabled', false);
				$(".saveBtnReq").text("Add");
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
						hideAfter: 2000
					});
					$('#addRequirementModal').modal('toggle'); //close modal
					dataTable2.draw(); //refresh table
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
	
	$('#table-grid2').delegate(".btnDelete2","click", function(){

		var requirement_id = $(this).data('value');

		$.ajax({
	  		type: 'post',
	  		url: base_url+'Main/getInfoRequirementUsingID',
	  		data:{'requirement_id':requirement_id},
	  		success:function(data){
	  			
	  			var res = data.result;
	  			if (data.success == 1) {
	  				$(".del_requirement_id").val(res[0].requirement_id); //user_id pk
	  			}
	  		}
	  	});
		$('#deleteRequirementModal').modal('show');

	});

	$('#table-grid2').delegate(".btnUpdate, .btnView2", "click", function(){

	  	var requirement_id = $(this).data('value');

	  	$.ajax({
	  		type: 'post',
	  		url: base_url+'Main/getInfoRequirementUsingID',
	  		data:{'requirement_id':requirement_id},
	  		success:function(data){
	  			var res = data.result;
	  			if (data.success == 1) {
	  				dataTable2.draw(); //refresh table

	  					$(".info_req_id").val(res[0].requirement_id);
		  				$(".info_req_desc").val(res[0].requirement_description);
					
	  			}
	  		}
	  	});
	});

	$(".goToEditModalReqBtn").click(function(e){
		e.preventDefault();
			$('#viewRequirementModal').modal('toggle');
			$('#editRequirementModal').modal('show'); 
	});

	$("#edit_view_requirementinfo-form").submit(function(e){
		e.preventDefault();
		var serial = $(this).serialize();

		$.ajax({
			type:'post',
			url:base_url+'Main/edit_requirement',
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
						hideAfter: 2000
					});
					dataTable2.draw(); //refresh table
					$('#editRequirementModal').modal('toggle'); //close modal
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

	$('.deleteReqBtn').click(function(e){
		e.preventDefault();

		var del_requirement_id = $(".del_requirement_id").val();

		$.ajax({
			type:'post',
			url:base_url+'Main/deleteRequirement',
			data:{'del_requirement_id':del_requirement_id},
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
						hideAfter: 2000
					});
					dataTable2.draw(); //refresh table
					$('#deleteRequirementModal').modal('toggle'); //close modal
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

	$('.btnClickAddRequirement').click(function(e){
		e.preventDefault();
		$('.info_req_desc').val("");
	})

});