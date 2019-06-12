<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Laporan extends REST_Controller
{
	private $table = 'laporan';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Crud', 'crud');
	}

	public function index_get()
	{
		$id = $this->get('kode');
		$year = $this->get('year');

		if ($id != null && $year != null) {
			$crud = $this->crud->getDataYear($id, $this->table, $year);
		}else{
			$crud = $this->crud->getData($id, $this->table);			
		}

		// var_dump($crud);
		if ($crud) {
			//jika ada isinya
			$this->set_response([
                'status' => true,
                'code' => 200,                
                'laporan' => $crud
            ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
		}else {
			$this->set_response([
                'status' => false,
                'code' => 200,                
                'message' => 'id not found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}	

	public function index_delete()
	{
		$id = $this->delete('id');

		if ($id === null) {
			$this->set_response([
                'status' => false,
                'message' => 'provide an id!'
            ], REST_Controller::HTTP_BAD_REQUEST);
		}else{
			//jika returnya lebih besar dari 0 maka success
			if ($this->crud->deleteData($id, $this->table) > 0) {
				// ok				
		        $this->set_response([
	                'status' => true,
	                'id' => $id,
	                'code' => 200,	                
	                'message' => 'Data berhasil dihapus!'
	            ], REST_Controller::HTTP_OK);
			}else{
				//id not found
				$this->set_response([
	                'status' => false,
	                'code' => 400,
	                'message' => 'id not found!'
	            ], REST_Controller::HTTP_BAD_REQUEST);
			}
		}
	}

	//create data
	public function index_post()
	{
		$id = $this->post('id');

		$tahun = $this->post('tanggal');
		$tahun = date('Y', strtotime($tahun));

		$data = [
			'kode_daftar' => $this->post('kode'),
			'nama_asset' => $this->post('nama'),
			'jenis_asset' => $this->post('jenis'),
			'jml_asset' => $this->post('jumlah'),
			'status' => $this->post('status'),
			'tanggal' => $this->post('tanggal'),
			'tahun' => $tahun
		];

		if ($id != null) {
			//jika returnya lebih besar dari 0 maka success
			if ($this->crud->deleteData($id, $this->table) > 0) {
				// ok				
		        $this->set_response([
	                'status' => true,
	                'id' => $id,
	                'code' => 200,	                
	                'message' => 'Data berhasil dihapus!'
	            ], REST_Controller::HTTP_OK);
			}else{
				//id not found
				$this->set_response([
	                'status' => false,
	                'code' => 400,
	                'message' => 'id not found!'
	            ], REST_Controller::HTTP_BAD_REQUEST);
			}
		}else if ($this->crud->createData($data, $this->table) > 0) {
			// ok				
	        $this->set_response([
                'status' => true,
                'code' => 200,
                'message' => 'Data berhasil ditambahkan!'
            ], REST_Controller::HTTP_CREATED);
		}else{
			//id not found
			$this->set_response([
                'status' => false,
                'code' => 400,
                'message' => 'Gagal menambahkan data!'
            ], REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	public function index_put()
	{
		$id = $this->put('id');
		$tahun = $this->put('tanggal');
		$tahun = date('Y', strtotime($tahun));

		$data = [
			'kode_daftar' => $this->put('kode'),
			'nama_asset' => $this->put('nama'),
			'jenis_asset' => $this->put('jenis'),
			'jml_asset' => $this->put('jumlah'),
			'status' => $this->put('status'),
			'tanggal' => $this->put('tanggal'),
			'tahun' => $tahun			
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