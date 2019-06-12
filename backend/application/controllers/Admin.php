<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		//cek login 
		//jika tidak sama dengan login maka dia blm login
		if ($this->session->userdata('status') != 'login') {
			redirect(base_url().'welcome?pesan=belumlogin');
		}
	}
	
	//func keluar
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url().'welcome?pesan=logout');
	}

	public function index()
	{
		$data['laporan'] = $this->m_crud->get_limit_report('laporan', '2')->result();		
		$data['laporan2'] = $this->m_crud->get_limit_report('laporan', '1')->result();		
		$data['laporan3'] = $this->m_crud->get_limit_report('laporan', '0')->result();		
		$data['pengguna'] = $this->m_crud->get_data_desc('pengguna', 'id')->result();		
		$data['dash'] = "active";	
		$this->load->view('dashboard/header', $data);
		$this->load->view('dashboard/dashboard');
		$this->load->view('dashboard/footer');
	}

	public function tes()
	{
		$data['lap'] = $this->m_crud->get_limit_report('laporan', '1')->result();

		foreach ($data['lap'] as $d) {
			print_r(date("Y", strtotime($d->tanggal)));
			print_r($d->nama);
			echo "<br>";
		}
	}

	public function profile()
	{
		$data['admin'] = $this->m_crud->get_admin('admin')->result();
		$this->load->view('dashboard/header');
		$this->load->view('dashboard/admin/profile', $data);
		$this->load->view('dashboard/footer');	
	}

	public function profile_act()
	{				
		//get all data from form methode post
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$email = $this->input->post('email');
		$alamat = $this->input->post('alamat');

		//validation form
		$this->form_validation->set_rules('nama', 'Nama PDM', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');

		//cek is form if null return false
		if ($this->form_validation->run() != false) { 
			$where = array(
				'id' => $id
			);

			$data = array(
				'nama' => $nama, 
				'email' => $email, 
				'alamat' => $alamat
			);
			//insert data from table pengguna
			$this->m_crud->update_data($where, $data, 'admin');			
			redirect(base_url().'admin/profile?pesan=success');
		}else{
			$data['admin'] = $this->m_crud->get_admin('admin')->result();
			$this->load->view('dashboard/header');
			$this->load->view('dashboard/admin/profile', $data);
			$this->load->view('dashboard/footer');	
		}
	}

	public function akun()
	{
		$where = array(
			'id' => $this->session->userdata('id')
		);

		$data['admin'] = $this->m_crud->edit_data($where, 'admin')->result();
		$this->load->view('dashboard/header');
		$this->load->view('dashboard/admin/akun', $data);
		$this->load->view('dashboard/footer');	
	}

	public function akun_act()
	{
		$username = $this->input->post('username');
		$pass_baru = $this->input->post('pass_baru');
		$ulang_pass = $this->input->post('ulang_pass');

		//set form validasi untuk supaya di isi dan sama (matches) dengan ulang pass
		//The Password Baru field does not match the Ulangi Password Baru field.
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('pass_baru', 'Password Baru', 'required|matches[ulang_pass]');
		$this->form_validation->set_rules('ulang_pass', 'Ulangi Password Baru', 'required');

		//cek form
		if ($this->form_validation->run() != false) {
			$data = array(
				'password' => md5($pass_baru),
				'username' => $username
			);
			$w = array(
				'id' => $this->session->userdata('id')
			);

			$this->m_crud->update_data($w, $data, 'admin');
			redirect(base_url().'admin/akun?pesan=success');
		}else{
			$where = array(
			'id' => $this->session->userdata('id')
		);

		$data['admin'] = $this->m_crud->edit_data($where, 'admin')->result();
		$this->load->view('dashboard/header');
		$this->load->view('dashboard/admin/akun', $data);
		$this->load->view('dashboard/footer');	

		}
	}
}