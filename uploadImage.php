<?php
	include "connect.php";
	$conn = connect_select();
	if (!$conn) {
		die("Connection Failed" . mysqli_connect_error());
		exit;
	}
	$sql = "SELECT NOW() AS time";
	$rslt = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($rslt);
	$time = time();
	$tmp = mime_content_type($_FILES["image"]["tmp_name"]);
	$file = $_REQUEST['usrID'] . $time . "." . explode("/", $tmp)[1];
	$data = Array();
	$oldName = $_FILES["image"]["tmp_name"];
	if ($_FILES["image"]["error"] > 0) {
		echo "Error: " . $_FILES["image"]["error"] . "<br>";
	} else {
		$usrID = $_REQUEST["usrID"];
		$name = $_FILES["image"]["name"];
		$tmp = mime_content_type($_FILES["image"]["tmp_name"]);
		$data['type'] = explode("/", $tmp)[1];
		$data['name'] = $name;
		$data['id'] = $usrID;
		move_uploaded_file($oldName,"img/".$file);
		$data['state'] = "OK";
	}
	mysqli_close($conn);
	$conn = connect_update();
	$sql = "UPDATE dyna SET image = '" . $file . "' WHERE dynamicID = '" . $_REQUEST['dynamicID'] . "'";
	echo $sql;
	mysqli_query($conn, $sql);
	mysqli_close($conn);
?>
