<?php
session_start();
$error=0;
if (!($_POST['id'])) {
    die('No row to delete!! ');
}
$id = $_POST['id'];
if (!isset($_SESSION['user'])) {
    die('User name does not have access! ');
}
$username=$_SESSION["user"];


if(!empty($username)){
    if (!$conn=mysqli_connect("tutorials.local.10.0.0.10.nip.io",$username))
    {
        echo "failed to connect to mysql ".mysql_connect_error();
    }

    if (!mysqli_select_db($conn,"tutorials")){
        echo "Could not select db!";
        exit;
    }

    if (empty($username)) {$error=1; $mname = 'Please enter the name!';}
        if ($error==0) {  
            $sql="delete from email_log where id = ".$id;
            $result=mysqli_query($conn,$sql);

            if (!mysqli_close($conn)){
                die('Error: '.mysql_error($conn));
            }
        }
}
?>
