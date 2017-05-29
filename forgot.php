<?php

include_once 'db.php';

if (empty($_POST['email'])) {
	header("location: forgot_user.php?msg=Merci de remplir le champ email.\n");
}

try {
	$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $db->prepare('SELECT * FROM membres WHERE email = :email');
	$stmt->bindParam(':email', $_POST[email], PDO::PARAM_STR);
	$stmt->execute();
} catch (PDOException $msg) {
	echo 'Error :'.$msg->getMessage();
}
if ($stmt->fetchColumn()) {
	try {
		$newpass = rand(5, 4000000);
		$stmt = $db->prepare('UPDATE membres SET passwd = :passwd WHERE email = :email');
		$stmt->bindParam(':passwd', $newpass, PDO::PARAM_STR);
		$stmt->bindParam('email', $_POST[email], PDO::PARAM_STR);
		$stmt->execute();
		$to = $_POST[email];
		$subject = 'New Password | Camagru';
		$message = '

	Cliquez ce lien pour chager votre mot de passe :

	---------------------
		http://localhost:8080/Camagru/newpass_user.php?email='.$_POST[email].'&hash='.$newpass.'
	---------------------

	Enjoy!';
		$headers = 'From:wickedpool@camagru.42.fr' . "\r\n";
		mail($to, $subject, $message, $headers);

	} catch (PDOException $msg) {
		echo "Error : ".$msg->getMessage();	
		exit;
	}
	header("Location: index.php?msg=Regardez vos mail pour changer votre mot de passe !.\n");
} else {
	header("Location: index.php?msg=Error.\n");
}

?>
