<?php
	include "sendMail.php";
	buildCommunity($_REQUEST["name"], $_REQUEST["desc"], $_REQUEST["person"], $_REQUEST["phone"], $_REQUEST["mail"]);
?>