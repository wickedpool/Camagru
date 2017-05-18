<?php

include_once 'db.php';

try {
	$DB = explode(';', $DB_DSN);
	$database = substr($DB[1], 7);
	$dbh = new PDO("$DB[0]", $DB_USER, $DB_PASSWORD);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$dbh->exec("CREATE DATABASE IF NOT EXISTS $database");
	echo "Database '$database' created successfully.<br>";
	$dbh->exec("use $database");
	$dbh->exec("CREATE TABLE IF NOT EXISTS membres (id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		email VARCHAR(255) NOT NULL,
		login VARCHAR(255) NOT NULL,
		passwd VARCHAR(255) NOT NULL,
		hash VARCHAR(255) NOT NULL,
		admin INT(9) DEFAULT 0,
		active INT(9) DEFAULT 0)");
	echo "Table 'membres' created successfully.<br>";
	$dbh->exec("CREATE TABLE IF NOT EXISTS gallery (id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		login VARCHAR(255) NOT NULL,
		img VARCHAR(255) NOT NULL)");
	echo "Table 'gallery' created successfully.<br>";
} catch (PDOException $e) {
	echo $sql.'<br>'.$e->getMessage();
}
$dbh = null;
?>

<!DOCTYPE html>
<html>
  <head>
	<meta charset="utf-8">
	<title>Camagru - Setup</title>
  </head>
  <body>
	<form action="../" class="inline">
		<button autofocus="autofocus" tabindex="1">Index</button>
	</form>
  </body>
</html>
