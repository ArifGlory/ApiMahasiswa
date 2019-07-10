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
    var $tb_skripsi      = "tabel_mahasiswa";
    var $tb_dosen        = "wp_dosen";
    var $tb_studi        = "tabel_program_studi";
    var $tb_jadwal       = "wp_jadwal";

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

    public function searchMahasiswa($keyword){
        $this->db->select('*');
        $this->db->like('npm',$keyword);
        $this->db->or_like('nama',$keyword);
        $query = $this->db->get($this->tb_mahasiswa);

        return $query;
    }

    public function filterTahunMahasiswa($idTahun){
        $q = $this->db->query("SELECT * FROM tabel_mahasiswa 
        INNER JOIN tabel_tahun_masuk 
            ON (tabel_mahasiswa.id_tahun_masuk = tabel_tahun_masuk.id_tahun_masuk)
            WHERE tabel_mahasiswa.id_tahun_masuk = $idTahun
            ORDER BY tabel_mahasiswa.id_tahun_masuk DESC");

        return $q;
    }

    public function filterJurusanMahasiswa($idJurusan){
        $q = $this->db->query("SELECT * FROM tabel_mahasiswa 
        INNER JOIN tabel_program_studi 
            ON (tabel_mahasiswa.id_program_studi = tabel_program_studi.id_program_studi)
            WHERE tabel_mahasiswa.id_program_studi = $idJurusan
            ORDER BY tabel_mahasiswa.id_program_studi DESC");

        return $q;
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

    public function searchDosen($keyword){
        $this->db->select('*');
        $this->db->like('nip',$keyword);
        $this->db->or_like('nama',$keyword);
        $query = $this->db->get($this->tb_dosen);

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


    public function searchSkripsi($keyword){
        $this->db->select('*');
        $this->db->like('npm',$keyword);
        $this->db->or_like('nama',$keyword);
        $query = $this->db->get($this->tb_mahasiswa);

        return $query;
    }
    
    function listJadwal(){
        $data = $this->db->get($this->tb_jadwal);
        return $data;
    }

    function getSingleJadwal($no_mk){
        $this->db->from($this->tb_jadwal);
        $this->db->where('nomormk',$no_mk);
        $query = $this->db->get();
        return $query;
    }

    public function searchJadwal($keyword){
        $this->db->select('*');
        $this->db->like('nomormk',$keyword);
        $this->db->or_like('kodemk',$keyword);
        $this->db->or_like('namamk',$keyword);
        $query = $this->db->get($this->tb_jadwal);

        return $query;
    }


        
}