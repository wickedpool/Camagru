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
	echo "Table 'jaime' created successfully.<br><br><br>";
	$db->exec('INSERT INTO membres (id, email, login, passwd, hash, admin, active) VALUES
		(1, giraudthomas38@gmail.com, thomas, d3068f59aa0148fbe5b930dfb4f31db1311f4f0c2b652e3d0e6907f2fd28b140f2cc9ca802cede3bd5608fd1296328e4a7cc5314849ed0c9d09dcc3e80f557fd, ba2fd310dcaa8781a9a652a31baf3c68, 1, 1),
		(2, thgiraud@student.42.fr, titi, cc8c74dc072e25db099cb60bc8683657736bc95f65f6a0164d52aae721c9367bdf06dfa8844107a815ab3e4c21c08bda71aaa7382a781696ece90d3e0ecae460, d14220ee66aeec73c49038385428ec4c, 0, 1),
		(3, glouyot@student.42.fr, glouyot, d3068f59aa0148fbe5b930dfb4f31db1311f4f0c2b652e3d0e6907f2fd28b140f2cc9ca802cede3bd5608fd1296328e4a7cc5314849ed0c9d09dcc3e80f557fd, 98f13708210194c475687be6106a3b84, 0, 1');
	echo "Table membres filled";
	$db->exec('INSERT INTO gallery (id, login, img) VALUES
		(1, thomas, image/1496503261.png),
		(2, glouyot, image/1496503771.png),
		(3, titi, image/1496503390.png),
		(4, thomas, image/1496503284.png),
		(5, thomas, image/1496503297.png),
		(6, glouyot, image/1496503774.png),
		(7, titi, image/1496503392.png),
		(8, thomas, image/1496503302.png),
		(9, glouyot, image/1496503774.png),
		(10, glouyot, image/1496503776.png),
		(11, glouyot, image/1496503261.png),
		(12, thomas, image/1496503306.png),
		(13, thomas, image/1496503314.png),
		(14, titi, image/1496503397.png),
		(15, titi, image/1496503400.png),');
	echo "Table gallery filled";
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
