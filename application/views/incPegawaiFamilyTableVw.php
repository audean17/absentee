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
  												<form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate" action="<?php if (isset($linkForm_getone)) {
      echo $linkForm_getone;
  } ?>" method="post" ><input type="hidden" name="employeeId" class="form-control"   value= <?php echo $myEmployeeId; ?> >
  											<header class="panel-heading">
  												<h2 class="panel-title">Add biodata Pegawai</h2>
  											</header>
  											<div class="panel-body">


                            <div class="form-group">
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
                            </div>
  													<div class="form-group">
  														<label class="col-sm-3 control-label">Family Name</label>
  														<div class="col-sm-9">
  															<input type="text" name="familyName" class="form-control" placeholder="Type familiy name..." />
  														</div>
  													</div>


                                                      <!-- <div class="form-group">
                                                          <label class="col-sm-3 control-label">Department</label>
   														<div class="col-sm-9">
                                                              <select data-plugin-selectTwo class="form-control populate js-example-responsive" name="departmentId" style="width: 100%;"  >
                                                              <option value="-1" >---- All Department ----</option>
                                                                  <?php
                                                                      foreach($departments as $row)
                                                                      {
                                                                       // echo '<option value="'.$row->customer_id.'" ';
                                                                        //echo '>'.$row->customer_name.'</option>';

                                                                        echo '<option value="'.$row->department_id.'"';
                                                                          if (isset($getDepartmentId) and $getDepartmentId==$row->department_id) {
                                                                              echo " selected ";
                                                                          }
                                                                        echo '>'.$row->department_name.'</option>';

                                                                      }
                                                                  ?>
                                                                  </select>

                                                          </div>
                                                      </div> -->

                                                      <!-- <div class="form-group">
                                                          <label class="col-sm-3 control-label">Designation</label>
  														                               <div class="col-sm-9">
                                                              <select data-plugin-selectTwo class="form-control populate js-example-responsive" name="designationId"   style="width: 100%;" >
                                                              <option value="-1" >---- All Designation ----</option>
                                                                  <?php
                                                                      foreach($designations as $row)
                                                                      {
                                                                       // echo '<option value="'.$row->customer_id.'" ';
                                                                        //echo '>'.$row->customer_name.'</option>';

                                                                        echo '<option value="'.$row->designation_id.'"';
                                                                          if (isset($getDesignationId) and $getDesignationId==$row->designation_id) {
                                                                              echo " selected ";
                                                                          }
                                                                        echo '>'.$row->designation_name.'</option>';

                                                                      }
                                                                  ?>
                                                                  </select>

                                                           </div>
                                                     </div> -->

                                                     <div class="form-group">
                           														<label class="col-sm-3 control-label">Tempat Lahir</label>
                           														<div class="col-sm-9">
                           															<input type="text" name="tempatlahir" class="form-control" placeholder="Type Tempat Lahir..." />
                           														</div>
                           													</div>

                                                    <div class="form-group">
                                                      <label for="estimasi1" class="control-label col-sm-3">Tanggal Lahir</label>
                                                      <div class="col-sm-4">
                                                      <div class="input-append date form_datetime">
                                                      <input type="text" name="tanggallahir" id="tanggallahir" class="form-control" value="">
                                                      <span class="add-on"><i class="icon-th"></i></span>

                                                      <script type="text/javascript">
                                                         $(".form_datetime").datetimepicker({
                                                         format: "yyyy-mm-dd hh:ii:ss",
                                                         autoclose: true,
                                                         todayBtn: true,
                                                         pickerPosition: "top-right"
                                                        });
                                                    </script>
                                                    </div>
                                                    </div>
                                                    </div>


                                                  <!-- <div class="form-group">
                                                    <label for="ket1" class="control-label col-sm-3">Alamat</label>
                                                    <div class="col-sm-7">
                                                    <textarea class="form-control" rows="6" name="alamat" id="alamat"></textarea>
                                                    </div>
                                                  </div> -->

                                                  <!-- <div class="form-group">
                                                    <label class="col-sm-3 control-label">Pendidikan</label>
                                                    <div class="col-sm-9">
                                                      <select data-plugin-selectTwo class="form-control populate js-example-responsive" style="width: 100%;" name="pendidikan">
                                                        <optgroup label="Status">
                                                         <option value="-1" >---- Pendidikan ----</option>
                                                         <option value="5">strata 2</option>
                                                         <option value="4">strata 1</option>
                                                          <option value="3">Diploma</option>
                                                          <option value="2">SMA</option>
                                                          <option value="1">SMP</option>
                                                          <option value="0">SD</option>
                                                        </optgroup>
                                                      </select>
                                                    </div>
                                                  </div> -->

                                                  		<!-- <div class="form-group">
  																										<label class="col-sm-3 control-label">Religion</label>
  																											<div class="col-sm-9">
  																												<select data-plugin-selectTwo class="form-control populate js-example-responsive" name="agama" style="width: 100%;"  >
  																												<option value="-1" >---- Religion ----</option>
  																														<?php
  																																foreach($agamas as $row)
  																																{
  																																 // echo '<option value="'.$row->customer_id.'" ';
  																																	//echo '>'.$row->customer_name.'</option>';

  																																	echo '<option value="'.$row->religi_id.'"';
  																																		if (isset($getReligiId) and $getReligiId==$row->religi_id) {
  																																				echo " selected ";
  																																		}
  																																	echo '>'.$row->religi_name.'</option>';

  																																}
  																														?>
  																														</select>

  																										</div>
  																								</div> -->

  																								<!-- <div class="form-group">
  																										<label class="col-sm-3 control-label">Married</label>
  																											<div class="col-sm-9">
  																												<select data-plugin-selectTwo class="form-control populate js-example-responsive" name="married" style="width: 100%;"  >
  																												<option value="-1" >----Status Married ----</option>
  																														<?php
  																																foreach($marrieds as $row)
  																																{
  																																 // echo '<option value="'.$row->customer_id.'" ';
  																																	//echo '>'.$row->customer_name.'</option>';

  																																	echo '<option value="'.$row->married_id.'"';
  																																		if (isset($getMarriedId) and $getMarriedId==$row->married_id) {
  																																				echo " selected ";
  																																		}
  																																	echo '>'.$row->married_name.'</option>';

  																																}
  																														?>
  																														</select>

  																										</div>
  																								</div> -->

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
                          <th>ID Family</th>
                          <!-- <th>ID Employee</th> -->
                          <th>Hubungan</th>
                          <th>Nama</th>
                          <th>Tempat Tanggal Lahir</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>

                      <tbody>
                      <?php
                  		foreach ($listFamily  as $row) {
                  		$myDataSplit=$row->family_id."|".$row->employee_id."|".$row->hubungan_id."|".$row->family_name."|".$row->tempat_lahir."|".$row->tanggal_lahir."|".$row->status;
                                                      ?>
                  										<tr class="gradeX">
                                        <td><?php echo $row->family_id;?></td>
                  											<!-- <td><?php echo $row->employee_id;?></td> -->
                  											<td><?php echo $row->hubungan_name;?></td>
                  											<td><?php echo $row->family_name;?></td>
                  											<td><?php echo $row->tempat_lahir." ".$row->tanggal_lahir;?></td>
                  											<td><?php echo $row->my_status;?></td>
                                        <td class="actions">
                  												<!-- <a href="http://fauzan.net" onclick="javascript:showFormEditEmployeeAffair('<?php echo site_url("pegawai/change/".$row->employee_id."")?>','<?php echo $myDataSplit;?>','<?php echo $myDataSplitDepartment;?>','<?php echo $myDataSplitDesignation;?>','<?php echo $myDataSplitReligi;?>','<?php echo $myDataSplitMarried;?>');return false;"  title="Edit for this row"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;&nbsp;&nbsp; -->
                  												<a href="http://fauzan.net" onclick="javascript:confirmationAlert('<?php echo site_url("pegawai/delete_getone/".$row->family_id."-".$row->employee_id)?>','Are you sure you want to delete this row?');return false;" title="delete for this row"><i class="fa fa-trash-o"></i></a>
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
