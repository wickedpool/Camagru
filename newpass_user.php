<?php

include_once('header.php');

if ($_GET[msg]) {echo "<script>alert(\"".htmlentities($_GET[msg])."\");window.location.href = \"newpass_user.php\";</script>";}

if (empty($_POST[mdp]) || empty($_POST[remdp]) || empty($_POST[email])) {
	header("Location: newpass_user.php?msg=Merci de remplir tous les champs.\n");
} else if (strlen($_POST[mdp]) < 8) {
	header("Location: newpass_user.php?msg=Le mot de passe doit contenir au moins 8 caracteres.\n");
} else if ($_POST[mdp] != $_POST[remdp]) {
	header("Location: newpass_user.php?msg=Les mots de passe ne sont pas identiques.\n");
}

try {
	include_once('db.php');
	$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $db->prepare('SELECT COUNT(*) FROM membres WHERE email = :email');
	$stmt->bindParam(':email', $_POST[email], PDO::PARAM_STR);
	$stmt->execute();
} catch (PDOException $msg) {
	echo "Error : ".$msg->getMessage();
	exit;
}
$passwd = hash('whirlpool', $_POST[mdp]);
if ($stmt->fetchColumn()) {
	try {
		$stmt = $db->prepare("UPDATE membres SET passwd = :passwd WHERE email = :email");
		$stmt->bindParam(':passwd', $passwd, PDO::PARAM_STR);
		$stmt->bindParam(':email', $_POST[email], PDO::PARAM_STR);
		$stmt->execute();
	} catch (PDOException $msg) {
		echo "Error : ".$msg->getMessage();
		exit;
	}
	header("Location: index.php?msg=Votre mot de passe a ete modifie.\n");
}

?>

			<form class='logform' action="newpass_user.php" method="post">
				<center>
				<label class='mytext' for='email'>Votre adresse email</label><br>
				<input class='mybar' type='email' name="email" placeholder="exemple@exemple.com"/><br/>
				<label class='mytext' for="mdp">Votre nouveau mot de passe</label><br>
				<input class='mybar' type="password" name="mdp" placeholder="entrez votre mot de passe" /><br/>
				<label class='mytext' for="remdp">Confirmez votre  mot de passe</label><br>
				<input class='mybar' type="password" name="remdp" placeholder="entrez a nouveau votre mot de passe" /><br/>
				<input class='mybutton' type="submit" name="connexion" /><br/>
				</center>
			</form>
		</div>
		<a class='mylink' href = "index.php">Retour a la page d'accueil</a>
	</body>
</html>
