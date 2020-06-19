<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{

	var $table = "user";
	var $primaryKey = "user_id";

	public function login($post)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('username', $post['username']);
		$this->db->where('password', sha1($post['password']));
		$query =  $this->db->get();
		return $query;
	}

	public function get($id = null)
	{
		$this->db->select('*');
		$this->db->from('user');

		if ($id != null) {
			$this->db->where('user_id', $id);
		}
		$query =  $this->db->get();
		return $query;
	}

	public function insert($post)
	{
		$params['name'] = $post['fullname'];
		$params['username'] = $post['username'];
		$params['password'] = sha1($post['password']);

		$params['alamat'] = $post['alamat'] != "" ? $post['alamat'] : null;
		$params['level'] = $post['level'];
		$this->db->insert('user', $params);
	}


	public function delete($id)
	{
		return $this->db->where(array("user_id" => $id))->delete($this->table);
	}

	public function update($post)
	{
		$params['name'] = $post['fullname'];
		$params['username'] = $post['username'];
		if (!empty($post['password'])) {
			$params['password'] = sha1($post['username']);
		}
		$params['alamat'] = $post['alamat'] != "" ? $post['alamat'] : null;
		$params['level'] = $post['level'];
		$this->db->where('user_id', $post['user_id']);
		$this->db->update('user', $params);
	}
}
