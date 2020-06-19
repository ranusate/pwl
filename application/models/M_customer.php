<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Customer extends CI_Model
{

	var $table = "customer";
	var $primaryKey = "id";


	public function get($id = null)
	{
		$this->db->select('*');
		$this->db->from('customer');

		if ($id != null) {
			$this->db->where('id', $id);
		}
		$query =  $this->db->get();
		return $query;
	}

	public function getAll()
	{
		//hanya mengembalikan data yang is_active = 1
		// $this->db->where("is_active", 1);
		return $this->db->get($this->table)->result();
	}

	public function getByPrimaryKey($id)
	{
		$this->db->where($this->primaryKey, $id);
		return $this->db->get($this->table)->row();
	}
	public function delete($id)
	{
		return $this->db->where(array("id" => $id))->delete($this->table);
	}

	public function insert($post)
	{
		$params = array(
			'nama' => $post['nama'],
			'jk' => $post['jk'],
			'no_tlpn' => $post['no_tlpn'],
			'alamat' => $post['alamat']
		);
		$this->db->insert('customer', $params);
	}


	public function update($post)
	{
		$params = array(
			'nama' => $post['nama'],
			'jk' => $post['jk'],
			'no_tlpn' => $post['no_tlpn'],
			'alamat' => $post['alamat'],
			'updated' => date('Y-m-d H:i:s')
		);
		$this->db->where('id', $post['id']);
		$this->db->update('customer', $params);
	}
}
