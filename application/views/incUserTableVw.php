  <!-- start: page -->
    
			<!-- Theme modal fauzan -->
			<?php echo $modalfau;?>
								<section class="panel">
									<header class="panel-heading">
										<div class="panel-actions">
											<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
											<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
										</div>
						
										<h2 class="panel-title"><?php echo $titleTable;?></h2>
                              
                                    <div class="faualert alert-error hide" style="color:#F00;float:left;position:relative;top: -20px; right: -290px;"> </div>
							       
                              		</header>
                                    
                                    

<div class="panel-body">
									<a class="modal-with-form btn btn-default" href="#modalForm" data-target="#modalForm" id="1">Add Data</a>

									<!-- Modal Form -->
									<div id="modalForm" class="modal-block modal-block-primary mfp-hide">
										<section class="panel">
												<form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate" action="<?php if (isset($linkForm)) {
    echo $linkForm;
} ?>" method="post" >
											<header class="panel-heading">
												<h2 class="panel-title">Add data user</h2>
											</header>
											<div class="panel-body">
 													<div class="form-group">
														<label class="col-sm-3 control-label">User Name</label>
														<div class="col-sm-9">
															<input type="text" name="userName" class="form-control" placeholder="Type User Name..."    required/>
														</div>
													</div>
                                                  
                                                    
													<div class="form-group">
														<label class="col-sm-3 control-label">Employee Name</label>
                                                        <div class="col-sm-9">
                                                             <select data-plugin-selectTwo class="form-control populate js-example-responsive" name="employeeId"   style="width: 100%;" >
                                                            <option value="-1" >---- Employee ----</option>
                                                                <?php 
                                                                    foreach($conEmployee as $row)
                                                                    { 
                                                                      echo '<option value="'.$row->employee_id.'"';
                                                                        if ($getGroupId==$row->employee_id) {
                                                                            echo " selected ";
                                                                        }
                                                                      echo '>'.$row->employee_first_name.' '.$row->employee_last_name.'</option>';
                                                                     
                                                                    }
                                                                ?>													
                                                                </select>
                                                                    
                                                         </div>
													
												    </div>
                                                    
													<div class="form-group">
														<label class="col-sm-3 control-label">Group User</label>
                                                        <div class="col-sm-9">
                                                             <select data-plugin-selectTwo class="form-control populate js-example-responsive" name="groupId"   style="width: 100%;" >
                                                            <option value="-1" >---- Group User ----</option>
                                                                <?php 
                                                                    foreach($conGroupUser as $row)
                                                                    { 
                                                                      echo '<option value="'.$row->group_id.'"';
                                                                        if ($getGroupId==$row->group_id) {
                                                                            echo " selected ";
                                                                        }
                                                                      echo '>'.$row->group_name.'</option>';
                                                                     
                                                                    }
                                                                ?>													
                                                                </select>
                                                                    
                                                         </div>
													
												    </div>
                                                    
													<div class="form-group">
														<label class="col-sm-3 control-label">Email</label>
														<div class="col-sm-9">
															<input type="text" name="emailAddress" class="form-control" placeholder="Type Email Address..." value="<?php if (isset($getEmail)) {  echo $getEmail; }?>" required/>
														</div>
													</div>
                                                    
													<div class="form-group">
														<label class="col-sm-3 control-label">All Employee Allowed</label>
														<div class="col-sm-9">
															<select data-plugin-selectTwo class="form-control populate js-example-responsive" style="width: 100%;" name="allEmployeeAllowed">
																<optgroup label="All Employee Allowed">
																	<option value="1">Yes</option>
																	<option value="0">NO</option>
																</optgroup>
															</select>
														</div>
													</div>
                                                    
                                                  <div class="form-group">
														<label class="col-sm-3 control-label">Remark</label>
														<div class="col-sm-9">
															<input type="text" name="remark" class="form-control" placeholder="Type remark..." required/>
														</div>
													</div>
                                                    
                                                    <div class="form-group">
														<label class="col-sm-3 control-label">Status</label>
														<div class="col-sm-9">
															<select data-plugin-selectTwo class="form-control populate js-example-responsive" style="width: 100%;" name="status">
																<optgroup label="Status">
																	<option value="1">Yes</option>
																	<option value="0">NO</option>
																</optgroup>
															</select>
														</div>
													</div>  
                                                    
											</div>
											<footer class="panel-footer">
												<div class="row">
													<div class="col-md-12 text-right">
														<button class="btn btn-primary" type="submit">Submit</button>
														<button class="btn btn-default modal-dismiss">Cancel</button>
													</div>
												</div>
											</footer>
										</form>

										</section>
									</div>

								</div>
                                    
                                    <div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th>User ID</th>
											<th>User name</th>
											<th>Employee name</th>
											<th>Email</th>
											<th>Group</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
                                    <?php
										foreach ($listUser as $row) {
											$fullName=$row->employee_first_name." ".$row->employee_last_name;
											$myDataSplit=$row->user_id."|".$row->user_name."|".$fullName."|".$row->email."|".$row->group_id."|".$row->all_employee_allowed."|".$row->remark."|".$row->status;
                                    ?>
										<tr class="gradeX">
											<td><?php echo $row->user_id;?></td>
											<td><?php echo $row->user_name;?></td>
											<td><?php echo $fullName;?></td>
											<td><?php echo $row->email;?></td>
											<td><?php echo $row->group_name;?></td>
											<td><?php echo $row->status_desc;?></td>
											<td class="actions">
												<a href="http://fauzan.net" onclick="javascript:showFormEditUsers('<?php echo site_url("user/change/".$row->user_id."")?>','<?php echo $myDataSplit;?>','<?php echo $myDataSplitGroup;?>');return false;"  title="Edit for this row"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
												<a href="http://fauzan.net" onclick="javascript:confirmationAlert('<?php echo site_url("user/delete/".$row->user_id."")?>','Are you sure you want to delete this row?');return false;" title="delete for this row"><i class="fa fa-trash-o"></i></a> 
											</td>
										</tr>
                                        <?php } ?>
									</tbody>
								</table>
							</div>
                                    
								</section>

									  
                                
<!-- scripts --> 
<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script> 
<script>


            $(document).ready(function() {	
				 $('input[name=userName]').focus();

                $('#btnSave').bind('click', function(e) {
					var userId = $('input[name=userId]').val();
                    var userName = $('input[name=userName]').val();
                    var fullName = $('input[name=fullName]').val();
                    var emailAddress = $('input[name=emailAddress]').val();
                    var allProvinsiAllowed = $('select[name=allProvinsiAllowed]').val();
                    var remark = $('input[name=remark]').val();

                    var groupId = $('select[name=groupId]').val();
					 var status = $('select[name=status]').val();
                    if (userName == "" || userName=="undefined") {
                        $('.alert-error').removeClass('hide').html('Nama User harus diisi');
						return false;
                    } else if (fullName == "" || fullName=="undefined") {
                        $('.alert-error').removeClass('hide').html('Full name harus diisi');
						return false;
                    } else if (groupId == "" || groupId=="undefined") {
                        $('.alert-error').removeClass('hide').html('Group harus dipilih');
						return false;
                    } else if (allProvinsiAllowed == "" || allProvinsiAllowed=="undefined") {
                        $('.alert-error').removeClass('hide').html('All provinsi llowed harus dipilih');
						return false;
                    } else {
						if (userId == "" || userId=="undefined") { 
						  doCreate(userName,groupId,fullName,emailAddress,allProvinsiAllowed,remark); 
						}else{
						  doUpdate(userId,userName,groupId,fullName,emailAddress,allProvinsiAllowed,remark,status); 
						}
                    }
                });
				/*
                $('#btnSearch').bind('click', function(e) {
						  doFilter('fauzan'); 
                });
				*/
                $('#btnDelete').bind('click', function(e) {
                    var userId = $('input[name=userId]').val();
						if (userId == "" || userId=="undefined") { 
							$('.alert-error').removeClass('hide').html('Nama User harus di pilih');
							return false;
						}else{
							
						  doDelete(userId); 
						}
                });

 
		
		 });
 
                function doCreate(userName,groupId,fullName,emailAddress,allProvinsiAllowed,remark) {
                    $.ajax({
                        type: "POST",
						url: "<?php echo site_url("user/create");?>", 
						data: {
                              'userName': userName,
                              'groupId': groupId,
                              'fullName': fullName,
                              'emailAddress': emailAddress,
                              'allProvinsiAllowed': allProvinsiAllowed,
                              'remark': remark 
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data['success'] == "1") {
								alert(data['msg']);
                                document.location.href = "<?php echo site_url("user/retrive"); ?>/" + data['userId'];
                            } else {
                                $('.alert-error').removeClass('hide').html('<i class="icon-remove-sign"></i> ' + data['msg']);
                            }
                        }
                    });
                }

                
                function doUpdate(userId,userName,groupId,fullName,emailAddress,allProvinsiAllowed,remark,status) {
                   $.ajax({
                        type: "POST",
						url: "<?php echo site_url("user/change");?>/" + userId,
						data: {
                            'userName': userName,
                            'userId': userId, 
                            'groupId': groupId,
                            'status': status, 
							'fullName': fullName,
							'emailAddress': emailAddress,
							'allProvinsiAllowed': allProvinsiAllowed,
							'remark': remark 
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data['success'] == "1") {
								alert(data['msg']);
                                document.location.href = "<?php echo site_url("user/retrive"); ?>/" + data['userId'];
                            } else {
                                $('.alert-error').removeClass('hide').html('<i class="icon-remove-sign"></i> ' + data['msg']);
                            }
                        }
                    });
                }

                function doDelete(userId) {
                   $.ajax({
                        type: "POST",
						url: "<?php echo site_url("user/delete");?>/" + userId,
						data: {
                            'userId': userId
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data['success'] == "1") {
								alert(data['msg']);
                                document.location.href = "<?php echo site_url("user"); ?>";
                            } else {
                                $('.alert-error').removeClass('hide').html('<i class="icon-remove-sign"></i> ' + data['msg']);
                            }
                        }
                    });
                }


 

				
        </script>

					<!-- end: page -->                        