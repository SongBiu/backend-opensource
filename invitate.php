<?php
	include "connect.php";
	function str_rand(& $str, $invitater, $length = 15, $char = '0123456789qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPLKJHGFDSAZXCVBNM&*()^%$#@') {
		if (!is_int($length) || $length < 0) {
			return false;
		}
		$s = '';
		for ($i = $length; $i > 0; $i--) {
			$s.=$char[mt_rand(0, strlen($char)-1)];
		}
		$conn = connect_select();
		if (!$conn) {
			die("Connection Failed" . mysqli_connect_error());
			exit;
		}
		$sql = "SELECT invitateCode FROM invitate WHERE usrID = '" . $invitater . "'";
		$rslt = mysqli_query($conn, $sql);
		if (mysqli_num_rows($rslt) != 0) {
			$row = mysqli_fetch_assoc($rslt);
			$str = $row['invitateCode'];
			return true;
		}
		$sql = "SELECT COUNT(*) AS num FROM invitate WHERE invitateCode = '" . $s . "'";
		$rslt = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($rslt);
		if ($row['num'] != 0) {
			return false;
		}
		mysqli_close($conn);
		$conn = connect_insert();
		$sql = "INSERT INTO invitate(invitateCode, usrID) VALUES ('" . $s . "', '" . $invitater . "')";
		$rslt = mysqli_query($conn, $sql);
		if (!$rslt) {
			echo "error";
			return false;
		}
		$str = $s;
		return true;
	}
	$str = '';
	while (true) {
		if (str_rand($str, $_REQUEST['invitater'])) {
			break;
		}
	}
	echo $str;
	mysqli_close($conn);
?>