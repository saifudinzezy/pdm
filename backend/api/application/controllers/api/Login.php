<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Login extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mahasiswa_model', 'mahasiswa');
	}

	//create data
	public function index_post()
	{
		$where = [
			'nama' => $this->post('nama'),
			'email' => $this->post('email')
		];

		if ($this->mahasiswa->login($where) > 0) {
			// ok				
	        $this->set_response([
                'status' => true,
                'message' => 'login sukses',
                'user' => $this->db->get_where('mahasiswa', $where)->result_array()
            ], REST_Controller::HTTP_OK);
		}else{
			//id not found
			$this->set_response([
                'status' => false,
                'message' => 'login gagal'
            ], REST_Controller::HTTP_BAD_REQUEST);
		}
	}
}
?>