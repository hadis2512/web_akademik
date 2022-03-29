<?php
class M_master_data extends CI_Model
{

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
    function get_all_karyawan()
    {
        $this->db->select('a.*,b.nip as nip,b.program_studi as prodi_id ,c.id as id_prodi,d.id as program_id,e.nama as nama');
        $this->db->from('karyawan a');
        $this->db->join('data_karyawan_kampus as b', 'b.id_karyawan=a.id', 'left outer');
        $this->db->join('program_studi as c', 'b.program_studi=c.id', 'left outer');
        $this->db->join('program as d', 'c.id_program=d.id', 'left outer');
        $this->db->join('jabatan as e', 'e.id=a.id_jabatan', 'left outer');
        $query = $this->db->get();
        return $query->result_array();
        // $sql = "SELECT a.*, b.id as id_jabatan,b.nama as nama from karyawan a, jabatan b where a.id_jabatan=b.id";
        // return $this->db->query($sql)->result_array();
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
    function get_data()
    {
        $query = $this->db->select('*')->from('mahasiswa')->get();
        return $query->result_array();
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
}
