<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Bank extends CI_Controller {

    // Nama table
    private $table = "bjb_tm_bank";
    // Primary key table
    private $primary = "bank_id";
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
    private $linkController = "bank";

	// private $queryDepartment="select * from tm_department where status=1 order by department_name asc";
	private $queryBankParent="select * from bjb_tm_bank where status=1 and parent_id='' order by bank_name asc";

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('userId')) {
            redirect('login');
        }
    }

    public function index($offset = null) {

        $data['linkForm'] = site_url($this->linkController.'/create');
        $data['queryBankParent2'] = $this->db->query("select * from bjb_tm_bank where status=1 and parent_id='' order by bank_name asc")->result();
  	   $data['groups'] = $this->db->query("select a.*, case when a.status = 1 then 'Yes' when a.status=0 then 'No' end as my_status,b.bank_name as parent_bank
  		 from bjb_tm_bank a
       left outer join bjb_tm_bank b on a.parent_id=b.bank_id and b.parent_id=''
  		 where a.status in (1,0,9) order by bank_name ASC")->result();

		  // $data['departments'] = $this->db->query("select department_id,department_name from tm_department a  where a.status in (1,0,9) order by department_name ASC")->result();

   		$data['bankparents'] = $this->db->query("select bank_id,bank_name from bjb_tm_bank where status in (1,0,9) order by bank_name ASC")->result();


 		$data['tittlepage']="Bank";
		$data['cssVendorSpecific']="
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/select2/css/select2.css\" />
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/select2-bootstrap-theme/select2-bootstrap.css\" />
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/jquery-datatables-bs3/assets/css/datatables.css\" />
		";

		$data['userName']=$this->session->userdata('userName');
		$data['fullname']=$this->session->userdata('userFullName');

		$data['titleContent']="Bank";
		$data['LeftCaption']="<li>
									<a href=\"".site_url('headline')."\">
										<i class=\"fa fa-home\"></i>
									</a>
								</li>
								<li><span>BJB</span></li>
								<li><span>Bank</span></li>
								";
		$data['titleTable']="Bank with details";


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

  $data['mnDataBJBLiParentClass']="class=\"nav-parent nav-expanded nav-active\"";
	$data['mnDataBJBLiBankClass']="class=\"nav-active\"";
	$data['mnDataBJBLiInsuranceClass']="";
	$data['mnDataBJBLiProductClass']="";
  $data['mnDataBJBLiTransactionClass']="";

	$data['mnAdministratorLiParentClass']="class=\"nav-parent\"";
	$data['mnAdministratorLiGroupsClass']="";
	$data['mnAdministratorLiUsersClass']="";


	$data['mnToolsLiParentClass']="class=\"nav-parent\"";
	$data['mnToolsLiUploadAbsentClass']="";

  // $data["getbankId"]='';

	$myDataSplitBankParent="ALL:-------------- ALL --------------,";
  $queryBankParent = $this->db->query($this->queryBankParent);
	foreach ($queryBankParent->result() as $row)
		{
		  $myDataSplitBankParent.=$row->bank_id.":".$row->bank_name.",";
		}
		$data['myDataSplitBankParent']=substr($myDataSplitBankParent,0,strlen($myDataSplitBankParent)-1);

	    $this->load->view('pgBankVw', $data);

    }

    public function create(){
         $row = array();
    /*       for ($i = 0; $i < count($this->fields); $i++) {
             $row[$this->fields[$i]] = $this->input->post($this->fields[$i]);
         }
    */	$id=$this->generateKey();
        $row['bank_id'] = $id;
        $row['parent_id'] = $this->input->post("parentId");
        $row['bank_name'] = $this->input->post("bankName");
        $row['address'] = $this->input->post("address");
        $row['telp'] = $this->input->post("telp");
        $row['fax'] = $this->input->post("fax");
        $row['description'] = $this->input->post("description");
        $row['status'] = $this->input->post("status");
        // $row['department_id'] = $this->input->post("departmentId");
        // $row['designation_id'] = $this->input->post("designationId");
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
      //  $row['employee_name'] = $this->input->post("employeeName");
      if ($this->input->post("myParent")=="ALL") {

      } else {
        $row['parent_id'] = $this->input->post("myParent");

      }
        $row['bank_name'] = $this->input->post("bankName");
        $row['address'] = $this->input->post("address");
        $row['telp'] = $this->input->post("telp");
        $row['fax'] = $this->input->post("fax");
        $row['description'] = $this->input->post("description");
        $row['status'] = $this->input->post("mystatus");
        $row['dt_update'] = date('Y-m-d H:i:s');
        $row['user_update'] = $this->session->userdata('userId');
		$this->db->where("bank_id", $id)->update($this->table, $row);
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

			$no_of_trailing=7;
			$string="BNK-";
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
