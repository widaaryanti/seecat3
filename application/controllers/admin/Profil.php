<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{
    public function __construct(){
        parent::__construct();
		if(!$this->session->userdata("username")){
			redirect("auth");
		} 
    }
    
    public function index()
    {
        $data["title"] = "Profil";
        $data["session"] = $this->db->get_where("user", ["username" => $this->session->userdata("username")])->row_array();

        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/navbar', $data);
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('admin/profil', $data);
        $this->load->view('layouts/footer', $data);
    }
    
    public function edit(){
        $this->form_validation->set_rules("username", "Username", "required|trim");
        $this->form_validation->set_rules("nama", "Nama", "required|trim");
        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $config['upload_path'] = './assets/image/user/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 99999;
            $config['encrypt_name'] = true;

            $this->load->library('upload', $config);

            $image = $this->db->get_where("user", ["id" => $id])->row_array();
            $new_image = $_FILES['foto']['name'];
            $old_image = $image["foto"];

            if ($new_image) {
                if ($old_image != "default.jpg") {
                    if (file_exists('./assets/image/user/' . $old_image)) {
                        unlink('./assets/image/user/' . $old_image);
                    }
                }
                if ($this->upload->do_upload('foto')) {
                    $new = $this->upload->data('file_name');
                    $this->db->where("id", $this->input->post("id"));
                    $this->db->update('user', ["foto" => $new]);
                } else {
                    $this->session->set_flashdata('pesan', '
                        <div class="alert alert-danger alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                </button>
                                Gagal mengupload gambar.
                            </div>
                        </div>
                    ');
                    redirect('admin/profil');
                }
            }

            if ($this->input->post('password') != null) {
                $password = password_hash(htmlspecialchars($this->input->post('password', true)), PASSWORD_DEFAULT);
                $this->db->where("id", $this->input->post("id"));
                $this->db->update('user', ["password" => $password]);
            } 
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'username' => htmlspecialchars($this->input->post('username', true)),
            ];
            $this->db->where("id", $this->input->post("id"));
            $this->db->update('user', $data);
            $this->session->set_flashdata('pesan', '
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
                    Berhasil Mengedit Data Profil.
                </div>
            </div>
            ');
            redirect("admin/profil");
        }
    }
}   