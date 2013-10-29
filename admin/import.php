<?php
session_start();
if (isset($_SESSION['login'], $_SESSION['pwd']))
{
	require "../admin/include/header.php";
	require "../admin/include/navbar.php";
	require "../admin/include/functions.php";
?>

<form action="" method="post" enctype="multipart/form-data"> 
  Votre fichier CSV : 
  <input name="uploadedfile" type="file"/> <br/>
  <input type="submit" class="btn btn-primary" name="Envoyer" value="Envoyer" /> 
</form>

<?php  

if(isset($_FILES['uploadedfile']['tmp_name']) && $_FILES['uploadedfile']['tmp_name'] != "")
{
    $handle = fopen($_FILES['uploadedfile']['tmp_name'], "r");
    $data = fgetcsv($handle, 1000, ";"); //Remove if CSV file does not have column headings
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) 
		{
			echo $data[0].'<br/>';
			echo $data[1].'<br/>';
			echo $data[2].'<br/>';
			echo $data[3].'<br/>';
			echo $data[4].'<br/>';
			echo $data[5].'<br/>';
			echo $data[6].'<br/>';
			echo $data[7].'<br/>';
			echo $data[8].'<br/>';
			echo $data[9];
		
			$bdd = bdd();
			$infoProduit=$bdd->exec("INSERT INTO produits(nom, description, marque, dimensions, prix, quantite, nouveaute, genre_ID_genre, vipProduit) VALUES('".$data[0]."', '".$data[1]."', '".$data[2]."', '".$data[3]."', '".$data[4]."', '".$data[5]."', '".$data[6]."', '".$data[7]."', '".$data[9]."')");
			
			$bdd1 = bdd();
  			$IDproduit=$bdd1->query("SELECT ID_produit FROM produits WHERE nom='".$data[0]."' AND description='".$data[1]."'");
			foreach($IDproduit as $idproduit);
			
			$bdd2 = bdd();
			$infoImage=$bdd2->exec("INSERT INTO images(adrImage1, produits_ID_produit) VALUES ('".$data[8]."', '".$idproduit['ID_produit']."')");
		 }
}
else {
/*	   header('Location: import.php?success=1'); die; 
		if (!empty($_GET['success'])) { 
			echo "<b>Votre fichier à bien été importer.</b><br><br>"; 
		}*/
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