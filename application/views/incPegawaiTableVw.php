<style type="text/css">
.dataTables_wrapper {
    max-width: 120%;
    display: block;

  }

</style>

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

                <a class="modal-with-form btn btn-default" href="#modalForm" data-target="#modalForm" data-from="add">Add Data</a>

                <!-- Modal Form -->
                <div id="modalForm" class="modal-block modal-block-primary mfp-hide">
                  <section class="panel">
                    <header class="panel-heading">
                      <h2 class="panel-title">Add biodata Pegawai</h2>
                      <div class="faualert alert-error hide" style="font-weight:bold; color:#F00;float:left;position:relative;top: -20px; right: -240px;"> </div>
                    </header>

                    <div class="col-md-12">
                            <div class="tabs tabs-danger">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#personal" data-toggle="tab">Personal Info</a>
                                    </li>
                                    <li>
                                        <a href="#employee" data-toggle="tab">Employee Info</a>
                                    </li>
                                    <li>
                                        <a href="#upload" data-toggle="tab">Upload Foto</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                        <div id="personal" class="tab-pane active">

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
                                          <select data-plugin-selectTwo class="form-control populate js-example-responsive" name="departmentId"  id="departmentId" style="width: 100%;"  >
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
                                          <select data-plugin-selectTwo class="form-control populate js-example-responsive" name="designationId" id="designationId"   style="width: 100%;" >
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
                                          <input type="text" name="tempatLahir" id="tempatLahir" class="form-control" placeholder="Type Tempat Lahir..." />
                                          </div>
                                        </div>

                                        <div class="form-group">
                                          <label class="col-md-3 control-label">Tanggal Lahir</label>
                                          <div class="col-md-6">
                                          <div class="input-group">
                                          <span class="input-group-addon">
                                          <i class="fa fa-calendar"></i>
                                          </span>
                                          <input type="text" data-plugin-datepicker class="form-control" name="tanggalLahir" id="tanggalLahir">
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
                                       <select data-plugin-selectTwo class="form-control populate js-example-responsive" name="agama" id="agama" style="width: 100%;">
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
                                       <select data-plugin-selectTwo class="form-control populate js-example-responsive" name="married" id="married" style="width: 100%;">
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
                                        <div id="employee" class="tab-pane">

                                          <div class="form-group">
                                          <label class="col-sm-3 control-label">Title</label>
                                          <div class="col-sm-9">
                                          <select data-plugin-selectTwo class="form-control populate js-example-responsive" name="titleId" id="titleId"  style="width: 100%;" >
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
                                           <select data-plugin-selectTwo class="form-control populate js-example-responsive" name="employeeStatusId" id="employeeStatusId"  style="width: 100%;" >
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
                                              <label class="col-md-3 control-label">Range of Contract</label>
                                              <div class="col-md-9">
                                                  <div class="input-daterange input-group" data-plugin-datepicker>
                                                      <span class="input-group-addon">
                                                          <i class="fa fa-calendar"></i>
                                                      </span>
                                                      <input type="text" class="form-control" name="jointDate" id="jointDate">
                                                      <span class="input-group-addon">to</span>
                                                      <input type="text" class="form-control" name="endOfContract" id="endOfContract">
                                                  </div>
                                              </div>
                                          </div>

                                          <div class="form-group">
                                              <label class="col-md-3 control-label">Permanent Date</label>
                                              <div class="col-md-6">
                                                  <div class="input-group">
                                                      <span class="input-group-addon">
                                                          <i class="fa fa-calendar"></i>
                                                      </span>
                                                      <input type="text" data-plugin-datepicker class="form-control" name="permanentDate" id="permanentDate">
                                                  </div>
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

                                <div id="
                                " class="tab-pane">
                                <form action='pegawai/simpan' method='post' enctype='multipart/form-data'>
                                  <input type="file" name="userfile" size="20" />
                                  <button type='submit'>Upload</button>
                                </form>

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
                    <th>Alamat</th>
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
                    $myDataSplit=$row->employee_id."|".$row->employee_first_name."|".$row->employee_last_name."|".$row->department_id."|".$row->designation_id."|".$row->title_id."|".$row->employee_status_id."|".$row->joint_date."|".$row->end_of_contract."|".$row->permanent_date."|".$row->tempat_lahir."|".$row->tanggal_lahir."|".$row->alamat."|".$row->religi_id."|".$row->married_id."|".$row->status;
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
                      <a class="modal-with-form" href="#modalForm" data-target="#modalForm" data-id="<?php echo $myDataSplit;?>" data-from="edit"><i class="fa fa-pencil"></i></a>
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
                            var titleId = $('select[name=titleId]').val();
                            var employeeStatusId = $('select[name=employeeStatusId]').val();
                            var jointDate = $('input[name=jointDate]').val();
                            var endOfContract = $('input[name=endOfContract]').val();
                            var permanentDate = $('input[name=permanentDate]').val();
                            var tempatLahir = $('input[name=tempatLahir]').val();
                            var tanggalLahir = $('input[name=tanggalLahir]').val();
                            var alamat = $('textarea#alamat').val();
                            var agama = $('select[name=agama]').val();
                            var married = $('select[name=married]').val();
                            var status = $('select[name=status]').val();

                            if (employeeId == "" || employeeId=="undefined") {
                                $('.alert-error').removeClass('hide').html('Employee ID view harus diisi');
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
                            } else if (titleId == "" || titleId=="-1" || titleId=="undefined") {
                                $('.alert-error').removeClass('hide').html('title harus dipilih');
        						return false;
                            } else if (employeeStatusId == "" || employeeStatusId=="-1" || employeeStatusId=="undefined") {
                                $('.alert-error').removeClass('hide').html('employee status harus dipilih');
        						return false;
                            } else if (jointDate == "" || jointDate=="undefined") {
                                $('.alert-error').removeClass('hide').html('joint Date harus diisi');
        						return false;
                            } else if (endOfContract == "" || endOfContract=="undefined") {
                                $('.alert-error').removeClass('hide').html('end Of Contract harus diisi');
        						return false;
                            } else if (permanentDate == "" || permanentDate=="undefined") {
                                $('.alert-error').removeClass('hide').html('permanent Date harus diisi');
        						return false;
                            } else if (tempatLahir == "" || tempatLahir=="undefined") {
                                $('.alert-error').removeClass('hide').html('tempat Lahir view harus diisi');
        						return false;
                            } else if (tanggalLahir == "" || tanggalLahir=="undefined") {
                                $('.alert-error').removeClass('hide').html('tanggal Lahir harus diisi');
                    return false;
                            } else if (alamat == "" || alamat=="undefined") {
                                $('.alert-error').removeClass('hide').html('alamat view harus diisi');
                    return false;
                            } else if (agama == "" || agama=="-1" || agama=="undefined") {
                                $('.alert-error').removeClass('hide').html('agama harus dipilih');
                    return false;
                            } else if (married== "" || married=="-1" || married=="undefined") {
                                $('.alert-error').removeClass('hide').html('status married harus dipilih');
                    return false;
                            } else if (status== "" || status=="-1" || status=="undefined") {
                                $('.alert-error').removeClass('hide').html('status harus dipilih');
                    return false;
                            } else {

        								if (myAction == "add" ) {
        							doCreate(employeeId, employeeFirstName, employeeLastName, departmentId, designationId, titleId, employeeStatusId, jointDate, endOfContract, permanentDate, tempatLahir, tanggalLahir, alamat, agama, married, status);
        						}else{
        							doUpdate(employeeId, employeeFirstName, employeeLastName, departmentId, designationId, titleId, employeeStatusId, jointDate, endOfContract, permanentDate, tempatLahir, tanggalLahir, alamat, agama, married, status);
                    }
                            }
                        });

                function doCreate(employeeId, employeeFirstName, employeeLastName, departmentId, designationId, titleId, employeeStatusId, jointDate, endOfContract, permanentDate, tempatLahir, tanggalLahir, alamat, agama, married, status) {
                  $.ajax({
                                type: "POST",
        						url: "<?php echo site_url("pegawai/create");?>",
        						data: {
                                    'employeeId': employeeId,
                                    'employeeFirstName': employeeFirstName,
                                    'employeeLastName': employeeLastName,
                                    'departmentId': departmentId,
                                    'designationId': designationId,
                                    'titleId': titleId,
                                    'employeeStatusId': employeeStatusId,
                                    'jointDate': jointDate,
                                    'endOfContract': endOfContract,
                                    'permanentDate': permanentDate,
                                    'tempatLahir': tempatLahir,
                                    'tanggalLahir': tanggalLahir,
                                    'alamat': alamat,
                                    'agama': agama,
                                    'married': married,
                                    'status': status
                              },
                                dataType: "json",
                                success: function(data) {
                                    if (data['success'] == "1") {
        								alert(data['msg']);
                                        document.location.href = "<?php echo site_url("pegawai"); ?>";
                                    } else {
                                       alert(data['msg']);
                                    }
                                }
                            });
                        }

                        function doUpdate(employeeId, employeeFirstName, employeeLastName, departmentId, designationId, titleId, employeeStatusId, jointDate, endOfContract, permanentDate, tempatLahir, tanggalLahir, alamat, agama, married, status) {
                          $.ajax({
                                type: "POST",
        						url: "<?php echo site_url("pegawai/update");?>",
        						data: {
                                    'employeeId': employeeId,
                                    'employeeFirstName': employeeFirstName,
                                    'employeeLastName': employeeLastName,
                                    'departmentId': departmentId,
                                    'designationId': designationId,
                                    'titleId': titleId,
                                    'employeeStatusId': employeeStatusId,
                                    'jointDate': jointDate,
                                    'endOfContract': endOfContract,
                                    'permanentDate': permanentDate,
                                    'tempatLahir': tempatLahir,
                                    'tanggalLahir': tanggalLahir,
                                    'alamat': alamat,
                                    'agama': agama,
                                    'married': married,
                                    'status': status
                                },
                                dataType: "json",
                                success: function(data) {
                                    if (data['success'] == "1") {
        								alert(data['msg']);
                                        document.location.href = "<?php echo site_url("pegawai"); ?>";
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
        				  $(".tab-content #employeeId").val("");
                  $(".tab-content #myAction").val("add");
        				  $(".tab-content #employeeFirstName").val("");
        				  $(".tab-content #employeeLastName").val("");
                  $("#departmentId").select2('val',-1);
                  $("#designationId").select2('val',-1);
                  $("#titleId").select2('val',-1);
                  $("#employeeStatusId").select2('val',-1);
                  $(".tab-content #jointDate").val("");
                  $(".tab-content #endOfContract").val("");
         				  $(".tab-content #permanentDate").val("");
                  $(".tab-content #tempatLahir").val("")
                  $(".tab-content #tanggalLahir").val("");
                  $("textarea#alamat").val("");
          				$("#agama").select2('val',-1);
                  $("#married").select2('val',-1);
                  $("#status").select2('val',-1);

        			}else{
        				  var arrData=new Array();
        				  arrData=$(this).data('id').split("|");

                  $(".tab-content #employeeId").val(arrData[0]);
                  $(".tab-content #employeeId").prop('readonly', true);
                  $(".tab-content #myAction").val("edit");
                  $(".tab-content #employeeFirstName").val(arrData[1]);
                  $(".tab-content #employeeLastName").val(arrData[2]);
                  $("#departmentId").select2('val',arrData[3]);
                  $("#designationId").select2('val',arrData[4]);
                  $("#titleId").select2('val',arrData[5]);
                  $("#employeeStatusId").select2('val',arrData[6]);
                  $(".tab-content #jointDate").val(arrData[7]);
                  $(".tab-content #endOfContract").val(arrData[8]);
                  $(".tab-content #permanentDate").val(arrData[9]);
                  $(".tab-content #tempatLahir").val(arrData[10]);
                  $(".tab-content #tanggalLahir").val(arrData[11]);
                  $("textarea#alamat").val(arrData[12]);
        				  $("#agama").select2('val',arrData[13]);
                  $("#married").select2('val',arrData[14]);
                  $("#status").select2('val',arrData[15]);

        			}

        		});
         </script>
