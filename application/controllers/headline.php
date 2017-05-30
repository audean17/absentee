<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Headline extends CI_Controller {

    // Nama table
    private $table = "headlines";
    // Primary key table
    private $primary = "idheadline";
    // Field-field data yang ada di database
    private $fields = array(
        'idheadline',
        'main_text',
        'sub_text',
        'created_by',
        'updated_date',
        'updated_by',
        'publish',
        'priority');
    // Link controller

    private $linkController = "testReport";
/*
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
 */
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('userId')) {
            redirect('login');
        }
	    $this->load->library("nusoap");

    }

    public function index() {


		$data['tittlepage']="DASHBOARD";
 		//$data['queryTargetPerUnit'] = $this->db->query($this->queryTargetPerUnit)->result();
 		//$data['querySumPermohonan'] = $this->db->query($this->querySumPermohonan)->result();
		//$data['queryTargetPerRequest'] = $this->db->query($this->queryTargetPerRequest)->result();



		$data['cssVendorSpecific']="
		<link rel=\"stylesheet\" href=\"".base_url()."\"assets/porto/vendor/jquery-ui/jquery-ui.css\" />
		<link rel=\"stylesheet\" href=\"".base_url()."\"assets/porto/vendor/jquery-ui/jquery-ui.theme.css\" />
		<link rel=\"stylesheet\" href=\"".base_url()."\"assets/porto/vendor/bootstrap-multiselect/bootstrap-multiselect.css\" />
		";
		$data['userName']=$this->session->userdata('userName');
		$data['fullname']=$this->session->userdata('userFullName');
		$data['titleContent']="Dashboard";
		$data['LeftCaption']="<li>
									<a href=\"".site_url('headline')."\">
										<i class=\"fa fa-home\"></i>
									</a>
								</li>
								<li><span>Dashboard</span></li>";


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
		<script src=\"".base_url()."assets/porto/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js\"></script>";
	  $data['vendorJavascriptExample']="
<script src=\"".base_url()."assets/porto/javascripts/dashboard/examples.dashboard.js\"></script>";


	$data['modalfau']="";
		$data['myMenu']='';

	$data['mnDataMasterLiParentClass']="class=\"nav-parent\"";
	$data['mnDataMasterLiEmployeeClass']="";
	$data['mnDataMasterLiDepartmentClass']="";
	$data['mnDataMasterLiDesignationClass']="";
  $data['mnDataMasterLiPegawaiClass']="";
  // $data['mnDataMasterLiInventoryClass']="";

  $data['mnDataGALiParentClass']="class=\"nav-parent\"";
  $data['mnDataGALiInventoryClass']="";

  $data['mnDataBJBLiParentClass']="class=\"nav-parent\"";
	$data['mnDataBJBLiBankClass']="";
	$data['mnDataBJBLiInsuranceClass']="";
	$data['mnDataBJBLiProductClass']="";
  $data['mnDataBJBLiTransactionClass']="";

	$data['mnHrmLiParentClass']="class=\"nav-parent\"";
	$data['mnHrmLiAbsenteeClass']="";
  $data['mnHrmliPengajuanClass']="";
  $data['mnHrmliManagerApproveClass']="";
/*	$data['mnRequestLiFormClass']="";
	$data['mnVerminLiFormClass']="";
	$data['mnVerminAnotherLiFormClass']="";
	$data['mnVertekLiFormClass']="";
*/

	$data['mnAdministratorLiParentClass']="class=\"nav-parent\"";
	$data['mnAdministratorLiGroupsClass']="";
	$data['mnAdministratorLiUsersClass']="";

	$data['mnReportLiParentClass']="class=\"nav-parent\"";
	$data['mnReportLiReportTestClass']="";
	$data['mnReportLiWebServiceClass']="";
	$data['mnReportLiGraphClass']="";

	$data['mnMapLiParentClass']="class=\"nav-parent\"";
	$data['mnMapRequestLiFormClass']="";

	$data['mnToolsLiParentClass']="class=\"nav-parent\"";
	$data['mnToolsLiUploadAbsentClass']="";
/*	$data['mnVerminLiFormClass']="";
	$data['mnVerminAnotherLiFormClass']="";
	$data['mnVertekLiFormClass']="";
*/

/*****************************GRAFIK***************************/
  	//$valData=array();
	//$data['dataUnit']=array();
  	//$valDataPropinsi=array();
	//$data['dataPropinsi']=array();
/**************************************************************/
/*	$totalUnit=0;
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

*/
/**************************************************************/

  	    $this->load->view('pgMyGraphVw', $data);

    }


	 public function rptUsulanByProvinsi($type){
		  $data['userName']=$this->session->userdata('userName');
		  $data['fullname']=$this->session->userdata('userFullName');

		  $data['provinsiId'] ="";
		  $data['targetId'] ="";
		  $data['tahunAnggaran'] ="";
		  $data['year'] ="";


		  $data['typeReport'] ="det";

		  $data['c'] ="";
		  $data['month'] ="07";

		  if($type=="all"){
			$data['anotherCriteria']="";
		  }elseif($type=="noSyarat"){
			$data['anotherCriteria']=" and (adm_val_surat_pemohonan +  adm_val_sertifikat_tanah +  adm_val_surat_rtrw)<300  ";
		  }elseif($type=="noVermin"){
			$data['anotherCriteria']=" and (adm_val_surat_pemohonan +  adm_val_sertifikat_tanah +  adm_val_surat_rtrw)=300 and (adm_val_proposal +  adm_val_surat_dukungan +  adm_val_surat_pernyataan+ adm_val_harga_satuan_kota+ adm_val_surat_pengantar_propinsi) < 100 ";
		  }elseif($type=="noVertek"){
			$data['anotherCriteria']=" and (adm_val_surat_pemohonan +  adm_val_sertifikat_tanah +  adm_val_surat_rtrw)=300 and  is_vertek=0 ";
		  }else {
			$data['anotherCriteria']="";
		  }

		$this->client = new  nusoap_client('http://167.160.170.99/wsdlReport/puGetReportProvinsi.php?wsdl', true);
		$this->load->view("report/rptUsulanByProvinsi",$data);


// 	    $this->load->view('openImageVw', $data);

	 }


	 public function requestDetail($rid){
		  $data['userName']=$this->session->userdata('userName');
		  $data['fullname']=$this->session->userdata('userFullName');

		  $data['provinsiId'] ="";
		  $data['targetId'] ="";
		  $data['tahunAnggaran'] ="";
		  $data['year'] ="";

		$query="
			select request_id,umum_pengusul,umum_propinsi_id,umum_no_tgl_disposisi,umum_no_surat,
			umum_tgl_surat,umum_alamat,umum_kontak_person,umum_target_id,umum_lokasi,umum_unit,
			umum_luas_lahan,
adm_val_surat_pemohonan,adm_val_proposal,adm_val_surat_dukungan,adm_val_surat_pernyataan,adm_val_surat_keterangan_dinas,adm_val_sertifikat_tanah,adm_val_harga_satuan_kota,adm_val_surat_pengantar_propinsi,adm_desc_surat_pemohonan,adm_desc_proposal,adm_desc_surat_dukungan,adm_desc_surat_pernyataan,adm_desc_surat_keterangan_dinas,adm_desc_sertifikat_tanah,adm_desc_harga_satuan_kota,adm_desc_surat_pengantar_propinsi,attachment_file_path,a.dt_etr,a.user_etr,adm_total_score, b.propinsi_name , c.target_name,case when adm_total_score < 75 then 'Belum Lengkap' else 'Data Lengkap' end as result_desc,adm_val_surat_rtrw,adm_desc_surat_rtrw,case when ((adm_val_surat_pemohonan+adm_val_sertifikat_tanah+adm_val_surat_rtrw)/3) <>100 then 'Belum Vertek' else case when is_vertek=1 then 'Sudah Vertek' else 'Siap Vertek' end end as status_vertek,case when is_vertek=0 then '' else case when val_vertek=1 then 'OK' else 'NO' end end as val_vertek,desc_vertek
			from tp_request2 a
			inner join tm_propinsi b on a.umum_propinsi_id=b.propinsi_id
			inner join tm_target_group c on a.umum_target_id = c.target_id
			where a.request_id='".$rid."'";

		$data['listKabupatenKota'] = $this->db->query($query)->result();



 	    $this->load->view('pgRequestRumahDetailVw', $data);

	 }




}
