<?php
class Produk_model extends CI_Model
{
	public function getProduk($id = null)
	{
		if ($id === null) {
			return $this->db->get('tec_products')->result_array();
		}else {
			return $this->db->get_where('tec_products', ['category_id' => $id])->result_array();
		}
	}
}

?>
