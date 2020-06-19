<?php

function dd($data)
{
	highlight_string("<?php\n\$data =\n" . var_export($data, true) . ";\n?>");
	die();
}







function isLogin2()
{
	$ci = &get_instance();
	if (!$ci->session->userdata('is_login_pwl')) {
		redirect("login");
	}
}


function sendEmail($subject, $data, $view)
{
	$CI = &get_instance();
	$config = array(
		'useragent' => 'CodeIgniter',
		'protocol' => 'smtp',
		'mailpath' => '/usr/sbin/sendmail',
		'smtp_host' => 'smtp.gmail.com',
		'smtp_user' => 'test9ong@gmail.com',
		'smtp_pass' => "15112607",
		'smtp_port' => 465,
		'smtp_keepalive' => TRUE,
		'smtp_crypto' => 'ssl',
		'wordwrap' => TRUE,
		'wrapchars' => 76,
		'mailtype' => 'html',
		'charset' => 'utf-8',
		'validate' => TRUE,
		'crlf' => "\r\n",
		'newline' => "\r\n",
	);
	$body = $CI->load->view("mail/" . $view, $data, TRUE);
	$CI->email->initialize($config);
	// $CI->email->from('noreply.alumni.sttii@gmail.com', 'PWL Aplikasi Kasir');
	$CI->email->from('test9ong@gmail.com', 'Radianus');

	$CI->email->to($data["email_user"]);
	$CI->email->subject($subject);

	$CI->email->message($body);

	if ($CI->email->send()) {

		return "1";
	} else {
		echo $CI->email->print_debugger();
		return "0";
	}
}

function randomPassword()
{
	$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	$pass = array(); //remember to declare $pass as an array
	$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	for ($i = 0; $i < 8; $i++) {
		$n = rand(0, $alphaLength);
		$pass[] = $alphabet[$n];
	}
	return implode($pass); //turn the array into a string
}


function bulan($bln)
{
	$bulan = $bln;
	switch ($bulan) {
		case 1:
			$bulan = "Januari";
			break;
		case 2:
			$bulan = "Februari";
			break;
		case 3:
			$bulan = "Maret";
			break;
		case 4:
			$bulan = "April";
			break;
		case 5:
			$bulan = "Mei";
			break;
		case 6:
			$bulan = "Juni";
			break;
		case 7:
			$bulan = "Juli";
			break;
		case 8:
			$bulan = "Agustus";
			break;
		case 9:
			$bulan = "September";
			break;
		case 10:
			$bulan = "Oktober";
			break;
		case 11:
			$bulan = "November";
			break;
		case 12:
			$bulan = "Desember";
			break;
	}
	return $bulan;
}
