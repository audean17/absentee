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
										<!--												<form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate" action="<?php //if (isset($linkForm)) {     echo $linkForm; } ?>" method="post" > -->
									<section class="panel">
											<header class="panel-heading">
												<h2 class="panel-title">Add data designation</h2>
                        <div class="faualert alert-error hide" style="font-weight:bold; color:#F00;float:left;position:relative;top: -20px; right: -240px;"> </div>											</header>
                        </header>
                      <div class="panel-body">

													<div class="form-group">
														<label class="col-sm-3 control-label">Designation Name</label>
														<div class="col-sm-9">
															<input type="hidden" name="designationId" id="designationId" class="form-control" >
															<input type="text" name="designationName" id="designationName" class="form-control" placeholder="Type designation name..." required/>
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-3 control-label">Is Overtime</label>
														<div class="col-sm-9">
															<select data-plugin-selectTwo class="form-control populate js-example-responsive" style="width: 100%;" name="isOvertime" id="isOvertime">
																<optgroup label="Status Overtime">
																	<option value="1">Yes</option>
																	<option value="0">No</option>
																</optgroup>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-3 control-label">Is Cut Off Absent</label>
														<div class="col-sm-9">
															<select data-plugin-selectTwo class="form-control populate js-example-responsive" style="width: 100%;" name="isCutAbsentee" id="isCutAbsentee">
																<optgroup label="Status Absent">
																	<option value="1">Yes</option>
																	<option value="0">No</option>
																</optgroup>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-3 control-label">Description</label>
														<div class="col-sm-9">
															<input type="text" name="description" id="description" class="form-control" placeholder="Type description..." />
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
														<button class="btn btn-primary" type="submit" name="btnSave" id="btnSave" >Submit</button>
														<button class="btn btn-default modal-dismiss">Cancel</button>
													</div>
												</div>
											</footer>
											<!--									</form> -->

										</section>
									</div>

								</div>

							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th>Designation ID</th>
											<th>Designation name</th>
											<th>Is Overtime</th>
											<th>Is Cut Off Absent</th>
											<th>Description</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
                                    <?php
										foreach ($designations as $row) {
											$myDataSplit=$row->designation_id."|".$row->designation_name."|".$row->is_overtime."|".$row->is_cut_absentee."|".$row->description."|".$row->status;
                                    ?>
										<tr class="gradeX">
											<td><?php echo $row->designation_id;?></td>
											<td><?php echo $row->designation_name;?></td>
											<td><?php echo $row->my_overtime;?></td>
											<td><?php echo $row->my_cut_absent;?></td>
											<td><?php echo $row->description;?></td>
											<td><?php echo $row->my_status;?></td>
											<td class="actions">
                        <a class="modal-with-form" href="#modalForm" data-target="#modalForm" data-id="<?php echo $myDataSplit;?>" data-from="edit"><i class="fa fa-pencil"></i></a>
												<a href="http://fauzan.net" onclick="javascript:confirmationAlert('<?php echo site_url("designation/delete/".$row->designation_id."")?>','Are you sure you want to delete this row?');return false;" title="delete for this row"><i class="fa fa-trash-o"></i></a>
											</td>
										</tr>
                                        <?php } ?>
									</tbody>
								</table>
							</div>
						</section>

            <script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
            <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
            <script src="<?php echo base_url(); ?>assets/js/accounting.js"></script>

            <script >

            $(document).ready(function() {
                        $('#btnSave').bind('click', function(e) {

					                   var designationId = $('input[name=designationId]').val();
                             var designationName = $('input[name=designationName]').val();
                             var isOvertime = $('select[name=isOvertime]').val();
                             var isCutAbsentee = $('select[name=isCutAbsentee]').val();
                             var description = $('input[name=description]').val();
                             var status = $('select[name=status]').val();
                            if (designationName == "" || designationName=="undefined") {
                                 $('.alert-error').removeClass('hide').html('Nama Designation harus diisi');
                     return false;
                             } else if (isOvertime == "" || isOvertime=="-1" || isOvertime=="undefined") {
                                 $('.alert-error').removeClass('hide').html('is Overtime harus dipilih');
                     return false;
                            } else if (isCutAbsentee == "" || isCutAbsentee=="-1" || isCutAbsentee=="undefined") {
                                $('.alert-error').removeClass('hide').html('is Cut Absentee harus dipilih');
                    return false;
                            } else  if (description == "" || description=="undefined") {
                                $('.alert-error').removeClass('hide').html('Deskripsi harus diisi');
                    return false;
                             } else if (status == "" || status=="-1" || status=="undefined") {
                                 $('.alert-error').removeClass('hide').html('Status harus dipilih');
         						return false;
                     } else {
										if (designationId == "" || designationId=="undefined") {
         							doCreate(designationName, isOvertime, isCutAbsentee, description, status);
         						}else{
         							doUpdate(designationId, designationName, isOvertime, isCutAbsentee, description, status);
         						}
                             }



                         });

                         function doCreate(designationName, isOvertime, isCutAbsentee, description, status) {
                  $.ajax({
                                type: "POST",
                    url: "<?php echo site_url("designation/create");?>",
                    data: {
                                    //  'departmentId': departmentId,
                                     'designationName': designationName,
                                     'isOvertime': isOvertime,
                                     'isCutAbsentee': isCutAbsentee,
                                     'description': description,
                                     'status': status

                                 },
                                 dataType: "json",
                                 success: function(data) {

                                     if (data['success'] == "1") {
                        alert(data['msg']);
                                         document.location.href = "<?php echo site_url("designation"); ?>";
                                     } else {
                                        alert(data['msg']);
                                     }
                                 }
                             });
                         }                    

                       function doUpdate(designationId,designationName, isOvertime, isCutAbsentee, description, status) {
                $.ajax({
                               type: "POST",
                  url: "<?php echo site_url("designation/update");?>",
                  data: {
                                    'designationId': designationId,
                                    'designationName': designationName,
                                    'isOvertime': isOvertime,
                                    'isCutAbsentee': isCutAbsentee,
                                    'description': description,
                                    'status': status
                               },
                               dataType: "json",
                               success: function(data) {
                                   if (data['success'] == "1") {
                      alert(data['msg']);
                                       document.location.href = "<?php echo site_url("designation"); ?>";
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
													 /*
                             $(".panel-body #designationId").val("");
                             $(".panel-body #designationName").val("");
                             $("#isOvertime").select2('val',-1);
                             $("#isCutAbsentee").select2('val',-1);
                             $(".panel-body #description").val("");
                             $("#status").select2('val',-1);
														 */
                         }else{
                             var arrData=new Array();
                             arrData=$(this).data('id').split("|");

                             $(".panel-body #designationId").val(arrData[0]);
                             $(".panel-body #designationName").val(arrData[1]);
                             $("#isOvertime").select2('val',arrData[2]);
                             $("#isCutAbsentee").select2('val',arrData[3]);
                             $(".panel-body #description").val(arrData[4]);
                             $("#status").select2('val',arrData[5]);

                         }

                       });
                       </script>
