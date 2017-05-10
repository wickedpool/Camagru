<?php
include_once 'header.php';
?>

<script src="webcam.js" charset="utf-8"></script>
    <article class="main">
    <div class="videobox">
      <h3>Live</h3>
	<video id="video"></video>
	<img id="image" height="640px" width="480px" style="display: none;"/>
	<div id="canvasvideo"></div>
      <form id="img_filter">
	<label for="pinkie_pie">
	  <input type="radio" name="img_filter" value="images/filters/pinkie_pie.png" id="pinkie_pie" onchange="myimage('pinkie_pie')">
	  <img class="img" src="images/filters/pinkie_pie.png" height="128" width="128">
	</label>
	<label for="fireman">
	  <input type="radio" name="img_filter" value="images/filters/fireman.png" id="fireman" onchange="myimage('fireman')">
	  <img class="img" src="images/filters/fireman.png" height="128" width="128">
	</label>
	<label for="risitas">
	  <input type="radio" name="img_filter" value="images/filters/risitas.png" id="risitas" onchange="myimage('risitas')">
	  <img class="img" src="images/filters/risitas.png" height="128" width="128">
	</label>
	<label for="saltbae">
	  <input type="radio" name="img_filter" value="images/filters/saltbae.png" id="saltbae" onchange="myimage('saltbae')">
	  <img class="img" src="images/filters/saltbae.png" height="128" width="128">
	</label>
	<br/>
	<label for="trump">
	  <input type="radio" name="img_filter" value="images/filters/trump.png" id="trump" onchange="myimage('trump')">
	  <img class="img" src="images/filters/trump.png" height="128" width="128">
	</label>
	<label for="panama">
	  <input type="radio" name="img_filter" value="images/filters/panama.png" id="panama" onchange="myimage('panama')">
	  <img class="img" src="images/filters/panama.png" height="128" width="128">
	</label>
      </form>
      <br/>
      <button class="button" id="snap" onclick="javascript:Shot()">Prendre une photo</button>
      </br>
      <br/>
    <input type='file' accept="image/*" onchange="readURL(this);" />
    <br/>
    <img id="image" height="640px" width="480px" style="display: none;"/>
  </div>
  </article>

  <aside class="aside2">
    <div class="videobox">
    <h3>Aperçu</h3>
    <div id="canvas"></div>
    <form method='post' accept-charset='utf-8' name='form'>
      <input name='img' id='img' type='hidden'/>
      <input name='user' id='user' type='hidden' value='<?=$_SESSION[Username];?>'/>
    </form>
  </div>
  </aside>
	</body>
</html>
