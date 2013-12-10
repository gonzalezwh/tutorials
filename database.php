<?php

$mtext="";
$memail="";
$mname="";
$name="";
$text="";
$email="";
$error="";
if(!empty($_POST)){
    if (!$conn=mysql_connect("tutorials.local.10.0.0.10.nip.io","whg"))
    {
        echo "Failed to connect to mysql ".mysql_connect_error();
    }

    if (!mysql_select_db("tutorials",$conn)){
        echo "Could not select db!";
        exit;
    }
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
            if (!mysql_query($sql,$conn))
            {
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
    <H2>Email Program</H2>
    <?php if($error): ?>
        <p>There was an error in your form. Please correct it.</p>
    <?php endif; ?>
    <TABLE>
        <TR>
            <TH>Name</TH>
            <TD><Input type='text' name='name' value="<?php echo htmlspecialchars($name) ?>"></TD>
            <TD><h1><?php echo $mname ?></h1></TD>
         </TR>
        <TR>
            <TH>E-mail</TH>
            <TD><input type='text' name='email' value="<?php echo htmlspecialchars($email) ?>"></TD>
            <TD><h1><?php echo $memail ?></h1></TD>
        </TR>
        <tr>
            <TH>Enter text</TH>
            <TD><textarea name='text'><?php echo htmlspecialchars($text) ?></textarea></td>
            <TD><h1><?php echo $mtext ?></h1></TD>
        </tr>
    </table>
    <input type='submit' value='Send Mail'>
</form>
</body>
</head>
</html>
