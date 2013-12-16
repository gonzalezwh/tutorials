<?php
session_start();
$error=0;
if (!isset($_SESSION['user'])) {
    die('User name does not have access! ');
}
$username=$_SESSION["user"];
$username=str_replace("*","",$username);
$username=str_replace("(","",$username);
$username=str_replace(")","",$username);
$username=str_replace(chr(92),"",$username);
$username=str_replace("\n","",$username);

$connection = ldap_connect('ldap.oit.pdx.edu');

$search = ldap_search($connection, 'dc=pdx,dc=edu', '(& (memberUid='.$username.') (objectclass=posixGroup))');
$results = ldap_get_entries($connection, $search);
if(!empty($username) && $results['count']==1){
    if (!$conn=mysqli_connect("tutorials.local.10.0.0.10.nip.io",$username))
    {
        echo "failed to connect to mysql ".mysql_connect_error();
    }

    if (!mysqli_select_db($conn,"tutorials")){
        echo "Could not select db!";
        exit;
    }

    if (empty($username) && ($results['count']!=1)) {$error=1; $mname = 'Please enter the name!';}
        if ($error==0) {  
            $sql="select id, to_whom, subject, textmsg, headers from email_log order by id";
            $result=mysqli_query($conn,$sql);

            if (!mysqli_close($conn)){
                die('Error: '.mysql_error($conn));
            }
        }
}
?>
<html>
<head>
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript"> 
$(document).ready(function(){
    $(".button").click(function(){
    var del_id = $(this).attr('id');
    var info = 'id=' + del_id;
    if(confirm("Do you realy want to delete the row?"))
    {
    var tr = $(this).closest('tr');
    tr.remove();
    $.ajax({
    type: "POST",
    url: "/delRowAdmin.php",
    data: info,
    success: function(){
    }
    });
    }
    });
})
</script>
</head>
<body>
    <H2>Email Report</H2>
    <H2><?php echo "Usuario: ".$username ?></H2>
    <?php if($error): ?>
        <H2>There was an error in your report. Please correct it.</H2>
    <?php endif; ?>
    <TABLE BORDER=1 id=logs>
        <TR>
            <TH>Id</TH>
            <TH>Name</TH>
            <TH>To_whom</TH>
            <TH>Subject</TH>
            <TH>Headers</TH>
            <TH></TH>
        </TR>
<?php while($row = mysqli_fetch_array($result)) {
    echo "<TR>";
    echo "<TD>".htmlspecialchars($row['id'])."</TD>";
    echo "<TD>".htmlspecialchars($row['to_whom'])."</TD>";
    echo "<TD>".htmlspecialchars($row['subject'])."</TD>";
    echo "<TD>".htmlspecialchars($row['textmsg'])."</TD>";
    echo "<TD>".htmlspecialchars($row['headers'])."</TD>";
    echo "<TD><button class=button id=".htmlspecialchars($row['id']).">delete</button></TD>";
    echo "</TR>";
} ?>
    </table>
</body>
</html>
