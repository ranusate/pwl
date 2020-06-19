<?php
defined('BASEPATH') or exit('No direct script access allowed');

class App extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		// check_not_login();
		// check_admin();
		// is_logged_in();
		isLogin2();
		$this->load->model('M_barang');
		$this->load->model('M_customer');
		$this->load->model('M_penjualan');
	}
	public function index()
	{
		$cart =  $this->M_penjualan->get_cart()->result();
		$barang =  $this->M_barang->get()->result();
		$cus =  $this->M_customer->get()->result();
		$data = array(
			"header" => "APP ",
			"judul" => "App Transaksi",
			"page" => "app/v_form_app",
			"barangs" => $barang,
			"customer" => $cus,
			"carts" => $cart,
			"invoice" => $this->M_penjualan->invoice_no()
		);
		$this->load->view('dashboard', $data);
	}
	function cart_data()
	{
		$cart =  $this->M_penjualan->get_cart()->result();
		$data = array(
			'carts' => $cart
		);
		$this->load->view('app/v_cart', $data);
	}

	function get_barang()
	{
		$kode = $this->input->post('barcode');
		$data = $this->M_barang->get_data_barang_bykode($kode);
		echo json_encode($data);
	}

	public function proses()
	{
		$data = $this->input->post(null, true);
		if (isset($_POST['proses_hold'])) {
			$trans_id = $this->M_penjualan->add_transaksi_tunda($data);
			$cart = $this->M_penjualan->get_cart()->result();
			$row = [];
			foreach ($cart as $c => $value) {
				array_push(
					$row,
					array(
						'id_trans_tunda' => $trans_id,
						'harga_tunda' => $value->harga,
						'discount_tunda' => $value->discount_barang,
						'total_tunda' => $value->total,
						'id_barang' => $value->id_barang,
						'qty_tunda' => $value->qty,
					)
				);
			}

			$this->M_penjualan->add_transaksi_detail_tunda($row);

			$this->M_penjualan->del_cart(['id_user' => $this->session->userdata('id_user_pwl')]);

			if ($this->db->affected_rows() > 0) {

				// $params = array('success' => true, 'id_penjualan' => $trans_id);

				$params = array('success' => true);
			} else {

				$params = array('success' => false);
			}

			echo json_encode($params);
		}

		if (isset($_POST['add_cart'])) {
			$idbarang = $this->input->post('id_barang');
			$check_cart = $this->M_penjualan->get_cart(['cart.id_barang' => $idbarang])->num_rows();



			if ($check_cart > 0) {
				$this->M_penjualan->update_cart_qty($data);
			} else {

				$this->M_penjualan->add_cart($data);
			}

			if ($this->db->affected_rows() > 0) {

				$params = array('success' => true);
			} else {

				$params = array('success' => false);
			}
			echo json_encode($params);
		}

		if (isset($_POST['edit_cart'])) {
			$this->M_penjualan->edit_cart($data);

			if ($this->db->affected_rows() > 0) {
				$params = array('success' => true);
			} else {
				$params = array('success' => false);
			}
			echo json_encode($params);
		}

		if (isset($_POST['proses_bayar'])) {

			$trans_id = $this->M_penjualan->add_transaksi($data);
			$cart = $this->M_penjualan->get_cart()->result();
			$row = [];

			foreach ($cart as $c => $value) {
				array_push(
					$row,
					array(
						'id_penjualan' => $trans_id,
						'id_barang' => $value->id_barang,
						'harga' => $value->harga,
						'qty' => $value->qty,
						'discount_barang' => $value->discount_barang,
						'total' => $value->total
					)
				);
			}
			$this->M_penjualan->add_transaksi_detail($row);

			$this->M_penjualan->del_cart(['id_user' => $this->session->userdata('id_user_pwl')]);

			if ($this->db->affected_rows() > 0) {
				$params = array('success' => true, 'id_penjualan' => $trans_id);
			} else {

				$params = array('success' => false);
			}
			echo json_encode($params);
		}
	}


	public function cart_del()
	{
		if (isset($_POST['proses_cancel'])) {
			$this->M_penjualan->del_cart(['id_user' => $this->session->userdata('id_user_pwl')]);
		} else {
			$id_cart = $this->input->post('id_cart');
			$this->M_penjualan->del_cart(['id_cart' => $id_cart]);
		}
		if ($this->db->affected_rows() > 0) {

			$params = array('success' => true);
		} else {

			$params = array('success' => false);
		}
		echo json_encode($params);
	}

	public function cetak_nota($id)
	{
		$pen = $this->M_penjualan->get_transaksi($id)->row();
		$det = $this->M_penjualan->get_transaksi_detail($id)->result();
		$data = array(
			"penjualan" => $pen,
			"detail" => $det
		);

		$this->load->view('transaksi/cetak_nota/v_print_nota_transaksi', $data);
	}


	//Proses TRANSAKSI dari Tunda
	public function prosesTunda()
	{
		$id = $this->input->post("id_trans_tunda");

		$keranjang = $this->M_penjualan->get_data_barang_bykode($id);
		// $index = 0;
		$row = [];

		foreach ($keranjang as $k => $value) {
			array_push(
				$row,
				array(
					'id_cart' => $value->id_cart_tunda,
					'id_barang' => $value->id_barang,
					'harga' => $value->harga_tunda,
					'qty' => $value->qty_tunda,
					'discount_barang' => $value->qty_tunda,
					'total' => $value->total_tunda,
					'id_user' => $this->session->userdata('id_user_pwl')
				)
			);
		}

		$this->M_penjualan->insertBatchTundaTransaksi($row);

		$this->M_penjualan->delete_tundaitemtransaksi(['id_trans_tunda' => $id]);

		$this->M_penjualan->delete_tundatransaksi(['id_trans_tunda' => $id]);




		if ($this->db->affected_rows() > 0) {
			$keranjang = array("success" => true);
		} else {
			$keranjang = array("success" => false);
		}
		echo json_encode($keranjang);
	}
	// Get data item transaksi tunda
	function get_data_barang_bykode($id)
	{
		$this->db->select('*');
		$this->db->from('item_transaksi_tunda');
		$this->db->where('id_transaksi_tunda', $id);
		$hasil = $this->db->get()->result();
		return $hasil;
	}
}
