<?php
	$data = Array();
	include "connect.php";
	$conn = connect_select();
	$date = date('Y-m-d H:i:s');
	
	if (!$conn) {
		die("Connection Failed" . mysqli_connect_error());
		exit;
	}
	// if ($_REQUEST['countBag'] == 0) {
	// 	echo "OK";		
	// 	exit;
	// }
	
	$sql = "SELECT signupDate, communityID FROM usr WHERE usrID = '" . $_REQUEST['usrID'] . "'";
	
	$rslt = mysqli_query($conn, $sql);
	$score = 2;
	mysqli_close($conn);
	while ($row = mysqli_fetch_assoc($rslt)) {	
		$conn = connect_select();
		$signupDate = $row['signupDate'];
		$communityID = $row['communityID'];
		$deltaDay = (strtotime($date) - strtotime($signupDate)) / (3600*24);
		$sql = "SELECT COUNT(*) AS num FROM dyna WHERE usrID = '" . $_REQUEST['usrID'] . "'";
		$rslt = mysqli_query($conn, $sql);
		while ($row = mysqli_fetch_assoc($rslt)) {
			if ($row['num'] == 0) {
				if ($deltaDay <=7) {
					$score = 3;
				}
				mysqli_close($conn);
				$conn = connect_update();
				$sql = "UPDATE usr, invitate, invitated SET usr.score = usr.score + 3 WHERE usr.usrID = invitate.usrID AND invitate.invitateCode = invitated.invitatedCode AND invitated.usrID = '" . $_REQUEST['usrID'] . "'";
				mysqli_query($conn, $sql);
				mysqli_close($conn);
				$conn = connect_delete();
				$sql = "DELETE FROM invitated WHERE usrID = '" . $_REQUEST['usrID'] . "'";
				mysqli_query($conn, $sql);
			}
		}
		
		if ($_REQUEST['countBag'] > 1) {
			$score += $_REQUEST['countBag'] - 1;
		}
		if ($score > 5) {
			$score = 5;
		}
	}
	mysqli_close($conn);
	$conn = connect_select();
	$sql = "SELECT COUNT(*) AS num FROM dyna";
	$rslt = mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_assoc($rslt)) {
		$ID = $row['num'];
	}
	$data['dynamicID'] = $ID;
	mysqli_close($conn);
	$conn = connect_insert();
	$sql = "INSERT INTO dyna(dynamicID, usrID, dynamicDate, countBag, say) VALUES ('" . $ID . "', '" . $_REQUEST['usrID'] . "', '" . $date . "', " . $_REQUEST['countBag'] . ", '" . $_REQUEST['say'] . "')";
	$data['sql'] = $sql;
	mysqli_query($conn, $sql);
	mysqli_close($conn);
	$conn = connect_update();
	$sql = "UPDATE usr SET score = score + " . $score . " WHERE usrID = '" . $_REQUEST['usrID'] . "'";
	mysqli_query($conn, $sql);
	$sql = "UPDATE usr SET countBag = countBag + " . $_REQUEST['countBag'] . " WHERE usrID = '" . $_REQUEST['usrID'] . "'";
	mysqli_query($conn, $sql);
	$sql = "UPDATE community SET allscore = score + '" . $score . "' WHERE communityID = '" . $communityID . "'";
	mysqli_query($conn, $sql);
	print(json_encode($data));
	mysqli_close($conn);
?>
