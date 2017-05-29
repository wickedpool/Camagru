<?php

if ($_GET[msg]) {echo "<script>alert(\"".htmlentities($_GET[msg])."\");window.location.href = \"forgot_user.php\";</script>";}

include_once('header.php');

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
