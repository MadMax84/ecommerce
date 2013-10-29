<?php
session_start();
if (isset($_SESSION['login'], $_SESSION['pwd']))
{
	require "../admin/include/header.php";
	require "../admin/include/navbar.php";
	require "../admin/include/functions.php";

?>

<div id="contain">
<h3>Liste des clients</h3>
<table id="listeClients" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Pseudo</th>
            <th>Email</th>
            <th>Civilité</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>V.I.P</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $bdd = bdd();
            $clients = $bdd->query('SELECT ID_client, pseudo, email, civilite, nom, prenom, vip FROM clients');
            foreach($clients as $client) {
			
				if($client['vip'] == "1") {
					$client['vip'] = "OUI";
				}
				else {
					$client['vip'] = "NON";
				}
				
                echo '<tr>';
                echo '<td>' . $client['pseudo'] . '</td>';
                echo '<td>' . $client['email'] . '</td>';
                echo '<td>' . $client['civilite'] . '</td>';
                echo '<td>' . $client['nom'] . '</td>';
				echo '<td>' . $client['prenom'] . '</td>';
				echo '<td>' . $client['vip'] . '</td>';		
				echo '<td>
						<a href="contact.php?id='.$client['ID_client'].'"><button class="btn btn-primary">Contact</button></a>
						<a href="ficheclient.php?id='.$client['ID_client'].'"><button class="btn btn-primary">Fiche complète</button></a>
					  </td>';
                echo '</tr>';
            }
        ?>
    </tbody>
    <tfoot>
            <th>Pseudo</th>
            <th>Email</th>
            <th>Civilité</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>V.I.P</th>
            <th>Actions</th>
    </tfoot>
</table>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#listeClients').dataTable();
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