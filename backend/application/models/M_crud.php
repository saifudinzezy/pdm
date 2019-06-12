<?php
class M_crud extends CI_Model
{
	
	//edit value tabel
	function edit_data($where, $table)
	{
		return $this->db->get_where($table, $where);
	}

	//get data for table
	public function get_yeardata($table, $field)
	{	
		$this->db->select('*');
		$this->db->join('pengguna', 'pengguna.kode_daftar = laporan.kode_daftar');
		$this->db->where("DATE_FORMAT(tanggal, '%Y') = ", $field);
		return $this->db->get($table);
	}

	//get data for table not duplicate data
	public function get_data($getTable, $select)
	{	
		$this->db->distinct();
		$this->db->select($select);
		return $this->db->get($getTable);
	}

	//get data for table
	public function get_admin($table)
	{
		return $this->db->get($table);
	}

	//get data for table
	public function get_datas($table, $year, $kode)
	{	
		$this->db->where("DATE_FORMAT(tanggal, '%Y') = ", $year);
		$this->db->where('kode_daftar', $kode);
		return $this->db->get($table);		
	}

	//get data for table lap yang belum diperiksa
	public function get_data_nol($table)
	{		
		$this->db->where('status', '0');
		$data = $this->db->get($table);
		return $data->num_rows();
	}

	//get data for table lap yang periksa kode (diterima/ditolak)
	public function get_data_report($table, $kode)
	{		
		$this->db->where('status', $kode);
		$data = $this->db->get($table);
		return $data->num_rows();
	}

	//get data for table lap
	public function get_limit_report($table, $kode)
	{				
		$this->db->select('*');
		$this->db->from($table);
		$this->db->join('pengguna', 'pengguna.kode_daftar = laporan.kode_daftar');
		$this->db->where('status', $kode);
		$this->db->order_by('laporan.id', 'DESC');
		$this->db->limit(10);		
		return $this->db->get();
	}

	//get data for table lap yang belum diperiksa
	public function get_alldata_nol($table, $field)
	{		
		$this->db->select('*');
		// $this->db->from($table);
		$this->db->join('pengguna', 'pengguna.kode_daftar = laporan.kode_daftar');
		$this->db->order_by($field, 'DESC');
		$this->db->where('status', '0');		
		return $this->db->get($table);
	}

	//get kode_daftar
	public function get_kode_daftar($table)
	{		
		$this->db->select_max('id', 'kode');
		return $this->db->get($table);
	}

	//get data join laporan dan pengguna table desc
	public function get_joindata_desc($table, $field)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->join('laporan', 'laporan.kode_daftar = pengguna.kode_daftar');
		$this->db->order_by($field, 'DESC');
		return $this->db->get();
	}

	//get data for table desc
	public function get_data_desc($table, $field)
	{
		$this->db->order_by($field, 'DESC');
		return $this->db->get($table);
	}

	//inser data from table
	public function insert_data($data, $table)
	{
		$this->db->insert($table, $data);
	}

	//update data from table
	public function update_data($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	//delete data
	public function delete_data($where, $table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}

	public function tgl_indo($tanggal){
		$bulan = array (
			1 =>   'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		);
		$pecahkan = explode('-', $tanggal);
		
		// variabel pecahkan 0 = tanggal
		// variabel pecahkan 1 = bulan
		// variabel pecahkan 2 = tahun
	 
		return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
	}
}
 ?>