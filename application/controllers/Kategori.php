<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		// check_not_login();
		//check_admin();
		$this->load->model('M_kategori');
		$this->load->library('form_validation');
	}
	public function index()
	{
		$listSup = $this->M_kategori->get()->result();
		$data = array(
			"page" => "master/kategori/v_list_kategori",

			"header" => "Kategori",
			"judul" => "Data Kategori",
			"kategoris" => $listSup
		);
		$this->load->view('dashboard', $data);
	}

	public function delete($id)
	{
		$this->M_kategori->delete($id);
		$error = $this->db->error();

		if ($error['code'] != 0) {

			$this->session->set_flashdata('error', 'Tidak bisah dihapus ! sudah berelasi');
		} else {
			$this->session->set_flashdata('succes', 'berhasil dihapus');
		}
		redirect('kategori');
	}

	public function tambah()
	{
		$kategori = new stdClass();
		$kategori->id = null;
		$kategori->nama = null;
		$data = array(

			"header" => "Kategori | Tambah",
			"judul" => "Tambah Kategori",
			"page" => "master/kategori/v_edit_kategori",
			"apa" => "Tambah",
			"row" => $kategori
		);
		$this->load->view('dashboard', $data);
	}
	public function update($id)
	{
		$query = $this->M_kategori->get($id);

		if ($query->num_rows() > 0) {
			$kategori = $query->row();
			$data = array(
				"header" => "Kategori | Update",
				"judul" => "Update Kategori",
				"page" => "master/kategori/v_edit_kategori",
				"apa" => "Update",
				'row' => $	
			);
			$this->load->view('dashboard', $data);
		} else {
			$this->session->set_flashdata('error', 'tidak ditemukan');
			redirect('kategori');
		}
	}


	public function proses()
	{
		$post = $this->input->post(null, true);
		if (isset($_POST['Tambah'])) {

			$this->M_kategori->insert($post);
		}
		if ($this->db->affected_rows() > 0) {

			$this->session->set_flashdata('succes', 'berhasil disimpan');
			redirect('kategori');
		} else if (isset($_POST['Update'])) {
			
			$this->M_kategori->update($post);
			if ($this->db->affected_rows() > 0) {
			}
			$this->session->set_flashdata('succes', 'berhasil diupdate');

			redirect('kategori');
		}
	}
}
