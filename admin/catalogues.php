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
		<a href="../admin/liste_catalogues.php">Liste des catalogues</a>
	</div>
	<div id="block2" class="textcenter">
		<div id="dashIcon"></div>
		<a href="../admin/liste_souscatalogues.php">Liste des sous-catalogues</a>
	</div>
	<div id="block3" class="textcenter">
		<div id="dashIcon"></div>
		<a href="../admin/add_catalogue.php">Ajouter un catalogue</a>
	</div>
	<div id="block4" class="textcenter">
		<div id="dashIcon"></div>
		<a href="../admin/add_souscatalogue.php">Ajouter un sous-catalogue</a>
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