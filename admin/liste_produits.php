<?php
session_start();
if (isset($_SESSION['login'], $_SESSION['pwd']))
{
	require "../admin/include/header.php";
	require "../admin/include/navbar.php";
	require "../admin/include/functions.php";
	
	$bdd = bdd();
	$produits = $bdd->query('SELECT ID_Produit, nom, produits.description, marque, dimensions, prix, quantite, nouveaute, genre_ID_genre, adrImage1, produits_ID_produit, images.libelle, images.description FROM produits, images WHERE ID_Produit = produits_ID_produit');

?>

<div id="contain">
    <table id="listeProduit" class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Marque</th>
                <th>Dimensions</th>
                <th>Prix</th>
                <th>Quantité</th>
				<th>Nouveauté</th>
                <th>Genre</th>
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
                    echo '<td>' . $produit['nom'] . '</td>';
                    echo '<td>' . $produit[2] . '</td>';
                    echo '<td>' . $produit['marque'] . '</td>';
                    echo '<td>' . $produit['dimensions'] . '</td>';
                    echo '<td>' . $produit['prix'] . '</td>';
                    echo '<td>' . $produit['quantite'] . '</td>';
					echo '<td>' . $produit['nouveaute'] . '</td>';
                    echo '<td>' . $produit['genre_ID_genre'] . '</td>';
					echo '<td><img src="'. $produit['adrImage1']. '" width="100px"/></td>';
					echo '<td width="18%">
							<form method="get" action="" style="float:left;margin-right:5px;">
								<input type="hidden" value="'.$produit['ID_Produit'].'" name="idProduit"/>
								<input type="submit" value="Modifier" class="btn btn-primary"/>
							</form>
							<form method="post" action="">
								<input type="hidden" value="'.$produit['ID_Produit'].'" name="supprProduit"/>
								<input type="submit" value="Supprimer" class="btn btn-danger"/>
							</form>
						</td>';
                    echo '</tr>';
                }
            ?>
        </tbody>
        <tfoot>
                <th>Nom</th>
                <th>Description</th>
                <th>Marque</th>
                <th>Dimensions</th>
                <th>Prix</th>
                <th>Quantité</th>
				<th>Nouveauté</th>
                <th>Genre</th>
                <th>Image</th>
                <th>Modifier / Supprimer</th>
        </tfoot>
    </table>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#listeProduit').dataTable();
} );
</script>

<?php 
	/* CODE PHP PERMETTANT DE MODIFIER UN SOUS CATALOGUE */
	if(isset($_GET['idProduit'])) {
		$bdd2 = bdd();
		
		$recupData = $bdd2->query('SELECT ID_Produit, nom, produits.description, marque, dimensions, prix, quantite, nouveaute, genre_ID_genre, souscatalogue_ID_souscatalogue, adrImage1, produits_ID_produit, libelle, images.description FROM produits, images WHERE ID_produit = "'.$_GET['idProduit'].'" AND ID_Produit = produits_ID_produit');
		
		foreach($recupData as $value) {
		?>
			<h3> >> Modification du produit : <?php echo $value['nom'];?> </h3>
			<form action="" method="post" enctype="multipart/form-data">
			<table>
				<tr>
                	<td>Nom :</td>
                    <td><input type="text" value="<?php echo $value['nom']; ?>" name="newnom"/></td>
                </tr>
				<tr>
                	<td>Description :</td>
                    <td><input type="text" value="<?php echo $value[2]; ?>" name="newDescription"/></td>
                </tr>
				<tr>
                	<td>Marque :</td>
                    <td><input type="text" value="<?php echo $value['marque']; ?>" name="newMarque"/></td>
                </tr>
				<tr>
                	<td>Dimensions :</td>
                    <td><input type="text" value="<?php echo $value['dimensions']; ?>" name="newDimensions"/></td>
                </tr>
				<tr>
                	<td>Prix :</td>
                    <td><input type="text" value="<?php echo $value['prix']; ?>" name="newPrix"/></td>
                </tr>
				<tr>
                	<td>Quantité :</td>
                    <td><input type="text" value="<?php echo $value['quantite']; ?>" name="newQuantite"/></td>
                </tr>
				<tr>
                	<td>Nouveauté :</td>
                    <td>
                    	<?php
							if($value['nouveaute'] == 1) {
								echo 'OUI <input name="newNouveaute" type="radio" value="1" checked="checked"/> NON <input name="newNouveaute" type="radio" value="0" />';
							}
							else {
								echo 'OUI <input name="newNouveaute" type="radio" value="1"/> NON <input name="newNouveaute" type="radio" value="0" checked="checked" />';
							}
						?>
                    </td>
                </tr>
                <tr>
                	<td>Sous catalogue affilié :</td>
                    <td>
                    	<select name="newIDsouscat">
                            <?php
                                $bdd3 = bdd();
                                $souscatParent=$bdd3->query("SELECT ID_souscatalogue, souscat_libelle, ID_produit FROM souscatalogue, produits WHERE ID_souscatalogue = souscatalogue_ID_souscatalogue AND ID_produit = ".$_GET['idProduit']."");
                                foreach($souscatParent as $parent) {
                                    echo '<option selected value="'.$parent['ID_souscatalogue'].'">' . $parent['souscat_libelle'] . '</option>';
                                }
                            ?>
                            <?php
                                $bdd31 = bdd();
                                $souscatList=$bdd31->query("SELECT ID_souscatalogue,souscat_libelle FROM souscatalogue");
                                foreach($souscatList as $newParent) {
                                    echo '<option value="'.$newParent['ID_souscatalogue'].'">' . $newParent['souscat_libelle'] . '</option>';
                                }
                            ?>
                        </select>
                    </td>
                </tr>
				<tr>
                	<td>Genre :</td>
                    <td>
                        <select name="newIDgenre">
                            <option>
                          		<?php 
									if($value['genre_ID_genre'] == "1") {
										$value['genre_ID_genre'] = "Homme";
									}
									if($value['genre_ID_genre'] == "2") {
										$value['genre_ID_genre'] = "Femme";
									}
									if($value['genre_ID_genre'] == "3") {
										$value['genre_ID_genre'] = "Mixte";
									}
									echo $value['genre_ID_genre'];
								?>
                            </option>
                        <?php
							$bdd4 = bdd();
                            $newgenre=$bdd4->query("SELECT ID_genre FROM genre");
							
                            foreach($newgenre as $parent) {
							    if($parent['ID_genre'] == "1") {
									$parent['ID_genre'] = "Homme";
								}
								if($parent['ID_genre'] == "2") {
									$parent['ID_genre'] = "Femme";
								}
								if($parent['ID_genre'] == "3") {
									$parent['ID_genre'] = "Mixte";
								}
                                echo '<option>' . $parent['ID_genre'] . '</option>';
                            }
                        ?>
                        </select>
                	</td>
                </tr>
                <tr>
                	<td>Image :</td>
                    <td><img src="<?php echo $value['adrImage1']; ?>" width="100px"/></td>
                </tr>
                <tr>
                	<td>Fichier : </td>
                    <td>
                        <!-- On limite le fichier à 100Ko -->
                        <input type="hidden" name="MAX_FILE_SIZE" value="100000"/>
                        <input type="file" id="avatar" name="avatar"/>
                    </td>
                </tr>
                <tr>
                	<td>Libelle de l'image :</td>
                    <td><input type="text" value="<?php echo $value['libelle']; ?>" name="newLibImg"/></td>
                </tr>
                <tr>
                	<td>Description de l'image :</td>
                    <td><input type="text" value="<?php echo $value[12]; ?>" name="newDescImg"/></td>
                </tr>
                <tr>
                	<td colspan="2"><input type="submit" value="Modifier le produit" class="btn btn-primary"/></td>
                </tr>
            </table>
			</form>
<?php
	}
		
	if(isset($_POST['newnom'])&& isset($_POST['newDescription']) && isset($_POST['newMarque']) && isset($_POST['newDimensions']) && isset($_POST['newPrix']) && isset($_POST['newQuantite']) && isset($_POST['newNouveaute']) && isset($_POST['newIDgenre']) && isset($_POST['newIDsouscat'])) 
	{	
		// On récupére les données POST
		$newNom = $_POST['newnom'];
		$newDescription = $_POST['newDescription'];
		$newMarque = $_POST['newMarque'];
		$newDimensions = $_POST['newDimensions'];
		$newPrix = $_POST['newPrix'];
		$newQuantite = $_POST['newQuantite'];
		$newNouveaute = $_POST['newNouveaute'];
		$newIDgenre = $_POST['newIDgenre'];
		$newSousCat = $_POST['newIDsouscat'];
		
		if($_POST['newIDgenre'] == "Homme") {
			$newIDgenre = "1";
		}
		if($_POST['newIDgenre'] == "Femme") {
			$newIDgenre = "2";
		}
		if($_POST['newIDgenre'] == "Mixte") {
			$newIDgenre = "3";
		}
		
		else {
			$bdd5 = bdd();
			$bdd5->exec("UPDATE produits SET nom='".$newNom."', description='".$newDescription."', marque='".$newMarque."', dimensions='".$newDimensions."', prix='".$newPrix."', quantite='".$newQuantite."', nouveaute='".$newNouveaute."', genre_ID_genre='".$newIDgenre."', souscatalogue_ID_souscatalogue='".$newSousCat."' WHERE ID_produit = '".$_GET['idProduit']."'");
		}
		
		$delai="1"; 
		$url='liste_produits.php';
		header("Refresh: $delai;url=$url"); 
	}	
}
?>

<?php
if(isset($_FILES['avatar'])) {

/*	$bdd6 = bdd();
	$oldAdr = $bdd6->query('SELECT adrImage1, produits_ID_produit FROM images WHERE produits_ID_produit = "'.$_GET['idProduit'].'"');
	foreach($oldAdr as $old){
		unlink($old['adrImage1']);
	}*/

	$newLibImg = $_POST['newLibImg'];
	$newDescImg = $_POST['newDescImg'];

	$dossier = '../admin/upload/';
	$fichier = basename($_FILES['avatar']['name']);
	$taille_maxi = 2097152;
	$taille = filesize($_FILES['avatar']['tmp_name']);
	$extensions = array('.png', '.gif', '.jpg', '.jpeg');
	$extension = strrchr($_FILES['avatar']['name'], '.'); 
	//Début des vérifications de sécurité...
	if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
	{
		 $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
	}
	if($taille>$taille_maxi)
	{
		 $erreur = 'Le fichier est trop gros...';
	}
	if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
	{
		 //On formate le nom du fichier ici...
		 $fichier = strtr($fichier, 
			  'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
			  'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
		 $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
		 if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
		 {		
			echo 'Upload effectué avec succès !';
			$adrImage1 = $dossier.$fichier;
			
			$bdd7 = bdd();
			$bdd7->exec("UPDATE images SET adrImage1='".$adrImage1."', libelle='".$newLibImg."', description='".$newDescImg."' WHERE produits_ID_produit = '".$_GET['idProduit']."'");
			
			$delai="1"; 
			$url='liste_produits.php';
			header("Refresh: $delai;url=$url"); 
			
		 }
		 else //Sinon (la fonction renvoie FALSE).
		 {
			  echo 'Echec de l\'upload !';
		 }
	}
	else
	{
		 echo $erreur;
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