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

										<h2 class="panel-title">Data Department</h2>
									</header>
									<div class="panel-body">
                                        <form id="demo-form" class="form-horizontal form-bordered" novalidate="novalidate" action="<?php if (isset($linkSearch)) {
    echo $linkSearch;
} ?>" method="post" >
											<div class="form-group">
												<label class="col-md-3 control-label">Search Department</label>
												<div class="col-md-6">
                                                <div class="input-group mb-md">
													<select data-plugin-selectTwo class="form-control populate" name="departmentIdforSearch" onchange="this.form.submit()">
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
														?>													</select>
                                                            <span class="input-group-btn">
															<button class="btn btn-success" type="submit">Go!</button>
														</span>
                                                 </div>
												</div>
											</div>

										</form>
												<hr />
											<div class="panel-body">

												<form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate" action="<?php if (isset($linkFormDepartment)) {
    echo $linkFormDepartment;
} ?>" method="post" >
<input type="hidden" name="departmentId" value="<?php if (isset($getDepartmentId)) {  echo $getDepartmentId; }?>" />
<input type="hidden" name="mystatus" value="1" />
													<div class="form-group">
														<label class="col-sm-3 control-label">Department Name</label>
														<div class="col-sm-9">
															<input type="text" name="departmentName" class="form-control" placeholder="Type department  name..." value="<?php if (isset($getDepartmentName)) {  echo $getDepartmentName; }?>" <?php if (isset($getDepartmentId)) {  echo 'disabled=\""\""'; }?> required/>
														</div>
													</div>


													<div class="form-group">
														<label class="col-sm-3 control-label">Description</label>
														<div class="col-sm-9">
															<input type="text" name="description" class="form-control" placeholder="Type description..."  value="<?php if (isset($getDescription)) {  echo $getDescription; }?>"  <?php if (isset($getDepartmentId)) {  echo 'disabled=\""\""'; }?> />
														</div>
													</div>
											</div>
											<footer class="panel-footer">
												<div class="row">
													<div class="col-md-12 text-right">
                                                    <?php if (!isset($getDepartmentId)) {
													?>
														<button class="btn btn-primary" type="submit">Add New Department</button>
														<button type="reset" class="mb-xs mt-xs mr-xs btn btn-primary">Cancel</button>
                                                     <?php } ?>
													</div>
												</div>
											</footer>
										</form>


                                    </div>

								</section>

						<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
									<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
								</div>

								<h2 class="panel-title"><?php echo $titleTable;?></h2>
							</header>
							<div class="panel-body">
							  <?php if (isset($getDepartmentId)) {
                              ?>
									<a class="modal-with-form btn btn-default" href="#modalForm" data-target="#modalForm" id="1">Add Data</a>
								<?php } ?>
									<div id="modalForm" class="modal-block modal-block-primary mfp-hide">
										<section class="panel">
												<form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate" action="<?php if (isset($linkForm)) {
    echo $linkForm;
} ?>" method="post" >
<input type="hidden" name="departmentId" value="<?php if (isset($getDepartmentId)) {  echo $getDepartmentId; }?>" />

											<header class="panel-heading">
												<h2 class="panel-title">Add department detail</h2>
											</header>
											<div class="panel-body">

													<div class="form-group">
														<label class="col-sm-3 control-label">Department Name</label>
														<div class="col-sm-9">
															<input type="text" name="departmentName" class="form-control" placeholder="Type customer  name..." value="<?php if (isset($getDepartmentName)) {  echo $getDepartmentName; }?>" <?php if (isset($getDepartmentId)) {  echo 'disabled=\""\""'; }?> required/>
														</div>
													</div>

													<div class="form-group">
														<label class="col-sm-3 control-label">Department Detail Name</label>
														<div class="col-sm-9">
															<input type="text" name="departmentDetailName" class="form-control" placeholder="Type Department Detail..." required/>
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
                            <?php if (isset($getDepartmentId)) { ?>
								<table class="table table-bordered table-striped" id="datatable-ajax" data-url="<?php echo site_url("departmentDetail/get_data")."/".$getDepartmentId; ?>"   cellspacing="0" style="100%" >
                              <?php } else { ?>
								<table class="table table-bordered table-striped" id="datatable-ajax" data-url="<?php echo site_url("departmentDetail/get_data")."/naura"; ?>"   cellspacing="0" style="100%" >
                              <?php } ?>
									<thead>
										<tr>
											<th width="2%">ID</th>
											<th width="15%">Department Detail Name</th>
											<th width="15%">Department Name</th>
											<th width="20%">Description</th>
											<th width="5%">Status</th>
											<th width="12%">Action</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</section>

					<!-- end: page -->
