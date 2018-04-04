<?php
	$secret = "3123098474510e3a9b716bdd67b4f596";
	$appid = "wxf75f308cbcc043f1";
        $wxurl = "https://api.weixin.qq.com/sns/jscode2session?appid=" . $appid . "&secret=" . $secret  . "&js_code=" . $_REQUEST['jsonCode'] . "&grant_type=authorization_code";
        $data = file_get_contents($wxurl);
	$r = Array();
	$r['openid'] = json_decode($data, true)['openid'];
	//print(json_decode($data, true));//['openid']);
	//$r = Array();
	//$r['openid'] = json_encode($data)['openid'];
	//print(json_encode($data)['openid']);
        print(json_encode($r));
?>
