<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Upload extends CI_Controller {

    // Nama table
    private $table = "tp_absentee";
    // Primary key table
    private $primary = "employee_id";
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
    private $linkController = "upload";

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('userId')) {
            redirect('login');
        }
 	    $this->load->library("IOFactory");

    }

    public function index($offset = null) {

		//$test=get_include_path() . PATH_SEPARATOR . '../../libraries/';
		//die($test);
        $data['linkForm'] = site_url($this->linkController.'/upload');
   		//$data['groups'] = $this->db->query("select a.*,case when status = 1 then 'Yes' when status=0 then 'No' end as my_status from tm_department a where status in (1,0,9) order by department_name ASC")->result();

 		$data['tittlepage']="Upload";
		$data['cssVendorSpecific']="
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/select2/css/select2.css\" />
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/select2-bootstrap-theme/select2-bootstrap.css\" />
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/jquery-datatables-bs3/assets/css/datatables.css\" />
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css\" />
		";

		$data['userName']=$this->session->userdata('userName');
		$data['fullname']=$this->session->userdata('userFullName');

		$data['titleContent']="Upload";
		$data['LeftCaption']="<li>
									<a href=\"".site_url('headline')."\">
										<i class=\"fa fa-home\"></i>
									</a>
								</li>
								<li><span>Data Master</span></li>
								<li><span>Upload</span></li>
								";
		$data['titleTable']="Upload with details";


	  $data['vendorJavascript']="
		<script src=\"".base_url()."assets/porto/vendor/select2/js/select2.js\"></script>
		<script src=\"".base_url()."assets/porto/vendor/jquery-datatables/media/js/jquery.dataTables.js\"></script>
		<script src=\"".base_url()."assets/porto/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js\"></script>
		<script src=\"".base_url()."assets/porto/vendor/jquery-datatables-bs3/assets/js/datatables.js\"></script>
		<script src=\"".base_url()."assets/porto/vendor/autosize/autosize.js\"></script>
		<script src=\"".base_url()."assets/porto/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js\"></script>
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
	$data['mnDataMasterLiEmployeeClass']="";
	$data['mnDataMasterLiDesignationClass']="";
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


	$data['mnToolsLiParentClass']="class=\"nav-parent nav-expanded nav-active\"";
	$data['mnToolsLiUploadAbsentClass']="class=\"nav-active\"";

	$data['nowMonth']="03";
	$data['nowYear']="2017";



	    $this->load->view('pgUploadVw', $data);

    }




 public function make_seed() {
    list($usec, $sec) = explode(' ', microtime());
    return (float) $sec + ((float) $usec * 100000);
}


     public function uploadFile($monthYear){


		mt_srand($this->make_seed());
		$randval = mt_rand();

		$random=substr($randval,0);
		$jml_random=strlen($random);
		if ($jml_random<10){
		  if (10-$jml_random==1) $random=$random . "0";
		  if (10-$jml_random==2) $random=$random . "00";
		  if (10-$jml_random==3) $random=$random . "000";
		  if (10-$jml_random==4) $random=$random . "0000";
		  if (10-$jml_random==5) $random=$random . "00000";
		  if (10-$jml_random==6) $random=$random . "000000";
		  if (10-$jml_random==7) $random=$random . "0000000";

		}

		$arrMonthYear=explode("-",$monthYear);

		$myMonth=$arrMonthYear[0];
		$myYear=$arrMonthYear[1];
			//$myMonth="";
		/*check tabel detail item yang sudah ke jual*/


		if (strlen($myMonth)==0 || $myMonth == ""  || $myMonth == "-1" ){
            $msg = "Bulan harus di pilih. ";
            $data = array(
                "msg" => $msg." ".$arrMonthYear[1],
                "success" => 0
            );
        } else {

		    try {






				$target_dir="./assets/absentFile/upload/";
				$monthName = date('F', mktime(0, 0, 0, $myMonth, 10));
				//$namaBaru="Fauzan.xlsx";
				$namaBaru=$myYear."".$monthName.$random.".xlsx";

				//$target_file = $target_dir . basename($_FILES["fileName"]["name"]);
				$target_file = $target_dir . $namaBaru;


				$uploadOk = 1;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


				if (file_exists($target_file)) {
					//echo "Sorry, file already exists.";
				   unlink($target_file);
				}


				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
					echo "Sorry, your file was not uploaded.";
				// if everything is ok, try to upload file
				} else {
					if (move_uploaded_file($_FILES["fileName"]["tmp_name"], $target_file)) {
						$msg= "The file ". basename( $_FILES["fileName"]["name"]). " has been uploaded.";
					} else {
						$msg= "Sorry, there was an error uploading your file.";
					}
				}


 				//$inputFileName = './assets/absentFile/upload/'.basename($_FILES["fileName"]["name"]);
				$inputFileName = './assets/absentFile/upload/'.$namaBaru;

				$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
 				$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);

				$myYearExcel="fauzan";
				$myMonthExcel = "achmad ";
				foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
					$worksheetTitle     = $worksheet->getTitle();
					$highestRow         = $worksheet->getHighestRow(); // e.g. 10
					$highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
					$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
					$nrColumns = ord($highestColumn) - 64;

					$cell = $worksheet->getCellByColumnAndRow('1', 8);
					$myYearExcel = $cell->getValue();
					$cell = $worksheet->getCellByColumnAndRow('2', 8);
					$myMonthExcel = $cell->getValue();
					$monthName = date('F', mktime(0, 0, 0, $myMonthExcel, 10));//F or M


					switch ($myMonth){
						case '1':
						case '3':
						case '5':
						case '7':
						case '8':
						case '10':
						case '12':
							$myLastDay=31;
							break;
						case '4':
						case '6':
						case '9':
						case '11':
							$myLastDay=30;
							break;
						case '2':
						 $isLeapYear = (bool) date('L', strtotime("$myYear-01-01"));

							if ($isLeapYear== true){
								//echo 'is';
								$myLastDay=29;
							}
							else {
								$myLastDay=28;
							}
							break;

					}

					$myStart="08:00";
					$cutOffAbsent="09:00";
					$cutOffAbsent2="09:14";
					$arrEmployeeId=array();
					//$arrIN=array();
					$isCutCuti=0;
					$cutOffAbsentDes="cut 1/4";
					$statusPotongCuti="C";
					$fauYearMonth="";
					$fauYear="";
					$fauMonth="";
					for ($i = 0; $i <= $highestRow-8; ++ $i) {
						$row=8+$i;


							$cell = $worksheet->getCellByColumnAndRow('5', $row);
							$arrEmployeeId[$i] = $cell->getValue();
							/*
							$cell = $worksheet->getCellByColumnAndRow('6', $row);
							$namaAwal = $cell->getValue();

							$cell = $worksheet->getCellByColumnAndRow('7', $row);
							$namaAkhir = $cell->getValue();
							echo '<td>' . $namaAwal.' '.$namaAkhir . ' </td>';
							*/
							$cell = $worksheet->getCellByColumnAndRow('1', $row);
							$fauYear = $cell->getValue();

							$cell = $worksheet->getCellByColumnAndRow('2', $row);
							$fauMonth = $cell->getValue();

							$fauYearMonth=$fauYear."-".$fauMonth;

							$myCellStart=8;

							for ($r=0;$r<$myLastDay;$r++){


								$cell = $worksheet->getCellByColumnAndRow($myCellStart, $row);
								if (substr($cell->getValue(),1,11)=="IF(Table_BF"){

									$arrIN[$i][$r]="";
									$arrOUT[$i][$r]="";
									$arrOvertime[$r]=0;
									$arrHour[$i][$r]=0;
									$arrHoureffective[$i][$r]=0;
									$arrIsPotongCuti[$i][$r]=0;
									$arrStatusPotongCuti[$i][$r]="A";
									//$arrFauYearMonth[$i][$r]=$fauYearMonth."-".$r+1;

								}else {
									$IN = PHPExcel_Style_NumberFormat::toFormattedString($cell->getCalculatedValue(), 'hh:mm:ss');
									$myCekStart = (strtotime($myStart) - strtotime($IN)) / 3600; //untuk mengecek datang kurang dari jam 08
									if($myCekStart>0){$myStartIn=$myStart;}else{$myStartIn=$IN;} //jika ada, jam datang di inisialisasi ke jam 8 yang mana digunakan untuk menghitung overtime
									//echo '<td style="border-left:2px black solid;">' . $IN . ' </td>';

									$cell = $worksheet->getCellByColumnAndRow($myCellStart+1, $row);
									$OUT = PHPExcel_Style_NumberFormat::toFormattedString($cell->getCalculatedValue(), 'hh:mm:ss');
									$myCekStart = (strtotime($myStart) - strtotime($OUT)) / 3600; //untuk mengecek pulang kurang dari jam 08
									if($myCekStart>0){$myStartOut=$myStart;}else{$myStartOut=$OUT;} //jika ada, jam pulang di inisialisasi ke jam 8 yang mana digunakan untuk menghitung overtime
									// echo '<td>' . $OUT . ' </td>';

									 //Menghitung Hour effektif
									 $houreffective= (strtotime($myStartOut) - strtotime($myStartIn)) / 3600;;

									$cell = $worksheet->getCellByColumnAndRow($myCellStart+2, $row);
									$hour = $cell->getValue();
									//echo '<td style="text-align:right;">' . $hour . ' </td>';
									//echo '<td style="text-align:right;">' . number_format($houreffective,2,",",".") . ' </td>';


									$overtime = $houreffective-9;
									$myCekcutOffAbsent = (strtotime($IN) - strtotime($cutOffAbsent)) / 3600; //untuk mengecek datang lebih dari jam 09
									if ($myCekcutOffAbsent>0){
										$myCekcutOffAbsent2 = (strtotime($IN) - strtotime($cutOffAbsent2)) / 3600; //untuk mengecek datang kurang dari jam 08
										if ($myCekcutOffAbsent2>0){
											$cutOffAbsentDes="cut 1/4";
											$statusPotongCuti="C";
											$isCutCuti=1;
										}else{
											$cutOffAbsentDes="warning";
											$statusPotongCuti="W";
											$isCutCuti=1;

										}
									}else{
										$cutOffAbsentDes="";
										$statusPotongCuti="N";
										$isCutCuti=0;
									}

									//echo '<td style="text-align:right;">' . $cutOffAbsentDes . ' </td>';

									$arrIN[$i][$r]=$IN;
									$arrOUT[$i][$r]=$OUT;
									$arrOvertime[$i][$r]=$overtime;
									$arrHour[$i][$r]=$hour;
									$arrHoureffective[$i][$r]=$houreffective;
									$arrIsPotongCuti[$i][$r]=$isCutCuti;
									$arrStatusPotongCuti[$i][$r]=$statusPotongCuti;
									//$arrFauYearMonth[$i][$r]=$fauYearMonth."-".$r+1;



								}

									$myCellStart=$myCellStart+4;
							}



						//echo '</tr>';
					}


				}

				$this->db->trans_begin();
				 	$row1 = array();
					$row1['upload_id']=$random;
					$row1['file_name'] = $namaBaru;
					$row1['dt_etr'] = date('Y-m-d H:i:s');
					$row1['user_etr'] = $this->session->userdata('userName');

					$this->db->insert("tp_upload_file_name", $row1);

				 	$row2 = array();
					$row2['periode_id']=$myYear."".$myMonth;
					$row2['year'] = $myYear;
					$row2['month'] = $myMonth;
					$row2['status'] = 1;
					$row2['dt_etr'] = date('Y-m-d H:i:s');
					$row2['user_etr'] = $this->session->userdata('userName');
					$row2['dt_etr_closing'] = date('Y-m-d H:i:s');
					$row2['user_etr_closing'] = $this->session->userdata('userName');

					$this->db->insert("tp_absentee_periode", $row2);

				for ($i = 0; $i <= $highestRow-8; ++ $i) {
					$t=0;
					for ($r=0;$r<$myLastDay;$r++){
						 $t=$t+1;
						if ($arrOvertime[$i][$r]>1){
							$is_overtime = 1;
						}else{
							$is_overtime = 0;
						}


					$rowAbsent[]= array(
						'employee_id'=>$arrEmployeeId[$i],
						'date'=>$fauYearMonth."-".$t,
						'in'=>$arrIN[$i][$r],
						'out'=>$arrOUT[$i][$r],
						'hour'=>$arrHour[$i][$r],
						'hour_effective'=>$arrHoureffective[$i][$r],
						'is_overtime'=>$is_overtime,
						'amount_overtime'=>$arrOvertime[$i][$r],
						'is_cut_absentee'=>$arrIsPotongCuti[$i][$r],
						'cut_absentee_type'=>$arrStatusPotongCuti[$i][$r],
						'status'=>1,
						'file_name'=>$namaBaru
					);


					}

				}
 					$this->db->insert_batch($this->table, $rowAbsent);
				$this->db->trans_commit();




				//$msg = "Upload berhasil";
 				$data = array(
					"requestId" =>"fsd",
					"msg" => $msg." - ".count($rowAbsent),
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

}
