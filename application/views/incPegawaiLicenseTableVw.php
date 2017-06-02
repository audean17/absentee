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

								<h2 class="panel-title"><?php echo $titleTable;?></h2>
							</header>

									<div class="panel-body">

											<div class="form-group">
												<label class="col-sm-3 control-label">Department : <?php echo $myDepartment;?></label>
										</div>
<a class="modal-with-form btn btn-default" href="#modalForm" data-target="#modalForm" id="1">Add Data</a>
                    <div id="modalForm" class="modal-block modal-block-primary mfp-hide">
  										<section class="panel">
  												<form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate" action="<?php if (isset($linkForm_getthree)) {
      echo $linkForm_getthree;
  } ?>" method="post" ><input type="hidden" name="employeeId" class="form-control"   value= <?php echo $myEmployeeId; ?> >
  											<header class="panel-heading">
  												<h2 class="panel-title">Add License Training</h2>
  											</header>
  											<div class="panel-body">


                            <!-- <div class="form-group">
                                <label class="col-sm-3 control-label">Relation</label>
                                <div class="col-sm-9">
                                    <select data-plugin-selectTwo class="form-control populate js-example-responsive" name="hubunganId" style="width: 100%;"  >
                                    <option value="-1" >---- Relation Status ----</option>
                                        <?php
                                            foreach($hubungans as $row)
                                            {
                                             // echo '<option value="'.$row->customer_id.'" ';
                                              //echo '>'.$row->customer_name.'</option>';

                                              echo '<option value="'.$row->hubungan_id.'"';
                                                if (isset($gethubunganId) and $gethubunganId==$row->hubungan_id) {
                                                    echo " selected ";
                                                }
                                              echo '>'.$row->hubungan_name.'</option>';

                                            }
                                        ?>
                                        </select>

                                </div>
                            </div> -->

  													<div class="form-group">
  														<label class="col-sm-3 control-label">License Name</label>
  														<div class="col-sm-9">
  															<input type="text" name="licenseName" class="form-control" placeholder="Type License name..." />
  														</div>
  													</div>


                            <div class="form-group">
                              <label class="col-md-3 control-label">Periode</label>
                              <div class="col-md-6">
                              <div class="input-group">
                              <span class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                              </span>
                              <input type="text" data-plugin-datepicker class="form-control" name="periode" id="periode">
                              </div>
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
                          <th>ID License</th>
                          <!-- <th>ID Employee</th> -->
                          <th>License Name</th>
                          <th>Periode</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>

                      <tbody>
                      <?php
                  		foreach ($listLicense  as $row) {
                  		$myDataSplit=$row->license_id."|".$row->employee_id."|".$row->license_name."|".$row->periode."|".$row->status;
                                                      ?>
                  										<tr class="gradeX">
                                        <td><?php echo $row->license_id;?></td>
                  											<!-- <td><?php echo $row->employee_id;?></td> -->
                  											<td><?php echo $row->license_name;?></td>
                  											<td><?php echo $row->periode;?></td>
                  											<td><?php echo $row->my_status;?></td>
                                        <td class="actions">
                  												<!-- <a href="http://fauzan.net" onclick="javascript:showFormEditEmployeeAffair('<?php echo site_url("pegawai/change/".$row->employee_id."")?>','<?php echo $myDataSplit;?>','<?php echo $myDataSplitDepartment;?>','<?php echo $myDataSplitDesignation;?>','<?php echo $myDataSplitReligi;?>','<?php echo $myDataSplitMarried;?>');return false;"  title="Edit for this row"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;&nbsp;&nbsp; -->
                  												<a href="http://fauzan.net" onclick="javascript:confirmationAlert('<?php echo site_url("pegawai/delete_getthree/".$row->license_id."-".$row->employee_id)?>','Are you sure you want to delete this row?');return false;" title="delete for this row"><i class="fa fa-trash-o"></i></a>
                                        </td>
                  										</tr>
                                                          <?php } ?>
                  									</tbody>
                  								</table>
                  							</div>
                  						</section>

					<!-- end: page -->

<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
