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
            <th colspan="2">Caractéristiques du produit :</th>
        </tr>
    </thead>
	<tr>
    	<td>Nom du produit :</td>
        <td><input name="nom" type="text" placeholder="Nom de votre produit"/></td>
    </tr>
    <tr>
    	<td>Description du produit :</td>
        <td><textarea name="descriptionProduit" placeholder="Description de votre produit"></textarea></td>
    </tr>
    <tr>
    	<td>Marque du produit :</td>
        <td><input name="marque" type="text" placeholder="Marque de votre produit"/></td>
    </tr>
    <tr>
    	<td>Dimensions :</td>
        <td><input name="dimensions" type="text" placeholder="Dimensions de votre produit"/></td>
    </tr>
    <tr>
    	<td>Prix :</td>
        <td><input name="prix" type="text" placeholder="Prix du produit"/></td>
    </tr>
    <tr>
    	<td>Quantité :</td>
        <td><input name="quantite" type="text" placeholder="Stock de votre produit"/></td>
    </tr>
    <tr>
    	<td>Sous-catalogue affilié :</td>
        <td>
            <select name="sousCat">
                <option value="0">Choisir le sous catalogue :</option>
                <?php
                    $bdd = bdd();
                    $souscatalogues=$bdd->query("SELECT ID_souscatalogue, souscat_libelle FROM souscatalogue");
                    foreach($souscatalogues as $souscatalogue) {
                        echo '<option value="'.$souscatalogue['ID_souscatalogue'].'">' . $souscatalogue['souscat_libelle'] . '</option>';
                    }
                ?>
            </select>
        </td>
    </tr>
    <tr>
    	<td>Genre du produit :</td>
        <td>
            <select name="IDgenre" id="IDgenre">
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
    <thead>
        <tr>
            <th colspan="2">Vignette du produit :</th>
        </tr>
    </thead>
    <tr>
    	<td>Nom de votre image :</td>
        <td><input name="nomImg1" type="text" placeholder="Nom de votre image 1"/></td>
    </tr>
    <tr>
    	<td>Description de votre image :</td>
        <td><textarea name="descriptionImage1" placeholder="Description de votre image"></textarea></td>
    </tr>
    <tr>
    	<td colspan="2">
            <!-- On limite le fichier à 100Ko -->
            <input type="hidden" name="MAX_FILE_SIZE" value="100000">
            Fichier : <input type="file" id="avatar" name="avatar"><br />
        </td>
    </tr>
    <thead>
        <tr>
            <th colspan="2">Nouveauté du produit :</th>
        </tr>
    </thead>
    <tr>
    	<td>OUI <input name="nouveaute" type="radio" value="1" /></td>
        <td>NON <input name="nouveaute" type="radio" value="0" /></td>
    </tr>
    <thead>
        <tr>
            <th colspan="2">Produit visible pour les membres V.I.P :</th>
        </tr>
    </thead>
    <tr>
    	<td>OUI <input name="vip" type="radio" value="1" /></td>
        <td>NON <input name="vip" type="radio" value="0" /></td>
    </tr>
    <tr>
    	<td colspan="2"><input type="submit" value="Ajouter le produit" class="btn btn-primary"/></td>
    </tr>
</table>

</form>

<?php

if(isset($_POST['nom']) && isset($_POST['descriptionProduit']) && isset($_POST['marque']) && isset($_POST['dimensions']) && isset($_POST['prix']) && isset($_POST['quantite']) && isset($_POST['IDgenre']) && isset($_POST['nouveaute']) && isset($_POST['vip']) && isset($_FILES['avatar'])) {

	// On récupère les données POST
	$nomProduit = $_POST['nom'];
	$descriptionProduit = $_POST['descriptionProduit'];
	$marqueProduit = $_POST['marque'];
	$dimensionsProduit = $_POST['dimensions'];
	$prixProduit = $_POST['prix'];
	$quantiteProduit = $_POST['quantite'];
	$souscat = $_POST['sousCat'];
	$genreProduit = $_POST['IDgenre'];
	$nouveauteProduit = $_POST['nouveaute'];
	$vipProduit = $_POST['vip'];
	
	$nomImg = $_POST['nomImg1'];
	$descImg1 = $_POST['descriptionImage1'];
	
	if($genreProduit == "Homme") {
		$genreProduit = "1";
	}
	if($genreProduit == "Femme") {
		$genreProduit = "2";
	}
	if($genreProduit == "Mixte") {
		$genreProduit = "3";
	}

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
			
			$bdd2 = bdd();
			$bdd2->exec("INSERT INTO produits(nom, description, marque, dimensions, prix, quantite, nouveaute, genre_ID_genre, souscatalogue_ID_souscatalogue, vipProduit) VALUES('".$nomProduit."','".$descriptionProduit."','".$marqueProduit."','".$dimensionsProduit."','".$prixProduit."','".$quantiteProduit."','".$nouveauteProduit."','".$genreProduit."','".$souscat."','".$vipProduit."')");
			
			$bdd3 = bdd();
  			$IDproduit=$bdd3->query("SELECT ID_produit FROM produits WHERE nom='".$nomProduit."' AND description='".$descriptionProduit."'");
			foreach($IDproduit as $idproduit);
			
			$adrImage1 = $dossier.$fichier;
			
			$bdd4 = bdd();
			$bdd4->exec("INSERT INTO images(libelle, description, adrImage1, produits_ID_produit) VALUES('".$nomImg."','".$descImg1."','".$adrImage1."','".$idproduit['ID_produit']."')");
			
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

</div>

<?php
	require "../admin/include/footer.php";
}
else {
	// Redirection de l'utilisateur //
	header("Location: ../admin/index.php");
}
?>