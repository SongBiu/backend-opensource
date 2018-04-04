<?php
	include "connect.php";
	$conn = connect_select();
	if (!$conn) {
		die("Connection Failed" . mysqli_connect_error());
		exit;
	}
	$data = Array();
	$sql = "SELECT COUNT(*) as num FROM invitate WHERE invitateCode = '" . $_REQUEST['invitateCode'] . "'";
	$rslt = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($rslt);
	
	if ($row['num'] == 0 && $_REQUEST['invitateCode'] != "") {
		$data['error'] = "邀请码不存在";
		print(json_encode($data));
		exit;
	}
	mysqli_close($conn);
	$conn = connect_insert();
	$date = date('Y-m-d');
	$sql = "INSERT INTO usr(usrID, name, email, signupDate) VALUES ('" . $_REQUEST["openid"] . "', '" . $_REQUEST['name'] . "', '" . $_REQUEST['email'] . "', '" . $date . "')"; 
	$rslt = mysqli_query($conn, $sql);
	if (!$rslt) {
		$data['error'] = "名字或邮箱填写错误";
		print(json_encode($data));
		exit;
	}
	if ($_REQUEST['invitateCode'] != "") {
		$sql = "INSERT INTO invitated(usrID, invitateCode) VALUES ('" . $_REQUEST['openid'] . "'" . ", '" . $_REQUEST['invitateCode'] . "')";
		mysqli_query($conn, $sql);
	}
	print(json_encode($data));
	mysqli_close($conn);
?>