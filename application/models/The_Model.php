<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Glory
 * Date: 16/04/2019
 * Time: 10:48
 */
class The_Model extends CI_Model
{

    var $tb_mahasiswa    = "tabel_mahasiswa";
    var $tb_dosen        = "wp_dosen";
    var $tb_studi        = "tabel_program_studi";

    function listMahasiswa(){
        $data = $this->db->get($this->tb_mahasiswa);
        return $data;
    }

    function getSingleMahasiswa($npm){
        $this->db->from($this->tb_mahasiswa);
        $this->db->where('npm',$npm);
        $query = $this->db->get();
        return $query;
    }

    function listDosen(){
        $data = $this->db->get($this->tb_dosen);
        return $data;
    }

    function getSingleDosen($nip){
        $this->db->from($this->tb_dosen);
        $this->db->where('nip',$nip);
        $query = $this->db->get();
        return $query;
    }

    function listStudi(){
        $data = $this->db->get($this->tb_studi);
        return $data;
    }

    function getSingleStudi($idStudi){
        $this->db->from($this->tb_studi);
        $this->db->where('id_program_studi',$idStudi);
        $query = $this->db->get();
        return $query;
    }
       

        
}