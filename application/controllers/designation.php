<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Designation extends CI_Controller {

    // Nama table
    private $table = "tm_designation";
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
    private $linkController = "designation";

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('userId')) {
            redirect('login');
        }
    }

    public function index($offset = null) {

      // $data['linkForm'] = site_url($this->linkController.'/create');
   		$data['designations'] = $this->db->query("select a.*,case when is_overtime = 1 then 'Yes' when is_overtime=0 then 'No' end as my_overtime,
		case when is_cut_absentee = 1 then 'Yes' when is_cut_absentee=0 then 'No' end as my_cut_absent,case when status = 1 then 'Yes' when status=0 then 'No' end as my_status
		from tm_designation a where status in (1,0,9) order by designation_name ASC")->result();

 		$data['tittlepage']="Designation";
		$data['cssVendorSpecific']="
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/select2/css/select2.css\" />
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/select2-bootstrap-theme/select2-bootstrap.css\" />
		<link rel=\"stylesheet\" href=\"".base_url()."assets/porto/vendor/jquery-datatables-bs3/assets/css/datatables.css\" />
		";

		$data['userName']=$this->session->userdata('userName');
		$data['fullname']=$this->session->userdata('userFullName');

		$data['titleContent']="Designation";
		$data['LeftCaption']="<li>
									<a href=\"".site_url('headline')."\">
										<i class=\"fa fa-home\"></i>
									</a>
								</li>
								<li><span>Data Master</span></li>
								<li><span>Designation</span></li>
								";
		$data['titleTable']="Designation with details";


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
	$data['mnDataMasterLiDepartmentClass']="";
	$data['mnDataMasterLiEmployeeClass']="";
	$data['mnDataMasterLiDesignationClass']="class=\"nav-active\"";
  $data['mnDataMasterLiPegawaiClass']="";

  $data['mnHrmLiParentClass']="class=\"nav-parent\"";
	$data['mnHrmLiAbsenteeClass']="";
  $data['mnHrmliPengajuanClass']="";
  $data['mnHrmliManagerApproveClass']="";

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


	    $this->load->view('pgDesignationVw', $data);

    }


    public function create(){
         $row = array();

         $designationName=$this->input->post("designationName");
         $isOvertime=$this->input->post("isOvertime");
         $isCutAbsentee=$this->input->post("isCutAbsentee");
         $description=$this->input->post("description");
         $status=$this->input->post("status");

         if (strlen($designationName)==0 || $designationName == "" ){
                 $msg = "Designation Name harus diisi. ";
                 $data = array(
                     "msg" => $msg,
                     "success" => 0
                 );
        }else if (strlen($isOvertime)==0 || $isOvertime == "" || $isOvertime == "-1"){
                  $msg = " Is Overtime harus diisi. ";
                  $data = array(
                        "msg" => $msg,
                        "success" => 0
                 );
        }else if (strlen($isCutAbsentee)==0 || $isCutAbsentee == "" || $isCutAbsentee == "-1"){
                 $msg = " Is Cut Absentee harus diisi. ";
                 $data = array(
                       "msg" => $msg,
                       "success" => 0
                 );
     		}else if (strlen($description)==0 || $description == "" ){
                 $msg = "description harus diisi. ";
                 $data = array(
                     "msg" => $msg,
                     "success" => 0
                 );
        }else if (strlen($status)==0 || $status == "" || $status == "-1"){
                 $msg = "Status harus diisi. ";
                 $data = array(
                       "msg" => $msg,
                       "success" => 0
                 );
               } else {
                       try {
                         $id=$this->generateKey();
                         $row['designation_id'] = $id;
                         $row['designation_name'] = $designationName;
                         $row['is_overtime'] = $isOvertime;
                         $row['is_cut_absentee'] = $isCutAbsentee;
                         $row['description'] = $description;
                         $row['status'] = $status;

                         $row['dt_etr'] = date('Y-m-d H:i:s');
                         $row['user_etr'] = $this->session->userdata('userId');
                         $row['dt_update'] = date('Y-m-d H:i:s');
                         $row['user_update'] = $this->session->userdata('userId');

                         $this->db->insert($this->table, $row);

                         $msg = "Data sudah berhasil di simpan";
                         $data = array(
                           "designationId" => $id,
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
                            $id = $this->input->post("designationId");
                            $designationName=$this->input->post("designationName");
                            $isOvertime=$this->input->post("isOvertime");
                            $isCutAbsentee=$this->input->post("isCutAbsentee");
                            $description=$this->input->post("description");
                            $status=$this->input->post("status");

                            if (strlen($id)==0 || $id == "" ){
                                    $msg = "tidak ada data yang harus di update. ";
                                    $data = array(
                                        "msg" => $msg,
                                        "success" => 0
                                    );
                            }else if (strlen($designationName)==0 || $designationName == "" ){
                                    $msg = "Designation Name harus diisi. ";
                                    $data = array(
                                        "msg" => $msg,
                                        "success" => 0
                                    );
                            }else if (strlen($isOvertime)==0 || $isOvertime == "" || $isOvertime == "-1"){
                                     $msg = " Is Overtime harus diisi. ";
                                     $data = array(
                                           "msg" => $msg,
                                                  "success" => 0
                                     );
                            }else if (strlen($isCutAbsentee)==0 || $isCutAbsentee == "" || $isCutAbsentee == "-1"){
                                     $msg = " Is Cut Absentee harus diisi. ";
                                     $data = array(
                                           "msg" => $msg,
                                           "success" => 0
                                    );
                            }else if (strlen($description)==0 || $description == "" ){
                                     $msg = "description harus diisi. ";
                                     $data = array(
                                            "msg" => $msg,
                                            "success" => 0
                                    );
                          }else if (strlen($status)==0 || $status == "" || $status == "-1"){
                                    $msg = "Status harus diisi. ";
                                    $data = array(
                                          "msg" => $msg,
                                          "success" => 0
                                    );
                                  } else {
                                  try {
                                   //  $row['department_id'] = $departmentId;
                                    $row['designation_name'] = $designationName;
                                    $row['is_overtime'] = $isOvertime;
                                    $row['is_cut_absentee'] = $isCutAbsentee;
                                    $row['description'] = $description;
                                    $row['status'] = $status;

                                    $row['dt_etr'] = date('Y-m-d H:i:s');
                                    $row['user_etr'] = $this->session->userdata('userId');
                                    $row['dt_update'] = date('Y-m-d H:i:s');
                                    $row['user_update'] = $this->session->userdata('userId');

                                    $this->db->where("designation_id", $id)->update($this->table, $row);

                                    $msg = "Data sudah berhasil di simpan";
                                    $data = array(
                                      "designationId" => $id,
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
		$currentdate=date("ym");

			$no_of_trailing=3;
			$string="DS";
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
