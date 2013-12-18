<?php
session_start();

if (!$conn=mysqli_connect("tutorials.local.10.0.0.10.nip.io",'whg'))
{
    echo "failed to connect to mysql ".mysqli_connect_error();
}
if (!mysqli_select_db($conn,"tutorials")){
    echo "Could not select db!";
    exit;
}

if (!isset($_SESSION['user'])) {
    $ticket=$_GET['ticket'];
    $ticket=substr($ticket,strpos($ticket,'>'));
    $ticket=substr($ticket,0,strlen($ticket));
    $ticket=trim($ticket);
    $ticket=utf8_encode($ticket);
    $service=utf8_encode("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
    $url='https://sso.pdx.edu/cas/proxyValidate?ticket='.$ticket.'&service='.$service;
    $output=file_get_contents($url);
    if (strpos($output,"whg")>0)
        $_SESSION["user"] = "whg";
    $username=$_SESSION["user"];  
    $username=str_replace("*","",$username);
    $username=str_replace("(","",$username);
    $username=str_replace(")","",$username);
    $username=str_replace(chr(92),"",$username);
    $username=str_replace("\n","",$username);
    $connection = ldap_connect('ldap.oit.pdx.edu');
    $search = ldap_search($connection, 'dc=pdx,dc=edu', '(& (memberUid='.$username.') (objectclass=posixGroup))');
    $results = ldap_get_entries($connection, $search);
    if ($results['count']!=1){
            header("Location: http://10.0.0.10/home.php");
    }
           
    header("Location: " . $_GET['next']);
}

$username = $_SESSION['user'];

?>
