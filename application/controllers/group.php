<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class group extends CI_Controller {

    // Nama table
    private $table = "tm_groups";
    // Primary key table
    private $primary = "group_id";
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
    private $linkController = "group";
    
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('userId')) {
            redirect('login');
        }
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
   		$data['groups'] = $this->db->query("select a.*,case when status = 1 then 'Yes' when status=0 then 'No' end as my_status from tm_groups a where status in (1,0,9) order by group_name ASC")->result();

 		$data['tittlepage']="Master Group";
		$data['cssVendorSpecific']="
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/select2/css/select2.css\" />
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/select2-bootstrap-theme/select2-bootstrap.css\" />
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/jquery-datatables-bs3/assets/css/datatables.css\" />
		";
	
		$data['userName']=$this->session->userdata('userName');
		$data['fullname']=$this->session->userdata('userFullName');
 
		$data['titleContent']="Master Group";
		$data['LeftCaption']="<li>
									<a href=\"".site_url('headline')."\">
										<i class=\"fa fa-home\"></i>
									</a>
								</li>
								<li><span>Data Master</span></li>
								<li><span>Group</span></li>
								";
		$data['titleTable']="Group data with details";

      
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

	$data['mnDataMasterLiParentClass']="class=\"nav-parent nav-expanded nav-active\"";
	$data['mnDataMasterLiGroupsClass']="class=\"nav-active\"";
	$data['mnDataMasterLiRelationClass']="";
	$data['mnDataMasterLiBenefitTypeClass']="";
	$data['mnDataMasterLiBenefitClass']="";
	
	$data['mnTransactionLiParentClass']="class=\"nav-parent\"";
	$data['mnTransactionLiCustomersClass']="";
	$data['mnTransactionLiProjectsClass']="";
	$data['mnTransactionLiBusnissBenefitsClass']="";
	$data['mnTransactionLiMembersClass']="";
	
	$data['mnAdministratorLiParentClass']="class=\"nav-parent\"";
	$data['mnAdministratorLiGroupsClass']="";
	$data['mnAdministratorLiUsersClass']="";
	
	    $this->load->view('pgGroupVw', $data);

    }
  
	
   public function create(){
        $row = array();
 /*       for ($i = 0; $i < count($this->fields); $i++) {
            $row[$this->fields[$i]] = $this->input->post($this->fields[$i]);
        }
 */	 $id=$this->generateKey();
        $row['group_id'] = $id;
        $row['group_name'] = $this->input->post("groupName");
        $row['description'] = $this->input->post("description");
        $row['status'] = $this->input->post("status");
        $row['dt_etr'] = date('Y-m-d H:i:s');
        $row['user_etr'] = $this->session->userdata('userId');
        $row['dt_update'] = date('Y-m-d H:i:s');
        $row['user_update'] = $this->session->userdata('userId');
		if (strlen($this->input->post("groupName"))==0){
			$this->session->set_flashdata('message', "<font style=\"color:#1598da;font-size:34px;\"><i class=\"fa fa-minus-square\"></i></font><font style=\"color:#1598da;\">  Group name can not empty</font>");
		}else{
	        $this->db->insert($this->table, $row);
			$this->session->set_flashdata('message', "<font style=\"color:#1598da;font-size:34px;\"><i class=\"fa fa-check-square\"></i></font><font style=\"color:#1598da;\">  Data has been saved successfully</font>");
		}
			 redirect(site_url($this->linkController));
		//$this->session->set_flashdata('message', "<font style=\"color:#1598da;\">Untuk tahap selanjutnya silahkan klik icon</font> <i class=\"fa fa-trash-o\"></i>");
       
    }
	
  public function change($id){
        $row = array();
        //$row['group_id'] = $this->input->post("groupId");
        $row['group_name'] = $this->input->post("groupName");
        $row['description'] = $this->input->post("description");
        $row['status'] = $this->input->post("mystatus");
        $row['dt_update'] = date('Y-m-d H:i:s');
        $row['user_update'] = $this->session->userdata('userId');
		if (strlen($this->input->post("groupName"))==0){
			$this->session->set_flashdata('message', "<font style=\"color:#1598da;font-size:34px;\"><i class=\"fa fa-minus-square\"></i></font><font style=\"color:#1598da;\">  Group name can not empty</font>");
		}else{
			$this->db->where("group_id", $id)->update("tm_groups", $row);
			$this->session->set_flashdata('message', "<font style=\"color:#1598da;font-size:34px;\"><i class=\"fa fa-check-square\"></i></font><font style=\"color:#1598da;\">  Data has been saved successfully</font>");
		}

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
			$this->session->set_flashdata('message', "<font style=\"color:#1598da;font-size:34px;\"><i class=\"fa fa-check-square\"></i></font><font style=\"color:#1598da;\">  Data has been deleted successfully</font>");
        redirect(site_url($this->linkController));
    }
	
	public function generateKey($additional_string="",$additional_criteria="") {
		$currentdate=date("ym");

			$no_of_trailing=3;
			$string="G";
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