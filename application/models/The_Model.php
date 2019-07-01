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

    public function saveMahasiswa($data){
        $query =  $this->db->insert($this->tb_mahasiswa,$data);
        //print_r($data);
        return $query;
    }

    public function updateMahasiswa($npm,$data){
        $this->db->where('npm',$npm);
        $query =  $this->db->update($this->tb_mahasiswa,$data);
        return $query;
    }

    public function dropMahasiswa($npm){
        $this->db->where('npm',$npm);
        $query =  $this->db->delete($this->tb_mahasiswa);
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

    public function saveDosen($data){
        $query =  $this->db->insert($this->tb_dosen,$data);
        //print_r($data);
        return $query;
    }

    public function updateDosen($nip,$data){
        $this->db->where('nip',$nip);
        $query =  $this->db->update($this->tb_dosen,$data);
        return $query;
    }

    public function dropDosen($nip){
        $this->db->where('nip',$nip);
        $query =  $this->db->delete($this->tb_dosen);
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

    public function saveStudi($data){
        $query =  $this->db->insert($this->tb_studi,$data);
        //print_r($data);
        return $query;
    }

    public function updateStudi($idStudi,$data){
        $this->db->where('id_program_studi',$idStudi);
        $query =  $this->db->update($this->tb_studi,$data);
        return $query;
    }

    public function dropStudi($idStudi){
        $this->db->where('id_program_studi',$idStudi);
        $query =  $this->db->delete($this->tb_studi);
        return $query;
    }
       

        
}