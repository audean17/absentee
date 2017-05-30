<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Inventory extends CI_Controller {

    // Nama table
    private $table = "tp_datainventory";
    // Primary key table
    private $primary = "item_id";
    // Field-field data yang ada di database
    private $fields = array(
        'idmenu',
        'menu',
        'menu_title',
        'link_type',
        'content',
        'file_name',
        'logo',
        'image',
        'priority',
        'level',
        'leaf',
        'idparent',
        'active');
    // Link controller
    private $linkController = "inventory";

	private $queryItem="select * from tp_datainventory where status=1 order by item_name asc";
	private $queryCate="select * from tm_inventory where status=1 order by inventory_name asc";

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('userId')) {
            redirect('login');
        }
    }

    public function index($offset = null) {

        $data['linkForm'] = site_url($this->linkController.'/create');

	// $data['groups'] = $this->db->query("select a.*,case when a.status = 1 then 'Yes' when a.status=0 then 'No' end as my_status,department_name,designation_name
	// 	from tm_employee a
	// 	inner join tm_department b on a.department_id=b.department_id
	// 	inner join tm_designation c on a.designation_id=c.designation_id
	// 	where a.status in (1,0,9) order by employee_first_name ASC")->result();

      // $data['gabungs'] = $this->db->query("select a.*,case when a.status = 1 then 'Yes' when a.status=0 then 'No' end as my_status,inventory_name
    	// from tm_inventory a
    	// inner join tp_datainventory b on a.inventory_id=b.inventory_id
    	// where a.status in (1,0,9) order by item_id ASC")->result();

      $data['gabungs'] = $this->db->query("select a.*,case when a.status = 1 then 'Yes' when a.status=0 then 'No' end as my_status,inventory_name
      from tp_datainventory a
      inner join tm_inventory b on a.inventory_id=b.inventory_id
      where a.status in (1,0,9) order by item_id ASC")->result();

      // $data['gabungs'] = $this->db->query("select item_id,item_name,item_qty,item_price from tp_datainventory a  where a.status in (1,0,9) order by item_id ASC")->result();
      $data['categorys'] = $this->db->query("select inventory_id,inventory_name from tm_inventory a  where a.status in (1,0,9) order by inventory_name ASC")->result();

		  // $data['departments'] = $this->db->query("select department_id,department_name from tm_department a  where a.status in (1,0,9) order by department_name ASC")->result();
      //
   	// 	$data['designations'] = $this->db->query("select designation_id,designation_name from tm_designation a  where a.status in (1,0,9) order by designation_name ASC")->result();


 		$data['tittlepage']="Inventory";
		$data['cssVendorSpecific']="
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/select2/css/select2.css\" />
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/select2-bootstrap-theme/select2-bootstrap.css\" />
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/jquery-datatables-bs3/assets/css/datatables.css\" />
		";

		$data['userName']=$this->session->userdata('userName');
		$data['fullname']=$this->session->userdata('userFullName');

		$data['titleContent']="Inventory";
		$data['LeftCaption']="<li>
									<a href=\"".site_url('headline')."\">
										<i class=\"fa fa-home\"></i>
									</a>
								</li>
								<li><span>Data GA</span></li>
								<li><span>Inventory</span></li>
								";
		$data['titleTable']="Inventory with details";


	  $data['vendorJavascript']="
		<script src=\"".base_url()."assets/porto/vendor/select2/js/select2.js\"></script>
		<script src=\"".base_url()."assets/porto/vendor/jquery-datatables/media/js/jquery.dataTables.js\"></script>
		<script src=\"".base_url()."assets/porto/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js\"></script>
		<script src=\"".base_url()."assets/porto/vendor/jquery-datatables-bs3/assets/js/datatables.js\"></script>
	  ";
/*	  $data['vendorJavascriptExample']="
		<script src=\"".base_url()."assets/porto/javascripts/tables/examples.datatables.default.js\"></script>
		<script src=\"".base_url()."assets/porto/javascripts/tables/examples.datatables.row.with.details.js\"></script>
		<script src=\"".base_url()."assets/porto/javascripts/tables/examples.datatables.tabletools.js\"></script>
	  ";
*/
	$data['vendorJavascriptExample']="
		<script src=\"".base_url()."assets/porto/javascripts/tables/examples.datatables.default.js\"></script>
		<script src=\"".base_url()."assets/porto/javascripts/ui-elements/examples.modals.js\"></script>
	";

	$data['modalfau']="
	 <link rel=\"stylesheet\" href=\"".base_url()."assets/porto/stylesheets/modalfau.css\">
	<script src=\"".base_url()."assets/porto/javascripts/modalfau.js\"></script>";

	$data['mnDataMasterLiParentClass']="class=\"nav-parent\"";
	$data['mnDataMasterLiDepartmentClass']="";
	$data['mnDataMasterLiDesignationClass']="";
	$data['mnDataMasterLiEmployeeClass']="";
  $data['mnDataMasterLiPegawaiClass']="";
  // $data['mnDataMasterLiInventoryClass']="class=\"nav-active\"";

  $data['mnHrmLiParentClass']="class=\"nav-parent\"";
	$data['mnHrmLiAbsenteeClass']="";
  $data['mnHrmliPengajuanClass']="";
  $data['mnHrmliManagerApproveClass']="";
//	$data['mnTransactionLiProjectsClass']="";
//	$data['mnTransactionLiBusnissBenefitsClass']="";
//	$data['mnTransactionLiMembersClass']="";

  $data['mnDataGALiParentClass']="class=\"nav-parent nav-expanded nav-active\"";
  $data['mnDataGALiInventoryClass']="class=\"nav-active\"";

  $data['mnDataBJBLiParentClass']="class=\"nav-parent\"";
	$data['mnDataBJBLiBankClass']="";
	$data['mnDataBJBLiInsuranceClass']="";
	$data['mnDataBJBLiProductClass']="";
  $data['mnDataBJBLiTransactionClass']="";


	$data['mnAdministratorLiParentClass']="class=\"nav-parent\"";
	$data['mnAdministratorLiGroupsClass']="";
	$data['mnAdministratorLiUsersClass']="";


	$data['mnToolsLiParentClass']="class=\"nav-parent\"";
	$data['mnToolsLiUploadAbsentClass']="";



	 $myDataSplitItem="ALL:-------------- ALL --------------,";
   $queryItem = $this->db->query($this->queryItem);
	 foreach ($queryItem->result() as $row)
		{
		  $myDataSplitItem.=$row->item_id.":".$row->item_name.",";
		}
		$data['myDataSplitItem']=substr($myDataSplitItem,0,strlen($myDataSplitItem)-1);


	 $myDataSplitCate="ALL:-------------- ALL --------------,";
   $queryCate = $this->db->query($this->queryCate);
	foreach ($queryCate->result() as $row)
		{
		  $myDataSplitCate.=$row->inventory_id.":".$row->inventory_name.",";
		}
		$data['myDataSplitCate']=substr($myDataSplitCate,0,strlen($myDataSplitCate)-1);


	    $this->load->view('pgInventoryVw', $data);

    }


   public function create(){
        $row = array();
 		    $id=$this->generateKey();
        $row['item_id'] = $id;
        // $row['item_id'] = $this->input->post("itemId");
        $row['item_name'] = $this->input->post("itemName");
        $row['item_qty'] = $this->input->post("itemQTY");
        $row['item_price'] = $this->input->post("itemPrice");
        $row['inventory_id'] = $this->input->post("itemCate");
        $row['status'] = $this->input->post("status");
        // $row['dt_etr'] = date('Y-m-d H:i:s');
        // $row['user_etr'] = $this->session->userdata('userId');
        // $row['dt_update'] = date('Y-m-d H:i:s');
        // $row['user_update'] = $this->session->userdata('userId');

        $this->db->insert($this->table, $row);
        redirect(site_url($this->linkController));
    }

  public function change($id){
        $row = array();
        //$row['group_id'] = $this->input->post("groupId");
      //  $row['employee_name'] = $this->input->post("employeeName");
        $row['item_name'] = $this->input->post("itemName");
        $row['item_qty'] = $this->input->post("itemQTY");
        $row['item_price'] = $this->input->post("itemPrice");
        $row['inventory_id'] = $this->input->post("myitemCate");
        $row['status'] = $this->input->post("mystatus");
        // $row['status'] = $this->input->post("mystatus");
        // $row['dt_update'] = date('Y-m-d H:i:s');
        // $row['user_update'] = $this->session->userdata('userId');
		$this->db->where("item_id", $id)->update($this->table, $row);
        redirect(site_url($this->linkController));
 /*
        $where = array('idusers'=>$iduser,'password'=>$password);

        $cek = $this->db->select('idusers')->where($where)->get("users");
        if($cek->num_rows() > 0){
            if($password_baru != $re_password_baru){
                $this->session->set_flashdata('message', "Password baru tidak cocok");
                redirect($this->linkController."/change_password/".$iduser, $data);
            }else{
                $data['success'] = true;
                $this->session->set_flashdata('message', "Sukses rubah password");
                $row['password'] = md5($password_baru);
                $this->db->where("idusers", $iduser)->update("users", $row);
                redirect($this->linkController."/change_password/".$iduser, $data);
            }
        }else{
            $this->session->set_flashdata('message', "Password Lama Salah");
            redirect($this->linkController."/change_password/".$iduser);
        }
*/
    }

    public function delete($id){
        $this->db->where($this->primary, $id);
        $this->db->delete($this->table);
        redirect(site_url($this->linkController));
    }

	public function generateKey($additional_string="",$additional_criteria="") {
		$currentdate=date("ym");

			$no_of_trailing=3;
			$string="IV";
			$query="select max(right(".$this->primary.",".$no_of_trailing.")) as max_id
				from ".$this->table." where left(".$this->primary.",". strlen($string) .") = '".$string."'";
			$myresult=$this->db->query($query);
			foreach ($myresult->result() as $row)
			{
				$id=($row->max_id)+1;
				$id=str_pad($id,$no_of_trailing,"0",STR_PAD_LEFT);
			};
		return $string.$id;
	}


}
