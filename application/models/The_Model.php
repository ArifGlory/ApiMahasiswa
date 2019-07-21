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
        $q = $this->db->query("SELECT
        wp_sik_usul_penelitian.id_sup
        , wp_sik_usul_penelitian.nama_mahasiswa
        , wp_sik_usul_penelitian.npm_mahasiswa
        , wp_sik_usul_penelitian.judul_skripsi
        , wp_sik_usul_penelitian.tanggal_sup
        , wp_sik_usul_penelitian.waktu_sup
        , wp_sik_usul_penelitian.nilai_sup
        , wp_sik_usul_penelitian.formulir_penilaian
        , wp_sik_usul_penelitian.formulir_berita_acara
        , wp_dosen.nama
        , detail_dosen_skripsi.peran
    FROM
        detail_dosen_skripsi
        INNER JOIN wp_sik_usul_penelitian 
            ON (detail_dosen_skripsi.id_skripsi = wp_sik_usul_penelitian.id_sup)
        INNER JOIN wp_dosen 
            ON (wp_dosen.nip = detail_dosen_skripsi.nip_dosen)
            ORDER BY wp_sik_usul_penelitian.id_sup DESC");

         $result        = $q->result_array();
         $listSkripsi   = array();
         $id_sup        = 0;
         $temp_id_sup   = 0;
         $no            = 0;

         for($c= 0;$c < count($result); $c++){
           
             $skripsi =  array(
                            'id_sup'=>$result[$c]['id_sup'],
                            'nama_mahasiswa'=>$result[$c]['nama_mahasiswa'],
                            'npm_mahasiswa'=>$result[$c]['npm_mahasiswa'],
                            'judul_skripsi'=>$result[$c]['judul_skripsi'],
                            'tanggal_sup'=>$result[$c]['tanggal_sup'],
                            'waktu_sup'=>$result[$c]['waktu_sup'],
                            'nilai_sup'=>$result[$c]['nilai_sup'],
                            'formulir_penilaian'=>$result[$c]['formulir_penilaian'],
                            'formulir_berita_acara'=>$result[$c]['formulir_berita_acara']
                         );
         }

         foreach($result as $val){
           
             if($no > 0){
                $id_sup = $val['id_sup'];
              
               
                
                //jika id nya masih sama
                if($temp_id_sup == $id_sup){

                    if($val['peran'] == "Pembimbing 1"){
                        $skripsi['pembimbing1'] = $val['nama'];
                     }else if($val['peran'] == "Pembimbing 2"){
                        $skripsi['pembimbing2'] = $val['nama'];
                     }else if($val['peran'] == "Pembahas 1"){
                        $skripsi['pembahas1'] = $val['nama'];
                     }else if($val['peran'] == "Pembahas 2"){
                        $skripsi['pembahas2'] = $val['nama'];
                     }
                   
                     if($no == count($result) - 1){
                         $listSkripsi[] = $skripsi;
                     }
                    

                     $temp_id_sup = $id_sup;

                }else{
                    $listSkripsi[] = $skripsi;
                    $temp_id_sup = $id_sup;
                    unset($skripsi);

                    $skripsi = array(
                        'id_sup'=>$val['id_sup'],
                        'nama_mahasiswa'=>$val['nama_mahasiswa'],
                        'npm_mahasiswa'=>$val['npm_mahasiswa'],
                        'judul_skripsi'=>$val['judul_skripsi'],
                        'tanggal_sup'=>$val['tanggal_sup'],
                        'waktu_sup'=>$val['waktu_sup'],
                        'nilai_sup'=>$val['nilai_sup'],
                        'formulir_penilaian'=>$val['formulir_penilaian'],
                        'formulir_berita_acara'=>$val['formulir_berita_acara']
                     );
    
                     if($val['peran'] == "Pembimbing 1"){
                        $skripsi['pembimbing1'] = $val['nama'];
                     }else if($val['peran'] == "Pembimbing 2"){
                        $skripsi['pembimbing2'] = $val['nama'];
                     }else if($val['peran'] == "Pembahas 1"){
                        $skripsi['pembahas1'] = $val['nama'];
                     }else if($val['peran'] == "Pembahas 2"){
                        $skripsi['pembahas2'] = $val['nama'];
                     }


                }

             }else{
                 //ketika iterator 0
                $id_sup         = $val['id_sup'];
                $temp_id_sup    = $val['id_sup'];

                $skripsi = array(
                    'id_sup'=>$val['id_sup'],
                    'nama_mahasiswa'=>$val['nama_mahasiswa'],
                    'npm_mahasiswa'=>$val['npm_mahasiswa'],
                    'judul_skripsi'=>$val['judul_skripsi'],
                    'tanggal_sup'=>$val['tanggal_sup'],
                    'waktu_sup'=>$val['waktu_sup'],
                    'nilai_sup'=>$val['nilai_sup'],
                    'formulir_penilaian'=>$val['formulir_penilaian'],
                    'formulir_berita_acara'=>$val['formulir_berita_acara']
                 );

                 if($val['peran'] == "Pembimbing 1"){
                    $skripsi['pembimbing1'] = $val['nama'];
                 }else if($val['peran'] == "Pembimbing 2"){
                    $skripsi['pembimbing2'] = $val['nama'];
                 }else if($val['peran'] == "Pembahas 1"){
                    $skripsi['pembahas1'] = $val['nama'];
                 }else if($val['peran'] == "Pembahas 2"){
                    $skripsi['pembahas2'] = $val['nama'];
                 }
   

             }
           
           
            $no++;   
         }
         

        //print_r($listSkripsi);
        return $listSkripsi;
    }

    function getSingleSkripsi($idSup){
        $this->db->from($this->tb_skripsi);
        $this->db->where('id_sup',$idSup);
        $query = $this->db->get();
        return $query;
    }


    public function searchSkripsi($keyword){
        $this->db->select('*');
        $this->db->like('judul_skripsi',$keyword);
        $this->db->or_like('nama_mahasiswa',$keyword);
        $query = $this->db->get($this->tb_skripsi);

        return $query;
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


        
}