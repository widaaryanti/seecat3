<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function tujuan(){
        $data["title"] = "Maksud dan Tujuan";
        $this->load->view('layouts/header_user', $data);
        $this->load->view('layouts/navbar_user', $data);
        $this->load->view('user/tujuan', $data);
        $this->load->view('layouts/footer_user', $data);
    }

    public function sejarah(){
        $data["title"] = "Sejarah Kelurahan Ciakar";
        $this->load->view('layouts/header_user', $data);
        $this->load->view('layouts/navbar_user', $data);
        $this->load->view('user/sejarah', $data);
        $this->load->view('layouts/footer_user', $data);
    }
    
    public function visimisi(){
        $data["title"] = "Visi dan Misi";
        $this->load->view('layouts/header_user', $data);
        $this->load->view('layouts/navbar_user', $data);
        $this->load->view('user/visidanmisi', $data);
        $this->load->view('layouts/footer_user', $data);
    }

    public function ktpkk(){
        $data["title"] = "Informasi Pelayanan Pembuatan KTP dan KK";
        $this->load->view('layouts/header_user', $data);
        $this->load->view('layouts/navbar_user', $data);
        $this->load->view('user/ktp', $data);
        $this->load->view('layouts/footer_user', $data);
    }


}