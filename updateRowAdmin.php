<?php
include('login.php');
$pk="";
$name="";
$text="";
$headers="";
$error="";
if(!empty($_SESSION['user'])){
    $username=$_SESSION['user'];
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
    if (isset($_POST['pk'])){
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
<h2>Update Email</h2>
<?php echo "<h3>User :".$_SESSION['user']."</h3>" ?>
    <?php if($error): ?>
        <h2>There was an error in your form. Please correct it.</h2>
    <?php endif; ?>
    <table bgcolor='#CCCCCC'>  
        <tr>
            <td><Input type='hidden' name='pk' value="<?php echo $pk ?>"></td>
         </tr>
        <tr>
            <th>Name</th>
            <td><Input type='text' name='name' value="<?php echo htmlspecialchars($name) ?>"></td>
         </tr>
        <tr>
            <th>E-mail</th>
            <td><input type='text' name='headers' value="<?php echo htmlspecialchars($headers) ?>"></td>
        </tr>
        <tr>
            <th>Enter text</th>
            <td><textarea name='text'><?php echo htmlspecialchars($text) ?></textarea></td>
        </tr>
    </table>
    <input type='submit' value='Update Mail'>
    <input type='button' onclick='openWin()' value='Exit'>
</form>
</body>
</head>
</html>
