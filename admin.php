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
    if(confirm("Do you realy want to delete the row?")){
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
    <h2>Email Report</h2>
    <h2><?php echo "User: ".$username ?></h2>
    <?php if($error): ?>
        <h2>There was an error in your report. Please correct it.</h2>
    <?php endif; ?>
    <table border=1 class=table  id=logs>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>To_whom</th>
            <th>Subject</th>
            <th>Headers</th>
            <th></th>
            <th></th>
        </tr>
    <tbody>
<?php while($row = mysqli_fetch_array($result)): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['id']) ?></td>
            <td><?php echo htmlspecialchars($row['to_whom']) ?></td>
            <td><?php echo htmlspecialchars($row['subject']) ?></td>
            <td><?php echo htmlspecialchars($row['textmsg']) ?></td>
            <td><?php echo htmlspecialchars($row['headers']) ?></td>
            <td><button class=bdelete id=<?php echo htmlspecialchars($row['id']) ?>>delete</button></td>
            <td><button class=bupdate onclick=openWinUpdate('<?php htmlspecialchars($row['id']) ?>')>update</button></td>
        </tr>
<?php endwhile; ?>
<p></p><button class=binsert onclick='openWinInsert()'>insert</button></p>
</tbody>
</table>
</body>
</html>
