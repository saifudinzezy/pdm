<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CetakLap extends CI_Controller {
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
		$data['cetak'] = "active";	
        //get data from view
		$tahun = $this->input->post('tahun');

		//set valisation
		$this->form_validation->set_rules('tahun', 'Tahun', 'required');

		if ($this->form_validation->run() != false) {
			$data['laporan'] = $this->m_crud->get_yeardata('laporan', $tahun)->result();
			$data['tahun'] = $this->db->query("SELECT DISTINCT tahun FROM laporan ORDER BY laporan.tahun DESC")->result();

        	$this->load->view('dashboard/header', $data);
        	$this->load->view('dashboard/lap/listcetaklap');
			$this->load->view('dashboard/footer');	
		}else{
			// $data['tahun'] = $this->m_crud->get_data('laporan', 'tahun')->result();
			$data['tahun'] = $this->db->query("SELECT DISTINCT tahun FROM laporan ORDER BY laporan.tahun DESC")->result();
        	$this->load->view('dashboard/header', $data);
        	$this->load->view('dashboard/lap/cetaklap');
		}
    }

    public function prints()
    {
    	$tahun = $this->input->get('tahun');
    	$data['tahun'] = $tahun;
    	$data['laporan'] = $this->db->query("SELECT * FROM laporan a INNER JOIN pengguna b ON a.kode_daftar = b.kode_daftar WHERE YEAR(a.tanggal) = '$tahun' GROUP BY a.kode_daftar")->result();

    	$this->load->view('dashboard/lap/lapprint', $data);
    }

    public function printspdf()
    {
    	$tahun = $this->input->post('tahun');
    	$data['tahun'] = $tahun;
    	$data['laporan'] = $this->db->query("SELECT * FROM laporan a INNER JOIN pengguna b ON a.kode_daftar = b.kode_daftar WHERE YEAR(a.tanggal) = '$tahun' GROUP BY a.kode_daftar")->result();    	
		$this->load->view('dashboard/lap/lappdf', $data);

    	$this->load->library('pdf');

    	//konversi ke file pdf
		$paper_size = 'A4'; //ukuran kertas
		$orientation = 'potrait'; //tipe format kertas potrait atau landscape

		$html = $this->output->get_output();

		$this->pdf->set_paper($paper_size, $orientation); ////Convert to PDF
		$this->pdf->load_html($html);
		$this->pdf->render();
		$this->pdf->stream("laporan.pdf", array('Attachment' => 0)); // nama file pdf yang di hasilkan
    }

    public function noll()
	{
		$data['lap'] = $this->m_crud->get_data('laporan', 'tahun')->result();

		foreach ($data['lap'] as $d) {
			// print_r(date("Y", strtotime($d->tahun)));
			print_r($d->tahun);
			echo "<br>";
		}
		// print_r($data);
	}

	public function printlap()
	{
		$data['lap'] = $this->db->query("SELECT * FROM laporan a INNER JOIN pengguna b ON a.kode_daftar = b.kode_daftar WHERE YEAR(a.tanggal) = '2018' GROUP BY a.kode_daftar")->result();

        foreach ($data['lap'] as $d) {			
			print_r($d->nama);
			echo "<br>";
			$datas['laps'] = $this->m_crud->get_datas('laporan', '2019', 'PCMPKL-8')->result();
			 foreach ($datas['laps'] as $ds) {	
			 	print_r($datas);
			 }
		}
		// print_r($data);
	}

	public function noll2()
	{
		$data['lap'] = $this->m_crud->get_datas('laporan', '2019', 'PCMPKL-8')->result();

		foreach ($data['lap'] as $d) {
			print_r(date("Y", strtotime($d->tanggal)));
			print_r($data);
			echo "<br>";
		}
	}
}