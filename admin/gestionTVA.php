<?php
session_start();
if (isset($_SESSION['login'], $_SESSION['pwd']))
{
	require "../admin/include/header.php";
	require "../admin/include/navbar.php";
	require "../admin/include/functions.php";
?>

<div id="contain">
	<div id="block3" class="textcenter">
		<div id="dashIcon"></div>
		<a href="../admin/modifTVA.php">Modifier la TVA</a>
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