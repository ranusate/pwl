<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		// check_not_login();
		// check_admin();
		// isLogin2();
		
		check_admin();
		$this->load->model('M_user');
		$this->load->library('form_validation');
	}
	public function index()
	{
		$listuser = $this->M_user->get()->result();
		$data = array(
			"page" => "user/user/v_list_user",
			"header" => "User",
			"judul" => "Data User",
			"users" => $listuser
		);
		$this->load->view('dashboard', $data);
	}
	public function tambah()
	{
		$this->form_validation->set_rules('fullname', 'Nama', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
		$this->form_validation->set_rules(
			'passconf',
			'Konfrimasi password',
			'required|matches[password]'
		);
		$this->form_validation->set_rules('level', 'Level', 'required');

		if ($this->form_validation->run() == false) {
			$listuser = $this->M_user->get()->result();
			$data = array(
				"page" => "user/v_list_user",
				"users" => $listuser
			);
			$this->load->view('dashboard', $data);
		} else {
			$post = $this->input->post(null, true);
			$this->M_user->insert($post);
			if ($this->db->affected_rows() > 0) {
				echo "<script>
				alert('Data berhasil disimpan');
				window.location='" . base_url('user') . "';
				</script>";
			}
		}
	}

	public function update($id)
	{
		$this->form_validation->set_rules('fullname', 'Nama', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required|callback_username_check');

		if ($this->input->post('password')) {
			$this->form_validation->set_rules('password', 'Password', 'min_length[5]');
			$this->form_validation->set_rules(
				'passconf',
				'Konfrimasi password',
				'required|matches[password]',
				array('matches' => '%s tidak sesuai denga password')
			);
		}

		if ($this->input->post('passconf')) {
			$this->form_validation->set_rules(
				'passconf',
				'Konfrimasi password',
				'matches[password]',
				array('matches' => '%s tidak sesuai denga password')
			);
		}
		$this->form_validation->set_rules('level', 'Level', 'required');
		$this->form_validation->set_rules('required', '%s masih kosong, silakan diisi');
		$this->form_validation->set_rules('min_length', '{field} minimail 5 karakter');
		$this->form_validation->set_error_delimiters('<span class="help block">', '</span>');
		if ($this->form_validation->run() == false) {
			$query = $this->M_user->get($id);
			if ($query->num_rows() > 0) {
				$listuser = $this->M_user->get()->row();
				$data['row'] = $query->result();
				$data = array(
					"page" => "user/v_edit_user",
					"users" => $listuser
				);
				$this->load->view('dashboard', $data);
			} else {
				echo "<script>
				alert('Data tidak ditemukan');
				window.location='" . base_url('user') . "';
				</script>";
			}
		} else {

			$post = $this->input->post(null, true);
			$this->M_user->update($post);
			if ($this->db->affected_rows() > 0) {
				echo "<script>
				alert('Data berhasil diupdate');
				window.location='" . base_url('user') . "';
				</script>";
			}
		}
	}



	public function username_check()
	{
		$post = $this->input->post(null, true);
		$query = $this->db->query("select * from user where username = '$post[username]' and user_id != '$post[user_id]'");
		if ($query->num_rows() > 0) {
			$this->form_validation->set_message('username_check', '{field} ini sudah dipakai, silakan ganti');
			return false;
		} else {
			return true;
		}
	}
	function delete()
	{
		$id = $this->input->post('user_id');
		$this->M_user->delete($id);
		if ($this->db->affected_rows() > 0) {
			echo "<script>
			alert('Data berhasil dihapus');
			window.location='" . base_url('user') . "';
			</script>";
		}
	}
}
