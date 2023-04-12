<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Rukun extends CI_Controller
{
    public function __construct(){
        parent::__construct();
		if(!$this->session->userdata("username")){
			redirect("auth");
		} 
    }
    
    public function index()
    {
        $data["title"] = "RT / RW";
        $data["session"] = $this->db->get_where("user", ["username" => $this->session->userdata("username")])->row_array();
        $data["tipe"] = ["RT", "RW"];
        $data["rukun"] = $this->db->get("rukun")->result_array();

        $this->form_validation->set_rules("koderukun", "Kode Rukun", "required|trim|is_unique[rukun.kode_rukun]");
        $this->form_validation->set_rules("alamat", "Alamat", "required|trim");
        $this->form_validation->set_rules("penjabat", "Penjabat", "required|trim");
        $this->form_validation->set_rules("tipe", "Tipe", "required|trim");
        if ($this->form_validation->run() == false) {
            $this->load->view('layouts/header', $data);
            $this->load->view('layouts/navbar', $data);
            $this->load->view('layouts/sidebar', $data);
            $this->load->view('admin/rukun', $data);
            $this->load->view('layouts/footer', $data);
        } else {
            $data = [
                'kode_rukun' => htmlspecialchars($this->input->post('koderukun', true)),
                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                'nama_penjabat' => htmlspecialchars($this->input->post('penjabat', true)),
                'tipe' => htmlspecialchars($this->input->post('tipe', true)),
            ];
            $this->db->insert('rukun', $data);
            $this->session->set_flashdata('pesan', '
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
                    Berhasil Menambahkan Data RT / RW.
                </div>
            </div>
            ');
            redirect("admin/rukun");
        }
    }

    public function delete($id){
		$this->db->delete("rukun", ["id_rukun" => $id]);
		$this->session->set_flashdata('pesan', '
		<div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
                Berhasil Menghapus Data RT / RW.
            </div>
        </div>
        ');
		redirect("admin/rukun");  
	}

    public function edit(){
        $this->form_validation->set_rules("koderukun1", "Kode Rukun", "required|trim");
        $this->form_validation->set_rules("alamat1", "Alamat", "required|trim");
        $this->form_validation->set_rules("penjabat1", "Penjabat", "required|trim");
        $this->form_validation->set_rules("tipe1", "Tipe", "required|trim");
        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $data = [
                'kode_rukun' => htmlspecialchars($this->input->post('koderukun1', true)),
                'alamat' => htmlspecialchars($this->input->post('alamat1', true)),
                'nama_penjabat' => htmlspecialchars($this->input->post('penjabat1', true)),
                'tipe' => htmlspecialchars($this->input->post('tipe1', true)),
            ];
            $this->db->where("id_rukun", $this->input->post("id"));
            $this->db->update('rukun', $data);
            $this->session->set_flashdata('pesan', '
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
                    Berhasil Mengedit Data Bangunan RT / RW.
                </div>
            </div>
            ');
            redirect("admin/rukun");
        }
	}
}