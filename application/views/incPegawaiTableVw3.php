<script src=\"".base_url()."assets/porto/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js\"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>


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
                <a class="modal-with-form btn btn-default" href="#modalForm" data-target="#modalForm" id="1">Add Data</a>

                <!-- Modal Form -->
                <div id="modalForm" class="modal-block modal-block-primary mfp-hide">
                  <section class="panel">
                      <form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate" action="<?php if (isset($linkForm)) {
  echo $linkForm;
} ?>" method="post" >
                    <header class="panel-heading">
                      <h2 class="panel-title">Add biodata Pegawai</h2>
                    </header>

                    <div class="panel-body">

                    <!-- <div class="container"> -->
                    <div class="row">
                    <div class="span1">
                    <ul class="nav nav-tabs" id="myTabs">
                    <li class="active"><a id="tab-1" href="#one" data-toggle="tab">Personal Info</a></li>
                    <li><a href="#two" id="tab-2" data-toggle="tab">Employee Info</a></li>
                    <li><a href="#three" id="tab-3" data-toggle="tab">Upload Foto</a></li>
                    </ul>

                    <div class="tab-content">
                    <div class="tab-pane active" id="one">

                      <div class="form-group">
                        <label class="col-sm-3 control-label">Employee ID</label>
                        <div class="col-sm-9">
                          <input type="text" name="employeeId" class="form-control" placeholder="Type Employee ID..." required/>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-3 control-label">First Name</label>
                        <div class="col-sm-9">
                          <input type="text" name="employeeFirstName" class="form-control" placeholder="Type first name..." required/>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-3 control-label">Last Name</label>
                        <div class="col-sm-9">
                          <input type="text" name="employeeLastName" class="form-control" placeholder="Type last name..." />
                        </div>
                      </div>

                      <div class="form-group">
                      <label class="col-sm-3 control-label">Department</label>
                      <div class="col-sm-9">
                      <select data-plugin-selectTwo class="form-control populate js-example-responsive" name="departmentId" style="width: 100%;"  >
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
                      <select data-plugin-selectTwo class="form-control populate js-example-responsive" name="designationId"   style="width: 100%;" >
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

                   <div class="form-group">
                     <label for="ket1" class="control-label col-sm-3">Alamat</label>
                     <div class="col-sm-7">
                     <textarea class="form-control" rows="6" name="alamat" id="alamat"></textarea>
                     </div>
                   </div>

                   <div class="form-group">
                   <label class="col-sm-3 control-label">Religion</label>
                   <div class="col-sm-9">
                   <select data-plugin-selectTwo class="form-control populate js-example-responsive" name="agama" style="width: 100%;"  >
                   <option value="-1" >---- Religion ----</option>
                   <?php
                   foreach($agamas as $row)
                   {
                   echo '<option value="'.$row->religi_id.'"';
                   if (isset($getReligiId) and $getReligiId==$row->religi_id) {
                   echo " selected ";
                   }
                   echo '>'.$row->religi_name.'</option>';
                   }
                   ?>
                   </select>
                   </div>
                   </div>

                   <div class="form-group">
                   <label class="col-sm-3 control-label">Married</label>
                   <div class="col-sm-9">
                   <select data-plugin-selectTwo class="form-control populate js-example-responsive" name="married" style="width: 100%;"  >
                   <option value="-1" >----Status Married ----</option>
                   <?php
                   foreach($marrieds as $row)
                   {
                   echo '<option value="'.$row->married_id.'"';
                   if (isset($getMarriedId) and $getMarriedId==$row->married_id) {
                   echo " selected ";
                   }
                   echo '>'.$row->married_name.'</option>';
                   }
                   ?>
                  </select>
                  </div>
                  </div>

                  </div>

                    <!-- Tab Kedua -->
                    <div class="tab-pane" id="two">

                    <div class="form-group">
                    <label class="col-sm-3 control-label">Title</label>
                    <div class="col-sm-9">
                    <select data-plugin-selectTwo class="form-control populate js-example-responsive" name="titleId"   style="width: 100%;" >
                    <option value="-1" >---- All Title ----</option>
                    <?php
                    foreach($titles as $row)
                    {
                    echo '<option value="'.$row->title_id.'"';
                    if (isset($getTitleId) and $getTitleId==$row->title_id) {
                    echo " selected ";
                    }
                    echo '>'.$row->title_name.'</option>';
                    }
                    ?>
                    </select>
                    </div>
                    </div>

                     <div class="form-group">
                     <label class="col-sm-3 control-label">Employee Status</label>
                     <div class="col-sm-9">
                     <select data-plugin-selectTwo class="form-control populate js-example-responsive" name="employeeStatusId"   style="width: 100%;" >
                     <option value="-1" >---- All Employee status ----</option>
                     <?php
                     foreach($employeeStatuss as $row)
                     {
                     echo '<option value="'.$row->employee_status_id.'"';
                     if (isset($getEmployeeStatusId) and $getEmployeeStatusId==$row->employee_status_id) {
                     echo " selected ";
                     }
                     echo '>'.$row->employee_status_name.'</option>';
                     }
                     ?>
                     </select>
                     </div>
                     </div>

                     <div class="form-group">
                       <label for="jointDate" class="control-label col-sm-3">Joint Date</label>
                       <div class="col-sm-4">
                       <div class="input-append date form_datetime">
                       <input type="text" name="jointDate" id="jointDate" class="form-control" value="">
                       <span class="add-on"><i class="icon-th"></i></span>
                       <script type="text/javascript">
                          $(".form_datetime").datepicker({
                          format: "yyyy-mm-dd",
                          autoclose: true,
                          todayBtn: true,
                          pickerPosition: "top-right"
                         });
                     </script>
                     </div>
                     </div>
                     </div>

                     <div class="form-group">
                      <label for="endOfContract" class="control-label col-sm-3">End Of Contract</label>
                      <div class="col-sm-4">
                      <div class="input-append date form_datetime">
                      <input type="text" name="endOfContract" id="endOfContract" class="form-control" value="">
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

                    <div class="form-group">
                     <label for="permanentDate" class="control-label col-sm-3">Permanent Date</label>
                     <div class="col-sm-4">
                     <div class="input-append date form_datetime">
                     <input type="text" name="permanentDate" id="permanentDate" class="form-control" value="">
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

                    <!-- Tab Ketiga -->
                    <div class="tab-pane" id="three">

                    <input type="file" name="userfile" size="20" />

                    </div>
                    <!--Akhit tab ketiga  -->

                    </div>
                    </div>
                    </div>
                    <!-- </div> -->

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
                    <th>ID Employee</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Designation</th>
                    <th>Title</th>
                    <th>Employee Status</th>
                    <th>Joint Date</th>
                    <th>End Of Contract</th>
                    <th>Permanent Date</th>
                    <th>Tempat Tanggal Lahir</th>
                    <th>address</th>
                    <th>Religion</th>
                    <th>Marriage</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>Pendidikan</th>
                    <th>Family</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($groups as $row) {
                    $myDataSplit=$row->employee_id."|".$row->employee_first_name."|".$row->employee_last_name."|".$row->department_id."|".$row->designation_id."|".$row->title_id."|".$row->employee_status_id."|".$row->tempat_lahir."|".$row->tanggal_lahir."|".$row->alamat."|".$row->religi_id."|".$row->married_id."|".$row->status;
                                  ?>
                  <tr class="gradeX">
                    <td><?php echo $row->employee_id;?></td>
                    <td><?php echo $row->employee_first_name." ".$row->employee_last_name;?></td>
                    <td><?php echo $row->department_name;?></td>
                    <td><?php echo $row->designation_name;?></td>
                    <td><?php echo $row->title_name;?></td>
                    <td><?php echo $row->employee_status_name;?></td>
                    <td><?php echo $row->joint_date;?></td>
                    <td><?php echo $row->end_of_contract;?></td>
                    <td><?php echo $row->permanent_date;?></td>
                    <td><?php echo $row->tempat_lahir." ".$row->tanggal_lahir;?></td>
                    <td><?php echo $row->alamat;?></td>
                    <td><?php echo $row->religi_name;?></td>
                    <td><?php echo $row->married_name;?></td>
                    <td><?php echo $row->my_status;?></td>
                    <td class="actions">
                      <a href="http://fauzan.net" onclick="javascript:showFormEditEmployeeAffair('<?php echo site_url("pegawai/change/".$row->employee_id);?>','<?php echo $myDataSplit;?>','<?php echo $myDataSplitDepartment;?>','<?php echo $myDataSplitDesignation;?>','<?php echo $myDataSplitTitle;?>','<?php echo $myDataSplitEmployeeStatus;?>','<?php echo $myDataSplitReligi;?>','<?php echo $myDataSplitMarried;?>');return false;" title="Edit for this row"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                      <a href="http://fauzan.net" onclick="javascript:confirmationAlert('<?php echo site_url("pegawai/delete/".$row->employee_id);?>','Are you sure you want to delete this row?');return false;" title="delete for this row"><i class="fa fa-trash-o"></i></a>
                    </td>
                    <td class="Pendidikans">
                      <a href="<?php echo site_url("pegawai/gettwo/".$row->employee_id."");?>" title="step to detail">Pendidikan<i class="glyphicon glyphicon-step-forward"></i></a>
                    </td>
                    </td>
                    <td class="familys">
                      <a href="<?php echo site_url("pegawai/getOne/".$row->employee_id."");?>" title="step to detail">Family<i class="glyphicon glyphicon-step-forward"></i></a>
                    </td>
                  </tr>
                                      <?php } ?>
                </tbody>
              </table>
            </div>
          </section>

        <!-- end: page -->
