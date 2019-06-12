<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pcm extends CI_Controller {

    public function index()
    {
		// $this->load->view('pcm/laporan');

		//get data from view
		$tahun = $this->input->post('tahun');
		$kode = $this->input->post('kode');

		//set valisation
		$this->form_validation->set_rules('tahun', 'Tahun', 'required');
		$this->form_validation->set_rules('kode', 'Kode', 'required');

		if ($this->form_validation->run() != false) {			
			$data['laporan'] = $this->db->query("SELECT * FROM laporan a INNER JOIN pengguna b ON a.kode_daftar = b.kode_daftar WHERE YEAR(a.tanggal) = '$tahun' AND a.kode_daftar = '$kode' GROUP BY a.kode_daftar")->result();

			$this->load->view('pcm/prints', $data);
		}else{
			$this->load->view('pcm/laporan');			
		}
    }   

    public function laporan_pdf(){

    $data = array(
        "dataku" => array(
            "nama" => "Petani Kode",
            "url" => "http://petanikode.com"
        )
    );

    $this->load->library('pdf');

    $this->pdf->setPaper('A4', 'potrait');
    $this->pdf->filename = "laporan-petanikode.pdf";
    $this->pdf->load_view('laporan_pdf', $data);


	} 
}