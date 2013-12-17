<?php
session_start();
$ticket=$_GET['ticket'];
$ticket=substr($ticket,strpos($ticket,'>'));
$ticket=substr($ticket,0,strlen($ticket));
$ticket=trim($ticket);
$ticket=utf8_encode($ticket);
$service=utf8_encode("http://10.0.0.10/login.php");
$url='https://sso.pdx.edu/cas/proxyValidate?ticket='.$ticket.'&service='.$service;
$output=file_get_contents($url);
if (strpos($output,"whg")>0) $_SESSION["user"] = "whg";
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
die('You do not have a record in the database!');
}
header("Location: http://10.0.0.10/admin.php");
?>
