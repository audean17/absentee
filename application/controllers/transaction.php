<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Transaction extends CI_Controller {

    // Nama table
    private $table = "bjb_tp_transaction";
    // Primary key table
    private $primary = "transaction_id";
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
    private $linkController = "transaction";

    private $qBank = "select bank_id,bank_name from bjb_tm_bank b  where b.status in (1)  order by bank_id ASC";
    private $qProduct = "select product_id,product_name from bjb_tm_product b where b.status in (1)  order by product_id ASC";
    private $qInsurance = "select insurance_id,insurance_name from bjb_tm_insurance b where b.status in (1)  order by insurance_id ASC";
    private $qPeriode = "select periode_id, periode_name from  bjb_tm_periode a  where a.status in (1) order by periode_id ASC";
    private $qRangeTime = "select range_time_id, range_time from  bjb_tm_range_time a  where a.status in (1) order by range_time_id ASC";

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('userId')) {
            redirect('login');
        }
    }

    public function index($offset = null) {

        $data['linkForm'] = site_url($this->linkController.'/create');
         $data['linkSearch'] = site_url($this->linkController.'/retrive');


  		$data['listTransaction'] = $this->db->query("select  DATE_FORMAT(a.credit_begin_date,'%Y%m') as year,
DATE_FORMAT(a.credit_begin_date,'%M %Y') as periode, a.*, b.bank_name,c.product_name,d.insurance_name, e.range_time,
DATE_FORMAT(a.credit_begin_date,'%Y/%m/%d') as credit_begin_date_2,
DATE_FORMAT(a.credit_begin_date,'%Y/%m/%d') as credit_end_date_2
from bjb_tp_transaction a
inner join bjb_tm_bank b on a.bank_id = b.bank_id
inner join bjb_tm_product c on a.product_id = c.product_id
inner join bjb_tm_insurance d on a.insurance_id = d.insurance_id
inner join bjb_tm_range_time e on a.range_time_id = e.range_time_id
where a.status  in (1) and DATE_FORMAT(a.credit_begin_date,'%Y')='".date('Y')."'
order by a.transaction_id desc")->result();

   		$data['banks'] = $this->db->query($this->qBank)->result();

		$data['products'] = $this->db->query($this->qProduct)->result();

		$data['insurances'] = $this->db->query($this->qInsurance)->result();

  		$data['periods'] = $this->db->query($this->qPeriode)->result();
		$data['periodeId']=date('Y');
  		$data['rangeTimes'] = $this->db->query($this->qRangeTime)->result();
 		$data['tittlepage']="BJB Transaction";
		$data['cssVendorSpecific']="
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/select2/css/select2.css\" />
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/select2-bootstrap-theme/select2-bootstrap.css\" />
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/jquery-datatables-bs3/assets/css/datatables.css\" />
		";

		$data['userName']=$this->session->userdata('userName');
		$data['fullname']=$this->session->userdata('userFullName');

		$data['titleContent']="BJB Transaction";
		$data['LeftCaption']="<li>
									<a href=\"".site_url('headline')."\">
										<i class=\"fa fa-home\"></i>
									</a>
								</li>
								<li><span>Data Master</span></li>
								<li><span>BJB Transaction</span></li>
								";
		$data['titleTable']="Transaction with details";


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

/*
	$data['mnDataMasterLiParentClass']="class=\"nav-parent\"";
	$data['mnDataMasterLiDepartmentClass']="";
	$data['mnDataMasterLiDesignationClass']="";
	$data['mnDataMasterLiEmployeeClass']="";

  $data['mnHrmLiParentClass']="class=\"nav-parent\"";
  $data['mnHrmLiAbsenteeClass']="";
  $data['mnHrmliPengajuanClass']="";
  $data['mnHrmliManagerApproveClass']="";

	$data['mnBjbLiParentClass']="class=\"nav-parent nav-expanded nav-active\"";
	$data['mnBjbLiTransactionClass']="class=\"nav-active\"";

  $data['mnDataGALiParentClass']="class=\"nav-parent\"";
  $data['mnDataGALiInventoryClass']="";


	$data['mnAdministratorLiParentClass']="class=\"nav-parent\"";
	$data['mnAdministratorLiGroupsClass']="";
	$data['mnAdministratorLiUsersClass']="";


	$data['mnToolsLiParentClass']="class=\"nav-parent\"";
	$data['mnToolsLiUploadAbsentClass']="";
	//$data['typePage']="header";
*/
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
$data['mnDataBJBLiBankClass']="";
$data['mnDataBJBLiInsuranceClass']="";
$data['mnDataBJBLiProductClass']="";
$data['mnDataBJBLiTransactionClass']="class=\"nav-active\"";

$data['mnAdministratorLiParentClass']="class=\"nav-parent\"";
$data['mnAdministratorLiGroupsClass']="";
$data['mnAdministratorLiUsersClass']="";

$data['mnToolsLiParentClass']="class=\"nav-parent\"";
$data['mnToolsLiUploadAbsentClass']="";

	    $this->load->view('pgTransactionVw', $data);

    }


    public function retrive() {

		$periodeId=$this->input->post("periodeId");
		$bankId=$this->input->post("bankId");

		$clausa= "";
		if (strlen($periodeId)==0 || $periodeId == ""  || $periodeId == "-1" ){
			$clausa.= " ";
		}else{
			$clausa.= " and DATE_FORMAT(a.credit_begin_date,'%Y')='".$periodeId."' ";

		}


		if (strlen($bankId)==0 || $bankId == ""  || $bankId == "-1" ){
			$clausa.= " ";
		}else{
			$clausa.= " and a.bank_id='".$bankId."'";

		}

		   $data['linkForm'] = site_url($this->linkController.'/create');
			$data['listTransaction'] = $this->db->query("select  DATE_FORMAT(a.credit_begin_date,'%Y%m') as year,
DATE_FORMAT(a.credit_begin_date,'%M %Y') as periode, a.*, b.bank_name,c.product_name,d.insurance_name, e.range_time,
DATE_FORMAT(a.credit_begin_date,'%Y/%m/%d') as credit_begin_date_2,
DATE_FORMAT(a.credit_begin_date,'%Y/%m/%d') as credit_end_date_2
from bjb_tp_transaction a
inner join bjb_tm_bank b on a.bank_id = b.bank_id
inner join bjb_tm_product c on a.product_id = c.product_id
inner join bjb_tm_insurance d on a.insurance_id = d.insurance_id
inner join bjb_tm_range_time e on a.range_time_id = e.range_time_id
where a.status  in (1) " .$clausa. "
order by a.transaction_id desc")->result();

   		$data['banks'] = $this->db->query($this->qBank)->result();

		$data['products'] = $this->db->query($this->qProduct)->result();

		$data['insurances'] = $this->db->query($this->qInsurance)->result();

  		$data['periods'] = $this->db->query($this->qPeriode)->result();
		$data['periodeId']=date('Y');
  		$data['rangeTimes'] = $this->db->query($this->qRangeTime)->result();
 		$data['tittlepage']="BJB Transaction";
		$data['cssVendorSpecific']="
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/select2/css/select2.css\" />
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/select2-bootstrap-theme/select2-bootstrap.css\" />
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/jquery-datatables-bs3/assets/css/datatables.css\" />
		";

		$data['userName']=$this->session->userdata('userName');
		$data['fullname']=$this->session->userdata('userFullName');

		$data['titleContent']="BJB Transaction";
		$data['LeftCaption']="<li>
									<a href=\"".site_url('headline')."\">
										<i class=\"fa fa-home\"></i>
									</a>
								</li>
								<li><span>Data Master</span></li>
								<li><span>BJB Transaction</span></li>
								";
		$data['titleTable']="Transaction with details";


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

	$data['mnHrmLiParentClass']="class=\"nav-parent \"";
	$data['mnHrmLiAbsenteeClass']="";

	$data['mnBjbLiParentClass']="class=\"nav-parent nav-expanded nav-active\"";
	$data['mnBjbLiTransactionClass']="class=\"nav-active\"";


	$data['mnAdministratorLiParentClass']="class=\"nav-parent\"";
	$data['mnAdministratorLiGroupsClass']="";
	$data['mnAdministratorLiUsersClass']="";


	$data['mnToolsLiParentClass']="class=\"nav-parent\"";
	$data['mnToolsLiUploadAbsentClass']="";
	//$data['typePage']="header";

		$data['periodeId']=$periodeId;
		$data['bankId']=$bankId;
	    $this->load->view('pgTransactionVw', $data);

    }



   public function create(){
      $row = array();

 		  $productId=$this->input->post("productId");
		  $insuranceId=$this->input->post("insuranceId");
		  $bankId=$this->input->post("bankId");
		  $rangeTimeId=$this->input->post("rangeTimeId");

		  $polisNumber=$this->input->post("polisNumber");
		  $referenceNumber=$this->input->post("referenceNumber");
		  $customerName=$this->input->post("customerName");
		  $dateOfBirth=$this->input->post("dateOfBirth");
		  $creditBeginDate=$this->input->post("creditBeginDate");
		  $creditEndDate=$this->input->post("creditEndDate");
		  $coverage=$this->input->post("coverage");
		  $percentageBrokerage=$this->input->post("percentageBrokerage");
		  $percentageFeebase=$this->input->post("percentageFeebase");


		if (strlen($productId)==0 || $productId == ""  || $productId == "-1" ){
            $msg = "Nama produk harus dipilih. ";
            $data = array(
                "msg" => $msg,
                "success" => 0
            );
		}else if (strlen($insuranceId)==0 || $insuranceId == ""  || $insuranceId == "-1" ){
            $msg = "Asuransi harus dipilih. ";
            $data = array(
                "msg" => $msg,
                "success" => 0
            );
		}else if (strlen($bankId)==0 || $bankId == ""  || $bankId == "-1" ){
            $msg = "Bank harus dipilih. ";
            $data = array(
                "msg" => $msg,
                "success" => 0
            );
		}else if (strlen($rangeTimeId)==0 || $rangeTimeId == ""  || $rangeTimeId == "-1" ){
            $msg = "range time harus dipilih. ";
            $data = array(
                "msg" => $msg,
                "success" => 0
            );
		}else if (strlen($customerName)==0 || $customerName == "" ){
            $msg = "customer harus diisi. ";
            $data = array(
                "msg" => $msg,
                "success" => 0
            );
		}else if (strlen($dateOfBirth)==0 || $dateOfBirth == "" ){
            $msg = "tanggal lahir harus diisi. ";
            $data = array(
                "msg" => $msg,
                "success" => 0
            );
		}else if (strlen($creditBeginDate)==0 || $creditBeginDate == "" ){
            $msg = "tanggal mulai kredit harus diisi. ";
            $data = array(
                "msg" => $msg,
                "success" => 0
            );
 		}else if (strlen($creditEndDate)==0 || $creditEndDate == "" ){
            $msg = "tanggal akhir kredit harus diisi. ";
            $data = array(
                "msg" => $msg,
                "success" => 0
            );
		}else if (strlen($coverage)==0 || $coverage == "" ){
            $msg = "coverage harus diisi. ";
            $data = array(
                "msg" => $msg,
                "success" => 0
            );
		}else if (strlen($percentageBrokerage)==0 || $percentageBrokerage == "" ){
            $msg = "Percentase broker harus diisi. ";
            $data = array(
                "msg" => $msg,
                "success" => 0
            );
		}else if (strlen($percentageFeebase)==0 || $percentageFeebase == "" ){
            $msg = "percentase Feebase harus diisi. ";
            $data = array(
                "msg" => $msg,
                "success" => 0
            );
        } else {
		    try {
					$id=$this->generateKey();
					$row['transaction_id'] = $id;
					$row['product_id'] = $productId;
					$row['insurance_id'] = $insuranceId;
					$row['bank_id'] = $bankId;
					$row['polis_number'] = $polisNumber;
					$row['reference_number'] = $referenceNumber;
					$row['customer_name'] = $customerName;
					$row['date_of_birth'] = $dateOfBirth;
					$row['credit_begin_date'] = $creditBeginDate;
					$row['credit_end_date'] = $creditEndDate;
					$row['range_time_id'] = $rangeTimeId;
					$row['coverage'] = $coverage;
					$row['percentage_brokerage'] = $percentageBrokerage;
					$row['percentage_feebase'] = $percentageFeebase;

					$myRate=0;
					$myPremium=0;
					$myBrokerage=0;
					$myPremiumNet=0;
					$myFeeBase=0;

					$myQuery="select rate from bjb_tm_range_time a
							WHERE a.range_time_id = '".$this->input->post("rangeTimeId")."'";
					$cek = $this->db->query($myQuery);
					if ($cek->num_rows() > 0) {
						$get = $cek->row();
						$myRate=$get->rate;
						$myPremium=$get->rate * $coverage;
						$myBrokerage=$myPremium * $percentageBrokerage/100;
						$myPremiumNet=$myPremium-$myBrokerage;
						$myFeeBase=$myBrokerage * $percentageFeebase/100;

					}
					$row['rate'] = $myRate;
					$row['premium'] = $myPremium;
					$row['brokerage'] = $myBrokerage;
					$row['premium_net'] = $myPremiumNet;
					$row['fee_base'] = $myFeeBase;

					$row['status'] = 1;
					$row['dt_etr'] = date('Y-m-d H:i:s');
					$row['user_etr'] = $this->session->userdata('userId');
					$row['dt_update'] = date('Y-m-d H:i:s');
					$row['user_update'] = $this->session->userdata('userId');

					$this->db->insert($this->table, $row);

					$msg = "Data sudah berhasil di simpan";
					$data = array(
						"transactionId" => $id,
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

   public function update(){
      $row = array();
      $id = $this->input->post("transactionId");
      $productId=$this->input->post("productId");
		  $insuranceId=$this->input->post("insuranceId");
		  $bankId=$this->input->post("bankId");
		  $rangeTimeId=$this->input->post("rangeTimeId");

		  $polisNumber=$this->input->post("polisNumber");
		  $referenceNumber=$this->input->post("referenceNumber");
		  $customerName=$this->input->post("customerName");
		  $dateOfBirth=$this->input->post("dateOfBirth");
		  $creditBeginDate=$this->input->post("creditBeginDate");
		  $creditEndDate=$this->input->post("creditEndDate");
		  $coverage=$this->input->post("coverage");
		  $percentageBrokerage=$this->input->post("percentageBrokerage");
		  $percentageFeebase=$this->input->post("percentageFeebase");


		if (strlen($id)==0 || $id == "" ){
            $msg = "tidak ada data yang harus di update. ";
            $data = array(
                "msg" => $msg,
                "success" => 0
            );
		}else if (strlen($productId)==0 || $productId == ""  || $productId == "-1" ){
            $msg = "Nama produk harus dipilih. ";
            $data = array(
                "msg" => $msg,
                "success" => 0
            );
		}else if (strlen($insuranceId)==0 || $insuranceId == ""  || $insuranceId == "-1" ){
            $msg = "Asuransi harus dipilih. ";
            $data = array(
                "msg" => $msg,
                "success" => 0
            );
		}else if (strlen($bankId)==0 || $bankId == ""  || $bankId == "-1" ){
            $msg = "Bank harus dipilih. ";
            $data = array(
                "msg" => $msg,
                "success" => 0
            );
		}else if (strlen($rangeTimeId)==0 || $rangeTimeId == ""  || $rangeTimeId == "-1" ){
            $msg = "range time harus dipilih. ";
            $data = array(
                "msg" => $msg,
                "success" => 0
            );
		}else if (strlen($customerName)==0 || $customerName == "" ){
            $msg = "customer harus diisi. ";
            $data = array(
                "msg" => $msg,
                "success" => 0
            );
		}else if (strlen($dateOfBirth)==0 || $dateOfBirth == "" ){
            $msg = "tanggal lahir harus diisi. ";
            $data = array(
                "msg" => $msg,
                "success" => 0
            );
		}else if (strlen($creditBeginDate)==0 || $creditBeginDate == "" ){
            $msg = "tanggal mulai kredit harus diisi. ";
            $data = array(
                "msg" => $msg,
                "success" => 0
            );
 		}else if (strlen($creditEndDate)==0 || $creditEndDate == "" ){
            $msg = "tanggal akhir kredit harus diisi. ";
            $data = array(
                "msg" => $msg,
                "success" => 0
            );
		}else if (strlen($coverage)==0 || $coverage == "" ){
            $msg = "coverage harus diisi. ";
            $data = array(
                "msg" => $msg,
                "success" => 0
            );
		}else if (strlen($percentageBrokerage)==0 || $percentageBrokerage == "" ){
            $msg = "Percentase broker harus diisi. ";
            $data = array(
                "msg" => $msg,
                "success" => 0
            );
		}else if (strlen($percentageFeebase)==0 || $percentageFeebase == "" ){
            $msg = "percentase Feebase harus diisi. ";
            $data = array(
                "msg" => $msg,
                "success" => 0
            );
        } else {
		    try {
 					$row['product_id'] = $productId;
					$row['insurance_id'] = $insuranceId;
					$row['bank_id'] = $bankId;
					$row['polis_number'] = $polisNumber;
					$row['reference_number'] = $referenceNumber;
					$row['customer_name'] = $customerName;
					$row['date_of_birth'] = $dateOfBirth;
					$row['credit_begin_date'] = $creditBeginDate;
					$row['credit_end_date'] = $creditEndDate;
					$row['range_time_id'] = $rangeTimeId;
					$row['coverage'] = $coverage;
					$row['percentage_brokerage'] = $percentageBrokerage;
					$row['percentage_feebase'] = $percentageFeebase;

					$myRate=0;
					$myPremium=0;
					$myBrokerage=0;
					$myPremiumNet=0;
					$myFeeBase=0;

					$myQuery="select rate from bjb_tm_range_time a
							WHERE a.range_time_id = '".$rangeTimeId."'";
					$cek = $this->db->query($myQuery);
					if ($cek->num_rows() > 0) {
						$get = $cek->row();
						$myRate=$get->rate;
						$myPremium=$get->rate * $this->input->post("coverage");
						$myBrokerage=$myPremium * $percentageBrokerage/100;
						$myPremiumNet=$myPremium-$myBrokerage;
						$myFeeBase=$myBrokerage * $percentageFeebase/100;

					}
					$row['rate'] = $myRate;
					$row['premium'] = $myPremium;
					$row['brokerage'] = $myBrokerage;
					$row['premium_net'] = $myPremiumNet;
					$row['fee_base'] = $myFeeBase;

 					$row['dt_update'] = date('Y-m-d H:i:s');
					$row['user_update'] = $this->session->userdata('userId');

					$this->db->where("transaction_id", $id)->update($this->table, $row);

					$msg = "Data sudah berhasil di simpan";
					$data = array(
						"transactionId" => $id,
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





    public function delete($id){
        $this->db->where($this->primary, $id);
        $this->db->delete($this->table);
        redirect(site_url($this->linkController));
    }

	public function generateKey($additional_string="",$additional_criteria="") {
		$currentdate=date("Ym");
			$no_of_trailing=4;
			$string="TR".$currentdate;
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
