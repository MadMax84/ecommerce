<?php
session_start();
if (isset($_SESSION['login'], $_SESSION['pwd']))
{
	require "../admin/include/header.php";
	require "../admin/include/navbar.php";
	require "../admin/include/functions.php";
?>

<div id="contain">
<div id="block1" class="textcenter">
		<div id="dashIcon"></div>
		<a href="../admin/liste_produits.php">Liste des produits</a>
	</div>
	<div id="block2" class="textcenter">
		<div id="dashIcon"></div>
		<a href="../admin/add_produit.php">Ajouter un produit</a>
	</div>
	<div id="block3" class="textcenter">
		<div id="dashIcon"></div>
		<a href="../admin/import.php">Importer des produits</a>
	</div>
	<div id="block4" class="textcenter">
		<div id="dashIcon"></div>
		<a href="../admin/export.php">Exporter des produits</a>
	</div>
</div>


<?php
	require "../admin/include/footer.php";
}
else {
	// Redirection de l'utilisateur //
	header("Location: ../admin/index.php");
}
?>