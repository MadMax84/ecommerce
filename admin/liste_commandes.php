<?php
session_start();
if (isset($_SESSION['login'], $_SESSION['pwd']))
{
	require "../admin/include/header.php";
	require "../admin/include/navbar.php";
	require "../admin/include/functions.php";

?>

<div id="contain">
<h3>Liste des commandes</h3>
<table id="listeCommandes" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Référence</th>
            <th>Client</th>
            <th>Etat</th>
            <th>Avancement</th>
            <th>Transporteur</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $bdd = bdd();
            $commandes = $bdd->query('SELECT ref_commande, clients.pseudo, etat, avancement, transports.transporteur FROM commandes, clients, transports WHERE ID_client = clients_ID_client AND ID_transport = transports_ID_transport GROUP BY ref_commande');
            foreach($commandes as $commande) {
				
                echo '<tr>';
                echo '<td>' . $commande[0] . '</td>';
				echo '<td>' . $commande[1] . '</td>';
                echo '<td>' . $commande[2] . '</td>';
                echo '<td><div class="progress progress-striped active"><div class="bar" style="width:' . $commande['3'] . '%;"></div></div></td>';
				echo '<td>' . $commande[4] . '</td>';
				echo '<td><a href="fiche_commande.php?ref='.$commande['0'].'"><button class="btn btn-primary">Fiche commande</button></a></td>';
                echo '</tr>';
            }
        ?>
    </tbody>
    <tfoot>
            <th>Référence</th>
            <th>Client</th>
            <th>Etat</th>
            <th>Avancement</th>
            <th>Transporteur</th>
            <th>Action</th>
    </tfoot>
</table>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#listeCommandes').dataTable();
} );
</script>

<?php
	require "../admin/include/footer.php";
}
else {
	// Redirection de l'utilisateur //
	header("Location: ../admin/index.php");
}
?>