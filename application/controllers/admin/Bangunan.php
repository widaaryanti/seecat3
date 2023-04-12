<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Bangunan extends CI_Controller
{
    public function __construct(){
        parent::__construct();
		if(!$this->session->userdata("username")){
			redirect("auth");
		} 
    }
    
    public function index()
    {
        $data["title"] = "Bangunan";
        $data["session"] = $this->db->get_where("user", ["username" => $this->session->userdata("username")])->row_array();
        $data["tipe"] = ["Mesjid Jamie", "Mushola", "Madrasah", "Sekolah"];
        $data["bangunan"] = $this->db->get("bangunan")->result_array();

        $this->form_validation->set_rules("namabangunan", "Nama Bangunan", "required|trim");
        $this->form_validation->set_rules("alamat", "Alamat", "required|trim");
        $this->form_validation->set_rules("tipe", "Tipe", "required|trim");
        if ($this->form_validation->run() == false) {
            $this->load->view('layouts/header', $data);
            $this->load->view('layouts/navbar', $data);
            $this->load->view('layouts/sidebar', $data);
            $this->load->view('admin/bangunan', $data);
            $this->load->view('layouts/footer', $data);
        } else {
            $data = [
                'nama_bangunan' => htmlspecialchars($this->input->post('namabangunan', true)),
                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                'tipe' => htmlspecialchars($this->input->post('tipe', true)),
            ];
            $this->db->insert('bangunan', $data);
            $this->session->set_flashdata('pesan', '
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
                    Berhasil Menambahkan Data Bangunan.
                </div>
            </div>
            ');
            redirect("admin/bangunan");
        }
    }

    public function delete($id){
		$this->db->delete("bangunan", ["id_bangunan" => $id]);
		$this->session->set_flashdata('pesan', '
		<div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
                Berhasil Menghapus Data Bangunan.
            </div>
        </div>
        ');
		redirect("admin/bangunan");  
	}

    public function edit(){
        $this->form_validation->set_rules("namabangunan1", "Nama Bangunan", "required|trim");
        $this->form_validation->set_rules("alamat1", "Alamat", "required|trim");
        $this->form_validation->set_rules("tipe1", "Tipe", "required|trim");
        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $data = [
                'nama_bangunan' => htmlspecialchars($this->input->post('namabangunan1', true)),
                'alamat' => htmlspecialchars($this->input->post('alamat1', true)),
                'tipe' => htmlspecialchars($this->input->post('tipe1', true)),
            ];
            $this->db->where("id_bangunan", $this->input->post("id"));
            $this->db->update('bangunan', $data);
            $this->session->set_flashdata('pesan', '
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
                    Berhasil Mengedit Data Bangunan.
                </div>
            </div>
            ');
            redirect("admin/bangunan");
        }
	}
}