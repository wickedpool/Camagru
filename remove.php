<?php
	session_start();
	include_once 'db.php';
	header("Location: gallery.php?page=$_GET[page]");
	try {
		$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $db->prepare('DELETE FROM gallery WHERE login = :log AND id = :id_img');
		$stmt->bindParam(':log', $_SESSION[login], PDO::PARAM_STR);
		$stmt->bindParam(':id_img', $_GET[img], PDO::PARAM_INT);
		$stmt->execute();
	} catch (PDOException $msg) {
		echo 'Error: '.$msg->getMessage();
	}
?>
