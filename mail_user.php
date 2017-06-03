<?php

session_start();

include_once('db.php');
try {
	$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $db->prepare('SELECT admin FROM membres WHERE login = :log');
	$stmt->bindParam(':log', $_SESSION['login'], PDO::PARAM_STR);
	$stmt->execute();
} catch (PDOException $msg) {
	echo 'Erreur: '.$msg->getMessage();
	exit;
}
$admin = $stmt->fetchColumn();

if ($admin == 1) {
	include_once('header.php');
} else {
	header('Location: index.php?msg=Vous n\'avez pas acces a cette page');
}

include_once('db.php');

try {
	$stmt = $db->prepare('UPDATE membres SET email = :newmail WHERE email = :email');
	$stmt->bindParam(':newmail', $_POST[newmail], PDO::PARAM_STR);
	$stmt->bindParam(':email', $_POST[email], PDO::PARAM_STR);
	$stmt->execute();
} catch (PDOException $msg) {
	echo 'Error: '.$msg->getMessage();
	exit;
}

?>

<div class=nav>
			<form class='logform' action="mail_user.php" method="post">
				<center>
				<label class='mytext' for="email">adresse email</label><br>
				<input class='mybar' type="email" name="email" placeholder="exemple@exemple.com"/><br/>
				<label class='mytext' for="newmail">Nouvelle adresse email</label><br>
				<input class='mybar' type="email" name="newmail" placeholder="exemple@exemple.com"/><br/>
				<input class='mybutton' type="submit" name="connexion" /><br/>
				</center>
			</form>
		</div>
		<a class='mylink' href = "index.php">Retour a la page d'accueil</a>
	</body>
</html>
