<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class departmentDetail extends CI_Controller {

    // Nama table
    private $table = "department_detail";
    // Primary key table
    private $primary = "department_detail_id";
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
    private $linkController = "departmentDetail";
    private $linkControllerNext = "objects";
    private $linkControllerPrev = "department";
    
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('userId')) {
            redirect('login');
        }
		//$this->load->model('mod_benefit_type');
    }

    public function index($offset = null) {
	
        $data['linkForm'] = site_url($this->linkController.'/create');
        $data['linkFormDepartment'] = site_url($this->linkControllerPrev.'/create/fromDepartmentDetail');
        $data['linkSearch'] = site_url($this->linkController.'/getDataDepartment');
   		$data['departments'] = $this->db->query("select department_id,department_name from department a  where a.status in (1,0,9) order by department_name ASC")->result();

 		$data['tittlepage']="Department Detail";
		$data['cssVendorSpecific']="
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/select2/css/select2.css\" />
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/select2-bootstrap-theme/select2-bootstrap.css\" />
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/jquery-datatables-bs3/assets/css/datatables.css\" />
		";
	
		$data['userName']=$this->session->userdata('userName');
		$data['fullname']=$this->session->userdata('userFullName');
 
		$data['titleContent']="Department Detail";
		$data['LeftCaption']="<li>
									<a href=\"".site_url('headline')."\">
										<i class=\"fa fa-home\"></i>
									</a>
								</li>
								<li><span>Data Master</span></li>
								<li><span>Department Detail</span></li>
								";
		$data['titleTable']="Data Department Detail";

      
	  $data['vendorJavascript']="
		<script src=\"".base_url()."assets/porto/vendor/select2/js/select2.js\"></script>
		<script src=\"".base_url()."assets/porto/vendor/jquery-datatables/media/js/jquery.dataTables.js\"></script>
		<script src=\"".base_url()."assets/porto/vendor/jquery-datatables-bs3/assets/js/datatables.js\"></script>
	  ";

/*
		<script src=\"".base_url()."assets/porto/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js\"></script>

*/


/*	  $data['vendorJavascriptExample']="
		<script src=\"".base_url()."assets/porto/javascripts/tables/examples.datatables.default.js\"></script>
		<script src=\"".base_url()."assets/porto/javascripts/tables/examples.datatables.row.with.details.js\"></script>
		<script src=\"".base_url()."assets/porto/javascripts/tables/examples.datatables.tabletools.js\"></script>
	  ";
*/
	$data['vendorJavascriptExample']="
		<script src=\"".base_url()."assets/porto/javascripts/tables/examples.datatables.ajax.js\"></script>
		
		<script src=\"".base_url()."assets/porto/javascripts/ui-elements/examples.modals.js\"></script>
	";	     
/*
		<script src=\"".base_url()."assets/porto/javascripts/tables/examples.datatables.default.js\"></script>
*/
	$data['modalfau']="
	 <link rel=\"stylesheet\" href=\"".base_url()."assets/porto/stylesheets/modalfau.css\">
	<script src=\"".base_url()."assets/porto/javascripts/modalfau.js\"></script>";

	$data['mnDataMasterLiParentClass']="class=\"nav-parent nav-expanded nav-active\"";
	$data['mnDataMasterLiDepartmentClass']="";
	$data['mnDataMasterLiDepartmentDetailClass']="class=\"nav-active\"";
	$data['mnDataMasterLiObjectsClass']="";
	$data['mnDataMasterLiCategoriesClass']="";
	$data['mnDataMasterLiProductsClass']="";
	
	
	$data['mnTransactionLiParentClass']="class=\"nav-parent\"";
	$data['mnTransactionLiPurchaseClass']="";
	$data['mnTransactionLiProjectsClass']="";
	$data['mnTransactionLiBusnissBenefitsClass']="";
	$data['mnTransactionLiMembersClass']="";
	
	
	$data['mnAdministratorLiParentClass']="class=\"nav-parent\"";
	$data['mnAdministratorLiGroupsClass']="";
	$data['mnAdministratorLiUsersClass']="";
	
	
//	$data['benefit_type']=$this->mod_benefit_type->getAllBenefitType();

	
	    $this->load->view('pgDepartmentDetailVw', $data);

    }
  

    public function getDataDepartment() {
		//die("ok2: ".$this->input->post("customerIdforSearch"));
 			     redirect(site_url($this->linkController."/department/".$this->input->post("departmentIdforSearch")));
	}
	
    public function department($departmentId) {
//		die("f". $departmentId);
	    $data['linkForm'] = site_url($this->linkController.'/create');
        $data['linkFormDepartment'] = site_url($this->linkControllerPrev.'/create/fromDepartmentDetail');
        $data['linkSearch'] = site_url($this->linkController.'/getDataDepartment');
   		$data['departments'] = $this->db->query("select department_id,department_name from department a  where a.status in (1,0,9) order by department_name ASC")->result();

 		$data['tittlepage']="Department Detail";
		$data['cssVendorSpecific']="
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/select2/css/select2.css\" />
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/select2-bootstrap-theme/select2-bootstrap.css\" />
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/jquery-datatables-bs3/assets/css/datatables.css\" />
		";
	
		$data['userName']=$this->session->userdata('userName');
		$data['fullname']=$this->session->userdata('userFullName');
 
		$data['titleContent']="Department Detail";
		$data['LeftCaption']="<li>
									<a href=\"".site_url('headline')."\">
										<i class=\"fa fa-home\"></i>
									</a>
								</li>
								<li><span>Data Master</span></li>
								<li><span>Department Detail</span></li>
								";
		$data['titleTable']="Data Department Detail";

      
	  $data['vendorJavascript']="
		<script src=\"".base_url()."assets/porto/vendor/select2/js/select2.js\"></script>
		<script src=\"".base_url()."assets/porto/vendor/jquery-datatables/media/js/jquery.dataTables.js\"></script>
		<script src=\"".base_url()."assets/porto/vendor/jquery-datatables-bs3/assets/js/datatables.js\"></script>
	  ";


	$data['vendorJavascriptExample']="
		<script src=\"".base_url()."assets/porto/javascripts/tables/examples.datatables.ajax.js\"></script>
		
		<script src=\"".base_url()."assets/porto/javascripts/ui-elements/examples.modals.js\"></script>
	";	     

	$data['modalfau']="
	 <link rel=\"stylesheet\" href=\"".base_url()."assets/porto/stylesheets/modalfau.css\">
	<script src=\"".base_url()."assets/porto/javascripts/modalfau.js\"></script>";

	$data['mnDataMasterLiParentClass']="class=\"nav-parent nav-expanded nav-active\"";
	$data['mnDataMasterLiDepartmentClass']="";
	$data['mnDataMasterLiDepartmentDetailClass']="class=\"nav-active\"";
	$data['mnDataMasterLiObjectsClass']="";
	$data['mnDataMasterLiCategoriesClass']="";
	$data['mnDataMasterLiProductsClass']="";
	
	
	$data['mnTransactionLiParentClass']="class=\"nav-parent\"";
	$data['mnTransactionLiPurchaseClass']="";
	$data['mnTransactionLiProjectsClass']="class=\"nav-active\"";
	$data['mnTransactionLiBusnissBenefitsClass']="";
	$data['mnTransactionLiMembersClass']="";
	
	
	$data['mnAdministratorLiParentClass']="class=\"nav-parent\"";
	$data['mnAdministratorLiGroupsClass']="";
	$data['mnAdministratorLiUsersClass']="";
	
/*send parameter*/
      $query = $this->db->query("select a.* from department a  where department_id='".$departmentId."'");
		foreach ($query->result() as $row){
		  $data["getDepartmentId"]=$row->department_id;
		  $data["getDepartmentName"]=$row->department_name;
		  $data["getDescription"]=$row->description;
		}
	    $this->load->view('pgDepartmentDetailVw', $data);

    }
  


	
   public function create(){
        $row = array();
 /*       for ($i = 0; $i < count($this->fields); $i++) {
            $row[$this->fields[$i]] = $this->input->post($this->fields[$i]);
        }
 */	 $id=$this->generateKey();
        $row['department_detail_id'] = $id;
        $row['department_id'] = $this->input->post("departmentId");
        $row['department_detail_name'] = $this->input->post("departmentDetailName");
		
 
		
        //$row['end_polis'] = $this->input->post("endPolis");
        $row['description'] = $this->input->post("description");
        $row['status'] = $this->input->post("status");
        $row['dt_etr'] = date('Y-m-d H:i:s');
        $row['user_etr'] = $this->session->userdata('userId');
        $row['dt_update'] = date('Y-m-d H:i:s');
        $row['user_update'] = $this->session->userdata('userId');
		
        $this->db->insert($this->table, $row);
        //redirect(site_url($this->linkController));
 		redirect(site_url($this->linkController."/department/".$this->input->post("departmentId")));
    }
	
  public function change($id){
        $row = array();
        $row['department_detail_name'] = $this->input->post("departmentDetailName");
		
        //$row['end_polis'] = $this->input->post("endPolis");
        $row['description'] = $this->input->post("description");
        $row['status'] = $this->input->post("mystatus");
        $row['dt_update'] = date('Y-m-d H:i:s');
        $row['user_update'] = $this->session->userdata('userId');
		$this->db->where("department_detail_id", $id)->update($this->table, $row);
//        redirect(site_url($this->linkController));
 		redirect(site_url($this->linkController."/department/".$this->input->post("departmentId")));
		
    }

    public function delete($id){
      $query = $this->db->query("select department_id from department_detail   where department_detail_id='".$id."'");
		foreach ($query->result() as $row){
		  $departmentId=$row->department_id;
		}

        $this->db->where($this->primary, $id);
        $this->db->delete($this->table);
        //redirect(site_url($this->linkController));
		redirect(site_url($this->linkController."/department/".$departmentId));

    }
	
	public function generateKey($additional_string="",$additional_criteria="") {
		$currentdate=date("ym");

			$no_of_trailing=3;
			$string="DD-".$currentdate;
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
	
 
  

public function get_data($departmentId){
	$aaData = array();

	if ($departmentId=="naura") {
      $query = $this->db->query("select a.*,case when a.status = 1 then 'Yes' when a.status=0 then 'No' end as my_status,b.department_name   from  department_detail a  inner join department b on a.department_id=b.department_id  order by department_detail_id ASC");
	} else { 
      $query = $this->db->query("select a.*,case when a.status = 1 then 'Yes' when a.status=0 then 'No' end as my_status,b.department_name   from  department_detail a  inner join department b on a.department_id=b.department_id where a.department_id='".$departmentId."' order by department_detail_id ASC");
	}

	foreach ($query->result() as $row)
    {
		$myDataSplit=$row->department_detail_id."|".$row->department_detail_name."|".$row->department_name."|".$row->description."|".$row->status."|".$row->department_id;
		$myEdit="<a href=\"http://fauzan.net\" onclick=\"javascript:showFormEditDepartmentDetail('".site_url($this->linkController."/change/".$row->department_detail_id)."','".$myDataSplit."');return false;\"  title=\"Edit for this row\"><i class=\"fa fa-pencil\"></i></a>&nbsp;";
		$myDelete="<a href=\"http://fauzan.net\" onclick=\"javascript:confirmationAlert('".site_url($this->linkController."/delete/".$row->department_detail_id)."','Are you sure you want to delete this row?');return false;\"  title=\"Delete for this row\"><i class=\"fa fa-trash-o\"></i></a>&nbsp;";
		$myNext="<a href=\"".site_url($this->linkControllerNext."/departmentDetail/".$row->department_detail_id)."\" title=\"step to Object\"><i class=\"glyphicon glyphicon-step-forward\"></i></a>&nbsp;";
				$aaData[] = array($row->department_detail_id,$row->department_detail_name,$row->department_name,$row->description,$row->my_status,$myEdit." &nbsp;&nbsp;&nbsp;&nbsp;".$myDelete." &nbsp;&nbsp;&nbsp;&nbsp;".$myNext);
    } 
        echo "{ \"aaData\": " .json_encode($aaData)."}";
   }  
 
}