<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_kategori extends CI_Model
{

	var $table = "kategori";
	var $primaryKey = "id";


	public function get($id = null)
	{
		$this->db->select('*');
		$this->db->from('kategori');
		if ($id != null) {
			$this->db->where('id', $id);
		}
		$query =  $this->db->get();
		return $query;
	}

	public function delete($id)
	{
		return $this->db->where(array("id" => $id))->delete($this->table);
	}

	public function insert($post)
	{
		$params = array(
			'nama' => $post['nama']
		);
		$this->db->insert('kategori', $params);
	}


	public function update($post)
	{
		$params = array(
			'nama' => $post['nama'],
			'updated' => date('Y-m-d H:i:s')
		);
		$this->db->where('id', $post['id']);
		$this->db->update('kategori', $params);
	}
}