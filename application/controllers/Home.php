<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function index(){
        $data["title"] = "Home";
        $this->load->view('layouts/header_user', $data);
        $this->load->view('layouts/navbar_user', $data);
        $this->load->view('user/home', $data);
        $this->load->view('layouts/footer_user', $data);
    }
}