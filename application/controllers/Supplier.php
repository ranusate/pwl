<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		// check_not_login();
		//check_admin();
		
		check_admin();
		$this->load->model('M_supplier');
		$this->load->library('form_validation');
	}
	public function index()
	{
		$listSup = $this->M_supplier->get()->result();
		$data = array(
			"page" => "supplier/v_list_supplier",
			"header" => "Supplier",
			"judul" => "Data Supplier",
			"suppliers" => $listSup
		);
		$this->load->view('dashboard', $data);
	}


	public function delete($id)
	{
		$this->M_supplier->delete($id);
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
		echo "<script>
		window.location='" . site_url('supplier') . "';
			</script>";
	}


	public function tambah()
	{
		$supplier = new stdClass();
		$supplier->id = null;
		$supplier->nama = null;
		$supplier->no_tlpn = null;
		$supplier->alamat = null;
		$supplier->decripsi = null;

		$data = array(
			
			"header" => "Supplier",
			"judul" => "Tambah Supplier",
			"page" => "supplier/v_edit_supplier",
			"apa" => "add",
			"row" => $supplier
		);
		$this->load->view('dashboard', $data);
	}
	public function update($id)
	{
		$query = $this->M_supplier->get($id);
		if ($query->num_rows() > 0) {
			$supplier = $query->row();
			$data = array(

				"header" =>"Supplier",
				"judul" =>"Update Supplier",
				"page" => "supplier/v_edit_supplier",
				"apa" => "update",
				'row' => $supplier
			);
			$this->load->view('dashboard', $data);
		} else {
			// echo "<script>
			// alert('Data Tidak ditemukan');
			// window.location='" . base_url('supplier') . "';
			// </script>";
			$this->session->set_flashdata('error', 'Tidak ditemukan');
			redirect('supplier');
		}
	}



	public function proses_tambah()
	{
		$post = $this->input->post(null, true);
		if (isset($_POST['add'])) {
			$this->M_supplier->insert($post);
		}

		if ($this->db->affected_rows() > 0) {
			// echo "<script>
			// alert('Data berhasil ditambah');
			// window.location='" . base_url('supplier') . "';
			// </script>";
			
			$this->session->set_flashdata('succes', 'berhasil ditambah');
			redirect('supplier');

		} else if (isset($_POST['update'])) {
			$this->M_supplier->update($post);
		}
		if ($this->db->affected_rows() > 0) {
			// echo "<script>
			// 	alert('Data berhasil diupdate');
			// 	window.location='" . base_url('supplier') . "';
			// 	</script>";

			
			$this->session->set_flashdata('succes', 'berhasil diupdate');
			redirect('supplier');
		}
	}
}