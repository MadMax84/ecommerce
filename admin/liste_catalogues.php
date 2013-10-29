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
<table id="listeCatalogue" class="table table-bordered table-hover">
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
						<a href="modif_catalogue.php?idcat='.$catalogue['ID_catalogue'].'"><button class="btn btn-primary">Modifier</button></a>
						<a href="liste_catalogues.php?supprCat='.$catalogue['ID_catalogue'].'"><button class="btn btn-danger">Supprimer</button></a>
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
	/* CODE PHP PERMETTANT DE SUPPRIMER UN SOUS CATALOGUE PUIS UN CATALOGUE*/
	if(isset($_GET['supprCat'])) {
		$bdd5 = bdd();
		$bdd5->exec("DELETE FROM souscatalogue WHERE catalogue_ID_catalogue='".$_GET['supprCat']."';
					DELETE FROM catalogue WHERE ID_catalogue='".$_GET['supprCat']."'");
		
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