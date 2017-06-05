<?php
session_start();
include_once 'db.php';
include_once 'escape.php';

if (empty($_POST[login]) || empty($_POST[passwd])) {
	header("Location: connexion_user.php?msg=Merci de remplir tous les champs.\n");
	exit();
} else {
	try {
		$log = Escape::bdd($_POST[login]);
		$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $db->prepare('SELECT COUNT(*) FROM membres WHERE login = :login');
		$stmt->bindParam(':login', $log, PDO::PARAM_STR);
		$stmt->execute();
	} catch (PDOException $e) {
		echo 'Error :'.$e->getMessage();
	}
	if ($user = $stmt->fetchColumn()) {
		try {
			$passwd = hash('whirlpool', Escape::bdd($_POST[passwd]));

			$stmt = $db->prepare('SELECT COUNT(*) FROM membres WHERE passwd = :passwd AND login = :login');
			$stmt->bindParam(':login', $log, PDO::PARAM_STR);
			$stmt->bindParam(':passwd', $passwd, PDO::PARAM_STR);
			$stmt->execute();
		} catch (PDOException $e) {
			echo 'Error :'.$e->getMessage();
		}
		if ($stmt->fetchColumn()) {
			try {
				$stmt = $db->prepare("SELECT COUNT(*) FROM membres WHERE passwd = :passwd AND login = :login AND active = '1'");
				$stmt->bindParam(':login', $log, PDO::PARAM_STR);
				$stmt->bindParam(':passwd', $passwd, PDO::PARAM_STR);
				$stmt->execute();
			} catch (PDOException $e) {
				echo 'Error :'.$e->getMessage();
			}
			if ($stmt->fetchColumn()) {
				$_SESSION['login'] = $log;
				header("Location: index.php?msg=Content de vous revoir ".$log." !\n");
				exit();
			} else {
				header("Location: index.php?msg=Activer votre compte.\n");
			}
		} else {
			header("Location: connexion_user.php?msg=Mauvais mot de passe.\n");
			exit();
		}
		header("Location: connexion_user.php?msg=Essaie encore.\n");
		exit();
	}
	header("Location: connexion_user.php?msg=Essaie encore.\n");
	exit();
}
?>
