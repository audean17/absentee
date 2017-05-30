  <style type="text/css">
	.dataTables_wrapper {
		  max-width: 120%;
		  display: block;

	  }

  </style>  

    
    <!-- start: page -->
    
			<!-- Theme modal fauzan -->
			<?php echo $modalfau;?>


								<section class="panel">
									<header class="panel-heading">
										<div class="panel-actions">
											<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
											<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
										</div>
						
										<h2 class="panel-title">Upload File</h2>
                              
                                    <div class="faualert alert-error hide" style="color:#F00;float:left;position:relative;top: -20px; right: -290px;"> </div>
							       
                              		</header>
								<form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate" action="<?php echo $linkForm;  ?>" method="post"  enctype="multipart/form-data">
                                    
									<div class="panel-body">

											<div class="panel-body">
                                            
                                                   
 
                                                                                                 

                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Absentee File</label>
                                                            <div class="col-md-9">
                                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                    <div class="input-append">
                                                                        <div class="uneditable-input">
                                                                            <i class="fa fa-file fileupload-exists"></i>
                                                                            <span class="fileupload-preview"></span>
                                                                        </div>
                                                                        <span class="btn btn-default btn-file">
                                                                            <span class="fileupload-exists">Change</span>
                                                                            <span class="fileupload-new">Select file</span>
                                                                            <input id="fileName" type="file" name="fileName"/>
                                                                        </span>
                                                                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                                        <a href="#" class="btn btn-default fileupload-exists" id="btnUpload1">Upload</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                       <div class="form-group">
                                                            <label class="col-md-3 control-label">Periode</label>
                                                            <div class="col-md-3">
                                                                <select  style="width:130px;" name="myMonth" id="myMonth">
																<optgroup label="Month">
																	<option value="01" <?php if ($nowMonth=='01') {?> selected="selected" <?php } ?>>Januari</option>
																	<option value="02" <?php if ($nowMonth=='02') {?> selected="selected" <?php } ?>>Februari</option>
																	<option value="03" <?php if ($nowMonth=='03') {?> selected="selected" <?php } ?>>Maret</option>
																	<option value="04" <?php if ($nowMonth=='04') {?> selected="selected" <?php } ?>>April</option>
																	<option value="05" <?php if ($nowMonth=='05') {?> selected="selected" <?php } ?>>Mei</option>
																	<option value="06" <?php if ($nowMonth=='06') {?> selected="selected" <?php } ?>>Juni</option>
																	<option value="07" <?php if ($nowMonth=='07') {?> selected="selected" <?php } ?>>Juli</option>
																	<option value="08" <?php if ($nowMonth=='08') {?> selected="selected" <?php } ?>>Agustus</option>
																	<option value="09" <?php if ($nowMonth=='09') {?> selected="selected" <?php } ?>>September</option>
																	<option value="10" <?php if ($nowMonth=='10') {?> selected="selected" <?php } ?>>Oktober</option>
																	<option value="11" <?php if ($nowMonth=='11') {?> selected="selected" <?php } ?>>November</option>
																	<option value="12" <?php if ($nowMonth=='12') {?> selected="selected" <?php } ?>>Desember</option>
																</optgroup>
															</select>
                                                                <select style="width:100px;" name="myYear" id="myYear">
																<optgroup label="year">
																	<option value="2017" <?php if ($nowYear=='2017') {?> selected="selected" <?php } ?>>2017</option>
																	<option value="2018" <?php if ($nowYear=='2018') {?> selected="selected" <?php } ?>>2018</option>
																	<option value="2019" <?php if ($nowYear=='2019') {?> selected="selected" <?php } ?>>2019</option>
																</optgroup>
															</select>
                                                         </div>
														</div>
   		                                                    
  
										</form>
                                               
                                        </div>
                                     </div>
                                 </section>       
                                            
                                            

<!-- scripts --> 
<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script> 
<script>


            $(document).ready(function() {

             
				 
               $('#btnUpload1').bind('click', function(e) {
				   
					var fileData= "";
					fileData = $("#fileName").prop("files")[0]; 
					var form_data = new FormData();
					form_data.append("fileName", fileData);
                    var myMonth = $('select[name=myMonth]').val();
                    var myYear = $('select[name=myYear]').val();
					var monthYear=myMonth +"-"+myYear;
 					$.ajax({
								url: "<?php echo site_url("upload/uploadFile");?>/" + monthYear,
								dataType: "json",
								cache: false,
								contentType: false,
								processData: false,
								data: form_data,  
								type: 'post',
								success: function(data) {
								if (data['success'] == "1") {
									alert(data['msg']);
									
								} else {
									$('.alert-error').removeClass('hide').html('<i class="icon-remove-sign"></i> ' + data['msg']);
								}
                        }
					 });					 
 
                    
                });				
				 
 
 
		
		 });
 

            
        </script>
  
      
     					<!-- end: page -->                        