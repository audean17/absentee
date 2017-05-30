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
									<div class="form-group">
									<label class="col-sm-6 control-label">Periode</label>
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


									<label class="col-sm-6 control-label">Bank Name</label>
									<div class="col-sm-3">
                  <div class="input-group mb-md">
									<select data-plugin-selectTwo class="form-control populate js-example-responsive" name="bankId" id="bankId"  onchange="this.form.submit()">
                  <option value="-1" >---- Choose Bank ----</option>
									<?php
									foreach($banks as $row)
									{
									echo '<option value="'.$row->bank_id.'"';
									if (isset($bankId) and $bankId==$row->bank_id) {
									echo " selected ";
									}
									echo '>'.$row->bank_name.'</option>';

									}
									?>
                  </select>
                  </div>
									</div>
									</div>

									</form>


                                    </div>

<div class="panel-body">
									<a class="modal-with-form btn btn-default" href="#modalForm" data-target="#modalForm" data-from="add">Add Data</a>

									<!-- Modal Form -->
									<div id="modalForm" class="modal-block modal-block-primary mfp-hide">
										<section class="panel">
<!--												<form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate" action="<?php //if (isset($linkForm)) {     echo $linkForm; } ?>" method="post" > -->
											<header class="panel-heading">
												<h2 class="panel-title">Data Transaction</h2>
                      <div class="faualert alert-error hide" style="font-weight:bold; color:#F00;float:left;position:relative;top: -20px; right: -240px;"> </div>
											</header>
											<div class="panel-body">

                                            <div class="col-md-12">
                                                    <div class="tabs tabs-danger">
                                                        <ul class="nav nav-tabs">
                                                            <li class="active">
                                                                <a href="#product" data-toggle="tab"><i class="fa fa-star"></i>Product</a>
                                                            </li>
                                                            <li>
                                                                <a href="#customer" data-toggle="tab">Customer</a>
                                                            </li>
                                                            <li>
                                                                <a href="#another" data-toggle="tab">Another</a>
                                                            </li>
                                                        </ul>
                                                        <div class="tab-content">
																<input type="hidden" name="transactionId" id="transactionId" />
                                                                <div id="product" class="tab-pane active">

                                                                     <div class="form-group">
                                                                        <label class="col-sm-3 control-label">Polis</label>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" name="polisNumber"  id="polisNumber" class="form-control" placeholder="Type polis Number..." required/>
                                                                        </div>
                                                                     </div>
                                                                         <div class="form-group">
                                                                            <label class="col-sm-3 control-label">Product Name</label>
                                                                            <div class="col-sm-9">
                                                                                <div class="input-group mb-md">
                                                                                    <select data-plugin-selectTwo class="form-control populate js-example-responsive" name="productId" id="productId" style="width: 100%;" >
                                                                                    <option value="-1" >---- Choose Product ----</option>
                                                                                        <?php
                                                                                            foreach($products as $row)
                                                                                            {
                                                                                              echo '<option value="'.$row->product_id.'"';
                                                                                                if (isset($productId) and $productId==$row->product_id) {
                                                                                                    echo " selected ";
                                                                                                }
                                                                                              echo '>'.$row->product_name.'</option>';

                                                                                            }
                                                                                        ?>
                                                                                        </select>

                                                                                 </div>
                                                                            </div>
                                                                        </div>
                                                                          <div class="form-group">
                                                                            <label class="col-sm-3 control-label">Insurance Name</label>
                                                                            <div class="col-sm-9">
                                                                                <div class="input-group mb-md">
                                                                                    <select data-plugin-selectTwo class="form-control populate js-example-responsive" name="insuranceId" id="insuranceId" style="width: 100%;"  >
                                                                                    <option value="-1" >---- Choose Insurance ----</option>
                                                                                        <?php
                                                                                            foreach($insurances as $row)
                                                                                            {
                                                                                              echo '<option value="'.$row->insurance_id.'"';
                                                                                                if (isset($insuranceId) and $insuranceId==$row->insurance_id) {
                                                                                                    echo " selected ";
                                                                                                }
                                                                                              echo '>'.$row->insurance_name.'</option>';

                                                                                            }
                                                                                        ?>
                                                                                        </select>

                                                                                 </div>
                                                                            </div>
                                                                        </div>
                                                                          <div class="form-group">
                                                                            <label class="col-sm-3 control-label">Bank Name</label>
                                                                            <div class="col-sm-9">
                                                                                <div class="input-group mb-md">
                                                                                    <select data-plugin-selectTwo class="form-control populate js-example-responsive" name="bankId" id="bankId" style="width: 100%;" >
                                                                                    <option value="-1" >---- Choose Bank ----</option>
                                                                                        <?php
                                                                                            foreach($banks as $row)
                                                                                            {
                                                                                              echo '<option value="'.$row->bank_id.'"';
                                                                                                if (isset($bankId) and $bankId==$row->bank_id) {
                                                                                                    echo " selected ";
                                                                                                }
                                                                                              echo '>'.$row->bank_name.'</option>';

                                                                                            }
                                                                                        ?>
                                                                                        </select>

                                                                                 </div>
                                                                            </div>
                                                                        </div>
                                                                         <div class="form-group">
                                                                            <label class="col-sm-3 control-label">Fee Broker (%)</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text" name="percentageBrokerage" id="percentageBrokerage" class="form-control" readonly="readonly" value="15"
                                                                                />
                                                                            </div>
                                                                        </div>
                                                                         <div class="form-group">
                                                                            <label class="col-sm-3 control-label">Fee Base (%)</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text" name="percentageFeebase" id="percentageFeebase" class="form-control" readonly="readonly" value="30"
                                                                                />
                                                                            </div>
                                                                        </div>



                                                                </div>
                                                                <div id="customer" class="tab-pane">
                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label">Reference</label>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" name="referenceNumber" id="referenceNumber" class="form-control" placeholder="Type reference number..." required/>
                                                                        </div>
                                                                     </div>
                                                                    <div class="form-group">
                                                                            <label class="col-sm-3 control-label">Customer Name</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text" name="customerName" id="customerName" class="form-control" placeholder="Type Customer Name..." />
                                                                            </div>
                                                                     </div>
                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label">Date Of Birth</label>
                                                                        <div class="col-md-6">
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon">
                                                                                    <i class="fa fa-calendar"></i>
                                                                                </span>
                                                                                <input type="text" data-plugin-datepicker class="form-control" name="dateOfBirth" id="dateOfBirth">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                            <label class="col-sm-3 control-label">Coverage</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text" name="coverage" id="coverage" class="form-control" placeholder="Type coverage..." />
                                                                            </div>
                                                                     </div>

                                                                     <div class="form-group">
                                                                        <label class="col-md-3 control-label">Date range</label>
                                                                        <div class="col-md-9">
                                                                            <div class="input-daterange input-group" data-plugin-datepicker>
                                                                                <span class="input-group-addon">
                                                                                    <i class="fa fa-calendar"></i>
                                                                                </span>
                                                                                <input type="text" class="form-control" name="creditBeginDate" id="creditBeginDate">
                                                                                <span class="input-group-addon">to</span>
                                                                                <input type="text" class="form-control" name="creditEndDate" id="creditEndDate">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                      <label class="col-sm-3 control-label">Time Range</label>
                                                                      <div class="col-sm-9">
                                                                          <div class="input-group mb-md">
                                                                              <select data-plugin-selectTwo class="form-control populate js-example-responsive" name="rangeTimeId" id="rangeTimeId" style="width: 100%;" >
                                                                              <option value="-1" >---- Time Range ----</option>
                                                                                  <?php
                                                                                      foreach($rangeTimes as $row)
                                                                                      {
                                                                                        echo '<option value="'.$row->range_time_id.'"';
                                                                                          if (isset($rangeTimeId) and $rangeTimeId==$row->range_time_id) {
                                                                                              echo " selected ";
                                                                                          }
                                                                                        echo '>'.$row->range_time.'</option>';

                                                                                      }
                                                                                  ?>
                                                                                  </select>

                                                                           </div>
                                                                      </div>
                                                                  </div>


                                                        </div>
                                                        <div id="another" class="tab-pane">

                                                            <div class="form-group">
                                                                <label class=" col-md-3 control-label">Rate</label>
                                                                <div class="col-lg-9">
                                                                     <div class="rate"></div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class=" col-md-3 control-label">Premium</label>
                                                                <div class="col-lg-9">
                                                                    <div class="premium"></div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class=" col-md-3 control-label">Brokerage</label>
                                                                <div class="col-lg-9">
                                                                    <div class="brokerage"></div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class=" col-md-3 control-label">Premium Net</label>
                                                                <div class="col-lg-9">
                                                                    <div class="premiumNet"></div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class=" col-md-3 control-label">FeeBase</label>
                                                                <div class="col-lg-9">
                                                                    <div class="feeBase"></div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class=" col-md-3 control-label">Actual Broker</label>
                                                                <div class="col-lg-9">
                                                                    <div class="actual"></div>
                                                                </div>
                                                            </div>
                                                         </div>
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


											</div>
	<!--									</form> -->

										</section>
									</div>

								</div>
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none" id="datatable-default">
									<thead>
										<tr>
											<th>Transaction ID</th>
											<th>Customer name</th>
											<th>Reference</th>
											<th>Polis</th>
											<th>Bank Name</th>
											<th>Credit Begin</th>
											<th>Credit End</th>
											<th>Time</th>
											<th>Coverage</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
                                    <?php
										$actual=0;
										foreach ($listTransaction as $row) {
											$actual=$row->brokerage-$row->fee_base;
											$myDataSplit=$row->transaction_id."|".$row->product_id."|".$row->insurance_id."|".$row->bank_id."|".$row->reference_number."|".$row->customer_name."|".$row->date_of_birth."|".$row->credit_begin_date_2."|".$row->credit_end_date_2."|".$row->range_time_id."|".$row->coverage."|".$row->rate."|".$row->premium."|".$row->percentage_brokerage."|".$row->percentage_feebase."|".$row->brokerage."|".$row->premium_net."|".$row->fee_base."|".$row->polis_number."|".$actual;
                                    ?>
										<tr >
											<td><?php echo $row->transaction_id;?></td>
											<td><?php echo $row->customer_name;?></td>
											<td><?php echo $row->reference_number;?></td>
											<td><?php echo $row->polis_number;?></td>
											<td><?php echo $row->bank_name;?></td>
											<td><?php echo $row->credit_begin_date_2;?></td>
											<td><?php echo $row->credit_end_date_2;?></td>
											<td><?php echo $row->range_time;?></td>
											<td><?php echo $row->coverage;?></td>
											<!-- <td class="actions">
                                                <a href="<?php echo site_url("transaction/getOne/".$row->transaction_id."-".$row->year);?>" title="step to detail"><?php echo $row->periode;?><i class="glyphicon glyphicon-step-forward"></i></a>
											</td>-->
                      <td class="actions">
                      <a class="modal-with-form" href="#modalForm" data-target="#modalForm" data-id="<?php echo $myDataSplit;?>" data-from="edit"><i class="fa fa-pencil"></i></a>

											<a href="http://fauzan.net" onclick="javascript:confirmationAlert('<?php echo site_url("transaction/delete/".$row->transaction_id."")?>','Are you sure you want to delete this row?');return false;" title="delete for this row"><i class="fa fa-trash-o"></i></a>
                                                <a href="<?php echo site_url("transaction")?>" title="Go to Claim belum jadi"><i class="fa fa-medkit"></i></i></a>
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
                    var transactionId = $('input[name=transactionId]').val();
                    var productId = $('select[name=productId]').val();
                    var insuranceId = $('select[name=insuranceId]').val();
                    var bankId = $('select[name=bankId]').val();
                    var rangeTimeId = $('select[name=rangeTimeId]').val();
                    var polisNumber = $('input[name=polisNumber]').val();
                    var referenceNumber = $('input[name=referenceNumber]').val();
                    var customerName = $('input[name=customerName]').val();
                    var dateOfBirth = $('input[name=dateOfBirth]').val();
                    var creditBeginDate = $('input[name=creditBeginDate]').val();
                    var creditEndDate = $('input[name=creditEndDate]').val();
                    var coverage = $('input[name=coverage]').val();
                    var percentageBrokerage = $('input[name=percentageBrokerage]').val();
                    var percentageFeebase = $('input[name=percentageFeebase]').val();
                    if (productId == "" || productId=="-1" || productId=="undefined") {
                        $('.alert-error').removeClass('hide').html('Nama product harus dipilih');
						return false;
                    } else if (insuranceId == "" || insuranceId=="-1" || insuranceId=="undefined") {
                        $('.alert-error').removeClass('hide').html('Nama asuransi harus dipilih');
						return false;
                    } else if (bankId == "" || bankId=="-1" || bankId=="undefined") {
                        $('.alert-error').removeClass('hide').html('Nama bank harus dipilih');
						return false;
                    } else if (percentageBrokerage == "" || percentageBrokerage=="undefined") {
                        $('.alert-error').removeClass('hide').html('persentase broker harus diisi');
						return false;
                    } else if (percentageFeebase == "" || percentageFeebase=="undefined") {
                        $('.alert-error').removeClass('hide').html('persentase feebase harus diisi');
						return false;
                    } else if (customerName == "" || customerName=="undefined") {
                        $('.alert-error').removeClass('hide').html('Nama customer harus diisi');
						return false;
                    } else if (dateOfBirth == "" || dateOfBirth=="undefined") {
                        $('.alert-error').removeClass('hide').html('Tanggal lahir harus diisi');
						return false;
                    } else if (coverage == "" || coverage=="undefined") {
                        $('.alert-error').removeClass('hide').html('Coverage harus diisi');
						return false;
                    } else if (creditBeginDate == "" || creditBeginDate=="undefined") {
                        $('.alert-error').removeClass('hide').html('Range date harus diisi');
						return false;
                    } else if (creditEndDate == "" || creditEndDate=="undefined") {
                        $('.alert-error').removeClass('hide').html('Range date harus diisi');
						return false;

                    } else if (rangeTimeId == "" || rangeTimeId=="-1" || rangeTimeId=="undefined") {
                        $('.alert-error').removeClass('hide').html('Range time harus dipilih');
						return false;
                    } else {
						if (transactionId == "" || transactionId=="undefined") {
							doCreate(productId, insuranceId, bankId, rangeTimeId, polisNumber, referenceNumber, customerName, dateOfBirth, creditBeginDate, creditEndDate, coverage, percentageBrokerage, percentageFeebase);
						}else{
							doUpdate(transactionId,productId, insuranceId, bankId, rangeTimeId, polisNumber, referenceNumber, customerName, dateOfBirth, creditBeginDate, creditEndDate, coverage, percentageBrokerage, percentageFeebase);
						}
                    }
                });

                function doCreate(productId, insuranceId, bankId, rangeTimeId, polisNumber, referenceNumber, customerName, dateOfBirth, creditBeginDate, creditEndDate, coverage, percentageBrokerage, percentageFeebase) {
					$.ajax({
                        type: "POST",
						url: "<?php echo site_url("transaction/create");?>",
						data: {
                            'productId': productId,
                            'insuranceId': insuranceId,
                            'bankId': bankId,
                            'rangeTimeId': rangeTimeId,
                            'polisNumber': polisNumber,
                            'referenceNumber': referenceNumber,
                            'customerName': customerName,
                            'dateOfBirth': dateOfBirth,
                            'creditBeginDate': creditBeginDate,
                            'creditEndDate': creditEndDate,
                            'coverage': coverage,
                            'percentageBrokerage': percentageBrokerage,
                            'percentageFeebase': percentageFeebase
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data['success'] == "1") {
								alert(data['msg']);
                                document.location.href = "<?php echo site_url("transaction"); ?>";
                            } else {
                               alert(data['msg']);
                            }
                        }
                    });
                }

                function doUpdate(transactionId,productId, insuranceId, bankId, rangeTimeId, polisNumber, referenceNumber, customerName, dateOfBirth, creditBeginDate, creditEndDate, coverage, percentageBrokerage, percentageFeebase) {
					$.ajax({
                        type: "POST",
						url: "<?php echo site_url("transaction/update");?>",
						data: {
                            'transactionId': transactionId,
                            'productId': productId,
                            'insuranceId': insuranceId,
                            'bankId': bankId,
                            'rangeTimeId': rangeTimeId,
                            'polisNumber': polisNumber,
                            'referenceNumber': referenceNumber,
                            'customerName': customerName,
                            'dateOfBirth': dateOfBirth,
                            'creditBeginDate': creditBeginDate,
                            'creditEndDate': creditEndDate,
                            'coverage': coverage,
                            'percentageBrokerage': percentageBrokerage,
                            'percentageFeebase': percentageFeebase
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data['success'] == "1") {
								alert(data['msg']);
                                document.location.href = "<?php echo site_url("transaction"); ?>";
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
				  $(".tab-content #transactionId").val("");
				  $("#productId").select2('val',-1);
				  $("#insuranceId").select2('val',-1);
				  $("#bankId").select2('val',-1);
  				$(".tab-content #referenceNumber").val("");
				  $(".tab-content #customerName").val("");
				  $(".tab-content #dateOfBirth").val("");
				  $(".tab-content #creditBeginDate").val("");
				  $(".tab-content #creditEndDate").val("");
				  $("#rangeTimeId").select2('val',-1);
				  $(".tab-content #coverage").val("");


				   $('div.rate').html("");
				   $('div.premium').html("");
				   $('div.brokerage').html("");
				   $('div.premiumNet').html("");
				   $('div.feeBase').html("");
				   $(".tab-content #polisNumber").val("");
				   $('div.actual').html("");

			}else{
				  var arrData=new Array();
				  arrData=$(this).data('id').split("|");

				  $(".tab-content #transactionId").val(arrData[0]);
				  $("#productId").select2('val',arrData[1]);
				  $("#insuranceId").select2('val',arrData[2]);
				  $("#bankId").select2('val',arrData[3]);
				  $(".tab-content #referenceNumber").val(arrData[4]);
				  $(".tab-content #customerName").val(arrData[5]);
				  $(".tab-content #dateOfBirth").val(arrData[6]);
				  $(".tab-content #creditBeginDate").val(arrData[7]);
				  $(".tab-content #creditEndDate").val(arrData[8]);
				  $("#rangeTimeId").select2('val',arrData[9]);
				  $(".tab-content #coverage").val(arrData[10]);
 				  $(".tab-content #percentageBrokerage").val(arrData[13]);
				  $(".tab-content #percentageFeebase").val(arrData[14]);

				   $('div.rate').html(arrData[11]);
				   $('div.premium').html(accounting.formatMoney(arrData[12], "", 2, ".", ","));
				   $('div.brokerage').html(accounting.formatMoney(arrData[15], "", 2, ".", ","));
				   $('div.premiumNet').html(accounting.formatMoney(arrData[16], "", 2, ".", ","));
				   $('div.feeBase').html(accounting.formatMoney(arrData[17], "", 2, ".", ","));
				   $(".tab-content #polisNumber").val(arrData[18]);
				   $('div.actual').html(accounting.formatMoney(arrData[19], "", 2, ".", ","));

			}



		});
 </script>
