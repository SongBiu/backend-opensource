<?php
	include "connect.php";
	$conn = connect_select();
	if (!$conn) {
		die("Connection Failed" . mysqli_connect_error());
		exit;
	}
	$sql = "SELECT name, score, communityID, countBag, PKU FROM usr WHERE usrID = '". $_REQUEST['usrID'] ."'";
	$rslt = mysqli_query($conn, $sql);
	$data = Array();
	while ($row = mysqli_fetch_assoc($rslt)) {
		$data['score'] = $row['score'];
		$data['countBag'] = $row['countBag'];
		$data['PKU'] = $row['PKU'];
		$data['name'] = $row['name'];
		$communityID = $row['communityID'];
		$data['communityID'] = $row['communityID'];
		$sql = "SELECT name, allscore FROM community WHERE communityID = '" . $communityID . "'";
		$r = mysqli_query($conn, $sql);
		while ($row = mysqli_fetch_assoc($r)) {
			$data['community_name'] = $row['name'];
			$data['allscore'] = $row['allscore'];
		}
	}
	print(json_encode($data));
	mysqli_close($conn);
?>