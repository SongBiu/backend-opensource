<?php
	include "connect.php";
	$conn = connect_select();
	if (!$conn) {
		die("Connection Failed" . mysqli_connect_error());
		exit;
	}
	mysqli_query($conn, "SET NAMES utf8");
	$sql = "SELECT score, ownpostcard, ownvouchers FROM usr WHERE usrID = '" . $_REQUEST['usrID'] . "'";
	$rslt = mysqli_query($conn, $sql);
	$score = 0;
	while ($row = mysqli_fetch_assoc($rslt)) {
		$score = intval($row['score']);
		$postcard = intval($row['ownpostcard']);
		$vouchers = intval($row['ownvouchers']);
	}
	// print($score);
	$data = Array();
	$data['score'] = $score;
	$data['postcard'] = $postcard;
	$data['vouchers'] = $vouchers;
	print_r(json_encode($data));
	mysqli_close($conn);
?>