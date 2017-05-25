<?php
session_start();
if ($_SESSION[login]) {
	include_once 'header.php';
} else {
	header('Location: index.php?msg=Vous devez vous connecter pour acceder a cette page');
}
?>

<script src="webcam.js" charset="utf-8"></script>
    <article class="main">
    <div class="videobox">
	<video id="video"></video>
	<img id="image" height="640px" width="480px" style="display: none;"/>
	<div id="canvasvideo"></div>
	    <br/>
      <button class="button" id="snap" onclick="javascript:Shot()">Prendre une photo</button>
      </br>
      <br/>
    <input type='file' accept="image/*" onchange="readURL(this);" />
    <br/>
    <img id="image" height="640px" width="480px" style="display: none;"/>
  </div>
  </article>
	<form id="img_filter">
	<label for="pinkie_pie" class="logo42">
	  <input type="radio" name="img_filter" value="images/filters/42.png" id="pinkie_pie" onchange="myimage('pinkie_pie')">
	  <img class="img" src="images/filters/42.png" height="128" width="128">
	</label>
	<label for="fireman" class="banane">
	  <input type="radio" name="img_filter" value="images/filters/banane.png" id="fireman" onchange="myimage('banane')">
	  <img class="img" src="images/filters/banane.png" height="128" width="128">
	</label>
	<label for="risitas" class="beard">
	  <input type="radio" name="img_filter" value="images/filters/beard_PNG6249-170x167.png" id="risitas" onchange="myimage('beard')">
	  <img class="img" src="images/filters/beard_PNG6249-170x167.png" height="128" width="128">
	</label>
	<label for="saltbae" class="lunette">
	  <input type="radio" name="img_filter" value="images/filters/lunette.png" id="saltbae" onchange="myimage('lunette')">
	  <img class="img" src="images/filters/lunette.png" height="128" width="128">
	</label>
	<br/>
	<label for="trump" class="moustache">
	  <input type="radio" name="img_filter" value="images/filters/moustache.png" id="trump" onchange="myimage('moustache')">
	  <img class="img" src="images/filters/moustache.png" height="128" width="128">
	</label>
	<label for="panama" class="barbe">
	  <input type="radio" name="img_filter" value="images/filters/lilbarbe.png" id="panama" onchange="myimage('barbe')">
	  <img class="img" src="images/filters/lilbarbe.png" height="128" width="128">
	</label>
      </form>

  <aside class="aside2">
    <div class="videobox">
    <h3>Aperçu</h3>
    <div id="canvas"></div>
    <form method='post' accept-charset='utf-8' name='form'>
      <input name='img' id='img' type='hidden'/>
      <input name='user' id='user' type='hidden' value='<?=$_SESSION[login];?>'/>
    </form>
  </div>
  </aside>
	</body>
</html>
