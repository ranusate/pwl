<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_barang extends CI_Model
{
	var $table = "barang";
	var $primaryKey = "id_barang";

	public function get($id = null)
	{
		$this->db->select('barang.* , kategori.nama as kat');
		$this->db->from('barang');
		$this->db->join('kategori', 'kategori.id = barang.id_kategori');
		// $this->db->where("is_active", 1);



		
		if ($id != null) {
			$this->db->where('id_barang', $id);
		}
		$query =  $this->db->get();
		return $query;
	}


	// delete data
	public function deletebarang($id)
	{
		//hanya mengupdate is_active dari 1 menjadi 0
		$this->db->where($this->primaryKey, $id);
		return $this->db->update($this->table, array("is_active" => 0));
	}
	

	public function getByPrimaryKey($id)
	{
		$this->db->where($this->primaryKey, $id);
		return $this->db->get($this->table)->row();
	}




	public function delete($id)
	{
		return $this->db->where(array("id_barang" => $id))->delete($this->table);
	}



	public function sum($table, $field)
	{
		$this->db->select_sum($field);

		return $this->db->get($table)->row_array()[$field];
	}

	public function count($table)
	{
		return $this->db->count_all($table);
	}
	public function insert($post)
	{
		$params = array(
			'barcode' => $post['barcode'],
			'nama' => $post['nama_barang'],
			'id_kategori' => $post['kategori_id'],
			'harga' => $post['harga_barang'],
			'image' => $post['image']
		);
		$this->db->insert('barang', $params);
	}


	public function update($post)
	{
		$params =  [
			'barcode' => $post['barcode'],
			'nama' => $post['nama_barang'],
			'id_kategori' => $post['kategori_id'],
			'harga' => $post['harga_barang'],
			'updated' => date('Y-m-d H:i:s')
		];
		if ($post['image'] != null) {
			$params['image'] = $post['image'];
		}

		$this->db->where('id_barang', $post['id_barang']);
		$this->db->update('barang', $params);
	}

	function cek_barcode($code, $id = null)
	{
		$this->db->from('barang');
		$this->db->where('barcode', $code);
		if ($id != null) {
			$this->db->where('id_barang !=', $id);
		}
		$query = $this->db->get();
		return $query;
	}


	public function min($table, $field, $min)
	{
		$field = $field . ' <=';
		$this->db->where($field, $min);
		return $this->db->get($table)->result_array();
	}
	public function update_stok_in($data)
	{
		$qty = $data['qty'];
		$id = $data['id_barang'];
		$sql = "update barang set stock = stock + '$qty' where id_barang= '$id'";
		$this->db->query($sql);
	}

	public function update_stok_out($data)
	{
		$qty = $data['qty'];
		$id = $data['id_barang'];
		$sql = "update barang set stock = stock - '$qty' where id_barang= '$id'";
		$this->db->query($sql);
	}


	public function getBarangMasuk($limit = null, $id_barang = null, $range = null)
	{
		$this->db->select('*, barang.nama as namabarang');
		$this->db->from('stock');
		$this->db->join('barang', 'barang.id_barang = stock.id_barang');
		$this->db->where('type', "in");
		if ($limit != null) {
			$this->db->limit($limit);
		}

		$this->db->order_by('stock_id', 'DESC');
		// return $this->db->get('stock ')->result_array();
		$query = $this->db->get();
		return $query;
		// return $this->db->get('stock');
	}

	public function getBarangKeluar($limit = null, $id_barang = null, $range = null)
	{
		$this->db->select('*, barang.nama as namabarang');
		$this->db->from('stock');
		$this->db->join('barang', 'barang.id_barang = stock.id_barang');
		$this->db->where('type', "out");
		if ($limit != null) {
			$this->db->limit($limit);
		}

		$this->db->order_by('stock_id', 'DESC');
		// return $this->db->get('stock ')->result_array();
		$query = $this->db->get();
		return $query;
		// return $this->db->get('stock');
	}


	// Cari kode barcode scanner
	function get_data_barang_bykode($barcode)
	{
		$hsl = $this->db->query("SELECT * FROM barang WHERE barcode='$barcode'");
		if ($hsl->num_rows() > 0) {
			foreach ($hsl->result() as $data) {
				$hasil = array(
					'id_barang' => $data->id_barang,
					'barcode' => $data->barcode,
					'nama' => $data->nama,
					'id_kategori' => $data->id_kategori,
					'harga' => $data->harga,
					'stock' => $data->stock,
				);
			}
		}
		return $hasil;
	}


	public function chartBarangMasuk($bulan)
	{
		$like = 'T-BM-' . date('y') . $bulan;

		$this->db->like('stock_id', $like, 'after');
		return count($this->db->get('stock')->result_array());
	}
}
