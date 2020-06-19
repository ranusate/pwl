<?php

class Fungsi
{
	protected $ci;
	function __construct()
	{
		$this->ci = &get_instance();
	}

	function user_login()
	{
		$this->ci->load->model('M_user');
		$user_id = $this->ci->session->userdata('userid');
		$user_data = $this->ci->M_user->get($user_id)->row();
		return $user_data;
	}


	

	
	function user_login1()
	{
		$this->ci->load->model('UserModel');
		$user_id = $this->ci->session->userdata('id_user_pwl');
		$user_data = $this->ci->UserModel->getByPrimaryKey($user_id);
		return $user_data;
	}


	function pfdGenerator($html, $filename, $paper, $orientation)
	{
		// reference the Dompdf namespace
		// instantiate and use the dompdf class
		$dompdf = new Dompdf\Dompdf();

		$dompdf->loadHtml($html);

		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper($paper, $orientation);

		// Render the HTML as PDF
		$dompdf->render();
		// Output the generated PDF to Browser
		$dompdf->stream($filename, array('Attachment' => 0));
	}






	function pfdGenerator1($html, $filename)
	{
		// reference the Dompdf namespace
		// instantiate and use the dompdf class
		$dompdf = new Dompdf\Dompdf();

		$dompdf->loadHtml('Hello word');

		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('A4', 'landscape');

		// Render the HTML as PDF
		$dompdf->render();
		// Output the generated PDF to Browser
		$dompdf->stream($filename, array('Attachment' => 0));
	}


	
	public function hitungbarang()
	{
		$this->ci->load->model('M_barang');
		return $this->ci->M_barang->get()->num_rows();
	}


	public function hitunguser()
	{
		$this->ci->load->model('M_user');
		return $this->ci->M_user->get()->num_rows();
	}

	public function hitungcus()
	{
		$this->ci->load->model('M_customer');
		return $this->ci->M_customer->get()->num_rows();
	}

	public function hitungsup()
	{
		$this->ci->load->model('M_supplier');
		return $this->ci->M_supplier->get()->num_rows();
	}
}
