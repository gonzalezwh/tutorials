<?php
include('login.php');
$error=0;

    if (empty($username)) {$error=1; $mname = 'Please enter the name!';}
        if ($error==0) {  
            $sql="select id, to_whom, subject, textmsg, headers from email_log order by id";
            $result=mysqli_query($conn,$sql);

            if (!mysqli_close($conn)){
                die('Error: '.mysqli_error($conn));
            }
        }
?>
<html>
<head>
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript"> 
$(document).ready(function(){
    $(".bdelete").click(function(){
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
});
</script>
<script type="text/javascript">
    function openWinUpdate(id) {
    var win = window.open('/updateRowAdmin.php?id='+id,'_top');
    }
    function openWinInsert() {
    var win = window.open('/addRowAdmin.php','_top');
    }  
</script>
<style>
.table  tbody tr:nth-child(odd) {
  background-color: #DDDDEE;
}

.table tbody tr:nth-child(even) {
  background-color: #CCCCCC;
}

.table tbody tr:hover {
  background-color: white;
}
.table th{
  background-color: gray;
}
</style>
</head>
<body>
    <H2>Email Report</H2>
    <H2><?php echo "User: ".$username ?></H2>
    <?php if($error): ?>
        <H2>There was an error in your report. Please correct it.</H2>
    <?php endif; ?>
    <TABLE BORDER=1 class=table  id=logs>
        <TR>
            <TH>Id</TH>
            <TH>Name</TH>
            <TH>To_whom</TH>
            <TH>Subject</TH>
            <TH>Headers</TH>
            <TH></TH>
            <TH></TH>
            <TH></TH>
        </TR>
        <TBODY>
<?php while($row = mysqli_fetch_array($result)): ?>
    <TR>";
    <TD><?php echo htmlspecialchars($row['id']) ?></TD>
    <TD>".htmlspecialchars($row['to_whom'])."</TD>";
    <TD>".htmlspecialchars($row['subject'])."</TD>";
    echo "<TD>".htmlspecialchars($row['textmsg'])."</TD>";
    echo "<TD>".htmlspecialchars($row['headers'])."</TD>";
    echo "<TD><button class=bdelete id=".htmlspecialchars($row['id']).">delete</button></TD>";
    echo "<TD><button class=bupdate onclick=openWinUpdate('".htmlspecialchars($row['id'])."')>update</button></TD>";
    echo "</TR>";
   
<?php endwhile; ?>
echo "<p></p><button class=binsert onclick='openWinInsert()'>insert</button></p>";
?>
    </TBODY>
    </table>
    
</body>
</html>
