<?php
defined('BASEPATH') or exit('No direct script access allowed');

require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use League\OAuth2\Client\Provider\Google;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use PHPMailer\PHPMailer\OAuth;

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
        $this->load->helper("download");
        $this->load->model('M_superadmin', 'superadmin');
        $this->load->model('M_master_data', 'master_data');
        $this->load->library(array('upload', 'Pdf'));
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
        $this->load->view('superadmin/home/V_add_data_ttd', $data);
    }

    public function data_ttd()
    {
        $data['pageTitle'] = "Data Tanda Tangan";
        $data['data_ttd'] = $this->master_data->get_all_data_ttd();
        $this->load->view('superadmin/home/V_data_ttd', $data);
    }

    public function data_surat()
    {
        $data['pageTitle'] = "Data Surat";
        $data['data_surat'] = $this->master_data->get_all_form_admin_by_surat();
        $this->load->view('superadmin/home/V_data_surat', $data);
    }

    public function data_formulir()
    {
        $data['pageTitle'] = "Data Formulir";
        $data['jenis_p'] = $this->master_data->get_jenis_permohonan();
        $data['data_formulir'] = $this->master_data->get_all_form_by_admin();
        $this->load->view('superadmin/home/V_data_formulir', $data);
    }

    public function data_karyawan()
    {
        $data['pageTitle'] = "Data Karyawan";
        $data['data_karyawan'] = $this->master_data->get_all_karyawan();
        $data['jabatan'] = $this->master_data->get_all_jbtn();
        $this->load->view('superadmin/home/V_data_karyawan', $data);
    }
    public function get_formulir_riset($id_jenis_p, $id_formulir)
    {
        $data['surat_riset'] = $this->master_data->get_formulir_riset($id_jenis_p, $id_formulir);
        $surat_riset = $data['surat_riset'];
        // print_r($surat_riset);
        // die();
        $data['pageTitle'] = "Detail Formulir " . $surat_riset['no_form'];
        $data['id_jenis_p'] = $id_jenis_p;
        $this->load->view('superadmin/home/V_detail_formulir_riset', $data);
    }
    public function get_formulir_kp($id_jenis_p, $id_formulir)
    {
        $data['pageTitle'] = "Detail Formulir KP";
        $data['surat_kp'] = $this->master_data->get_detail_surat_kp($id_formulir, $id_jenis_p);
        $data['id_jenis_p'] = $id_jenis_p;
        $this->load->view('superadmin/home/V_detail_formulir_kp', $data);
    }
    public function get_surat_riset($id_jenis_p, $id_formulir)
    {
        $data['surat_riset'] = $this->master_data->get_formulir_riset($id_jenis_p, $id_formulir);
        $surat_riset = $data['surat_riset'];
        $data['pageTitle'] = "Detail Surat Riset " . $surat_riset['no_form'];
        $data['id_jenis_p'] = $id_jenis_p;
        $this->load->view('superadmin/home/V_detail_surat_riset', $data);
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

    function test_mailer()
    {
        $mail = new PHPMailer(true);

        try {
            //Server settings            
            $mail->isSMTP();                                            //Send using SMTP            
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->Host     = 'smtp.gmail.com';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->SMTPAuth = true;
            $mail->AuthType = 'XOAUTH2';
            // $mail->Username = 'academicoperationskalbis@gmail.com';
            // $mail->Password = 'Hadits123';
            $mail->SMTPSecure = 'tls';
            $mail->Port     = 587;
            $email = 'academicoperationskalbis@gmail.com';
            $clientId = '426965174563-q7ps5r823aau8dnq6cltlko0h96dju1m.apps.googleusercontent.com';
            $clientSecret = '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';

            //Obtained by configuring and running get_oauth_token.php
            //after setting up an app in Google Developer Console.
            $refreshToken = '1//0gf676lZoNfJCCgYIARAAGBASNwF-L9Irao8AUfBU_Jx43kQ53eoYGvF8cOEARtxISZDgXPJasvUHy_eTQKe-syOOuORCu0RpskE';
            $provider = new Google(
                [
                    'clientId' => $clientId,
                    'clientSecret' => $clientSecret,
                ]
            );
            $mail->setOAuth(new OAuth([
                'provider' => $provider,
                'clientId' => $clientId,
                'clientSecret' => $clientSecret,
                'refreshToken' => $refreshToken,
                'userName' => $email,
            ]));

            //Recipients
            $mail->setFrom('academicoperationsKkalbis@gmail.com', 'Academic Operation Kalbis Institute');
            $mail->addAddress('2018104030@student.kalbis.ac.id');               //Name is optional
            // $mail->addAttachment($_SERVER['DOCUMENT_ROOT'] . '/web_akademik' . $path);

            // $mail->addAttachment($path_surat);         //Add attachments
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'halo';
            $mail->Body    = '<div class="container" style="width: 600px; height: 100%;">
                                                 <div class="card" style="border:1px solid;width: 100%; height: 100%;">
                                                     <div class="card-header " style="width: 100%; height: 100px; display: flex; justify-content: center; align-items: center; text-align: center; background: #007bff;">
                                                         <h3 style="font-size: 18px; text-align: center; padding: 0 175px; " ></h3>
                                                     </div>
                                                     <div class="card-body" style=" padding: 50px;">
                                                         <h2 class="card-text">Hello,</h2>
                                                         <h4 class="card-text">Surat untuk formulir pengajuan  dengan nomor formulir <br> telah dibuat.</h4>
                                                         <h5 class="card-text">Untuk melihat lebih detail silahkan kunjungi link berikut: <a href="http://localhost/web_akademik/Pengajuan-Form/" class="btn btn-link">Detail Formulir</a></h5>
                                                     </div>
                                                 
                                                <div class="row">
                                                <div class="col-12">										
                                                    <p class="card-text">Jalan Pulomas Selatan Kav. 22 Jakarta Timur, Indonesia - 13210</p>										
                                                    <p class="card-text">Telp     : 021 - 47883900 ext. 1119 - 1121</p>										
                                                    <p class="card-text">Email  : academicoperationskalbis@gmail.com</p>										
                                                </div>                                                
                                            </div>
                                            </div>
                                             </div>';
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $mail->send();
            echo "success sent";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public function create_surat($id_formulir, $id_jenis_p, $gmail)
    {
        ob_start();
        if ($id_jenis_p == 1) {
            $get_surat = $this->master_data->get_surat_riset($id_jenis_p);
            $tot_surat = count($get_surat);
            $year = date("Y");
            $laporan = $this->master_data->get_surat_for_print_riset($id_formulir, $id_jenis_p);
            // print_r($laporan['no_surat']);
            // die();
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
                'id_admin' => 1,
                'created_at' => date("Y-m-d")
            ];
            $insert_surat_riset = $this->master_data->insert_surat_riset($data);
            $this->master_data->admin_buat_surat($id_formulir);
            if ($insert_surat_riset) {
                $ttd = $this->master_data->get_ttd();
                $tgl_lahir = date("d F Y", strtotime($laporan['tgl_lahir']));
                $tanda_tangan = base_url() . $ttd['tanda_tangan'];

                error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
                $pdf = new FPDF('P', 'mm', 'a4');
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
                $pdf->MultiCell(0, 1, '' . $laporan['alamat_surat'], 0, 1, $pdf->setX(25));

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
                $pdf->Cell(0, 10, 'Jakarta, ' . date('d F Y', strtotime($laporan['updated_at'])), 0, 1, $pdf->setX(-60));

                $pdf->Cell(0, 5, '', 0, 1);
                $pdf->SetFont('Arial', '', 11.5);
                $pdf->Image($tanda_tangan,  160, $pdf->getY(), 40);
                // $pdf->Image('./assets/data/img/kalbis_logo.png', 10, 10, 80);

                $pdf->Cell(0, 25, '', 0, 1);
                $pdf->SetFont('Arial', '', 11.5);
                $pdf->Cell(0, 10, 'Siti Komariah SM.MM.', 0, 1, $pdf->setX(-60));
                $pdf->Cell(0, 1, 'Head of Academic Operation', 0, 1, $pdf->setX(-71));


                $pdf->setY(-19);
                // $pdf->Cell(0, 10, '', 0, 1);
                // $pdf->SetFont('Arial', '', 10.5);
                $pdf->SetFont('Arial', 'B', 10);
                // $pdf->Cell(0, 10, '', 0, 1);
                $pdf->Image('./assets/data/img/kalbis_footer.png', 0, $pdf->GetY(), 210);
                // $a = preg_replace($laporan['no_surat'], "-", $laporan['no_surat']);
                $b = explode('/', $laporan['no_surat']);
                $a = implode("-", $b);
                $nama = $a  . '_surat_pengantar_riset_' . $laporan['nama_mahasiswa'] . '.pdf';
                $path = "/assets/data/" . $nama;
                // echo $path;
                // die();
                $save_to_local = $pdf->Output(__DIR__ . "/../../../assets/data/" . $nama, "F");
                $update_path = $this->master_data->update_file_pdf($path, $nama, $insert_surat_riset);
                if ($update_path) {
                    $mhs = $this->master_data->get_mhs_by_email($gmail);
                    $user = $this->master_data->get_form_by_id_formulir($id_formulir);
                    $jenis = "Surat Pengantar Riset";
                    $link = 'superadmin/master_data/get_formulir_riset/1/' . $user['id_formulir'];
                    $mail = new PHPMailer(true);

                    try {
                        //Server settings            
                        $mail->isSMTP();                                            //Send using SMTP            
                        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                        $mail->Host     = 'smtp.gmail.com';
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->SMTPAuth = true;
                        $mail->AuthType = 'XOAUTH2';
                        $mail->SMTPSecure = 'tls';
                        $mail->Port     = 587;
                        $email = 'academicoperationskalbis@gmail.com';
                        $clientId = '426965174563-q7ps5r823aau8dnq6cltlko0h96dju1m.apps.googleusercontent.com';
                        $clientSecret = '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';

                        //Obtained by configuring and running get_oauth_token.php
                        //after setting up an app in Google Developer Console.
                        $refreshToken = '1//0gf676lZoNfJCCgYIARAAGBASNwF-L9Irao8AUfBU_Jx43kQ53eoYGvF8cOEARtxISZDgXPJasvUHy_eTQKe-syOOuORCu0RpskE';
                        $provider = new Google(
                            [
                                'clientId' => $clientId,
                                'clientSecret' => $clientSecret,
                            ]
                        );
                        $mail->setOAuth(new OAuth([
                            'provider' => $provider,
                            'clientId' => $clientId,
                            'clientSecret' => $clientSecret,
                            'refreshToken' => $refreshToken,
                            'userName' => $email,
                        ]));

                        //Recipients
                        $mail->setFrom('academicoperationsKkalbis@gmail.com', 'Academic Operation Kalbis Institute');
                        $mail->addAddress($gmail);               //Name is optional
                        // $mail->addAttachment($_SERVER['DOCUMENT_ROOT'] . '/web_akademik' . $path);
                        $path_surat = $_SERVER['DOCUMENT_ROOT'] . '/web_akademik' . $path;
                        $mail->addAttachment($path_surat);         //Add attachments
                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = 'Formulir Pengajuan ' . $jenis . '(' . $user['no_form'] . ')';
                        $mail->Body    = '<div class="container" style="width: 600px; height: 100%;">
                                                 <div class="card" style="width: 100%; height: 100%;">
                                                     <div class="card-header " style="background-color:#6777ef;color:#fff;width: 100%; height: 100px; display: flex; justify-content: center; align-items: center; text-align: center; background: #007bff;">
                                                         <h3 style="font-size: 18px; text-align: center; padding: 0 175px; " >' . $jenis . '(' . $user['no_form'] . ')</h3>
                                                     </div>
                                                     <div class="card-body" style="background-color: rgb(240, 240, 240); padding: 50px;">
                                                         <h2 class="card-text">Hello, ' . $mhs['nama_lengkap'] . '</h2>
                                                         <h4 class="card-text">Surat untuk formulir pengajuan ' . $jenis . ' dengan nomor formulir <br> ' . $user['no_form'] . ' telah dibuat.</h4>
                                                         <h5 class="card-text">Untuk melihat lebih detail silahkan kunjungi link berikut: <a href="http://localhost/web_akademik/Pengajuan-Form/" class="btn btn-link">Detail Formulir</a></h5>
                                                     </div>
                                                 </div>
                                                 <div class="row">
                                                <div class="col-12">										
                                                    <p class="card-text">Jalan Pulomas Selatan Kav. 22 Jakarta Timur, Indonesia - 13210</p>										
                                                    <p class="card-text">Telp     : 021 - 47883900 ext. 1119 - 1121</p>										
                                                    <p class="card-text">Email  : academicoperationskalbis@gmail.com</p>										
                                                </div>
                                            </div>
                                             </div>';
                        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                        $mail->send();
                        echo $this->session->set_flashdata('msg', '<div id="lookatme"  class="alert alert-success animated fadeIn" role="alert"><i class="fa fa-times mr-2"></i>Data Surat Berhasil Di Buat!</div>');
                        redirect('superadmin/master_data/get_formulir_riset/1/' . $user['id_formulir']);
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                }
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
            $user = $this->master_data->get_form_by_id_formulir($id_formulir);
            print_r($user);
            $total_surat = $tot_surat + 1;
            $data = [
                'no_surat' => $jumlah_surat . $total_surat . '/AO-SRT/VI/' . $year,
                'id_formulir' => $id_formulir,
                'id_admin' => 1,
                'created_at' => date("Y-m-d")
            ];
            $insert_surat_kp = $this->master_data->insert_surat_kp($data);


            $this->master_data->admin_buat_surat($id_formulir);
            if ($insert_surat_kp) {
                // $bukti_laporan = $this->bukti->get_bukti_by_laporan_id($laporan_id);
                $laporan = $this->master_data->get_surat_for_print_kp($id_formulir, $id_jenis_p);
                $ttd = $this->master_data->get_ttd();
                $tanda_tangan = base_url() . $ttd['tanda_tangan'];
                // print_r($tanda_tangan);
                // die();
                // print_r($laporan);
                // die();
                $tgl_lahir = date("d F Y", strtotime($laporan['tgl_lahir']));

                // $count = count($gambar);
                // $data = [];
                // $no = 0;


                error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
                $pdf = new FPDF('P', 'mm', 'Legal');
                $pdf->AddPage();


                $pdf->SetTitle($laporan['no_surat'] . '-' . $laporan['jenis_permohonan'] . '-' . $laporan['nama_mahasiswa'] . '.pdf');

                // $pdf->SetFont('Arial', 'B', 10);
                // $pdf->Cell(30, 10, 'Title', 1, 0, 'C');

                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(0, 10, '', 0, 1);
                $pdf->Cell(0, 5, '', 0, 1);
                $pdf->Image('./assets/data/img/kalbis_logo.png', 10, 10, 80);

                $pdf->Cell(10, 20, '', 0, 1);
                $pdf->SetFont('Arial', 'B', 12);
                $pdf->Cell(0, 1, 'Surat Pengantar Kerja Praktik', 0, 1, 'C');

                $pdf->Cell(10, 5, '', 0, 1);
                $pdf->SetFont('Arial', '', 12);
                $pdf->Cell(0, 1, $laporan['no_surat'], 0, 1, 'C');

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
                $pdf->Cell(0, 10, 'Jakarta,' . date('d F Y', strtotime($laporan['updated_at'])), 0, 1, $pdf->setX(25));

                $pdf->Cell(0, 5, '', 0, 1);
                $pdf->SetFont('Arial', '', 11.5);
                $pdf->Image($tanda_tangan,  25, $pdf->getY(), 40);


                $pdf->Cell(0, 35, '', 0, 1);
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

                $b = explode('/', $laporan['no_surat']);
                $a = implode("-", $b);
                $nama = $a  . '_surat_magang' . '_' . $laporan['nama_mahasiswa'] . '.pdf';
                $path = "/assets/data/" . $nama;
                // echo $path;
                // die();
                $save_to_local = $pdf->Output(__DIR__ . "/../../../assets/data/" . $nama, "F");

                $update_path = $this->master_data->update_file_pdfKP($path, $nama, $insert_surat_kp);
                if ($update_path) {
                    $mhs = $this->master_data->get_mhs_by_email($gmail);
                    $user = $this->master_data->get_form_by_id_formulir($id_formulir);
                    $jenis = "Surat Pengantar Riset";

                    $mail = new PHPMailer(true);

                    try {
                        //Server settings            
                        $mail->isSMTP();                                            //Send using SMTP            
                        $mail->SMTPDebug = SMTP::DEBUG_SERVER;

                        //Set the hostname of the mail server
                        $mail->Host = 'smtp.gmail.com';

                        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
                        $mail->Port = 587;

                        //Set the encryption mechanism to use - STARTTLS or SMTPS
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

                        //Whether to use SMTP authentication
                        $mail->SMTPAuth = true;

                        //Set AuthType to use XOAUTH2
                        $mail->AuthType = 'XOAUTH2';

                        $email = 'academicoperationskalbis@gmail.com';
                        $clientId = '426965174563-q7ps5r823aau8dnq6cltlko0h96dju1m.apps.googleusercontent.com';
                        $clientSecret = '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';

                        //Obtained by configuring and running get_oauth_token.php
                        //after setting up an app in Google Developer Console.
                        $refreshToken = '1//0gf676lZoNfJCCgYIARAAGBASNwF-L9Irao8AUfBU_Jx43kQ53eoYGvF8cOEARtxISZDgXPJasvUHy_eTQKe-syOOuORCu0RpskE';
                        $provider = new Google(
                            [
                                'clientId' => $clientId,
                                'clientSecret' => $clientSecret,
                            ]
                        );
                        $mail->setOAuth(new OAuth([
                            'provider' => $provider,
                            'clientId' => $clientId,
                            'clientSecret' => $clientSecret,
                            'refreshToken' => $refreshToken,
                            'userName' => $email,
                        ]));

                        //Recipients
                        $mail->setFrom('academicoperationsKkalbis@gmail.com', 'Academic Operation Kalbis Institute');
                        $mail->addAddress($gmail);               //Name is optional
                        // $mail->addAttachment($_SERVER['DOCUMENT_ROOT'] . '/web_akademik' . $path);
                        $path_surat = $_SERVER['DOCUMENT_ROOT'] . '/web_akademik' . $path;
                        $mail->addAttachment($path_surat);         //Add attachments
                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = 'Formulir Pengajuan ' . $jenis . '(' . $user['no_form'] . ')';
                        $mail->Body    = '<div class="container" style="width: 600px; height: 100%;">
                                                 <div class="card" style="width: 100%; height: 100%;">
                                                     <div class="card-header " style="background-color:#6777ef;color:#fff;width: 100%; height: 100px; display: flex; justify-content: center; align-items: center; text-align: center; background: #007bff;">
                                                         <h3 style="font-size: 18px; text-align: center; padding: 0 175px; " >' . $jenis . '(' . $user['no_form'] . ')</h3>
                                                     </div>
                                                     <div class="card-body" style="background-color: rgb(240, 240, 240); padding: 50px;">
                                                         <h2 class="card-text">Hello, ' . $mhs['nama_lengkap'] . '</h2>
                                                         <h4 class="card-text">Surat untuk formulir pengajuan ' . $jenis . ' dengan nomor formulir <br> ' . $user['no_form'] . ' telah dibuat.</h4>
                                                         <h5 class="card-text">Untuk melihat lebih detail silahkan kunjungi link berikut: <a href="http://localhost/web_akademik/Pengajuan-Form/" class="btn btn-link">Detail Formulir</a></h5>
                                                     </div>
                                                 </div>
                                                 <div class="row">
                                                <div class="col-12">										
                                                    <p class="card-text">Jalan Pulomas Selatan Kav. 22 Jakarta Timur, Indonesia - 13210</p>										
                                                    <p class="card-text">Telp     : 021 - 47883900 ext. 1119 - 1121</p>										
                                                    <p class="card-text">Email  : academicoperationskalbis@gmail.com</p>										
                                                </div>
                                            </div>
                                             </div>';
                        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                        $mail->send();
                        echo ($this->session->set_flashdata('msg', '<div id="lookatme"  class="alert alert-success animated fadeIn" role="alert"><i class="fa fa-times mr-2"></i>Data Surat Berhasil Di Buat!</div>'));
                        redirect('superadmin/master_data/get_formulir_kp/2/' . $user['id_formulir']);
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                }
                // echo $this->session->set_flashdata('msg', '<div id="lookatme"  class="alert alert-success animated fadeIn" role="alert"><i class="fa fa-times mr-2"></i>Data Surat Berhasil Di Buat!</div>');
                // redirect('admin-data-formulir');
            } else {
                echo $this->session->set_flashdata('msg', '<div id="lookatme"  class="alert alert-danger animated fadeIn" role="alert"><i class="fa fa-times mr-2"></i>Data Surat Gagal Di Buat!</div>');
                redirect('admin-data-formulir');
            }
        }
    }
    function test()
    {
        redirect('superadmin/master_data/data_formulir');
    }

    public function validate($id_formulir, $id_jenis_p, $emailMHS)
    {
        ob_start();
        $data = [
            'id_formulir' => $id_formulir,
            'approval_admin' => 1,
            'update_at' => date('Y-m-d')
        ];
        $validate = $this->master_data->validasi_admin1($data);
        if ($validate) {
            $mhs = $this->master_data->get_mhs_by_email($emailMHS);
            $user = $this->master_data->get_form_by_id_formulir($id_formulir);
            if ($id_jenis_p == 1) {
                $jenis = "Surat Pengantar Riset";
                $link = 'superadmin/master_data/get_formulir_riset/1/' . $user['id_formulir'];
            } elseif ($id_jenis_p == 2) {
                $jenis = "Surat Pengantar Kerja Praktik";
                $link = 'superadmin/master_data/get_formulir_kp/2/' . $user['id_formulir'];
            }
            $mail = new PHPMailer(true);
            try {
                // Server Settings
                $mail->isSMTP();                                            //Send using SMTP            
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->Host     = 'smtp.gmail.com';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->SMTPAuth = true;
                $mail->AuthType = 'XOAUTH2';
                // $mail->Username = 'academicoperationskalbis@gmail.com';
                // $mail->Password = 'Hadits123';
                $mail->SMTPSecure = 'tls';
                $mail->Port     = 587;
                $email = 'academicoperationskalbis@gmail.com';
                $clientId = '426965174563-q7ps5r823aau8dnq6cltlko0h96dju1m.apps.googleusercontent.com';
                $clientSecret = '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';

                //Obtained by configuring and running get_oauth_token.php
                //after setting up an app in Google Developer Console.
                $refreshToken = '1//0gf676lZoNfJCCgYIARAAGBASNwF-L9Irao8AUfBU_Jx43kQ53eoYGvF8cOEARtxISZDgXPJasvUHy_eTQKe-syOOuORCu0RpskE';
                $provider = new Google(
                    [
                        'clientId' => $clientId,
                        'clientSecret' => $clientSecret,
                    ]
                );
                $mail->setOAuth(new OAuth([
                    'provider' => $provider,
                    'clientId' => $clientId,
                    'clientSecret' => $clientSecret,
                    'refreshToken' => $refreshToken,
                    'userName' => $email,
                ]));

                //Recipients
                $mail->setFrom('academicoperationsKkalbis@gmail.com', 'Academic Operation Kalbis Institute');
                $mail->addAddress($emailMHS);

                //Content
                $mail->isHTML(true);
                $mail->Subject = 'Formulir Pengajuan ' . $jenis . '(' . $user['no_form'] . ')';
                $mail->Body    = '<div class="container" style="width: 600px; height: 100%;">
                                     <div class="card" style="width: 100%; height: 100%;">
                                         <div class="card-header " style="background-color:#6777ef;color:#fff;width: 100%; height:
                                          100px; display: flex; justify-content: center; align-items: center; text-align: center;
                                           background: #007bff;">
                                             <h3 style="font-size: 18px; text-align: center; padding: 0 175px; " >'
                    . $jenis . '(' . $user['no_form'] . ')</h3>
                                         </div>
                                         <div class="card-body" style="background-color: rgb(240, 240, 240); padding: 50px;">
                                             <h2 class="card-text">Hello, ' . $mhs['nama_lengkap'] . '</h2>
                                             <h4 class="card-text">Formulir pengajuan ' . $jenis . ' dengan nomor formulir <br> '
                    . $user['no_form'] . ' telah di Approve oleh admin.</h4>
                                             <h5 class="card-text">Untuk melihat lebih detail silahkan kunjungi link berikut: 
                                             <a href="http://localhost/web_akademik/Pengajuan-Form/" class="btn btn-link">
                                             Detail Formulir</a></h5>
                                         </div>
                                     </div>
                                     <div class="row">
									<div class="col-12">										
										<p class="card-text">Jalan Pulomas Selatan Kav. 22 Jakarta Timur, Indonesia - 13210</p>										
										<p class="card-text">Telp     : 021 - 47883900 ext. 1119 - 1121</p>										
										<p class="card-text">Email  : academicoperationskalbis@gmail.com</p>										
									</div>
								</div>
                                 </div>';
                $mail->send();
                echo $this->session->set_flashdata('msg', '<div id="lookatme"  class="alert alert-success animated fadeIn" 
                role="alert"><i class="fa fa-times mr-2"></i>Formulir sudah di <b>validasi<b>!</div>');
                redirect($link);
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }

    public function duplicate($id_formulir, $id_jenis_p, $emailMhs)
    {
        ob_start();
        if ($id_jenis_p == 1) {
            $jenis = "Surat Pengantar Riset";
            $link = 'superadmin/master_data/get_formulir_riset/1/' . $id_formulir;
        } elseif ($id_jenis_p == 2) {
            $jenis = "Surat Pengantar Kerja Praktik";
            $link = 'superadmin/master_data/get_formulir_kp/2/' . $id_formulir;
        }
        $reject = $this->master_data->duplikasi_admin($id_formulir);

        if ($reject) {
            $mhs = $this->master_data->get_mhs_by_email($emailMhs);
            $data_form = $this->master_data->get_form_by_id_formulir($id_formulir);
            $mail = new PHPMailer(true);
            try {
                //Server settings            
                $mail->isSMTP();                                            //Send using SMTP            
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->Host     = 'smtp.gmail.com';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->SMTPAuth = true;
                $mail->AuthType = 'XOAUTH2';
                // $mail->Username = 'academicoperationskalbis@gmail.com';
                // $mail->Password = 'Hadits123';
                // $mail->SMTPSecure = 'tls';
                $mail->Port     = 587;
                $email = 'academicoperationskalbis@gmail.com';
                $clientId = '426965174563-q7ps5r823aau8dnq6cltlko0h96dju1m.apps.googleusercontent.com';
                $clientSecret = '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';

                //Obtained by configuring and running get_oauth_token.php
                //after setting up an app in Google Developer Console.
                $refreshToken = '1//0gf676lZoNfJCCgYIARAAGBASNwF-L9Irao8AUfBU_Jx43kQ53eoYGvF8cOEARtxISZDgXPJasvUHy_eTQKe-syOOuORCu0RpskE';
                $provider = new Google(
                    [
                        'clientId' => $clientId,
                        'clientSecret' => $clientSecret,
                    ]
                );
                $mail->setOAuth(new OAuth([
                    'provider' => $provider,
                    'clientId' => $clientId,
                    'clientSecret' => $clientSecret,
                    'refreshToken' => $refreshToken,
                    'userName' => $email,
                ]));

                //Recipients
                $mail->setFrom('academicoperationsKkalbis@gmail.com', 'Academic Operation Kalbis Institute');
                $mail->addAddress($emailMhs);

                //Content
                $mail->isHTML(true);
                $mail->Subject = 'Formulir Pengajuan ' . $jenis . '(' . $data_form['no_form'] . ')';
                $mail->Body    = '<div class="container" style="width: 600px; height: 100%;">
                                     <div class="card" style="width: 100%; height: 100%;">
                                         <div class="card-header " style="background-color:#6777ef;color:#fff;
                                         width: 100%; height: 100px; display: flex; justify-content: center; 
                                         align-items: center; text-align: center; background: #007bff;">
                                             <h3 style="font-size: 18px; text-align: center; padding: 0 175px; " >'
                    . $jenis . '(' . $data_form['no_form'] . ')</h3>
                                         </div>
                                         <div class="card-body" style="background-color: rgb(240, 240, 240); padding: 50px;">
                                             <h2 class="card-text">Hello, ' . $mhs['nama_lengkap'] . '</h2>
                                             <h4 class="card-text">Formulir pengajuan ' . $jenis . ' dengan nomor formulir 
                                             <br> ' . $data_form['no_form'] . ' di reject oleh Admin.</h4>
                                             <h5 class="card-text">Untuk melihat lebih detail silahkan kunjungi link berikut:
                                              <a href="http://localhost/web_akademik/Pengajuan-Form/" class="btn btn-link">
                                              Detail Formulir</a></h5>
                                         </div>
                                     </div>
                                     <div class="row">
									<div class="col-12">										
										<p class="card-text">Jalan Pulomas Selatan Kav. 22 Jakarta Timur, Indonesia - 13210</p>										
										<p class="card-text">Telp     : 021 - 47883900 ext. 1119 - 1121</p>										
										<p class="card-text">Email  : academicoperationskalbis@gmail.com</p>										
									</div>
								</div>
                                 </div>';
                $mail->send();
                echo $this->session->set_flashdata('msg', '<div id="lookatme"  class="alert alert-success animated fadeIn"
                 role="alert"><i class="fa fa-times mr-2"></i>Formulir sudah di <b>reject<b>!</div>');
                redirect($link);
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
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

    public function download_surat($id_jenis_p, $id_surat)
    {
        if ($id_jenis_p == 1) {
            $pdf_surat_riset = $this->master_data->get_pdf_surat_riset($id_surat);
            $surat_riset = $this->master_data->get_surat($id_surat);
            $path_file = $_SERVER['DOCUMENT_ROOT'] . '/web_akademik' . $pdf_surat_riset['file_pdf'];

            header("Cache-Control:  maxage=1");
            header("Pragma: public");
            header("Content-type: application/pdf");
            header("Content-Transfer-Encoding: Binary");
            header("Content-length: " . filesize($path_file));
            header("Content-disposition: attachment; filename=\"" . basename($path_file) . "\"");
            readfile($path_file);
        } elseif ($id_jenis_p == 2) {
            $pdf_surat_riset = $this->master_data->get_pdf_surat_riset($id_surat);
            $surat_riset = $this->master_data->get_surat($id_surat);
            $path_file = $_SERVER['DOCUMENT_ROOT'] . '/web_akademik' . $pdf_surat_riset['file_pdf'];

            header("Cache-Control:  maxage=1");
            header("Pragma: public");
            header("Content-type: application/pdf");
            header("Content-Transfer-Encoding: Binary");
            header("Content-length: " . filesize($path_file));
            header("Content-disposition: attachment; filename=\"" . basename($path_file) . "\"");
            readfile($path_file);
        }
    }

    public function delete_mahasiswa($id)
    {
        $this->master_data->delete_data_mahasiswa($id);
        echo $this->session->set_flashdata('msg', '<div class="alert alert-success"><button type="button"
         class="close" data-dismiss="alert">&times;</button>Data berhasil di hapus !</div>');
        redirect('superadmin/Master_data/data_mahasiswa');
    }

    public function delete_ttd($id)
    {
        $this->master_data->delete_data_ttd($id);
        echo $this->session->set_flashdata('msg', '<div class="alert alert-success"><button type="button"
         class="close" data-dismiss="alert">&times;</button>Data berhasil di hapus !</div>');
        redirect('superadmin/Master_data/data_ttd');
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
        $path = '/web_akademik/assets/data/ttd/';
        $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'] . $path; //path folder
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

                $data1 = $this->security->xss_clean($data);
                $insert = $this->master_data->save_ttd($data1);
                if ($insert == true) {
                    echo $this->session->set_flashdata('msg', '<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>Data tanda tangan <b>'
                        . $nama . '</b>, berhasil ditambahkan.</div>');
                    redirect('admin-add-ttd');
                } else {
                    echo $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>Data tanda tangan <b>'
                        . $nama . '</b>, gagal ditambahkan.</div>');
                    redirect('admin-add-ttd');
                }
            } else {
                echo $this->session->set_flashdata('msg', '<div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>'
                    . $this->upload->display_errors() . '</div>');
                redirect('admin-add-ttd');
            }
        } else {
            echo $this->session->set_flashdata('msg', '<div class="alert alert-danger"><button type="button" 
                class="close" data-dismiss="alert">&times;</button>' . $this->upload->display_errors() . '</div>');
            redirect('admin-add-ttd');
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
        $path = '/web_akademik/assets/data/mahasiswa/foto_profilM';
        $nmfile = $nim . "_" . date("H-i-s"); //nama file saya beri nama langsung dengan nim dan tgl
        $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'] . $path; //path folder
        $config['allowed_types'] = 'gif|jpg|PNG|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '2048000000'; //maksimum besar file 2M
        $config['max_width']  = '0';
        $config['max_height']  = '0';
        $config['file_name'] = $nmfile; //nama yang terupload nantinya

        $this->upload->initialize($config);
        $this->load->library('upload', $config);
        if (!empty($_FILES['foto']['name'])) {
            if ($this->upload->do_upload('foto')) {
                $pw = md5(str_replace("'", "", $this->security->xss_clean($this->input->post('password'))),);
                $pic = $this->upload->data();
                $foto = "/assets/data/mahasiswa/foto_profilM/" . $pic['file_name'];
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
                    echo $this->session->set_flashdata('msg', '<div class="alert alert-success"><button type="button" 
                    class="close" data-dismiss="alert">&times;</button>Data  <b>' . $data['nama_lengkap'] .
                        '</b> Successfully added to database.</div>');
                    redirect('superadmin/Master_data/add_mahasiswa');
                } else {
                    echo $this->session->set_flashdata('msg', '<div class="alert alert-danger"><button type="button" 
                    class="close" data-dismiss="alert">&times;</button></b> Failed added to database.</div>');
                    redirect('superadmin/Master_data/add_mahasiswa');
                }
            } else {
                echo $this->session->set_flashdata('msg', '<div class="alert alert-danger"><button type="button" 
                class="close" data-dismiss="alert">&times;</button>' . $this->upload->display_errors() . '</div>');
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
            if ($a) {
                $data_prodi = [
                    'id_mahasiswa' => $a,
                    'nim' => $nim,
                    'program_studi' => str_replace("'", "", $this->security->xss_clean($this->input->post('prodi'))),
                ];
                $data2 = $this->security->xss_clean($data_prodi);
                $insert_id = $this->master_data->save_data_kampus($data2);
            }
            echo $this->session->set_flashdata('msg', '<div class="alert alert-success"><button type="button" 
            class="close" data-dismiss="alert">&times;</button>Data <b>' . $data['nama_lengkap'] .
                '</b> Successfully added to database.</div>');
            redirect('superadmin/Master_data/add_mahasiswa');
        }
    }

    public function update_mahasiswa($id)
    {
        $nim = str_replace("'", "", $this->security->xss_clean($this->input->post('nim')));
        $path = '/web_akademik/assets/data/mahasiswa/foto_profilM/';
        $nmfile = $nim . "_" . date("H-i-s"); //nama file saya beri nama nim dan tanggal
        $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'] . $path; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '2048000000'; //maksimum besar file 2M
        $config['max_width']  = '0'; //lebar maksimum 1288 px
        $config['max_height']  = '0'; //tinggi maksimu 1000 px
        $config['file_name'] = $nmfile; //nama yang terupload nantinya
        $this->upload->initialize($config);
        $this->load->library('upload', $config);
        if (!empty($_FILES['foto']['name'])) {
            if ($this->upload->do_upload('foto')) {
                $pw = str_replace("'", "", $this->security->xss_clean($this->input->post('password')));
                $pic = $this->upload->data();
                $foto = "/assets/data/mahasiswa/foto_profilM/" . $pic['file_name'];

                $data1 = [

                    'email' => str_replace("'", "", $this->security->xss_clean($this->input->post('email'))),
                    'nama_lengkap' => str_replace("'", "", $this->security->xss_clean($this->input->post('nama_lengkap'))),
                    'password' => md5($pw),
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
                if ($pw == null) {
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
                    $data1 = $this->security->xss_clean($data1);
                    $data2 = $this->security->xss_clean($data_kampus);
                }

                $insert = $this->master_data->update_mahasiswa($data1, $id);
                if ($insert) {
                    $update = $this->master_data->update_data_kampus($data2, $id);
                    echo $this->session->set_flashdata('msg', '<div class="alert alert-success"><button type="button"
                     class="close" data-dismiss="alert">&times;</button>Data  <b>' . $data['nama_lengkap'] .
                        '</b> Successfully added to database.</div>');
                    redirect('superadmin/Master_data/data_mahasiswa');
                } else {
                    echo $this->session->set_flashdata('msg', '<div class="alert alert-danger"><button type="button"
                     class="close" data-dismiss="alert">&times;</button></b> Failed added to database.</div>');
                    redirect('superadmin/Master_data/data_mahasiswa');
                }
            } else {
                echo $this->session->set_flashdata('msg', '<div class="alert alert-danger"><button type="button" 
                class="close" data-dismiss="alert">&times;</button>' . $this->upload->display_errors() . '.</div>');
                redirect('superadmin/Master_data/data_mahasiswa');
            }
        } else {
            $pw = str_replace("'", "", $this->security->xss_clean($this->input->post('password')));
            $data1 = [
                'email' => str_replace("'", "", $this->security->xss_clean($this->input->post('email'))),
                'nama_lengkap' => str_replace("'", "", $this->security->xss_clean($this->input->post('nama_lengkap'))),
                'password' => md5($pw),
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

            if ($pw == null) {
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
                $data1 = $this->security->xss_clean($data1);
                $data2 = $this->security->xss_clean($data_kampus);
            }

            $update1 = $this->master_data->update_mahasiswa1($data1, $id);
            if ($update1) {
                $this->master_data->update_data_kampus1($data2, $id);
                echo $this->session->set_flashdata('msg', '<div class="alert alert-success"><button type="button" 
                class="close" data-dismiss="alert">&times;</button>Data <b>' . $data['nama_lengkap'] .
                    '</b> Successfully added to database.</div>');
                redirect('superadmin/Master_data/data_mahasiswa');
            }
        }
    }

    public function lihat_surat($id_jenis_p, $id_formulir)
    {
        if ($id_jenis_p == 1) {
            $this->lihat_surat_riset($id_jenis_p, $id_formulir);
        } elseif ($id_jenis_p == 2) {
            $this->lihat_surat_kp($id_jenis_p, $id_formulir);
        }
    }



    public function lihat_surat_kp($id_jenis_p, $id_surat)
    {
        $pdf_surat_kp = $this->master_data->get_pdf_surat_kp($id_surat);
        $filename = $pdf_surat_kp;
        redirect($filename);
    }

    public function update_ttd($id)
    {
        $nmfile = $this->input->post("foto"); //nama file saya beri nama langsung dan diikuti fungsi time
        $path = '/web_akademik/assets/data/ttd/';
        $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'] . $path; //path folder
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

                    'nama' => str_replace("'", "", $this->security->xss_clean($this->input->post('nama'))),
                    'jabatan' => str_replace("'", "", $this->security->xss_clean($this->input->post('jabatan'))),
                    'tanda_tangan' => $foto,
                    'updated_at' => date('Y-m-d H:i:S')
                ];
                $data1 = $this->security->xss_clean($data);
                $insert = $this->master_data->update_ttd($data1, $id);
                if ($insert) {
                    echo $this->session->set_flashdata('msg', '<div class="alert alert-success"><button type="button"
                     class="close" data-dismiss="alert">&times;</button>Data  <b>' . $data['nama'] .
                        '</b> Successfully update to database.</div>');
                    redirect('superadmin/Master_data/data_ttd');
                } else {
                    echo $this->session->set_flashdata('msg', '<div class="alert alert-danger"><button type="button"
                     class="close" data-dismiss="alert">&times;</button></b> Failed update to database.</div>');
                    redirect('superadmin/Master_data/data_ttd');
                }
            } else {
                echo $this->session->set_flashdata('msg', '<div class="alert alert-danger"><button type="button" 
                class="close" data-dismiss="alert">&times;</button>' . $this->upload->display_errors() . '.</div>');
                redirect('superadmin/Master_data/data_ttd');
            }
        } else {
            $data = [

                'nama' => str_replace("'", "", $this->security->xss_clean($this->input->post('nama'))),
                'jabatan' => str_replace("'", "", $this->security->xss_clean($this->input->post('jabatan'))),
                'updated_at' => date('Y-m-d H:i:S')
            ];


            $data1 = $this->security->xss_clean($data);
            $update1 = $this->master_data->update_ttd($data1, $id);
            if ($update1) {

                echo $this->session->set_flashdata('msg', '<div class="alert alert-success"><button type="button" 
                class="close" data-dismiss="alert">&times;</button>Data <b>' . $data['nama'] .
                    '</b> Successfully update to database.</div>');
                redirect('superadmin/Master_data/data_ttd');
            }
        }
    }

    public function lihat_surat_riset($id_jenis_p, $id_surat)
    {
        $pdf_surat_riset = $this->master_data->get_pdf_surat_riset($id_surat);
        $filename = $pdf_surat_riset;
        redirect($filename);
    }
}
