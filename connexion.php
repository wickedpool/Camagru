<?php

include_once 'header.php';

if ($_POST['login'] && $_POST['login'] !== "" && $_POST['passwd'] !== "") {
	$login = $_POST['login'];
	$passwd = $_POST['passwd'];
	session_start();
	//CONNEXION SQL
	$db = mysqli_connect("localhost", "root", "root", "camagru");
	if (!$db)
		echo "fuck";
	$login = preg_replace("[^A-Za-z0-9]","",$login);
	$passwd = preg_replace("[^A-Za-z0-9]","",$passwd);
	//crypt
	//SQL request
	$query = mysqli_query($db, "SELECT * FROM membres WHERE login = '$login' LIMIT 1");
	$user_found = mysqli_fetch_assoc($query);
	// echo $user_found['login'];
	if(!$user_found)
		echo "<h4>L'utilisateur ou le mot de passe n'existe pas!</h4>";
	else {
		$passwd = sha1($passwd);
		// echo "passwd: ".$passwd."<br>";
		$query2 = mysqli_query($db, "SELECT * FROM membres WHERE login='$login' AND passwd='$passwd' LIMIT 1");
		$user_found2 = mysqli_fetch_assoc($query2);
		// print_r($user_found2);
		if(!$user_found2) {
			echo "<h4>L'utilisateur ou le mot de passe ne correspond pas</h4>";
			exit();
		}
		else {
			//CONNEXION
			$_SESSION['login']=$login;
			$_SESSION['is_admin']=$user_found2['admin'];
		}
	}
}

?>

	<form class='logform' action="connexion.php" method="post">
		<center>
		<label class='mytext' for="login">Login</label><br>
		<input class='mybar' type="text" name="login" placeholder='entrez votre login' /><br/>
		<label class='mytext' for="passwd">Mot de passe</label><br>
		<input class='mybar' type="password" name="passwd" placeholder='entrez votre mot de passe' /><br/>
		<a href='forgot.php'>Mot de passe oublié</a><br/>
		<input class='mybutton' type="submit" name="connexion" /><br/>
		</center>
	</form>
</html>
