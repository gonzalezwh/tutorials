<?php
$connection = ldap_connect('ldap.oit.pdx.edu');

$search = ldap_search($connection, 'dc=pdx,dc=edu', '(& (memberUid=mdj2) (objectclass=posixGroup))');
$results = ldap_get_entries($connection, $search);
echo "Count: ".$results['count'];
echo '<br>';
print_r($results);


echo '<br>';
echo '<br>';
echo '<br>';

$search = ldap_search($connection, 'dc=pdx,dc=edu', '(& (| (cn=whg) (cn=arc) (cn=arcstaff)) (memberUid=whg) (objectclass=posixGroup))');
$results = ldap_get_entries($connection, $search);
echo "Count: ".$results['count'];
echo '<br>';
print_r($results);
?>
