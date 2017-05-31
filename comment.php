<?php
session_start();
if (!$_SESSION[login]) {
	header ("Location: index.php?msg=Vous deve vous connecter pour acceder a cette page.\n");
	exit;
}
if (empty($_POST[comm]) || empty($_GET[id_image])) {
	header("Location: gallery.php?page=$_GET[page]");
	exit;
}
include_once "db.php";
header("Location: gallery.php?page=$_GET[page]");
try {
	$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $db->prepare('INSERT INTO commentaire (login, id_image, comment) VALUES	(:login, :id_img, :comment)');
	$stmt->bindParam(':id_image', $_GET[id_image], PDO::PARAM_INT);
	$stmt->bindParam(':login', $_SESSION[login], PDO::PARAM_STR);
	$stmt->bindParam(':id_image', $_GET[comment], PDO::PARAM_STR);
	$stmt->execute();
	$stmt = $db-prepare('SELECT membres.mail FROM membres INNER JOIN gallery ON membres.login = gallery.login WHERE gallery.id = :id_img');
	$stmt->bindParam(':id_img', $_GET[id_image], PDO::PARAM_INT); 
	$stmt->execute();
} catch (PDOException $msg) {
	echo 'Erreur: '.$msg->getMessage();
	exit;
}


?>
