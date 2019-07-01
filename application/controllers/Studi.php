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

    function addStudi_post(){
        $data   = $this->input->post();
        $insert =  $this->The_Model->saveStudi($data);

        if($insert){
            $message = "Berhasil menaambahkan  data Studi";
            $this->response($message,200);
        }else{
            $this->response(array('status' => 'fail', 502));
        }
        
    }

    function editStudi_post(){
        $data   = $this->input->post();
        $idStudi    =  $data['id_program_studi'];
        unset($data['id_program_studi']);

        $update =  $this->The_Model->updateStudi($idStudi,$data);
        
        if($update){
            $message = "Berhasil mengubah  data Studi";
            $this->response($message,200);
        }else{
            $this->response(array('status' => 'fail', 502));
        }

    }

    function deleteStudi_get($idStudi){
        $delete = $this->The_Model->dropStudi($idStudi);
      
        if($delete){
            $message = "Berhasil menghapus  data Studi";
            $this->response($message,200);
        }else{
            $this->response(array('status' => 'fail', 502));
        }
    }

    
}