<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Pengajuan extends CI_Controller {

    // Nama table
    private $table = "tp_absentee";
    // Primary key table
    private $primary = "designation_id";
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
    private $linkController = "pengajuan";

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('userId')) {
            redirect('login');
        }
    }

    public function index($offset = null) {

        $data['linkForm'] = site_url($this->linkController.'/create');
         $data['linkSearch'] = site_url($this->linkController.'/retrive');
		  $clausa="";
		 if ($this->session->userdata('allEmployeeAllowed')==1){
			 $clausa="";
		 }else {
			  $clausa.=" and b.department_id='".$this->session->userdata('departmentId')."'";
		 }
  		$data['listAbsentee'] = $this->db->query("select DISTINCT DATE_FORMAT(a.date,'%Y%m') as year,
DATE_FORMAT(a.date,'%M %Y') as periode, a.employee_id, b.employee_first_name,
b.employee_last_name,department_name,designation_name,d.is_cut_absentee,d.is_overtime,
case when d.is_cut_absentee =1 then 'YES' else 'NO' end absent_status,
case when d.is_overtime =1 then 'YES' else 'NO' end overtime_status
from tp_absentee a
inner join tm_employee b on a.employee_id = b.employee_id
inner join tm_department c on b.department_id = c.department_id
inner join tm_designation d on b.designation_id = d.designation_id
where b.department_id not in ('DP001','DP009')	" .$clausa. "
order by employee_first_name	 ASC")->result();

   		$data['departments'] = $this->db->query("select department_id,department_name
		from tm_department b
		where b.status in (1) 	" .$clausa. "  order by department_name ASC")->result();

  		$data['periods'] = $this->db->query("select periode_id,
CONCAT(CAST(MONTHNAME(STR_TO_DATE(a.month, '%m')) AS CHAR CHARACTER SET utf8),' ' ,CAST(year AS CHAR CHARACTER SET utf8))
 as periode_name from  tp_absentee_periode a  where a.status in (1) order by periode_id ASC")->result();

 		$data['tittlepage']="Pengajuan Lembur";
		$data['cssVendorSpecific']="
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/select2/css/select2.css\" />
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/select2-bootstrap-theme/select2-bootstrap.css\" />
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/jquery-datatables-bs3/assets/css/datatables.css\" />
		";

		$data['userName']=$this->session->userdata('userName');
		$data['fullname']=$this->session->userdata('userFullName');

		$data['titleContent']="Pengajuan Lembur";
		$data['LeftCaption']="<li>
									<a href=\"".site_url('headline')."\">
										<i class=\"fa fa-home\"></i>
									</a>
								</li>
								<li><span>HRM</span></li>
								<li><span>Pengajuan Lembur</span></li>
								";
		$data['titleTable']="Pengajuan Lembur Karyawan";


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

	$data['mnHrmLiParentClass']="class=\"nav-parent nav-expanded nav-active\"";
	$data['mnHrmLiAbsenteeClass']="";
  $data['mnHrmliPengajuanClass']="class=\"nav-active\"";
  $data['mnHrmliManagerApproveClass']="";
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
	$data['typePage']="header";


	    $this->load->view('pgPengajuanVw', $data);

    }


    public function retrive() {

		$periodeId=$this->input->post("periodeId");
		$departmentId=$this->input->post("departmentId");


		 $clausa_b="";
		if ($this->session->userdata('allEmployeeAllowed')==1){
			 $clausa_b="";
		 }else {
			  $clausa_b.=" and b.department_id='".$this->session->userdata('departmentId')."' ";
		 }


		$clausa= "";
		if (strlen($periodeId)==0 || $periodeId == ""  || $periodeId == "-1" ){
			$clausa.= " ";
		}else{
			$clausa.= " and DATE_FORMAT(a.date,'%Y%m')='".$periodeId."' ";

		}


		if (strlen($departmentId)==0 || $departmentId == ""  || $departmentId == "-1" ){
			$clausa.= " ";
		}else{
			$clausa.= " and b.department_id='".$departmentId."'";

		}

		   $data['linkForm'] = site_url($this->linkController.'/create');
			$data['listAbsentee'] = $this->db->query("select DISTINCT DATE_FORMAT(a.date,'%Y%m') as year,
	DATE_FORMAT(a.date,'%M %Y') as periode, a.employee_id, b.employee_first_name,
	b.employee_last_name,department_name,designation_name,d.is_cut_absentee,d.is_overtime,
	case when d.is_cut_absentee =1 then 'YES' else 'NO' end absent_status,
	case when d.is_overtime =1 then 'YES' else 'NO' end overtime_status, b.designation_id, b.department_id
	from tp_absentee a
	inner join tm_employee b on a.employee_id = b.employee_id
	inner join tm_department c on b.department_id = c.department_id
	inner join tm_designation d on b.designation_id = d.designation_id
	where  b.department_id not in ('DP001','DP009')	and b.status=1  " .$clausa.$clausa_b. "
	order by employee_first_name	 ASC")->result();

			$data['departments'] = $this->db->query("select department_id,department_name from tm_department b
			where b.status in (1) ".$clausa_b." order by department_name ASC")->result();

			$data['periods'] = $this->db->query("select periode_id,
	CONCAT(CAST(MONTHNAME(STR_TO_DATE(a.month, '%m')) AS CHAR CHARACTER SET utf8),' ' ,CAST(year AS CHAR CHARACTER SET utf8))
	 as periode_name from  tp_absentee_periode a  where a.status in (1) order by periode_id ASC")->result();

			$data['tittlepage']="Absentee";
			$data['cssVendorSpecific']="
			<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/select2/css/select2.css\" />
			<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/select2-bootstrap-theme/select2-bootstrap.css\" />
			<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/jquery-datatables-bs3/assets/css/datatables.css\" />
			";

			$data['userName']=$this->session->userdata('userName');
			$data['fullname']=$this->session->userdata('userFullName');

			$data['titleContent']="Absentee";
			$data['LeftCaption']="<li>
										<a href=\"".site_url('headline')."\">
											<i class=\"fa fa-home\"></i>
										</a>
									</li>
									<li><span>Data Master</span></li>
									<li><span>Absentee</span></li>
									";
			$data['titleTable']="Absentee with details";


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

		$data['mnHrmLiParentClass']="class=\"nav-parent nav-expanded nav-active\"";
		$data['mnHrmLiAbsenteeClass']="class=\"nav-active\"";
	//	$data['mnTransactionLiProjectsClass']="";
	//	$data['mnTransactionLiBusnissBenefitsClass']="";
	//	$data['mnTransactionLiMembersClass']="";


		$data['mnAdministratorLiParentClass']="class=\"nav-parent\"";
		$data['mnAdministratorLiGroupsClass']="";
		$data['mnAdministratorLiUsersClass']="";


		$data['mnToolsLiParentClass']="class=\"nav-parent\"";
		$data['mnToolsLiUploadAbsentClass']="";

		$data['typePage']="header";
		$data['periodeId']=$periodeId;
		$data['departmentId']=$departmentId;

	    $this->load->view('pgAbsenteeVw', $data);

    }

    public function getOne($mydata) {

		$arrMydata=explode("-",$mydata);

		$myEmployeeId=$arrMydata[0];
		$myPeriodeId=$arrMydata[1];

 		$clausa= "";
		if (strlen($myPeriodeId)==0 || $myPeriodeId == ""  || $myPeriodeId == "-1" ){
			$clausa.= " ";
		}else{
			$clausa.= " and DATE_FORMAT(a.date,'%Y%m')='".$myPeriodeId."'";

		}

		if (strlen($myEmployeeId)==0 || $myEmployeeId == ""  || $myEmployeeId == "-1" ){
			$clausa.= " ";
		}else{
			$clausa.= " and a.employee_id='".$myEmployeeId."'";

		}

		   $data['linkForm'] = site_url($this->linkController.'/create');
			$data['listAbsentee'] = $this->db->query("select DATE_FORMAT(a.date,'%d-%m-%Y') as absent_date, DATE_FORMAT(a.date,'%Y-%m-%d') as absent_date_db, DATE_FORMAT(a.date,'%M %Y') as periode, DATE_FORMAT(a.date,'%Y%m') as periode_link, a.employee_id, b.employee_first_name, b.employee_last_name,department_name,designation_name,a.is_cut_absentee,a.is_overtime, case when a.is_cut_absentee =1 then 'YES' else 'NO' end absent_status, case when a.is_overtime =1 then 'YES' when a.is_overtime =9 then 'REJECT' else 'NO' end overtime_status, a.in, a.out,hour,hour_effective,a.is_overtime as status_overtime,amount_overtime,a.is_cut_absentee,cut_absentee_type,
			case when a.cut_absentee_type ='W' then 'Warning'  when a.cut_absentee_type ='C' then 'C 1/4'  else 'N' end cut_absentee_type_desc,is_approve_overtime,overtime_reason,approve_reason_overtime,is_approve_complain,absentee_complain,approve_reason_complain,d.is_cut_absentee as is_cut_absentee_des,d.is_overtime as is_overtime_des, b.designation_id, b.department_id
			from tp_absentee a inner join tm_employee b on a.employee_id = b.employee_id inner join tm_department c on b.department_id = c.department_id inner join tm_designation d on b.designation_id = d.designation_id where b.status=1  " .$clausa. "
	order by employee_first_name	 ASC")->result();

			$data['tittlepage']="Pengajuan Lembur";
			$data['cssVendorSpecific']="
			<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/select2/css/select2.css\" />
			<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/select2-bootstrap-theme/select2-bootstrap.css\" />
			<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/jquery-datatables-bs3/assets/css/datatables.css\" />
			";

			$data['userName']=$this->session->userdata('userName');
			$data['fullname']=$this->session->userdata('userFullName');

			$data['titleContent']="Pengajuan Lembur";
			$data['LeftCaption']="<li>
										<a href=\"".site_url('headline')."\">
											<i class=\"fa fa-home\"></i>
										</a>
									</li>
									<li><span>HRM</span></li>
									<li><span>Pengajuan Lembur</span></li>
									";

			$myFullName="";
			$myDepartment="";

			$query="select employee_first_name,employee_last_name,department_name
				from tm_employee a
				inner join tm_department b on a.department_id=b.department_id
				where employee_id = '".$myEmployeeId."'";
			$myresult=$this->db->query($query);
			foreach ($myresult->result() as $row)
			{
				$myFullName=$row->employee_first_name." ".$row->employee_last_name;
				$myDepartment=$row->department_name;

			};

			$data['titleTable']=$myEmployeeId." - ".$myFullName;
			$data['myDepartment']=$myDepartment;

			$data['myEmployeeId']=$myEmployeeId;
			$data['myPeriodeId']=$myPeriodeId;


		  $data['vendorJavascript']="
			<script src=\"".base_url()."assets/porto/vendor/select2/js/select2.js\"></script>
			<script src=\"".base_url()."assets/porto/vendor/jquery-datatables/media/js/jquery.dataTables.js\"></script>
			<script src=\"".base_url()."assets/porto/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js\"></script>
			<script src=\"".base_url()."assets/porto/vendor/jquery-datatables-bs3/assets/js/datatables.js\"></script>
		  ";

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

		$data['mnHrmLiParentClass']="class=\"nav-parent nav-expanded nav-active\"";
		$data['mnHrmLiAbsenteeClass']="";
    $data['mnHrmliPengajuanClass']="class=\"nav-active\"";
    $data['mnHrmliManagerApproveClass']="";
	//	$data['mnTransactionLiProjectsClass']="";
	//	$data['mnTransactionLiBusnissBenefitsClass']="";
	//	$data['mnTransactionLiMembersClass']="";

    $data['mnDataGALiParentClass']="class=\"nav-parent\"";
    $data['mnDataGALiInventoryClass']="";

		$data['mnAdministratorLiParentClass']="class=\"nav-parent\"";
		$data['mnAdministratorLiGroupsClass']="";
		$data['mnAdministratorLiUsersClass']="";


		$data['mnToolsLiParentClass']="class=\"nav-parent\"";
		$data['mnToolsLiUploadAbsentClass']="";

		$data['typePage']="detail";

	    $this->load->view('pgPengajuanVw', $data);

    }

/*
   public function create(){
        $row = array();
 		$id=$this->generateKey();
        $row['designation_id'] = $id;
        $row['designation_name'] = $this->input->post("designationName");
        $row['description'] = $this->input->post("description");
        $row['status'] = $this->input->post("status");
        $row['is_overtime'] = $this->input->post("isOvertime");
        $row['is_cut_absentee'] = $this->input->post("isCutAbsentee");
        $row['dt_etr'] = date('Y-m-d H:i:s');
        $row['user_etr'] = $this->session->userdata('userId');
        $row['dt_update'] = date('Y-m-d H:i:s');
        $row['user_update'] = $this->session->userdata('userId');

        $this->db->insert($this->table, $row);
        redirect(site_url($this->linkController));
    }
*/
  public function changeReason($id){
        $row = array();
        $arrMyDate = array();
		//myReasonOvertime
		//myDateDb
		$arrMydata=explode("-",$this->input->post("myDateDb"));

        $row['overtime_reason'] = $this->input->post("myReasonOvertime");
        $row['is_approve_overtime'] =99;

		$this->db->where("employee_id", $id);
		$this->db->where("date", $this->input->post("myDateDb"));
		$this->db->update($this->table, $row);

		redirect(site_url("absentee/getOne/".$id."-".$arrMydata[0].$arrMydata[1]));

    }

  public function approvalOvertime($id){
        $row = array();
        $arrMyDate = array();
 		$arrMydata=explode("-",$this->input->post("myDateDb"));

        $row['approve_reason_overtime'] = $this->input->post("myReasonApproval");
        $row['is_approve_overtime'] =$this->input->post("mystatus");
       	$row['approve_overtime_by'] = $this->session->userdata('userId');
        $row['approve_overtime_dt'] = date('Y-m-d H:i:s');
		if ($this->input->post("mystatus")==-1){
	        $row['is_overtime'] = 0;
		}

		$this->db->where("employee_id", $id);
		$this->db->where("date", $this->input->post("myDateDb"));
		$this->db->update($this->table, $row);

		redirect(site_url("absentee/getOne/".$id."-".$arrMydata[0].$arrMydata[1]));

    }

  public function changeComplain($id){
        $row = array();
        $arrMyDate = array();
		//myReasonOvertime
		//myDateDb
		$arrMydata=explode("-",$this->input->post("myDateDb"));

        $row['absentee_complain'] = $this->input->post("myReasonComplain");
        $row['is_approve_complain'] =99;

		$this->db->where("employee_id", $id);
		$this->db->where("date", $this->input->post("myDateDb"));
		$this->db->update($this->table, $row);

		redirect(site_url("absentee/getOne/".$id."-".$arrMydata[0].$arrMydata[1]));

    }

   public function approvalComplain($id){
        $row = array();
        $arrMyDate = array();
 		$arrMydata=explode("-",$this->input->post("myDateDb"));

        $row['approve_reason_complain'] = $this->input->post("myComplainApproval");
        $row['is_approve_complain'] =$this->input->post("mystatus");
       	$row['approve_complain_by'] = $this->session->userdata('userId');
        $row['approve_complain_dt'] = date('Y-m-d H:i:s');
        if ($this->input->post("mystatus")==1){
	        $row['is_cut_absentee'] = 0;
		}
		$this->db->where("employee_id", $id);
		$this->db->where("date", $this->input->post("myDateDb"));
		$this->db->update($this->table, $row);

		redirect(site_url("absentee/getOne/".$id."-".$arrMydata[0].$arrMydata[1]));

    }

	  public function employeeAbsentPrint($mydata){


        $arrMydata = array();
 		$arrMydata=explode("-",$mydata);

		$myEmployeeId=$arrMydata[0];
		$myPeriodeId=$arrMydata[1];


		$clausa= "";
		if (strlen($myPeriodeId)==0 || $myPeriodeId == ""  || $myPeriodeId == "-1" ){
			$clausa.= " ";
		}else{
			$clausa.= " and DATE_FORMAT(a.date,'%Y%m')='".$myPeriodeId."'";

		}

		if (strlen($myEmployeeId)==0 || $myEmployeeId == ""  || $myEmployeeId == "-1" ){
			$clausa.= " ";
		}else{
			$clausa.= " and a.employee_id='".$myEmployeeId."'";

		}


			$data['listAbsentee'] = $this->db->query("select DATE_FORMAT(a.date,'%d-%m-%Y') as absent_date, DATE_FORMAT(a.date,'%Y-%m-%d') as absent_date_db, DATE_FORMAT(a.date,'%M %Y') as periode, DATE_FORMAT(a.date,'%Y%m') as periode_link, a.employee_id, b.employee_first_name, b.employee_last_name,department_name,designation_name,a.is_cut_absentee,a.is_overtime, case when a.is_cut_absentee =1 then 'YES' else 'NO' end absent_status, case when a.is_overtime =1 then 'YES' when a.is_overtime =9 then 'REJECT' else 'NO' end overtime_status, a.in, a.out,hour,hour_effective,a.is_overtime as status_overtime,amount_overtime,a.is_cut_absentee,cut_absentee_type,
			case when a.cut_absentee_type ='W' then 'Warning'  when a.cut_absentee_type ='C' then 'C 1/4'  else 'N' end cut_absentee_type_desc,is_approve_overtime,overtime_reason,approve_reason_overtime,is_approve_complain,absentee_complain,approve_reason_complain,d.is_cut_absentee as is_cut_absentee_des,d.is_overtime as is_overtime_des, b.designation_id, b.department_id
			from tp_absentee a inner join tm_employee b on a.employee_id = b.employee_id inner join tm_department c on b.department_id = c.department_id inner join tm_designation d on b.designation_id = d.designation_id where b.status=1  " .$clausa. "
	order by employee_first_name	 ASC")->result();


			$myFullName="";
			$myDepartment="";

			$query="select employee_first_name,employee_last_name,department_name
				from tm_employee a
				inner join tm_department b on a.department_id=b.department_id
				where employee_id = '".$myEmployeeId."'";
			$myresult=$this->db->query($query);
			foreach ($myresult->result() as $row)
			{
				$myFullName=$row->employee_first_name." ".$row->employee_last_name;
				$myDepartment=$row->department_name;

			};

			$data['myFullName']=$myFullName;
			$data['myDepartment']=$myDepartment;

		$data['myEmployeeId']=$myEmployeeId;
		$data['myPeriodeId']=$myPeriodeId;

		 $this->load->view('incEmployeeAbsentPrint', $data);

    }



}
