<?php require "include/header.php"; ?>
<?php require "include/functions.php";?>

<div id="conteneur">
	<div id="myCarousel" class="carousel slide hidden-phone">
		<!-- Carousel items -->
		<div class="carousel-inner">
			<div id="slideshow" class="carousel-inner">
				<?php
					$backgrounds = $bdd->query('SELECT * FROM slideshow');
					foreach($backgrounds as $background) {
						echo '<div class="item"><img src="'.$background['adrSlides'].'"/></div>';
					}
				?>
			</div>
		</div>
	</div>
    <div id="prodNewIndex">
    	<?php
			$produits = $bdd->query('SELECT ID_produit, nom, adrImage1, produits_ID_produit FROM produits, images WHERE ID_produit = produits_ID_produit AND nouveaute = "1" ORDER BY ID_produit DESC LIMIT 0,3');
			foreach($produits as $produit) {
				$trimmed = trim($produit['adrImage1'], '"../"');
				$id = $produit['ID_produit'];
				echo '<div id="imglib"><div class="rubanNouveaute"></div>';
					echo '<a href="ficheproduit.php?id='.$id.'"><img src="'.$trimmed.'"></a>';
					echo $produit['nom'].'<div id="icoPanier"></div>';
				echo '</div>';
			}
		?>
    </div>
</div>

<script>
$('.carousel').carousel({

})
</script>

<?php require "include/footer.php"; ?>
<?php require "include/formContact.php";?>