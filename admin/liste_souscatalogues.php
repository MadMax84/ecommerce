<?php
session_start();
if (isset($_SESSION['login'], $_SESSION['pwd']))
{
	require "../admin/include/header.php";
	require "../admin/include/navbar.php";
	require "../admin/include/functions.php";

?>

<div id="contain">
<h3>Liste des sous - catalogues</h3>
<table id="listeSousCatalogue" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Sous catalogue</th>
            <th>Description</th>
            <th>Appartient au catalogue</th>
            <th>Image</th>
            <th>Modifier / Supprimer</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $bdd = bdd();
            $assoc= $bdd->query('SELECT ID_souscatalogue, souscat_libelle, souscat_description, cat_libelle, souscat_img FROM souscatalogue, catalogue WHERE catalogue_ID_catalogue = ID_catalogue');
            foreach($assoc as $ligneTab) {
                echo '<tr>';
                echo '<td>' . $ligneTab['ID_souscatalogue'] . '</td>';
                echo '<td>' . $ligneTab['souscat_libelle'] . '</td>';
				echo '<td>' . $ligneTab['souscat_description'] . '</td>';
                echo '<td>' . $ligneTab['cat_libelle'] . '</td>';
				echo '<td><img src="' . $ligneTab['souscat_img'] . '" width="100px"/></td>';
				echo '<td width="18%">
						<a href="modif_souscatalogue.php?idsouscat='.$ligneTab['ID_souscatalogue'].'"><button class="btn btn-primary">Modifier</button></a>
						<a href="liste_souscatalogues.php?supprSousCat='.$ligneTab['ID_souscatalogue'].'"><button class="btn btn-danger">Supprimer</button></a>
					  </td>';
                echo '</tr>';
            }
        ?>
    </tbody>
    <tfoot>
            <th>ID</th>
            <th>Sous catalogue</th>
            <th>Description</th>
            <th>Appartient au catalogue</th>
            <th>Image</th>
            <th>Modifier / Supprimer</th>
    </tfoot>
</table>
</div>
    
<script type="text/javascript">
$(document).ready(function() {
    $('#listeSousCatalogue').dataTable();
} );
</script>

<?php
	/* CODE PHP PERMETTANT DE SUPPRIMER UN SOUS CATALOGUE */
	if(isset($_GET['supprSousCat'])) {
		$bdd6 = bdd();
		$bdd6->exec("DELETE FROM souscatalogue WHERE ID_souscatalogue='".$_GET['supprSousCat']."'");
		
		$delai="1"; 
		$url='liste_souscatalogues.php';
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