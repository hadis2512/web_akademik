<?php
class M_user extends CI_Model
{
    function login($u, $p)
    {
        $this->db->select('email');
        $this->db->where(array('email' => $u));
        $emailMhs = $this->db->get('mahasiswa');
        if ($emailMhs->num_rows() > 0) {
            $this->db->select('*');
            $this->db->where(array('email' => $u, 'password' => md5($p)));
            $mahasiswa = $this->db->get('mahasiswa');
            if ($mahasiswa->num_rows() > 0) {
                return $mahasiswa;
            } else {
                $a = "Password Salah!!";
                return $a;
            }
        } elseif ($emailMhs->num_rows() == 0) {
            $a = "Data tidak ada!!";
            return $a;
        }
    }
    function get_data_lengkap($email)
    {
        $this->db->select('email');
        $this->db->where(array('email' => $email));
        $emailMhs = $this->db->get('mahasiswa');
        if ($emailMhs->num_rows() > 0) {
            $this->db->select('a.*,b.nim as nim,c.program_studi as nama_prodi');
            $this->db->from('mahasiswa a');
            $this->db->join('data_mahasiswa_kampus as b', 'a.id=b.id_mahasiswa', 'left outer');
            $this->db->join('program_studi as c', 'b.program_studi=c.id', 'left outer');
            $this->db->where('email', $email);
            $mahasiswa = $this->db->get();
            return $mahasiswa;
        } elseif ($emailMhs->num_rows() == 0) {


            return false;
        }
    }
}
