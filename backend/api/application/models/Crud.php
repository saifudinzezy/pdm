<?php
class Crud extends CI_Model
{
	public function getData($id, $table)
	{
		$this->db->order_by('id', 'DESC');
		return $this->db->get_where($table, ['kode_daftar' => $id])->result_array();
	}

	public function getDataYear($id, $table, $year)
	{
		$this->db->order_by('id', 'DESC');
		return $this->db->get_where($table, ["kode_daftar" => $id, "DATE_FORMAT(tanggal, '%Y') = " => $year])->result_array();
	}

	public function deleteData($id, $table)
	{
		$this->db->delete($table, ['id' => $id]);
		//jika berhasil = 1, jika gagal = -1
		return $this->db->affected_rows();
	}

	public function createData($data, $table)
	{
		$this->db->insert($table, $data);
		return $this->db->affected_rows();		
	}

	public function updateData($data, $id, $table)
	{
		$this->db->update($table, $data, ['id' => $id]);
		return $this->db->affected_rows();
	}

	public function login($where, $table)
	{
		$this->db->get_where($table, $where);
		return $this->db->affected_rows();		
	}
}
?>
