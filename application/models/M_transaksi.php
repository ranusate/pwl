<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_transaksi extends CI_Model
{

	var $table = "penjualan";
	var $primaryKey = "p_id";
	var $table1 = "transaksi_tunda";
	var $primaryKey1 = "id_trans_tunda";


	public function getAll()
	{
		$this->db->select('*, customer.nama as cusnama, user.username as usname,
		penjualan.created as pencre');
		$this->db->from('penjualan');
		// $this->db->join('detail_transaksi','penjualan.id_detail = detai_transaksi.id_detail', 'left');
		$this->db->join('customer', 'penjualan.id_customer = customer.id', 'left');
		$this->db->join('user', 'penjualan.id_user = user.user_id', 'left');
		$this->db->order_by('date', "%Y%m%d");
		$query = $this->db->get()->result();
		return $query;
	}



	function get_transaksi_detail($id_penjualan = null)
	{
		$this->db->select('*, barang.nama as nama_barang');
		$this->db->from('detail_transaksi');
		$this->db->join('barang', 'detail_transaksi.id_barang = barang.id_barang');
		$this->db->join('penjualan', 'penjualan.p_id = detail_transaksi.id_penjualan');





		if ($id_penjualan != null) {
			$this->db->where('detail_transaksi.id_penjualan', $id_penjualan);
		}







		$query = $this->db->get();
		return $query;
	}


	public function getAllDetail($id = null)
	{
		$this->db->select('stock.stock_id, barang.barcode, barang.nama as namabrg, qty , date, detail, supplier.nama as supplier,barang.id_barang');
		$this->db->from('detail_transaksi');
		$this->db->join('barang', 'barang.id_barang = stock.id_barang');
		$this->db->join('supplier', 'supplier.id = stock.supplier_id', 'left');



		
		if ($id != null) {
			$this->db->where('id_barang', $id);
		}
		$query =  $this->db->get();
		return $query;
	}


	public function getAllTransTunda()
	{
		return $this->db->get($this->table1)->result();
	}


	public function getJoin($date1 = null, $date2 = null)
	{
		$this->db->select('penjualan.*, MONTH(date) as bulan, SUM(total_harga) AS totals');
		$this->db->group_by('MONTH(date)');
		return $this->db->get($this->table)->result();
	}


	public function laris()
	{
		$data = $this->db->select('*, b.nama as namabarang, SUM(qty) as totalas , sum(total) as hargatotal')
			->from('detail_transaksi dt')
			->join("barang b", 'dt.id_barang = b.id_barang')
			->order_by('totalas', 'desc')
			->limit(5)
			->group_by('dt.id_barang')
			->get()->result();
		return $data;
	}
}
