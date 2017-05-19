<?php
session_start();
echo "<html>
	<head>
		<title>Camagru</title>
		<link rel='stylesheet' type='text/css' href='css/style.css'
	</head>
	<body>";
if ($_SESSION['login'] && $_SESSION['login'] != "")
{
	echo "<ul class='topnav'>";
	if ($_SESSION['is_admin'])
		echo "<li style='float:right'><a href=\"administration.php\">administration</a></li>";
	echo "  <li><a href='index.php'><img src='img/camagru.png'/></a><li>
		<li style='float:right'><a href=\"deconnexion.php\">déconnexion</a></li>";
	echo "</ul>";
}
else {
	echo "<ul class='topnav'>
		<li><a href='index.php'><img src='img/camagru.png'/></a><li>
		<li style='float:right'><a href='connexion_user.php'>Connexion</a></li>
		<li style='float:right'><a href='create_user.php'>Creer un compte</a></li>";
	echo "</ul>";
}
?>
