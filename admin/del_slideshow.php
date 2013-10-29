<?php
session_start();
if (isset($_SESSION['login'], $_SESSION['pwd']))
{
	require "../admin/include/header.php";
	require "../admin/include/navbar.php";
	require "../admin/include/functions.php";

?>

<div id="contain">
<h3>Suppression d'une image défilante</h3>
<table id="delSlideshow" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Libellé</th>
            <th>Description</th>
            <th>Image</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $bdd = bdd();
            $slideshows = $bdd->query('SELECT IDslideshow, libelle, description, adrSlides FROM slideshow');
            foreach($slideshows as $slideshow) {
                echo '<tr>';
                echo '<td>' . $slideshow['IDslideshow'] . '</td>';
                echo '<td>' . $slideshow['libelle'] . '</td>';
                echo '<td>' . $slideshow['description'] . '</td>';
				echo '<td><img src="../' . $slideshow['adrSlides'] . '" width="400px"/></td>';
				echo '<td width="18%">
						<a href="del_slideshow.php?supprSlide='.$slideshow['IDslideshow'].'"><button class="btn btn-danger">Supprimer</button></a>
					  </td>';
                echo '</tr>';
            }
        ?>
    </tbody>
    <tfoot>
            <th>ID</th>
            <th>Libellé</th>
            <th>Description</th>
            <th>Image</th>
            <th>Supprimer</th>
    </tfoot>
</table>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#delSlideshow').dataTable();
} );
</script>

<?php
	/* CODE PHP PERMETTANT DE SUPPRIMER UN SOUS CATALOGUE PUIS UN CATALOGUE*/
	if(isset($_GET['supprSlide'])) {
		$bdd5 = bdd();
		$bdd5->exec("DELETE FROM slideshow WHERE IDslideshow='".$_GET['supprSlide']."'");
		
	    $delai="1"; 
		$url='del_slideshow.php';
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