<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('security');
        $this->load->model('M_superadmin', 'superadmin');
        $this->load->model('M_master_data', 'master_data');
    }


    public function index()
    {
        $this->load->view('superadmin/V_login');
    }
    public function loginAjax()
    {
        $this->load->view('superadmin/login_via_js');
    }
    function cek_php()
    {
        phpinfo();
    }

    function berhasilLoginAjax()
    {
        if ($this->session->userdata('login') == true) {
            redirect('superadmin/Login/berhasillogin');
        } else {
            redirect('superadmin/Login/gagallogin');
        }
    }

    public function LoginViaAjax($u, $p)
    {
        $username = $u;
        $pass = $p;
        $us = $this->security->xss_clean($username);
        $pw = $this->security->xss_clean($pass);

        $cadmin = $this->superadmin->login($us, $pw);
        if ($cadmin->num_rows() > 0) {
            $this->session->set_userdata('login', true);
            $this->session->set_userdata('user', $us);
            $xcadmin = $cadmin->row_array();
            $idadmin = $xcadmin['id'];
            $user_nama = $xcadmin['username'];
            $this->session->set_userdata('idadmin', $idadmin);
            $this->session->set_userdata('nama', $user_nama);
        }
        echo json_encode($cadmin->row_array());
    }

    public function auth()
    {
        $username = strip_tags(str_replace("'", "", $this->input->post('username')));
        $password = strip_tags(str_replace("'", "", $this->input->post('password')));
        $u = $username;
        $p = $password;
        $u = $this->security->xss_clean($u);
        $p = $this->security->xss_clean($p);

        $cadmin = $this->superadmin->login($u, $p);
        if ($cadmin->num_rows() > 0) {
            $this->session->set_userdata('login', true);
            $this->session->set_userdata('user', $u);
            $xcadmin = $cadmin->row_array();
            $idadmin = $xcadmin['id'];
            $user_nama = $xcadmin['username'];
            $this->session->set_userdata('idadmin', $idadmin);
            $this->session->set_userdata('nama', $user_nama);
        }

        if ($this->session->userdata('login') == true) {
            redirect('superadmin/Login/berhasillogin');
        } else {
            redirect('superadmin/Login/gagallogin');
        }
    }

    public function berhasilLogin()
    {
        redirect('admin-home');
    }
    public function gagalLogin()
    {
        echo $this->session->set_flashdata('msg', '<div id="lookatme"  class="alert alert-danger animated fadeIn" role="alert"><i class="fa fa-times mr-2"></i>Incorrect <b>Username</b> or <b>Password !</b> </div>');
        redirect('admin-login');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('admin-login'));
    }

    public function home()
    {
        if ($this->session->userdata('login') != true) {
            $this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <i class="fa fa-exclamation-triangle mr-2"></i> Please Login First!
                                                    </div>');
            redirect('admin-login');
        }
        $data['pageTitle'] = "Dashboard";
        $all_form = $this->master_data->get_all_formulir();
        $all_surat = $this->master_data->get_all_surat();
        $data_formulir_riset = $this->master_data->get_all_form_riset();
        $data_formulir_kp = $this->master_data->get_all_form_kp();
        $data_formulir_tertunda = $this->master_data->get_all_form_tertunda();
        $data_formulir_duplikasi = $this->master_data->get_all_form_duplikasi();
        $data_surat_riset = $this->master_data->get_all_surat_riset();
        $data_surat_kp = $this->master_data->get_all_surat_kp();
        $data['data'] = [
            'all_form' => count($all_form),
            'form_riset' => count($data_formulir_riset),
            'form_kp' => count($data_formulir_kp),
            'form_tertunda' => count($data_formulir_tertunda),
            'form_reject' => count($data_formulir_duplikasi),
            'all_surat' => count($all_surat),
            'surat_riset' => count($data_surat_riset),
            'surat_kp' => count($data_surat_kp)
        ];
        $data['latest_form'] = $this->master_data->get_latest_form();
        $this->load->view('superadmin/home/V_home', $data);
    }
}
