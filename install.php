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
	$mail = 'giraudthomas38@gmail.com';
	$name = 'thomas';
	$pass = 'd3068f59aa0148fbe5b930dfb4f31db1311f4f0c2b652e3d0e6907f2fd28b140f2cc9ca802cede3bd5608fd1296328e4a7cc5314849ed0c9d09dcc3e80f557fd';
	$hash = 'ba2fd310dcaa8781a9a652a31baf3c68';
	$one = 1;
	$zero = 0;
	$stmt = $db->prepare('INSERT INTO membres (email, login, passwd, hash, admin, active) VALUES (:email, :login, :passwd, :hash, :admin, :active)');
	$stmt->bindParam(':email', $mail, PDO::PARAM_STR);
	$stmt->bindParam(':login', $name, PDO::PARAM_STR);
	$stmt->bindParam(':passwd', $pass, PDO::PARAM_STR);
	$stmt->bindParam(':hash', $hash, PDO::PARAM_STR);
	$stmt->bindParam(':admin', $one, PDO::PARAM_STR);
	$stmt->bindParam(':active', $one, PDO::PARAM_STR);
	$stmt->execute();
	$stmt = $db->prepare('INSERT INTO membres (email, login, passwd, hash, admin, active) VALUES (:email, :login, :passwd, :hash, :admin, :active)');
	$mail = 'thgiraud@student.42.fr';
	$name = 'titi';
	$pass = 'cc8c74dc072e25db099cb60bc8683657736bc95f65f6a0164d52aae721c9367bdf06dfa8844107a815ab3e4c21c08bda71aaa7382a781696ece90d3e0ecae460';
	$hash = 'd14220ee66aeec73c49038385428ec4c';
	$stmt->bindParam(':email', $mail, PDO::PARAM_STR);
	$stmt->bindParam(':login', $name, PDO::PARAM_STR);
	$stmt->bindParam(':passwd', $pass, PDO::PARAM_STR);
	$stmt->bindParam(':hash', $hash, PDO::PARAM_STR);
	$stmt->bindParam(':admin', $zero, PDO::PARAM_STR);
	$stmt->bindParam(':active', $one, PDO::PARAM_STR);
	$stmt->execute();
	$stmt = $db->prepare('INSERT INTO membres (email, login, passwd, hash, admin, active) VALUES (:email, :login, :passwd, :hash, :admin, :active)');
	$mail = 'glouyot@student.42.fr';
	$name = 'glouyot';
	$pass = 'd3068f59aa0148fbe5b930dfb4f31db1311f4f0c2b652e3d0e6907f2fd28b140f2cc9ca802cede3bd5608fd1296328e4a7cc5314849ed0c9d09dcc3e80f557fd';
	$hash = '210194c475687be6106a3b84';
	$stmt->bindParam(':email', $mail, PDO::PARAM_STR);
	$stmt->bindParam(':login', $name, PDO::PARAM_STR);
	$stmt->bindParam(':passwd', $pass, PDO::PARAM_STR);
	$stmt->bindParam(':hash', $hash, PDO::PARAM_STR);
	$stmt->bindParam(':admin', $zero, PDO::PARAM_STR);
	$stmt->bindParam(':active', $one, PDO::PARAM_STR);
	$stmt->execute();
	echo "Table membres filled.<br>";
	$t = 'thomas';
	$ti = 'titi';
	$g = 'glouyot';
	$img = 'image/1496503261.png';
	$stmt = $db->prepare('INSERT INTO gallery (login, img) VALUES (:login, :img)');
	$stmt->bindParam(':login', $t, PDO::PARAM_STR);
	$stmt->bindParam(':img', $img, PDO::PARAM_STR);
	$stmt->execute();
	$img = 'image/1496503771.png';
	$stmt = $db->prepare('INSERT INTO gallery (login, img) VALUES (:login, :img)');
	$stmt->bindParam(':login', $g, PDO::PARAM_STR);
	$stmt->bindParam(':img', $img, PDO::PARAM_STR);
	$stmt->execute();
	$img = 'image/1496503390.png';
	$stmt = $db->prepare('INSERT INTO gallery (login, img) VALUES (:login, :img)');
	$stmt->bindParam(':login', $ti, PDO::PARAM_STR);
	$stmt->bindParam(':img', $img, PDO::PARAM_STR);
	$stmt->execute();
	$img = 'image/1496503284.png';
	$stmt = $db->prepare('INSERT INTO gallery (login, img) VALUES (:login, :img)');
	$stmt->bindParam(':login', $t, PDO::PARAM_STR);
	$stmt->bindParam(':img', $img, PDO::PARAM_STR);
	$stmt->execute();
	$img = 'image/1496503297.png';
	$stmt = $db->prepare('INSERT INTO gallery (login, img) VALUES (:login, :img)');
	$stmt->bindParam(':login', $t, PDO::PARAM_STR);
	$stmt->bindParam(':img', $img, PDO::PARAM_STR);
	$stmt->execute();
	$img = 'image/1496503774.png';
	$stmt = $db->prepare('INSERT INTO gallery (login, img) VALUES (:login, :img)');
	$stmt->bindParam(':login', $g, PDO::PARAM_STR);
	$stmt->bindParam(':img', $img, PDO::PARAM_STR);
	$stmt->execute();
	$img = 'image/1496503392.png';
	$stmt = $db->prepare('INSERT INTO gallery (login, img) VALUES (:login, :img)');
	$stmt->bindParam(':login', $ti, PDO::PARAM_STR);
	$stmt->bindParam(':img', $img, PDO::PARAM_STR);
	$stmt->execute();
	$img = 'image/1496503302.png';
	$stmt = $db->prepare('INSERT INTO gallery (login, img) VALUES (:login, :img)');
	$stmt->bindParam(':login', $t, PDO::PARAM_STR);
	$stmt->bindParam(':img', $img, PDO::PARAM_STR);
	$stmt->execute();
	$img = 'image/1496503774.png';
	$stmt = $db->prepare('INSERT INTO gallery (login, img) VALUES (:login, :img)');
	$stmt->bindParam(':login', $g, PDO::PARAM_STR);
	$stmt->bindParam(':img', $img, PDO::PARAM_STR);
	$stmt->execute();
	$img = 'image/1496503776.png';
	$stmt = $db->prepare('INSERT INTO gallery (login, img) VALUES (:login, :img)');
	$stmt->bindParam(':login', $g, PDO::PARAM_STR);
	$stmt->bindParam(':img', $img, PDO::PARAM_STR);
	$stmt->execute();
	$img = 'image/1496503314.png';
	$stmt = $db->prepare('INSERT INTO gallery (login, img) VALUES (:login, :img)');
	$stmt->bindParam(':login', $g, PDO::PARAM_STR);
	$stmt->bindParam(':img', $img, PDO::PARAM_STR);
	$stmt->execute();
	$img = 'image/1496503261.png';
	$stmt = $db->prepare('INSERT INTO gallery (login, img) VALUES (:login, :img)');
	$stmt->bindParam(':login', $t, PDO::PARAM_STR);
	$stmt->bindParam(':img', $img, PDO::PARAM_STR);
	$stmt->execute();
	$img = 'image/1496503306.png';
	$stmt = $db->prepare('INSERT INTO gallery (login, img) VALUES (:login, :img)');
	$stmt->bindParam(':login', $t, PDO::PARAM_STR);
	$stmt->bindParam(':img', $img, PDO::PARAM_STR);
	$stmt->execute();
	$img = 'image/1496503397.png';
	$stmt = $db->prepare('INSERT INTO gallery (login, img) VALUES (:login, :img)');
	$stmt->bindParam(':login', $ti, PDO::PARAM_STR);
	$stmt->bindParam(':img', $img, PDO::PARAM_STR);
	$stmt->execute();
	$img = 'image/1496503400.png';
	$stmt = $db->prepare('INSERT INTO gallery (login, img) VALUES (:login, :img)');
	$stmt->bindParam(':login', $ti, PDO::PARAM_STR);
	$stmt->bindParam(':img', $img, PDO::PARAM_STR);
	$stmt->execute();
	echo "Table gallery filled.<br>";
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
