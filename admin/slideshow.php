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
		<a href="../admin/add_slideshow.php">Ajouter une image</a>
	</div>
    <div id="block2" class="textcenter">
		<div id="dashIcon"></div>
		<a href="../admin/del_slideshow.php">Supprimer une image</a>
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