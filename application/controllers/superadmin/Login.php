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
        $data_formulir_riset = $this->master_data->get_all_formulir();
        $data['jumlah_formulir'] = count($data_formulir_riset);

        $data_formulir_riset = $this->master_data->get_all_form_riset();
        $data['form_riset'] = count($data_formulir_riset);

        $data_formulir_kp = $this->master_data->get_all_form_kp();
        $data['form_kp'] = count($data_formulir_kp);

        $data_formulir_tertunda = $this->master_data->get_all_form_tertunda();
        $data['form_tertunda'] = count($data_formulir_tertunda);

        $data_formulir_duplikasi = $this->master_data->get_all_form_duplikasi();
        $data['form_duplikasi'] = count($data_formulir_duplikasi);

        $data_formulir_tolak = $this->master_data->get_all_form_tolak();
        $data['form_tolak'] = count($data_formulir_tolak);

        $data_surat_riset = $this->master_data->get_all_surat_riset();
        $data['surat_riset'] = count($data_surat_riset);

        $data_surat_kp = $this->master_data->get_all_surat_kp();
        $data['surat_kp'] = count($data_surat_kp);

        $data['latest_form'] = $this->master_data->get_latest_form();

        // print_r($data['latest_form']);
        // print_r($data_surat_riset);
        // die();
        $this->load->view('superadmin/home/V_home', $data);
    }
}
