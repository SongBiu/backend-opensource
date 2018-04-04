<?php
	$pkuID = $_REQUEST['pkuID'];
	include "sendMail.php";
	$mail = $pkuID . "@pku.edu.cn";
	$ch = '0123456789qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPLKJHGFDSAZXCVBNM';
	$s = '';
	for ($i = 6; $i > 0; $i--) {
		$s.=$ch[mt_rand(0, strlen($ch)-1)];
	}
	if(sendMail($mail, "您的验证码为" . $s)) {
		print($s); 
	} else {
		print("***");
	}
	
?>