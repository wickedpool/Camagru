<?php

include_once 'header.php';
include_once 'db.php';

try {
	$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD); 
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $db->prepare('SELECT COUNT(*) FROM membres WHERE email = :email AND hash = :hash');
	$stmt->bindParam(':email', $_GET[email], PDO::PARAM_STR);
	$stmt->bindParam(':hash', $_GET[hash], PDO::PARAM_STR);
	$stmt->execute();
} catch (PDOException $msg) {
	echo "<h4>Error : '.$msg->getMessage().'</h4>";
	exit;
}
if ($stmt->fetchColumn()) {
	try {
		$stmt = $dbh->prepare("UPDATE membres SET active='1' WHERE email = :email AND hash = :hash");
		$stmt->bindParam(':email', $_GET[email], PDO::PARAM_STR);
		$stmt->bindParam(':hash', $_GET[hash], PDO::PARAM_STR);
		$stmt->execute();
	} catch (PDOException $msg) {
		echo "<h4>Error : '.$msg->getMessage().'</h4>";
		exit;
	}
	header("Location: index.php?msg=Votre compte est actif");
} else {
	header("Location: index.php?msg=error.\n");
}
	/*if ($_GET['email']) {
		$email = $_GET['email'];
		$hash = $_GET['hash'];
		$active = 1;
		$search = mysqli_query($db, "SELECT email, hash, active FROM membres WHERE email='.$email.' AND hash='.$hash.' AND active='0'"); 
		if($search) {
			if (mysqli_query($db, "UPDATE membres SET active='.$active.' WHERE email='.$email.' AND hash='.$hash.'"))
				echo '<h4>Votre compte a ete active vous pouvez maintenant profiter pleinement de ce merveilleux site</h4>';
			else {
				echo '<h4>Votre compte n\'a pas ete active car l\'url n\'est pas valide ou votre compte a deja ete validee</h4>';
			}
		} else {
			echo '<h4>Votre compte n\'a pas ete active car l\'url n\'est pas valide ou votre compte a deja ete valide</h4>';
		}
	} else {
		echo '<h4>L\'url est invalide, veuillez utiliser le lien transmis par mail</h4>';
	} */
?>
	</body>
</html>
