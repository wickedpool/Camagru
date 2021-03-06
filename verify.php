<?php

include_once 'db.php';
include_once 'escape.php';

try {
	$email = Escape::bdd($_GET[email]);
	$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD); 
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $db->prepare('SELECT COUNT(*) FROM membres WHERE email = :email AND hash = :hash');
	$stmt->bindParam(':email', $email, PDO::PARAM_STR);
	$stmt->bindParam(':hash', $_GET[hash], PDO::PARAM_STR);
	$stmt->execute();
} catch (PDOException $msg) {
	echo "Error : ".$msg->getMessage();
	exit;
}
if ($stmt->fetchColumn()) {
	try {
		$stmt = $db->prepare("UPDATE membres SET active = '1' WHERE email = :email AND hash = :hash");
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->bindParam(':hash', $_GET[hash], PDO::PARAM_STR);
		$stmt->execute();
	} catch (PDOException $msg) {
		echo "Error : ".$msg->getMessage();
		exit;
	}
	header("Location: index.php?msg=Votre compte est actif.\n");
} else {
	header("Location: index.php?msg=error.\n");
}
?>
	</body>
</html>
