<?php

include_once 'header.php';

if (empty($_POST["email"])) {
	echo '<h4>Champ email vide</h4>';
} else if (empty($_POST["login"])) {
	echo '<h4>Champ login vide </h4>';
} else if (empty($_POST["mdp"])) {
	echo '<h4>Champ password vide</h4>';
} else if (strlen($_POST["mdp"]) < 8) {
	echo '<h4>Le mot de passe doit contenir au moins 8 caracteres</h4>';
} else {
	if ($_POST['login'] && $_POST['login'] !== "" && $_POST['mdp'] !== "") {
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
				<center>
				<label class='mytext' for="email">Votre adresse email</label><br>
				<input class='mybar' type="email" name="email" placeholder="exemple@exemple.com"/><br/>
				<label class='mytext' for="login">Votre login</label><br>
				<center><input class='mybar' type="text" name="login" placeholder="entrez votre login" /><br/>
				<label class='mytext' for="mdp">Votre mot de passe</label><br>
				<input class='mybar' type="password" name="mdp" placeholder="entrez votre mot de passe" /><br/>
				<input class='mybutton' type="submit" name="connexion" /><br/>
				</center>
			</form>
		</div>
		<a class='mylink' href = "index.php">Retour a la page d'accueil</a>
	</body>
</html>
