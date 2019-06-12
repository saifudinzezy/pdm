<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Pengguna extends REST_Controller
{
	private $table = 'pengguna';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Crud', 'crud');
	}	

	public function index_put()
	{
		$id = $this->put('id');

		$data = [
			'kode_daftar' => $this->put('kode'),
			'nama' => $this->put('nama'),
			'email' => $this->put('email'),
			'alamat' => $this->put('alamat'),
			'password' => $this->put('password')
		];

		if ($this->crud->updateData($data, $id, $this->table) > 0) {
			// ok				
	        $this->set_response([
                'status' => true,
                'code' => 200,
                'message' => 'Data berhasil diubah!'
            ], REST_Controller::HTTP_CREATED);

		}else{
			//id not found
			$this->set_response([
                'status' => false,
                'code' => 400,                
                'message' => 'Gagal diubah!'
            ], REST_Controller::HTTP_BAD_REQUEST);

		}
	}
}
?>