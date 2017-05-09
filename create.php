<?php

include_once 'header.php';

if ($_POST['login'] && $_POST['login'] !== "" && $_POST['passwd'] !== "") {
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
	if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)) {
		echo "<h4>Format xxx@xxx.xx invalide !</h4>";
	}
	else {
		$query = mysqli_query($db, "SELECT * FROM membres WHERE login='$login' LIMIT 1");
		$is_found = mysqli_fetch_assoc($query);
		$query2 = mysqli_query($db, "SELECT * FROM membres WHERE email='$email'");
		$email_found = mysqli_fetch_assoc($query2);
		if($email_found || $is_found){
			echo '<h4>L\'email ou le login existe deja! Merci de reessayer !</h4>';
		}
		else {
			echo "<script>window.location.replace(\"index.php\");</script>";
			$passwd = sha1($passwd);
			$query = mysqli_query($db, "INSERT INTO `membres`(`email`, `login`, `passwd`, `hash`) VALUES ('$email', '$login', '$passwd', '$hash')");
			$_SESSION['login']=$login;
		}
	}
}
?>
		<div class=nav>
			<form class='logform' action="create.php" method="post">
				<label class='mytext' for="email">Votre adresse email</label><br>
				<input class='mybar' type="text" name="email" /><br/>
				<label class='mytext' for="login">Votre login</label><br>
				<input class='mybar' type="text" name="login" /><br/>
				<label class='mytext' for="mdp">Votre mot de passe</label><br>
				<input class='mybar' type="password" name="mdp" /><br/>
				<input class='mybutton' type="submit" name="connexion" /><br/>
			</form>
		</div>
		<a class='mylink' href = "index.php">Retour a la page d'accueil</a>
	</body>
</html>
