<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function index()
	{
		// check_not_login();
		// check_already_login();
		$this->load->view('authku/login');
	}
	public function proses_login()
	{
		$post =  $this->input->post(null, true);

		if (isset($post['login'])) {
			$this->load->model('M_user');

			$query = $this->M_user->login($post);
			if ($query->num_rows() > 0) {
				$row =  $query->row();
				
				$params  = array(
					'userid' => $row->user_id,
					'level' => $row->level
				);

				$this->session->set_userdata($params);
				echo "<script>
				alert('selamat, Login berhasi');
				window.location='" . base_url('dashboard') . "';
				</script>";
				
			} else {
				echo "<script>
				alert('Login gagal');window.location='" . base_url('auth') . "';
				</script>";
			}
		}
	}
	public function logout()
	{
		$params = array('userid', 'level');
		$this->session->unset_userdata($params);
		redirect('auth');
	}
}
