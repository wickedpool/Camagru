<?php
session_start();
if ($_SESSION['login'] && $_SESSION['login'] != "")
{
	echo "<ul class='topnav'>";
	if ($_SESSION['is_admin'])
		echo "<li style='float:right'><a href=\"administration.php\">administration</a></li>";
	echo "<li style='float:right'><a href=\"deconnexion.php\">déconnexion</a></li>";
}
else {
	echo "<ul class='topnav'>
		<li><a href='index.php'><img src='img/camagru.png'/></a><li>
		<li style='float:right'><a href='log_form.php'>Connexion</a></li>
		<li style='float:right'><a href='create.php'>Creer un compte</a></li>";
	echo "</ul>";
}
?>

<html>
	<head>
		<title>Camagru</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<meta charset="UTF-8" />
	</head>
	<body>
		<div class="wrapper">
			<h1>CAMAGRU</h1>
			<ul class="menu">
				<li><a href="index.php">Home</a></li>
				<li><a href="picture.php">MyPics</li>
				<li><a href="gallery.php">Gallery</a></li>
			</ul>
		</div>
		<ul class="footer">		
			<li>F O O T E R</li>
			<li>F O O T E R</li>
			<li>F O O T E R</li>
			<li>F O O T E R</li>
			<li>F O O T E R</li>
			<li>F O O T E R</li>
			<li>F O O T E R</li>
			<li>F O O T E R</li>
			<li>F O O T E R</li>
			<li>F O O T E R</li>
			<li>F O O T E R</li>
			<li>F O O T E R</li>
			<li>F O O T E R</li>
			<li>F O O T E R</li>
		</ul>
	</body>
</html>
