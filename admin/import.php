<?php
session_start();
if (isset($_SESSION['login'], $_SESSION['pwd']))
{
	require "../admin/include/header.php";
	require "../admin/include/navbar.php";
	require "../admin/include/functions.php";
?>

<form action="" method="post" enctype="multipart/form-data" name="form1"> 
  Votre fichier CSV : <br /> 
  <input name="csv" type="file" id="csv" /> 
  <input type="submit" name="Envoyer" value="Envoyer" /> 
</form> 

<?php  

if ($_FILES['csv'][size] > 0) { 

    //get the csv file 
    $file = $_FILES[csv][tmp_name]; 
    $handle = fopen($file,"r"); 
     
    //loop through the csv file and insert into database 
    do { 
        if ($data[0]) { 
			$bdd = bdd();
			$infoProduit=$bdd->query("INSERT INTO produits(nom, description, marque, dimensions, prix, quantite, nouveaute, genre_ID_genre) VALUES 
                ( 
                    '".addslashes($data[0])."', 
                    '".addslashes($data[1])."',
					'".addslashes($data[2])."', 
					'".addslashes($data[3])."', 
					'".addslashes($data[4])."', 
					'".addslashes($data[5])."', 
					'".addslashes($data[6])."', 
                    '".addslashes($data[7])."' 
                ) 
            "); 
        } 
    } while ($data = fgetcsv($handle,1000,",","'")); 
    // 

    //redirect 
    header('Location: import.php?success=1'); die; 
	if (!empty($_GET['success'])) { 
		echo "<b>Votre fichier à bien été importer.</b><br><br>"; 
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