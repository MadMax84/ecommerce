<?php
session_start();
if (isset($_SESSION['login'], $_SESSION['pwd']))
{
	require "../admin/include/header.php";
	require "../admin/include/navbar.php";
?>

<div id="contain">
	<div id="block1" class="textcenter">
		<div id="dashIcon"></div>
		<a href="catalogues.php">Catalogues</a>
	</div>
	<div id="block2" class="textcenter">
		<div id="dashIcon"></div>
		<a href="produits.php">Produits</a>
	</div>
	<div id="block3" class="textcenter">
		<div id="dashIcon"></div>
		<a href="gestionTVA.php">Gestion de la TVA</a>
	</div>
	<div id="block4" class="textcenter">
		<div id="dashIcon"></div>
		<a href="promotions.php">Promotions</a>
	</div>
	<div id="block5" class="textcenter">
		<div id="dashIcon"></div>
		<a href="ventesprivees.php">Ventes privées</a>
	</div>
	<div id="block6" class="textcenter">
		<div id="dashIcon"></div>
		<a href="clients.php">Clients</a>
	</div>
	<div id="block7" class="textcenter">
		<div id="dashIcon"></div>
		<a href="commandes.php">Commandes</a>
	</div>
	<div id="block8" class="textcenter">
		<div id="dashIcon"></div>
		<a href="transports.php">Transports</a>
	</div>
	<div id="block9" class="textcenter">
		<div id="dashIcon"></div>
		<a href="slideshow.php">Slideshow</a>
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