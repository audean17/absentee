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
                                        <form id="demo-form" class="form-horizontal form-bordered" novalidate="novalidate" action="<?php if (isset($linkSearch)) {
    echo $linkSearch;
} ?>" method="post" >
											<!-- <div class="form-group">
												<label class="col-sm-6 control-label">Periode ku</label>
												<div class="col-sm-3">
                                                <div class="input-group mb-md">
													<select data-plugin-selectTwo class="form-control populate js-example-responsive" name="periodeId" id="periodeId" onchange="this.form.submit()">
                                                    <option value="-1" >---- All Periode ----</option>
														<?php
															foreach($periods as $row)
															{
															  echo '<option value="'.$row->periode_id.'"';
															  	if (isset($periodeId) and $periodeId==$row->periode_id) {
																	echo " selected ";
																}
															  echo '>'.$row->periode_name.'</option>';

															}
														?>
                                                        </select>
                                                  </div>
												</div>


													<label class="col-sm-6 control-label">Department Name</label>
												<div class="col-sm-3">
                                                <div class="input-group mb-md">
													<select data-plugin-selectTwo class="form-control populate js-example-responsive" name="departmentId" id="departmentId"  onchange="this.form.submit()">
                                                    <option value="-1" >---- Choose Department ----</option>
														<?php
															foreach($departments as $row)
															{
															  echo '<option value="'.$row->department_id.'"';
															  	if (isset($departmentId) and $departmentId==$row->department_id) {
																	echo " selected ";
																}
															  echo '>'.$row->department_name.'</option>';

															}
														?>
                                                        </select>

                                                 </div>
												</div>
											</div> -->

										</form>


                                    </div>
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th>Employee ID</th>
											<th>Employee name</th>
											<th>Department</th>
											<th>Designation</th>
											<th>Absent Status</th>
											<th>Overtime Status</th>
											<th>Periode Absent</th>
										</tr>
									</thead>
									<tbody>
                                    <?php
										foreach ($listAbsentee as $row) {
											//$myDataSplit=$row->designation_id."|".$row->designation_name."|".$row->is_overtime."|".$row->is_cut_absentee."|".$row->description."|".$row->status;
                                    ?>
										<tr class="gradeX">
											<td><?php echo $row->employee_id;?></td>
											<td><?php echo $row->employee_first_name." ".$row->employee_last_name;?></td>
											<td><?php echo $row->department_name;?></td>
											<td><?php echo $row->designation_name;?></td>
											<td><?php echo $row->absent_status;?></td>
											<td><?php echo $row->overtime_status;?></td>
											<td class="actions">
                                                <a href="<?php echo site_url("absentee/getOne/".$row->employee_id."-".$row->year);?>" title="step to detail"><?php echo $row->periode;?><i class="glyphicon glyphicon-step-forward"></i></a>
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
<script>

/*
            $(document).ready(function() {

               $("#periodeId").change(function(){
                    var periodeId = $('select[name=periodeId]').val();
                    var departmentId = $('select[name=departmentId]').val();
 						  getData(periodeId, departmentId);
                });


               $("#departmentId").change(function(){
                    var periodeId = $('select[name=periodeId]').val();
                    var departmentId = $('select[name=departmentId]').val();
 						  getData(periodeId, departmentId);
                });




                function getData(periodeId, departmentId) {
                    $.ajax({
                        type: "POST",
						url: "<?php //echo site_url("absentee/retrive");?>",
						data: {
                            'periodeId': periodeId,
                             'departmentId': departmentId
                        },
                        dataType: "text",
                        success: function(data) {

                        }
                    });
                }


            });

*/


</script>
