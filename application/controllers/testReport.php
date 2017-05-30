<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class testReport extends CI_Controller {
	private $pv;
	private $rptColumnHeader;
	var $arrTemp;
	
	private $pg;
	private $myVal;
	
	private $params;
    // Nama table
    private $table = "tp_request2";
    // Primary key table
    private $primary = "request_id";
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
	

    private $linkController = "testReport";
	
	private $queryProvinsi="select * from tm_propinsi where status=1 order by propinsi_name";
	private $queryPeriode="select * from tm_period_year where status=1 order by period_year desc";
	private $queryTarget="select * from tm_target_group where status=1 order by target_name";



    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('userId')) {
            redirect('login');
        }
			//$pg=new myForm("PAGE BROWSER", $_SERVER['PHP_SELF'], "150", "center", "center");
		
		//$params = array('page_title' => 'PAGE BROWSER', 'file_name' => $_SERVER['PHP_SELF'], 'right_width' => '150', 'right_valign' => 'center', 'contents_valign' => 'center');
		//$this->load->model('myForm');
	    $this->load->library("nusoap");

    }

    public function index($offset = null) {
	
 	    $data['linkForm'] = site_url($this->linkController.'/create');
 	    $data['linkFormDetail'] = site_url($this->linkController.'/createDetail');
 
 		$data['tittlepage']="Report";
		$data['cssVendorSpecific']="
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/select2/css/select2.css\" />
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/select2-bootstrap-theme/select2-bootstrap.css\" />
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/jquery-datatables-bs3/assets/css/datatables.css\" />
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css\" />
		";
	
		$data['userName']=$this->session->userdata('userName');
		$data['fullname']=$this->session->userdata('userFullName');
 		$mylink=site_url($this->linkController);
		$mylink2="#modalForm";
		$data['titleContent']="Report";
		$data['myMenu']='';
//								<li><span id="btnSearch"><a class="modal-with-form" href="#modalForm" data-target="#modalForm" id="3">
		$data['LeftCaption']="<li>
									<a href=\"".site_url('headline')."\">
										<i class=\"fa fa-home\"></i>
									</a>
								</li>
								<li><span>Report</span></li>
								<li><span>Laporan Permohonan</span></li>
								";
		$data['titleTable']="Report";

      
	  
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

	$data['mnDataMasterLiParentClass']="class=\"nav-parent \"";
	$data['mnDataMasterLiProvinsiClass']="";
	$data['mnDataMasterLiKabupatenClass']="";
	$data['mnDataMasterLiTargetClass']="";
	
	
	$data['mnRequestLiParentClass']="class=\"nav-parent\"";
	$data['mnRequestLiFormClass']="";
	$data['mnVerminLiFormClass']="";
	$data['mnVerminAnotherLiFormClass']="";
	$data['mnVertekLiFormClass']="";
	

	
	$data['mnAdministratorLiParentClass']="class=\"nav-parent\"";
	$data['mnAdministratorLiGroupsClass']="";
	$data['mnAdministratorLiUsersClass']="";
 
 	$data['mnReportLiParentClass']="class=\"nav-parent nav-expanded nav-active\"";
	$data['mnReportLiReportTestClass']="class=\"nav-active\"";
	$data['mnReportLiWebServiceClass']="";
	$data['mnReportLiGraphClass']="";

	$data['mnMapLiParentClass']="class=\"nav-parent\"";
	$data['mnMapRequestLiFormClass']="";

 
	$data['database']="dtr";
	$data['rptName']="rptRequestByPropinsi3";
 	$data['c']="";

	 $myDataSplitProvinsi="ALL:-------------- ALL --------------,";
     $queryProvinsi = $this->db->query($this->queryProvinsi);
	foreach ($queryProvinsi->result() as $row)
		{ 
		  $myDataSplitProvinsi.=$row->propinsi_id.":".$row->propinsi_name.",";
		}
		$myDataSplitProvinsi=substr($myDataSplitProvinsi,0,strlen($myDataSplitProvinsi)-1);


	 $myDataSplitTarget="ALL:-------------- ALL --------------,";
     $queryTarget = $this->db->query($this->queryTarget);
	foreach ($queryTarget->result() as $row)
		{ 
		  $myDataSplitTarget.=$row->target_id.":".$row->target_name.",";
		}
		$myDataSplitTarget=substr($myDataSplitTarget,0,strlen($myDataSplitTarget)-1);


	 $myDataSplitPeriode="ALL:-------------- ALL --------------,";
     $queryPeriode = $this->db->query($this->queryPeriode);
	foreach ($queryPeriode->result() as $row)
		{ 
		  $myDataSplitPeriode.="-".$row->period_id.":".$row->period_year.",";
		}
		$myDataSplitPeriode=substr($myDataSplitPeriode,0,strlen($myDataSplitPeriode)-1);


	
	$reportNameCaption="Usulan Masuk by Provinsi";
	$reportName=str_replace(" ","_",$reportNameCaption);
	$myDataSplit=$reportName."|myDet|naura";

 $rptUsulanByProvinsi="<td onclick=\"javascript:showFormReport('".site_url($this->linkController."/rptUsulanByProvinsi")."','".$myDataSplit."','".$myDataSplitProvinsi."','".$myDataSplitTarget."','".$myDataSplitPeriode."');return false;\" style=\"cursor:pointer\">".$reportNameCaption."</td>";

	$reportNameCaption="Usulan Masuk by Target";
	$reportName=str_replace(" ","_",$reportNameCaption);
	$myDataSplit=$reportName."|myDet|naura";

 $rptUsulanByTarget="<td onclick=\"javascript:showFormReport('".site_url($this->linkController."/rptUsulanByTarget")."','".$myDataSplit."','".$myDataSplitProvinsi."','".$myDataSplitTarget."','".$myDataSplitPeriode."');return false;\" style=\"cursor:pointer\">".$reportNameCaption."</td>";


/**********************SUMMARY*****************************/

	$reportNameCaption="Usulan Masuk by Provinsi-Kabupaten";
	$reportName=str_replace(" ","_",$reportNameCaption);
$myDataSplit=$reportName."|mySum|naura";
$rptSumUsulanByProvinsiKabupaten="<td onclick=\"javascript:showFormReport('".site_url($this->linkController."/rptSumUsulanByProvinsiKabupaten")."','".$myDataSplit."','".$myDataSplitProvinsi."','".$myDataSplitTarget."','".$myDataSplitPeriode."');return false;\" style=\"cursor:pointer\">".$reportNameCaption."</td>";

	$reportNameCaption="Usulan Masuk by Provinsi";
	$reportName=str_replace(" ","_",$reportNameCaption);
$myDataSplit=$reportName."|mySum|naura";
$rptSumUsulanByProvinsi="<td onclick=\"javascript:showFormReport('".site_url($this->linkController."/rptSumUsulanByProvinsi")."','".$myDataSplit."','".$myDataSplitProvinsi."','".$myDataSplitTarget."','".$myDataSplitPeriode."');return false;\" style=\"cursor:pointer\">".$reportNameCaption."</td>";

	$reportNameCaption="Usulan Masuk by Target-Provinsi";
	$reportName=str_replace(" ","_",$reportNameCaption);
$myDataSplit=$reportName."|mySum|naura";
$rptSumUsulanByTargetProvinsi="<td onclick=\"javascript:showFormReport('".site_url($this->linkController."/rptSumUsulanByTargetProvinsi")."','".$myDataSplit."','".$myDataSplitProvinsi."','".$myDataSplitTarget."','".$myDataSplitPeriode."');return false;\" style=\"cursor:pointer\">".$reportNameCaption."</td>";

	$reportNameCaption="Usulan Masuk by Target";
	$reportName=str_replace(" ","_",$reportNameCaption);
$myDataSplit=$reportName."|mySum|naura";
$rptSumUsulanByTarget="<td onclick=\"javascript:showFormReport('".site_url($this->linkController."/rptSumUsulanByTarget")."','".$myDataSplit."','".$myDataSplitProvinsi."','".$myDataSplitTarget."','".$myDataSplitPeriode."');return false;\" style=\"cursor:pointer\">".$reportNameCaption."</td>";

$data['reportMenu']="
						<div class=\"row\">
							<div class=\"col-md-6\">
								<section class=\"panel\">
									<header class=\"panel-heading\">
										<div class=\"panel-actions\">
											<a href=\"#\" class=\"panel-action panel-action-toggle\" data-panel-toggle></a>
											<a href=\"#\" class=\"panel-action panel-action-dismiss\" data-panel-dismiss></a>
										</div>
						
										<h2 class=\"panel-title\">Detail</h2>
									</header>
									<div class=\"panel-body\">
										<div class=\"table-responsive\">
											<table class=\"table table-hover mb-none\">
												<thead>
													<tr>
														<th>Report Name</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														".$rptUsulanByProvinsi." 
													</tr>
													<tr>
														".$rptUsulanByTarget." 
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</section>
							</div>
							<div class=\"col-md-6\">
								<section class=\"panel\">
									<header class=\"panel-heading\">
										<div class=\"panel-actions\">
											<a href=\"#\" class=\"panel-action panel-action-toggle\" data-panel-toggle></a>
											<a href=\"#\" class=\"panel-action panel-action-dismiss\" data-panel-dismiss></a>
										</div>
						
										<h2 class=\"panel-title\">Summary</h2>
									</header>
									<div class=\"panel-body\">
										<div class=\"table-responsive\">
											<table class=\"table table-hover mb-none\">
												<thead>
													<tr>
														<th>Report Name</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														".$rptSumUsulanByProvinsiKabupaten." 
													</tr>
													<tr>
														".$rptSumUsulanByProvinsi." 
													</tr>
													<tr>
														".$rptSumUsulanByTargetProvinsi." 
													</tr>
													<tr>
														".$rptSumUsulanByTarget." 
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</section>
							</div>
						</div>

";	
 
 	    $this->load->view('pgTestReportVw', $data);

    }
  

	
	 public function rptUsulanByProvinsi(){
		  $data['userName']=$this->session->userdata('userName');
		  $data['fullname']=$this->session->userdata('userFullName');
 
 		
 
		  $typeReport= $this->input->post("typeReport");
		  $provinsiId= $this->input->post("myProvinsiId");
		  $periodId= $this->input->post("myPeriodId");
		  $targetId= $this->input->post("myTargetId");

		  if($provinsiId=="ALL"){
			  $data['provinsiId'] ="";
		  }else{
			  $data['provinsiId'] = $provinsiId;
		  }
		  if($targetId=="ALL"){
			  $data['targetId'] ="";
		  }else{
			  $data['targetId'] = $targetId;
		  }
		  if($periodId=="ALL"){
			  $data['tahunAnggaran'] ="";
			  $data['year'] ="";
		  }else{
			  $data['tahunAnggaran'] = substr($periodId,1,4);
			  $data['year'] =substr($periodId,1,4);;
		  }

		  $data['anotherCriteria']="";	
		  $data['typeReport'] =$typeReport;

		  $data['c'] ="";
		  $data['month'] ="07";


		$this->client = new  nusoap_client('http://167.160.170.99/wsdlReport/puGetReportProvinsi.php?wsdl', true);
		$this->load->view("report/rptUsulanByProvinsi",$data);


	
 
	 } 
 
	 public function rptUsulanByTarget(){
		  $data['userName']=$this->session->userdata('userName');
		  $data['fullname']=$this->session->userdata('userFullName');
 
		  $typeReport= $this->input->post("typeReport");
		  $provinsiId= $this->input->post("myProvinsiId");
		  $periodId= $this->input->post("myPeriodId");
		  $targetId= $this->input->post("myTargetId");

		  if($provinsiId=="ALL"){
			  $data['provinsiId'] ="";
		  }else{
			  $data['provinsiId'] = $provinsiId;
		  }
		  if($targetId=="ALL"){
			  $data['targetId'] ="";
		  }else{
			  $data['targetId'] = $targetId;
		  }
		  if($periodId=="ALL"){
			  $data['tahunAnggaran'] ="";
			  $data['year'] ="";
		  }else{
			  $data['tahunAnggaran'] = substr($periodId,1,4);
			  $data['year'] =substr($periodId,1,4);;
		  }

		  $data['typeReport'] =$typeReport;

		  $data['c'] ="";
		  $data['month'] ="07";


		$this->client = new  nusoap_client('http://167.160.170.99/wsdlReport/puGetReportTarget.php?wsdl', true);
		$this->load->view("report/rptUsulanByTarget",$data);
	 } 
 
 
 
 	 public function rptSumUsulanByProvinsiKabupaten(){
		  $data['userName']=$this->session->userdata('userName');
		  $data['fullname']=$this->session->userdata('userFullName');
 
		  $provinsiId= $this->input->post("myProvinsiId");
		  $periodId= $this->input->post("myPeriodId");
		  $myTypeReport= "sum";
		  $targetId= $this->input->post("myTargetId");

		   if($provinsiId=="ALL"){
			  $data['provinsiId'] ="";
		  }else{
			  $data['provinsiId'] = $provinsiId;
		  } 
		  if($targetId=="ALL"){
			  $data['targetId'] ="";
		  }else{
			  $data['targetId'] = $targetId;
		  }
		  if($periodId=="ALL"){
			  $data['tahunAnggaran'] ="";
			  $data['year'] ="";
		  }else{
			  $data['tahunAnggaran'] = substr($periodId,1,4);
			  $data['year'] =substr($periodId,1,4);;
		  }
		  $data['typeReport'] =$myTypeReport;

		  $data['c'] ="";
		  $data['month'] ="07";


		$this->client = new  nusoap_client('http://167.160.170.99/wsdlReport/puGetReportProvinsi.php?wsdl', true);
		$this->load->view("report/rptSumUsulanByProvinsiKabupaten",$data);
	 } 
 
  
 	 public function rptSumUsulanByProvinsi(){
		  $data['userName']=$this->session->userdata('userName');
		  $data['fullname']=$this->session->userdata('userFullName');
 
		  $provinsiId= $this->input->post("myProvinsiId");
		  $periodId= $this->input->post("myPeriodId");
		  $myTypeReport= "sum";
		  $targetId= $this->input->post("myTargetId");

		   if($provinsiId=="ALL"){
			  $data['provinsiId'] ="";
		  }else{
			  $data['provinsiId'] = $provinsiId;
		  } 
		  if($targetId=="ALL"){
			  $data['targetId'] ="";
		  }else{
			  $data['targetId'] = $targetId;
		  }
		  if($periodId=="ALL"){
			  $data['tahunAnggaran'] ="";
			  $data['year'] ="";
		  }else{
			  $data['tahunAnggaran'] = substr($periodId,1,4);
			  $data['year'] =substr($periodId,1,4);;
		  }
		  $data['typeReport'] =$myTypeReport;

		  $data['c'] ="";
		  $data['month'] ="07";


		$this->client = new  nusoap_client('http://167.160.170.99/wsdlReport/puGetReportProvinsi.php?wsdl', true);
		$this->load->view("report/rptSumUsulanByProvinsi",$data);
	 } 
 
 
	 public function rptSumUsulanByTargetProvinsi(){
		  $data['userName']=$this->session->userdata('userName');
		  $data['fullname']=$this->session->userdata('userFullName');
 
		  $provinsiId= $this->input->post("myProvinsiId");
		  $periodId= $this->input->post("myPeriodId");
		  $myTypeReport= "sum";
		  $targetId= $this->input->post("myTargetId");

		   if($provinsiId=="ALL"){
			  $data['provinsiId'] ="";
		  }else{
			  $data['provinsiId'] = $provinsiId;
		  } 
		  if($targetId=="ALL"){
			  $data['targetId'] ="";
		  }else{
			  $data['targetId'] = $targetId;
		  }
		  if($periodId=="ALL"){
			  $data['tahunAnggaran'] ="";
			  $data['year'] ="";
		  }else{
			  $data['tahunAnggaran'] = substr($periodId,1,4);
			  $data['year'] =substr($periodId,1,4);;
		  }
		  $data['typeReport'] =$myTypeReport;

		  $data['c'] ="";
		  $data['month'] ="07";


		$this->client = new  nusoap_client('http://167.160.170.99/wsdlReport/puGetReportTarget.php?wsdl', true);
		$this->load->view("report/rptSumUsulanByTargetProvinsi",$data);
	 } 
 

	 public function rptSumUsulanByTarget(){
		  $data['userName']=$this->session->userdata('userName');
		  $data['fullname']=$this->session->userdata('userFullName');
 
		  $provinsiId= $this->input->post("myProvinsiId");
		  $periodId= $this->input->post("myPeriodId");
		  $myTypeReport= "sum";
		  $targetId= $this->input->post("myTargetId");

		   if($provinsiId=="ALL"){
			  $data['provinsiId'] ="";
		  }else{
			  $data['provinsiId'] = $provinsiId;
		  } 
		  if($targetId=="ALL"){
			  $data['targetId'] ="";
		  }else{
			  $data['targetId'] = $targetId;
		  }
		  if($periodId=="ALL"){
			  $data['tahunAnggaran'] ="";
			  $data['year'] ="";
		  }else{
			  $data['tahunAnggaran'] = substr($periodId,1,4);
			  $data['year'] =substr($periodId,1,4);;
		  }
		  $data['typeReport'] =$myTypeReport;

		  $data['c'] ="";
		  $data['month'] ="07";


		$this->client = new  nusoap_client('http://167.160.170.99/wsdlReport/puGetReportTarget.php?wsdl', true);
		$this->load->view("report/rptSumUsulanByTarget",$data);
	 } 
 
  
  

   
	
 
}
