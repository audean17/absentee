<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class user extends CI_Controller {

    // Nama table
    private $table = "tm_users";
    // Primary key table
    private $primary = "user_id";
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


	private $queryUser="select a.*,case when a.status=1 then 'Yes' else 'NO' end as status_desc,b.group_name as group_name,employee_first_name,employee_last_name
	from  tm_users a
	inner join tm_user_groups b on a.group_id=b.group_id
	left outer join tm_employee c on a.employee_id=c.employee_id
	order by user_name DESC";
	private $queryGroupUser="select a.*  from  tm_user_groups a order by group_id asc";
	private $queryEmployee="select a.*  from  tm_employee a order by employee_id asc";
    private $linkController = "user";

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('userId')) {
            redirect('login');
        }
		//$this->load->model('mod_benefit_type');
    }

    public function index($offset = null) {

 	    $data['linkForm'] = site_url($this->linkController.'/create');
 	    $data['linkFormDetail'] = site_url($this->linkController.'/createDetail');

 		$data['listUser'] = $this->db->query($this->queryUser)->result();
 		$data['conGroupUser'] = $this->db->query($this->queryGroupUser)->result();
 		$data['conEmployee'] = $this->db->query($this->queryEmployee)->result();

	  	$myDataSplitGroup="";
    	$queryGroup = $this->db->query($this->queryGroupUser);
		foreach ($queryGroup->result() as $row)
		{
		  $myDataSplitGroup.=$row->group_id.":".$row->group_name.",";
		}
		$myDataSplitGroup=substr($myDataSplitGroup,0,strlen($myDataSplitGroup)-1);

 		$data['myDataSplitGroup']=$myDataSplitGroup;
 		$data['tittlepage']="User";
		$data['cssVendorSpecific']="
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/select2/css/select2.css\" />
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/select2-bootstrap-theme/select2-bootstrap.css\" />
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/jquery-datatables-bs3/assets/css/datatables.css\" />
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css\" />
		";

		$data['userName']=$this->session->userdata('userName');
		$data['fullname']=$this->session->userdata('userFullName');
 		$mylink=site_url($this->linkController);
 		$data['titleContent']="User";
		$data['LeftCaption']="<li>
									<a href=\"".site_url('headline')."\">
										<i class=\"fa fa-home\"></i>
									</a>
								</li>
								<li><span>Data Master</span></li>
								<li><span>User</span></li>
								";
		$data['titleTable']="Data User";



	  $data['vendorJavascript']="
		<script src=\"".base_url()."assets/porto/vendor/select2/js/select2.js\"></script>
		<script src=\"".base_url()."assets/porto/vendor/jquery-datatables/media/js/jquery.dataTables.js\"></script>
		<script src=\"".base_url()."assets/porto/vendor/jquery-datatables-bs3/assets/js/datatables.js\"></script>
		<script src=\"".base_url()."assets/porto/vendor/autosize/autosize.js\"></script>
		<script src=\"".base_url()."assets/porto/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js\"></script>
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

	$data['mnDataMasterLiParentClass']="class=\"nav-parent\"";
	$data['mnDataMasterLiDepartmentClass']="";
	$data['mnDataMasterLiDesignationClass']="";
	$data['mnDataMasterLiEmployeeClass']="";
  $data['mnDataMasterLiPegawaiClass']="";

	$data['mnHrmLiParentClass']="class=\"nav-parent\"";
	$data['mnHrmLiAbsenteeClass']="";
  $data['mnHrmliPengajuanClass']="";
  $data['mnHrmliManagerApproveClass']="";
//	$data['mnTransactionLiProjectsClass']="";
//	$data['mnTransactionLiBusnissBenefitsClass']="";
//	$data['mnTransactionLiMembersClass']="";

  $data['mnDataGALiParentClass']="class=\"nav-parent\"";
  $data['mnDataGALiInventoryClass']="";

  $data['mnDataBJBLiParentClass']="class=\"nav-parent\"";
	$data['mnDataBJBLiBankClass']="";
	$data['mnDataBJBLiInsuranceClass']="";
	$data['mnDataBJBLiProductClass']="";
  $data['mnDataBJBLiTransactionClass']="";

	$data['mnAdministratorLiParentClass']="class=\"nav-parent nav-expanded nav-active\"";
	$data['mnAdministratorLiGroupsClass']="";
	$data['mnAdministratorLiUsersClass']="class=\"nav-active\"";


	$data['mnToolsLiParentClass']="class=\"nav-parent\"";
	$data['mnToolsLiUploadAbsentClass']="";


	$data['getUserId']="";
	$data['getUserName']="";
	$data['getFullName']="";
	$data['getEmail']="";
	$data['getAllProvinsiAlowed']="0";
	$data['getRemark']="";
	$data['getFullName']="";

	$data['getGroupId']="";
	$data['getStatus']="1";


	    $this->load->view('pgUserVw', $data);

    }



    public function getData() {
 		redirect(site_url($this->linkController."/retrive/".$this->input->post("userIdforSearch")));
	}



   public function create(){
        $row = array();
		$strUserName=$this->input->post("userName");
		$strGroupId=$this->input->post("groupId");
		if (strlen($strUserName)==0 || $strUserName == ""  || $strUserName == "-1" ){
            $msg = "Nama User harus di isi. ";



		}elseif (strlen($strGroupId)==0 || $strGroupId == ""  || $strGroupId == "-1" ){
            $msg = "Group user harus dipilih. ";

        } else {
		    try {
					$id=$this->generateKey();


					$row['user_id'] = $id;
					$row['user_name'] = $this->input->post("userName");
					$row['group_id'] = $this->input->post("groupId");
 					$row['employee_id'] = $this->input->post("employeeId");
					$row['email'] = $this->input->post("emailAddress");
					$row['all_employee_allowed'] = $this->input->post("allEmployeeAllowed");
					$row['remark'] = $this->input->post("remark");
					$row['status'] = 1;
					$row['dt_etr'] = date('Y-m-d H:i:s');
					$row['user_etr'] = $this->session->userdata('userId');
					$row['dt_update'] = date('Y-m-d H:i:s');
					$row['user_update'] = $this->session->userdata('userId');
       				$row['password'] = md5($this->input->post("userName")."123");

					$this->db->insert($this->table, $row);

			 } catch (exception $e) {

            }

		}

		 redirect(site_url($this->linkController));

    }



  public function change($id){
        $row = array();

		$row['user_id'] = $id;

		$row['user_name'] = $this->input->post("userName");
		$row['group_id'] = $this->input->post("groupId");
//		$row['employee_id'] = $this->input->post("employeeId");
 		$row['email'] = $this->input->post("email");
		$row['all_employee_allowed'] = $this->input->post("employeeAllowed");
		$row['remark'] = $this->input->post("remark");
		$row['status'] = $this->input->post("mystatus");
		$row['dt_update'] = date('Y-m-d H:i:s');
		$row['user_update'] = $this->session->userdata('userId');

		$this->db->where("user_id", $id)->update($this->table, $row);

		redirect(site_url($this->linkController));

    }


     public function delete($id){
        $this->db->where($this->primary, $id);
        $this->db->delete($this->table);
        redirect(site_url($this->linkController));
    }



	public function generateKey($additional_string="",$additional_criteria="") {
		$currentdate=date("Ym");

			$no_of_trailing=3;
			$string="USR-".$currentdate;
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
