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
		$this->load->model('Crud', 'crud');
	}

	//create data
	public function index_post()
	{
		$where = [
			'kode_daftar' => $this->post('kode'),
			'password' => $this->post('password')
		];

		if ($this->crud->login($where, 'pengguna') > 0) {
			// ok				
	        $this->set_response([
                'status' => true,
                'code' => 200,
                'message' => 'Login Berhasil!',
                'user' => $this->db->get_where('pengguna', $where)->result_array()
            ], REST_Controller::HTTP_OK);
		}else{
			//id not found
			$this->set_response([
                'status' => false,
                'code' => 400,                
                'message' => 'Akun tidak terdaftar'
            ], REST_Controller::HTTP_BAD_REQUEST);
		}
	}
}
?>