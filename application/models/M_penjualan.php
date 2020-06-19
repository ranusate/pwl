<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_penjualan extends CI_Model
{
	public function invoice_no()
	{
		$sql = "SELECT Max(MID(invoice,9,4)) AS invoice_no
		FROM penjualan
		WHERE MID(invoice,3,6) = DATE_FORMAT(CURDATE(),'%y%m%d')";

		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$row = $query->row();
			$n = (((int) $row->invoice_no) + 1);

			$no = sprintf("%'.04d", $n);
		} else {
			$no = "0001";
		}
		$invoice = "TRX" . date('ymd') . $no;
		return $invoice;
	}

	public function add_cart($post)
	{
		$this->db->select_max('id_cart');
		$query = $this->db->get('cart');

		if ($query->num_rows() > 0) {
			$row = $query->row();
			$no = ((int) $row->id_cart) + 1;
		} else {
			$no = "1";
		}

		$params = array(
			'id_cart' => $no,
			'id_barang' => $post['id_barang'],
			'harga' => $post['harga'],
			'qty' => $post['qty'],
			'total' => ($post['harga'] * $post['qty']),
			'id_user' => $this->session->userdata('id_user_pwl')
		);
		$this->db->insert('cart', $params);
	}

	public function get_cart($params = null)
	{
		$this->db->select('*,barang.nama as b_nama , barang.stock as stocks, cart.harga as c_harga');
		$this->db->from('cart');
		$this->db->join('barang', 'cart.id_barang = barang.id_barang');

		if ($params != null) {
			$this->db->where($params);
		}
		$this->db->where('id_user', $this->session->userdata('id_user_pwl'));
		$query = $this->db->get();
		return $query;
	}


	public function del_cart($params = null)
	{
		if ($params != null) {
			$this->db->where($params);
		}
		$this->db->delete('cart');
	}


	public function update_cart_qty($post)
	{
		$sql = "update cart set harga ='$post[harga]',
				qty = qty + '$post[qty]',
				total = '$post[harga]' * qty
				where id_barang = '$post[id_barang]'";
		$this->db->query($sql);
	}

	public function edit_cart($post)
	{
		$params = array(
			'harga' => $post['harga'],
			'qty' => $post['qty'],
			'discount_barang' => $post['discount'],
			'total' => $post['total']
		);
		$this->db->where('id_cart', $post['id_cart']);
		$this->db->update('cart', $params);
	}

	public function add_transaksi($post)
	{
		$max = getLastNomor("penjualan")->nomor + 1;
		$noTransaksi = autoCreate(array("TRX"), "/", $max);


		$params = array(
			'invoice' => $noTransaksi,
			'id_customer' => $post['id_customer'] == "" ? null : $post['id_customer'],
			'total_harga' => $post['subtotal'],
			'discount' => $post['discount'],
			'final_harga' => $post['grandtotal'],
			'cash' => $post['cash'],
			'remaining' => $post['change'],
			'note' => $post['note'],
			'date' => $post['date'],
			'id_user' => $this->session->userdata('id_user_pwl'),
			'nomor' => $max,
		);

		$this->db->insert('penjualan', $params);
		return $this->db->insert_id();
	}

	public function add_transaksi_tunda($post)
	{
		$max = getLastNomorTunda("transaksi_tunda")->nomor + 1;
		$noTransaksi = autoCreate(array("TRX"), "/", $max);

		$params = array(
			'no_tunda' => $noTransaksi,
			// 'id_customer' => $post['id_customer'] == "" ? null : $post['id_customer'],
			'id_user' => $this->session->userdata('id_user_pwl'),
			'tgl_transaksi' => date("Y-m-d H:i:s"),
			'nomor' => $max

		);

		$this->db->insert('transaksi_tunda', $params);
		return $this->db->insert_id();
	}

	public function delete_tundatransaksi($params = null)
	{
		if ($params != null) {
			$this->db->where($params);
		}
		return $this->db->delete('transaksi_tunda');
	}

	public function delete_tundaitemtransaksi($params = null)
	{
		if ($params != null) {
			$this->db->where($params);
		}
		return $this->db->delete('cart_tunda');
	}

	function get_data_barang_bykode($id)
	{
		$this->db->select('*');
		$this->db->from('cart_tunda');
		$this->db->where('id_trans_tunda', $id);
		$hasil = $this->db->get()->result();
		return $hasil;
	}


	function add_transaksi_detail_tunda($params)
	{
		$this->db->insert_batch('cart_tunda', $params);
	}

	function insertBatchTundaTransaksi($params)
	{
		$this->db->insert_batch('cart', $params);
	}


	function add_transaksi_detail($params)
	{
		$this->db->insert_batch('detail_transaksi', $params);
	}


	function get_transaksi($id = null)
	{
		$this->db->select('*, customer.nama as cusnama, users.nama_user as usname,
							penjualan.created as pencre');
		$this->db->from('penjualan');
		$this->db->join('customer', 'penjualan.id_customer = customer.id', 'left');

		$this->db->join('users', 'penjualan.id_user = users.id_user');
		if ($id != null) {
			$this->db->where('p_id', $id);
		}
		$query = $this->db->get();
		return $query;
	}


	function get_transaksi_detail($id_penjualan = null)
	{

		$this->db->from('detail_transaksi');
		$this->db->join('barang', 'detail_transaksi.id_barang = barang.id_barang');
		if ($id_penjualan != null) {
			$this->db->where('detail_transaksi.id_penjualan', $id_penjualan);
		}
		$query = $this->db->get();
		return $query;
	}
}
