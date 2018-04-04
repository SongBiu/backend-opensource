<?php
	include "connect.php";
	$conn = connect_select();
	if (!$conn) {
		die("Connection Failed" . mysqli_connect_error());
		exit;
	}
	$sql = "SELECT communityID FROM usr WHERE usrID = '" . $_REQUEST["usrID"] . "'";
	$rslt = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($rslt);
	$communityID = $row['communityID'];
	$sql = "SELECT name, countBag, usrID FROM usr WHERE communityID = '" . $communityID . "' ORDER BY countBag DESC";
	$rslt = mysqli_query($conn, $sql);
	$data = Array();
	$other = Array();
	$index = 0;
	$cnt = 0;
	while ($row = mysqli_fetch_assoc($rslt)) {
		if ($cnt == 0) {
			$usr = Array();
			$usr['countBag'] = $row['countBag'];
			$usr['name'] = $row['name'];
			$usr['usrID'] = $row['usrID'];
			$data['thefirst'] = $usr;
		} else {
			$usr = Array();
			$usr['countBag'] = $row['countBag'];
			$usr['name'] = $row['name'];
			$usr['usrID'] = $row['usrID'];
			$usr['index'] = $cnt+1;
			$other[$index++] = $usr;
		}
		$cnt++;
	}
	$data['other'] = $other;
	print(json_encode($data));
	mysqli_close($conn);
?>