<?php
	include "connect.php";
	$conn = connect_select();
	if (!$conn) {
		die("Connection Failed" . mysqli_connect_error());
		exit;
	}
	$sql = "SELECT * FROM community";
	$rslt = mysqli_query($conn, $sql);
	$data = Array();
	while ($row = mysqli_fetch_assoc($rslt)) {
		$id = $row['communityID'];
		$community = Array();
		$community['name'] = $row['name'];
		$community['descr'] = $row['descr'];
		$data[$id] = $community;
	}
	mysqli_close($conn);
	print(json_encode($data));
?>