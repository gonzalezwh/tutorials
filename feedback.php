<html>
<head>
<body>
<?php
$name=$_POST['name'];
$email=$_POST['email'];
$text=$_POST['text'];
echo "<form method='POST' name='feedback.php' action='message.php'>";
echo "<H2>Email Program</H2>";
echo "<TABLE>";
echo "<TR><TH>Name</TH><TD>";
echo "<Input type='text' name='name'>";
echo "</TD></TR><TR><TH>E-mail</TH>";
echo "<TD><input tyoe='text' name='email'></TD>";
echo "</TR><TH>Enter text</TH><TD>";
echo "<textarea name='text'></textarea>'";
echo "<input type='submit' value='Send Mail'>";
echo "</form>";
?>
</body>
</head>
</html>
