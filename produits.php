<?php require "include/header.php"; ?>
<?php require "include/functions.php";?>

<section id="conteneur">
	<?php
		$bdd = bdd();
		$id = $_GET['id'];
		$produits = $bdd->query('SELECT distinct nom, prix, quantite, nouveaute, adrImage1 FROM produits p INNER JOIN images i ON p.ID_produit=i.produits_ID_produit WHERE souscatalogue_ID_souscatalogue='.$id.'');
		
		while($produit = $produits->fetch())
		{
			echo '<div class="imglib">';
			echo'<a href="souscatalogues.php"><img src="'.$produit['adrImage1'].'" class="cata"></a>';
			echo '<div class="catlibelle">'.$produit['nom'].'</div>';
			echo '</div>';
			
		}		
		
	?>
</section>

<?php require "include/footer.php"; ?>
<?php require "include/formContact.php";?>