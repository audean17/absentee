<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nusoapserver extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   $ns = base_url();
   $this->load->library("nusoap");
   $this->load->library("Master"); 
   $this->server = new soap_server(); // it is a soap server object
   $this->server->configureWSDL("SOAP", $ns); // configure wsdl
   $this->server->wsdl->schemaTargetNamespace = $ns; // namespace for the server
 }

 public function index()
 {
   $ns = base_url();
   $input_array = array ('count' => 'xsd:integer', 'type' => "xsd:string"); // method parameters
   $return_array = array ("fruit" => "xsd:string");
   $this->server->register('Master.fruits', $input_array, $return_array, "urn:SOAPServerWSDL", "urn:".$ns."/fruits", "rpc", "encoded", "Fruit Types");
   $this->server->service(file_get_contents("php://input")); // reading raw data 
 }

/*
  public function client(){
    $this->client = new nusoap_client(base_url()."index.php?wsdl", true);
    $this->load->view("client");
 }
 */
  public function client(){
    $this->client = new  nusoap_client('http://localhost:99/wsdlReport/getViewReport.php?wsdl', true);
    $this->load->view("client");
 }


 
}
?>