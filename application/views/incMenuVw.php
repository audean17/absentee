				<!-- start: sidebar -->
				<aside id="sidebar-left" class="sidebar-left">

					<div class="sidebar-header">
						<div class="sidebar-title">
							Navigation
						</div>
						<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
							<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
						</div>
					</div>

					<div class="nano">
						<div class="nano-content">
							<nav id="menu" class="nav-main" role="navigation">
								<ul class="nav nav-main">
									<li>
										<a href="<?php echo site_url('headline'); ?>">
											<i class="fa fa-home" aria-hidden="true"></i>
											<span>Dashboard</span>
										</a>
									</li>



										<li <?php echo $mnHrmLiParentClass;?>>

										<a>
											<i class="fa fa-copy" aria-hidden="true"></i>
											<span>HRM</span>
										</a>
												<ul class="nav nav-children">
													<li <?php echo $mnHrmLiAbsenteeClass;?>>
                                                          <a href="<?php echo site_url('absentee'); ?>">
                                                               Absentee Employee
                                                          </a>													</li>
 													<li <?php echo $mnDataMasterLiEmployeeClass;?>>
                                                          <a href="<?php //echo site_url('vermin'); ?>">
                                                                Closing Periode Absentee
                                                          </a>													</li>
 													<li <?php echo $mnHrmliPengajuanClass;?>>
                                                          <a href="<?php echo site_url('pengajuan'); ?>">
                                                               Pengajuan Lembur
                                                          </a>													</li>

													<li <?php echo $mnHrmliManagerApproveClass;?>>
                                                          <a href="<?php //echo site_url('vertek'); ?>">
                                                               Manager Approval Lembur
                                                          </a>													</li>

												</ul>
											</li>

									<li <?php echo $mnDataMasterLiParentClass;?>>
										<a>
											<i class="fa fa-columns" aria-hidden="true"></i>
											<span>Data Master</span>
										</a>
										<ul class="nav nav-children">


											<li <?php echo $mnDataMasterLiEmployeeClass;?>>
												<a href="<?php echo site_url('employee'); ?>">
													 Employee
												</a>
											</li>
											<li <?php echo $mnDataMasterLiDepartmentClass;?>>
												<a href="<?php echo site_url('department'); ?>">
													 Department
												</a>
											</li>
											<li <?php echo $mnDataMasterLiDesignationClass;?>>
												<a href="<?php echo site_url('designation'); ?>">
													 Designation
												</a>
												</li>
											<li <?php echo $mnDataMasterLiPegawaiClass;?>>
													<a href="<?php echo site_url('pegawai'); ?>">
														 Employee Affair
													</a>
											</li>

                    </ul>
									</li>


									<li <?php echo $mnDataGALiParentClass;?>>
										<a>
											<i class="fa fa-steam" aria-hidden="true"></i>
											<span>Data GA</span>
										</a>
										<ul class="nav nav-children">


											<li <?php echo $mnDataGALiInventoryClass;?>>
												<a href="<?php echo site_url('inventory'); ?>">
													 Inventory
												</a>

										</ul>
									</li>

									<li <?php echo $mnDataBJBLiParentClass;?>>
										<a>
											<i class="fa fa-university" aria-hidden="true"></i>
											<span>BJB</span>
										</a>
										<ul class="nav nav-children">


											<li <?php echo $mnDataBJBLiBankClass;?>>
												<a href="<?php echo site_url('bank'); ?>">
													 Bank
												</a>
											</li>
											<li <?php echo $mnDataBJBLiInsuranceClass;?>>
												<a href="<?php echo site_url('department'); ?>">
													 Insurance
												</a>
											</li>
											<li <?php echo $mnDataBJBLiProductClass;?>>
												<a href="<?php echo site_url('designation'); ?>">
													 Product
												</a>
												</li>
											<li <?php echo $mnDataBJBLiTransactionClass;?>>
													<a href="<?php echo site_url('transaction'); ?>">
														 Transaction
													</a>
											</li>

                    </ul>
									</li>



											<li <?php echo $mnAdministratorLiParentClass;?>>
										<a>
											<i class="fa fa-tasks" aria-hidden="true"></i>
											<span>Administrator</span>
										</a>
												<ul class="nav nav-children">
													<li <?php echo $mnAdministratorLiUsersClass;?>>
                                                          <a href="<?php echo site_url('user'); ?>">
                                                               Users
                                                          </a>													</li>
													<li  <?php echo $mnAdministratorLiGroupsClass;?>>
                                                            <a href="<?php echo site_url('usergroup'); ?>">
                                                                 User Groups
                                                            </a>
													</li>
												</ul>
											</li>



                                           <li class="nav-parent">
                                              <a>
                                                  <i class="fa fa-list-alt" aria-hidden="true"></i>
                                                  <span>Report</span>
                                              </a>
                                                  <ul class="nav nav-children">
                                                     <li >
                                                          <a href="#">
                                                               Laporan 1
                                                          </a>
                                                     </li>
                                                     <li>
                                                        <a href="#">
                                                               Laporan 2
                                                          </a>
                                                     </li>
                                                     <li >
                                                        <a href="#">
                                                               Laporan 3
                                                          </a>
                                                     </li>
                                                  </ul>
                                             </li>




											<li <?php echo $mnToolsLiParentClass;?>>
                                              <a>
                                                  <i class="fa fa-table" aria-hidden="true"></i>
                                                  <span>Tools</span>
                                              </a>
                                                  <ul class="nav nav-children">
													<li  <?php echo $mnToolsLiUploadAbsentClass;?>>
                                                            <a href="<?php echo site_url('upload'); ?>">
                                                                 Upload File Absent
                                                            </a>
													</li>
                                                     <li>
                                                        <a href="#">
                                                            Cara Penggunaan Sistem
                                                        </a>
                                                     </li>
                                                  </ul>
                                             </li>

							<hr class="separator" />
						</div>

					</div>

				</aside>
				<!-- end: sidebar -->
