<?php
session_start();
if (isset($_SESSION['login'], $_SESSION['pwd']))
{
	require "../admin/include/header.php";
	require "../admin/include/navbar.php";
	require "../admin/include/functions.php";

?>

<div id="contain">
<h3>Ajouter un sous-catalogue</h3>
<form action="" method="post" enctype="multipart/form-data">
    <table class="table table-bordered">
        <tr>
            <td>Libellé du sous - catalogue :</td>
            <td><input name="libelleSousCat" type="text" placeholder="Nom de votre sous - catalogue" required/></td>
        </tr>
        <tr>
            <td>Description du sous - catalogue :</td>
            <td><textarea name="descSousCat" placeholder="Descrivez votre sous - catalogue" required></textarea></td>
        </tr>
        <tr>
            <td>Catalogue parent :</td>
            <td>
                <select name="IDparent" required>
                <option value="0">Choisir le catalogue parent :</option>
                <?php
                    $bdd1 = bdd();
                    $catParent=$bdd1->query("SELECT cat_libelle FROM catalogue");
                    foreach($catParent as $parent) {
                        echo '<option>' . $parent['cat_libelle'] . '</option>';
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
            <td><input name="nomVignSousCat" type="text" placeholder="Nom de votre vignette" required/></td>
        </tr>
        <tr>
            <td>Description de votre image :</td>
            <td><textarea name="descVignSousCat" placeholder="Description de votre vignette" required></textarea></td>
        </tr>
        <tr>
            <td colspan="2">
                <!-- On limite le fichier à 10Mo -->
                <input type="hidden" name="MAX_FILE_SIZE" value="5242880">
                Image : <input type="file" id="avatar" name="avatar">
            </td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="Ajouter un sous - catalogue" class="btn btn-primary"/></td>
        </tr>
    </table>
</form>
</div>

<?php

if(isset($_POST['libelleSousCat']) && isset($_POST['descSousCat']) && isset($_FILES['avatar']) && isset($_POST['nomVignSousCat']) && isset($_POST['descVignSousCat'])) {

	// On récupére les données POST
	$libelleSousCat = $_POST['libelleSousCat'];
	$descSousCat = $_POST['descSousCat'];
	$nomImg = $_POST['nomVignSousCat'];
	$descImg = $_POST['descVignSousCat'];

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
			$IDparent = $bdd2->query("SELECT ID_catalogue FROM catalogue WHERE cat_libelle LIKE '" . $_POST['IDparent'] . "'");
			foreach ($IDparent as $idCat);
				
			$bdd3 = bdd();
			$bdd3->exec("INSERT INTO souscatalogue(souscat_libelle, souscat_description, souscat_img, catalogue_ID_catalogue) VALUES ('".$libelleSousCat."','".$descSousCat."','".$adrImage1."','".$idCat['ID_catalogue']."')");
			
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