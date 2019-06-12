<?php
class Kategori_model extends CI_Model
{
	public function getKategori()
	{	
		return $this->db->get('tec_categories')->result_array();
	}
}
?>
