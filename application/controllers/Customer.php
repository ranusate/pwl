<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		//check_not_login();
		//check_admin();
		
		check_admin();
		$this->load->model('M_customer');
		$this->load->library('form_validation');
	}
	public function index()
	{
		$listSup = $this->M_customer->getAll();
		$data = array(
			"page" => "customer/v_list_customer",
			"header" => "Customer",
			"judul" => "Data Customer",
			"customers" => $listSup
		);
		$this->load->view('dashboard', $data);
	}
	public function delete($id)
	{
		$this->M_customer->delete($id);
		$error = $this->db->error();

		if ($error['code'] != 0) {
			// echo "<script>
			// alert('Data Tidak bisah dihapus ! sudah berelasi');
			// </script>";

			$this->session->set_flashdata('error', 'Tidak bisah dihapus ! sudah berelasi');
		} else {
			// echo "<script>
			// alert('Data berhasil dihapus');
			// </script>";

			$this->session->set_flashdata('succes', 'berhasil dihapus');
		}
		// echo "<script>
		// window.location='" . site_url('supplier') . "';
		// 	</script>";
		redirect('customer');
	}
	public function tambah()
	{
		$Customer = new stdClass();
		$Customer->id = null;
		$Customer->nama = null;
		$Customer->jk = null;
		$Customer->no_tlpn = null;
		$Customer->alamat = null;

		$data = array(

			"header" => "Customer",
			"judul" => "Tambah Customer",
			"page" => "customer/v_edit_customer",
			"apa" => "Tambah",
			"row" => $Customer
		);
		$this->load->view('dashboard', $data);
	}
	public function update($id)
	{
		$query = $this->M_customer->get($id);
		if ($query->num_rows() > 0) {
			$Customer = $query->row();
			$data = array(

				"header" => "Customer",
				"judul" => "Tambah Customer",
				"page" => "customer/v_edit_customer",
				"apa" => "Update",
				'row' => $Customer
			);
			$this->load->view('dashboard', $data);
		} else {
			echo "<script>
			alert('Data Tidak ditemukan');
			window.location='" . base_url('customer') . "';
			</script>";
		}
	}
	public function proses()
	{
		$post = $this->input->post(null, true);
		if (isset($_POST['Tambah'])) {
			$this->M_customer->insert($post);
		}
		if ($this->db->affected_rows() > 0) {
			// echo "<script>
			// alert('Data berhasil ditambah');
			// window.location='" . base_url('customer') . "';
			// </script>";
			$this->session->set_flashdata('succes', 'berhasil ditambah');
			redirect('customer');
		} else if (isset($_POST['Update'])) {
			$this->M_customer->update($post);
		}

		if ($this->db->affected_rows() > 0) {
			// echo "<script>
			// 	alert('Data berhasil diupdate');
			// 	window.location='" . base_url('customer') . "';
			// 	</script>";
			$this->session->set_flashdata('succes', 'berhasil diupdate');
			redirect('customer');
		}
	}
}
