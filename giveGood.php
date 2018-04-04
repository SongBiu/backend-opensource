<?php
		include "connect.php";
		$conn = connect_update();
		if (!$conn) {
				die("Connection Failed" . mysqli_connect_error());
				exit;
		}
		$sql = "UPDATE dyna SET good = good + 1 WHERE dynamicID = '" . $_REQUEST['dynamicID'] . "'";
		$rslt = mysqli_query($conn, $sql);
		mysqli_close($conn);
		$conn = connect_insert();
		$sql = "INSERT INTO good(dynamicID, usrID) VALUES ('" . $_REQUEST['dynamicID'] . "', '" . $_REQUEST['openid'] . "')";
		$rslt = mysqli_query($conn, $sql);
		mysqli_close($conn);
?>
