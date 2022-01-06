<?php
class M_master_data extends CI_Model
{

    function get_all_mhs()
    {
        return $this->db->get('mahasiswa')->result_array();
    }

    function save_mahasiswa($data)
    {
        $this->db->insert('mahasiswa', $data);
        return true;
    }
    function save_mahasiswa1($data)
    {
        $this->db->insert('mahasiswa', $data);
        return true;
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

    function delete_mahasiswa($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('mahasiswa');
    }
}
