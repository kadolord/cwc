

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div>
		<input type="file" id="files" name="files" multiple>
	</div>
	<div id='uploaded_images'>
		
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			$(#files).change(function(){
				var files = $('#files')[0].files;
				var error = '';
				var form_data = new FormData();

				for(var i = 0; i <files.length; i++){

					var name = files[i].name;
					var extension = name.split('.').pop().toLowerCase();
					if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1){

						error += 'Invalid ' + i + " Image file".
					}else{

						form_data.append("files[]", files[i]);
					}
				}

				if (error == ''){
					$.ajax({
						url:"<?php echo base_url(); ?>upload_requirements",
						method: "POST",
						data: form_data,
						contentType:false,
						cache:false,
						processData:false,
						beforeSend:function(){
							$('#uploaded_images').html("<label class='text-success'>Uploading ..</label>");
						},
						success:function(data){
							$('#uploaded_images').html(data);
							$('files').val('');	
						}
					})
				}else{
					alert(error);
				}

			})
		});
	</script>

</body>
</html>
<?php

//FOR MAIN COntroller

function upload_requirements(){
	if($_FILES["files"]["name"] != ''){
		$output = '';
		$config["upload_path"] = './assets/img/applicant_requirements/';
		$config["allowed_types"] = 'gif|jpg|png';
		$this->upload->initialize($config);
		for($i = 0; $i<count($_FILES["files"]["name"]);$i++){
			$_FILES["files"]["name"] = $_FILES["files"]["name"][$i];
			$_FILES["files"]["type"] = $_FILES["files"]["type"][$i];
			$_FILES["files"]["tmp_name"] = $_FILES["files"]["tmp_name"][$i];
			$_FILES["files"]["error"] = $_FILES["files"]["error"][$i];
			$_FILES["files"]["size"] = $_FILES["files"]["size"][$i];

			if($this->upload->do_upload('file')){
				$data = $this->upload->data();
				$output = '
					<div class ="col-md-3">
						<img src="'.base_url().'upload/'.$data["file_name"].'" class = "img-responsive img-thumbnail">
						</div>';
				
			}
		}
		echo $output;
	}
}

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
}

