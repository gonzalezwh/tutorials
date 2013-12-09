
<html>
<head>
<body>
<?php
$name=$_POST['name'];
$email=$_POST['email'];
$text=$_POST['text'];
echo "<form method='POST' name='message.php' action='feedback.php'>";
echo "<H2>Message Sent</H2>";
echo "<TABLE>";
echo "<TR><TH>Name</TH><TD>";
echo $name."</TD></TR><TR><TH>E-mail</TH>";
echo "<TD>".$email."</TD>";
echo "</TR><TH>Enter text</TH><TD>".$text."</TD></TR>";
echo "<input type='submit' value='Mail'>";
echo "</TABLE>";
echo "</form>";
  $to = "whg@pdx.edu";
  $headers = "From: whg@pdx.edu \r\n";
  $headers .= "Reply-To: whg@pdx.edu \r\n";
  mail($to,$email,$text,$headers);
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: http://tutorials.local.10.0.0.10.nip.io/thanks.php");
?>
</body>
</head>
</html>
