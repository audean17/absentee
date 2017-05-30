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
												<div class="col-sm-3">

												</div>

											</div>

										</form>


                                    </div>
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th  rowspan="2" style="text-align:center;vertical-align:central;">Date</th>
											<th  colspan="2" style="text-align:center;">Absent</th>
											<th colspan="2" style="text-align:center;">Hour</th>
											<th colspan="3" style="text-align:center;">Over time</th>
											<th  colspan="4" style="text-align:center;">Cut Off Absent</th>
 										</tr>
										<tr>
											<th>IN</th>
											<th>OUT</th>
											<th>Total Hour</th>
											<th>Effective</th>
											<th>Status</th>
											<th>Total</th>
											<th>Reason</th>
											<th>Status</th>
											<th>Type</th>
											<th>Pengajuan</th>
 										</tr>
									</thead>
									<tbody>
 									<?php
										foreach ($listAbsentee as $row) {

											$full_name=$row->employee_first_name." ".$row->employee_last_name;
											$myDataSplitOvertime=$row->employee_id."|".$full_name."|".$row->absent_date."|".$row->in."|".$row->out."|".$row->amount_overtime."|".$row->absent_date_db."|".$row->overtime_reason;
											$myDataSplitComplain=$row->employee_id."|".$full_name."|".$row->absent_date."|".$row->in."|".$row->out."|".$row->cut_absentee_type_desc."|".$row->absent_date_db."|".$row->absentee_complain;
                                    ?>
										<tr class="gradeX">
											<td><?php echo $row->absent_date;?></td>
											<td><?php echo $row->in;?></td>
											<td><?php echo $row->out;?></td>
											<td><?php echo $row->hour;?></td>
											<td><?php echo number_format($row->hour_effective,2,".",",");?></td>
											<td><?php echo $row->overtime_status;?></td>
											<td><?php echo number_format($row->amount_overtime,2,".",",");?></td>
                                            <?php
												if ($this->session->userdata('groupId')<>"UG003") { /*selain user biasa*/
													if ($row->is_overtime_des=="1"){
														if ($row->overtime_status=="YES" and $row->amount_overtime>=1){
															if($row->is_approve_overtime ==0) {
																  echo "<td>";
																  echo "<button type=\"button\" class=\"mb-xs mt-xs mr-xs btn-xm btn-primary\" onclick=\"javascript:showFormReasonOvertime('".site_url("absentee/changeReason/".$row->employee_id)."','".$myDataSplitOvertime."');return false;\"  ><i class=\"fa fa-pencil\"></i>Reason</button>";
																  if ($this->session->userdata('groupId')<>"UG002") { /*selain user biasa dan operator*/
																  	echo "<button type=\"button\" class=\"mb-xs mt-xs mr-xs btn-xm btn-danger\" onclick=\"javascript:showFormApprovalOvertime('".site_url("absentee/approvalOvertime/".$row->employee_id)."','".$myDataSplitOvertime."');return false;\"  ><i class=\"fa fa-check\"></i>Approve</button>";

																  }
																 echo "</td>";
															}else if ($row->is_approve_overtime ==1) {
																  echo "<td>".$row->overtime_reason." - <font style=\"font-weight:bold;color:blue;\">(Approve - </font><font style=\"color:blue;\">".$row->approve_reason_overtime." <b>)</b></font></td>";

															}else {
																echo "<td>";
																echo $row->overtime_reason;
																 if ($this->session->userdata('groupId')<>"UG002") { /*selain user biasa dan operator*/
																	  echo "<button type=\"button\" class=\"mb-xs mt-xs mr-xs btn-xm btn-danger\" onclick=\"javascript:showFormApprovalOvertime('".site_url("absentee/approvalOvertime/".$row->employee_id)."','".$myDataSplitOvertime."');return false;\"  ><i class=\"fa fa-pencil\"></i>Approve</button>";
																 }
																echo "</td>";
															}

														}elseif ($row->overtime_status=="NO" and $row->is_approve_overtime==-1){
															 echo "<td>".$row->overtime_reason." - <font style=\"font-weight:bold;color:red;\">(Reject - </font><font style=\"color:red;\">".$row->approve_reason_overtime." <b>)</b></font></td>";
														}else{

															echo "<td>&nbsp;</td>";/*cek overtime di bawah 1 jam*/
														}
													}else{

															echo "<td>&nbsp;</td>"; /*cek overtime untuk tiap designation*/
													}
												}else{

														echo "<td>&nbsp;</td>"; /*group id*/
												}
											?>

											<td><?php echo $row->absent_status;?></td>
											<td><?php echo $row->cut_absentee_type_desc;?></td>
                                            <?php
												if ($this->session->userdata('groupId')<>"UG003") { /*selain user biasa*/
													if ($row->is_cut_absentee_des=="1"){
														if ($row->is_cut_absentee=="1" and $row->cut_absentee_type<>"N"){
															if( $row->is_approve_complain ==0) {
																echo "<td><button type=\"button\" class=\"mb-xs mt-xs mr-xs btn-sm btn-primary\" onclick=\"javascript:showFormComplainAbsentee('".site_url("absentee/changeComplain/".$row->employee_id)."','".$myDataSplitComplain.">');return false;\"  ><i class=\"fa fa-pencil\"></i>Complain</button></td>";


															}else if ($row->is_approve_complain ==-1) {
																echo "<td>".$row->absentee_complain." - <font style=\"font-weight:bold;color:red;\">(Reject - </font><font style=\"color:red;\">".$row->approve_reason_complain." <b>)</b></font></td>";
															}else {
																echo  "<td>";
																echo $row->absentee_complain;
																if ($this->session->userdata('groupId')<>"UG002") { /*selain user biasa dan operator*/

																echo "<button type=\"button\" class=\"mb-xs mt-xs mr-xs btn-sm btn-danger\" onclick=\"javascript:showFormApprovalComplain('".site_url("absentee/approvalComplain/".$row->employee_id)."','".$myDataSplitComplain."');return false;\"  ><i class=\"fa fa-pencil\"></i>Approve</button>";
																}
																	echo  "</td>";
															}

														}elseif ($row->is_cut_absentee=="0" and $row->is_approve_complain==1){
															echo "<td>".$row->absentee_complain." - <font style=\"font-weight:bold;color:blue;\">(Approve - </font><font style=\"color:blue;\">".$row->approve_reason_complain." <b>)</b></font></td>";
														}else{
															echo "<td>&nbsp;</td>"; /*normal*/
														}
													}else{
														echo "<td>&nbsp;</td>"; /*cek potong cuti untuk tiap designation*/
													}
												}else{
														echo "<td>&nbsp;</td>";  /*group id*/
													}
											?>

										</tr>
                                        <?php } ?>
									</tbody>
								</table>
                                <!-- <p></p> -->

                                 <div class="text-right mr-lg">
								<a href="<?php echo site_url("absentee/employeeAbsentPrint/".$myEmployeeId."-".$myPeriodeId);?>" target="_blank" class="btn btn-primary ml-sm"><i class="fa fa-print"></i> Print</a>
							</div>
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
