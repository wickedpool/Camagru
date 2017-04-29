<?php
echo '<link rel="stylesheet" type="text/css" href="style.css">';
echo "<html class='home'>
	<form class='logform' action=\"connexion.php\" method=\"post\">
		<label class='mytext' for=\"login\">Login</label><br>
		<input class='mybar' type=\"text\" name=\"login\" /><br/>
		<label class='mytext' for=\"passwd\">Mot de passe</l	abel><br>
		<input class='mybar' type=\"password\" name=\"passwd\" /><br/>
		<input class='mybutton' type=\"submit\" name=\"connexion\" /><br/>
	</form>
</html>";
?>
