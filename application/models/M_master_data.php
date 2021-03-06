<?php
class M_master_data extends CI_Model
{
    function get_foto_profil($email)
    {
        $this->db->select('email');
        $this->db->where(array('email' => $email));
        $emailMhs = $this->db->get('mahasiswa');
        if ($emailMhs->num_rows() > 0) {
            $this->db->select('foto');
            $this->db->where(array('email' => $email));
            $mhs = $this->db->get('mahasiswa');
            return $mhs->result_array();
        } elseif ($emailMhs->num_rows() == 0) {
            $this->db->select('email');
            $this->db->where(array('email' => $email));
            $emailDosen = $this->db->get('mahasiswa');
            if ($emailDosen->num_rows() > 0) {
                $this->db->select('foto');
                $this->db->where(array('email' => $email));
                $dosen = $this->db->get('karyawan');
                return $dosen->result_array();
            }
        }
    }
    function get_my_profile($id)
    {
        $this->db->select('a.*,b.nim as nim,b.program_studi as id_prodi,c.id_program as id_program,c.program_studi as prodi,d.nama as nama_program');
        $this->db->from('mahasiswa a');
        $this->db->join('data_mahasiswa_kampus b', 'a.id=b.id_mahasiswa', 'left outer');
        $this->db->join('program_studi c', 'b.program_studi=c.id', 'left outer');
        $this->db->join('program d', 'd.id=c.id_program', 'left outer');
        $this->db->where('a.id', $id);
        return $this->db->get()->result_array();
    }
    function get_mhs_by_email($emailMHS)
    {
        $this->db->where('email', $emailMHS);
        return $this->db->get('mahasiswa')->row_array();
    }
    function get_all_mhs()
    {
        $this->db->select('a.*,b.nim as nim, b.program_studi as program_studi_id, c.program_studi as program_studi, d.id as program_id,d.nama as nama');
        $this->db->from('mahasiswa a');
        $this->db->join('data_mahasiswa_kampus AS b', 'b.id_mahasiswa=a.id', 'left outer');
        $this->db->join('program_studi AS c', 'b.program_studi=c.id', 'left outer');
        $this->db->join('program AS d', 'c.id_program=d.id', 'left outer');
        $query = $this->db->get();
        return $query->result_array();
    }
    function get_all_formulir()
    {
        return $this->db->get('data_formulir')->result_array();
    }
    function get_all_form_riset()
    {
        $this->db->where('id_jenis_permohonan', 1);
        return $this->db->get('data_formulir')->result_array();
    }
    function get_all_form_kp()
    {
        $this->db->where('id_jenis_permohonan', 2);
        return $this->db->get('data_formulir')->result_array();
    }
    function get_all_form_tertunda()
    {
        $this->db->where(['approval_admin' => 0]);
        return $this->db->get('data_formulir')->result_array();
    }
    function get_all_surat()
    {
        return $this->db->get("data_surat")->result_array();
    }
    function get_all_form_duplikasi()
    {
        $this->db->where(['approval_admin' => 2]);
        return $this->db->get('data_formulir')->result_array();
    }
    function get_all_surat_riset()
    {
        $this->db->select('b.*');
        $this->db->from('data_formulir a');
        $this->db->join('data_surat b', 'b.id_formulir=a.id_formulir', 'left outer');
        $this->db->where(['a.id_jenis_permohonan' => 1, 'a.status_surat' => 1]);
        return $this->db->get()->result_array();
    }
    function get_all_surat_kp()
    {
        $this->db->select('b.*');
        $this->db->from('data_formulir a');
        $this->db->join('data_surat b', 'b.id_formulir=a.id_formulir', 'left outer');
        $this->db->where(['a.id_jenis_permohonan' => 2, 'a.status_surat' => 1]);
        return $this->db->get()->result_array();
    }
    function get_latest_form()
    {
        $this->db->select('a.*,b.nama as jenis_permohonan,c.nama_lengkap as nama');
        $this->db->from('data_formulir a');
        $this->db->join('jenispermohonan b', 'a.id_jenis_permohonan=b.id', 'left_outer');
        $this->db->join('mahasiswa c', 'a.id_mahasiswa=c.id', 'left_outer');
        $this->db->order_by('id_formulir', 'DESC');
        $this->db->limit(3);
        return $this->db->get()->result_array();
    }


    function get_prodi()
    {
        // $this->db->distinct();
        // $this->db->select('program_studi');
        return $this->db->get('program_studi')->result_array();
    }
    function get_all_program()
    {
        return $this->db->get('program')->result_array();
    }
    function get_all_permohonan()
    {
        return $this->db->get('jenisPermohonan')->result_array();
    }
    function get_prodi_id($id)
    {
        $this->db->where('id_program', $id);
        return $this->db->get_where('program_studi')->result_array();
    }
    function get_prodi_id1($id)
    {
        $this->db->where('id', $id);
        return $this->db->get_where('program_studi')->result_array();
    }
    function get_data()
    {
        $query = $this->db->select('*')->from('mahasiswa')->get();
        return $query->result_array();
    }
    function get_all_data_ttd()
    {
        $this->db->select('a.*');
        $this->db->from('data_ttd as a');
        return $this->db->get('')->result_array();
    }
    function get_foto($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('mahasiswa')->row_array();
    }
    function get_all_jbtn()
    {
        return $this->db->get('jabatan')->result_array();
        // $a = $this->db->query('CALL get_jabatan');
        // return $a->result_array();
        // $this->db->close();
    }

    function save_karyawan($data)
    {
        $this->db->insert('karyawan', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    function save_ttd($data)
    {
        $this->db->insert('data_ttd', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function save_karyawan1($data)
    {
        $this->db->insert('karyawan', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function save_mahasiswa($data1)
    {
        $data_mhs = $this->db->insert('mahasiswa', $data1);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    function save_mahasiswa1($data1)
    {
        $data_mhs = $this->db->insert('mahasiswa', $data1);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    function save_data_kampus($data2)
    {
        $insert_id = $this->db->insert('data_mahasiswa_kampus', $data2);
        return true;
    }
    function save_data_karyawan($data2)
    {
        $insert_id = $this->db->insert('data_karyawan_kampus', $data2);
        return true;
    }

    function update_data_kampus($data2, $id)
    {
        $this->db->where('id_mahasiswa', $id);
        $this->db->update('data_mahasiswa_kampus', $data2);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }
    function update_data_kampus1($data2, $id)
    {
        $this->db->where('id_mahasiswa', $id);
        $this->db->update('data_mahasiswa_kampus', $data2);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    public function update_mahasiswa($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('mahasiswa', $data);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }
    public function update_mahasiswa1($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('mahasiswa', $data);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }
    public function update_karyawan($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('karyawan', $data);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }
    public function update_karyawan1($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('karyawan', $data);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    function delete_data_mahasiswa($id)
    {
        $this->db->where('id_mahasiswa', $id);
        $a = $this->db->delete('data_mahasiswa_kampus');

        if ($a) {
            $this->db->where('id', $id);
            $this->db->delete('mahasiswa');
            return true;
        } else {
            return false;
        }
    }

    function delete_karyawan($id)
    {
        $this->db->where('id_karyawan', $id);
        $a = $this->db->delete('data_karyawan_kampus');

        if ($a) {
            $this->db->where('id', $id);
            $this->db->delete('karyawan');
            return true;
        } else {
            return false;
        }
    }
    function get_jenis_permohonan()
    {
        return $this->db->get('jenispermohonan')->result_array();
    }
    function get_jenis_permohonan_by($jenis_permohonan)
    {
        $this->db->where('id', $jenis_permohonan);
        $this->db->select('nama');
        return $this->db->get('jenispermohonan')->result_array();
    }

    function save_formulir($data1)
    {
        $this->db->insert('data_formulir', $data1);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    function save_surat_riset($data2)
    {
        $data_surat_riset = $this->db->insert('data_surat_pengantar_riset', $data2);
        return $data_surat_riset;
    }
    function insert_surat_riset($data)
    {
        $data_surat_riset = $this->db->insert('data_surat', $data);
        return  $this->db->insert_id();
    }
    function insert_surat_kp($data)
    {
        $data_surat_kp = $this->db->insert('data_surat', $data);
        return $this->db->insert_id();
    }

    function get_surat_riset($id_jenis_p)
    {
        $this->db->select('a.*,b.id_jenis_permohonan as id_jenis_permohonan');
        $this->db->from('data_surat a');
        $this->db->join('data_formulir b', 'a.id_formulir=b.id_formulir', 'left outer');
        $this->db->where('b.id_jenis_permohonan', $id_jenis_p);
        $data_surat = $this->db->get();
        return $data_surat->result_array();
    }
    function get_surat_kp($id_jenis_p)
    {
        $this->db->select('a.*,b.id_jenis_permohonan as id_jenis_permohonan');
        $this->db->from('data_surat a');
        $this->db->join('data_formulir b', 'a.id_formulir=b.id_formulir', 'left outer');
        $this->db->where('b.id_jenis_permohonan', $id_jenis_p);
        $data_surat = $this->db->get();
        return $data_surat->result_array();
    }

    function save_surat_kp($data2)
    {
        $data_surat_kp = $this->db->insert('data_surat_kp', $data2);
        return $data_surat_kp;
    }
    function get_new_formulir($insert)
    {
        $this->db->where('id_formulir', $insert);
        return $this->db->get('data_formulir')->row_array();
    }

    function approve_dosen($data)
    {
        $this->db->set('approval', $data['approval']);
        $this->db->where('id_formulir', $data['id_formulir']);
        $this->db->update('data_formulir');
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }
    function reject_dosen($data)
    {
        $this->db->set('approval', $data['approval']);
        $this->db->where('id_formulir', $data['id_formulir']);
        $this->db->update('data_formulir');
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }
    function duplikasi_admin($data)
    {
        $this->db->set('approval_admin', 2);
        $this->db->where('id_formulir', $data);
        $this->db->update('data_formulir');
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    function validasi_admin($id_formulir)
    {
        $this->db->set(['approval' => 0, 'approval_admin' => 1]);
        $this->db->where('id_formulir', $id_formulir);
        $this->db->update('data_formulir');
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }
    function validasi_admin1($data)
    {
        $this->db->set(['approval_admin' => $data['approval_admin']]);
        $this->db->where('id_formulir', $data['id_formulir']);
        $this->db->update('data_formulir');
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    function admin_buat_surat($id_formulir)
    {
        $this->db->set('status_surat', 1);
        $this->db->where('id_formulir', $id_formulir);
        $this->db->update('data_formulir');
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }
    function update_file_pdf($path_file_pdf, $nama_file, $id_formulir)
    {
        $this->db->set(['file_pdf' => $path_file_pdf, 'nama_file' => $nama_file]);
        $this->db->where('id_surat', $id_formulir);
        $this->db->update('data_surat');
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }
    function update_file_pdfKP($path_file_pdf, $nama_file, $id_formulir)
    {
        $this->db->set(['file_pdf' => $path_file_pdf, 'nama_file' => $nama_file]);
        $this->db->where('id_surat', $id_formulir);
        $this->db->update('data_surat');
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    function get_detail_riset($id_pengguna)
    {
        $this->db->select('a.*,b.nama as jenis_permohonan,c.judul as judul_tugas');
        $this->db->from('data_formulir a');
        $this->db->join('jenispermohonan b', 'a.id_jenis_permohonan=b.id', 'left_outer');
        $this->db->join('data_surat_pengantar_riset c', 'a.id_formulir=c.id_formulir', 'left_outer');
        $this->db->limit(3);
        $this->db->where('a.id_mahasiswa', $id_pengguna);
        return $this->db->get()->result_array();
    }
    function get_detail_kp($id_pengguna)
    {
        $this->db->select('a.*,b.nama as jenis_permohonan,c.alamat_surat as alamat_surat,c.nama_perusahaan as nama_perusahaan, c.perwakilan_perusahaan as perwakilan_perusahaan,c.jabatan as jabatan_perwakilan, c.telp_perusahaan as no_telp_perusahaan');
        $this->db->from('data_formulir a');
        $this->db->join('jenispermohonan b', 'a.id_jenis_permohonan=b.id', 'left_outer');
        $this->db->join('data_surat_kp c', 'a.id_formulir=c.id_formulir', 'left_outer');
        $this->db->limit(3);
        $this->db->where('a.id_mahasiswa', $id_pengguna);
        return $this->db->get()->result_array();
    }
    function get_detail_jenis($id_pengguna)
    {
        $this->db->select('id_jenis_permohonan');
        $this->db->where('id_mahasiswa', $id_pengguna);
        $a = $this->db->get('data_formulir')->result_array();
        return $a;
        // $this->db->select('a.*,b.nama as jenis_permohonan,c.judul as judul_tugas');
        // $this->db->from('data_formulir a');
        // $this->db->join('jenispermohonan b', 'a.id_jenis_permohonan=b.id', 'left_outer');
        // $this->db->join('data_surat_pengantar_riset c', 'a.id_formulir=c.id_formulir', 'left_outer');
        // $this->db->limit(3);
        // $this->db->where('a.id_mahasiswa', $id_pengguna);
        // return $this->db->get()->result_array();   
    }

    function get_surat_by_id_pengguna($id_pengguna)
    {
        $this->db->select('a.id_surat as id_surat,a.no_surat as no_surat, a.nama_file as nama_file,a.file_pdf as path,b.*');
        $this->db->from('data_surat a');
        $this->db->join('data_formulir b', 'a.id_formulir=b.id_formulir', 'left outer');
        $this->db->where('b.id_mahasiswa', $id_pengguna);
        return $this->db->get()->result_array();
    }
    function get_surat_by_id($id_pengguna)
    {
        $this->db->select('a.id_surat as id_surat,a.no_surat as no_surat, a.nama_file as nama_file,a.file_pdf as path,b.*');
        $this->db->from('data_surat a');
        $this->db->join('data_formulir b', 'a.id_formulir=b.id_formulir', 'left outer');
        $this->db->where('b.id_mahasiswa', $id_pengguna);
        return $this->db->get()->result_array();
    }




    function get_form($id_pengguna)
    {
        $this->db->select('a.*,b.nama as jenis_permohonan');
        $this->db->from('data_formulir a');
        $this->db->join('jenispermohonan b', 'a.id_jenis_permohonan=b.id', 'left_outer');
        $this->db->where(['a.id_mahasiswa' => $id_pengguna,]);
        $this->db->order_by('id_formulir', 'DESC');
        $this->db->limit(3);
        return $this->db->get()->result_array();
    }
    function get_form_by_id($id_pengguna)
    {
        $this->db->select('a.*,b.nama as jenis_permohonan');
        $this->db->from('data_formulir a');
        $this->db->join('jenispermohonan b', 'a.id_jenis_permohonan=b.id', 'left_outer');
        $this->db->where(['a.id_mahasiswa' => $id_pengguna,]);
        $this->db->order_by('id_formulir', 'DESC');
        return $this->db->get()->result_array();
    }
    function get_all_form_by_admin()
    {
        $this->db->select('a.*,b.id as id_jenis_p, b.nama as jenis_permohonan,c.nama_lengkap as nama_mahasiswa,d.nim as nim,e.program_studi as nama_prodi');
        $this->db->from('data_formulir a');
        $this->db->join('jenispermohonan b', 'a.id_jenis_permohonan=b.id', 'left_outer');
        $this->db->join('mahasiswa c', 'a.id_mahasiswa=c.id', 'left_outer');
        $this->db->join('data_mahasiswa_kampus d', 'c.id=d.id_mahasiswa', 'left_outer');
        $this->db->join('program_studi e', 'd.program_studi=e.id', 'left_outer');
        $this->db->order_by('a.created_at', 'asc');
        // $this->db->where('a.approval_admin', 0);
        return $this->db->get()->result_array();
    }
    function get_all_form_admin_by_surat()
    {
        $this->db->select('a.*,b.id as id_jenis_p, b.nama as jenis_permohonan,c.nama_lengkap as nama_mahasiswa,d.nim as nim,e.program_studi as nama_prodi,f.no_surat as no_surat,f.id_surat as id_surat,f.nama_file as nama_file,f.file_pdf as path_file ');
        $this->db->from('data_formulir a');
        $this->db->join('jenispermohonan b', 'a.id_jenis_permohonan=b.id', 'left_outer');
        $this->db->join('mahasiswa c', 'a.id_mahasiswa=c.id', 'left_outer');
        $this->db->join('data_mahasiswa_kampus d', 'c.id=d.id_mahasiswa', 'left_outer');
        $this->db->join('program_studi e', 'd.program_studi=e.id', 'left_outer');
        $this->db->join('data_surat f', 'f.id_formulir=a.id_formulir', 'left_outer');
        $this->db->where(['a.approval_admin' => 1, 'a.status_surat' => 1]);
        return $this->db->get()->result_array();
    }
    function get_surat_for_print_kp($id_formulir, $id_jenis_p)
    {
        $this->db->select('a.*,b.id as id_jenis_p, b.nama as jenis_permohonan,
        c.nama_lengkap as nama_mahasiswa,c.email as email,c.tempat as tempat,c.tgl_lahir as tgl_lahir,c.no_telp as no_telp_mhs,d.nim as nim,e.program_studi as nama_prodi,f.no_surat as no_surat,g.*');
        $this->db->from('data_formulir a');
        $this->db->join('jenispermohonan b', 'a.id_jenis_permohonan=b.id', 'left_outer');
        $this->db->join('mahasiswa c', 'a.id_mahasiswa=c.id', 'left_outer');
        $this->db->join('data_mahasiswa_kampus d', 'c.id=d.id_mahasiswa', 'left_outer');
        $this->db->join('program_studi e', 'd.program_studi=e.id', 'left_outer');
        $this->db->join('data_surat f', 'f.id_formulir=a.id_formulir', 'left_outer');
        $this->db->join('data_surat_kp g', 'g.id_formulir=a.id_formulir', 'left_outer');

        $this->db->where(['f.id_formulir' => $id_formulir, 'a.id_jenis_permohonan' => $id_jenis_p]);
        return $this->db->get()->row_array();
    }
    function get_surat_for_print_riset($id_formulir, $id_jenis_p)
    {
        $this->db->select('a.*,b.id as id_jenis_p, b.nama as jenis_permohonan,c.email as email,c.nama_lengkap as nama_mahasiswa,c.tempat as tempat,c.tgl_lahir as tgl_lahir,c.no_telp as no_telp_mhs,d.nim as nim,e.program_studi as nama_prodi,f.no_surat as no_surat,g.*');
        $this->db->from('data_formulir a');
        $this->db->join('jenispermohonan b', 'a.id_jenis_permohonan=b.id', 'left_outer');
        $this->db->join('mahasiswa c', 'a.id_mahasiswa=c.id', 'left_outer');
        $this->db->join('data_mahasiswa_kampus d', 'c.id=d.id_mahasiswa', 'left_outer');
        $this->db->join('program_studi e', 'd.program_studi=e.id', 'left_outer');
        $this->db->join('data_surat f', 'f.id_formulir=a.id_formulir', 'left_outer');
        $this->db->join('data_surat_pengantar_riset g', 'g.id_formulir=a.id_formulir', 'left_outer');
        $this->db->where(['f.id_formulir' => $id_formulir, 'a.id_jenis_permohonan' => $id_jenis_p]);
        return $this->db->get()->row_array();
    }

    function get_data_surat_mahasiswa($id_pengguna)
    {
        $this->db->select('a.id_surat as id_surat, a.no_surat as no_surat, a.id_formulir as id_formulir, a.nama_file as nama_file,
        a.file_pdf as path_surat,b.*,c.nama as jenis_permohonan,c.id as id_jenis_permohonan');
        $this->db->from('data_surat a');
        $this->db->join('data_formulir b', 'a.id_formulir=b.id_formulir', 'left outer');
        $this->db->join('jenispermohonan c', 'b.id_jenis_permohonan=c.id', 'left_outer');
        $this->db->order_by('a.created_at', "desc");
        $this->db->where('b.id_mahasiswa', $id_pengguna);
        return $this->db->get()->result_array();
    }
    function update_ttd($data, $id)
    {
        $this->db->where("id_ttd", $id);
        $this->db->update("data_ttd", $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }


    function get_ttd()
    {
        $this->db->select('a.*');
        $this->db->from('data_ttd a');

        return $this->db->get()->row_array();
    }
    function get_all_form_by_prodi($prodi)
    {
        $this->db->select('a.id_formulir as id_formulir, a.no_form as no_form, a.id_mahasiswa as idM, a.id_jenis_permohonan as id_jenis_permohonan,a.approval as approval,a.created_at as tanggal_buat ,b.nama as jenis_permohonan,c.*,e.program_studi');
        $this->db->from('data_formulir a');
        $this->db->join('jenispermohonan as b', 'a.id_jenis_permohonan=b.id', 'left_outer');
        $this->db->join('mahasiswa as c', 'a.id_mahasiswa=c.id', 'left_outer');
        $this->db->join('data_mahasiswa_kampus as d', 'd.id_mahasiswa=c.id', 'left_outer');
        $this->db->join('program_studi as e', 'e.id=d.program_studi', 'left_outer');
        // $this->db->join('data_surat as f', 'f.id_formulir=a.id_formulir', 'left_outer');
        $this->db->limit(3);
        $this->db->where(['e.program_studi' => $prodi]);
        return $this->db->get();
    }
    function get_detail_surat_riset($id_formulir, $jenis_permohonan)
    {
        $this->db->select('a.*,b.*, c.nim, c.program_studi as id_prodi,d.program_studi as nama_prodi,e.nama as nama_fakultas,f.nama as nama_program,g.jenis_tugas as jenis_tugas, g.judul as judul_tugas,h.nama as jenis_permohonan,
        g.nama_perusahaan as nama_perusahaan, g.alamat_surat as alamat_surat, g.perwakilan_perusahaan as perwakilan_perusahaan, g.jabatan as jabatan_perwakilan,g.telp_perusahaan as no_telp_perusahaan,i.id_surat as id_surat ');
        $this->db->from('data_formulir a');
        $this->db->join('mahasiswa as b', 'b.id=a.id_mahasiswa', 'left outer');
        $this->db->join('data_mahasiswa_kampus AS c', 'c.id_mahasiswa=b.id', 'left outer');
        $this->db->join('program_studi AS d', 'd.id=c.program_studi', 'left outer');
        $this->db->join('fakultas AS e', 'e.id=d.id_fakultas', 'left outer');
        $this->db->join('program AS f', 'f.id=d.id_program', 'left outer');
        $this->db->join('data_surat_pengantar_riset AS g', 'g.id_formulir=a.id_formulir', 'left outer');
        $this->db->join('jenispermohonan AS h', 'a.id_jenis_permohonan=h.id', 'left outer');
        $this->db->join('data_surat AS i', 'a.id_formulir=i.id_formulir', 'left outer');
        $this->db->where(['a.id_formulir' => $id_formulir, 'h.id' => $jenis_permohonan]);
        return $this->db->get()->result_array();
    }
    function get_formulir_riset($id_jenis_p, $id_formulir)
    {
        $this->db->select('a.*,b.*, c.nim, c.program_studi as id_prodi,d.program_studi as nama_prodi,e.nama as nama_fakultas,f.nama as nama_program,g.jenis_tugas as jenis_tugas, g.judul as judul_tugas,h.nama as jenis_permohonan,g.alamat_surat as alamat_surat,g.nama_perusahaan as nama_perusahaan, g.perwakilan_perusahaan as perwakilan_perusahaan,g.jabatan as jabatan_perwakilan, g.telp_perusahaan as no_telp_perusahaan');
        $this->db->from('data_formulir a');
        $this->db->join('mahasiswa as b', 'b.id=a.id_mahasiswa', 'left outer');
        $this->db->join('data_mahasiswa_kampus AS c', 'c.id_mahasiswa=b.id', 'left outer');
        $this->db->join('program_studi AS d', 'd.id=c.program_studi', 'left outer');
        $this->db->join('fakultas AS e', 'e.id=d.id_fakultas', 'left outer');
        $this->db->join('program AS f', 'f.id=d.id_program', 'left outer');
        $this->db->join('data_surat_pengantar_riset AS g', 'g.id_formulir=a.id_formulir', 'left outer');
        $this->db->join('jenispermohonan AS h', 'a.id_jenis_permohonan=h.id', 'left outer');
        $this->db->where(['h.id' => $id_jenis_p, 'a.id_formulir' => $id_formulir]);
        return $this->db->get()->row_array();
    }
    function get_detail_surat_kp($id_formulir, $jenis_permohonan)
    {
        $this->db->select('a.*,b.*, c.nim, c.program_studi as id_prodi,d.program_studi as nama_prodi,e.nama as nama_fakultas,
        f.nama as nama_program,g.alamat_surat as alamat_surat,g.nama_perusahaan as nama_perusahaan,
        g.perwakilan_perusahaan as perwakilan_perusahaan,g.jabatan as jabatan_perwakilan, g.telp_perusahaan as no_telp_perusahaan,i.id_surat as id_surat');
        $this->db->from('data_formulir a');
        $this->db->join('mahasiswa as b', 'b.id=a.id_mahasiswa', 'left outer');
        $this->db->join('data_mahasiswa_kampus AS c', 'c.id_mahasiswa=b.id', 'left outer');
        $this->db->join('program_studi AS d', 'd.id=c.program_studi', 'left outer');
        $this->db->join('fakultas AS e', 'e.id=d.id_fakultas', 'left outer');
        $this->db->join('program AS f', 'f.id=d.id_program', 'left outer');
        $this->db->join('data_surat_kp AS g', 'g.id_formulir=a.id_formulir', 'left outer');
        $this->db->join('jenispermohonan AS h', 'a.id_jenis_permohonan=h.id', 'left outer');
        $this->db->join('data_surat AS i', 'a.id_formulir=i.id_formulir', 'left outer');
        $this->db->where(['a.id_formulir' => $id_formulir, 'h.id' => $jenis_permohonan]);
        return $this->db->get()->row_array();
    }

    function get_pdf_surat_kp($id_surat)
    {
        $this->db->select('file_pdf');
        $this->db->where('id_surat', $id_surat);
        return $this->db->get('data_surat')->row_array();
    }
    function get_pdf_surat_riset($id_surat)
    {
        $this->db->select('file_pdf');
        $this->db->where('id_surat', $id_surat);
        return $this->db->get('data_surat')->row_array();
    }
    public function get_surat($id_surat)
    {
        $this->db->select('a.id_surat as id_surat,a.no_surat as no_surat,a.nama_file as nama_file,a.file_pdf as file_pdf,a.created_at as created_at,b.*');
        $this->db->from('data_surat a');
        $this->db->join('data_formulir b', 'a.id_formulir=b.id_formulir', 'left outer');
        $this->db->where('id_surat', $id_surat);
        return $this->db->get('')->row_array();
    }
    function get_form_by_id_formulir($id_formulir)
    {
        $this->db->where('id_formulir', $id_formulir);
        return $this->db->get('data_formulir')->row_array();
    }
}
