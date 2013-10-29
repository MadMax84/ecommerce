<?php
session_start();
if (isset($_SESSION['login'], $_SESSION['pwd']))
{
	require "../admin/include/header.php";
	require "../admin/include/navbar.php";
	require "../admin/include/functions.php";
	
	$id = $_GET['id'];
	
	$bdd = bdd();
	$clients = $bdd->query('SELECT * FROM clients WHERE ID_client = "'.$id.'"');
	foreach($clients as $client);

?>

<div id="contain">
<h3>Fiche client - <?php echo $client['pseudo'];?></h3>

<table class="table table-hover table-bordered">
    <tr>
        <th width="15%">N° Client</th><td><?php echo $client['ID_client'];?></td>
    </tr>
    <tr>
        <th>Pseudo :</th><td><?php echo $client['pseudo'];?></td>
    </tr>
    <tr>
        <th>Email :</th><td><?php echo $client['email'];?></td>
    </tr>
    <tr>
        <th>Civilité :</th><td><?php echo $client['civilite'];?></td>
    </tr>
    <tr>
        <th>Nom :</th><td><?php echo $client['nom'];?></td>
    </tr>
    <tr>
        <th>Prénom :</th><td><?php echo $client['prenom'];?></td>
    </tr>
    <tr>
        <th>Date de Naissance :</th><td><?php echo $client['date_naissance'];?></td>
    </tr>
    <tr>
        <th>Téléphone :</th><td>0<?php echo $client['telephone'];?></td>
    </tr>
    <tr>
        <th>Adresse de facturation :</th><td><?php echo $client['num_facturation'].' '.$client['adresse_facturation'].' , '.$client['cp_facturation'].' '.$client['ville_facturation'];?></td>
    </tr>
    <tr>
        <th>Adresse de livraison :</th><td><?php echo $client['num_livraison'].' '.$client['adresse_livraison'].' , '.$client['cp_livraison'].' '.$client['ville_livraison'];?></td>
    </tr>
    <tr>
        <th>Pays :</th><td><?php echo $client['pays'];?></td>
    </tr>
    <tr>
        <th>Membre V.I.P :</th><td><form method="post" action="">
        <?php
			if($client['vip'] == 1) {
				echo 'OUI <input name="vip" type="radio" value="1" checked="checked"/> NON <input name="vip" type="radio" value="0" />';
			}
			else {
				echo 'OUI <input name="vip" type="radio" value="1"/> NON <input name="vip" type="radio" value="0" checked="checked" />';
			}
		?>
        <input type="submit" class="btn btn-primary" value="V.I.P ?"/>
        </form>
        </td>
    </tr>
</table>

<?php
	if(isset($_POST['vip'])) {
		$newvip = $_POST['vip'];
		
		$bdd2 = bdd();
		$bdd2->exec("UPDATE clients SET vip='".$newvip."' WHERE ID_client ='".$_GET['id']."'");
		
		$delai="1"; 
		$url='liste_clients.php';
		header("Refresh: $delai;url=$url"); 
	}
?>

<br/>

<h3>Historique de ses commandes</h3>

</div>

<?php
	require "../admin/include/footer.php";
}
else {
	// Redirection de l'utilisateur //
	header("Location: ../admin/index.php");
}
?>