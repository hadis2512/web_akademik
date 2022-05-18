<?php
defined('BASEPATH') or exit('No direct script access allowed');

class u_auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('security');
        $this->load->model('M_user', 'user');
    }


    public function index()
    {
        $data['pageTitle'] = "Sign In";
        $this->load->view('user/V_uLogin', $data);
    }
    public function auth()
    {
        $email = strip_tags(str_replace("'", "", $this->input->post('email')));
        $password = strip_tags(str_replace("'", "", $this->input->post('password')));
        $u = $email;
        $p = $password;
        $u = $this->security->xss_clean($u);
        $p = $this->security->xss_clean($p);
        $cadmin = $this->user->login($u, $p);
        // print_r($cadmin->result_array());
        // die();
        if ($cadmin == 'Password Salah!!') {
            echo $this->session->set_flashdata('msg', '<div id="lookatme"  class="alert alert-danger animated fadeIn" role="alert"><i class="fa fa-times mr-2"></i>' . $cadmin . '</b> </div>');
            redirect('login');
        } elseif ($cadmin == 'Username atau Password Salah!!') {
            echo $this->session->set_flashdata('msg', '<div id="lookatme"  class="alert alert-danger animated fadeIn" role="alert"><i class="fa fa-times mr-2"></i>Username atau Password Tidak Ada!!!</b> </div>');
            redirect('login');
        } elseif ($cadmin == null) {
            echo $this->session->set_flashdata('msg', '<div id="lookatme"  class="alert alert-danger animated fadeIn" role="alert"><i class="fa fa-times mr-2"></i>Username atau Password Salah!!!</b> </div>');
            redirect('login');
        } else {
            $this->session->set_userdata('masuk', true);
            $this->session->set_userdata('user', $u);
            $xcadmin = $cadmin->row_array();
            // print_r($xcadmin);
            // die();
            $idadmin = $xcadmin['id'];
            $email = $xcadmin['email'];
            $user_nama = $xcadmin['nama_lengkap'];
            $jabatan = $xcadmin['jabatan'];
            $foto = $xcadmin['foto'];
            $data = $this->user->get_data_lengkap($email)->result_array();
            $prodi = $data[0]['nama_prodi'];

            $this->session->set_userdata('idadmin', $idadmin);
            $this->session->set_userdata('email', $email);
            $this->session->set_userdata('nama', $user_nama);
            $this->session->set_userdata('foto', $foto);
            $this->session->set_userdata('jabatan', $jabatan);
            $this->session->set_userdata('prodi', $prodi);
            if ($jabatan == "Dosen") {
                redirect('Dosen-home');
            } elseif ($jabatan == "Mahasiswa") {
                redirect('Mahasiswa-home');
            }
        }
        // if ($this->session->userdata('masuk') == true) {
        //     if ($jab == 'Mahasiswa') {
        //         redirect('Mahasiswa-home');
        //     } elseif ($jab == 'Dosen') {
        //         redirect('Dosen-home');
        //     } else {
        //         echo $this->session->set_flashdata('msg', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Akun belum terdaftar!</div>');
        //         redirect('user/u_auth/gagallogin');
        //     }
        // } else {
        //     echo $this->session->set_flashdata('msg', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Akun belum terdaftar!</div>');
        //     redirect('user/u_auth/gagallogin');
        // }
    }


    public function logout()
    {
        $this->session->sess_destroy();
        $url = base_url('login');
        $this->session->set_flashdata('msg', '<div class="alert alert-primary alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        <i class="fa fa-hand-peace-o mr-2"></i> Goodbye!
        </div>');
        redirect($url);
    }
}
