<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		//cek login 
		//jika tidak sama dengan login maka dia blm login
		if ($this->session->userdata('status') != 'login') {
			redirect(base_url().'welcome?pesan=belumlogin');
		}
	}

	public function index()
	{
		$data['user'] = "active";
		//get data pengguna simpan di array pengguna
		$data['pengguna'] = $this->m_crud->get_data_desc('pengguna', 'id')->result();
		$this->load->view('dashboard/header', $data);
		$this->load->view('dashboard/user/user');
		$this->load->view('dashboard/footer');
	}

	public function add()
	{
		$data['user'] = "active";
		$data['kode'] = $this->kode();

		$this->load->view('dashboard/header', $data);
		$this->load->view('dashboard/user/add');
		$this->load->view('dashboard/footer');	
	}

	public function add_act()
	{
		$data['user'] = "active";
		$data['kode'] = $this->kode();		

		//get all data from form methode post
		$nomer = $this->input->post('nomer');
		$pcm = $this->input->post('pcm');
		$email = $this->input->post('email');
		$alamat = $this->input->post('alamat');
		$password = $this->input->post('password');

		//validation form
		$this->form_validation->set_rules('nomer', 'Nomer Daftar', 'required');
		$this->form_validation->set_rules('pcm', 'Nama PCM', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		//cek is form if null return false
		if ($this->form_validation->run() != false) { 
			$data = array(
				'kode_daftar' => $nomer, 
				'nama' => $pcm, 
				'email' => $email, 
				'alamat' => $alamat, 
				'password' => $password
			);
			//insert data from table pengguna
			$this->m_crud->insert_data($data, 'pengguna');			
			redirect(base_url().'user/add?pesan=success');
		}else{
			$this->load->view('dashboard/header', $data);
			$this->load->view('dashboard/user/add');
			$this->load->view('dashboard/footer');	
		}
	}

	public function update()
	{
		$data['user'] = "active";

		//get all data from form methode post
		$id = $this->input->post('id');
		$nomer = $this->input->post('nomer');
		$pcm = $this->input->post('pcm');
		$email = $this->input->post('email');
		$alamat = $this->input->post('alamat');
		$password = $this->input->post('password');

		//validation form
		$this->form_validation->set_rules('nomer', 'Nomer Daftar', 'required');
		$this->form_validation->set_rules('pcm', 'Nama PCM', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		//cek is form if null return false
		if ($this->form_validation->run() != false) { 
			$where = array(
				'id' => $id
			);

			$data = array(
				'kode_daftar' => $nomer, 
				'nama' => $pcm, 
				'email' => $email, 
				'alamat' => $alamat, 
				'password' => $password
			);
			//insert data from table pengguna
			$this->m_crud->update_data($where, $data, 'pengguna');			
			redirect(base_url().'user?pesan=update');
		}else{
			$where = array(
				'id' => $id
			);
			//ambil data dari db dan masukan di variabel mobil
			$data['pengguna'] = $this->m_crud->edit_data($where, 'pengguna')->result();
			$this->load->view('dashboard/header', $data);
			$this->load->view('dashboard/user/edit');
			$this->load->view('dashboard/footer');					
		}
	}

	public function edit($id)
	{
		$data['user'] = "active";
		$where = array(
			'id' => $id 
		);

		$data['pengguna'] = $this->m_crud->edit_data($where, 'pengguna')->result();
		$this->load->view('dashboard/header', $data);
		$this->load->view('dashboard/user/edit');
		$this->load->view('dashboard/footer');
	}

	public function kode()
	{
		$data = $this->m_crud->get_kode_daftar('pengguna')->row();		
		$value = $data->kode + 1;
		print_r($value);
		return $value;
	}

	public function hapus($id)
	{
		$where = array(
			'id' => $id
		);
		$this->m_crud->delete_data($where, 'pengguna');
		redirect(base_url().'user?pesan=success');
	} 
}
