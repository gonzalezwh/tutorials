<?php
session_start();
$ticket=$_GET['ticket'];
$ticket=substr($ticket,strpos($ticket,'>'));
$ticket=substr($ticket,0,strlen($ticket));
$ticket=trim($ticket);
$ticket=utf8_encode($ticket);
$service=utf8_encode("http://10.0.0.10/login.php");
$url='https://sso.pdx.edu/cas/proxyValidate?ticket='.$ticket.'&service='.$service;
$output=file_get_contents($url);
if (strpos($output,"whg")>0) $_SESSION["user"] = "whg";
header("Location: http://10.0.0.10/admin.php");
?>
