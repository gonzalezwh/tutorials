<?php
if (!isset($_GET['service'])){
print_r($_GET);
$ticket=$_GET['ticket'];
$ticket=substr($ticket,strpos($ticket,'>'));
$ticket=substr($ticket,0,strlen($ticket));
$ticket=trim($ticket);
$ticket=utf8_encode($ticket);
$service=utf8_encode("http://10.0.0.10/login.php");
$_SESSION['xml']="https://sso.pdx.edu/cas/proxyValidate?ticket=".$ticket."&service=".$service;
$output=file_get_contents($_SESSION['xml']);
$xml = new SimpleXMLElement($output);
print_r($output);
//header("HTTP/1.1 301 Moved Permanently");
//header("Location: http://10.0.0.10/admin.php?user=".$xml->user);
}
?>
<html>
<head>
<body>
    <a href=<?php echo $_SESSION['xml'] ?>>validate</a>
</body>
</head>
</html>
