<?php
class M_user extends CI_Model
{
    function login($u, $p)
    {
        // $sql = "SELECT * FROM superadmin WHERE username=? AND password=md5(?)";
        // $hsl = $this->db->query($sql, array($u, $p));
        // return $hsl;
        $this->db->select('*');
        $this->db->where(array('email' => $u, 'password' => md5($p)));
        return $this->db->get('mahasiswa');
    }
}
