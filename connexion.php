<?php
header("location: index.php");

if ($_POST['login'] && $_POST['login'] !== "" && $_POST['passwd'] !== "") {
	$login = $_POST['login'];
	$passwd = $_POST['passwd'];
	session_start();
	//CONNEXION SQL
	$db = mysqli_connect("localhost", "root", "thgiraud", "camagru");
	if (!$db)
		echo "fuck";
	$login = preg_replace("[^A-Za-z0-9]","",$login);
	$passwd = preg_replace("[^A-Za-z0-9]","",$passwd);
	//crypt
	//SQL request
	$query = mysqli_query($db, "SELECT * FROM membres WHERE login = '$login' LIMIT 1");
	$user_found = mysqli_fetch_assoc($query);
	// echo $user_found['login'];
	if(!$user_found)
		echo "L'utilisateur n'existe pas!";
	else {
		$passwd = sha1($passwd);
		// echo "passwd: ".$passwd."<br>";
		$query2 = mysqli_query($db, "SELECT * FROM membres WHERE login='$login' AND passwd='$passwd' LIMIT 1");
		$user_found2 = mysqli_fetch_assoc($query2);
		// print_r($user_found2);
		if(!$user_found2) {
			echo "Le mot de passe ne correspond pas";
			exit();
		}
		else {
			//CONNEXION
			$_SESSION['login']=$login;
			$_SESSION['is_admin']=$user_found2['admin'];
		}
	}
}
else {
	echo "Login ou mot de passe ";
}

?>
