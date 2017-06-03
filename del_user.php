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
	$stmt = $db->prepare('DELETE FROM membres WHERE login = :log');
	$stmt->bindParam(':log', $_POST[login], PDO::PARAM_STR);
	$stmt->execute();
} catch (PDOException $msg) {
	echo 'Error: '.$msg->getMessage();
	exit;
}
try {
	$stmt = $db->prepare('DELETE FROM jaime WHERE login = :log');
	$stmt->bindParam(':log', $_POST[login], PDO::PARAM_STR);
	$stmt->execute();
} catch (PDOException $msg) {
	echo 'Error: '.$msg->getMessage();
	exit;
}
try {
	$stmt = $db->prepare('DELETE FROM commentaire WHERE login = :log');
	$stmt->bindParam(':log', $_POST[login], PDO::PARAM_STR);
	$stmt->execute();
} catch (PDOException $msg) {
	echo 'Error: '.$msg->getMessage();
	exit;
}
?>

<div class=nav>
			<form class='logform' action="del_user.php" method="post">
				<center>
				<label class='mytext' for="login">User login</label><br>
				<center><input class='mybar' type="text" name="login" placeholder="entrez le login en question" /><br/>
				<input class='mybutton' type="submit" name="send" /><br/>
				</center>
			</form>
		</div>
	</body>
</html>
