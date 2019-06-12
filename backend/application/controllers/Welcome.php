<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//load model di contructor
		$this->load->model('m_crud');
	}

	public function index()
	{
		$this->load->view('login');		
	}	

	public function login()
	{
		//ambil nilai kiriman
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		//validation
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		//checked apakah ada yg sakah isi
		//return false jika ada yang salah
		if ($this->form_validation->run() != false) {
			//simpan di array jika benar
			$where = array(
				'username' => $username,
				'password' => md5($password)
			);

			//ambil semua value dari tabel admin
			$data = $this->m_crud->edit_data($where, 'admin');
			$d = $this->m_crud->edit_data($where, 'admin')->row();
			//ambil nilai int rowsnya
			$cek = $data->num_rows();
			//jika ada maka dia lebih dari nol
			if ($cek > 0) {
				//buat session
				$session = array(
					'id' => $d->id,
					'nama' => $d->nama,
					'status' => 'login'
				);
				//set sessionnya
				$this->session->set_userdata($session);
				//redirect jika benar
				redirect(base_url().'admin');
			}else{
				//jika gagal
				redirect(base_url().'welcome?pesan=gagal');
			}
		}else{
			$this->load->view('login');
		}
	}
}