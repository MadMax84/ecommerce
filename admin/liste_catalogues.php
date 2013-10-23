<?php
session_start();
if (isset($_SESSION['login'], $_SESSION['pwd']))
{
	require "../admin/include/header.php";
	require "../admin/include/navbar.php";
	require "../admin/include/functions.php";

?>

<div id="contain">
<h3>Liste des catalogues</h3>
<table id="listeCatalogue" class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Libellé</th>
            <th>Description</th>
            <th>Genre</th>
            <th>Image</th>
            <th>Modifier / Supprimer</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $bdd = bdd();
            $catalogues = $bdd->query('SELECT ID_catalogue, cat_libelle, cat_description, cat_img, genre_ID_genre FROM catalogue');
            foreach($catalogues as $catalogue) {
                if($catalogue['genre_ID_genre'] == "1") {
                    $catalogue['genre_ID_genre'] = "Homme";
                }
                if($catalogue['genre_ID_genre'] == "2") {
                    $catalogue['genre_ID_genre'] = "Femme";
                }
                if($catalogue['genre_ID_genre'] == "3") {
                    $catalogue['genre_ID_genre'] = "Mixte";
                }
                echo '<tr>';
                echo '<td>' . $catalogue['ID_catalogue'] . '</td>';
                echo '<td>' . $catalogue['cat_libelle'] . '</td>';
                echo '<td>' . $catalogue['cat_description'] . '</td>';
                echo '<td>' . $catalogue['genre_ID_genre'] . '</td>';
				echo '<td><img src="' . $catalogue['cat_img'] . '" width="100px"/></td>';
				echo '<td width="18%">
					<form method="get" action="" style="float:left;margin-right:5px;">
						<input type="hidden" value="'.$catalogue['ID_catalogue'].'" name="idcat"/>
						<input type="submit" value="Modifier" class="btn btn-primary"/>
					</form>
					<form method="post" action="">
						<input type="hidden" value="'.$catalogue['ID_catalogue'].'" name="supprCat"/>
						<input type="submit" value="Supprimer" class="btn btn-danger"/>
					</form>
				</td>';
                echo '</tr>';
            }
        ?>
    </tbody>
    <tfoot>
            <th>ID</th>
            <th>Libellé</th>
            <th>Description</th>
            <th>Genre</th>
            <th>Image</th>
            <th>Modifier / Supprimer</th>
    </tfoot>
</table>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#listeCatalogue').dataTable();
} );
</script>

<?php 
	/* CODE PHP PERMETTANT DE MODIFIER UN SOUS CATALOGUE */
	if(isset($_GET['idcat'])) {
		$bdd2 = bdd();
		$recupData = $bdd2->query('SELECT ID_catalogue, cat_libelle, cat_description, cat_img, genre_ID_genre FROM catalogue WHERE ID_catalogue ="'.$_GET['idcat'].'"');
		foreach($recupData as $value) {
		?>
			<h3> >> Modification de la catégorie : <?php echo $value['cat_libelle'];?> </h3>
			<form action="" method="post" enctype="multipart/form-data">
			<table class="center">
				<tr>
                	<td>Libellé :</td>
                    <td><input type="text" value="<?php echo $value['cat_libelle']; ?>" name="newlibelleCat"/></td>
                </tr>
				<tr>
                	<td>Description :</td>
                    <td><textarea name="newdescCat"><?php echo $value['cat_description']; ?></textarea></td>
                </tr>
				<tr>
                	<td>Genre :</td>
                    <td>
                        <select name="newIDgenre">
                        <option value="0">Choississez un genre :</option>
                        <?php
                            $bdd3 = bdd();
                            $newgenre=$bdd3->query("SELECT ID_genre FROM genre");
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
                    <td><img src="<?php echo $value['cat_img']; ?>" width="100px"/></td>
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
                	<td colspan="2"><input type="submit" value="Modifier la catégorie" class="btn btn-primary"/></td>
                </tr>
            </table>
			</form>
<?php
		}
		
		if(isset($_POST['newlibelleCat']) && isset($_POST['newdescCat'])) {	
					// On récupére les données POST
					$newLibelle = $_POST['newlibelleCat'];
					$newDescription = $_POST['newdescCat'];
					$newIDgenre = $_POST['newIDgenre'];
					
					if($_POST['newIDgenre'] == "Homme") {
						$newIDgenre = "1";
					}
					if($_POST['newIDgenre'] == "Femme") {
						$newIDgenre = "2";
					}
					if($_POST['newIDgenre'] == "Mixte") {
						$newIDgenre = "3";
					}
					
					if($_POST['newIDgenre'] == "0") {
						echo 'Merci de choisir un genre pour votre catégorie !';
					}
					else {
						$bdd4 = bdd();
						$bdd4->exec("UPDATE catalogue SET cat_libelle='".$newLibelle."',cat_description='".$newDescription."', genre_ID_genre='".$newIDgenre."' WHERE ID_catalogue = '".$value['ID_catalogue']."'");
					}
					
					$delai="1"; 
					$url='liste_catalogues.php';
					header("Refresh: $delai;url=$url");
		}
	}
	
	if(isset($_FILES['avatar'])) {
	
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
				$bdd7->exec("UPDATE catalogue SET cat_img='".$adrImage1."' WHERE ID_catalogue ='".$_GET['idcat']."'");
				
				$delai="1"; 
				$url='liste_catalogues.php';
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
	/* CODE PHP PERMETTANT DE SUPPRIMER UN SOUS CATALOGUE PUIS UN CATALOGUE*/
	if(isset($_POST['supprCat'])) {
		$bdd5 = bdd();
		$bdd5->exec("DELETE FROM souscatalogue WHERE catalogue_ID_catalogue='".$_POST['supprCat']."';
					DELETE FROM catalogue WHERE ID_catalogue='".$_POST['supprCat']."'");
		
	    $delai="1"; 
		$url='liste_catalogues.php';
		header("Refresh: $delai;url=$url");
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