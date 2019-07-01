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

    function addDosen_post(){
        $data   = $this->input->post();
        $insert =  $this->The_Model->saveDosen($data);

        if($insert){
            $message = "Berhasil menaambahkan  data dosen";
            $this->response($message,200);
        }else{
            $this->response(array('status' => 'fail', 502));
        }
        
    }

    function editDosen_post(){
        $data   = $this->input->post();
        $nip    =  $data['nip'];
        unset($data['nip']);

        $update =  $this->The_Model->updateDosen($nip,$data);
        
        if($update){
            $message = "Berhasil mengubah  data Dosen";
            $this->response($message,200);
        }else{
            $this->response(array('status' => 'fail', 502));
        }

    }

    function deleteDosen_get($nip){
        $delete = $this->The_Model->dropDosen($nip);
      
        if($delete){
            $message = "Berhasil menghapus  data Dosen";
            $this->response($message,200);
        }else{
            $this->response(array('status' => 'fail', 502));
        }
    }

    
}