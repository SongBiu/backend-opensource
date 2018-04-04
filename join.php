<?php
	include "connect.php";
	$conn = connect_update();
	if (!$conn) {
		die('error');
		exit;
	}
	$sql = "UPDATE usr SET communityID = '" . $_REQUEST['communityID'] . "' WHERE usrID = '" . $_REQUEST['usrID'] . "'";
	$rslt = mysqli_query($conn, $sql);
	if (!$rslt) {
		die("error");
		exit;
	}
	echo "join OK";
	mysqli_close($conn);
?>