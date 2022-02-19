<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_data extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // if ($this->session->userdata('masuk') != true) {
        //     $this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible" role="alert">
        //                                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //                                                 <span aria-hidden="true">&times;</span>
        //                                             </button>
        //                                             <i class="fa fa-exclamation-triangle mr-2"></i> Please Login First!
        //                                             </div>');
        //     redirect('superadmin/Login');
        // }
        $this->load->helper('security');
        $this->load->model('M_superadmin', 'superadmin');
        $this->load->model('M_master_data', 'master_data');
        $this->load->library('upload');
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
        $data['jabatan'] = $this->master_data->get_all_jbtn();
        $this->load->view('superadmin/home/V_add_karyawan', $data);
    }
    public function data_karyawan()
    {
        $data['pageTitle'] = "Data Karyawan";
        $data['data_karyawan'] = $this->master_data->get_all_karyawan();
        // print_r($data);
        // die();
        $data['jabatan'] = $this->master_data->get_all_jbtn();
        $this->load->view('superadmin/home/V_data_karyawan', $data);
    }

    public function delete_mahasiswa($id)
    {
        $this->master_data->delete_mahasiswa($id);
        // $url = $this->data_mahasiswa();
        echo $this->session->set_flashdata('msg', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Data berhasil di hapus !</div>');
        redirect('superadmin/Master_data/data_mahasiswa');
    }
    public function delete_karyawan($id)
    {
        $this->master_data->delete_karyawan($id);
        // $url = $this->data_mahasiswa();
        echo $this->session->set_flashdata('msg', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Data berhasil di hapus !</div>');
        redirect('superadmin/Master_data/data_karyawan');
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
                    'id_jabatan' => str_replace("'", "", $this->security->xss_clean($this->input->post('jabatan'))),
                    'is_active' => 1,
                    'created_at' => date('Y-m-d H:i:S'),
                    'updated_at' => date('Y-m-d H:i:S')
                ];
                $data1 = $this->security->xss_clean($data);

                $insert = $this->master_data->save_karyawan($data1);
                if ($insert) {
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

            $this->master_data->save_karyawan1($data);
            echo $this->session->set_flashdata('msg', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Data <b>' . $data['nama_lengkap'] . '</b> Successfully added to database.</div>');
            redirect('superadmin/Master_data/add_karyawan');
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
                    'id_jabatan' => str_replace("'", "", $this->security->xss_clean($this->input->post('jabatan'))),
                    'is_active' => 1,
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
                    'id_jabatan' => 2,
                    'is_active' => 1,
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
                'id_jabatan' => 2,
                'is_active' => 1,
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
                    'nim' => $nim,
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

                if ($data['password'] == null) {
                    $data = [
                        'nim' => $nim,
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
                } else {
                    $data1 = $this->security->xss_clean($data);
                }

                $insert = $this->master_data->update_mahasiswa($data1, $id);
                if ($insert) {
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
                'nim' => $nim,
                'email' => str_replace("'", "", $this->security->xss_clean($this->input->post('email'))),
                'nama_lengkap' => str_replace("'", "", $this->security->xss_clean($this->input->post('nama_lengkap'))),
                'password' => $pw,
                'tempat' => str_replace("'", "", $this->security->xss_clean($this->input->post('tempat'))),
                'tgl_lahir' => str_replace("'", "", $this->security->xss_clean($this->input->post('tgl_lahir'))),
                'jenis_kelamin' => str_replace("'", "", $this->security->xss_clean($this->input->post('jenis_kelamin'))),
                'no_telp' => str_replace("'", "", $this->security->xss_clean($this->input->post('no_telp'))),
                'alamat' => str_replace("'", "", $this->security->xss_clean($this->input->post('alamat')))
            ];
            if ($data['password'] == null) {
                $data = [
                    'nim' => $nim,
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
            } else {
                $data1 = $this->security->xss_clean($data);
            }

            $this->master_data->update_mahasiswa1($data1, $id);
            echo $this->session->set_flashdata('msg', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Data <b>' . $data['nama_lengkap'] . '</b> Successfully added to database.</div>');
            redirect('superadmin/Master_data/data_mahasiswa');
        }
    }
}
