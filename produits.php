<?php require "include/header.php"; ?>
<?php require "include/functions.php";?>

<div id="conteneur">
	<?php
		$id = $_GET['id'];
		$produits = $bdd->query('SELECT distinct nom, prix, quantite, nouveaute, adrImage1, ID_produit FROM produits p INNER JOIN images i ON p.ID_produit=i.produits_ID_produit WHERE souscatalogue_ID_souscatalogue='.$id.'');
		
		while($produit = $produits->fetch())
		{
			$id2 = $produit['ID_produit'];
			echo '<a href="ficheproduit.php?id='.$id2.'"><div id="imglib">';
			$trimmed = trim($produit['adrImage1'], '"../"');
				echo '<img src="'.$trimmed.'"><br/>';
				echo $produit['nom'].'<div id="icoPanier"></div>';
			echo '</div></a>';
		}		
	?>
</div>

<?php require "include/footer.php"; ?>
<?php require "include/formContact.php";?>