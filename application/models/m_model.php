<?php
class M_model extends CI_Model
{
    public function get_data($table)
    {
        return $this->db->get($table);
    }
    public function getwhere($table, $data)
    {
        return $this->db->get_where($table, $data);
    }
    public function delete($table, $field, $id)
    {
        $data = $this->db->delete($table, array($field => $id));
        return $data;
    }
    public function add($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    public function update($table, $data, $where)
    {
        $data = $this->db->update($table, $data, $where);
        return $this->db->affected_rows();
    }
    public function get_by_id($table, $id_column, $id_siswa)
    {
        $data = $this->db->where($id_column, $id_siswa) -> get($table);
        return $data;
    }
    public function get_siswa_foto_by_id($id_siswa)
    {
        $this->db->select('foto');
        $this->db->from('siswa');
        $this->db->where('id_siswa', $id_siswa);
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->foto;
        } else {
            return false;
        }
    }

    


}
