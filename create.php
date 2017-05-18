<?php

	if ($_GET[msg]) {echo "<script>alert(\"".htmlentities($_GET[msg])."\");window.location.href = \"create.php\";</script>";}

include_once 'header.php';
include_once 'db.php';

echo '<h4>Veuillez remplir tous les champs, un mail vous sera envoyé pour activer votre compte </h4>';

if (empty($_POST["email"]) || empty($_POST["login"]) || empty($_POST["mdp"])) {
		header("location: create.php?msg=Merci de remplir tous les champs.\n");
} else if (strlen($_POST["mdp"]) < 8) {
		header("location: create.php?msg=Le mot de passe doit contenir au moins 8 caracteres.\n");
} else if ($_POST['mdp'] != $_POST['remdp']) {
		header("location: create.php?msg=Les mots de passe ne sont pas identiques.\n");
}

try {
	$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $db->prepare('SELECT COUNT(*) FROM membres WHERE login = :login');
	$stmt->bindParam(':login', $_POST[login], PDO::PARAM_STR);
	$stmt->execute();
} catch (PDOException $mess) {
	echo '<h4>Error: '.$mess->getMessage()'</h4>';
	exit;
}
if ($stmt->fetchColumn()) {
	header("Location: create.php?msg=Login deja pris.\n");
	exit;
}
$passwd = sha1($_POST[passwd]);
$hash = md5( rand(0,1000) );

try {
	$stmt = $db->prepare('INSERT INTO membres (email, login, passwd, hash) VALUES (:email, :login, :passwd, :hash)');
	$stmt->bindParam(':email', $_POST[email], PDO::PARAM_STR,);
	$stmt->bindParam(':login', $_POST[login], PDO::PARAM_STR,);
	$stmt->bindParam(':email', $passwd, PDO::PARAM_STR,);
	$stmt->bindParam(':email', $hash, PDO::PARAM_STR,);
	$stmt->execute();
} catch (PDOException $mess) {
	echo '<h4>Error: '.$mess->getMessage()'</h4>';
	exit;
}

/*else {
		$login = $_POST['login'];
		$passwd = $_POST['mdp'];
		$email = $_POST['email'];
		$hash = md5( rand(0,1000) );
		// CONNEXION SQL
		$db = mysqli_connect("localhost", "root", "root", "camagru");
		$login = preg_replace("[^A-Za-z0-9]","",$login);
		$passwd = preg_replace("[^A-Za-z0-9]","",$passwd);
		//crypt
		//SQL request
		$query = mysqli_query($db, "SELECT * FROM membres WHERE login='$login' LIMIT 1");
		$is_found = mysqli_fetch_assoc($query);
		$query2 = mysqli_query($db, "SELECT * FROM membres WHERE email='$email'");
		$email_found = mysqli_fetch_assoc($query2);
		if($email_found || $is_found){
			echo '<h4>L\'email ou le login existe deja! Merci de reessayer !</h4>';
		}
		else {
			//echo "<script>window.location.replace(\"index.php\");</script>";
			echo "<h4>Votre compte a ete cree, rdv boite mail!</h4>";
			$passwd = sha1($passwd);
			$query = mysqli_query($db, "INSERT INTO `membres`(`email`, `login`, `passwd`, `hash`) VALUES ('$email', '$login', '$passwd', '$hash')");
 */
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
	http://localhost:8080/Camagru/verify.php?email='.$email.'&hash='.$hash.'

	';

			$headers = 'From:wickedpool@camagru.42.fr' . "\r\n";
			mail($to, $subject, $message, $headers);
			$_SESSION['login']=$login;
			header("Location: index.php?msg=Votre compte a ete cree. Merci de consulter vos mail pour activer votre compte.\n");
		}
	}
}

?>
		<div class=nav>
			<form class='logform' action="create.php" method="post">
				<center>
				<label class='mytext' for="email">Votre adresse email</label><br>
				<input class='mybar' type="email" name="email" placeholder="exemple@exemple.com"/><br/>
				<label class='mytext' for="login">Votre login</label><br>
				<center><input class='mybar' type="text" name="login" placeholder="entrez votre login" /><br/>
				<label class='mytext' for="mdp">Votre mot de passe</label><br>
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
