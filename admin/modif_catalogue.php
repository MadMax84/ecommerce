<?php
session_start();
if (isset($_SESSION['login'], $_SESSION['pwd']))
{
	require "../admin/include/header.php";
	require "../admin/include/navbar.php";
	require "../admin/include/functions.php";

?>

<div id="contain">
<?php 
	/* CODE PHP PERMETTANT DE MODIFIER UN SOUS CATALOGUE */
	if(isset($_GET['idcat'])) {
		$bdd2 = bdd();
		$recupData = $bdd2->query('SELECT ID_catalogue, cat_libelle, cat_description, cat_img, genre_ID_genre FROM catalogue WHERE ID_catalogue ="'.$_GET['idcat'].'"');
		foreach($recupData as $value) {
		?>
			<h3> >> Modification de la catégorie : <?php echo $value['cat_libelle'];?> </h3>
			<form action="" method="post" enctype="multipart/form-data">
			<table class="table table-bordered table-hover">
				<tr>
                	<th>Libellé :</th>
                    <td><input type="text" value="<?php echo $value['cat_libelle']; ?>" name="newlibelleCat"/></td>
                </tr>
				<tr>
                	<th>Description :</th>
                    <td><textarea name="newdescCat"><?php echo $value['cat_description']; ?></textarea></td>
                </tr>
				<tr>
                	<th>Genre :</th>
                    <td>
                        <select name="newIDgenre">
						<?php
                            $bdd31 = bdd();
                            $genres=$bdd31->query("SELECT ID_genre FROM genre, catalogue WHERE ID_genre = genre_ID_genre AND ID_catalogue = '".$_GET['idcat']."'");
                            foreach($genres as $genre) {
                                if($genre['ID_genre'] == "1") {
                                    $genre['ID_genre'] = "Homme";
                                }
                                if($genre['ID_genre'] == "2") {
                                    $genre['ID_genre'] = "Femme";
                                }
                                if($genre['ID_genre'] == "3") {
                                    $genre['ID_genre'] = "Mixte";
                                }
                                echo '<option selected>' . $genre['ID_genre'] . '</option>';
                            }
                        ?>
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
                	<th>Image :</th>
                    <td><img src="<?php echo $value['cat_img']; ?>" width="100px"/></td>
                </tr>
                <tr>
                	<th>Fichier : </th>
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
/*		else
		{
			 echo $erreur;
		}*/
	
	}	
	
?>
</div>

<?php
	require "../admin/include/footer.php";
}
else {
	// Redirection de l'utilisateur //
	header("Location: ../admin/index.php");
}
?>