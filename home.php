<?php
    session_start();
    unset ($_SESSION['user']);
?>
<html>
<head>
<body>
        <?php
        $service=utf8_encode("http://10.0.0.10/login.php?next=http://10.0.0.10/admin.php");
        ?>
        <h3><a href="https://sso.pdx.edu/cas/login?service=<?php echo $service ?>">Login</a></h3>
</body>
</head>
</html>
