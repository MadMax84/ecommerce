<?php
		require "functions.php";
		
	if(isset($_POST["login"], $_POST["pwd"])) {
		
		$bdd = bdd();
		$util = $bdd->query('SELECT login, password FROM admin');
		
		// Récupération des données //
		$admin = $util->fetch();
		$login = $admin['login'];
		$pwd = $admin['password'];

		// Vérification du nom d'utilisateur //
		if($_POST['login'] != $login) {
			echo("Votre nom d'utilisateur " . $_POST["login"] . " est errone.");
		}
		
		// Vérification du mot de passe //
		if(md5($_POST["pwd"]) != $pwd) {
			echo("Votre mot de passe est incorrect.");
		}
		
		else {
			if ($login == $_POST['login'] && $pwd == md5($_POST['pwd']))
			{
				session_start();
				$_SESSION['login'] = $_POST['login'];
				$_SESSION['pwd'] = md5($_POST['pwd']);
				header('location: ../dashboard.php');
			}
			else {
				header('location: ../admin/index.php');
			}
		}
	}
?>