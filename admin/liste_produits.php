<?php
session_start();
if (isset($_SESSION['login'], $_SESSION['pwd']))
{
	require "../admin/include/header.php";
	require "../admin/include/navbar.php";
	require "../admin/include/functions.php";
	
	$bdd = bdd();
/*	$produits = $bdd->query('SELECT ID_Produit, nom, produits.description, marque, dimensions, prix, quantite, nouveaute, genre_ID_genre, vipProduit, adrImage1, produits_ID_produit, images.libelle, images.description FROM produits, images WHERE ID_Produit = produits_ID_produit');*/
	
	$produits = $bdd->query('SELECT ID_Produit, nom, produits.description, marque, dimensions, prix, quantite, nouveaute, genre_ID_genre, vipProduit, adrImage1, produits_ID_produit, images.libelle, images.description, souscat_libelle FROM produits, images, souscatalogue WHERE ID_Produit = produits_ID_produit AND souscatalogue_ID_souscatalogue = ID_souscatalogue');
?>

<div id="contain">
    <table id="listeProduit" class="table table-bordered table-hover">
        <thead>
            <tr>
            	<th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Marque</th>
                <th>Prix</th>
                <th>Stock</th>
				<th>Nouveauté</th>
                <th>V.I.P</th>
                <th>Genre</th>
                <th>Associé à</th>
                <th>Image</th>
                <th>Modifier / Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($produits as $produit) {
                    if($produit['nouveaute'] == "1") {
                        $produit['nouveaute'] = "OUI";
                    }
                    else {
                        $produit['nouveaute'] = "NON";
                    }
					
					if($produit['vipProduit'] == "1") {
                        $produit['vipProduit'] = "OUI";
                    }
                    else {
                        $produit['vipProduit'] = "NON";
                    }
					
					if($produit['genre_ID_genre'] == "1") {
						$produit['genre_ID_genre'] = "Homme";
					}
					if($produit['genre_ID_genre'] == "2") {
						$produit['genre_ID_genre'] = "Femme";
					}
					if($produit['genre_ID_genre'] == "3") {
						$produit['genre_ID_genre'] = "Mixte";
					}
					
                    echo '<tr>';
					echo '<td>' . $produit['ID_Produit'] . '</td>';
                    echo '<td>' . $produit['nom'] . '</td>';
                    echo '<td>' . substr($produit[2],0,20) . '...</td>';
                    echo '<td>' . $produit['marque'] . '</td>';
                    echo '<td>' . $produit['prix'] . '</td>';
                    echo '<td>' . $produit['quantite'] . '</td>';
					echo '<td>' . $produit['nouveaute'] . '</td>';
					echo '<td>' . $produit['vipProduit'] . '</td>';
                    echo '<td>' . $produit['genre_ID_genre'] . '</td>';
					echo '<td>' . $produit['souscat_libelle'] . '</td>';
					echo '<td><img src="'. $produit['adrImage1']. '" width="100px"/></td>';
					echo '<td width="18%">
							<a href="modif_produit.php?idProduit='.$produit['ID_Produit'].'"><button class="btn btn-primary">Modifier</button></a>
							<a href="liste_produits.php?supprProduit='.$produit['ID_Produit'].'"><button class="btn btn-danger">Supprimer</button></a>
						  </td>';
                    echo '</tr>';
                }
            ?>
        </tbody>
        <tfoot>
            <th>ID</th>
            <th>Nom</th>
            <th>Description</th>
            <th>Marque</th>
            <th>Prix</th>
            <th>Stock</th>
            <th>Nouveauté</th>
            <th>V.I.P</th>
            <th>Genre</th>
            <th>Associé à</th>
            <th>Image</th>
            <th>Modifier / Supprimer</th>
        </tfoot>
    </table>
</div>

<?php
	/* CODE PHP PERMETTANT DE SUPPRIMER UN PRODUIT */
	if(isset($_GET['supprProduit'])) {
		$bdd6 = bdd();
		$bdd6->exec("DELETE FROM images WHERE produits_ID_produit = '".$_GET['supprProduit']."';
					 DELETE FROM produits WHERE ID_produit='".$_GET['supprProduit']."';");
		
		$delai="1"; 
		$url='liste_produits.php';
		header("Refresh: $delai;url=$url"); 
	}
?>

<script type="text/javascript">
$(document).ready(function() {
    $('#listeProduit').dataTable();
} );
</script>

<?php
	require "../admin/include/footer.php";
}
else {
	// Redirection de l'utilisateur //
	header("Location: ../admin/index.php");
}
?>