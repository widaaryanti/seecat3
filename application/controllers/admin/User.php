<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct(){
        parent::__construct();
		if(!$this->session->userdata("username")){
			redirect("auth");
		} 
        if($this->session->userdata("role") == 2){
			redirect("admin/dashboard");
		} 
    }
    
    public function index()
    {
        $data["title"] = "User";
        $data["session"] = $this->db->get_where("user", ["username" => $this->session->userdata("username")])->row_array();
        $data["user"] = $this->db->get_where("user", ["role" => 2])->result_array();

        $this->form_validation->set_rules("username", "Username", "required|trim|is_unique[user.username]");
        $this->form_validation->set_rules("nama", "Nama", "required|trim");
        $this->form_validation->set_rules("password", "Password", "required|trim");

        if ($this->form_validation->run() == false) {
            $this->load->view('layouts/header', $data);
            $this->load->view('layouts/navbar', $data);
            $this->load->view('layouts/sidebar', $data);
            $this->load->view('admin/user', $data);
            $this->load->view('layouts/footer', $data);
        } else {
            $config['upload_path'] = './assets/image/user/'; // folder tempat menyimpan foto
            $config['allowed_types'] = 'jpg|jpeg|png'; // jenis file yang diizinkan untuk diupload
            $config['max_size'] = 99999; // ukuran maksimal file dalam kilobita
            $config['encrypt_name'] = true; // enkripsi nama file untuk menghindari duplikat nama file

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto')) { // 'foto' adalah name pada input type file pada form
                $foto = $this->upload->data("file_name"); // mengambil nama file dari hasil upload
                $data = [
                    'nama' => htmlspecialchars($this->input->post('nama', true)),
                    'username' => htmlspecialchars($this->input->post('username', true)),
                    'password' => password_hash($this->input->post("password"), PASSWORD_DEFAULT),
                    'foto' => $foto, // menyimpan nama file pada kolom 'foto'
                    'role' => 2,
                ];

                $this->db->insert('user', $data);
                $this->session->set_flashdata('pesan', '
                <div class="alert alert-success alert-dismissible show fade">
                    <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                        Berhasil Menambahkan Data User.
                    </div>
                </div>
                ');
                redirect("admin/user");
            } else {
                $data = [
                    'nama' => htmlspecialchars($this->input->post('nama', true)),
                    'username' => htmlspecialchars($this->input->post('username', true)),
                    'password' => password_hash($this->input->post("password"), PASSWORD_DEFAULT),
                    'foto' => "default.jpg", // menyimpan nama file pada kolom 'foto'
                    'role' => 2,
                ];

                $this->db->insert('user', $data);
                $this->session->set_flashdata('pesan', '
                <div class="alert alert-success alert-dismissible show fade">
                    <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                        Berhasil Menambahkan Data User.
                    </div>
                </div>
                ');
                redirect("admin/user");
            }
        }
    }

    public function delete($id)
    {
        $data = $this->db->get_where('user', ['id' => $id])->row_array();
        if ($data['foto'] != "default.jpg") {
            $file_path = "./assets/image/user/" . $data['foto'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
        $this->db->delete("user", ["id" => $id]);
        $this->session->set_flashdata('pesan', '
		<div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
                Berhasil Menghapus Data User.
            </div>
        </div>
        ');
        redirect("admin/user");
    }

    public function edit()
    {
        $this->form_validation->set_rules("username1", "Username", "required|trim");
        $this->form_validation->set_rules("nama1", "Nama", "required|trim");
        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $config['upload_path'] = './assets/image/user/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 99999;
            $config['encrypt_name'] = true;

            $this->load->library('upload', $config);

            $image = $this->db->get_where("user", ["id" => $id])->row_array();
            $new_image = $_FILES['foto1']['name'];
            $old_image = $image["foto"];

            if ($new_image) {
                if ($old_image != "default.jpg") {
                    if (file_exists('./assets/image/user/' . $old_image)) {
                        unlink('./assets/image/user/' . $old_image);
                    }
                }
                if ($this->upload->do_upload('foto1')) {
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
                    redirect('admin/user');
                }
            }

            if ($this->input->post('password1') != null) {
                $password = password_hash(htmlspecialchars($this->input->post('password1', true)), PASSWORD_DEFAULT);
                $this->db->where("id", $this->input->post("id"));
                $this->db->update('user', ["password" => $password]);
            } 
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama1', true)),
                'username' => htmlspecialchars($this->input->post('username1', true)),
            ];
            $this->db->where("id", $this->input->post("id"));
            $this->db->update('user', $data);
            $this->session->set_flashdata('pesan', '
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
                    Berhasil Mengedit Data Bangunan User.
                </div>
            </div>
            ');
            redirect("admin/user");
        }
    }
}