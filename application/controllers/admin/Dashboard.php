<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct(){
        parent::__construct();
		if(!$this->session->userdata("username")){
			redirect("auth");
		} 
    }
    
    public function index()
    {
        $data["session"] = $this->db->get_where("user", ["username" => $this->session->userdata("username")])->row_array();
        $data["title"] = "Dashboard";
        $data["artikel"] = $this->db->get("artikel")->num_rows();
        $data["staff"] = $this->db->get("staff")->num_rows();
        $data["user"] = $this->db->get_where("user", ["role" => 2])->num_rows();
        $data["rt"] = $this->db->get_where("rukun", ["tipe" => "RT"])->num_rows();
        $data["rw"] = $this->db->get_where("rukun", ["tipe" => "RW"])->num_rows();
        $data["laki_laki"] = $this->db->select_sum('laki_laki')->get('penduduk')->row()->laki_laki;
        $data["perempuan"] = $this->db->select_sum('perempuan')->get('penduduk')->row()->perempuan;
        $data["mesjid"] = $this->db->get_where("bangunan", ["tipe" => "Mesjid Jamie"])->num_rows();
        $data["mushola"] = $this->db->get_where("bangunan", ["tipe" => "Mushola"])->num_rows();
        $data["madrasah"] = $this->db->get_where("bangunan", ["tipe" => "Madrasah"])->num_rows();
        $data["sekolah"] = $this->db->get_where("bangunan", ["tipe" => "Sekolah"])->num_rows();
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/navbar', $data);
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('layouts/footer', $data);
    }
}