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
    var $tb_skripsi      = "wp_sik_usul_penelitian";
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


    function listSkripsi(){
       $this->db->select('*');
		$this->db->from('skripsi');
		$this->db->join('tabel_mahasiswa', 'skripsi.npm = tabel_mahasiswa.npm');
		$data = $this->db->get();

		return $data;
    }

    function getSingleSkripsi($id){
		$this->db->select('*');
		$this->db->from('skripsi');
		$this->db->join('tabel_mahasiswa', 'skripsi.npm = tabel_mahasiswa.npm');
		$this->db->where('id',$id);
		$data = $this->db->get();

		return $data;

    }


    public function searchSkripsi($keyword){
    	$this->db->select('*');
    	$this->db->from('skripsi');
		$this->db->join('tabel_mahasiswa', 'skripsi.npm = tabel_mahasiswa.npm');
		$this->db->like('skripsi.judul',$keyword);
		$data = $this->db->get();

		return $data;

    }
    
    function listJadwal(){
        $q = $this->db->query("SELECT `nomormk`,`tahunajaran`,`kodemk`,`namamk`,`dosenpj` as `nama_dosen`,`ruang`,
        `waktu`,`hari`,`nip_dosen`  FROM wp_jadwal 
        INNER JOIN wp_dosen 
            ON (wp_jadwal.nip_dosen = wp_dosen.nip)
            ORDER BY wp_jadwal.nomormk DESC");

        return $q;
    }

    function getSingleJadwal($no_mk){
        $q = $this->db->query("SELECT `nomormk`,`tahunajaran`,`kodemk`,`namamk`,`dosenpj` as `nama_dosen`,`ruang`,
        `waktu`,`hari`,`nip_dosen`  FROM wp_jadwal 
        INNER JOIN wp_dosen 
            ON (wp_jadwal.nip_dosen = wp_dosen.nip)
            WHERE wp_jadwal.nomormk = $no_mk
            ORDER BY wp_jadwal.nomormk DESC");

        return $q;
    }

    public function searchJadwal($keyword){
        $q = $this->db->query("SELECT `nomormk`,`tahunajaran`,`kodemk`,`namamk`,`dosenpj` as `nama_dosen`,`ruang`,
        `waktu`,`hari`,`nip_dosen`  FROM wp_jadwal 
        INNER JOIN wp_dosen 
            ON (wp_jadwal.nip_dosen = wp_dosen.nip)
            WHERE wp_jadwal.nomormk LIKE '%".$keyword."%'  OR
            wp_jadwal.kodemk LIKE '%".$keyword."%' OR
            wp_jadwal.namamk LIKE '%".$keyword."%'
            ORDER BY wp_jadwal.nomormk DESC");

        return $q;
    }

    public function filterMahasiswaByTahunDanJurusan($tahun,$jurusan){
    	$this->db->select('*');
    	$this->db->from('tabel_mahasiswa');
		$this->db->join('tabel_tahun_masuk', 'tabel_mahasiswa.id_tahun_masuk = tabel_tahun_masuk.id_tahun_masuk');
		$this->db->join('tabel_program_studi', 'tabel_mahasiswa.id_program_studi = tabel_program_studi.id_program_studi');
		if(isset($tahun)){
			$this->db->where('tabel_mahasiswa.id_tahun_masuk',$tahun);
		}
		if (isset($jurusan)){
			$this->db->where('tabel_mahasiswa.id_program_studi',$jurusan);
		}

		$query = $this->db->get();

		return $query;

	}

	function filterJurusanByNama($nama){
    	$this->db->select('*');
    	$this->db->from('tabel_program_studi');
    	$this->db->like('program_studi',$nama);
    	$data = $this->db->get();

    	return $data;
	}


        
}
