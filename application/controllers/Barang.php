<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		// check_not_login();
		// check_admin();
		isLogin2();
		check_admin();
		$this->load->model('M_barang');
		$this->load->model('M_kategori');
		$this->load->library('form_validation');
	}
	public function index()
	{
		$listSup = $this->M_barang->get()->result();
		$data = array(
			"page" => "master/barang/v_list_barang",
			"header" => "Barang",
			"judul" => "Data Barang",
			"barangs" => $listSup
		);
		$this->load->view('dashboard', $data);
	}

	public function stock()
	{
	}
	public function tambah()
	{
		$barang = new stdClass();
		$barang->id_barang = null;
		$barang->barcode = null;
		$barang->nama = null;
		$barang->harga = null;
		$barang->image = null;
		$barang->id_kategori = null;

		$kategori = $this->M_kategori->get()->result();
		$data = array(
			"header" => "Barang | Tambah",
			"judul" => "Tambah Barang",
			"page" => "master/barang/v_edit_barang",
			"apa" => "Tambah",
			"kategoris" => $kategori,
			"row" => $barang
		);
		$this->load->view('dashboard', $data);
	}

	public function update($id)
	{
		$query = $this->M_barang->get($id);
		if ($query->num_rows() > 0) {
			$kategori = $this->M_kategori->get()->result();
			$barang = $query->row();
			$data = array(
				"header" => "Barang | Update",
				"judul" => "Update Barang",
				"page" => "master/barang/v_edit_barang",
				"apa" => "Update",
				"kategoris" => $kategori,
				'row' => $barang
			);
			$this->load->view('dashboard', $data);
		} else {
			echo "<script>
			alert('Data Tidak ditemukan');
			window.location='" . base_url('barang') . "';
			</script>";
		}
	}


	function get_barang()
	{
		$kode = $this->input->post('barcode');
		$data = $this->M_barang->get_data_barang_bykode($kode);
		echo json_encode($data);
	}

	public function proses()
	{
		$config['upload_path'] 		= 'assets/img/';
		$config['allowed_types'] 	= 'gif|jpg|png';
		$config['max_size'] 			= 10048;
		$config['file_name'] 			= 'barang-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
		$this->load->library('upload', $config);


		$post = $this->input->post(null, true);

		if (isset($_POST['Tambah'])) {
			if ($this->M_barang->cek_barcode($post['barcode'])->num_rows() > 0) {
				// $this->session->set_flashdata('error', '$post[barcode] sudah dipakai barang lain');
				// $this->session->set_flashdata('barcode', 'Barcode $post[barcode] sudah dipakai barang lain');

				$this->session->set_flashdata('error', 'sudah dipakai barang lain');
				redirect('barang/tambah');
			} else {

				if (@$_FILES['image']['name'] != null) {
					if ($this->upload->do_upload('image')) {
						$post['image'] = $this->upload->data('file_name');
						$this->M_barang->insert($post);
						if ($this->db->affected_rows() > 0) {
							$this->session->set_flashdata('succes', 'berhasil disimpan');
							// $this->session->set_flashdata('flash');
						}
						redirect('barang');
					} else {
						$error =  $this->upload->display_errors();
						$this->session->set_flashdata('error', $error);
						redirect('barang');
					}
				} else {
					$post['image'] = null;
					$this->M_barang->insert($post);
					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('succes', 'berhasil disimpan');
						// $this->session->set_flashdata('flash');
					}
					redirect('barang');
				}
			}
		} else if (isset($_POST['Update'])) {

			if ($this->M_barang->cek_barcode($post['barcode'], $post['id_barang'])->num_rows() > 0) {

				// $this->session->set_flashdata('error', "Barcode $post[barcode] sudah dipakai barang lain");
				$this->session->set_flashdata('succes', '$post[barcode] sudah dipakai barang lain');
				redirect('barang/update');
			} else {
				if (@$_FILES['image']['name'] != null) {
					if ($this->upload->do_upload('image')) {

						$barang = $this->M_barang->get($post['id_barang'])->row();
						if ($barang->image != null) {
							$target_file = './assets/img/' . $barang->image;
							unlink($target_file);
						}


						$post['image'] = $this->upload->data('file_name');
						$this->M_barang->update($post);

						if ($this->db->affected_rows() > 0) {
							$this->session->set_flashdata('succes', ' berhasil diupdate');
							// $this->session->set_flashdata('success');
						}
						redirect('barang');
					} else {
						// $error =  $this->upload->display_errors();

						$this->session->set_flashdata('error', 'Sudah dipakai barang lain');
						// $this->session->set_flashdata('error', $error);
						redirect('barang');
					}
				} else {
					$post['image'] = null;
					$this->M_barang->update($post);
					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('succes', ' berhasil diupdate');
						// $this->session->set_flashdata('flash');
					}
					redirect('barang');
				}
			}
		}
	}
	public function delete($id)
	{


		$barang = $this->M_barang->get($id)->row();

		if ($barang->image != null) {
			$target_file = './assets/img/' . $barang->image;
			unlink($target_file);
		}

		// $this->M_barang->deletebarang($id);
		$this->M_barang->delete($id);

		$error = $this->db->error();


		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('succes', ' berhasil dihapus');
			
		}else if ($error['code'] != 0) {
			$this->session->set_flashdata('error', 'Tidak bisah dihapus ! sudah berelasi');
		}

		redirect('barang');
	}




	function barcode_qr($id)
	{
		$listbarang = $this->M_barang->getByPrimaryKey($id);


		$data = array(
			"page" => "master/barang/barcode_barang",
			"header" => "Barcode Generator",
			"judul" => "Barcode Barang",
			"barangs" => $listbarang,
		);
		$this->load->view('dashboard', $data);
	}


	function barcode_print($id)
	{
		$listbarang = $this->M_barang->get($id)->row();

		// $data['row'] = $this->M_barang->get($id)->row();
		$data = array(

			//	"page" => "master/barang/barcode_print",
			"header" => "Barcode Generator",
			//"judul" => "Barcode Barang",
			"barangs" => $listbarang,
		);

		$html = $this->load->view('master/barang/barcode_print', $data, true);
		$this->fungsi->pfdGenerator($html, 'barcode ', 'A4', 'landscape');
	}


	function barcodeprint($id)
	{
		$listbarang = $this->M_barang->get($id)->row();
		$data = array(
			"header" => "Barcode",
			"judul" => "Barcode Barang",
			"barangs" => $listbarang,
		);
		$html = $this->load->view('master/barang/barcode_print', $listbarang, true);
		$this->fungsi->pfdGenerator1($html, 'barcode' . $listbarang->barcode);
	}
}
