<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Jenis extends CI_Controller
{
    public function __construct(){
        parent::__construct();
		if(!$this->session->userdata("username")){
			redirect("auth");
		} 
    }
    
    public function index()
    {
        $data["title"] = "Jenis Kucing";
        $data["session"] = $this->db->get_where("user", ["username" => $this->session->userdata("username")])->row_array();
        $data["jenis"] = $this->db->get("jenis_kucing")->result_array();

        $this->form_validation->set_rules("jenis_kucing", "Jenis Kucing", "required|trim|is_unique[jenis_kucing.jenis_kucing]");
        if ($this->form_validation->run() == false) {
            $this->load->view('layouts/header', $data);
            $this->load->view('layouts/navbar', $data);
            $this->load->view('layouts/sidebar', $data);
            $this->load->view('admin/jenis_kucing', $data);
            $this->load->view('layouts/footer', $data);
        } else {
            $data = [
                'jenis_kucing' => htmlspecialchars($this->input->post('jenis_kucing', true)),
            ];
            $this->db->insert('jenis_kucing', $data);
            $this->session->set_flashdata('pesan', '
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
                    Berhasil Menambahkan Data Jenis Kucing.
                </div>
            </div>
            ');
            redirect("admin/jenis");
        }
    }

    public function delete($id){
		$this->db->delete("jenis_kucing", ["id" => $id]);
		$this->session->set_flashdata('pesan', '
		<div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
                Berhasil Menghapus Data Jenis Kucing.
            </div>
        </div>
        ');
		redirect("admin/jenis");  
	}

    public function edit(){
        $this->form_validation->set_rules("jenis_kucing1", "Jenis Kucing", "required|trim");
        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $data = [
                'jenis_kucing' => htmlspecialchars($this->input->post('jenis_kucing1', true)),
            ];
            $this->db->where("id", $this->input->post("id"));
            $this->db->update('jenis_kucing', $data);
            $this->session->set_flashdata('pesan', '
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
                    Berhasil Mengedit Data Jenis Kucing.
                </div>
            </div>
            ');
            redirect("admin/jenis");
        }
	}
}