<?php

function bdd() {
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=grindhouse','root','');
		return $bdd;
	}
	catch(Exception $e) {
		die ('erreur :' .$e->getMessage());
	}
}

?>