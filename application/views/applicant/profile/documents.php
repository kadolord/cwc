 <!-- change the data-num and data-subnum for numbering of navigation -->
<div class="content-inner" id="pageActive" data-num="1" data-namecollapse="#profile-collapse-a" data-labelname="Documents" >
    <!-- Page Header-->
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="no-margin-bottom">Documents</h2>
        </div>
    </header>
    <!-- Breadcrumb-->
    <ul class="breadcrumb">
        <div class="container-fluid">
        <li class="breadcrumb-item active">Profile</li>
        <li class="breadcrumb-item active">Documents</li>
        </div>
    </ul>
    <section class="tables">   
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 no-padding">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-control-label form-label-sm">Document Type</label>
                                <select data-column="2" class="form-control search-input-select app_requirement col-md-4" name="">
                                    <option value="" disabled selected hidden value="">--Select Document Type--</option>
                                    <?php foreach ($app_requirement->result() as $app): ?>
                                        <option value="<?php echo $app->requirement_id; ?>"><?php echo $app->requirement_description; ?></option>
                                   <?php endforeach ?>;
                                </select>
                            </div><br><br>
                            <div>
                                <button disabled id='ADDFILE' class="btn btn-primary">Upload Document</button><span class="small "> (You can only upload jpg, png or pdf file with a maximum size of 2MB. You can upload 2 images for each category.)</span><span class="asterisk" style="color:red">*</span>
                            </div>
                            <br>
                            <div class="uploadFileContainer"></div>
                            <button type="button" style="float:right;display:none" class="btn btn-primary" id='submit'>Upload</button>
                            <br><hr>
                            <h1>Uploaded Documents</h1>
                            <br>
                            <?php if($has_uploaded_docs): ?>
                                <?php foreach ($doc_ids as $id): ?>
                                    <?php foreach ($app_requirement2->result() as $app): ?>
                                        <?php if($id == $app->requirement_id): ?>
                                            <h4><?php echo $app->requirement_description;?></h4>
                                            <br>
                                            <div class="row">
                                        <?php endif;  ?>
                                    <?php endforeach; ?>
                                    <?php foreach($docs_uploaded as $doc) : ?>
                                        <?php if ($doc->document_type_id == $id): ?>
                                            <?php if($doc->uploaded_doc_ext == "pdf"): ?>
                                                 <div class="col-md-2">
                                                   <a target="_blank" href="<?php echo base_url('assets/img/applicant_documents/').$doc->uploaded_doc; ?>"><img width="100px" height="100px" class="img-fluid img-thumbnail" src="<?php echo base_url('assets/images/pdf_icon.png'); ?>"></a><br>
                                                   <small><?php echo $doc->uploaded_doc; ?></small>
                                                </div>
                                            <?php else: ?>
                                                <div class="col-md-2">
                                                   <a target="_blank" href="<?php echo base_url('assets/img/applicant_documents/').$doc->uploaded_doc; ?>"><img width="100px" height="100px" class="img-fluid img-thumbnail" src="<?php echo base_url('assets/img/applicant_documents/').$doc->uploaded_doc; ?>"></a><br>
                                                   <small><?php echo $doc->uploaded_doc; ?></small>
                                                </div>
                                            <?php endif; ?>

                                        <?php endif;?>
                                    <?php endforeach; ?>
                                    </div>
                                    <hr>
                            <?php endforeach; ?>

                            <?php else: ?>
                                <h4>No documents uploaded.</h4>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="confirmUploadModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-m">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="exampleModalLabel" class="modal-title">Confirm Upload</h4>
                </div>
                <form class="form-horizontal personal-info-css" id="delete_appointmentinfo-form">
                    <div class="modal-body">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <p>You have already uploaded 2 documents for this category. Uploading another document will replace the oldest document you have uploaded. Please click Save to confirm upload. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group row">       
                            <div class="col-md-12">
                                <button type="submit" style="float:right" class="btn btn-danger confirmUploadBtn">Save</button>
                                <button type="button" style="float:right; margin-right:10px;" class="btn btn-default cancelBtn" data-dismiss="modal" aria-label="Close">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- add a br to eliminate whitespaces in the bottom -->
    <br><br><br><br><br>
<?php $this->load->view('includes/footer'); ?>

<script src="<?=base_url('assets/js/applicant/profile/documents.js');?>"></script>
<script type="text/javascript">
    var base_url = $("body").data('base_url'); //base_url come from php functions base_url();s
    
    $('.app_requirement').click(function(e){

        if($('.app_requirement option:selected').val() != ""){
            $('#ADDFILE').prop('disabled', false);
        }else{
            $('#ADDFILE').prop('disabled', true);
        }
    });

    $('#ADDFILE').click(function (event){

        var requirement_id = $(".app_requirement option:selected").val();
        var counter = $('.uploadFileContainer .req_upload').length;
        var duplicate_ids = <?php echo json_encode($docs_uploaded); ?>;
        $.each(duplicate_ids, function(key,value){
            if(value.document_type_id == requirement_id){
                counter++
                return false;
            }
        }); 

        $('#submit').css('display', 'block');
       
        if(counter < 2){
            addFileInput();
        }else{
            $.toast({
                heading: 'Warning',
                text: 'You can only upload up to 5 location sketch/images.',
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

    $('.uploadFileContainer').delegate('.close', 'click', function(e){
        var counter = $('.uploadFileContainer .req_upload').length;
        if(counter == 1){
            $('#submit').css('display', 'none');
        }
    });

   
    function addFileInput(){
        
        var html = '';
        html += '<div class = "alert alert-info">';
        html += '<button type = "button" class = "close xbutton" data-dismiss = "alert" aria-hidden = "true">&times;</button>';
        html += '<strong>Upload file </strong>';
        html += '<input type="file" name="images[]" class="req_upload">';
        html += '</div>';

        $(".uploadFileContainer").append(html);
    }

    //Validated the photos to be uploaded
    $('.uploadFileContainer').delegate('.req_upload', 'change', function(e){
      
        var filesize = $(this)[0].files[0].size;
        if(!hasExtension($('.req_upload'),['.jpg', '.png', '.pdf']) || filesize > 2000000){
            $.toast({
                heading: 'Warning',
                text: 'Please select valid file to upload (PNG, JPG, PDF file lesser than 2MB)',
                icon: 'warning',
                loader: false,  
                stack: false,
                position: 'top-center', 
                allowToastClose: false,
                bgColor: '#f0ad4e;',
                textColor: 'white'  
            });
           $(this).val("");
        }
    });

    function hasExtension(inputID, exts) {
        var fileName = inputID.val();
        return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
    }
    

    $('#submit').click(function(e){
        e.preventDefault();

        var counter = $('.uploadFileContainer .req_upload').length;
    
        var duplicate_ids = <?php echo json_encode($duplicate_ids); ?>;
        var has2docs = false;
        var formData = new FormData();
        var requirement_id = $(".app_requirement option:selected").val();
        var hasRequirement = $('input[type=file]').val();



        if(hasRequirement !="" && requirement_id != ""){

            $.each(duplicate_ids, function(key,value){
                if(value == requirement_id ){
                    has2docs = true;
                   return false;
                }
            }); 

            if(has2docs){
                $("#confirmUploadModal").modal("show");
            }else{

                formData.append('requirement_id', requirement_id);
                var fileInputs = $('.req_upload');
          
                $.each(fileInputs, function(i,fileInput){
                    if( fileInput.files.length > 0 ){
                        $.each(fileInput.files, function(k,file){
                            formData.append('images[]', file);
                        });
                    }
                });
                $.ajax({
                    method: 'post',
                    url:base_url+'Main/upload_document',
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    beforeSend: function(){
                        $(this).prop('disabled', true);
                    },

                    success: function(data){
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
                            $(this).prop("disabled",false);
                            setTimeout(function () { 
                              location.reload();
                            }, 2 * 1000);

                        }
                    }
                });
            }                    
        }else {
            if(hasRequirement =="" && requirement_id == ""){
                $.toast({
                    heading: 'Warning',
                    text: 'Please select document type and photo to upload',
                    icon: 'warning',
                    loader: false,  
                    stack: false,
                    position: 'top-center', 
                    allowToastClose: false,
                    bgColor: '#f0ad4e;',
                    textColor: 'white'  
                });
            }else if(hasRequirement ==""){
                $.toast({
                    heading: 'Warning',
                    text: 'Please select photo to upload',
                    icon: 'warning',
                    loader: false,  
                    stack: false,
                    position: 'top-center', 
                    allowToastClose: false,
                    bgColor: '#f0ad4e;',
                    textColor: 'white'  
                });
            }else if( requirement_id == ""){
                 $.toast({
                    heading: 'Warning',
                    text: 'Please select document type',
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

    $('.confirmUploadBtn').click(function(e){
        e.preventDefault();

        var formData = new FormData();
        var requirement_id = $(".app_requirement").val();
        var hasRequirement = $('input[type=file]').val();
        console.log(requirement_id);

        if(hasRequirement !="" && requirement_id != ""){

            formData.append('requirement_id', requirement_id);
            var fileInputs = $('.req_upload');
  
            $.each(fileInputs, function(i,fileInput){
                if( fileInput.files.length > 0 ){
                    $.each(fileInput.files, function(k,file){
                        formData.append('images[]', file);
                    });
                }
            });
            $.ajax({
                method: 'post',
                url:base_url+'Main/upload_document',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(data){
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
                        $("#confirmUploadModal").modal('toggle');
                        setTimeout(function () { 
                          location.reload();
                        }, 2 * 1000);
                    }
                }
            });
        }else {
            $.toast({
                heading: 'Warning',
                text: 'Please select document type and photo to upload',
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
</script>

