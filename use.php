<?php
	include "connect.php";
	$conn = connect_update();
	if (!$conn) {
		die("Connection Failed" . mysqli_connect_error());
		exit;
	}
	$r = "own" . $_REQUEST['useType'];
	$sql = "UPDATE usr SET " . $r . " = " . $r . "-1 WHERE usrID = '" . $_REQUEST['usrID'] . "'";
	
	if (mysqli_query($conn, $sql)) {
		echo $sql;
	} else {
		echo "error";
	}
	mysqli_close($conn);
?>