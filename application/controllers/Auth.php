<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function index()
    {
        if ($this->session->userdata("username")) {
            redirect("admin/dashboard");
        }
        $data["title"] = "Login";
        $this->form_validation->set_rules("username", "Username", "required|trim");
        $this->form_validation->set_rules("password", "Password", "required|trim");
        if ($this->form_validation->run() == false) {
            $this->load->view('layouts/header', $data);
            $this->load->view('user/auth', $data);
            $this->load->view('layouts/footer', $data);
        } else {
            $this->veriflogin();
        }
    }

    private function veriflogin()
    {
        if (isset($_POST['g-recaptcha-response'])) {
            $secret = "6LeUT88kAAAAAOo2WcTQEodtTwERzA7E2RM7-hgC";
            $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$_POST['g-recaptcha-response']);
            $response = json_decode($verify);
            if ($response->success) {
                $username = $this->input->post("username");
                $password = $this->input->post("password");
                $user = $this->db->get_where('user', ['username' => $username])->row_array();
                if ($user) {
                    if (password_verify($password, $user['password'])) {
                        $data = [
                            'username' => $user["username"],
                            'role' => $user["role"]
                        ];
                        $this->session->set_userdata($data);
                        $this->session->set_flashdata('pesan', '
                        <div class="alert alert-success alert-dismissible show fade">
                            <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                                Anda Berhasil Login.
                            </div>
                        </div>
                        ');
                        redirect('admin/dashboard');
                    } else {
                        $this->session->set_flashdata('pesan', '
                        <div class="alert alert-danger alert-dismissible show fade">
                            <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                                Password Yang Anda Masukan Salah.
                            </div>
                        </div>
                        ');
                        redirect("auth");
                    }
                } else {
                    $this->session->set_flashdata('pesan', '
                    <div class="alert alert-danger alert-dismissible show fade">
                        <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                            Username Yang Anda Masukan Belum Terdaftar.
                        </div>
                    </div>
                    ');
                    redirect("auth");
                }
            } else {
                $this->session->set_flashdata('pesan', '
                    <div class="alert alert-danger alert-dismissible show fade">
                        <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                            Chaptcha Salah
                        </div>
                    </div>
                ');
                redirect("auth");
            }
        }
    }

        public function logout()
        {
            $this->session->unset_userdata("username");
            $this->session->unset_userdata("role");
            $this->session->set_flashdata('pesan', '
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
                    Anda Berhasil Logout.
                </div>
            </div>
            ');
            redirect("auth");
        }
}