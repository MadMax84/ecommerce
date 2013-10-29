<?php require "include/header.php"; ?>
<?php require "include/functions.php";?>

<section id="conteneur">
	<?php
		$id = $_GET['id'];
		$produits = $bdd->query('SELECT nom, p.description, marque, dimensions, prix, quantite, nouveaute, adrImage1 FROM produits p INNER JOIN images i ON p.ID_produit = i.produits_ID_produit where ID_produit ='.$id.'');
		
			 
		while($produit = $produits->fetch())
		{
			$trimmed = trim($produit['adrImage1'], '"../"');
			echo '<div id="titreProduit"><b>'.$produit['nom'].'</b></div>';
			echo '<div id="imgprod">';
				echo '<img src="'.$trimmed.'">';
			echo '</div>';
			
			echo '
				<div id="catprod">
					<div class="marge">
						<b>'.$produit['marque'].'</b><br/><br/>
						'.$produit['description'].'<br/><br/>
						Dimensions : '.$produit['dimensions'].'<br/>
						Prix : '.$produit['prix'].' € <br/><br/>
						Stock : '.$produit['quantite'].' <br/>
					</div>
					<div id="ajoutPanier">
						<a href="">+ Ajouter au panier</a>
					</div>
				</div>';
			
		}		
		
	?>
</section>

<?php require "include/footer.php"; ?>
<?php require "include/formContact.php";?>