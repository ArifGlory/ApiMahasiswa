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

    function addMahasiswa_post(){
        $data   = $this->input->post();
        $insert =  $this->The_Model->saveMahasiswa($data);

        if($insert){
            $message = "Berhasil menaambahkan  data mahasiswa";
            $this->response($message,200);
        }else{
            $this->response(array('status' => 'fail', 502));
        }
        
    }

    function editMahasiswa_post(){
        $data   = $this->input->post();
        $npm    =  $data['npm'];
        unset($data['npm']);

        $update =  $this->The_Model->updateMahasiswa($npm,$data);
        
        if($update){
            $message = "Berhasil mengubah  data mahasiswa";
            $this->response($message,200);
        }else{
            $this->response(array('status' => 'fail', 502));
        }

    }

    function deleteMahasiswa_get($npm){
        $delete = $this->The_Model->dropMahasiswa($npm);
      
        if($delete){
            $message = "Berhasil menghapus  data mahasiswa";
            $this->response($message,200);
        }else{
            $this->response(array('status' => 'fail', 502));
        }
    }

    
}