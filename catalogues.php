<?php require "include/header.php"; ?>
<?php require "include/functions.php";?>

<section id="conteneur">
	<?php 
		$catalogues = $bdd->query('SELECT cat_libelle, cat_img, ID_catalogue FROM catalogue');
		while($catalogue = $catalogues->fetch())
		{
			$trimmed = trim($catalogue['cat_img'], '"../"');
			$id = $catalogue['ID_catalogue'];
			echo '<a href="souscatalogues.php?id='.$id.'"><div id="imglib">';
				echo '<img src="'.$trimmed.'"/><br/>';
				echo $catalogue['cat_libelle'];
			echo '</div></a>';
		}		
		
	?>
</section>

<?php require "include/footer.php"; ?>
<?php require "include/formContact.php";?>