<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Mahasiswa extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mahasiswa_model', 'mahasiswa');
	}

	public function index_get()
	{
		$id = $this->get('id');
		if ($id === null) {
			$mahasiswa = $this->mahasiswa->getMahasiswa();
		}else {
			$mahasiswa = $this->mahasiswa->getMahasiswa($id);
		}

		// var_dump($mahasiswa);
		if ($mahasiswa) {
			//jika ada isinya
			$this->set_response([
                'status' => true,
                'data' => $mahasiswa
            ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
		}else {
			$this->set_response([
                'status' => false,
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
			if ($this->mahasiswa->deleteMahasiswa($id) > 0) {
				// ok				
		        $this->set_response([
	                'status' => true,
	                'id' => $id,
	                'message' => 'deleted.'
	            ], REST_Controller::HTTP_OK);
			}else{
				//id not found
				$this->set_response([
	                'status' => false,
	                'message' => 'id not found!'
	            ], REST_Controller::HTTP_BAD_REQUEST);
			}
		}
	}

	//create data
	public function index_post()
	{
		$data = [
			'nrp' => $this->post('nrp'),
			'nama' => $this->post('nama'),
			'email' => $this->post('email'),
			'jurusan' => $this->post('jurusan')
		];

		if ($this->mahasiswa->createMahasiswa($data) > 0) {
			// ok				
	        $this->set_response([
                'status' => true,
                'message' => 'new Mahasiswa'
            ], REST_Controller::HTTP_CREATED);
		}else{
			//id not found
			$this->set_response([
                'status' => false,
                'message' => 'failed to create new data!'
            ], REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	public function index_put()
	{
		$id = $this->put('id');

		$data = [
			'nrp' => $this->put('nrp'),
			'nama' => $this->put('nama'),
			'email' => $this->put('email'),
			'jurusan' => $this->put('jurusan')
		];

		if ($this->mahasiswa->updateMahasiswa($data, $id) > 0) {
			// ok				
	        $this->set_response([
                'status' => true,
                'message' => 'updated Mahasiswa'
            ], REST_Controller::HTTP_CREATED);
		}else{
			//id not found
			$this->set_response([
                'status' => false,
                'message' => 'failed to update data!'
            ], REST_Controller::HTTP_BAD_REQUEST);
		}
	}
}
?>