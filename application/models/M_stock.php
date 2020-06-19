<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_stock extends CI_Model
{
	var $table = "stock";
	var $primaryKey = "id_stock";


	public function get($id = null)
	{
		$this->db->from('stock');
		if ($id != null) {
			$this->db->where('stock_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function delete($id)
	{
		return $this->db->where(array("stock_id" => $id))->delete($this->table);
	}


	public function getAll()
	{
		$this->db->select('stock.stock_id, barang.barcode, barang.nama as namabrg, qty , date, detail, supplier.nama as supplier,barang.id_barang');
		$this->db->from('stock');
		$this->db->join('barang', 'barang.id_barang = stock.id_barang');
		$this->db->join('supplier', 'supplier.id = stock.supplier_id', 'left');
		$this->db->where('type', 'in');
		// if ($id != null) {
		// 	$this->db->where('id_barang', $id);
		// }
		$query =  $this->db->get();
		return $query;
	}

	public function stock_in($post)
	{


		$params =  array(
			'id_barang' => $post['id_barang'],
			'type' => 'in',
			'detail' => $post['detail'],
			'supplier_id' => $post['supplier'] == '' ? null : $post['supplier'],
			'qty' => $post['qty'],
			'date' => $post['date'],

			

			// 'user_id' => $this->session->userdata('userid')
		);

		$this->db->insert('stock', $params);
	}




	public function getAllStockout()
	{
		$this->db->from('stock');
		$this->db->join('barang', 'barang.id_barang = stock.id_barang');
		$this->db->where('type', 'out');
		// if ($id != null) {
		// 	$this->db->where('id_barang', $id);
		// }
		$query =  $this->db->get();
		return $query;
	}


	public function insert_stock_out($post)
	{
		$params =  array(
			'id_barang' => $post['id_barang'],
			'type' => 'out',
			'detail' => $post['detail'],
			'qty' => $post['qty'],
			'date' => $post['date'],
			// 'user_id' => $this->session->userdata('userid')
		);

		$this->db->insert('stock', $params);
	}
}