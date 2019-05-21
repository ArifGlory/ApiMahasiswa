<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;
class Dosen extends REST_Controller{

    function __construct(){
        parent::__construct();
        $this->load->helper(array('url'));
        $this->load->library(array('form_validation','pagination','session'));
        $this->load->model('The_Model');
    }

    function listDosen_get(){
        $data = $this->The_Model->listDosen()->result();
        $this->response($data, 200);
    }

    function detailDosen_get($nip){
        $dosen = $this->The_Model->getSingleDosen($nip)->result();
        $this->response($dosen, 200);
    }

    
}