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
            $this->db->select('email');
            $this->db->where(array('email' => $u));
            $karyawan = $this->db->get('karyawan');
            if ($karyawan->num_rows() > 0) {
                $this->db->select('*');
                $this->db->where(array('email' => $u, 'password' => md5($p)));
                $karyawan1 = $this->db->get('karyawan');
                if ($karyawan1->num_rows() > 0) {
                    return $karyawan1;
                } else {
                    $a = "Password Salah!!";
                    return $a;
                }
            }
        } else {
            $a = "Username atau Password Salah!!";
            return $a;
        }
    }
}
