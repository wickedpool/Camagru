<?php

include_once 'db.php';

if (empty($_POST["email"]) || empty($_POST["login"]) || empty($_POST["mdp"])) {
	header("location: create_user.php?msg=Merci de remplir tous les champs.\n");
} else if (strlen($_POST["mdp"]) < 8) {
	header("location: create_user.php?msg=Le mot de passe doit contenir au moins 8 caracteres.\n");
} else if ($_POST['mdp'] != $_POST['remdp']) {
	header("location: create_user.php?msg=Les mots de passe ne sont pas identiques.\n");
}

try {
	$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $db->prepare('SELECT COUNT(*) FROM membres WHERE login = :login');
	$stmt->bindParam(':login', $_POST[login], PDO::PARAM_STR);
	$stmt->execute();
} catch (PDOException $mess) {
	echo 'Error: '.$mess->getMessage();
	exit;
}
if ($stmt->fetchColumn()) {
	header("Location: create_user.php?msg=Login deja pris.\n");
	exit;
}
$passwd = sha1($_POST[passwd]);
$hash = md5( rand(0,1000) );

try {
	$stmt = $db->prepare('INSERT INTO membres (email, login, passwd, hash) VALUES (:email, :login, :passwd, :hash)');
	$stmt->bindParam(':email', $_POST[email], PDO::PARAM_STR);
	$stmt->bindParam(':login', $_POST[login], PDO::PARAM_STR);
	$stmt->bindParam(':passwd', $passwd, PDO::PARAM_STR);
	$stmt->bindParam(':hash', $hash, PDO::PARAM_STR);
	$stmt->execute();
} catch (PDOException $mess) {
	echo 'Error: '.$mess->getMessage();
	exit;
}

$to      = $_POST[email];
$subject = 'Signup | Verification';
$message = '

	Thanks for signing up!
	Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.

	Merci pour votre inscription!
	Votre compte a ete cree, vous pouvez maintenant vous connecter avec vos identifiants apres avoir active votre compte en cliquant sur le lien en dessous.

	------------------------
	Username: '.$login.'
	Password: '.$passwd.'
	------------------------

	Please click this link to activate your account:
	http://localhost:8080/Camagru/verify.php?email='.$_POST[email].'&hash='.$hash.'

	';

$headers = 'From:wickedpool@camagru.42.fr' . "\r\n";
mail($to, $subject, $message, $headers);
$_SESSION['login']=$login;
header("Location: index.php?msg=Votre compte a ete cree. Merci de consulter vos mail pour activer votre compte.\n");

?>
