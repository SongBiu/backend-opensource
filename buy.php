<?php
	include "connect.php";
	$conn = connect_select();
	if (!$conn) {
		die("Connection Failed" . mysqli_connect_error());
		exit;
	}
	$sql = "SELECT score FROM usr WHERE usrID = '" . $_REQUEST['usrID'] . "'";
	$rslt = mysqli_query($conn, $sql);
	$score = 0;
	while ($row = mysqli_fetch_assoc($rslt)) {
		$score = intval($row['score']);
	}
	if (!$conn) {
		die("Connection Failed" . mysqli_connect_error());
		exit;
	}
	mysqli_close($conn);
	$conn = connect_update();
	if ($_REQUEST['score'] === '3') {
		
		$sql = "UPDATE usr SET ownpostcard = ownpostcard+1, score = score-3 WHERE usrID = '" . $_REQUEST['usrID'] . "'";
		$rslt = mysqli_query($conn, $sql);
		echo $sql;
	}
	else if($_REQUEST['score'] === '10'){
		$sql = "UPDATE usr SET ownvouchers = ownvouchers+1, score = score-10 WHERE usrID = '" . $_REQUEST['usrID'] . "'";	
		$rslt = mysqli_query($conn, $sql);
	}
?>