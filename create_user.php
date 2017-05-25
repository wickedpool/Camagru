<?php 

if ($_GET[msg]) {echo "<script>alert(\"".htmlentities($_GET[msg])."\");window.location.href = \"create_user.php\";</script>";}

include_once('header.php'); 

echo '<h4>Veuillez remplir tous les champs, un mail vous sera envoyé pour activer votre compte </h4>';

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
