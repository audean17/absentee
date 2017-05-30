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
									<!-- <a class="modal-with-form btn btn-default" href="#modalForm" data-target="#modalForm" id="1">Add Data</a> -->

										<div id="modalForm" class="modal-block modal-block-primary mfp-hide">
										<section class="panel">
												<form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate" action="<?php if (isset($linkForm)) {
    echo $linkForm;
} ?>" method="post" >
											<!-- <header class="panel-heading">
												<h2 class="panel-title">Add data Bank</h2>
											</header> -->
											<!-- <div class="panel-body">

                          <div class="form-group">
                              <label class="col-sm-3 control-label">Bank Parent</label>
  														<div class="col-sm-9">
                                  <select data-plugin-selectTwo class="form-control populate js-example-responsive" name="parentId" style="width: 100%;"  >
                                  <option value="-1" >---- All Bank ----</option>
                                      <?php
                                          foreach($queryBankParent2 as $row)
                                          {
                                           // echo '<option value="'.$row->customer_id.'" ';
                                            //echo '>'.$row->customer_name.'</option>';

                                            echo '<option value="'.$row->bank_id.'"';
                                              if (isset($getbankId) and $getbankId==$row->bank_id) {
                                                  echo " selected ";
                                              }
                                            echo '>'.$row->bank_name.'</option>';

                                          }
                                      ?>
                                      </select>

                              </div>
                          </div>
													<div class="form-group">
														<label class="col-sm-3 control-label">Bank Name</label>
														<div class="col-sm-9">
															<input type="text" name="bankName" class="form-control" placeholder="Type Bank name..." />
														</div>
													</div>

                          <div class="form-group">
                            <label for="ket1" class="control-label col-sm-3">Address</label>
                            <div class="col-sm-7">
                            <textarea class="form-control" rows="6" name="address" placeholder="Type address"></textarea>
                            </div>
                          </div>

                          <div class="form-group">
														<label class="col-sm-3 control-label">Telp</label>
														<div class="col-sm-9">
															<input type="text" name="telp" class="form-control" placeholder="Type Telp Number..." />
														</div>
													</div>

                          <div class="form-group">
														<label class="col-sm-3 control-label">Fax</label>
														<div class="col-sm-9">
															<input type="text" name="fax" class="form-control" placeholder="Type Fax NUmber..." />
														</div>
													</div>

                          <div class="form-group">
                            <label for="ket1" class="control-label col-sm-3">Description</label>
                            <div class="col-sm-7">
                            <textarea class="form-control" rows="6" name="description" placeholder="Type Description"></textarea>
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
											</div> -->
											<!-- <footer class="panel-footer">
												<div class="row">
													<div class="col-md-12 text-right">
														<button class="btn btn-primary" type="submit">Submit</button>
														<button class="btn btn-default modal-dismiss">Cancel</button>
													</div>
												</div>
											</footer> -->
										</form>

										</section>
									</div>

								</div>

							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<!-- <th style="width:20px;">User ID</th>

											<th style="width:20px;">Action</th> -->
										</tr>
									</thead>
									<tbody>
                                    <?php
										// foreach ($groups as $row) {
										// $myDataSplit=$row->bank_id."|".$row->parent_id."|".$row->bank_name."|".$row->address."|".$row->telp."|".$row->fax."|".$row->description."|".$row->status;
                                    ?>
										<tr class="gradeX">
											<!-- <td><?php echo $row->bank_id;?></td> -->

											<!-- <td class="actions">
												<a href="http://fauzan.net" onclick="javascript:showFormEditBank('<?php echo site_url("bank/change/".$row->bank_id."")?>','<?php echo $myDataSplit;?>','<?php echo $myDataSplitBankParent;?>');return false;"  title="Edit for this row"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
												<a href="http://fauzan.net" onclick="javascript:confirmationAlert('<?php echo site_url("bank/delete/".$row->bank_id."")?>','Are you sure you want to delete this row?');return false;" title="delete for this row"><i class="fa fa-trash-o"></i></a>
											</td> -->
										</tr>
                
									</tbody>
								</table>
							</div>
						</section>

					<!-- end: page -->
