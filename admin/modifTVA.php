<?php
session_start();
if (isset($_SESSION['login'], $_SESSION['pwd']))
{
	require "../admin/include/header.php";
	require "../admin/include/navbar.php";
	require "../admin/include/functions.php";
?>

<?php
	$bdd1 = bdd();
	$val=$bdd1->query("SELECT taxe FROM taxes");
	foreach($val as $valtva);
	
?>

<div id="contain">
<h3>Modifier la TVA</h3>
<form action="" method="post">
    <table>
        <tr>
            <td><label for="valeurTVA">Valeur de la TVA : </label></td>
            <td><input name="valeurTVA" type="text" value="<?php echo $valtva['taxe'];?>" id="valeurTVA" required/></td>
        </tr>
        <tr>
        	<td colspan="2">Info : la virgule est remplacé par un point " . "</td>
        </tr>
        <tr>
        	<td colspan="2"><input type="submit" class="btn btn-primary" value="Modifier la TVA"/></td>
        </tr>
    </table>
</form>
</div>

<?php

if(isset($_POST['valeurTVA'])) {
	$tva = $_POST['valeurTVA'];
	
	$bdd = bdd();
	$bdd->exec("UPDATE taxes SET taxe='".$tva."'");
	
	$delai="1"; 
	$url='modifTVA.php?success=1';
	header("Refresh: $delai;url=$url");
	
	if($_GET['success'] = "1") {
		echo '<div class="alert alert-success">TVA modifié avec succès !</div>';
	}
}
			
?>

<?php
	require "../admin/include/footer.php";
}
else {
	// Redirection de l'utilisateur //
	header("Location: ../admin/index.php");
}
?>