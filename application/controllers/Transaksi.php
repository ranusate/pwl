<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
	function __construct()
	{

		parent::__construct();
		// check_not_login();
		// check_admin();
		$this->load->model('M_barang');
		$this->load->model('M_customer');
		$this->load->model('M_penjualan');
		$this->load->model('M_transaksi');
	}

	public function index()
	{
		$detail = $this->M_transaksi->getAllDetail();
		$detailtrans = $this->M_transaksi->getAll();

		$data = array(
			"header" => "Transaksi",
			"judul" => "List Transaksi",
			"page" => "transaksi/v_list_transaksi",
			"trs" => $detailtrans,
			"detail" => $detail

		);

		$this->load->view('dashboard', $data);
	}	
	public function getTrsantunda()
	{
		$detail = $this->M_transaksi->getAllDetail();
		$detailtrans = $this->M_transaksi->getAllTransTunda();

		$data = array(
			"header" => "Transaksi Tunda",
			"judul" => "List Transaksi Tunda",
			"page" => "transaksi/v_transaksi_tunda",
			"trs" => $detailtrans,
			"detail" => $detail

		);

		$this->load->view('dashboard', $data);
	}

	
	public function detail($id)
	{
		$detail = $this->M_transaksi->get_transaksi_detail($id)->result();
		$data = array(
			"header" => "Detail Transaksi",
			"judul" => "Detail Transaksi",
			"page" => "transaksi/v_detail_transaksi",
			"detail" => $detail

		);

		$this->load->view('dashboard', $data);
	}



	function detail_print($id)
	{
		$detail = $this->M_transaksi->get_transaksi_detail($id)->result();
		$data = array(
			//	"page" => "master/barang/barcode_print",
			"header" => "Detail Print",
			//"judul" => "Barcode Barang",
			"detail" => $detail,
		);
		$html = $this->load->view('transaksi/cetak_nota/print_detail', $data, true);
		$this->fungsi->pfdGenerator($html, 'Nama ', 'A4', 'landscape');


	}
	function laporan()
	{
		$detail = $this->M_transaksi->get_transaksi_detail()->result();
		$data = array(
			//	"page" => "master/barang/barcode_print",
			"header" => "Detail Print",
			//"judul" => "Barcode Barang",
			"detail" => $detail,
		);
		$html = $this->load->view('transaksi/cetak_nota/print_detail', $data, true);
		$this->fungsi->pfdGenerator($html, 'Nama ', 'A4', 'landscape');


	}
}
