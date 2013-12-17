<?php
session_start();

$pk="";
$name="";
$text="";
$headers="";
$error="";
if(!empty($_SESSION['user'])){
    $username=$_SESSION['user'];
    if (!$conn=mysqli_connect("tutorials.local.10.0.0.10.nip.io",$username))
    {
        echo "failed to connect to mysql ".mysql_connect_error();
    }

    if (!mysqli_select_db($conn,"tutorials")){
        echo "Could not select db!";
        exit;
    }


    if (!isset($_POST['pk'])) {    
        $pk=$_GET['id']; 
        $pk_safe= mysql_real_escape_string($pk);
        $sql="select id, to_whom, subject, textmsg, headers from email_log where  id=".$pk_safe;
        $result=mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($result)) {
            $pk=$row['id'];
            $name=htmlspecialchars($row['to_whom']);
            $headers=htmlspecialchars($row['headers']);
            $text=htmlspecialchars($row['textmsg']);
        }
        unset($_GET['id']);
    }

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
        $sql="update  email_log set to_whom = '".$name_safe."',textmsg='".$text_safe."', headers='".$headers_safe."' where id =".$pk_safe;
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
<H2>Update Email</H2>
<?php echo "<H3>User :".$_SESSION['user']."</H3>" ?>
    <?php if($error): ?>
        <H2>There was an error in your form. Please correct it.</H2>
    <?php endif; ?>
    <TABLE> 
        <TR>
            <TD><Input type='hidden' name='pk' value="<?php echo $pk ?>"></TD>
         </TR>
        <TR>
            <TH>Name</TH>
            <TD><Input type='text' name='name' value="<?php echo htmlspecialchars($name) ?>"></TD>
         </TR>
        <TR>
            <TH>E-mail</TH>
            <TD><input type='text' name='headers' value="<?php echo htmlspecialchars($headers) ?>"></TD>
        </TR>
        <tr>
            <TH>Enter text</TH>
            <TD><textarea name='text'><?php echo htmlspecialchars($text) ?></textarea></td>
        </tr>
    </table>
    <input type='submit' value='Update Mail'>
    <input type='button' onclick='openWin()' value='Exit'>
</form>
</body>
</head>
</html>
