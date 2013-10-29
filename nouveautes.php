<?php require "include/header.php"; ?>
<?php require "include/functions.php";?>

<section id="conteneur">
	<?php 
		$nouveautes = $bdd->query('SELECT distinct nom, prix, quantite, nouveaute, adrImage1, ID_produit FROM produits p INNER JOIN images i ON p.ID_produit=i.produits_ID_produit WHERE nouveaute = 1');
		while($nouveaute = $nouveautes->fetch())
		{
			$trimmed = trim($nouveaute['adrImage1'], '"../"');
			$id = $nouveaute['ID_produit'];
				echo '<div id="imglib"><div class="rubanNouveaute"></div>';
					echo '<a href="ficheproduit.php?id='.$id.'"><img src="'.$trimmed.'"/></a>';
					echo $nouveaute['nom'].'<div id="icoPanier"></div>';
				echo '</div>';
		}		
		
	?>
</section>

<?php require "include/footer.php"; ?>
<?php require "include/formContact.php";?>