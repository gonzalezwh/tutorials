<?php
$mname="";
$memail="";
$mtext="";
$error="";
$name="";
$email="";
$text="";
if(!empty($_POST)){
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
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $headers .= "Reply-To: $email  \r\n";
        mail($to,"Student message",$text,$headers);
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: /thanks.php"); 
    }
}

?>
<html>
<head>
<body>
<form method='POST'>
    <H2>Email Program</H2>
    <?php if($error): ?>
        <H2>There was an error in your form. Please correct it.</H2>
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
