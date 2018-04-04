<?php
	include "connect.php";
	$conn = connect_update();
	if (!$conn) {
		die("Connection Failed" . mysqli_connect_error());
		exit;
	}
	$sql = "UPDATE usr SET PKU = TRUE WHERE usrID = '" . $_REQUEST['usrID'] . "'";
	mysqli_query($conn, $sql);
	mysqli_close($conn);
?>