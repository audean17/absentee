
   function confirmationAlert(href, data_confirm){
        if (!$('#dataConfirmModalfau').length) {
           $('body').append('<div id="dataConfirmModalfau" class="modalfau" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><section class="panel"><header class="panel-heading"><h2 class="panel-title">Confirmation</h2></header><div class="panel-body"><div class="modalfau-wrapper"><div class="modal-icon"><i class="fa fa-warning"></i></div><div class="modal-text"></div></div></div><footer class="panel-footer"><div class="row"><div class="col-md-12 text-right"><a class="btn btn-primary" id="dataConfirmOK">OK</a><button class="btn" data-dismiss="modal" aria-hidden="true" type=\"reset\">Cancel</button></div></div></footer></section></div>');
        }
        $('#dataConfirmModalfau').find('.modal-text').text(data_confirm);
        $('#dataConfirmOK').attr('href', href);
        $('#dataConfirmModalfau').modal({show: true});
        return false;
    }

   function showFormEdit(href, data_with_split,dataFromDatabase) {
		var arrData=new Array();
		arrData=data_with_split.split("|");

        if (!$('#dataConfirmModal').length) {
            $('body').append('<div id="dataConfirmModal" class="modalfau"  role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><section class="panel"><form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate" action="'+ href +'" method="post" ><header class="panel-heading"><h2 class="panel-title">Edit data group</h2></header><div class="panel-body"><div class="form-group mt-lg"><label class="col-sm-3 control-label">Group ID</label><div class="col-sm-9"><input type="text" id="groupId" name="groupId" class="form-control" placeholder="Type group id..." disabled=""/></div></div><div class="form-group"><label class="col-sm-3 control-label">Group Name</label><div class="col-sm-9"><input type="text" id="groupName" name="groupName" class="form-control" placeholder="Type group name..." required/></div></div><div class="form-group"><label class="col-sm-3 control-label">Description</label><div class="col-sm-9"><input type="text" id="description"  name="description"  class="form-control" placeholder="Type description..." /></div></div><div class="form-group"><label class="col-sm-3 control-label">Status</label><div class="col-sm-9"><select  id="mystatus" data-plugin-selectTwo class="form-control populate js-example-responsive" style="width: 100%;" name="mystatus"><option value="1">Yes</option><option value="0">No</option></select></div></div></div><footer class="panel-footer"><div class="row"><div class="col-md-12 text-right"><button class="btn btn-primary" type="submit" id="dataConfirmOK">Submit</button><button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button></div></div></footer></form></section></div></div>');
        }
        $('#groupId').attr('value', arrData[0]);
        $('#groupName').attr('value', arrData[1]);
        $('#description').attr('value', arrData[2]);

		$('#mystatus option').each(function () {
			if (this.value == arrData[3]) {
				this.selected = true;
				return false;
			}
		});

		$('#dataConfirmOK').attr('href', href);
        $('#dataConfirmModal').modal({show: true});
        return false;
    }

function malformedJSON2Array (tar) {
    var arr = [];
    tar = tar.replace(/^\{|\}$/g,'').split(',');
    for(var i=0,cur,pair;cur=tar[i];i++){
        arr[i] = {};
        pair = cur.split(':');
        arr[i][pair[0]] = /^\d*$/.test(pair[1]) ? +pair[1] : pair[1];
    }
    return arr;
}


function malformedJSON2Object(tar) {
    var obj = {};
    tar = tar.replace(/^\{|\}$/g,'').split(',');
    for(var i=0,cur,pair;cur=tar[i];i++){
        pair = cur.split(':');
        obj[pair[0]] = /^\d*$/.test(pair[1]) ? +pair[1] : pair[1];
    }
    return obj;
}




   function showFormEditUsers(href, data_with_split,dataFromDatabase) {
		var arrData=new Array();
		arrData=data_with_split.split("|");
        if (!$('#dataConfirmModalUsers').length) {
            $('body').append('<div id="dataConfirmModalUsers" class="modalfau"  role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><section class="panel"><form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate" action="'+ href +'" method="post" ><header class="panel-heading"><h2 class="panel-title">Edit data user</h2></header><div class="panel-body"><div class="form-group mt-lg"><label class="col-sm-3 control-label">User Name</label><div class="col-sm-9"><input type="text" id="userName" name="userName" class="form-control" placeholder="Type user name..." readonly/></div></div><div class="form-group"><label class="col-sm-3 control-label">Employee Name</label><div class="col-sm-9"><input type="text" id="userFullName" name="userFullName" class="form-control" placeholder="Type full name..."  readonly/></div></div><div class="form-group"><label class="col-sm-3 control-label">Email</label><div class="col-sm-9"><input type="text" id="email"  name="email"  class="form-control" placeholder="Type email..." /></div></div><div class="form-group"><label class="col-sm-3 control-label">Group</label><div class="col-sm-9"><select  id="groupId" data-plugin-selectTwo class="form-control populate js-example-responsive" style="width: 100%;" name="groupId"></select></div></div><div class="form-group"><label class="col-sm-3 control-label">All employee allowed</label><div class="col-sm-9"><select  id="employeeAllowed" data-plugin-selectTwo class="form-control populate js-example-responsive" style="width: 100%;" name="employeeAllowed"><option value="1">Yes</option><option value="0">No</option></select></div></div><div class="form-group"><label class="col-sm-3 control-label">Remark</label><div class="col-sm-9"><input type="text" id="remark"  name="remark"  class="form-control" placeholder="Type remark..." /></div></div><div class="form-group"><label class="col-sm-3 control-label">Status</label><div class="col-sm-9"><select  id="mystatus" data-plugin-selectTwo class="form-control populate js-example-responsive" style="width: 100%;" name="mystatus"><option value="1">Yes</option><option value="0">No</option></select></div></div></div><footer class="panel-footer"><div class="row"><div class="col-md-12 text-right"><button class="btn btn-primary" type="submit" id="dataConfirmOK">Submit</button><button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button></div></div></footer></form></section></div></div>');
        }
        $('#userName').attr('value', arrData[1]);
        $('#userFullName').attr('value', arrData[2]);
        $('#email').attr('value', arrData[3]);
        $('#remark').attr('value', arrData[6]);

		//dataFromDatabase=dataFromDatabase.replace(/#/g,'');

//		selectValues = { "8": "test 8", "7": "test 7" };
	  $('#groupId option').remove();
		selectValues = malformedJSON2Object(dataFromDatabase);
		$.each(selectValues, function(key, value) {
			 $('#groupId')
				  .append($('<option>', { value : key })
				  .text(value));
		});

		$('#groupId option').each(function () {
			if (this.value == arrData[4]) {
				this.selected = true;
				return false;
			}
		});

		$('#employeeAllowed option').each(function () {
			if (this.value == arrData[5]) {
				this.selected = true;
				return false;
			}
		});

		$('#mystatus option').each(function () {
			if (this.value == arrData[7]) {
				this.selected = true;
				return false;
			}
		});

		$('#dataConfirmOK').attr('href', href);
        $('#dataConfirmModalUsers').modal({show: true});
        return false;
    }

   function showFormEditDepartment(href, data_with_split) {
		var arrData=new Array();
		arrData=data_with_split.split("|");

        if (!$('#dataConfirmModal').length) {
            $('body').append('<div id="dataConfirmModal" class="modalfau"  role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><section class="panel"><form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate" action="'+ href +'" method="post" ><header class="panel-heading"><h2 class="panel-title">Edit data department</h2></header><div class="panel-body"><div class="form-group mt-lg"><label class="col-sm-3 control-label">Department ID</label><div class="col-sm-9"><input type="text" id="departmentId" name="departmentId" class="form-control" placeholder="Type department id..." disabled=""/></div></div><div class="form-group"><label class="col-sm-3 control-label">Department Name</label><div class="col-sm-9"><input type="text" id="departmentName" name="departmentName" class="form-control" placeholder="Type department name..."  disabled=""/></div></div><div class="form-group"><label class="col-sm-3 control-label">Description</label><div class="col-sm-9"><input type="text" id="description"  name="description"  class="form-control" placeholder="Type description..." /></div></div><div class="form-group"><label class="col-sm-3 control-label">Status</label><div class="col-sm-9"><select  id="mystatus" data-plugin-selectTwo class="form-control populate js-example-responsive" style="width: 100%;" name="mystatus"><option value="1">Yes</option><option value="0">No</option></select></div></div></div><footer class="panel-footer"><div class="row"><div class="col-md-12 text-right"><button class="btn btn-primary" type="submit" id="dataConfirmOK">Submit</button><button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button></div></div></footer></form></section></div></div>');
        }
        $('#departmentId').attr('value', arrData[0]);
        $('#departmentName').attr('value', arrData[1]);
        $('#description').attr('value', arrData[2]);

		$('#mystatus option').each(function () {
			if (this.value == arrData[3]) {
				this.selected = true;
				return false;
			}
		});

		$('#dataConfirmOK').attr('href', href);
        $('#dataConfirmModal').modal({show: true});
        return false;
    }

   function showFormEditDesignation(href, data_with_split) {
		var arrData=new Array();
		arrData=data_with_split.split("|");

        if (!$('#dataConfirmModal').length) {
            $('body').append('<div id="dataConfirmModal" class="modalfau"  role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><section class="panel"><form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate" action="'+ href +'" method="post" ><header class="panel-heading"><h2 class="panel-title">Edit data designation</h2></header><div class="panel-body"><div class="form-group mt-lg"><label class="col-sm-3 control-label">Designation ID</label><div class="col-sm-9"><input type="text" id="designationId" name="designationId" class="form-control" placeholder="Type designation id..." disabled=""/></div></div><div class="form-group"><label class="col-sm-3 control-label">Designation Name</label><div class="col-sm-9"><input type="text" id="designationName" name="designationName" class="form-control" placeholder="Type designation name..." disabled=""/></div></div><div class="form-group"><label class="col-sm-3 control-label">Is Overtime</label><div class="col-sm-9"><select  id="isOvertime" data-plugin-selectTwo class="form-control populate js-example-responsive" style="width: 100%;" name="isOvertime"><option value="1">Yes</option><option value="0">No</option></select></div></div><div class="form-group"><label class="col-sm-3 control-label">Is Cut Off Absent</label><div class="col-sm-9"><select  id="isCutAbsentee" data-plugin-selectTwo class="form-control populate js-example-responsive" style="width: 100%;" name="isCutAbsentee"><option value="1">Yes</option><option value="0">No</option></select></div></div><div class="form-group"><label class="col-sm-3 control-label">Description</label><div class="col-sm-9"><input type="text" id="description"  name="description"  class="form-control" placeholder="Type description..." /></div></div><div class="form-group"><label class="col-sm-3 control-label">Status</label><div class="col-sm-9"><select  id="mystatus" data-plugin-selectTwo class="form-control populate js-example-responsive" style="width: 100%;" name="mystatus"><option value="1">Yes</option><option value="0">No</option></select></div></div></div><footer class="panel-footer"><div class="row"><div class="col-md-12 text-right"><button class="btn btn-primary" type="submit" id="dataConfirmOK">Submit</button><button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button></div></div></footer></form></section></div></div>');
        }
        $('#designationId').attr('value', arrData[0]);
        $('#designationName').attr('value', arrData[1]);
         $('#description').attr('value', arrData[4]);

		$('#isOvertime option').each(function () {
			if (this.value == arrData[2]) {
				this.selected = true;
				return false;
			}
		});

		$('#isCutAbsentee option').each(function () {
			if (this.value == arrData[3]) {
				this.selected = true;
				return false;
			}
		});

		$('#mystatus option').each(function () {
			if (this.value == arrData[5]) {
				this.selected = true;
				return false;
			}
		});

		$('#dataConfirmOK').attr('href', href);
        $('#dataConfirmModal').modal({show: true});
        return false;
    }


   function showFormEditDepartmentDetail(href, data_with_split) {
		var arrData=new Array();
		arrData=data_with_split.split("|");
        if (!$('#dataConfirmModalDepartmentDetail').length) {
            $('body').append('<div id="dataConfirmModalDepartmentDetail" class="modalfau"  role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><section class="panel"><form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate" action="'+ href +'" method="post" ><input type="hidden" id="departmentId" name="departmentId" class="form-control" /><header class="panel-heading"><h2 class="panel-title">Edit data department detail</h2></header><div class="panel-body"><div class="form-group mt-lg"><label class="col-sm-6 control-label">Department Detail ID</label><div class="col-sm-6"><input type="text" id="departmentDetailId" name="departmentDetailId" class="form-control" placeholder="Type department detail Id..." disabled=""/></div></div><div class="form-group"><label class="col-sm-6 control-label">Department Detail Name</label><div class="col-sm-6"><input type="text" id="departmentDetailName" name="departmentDetailName" class="form-control" placeholder="Type department detail name..." required/></div></div><div class="form-group"><label class="col-sm-6 control-label">department Name</label><div class="col-sm-6"><input type="text" id="departmentName" name="departmentName" class="form-control" placeholder="Type department name..."  disabled="" /></div></div><div class="form-group"><label class="col-sm-6 control-label">Description</label><div class="col-sm-6"><input type="text" id="description"  name="description"  class="form-control" placeholder="Type description..." /></div></div><div class="form-group"><label class="col-sm-6 control-label">Status</label><div class="col-sm-6"><select  id="mystatus" data-plugin-selectTwo class="form-control populate js-example-responsive" style="width: 100%;" name="mystatus"><option value="1">Yes</option><option value="0">No</option></select></div></div></div><footer class="panel-footer"><div class="row"><div class="col-md-12 text-right"><button class="btn btn-primary" type="submit" id="dataConfirmOK">Submit</button><button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button></div></div></footer></form></section></div></div>');
        }
		/*<style>.datepicker{z-index:1151 !important;}</style>
        */
		$('#departmentDetailId').attr('value', arrData[0]);
        $('#departmentDetailName').attr('value', arrData[1]);
        $('#departmentName').attr('value', arrData[2]);
        $('#description').attr('value', arrData[3]);
        $('#departmentId').attr('value', arrData[5]);


		$('#mystatus option').each(function () {
			if (this.value == arrData[4]) {
				this.selected = true;
				return false;
			}
		});

		$('#dataConfirmOK').attr('href', href);
        $('#dataConfirmModalDepartmentDetail').modal({show: true});
        return false;
    }


    function showFormEditInventory(href, data_with_split,dbdataInventory) {
     var arrData=new Array();
     arrData=data_with_split.split("|");
         if (!$('#dataConfirmModalInventory').length) {
             $('body').append('<div id="dataConfirmModalInventory" class="modalfau"  role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><section class="panel"><form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate" action="'+ href +'" method="post" ><header class="panel-heading"><h2 class="panel-title">Edit Inventory</h2></header><div class="panel-body"><div class="form-group mt-lg"><label class="col-sm-6 control-label">Item ID</label><div class="col-sm-6"><input type="text" id="itemId" name="itemId" class="form-control" placeholder="Type item Id..." disabled=""/></div></div><div class="form-group"><label class="col-sm-6 control-label">Item Name</label><div class="col-sm-6"><input type="text" id="itemName" name="itemName" class="form-control" placeholder="Type Item Name..." required/></div></div><div class="form-group"><label class="col-sm-6 control-label">Item Qty</label><div class="col-sm-6"><input type="text" id="itemQTY" name="itemQTY" class="form-control" placeholder="Type Item Qty..."  /></div></div><div class="form-group"><label class="col-sm-6 control-label">Price</label><div class="col-sm-6"><input type="text" id="itemPrice" name="itemPrice" class="form-control" placeholder="Type Item Price..." required/></div></div><div class="form-group"><label class="col-sm-6 control-label">Category</label><div class="col-sm-6"><div class="input-group mb-md"><select id="myitemCate" data-plugin-selectTwo class="form-control populate" style="width: 100%;" name="myitemCate"></select></div></div></div><div class="form-group"><label class="col-sm-6 control-label">Status</label><div class="col-sm-6"><select  id="mystatus" data-plugin-selectTwo class="form-control populate js-example-responsive" style="width: 100%;" name="mystatus"><option value="1">Yes</option><option value="0">No</option></select></div></div></div><footer class="panel-footer"><div class="row"><div class="col-md-12 text-right"><button class="btn btn-primary" type="submit" id="dataConfirmOK">Submit</button><button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button></div></div></footer></form></section></div></div>');
         }


         $('#itemId').attr('value', arrData[0]);
         $('#itemName').attr('value', arrData[1]);
         $('#itemQTY').attr('value', arrData[2]);
         $('#itemPrice').attr('value', arrData[3]);


     $('#mystatus option').each(function () {
       if (this.value == arrData[5]) {
         this.selected = true;
         return false;
       }
     });

     $('#myitemCate option').remove();
     selectValuesInventory = malformedJSON2Object(dbdataInventory);
     $.each(selectValuesInventory, function(key, value) {
        $('#myitemCate')
           .append($('<option>', { value : key })
           .text(value));
     });

     $('#myitemCate option').each(function () {
       if (this.value == arrData[4]) {
         this.selected = true;
         return false;
       }
     });



     $('#dataConfirmOK').attr('href', href);
         $('#dataConfirmModalInventory').modal({show: true});
         return false;
     }


     function showFormEditBank(href, data_with_split,dbdataBank) {
   var arrData=new Array();
   arrData=data_with_split.split("|");
   if (!$('#dataConfirmModalBank').length) {
       $('body').append('<div id="dataConfirmModalBank" class="modalfau"  role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><section class="panel"><form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate" action="'+ href +'" method="post" ><header class="panel-heading"><h2 class="panel-title">Edit Bank</h2></header><div class="panel-body"><div class="form-group mt-lg"><label class="col-sm-6 control-label">Bank ID</label><div class="col-sm-6"><input type="text" id="bankId" name="bankId" class="form-control" placeholder="Type Bank Id..." disabled=""/></div></div><div class="form-group"><label class="col-sm-6 control-label">Bank Parent</label><div class="col-sm-6"><div class="input-group mb-md"><select id="myParent" data-plugin-selectTwo class="form-control populate" style="width: 100%;" name="myParent"></select></div></div></div><div class="form-group"><label class="col-sm-6 control-label">Bank Name</label><div class="col-sm-6"><input type="text" id="bankName" name="bankName" class="form-control" placeholder="Type Bank Name..." required/></div></div><div class="form-group"><label class="col-sm-6 control-label">Address</label><div class="col-sm-6"><textarea class="form-control" id="address" name="address"></textarea></div></div><div class="form-group"><label class="col-sm-6 control-label">Telp</label><div class="col-sm-6"><input type="text" id="telp" name="telp" class="form-control" placeholder="Type Telp Number..." required/></div></div><div class="form-group"><label class="col-sm-6 control-label">Fax</label><div class="col-sm-6"><input type="text" id="fax" name="fax" class="form-control" placeholder="Type Fax Number..." required/></div></div><div class="form-group"><label class="col-sm-6 control-label">Description</label><div class="col-sm-6"><textarea class="form-control" id="description" name="description"></textarea></div></div><div class="form-group"><label class="col-sm-6 control-label">Status</label><div class="col-sm-6"><select  id="mystatus" data-plugin-selectTwo class="form-control populate js-example-responsive" style="width: 100%;" name="mystatus"><option value="1">Yes</option><option value="0">No</option></select></div></div></div><footer class="panel-footer"><div class="row"><div class="col-md-12 text-right"><button class="btn btn-primary" type="submit" id="dataConfirmOK">Submit</button><button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button></div></div></footer></form></section></div></div>');
   }

          $('#bankId').attr('value', arrData[0]);
          $('#bankName').attr('value', arrData[2]);
          //$('#address').attr('value', arrData[3]);
          $('#address').val(arrData[3]);
          $('#telp').attr('value', arrData[4]);
          $('#fax').attr('value', arrData[5]);
          $('#description').val(arrData[6]);


      $('#mystatus option').each(function () {
        if (this.value == arrData[7]) {
          this.selected = true;
          return false;
        }
      });

      $('#myParent option').remove();
      selectValuesParent = malformedJSON2Object(dbdataBank);
      $.each(selectValuesParent, function(key, value) {
         $('#myParent')
            .append($('<option>', { value : key })
            .text(value));
      });

      $('#myParent option').each(function () {
        if (this.value == arrData[1]) {
          this.selected = true;
          return false;
        }
      });



      $('#dataConfirmOK').attr('href', href);
          $('#dataConfirmModalBank').modal({show: true});
          return false;
      }


     function showFormEditFamily(href, data_with_split,dbdataInventory) {
      var arrData=new Array();
      arrData=data_with_split.split("|");
          if (!$('#dataConfirmModalInventory').length) {
              $('body').append('<div id="dataConfirmModalInventory" class="modalfau"  role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><section class="panel"><form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate" action="'+ href +'" method="post" ><header class="panel-heading"><h2 class="panel-title">Edit Inventory</h2></header><div class="panel-body"><div class="form-group mt-lg"><label class="col-sm-6 control-label">Item ID</label><div class="col-sm-6"><input type="text" id="itemId" name="itemId" class="form-control" placeholder="Type item Id..." disabled=""/></div></div><div class="form-group"><label class="col-sm-6 control-label">Item Name</label><div class="col-sm-6"><input type="text" id="itemName" name="itemName" class="form-control" placeholder="Type Item Name..." required/></div></div><div class="form-group"><label class="col-sm-6 control-label">Item Qty</label><div class="col-sm-6"><input type="text" id="itemQTY" name="itemQTY" class="form-control" placeholder="Type Item Qty..."  /></div></div><div class="form-group"><label class="col-sm-6 control-label">Price</label><div class="col-sm-6"><input type="text" id="itemPrice" name="itemPrice" class="form-control" placeholder="Type Item Price..." required/></div></div><div class="form-group"><label class="col-sm-6 control-label">Category</label><div class="col-sm-6"><div class="input-group mb-md"><select id="myitemCate" data-plugin-selectTwo class="form-control populate" style="width: 100%;" name="myitemCate"></select></div></div></div><div class="form-group"><label class="col-sm-6 control-label">Status</label><div class="col-sm-6"><select  id="mystatus" data-plugin-selectTwo class="form-control populate js-example-responsive" style="width: 100%;" name="mystatus"><option value="1">Yes</option><option value="0">No</option></select></div></div></div><footer class="panel-footer"><div class="row"><div class="col-md-12 text-right"><button class="btn btn-primary" type="submit" id="dataConfirmOK">Submit</button><button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button></div></div></footer></form></section></div></div>');
          }


          $('#itemId').attr('value', arrData[0]);
          $('#itemName').attr('value', arrData[1]);
          $('#itemQTY').attr('value', arrData[2]);
          $('#itemPrice').attr('value', arrData[3]);


      $('#mystatus option').each(function () {
        if (this.value == arrData[5]) {
          this.selected = true;
          return false;
        }
      });

      $('#myitemCate option').remove();
      selectValuesInventory = malformedJSON2Object(dbdataInventory);
      $.each(selectValuesInventory, function(key, value) {
         $('#myitemCate')
            .append($('<option>', { value : key })
            .text(value));
      });

      $('#myitemCate option').each(function () {
        if (this.value == arrData[4]) {
          this.selected = true;
          return false;
        }
      });



      $('#dataConfirmOK').attr('href', href);
          $('#dataConfirmModalInventory').modal({show: true});
          return false;
      }


// =-=========== Edit pendidikan
function showFormEditPendidikan(href, data_with_split,dbStudi) {
 var arrData=new Array();
 arrData=data_with_split.split("|");
     if (!$('#dataConfirmModalpendidikan').length) {
         $('body').append('<div id="dataConfirmModalPendidikan" class="modalfau"  role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><section class="panel"><form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate" action="'+ href +'" method="post" ><header class="panel-heading"><h2 class="panel-title">Edit data Pendidikan </h2></header><input type="hidden" id="pendidikanId" name="pendidikanId" class="form-control" /><input type="hidden" id="employeeId" name="employeeId" class="form-control" /><div class="panel-body"><div class="form-group"><label class="col-sm-6 control-label">Pendidikan</label><div class="col-sm-6"><div class="input-group mb-md"><select  id="myStudiId" data-plugin-selectTwo class="form-control populate" style="width: 100%;" name="myStudiId"></select></div></div></div><div class="form-group"><label class="col-sm-6 control-label">School Name</label><div class="col-sm-6"><input type="text" id="schoolName" name="schoolName" class="form-control" placeholder="Type School name..." /></div></div><div class="form-group"><label class="col-sm-6 control-label">Periode</label><div class="col-sm-6"><input type="text" id="periode"  name="periode"  class="form-control" placeholder="Type Periode..." /></div></div><div class="form-group"><label class="col-sm-6 control-label">Status</label><div class="col-sm-6"><select  id="mystatus" data-plugin-selectTwo class="form-control populate js-example-responsive" style="width: 100%;" name="mystatus"><option value="1">Yes</option><option value="0">No</option></select></div></div></div><footer class="panel-footer"><div class="row"><div class="col-md-12 text-right"><button class="btn btn-primary" type="submit" id="dataConfirmOK">Submit</button><button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button></div></div></footer></form></section></div></div>');
     }

     /*<style>.datepicker{z-index:1151 !important;}</style>
     */
    //  $('#pendidikanId').attr('value', arrData[0]);
    $('#employeeId').attr('value', arrData[1]);
     $('#schoolName').attr('value', arrData[3]);
     $('#periode').attr('value', arrData[4]);
    //  $('#description').attr('value', arrData[3]);
    //  $('#departmentId').attr('value', arrData[5]);

    $('#myStudiId option').remove();
    selectValuesStudi = malformedJSON2Object(dbStudi);
    $.each(selectValuesStudi, function(key, value) {
       $('#myStudiId')
          .append($('<option>', { value : key })
          .text(value));
    });

    $('#myStudiId option').each(function () {
      if (this.value == arrData[2]) {
        this.selected = true;
        return false;
      }
    });


 $('#mystatus option').each(function () {
   if (this.value == arrData[5]) {
     this.selected = true;
     return false;
   }
 });

 $('#dataConfirmOK').attr('href', href);
     $('#dataConfirmModalpendidikan').modal({show: true});
     return false;
 }
// =======


   function showFormEditEmployee(href, data_with_split,dbDepartment,dbDesignation) {
		var arrData=new Array();
		arrData=data_with_split.split("|");
        if (!$('#dataConfirmModalEmployee').length) {
            $('body').append('<div id="dataConfirmModalEmployee" class="modalfau"  role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><section class="panel"><form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate" action="'+ href +'" method="post" ><header class="panel-heading"><h2 class="panel-title">Edit Employee</h2></header><div class="panel-body"><div class="form-group mt-lg"><label class="col-sm-6 control-label">Employee ID</label><div class="col-sm-6"><input type="text" id="employeeId" name="employeeId" class="form-control" placeholder="Type employee Id..." disabled=""/></div></div><div class="form-group"><label class="col-sm-6 control-label">Employee First Name</label><div class="col-sm-6"><input type="text" id="employeeFirstName" name="employeeFirstName" class="form-control" placeholder="Type Employee First Name..." required/></div></div><div class="form-group"><label class="col-sm-6 control-label">Employee last Name</label><div class="col-sm-6"><input type="text" id="employeeLastName" name="employeeLastName" class="form-control" placeholder="Type Employee Last Name..."  /></div></div><div class="form-group"><label class="col-sm-6 control-label">Department</label><div class="col-sm-6"><div class="input-group mb-md"><select  id="myDepartmentId" data-plugin-selectTwo class="form-control populate" style="width: 100%;" name="myDepartmentId"></select></div></div></div><div class="form-group"><label class="col-sm-6 control-label">Designation</label><div class="col-sm-6"><select  id="myDesignationId" data-plugin-selectTwo class="form-control populate js-example-responsive" style="width: 100%;" name="myDesignationId"></select></div></div><div class="form-group"><label class="col-sm-6 control-label">Status</label><div class="col-sm-6"><select  id="mystatus" data-plugin-selectTwo class="form-control populate js-example-responsive" style="width: 100%;" name="mystatus"><option value="1">Yes</option><option value="0">No</option></select></div></div></div><footer class="panel-footer"><div class="row"><div class="col-md-12 text-right"><button class="btn btn-primary" type="submit" id="dataConfirmOK">Submit</button><button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button></div></div></footer></form></section></div></div>');
        }
		/*<style>.datepicker{z-index:1151 !important;}</style>
        */
        $('#employeeId').attr('value', arrData[0]);
        $('#employeeFirstName').attr('value', arrData[1]);
        $('#employeeLastName').attr('value', arrData[2]);


		$('#mystatus option').each(function () {
			if (this.value == arrData[5]) {
				this.selected = true;
				return false;
			}
		});

		$('#myDepartmentId option').remove();
		selectValuesDepartment = malformedJSON2Object(dbDepartment);
		$.each(selectValuesDepartment, function(key, value) {
			 $('#myDepartmentId')
				  .append($('<option>', { value : key })
				  .text(value));
		});

		$('#myDepartmentId option').each(function () {
			if (this.value == arrData[3]) {
				this.selected = true;
				return false;
			}
		});



		$('#myDesignationId option').remove();
		selectValuesDesignation = malformedJSON2Object(dbDesignation);
		$.each(selectValuesDesignation, function(key, value) {
			 $('#myDesignationId')
				  .append($('<option>', { value : key })
				  .text(value));
		});

		$('#myDesignationId option').each(function () {
			if (this.value == arrData[4]) {
				this.selected = true;
				return false;
			}
		});


		$('#dataConfirmOK').attr('href', href);
        $('#dataConfirmModalEmployee').modal({show: true});
        return false;
    }
// =====================================
function showFormEditEmployeeAffair(href, data_with_split,dbDepartment,dbDesignation,dbTitle,dbEmployeeStatus,dbReligi,dbMarried) {
  var arrData=new Array();
  arrData=data_with_split.split("|");

       if (!$('#dataConfirmModalEmployeeAffair').length) {
           $('body').append('<div id="dataConfirmModalEmployeeAffair" class="modalfau"  role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><section class="panel"><form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate" action="'+ href +'" method="post" ><header class="panel-heading"><h2 class="panel-title">Edit Employee Affair</h2></header><div class="panel-body"><div class="form-group mt-lg"><label class="col-sm-6 control-label">Employee ID</label><div class="col-sm-6"><input type="text" id="employeeId" name="employeeId" class="form-control" placeholder="Type employee Id..." disabled=""/></div></div><div class="form-group"><label class="col-sm-6 control-label">Employee First Name</label><div class="col-sm-6"><input type="text" id="employeeFirstName" name="employeeFirstName" class="form-control" placeholder="Type Employee First Name..." required/></div></div><div class="form-group"><label class="col-sm-6 control-label">Employee last Name</label><div class="col-sm-6"><input type="text" id="employeeLastName" name="employeeLastName" class="form-control" placeholder="Type Employee Last Name..." /></div></div><div class="form-group"><label class="col-sm-6 control-label">Department</label><div class="col-sm-6"><div class="input-group mb-md"><select  id="myDepartmentId" data-plugin-selectTwo class="form-control populate" style="width: 100%;" name="myDepartmentId"></select></div></div></div><div class="form-group"><label class="col-sm-6 control-label">Designation</label><div class="col-sm-6"><select  id="myDesignationId" data-plugin-selectTwo class="form-control populate js-example-responsive" style="width: 100%;" name="myDesignationId"></select></div></div><div class="form-group"><label class="col-sm-6 control-label">Tempat Lahir</label><div class="col-sm-6"><input type="text" id="tempatlahir" name="tempatlahir" class="form-control" placeholder="Type tempat lahir..."  /></div></div><div class="form-group"><label class="col-sm-6 control-label">Tanggal Lahir</label><div class="col-sm-6"><input type="text" id="tanggallahir" name="tanggallahir" class="form-control" placeholder="Type Tanggal Lahir..."  /></div></div><div class="form-group"><label class="col-sm-6 control-label">Alamat</label><div class="col-sm-6"><textarea class="form-control" id="alamat" name="alamat"></textarea></div></div><div class="form-group"><label class="col-sm-6 control-label">Religion</label><div class="col-sm-6"><select  id="myReligiId" data-plugin-selectTwo class="form-control populate js-example-responsive" style="width: 100%;" name="myReligiId"></select></div></div><div class="form-group"><label class="col-sm-6 control-label">Married</label><div class="col-sm-6"><select  id="myMarriedId" data-plugin-selectTwo class="form-control populate js-example-responsive" style="width: 100%;" name="myMarriedId"></select></div></div><div class="form-group"><label class="col-sm-6 control-label">Status</label><div class="col-sm-6"><select  id="mystatus" data-plugin-selectTwo class="form-control populate js-example-responsive" style="width: 100%;" name="mystatus"><option value="1">Yes</option><option value="0">No</option></select></div></div></div><footer class="panel-footer"><div class="row"><div class="col-md-12 text-right"><button class="btn btn-primary" type="submit" id="dataConfirmOK">Submit</button><button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button></div></div></footer></form></section></div></div>');
       }
       $('#employeeId').attr('value', arrData[0]);
       $('#employeeFirstName').attr('value', arrData[1]);
       $('#employeeLastName').attr('value', arrData[2]);
       $('#tempatlahir').attr('value', arrData[5]);
       $('#tanggallahir').attr('value', arrData[6]);
       $('#alamat').val(arrData[7]);
       $('#mystatus option').each(function () {
         if (this.value == arrData[10]) {
             this.selected = true;
             return false;
           }
         });

  $('#myDepartmentId option').remove();
  selectValuesDepartment = malformedJSON2Object(dbDepartment);
  $.each(selectValuesDepartment, function(key, value) {
     $('#myDepartmentId')
        .append($('<option>', { value : key })
        .text(value));
  });

  $('#myDepartmentId option').each(function () {
    if (this.value == arrData[3]) {
      this.selected = true;
      return false;
    }
  });

  $('#myDesignationId option').remove();
  selectValuesDesignation = malformedJSON2Object(dbDesignation);
  $.each(selectValuesDesignation, function(key, value) {
     $('#myDesignationId')
        .append($('<option>', { value : key })
        .text(value));
  });

  $('#myDesignationId option').each(function () {
    if (this.value == arrData[4]) {
      this.selected = true;
      return false;
    }
  });

   $('#myReligiId option').remove();
   selectValuesReligi = malformedJSON2Object(dbReligi);
   $.each(selectValuesReligi, function(key, value) {
      $('#myReligiId')
         .append($('<option>', { value : key })
         .text(value));
   });

   $('#myReligiId option').each(function () {
     if (this.value == arrData[8]) {
       this.selected = true;
       return false;
     }
   });

   $('#myMarriedId option').remove();
   selectValuesMarried = malformedJSON2Object(dbMarried);
   $.each(selectValuesMarried, function(key, value) {
      $('#myMarriedId')
         .append($('<option>', { value : key })
         .text(value));
   });

   $('#myMarriedId option').each(function () {
     if (this.value == arrData[9]) {
       this.selected = true;
       return false;
     }
   });

   $('#dataConfirmOK').attr('href', href);
        $('#dataConfirmModalEmployeeAffair').modal({show: true});

        return false;
    }




// ============================================

   function showFormReport(href, data_with_split,dbProvinsi,dbTarget,dbPeriod) {
	   var myHref="";
	   var myHref=href;

		var arrData=new Array();
		arrData=data_with_split.split("|");
        if (!$('#dataConfirmModalReport').length) {
             $('body').append('<div id="dataConfirmModalReport" class="modalfau"  role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><section class="panel"><form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate" action="'+ myHref +'" method="post" target="new"><input type="hidden" id="href" name="href" class="form-control" /><input type="hidden" id="myType" name="myType" class="form-control" /><header class="panel-heading"><h2 class="panel-title">Criteria Report</h2></header><div class="panel-body"><div class="form-group mt-lg"><label class="col-sm-6 control-label">Report Name</label><div class="col-sm-6"><input type="text" id="fauzan" name="fauzan" class="form-control" placeholder="Type fauzan..." readonly="readonly"/></div></div><div class="form-group"><label class="col-sm-6 control-label">Provinsi</label><div class="col-sm-6"><div class="input-group mb-md"><select  id="myProvinsiId" data-plugin-selectTwo class="form-control populate" style="width: 100%;" name="myProvinsiId"></select></div></div></div><div class="form-group"><label class="col-sm-6 control-label">Target Group</label><div class="col-sm-6"><select  id="myTargetId" data-plugin-selectTwo class="form-control populate js-example-responsive" style="width: 100%;" name="myTargetId"></select></div></div><div class="form-group"><label class="col-sm-6 control-label">Period</label><div class="col-sm-6"><select  id="myPeriodId" data-plugin-selectTwo class="form-control populate js-example-responsive" style="width: 100%;" name="myPeriodId"></select></div></div><div class="form-group"><label class="col-sm-6 control-label">Status Verifikasi Teknik</label><div class="col-sm-6"><select  id="mystatus" data-plugin-selectTwo class="form-control populate js-example-responsive" style="width: 100%;" name="mystatus"><option value="-1">-------------- ALL --------------</option><option value="1">Yes</option><option value="0">No</option></select></div></div></div><footer class="panel-footer"><div class="row"><div class="col-md-12 text-right"><button class="btn btn-primary" type="submit" id="dataConfirmOK"  class="btn" aria-hidden="true">Submit</button><button class="btn" data-dismiss="modal" aria-hidden="true"  type=\"reset\">Cancel</button></div></div></footer></form></section></div></div>');
        }


		$('#fauzan').attr('value', arrData[0]);
		$('#myType').attr('value', arrData[1]);
		$('#href').attr('value', href);



		$('#myProvinsiId option').remove();
		selectValuesProvinsi = malformedJSON2Object(dbProvinsi);
		$.each(selectValuesProvinsi, function(key, value) {
			 $('#myProvinsiId')
				  .append($('<option>', { value : key })
				  .text(value));
		});

		$('#myTargetId option').remove();
		selectValuesTarget = malformedJSON2Object(dbTarget);
		$.each(selectValuesTarget, function(key, value) {
			 $('#myTargetId')
				  .append($('<option>', { value : key })
				  .text(value));
		});

		$('#myPeriodId option').remove();
		selectValuesPeriod = malformedJSON2Object(dbPeriod);
		$.each(selectValuesPeriod, function(key, value) {
			 $('#myPeriodId')
				  .append($('<option>', { value : key })
				  .text(value));
		});




		//$('#dataConfirmOK').attr('href', href);
        $('#dataConfirmModalReport').modal({show: true});

		$('#dataConfirmOK').click(function() {
			 window.location.reload();
		});



		$('#dataConfirmOK').bind('click', function(e) {
                    var href = $('input[name=href]').val();
                    var typeReport = $('input[name=myType]').val();
	                var myProvinsiId = $('select[name=myProvinsiId]').val();
                    var myPeriodId = $('select[name=myPeriodId]').val();
                    var myTargetId = $('select[name=myTargetId]').val();

 						  doGenerateReport(href, typeReport, myProvinsiId, myPeriodId, myTargetId);

		});


        return false;
    }


 function showFormReasonOvertime(href, data_with_split) {
		var arrData=new Array();
		arrData=data_with_split.split("|");
         if (!$('#dataConfirmModal').length) {
            $('body').append('<div id="dataConfirmModal" class="modalfau"  role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><section class="panel"><form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate" action="'+ href +'" method="post" ><header class="panel-heading"><h2 class="panel-title">Type Reason Overtime</h2></header><div class="panel-body"><div class="form-group mt-lg"><input type="hidden" id="employeeId" name="employeeId"/><input type="hidden" id="myDateDb" name="myDateDb" class="form-control"><label class="col-sm-3 control-label">Employee Name</label><div class="col-sm-9"><input type="text" id="employeeName" name="employeeName" class="form-control" placeholder="Type employee name..." disabled=""/></div></div><div class="form-group"><label class="col-sm-3 control-label">Date</label><div class="col-sm-9"><input type="text" id="myDate" name="myDate" class="form-control" placeholder="Type date..."readonly/></div></div><div class="form-group"><label class="col-sm-3 control-label">IN</label><div class="col-sm-9"><input type="text" id="myIn" name="myIn" class="form-control" placeholder="Type IN..." disabled=""/></div></div><div class="form-group"><label class="col-sm-3 control-label">OUT</label><div class="col-sm-9"><input type="text" id="myOut"  name="myOut"  class="form-control" placeholder="Type OUT..." disabled=""/></div></div><div class="form-group"><label class="col-sm-3 control-label">Amount Overtime</label><div class="col-sm-9"><input type="text" id="amountOvertime" name="amountOvertime" class="form-control" placeholder="Type Amount Overtime..." disabled=""/></div></div><div class="form-group"><label class="col-sm-3 control-label">Reason</label><div class="col-sm-9"><input type="text" id="myReasonOvertime"  name="myReasonOvertime"  class="form-control" placeholder="Type Reason Overtime..." /></div></div></div><footer class="panel-footer"><div class="row"><div class="col-md-12 text-right"><button class="btn btn-primary" type="submit" id="dataConfirmOK">Submit</button><button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button></div></div></footer></form></section></div></div>');
        }
        $('#employeeId').attr('value', arrData[0]);
        $('#employeeName').attr('value', arrData[1]);
         $('#myDate').attr('value', arrData[2]);
         $('#myIn').attr('value', arrData[3]);
         $('#myOut').attr('value', arrData[4]);
         $('#amountOvertime').attr('value', arrData[5]);
         $('#myDateDb').attr('value', arrData[6]);


		$('#dataConfirmOK').attr('href', href);
        $('#dataConfirmModal').modal({show: true});
        return false;
    }



 function showFormApprovalOvertime(href, data_with_split) {
		var arrData=new Array();
		arrData=data_with_split.split("|");
         if (!$('#dataConfirmModal').length) {
            $('body').append('<div id="dataConfirmModal" class="modalfau"  role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><section class="panel"><form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate" action="'+ href +'" method="post" ><header class="panel-heading"><h2 class="panel-title">Approval Overtime</h2></header><div class="panel-body"><div class="form-group mt-lg"><input type="hidden" id="employeeId" name="employeeId"/><input type="hidden" id="myDateDb" name="myDateDb" class="form-control"> <label class="col-sm-3 control-label">Employee Name</label><div class="col-sm-9"><input type="text" id="employeeName" name="employeeName" class="form-control" placeholder="Type employee name..." disabled=""/></div></div><div class="form-group"><label class="col-sm-3 control-label">Date</label><div class="col-sm-9"><input type="text" id="myDate" name="myDate" class="form-control" placeholder="Type date..."readonly/></div></div><div class="form-group"><label class="col-sm-3 control-label">IN</label><div class="col-sm-9"><input type="text" id="myIn" name="myIn" class="form-control" placeholder="Type IN..." disabled=""/></div></div><div class="form-group"><label class="col-sm-3 control-label">OUT</label><div class="col-sm-9"><input type="text" id="myOut"  name="myOut"  class="form-control" placeholder="Type OUT..." disabled=""/></div></div><div class="form-group"><label class="col-sm-3 control-label">Amount Overtime</label><div class="col-sm-9"><input type="text" id="amountOvertime" name="amountOvertime" class="form-control" placeholder="Type Amount Overtime..." disabled=""/></div></div><div class="form-group"><label class="col-sm-3 control-label">Reason</label><div class="col-sm-9"><input type="text" id="myReasonOvertime"  name="myReasonOvertime"  class="form-control" placeholder="Type Reason Overtime..." disabled=""/></div></div><div class="form-group"><label class="col-sm-3 control-label">Approve/Reject</label><div class="col-sm-6"><select  id="mystatus" data-plugin-selectTwo class="form-control populate js-example-responsive" style="width: 100%;" name="mystatus"><option value="1">Approve</option><option value="-1">Reject</option></select></div></div><div class="form-group"><label class="col-sm-3 control-label">Reason </label><div class="col-sm-9"><input type="text" id="myReasonApproval"  name="myReasonApproval"  class="form-control" placeholder="Type Reason ..." /></div></div></div><footer class="panel-footer"><div class="row"><div class="col-md-12 text-right"><button class="btn btn-primary" type="submit" id="dataConfirmOK">Submit</button><button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button></div></div></footer></form></section></div></div>');
        }
        $('#employeeId').attr('value', arrData[0]);
        $('#employeeName').attr('value', arrData[1]);
         $('#myDate').attr('value', arrData[2]);
         $('#myIn').attr('value', arrData[3]);
         $('#myOut').attr('value', arrData[4]);
         $('#amountOvertime').attr('value', arrData[5]);
         $('#myDateDb').attr('value', arrData[6]);
         $('#myReasonOvertime').attr('value', arrData[7]);


		$('#dataConfirmOK').attr('href', href);
        $('#dataConfirmModal').modal({show: true});
        return false;
    }


 function showFormComplainAbsentee(href, data_with_split,hrefDestination) {
		var arrData=new Array();
		arrData=data_with_split.split("|");
         if (!$('#dataConfirmModal').length) {
            $('body').append('<div id="dataConfirmModal" class="modalfau"  role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><section class="panel"><form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate" action="'+ href +'" method="post" ><header class="panel-heading"><h2 class="panel-title">Type Reason Overtime</h2></header><div class="panel-body"><div class="form-group mt-lg"><input type="hidden" id="myDateDb" name="myDateDb" class="form-control"><label class="col-sm-3 control-label">Employee ID</label><div class="col-sm-9"><input type="text" id="employeeId" name="employeeId" class="form-control" placeholder="Type employee id..." readonly/></div></div><div class="form-group"><label class="col-sm-3 control-label">Employee Name</label><div class="col-sm-9"><input type="text" id="employeeName" name="employeeName" class="form-control" placeholder="Type employee name..." disabled=""/></div></div><div class="form-group"><label class="col-sm-3 control-label">Date</label><div class="col-sm-9"><input type="text" id="myDate" name="myDate" class="form-control" placeholder="Type date..." readonly/></div></div><div class="form-group"><label class="col-sm-3 control-label">IN</label><div class="col-sm-9"><input type="text" id="myIn" name="myIn" class="form-control" placeholder="Type IN..." disabled=""/></div></div><div class="form-group"><label class="col-sm-3 control-label">OUT</label><div class="col-sm-9"><input type="text" id="myOut"  name="myOut"  class="form-control" placeholder="Type OUT..." disabled=""/></div></div><div class="form-group"><label class="col-sm-3 control-label">Cut Off Absentee Desc</label><div class="col-sm-9"><input type="text" id="cutAbsenteeTypeDesc" name="cutAbsenteeTypeDesc" class="form-control" placeholder="Type Desc..." disabled=""/></div></div><div class="form-group"><label class="col-sm-3 control-label">Reason/Complain</label><div class="col-sm-9"><input type="text" id="myReasonComplain"  name="myReasonComplain"  class="form-control" placeholder="Type Reason complain..." /></div></div></div><footer class="panel-footer"><div class="row"><div class="col-md-12 text-right"><button class="btn btn-primary" type="submit" id="dataConfirmOK">Submit</button><button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button></div></div></footer></form></section></div></div>');
        }
        $('#employeeId').attr('value', arrData[0]);
        $('#employeeName').attr('value', arrData[1]);
         $('#myDate').attr('value', arrData[2]);
         $('#myIn').attr('value', arrData[3]);
         $('#myOut').attr('value', arrData[4]);
         $('#cutAbsenteeTypeDesc').attr('value', arrData[5]);
         $('#myDateDb').attr('value', arrData[6]);


		$('#dataConfirmOK').attr('href', href);
        $('#dataConfirmModal').modal({show: true});
        return false;
    }

 function showFormApprovalComplain(href, data_with_split) {
		var arrData=new Array();
		arrData=data_with_split.split("|");
         if (!$('#dataConfirmModal').length) {
            $('body').append('<div id="dataConfirmModal" class="modalfau"  role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true"><section class="panel"><form id="demo-form" class="form-horizontal mb-lg" novalidate="novalidate" action="'+ href +'" method="post" ><header class="panel-heading"><h2 class="panel-title">Approval Complain</h2></header><div class="panel-body"><div class="form-group mt-lg"><input type="hidden" id="employeeId" name="employeeId"/><input type="hidden" id="myDateDb" name="myDateDb" class="form-control"> <label class="col-sm-3 control-label">Employee Name</label><div class="col-sm-9"><input type="text" id="employeeName" name="employeeName" class="form-control" placeholder="Type employee name..." disabled=""/></div></div><div class="form-group"><label class="col-sm-3 control-label">Date</label><div class="col-sm-9"><input type="text" id="myDate" name="myDate" class="form-control" placeholder="Type date..."readonly/></div></div><div class="form-group"><label class="col-sm-3 control-label">IN</label><div class="col-sm-9"><input type="text" id="myIn" name="myIn" class="form-control" placeholder="Type IN..." disabled=""/></div></div><div class="form-group"><label class="col-sm-3 control-label">OUT</label><div class="col-sm-9"><input type="text" id="myOut"  name="myOut"  class="form-control" placeholder="Type OUT..." disabled=""/></div></div> <div class="form-group"><label class="col-sm-3 control-label">Reason</label><div class="col-sm-9"><input type="text" id="myReasonOvertime"  name="myReasonOvertime"  class="form-control" placeholder="Type Reason Overtime..." disabled=""/></div></div><div class="form-group"><label class="col-sm-3 control-label">Approve/Reject</label><div class="col-sm-6"><select  id="mystatus" data-plugin-selectTwo class="form-control populate js-example-responsive" style="width: 100%;" name="mystatus"><option value="1">Approve</option><option value="-1">Reject</option></select></div></div><div class="form-group"><label class="col-sm-3 control-label">Reason </label><div class="col-sm-9"><input type="text" id="myComplainApproval"  name="myComplainApproval"  class="form-control" placeholder="Type Reason ..." /></div></div></div><footer class="panel-footer"><div class="row"><div class="col-md-12 text-right"><button class="btn btn-primary" type="submit" id="dataConfirmOK">Submit</button><button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button></div></div></footer></form></section></div></div>');
        }
        $('#employeeId').attr('value', arrData[0]);
        $('#employeeName').attr('value', arrData[1]);
         $('#myDate').attr('value', arrData[2]);
         $('#myIn').attr('value', arrData[3]);
         $('#myOut').attr('value', arrData[4]);
         $('#amountOvertime').attr('value', arrData[5]);
         $('#myDateDb').attr('value', arrData[6]);
         $('#myReasonOvertime').attr('value', arrData[7]);


		$('#dataConfirmOK').attr('href', href);
        $('#dataConfirmModal').modal({show: true});
        return false;
    }
