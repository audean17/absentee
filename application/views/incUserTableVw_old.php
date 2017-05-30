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
<!--
													<div class="form-group mt-lg">
														<label class="col-sm-3 control-label">Group ID</label>
														<div class="col-sm-9">
															<input type="text" name="groupId" class="form-control" placeholder="Type group id..." required/>
														</div>
													</div>
-->                                                   
													<div class="form-group">
														<label class="col-sm-3 control-label">User Name</label>
														<div class="col-sm-9">
															<input type="text" name="userName" class="form-control" placeholder="Type user name..." required/>
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-3 control-label">User Full Name</label>
														<div class="col-sm-9">
															<input type="text" name="userFullName" class="form-control" placeholder="Type Full Name..." />
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-3 control-label">Email</label>
														<div class="col-sm-9">
															<input type="text" name="email" class="form-control" placeholder="Type email..." />
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-3 control-label">Group</label>
														<div class="col-sm-9">
															<select data-plugin-selectTwo class="form-control populate js-example-responsive" style="width: 100%;" name="groupId">
																<optgroup label="Pilih Group">
                                                                <?php 

																	  foreach($user_groups as $row)
																	  { 
																		echo '<option value="'.$row->group_id.'">'.$row->group_name.'</option>';
																	  }
																  ?>
																</optgroup>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-3 control-label">Status</label>
														<div class="col-sm-9">
															<select data-plugin-selectTwo class="form-control populate js-example-responsive" style="width: 100%;" name="status">
																<optgroup label="Status">
																	<option value="1">Yes</option>
																	<option value="0">No</option>
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
                            
<?php
	  $myDataSplitGroup="";
	   foreach($user_groups as $row)
		{ 
		  $myDataSplitGroup.=$row->group_id.":".$row->group_name.",";
		}
		$myDataSplitGroup=substr($myDataSplitGroup,0,strlen($myDataSplitGroup)-1);
?>
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th>User Name</th>
											<th>Full Name</th>
											<th>Email</th>
											<th>Group</th>
											<th>Last Login</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
                                    <?php
										foreach ($users as $row) {
											$myDataSplit=$row->user_name."|".$row->user_full_name."|".$row->email."|".$row->status."|".$row->group_id;
                                    ?>
										<tr class="gradeX">
											<td><?php echo $row->user_name;?></td>
											<td><?php echo $row->user_full_name;?></td>
											<td><?php echo $row->email;?></td>
											<td><?php echo $row->group_name;?></td>
											<td><?php echo $row->last_login;?></td>
											<td><?php echo $row->my_status;?></td>
											<td class="actions">
												<a href="http://fauzan.net" onclick="javascript:showFormEditUsers('<?php echo site_url("user/change/".$row->user_id."")?>','<?php echo $myDataSplit;?>','<?php echo $myDataSplitGroup;?>');return false;"  title="Edit for this row"><i class="fa fa-pencil"></i></a>&nbsp;
												<a href="http://fauzan.net" onclick="javascript:confirmationAlert('<?php echo site_url("user/delete/".$row->user_id."")?>','Are you sure you want to delete this row?');return false;" title="delete for this row"><i class="fa fa-trash-o"></i></a>
											</td>
										</tr>
                                        <?php } ?>
									</tbody>
								</table>
							</div>
						</section>

					<!-- end: page -->                        