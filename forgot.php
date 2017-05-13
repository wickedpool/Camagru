<?php

include_once 'header.php';

if ($_POST['email'] && $_POST['email'] != "")
{
	$email = $_POST('email');
	$newpass = rand(5, 400000);
	$db = mysqli_connect("localhost", "root", "root", "camagru");
	$query = mysqli_query($db, "SELECT * FROM membres WHERE email='$email'");
	$is_found = mysqli_fetch_assoc($query);
	if ($is_found) {
		echo "<h4>Votre mot de passe a ete change</h4>";
		echo "<script>window.location.replace(\"forgot.php\");</script>";
		$hashit = sha1($newpass);
		$query1 = mysqli_query($db, "UPDATE membres SET passwd='$hashit' WHERE email='$email'");
		$to = $email;
		$subjet = 'New Password | Camagru';
		$message = '

	Voici votre nouveau mot de passe :

	---------------------
	New password = '.$newpass.'
	---------------------

	Enjoy!';
		$headers = 'From:wickedpool@camagru.42.fr' . "\r\n";
		mail($to, $subject, $message, $headers);
	} else {
		echo "<h4>L'email ne correspond a aucun compte</h4>";
	}
}

?>

	<form class='logform' action="forgot.php" method="post">
		<center>
		<h3>Mot de passe oublié?<h3>
		<label class='mytext' for="email">Votre adresse email</label><br>
		<input class='mybar' type="email" name="email" placeholder='entrez votre adresse mail' /><br/>
		<input class='mybutton' type="submit" name="connexion" /><br/>
		</center>
	</form>
</html>
