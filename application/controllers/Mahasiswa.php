<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;
class Mahasiswa extends REST_Controller{

    function __construct(){
        parent::__construct();
        $this->load->helper(array('url'));
        $this->load->library(array('form_validation','pagination','session'));
        $this->load->model('The_Model');
    }

    function listMahasiswa_get(){
        $data = $this->The_Model->listMahasiswa()->result();
        $this->response($data, 200);
    }

    function detailMahasiswa_get($npm){
        $mahasiswa = $this->The_Model->getSingleMahasiswa($npm)->result();
        $this->response($mahasiswa, 200);
    }

    
}