<?php

	if ($_GET[msg]) {echo "<script>alert(\"".htmlentities($_GET[msg])."\");window.location.href = \"index.php\";</script>";}
include_once 'header.php'
?>

		<h1 class="hometext">Montez, capturez et partagez sur</h1>
		<img class="easy" src="img/clogo1.png" />
		<div class="wrapper">
		<center>
		<ul class="menu_h">
			<li><a class="hey1" href="picture.php">Montez votre photo!</a></li>
			<li><a class="hey1" href="gallery.php">Visionnez la galerie!</a></li>
		</ul>
		</center>
		<div class="ban">
			<img src="img/enjoy.png" />
		</div>
		</div>
	</body>
</html>
