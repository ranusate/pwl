<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_supplier extends CI_Model
{

	var $table = "supplier";
	var $primaryKey = "id";


	public function get($id = null)
	{
		$this->db->select('*');
		$this->db->from('supplier');
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
			'nama' => $post['sup_nam'],
			'no_tlpn' => $post['no'],
			'alamat' => $post['alamat'],
			'decripsi' => empty($post['decripsi']) ? null : $post['decripsi']

		);
		$this->db->insert('supplier', $params);
	}




	public function update($post)
	{
		$params = array(
 			'nama' => $post['sup_nam'],
			'no_tlpn' => $post['no'],
			'alamat' => $post['alamat'],
			'decripsi' => empty($post['decripsi']) ? null : $post['decripsi'],
			'updated' => date('Y-m-d H:i:s')
		);
		$this->db->where('id', $post['id']);
		$this->db->update('supplier', $params);
	}
}