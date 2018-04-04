<?php
	include "connect.php";
	$conn = connect_select();
	if (!$conn) {
		die('error');
		exit;
	}
	$sql = "SELECT * FROM dyna ORDER BY dynamicDate DESC";
	$rslt = mysqli_query($conn, $sql);
	if (!$rslt) {
		die("error");
		exit;
	}
	$index = 0;
	$data = Array();
	while ($row = mysqli_fetch_assoc($rslt)) {
		$dyna = Array();
		$dyna['say'] = $row["say"];
		$dyna["countBag"] = $row['countBag'];
		$dyna["good"] = $row["good"];
		$dyna['time'] = $row['dynamicDate'];
		if ($row['image'] == NULL) {
			$dyna['hasImg'] = false;
		}
		else {
			$dyna['hasImg'] = true;
		}
		$dyna['image'] = 'img/'.$row['image'];
		$dyna['dynamicID'] = $row['dynamicID']; 
		$usrID = $row['usrID'];
		$dyna['usrID'] = $usrID;
		$sql = "SELECT name FROM usr WHERE usrID = '" . $usrID . "'";
		$r = mysqli_query($conn, $sql);
		$name = '';
		while ($row = mysqli_fetch_assoc($r)) {
			$name = $row['name'];
		}
		$dyna['name'] = $name;
		

		$sql = "SELECT COUNT(*) AS num FROM good WHERE usrID = '" . $_REQUEST['openid'] . "' AND dynamicID = '" . $dyna['dynamicID'] . "'";
		$r = mysqli_query($conn, $sql);
		while ($row = mysqli_fetch_assoc($r)) {
			if ($row['num'] != 0) {
				$dyna['hasGood'] = true;
			} else {
				$dyna['hasGood'] = false;
			}
		}
		$data[$index++] = $dyna;
	}
	mysqli_close($conn);
	print(json_encode($data));
?>