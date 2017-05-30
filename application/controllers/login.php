<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if ($this->session->userdata('userId')) {
            redirect('main');
        } else {
			$data["is_smart_phone"]="0";
			if($this->checkIsSmartphone()=="YES"){
				$data["isSmartPhone"]="1";
			}else{
				$data["isSmartPhone"]="0";
			}

            $this->load->view("login",$data);
        }
    }
	private function checkIsSmartphone() {
			/* get browser info */
			$browser=$_SERVER['HTTP_USER_AGENT'];


			if(preg_match('/android|avantgo|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(chone|od)|x11|iris|kindle|lge |maemo|midp|mmp|opera m(ob|in)i|palm( os)?|cphone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$browser)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i',substr($browser,0,4))) { return "YES"; } else if ((strpos(strtolower($browser), 'firefox'))||(strpos(strtolower($browser), 'safari'))||(strpos(strtolower($browser), 'msie'))) { return "NO"; } else { return "NO"; }
	}


    public function do_login() {
        $userName = $_POST["user"];
        $password = md5($_POST["password"]);
		//$password = "6273d06733de92a216f859ad6d2e8c40";

        $data = array();
        if ($userName == "" || $password == "") {
            $msg = "User name and password must be filled.";
            $data = array(
                "msg" => $msg,
                "success" => 0
            );
        } else {
            try {
				$myQuery="SELECT a.*, b.employee_first_name, b.employee_last_name, b.department_id, b.designation_id,
				c.department_name, d.designation_name,
				d.is_cut_absentee as is_cut_absentee_des,d.is_overtime as is_overtime_des
				FROM tm_users a
				inner join tm_employee b on a.employee_id=b.employee_id
				inner join tm_department c on b.department_id = c.department_id
				inner join tm_designation d on b.designation_id = d.designation_id
				WHERE a.employee_id = '$userName'";
                $cek = $this->db->query($myQuery);
                if ($cek->num_rows() > 0) {
                    $get = $cek->row();
					if ($get->password==$password) {
						if ($get->status==1) {
							$userFullName=$get->employee_first_name." ".$get->employee_last_name;
							$this->session->set_userdata("userFullName", $userFullName);
							$this->session->set_userdata("userName", $get->user_name);
							$this->session->set_userdata("userId", $get->user_id);
							$this->session->set_userdata("groupId", $get->group_id);
							if($this->checkIsSmartphone()=="YES"){
								$this->session->set_userdata("isSmartPhone", 1);
							}else{
								$this->session->set_userdata("isSmartPhone", 0);
							}
							$this->session->set_userdata("allEmployeeAllowed", $get->all_employee_allowed);
							$this->session->set_userdata("departmentId", $get->department_id);
							$msg = "Login success";
							$data = array(
								"msg" => $msg,
								"success" => 1
							);
						} else {
							$msg = "user is blocked";
							$data = array(
								"msg" => $msg,
								"success" => 0
							);

						}

					} else {
						$msg = "password is wrong";
						$data = array(
							"msg" => $msg,
							"success" => 0
						);

					}
                } else {
                    $msg = "User name  not match.";
                    $data = array(
                        "msg" => $msg,
                        "success" => 0
                    );
                }
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
