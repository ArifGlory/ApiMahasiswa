<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;
class Studi extends REST_Controller{

    function __construct(){
        parent::__construct();
        $this->load->helper(array('url'));
        $this->load->library(array('form_validation','pagination','session'));
        $this->load->model('The_Model');
    }

    function listStudi_get(){
        $data = $this->The_Model->listStudi()->result();
        $this->response($data, 200);
    }

    function detailStudi_get($nip){
        $studi = $this->The_Model->getSingleStudi($nip)->result();
        $this->response($studi, 200);
    }

    
}