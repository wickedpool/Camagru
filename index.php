<?php
	if ($_GET[msg]) {echo "<script>alert(\"".htmlentities($_GET[msg])."\");window.location.href = \"index.php\";</script>";}
include_once 'header.php'
?>

		<h1>Montez, capturez et partagez sur</h1>
		<img src="img/clogo.png" /><h2>AMAGRU</h2>
		<div class="wrapper">
			<div class="content">
				<a class="home" href="gallery.php">
					<img src="https://static1.squarespace.com/static/53c46660e4b07557fac2eb85/t/550ee40ce4b02547ba9c325e/1427039245866/doug-rickard_a-new-american-picture_west-gallery-6-b1.jpg?format=1500w" id="myhome" title="home">
				</a>
				<a class="pics" href="picture.php">
					<img src="http://icon-icons.com/icons2/426/PNG/512/Cam_camera_1112px_1195275_42267.png" id="mypics" title="pictures">
				</a>
				<a class="gellery" href="index.php">
					<img src="http://4.bp.blogspot.com/-Q11j9gR4x-s/VcTqbwTwiiI/AAAAAAAAAgo/oUwuhscRpvY/s1600/iconemaison2-01.png" id="mygallery" title="gallerie">
				</a>
			</div>
		</div>
	</body>
</html>
