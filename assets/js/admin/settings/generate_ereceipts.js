$(function(){
	var base_url = $("body").data('base_url'); //base_url come from php functions base_url();

	$(".bntGenerate").click(function(e){
		
		e.preventDefault();
		var prefix = $('.prefix').val();
		var start = $('.start').val();
		var end = $('.end').val();

		if(start == "" || end == ""){
			$.toast({
			    heading: 'Warning',
			    text: "Please fill up both Start and End",
			    icon: 'warning',
			    loader: false,   
			    stack: false,
			    position: 'top-center',  
			    bgColor: '#f0ad4e;',
				textColor: 'white'        
			});
		}else{
			if(start > end){
				$.toast({
				    heading: 'Warning',
				    text: "Start should be lesser than End",
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
					url: base_url+'Main/generate_receipt',
					data: {'prefix':prefix, 'start':start, 'end':end},
					beforeSend:function(data){
						$(".bntGenerate").prop('disabled', true); 
						$(".bntGenerate").text("Please wait...");
					},
					success:function(data){
						$(".btnClearReceipt").css('display', 'block');
						$(".bntGenerate").css('display', 'none');
						$(".bntGenerate").text("Generate");
						if (data.success == 1) {
							var receipts = data.html;
							var receipts_array = receipts.split(',');
							var html ="<div class='row'>";
							html +="<div class='col-md-3'>";
							var counter = 0;
							for (var i=0; i < receipts_array.length ;i++){
								counter++;
								html += "<label class='form-control-label col-form-label-sm'>";
								html += receipts_array[i];
								html += "</label>";
								html += "<br>";

								if(counter == 10){
									html+="</div>";
									html +="<div class='col-md-3'>";
									counter = 0;;
								}
							}
							html += "</div>";

							$('.prefix').val('');
							$('.start').val('');
							$('.end').val('');
							$('.receipt_container').css('display', 'block');
							$('.receipt_container').html(html);

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
		}
		
	});

	$('.btnClearReceipt').click(function(){
		$('.receipt_container').html("");
		$('.receipt_container').css("display", "none");
		$(".bntGenerate").prop("disabled",false);
		$(".bntGenerate").css("display","block");
		$(this).css("display","none");
	});
	
});

function upperCaseF(text){
	setTimeout(function(){
        text.value = text.value.toUpperCase();
    }, 1);
};