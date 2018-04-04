<?php
	include "connect.php";
	$conn = connect_select();
	if (!$conn) {
		die("Connection Failed" . mysqli_connect_error());
		exit;
	}
	$sql = "SELECT * FROM dyna WHERE usrID = '" . $_REQUEST['usrID'] . "' ORDER BY dynamicDate DESC";
	$rslt = mysqli_query($conn, $sql);
	$data = Array();
	$index = 0;
	while ($row = mysqli_fetch_assoc($rslt)) {
		$dyna = Array();
		$dyna['good'] = $row['good'];
		$dyna['countBag'] = $row['countBag'];
		$dyna['image'] = "img/".$row['image'];
		$dyna['say'] = $row['say'];
		$dyna['time'] = $row['dynamicDate'];
		$dyna['dynamicID'] = $row['dynamicID'];
		if ($row['image'] == NULL) {
			$dyna['hasImg'] = false;
		}
		else {
			$dyna['hasImg'] = true;
		}
		$sql = "SELECT name FROM usr WHERE usrID = '" . $_REQUEST['usrID'] . "'";
		$r = mysqli_query($conn, $sql);
		$name = '';
		while ($row = mysqli_fetch_assoc($r)) {
			$name = $row['name'];
		}
		$dyna['name'] = $name;
		$data[$index++] = $dyna;
	}
	print(json_encode($data));
	mysqli_close($conn);
?>