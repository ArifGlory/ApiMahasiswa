<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;
class Jadwal extends REST_Controller{

    function __construct(){
        parent::__construct();
        $this->load->helper(array('url'));
        $this->load->library(array('form_validation','pagination','session'));
        $this->load->model('The_Model');
    }

    function listJadwal_get(){
        $data = $this->The_Model->listJadwal()->result();
        $this->response($data, 200);
    }

    function detailJadwal_get($no_mk){
        $jadwal = $this->The_Model->getSingleJadwal($no_mk)->result();
        $this->response($jadwal, 200);
    }

    function search_get($keyword){
        $search =  $this->The_Model->searchJadwal($keyword);

        if($search){
           
            $this->response($search->result(),200);
        }else{
            $this->response(array('status' => 'fail', 502));
        }
    }

}