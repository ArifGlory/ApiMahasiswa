<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;
class Skripsi extends REST_Controller{


    function __construct(){
        parent::__construct();
        $this->load->helper(array('url'));
        $this->load->library(array('form_validation','pagination','session'));
        $this->load->model('The_Model');
    }

    function searchByJudul_post(){
		$keyword = $this->input->post('judul');
        $search =  $this->The_Model->searchSkripsi($keyword);

        if($search){
           
            $this->response($search->result(),200);
        }else{
            $this->response(array('status' => 'fail', 502));
        }
    }

    function listSkripsi_get(){
        $data = $this->The_Model->listSkripsi()->result();
        $this->response($data, 200);
    }

    function detailSkripsi_get($id){
        $skripsi = $this->The_Model->getSingleSkripsi($id)->result();
        $this->response($skripsi, 200);
    }

}
