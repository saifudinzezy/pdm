<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
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
		$data['lap'] = "active";
		//get data pengguna simpan di array pengguna
		$data['laporan'] = $this->m_crud->get_joindata_desc('pengguna', 'laporan.id')->result();
		$this->load->view('dashboard/header', $data);
		$this->load->view('dashboard/lap/laporan');
		$this->load->view('dashboard/footer');
	}	

	public function hapus($id)
	{
		$where = array(
			'id' => $id
		);
		$this->m_crud->delete_data($where, 'laporan');
		redirect(base_url().'laporan?pesan=success');
	} 

	public function update()
	{
		$data['user'] = "active";

		//get all data from form methode post
		$id = $this->input->post('id');
		$kode = $this->input->post('kode');
		$nama = $this->input->post('nama');
		$jns = $this->input->post('jns');
		$jml = $this->input->post('jml');
		$status = $this->input->post('status');
		$tanggal = $this->input->post('tanggal');

		//validation form
		$this->form_validation->set_rules('kode', 'Kode Daftar', 'required');
		$this->form_validation->set_rules('nama', 'Nama PCM', 'required');
		$this->form_validation->set_rules('jns', 'Jenis', 'required');
		$this->form_validation->set_rules('jml', 'Jumlah', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');

		//cek is form if null return false
		if ($this->form_validation->run() != false) { 
			$where = array(
				'id' => $id
			);

			$data = array(
				'kode_daftar' => $kode, 
				'nama_asset' => $nama, 
				'jenis_asset' => $jns, 
				'jml_asset' => $jml, 
				'status' => $status,
				'tanggal' => $tanggal
			);
			//insert data from table pengguna
			$this->m_crud->update_data($where, $data, 'laporan');			
			redirect(base_url().'laporan?pesan=update');
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

	/*public function noll()
	{
		$data['lap'] = $this->m_crud->get_joindata_desc('pengguna', 'pengguna.id')->result();

		foreach ($data['lap'] as $d) {
			print_r($d->nama);
			print_r($d->id);
			print_r($d->nama_asset);
			echo " | ";
			print_r($d->kode_daftar);
			echo "<br>";
		}
		// print_r($data);
	}*/	

	/*public function noll2()
	{
		$data['lap'] = $this->m_crud->get_alldata_nol('laporan', 'laporan.id')->result();

		foreach ($data['lap'] as $d) {
			print_r($d->nama);
			echo " | ";
			print_r($d->kode_daftar);
			echo "<br>";
		}
		// print_r($data);
	}*/
}
