<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Staff extends CI_Controller
{
    public function __construct(){
        parent::__construct();
		if(!$this->session->userdata("username")){
			redirect("auth");
		} 
    }
    
    public function index()
    {
        $data["title"] = "Staff";
        $data["session"] = $this->db->get_where("user", ["username" => $this->session->userdata("username")])->row_array();
        $data["staff"] = $this->db->get("staff")->result_array();
    
        $this->form_validation->set_rules("nama", "Nama", "required|trim");
        $this->form_validation->set_rules("nip", "NIP", "required|trim");
        $this->form_validation->set_rules("tempat", "Tempat Lahir", "required|trim");
        $this->form_validation->set_rules("tanggal_lahir", "Tanggal Lahir", "required|trim");
        $this->form_validation->set_rules("pangkat", "Pangkat", "required|trim");
        $this->form_validation->set_rules("jabatan", "Jabatan", "required|trim");
    
        if ($this->form_validation->run() == false) {
            $this->load->view('layouts/header', $data);
            $this->load->view('layouts/navbar', $data);
            $this->load->view('layouts/sidebar', $data);
            $this->load->view('admin/staff', $data);
            $this->load->view('layouts/footer', $data);
        } else {
            $config['upload_path'] = './assets/image/staff/'; // folder tempat menyimpan foto
            $config['allowed_types'] = 'jpg|jpeg|png'; // jenis file yang diizinkan untuk diupload
            $config['max_size'] = 99999; // ukuran maksimal file dalam kilobita
            $config['encrypt_name'] = true; // enkripsi nama file untuk menghindari duplikat nama file

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto')) { // 'foto' adalah name pada input type file pada form
                $foto = $this->upload->data("file_name"); // mengambil nama file dari hasil upload
                $data = [
                    'nama' => htmlspecialchars($this->input->post('nama', true)),
                    'nip' => htmlspecialchars($this->input->post('nip', true)),
                    'tempat' => htmlspecialchars($this->input->post('tempat', true)),
                    'tanggal_lahir' => htmlspecialchars($this->input->post('tanggal_lahir', true)),
                    'pangkat' => htmlspecialchars($this->input->post('pangkat', true)),
                    'jabatan' => htmlspecialchars($this->input->post('jabatan', true)),
                    'foto' => $foto // menyimpan nama file pada kolom 'foto'
                ];

                $this->db->insert('staff', $data);
                $this->session->set_flashdata('pesan', '
                <div class="alert alert-success alert-dismissible show fade">
                    <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                        Berhasil Menambahkan Data Staff.
                    </div>
                </div>
                ');
                redirect("admin/staff");
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
                redirect("admin/staff");
            }
        } 
    }   

    public function delete($id){
		$this->db->delete("staff", ["id_staff" => $id]);
		$this->session->set_flashdata('pesan', '
		<div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
                Berhasil Menghapus Data Staff.
            </div>
        </div>
        ');
		redirect("admin/staff");  
	}

    public function edit(){
        $this->form_validation->set_rules("nama1", "Nama", "required|trim");
        $this->form_validation->set_rules("nip1", "NIP", "required|trim");
        $this->form_validation->set_rules("tempat1", "Tempat Lahir", "required|trim");
        $this->form_validation->set_rules("tanggal_lahir1", "Tanggal Lahir", "required|trim");
        $this->form_validation->set_rules("pangkat1", "Pangkat", "required|trim");
        $this->form_validation->set_rules("jabatan1", "Jabatan", "required|trim");
        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $config['upload_path'] = './assets/image/staff/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 99999;
            $config['encrypt_name'] = true;

            $this->load->library('upload', $config);
            
            $image = $this->db->get_where("staff", ["id_staff" => $id])->row_array();
            $new_image = $_FILES['foto1']['name'];
            $old_image = $image["foto"];

            if ($new_image) {
                if (file_exists('./assets/image/staff/' . $old_image)) {
                    unlink('./assets/image/staff/' . $old_image);
                }
                if ($this->upload->do_upload('foto1')) {
                    $new = $this->upload->data('file_name');
                    $this->db->where("id_staff", $this->input->post("id"));
                    $this->db->update('staff', ["foto" => $new]);
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
                    redirect('admin/staff');
                }
            } 
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama1', true)),
                'nip' => htmlspecialchars($this->input->post('nip1', true)),
                'tempat' => htmlspecialchars($this->input->post('tempat1', true)),
                'tanggal_lahir' => htmlspecialchars($this->input->post('tanggal_lahir1', true)),
                'pangkat' => htmlspecialchars($this->input->post('pangkat1', true)),
                'jabatan' => htmlspecialchars($this->input->post('jabatan1', true)),
            ];
            $this->db->where("id_staff", $this->input->post("id"));
            $this->db->update('staff', $data);
            $this->session->set_flashdata('pesan', '
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
                    Berhasil Mengedit Data Bangunan Staff.
                </div>
            </div>
            ');
            redirect("admin/staff");
        }
	}
}