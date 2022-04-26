<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_data extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('login') != true) {
            $this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <i class="fa fa-exclamation-triangle mr-2"></i> Please Login First!
                                                    </div>');
            redirect('admin-login');
        }
        $this->load->helper('security');
        $this->load->model('M_superadmin', 'superadmin');
        $this->load->model('M_master_data', 'master_data');
        $this->load->library(array('upload', 'Pdf', 'Qrcode'));
    }

    public function data()
    {
        $data = $this->master_data->get_data();

        $result = array();
        $no = 1;
        foreach ($data as $a) {
            $button = '<div class="d-flex ">
            <a href="#" data-toggle="modal" data-target="#details' . $a["id"] . '" id="#modalCenter" class="btn btn-info btn-sm">
                <i class="fas fa-info-circle"></i>
            </a>
            <a href="#" data-toggle="modal" data-target="#delete' . $a["id"] . '" id="#modalCenter" class="btn btn-danger btn-sm"><i class="fa fa-trash " aria-hidden="true"></i></a>
        </div>';



            $result['data'][] = array(
                $no++,
                $a['nim'],
                $a['email'],
                $a['nama_lengkap'],
                $a['tempat'] . ', ' .
                    $a['tgl_lahir'],
                $a['jenis_kelamin'],
                $button
            );
        }
        echo json_encode($result);
        // print_r($data);
        // die();
    }
    public function add_surat()
    {
        $data['pageTitle'] = "Add Surat";
        $data['program'] = $this->master_data->get_all_program();
        $data['jenis_permohonan'] = $this->master_data->get_all_permohonan();

        $this->load->view('superadmin/home/V_add_surat', $data);
    }

    public function get_prodi($id)
    {
        $data = $this->master_data->get_prodi_id($id);
        $result = array();
        foreach ($data as $a) {
            $select =  '<option value="' . $a['id'] . '">' . $a['program_studi'] . '</option>';
            array_push($result, $select);
        }
        echo json_encode($result);
    }
    public function add_mahasiswa()
    {
        $data['pageTitle'] = "Add Mahasiswa";
        $data['program'] = $this->master_data->get_all_program();

        $this->load->view('superadmin/home/V_add_mahasiswa', $data);
    }
    function get_prodi_by_id($id)
    {
        $data = $this->master_data->get_prodi($id);
        $result = array();
        foreach ($data as $a) {
            $select =  '<option value="' . $a['id'] . '">' . $a['program_studi'] . '</option>';
            array_push($result, $select);
        }
        echo json_encode($result);
    }
    public function data_mahasiswa()
    {
        $data['pageTitle'] = "Data Mahasiswa";
        $data['data_mahasiswa'] = $this->master_data->get_all_mhs();
        $data['program'] = $this->master_data->get_all_program();
        // print_r($data['data_mahasiswa']);
        // die();
        $this->load->view('superadmin/home/V_data_mahasiswa', $data);
    }
    public function testing()
    {
        $data['pageTitle'] = "Data Mahasiswa";
        $this->load->view('superadmin/home/tst', $data);
    }
    public function add_karyawan()
    {
        $data['pageTitle'] = "Add karyawan";
        $data['program'] = $this->master_data->get_all_program();
        $data['prodi'] = $this->master_data->get_prodi();
        // $data['jabatan'] = $this->master_data->get_all_jbtn();
        $this->load->view('superadmin/home/V_add_karyawan', $data);
    }

    public function add_data_ttd()
    {
        $data['pageTitle'] = "Add Tanda Tangan";
        $data['jenis_permohonan'] = $this->master_data->get_jenis_permohonan();
        // $data['jabatan'] = $this->master_data->get_all_jbtn();
        $this->load->view('superadmin/home/V_add_data_ttd', $data);
    }

    public function data_ttd()
    {
        $data['pageTitle'] = "Data Tanda Tangan";
        $data['data_ttd'] = $this->master_data->get_all_data_ttd();
        // print_r($data);
        // die();
        $this->load->view('superadmin/home/V_data_ttd', $data);
    }
    public function data_surat()
    {
        $data['pageTitle'] = "Data Surat";
        $data['data_surat'] = $this->master_data->get_all_form_admin_by_surat();
        // print_r($data['data_surat']);
        // die();
        $this->load->view('superadmin/home/V_data_surat', $data);
    }

    public function data_formulir()
    {
        $data['pageTitle'] = "Data Formulir";
        $data['jenis_p'] = $this->master_data->get_jenis_permohonan();
        $data['data_formulir'] = $this->master_data->get_all_form_by_admin();

        // print_r($data['data_formulir']);
        // die();
        $this->load->view('superadmin/home/V_data_formulir', $data);
    }

    public function data_karyawan()
    {
        $data['pageTitle'] = "Data Karyawan";
        $data['data_karyawan'] = $this->master_data->get_all_karyawan();

        // print_r($data['prodi']);
        // die();
        $data['jabatan'] = $this->master_data->get_all_jbtn();
        // print_r($data['data_karyawan']);
        // die();
        $this->load->view('superadmin/home/V_data_karyawan', $data);
    }
    public function get_formulir_riset($id_jenis_p, $id_formulir)
    {
        $data['surat_riset'] = $this->master_data->get_formulir_riset($id_jenis_p, $id_formulir);
        $surat_riset = $data['surat_riset'];
        $data['pageTitle'] = "Detail Formulir " . $surat_riset['no_form'];
        $data['id_jenis_p'] = $id_jenis_p;
        // echo json_encode($data['surat_riset']);
        // die();        
        $this->load->view('superadmin/home/V_detail_formulir_riset', $data);
    }
    public function get_surat_riset($id_jenis_p, $id_formulir)
    {
        $data['surat_riset'] = $this->master_data->get_formulir_riset($id_jenis_p, $id_formulir);
        $surat_riset = $data['surat_riset'];
        $data['pageTitle'] = "Detail Surat Riset " . $surat_riset['no_form'];
        $data['id_jenis_p'] = $id_jenis_p;
        // echo json_encode($data['surat_riset']);
        // die();
        $this->load->view('superadmin/home/V_detail_surat_riset', $data);
    }
    public function get_formulir_kp($id_jenis_p, $id_formulir)
    {
        $data['pageTitle'] = "Detail Formulir KP";
        $data['surat_kp'] = $this->master_data->get_detail_surat_kp($id_formulir, $id_jenis_p);
        // echo json_encode($data['surat_kp']);
        // die();
        $data['id_jenis_p'] = $id_jenis_p;

        $this->load->view('superadmin/home/V_detail_formulir_kp', $data);
    }
    public function get_surat_kp($id_jenis_p, $id_formulir)
    {
        $data['pageTitle'] = "Detail Surat KP";
        $data['surat_kp'] = $this->master_data->get_detail_surat_kp($id_formulir, $id_jenis_p);
        // echo json_encode($data['surat_kp']);
        // die();
        $data['id_jenis_p'] = $id_jenis_p;

        $this->load->view('superadmin/home/V_detail_surat_kp', $data);
    }

    public function validate($id_formulir, $id_jenis_p)
    {
        if ($id_jenis_p == 1) {
            $data = [
                'id_formulir' => $id_formulir,
                'approval' => 1,
                'approval_admin' => 1
            ];
            $this->master_data->validasi_admin1($data);
            redirect('admin-data-formulir');
        } elseif ($id_jenis_p == 2) {
            $this->master_data->validasi_admin($id_formulir);
            redirect('admin-data-formulir');
        }
    }

    public function create_surat($id_formulir, $id_jenis_p)
    {

        if ($id_jenis_p == 1) {
            $get_surat = $this->master_data->get_surat_riset($id_jenis_p);
            $tot_surat = count($get_surat);
            // print_r($tot_surat);
            // die();
            $year = date("Y");
            if ($tot_surat < 10) {
                $jumlah_surat = "00";
            } elseif ($tot_surat > 9 && $tot_surat < 100) {
                $jumlah_surat = "0";
            } elseif ($tot_surat > 99) {
                $jumlah_surat = "";
            }
            $total_surat = $tot_surat + 1;
            $data = [
                'no_surat' => $jumlah_surat . $total_surat . '/AO-SRT/IV/' . $year,
                'id_formulir' => $id_formulir,
                'created_at' => date("Y-m-d")
            ];
            // print_r($data);
            // die();
            $insert_surat_riset = $this->master_data->insert_surat_riset($data);
            $this->master_data->admin_buat_surat($id_formulir);
            if ($insert_surat_riset) {
                echo $this->session->set_flashdata('msg', '<div id="lookatme"  class="alert alert-success animated fadeIn" role="alert"><i class="fa fa-times mr-2"></i>Data Surat Berhasil Di Buat!</div>');
                redirect('admin-data-formulir');
            } else {
                echo $this->session->set_flashdata('msg', '<div id="lookatme"  class="alert alert-danger animated fadeIn" role="alert"><i class="fa fa-times mr-2"></i>Data Surat Gagal Di Buat!</div>');
                redirect('admin-data-formulir');
            }
        } elseif ($id_jenis_p == 2) {
            $get_surat = $this->master_data->get_surat_kp($id_jenis_p);
            $tot_surat = count($get_surat);
            // print_r($tot_surat);
            // die();
            $year = date("Y");
            if ($tot_surat < 10) {
                $jumlah_surat = "00";
            } elseif ($tot_surat > 9 && $tot_surat < 100) {
                $jumlah_surat = "0";
            } elseif ($tot_surat > 99) {
                $jumlah_surat = "";
            }
            $total_surat = $tot_surat + 1;
            $data = [
                'no_surat' => $jumlah_surat . $total_surat . '/WRII-SRT/VI/' . $year,
                'id_formulir' => $id_formulir,
                'created_at' => date("Y-m-d")
            ];
            $insert_surat_kp = $this->master_data->insert_surat_kp($data);
            $this->master_data->admin_buat_surat($id_formulir);
            if ($insert_surat_kp) {
                echo $this->session->set_flashdata('msg', '<div id="lookatme"  class="alert alert-success animated fadeIn" role="alert"><i class="fa fa-times mr-2"></i>Data Surat Berhasil Di Buat!</div>');
                redirect('admin-data-formulir');
            } else {
                echo $this->session->set_flashdata('msg', '<div id="lookatme"  class="alert alert-danger animated fadeIn" role="alert"><i class="fa fa-times mr-2"></i>Data Surat Gagal Di Buat!</div>');
                redirect('admin-data-formulir');
            }
        }
    }
    public function duplicate($id_formulir, $id_jenis_p)
    {
        $this->master_data->duplikasi_admin($id_formulir);
        if ($id_jenis_p == 1) {
            redirect('admin-data-formulir');
        } elseif ($id_jenis_p == 2) {
            redirect('admin-data-formulir');
        }
    }

    public function detail($id_jenis_p, $id_formulir)
    {
        if ($id_jenis_p == 1) {
            redirect('superadmin/master_data/get_formulir_riset/' . $id_jenis_p . '/' . $id_formulir);
        } elseif ($id_jenis_p == 2) {
            redirect('superadmin/master_data/get_formulir_kp/' . $id_jenis_p . '/' . $id_formulir);
        }
    }
    public function detail_surat($id_jenis_p, $id_formulir)
    {
        if ($id_jenis_p == 1) {
            redirect('superadmin/master_data/get_surat_riset/' . $id_jenis_p . '/' . $id_formulir);
        } elseif ($id_jenis_p == 2) {
            redirect('superadmin/master_data/get_surat_kp/' . $id_jenis_p . '/' . $id_formulir);
        }
    }

    public function delete_mahasiswa($id)
    {
        $delete_data = $this->master_data->delete_data_mahasiswa($id);

        echo $this->session->set_flashdata('msg', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Data berhasil di hapus !</div>');
        redirect('superadmin/Master_data/data_mahasiswa');
        // if ($delete_data) {
        //     $delete_mhs = $this->master_data->delete_mahasiswa($id);
        //     if ($delete_mhs) {
        //     }
        // }
    }
    public function delete_karyawan($id)
    {
        $this->master_data->delete_karyawan($id);
        // $url = $this->data_mahasiswa();
        echo $this->session->set_flashdata('msg', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Data berhasil di hapus !</div>');
        redirect('superadmin/Master_data/data_karyawan');
    }

    public function save_ttd()
    {
        $nama = str_replace("'", "", $this->security->xss_clean($this->input->post('nama_lengkap')));
        $nmfile = "ttd_" . $nama; //nama file saya beri nama langsung dan diikuti fungsi time
        $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'] . '/web_akademik/assets/data/ttd/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '2048000000'; //maksimum besar file 2M
        $config['max_width']  = '0'; //lebar maksimum 1288 px
        $config['max_height']  = '0'; //tinggi maksimu 1000 px
        $config['file_name'] = $nmfile; //nama yang terupload nantinya

        $this->upload->initialize($config);
        $this->load->library('upload', $config);
        if (!empty($_FILES['foto']['name'])) {
            if ($this->upload->do_upload('foto')) {

                $pic = $this->upload->data();
                $foto = "/assets/data/ttd/" . $pic['file_name'];

                $data = [
                    'nama' => $nama,
                    'jabatan' => str_replace("'", "", $this->security->xss_clean($this->input->post('jabatan'))),
                    'id_jenis_permohonan' => str_replace("'", "", $this->security->xss_clean($this->input->post('jenis_permohonan'))),
                    'tanda_tangan' => $foto,
                    'created_at' => date('Y-m-d H:i:S'),
                    'updated_at' => date('Y-m-d H:i:S')
                ];
                // print_r($data);
                // die();
                $data1 = $this->security->xss_clean($data);
                $insert = $this->master_data->save_ttd($data1);
                if ($insert == true) {
                    echo $this->session->set_flashdata('msg', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Data tanda tangan <b>' . $nama . '</b>, berhasil ditambahkan.</div>');
                    redirect('admin-add-ttd');
                } else {
                    echo $this->session->set_flashdata('msg', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Data tanda tangan <b>' . $nama . '</b>, gagal ditambahkan.</div>');
                    redirect('admin-add-ttd');
                }
            } else {
                echo $this->session->set_flashdata('msg', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>' . $this->upload->display_errors() . '</div>');
                redirect('admin-add-ttd');
            }
        }
    }

    public function save_karyawan()
    {
        $nip = str_replace("'", "", $this->security->xss_clean($this->input->post('nip')));
        $nmfile = $nip . "_" . date("H-i-s"); //nama file saya beri nama langsung dan diikuti fungsi time
        $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'] . '/web_akademik/assets/data/karyawan/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '2048000000'; //maksimum besar file 2M
        $config['max_width']  = '0'; //lebar maksimum 1288 px
        $config['max_height']  = '0'; //tinggi maksimu 1000 px
        $config['file_name'] = $nmfile; //nama yang terupload nantinya
        $pw = md5(str_replace("'", "", $this->security->xss_clean($this->input->post('password'))),);
        $this->upload->initialize($config);
        $this->load->library('upload', $config);
        if (!empty($_FILES['foto']['name'] && $pw)) {
            if ($this->upload->do_upload('foto')) {

                $pic = $this->upload->data();
                $foto = "/assets/data/karyawan/" . $pic['file_name'];

                $data = [
                    'email' => str_replace("'", "", $this->security->xss_clean($this->input->post('email'))),
                    'nama_lengkap' => str_replace("'", "", $this->security->xss_clean($this->input->post('nama_lengkap'))),
                    'password' => $pw,
                    'tempat' => str_replace("'", "", $this->security->xss_clean($this->input->post('tempat'))),
                    'tgl_lahir' => str_replace("'", "", $this->security->xss_clean($this->input->post('tgl_lahir'))),
                    'jenis_kelamin' => str_replace("'", "", $this->security->xss_clean($this->input->post('jenis_kelamin'))),
                    'no_telp' => str_replace("'", "", $this->security->xss_clean($this->input->post('no_telp'))),
                    'alamat' => str_replace("'", "", $this->security->xss_clean($this->input->post('alamat'))),
                    'foto' => $foto,
                    'jabatan' => "Dosen",
                    'created_at' => date('Y-m-d H:i:S'),
                    'updated_at' => date('Y-m-d H:i:S')
                ];

                $data1 = $this->security->xss_clean($data);

                $insert = $this->master_data->save_karyawan($data1);
                if ($insert) {
                    $data_prodi = [
                        'id_karyawan' => $insert,
                        'nip' => $nip,
                        'program_studi' => str_replace("'", "", $this->security->xss_clean($this->input->post('prodi'))),
                    ];
                    $data2 = $this->security->xss_clean($data_prodi);
                    $insert_id = $this->master_data->save_data_karyawan($data2);
                    echo $this->session->set_flashdata('msg', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Data  <b>' . $data['nama_lengkap'] . '</b> Successfully added to database.</div>');
                    redirect('superadmin/Master_data/add_karyawan');
                } else {
                    echo $this->session->set_flashdata('msg', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button></b> Failed added to database.</div>');
                    redirect('superadmin/Master_data/add_karyawan');
                }
            } else {
                echo $this->session->set_flashdata('msg', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>' . $this->upload->display_errors() . '.</div>');
                redirect('superadmin/Master_data/add_karyawan');
            }
        } else {
            $data = [

                'email' => str_replace("'", "", $this->security->xss_clean($this->input->post('email'))),
                'nama_lengkap' => str_replace("'", "", $this->security->xss_clean($this->input->post('nama_lengkap'))),
                'password' => $pw,
                'tempat' => str_replace("'", "", $this->security->xss_clean($this->input->post('tempat'))),
                'tgl_lahir' => str_replace("'", "", $this->security->xss_clean($this->input->post('tgl_lahir'))),
                'jenis_kelamin' => str_replace("'", "", $this->security->xss_clean($this->input->post('jenis_kelamin'))),
                'no_telp' => str_replace("'", "", $this->security->xss_clean($this->input->post('no_telp'))),
                'alamat' => str_replace("'", "", $this->security->xss_clean($this->input->post('alamat'))),
                'jabatan' => "Dosen",
                'created_at' => date('Y-m-d H:i:S'),
                'updated_at' => date('Y-m-d H:i:S')
            ];


            $data = $this->security->xss_clean($data);

            $insert2 = $this->master_data->save_karyawan1($data);
            if ($insert2) {
                $data_prodi = [
                    'id_karyawan' => $insert2,
                    'nip' => $nip,
                    'program_studi' => str_replace("'", "", $this->security->xss_clean($this->input->post('prodi'))),

                ];
                $data2 = $this->security->xss_clean($data_prodi);
                $insert_id = $this->master_data->save_data_karyawan($data2);
                echo $this->session->set_flashdata('msg', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Data <b>' . $data['nama_lengkap'] . '</b> Successfully added to database.</div>');
                redirect('superadmin/Master_data/add_karyawan');
            } else {
                echo $this->session->set_flashdata('msg', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Data <b>' . $data['nama_lengkap'] . '</b> Failed added to database.</div>');
                redirect('superadmin/Master_data/add_karyawan');
            }
        }
    }
    public function update_karyawan($id)
    {
        $nip = str_replace("'", "", $this->security->xss_clean($this->input->post('nip')));
        $nmfile = $nip . "_" . date("H-i-s"); //nama file saya beri nama langsung dan diikuti fungsi time
        $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'] . '/web_akademik/assets/data/karyawan/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '2048000000'; //maksimum besar file 2M
        $config['max_width']  = '0'; //lebar maksimum 1288 px
        $config['max_height']  = '0'; //tinggi maksimu 1000 px
        $config['file_name'] = $nmfile; //nama yang terupload nantinya
        $pw = md5(str_replace("'", "", $this->security->xss_clean($this->input->post('password'))),);
        $this->upload->initialize($config);
        $this->load->library('upload', $config);
        if (!empty($_FILES['foto']['name'])) {
            if ($this->upload->do_upload('foto')) {

                $pic = $this->upload->data();
                $foto = "/assets/data/karyawan/" . $pic['file_name'];

                $data = [
                    'nip' => $nip,
                    'email' => str_replace("'", "", $this->security->xss_clean($this->input->post('email'))),
                    'nama_lengkap' => str_replace("'", "", $this->security->xss_clean($this->input->post('nama_lengkap'))),
                    'password' => $pw,
                    'tempat' => str_replace("'", "", $this->security->xss_clean($this->input->post('tempat'))),
                    'tgl_lahir' => str_replace("'", "", $this->security->xss_clean($this->input->post('tgl_lahir'))),
                    'jenis_kelamin' => str_replace("'", "", $this->security->xss_clean($this->input->post('jenis_kelamin'))),
                    'no_telp' => str_replace("'", "", $this->security->xss_clean($this->input->post('no_telp'))),
                    'alamat' => str_replace("'", "", $this->security->xss_clean($this->input->post('alamat'))),
                    'foto' => $foto,
                    'jabatan' => "Dosen",
                    'created_at' => date('Y-m-d H:i:S'),
                    'updated_at' => date('Y-m-d H:i:S')
                ];
                $data1 = $this->security->xss_clean($data);

                $insert = $this->master_data->update_karyawan($data1, $id);
                if ($insert) {
                    echo $this->session->set_flashdata('msg', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Data  <b>' . $data['nama_lengkap'] . '</b> Successfully updated to database.</div>');
                    redirect('superadmin/Master_data/data_karyawan');
                } else {
                    echo $this->session->set_flashdata('msg', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button></b> Failed updated to database.</div>');
                    redirect('superadmin/Master_data/data_karyawan');
                }
            } else {
                echo $this->session->set_flashdata('msg', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>' . $this->upload->display_errors() . '.</div>');
                redirect('superadmin/Master_data/data_karyawan');
            }
        } else {
            $data = [
                'nip' => $nip,
                'email' => str_replace("'", "", $this->security->xss_clean($this->input->post('email'))),
                'nama_lengkap' => str_replace("'", "", $this->security->xss_clean($this->input->post('nama_lengkap'))),
                'password' => $pw,
                'tempat' => str_replace("'", "", $this->security->xss_clean($this->input->post('tempat'))),
                'tgl_lahir' => str_replace("'", "", $this->security->xss_clean($this->input->post('tgl_lahir'))),
                'jenis_kelamin' => str_replace("'", "", $this->security->xss_clean($this->input->post('jenis_kelamin'))),
                'no_telp' => str_replace("'", "", $this->security->xss_clean($this->input->post('no_telp'))),
                'alamat' => str_replace("'", "", $this->security->xss_clean($this->input->post('alamat'))),
                'id_jabatan' => str_replace("'", "", $this->security->xss_clean($this->input->post('jabatan'))),
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:S'),
                'updated_at' => date('Y-m-d H:i:S')
            ];


            $data = $this->security->xss_clean($data);

            $this->master_data->update_karyawan1($data, $id);
            echo $this->session->set_flashdata('msg', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Data <b>' . $data['nama_lengkap'] . '</b> Successfully added to database.</div>');
            redirect('superadmin/Master_data/data_karyawan');
        }
    }

    public function save_mahasiswa()
    {

        $nim = str_replace("'", "", $this->security->xss_clean($this->input->post('nim')));
        $nmfile = $nim . "_" . date("H-i-s"); //nama file saya beri nama langsung dan diikuti fungsi time
        $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'] . '/web_akademik/assets/data/mahasiswa/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '2048000000'; //maksimum besar file 2M
        $config['max_width']  = '0'; //lebar maksimum 1288 px
        $config['max_height']  = '0'; //tinggi maksimu 1000 px
        $config['file_name'] = $nmfile; //nama yang terupload nantinya
        $pw = md5(str_replace("'", "", $this->security->xss_clean($this->input->post('password'))),);
        $this->upload->initialize($config);
        $this->load->library('upload', $config);
        if (!empty($_FILES['foto']['name'])) {
            if ($this->upload->do_upload('foto')) {

                $pic = $this->upload->data();
                $foto = "/assets/data/mahasiswa/" . $pic['file_name'];

                $data = [

                    'email' => str_replace("'", "", $this->security->xss_clean($this->input->post('email'))),
                    'nama_lengkap' => str_replace("'", "", $this->security->xss_clean($this->input->post('nama_lengkap'))),
                    'password' => $pw,
                    'tempat' => str_replace("'", "", $this->security->xss_clean($this->input->post('tempat'))),
                    'tgl_lahir' => str_replace("'", "", $this->security->xss_clean($this->input->post('tgl_lahir'))),
                    'jenis_kelamin' => str_replace("'", "", $this->security->xss_clean($this->input->post('jenis_kelamin'))),
                    'no_telp' => str_replace("'", "", $this->security->xss_clean($this->input->post('no_telp'))),
                    'alamat' => str_replace("'", "", $this->security->xss_clean($this->input->post('alamat'))),
                    'foto' => $foto,
                    'jabatan' => "Mahasiswa",
                    'created_at' => date('Y-m-d H:i:S'),
                    'updated_at' => date('Y-m-d H:i:S')
                ];



                $data1 = $this->security->xss_clean($data);
                $insert = $this->master_data->save_mahasiswa($data1);

                if ($insert) {
                    $data_prodi = [
                        'id_mahasiswa' => $insert,
                        'nim' => $nim,
                        'program_studi' => str_replace("'", "", $this->security->xss_clean($this->input->post('prodi'))),
                    ];
                    $data2 = $this->security->xss_clean($data_prodi);
                    $insert_id = $this->master_data->save_data_kampus($data2);

                    echo $this->session->set_flashdata('msg', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Data  <b>' . $data['nama_lengkap'] . '</b> Successfully added to database.</div>');
                    redirect('superadmin/Master_data/add_mahasiswa');
                } else {
                    echo $this->session->set_flashdata('msg', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button></b> Failed added to database.</div>');
                    redirect('superadmin/Master_data/add_mahasiswa');
                }
            } else {
                echo $this->session->set_flashdata('msg', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>' . $this->upload->display_errors() . '.</div>');
                redirect('superadmin/Master_data/add_mahasiswa');
            }
        } else {
            $data = [
                'email' => str_replace("'", "", $this->security->xss_clean($this->input->post('email'))),
                'nama_lengkap' => str_replace("'", "", $this->security->xss_clean($this->input->post('nama_lengkap'))),
                'password' => $pw,
                'tempat' => str_replace("'", "", $this->security->xss_clean($this->input->post('tempat'))),
                'tgl_lahir' => str_replace("'", "", $this->security->xss_clean($this->input->post('tgl_lahir'))),
                'jenis_kelamin' => str_replace("'", "", $this->security->xss_clean($this->input->post('jenis_kelamin'))),
                'no_telp' => str_replace("'", "", $this->security->xss_clean($this->input->post('no_telp'))),
                'alamat' => str_replace("'", "", $this->security->xss_clean($this->input->post('alamat'))),
                'jabatan' => "Mahasiswa",
                'created_at' => date('Y-m-d H:i:S'),
                'updated_at' => date('Y-m-d H:i:S')
            ];




            $data1 = $this->security->xss_clean($data);


            $a = $this->master_data->save_mahasiswa1($data1);
            // print_r($a);
            // die();
            if ($a) {
                $data_prodi = [
                    'id_mahasiswa' => $a,
                    'nim' => $nim,
                    'program_studi' => str_replace("'", "", $this->security->xss_clean($this->input->post('prodi'))),
                ];
                $data2 = $this->security->xss_clean($data_prodi);
                $insert_id = $this->master_data->save_data_kampus($data2);
            }

            echo $this->session->set_flashdata('msg', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Data <b>' . $data['nama_lengkap'] . '</b> Successfully added to database.</div>');
            redirect('superadmin/Master_data/add_mahasiswa');
        }
    }
    public function update_mahasiswa($id)
    {

        $nim = str_replace("'", "", $this->security->xss_clean($this->input->post('nim')));
        $nmfile = $nim . "_" . date("H-i-s"); //nama file saya beri nama langsung dan diikuti fungsi time
        $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'] . '/web_akademik/assets/data/mahasiswa/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '2048000000'; //maksimum besar file 2M
        $config['max_width']  = '0'; //lebar maksimum 1288 px
        $config['max_height']  = '0'; //tinggi maksimu 1000 px
        $config['file_name'] = $nmfile; //nama yang terupload nantinya
        $pw = md5(str_replace("'", "", $this->security->xss_clean($this->input->post('password'))),);
        $this->upload->initialize($config);
        $this->load->library('upload', $config);
        if (!empty($_FILES['foto']['name'])) {
            if ($this->upload->do_upload('foto')) {

                $pic = $this->upload->data();
                $foto = "/assets/data/mahasiswa/" . $pic['file_name'];

                $data = [

                    'email' => str_replace("'", "", $this->security->xss_clean($this->input->post('email'))),
                    'nama_lengkap' => str_replace("'", "", $this->security->xss_clean($this->input->post('nama_lengkap'))),
                    'password' => $pw,
                    'tempat' => str_replace("'", "", $this->security->xss_clean($this->input->post('tempat'))),
                    'tgl_lahir' => str_replace("'", "", $this->security->xss_clean($this->input->post('tgl_lahir'))),
                    'jenis_kelamin' => str_replace("'", "", $this->security->xss_clean($this->input->post('jenis_kelamin'))),
                    'no_telp' => str_replace("'", "", $this->security->xss_clean($this->input->post('no_telp'))),
                    'alamat' => str_replace("'", "", $this->security->xss_clean($this->input->post('alamat'))),
                    'foto' => $foto,
                    'updated_at' => date('Y-m-d H:i:S')
                ];

                $data_kampus = [
                    'nim' => $nim,
                    'program_studi' => $this->input->post('prodi')
                ];
                if ($data['password'] == null) {
                    $data = [
                        'email' => str_replace("'", "", $this->security->xss_clean($this->input->post('email'))),
                        'nama_lengkap' => str_replace("'", "", $this->security->xss_clean($this->input->post('nama_lengkap'))),
                        'tempat' => str_replace("'", "", $this->security->xss_clean($this->input->post('tempat'))),
                        'tgl_lahir' => str_replace("'", "", $this->security->xss_clean($this->input->post('tgl_lahir'))),
                        'jenis_kelamin' => str_replace("'", "", $this->security->xss_clean($this->input->post('jenis_kelamin'))),
                        'no_telp' => str_replace("'", "", $this->security->xss_clean($this->input->post('no_telp'))),
                        'alamat' => str_replace("'", "", $this->security->xss_clean($this->input->post('alamat'))),
                        'foto' => $foto,
                        'updated_at' => date('Y-m-d H:i:S')
                    ];
                    $data1 = $this->security->xss_clean($data);
                    $data2 = $this->security->xss_clean($data_kampus);
                } else {
                    $data1 = $this->security->xss_clean($data);
                    $data2 = $this->security->xss_clean($data_kampus);
                }

                $insert = $this->master_data->update_mahasiswa($data1, $id);
                if ($insert) {
                    $update = $this->master_data->update_data_kampus($data2, $id);
                    echo $this->session->set_flashdata('msg', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Data  <b>' . $data['nama_lengkap'] . '</b> Successfully added to database.</div>');
                    redirect('superadmin/Master_data/data_mahasiswa');
                } else {
                    echo $this->session->set_flashdata('msg', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button></b> Failed added to database.</div>');
                    redirect('superadmin/Master_data/data_mahasiswa');
                }
            } else {
                echo $this->session->set_flashdata('msg', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>' . $this->upload->display_errors() . '.</div>');
                redirect('superadmin/Master_data/data_mahasiswa');
            }
        } else {
            $data = [
                'email' => str_replace("'", "", $this->security->xss_clean($this->input->post('email'))),
                'nama_lengkap' => str_replace("'", "", $this->security->xss_clean($this->input->post('nama_lengkap'))),
                'password' => $pw,
                'tempat' => str_replace("'", "", $this->security->xss_clean($this->input->post('tempat'))),
                'tgl_lahir' => str_replace("'", "", $this->security->xss_clean($this->input->post('tgl_lahir'))),
                'jenis_kelamin' => str_replace("'", "", $this->security->xss_clean($this->input->post('jenis_kelamin'))),
                'no_telp' => str_replace("'", "", $this->security->xss_clean($this->input->post('no_telp'))),
                'alamat' => str_replace("'", "", $this->security->xss_clean($this->input->post('alamat')))
            ];

            $data_kampus = [
                'nim' => $nim,
                'program_studi' => $this->input->post('prodi')
            ];

            if ($data['password'] == null) {
                $data = [

                    'email' => str_replace("'", "", $this->security->xss_clean($this->input->post('email'))),
                    'nama_lengkap' => str_replace("'", "", $this->security->xss_clean($this->input->post('nama_lengkap'))),
                    'tempat' => str_replace("'", "", $this->security->xss_clean($this->input->post('tempat'))),
                    'tgl_lahir' => str_replace("'", "", $this->security->xss_clean($this->input->post('tgl_lahir'))),
                    'jenis_kelamin' => str_replace("'", "", $this->security->xss_clean($this->input->post('jenis_kelamin'))),
                    'no_telp' => str_replace("'", "", $this->security->xss_clean($this->input->post('no_telp'))),
                    'alamat' => str_replace("'", "", $this->security->xss_clean($this->input->post('alamat'))),
                    'updated_at' => date('Y-m-d H:i:S')
                ];
                $data1 = $this->security->xss_clean($data);
                $data1 = $this->security->xss_clean($data_kampus);
            } else {
                $data1 = $this->security->xss_clean($data);
                $data2 = $this->security->xss_clean($data_kampus);
            }

            $update1 = $this->master_data->update_mahasiswa1($data1, $id);
            if ($update1) {
                $this->master_data->update_data_kampus1($data2, $id);
                echo $this->session->set_flashdata('msg', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Data <b>' . $data['nama_lengkap'] . '</b> Successfully added to database.</div>');
                redirect('superadmin/Master_data/data_mahasiswa');
            }
        }
    }

    public function cetak($id_jenis_p, $id_formulir)
    {
        if ($id_jenis_p == 1) {
            $this->cetak_surat_riset($id_jenis_p, $id_formulir);
        } elseif ($id_jenis_p == 2) {
            $this->cetak_surat_kp($id_jenis_p, $id_formulir);
        }
    }



    public function cetak_surat_kp($id_jenis_p, $id_formulir)
    {
        // $bukti_laporan = $this->bukti->get_bukti_by_laporan_id($laporan_id);
        $laporan = $this->master_data->get_surat_for_print_kp($id_formulir, $id_jenis_p);
        // print_r($laporan);
        // die();
        $tgl_lahir = date("d F Y", strtotime($laporan['tgl_lahir']));

        // $count = count($gambar);
        // $data = [];
        // $no = 0;


        error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
        $pdf = new FPDF('P', 'mm', 'Legal');
        $pdf->AddPage();

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(0, 10, '', 0, 1);
        $pdf->Cell(0, 5, '', 0, 1);
        $pdf->Image('./assets/data/img/kalbis_logo.png', 10, 10, 80);

        $pdf->Cell(10, 20, '', 0, 1);
        $pdf->SetFont('Arial', '', 10.5);
        $pdf->Cell(0, 1, 'No Surat              : ' . $laporan['no_surat'], 0, 1, $pdf->setX(25));
        $pdf->Cell(0, 10, 'Perihal                 : ' . 'Izin kerja praktik', 0, 1, $pdf->setX(25));
        $pdf->Cell(0, 1, 'Lampiran             : ' . '-', 0, 1, $pdf->setX(25));

        $pdf->Cell(10, 20, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10.5);
        $pdf->Cell(0, 1, 'Yth. Bapak/Ibu ' . $laporan['perwakilan_perusahaan'], 0, 1, $pdf->setX(25));
        $pdf->Cell(0, 10, '' . $laporan['jabatan'], 0, 1, $pdf->setX(25));
        $pdf->Cell(0, 1, '' . $laporan['nama_perusahaan'], 0, 1, $pdf->setX(25));

        $pdf->Cell(10, 5, '', 0, 1);
        $pdf->SetFont('Arial', '', 10.5);
        $pdf->Cell(0, 1, '' . $laporan['alamat_surat'], 0, 1, $pdf->setX(25));

        $pdf->Cell(0, 15, '', 0, 1);
        $pdf->SetFont('Arial', '', 10.5);
        $pdf->Cell(0, 1, 'Dengan hormat,', 0, 1, $pdf->setX(25));

        $pdf->Cell(0, 7.5, '', 0, 1);
        $pdf->SetFont('Arial', '', 10.5);
        $pdf->Cell(0, 1, 'Bersama ini kami menerangkan bahwa :', 0, 1, $pdf->setX(25));

        $pdf->Cell(0, 10, '', 0, 1);
        $pdf->SetFont('Arial', '', 10.5);
        $pdf->Cell(0, 1, 'Nama                                 : ' . $laporan['nama_mahasiswa'], 0, 1, $pdf->setX(40));
        $pdf->Cell(0, 10, 'Tempat/Tanggal Lahir        : ' . $laporan['tempat'] . '/' . $tgl_lahir, 0, 1, $pdf->setX(40));
        $pdf->Cell(0, 1, 'Nomor Induk Mahasiswa    : ' . $laporan['nim'], 0, 1, $pdf->setX(40));
        $pdf->Cell(0, 10, 'Program Studi                     : ' . $laporan['nama_prodi'], 0, 1, $pdf->setX(40));
        $pdf->Cell(0, 1, 'Telepon                               : ' . $laporan['no_telp_mhs'], 0, 1, $pdf->setX(40));

        $pdf->Cell(0, 10, '', 0, 1);
        $pdf->SetFont('Arial', '', 10.5);
        $pdf->MultiCell(0, 8, 'merupakan mahasiswa Institut Teknologi dan Bisnis Kalbis yang sedang melakukan kerja praktik. Sehubungan dengan hal itu mohon kiranya mahasiswa kami dapat diberikan kesempatan untuk magang di Instansi Bapak/Ibu.', 0, 1, $pdf->setX(25));

        // $pdf->Cell(0, 5, '', 0, 1);
        // $pdf->SetFont('Arial', '', 10.5);
        // $pdf->Cell(0, 10, '', 0, 1, $pdf->setX(25));
        // $pdf->Cell(0, 1, ' ', 0, 1, $pdf->setX(25));

        $pdf->Cell(0, 5, '', 0, 1);
        $pdf->SetFont('Arial', '', 10.5);
        $pdf->Cell(0, 10, 'Demikian surat ini kami sampaikan. Atas perhatian dan kerjasamanya kami ucapkan terima kasih.', 0, 1, $pdf->setX(25));

        $pdf->Cell(0, 10, '', 0, 1);
        $pdf->SetFont('Arial', '', 10.5);
        $pdf->Cell(0, 10, 'Hormat kami,', 0, 1, $pdf->setX(25));

        $pdf->Cell(0, 40, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10.5);
        $pdf->Cell(0, 1, 'Dr. Siti Nurjanah, SE., MM.,', 0, 1, $pdf->setX(25));

        $pdf->Cell(0, 1, '', 0, 1);
        $pdf->SetFont('Arial', '', 10.5);
        $pdf->Cell(0, 10, 'Wakil Rektor II', 0, 1, $pdf->setX(25));

        $pdf->Cell(0, 15, '', 0, 1);
        $pdf->SetFont('Arial', '', 10.5);
        $pdf->MultiCell(0, 5, 'Surat ini hanya untuk keperluan mandapatkan izin kerja praktik di perusahaan/PT/Dinas/Kementerian dan tidak berlaku untuk keperluan lain. Apabila Bapak/Ibu memerlukan validasi keaslian surat ini dari Institusi, Bapak/Ibu dapat mengirimkan email ke student.service@kalbis.ac.id', 0, 1,  $pdf->setX(25));

        $pdf->setY(-19);
        // $pdf->Cell(0, 10, '', 0, 1);
        // $pdf->SetFont('Arial', '', 10.5);
        $pdf->SetFont('Arial', 'B', 10);
        // $pdf->Cell(0, 10, '', 0, 1);
        $pdf->Image('./assets/data/img/kalbis_footer.png', 0, $pdf->GetY(), 220);



        $nama = $laporan['no_surat'] . '-' . $laporan['jenis_permohonan'] . '-' . $laporan['nama_mahasiswa'] . '.pdf';
        $pdf->Output('D', $nama);
    }
    public function cetak_surat_riset($id_jenis_p, $id_formulir)
    {
        // $bukti_laporan = $this->bukti->get_bukti_by_laporan_id($laporan_id);
        $laporan = $this->master_data->get_surat_for_print_riset($id_formulir, $id_jenis_p);
        // print_r($laporan);
        // die();
        $tgl_lahir = date("d F Y", strtotime($laporan['tgl_lahir']));

        // $count = count($gambar);
        // $data = [];
        // $no = 0;


        error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
        $pdf = new FPDF('P', 'mm', 'Legal');
        $pdf->AddPage();

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(0, 10, '', 0, 1);
        $pdf->Cell(0, 5, '', 0, 1);
        $pdf->Image('./assets/data/img/kalbis_logo.png', 10, 10, 80);

        $pdf->Cell(10, 20, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 1, 'Surat Pengantar Riset', 0, 1, 'C');

        $pdf->Cell(10, 5, '', 0, 1);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 1, $laporan['no_surat'], 0, 1, 'C');

        $pdf->Cell(10, 20, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 11.5);
        $pdf->Cell(0, 1, 'Yth. Bapak/Ibu ' . $laporan['perwakilan_perusahaan'], 0, 1, $pdf->setX(25));
        $pdf->Cell(0, 10, '' . $laporan['jabatan'], 0, 1, $pdf->setX(25));
        $pdf->Cell(0, 1, '' . $laporan['nama_perusahaan'], 0, 1, $pdf->setX(25));

        $pdf->Cell(10, 5, '', 0, 1);
        $pdf->SetFont('Arial', '', 11.5);
        $pdf->Cell(0, 1, '' . $laporan['alamat_surat'], 0, 1, $pdf->setX(25));

        $pdf->Cell(0, 15, '', 0, 1);
        $pdf->SetFont('Arial', '', 11.5);
        $pdf->Cell(0, 1, 'Dengan hormat,', 0, 1, $pdf->setX(25));

        $pdf->Cell(0, 10, '', 0, 1);
        $pdf->SetFont('Arial', '', 11.5);
        $pdf->Cell(0, 1, 'Bersama ini kami menerangkan bahwa :', 0, 1, $pdf->setX(25));

        $pdf->Cell(0, 10, '', 0, 1);
        $pdf->SetFont('Arial', '', 11.5);
        $pdf->Cell(0, 1, 'Nama                                 : ' . $laporan['nama_mahasiswa'], 0, 1, $pdf->setX(40));
        $pdf->Cell(0, 10, 'Tempat/Tanggal Lahir        : ' . $laporan['tempat'] . '/' . $tgl_lahir, 0, 1, $pdf->setX(40));
        $pdf->Cell(0, 1, 'Nomor Induk Mahasiswa    : ' . $laporan['nim'], 0, 1, $pdf->setX(40));
        $pdf->Cell(0, 10, 'Program Studi                     : ' . $laporan['nama_prodi'], 0, 1, $pdf->setX(40));
        $pdf->Cell(0, 1, 'Telepon                               : ' . $laporan['no_telp_mhs'], 0, 1, $pdf->setX(40));

        if ($laporan['jenis_tugas'] == "tugas akhir") {
            $pdf->Cell(0, 10, '', 0, 1);
            $pdf->SetFont('Arial', '', 11.5);
            $pdf->MultiCell(0, 5, 'merupakan mahasiswa Institut Teknologi dan Bisnis Kalbis yang sedang mengerjakan tugas untuk mata kuliah Skripsi.', 0, 1, $pdf->setX(25), 'J');

            $pdf->Cell(0, 5, '', 0, 1);
            $pdf->SetFont('Arial', '', 11.5);
            $pdf->MultiCell(0, 5, 'Sehubungan dengan hal itu mohon kiranya mahasiswa kami dapat diizinkan untuk melakukan riset dengan judul: "' . $laporan['judul'] . '".', 0, 1, $pdf->setX(25), 'J');
        } elseif ($laporan['jenis_tugas'] == "tugas kuliah") {
            $pdf->Cell(0, 10, '', 0, 1);
            $pdf->SetFont('Arial', '', 11.5);
            $pdf->MultiCell(0, 5, 'merupakan mahasiswa Institut Teknologi dan Bisnis Kalbis yang sedang mengerjakan tugas kuliah.', 0, 1, $pdf->setX(25), 'J');

            $pdf->Cell(0, 5, '', 0, 1);
            $pdf->SetFont('Arial', '', 11.5);
            $pdf->MultiCell(0, 5, 'Sehubungan dengan hal itu mohon kiranya mahasiswa kami dapat diizinkan untuk melakukan tugas kuliah dengan judul: "' . $laporan['judul'] . '".', 0, 1, $pdf->setX(25), 'J');
        }

        $pdf->Cell(0, 5, '', 0, 1);
        $pdf->SetFont('Arial', '', 11.5);
        $pdf->MultiCell(0, 5, 'Demikian surat keterangan ini dibuat dengan sesungguhnya untuk dapat dipergunakan sebagaimana mestinya.', 0, 1, $pdf->setX(25), 'J');

        $pdf->Cell(0, 10, '', 0, 1);
        $pdf->SetFont('Arial', '', 11.5);
        $pdf->Cell(0, 10, 'Jakarta, ' . date('d F Y'), 0, 1, $pdf->setX(-60));

        $pdf->Cell(0, 25, '', 0, 1);
        $pdf->SetFont('Arial', '', 11.5);
        $pdf->Cell(0, 10, $this->session->userdata('nama'), 0, 1, $pdf->setX(-30));
        $pdf->Cell(0, 1, 'Head of Academic Operation', 0, 1, $pdf->setX(-71));


        $pdf->setY(-19);
        // $pdf->Cell(0, 10, '', 0, 1);
        // $pdf->SetFont('Arial', '', 10.5);
        $pdf->SetFont('Arial', 'B', 10);
        // $pdf->Cell(0, 10, '', 0, 1);
        $pdf->Image('./assets/data/img/kalbis_footer.png', 0, $pdf->GetY(), 220);

        $nama = $laporan['no_surat'] . '-' . $laporan['jenis_permohonan'] . '-' . $laporan['nama_mahasiswa'] . '.pdf';
        $pdf->Output('D', $nama);
    }
}
