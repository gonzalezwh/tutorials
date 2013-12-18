
<?php $dsn = 'mysql:host=localhost;dbname=tutorials'; $username = 'whg';
$password = 'password'; try {
    $dbh = new PDO($dsn, $username);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

$sql = 'SELECT id, to_whom, subject, textmsg, headers
    FROM email_log WHERE textmsg like ?';

  
$stmt = $dbh->prepare($sql); if ($stmt->execute(array('%E%'))) {
  while ($row = $stmt->fetch()) {
    echo ('<h1>'.$row['id'].'</h1>'); echo '<br>';
	echo (htmlentities($row['to_whom'])); echo '<br>';
	    echo (htmlentities($row['subject'])); echo '<br>';
	echo (htmlentities($row['textmsg'])); echo '<br>';
	    echo (htmlentities($row['headers'])); echo '<br>';
  } echo '<br>'; echo '<br>'; echo '<br>';
}
  
?>
