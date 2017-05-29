<?php

if ($_GET[msg]) {echo "<script>alert(\"".htmlentities($_GET[msg])."\");window.location.href = \"connexion_user.php\";</script>";}

include_once('header.php');

?>

	<form class='logform' action="connexion.php" method="post">
		<center>
		<label class='mytext' for="login">Login</label><br>
		<input class='mybar' type="text" name="login" placeholder='entrez votre login' /><br/>
		<label class='mytext' for="passwd">Mot de passe</label><br>
		<input class='mybar' type="password" name="passwd" placeholder='entrez votre mot de passe' /><br/>
		<a href='forgot_user.php'>Mot de passe oublié</a><br/>
		<input class='mybutton' type="submit" name="connexion" /><br/>
		</center>
	</form>
</html>
