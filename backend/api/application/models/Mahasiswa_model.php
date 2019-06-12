<?php
class Mahasiswa_model extends CI_Model
{
	public function getMahasiswa($id = null)
	{
		if ($id === null) {
			return $this->db->get('mahasiswa')->result_array();
		}else {
			return $this->db->get_where('mahasiswa', ['id' => $id])->result_array();
		}
	}

	public function deleteMahasiswa($id)
	{
		$this->db->delete('mahasiswa', ['id' => $id]);
		//jika berhasil = 1, jika gagal = -1
		return $this->db->affected_rows();
	}

	public function createMahasiswa($data)
	{
		$this->db->insert('mahasiswa', $data);
		return $this->db->affected_rows();		
	}

	public function updateMahasiswa($data, $id)
	{
		$this->db->update('mahasiswa', $data, ['id' => $id]);
		return $this->db->affected_rows();
	}

	public function login($where)
	{
		$this->db->get_where('mahasiswa', $where);
		return $this->db->affected_rows();		
	}
}
?>
