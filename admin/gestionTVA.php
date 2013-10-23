<?php
session_start();
if (isset($_SESSION['login'], $_SESSION['pwd']))
{
	require "../admin/include/header.php";
	require "../admin/include/navbar.php";
?>

<!-- TON CODE HTML -->

<?php
	require "../admin/include/footer.php";
}
else {
	// Redirection de l'utilisateur //
	header("Location: ../admin/index.php");
}
?>