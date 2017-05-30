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
												<h2 class="panel-title">Add data Inventory</h2>
											</header>
											<div class="panel-body">

													<!-- <div class="form-group">
														<label class="col-sm-3 control-label">Inventory ID</label>
														<div class="col-sm-9">
															<input type="text" name="inventoryId" class="form-control" placeholder="Type Inventory ID..." required/>
														</div>
													</div> -->
													<div class="form-group">
														<label class="col-sm-3 control-label">Item Name</label>
														<div class="col-sm-9">
															<input type="text" name="itemName" class="form-control" placeholder="Type Item name..." required/>
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-3 control-label">Item Quantity</label>
														<div class="col-sm-9">
															<input type="text" name="itemQTY" class="form-control" placeholder="Type Item Quantity..." />
														</div>
													</div>
                          <div class="form-group">
														<label class="col-sm-3 control-label">Item Price</label>
														<div class="col-sm-9">
															<input type="text" name="itemPrice" class="form-control" placeholder="Type Item Price..." />
														</div>
													</div>

                          <div class="form-group">
                          <label class="col-sm-3 control-label">Item Category</label>
 													<div class="col-sm-9">
                          <select data-plugin-selectTwo class="form-control populate js-example-responsive" name="itemCate" style="width: 100%;"  >
                          <option value="-1" >---- All Category ----</option>
                            <?php
                            foreach($categorys as $row)
                            {
                                                                     // echo '<option value="'.$row->customer_id.'" ';
                                                                      //echo '>'.$row->customer_name.'</option>';

                              echo '<option value="'.$row->inventory_id.'"';
                              if (isset($getInventoryId) and $getInventoryId==$row->inventory_id) {
                              echo " selected ";
                              }
                              echo '>'.$row->inventory_name.'</option>';

                              }
                              ?>
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

							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th>Item ID</th>
											<th>Item Name</th>
                      <th>Qty</th>
                      <th>Price</th>
                      <th>Category</th>

											<!-- <th>Price</th> -->
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
                                    <?php
										foreach ($gabungs as $row) {
										$myDataSplit=$row->item_id."|".$row->item_name."|".$row->item_qty."|".$row->item_price."|".$row->inventory_id."|".$row->status;
                                    ?>
										<tr class="gradeX">
											<td><?php echo $row->item_id;?></td>
											<td><?php echo $row->item_name;?></td>
											<td><?php echo $row->item_qty;?></td>
                      <td><?php echo $row->item_price;?></td>
											<td><?php echo $row->inventory_name;?></td>
											<td><?php echo $row->my_status;?></td>

											<td class="actions">
												<a href="http://fauzan.net" onclick="javascript:showFormEditInventory('<?php echo site_url("inventory/change/".$row->item_id."")?>','<?php echo $myDataSplit;?>','<?php echo $myDataSplitCate;?>');return false;"  title="Edit for this row"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
												<a href="http://fauzan.net" onclick="javascript:confirmationAlert('<?php echo site_url("inventory/delete/".$row->item_id."")?>','Are you sure you want to delete this row?');return false;" title="delete for this row"><i class="fa fa-trash-o"></i></a>
												<!-- <a href="http://fauzan.net" onclick="javascript:showFormEditEmployee('<?php echo site_url("employee/change/".$row->employee_id."")?>','<?php echo $myDataSplit;?>','<?php echo $myDataSplitDepartment;?>','<?php echo $myDataSplitDesignation;?>');return false;"  title="Edit for this row"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;&nbsp;&nbsp; -->
												<!-- <a href="http://fauzan.net" onclick="javascript:confirmationAlert('<?php echo site_url("employee/delete/".$row->employee_id."")?>','Are you sure you want to delete this row?');return false;" title="delete for this row"><i class="fa fa-trash-o"></i></a> -->
											</td>
										</tr>
                                        <?php } ?>
									</tbody>
								</table>
							</div>
						</section>

					<!-- end: page -->
