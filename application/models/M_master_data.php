<?php
class M_master_data extends CI_Model
{

    function get_all_mhs()
    {
        $this->db->select('*');
        $this->db->from('mahasiswa a');
        $this->db->join('data_mahasiswa_kampus AS b', 'b.id_mahasiswa=a.id', 'left outer');
        $this->db->join('program_studi AS c', 'b.program_studi=c.id', 'left outer');
        $this->db->join('program AS d', 'c.id_program=d.id', 'left outer');
        $query = $this->db->get();
        return $query->result_array();
    }
    function get_prodi_by_id($id_program)
    {
    }
    function get_all_program()
    {
        return $this->db->get('program')->result_array();
    }
    function get_prodi_id($id)
    {
        $this->db->where('id_program', $id);
        return $this->db->get_where('program_studi')->result_array();
    }
    function get_data()
    {
        $query = $this->db->select('*')->from('mahasiswa')->get();
        return $query->result_array();
    }
    function get_all_karyawan()
    {
        // $this->db->select('*');
        // $this->db->from('karyawan');
        // $this->db->join('jabatan AS b', 'karyawan.id_jabatan = b.id', 'left outer');
        // $query = $this->db->get('karyawan');
        // return $query->result_array();
        $sql = "SELECT a.*, b.id as id_jabatan,b.nama as nama from karyawan a, jabatan b where a.id_jabatan=b.id";
        return $this->db->query($sql)->result_array();
    }
    function get_all_jbtn()
    {
        return $this->db->get('jabatan')->result_array();
    }

    function save_karyawan($data)
    {
        $this->db->insert('karyawan', $data);
        return true;
    }
    function save_karyawan1($data)
    {
        $this->db->insert('karyawan', $data);
        return true;
    }
    function save_mahasiswa($data1)
    {
        $data_mhs = $this->db->insert('mahasiswa', $data1);
        $insert_id = $this->db->insert_id();
        return $insert_id;
        // if ($data_mhs->affected_rows() > 0) {
        //     $data2['id_mahasiswa'] = $insert_id;
        //     array_push($id_mahasiswa, $data2);
        //     $this->db->insert('data_mahasiswa_kampus', $id_mahasiswa);        
        //     return true;
        // } else {
        //     return false;
        // }
    }
    function save_mahasiswa1($data1)
    {
        $data_mhs = $this->db->insert('mahasiswa', $data1);
        $insert_id = $this->db->insert_id();
        return $insert_id;
        // if ($data_mhs) {
        //     $data2['id_mahasiswa'] = $insert_id;
        //     array_push($id_mahasiswa, $data2);
        //     $this->db->insert('data_mahasiswa_kampus', $id_mahasiswa);
        //     return true;
        // } else {
        //     return false;
        // }
    }
    function save_data_kampus($data2)
    {
        $insert_id = $this->db->insert('data_mahasiswa_kampus', $data2);
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

    function delete_mahasiswa($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('mahasiswa');
    }
    function delete_karyawan($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('karyawan');
    }
}
