<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('masuk') != true) {
            $this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <i class="fa fa-exclamation-triangle mr-2"></i> Please Login First!
                                                    </div>');
            redirect('login');
        }

        $this->load->helper('security');
        $this->load->model('M_user', 'user');
    }

    public function Mahasiswa()
    {
        $data['pageTitle'] = "Home Mahasiswa";
        $this->load->view('user/home/V_Mahasiswa_home', $data);
    }

    public function Pengajuan_form()
    {
        $data['pageTitle'] = "Pengajuan Form";
        $this->load->view('user/form/V_pengajuan_form', $data);
    }

    public function Dosen()
    {
        $data['pageTitle'] = "Home Dosen";
        $this->load->view('user/home/V_Dosen_home', $data);
    }
}
