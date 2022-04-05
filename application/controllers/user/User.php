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
        $this->load->model('M_master_data', 'master_data');
    }

    public function back_to_home($id_jabatan)
    {
        if ($id_jabatan == "Dosen") {
            redirect('Dosen-home');
        } elseif ($id_jabatan == "Mahasiswa") {
            redirect('Mahasiswa-home');
        }
    }


    public function Pengajuan_form()
    {
        $data['id_pengguna'] = $this->session->userdata('idadmin');
        $id_pengguna = $data['id_pengguna'];
        $data['pageTitle'] = "Pengajuan Form";
        $data['jenis'] = $this->master_data->get_detail_jenis($id_pengguna);
        $data['jenis_p'] = $this->master_data->get_jenis_permohonan();
        $data['User'] = $this;
        $data['riset'] = $this->master_data->get_detail_riset($id_pengguna);
        $data['kp'] = $this->master_data->get_detail_kp($id_pengguna);
        $data['form'] = $this->master_data->get_form($id_pengguna);
        // print_r($data['kp']);
        // print_r($data['riset']);
        // print_r($data['form']);
        // die();
        $this->load->view('user/form/V_pengajuan_form', $data);
    }
    public function Pengajuan_form_dosen()
    {
        $data['id_pengguna'] = $this->session->userdata('idadmin');
        $data['nama_prodi'] = $this->session->userdata('prodi');
        $prodi = $data['nama_prodi'];
        // print_r($prodi);
        // die();
        $data['pageTitle'] = "Pengajuan Form";
        $data['User'] = $this;
        $data['form'] = $this->master_data->get_all_form_by_prodi($prodi)->result_array();
        $data['jenis_p'] = $this->master_data->get_jenis_permohonan();
        $form = $this->master_data->get_all_form_by_prodi($prodi);
        if ($form->num_rows > 0) {
            $data['view_more'] = '<div class="my-4 d-flex flex-row-reverse">
            <a href="" class="btn btn-inverse-info btn-sm "><i class="icon-grid mr-3"></i>View More</a>
        </div>';
        } else {
            $data['view_more'] = '<div class="row flex-grow">
            <div class="col-lg-7  mx-auto text-secondary">
                <div class="row align-items-center d-flex flex-row">
                    <div class="col-lg-12 error-page-divider text-lg-center pl-lg-4">                        
                        <h3 class="font-weight-light mt-5">Saat ini belum ada data.</h3>
                    </div>
                </div>
                
                <div class="row mt-5">
                    <div class="col-12 mt-xl-2">
                        <p class="text-white font-weight-medium text-center">Copyright &copy; 2021 All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>';
        }
        // print_r($data['form']);
        // print_r($data['jenis_p']);
        // die();
        $this->load->view('user/form/V_pengajuan_form_dosen', $data);
    }

    public function get_detail_form($id_formulir, $jenis_permohonan)
    {
        if ($jenis_permohonan == 1) {
            $detail_form = $this->master_data->get_detail_surat_riset($id_formulir, $jenis_permohonan);
            echo json_encode($detail_form);
        } elseif ($jenis_permohonan == 2) {
            $detail_form = $this->master_data->get_detail_surat_kp($id_formulir, $jenis_permohonan);
            echo json_encode($detail_form);
        }
    }

    public function Create_surat($id)
    {

        $data['jenis_permohonan'] = $id;
        if ($id == 1) {
            $data['pageTitle'] = "Surat Pengantar Riset";
            $this->load->view('user/form/V_surat_pengantar_riset', $data);
        } elseif ($id == 2) {
            $data['pageTitle'] = "Surat Pengantar Kerja Praktik";
            $this->load->view('user/form/V_surat_pengantar_kp', $data);
        } else {
            $data['pageTitle'] = "404 NOT FOUND";
            $this->load->view('errors/V_404', $data);
        }
    }

    public function Mahasiswa()
    {
        $data['pageTitle'] = "Home Mahasiswa";
        $this->load->view('user/home/V_Mahasiswa_home', $data);
    }

    public function Dosen()
    {
        $data['pageTitle'] = "Home Dosen";
        $this->load->view('user/home/V_Dosen_home', $data);
    }

    public function dateDifference($start_date, $end_date)
    {
        // calulating the difference in timestamps 
        $diff = strtotime($start_date) - strtotime($end_date);

        // 1 day = 24 hours 
        // 24 * 60 * 60 = 86400 seconds
        return ceil(abs($diff / 86400));
    }
    public function Buat_surat($jenis_permohonan)
    {
        $nama_surat = $this->master_data->get_jenis_permohonan_by($jenis_permohonan);
        // print_r($nama_surat);
        // die();
        $no_form = 'FR-KALBIS-OPR-' . rand(10000, 99999) . "/V1/R0";
        $data = [
            'no_form' => $no_form,
            'id_mahasiswa' => $this->session->userdata('idadmin'),
            'id_jenis_permohonan' => $jenis_permohonan,
            'created_at' => date('Y-m-d H:i:S')
        ];
        $data1 = $this->security->xss_clean($data);
        $insert = $this->master_data->save_formulir($data1);

        if ($insert) {
            $jenis_permohonan = $this->master_data->get_new_formulir($insert);


            if ($jenis_permohonan['id_jenis_permohonan'] == 1) {
                $data_surat = [
                    'id_formulir' => $insert,
                    'jenis_tugas' => str_replace("'", "", $this->security->xss_clean($this->input->post('jenis_tugas'))),
                    'judul' => str_replace("'", "", $this->security->xss_clean($this->input->post('judul'))),
                ];
                $data2 = $this->security->xss_clean($data_surat);
                $insert1 = $this->master_data->save_surat_riset($data2);
            } elseif ($jenis_permohonan['id_jenis_permohonan'] == 2) {
                $data_surat = [
                    'id_formulir' => $insert,
                    'alamat_surat' => str_replace("'", "", $this->security->xss_clean($this->input->post('alamat_perusahaan'))),
                    'nama_perusahaan' => str_replace("'", "", $this->security->xss_clean($this->input->post('nama_perusahaan'))),
                    'perwakilan_perusahaan' => str_replace("'", "", $this->security->xss_clean($this->input->post('perwakilan'))),
                    'jabatan' => str_replace("'", "", $this->security->xss_clean($this->input->post('jabatan_perwakilan'))),
                    'telp_perusahaan' => str_replace("'", "", $this->security->xss_clean($this->input->post('no_telp_perusahaan'))),
                ];
                $data2 = $this->security->xss_clean($data_surat);
                $insert1 = $this->master_data->save_surat_kp($data2);
            }
            echo $this->session->set_flashdata('msg', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Formulir pengajuan  <b>' . $nama_surat . '</b> Successfully added to database.</div>');
            redirect('Pengajuan-Form');
        }
        // print_r($data);
        // die();
    }
}
