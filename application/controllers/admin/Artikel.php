<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Artikel extends CI_Controller
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
        $data["title"] = "Artikel";
        $data["artikel"] = $this->db->get("artikel")->result_array();
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/navbar', $data);
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('admin/artikel', $data);
        $this->load->view('layouts/footer', $data);
    }

    public function tambah()
    {
        $data["title"] = "Artikel";
        $data["session"] = $this->db->get_where("user", ["username" => $this->session->userdata("username")])->row_array();
        $this->form_validation->set_rules("judul", "Judul", "required|trim");
        $this->form_validation->set_rules("tanggal", "Tanggal", "required|trim");
        $this->form_validation->set_rules("artikel", "Artikel", "required|trim");

        if ($this->form_validation->run() == false) {
            $this->load->view('layouts/header', $data);
            $this->load->view('layouts/navbar', $data);
            $this->load->view('layouts/sidebar', $data);
            $this->load->view('admin/tambah_artikel', $data);
            $this->load->view('layouts/footer', $data);
        } else {
            $config['upload_path'] = './assets/image/blog/'; // folder tempat menyimpan foto
            $config['allowed_types'] = 'jpg|jpeg|png'; // jenis file yang diizinkan untuk diupload
            $config['max_size'] = 99999; // ukuran maksimal file dalam kilobita
            $config['encrypt_name'] = true; // enkripsi nama file untuk menghindari duplikat nama file

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto')) { // 'foto' adalah name pada input type file pada form
                $foto = $this->upload->data("file_name"); // mengambil nama file dari hasil upload
                $data = [
                    'judul' => htmlspecialchars($this->input->post('judul', true)),
                    'tanggal' => htmlspecialchars($this->input->post('tanggal', true)),
                    'artikel' => $this->input->post('artikel'),
                    'foto' => $foto, // menyimpan nama file pada kolom 'foto'
                    'author' => htmlspecialchars($this->input->post('author', true)),
                ];

                $this->db->insert('artikel', $data);
                $this->session->set_flashdata('pesan', '
                <div class="alert alert-success alert-dismissible show fade">
                    <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                        Berhasil Menambahkan Data Artikel.
                    </div>
                </div>
                ');
                redirect("admin/artikel");
            } else {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('pesan', '
                <div class="alert alert-danger alert-dismissible show fade">
                    <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                        '.$error.'
                    </div>
                </div>
                ');
                redirect("admin/artikel");
            }
        }
    }

    public function delete($id)
    {
        $data = $this->db->get_where('artikel', ['id_artikel' => $id])->row_array();
        $file_path = "./assets/image/blog/" . $data['foto'];

        if (file_exists($file_path)) {
            unlink($file_path);
        }
        $this->db->delete("artikel", ["id_artikel" => $id]);
        $this->session->set_flashdata('pesan', '
		<div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
                Berhasil Menghapus Data Artikel.
            </div>
        </div>
        ');
        redirect("admin/artikel");
    }

    public function edit($id)
    {
        $data["title"] = "Artikel";
        $data["session"] = $this->db->get_where("user", ["username" => $this->session->userdata("username")])->row_array();
        $data["artikel"] = $this->db->get_where("artikel", ["id_artikel" => $id])->row_array();
        $this->form_validation->set_rules("judul", "Judul", "required|trim");
        $this->form_validation->set_rules("tanggal", "Tanggal", "required|trim");
        $this->form_validation->set_rules("artikel", "Artikel", "required|trim");

        if ($this->form_validation->run() == false) {
            $this->load->view('layouts/header', $data);
            $this->load->view('layouts/navbar', $data);
            $this->load->view('layouts/sidebar', $data);
            $this->load->view('admin/edit_artikel', $data);
            $this->load->view('layouts/footer', $data);
        } else {
            $config['upload_path'] = './assets/image/blog/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 99999;
            $config['encrypt_name'] = true;

            $this->load->library('upload', $config);
            
            $image = $this->db->get_where("artikel", ["id_artikel" => $id])->row_array();
            $new_image = $_FILES['foto']['name'];
            $old_image = $image["foto"];

            if ($new_image) {
                if (file_exists('./assets/image/blog/' . $old_image)) {
                    unlink('./assets/image/blog/' . $old_image);
                }
                if ($this->upload->do_upload('foto')) {
                    $new_image = $this->upload->data('file_name');
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
                    redirect('admin/artikel');
                }
            } else {
                $new_image = $old_image;
            }
            $data = [
                'judul' => htmlspecialchars($this->input->post('judul', true)),
                'tanggal' => htmlspecialchars($this->input->post('tanggal', true)),
                'artikel' => $this->input->post('artikel'),
                'foto' => $new_image
            ];

            $this->db->where('id_artikel', $id);
            $this->db->update('artikel', $data);
            $this->session->set_flashdata('pesan', '
                <div class="alert alert-success alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                        Data Artikel berhasil diubah.
                    </div>
                </div>
            ');
            redirect('admin/artikel');
        }
    }
}