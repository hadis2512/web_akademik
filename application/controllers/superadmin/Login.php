<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('security');
        $this->load->model('M_superadmin', 'superadmin');
    }


    public function index()
    {
        $this->load->view('superadmin/V_login');
    }
    function cek_php()
    {
        phpinfo();
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
            $this->session->set_userdata('masuk', true);
            $this->session->set_userdata('user', $u);
            $xcadmin = $cadmin->row_array();
            $idadmin = $xcadmin['id'];
            $user_nama = $xcadmin['username'];
            $this->session->set_userdata('idadmin', $idadmin);
            $this->session->set_userdata('nama', $user_nama);
        }

        if ($this->session->userdata('masuk') == true) {
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
        $url = base_url('admin-login');
        $this->session->set_flashdata('msg', '<div class="alert alert-primary alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <i class="fa fa-hand-peace-o mr-2"></i> Goodbye!
                                        </div>');
        redirect($url);
    }

    public function home()
    {
        if ($this->session->userdata('masuk') != true) {
            $this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <i class="fa fa-exclamation-triangle mr-2"></i> Please Login First!
                                                    </div>');
            redirect('admin-login');
        }
        $data['pageTitle'] = "Dashboard";
        $this->load->view('superadmin/home/V_home', $data);
    }
}
