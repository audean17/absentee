<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Mygraph extends CI_Controller {
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
	
	private $queryTargetPerUnit="SELECT a.umum_target_id, sum( umum_unit ) AS jumlah_unit, b.target_name
FROM tp_request2 a
INNER JOIN tm_target_group b ON a.umum_target_id = b.target_id
GROUP BY a.umum_target_id, target_name
ORDER BY target_name ";
 
	private $querySumPermohonan="select sum(umum_unit) AS jumlah_unit, count(request_id) AS jumlah_request FROM tp_request2 a ";
 
	private $queryTargetPerRequest="SELECT a.umum_target_id, count(request_id) AS jumlah_request, b.target_name
FROM tp_request2 a
INNER JOIN tm_target_group b ON a.umum_target_id = b.target_id
GROUP BY a.umum_target_id, target_name
ORDER BY target_name ";
 
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('userId')) {
            redirect('login');
        }
 //	    $this->load->library("nusoap");

    }

    public function index($offset = null) {
	
 	    $data['linkForm'] = site_url($this->linkController.'/create');
 	    $data['linkFormDetail'] = site_url($this->linkController.'/createDetail');
 
 		$data['queryTargetPerUnit'] = $this->db->query($this->queryTargetPerUnit)->result();
 		$data['querySumPermohonan'] = $this->db->query($this->querySumPermohonan)->result();
		$data['queryTargetPerRequest'] = $this->db->query($this->queryTargetPerRequest)->result();
		

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
		$data['titleContent']="Dashboard";
		$data['myMenu']='';
//								<li><span id="btnSearch"><a class="modal-with-form" href="#modalForm" data-target="#modalForm" id="3">
		$data['LeftCaption']="<li>
									<a href=\"".site_url('headline')."\">
										<i class=\"fa fa-home\"></i>
									</a>
								</li>
								<li><span>Dashboard</span></li>
								";
		$data['titleTable']="Dashboard";

      
	  
	  $data['vendorJavascript']="
	  
	    <script src=\"".base_url()."assets/porto/vendor/jquery-ui/jquery-ui.js\"></script>
		<script src=\"".base_url()."assets/porto/vendor/jqueryui-touch-punch/jqueryui-touch-punch.js\"></script>
		<script src=\"".base_url()."assets/porto/vendor/jquery-appear/jquery-appear.js\"></script>
		<script src=\"".base_url()."assets/porto/vendor/bootstrap-multiselect/bootstrap-multiselect.js\"></script>
		
		<script src=\"".base_url()."assets/porto/vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.js\"></script>
		<script src=\"".base_url()."assets/porto/vendor/flot/jquery.flot.js\"></script>
		<script src=\"".base_url()."assets/porto/vendor/flot.tooltip/flot.tooltip.js\"></script>
		<script src=\"".base_url()."assets/porto/vendor/flot/jquery.flot.pie.js\"></script>
		<script src=\"".base_url()."assets/porto/vendor/flot/jquery.flot.categories.js\"></script>
		<script src=\"".base_url()."assets/porto/vendor/flot/jquery.flot.resize.js\"></script>
		<script src=\"".base_url()."assets/porto/vendor/jquery-sparkline/jquery-sparkline.js\"></script>
	
		<script src=\"".base_url()."assets/porto/vendor/raphael/raphael.js\"></script>
		<script src=\"".base_url()."assets/porto/vendor/morris.js/morris.js\"></script>
		<script src=\"".base_url()."assets/porto/vendor/gauge/gauge.js\"></script>
		<script src=\"".base_url()."assets/porto/vendor/snap.svg/snap.svg.js\"></script>
		<script src=\"".base_url()."assets/porto/vendor/liquid-meter/liquid.meter.js\"></script>
		<script src=\"".base_url()."assets/porto/vendor/jqvmap/jquery.vmap.js\"></script>
		<script src=\"".base_url()."assets/porto/vendor/jqvmap/data/jquery.vmap.sampledata.js\"></script>
		<script src=\"".base_url()."assets/porto/vendor/jqvmap/maps/jquery.vmap.world.js\"></script>
		<script src=\"".base_url()."assets/porto/vendor/jqvmap/maps/continents/jquery.vmap.africa.js\"></script>
		<script src=\"".base_url()."assets/porto/vendor/jqvmap/maps/continents/jquery.vmap.asia.js\"></script>
		<script src=\"".base_url()."assets/porto/vendor/jqvmap/maps/continents/jquery.vmap.australia.js\"></script>
		<script src=\"".base_url()."assets/porto/vendor/jqvmap/maps/continents/jquery.vmap.europe.js\"></script>
		<script src=\"".base_url()."assets/porto/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js\"></script>
		<script src=\"".base_url()."assets/porto/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js\"></script>	
			  ";

/*
		<script src=\"".base_url()."assets/porto/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js\"></script>

*/


 	$data['vendorJavascriptExample']="
		<script src=\"".base_url()."assets/porto/javascripts/dashboard/examples.dashboard.js\"></script>
	";	     
/*
		<script src=\"".base_url()."assets/porto/javascripts/tables/examples.datatables.default.js\"></script>
*/
	$data['modalfau']="";

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
	$data['mnReportLiReportTestClass']="";
	$data['mnReportLiWebServiceClass']="";
	$data['mnReportLiGraphClass']="class=\"nav-active\"";

	$data['mnMapLiParentClass']="class=\"nav-parent\"";
	$data['mnMapRequestLiFormClass']="";
	
	
/*****************************GRAFIK***************************/
  	$valData=array();
	$data['dataUnit']=array();
  	$valDataPropinsi=array();
	$data['dataPropinsi']=array();
/**************************************************************/
	$totalUnit=0;
	$totalRequest=0;
	$totalFailSyarat=0;
	$totalNotYetVermin=0;
	$totalNotYetVertek=0;
        $query = $this->db->query($this->querySumPermohonan);
		foreach ($query->result() as $row){
			$totalUnit=$row->jumlah_unit;		
			$totalRequest=$row->jumlah_request;		
		}

       $query = $this->db->query("select count(request_id) as jumlah_unit from tp_request2 where  (adm_val_surat_pemohonan +  adm_val_sertifikat_tanah +  adm_val_surat_rtrw)<300  ");
		foreach ($query->result() as $row){
			$totalFailSyarat=$row->jumlah_unit;		
		}

       $query = $this->db->query("select count(request_id) as jumlah_unit from tp_request2 where  (adm_val_surat_pemohonan +  adm_val_sertifikat_tanah +  adm_val_surat_rtrw)=300 and (adm_val_proposal +  adm_val_surat_dukungan +  adm_val_surat_pernyataan+ adm_val_harga_satuan_kota+ adm_val_surat_pengantar_propinsi) < 100 ");
		foreach ($query->result() as $row){
			$totalNotYetVermin=$row->jumlah_unit;		
		}

       $query = $this->db->query("select count(request_id) as jumlah_unit from tp_request2 where  (adm_val_surat_pemohonan +  adm_val_sertifikat_tanah +  adm_val_surat_rtrw)=300 and  is_vertek=0");
		foreach ($query->result() as $row){
			$totalNotYetVertek=$row->jumlah_unit;		
		}

        $query = $this->db->query($this->queryTargetPerUnit);
		foreach ($query->result() as $row){
			$myVal=($row->jumlah_unit/$totalUnit)*100;
			$myVal=number_format($myVal,2);
			$valData[] = array("label" => $row->target_name, "data" => $myVal);		
		}


        $query = $this->db->query("SELECT a.umum_propinsi_id, sum( umum_unit ) AS jumlah_unit, b.propinsi_name
FROM tp_request2 a
INNER JOIN tm_propinsi b ON a.umum_propinsi_id = b.propinsi_id
GROUP BY a.umum_propinsi_id, propinsi_name
ORDER BY propinsi_name ");
			$strDataPropinsi="";

		foreach ($query->result() as $row){
			$valDataPropinsi[] = array("label" => $row->propinsi_name, "data" => $row->jumlah_unit);		
           //var data = [ ["January", 10], ["February", 8], ["March", 4], ["April", 13], ["May", 17], ["June", 9] ];
			$strDataPropinsi.="[\"".$row->propinsi_name."\", ".$row->jumlah_unit."],";
		}
			$strDataPropinsi=substr($strDataPropinsi,0,strlen($strDataPropinsi)-1);
			$strDataPropinsi="[".$strDataPropinsi."]";

		$data['dataUnit']=$valData;
		$data['dataPropinsi']=$strDataPropinsi;
		$data['totalUnit']=$totalUnit;
		$data['totalRequest']=$totalRequest;
		$data['totalFailSyarat']=$totalFailSyarat;
		$data['totalNotYetVermin']=$totalNotYetVermin;
		$data['totalNotYetVertek']=$totalNotYetVertek;
		

/**************************************************************/
 	    $this->load->view('pgMyGraphVw', $data);

    }
  

 

   
	
 
}
