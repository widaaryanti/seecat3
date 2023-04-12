<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Penduduk extends CI_Controller
{
    public function __construct(){
        parent::__construct();
		if(!$this->session->userdata("username")){
			redirect("auth");
		} 
    }
    
    public function index()
    {
        $data["title"] = "Penduduk";
        $data["session"] = $this->db->get_where("user", ["username" => $this->session->userdata("username")])->row_array();
        $data["tipe"] = $this->db->get_where("rukun" , ["tipe" == "RW"])->result_array();
        $data["penduduk"] = $this->db->get("penduduk")->result_array();

        $this->form_validation->set_rules("rw_id", "RW", "required|trim|is_unique[penduduk.rw_id]");
        $this->form_validation->set_rules("laki_laki", "Laki-laki", "required|trim");
        $this->form_validation->set_rules("perempuan", "Perempuan", "required|trim");
        if ($this->form_validation->run() == false) {
            $this->load->view('layouts/header', $data);
            $this->load->view('layouts/navbar', $data);
            $this->load->view('layouts/sidebar', $data);
            $this->load->view('admin/penduduk', $data);
            $this->load->view('layouts/footer', $data);
        } else {
            $data = [
                'rw_id' => htmlspecialchars($this->input->post('rw_id', true)),
                'laki_laki' => htmlspecialchars($this->input->post('laki_laki', true)),
                'perempuan' => htmlspecialchars($this->input->post('perempuan', true)),
            ];
            $this->db->insert('penduduk', $data);
            $this->session->set_flashdata('pesan', '
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
                    Berhasil Menambahkan Data Penduduk.
                </div>
            </div>
            ');
            redirect("admin/penduduk");
        }
    }

    public function delete($id){
		$this->db->delete("penduduk", ["id_penduduk" => $id]);
		$this->session->set_flashdata('pesan', '
		<div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
                Berhasil Menghapus Data Penduduk.
            </div>
        </div>
        ');
		redirect("admin/penduduk");  
	}

    public function edit(){
        $this->form_validation->set_rules("rw_id1", "RW", "required|trim");
        $this->form_validation->set_rules("laki_laki1", "Laki-laki", "required|trim");
        $this->form_validation->set_rules("perempuan1", "Perempuan", "required|trim");
        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $data = [
                'rw_id' => htmlspecialchars($this->input->post('rw_id1', true)),
                'laki_laki' => htmlspecialchars($this->input->post('laki_laki1', true)),
                'perempuan' => htmlspecialchars($this->input->post('perempuan1', true)),
            ];
            $this->db->where("id_penduduk", $this->input->post("id"));
            $this->db->update('penduduk', $data);
            $this->session->set_flashdata('pesan', '
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
                    Berhasil Mengedit Data Penduduk.
                </div>
            </div>
            ');
            redirect("admin/penduduk");
        }
	}
}