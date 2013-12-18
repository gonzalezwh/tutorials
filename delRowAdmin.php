<?php
include('login.php');
$error=0;
if (!($_POST['id'])) {
    die('No row to delete!! ');
}
$id = $_POST['id'];
if (!isset($_SESSION['user'])) {
    die('User name does not have access! ');
}


if(!empty($username)){

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
