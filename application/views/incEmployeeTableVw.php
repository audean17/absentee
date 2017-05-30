<style type="text/css">
.dataTables_wrapper {
		max-width: 120%;
		display: block;

	}

</style>

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
                  <a class="modal-with-form btn btn-default" href="#modalForm" data-target="#modalForm" data-from="add">Add Data</a>

									<!-- Modal Form -->
									<div id="modalForm" class="modal-block modal-block-primary mfp-hide">
										<section class="panel">
											<header class="panel-heading">
												<h2 class="panel-title">Add data employee</h2>
												<div class="faualert alert-error hide" style="font-weight:bold; color:#F00;float:left;position:relative;top: -20px; right: -240px;"> </div>
											</header>
											<div class="panel-body">

													<div class="form-group">
                             <label class="col-sm-3 control-label">Employee ID</label>
                             <div class="col-sm-9">
                                 <input type="text" name="employeeId"  id="employeeId" class="form-control" placeholder="Type Employee ID..." required/>
                                 <input type="hidden" name="myAction"  id="myAction" class="form-control" >

														 </div>
                             </div>
													<div class="form-group">
														<label class="col-sm-3 control-label">First Name</label>
														<div class="col-sm-9">
															<input type="text" name="employeeFirstName" id="employeeFirstName" class="form-control" placeholder="Type first name..." required/>
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-3 control-label">Last Name</label>
														<div class="col-sm-9">
															<input type="text" name="employeeLastName" id="employeeLastName" class="form-control" placeholder="Type last name..." />
														</div>
													</div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Department</label>
 														<div class="col-sm-9">
                                                            <select data-plugin-selectTwo class="form-control populate js-example-responsive" name="departmentId" id="departmentId" style="width: 100%;"  >
                                                            <option value="-1" >---- All Department ----</option>
                                                                <?php
                                                                    foreach($departments as $row)
                                                                    {
                                                                     echo '<option value="'.$row->department_id.'"';
                                                                        if (isset($getDepartmentId) and $getDepartmentId==$row->department_id) {
                                                                            echo " selected ";
                                                                        }
                                                                      echo '>'.$row->department_name.'</option>';
                                                                    }
                                                                ?>
                                                                </select>

                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Designation</label>
														<div class="col-sm-9">
                                                            <select data-plugin-selectTwo class="form-control populate js-example-responsive" name="designationId"  id="designationId" style="width: 100%;" >
                                                            <option value="-1" >---- All Designation ----</option>
                                                                <?php
                                                                    foreach($designations as $row)
                                                                    {
                                                                      echo '<option value="'.$row->designation_id.'"';
                                                                        if (isset($getDesignationId) and $getDesignationId==$row->designation_id) {
                                                                            echo " selected ";
                                                                        }
                                                                      echo '>'.$row->designation_name.'</option>';
                                                                    }
                                                                ?>
                                                                </select>

                                                         </div>
                                                   </div>

 													<div class="form-group">
														<label class="col-sm-3 control-label">Status</label>
														<div class="col-sm-9">
															<select data-plugin-selectTwo class="form-control populate js-example-responsive" style="width: 100%;" name="status" id="status">
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
														<button class="btn btn-primary" type="submit" id="btnSave" name="btnSave">Submit</button>
														<button class="btn btn-default modal-dismiss">Cancel</button>
													</div>
												</div>
											</footer>
										<!-- </form> -->

										</section>
									</div>

								</div>

							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th>Employee ID</th>
											<th>Employee Name</th>
											<th>Department Name</th>
											<th>Designation Name</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
                                    <?php
										foreach ($groups as $row) {
											$myDataSplit=$row->employee_id."|".$row->employee_first_name."|".$row->employee_last_name."|".$row->department_id."|".$row->designation_id."|".$row->status;
                                    ?>
										<tr class="gradeX">
											<td><?php echo $row->employee_id;?></td>
											<td><?php echo $row->employee_first_name." ".$row->employee_last_name;?></td>
											<td><?php echo $row->department_name;?></td>
											<td><?php echo $row->designation_name;?></td>
											<td><?php echo $row->my_status;?></td>
											<td class="actions">
												<a class="modal-with-form" href="#modalForm" data-target="#modalForm" data-id="<?php echo $myDataSplit;?>" data-from="edit"><i class="fa fa-pencil"></i></a>
												<a href="http://fauzan.net" onclick="javascript:confirmationAlert('<?php echo site_url("employee/delete/".$row->employee_id."")?>','Are you sure you want to delete this row?');return false;" title="delete for this row"><i class="fa fa-trash-o"></i></a>
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
          <script src="<?php echo base_url(); ?>assets/js/accounting.js"></script>
          <script >

           $(document).ready(function() {
                       $('#btnSave').bind('click', function(e) {
                            var myAction = $('input[name=myAction]').val();
                            var employeeId = $('input[name=employeeId]').val();
                            var employeeFirstName = $('input[name=employeeFirstName]').val();
                            var employeeLastName = $('input[name=employeeLastName]').val();
                            var departmentId = $('select[name=departmentId]').val();
                            var designationId = $('select[name=designationId]').val();
                            var status = $('select[name=status]').val();

                            if (employeeId == "" || employeeId=="undefined") {
                                $('.alert-error').removeClass('hide').html('Employee ID harus diisi');
        						return false;
                            } else  if (employeeFirstName == "" || employeeFirstName=="undefined") {
                                $('.alert-error').removeClass('hide').html('Nama depan harus diisi');
                    return false;
                            } else  if (employeeLastName == "" || employeeLastName=="undefined") {
                                $('.alert-error').removeClass('hide').html('Nama akhir harus diisi');
                    return false;
                            } else  if (departmentId == "" || departmentId=="-1" || departmentId=="undefined") {
                                $('.alert-error').removeClass('hide').html('Nama department harus dipilih');
        						return false;
                            } else if (designationId == "" || designationId=="-1" || designationId=="undefined") {
                                $('.alert-error').removeClass('hide').html('Nama designation harus dipilih');
        						return false;
                            } else if (status == "" || status=="-1" || status=="undefined") {
                                $('.alert-error').removeClass('hide').html('status harus dipilih');
        						return false;
                    } else {

										if (myAction == "add" ) {
        							doCreate(employeeId,employeeFirstName, employeeLastName, departmentId, designationId, status);
        						}else{
        							doUpdate(employeeId,employeeFirstName, employeeLastName, departmentId, designationId, status);
        						}
                            }
                        });

                        function doCreate(employeeId,employeeFirstName, employeeLastName, departmentId, designationId, status) {
        					$.ajax({
	                              type: "POST",
        						url: "<?php echo site_url("employee/create");?>",
        						data: {
                                    'employeeId': employeeId,
                                    'employeeFirstName': employeeFirstName,
                                    'employeeLastName': employeeLastName,
                                    'departmentId': departmentId,
                                    'designationId': designationId,
                                    'status': status
                                },
                                dataType: "json",
                                success: function(data) {

                                    if (data['success'] == "1") {
        								alert(data['msg']);
                                        document.location.href = "<?php echo site_url("employee"); ?>";
                                    } else {
                                       alert(data['msg']);
                                    }
                                }
                            });
                        }


                        function doUpdate(employeeId, employeeFirstName, employeeLastName, departmentId, designationId, status) {
        					$.ajax({
                                type: "POST",
        						url: "<?php echo site_url("employee/update");?>",
        						data: {
                                    'employeeId': employeeId,
                                    'employeeFirstName': employeeFirstName,
                                    'employeeLastName': employeeLastName,
                                    'departmentId': departmentId,
                                    'designationId': designationId,
                                    'status': status
                                },
                                dataType: "json",
                                success: function(data) {
                                    if (data['success'] == "1") {
        								alert(data['msg']);
                                        document.location.href = "<?php echo site_url("employee"); ?>";
                                    } else {
                                       alert(data['msg']);
                                    }
                                }
                            });
                        }

        		});


        		$(document).on("click", ".modal-with-form", function () {
        			var myFrom=$(this).data('from');
        			if(myFrom=="add"){
        				  $(".panel-body #employeeId").val("");
        				  $(".panel-body #myAction").val("add");
                  $(".panel-body #employeeFirstName").val("");
                  $(".panel-body #employeeLastName").val("");
        				  $("#departmentId").select2('val',-1);
        				  $("#designationId").select2('val',-1);
        				  $("#status").select2('val',-1);

        			}else{
        				  var arrData=new Array();
        				  arrData=$(this).data('id').split("|");

        				  $(".panel-body #employeeId").val(arrData[0]);
									$(".panel-body #myAction").val("edit");
                  $(".panel-body #employeeFirstName").val(arrData[1]);
                  $(".panel-body #employeeLastName").val(arrData[2]);
        				  $("#departmentId").select2('val',arrData[3]);
        				  $("#designationId").select2('val',arrData[4]);
        				  $("#status").select2('val',arrData[5]);

        			}

        		});
         </script>
