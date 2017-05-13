<?php

include_once 'header.php';


if ($_POST['login'] && $_POST['login'] !== "" && $_POST['mdp'] !== "") {
	if (empty($_POST["email"])) {
		echo '<h4>Veuillez remplir tous les champs, un mail vous sera envoyé pour activer votre compte </h4>';
	} else if (empty($_POST["login"])) {
		echo '<h4>Champ login vide </h4>';
	} else if (empty($_POST["mdp"])) {
		echo '<h4>Champ password vide</h4>';
	} else if (strlen($_POST["mdp"]) < 8) {
		echo '<h4>Le mot de passe doit contenir au moins 8 caracteres</h4>';
	} else if ($_POST['mdp'] != $_POST['remdp']) {
		echo '<h4>Les mots de passe sont differents</h4>';
	} else {
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
			echo "<script>window.location.replace(\"create.php\");</script>";
			echo "<h4>Votre compte a ete cree, rdv boite mail!</h4>";
			$passwd = sha1($passwd);
			$query = mysqli_query($db, "INSERT INTO `membres`(`email`, `login`, `passwd`, `hash`) VALUES ('$email', '$login', '$passwd', '$hash')");
			$to      = $email;
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
	http://localhost:8888/titi/verify.php?email='.$email.'&hash='.$hash.'

	';

			$headers = 'From:wickedpool@camagru.42.fr' . "\r\n";
			mail($to, $subject, $message, $headers);
			echo "<h4>Votre compte a ete cree, rdv boite mail!</h4>";
			$_SESSION['login']=$login;
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
