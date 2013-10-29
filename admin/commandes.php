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
		<a href="../admin/liste_commandes.php">Liste des commandes</a>
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