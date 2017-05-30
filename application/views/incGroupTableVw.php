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
                            		<table cellpadding="0" cellspacing="0" width="100%" border="0">
                                    	<tr >
                                        	<td width="10%"><a class="modal-with-form btn btn-default" href="#modalForm" data-target="#modalForm" id="1">Add Data</a></td>
                                        	<td width="18%">&nbsp;</td>
                                        	<td style="font-family:Arial, Helvetica, sans-serif; font-size:19px;">
											<?php if ($this->session->flashdata('message')){
												    echo "<p><i>".$this->session->flashdata("message")."</i></p>";
												  } 
											?></td>
                                        </tr>
                                    </table>
									

									<!-- Modal Form -->
									<div id="modalForm" class="modal-block modal-block-primary mfp-hide">
										<section class="panel">
												<form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate" action="<?php if (isset($linkForm)) {
    echo $linkForm;
} ?>" method="post" >
											<header class="panel-heading">
												<h2 class="panel-title">Add data group</h2>
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
														<label class="col-sm-3 control-label">Group Name</label>
														<div class="col-sm-9">
															<input type="text" name="groupName" class="form-control" placeholder="Type group name..." required/>
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-3 control-label">Description</label>
														<div class="col-sm-9">
															<input type="text" name="description" class="form-control" placeholder="Type description..." />
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
							
                            
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th>Group ID</th>
											<th>Group Name</th>
											<th>Description</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
                                    <?php
										foreach ($groups as $row) {
											$myDataSplit=$row->group_id."|".$row->group_name."|".$row->description."|".$row->status;
                                    ?>
										<tr class="gradeX">
											<td><?php echo $row->group_id;?></td>
											<td><?php echo $row->group_name;?></td>
											<td><?php echo $row->description;?></td>
											<td><?php echo $row->my_status;?></td>
											<td class="actions">
												<a href="http://fauzan.net" onclick="javascript:showFormEdit('<?php echo site_url("group/change/".$row->group_id."")?>','<?php echo $myDataSplit;?>');return false;"  title="Edit for this row"><i class="fa fa-pencil"></i></a>&nbsp;
												<a href="http://fauzan.net" onclick="javascript:confirmationAlert('<?php echo site_url("group/delete/".$row->group_id."")?>','Are you sure you want to delete this row?');return false;" title="delete for this row"><i class="fa fa-trash-o"></i></a>
											</td>
										</tr>
                                        <?php } ?>
									</tbody>
								</table>
							</div>
						</section>

					<!-- end: page -->                        