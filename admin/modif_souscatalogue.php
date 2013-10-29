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
	if(isset($_GET['idsouscat'])) {
		$bdd2 = bdd();
		$recupData = $bdd2->query('SELECT ID_souscatalogue, souscat_libelle, souscat_description, souscat_img, catalogue_ID_catalogue, ID_catalogue, cat_libelle FROM souscatalogue, catalogue WHERE ID_souscatalogue ="'.$_GET['idsouscat'].'" AND ID_catalogue = catalogue_ID_catalogue');
		foreach($recupData as $value) {
		?>
			<h3> >> Modification de la sous-catégorie : <?php echo $value['souscat_libelle'];?> </h3>
			<form action="" method="post" enctype="multipart/form-data">
			<table class="table table-bordered">
				<tr>
                	<td>Libellé :</td>
                    <td><input type="text" value="<?php echo $value['souscat_libelle']; ?>" name="newlibelleSousCat"/></td>
                </tr>
				<tr>
                	<td>Description :</td>
                    <td><textarea name="newdescSousCat"><?php echo $value['souscat_description']; ?></textarea></td>
                </tr>
				<tr>
                	<td>Catalogue parent :</td>
                    <td>
                        <select name="newIDparent">
                        <option><?php echo $value['cat_libelle'];?></option>
                        <?php
                            $bdd3 = bdd();
                            $catParent=$bdd3->query("SELECT cat_libelle FROM catalogue");
                            foreach($catParent as $parent) {
                                echo '<option>' . $parent['cat_libelle'] . '</option>';
                            }
                        ?>
                        </select>
                	</td>
                </tr>
                <tr>
                	<td>Image :</td>
                    <td><img src="<?php echo $value['souscat_img']; ?>" width="100px"/></td>
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
                	<td colspan="2"><input type="submit" value="Modifier la sous-catégorie" class="btn btn-primary"/></td>
                </tr>
            </table>
			</form>
<?php
		}
		
		if(isset($_POST['newlibelleSousCat']) && isset($_POST['newdescSousCat'])) {	
			// On récupére les données POST
			$newLibelle = $_POST['newlibelleSousCat'];
			$newDescription = $_POST['newdescSousCat'];
			
			$bdd4 = bdd();
			$newIDparent = $bdd4->query("SELECT ID_catalogue FROM catalogue WHERE cat_libelle LIKE '" . $_POST['newIDparent'] . "'");
			foreach ($newIDparent as $newidCat);
			
			$bdd5 = bdd();
			$bdd5->exec("UPDATE souscatalogue SET souscat_libelle='".$newLibelle."',souscat_description='".$newDescription."', catalogue_ID_catalogue='".$newidCat['ID_catalogue']."' WHERE ID_souscatalogue = '".$value['ID_souscatalogue']."'");
			
			$delai="1"; 
			$url='liste_souscatalogues.php';
			header("Refresh: $delai;url=$url"); 
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
					$bdd7->exec("UPDATE souscatalogue SET souscat_img='".$adrImage1."' WHERE ID_souscatalogue ='".$_GET['idsouscat']."'");
					
					$delai="1"; 
					$url='liste_souscatalogues.php';
					header("Refresh: $delai;url=$url");
					
				 }
				 else //Sinon (la fonction renvoie FALSE).
				 {
					  echo 'Echec de l\'upload !';
				 }
			}
/*			else
			{
				 echo $erreur;
			}*/
		
		}	
		
		
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