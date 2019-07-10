<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;
class Skripsi extends REST_Controller{

    function search_get($keyword){
        $search =  $this->The_Model->searchSkripsi($keyword);

        if($search){
           
            $this->response($search->result(),200);
        }else{
            $this->response(array('status' => 'fail', 502));
        }
    }

}