<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Pegawai extends CI_Controller {

    // Nama table
    private $table = "tm_employee_affair";
    private $table_getone = "tp_employee_family";
    private $table_gettwo = "tp_employee_studi";
    // Primary key table
    private $primary = "employee_id";
    private $primary_getone = "family_id";
    private $primary_gettwo = "pendidikan_id";
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
    private $linkController = "pegawai";

	private $queryDepartment="select * from tm_department where status=1 order by department_name asc";
	private $queryDesignation="select * from tm_designation where status=1 order by designation_name asc";
  private $queryReligi="select * from tm_religi where status=1 order by religi_name asc";
  private $queryMarried="select * from tm_married where status=1 order by married_name asc";
  private $queryTitle="select * from tm_title where status=1 order by title_name asc";
  private $queryEmployeeStatus="select * from tm_employee_status where status=1 order by employee_status_name asc";

  private $queryStudi="select * from tm_studi where status=1 order by studi_name asc";

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('userId')) {
            redirect('login');
        }
    }

    public function index($offset = null) {

        $data['linkForm'] = site_url($this->linkController.'/create');
        // $data['linkForm2'] = site_url($this->linkController.'/change2');

	$data['groups'] = $this->db->query("select a.*,case when a.status = 1 then 'Yes' when a.status=0 then 'No' end as my_status,department_name,designation_name,religi_name,title_name,employee_status_name,married_name
		from tm_employee_affair a
		left outer join tm_department b on a.department_id=b.department_id
		left outer join tm_designation c on a.designation_id=c.designation_id
    left outer join tm_title d on a.title_id=d.title_id
    left outer join tm_employee_status e on a.employee_status_id=e.employee_status_id
    left outer join tm_religi f on a.religi_id=f.religi_id
    left outer join tm_married g on a.married_id=g.married_id
		where a.status in (1,0,9) order by employee_first_name ASC")->result();

		  $data['departments'] = $this->db->query("select department_id,department_name from tm_department a  where a.status in (1,0,9) order by department_name ASC")->result();
      $data['agamas'] = $this->db->query("select religi_id,religi_name from tm_religi a  where a.status in (1,0,9) order by religi_name ASC")->result();
      $data['marrieds'] = $this->db->query("select married_id,married_name from tm_married a  where a.status in (1,0,9) order by married_name ASC")->result();
   		$data['designations'] = $this->db->query("select designation_id,designation_name from tm_designation a  where a.status in (1,0,9) order by designation_name ASC")->result();
      $data['titles'] = $this->db->query("select title_id,title_name from tm_title a  where a.status in (1,0,9) order by title_id ASC")->result();
      $data['employeeStatuss'] = $this->db->query("select employee_status_id,employee_status_name from tm_employee_status a  where a.status in (1,0,9) order by employee_status_name ASC")->result();

 		$data['tittlepage']="Employee Affair";
		$data['cssVendorSpecific']="
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/select2/css/select2.css\" />
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/select2-bootstrap-theme/select2-bootstrap.css\" />
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/jquery-datatables-bs3/assets/css/datatables.css\" />
		";

		$data['userName']=$this->session->userdata('userName');
		$data['fullname']=$this->session->userdata('userFullName');

		$data['titleContent']="Employee Affair";
		$data['LeftCaption']="<li>
									<a href=\"".site_url('headline')."\">
										<i class=\"fa fa-home\"></i>
									</a>
								</li>
								<li><span>Data Master</span></li>
								<li><span>Employee Affair</span></li>
								";
		$data['titleTable']="Employee Affair with details";


	  $data['vendorJavascript']="
		<script src=\"".base_url()."assets/porto/vendor/select2/js/select2.js\"></script>
		<script src=\"".base_url()."assets/porto/vendor/jquery-datatables/media/js/jquery.dataTables.js\"></script>
		<script src=\"".base_url()."assets/porto/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js\"></script>
		<script src=\"".base_url()."assets/porto/vendor/jquery-datatables-bs3/assets/js/datatables.js\"></script>
    <script src=\"".base_url()."assets/porto/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js\"></script>
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
	$data['mnDataMasterLiDepartmentClass']="";
	$data['mnDataMasterLiDesignationClass']="";
	$data['mnDataMasterLiEmployeeClass']="";
  $data['mnDataMasterLiPegawaiClass']="class=\"nav-active\"";

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
  $data['typePage']="header";



	 $myDataSplitDesignation="ALL:-------------- ALL --------------,";
     $queryDesignation = $this->db->query($this->queryDesignation);
	foreach ($queryDesignation->result() as $row)
		{
		  $myDataSplitDesignation.=$row->designation_id.":".$row->designation_name.",";
		}
		$data['myDataSplitDesignation']=substr($myDataSplitDesignation,0,strlen($myDataSplitDesignation)-1);


	 $myDataSplitDepartment="ALL:-------------- ALL --------------,";
     $queryDepartment = $this->db->query($this->queryDepartment);
	foreach ($queryDepartment->result() as $row)
		{
		  $myDataSplitDepartment.=$row->department_id.":".$row->department_name.",";
		}
		$data['myDataSplitDepartment']=substr($myDataSplitDepartment,0,strlen($myDataSplitDepartment)-1);

    $myDataSplitReligi="ALL:-------------- ALL --------------,";
      $queryReligi = $this->db->query($this->queryReligi);
 	foreach ($queryReligi->result() as $row)
 		{
 		  $myDataSplitReligi.=$row->religi_id.":".$row->religi_name.",";
 		}
 		$data['myDataSplitReligi']=substr($myDataSplitReligi,0,strlen($myDataSplitReligi)-1);

    $myDataSplitMarried="ALL:-------------- ALL --------------,";
      $queryMarried = $this->db->query($this->queryMarried);
 	foreach ($queryMarried->result() as $row)
 		{
 		  $myDataSplitMarried.=$row->married_id.":".$row->married_name.",";
 		}
 		$data['myDataSplitMarried']=substr($myDataSplitMarried,0,strlen($myDataSplitMarried)-1);

    $myDataSplitTitle="ALL:-------------- ALL --------------,";
      $queryTitle = $this->db->query($this->queryTitle);
  foreach ($queryTitle->result() as $row)
    {
      $myDataSplitTitle.=$row->title_id.":".$row->title_name.",";
    }
    $data['myDataSplitTitle']=substr($myDataSplitTitle,0,strlen($myDataSplitTitle)-1);

    $myDataSplitEmployeeStatus="ALL:-------------- ALL --------------,";
      $queryEmployeeStatus = $this->db->query($this->queryEmployeeStatus);
  foreach ($queryEmployeeStatus->result() as $row)
    {
      $myDataSplitEmployeeStatus.=$row->employee_status_id.":".$row->employee_status_name.",";
    }
    $data['myDataSplitEmployeeStatus']=substr($myDataSplitEmployeeStatus,0,strlen($myDataSplitEmployeeStatus)-1);

	    $this->load->view('pgPegawaiVw', $data);

    }
//===================================DIVA======================

public function getOne($mydata) {
  $data['linkForm_getone'] = site_url($this->linkController.'/create_getone');
    //$arrMydata=explode("-",$mydata);

    $myEmployeeId=$mydata;
    // $myPegawai=$myEmployeeId;

    $data['listFamily'] = $this->db->query("select a.*,case when a.status = 1 then 'Yes' when a.status=0 then 'No' end as my_status,employee_first_name,hubungan_name
  		from tp_employee_family a
  		left outer join tm_employee b on a.employee_id=b.employee_id
      left outer join tm_hubungan c on a.hubungan_id=c.hubungan_id
  		where b.employee_id= '".$myEmployeeId."' and a.status in (1,0,9) order by employee_first_name ASC")->result();

       $data['hubungans'] = $this->db->query("select hubungan_id,hubungan_name from tm_hubungan a  where a.status in (1,0,9) order by hubungan_name ASC")->result();

      $data['tittlepage']="Employee Affair";
      $data['cssVendorSpecific']="
      <link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/select2/css/select2.css\" />
      <link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/select2-bootstrap-theme/select2-bootstrap.css\" />
      <link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/jquery-datatables-bs3/assets/css/datatables.css\" />
      ";

      $data['userName']=$this->session->userdata('userName');
      $data['fullname']=$this->session->userdata('userFullName');

      $data['titleContent']="Employee Affair";
      $data['LeftCaption']="<li>
                    <a href=\"".site_url('headline')."\">
                      <i class=\"fa fa-home\"></i>
                    </a>
                  </li>
                  <li><span>Data Master</span></li>
                  <li><span>Employee Affair</span></li>
                  <li><span>Family</span></li>
                  ";

      $myFullName="";
      $myDepartment="";

      $query="select employee_first_name,employee_last_name,department_name
        from tm_employee_affair a
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
      // $data['myPeriodeId']=$myPeriodeId;


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

    $data['mnDataMasterLiParentClass']="class=\"nav-parent nav-expanded nav-active\"";
    $data['mnDataMasterLiDepartmentClass']="";
    $data['mnDataMasterLiDesignationClass']="";
    $data['mnDataMasterLiEmployeeClass']="";
    $data['mnDataMasterLiPegawaiClass']="class=\"nav-active\"";

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

    $data['typePage']="detail";

      $this->load->view('pgPegawaiVw', $data);

    }
// ==============================
public function gettwo($mydata) {
  $data['linkForm_gettwo'] = site_url($this->linkController.'/create_gettwo');

    // $arrMydata=explode("-",$mydata);

    $myEmployeeId=$mydata;
    // $myPegawai=$myEmployeeId;

    $data['listpendidikan'] = $this->db->query("select a.*,case when a.status = 1 then 'Yes' when a.status=0 then 'No' end as my_status,employee_first_name,studi_name
  		from tp_employee_studi a
  		left outer join tm_employee b on a.employee_id=b.employee_id
      left outer join tm_studi c on a.studi_id=c.studi_id
  		where b.employee_id= '".$myEmployeeId."' and a.status in (1,0,9) order by employee_first_name ASC")->result();

       $data['pendidikans'] = $this->db->query("select studi_id,studi_name from tm_studi a  where a.status in (1,0,9) order by studi_id Desc")->result();

      $data['tittlepage']="Employee Affair";
      $data['cssVendorSpecific']="
      <link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/select2/css/select2.css\" />
      <link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/select2-bootstrap-theme/select2-bootstrap.css\" />
      <link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/jquery-datatables-bs3/assets/css/datatables.css\" />
      ";

      $data['userName']=$this->session->userdata('userName');
      $data['fullname']=$this->session->userdata('userFullName');

      $data['titleContent']="Employee Affair";
      $data['LeftCaption']="<li>
                    <a href=\"".site_url('headline')."\">
                      <i class=\"fa fa-home\"></i>
                    </a>
                  </li>
                  <li><span>Data Master</span></li>
                  <li><span>Employee Affair</span></li>
                  <li><span>Pendidikan</span></li>
                  ";

      $myFullName="";
      $myDepartment="";

      $query="select employee_first_name,employee_last_name,department_name
        from tm_employee_affair a
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
      // $data['myPeriodeId']=$myPeriodeId;


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

    $data['mnDataMasterLiParentClass']="class=\"nav-parent nav-expanded nav-active\"";
    $data['mnDataMasterLiDepartmentClass']="";
    $data['mnDataMasterLiDesignationClass']="";
    $data['mnDataMasterLiEmployeeClass']="";
    $data['mnDataMasterLiPegawaiClass']="class=\"nav-active\"";

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

    $data['typePage']="detail_pendidikan";

    $myDataSplitStudi="ALL:-------------- ALL --------------,";
      $queryStudi = $this->db->query($this->queryStudi);
   foreach ($queryStudi->result() as $row)
     {
       $myDataSplitStudi.=$row->studi_id.":".$row->studi_name.",";
     }
     $data['myDataSplitStudi']=substr($myDataSplitStudi,0,strlen($myDataSplitStudi)-1);


      $this->load->view('pgPegawaiVw', $data);

    }

    public function create(){
      $row = array();

      $employeeId=$this->input->post("employeeId");
      $employeeFirstName=$this->input->post("employeeFirstName");
      $employeeLastName=$this->input->post("employeeLastName");
      $departmentId=$this->input->post("departmentId");
      $designationId=$this->input->post("designationId");
      $titleId=$this->input->post("titleId");
      $employeeStatusId=$this->input->post("employeeStatusId");
      $jointDate=$this->input->post("jointDate");
      $endOfContract=$this->input->post("endOfContract");
      $permanentDate=$this->input->post("permanentDate");
      $tempatlahir=$this->input->post("tempatLahir");
      $tanggallahir=$this->input->post("tanggalLahir");
      $alamat=$this->input->post("alamat");
      $agama=$this->input->post("agama");      
      $married=$this->input->post("married");
      $status=$this->input->post("status");

      if (strlen($employeeId)==0 || $employeeId == "" ){
              $msg = "Employee id Name harus diisi. ";
              $data = array(
                  "msg" => $msg,
                  "success" => 0
              );
      }else if (strlen($employeeFirstName)==0 || $employeeFirstName == "" ){
              $msg = "Nama Awal harus diisi. ";
              $data = array(
                  "msg" => $msg,
                  "success" => 0
              );
      }else if (strlen($employeeLastName)==0 || $employeeLastName == "" ){
              $msg = "Nama Akhir harus diisi. ";
              $data = array(
                    "msg" => $msg,
                    "success" => 0
              );
      }else if (strlen($departmentId)==0 || $departmentId == "" || $departmentId == "-1"){
              $msg = "Department harus dipilih. ";
              $data = array(
                    "msg" => $msg,
                    "success" => 0
              );
      }else if (strlen($designationId)==0 || $designationId == "" || $designationId == "-1"){
              $msg = "Designation harus dipilih. ";
              $data = array(
                    "msg" => $msg,
                    "success" => 0
              );
      }else if (strlen($titleId)==0 || $titleId == "" || $titleId == "-1"){
              $msg = "Title harus dipilih. ";
              $data = array(
                    "msg" => $msg,
                    "success" => 0
              );
      }else if (strlen($employeeStatusId)==0 || $employeeStatusId == "" || $employeeStatusId == "-1"){
              $msg = "Status Pegawai harus dipilih. ";
              $data = array(
                    "msg" => $msg,
                    "success" => 0
              );
      }else if (strlen($jointDate)==0 || $jointDate == "" ){
              $msg = "Joint Date harus diisi. ";
              $data = array(
                    "msg" => $msg,
                    "success" => 0
              );
      }else if (strlen($endOfContract)==0 || $endOfContract == "" ){
              $msg = "Akhir Contract harus diisi. ";
              $data = array(
                    "msg" => $msg,
                    "success" => 0
              );
      }else if (strlen($permanentDate)==0 || $permanentDate == "" ){
              $msg = "Permanent date harus diisi. ";
              $data = array(
                    "msg" => $msg,
                    "success" => 0
              );
      }else if (strlen($tempatLahir)==0 || $tempatLahir == "" ){
              $msg = "Tempat Lahir controller harus diisi. ";
              $data = array(
                    "msg" => $msg,
                    "success" => 0
              );
      }else if (strlen($tanggalLahir)==0 || $tanggalLahir == "" ){
              $msg = "Tanggal Lahir harus diisi. ";
              $data = array(
                    "msg" => $msg,
                    "success" => 0
              );
      }else if (strlen($alamat)==0 || $alamat == "" ){
              $msg = "Alamatharus diisi. ";
              $data = array(
                    "msg" => $msg,
                    "success" => 0
              );
      }else if (strlen($agama)==0 || $agama == "" || $agama == "-1"){
              $msg = "Agama harus dipilih. ";
              $data = array(
                    "msg" => $msg,
                    "success" => 0
              );
      }else if (strlen($married)==0 || $married == "" || $married == "-1"){
              $msg = "Pernikahan harus dipilih. ";
              $data = array(
                    "msg" => $msg,
                    "success" => 0
              );
      }else if (strlen($status)==0 || $status == "" || $status == "-1"){
              $msg = "Status harus dipilih. ";
              $data = array(
                    "msg" => $msg,
                    "success" => 0
              );
            } else {
                    try {
                      // $id=$this->generateKey();
                      $row['employee_id'] = $employeeId;
                      $row['employee_first_name'] = $employeeFirstName;
                      $row['employee_last_name'] = $employeeLastName;
                      $row['department_id'] = $departmentId;
                      $row['designation_id'] = $designationId;
                      $row['title_id'] = $titleId;
                      $row['employee_status_id'] = $employeeStatusId;
                      $row['joint_date'] = $jointDate;
                      $row['end_of_contract'] = $endOfContract;
                      $row['permanent_date'] = $permanentDate;
                      $row['tempat_lahir'] = $tempatLahir;
                      $row['tanggal_lahir'] = $tanggalLahir;
                      $row['alamat'] = $alamat;
                      $row['agama'] = $agama;
                      $row['married'] = $married;
                      $row['status'] = $status;

                      $row['dt_etr'] = date('Y-m-d H:i:s');
                      $row['user_etr'] = $this->session->userdata('userId');
                      $row['dt_update'] = date('Y-m-d H:i:s');
                      $row['user_update'] = $this->session->userdata('userId');

                      $this->db->insert($this->table, $row);

                      $msg = "Data sudah berhasil di simpan";
                      $data = array(
                        "employeeId" => $employeeId,
                        "msg" => $msg,
                        "success" => 1
                      );
                    } catch (exception $e) {
                            $data = array(
                                "msg" => $e,
                                "success" => 0
                            );
                        }

                    }

                    echo json_encode($data);
                    }


    public function create_getone(){
         $row = array();
  		   $id_getone=$this->generateKey();
         $row['family_id'] = $id_getone;
         $row['employee_id'] = $this->input->post("employeeId");
         $row['hubungan_id'] = $this->input->post("hubunganId");
         $row['family_name'] = $this->input->post("familyName");
         $row['tempat_lahir'] = $this->input->post("tempatLahir");
         $row['tanggal_lahir'] = $this->input->post("tanggalLahir");
         $row['status'] = $this->input->post("status");

         $this->db->insert($this->table_getone, $row);
         redirect(site_url($this->linkController)."/getone/".$this->input->post("employeeId"));
     }

     public function create_gettwo(){
          $row = array();
   		    $id_gettwo=$this->generateKey2();
          $row['pendidikan_id'] = $id_gettwo;
          $row['employee_id'] = $this->input->post("employeeId");
          $row['studi_id'] = $this->input->post("studiId");
          $row['school_name'] = $this->input->post("schoolName");
          $row['periode'] = $this->input->post("periode");
          $row['status'] = $this->input->post("status");

          $this->db->insert($this->table_gettwo, $row);
          redirect(site_url($this->linkController)."/gettwo/".$this->input->post("employeeId"));
      }

  public function update(){
              $row = array();

              $employeeId=$this->input->post("employeeId");
              $employeeFirstName=$this->input->post("employeeFirstName");
              $employeeLastName=$this->input->post("employeeLastName");
              $departmentId=$this->input->post("departmentId");
              $designationId=$this->input->post("designationId");
              $titleId=$this->input->post("titleId");
              $employeeStatusId=$this->input->post("employeeStatusId");
              $jointDate=$this->input->post("jointDate");
              $endOfContract=$this->input->post("endOfContract");
              $permanentDate=$this->input->post("permanentDate");
              $tempatlahir=$this->input->post("tempatLahir");
              $tanggalLahir=$this->input->post("tanggalLahir");
              $alamat=$this->input->post("alamat");
              $agama=$this->input->post("agama");
              $married=$this->input->post("married");
              $status=$this->input->post("status");

              if (strlen($employeeId)==0 || $employeeId == "" ){
                      $msg = "Employee id Name harus diisi. ";
                      $data = array(
                          "msg" => $msg,
                          "success" => 0
                      );
              }else if (strlen($employeeFirstName)==0 || $employeeFirstName == "" ){
                      $msg = "Nama Awal harus diisi. ";
                      $data = array(
                          "msg" => $msg,
                          "success" => 0
                      );
              }else if (strlen($employeeLastName)==0 || $employeeLastName == "" ){
                      $msg = "Nama Akhir harus diisi. ";
                      $data = array(
                            "msg" => $msg,
                            "success" => 0
                      );
              }else if (strlen($departmentId)==0 || $departmentId == "" || $departmentId == "-1"){
                      $msg = "Department harus dipilih. ";
                      $data = array(
                            "msg" => $msg,
                            "success" => 0
                      );
              }else if (strlen($designationId)==0 || $designationId == "" || $designationId == "-1"){
                      $msg = "Designation harus dipilih. ";
                      $data = array(
                            "msg" => $msg,
                            "success" => 0
                      );
              }else if (strlen($titleId)==0 || $titleId == "" || $titleId == "-1"){
                      $msg = "Title harus dipilih. ";
                      $data = array(
                            "msg" => $msg,
                            "success" => 0
                      );
              }else if (strlen($employeeStatusId)==0 || $employeeStatusId == "" || $employeeStatusId == "-1"){
                      $msg = "Status Pegawai harus dipilih. ";
                      $data = array(
                            "msg" => $msg,
                            "success" => 0
                      );
              }else if (strlen($jointDate)==0 || $jointDate == "" ){
                      $msg = "Joint Date harus diisi. ";
                      $data = array(
                            "msg" => $msg,
                            "success" => 0
                      );
              }else if (strlen($endOfContract)==0 || $endOfContract == "" ){
                      $msg = "Akhir Contract harus diisi. ";
                      $data = array(
                            "msg" => $msg,
                            "success" => 0
                      );
              }else if (strlen($permanentDate)==0 || $permanentDate == "" ){
                      $msg = "Permanent date harus diisi. ";
                      $data = array(
                            "msg" => $msg,
                            "success" => 0
                      );
              }else if (strlen($tempatLahir)==0 || $tempatLahir == "" ){
                      $msg = "Tempat Lahir controller update harus diisi. ";
                      $data = array(
                            "msg" => $msg,
                            "success" => 0
                      );
              }else if (strlen($tanggalLahir)==0 || $tanggalLahir == "" ){
                      $msg = "Tanggal Lahir harus diisi. ";
                      $data = array(
                            "msg" => $msg,
                            "success" => 0
                      );
              }else if (strlen($alamat)==0 || $alamat == "" ){
                      $msg = "Alamat harus diisi. ";
                      $data = array(
                            "msg" => $msg,
                            "success" => 0
                      );
              }else if (strlen($agama)==0 || $agama == "" || $agama == "-1"){
                      $msg = "Agama harus dipilih. ";
                      $data = array(
                            "msg" => $msg,
                            "success" => 0
                      );
              }else if (strlen($married)==0 || $married == "" || $married == "-1"){
                      $msg = "Pernikahan harus dipilih. ";
                      $data = array(
                            "msg" => $msg,
                            "success" => 0
                      );
              }else if (strlen($status)==0 || $status == "" || $status == "-1"){
                      $msg = "Status harus dipilih. ";
                      $data = array(
                            "msg" => $msg,
                            "success" => 0
                      );
                    } else {
                            try {
                                // $id=$this->generateKey();
                                // $row['employee_id'] = $employeeId;
                                $row['employee_first_name'] = $employeeFirstName;
                                $row['employee_last_name'] = $employeeLastName;
                                $row['department_id'] = $departmentId;
                                $row['designation_id'] = $designationId;
                                $row['title_id'] = $titleId;
                                $row['employee_status_id'] = $employeeStatusId;
                                $row['joint_date'] = $jointDate;
                                $row['end_of_contract'] = $endOfContract;
                                $row['permanent_date'] = $permanentDate;
                                $row['tempat_lahir'] = $tempatLahir;
                                $row['tanggal_lahir'] = $tanggalLahir;
                                $row['alamat'] = $alamat;
                                $row['agama'] = $agama;
                                $row['married'] = $married;
                                $row['status'] = $status;

                                $row['dt_etr'] = date('Y-m-d H:i:s');
                                $row['user_etr'] = $this->session->userdata('userId');
                                $row['dt_update'] = date('Y-m-d H:i:s');
                                $row['user_update'] = $this->session->userdata('userId');

                                $this->db->where("employee_id", $employeeId)->update($this->table, $row);

                                $msg = "Data sudah berhasil di simpan";
                                $data = array(
                                  "employeeId" => $employeeId,
                                  "msg" => $msg,
                                  "success" => 1
                                );
                              } catch (exception $e) {
                                      $data = array(
                                          "msg" => $e,
                                          "success" => 0
                                      );
                                  }

                              }

                              echo json_encode($data);
                              }



  public function change_gettwo($id_gettwo){
        $row = array();
        $row['school_name'] = $this->input->post("schoolName");
        $row['studi_id'] = $this->input->post("myStudiId");
        $row['periode'] = $this->input->post("periode");
        // $row['alamat'] = $this->input->post("alamat");
        // $row['religi_id'] = $this->input->post("myReligiId");
        // $row['married_id'] = $this->input->post("myMarriedId");
        $row['status'] = $this->input->post("mystatus");
        // $row['dt_update'] = date('Y-m-d H:i:s');
        // $row['user_update'] = $this->session->userdata('userId');
      	$this->db->where("pendidikan_id","employee_id", $id_gettwo,$employeeId)->update($this->table_gettwo, $row);
        redirect(site_url($this->linkController)."/gettwo/".$this->input->post("employeeId"));
     }

    public function delete($id){
        $this->db->where($this->primary, $id);
        $this->db->delete($this->table);
        redirect(site_url($this->linkController));
    }

    public function delete_getone($id_getone){
      $arrMydata=array();
        $arrMydata=explode("-",$id_getone);
        $familyId=$arrMydata[0];
        $employeeId=$arrMydata[1];

        $this->db->where($this->primary_getone, $familyId);
        $this->db->delete($this->table_getone);
        redirect(site_url($this->linkController)."/getone/".$employeeId);
    }

    public function delete_gettwo($id_gettwo){
      $arrMydata=array();
        $arrMydata=explode("-",$id_gettwo);
        $pendidikanId=$arrMydata[0];
        $employeeId=$arrMydata[1];

        $this->db->where($this->primary_gettwo, $pendidikanId);
        $this->db->delete($this->table_gettwo);
        redirect(site_url($this->linkController)."/gettwo/".$employeeId);
    }

	public function generateKey($additional_string="",$additional_criteria="") {
		$currentdate=date("ym");

			$no_of_trailing=3;
			$string="FML";
			$query="select max(right(".$this->primary_getone.",".$no_of_trailing.")) as max_id
				from ".$this->table_getone." where left(".$this->primary_getone.",". strlen($string) .") = '".$string."'";
			$myresult=$this->db->query($query);
			foreach ($myresult->result() as $row)
			{
				$id_getone=($row->max_id)+1;
				$id_getone=str_pad($id_getone,$no_of_trailing,"0",STR_PAD_LEFT);
			};
		return $string.$id_getone;
	}

  public function generateKey2($additional_string="",$additional_criteria="") {
		$currentdate=date("ym");

			$no_of_trailing=3;
			$string="SCH";
			$query="select max(right(".$this->primary_gettwo.",".$no_of_trailing.")) as max_id
				from ".$this->table_gettwo." where left(".$this->primary_gettwo.",". strlen($string) .") = '".$string."'";
			$myresult=$this->db->query($query);
			foreach ($myresult->result() as $row)
			{
				$id_gettwo=($row->max_id)+1;
				$id_gettwo=str_pad($id_gettwo,$no_of_trailing,"0",STR_PAD_LEFT);
			};
		return $string.$id_gettwo;
	}


}
