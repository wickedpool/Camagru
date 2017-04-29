<?php
if ($_SESSION['login'] && $_SESSION['login'] != "")
{
	echo "	<ul class='topnav'>";
	if ($_SESSION['is_admin'])
		echo	"<li style='float:right'><a href=\"administration.php\">administration</a></li>";
	echo "		<li style='float:right'><a href=\"deconnexion.php\">déconnexion</a></li>";
	echo "</ul>";
	// exit();
}
else {
	echo "<ul class='topnav'>
		<li style='float:right'><a href='log_form.php'>Connexion</a></li>
		<li style='float:right'><a href='create.php'>Creer un compte</a></li>";
	echo "</ul>";
}
if ($_POST['login'] && $_POST['login'] !== "" && $_POST['passwd'] !== "") {
	$login = $_POST['login'];
	$passwd = $_POST['mdp'];
	// CONNEXION SQL
	$db = mysqli_connect("localhost", "root", "thgiraud", "camagru");
	$login = preg_replace("[^A-Za-z0-9]","",$login);
	$passwd = preg_replace("[^A-Za-z0-9]","",$passwd);
	//crypt
	//SQL request
	$query = mysqli_query($db, "SELECT * FROM membres WHERE login='$login' LIMIT 1");
	$is_found = mysqli_fetch_assoc($query);
	if($is_found){
		echo "Le login existe deja! Merci de reessayer !<br><br>";
	}
	else {
		echo "<script>window.location.replace(\"index.php\");</script>";
		$passwd = sha1($passwd);
		$idmax = mysqli_query($db, 'SELECT MAX(id) FROM membres');
		$new_id = mysqli_fetch_assoc($idmax);
		// print_r($new_id);
		$iddd = $new_id['MAX(id)'] + 1;
		// echo $iddd;
		$query = mysqli_query($db, "INSERT INTO `membres`(`id`, `login`, `passwd`) VALUES ('$iddd', '$login', '$passwd')");
		$_SESSION['login']=$login;
	}
}
// header("location: index.php");

// echo "";
?>

<html class='home'>
	<head>
		<meta charset="UTF-8" />
		<link rel="stylesheet" type="text/css" href="style.css">
		<title>RUSH</title>
	</head>
	<body>
		<div class=nav>
			<form class='logform' action="create.php" method="post">
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
