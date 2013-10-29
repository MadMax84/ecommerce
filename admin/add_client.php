<?php
session_start();
if (isset($_SESSION['login'], $_SESSION['pwd']))
{
	require "../admin/include/header.php";
	require "../admin/include/navbar.php";
	require "../admin/include/functions.php";

?>

<div id="contain">
<h3>Ajouter un client</h3>

<form method="post" action="">
<table class="table table-hover table-bordered">
	<thead>
        <tr>
            <th colspan="2">Informations générales</th>
        </tr>
    </thead>
    <tr>
        <td width="12%">Pseudo :</td><td><input type="text" name="pseudo" placeholder="Pseudonyme du client" required/></td>
    </tr>
    <tr>
        <td>Password :</td><td><input type="password" name="password" placeholder="Mot de passe du client" required/></td>
    </tr>
    <tr>
        <td>Email :</td><td><input type="email" name="email" placeholder="Email du client" required/></td>
    </tr>
    <tr>
        <td>Nom :</td><td><input type="text" name="nom" placeholder="Nom du client" required/></td>
    </tr>
    <tr>
        <td>Prénom :</td><td><input type="text" name="prenom" placeholder="Prénom du client" required/></td>
    </tr>
    <tr>
        <td>Date de Naissance :</td><td><input type="date" name="datenaissance" required/></td>
    </tr>
    <tr>
        <td>Civilité :</td><td><select name="civilite">
        	<option selected value="0">Civilité du nouveau client</option>
        	<option value="Mr">Mr</option>
            <option value="Mlle">Mlle</option>
            <option value="Mme">Mme</option>
        </select></td>
    </tr>
    <tr>
        <td>Téléphone :</td><td><input type="tel" name="tel" pattern="^0[1-689][0-9]{8}$" placeholder="Exemple : 0102030405 sans espace ni tirets" required/></td>
    </tr>
    <tr>
        <td>Pays :</td><td><select name="pays">
        	<option selected value="0">Pays du nouveau client</option>
        	<option value="France">France</option>
            <option value="Belgique">Belgique</option>
        </select></td>
    </tr>
    <thead>
        <tr>
            <th colspan="2">Adresse de Facturation</th>
        </tr>
    </thead>
    <tr>
        <td>N° de Rue :</td><td><input name="numRueF" type="number" placeholder="Numéro de rue"/></td>
    </tr>
    <tr>
        <td>Adresse :</td><td><input type="text" name="adresseF" placeholder="Adresse de facturation"/></td>
    </tr>
    <tr>
        <td>Code Postal :</td><td><input name="cpF" type="number" placeholder="Code postal"/></td>
    </tr>
    <tr>
        <td>Ville :</td><td><input type="text" name="villeF" placeholder="Ville"/></td>
    </tr>
    <thead>
        <tr>
            <th colspan="2">Adresse de Livraison</th>
        </tr>
    </thead>
    <tr>
        <td>N° de Rue :</td><td><input name="numRueL" type="number" placeholder="Numéro de rue"/></td>
    </tr>
    <tr>
        <td>Adresse :</td><td><input type="text" name="adresseL" placeholder="Adresse de Livraison"/></td>
    </tr>
    <tr>
        <td>Code Postal :</td><td><input name="cpL" type="number" placeholder="Code postal"/></td>
    </tr>
    <tr>
        <td>Ville :</td><td><input type="text" name="villeL" placeholder="Ville"/></td>
    </tr>
    <tr>
    	<td colspan="2"><input type="submit" value="Ajouter un client" class="btn btn-primary"/></td>
    </tr>
</table>
</form>

<?php

if(isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['datenaissance']) && isset($_POST['civilite']) && isset($_POST['tel']) && isset($_POST['pays'])) {

$pseudo = $_POST['pseudo'];
$password = md5($_POST['password']);
$email = $_POST['email'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$naissance = $_POST['datenaissance'];
$civilite = $_POST['civilite'];
$tel = $_POST['tel'];
$pays = $_POST['pays'];

$numRueF = $_POST['numRueF'];
$adresseF = $_POST['adresseF'];
$cpF = $_POST['cpF'];
$villeF = $_POST['villeF'];

$numRueL = $_POST['numRueL'];
$adresseL = $_POST['adresseL'];
$cpL = $_POST['cpL'];
$villeL = $_POST['villeL'];

/* Vérifie que l'utilisateur n'existe pas déjà */

$bdd = bdd();
$rows = $bdd->prepare("SELECT pseudo, email FROM clients WHERE (pseudo='".$pseudo."' OR email='".$email."')");
$rows->execute();
$count = $rows->rowCount();

if($count >= 1) {
	echo '<div class="alert alert-error">Le pseudo ou l\'adresse email à déjà été utilisé.</div>';
}
else {
		$bdd1 = bdd();
		$bdd1->exec("INSERT INTO clients(pseudo, password, email, nom, prenom, date_naissance, civilite, telephone, num_facturation, adresse_facturation, cp_facturation, ville_facturation, num_livraison, adresse_livraison, cp_livraison, ville_livraison, pays) 
		VALUES ('".$pseudo."','".$password."','".$email."','".$nom."','".$prenom."','".$naissance."','".$civilite."','".$tel."','".$numRueF."','".$adresseF."','".$cpF."','".$villeF."','".$numRueL."','".$adresseL."','".$cpL."','".$villeL."','".$pays."')");
				
		echo '<div class="alert alert-success">Le client à bien été créer.</div>';
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