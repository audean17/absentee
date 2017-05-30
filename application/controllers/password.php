<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Password extends CI_Controller {

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
    private $linkController = "password";

	// private $queryDepartment="select * from tm_department where status=1 order by department_name asc";
	private $queryPassword="select * from tm_users where status=1 order by users_name asc";

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('userId')) {
            redirect('login');
        }
    }

    public function index($offset = null) {

        $data['linkForm'] = site_url($this->linkController.'/change_password');
      //   $data['queryBankParent2'] = $this->db->query("select * from bjb_tm_bank where status=1 and parent_id='' order by bank_name asc")->result();
  	  //  $data['groups'] = $this->db->query("select a.*, case when a.status = 1 then 'Yes' when a.status=0 then 'No' end as my_status,b.bank_name as parent_bank
  		//  from bjb_tm_bank a
      //  left outer join bjb_tm_bank b on a.parent_id=b.bank_id and b.parent_id=''
  		//  where a.status in (1,0,9) order by bank_name ASC")->result();
      //
   	// 	$data['bankparents'] = $this->db->query("select bank_id,bank_name from bjb_tm_bank where status in (1,0,9) order by bank_name ASC")->result();

 		$data['tittlepage']="Bank";
		$data['cssVendorSpecific']="
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/select2/css/select2.css\" />
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/select2-bootstrap-theme/select2-bootstrap.css\" />
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/jquery-datatables-bs3/assets/css/datatables.css\" />
		";

		$data['userName']=$this->session->userdata('userName');
		$data['fullname']=$this->session->userdata('userFullName');

		$data['titleContent']="Change Password";
		$data['LeftCaption']="<li>
									<a href=\"".site_url('headline')."\">
										<i class=\"fa fa-home\"></i>
									</a>
								</li>
								<li><span>Change Password</span></li>
								";
		$data['titleTable']="Change Password";

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

	$data['mnAdministratorLiParentClass']="class=\"nav-parent\"";
	$data['mnAdministratorLiGroupsClass']="";
	$data['mnAdministratorLiUsersClass']="";


	$data['mnToolsLiParentClass']="class=\"nav-parent\"";
	$data['mnToolsLiUploadAbsentClass']="";

	    $this->load->view('pgPasswordVw', $data);

    }

    public function change_password($id){
          $row = array();
          //$row['group_id'] = $this->input->post("groupId");
        //  $row['department_name'] = $this->input->post("departmentName");
          $row['user_name'] = $this->input->post("username");
          $row['email'] = $this->input->post("email");
          $row['password'] = $this->input->post("password");
  		$this->db->where("user_id", $id)->update($this->table, $row);
          redirect(site_url($this->linkController));
          }



}
