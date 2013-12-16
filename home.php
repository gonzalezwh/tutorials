<? session_start();
unset ($_SESSION['user']);
?>
<html>
<head>
<body>
<?php
$service=utf8_encode("http://10.0.0.10/login.php");
?>
<H3><a href="https://sso.pdx.edu/cas/login?service=<?php echo $service ?>">Login</a>
</body>
</head>
</html>
