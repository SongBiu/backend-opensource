<?php
	include "connect.php";
	$conn = connect_select();
	if (!$conn) {
		echo "wrong";
		exit;
	}
	mysqli_query($conn, "SET NAMES utf8");
	$sql = "SELECT COUNT(*) as num FROM community";
	$rslt = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($rslt);
	echo $row['num'];
	mysqli_close($conn);
?>