<?php
session_start();
if ($_SESSION[login]) {
	include_once 'header.php';
} else {
	header('Location: index.php?msg=Vous devez vous connecter pour acceder a cette page');
}
?>
<html>
	<head>
		<title>Camagru</title>
		<link rel="steelsheet" href="css/style.css" type="text/css"/>
		<meta charset="UTF-8"/>
	</head>
	<body>
	</body>
</html>
