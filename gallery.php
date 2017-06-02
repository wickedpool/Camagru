<?php
session_start();

if ($_SESSION[login]) {
	if (!$_GET[page]) {
		header('Location: gallery.php?page=1');
	}
	include_once 'header.php';
} else {
	header('Location: index.php?msg=Vous devez vous connecter pour acceder a cette page');
}

include_once 'db.php';

$nb = ($_GET[page] - 1) * 10;
try {
	$db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);	
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $db->prepare('SELECT * FROM gallery LIMIT 10 OFFSET :nb');
	$stmt->bindParam(':nb', $nb, PDO::PARAM_INT);
	$stmt->execute();
} catch (PDOException $msg) {
	echo 'Error: '.$msg->getMessage();
	exit;
}

$sql = $stmt->fetchAll();
if (!$sql) {
	if ($_GET[page] > 1) {
		$preview = $_GET[page] - 1;
		header("Location: gallery.php?page=$prev");
		exit;
	} else {
		echo '<h4>La galerie est vide, soyez le premier a poster une photo !</h4>';
	}
}
echo "<div>";
foreach ($sql as $key => $value) {
	echo "<div class='boximg'>";
	try {
		$stmt = $db->prepare("SELECT COUNT(*) FROM jaime WHERE id_image = :id_img");
		$stmt->bindParam(':id_img', $value[id], PDO::PARAM_INT);
		$stmt->execute();
	} catch (PDOException $msg) {
		echo 'Error: '.$msg->getMessage();
		exit;
	}
	$jaime = $stmt->fetchColumn();
	try {
		$stmt = $db->prepare("SELECT admin from membres WHERE login = :log");
		$stmt->bindParam(':log', $_SESSION[login], PDO::PARAM_STR);
		$stmt->execute();
	} catch (PDOException $msg) {
		echo 'Error: '.$msg->getMessage();
		exit;
	}
	$admin = $stmt->fetchColumn();
	if ($value[login] == $_SESSION[login] || $admin == 1) {
		echo "<a href='remove.php?img=$value[id]&page=$_GET[page]'><img src='images/trash.png' width='30' style='position:absolute'></a>";
	}
	echo "<img src='$value[img]' style='width:400px'><br/>
		Posté par : <i>$value[login]<br/></i>
		J'aime : $jaime";
		try {
			$stmt = $db->prepare('SELECT COUNT(*) FROM jaime WHERE login = :log AND id_image = :id_img');
			$stmt->bindParam(':log', $_SESSION[login], PDO::PARAM_STR);
			$stmt->bindParam(':id_img', $value[id], PDO::PARAM_INT);
			$stmt->execute();
		} catch (PDOException $msg) {
			echo 'Error: '.$msg->getMessage();
			exit;
		} if ($stmt->fetchColumn()) {	
			echo "<a href='like.php?id_image=$value[id]&page=$_GET[page]' style='float:right;margin-top:-20px'>
					<img src='images/dislike.png' width='30' height='30' style='margin-top:10px'>
				</a>";
		} else {
			echo "<a href='like.php?id_image=$value[id]&page=$_GET[page]' style='float:right;margin-top:-20px'>
					<img src='images/Like.png' width='30' height='30' style='margin-top:10px'>
				</a>";
		}
	echo "<form class='com' action='comment.php?id_image=$value[id]&page=$_GET[page]' method='post'><br/>
			<input class='comform' style='width:100%' type='text' placeholder='Entrez votre commentaire' name='comm' required>
			<input type='submit' class='button' name='Valider'/>
		</form>"; 

	try {
		$stmt = $db->prepare("SELECT * FROM commentaire WHERE id_image = :id_img");
		$stmt->bindParam(':id_img', $value[id], PDO::PARAM_INT);
		$stmt->execute();
	} catch (PDOException $msg) {
		echo 'Error: '.$msg->getMessage();
		exit;
	}
	$sql = $stmt->fetchAll();
	if ($sql) {
		echo "<div class='comment'>";
		foreach ($sql as $key => $var) {
			echo "by <i>$var[login]</i> : $var[comment] <hr>";
		}
		echo '</div>';
	}
	echo '</div>';
}
echo "</div>";
echo "<center><div class='galfoot'";
echo "<ul class='pages'>";
try {
	$stmt = $db->prepare("SELECT COUNT(*) from gallery");
	$stmt->execute();
} catch (PDOException $msg) {
	echo 'Error: '.$msg->getMessage();
	exit;
}
$nb = ($stmt->fetchColumn() - 1) / 10 + 1;
$previous = $_GET[page] - 1;
if ($previous > 0) {
	echo "<li><a href='?page=$prev'>← ← </a></li>";
}
for ($i = 1; $i <= $nb; ++$i) {
	echo "<li><a href='?page=$i'>$i</a></li>";
}
$next = $_GET[page] + 1;
if ($next < $nb) {
	echo "<li><a href='?page=$next'> →→ </a></li>";
}
	echo "</ul>";
echo "</div></center>";

?>

	</body>
</html>
