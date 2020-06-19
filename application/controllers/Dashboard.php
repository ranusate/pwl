<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		isLogin2();
		// check_not_login();
		$this->load->model('M_barang');
		$this->load->model('M_transaksi');
		$this->load->library('form_validation');
		$this->load->model('M_penjualan');
	}

	public function index()
	{
		$barangm= $this->M_barang->getBarangMasuk(5)->result_array();
		$barangk= $this->M_barang->getBarangKeluar(5)->result_array();
		$laris= $this->M_transaksi->laris();

		$tras = $this->M_transaksi->getJoin();

		
		$stock = $this->M_barang->sum('barang', 'stock');		
		$barang_min = $this->M_barang->min('barang', 'stock', 10);
		$data = array(
			"page" => "dashboard/blank",
			"header" => "Dashboard",
			"judul" => " Dashboard",
			"detail" => $tras,
			"stock" => $stock,
			"barangm" => $barangm,
			"barangk" => $barangk,
			"laris" => $laris,
			"barang_min" => $barang_min
		);
		$this->load->view('dashboard', $data);
	}
	public function blocked()
	{
			$data = array(
			"page" => "auth/blocked",
			"header" => "Dashboard",
			"judul" => " Dashboard",
			);
		$this->load->view('dashboard', $data);
	}
}
