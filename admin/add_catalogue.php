<?php
session_start();
if (isset($_SESSION['login'], $_SESSION['pwd']))
{
	require "../admin/include/header.php";
	require "../admin/include/navbar.php";
	require "../admin/include/functions.php";

?>

<div id="contain">
<h3>Ajouter un catalogue</h3>
<form action="" method="post" enctype="multipart/form-data">
    <table class="table table-bordered">
        <tr>
            <td><label for="libelleCat">Libellé du catalogue :</label></td>
            <td><input name="libelleCat" type="text" placeholder="Nom de votre catalogue" id="libelleCat" required/></td>
        </tr>
        <tr>
            <td><label for="descCat">Description du catalogue :</label></td>
            <td><textarea name="descCat" placeholder="Descrivez votre catalogue" id="descCat" required></textarea></td>
        </tr>
        <tr>
            <td><label for="IDgenre">Genre du catalogue :</label></td>
            <td>
                <select name="IDgenre" id="IDgenre" required>
                <option value="0">Choisir genre:</option>
                <?php
                    $bdd1 = bdd();
                    $genre=$bdd1->query("SELECT ID_genre FROM genre");
                    foreach($genre as $genres) {
                        if($genres['ID_genre'] == "1") {
                            $genres['ID_genre'] = "Homme";
                        }
                        if($genres['ID_genre'] == "2") {
                            $genres['ID_genre'] = "Femme";
                        }
                        if($genres['ID_genre'] == "3") {
                            $genres['ID_genre'] = "Mixte";
                        }
                        echo '<option>' . $genres['ID_genre'] . '</option>';
                    }
                ?>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2">Ajouter une vignette :</td>
        </tr>
        <tr>
            <td>Nom de votre image :</td>
            <td><input name="nomVignCat" type="text" placeholder="Nom de votre vignette" required/></td>
        </tr>
        <tr>
            <td>Description de votre image :</td>
            <td><textarea name="descVignCat" placeholder="Description de votre vignette" required></textarea></td>
        </tr>
        <tr>
            <td colspan="2">
                <!-- On limite le fichier à 10Mo -->
                <input type="hidden" name="MAX_FILE_SIZE" value="5242880">
                Image : <input type="file" id="avatar" name="avatar" required>
            </td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="Ajouter un catalogue" class="btn btn-primary"/></td>
        </tr>
    </table>
</form>
</div>

<?php

if(isset($_POST['libelleCat']) && isset($_POST['descCat']) && isset($_FILES['avatar']) && isset($_POST['nomVignCat']) && isset($_POST['descVignCat'])) {

	// On récupère les données POST
	$libelleCat = $_POST['libelleCat'];
	$descCat = $_POST['descCat'];
	$IDgenre = $_POST['IDgenre'];
	
	if($IDgenre == "Homme") {
		$IDgenre = "1";
	}
	if($IDgenre == "Femme") {
		$IDgenre = "2";
	}
	if($IDgenre == "Mixte") {
		$IDgenre = "3";
	}

	$nomImg = $_POST['nomVignCat'];
	$descImg = $_POST['descVignCat'];

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
			
			$bdd2 = bdd();
			$bdd2->exec("INSERT INTO catalogue(cat_libelle, cat_description, cat_img, genre_ID_genre) VALUES('".$libelleCat."','".$descCat."','".$adrImage1."','".$IDgenre."')");
			
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