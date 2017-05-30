<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class User extends CI_Controller {

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
    private $linkController = "user";
    
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('userId')) {
            redirect('login');
        }
		 $this->load->model('mod_user_group');

    }

    public function index($offset = null) {
/*
        $datatable_fields = array(
                    'ID', 
                    'Menu',
                    'Parent',
                    'Prioritas',
                    'Lihat',
                    'Edit',
                    'Hapus'
                    );
        $data['contentPage'] = "table";
        $data['contentTitle'] = "Menu";
        $data['mainMenu'] = "halamanutama";
        $data['subMenu'] = "menu";
        $data['linkDatatable'] = site_url($this->linkController.'/lists');
        $data['linkAdd'] = site_url($this->linkController.'/add');
        $data['datatableFields'] = $datatable_fields;
*/	
        $data['linkForm'] = site_url($this->linkController.'/create');
   		$data['users'] = $this->db->query("select a.*,case when a.status = 1 then 'Yes' when a.status=0 then 'No' end as my_status,b.group_name from tm_users a inner join tm_user_groups b on a.group_id= b.group_id where a.status in (1,0,9) order by user_name ASC")->result();

 		$data['tittlepage']="Master User";
		$data['cssVendorSpecific']="
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/select2/css/select2.css\" />
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/select2-bootstrap-theme/select2-bootstrap.css\" />
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/jquery-datatables-bs3/assets/css/datatables.css\" />
		";
	
		$data['userName']=$this->session->userdata('userName');
		$data['fullname']=$this->session->userdata('userFullName');
 
		$data['titleContent']="Master User";
		$data['LeftCaption']="<li>
									<a href=\"".site_url('headline')."\">
										<i class=\"fa fa-home\"></i>
									</a>
								</li>
								<li><span>Administrator</span></li>
								<li><span>Users</span></li>
								";
		$data['titleTable']="User data with details";

      
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
	$data['mnDataMasterLiGroupsClass']="";
	$data['mnDataMasterLiRelationClass']="";
	$data['mnDataMasterLiBenefitTypeClass']="";
	$data['mnDataMasterLiBenefitClass']="";
	
	
	$data['mnTransactionLiParentClass']="class=\"nav-parent\"";
	$data['mnTransactionLiCustomersClass']="";
	$data['mnTransactionLiProjectsClass']="";
	$data['mnTransactionLiBusnissBenefitsClass']="";
	$data['mnTransactionLiMembersClass']="";
	
	$data['mnAdministratorLiParentClass']="class=\"nav-parent  nav-expanded nav-active\"";
	$data['mnAdministratorLiGroupsClass']="";
	$data['mnAdministratorLiUsersClass']="class=\"nav-active\"";

	$data['user_groups']=$this->mod_user_group->getAllGroups();


	    $this->load->view('pgUserVw', $data);

    }
  
	
   public function create(){
        $row = array();
 /*       for ($i = 0; $i < count($this->fields); $i++) {
            $row[$this->fields[$i]] = $this->input->post($this->fields[$i]);
        }
 */	 $id=$this->generateKey();
        $row['user_id'] = $id;
        $row['user_name'] = $this->input->post("userName");
        $row['user_full_name'] = $this->input->post("userFullName");
        $row['password'] = md5($this->input->post("userName")."123");
        $row['email'] = $this->input->post("email");
        $row['group_id'] = $this->input->post("groupId");
        $row['last_login'] =date('Y-m-d H:i:s');
        $row['last_change_password'] = date('Y-m-d H:i:s');
        $row['status'] = $this->input->post("status");
        $row['dt_etr'] = date('Y-m-d H:i:s');
        $row['user_etr'] = $this->session->userdata('userId');
        $row['dt_update'] = date('Y-m-d H:i:s');
        $row['user_update'] = $this->session->userdata('userId');
		
        $this->db->insert($this->table, $row);
        redirect(site_url($this->linkController));
    }
	
  public function change($id){
        $row = array();
        //$row['group_id'] = $this->input->post("groupId");
        $row['user_full_name'] = $this->input->post("userFullName");
        $row['email'] = $this->input->post("email");
        $row['group_id'] = $this->input->post("groupId");
        $row['status'] = $this->input->post("mystatus");
        $row['dt_update'] = date('Y-m-d H:i:s');
        $row['user_update'] = $this->session->userdata('userId');
		$this->db->where("user_id", $id)->update($this->table, $row);
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