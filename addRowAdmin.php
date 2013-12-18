<?php
include('login.php');
$pk="";
$name="";
$text="";
$headers="";
$error="";
if(!empty($_SESSION['user'])){
    $username=$_SESSION['user'];


    $error=0;
    if (isset($_POST['pk'])) {
        $pk=$_POST['pk'];
        $name=$_POST['name'];
        $headers=$_POST['headers'];
        $text=$_POST['text'];
        $name_safe = mysql_real_escape_string($name);
        $pk_safe= mysql_real_escape_string($pk);
        $headers_safe = mysql_real_escape_string($headers);
        $text_safe = mysql_real_escape_string($text);
        $sql="insert into email_log (to_whom, subject, textmsg, headers) values ('".$name_safe."','Insert Record','".$text_safe."','".$headers_safe."')";
        $result=mysqli_query($conn,$sql);
        if (!$result)
        {
            die('Error: '.mysqli_error($conn));
        }
        header('Location: /admin.php');
        exit;
    }                  
}
?>
<html>
<html>
<head>
<script type="text/javascript"> 
function openWin() {
    this.close();
    var win = window.location='/admin.php?id=';
}


</script>
<body>
<form method='POST'>
<H2>Add Mail</H2>
<?php echo "<H3>User :".$_SESSION['user']."</H3>" ?>
    <?php if($error): ?>
        <H2>There was an error in your form. Please correct it.</H2>
    <?php endif; ?>
    <TABLE bgcolor='#CCCCCC'> 
        <TR>
            <TD><Input type='hidden' name='pk' value="<?php echo $pk ?>"></TD>
         </TR>
        <TR>
            <TH>Email</TH>
            <TD><Input type='text' name='name' value="<?php echo htmlspecialchars($name) ?>"></TD>
         </TR>
        <TR>
            <TH>Headers</TH>
            <TD><input type='text' name='headers' value="<?php echo htmlspecialchars($headers) ?>"></TD>
        </TR>
        <tr>
            <TH>Enter text</TH>
            <TD><textarea name='text'><?php echo htmlspecialchars($text) ?></textarea></td>
        </tr>
    </table>
    <input type='submit' value='Add Record'>
    <input type='button' onclick='openWin()' value='Exit'>
</form>
</body>
</head>
</html>
