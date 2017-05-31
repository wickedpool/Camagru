<?php

include_once 'db.php';

try {
	$DB = explode(';', $DB_DSN);
	$database = substr($DB[1], 7);
	$db = new PDO("$DB[0]", $DB_USER, $DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->exec("CREATE DATABASE IF NOT EXISTS $database");
	echo "Database '$database' created successfully.<br>";
	$db->exec("use $database");
	$db->exec("CREATE TABLE IF NOT EXISTS membres (id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		email VARCHAR(255) NOT NULL,
		login VARCHAR(255) NOT NULL,
		passwd VARCHAR(255) NOT NULL,
		hash VARCHAR(255) NOT NULL,
		admin INT(9) DEFAULT 0,
		active INT(9) DEFAULT 0)");
	echo "Table 'membres' created successfully.<br>";
	$db->exec("CREATE TABLE IF NOT EXISTS gallery (id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		login VARCHAR(255) NOT NULL,
		img VARCHAR(255) NOT NULL)");
	echo "Table 'gallery' created successfully.<br>";
	$db->exec("CREATE TABLE IF NOT EXISTS commentaire (id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		login VARCHAR(255) NOT NULL,
		id_image VARCHAR(255) NOT NULL,
		comment VARCHAR(255) NOT NULL)");
	echo "Table 'commentaire' created successfully.<br>";
	$db->exec("CREATE TABLE IF NOT EXISTS jaime (id INT(9) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		login VARCHAR(255) NOT NULL,
		id_image VARCHAR(255) NOT NULL)");
	echo "Table 'jaime' created successfully.<br>";
} catch (PDOException $e) {
	echo $sql.'<br>'.$e->getMessage();
}
$db = null;
?>

<!DOCTYPE html>
<html>
  <head>
	<meta charset="utf-8">
	<title>Camagru</title>
  </head>
  <body>
	<form action="index.php" class="inline">
		<button autofocus="autofocus" tabindex="1">Index</button>
	</form>
  </body>
</html>
