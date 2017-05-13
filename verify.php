<?php

include_once 'header.php';

$db = mysqli_connect("localhost", "root", "root", "camagru");
if ($_GET['email']) {
	$email = $_GET['email'];
        $hash = $_GET['hash'];
	$search = mysql_query("SELECT email, hash, active FROM membres WHERE email='".$email."' AND hash='".$hash."' AND active='0'"); 
	$match  = mysql_num_rows($search);
	echo '<h4>EMAIL = '.$email.'</h4>';
	echo '<h4>HASH = '.$hash.'</h4>';
	echo '<h4>MATCH = '.$match.'</h4>';
	if($match > 0) {
		mysql_query("UPDATE membres SET active='1' WHERE email='".$email."' AND hash='".$hash."' AND active='0'") or die(mysql_error());
		echo '<h4>Votre compte a ete active vous pouvez maintenant profiter pleinement de ce merveilleux site</h4>';
	} else {
		echo '<h4>Votre compte n\'a pas ete active car l\'url n\'est pas valide ou votre compte a deja ete valide</h4>';
	}
} else {
		echo '<h4>L\'url est invalide, veuillez utiliser le lien transmis par mail</h4>';
}
?>
	</body>
</html>
