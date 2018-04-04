<?php
	$s = $_REQUEST['str'];
	if ($s == '') {
		$ch = '0123456789qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPLKJHGFDSAZXCVBNM';
		$s = '';
		for ($i = 6; $i > 0; $i--) {
			$s.=$ch[mt_rand(0, strlen($ch)-1)];
		}
	}
	print(hash("md5", $s));
?>