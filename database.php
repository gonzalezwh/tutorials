<?php
if (!$conn=mysql_connect("1tutorials.local.10.0.0.10.nip.io","whg"))
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
$mname=$name;
$memail=$email;
$mtext=$text;
if (empty($name)) {$error=1; $mname = 'Please enter the name!';}
if (empty($email)) {$error=1;  $memail = 'Please enter the email!';}
if (empty($text)) {$error=1;   $mtext = 'Please enter the email text!';}
$attr=" bgcolor=white ";
if ($error==1) {$attr=" bgcolor=yellow ";}
if ($error==0) {  
  $to = "whg@pdx.edu";
  $headers = "From: whg@pdx.edu \r\n";
  $headers .= "Reply-To: $email  \r\n";
  $sql="insert into email_log(to_whom, subject, textmsg, headers) values('$to','Database Log','$text','$headers')";
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
?>
<html>
<head>
<body>
<?php
echo "<form method='POST' name='message.php' action='feedback.php'>";
echo "<input type=hidden name='name' value='".$name."'>";
echo "<input type=hidden name='email' value='".$email."'>";
echo "<input type=hidden name='text' value='".$text."'>";
echo "<form method='POST' name='message.php' action='feedback.php'>";
echo "<H2>Database</H2>";
echo "<TABLE>";
echo "<TR><TH>Name</TH><TD".$attr.">";
echo $mname."</TD></TR><TR><TH>E-mail</TH>";
echo "<TD".$attr.">".$memail."</TD>";
echo "</TR><TH>Enter text</TH><TD".$attr.">".$mtext."</TD></TR>";
echo "<input type='submit' value='Mail'>";
echo "</TABLE>";
echo "</form>";
?>
</body>
</head>
</html>
