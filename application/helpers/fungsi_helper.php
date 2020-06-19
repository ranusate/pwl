<?php


function getLastNomor($table)
{
	$CI = &get_instance();
	$queryMaxId = "SELECT MAX(nomor) as nomor from $table WHERE year(date) = year(now())";
	$queryMaxId .= "AND month(date) = month(now())";
	$nomor = $CI->db->query($queryMaxId)->row();
	return $nomor;
}

function getLastNomorTunda($table)
{
	$CI = &get_instance();
	$queryMaxId = "SELECT MAX(nomor) as nomor from $table WHERE year(tgl_transaksi) = year(now())";
	$queryMaxId .= "AND month(tgl_transaksi) = month(now())";
	$nomor = $CI->db->query($queryMaxId)->row();
	return $nomor;
}


function autoCreate($prefix, $delimeter, $nomor)
{
	$s = "";
	foreach ($prefix as $value) {
		$s .= $value . $delimeter;
	}
	return $s . date("Y")
		. $delimeter
		. date("m")
		. $delimeter
		. str_pad($nomor, 4, "0", STR_PAD_LEFT);
}

function getJenisKelaminLengkap($jk)
{
	return ($jk == "L") ? "Laki-Laki" : "Perempuan";
}

function getLevel($level)
{
	return ($level == "1") ? "Admin" : "Kasir";
}


function check_already_login()
{
	$ci  = &get_instance();
	$user_session = $ci->session->userdata('userid');
	if ($user_session) {
		redirect('Dashboard');
	} else {

		redirect('auth');
	}
}

function check_not_login()
{
	$ci  = &get_instance();
	$user_session = $ci->session->userdata('userid');
	if (!$user_session) {
		redirect('auth');
	}
}




function check_admin()
{
	$ci = &get_instance();
	$ci->load->library('fungsi');
	if ($ci->fungsi->user_login1()->role_user != 'admin') {
		redirect('dashboard/blocked');
		die();
	}
}

function format_rupiah($nominal)
{
	$result = "Rp" . number_format($nominal, 0, ',', '.');
	return $result;
}


function format_date($dt)
{
	$d = substr($dt, 8, 2);
	$m = substr($dt, 5, 2);
	$y = substr($dt, 0, 4);
	return $d . '/' . $m . '/' . $y;
}
