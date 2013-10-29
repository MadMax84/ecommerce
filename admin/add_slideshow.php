<?php
session_start();
if (isset($_SESSION['login'], $_SESSION['pwd']))
{
	require "../admin/include/header.php";
	require "../admin/include/navbar.php";
	require "../admin/include/functions.php";
?>

<div id="contain">
<form action="" method="post" enctype="multipart/form-data">
<table class="table table-bordered center">
    <thead>
        <tr>
            <th colspan="2">Ajouter une image défilante :</th>
        </tr>
    </thead>
    <tr>
    	<td>Nom de votre image :</td>
        <td><input name="nomImg" type="text" placeholder="Nom de votre image défilante"/></td>
    </tr>
    <tr>
    	<td>Description de votre image :</td>
        <td><textarea name="descriptionImage" placeholder="Description de votre image défilante"></textarea></td>
    </tr>
    <tr>
    	<td colspan="2">
            <!-- On limite le fichier à 10Mo -->
            <input type="hidden" name="MAX_FILE_SIZE" value="5242880">
            Image : <input type="file" id="avatar" name="avatar"><br />
        </td>
    </tr>
    <tr>
    	<td colspan="2"><input type="submit" value="Ajouter l'image" class="btn btn-primary"/></td>
    </tr>
</table>
</form>
</div>

<?php

if(isset($_POST['nomImg']) && isset($_POST['descriptionImage'])) {	
	$nomImg = $_POST['nomImg'];
	$descImg = $_POST['descriptionImage'];
}

if(isset($_FILES['avatar'])) {

	$dossier = '../slideshow/';
	$fichier = basename($_FILES['avatar']['name']);
	$taille_maxi = 5242880;
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
			echo '<div class="alert alert-success">Upload effectué avec succès !</div>';
			
			$adrSlide = $dossier.$fichier;
			$trimmed = trim($adrSlide, '"../"');
			
			$bdd1 = bdd();
			$bdd1->exec("INSERT INTO slideshow(libelle, description, adrSlides) VALUES('".$nomImg."','".$descImg."','".$trimmed."')");
			
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