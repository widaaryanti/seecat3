<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kucing extends CI_Controller
{
    public function __construct(){
        parent::__construct();
		if(!$this->session->userdata("username")){
			redirect("auth");
		} 
    }
    
    public function index()
    {
        $data["title"] = "Kucing";
        $data["session"] = $this->db->get_where("user", ["username" => $this->session->userdata("username")])->row_array();
        $data["kucing"] = $this->db->get("kucing")->result_array();
    
        $this->form_validation->set_rules("kucing", "Kucing", "required|trim");
        $this->form_validation->set_rules("jenis_id", "Jenis Kucing", "required|trim");
        $this->form_validation->set_rules("umur", "Umur", "required|trim");
        $this->form_validation->set_rules("deskripsi", "Deskripsi", "required|trim");
        $this->form_validation->set_rules("status", "Status", "required|trim");
    
        if ($this->form_validation->run() == false) {
            $this->load->view('layouts/header', $data);
            $this->load->view('layouts/navbar', $data);
            $this->load->view('layouts/sidebar', $data);
            $this->load->view('admin/kucing', $data);
            $this->load->view('layouts/footer', $data);
        } else {
            $config['upload_path'] = './assets/image/kucing/'; // folder tempat menyimpan foto
            $config['allowed_types'] = 'jpg|jpeg|png'; // jenis file yang diizinkan untuk diupload
            $config['max_size'] = 99999; // ukuran maksimal file dalam kilobita
            $config['encrypt_name'] = true; // enkripsi nama file untuk menghindari duplikat nama file

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto')) { // 'foto' adalah name pada input type file pada form
                $foto = $this->upload->data("file_name"); // mengambil nama file dari hasil upload
                $data = [
                    'kucing' => htmlspecialchars($this->input->post('kucing', true)),
                    'jenis_id' => htmlspecialchars($this->input->post('jenis_id', true)),
                    'umur' => htmlspecialchars($this->input->post('umur', true)),
                    'deskripsi' => htmlspecialchars($this->input->post('deskripsi', true)),
                    'status' => htmlspecialchars($this->input->post('status', true)),
                    'foto' => $foto // menyimpan nama file pada kolom 'foto'
                ];

                $this->db->insert('kucing', $data);
                $this->session->set_flashdata('pesan', '
                <div class="alert alert-success alert-dismissible show fade">
                    <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                        Berhasil Menambahkan Data Kucing.
                    </div>
                </div>
                ');
                redirect("admin/kucing");
            } else {
                $error = $this->upload->display_errors(); // menampilkan pesan error jika gagal upload
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
                redirect("admin/kucing");
            }
        } 
    }   

    public function delete($id){
		$this->db->delete("kucing", ["id" => $id]);
		$this->session->set_flashdata('pesan', '
		<div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
                Berhasil Menghapus Data Kucing.
            </div>
        </div>
        ');
		redirect("admin/kucing");  
	}

    public function edit(){
        $this->form_validation->set_rules("kucing1", "Kucing", "required|trim");
        $this->form_validation->set_rules("jenis_id1", "Jenis Kucing", "required|trim");
        $this->form_validation->set_rules("umur1", "Umur", "required|trim");
        $this->form_validation->set_rules("deskripsi1", "Deskripsi", "required|trim");
        $this->form_validation->set_rules("status1", "Status", "required|trim");
        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $config['upload_path'] = './assets/image/kucing/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 99999;
            $config['encrypt_name'] = true;

            $this->load->library('upload', $config);
            
            $image = $this->db->get_where("kucing", ["id" => $id])->row_array();
            $new_image = $_FILES['foto1']['name'];
            $old_image = $image["image"];

            if ($new_image) {
                if (file_exists('./assets/image/kucing/' . $old_image)) {
                    unlink('./assets/image/kucing/' . $old_image);
                }
                if ($this->upload->do_upload('foto1')) {
                    $new = $this->upload->data('file_name');
                    $this->db->where("id", $this->input->post("id"));
                    $this->db->update('kucing', ["image" => $new]);
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
                    redirect('admin/kucing');
                }
            } 
            $data = [
                'kucing' => htmlspecialchars($this->input->post('kucing1', true)),
                'jenis_id' => htmlspecialchars($this->input->post('jenis_id1', true)),
                'umur' => htmlspecialchars($this->input->post('umur1', true)),
                'deskripsi' => htmlspecialchars($this->input->post('deskripsi1', true)),
                'status' => htmlspecialchars($this->input->post('status1', true)),
            ];
            $this->db->where("id", $this->input->post("id"));
            $this->db->update('kucing', $data);
            $this->session->set_flashdata('pesan', '
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
                    Berhasil Mengedit Data Kucing.
                </div>
            </div>
            ');
            redirect("admin/kucing");
        }
	}
}