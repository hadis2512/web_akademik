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
        $this->load->library(array('upload', 'Pdf'));
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

    public function get_data_form($id_pengguna)
    {
        $get_form = $this->master_data->get_form_by_id($id_pengguna);
        echo json_encode($get_form);
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
        // die();
        $data['form'] = $this->master_data->get_form($id_pengguna);
        // $data['form'] = $this->master_data->get_form_by_id($id_pengguna);
        // print_r($data['kp']);
        // print_r($data['riset']);
        // print_r($data['form']);
        // die();
        $this->load->view('user/form/V_pengajuan_form', $data);
    }

    public function get_data_surat($id_pengguna)
    {
        $get_surat = $this->master_data->get_data_surat_mahasiswa($id_pengguna);
        echo json_encode($get_surat);
    }


    public function data_surat()
    {
        $data['id_pengguna'] = $this->session->userdata('idadmin');
        $id_pengguna = $data['id_pengguna'];
        $data['form'] = $this->master_data->get_surat_by_id_pengguna($id_pengguna);
        $id_pengguna = $data['id_pengguna'];
        $data['pageTitle'] = "Data Surat";
        $data['User'] = $this;
        // print_r($data['kp']);
        // print_r($data['riset']);
        // print_r($data['form']);
        // die();
        $this->load->view('user/form/V_data_surat', $data);
    }

    public function approve($id_formulir)
    {
        $data = [
            'approval' => 1,
            'id_formulir' => $id_formulir
        ];
        $approve = $this->master_data->approve_dosen($data);
        echo json_encode($approve);
    }
    public function reject($id_formulir)
    {
        $data = [
            'approval' => 2,
            'id_formulir' => $id_formulir
        ];
        $approve = $this->master_data->reject_dosen($data);
        echo json_encode($approve);
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
        // print_r($data['form']);
        // die();
        $data['jenis_p'] = $this->master_data->get_jenis_permohonan();
        if (count($data['form']) > 0) {
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
            // die();
        } elseif ($jenis_permohonan == 2) {
            $detail_form = $this->master_data->get_detail_surat_kp($id_formulir, $jenis_permohonan);
            echo json_encode($detail_form);
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
        $pdf->Cell(0, 10, $laporan['nama'], 0, 1, $pdf->setX(-30));
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
        $id_pengguna = $this->session->userdata('idadmin');
        $data['pageTitle'] = "Home Mahasiswa";
        $data['User'] = $this;
        $data['form'] = $this->master_data->get_form($id_pengguna);
        if (count($data['form']) > 0) {
            $data['view_more'] = '<div class="my-4 d-flex flex-row-reverse">
            <a href="' . base_url('Pengajuan-Form') . '" class="btn btn-inverse-info btn-sm "><i class="icon-grid mr-3"></i>View More</a>
        </div>';
        } else {
            $data['view_more'] = '<div class="row flex-grow">
            <div class="col-lg-7  mx-auto text-secondary">
                <div class="row align-items-center d-flex flex-row">
                    <div class="col-lg-12 error-page-divider text-lg-center pl-lg-4">                        
                        <h3 class="font-weight-light mt-5">Saat ini belum ada data.</h3>
                    </div>
                </div>
                
                <div class="d-flex justify-content-center">
                    <div class="my-5 ">
                    <a href="' . base_url('Pengajuan-Form') . '" class="btn btn-primary"><i class="ti-plus mr-2"></i>Buat Pengajuan</a>       
                    </div>
                </div>
            </div>
        </div>';
        }
        $this->load->view('user/home/V_Mahasiswa_home', $data);
    }

    function get_prodi($id)
    {
        $data = $this->master_data->get_prodi_id($id);
        $result = array();
        foreach ($data as $a) {
            $select =  '<option value="' . $a['id'] . '">' . $a['program_studi'] . '</option>';
            array_push($result, $select);
        }
        echo json_encode($result);
    }

    public function edit_profile_m($id)
    {
        $profil = $this->master_data->get_my_profile($id);
        $oldpass = $profil[0]['password'];
        // print_r($oldpass[0]['password']);
        // die();
        $nim = str_replace("'", "", $this->security->xss_clean($this->input->post('nim')));
        $nmfile = $nim . "_" . date("H-i-s"); //nama file saya beri nama langsung dan diikuti fungsi time
        $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'] . '/web_akademik/assets/data/mahasiswa/foto_profilM/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '2048000000'; //maksimum besar file 2M
        $config['max_width']  = '0'; //lebar maksimum 1288 px
        $config['max_height']  = '0'; //tinggi maksimu 1000 px
        $config['file_name'] = $nmfile; //nama yang terupload nantinya
        $pw_lama = $this->input->post('oldpass');
        $pw_baru = $this->input->post('password');
        if ($pw_lama != null && $pw_baru != null) {
            $pw = md5(str_replace("'", "", $this->security->xss_clean($pw_lama)));
            $pw1 = md5(str_replace("'", "", $this->security->xss_clean($pw_baru)));
        } else {
            $pw = (str_replace("'", "", $this->security->xss_clean($pw_lama)));
            $pw1 = (str_replace("'", "", $this->security->xss_clean($pw_baru)));
        }

        $this->upload->initialize($config);
        $this->load->library('upload', $config);
        if (!empty($_FILES['foto']['name'])) {
            if ($this->upload->do_upload('foto')) {

                $pic = $this->upload->data();
                $foto = "/assets/data/mahasiswa/foto_profilM/" . $pic['file_name'];
                if ($oldpass == $pw) {
                    $data = [

                        'nama_lengkap' => str_replace("'", "", $this->security->xss_clean($this->input->post('nama_lengkap'))),
                        'password' => $pw1,
                        'tempat' => str_replace("'", "", $this->security->xss_clean($this->input->post('tempat'))),
                        'tgl_lahir' => str_replace("'", "", $this->security->xss_clean($this->input->post('tgl_lahir'))),
                        'jenis_kelamin' => str_replace("'", "", $this->security->xss_clean($this->input->post('jenis_kelamin'))),
                        'no_telp' => str_replace("'", "", $this->security->xss_clean($this->input->post('no_telp'))),
                        'alamat' => str_replace("'", "", $this->security->xss_clean($this->input->post('alamat'))),
                        'foto' => $foto,
                        'updated_at' => date('Y-m-d H:i:s')
                    ];

                    $data_kampus = [
                        'nim' => $nim,
                        'program_studi' => $this->input->post('prodi')
                    ];


                    $data1 = $this->security->xss_clean($data);
                    $data2 = $this->security->xss_clean($data_kampus);


                    $insert = $this->master_data->update_mahasiswa($data1, $id);
                    if ($insert) {
                        $update = $this->master_data->update_data_kampus($data2, $id);
                        $poto_propil = $this->master_data->get_foto($id);
                        $this->session->set_userdata('foto', $poto_propil['foto']);
                        // $this->session->set_userdata('email', $poto_propil['email']);
                        echo $this->session->set_flashdata('msg', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Data  <b>' . $data['nama_lengkap'] . '</b> Successfully added to database.</div>');
                        redirect('user/User/profileM/' . $id);
                    } else {
                        echo $this->session->set_flashdata('msg', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button></b> Failed added to database.</div>');
                        redirect('user/User/profileM/' . $id);
                    }
                } elseif ($pw == null && $pw1 == null) {
                    $data = [

                        'nama_lengkap' => str_replace("'", "", $this->security->xss_clean($this->input->post('nama_lengkap'))),
                        'tempat' => str_replace("'", "", $this->security->xss_clean($this->input->post('tempat'))),
                        'tgl_lahir' => str_replace("'", "", $this->security->xss_clean($this->input->post('tgl_lahir'))),
                        'jenis_kelamin' => str_replace("'", "", $this->security->xss_clean($this->input->post('jenis_kelamin'))),
                        'no_telp' => str_replace("'", "", $this->security->xss_clean($this->input->post('no_telp'))),
                        'alamat' => str_replace("'", "", $this->security->xss_clean($this->input->post('alamat'))),
                        'foto' => $foto,
                        'updated_at' => date('Y-m-d H:i:s')
                    ];

                    $data_kampus = [
                        'nim' => $nim,
                        'program_studi' => $this->input->post('prodi')
                    ];


                    $data1 = $this->security->xss_clean($data);
                    $data2 = $this->security->xss_clean($data_kampus);


                    $insert = $this->master_data->update_mahasiswa($data1, $id);
                    if ($insert) {
                        $update = $this->master_data->update_data_kampus($data2, $id);
                        $poto_propil = $this->master_data->get_foto($id);
                        $this->session->set_userdata('foto', $poto_propil['foto']);
                        // $this->session->set_userdata('email', $poto_propil['email']);
                        echo $this->session->set_flashdata('msg', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Data  <b>' . $data['nama_lengkap'] . '</b> Successfully added to database.</div>');
                        redirect('user/User/profileM/' . $id);
                    } else {
                        echo $this->session->set_flashdata('msg', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button></b> Failed added to database.</div>');
                        redirect('user/User/profileM/' . $id);
                    }
                } elseif ($pw != $oldpass) {
                    echo $this->session->set_flashdata('msg', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Password Lama Salah .</div>');
                    redirect('user/User/profileM/' . $id);
                }
            } else {
                echo $this->session->set_flashdata('msg', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>' . $this->upload->display_errors() . '.</div>');
                redirect('user/User/profileM/' . $id);
            }
        } elseif (empty($_FILES['foto']['name'])) {
            if ($oldpass == $pw) {
                $data = [

                    'nama_lengkap' => str_replace("'", "", $this->security->xss_clean($this->input->post('nama_lengkap'))),
                    'password' => $pw1,
                    'tempat' => str_replace("'", "", $this->security->xss_clean($this->input->post('tempat'))),
                    'tgl_lahir' => str_replace("'", "", $this->security->xss_clean($this->input->post('tgl_lahir'))),
                    'jenis_kelamin' => str_replace("'", "", $this->security->xss_clean($this->input->post('jenis_kelamin'))),
                    'no_telp' => str_replace("'", "", $this->security->xss_clean($this->input->post('no_telp'))),
                    'alamat' => str_replace("'", "", $this->security->xss_clean($this->input->post('alamat'))),
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                $data_kampus = [
                    'nim' => $nim,
                    'program_studi' => $this->input->post('prodi')
                ];

                $data1 = $this->security->xss_clean($data);
                $data2 = $this->security->xss_clean($data_kampus);


                $insert = $this->master_data->update_mahasiswa($data1, $id);
                if ($insert) {
                    $update = $this->master_data->update_data_kampus($data2, $id);
                    $poto_propil = $this->master_data->get_my_profile($id);
                    // $this->session->set_userdata('foto', $poto_propil['foto']);                    
                    $this->session->set_userdata('nama', $poto_propil['nama_lengkap']);
                    echo $this->session->set_flashdata('msg', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Data  <b>' . $data['nama_lengkap'] . '</b> Successfully added to database.</div>');
                    redirect('user/User/profileM/' . $id);
                } else {
                    echo $this->session->set_flashdata('msg', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button></b> Failed added to database.</div>');
                    redirect('user/User/profileM/' . $id);
                }
            } elseif ($oldpass == null && $pw == null) {
                $data = [

                    'nama_lengkap' => str_replace("'", "", $this->security->xss_clean($this->input->post('nama_lengkap'))),
                    'tempat' => str_replace("'", "", $this->security->xss_clean($this->input->post('tempat'))),
                    'tgl_lahir' => str_replace("'", "", $this->security->xss_clean($this->input->post('tgl_lahir'))),
                    'jenis_kelamin' => str_replace("'", "", $this->security->xss_clean($this->input->post('jenis_kelamin'))),
                    'no_telp' => str_replace("'", "", $this->security->xss_clean($this->input->post('no_telp'))),
                    'alamat' => str_replace("'", "", $this->security->xss_clean($this->input->post('alamat'))),
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                $data_kampus = [
                    'nim' => $nim,
                    'program_studi' => $this->input->post('prodi')
                ];

                $data1 = $this->security->xss_clean($data);
                $data2 = $this->security->xss_clean($data_kampus);


                $insert = $this->master_data->update_mahasiswa($data1, $id);
                if ($insert) {
                    $update = $this->master_data->update_data_kampus($data2, $id);
                    $poto_propil = $this->master_data->get_my_profile($id);
                    // $this->session->set_userdata('foto', $poto_propil['foto']);                    
                    $this->session->set_userdata('nama', $poto_propil['nama_lengkap']);
                    echo $this->session->set_flashdata('msg', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Data  <b>' . $data['nama_lengkap'] . '</b> Successfully added to database.</div>');
                    redirect('user/User/profileM/' . $id);
                } else {
                    echo $this->session->set_flashdata('msg', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button></b> Failed added to database.</div>');
                    redirect('user/User/profileM/' . $id);
                }
            } elseif ($oldpass != $pw) {
                echo $this->session->set_flashdata('msg', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button></b> Password Lama Salah!.</div>');
                redirect('user/User/profileM/' . $id);
            }
        }
    }


    public function profileM($id)
    {
        $data['pageTitle'] = "My Profile";
        $data['profile'] = $this->master_data->get_my_profile($id);
        // print_r($data['profile']);
        // die();
        $data['program'] = $this->master_data->get_all_program();


        $propil = $data['profile'];
        $program = $data['program'];
        $prodi = $this->master_data->get_prodi_id1($propil[0]['id_prodi']);
        $data['prodi1'] = $this->master_data->get_prodi_id($propil[0]['id_program']);
        // print_r($propil);
        // die();

        if ($propil[0]['jenis_kelamin'] == "Pria") {
            $data['jenis_kelamin'] = "<option selected>Pria</option>
            <option>Wanita</option>";
        } elseif ($propil[0]['jenis_kelamin'] == "Wanita") {
            $data['jenis_kelamin'] = "<option>Pria</option>            
            <option selected>Wanita</option>";
        }

        $foto = $propil[0]['foto'];
        if ($foto == null) {
            $data['foto'] = '<img class=" pp_v" style="position: relative; width:150px;height:150px;border-radius:50%;" id="pp" src="' . base_url('assets/user/images/user.jpg') . '" alt="asd"/>';
        } elseif ($foto != null) {
            $data['foto'] = '<img class="pp_v" style="position: relative; width:150px;height:150px;border-radius:50%;" id="pp" src="' . base_url($foto) . '" alt="profile" />';
        }

        $data['form'] = $this->master_data->get_form($id);
        $this->load->view('user/home/V_profileM', $data);
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
            'created_at' => date('Y-m-d H:i:s')
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
                    'alamat_surat' => str_replace("'", "", $this->security->xss_clean($this->input->post('alamat_perusahaan'))),
                    'nama_perusahaan' => str_replace("'", "", $this->security->xss_clean($this->input->post('nama_perusahaan'))),
                    'perwakilan_perusahaan' => str_replace("'", "", $this->security->xss_clean($this->input->post('perwakilan'))),
                    'jabatan' => str_replace("'", "", $this->security->xss_clean($this->input->post('jabatan_perwakilan'))),
                    'telp_perusahaan' => str_replace("'", "", $this->security->xss_clean($this->input->post('no_telp_perusahaan'))),
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
