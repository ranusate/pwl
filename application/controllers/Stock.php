<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stock extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		// check_not_login();
		//check_admin();
		$this->load->model('M_supplier');
		$this->load->model('M_stock');
		$this->load->model('M_kategori');
		$this->load->model(['M_barang', 'M_supplier']);
	}
	public function stock_in()
	{
		$stock = $this->M_stock->getAll()->result();

		$data = array(
			"page" => "transaksi/stockin/v_stock_in",
			"stocks" => $stock,
			"judul" => "Stockin",
			"header" => "Stockin"
		);
		$this->load->view('dashboard', $data);
	}
	public function stock_in_add()
	{
		$suplier = $this->M_supplier->get()->result();
		$barang = $this->M_barang->get()->result();
		$data = array(
			"page" => "transaksi/stockin/v_stock_edit",
			"sups" => $suplier,
			"judul" => "Stockin | Add",
			"header" => "Stockin | Add",
			"barangs" => $barang
		);

		$this->load->view('dashboard', $data);
	}
	public function proses()
	{
		if (isset($_POST['in_add'])) {


			$post = $this->input->post(null, true);


			$this->M_stock->stock_in($post);

			
			$this->M_barang->update_stok_in($post);


			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('succes', ' berhasil disimpan');
			}
			redirect('stock/in');



		} else if (isset($_POST['out_add'])) {
			$post = $this->input->post(null, true);
			$row_barang =  $this->M_barang->get($this->input->post('id_barang'))->row();

			if ($row_barang->stock < $this->input->post('qty')) {
				$this->session->set_flashdata('error', 'Jumlah barang yang dihapus melebihi stock');
				redirect('stock/out/add');
			} else {
				$this->M_stock->insert_stock_out($post);
				$this->M_barang->update_stok_out($post);

				if ($this->db->affected_rows() > 0) {
					// $this->session->set_flashdata('succes', 'Data berhasil disimpan');
					$this->session->set_flashdata('succes', ' berhasil disimpan');
				}
				redirect('stock/out');
			}
		}
	}


	public function stock_in_delete()
	{
		$stock_id = $this->uri->segment(4);
		$id_barang = $this->uri->segment(5);

		$qty = $this->M_stock->get($stock_id)->row()->qty;
		$data = ['qty' => $qty, 'id_barang' => $id_barang];

		$this->M_barang->update_stok_out($data);
		$this->M_stock->delete($stock_id);
		if ($this->db->affected_rows() > 0) {

			$this->session->set_flashdata('succes', ' berhasil dihapus');
		}
		redirect('stock/in');
	}

	//---------------proses out

	public function stock_out()
	{
		$stock = $this->M_stock->getAllStockout()->result();
		$data = array(
			"page" => "transaksi/stockout/v_list_stockout",
			"stocks" => $stock,
			"judul" => "Stockout | Add",
			"header" => "Stockout | Add",
		);
		$this->load->view('dashboard', $data);
	}

	public function stock_out_add()
	{
		$barang = $this->M_barang->get()->result();
		$data = array(
			"page" => "transaksi/stockout/v_form_stockout",
			"barangs" => $barang,
			"judul" => "Stockout",
			"header" => "Stockout | Add",
		);
		$this->load->view('dashboard', $data);
	}

	public function stock_out_delete()
	{
		$stock_id = $this->uri->segment(4);
		$id_barang = $this->uri->segment(5);

		$qty = $this->M_stock->get($stock_id)->row()->qty;

		$data = ['qty' => $qty, 'id_barang' => $id_barang];
		$this->M_barang->update_stok_in($data);
		$this->M_stock->delete($stock_id);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('succes', ' berhasil dihapus');
		}
		redirect('stock/out');
	}
}
