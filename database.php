<?php
include('login.php');
$mtext="";
$memail="";
$mname="";
$name="";
$text="";
$email="";
$error="";
if(!empty($_POST)){
    $error=0;
    $name=$_POST['name'];
    $email=$_POST['email'];
    $text=$_POST['text'];
        if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            $error=1; $memail='Email is not valid';
        }
        if (empty($name)) {$error=1; $mname = 'Please enter the name!';}
        if (empty($email)) {$error=1;  $memail = 'Please enter the email!';}
        if (empty($text)) {$error=1;   $mtext = 'Please enter the email text!';}
            $attr=" bgcolor=white ";
        if ($error==1) {$attr=" bgcolor=yellow ";}
            if ($error==0) {  
                $to = "whg@pdx.edu";
                $headers = "From: whg@pdx.edu \r\n";
                $headers .= "Reply-To: $email  \r\n";
                $to_safe = mysql_real_escape_string($to);
                $headers_safe = mysql_real_escape_string($headers);
                $text_safe = mysql_real_escape_string($text);
                $sql="insert into email_log(to_whom, subject, textmsg, headers) values('$to_safe','Database Log','$text_safe','$headers_safe')";
                if (!mysql_query($sql,$conn)){
                    die('Error: '.mysql_error($conn));
                }
                echo "Record added";      
                if (!mysql_close($conn)){
                    die('Error: '.mysql_error($conn));
                }
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: http://tutorials.local.10.0.0.10.nip.io/thanks.php"); 
            }
}
?>
<html>
<html>
<head>
<body>
<form method='POST'>
    <h2>Email Program</h2>
    <?php if($error): ?>
        <h2>There was an error in your form. Please correct it.</h2>
    <?php endif; ?>
    <table>
        <tr>
            <th>Name</th>
            <td><Input type='text' name='name' value="<?php echo htmlspecialchars($name) ?>"></td>
            <td><h3><?php echo $mname ?></h3></td>
         </tr>
        <tr>
            <th>E-mail</th>
            <td><input type='text' name='email' value="<?php echo htmlspecialchars($email) ?>"></td>
            <td><h3><?php echo $memail ?></h3></td>
        </tr>
        <tr>
            <th>Enter text</th>
            <td><textarea name='text'><?php echo htmlspecialchars($text) ?></textarea></td>
            <td><h3><?php echo $mtext ?></h3></td>
        </tr>
    </table>
    <input type='submit' value='Send Mail'>
</form>
</body>
</head>
</html>
