<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class reportfauzan extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   $this->load->library("nusoap");
 }

  public function index(){
    $this->client = new  nusoap_client('http://localhost:99/wsdlReport/getViewReport.php?wsdl', true);
    $this->load->view("client");
 }


 
}
?>