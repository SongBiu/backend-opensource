<?php
	require_once('Mail.php');
	require_once('Mail/mime.php');
	require_once('Net/SMTP.php');
	function buildCommunity($name, $desc, $person, $phone, $eMail) {
		$smtpinfo = array();
		$smtpinfo["host"] = "smtp.163.com";
		$smtpinfo["port"] = "465";
		$smtpinfo["SMTPSecure"] = "ssl";
		$smtpinfo["username"] = "songMAPKU@163.com";
		$smtpinfo["password"] = "lisong862";
		$smtpinfo["timeout"] = 10;
		$smtpinfo["auth"] = true;
		$mailAddr = array('song_pku@foxmail.com');
		$from = "活动管理员<songMAPKU@163.com>";
		$to = implode(',', $mailAddr);
		$subject = "创建社团信息提交";
		$content = "<h1>社团名称：".$name."</h1><h2>社团描述：".$desc."</h2><h2>负责人姓名：".$person."</h2><p>负责人联系电话：".$phone."</p><p>社团联系邮箱：".$eMail."</p>";
		$contentType = "text/html; charset=utf-8";
		$crlf = "\n";
		$mime = new Mail_mime($crlf);
		$mime->setHTMLBody($content);
		$param['text_charset'] = 'utf-8';
		$param['html_charset'] = 'utf-8';
		$param['head_charset'] = 'utf-8';
		$body = $mime->get($param);
		$headers = array();
		$headers["From"] = $from;
		$headers["To"] = $to;
		$headers["Subject"] = $subject;
		$headers["Content-Type"] = $contentType;
		$headers = $mime->headers($headers);

		$smtp = & Mail::factory("smtp", $smtpinfo);
		$mail = $smtp->send($mailAddr, $headers, $body);
		$smtp->disconnect();
		if (PEAR::isError($mail)) {
			echo "WRONG\r\n".$mail->getMessage()."\n";
		}
	}
	function sendMail($accept, $contentSend) {
		// $smtpinfo = array();
		// $smtpinfo["host"] = "smtp.163.com";
		// $smtpinfo["port"] = "465";
		// $smtpinfo["username"] = "songMAPKU@163.com";
		// $smtpinfo["password"] = "lisong862";
		// $smtpinfo["timeout"] = 10;
		// $smtpinfo["auth"] = true;
		// $mailAddr = array($accpet);
		// $from = "活动管理员<songMAPKU@163.com>";
		// $to = implode(',', $mailAddr);
		// $subject = "北大认证验证码";
		// $content = $contentSend;
		// $contentType = "text/html; charset=utf-8";
		// $crlf = "\n";
		// $mime = new Mail_mime($crlf);
		// $mime->setHTMLBody($content);
		// $param['text_charset'] = 'utf-8';
		// $param['html_charset'] = 'utf-8';
		// $param['head_charset'] = 'utf-8';
		// $body = $mime->get($param);
		// $headers = array();
		// $headers["From"] = $from;
		// $headers["To"] = $to;
		// $headers["Subject"] = $subject;
		// $headers["Content-Type"] = $contentType;
		// $headers = $mime->headers($headers);

		// $smtp = & Mail::factory("smtp", $smtpinfo);
		// $mail = $smtp->send($mailAddr, $headers, $body);
		// $smtp->disconnect();
		// if (PEAR::isError($mail)) {
		// 	false;
		// }
		// return true;

	
		require("./PHPMailer/class.phpmailer.php");
		require("./PHPMailer/class.smtp.php");
		$mail = new PHPMailer();
		// return true;
		$mail->isSMTP();
		
		$mail->SMTPAuth=true;
		$mail->Host = "smtp.163.com";
		$mail->SMTPSecure = "ssl";
		$mail->Port = 465;
		$mail->Hostname = 'https://www.mapku.top';
		$mail->CharSet = 'UTF-8';
		$mail->FromName = "顺手一袋活动管理员";
		$mail->Username = "xxx";
		$mail->Password = 'password';
		
		$mail->From = 'songMAPKU@163.com';
		$mail->isHTML(true); 
		$mail->addAddress($accept,'用户');
		$mail->Subject = "北大认证验证码";
		$mail->Body = $contentSend;
		$status = $mail->send();
		if($status) {
			return true;
		}else{
			return false;
		}
	}
?>