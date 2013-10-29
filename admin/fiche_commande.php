<?php
session_start();
if (isset($_SESSION['login'], $_SESSION['pwd']))
{
	require "../admin/include/header.php";
	require "../admin/include/navbar.php";
	require "../admin/include/functions.php";

?>

<div id="contain">
<?php
	$id = $_GET['ref'];
	$bdd = bdd();
	$commandes = $bdd->query('SELECT ref_commande, clients.pseudo, produits.nom, prixc, quantitec, taxes.taxe, etat, avancement, transports.transporteur FROM commandes, clients, produits, taxes, transports WHERE ID_client = clients_ID_client AND ID_produit = produits_ID_produit AND ID_transport = transports_ID_transport AND ref_commande = "'.$_GET['ref'].'"');
	foreach($commandes as $commande);
	
	$bdd1 = bdd();
	$clients = $bdd1->query('SELECT * FROM clients WHERE pseudo = "'.$commande['1'].'"');
	foreach($clients as $client);
	
	$bdd2 = bdd();
	$produitsCommandes = $bdd2->query('SELECT produits.nom, prixc, quantitec FROM commandes, clients, produits, taxes, transports WHERE ID_client = clients_ID_client AND ID_produit = produits_ID_produit AND ID_transport = transports_ID_transport AND ref_commande = "'.$_GET['ref'].'"');
	
?>
<h3>Fiche commande N° <?php echo $commande['0'];?> </h3>
	<table class="table table-bordered table-hover">
        <thead>
        	<th colspan="2">Informations clients :</th>
        </thead>
    	<tr>
        	<th rowspan="8" width="20%">Client :</th>
        </tr>
        <tr><td width="40%%">Pseudo :</td><td><?php echo $client['pseudo']; ?></td></tr>
        <tr><td>Email :</td><td><?php echo $client['email']; ?></td></tr>
        <tr><td>Civilité :</td><td><?php echo $client['civilite']; ?></td></tr>
        <tr><td>Nom :</td><td><?php echo $client['nom']; ?></td></tr>
        <tr><td>Prénom :</td><td><?php echo $client['prenom']; ?></td></tr>
        <tr><td>Date de Naissance :</td><td><?php echo $client['date_naissance']; ?></td></tr>
        <tr><td>Téléphone :</td><td>0<?php echo $client['telephone']; ?></td></tr>
        <tr>
        	<th>Adresse de facturation :</th>
            <td colspan="2"><?php echo $client['num_facturation'].' '.$client['adresse_facturation'].' , '.$client['cp_facturation'].' '.$client['ville_facturation']. ' , '.$client['pays'];?></td>
        </tr>
        <tr>
        	<th>Adresse de livraison :</th>
            <td colspan="2"><?php echo $client['num_livraison'].' '.$client['adresse_livraison'].' , '.$client['cp_livraison'].' '.$client['ville_livraison']. ' , '.$client['pays'];;?></td>
        </tr>
    </table>
    <table class="table table-bordered table-hover">
        <thead>
        	<th colspan="2">Commande  :</th>
        </thead>
    	<tr>
        	<th rowspan="5" width="20%">Liste des produits commandés :</th><th>Nom du produit</th><th>Prix</th><th>Quantité commandé</th>
        </tr>
		<?php
            foreach($produitsCommandes as $produit) {
                echo '<tr><td>'.$produit['0'].'</td><td>'.$produit['1'].'</td><td>'.$produit['2'].'</td></tr>';
            }
        ?>
    </table>
    <table class="table table-bordered table-hover">
    	<form action="" method="post">
        <thead>
        	<th colspan="2">Situation de la commande :</th>
        </thead>
    	<tr>
        	<th width="20%">Etat de la commande :</th><th>Avancement de la commande :</th>
        </tr>
        <tr>
            <td>
            	<select name="etat">
                	<option selected="selected"><?php echo $commande['etat'];?></option>
                    <option value="Preparation"> En préparation</option>
                    <option value="Cours">En cours</option>
                    <option value="Attente">En attente du transporteur</option>
                    <option value="Envoye">Envoyé</option>
                    <option value="Plateforme">Plateforme d'envoi</option>
                    <option value="Transit">En transit</option>
                    <option value="Relais">Point relais</option>
                    <option value="Termine">Terminé</option>
                </select>
            </td>
            <td><?php echo '<div class="progress progress-striped active"><div class="bar" style="width:' . $commande['avancement'] . '%;"></div></div>';?></td>
        </tr>
        <tr><td colspan="2"><input type="submit" class="btn btn-primary"/></td></tr>
        </form>
    </table>
    
</div>

<?php
if(isset($_POST['etat'])) {
	$newEtat = $_POST['etat'];
	
	$bdd5 = bdd();
	$bdd5->exec("UPDATE commandes SET etat='".$newEtat."' WHERE ref_commande ='".$id."'");
	
	$bdd51 = bdd();
	$etats = $bdd51->query("SELECT etat FROM commandes WHERE ref_commande = '".$id."'");
	foreach($etats as $etat);
	
	if($etat['etat'] == "Preparation") {
		$avancement = "10";
	}
	if($etat['etat'] == "Cours") {
		$avancement = "20";
	}
	if($etat['etat'] == "Attente") {
		$avancement = "40";
	}
	if($etat['etat'] == "Envoye") {
		$avancement = "50";
	}
	if($etat['etat'] == "Plateforme") {
		$avancement = "60";
	}
	if($etat['etat'] == "Transit") {
		$avancement = "70";
	}
	if($etat['etat'] == "Relais") {
		$avancement = "90";
	}
	if($etat['etat'] == "Termine") {
		$avancement = "100";
	}
	
	$bdd6 = bdd();
	$bdd6->exec("UPDATE commandes SET avancement='".$avancement."' WHERE ref_commande ='".$id."'");
	
	$delai="1"; 
	$url='liste_commandes.php';
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