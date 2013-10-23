<?php
session_start();
if (isset($_SESSION['login'], $_SESSION['pwd']))
{
	require "../admin/include/header.php";
	require "../admin/include/navbar.php";
	require "../admin/include/functions.php";
?>

<?php

$bdd = bdd();
$infoProduit=$bdd->query("SELECT ID_produit, nom, description, marque, dimensions, prix, quantite FROM produits");
$xml = '<?xml version="1.0" encoding="ISO-8859-1"?>'.'<carnet>';
foreach($infoProduit as $value) {
	$xml .= '<produit>';
		$xml .= '<idProduit>'.$value['ID_produit'].'</idProduit>';
		$xml .= '<nomProduit>'.$value['nom'].'</nomProduit>';
		$xml .= '<descProduit>'.$value['description'].'</descProduit>';
		$xml .= '<marqueProduit>'.$value['marque'].'</marqueProduit>';
		$xml .= '<dimensionsProduit>'.$value['dimensions'].'</dimensionsProduit>';
		$xml .= '<prixProduit>'.$value['prix'].'</prixProduit>';
		$xml .= '<quantiteProduit>'.$value['quantite'].'</quantiteProduit>';
	$xml .= '</produit>';
}
	$xml .= '</carnet>';
		
	$fp = fopen("carnetMysqlToXml.xml", 'w+');
	fputs($fp, $xml);
	fclose($fp);
	
	echo 'Votre fichier XML!<br/>';
	echo '<a href="carnetMysqlToXml.xml">Voir le fichier</a>';
?>

<?php
	require "../admin/include/footer.php";
}
else {
	// Redirection de l'utilisateur //
	header("Location: ../admin/index.php");
}
?>