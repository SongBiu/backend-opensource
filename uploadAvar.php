<?php
	$in = fopen($_REQUEST['avatarUrl'], "rb");
	$out = fopen("avatar/" . $_REQUEST['usrID'] . ".jpg", "wb");
	while ($chunk = fread($in, 8192)) {
		fwrite($out, $chunk, 8192);
	}
	fclose($in);
	fclose($out);
?>