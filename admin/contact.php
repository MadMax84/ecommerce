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
		$idClient = $_GET['id'];
		$bdd = bdd();
        $clients = $bdd->query('SELECT ID_client, pseudo, email, civilite, nom, prenom, vip FROM clients WHERE ID_client = "'.$idClient.'"');
		foreach($clients as $client);
		
		echo '<h3>Formulaire de contact - ' .$client['pseudo']. '</h3>';
	?>
            <form method="post" action="">
            <table>
                    <tr><td><label for="sujet">Sujet : </label></td><td><input type="text" name="sujet" id="sujet" size="100"
                    value="<?php if(isset($_POST['sujet'])) echo htmlspecialchars($_POST['sujet'])?>" /></td></tr>
                    <tr><td><label for="mess">Message : </label></td><td><textarea name="mess" id="mess" size="100"><?php if(isset($_POST['mess'])) echo htmlspecialchars($_POST['mess'])?></textarea></td></tr>
            </table>
                    <p class="right"><input type="submit" value="Envoyer" class="btn btn-primary"/></p>
            </form> 
</div>

<?php 
if(isset($_POST['sujet']) && isset($_POST['mess'])) {

	$msg_ok = '<div class="alert alert-success">Le message a bien été envoyer.</div>';

	$sujet = $_POST['sujet']; 
	$mess = $_POST['mess'];
	
	$msg_erreur = "Erreur. Les champs suivants doivent être obligatoirement 
	remplis :<br/><br/>";
	/*$msg_ok = "Votre demande a bien ete prise en compte.";*/
	$message = $msg_erreur;
	define ('MAIL_DESTINATAIRE',$client['email']); // remplacer par votre email
	define ('MAIL_SUJET','GrindHouse Leather - Administration');
	 
	// vérification des champs
	if (empty ($_POST['sujet'])) 
	$message .= "Votre Sujet<br/>";
	if (empty ($_POST['mess'])) 
	$message .= "Votre message<br/>";
	 
	// si un champ est vide, on affiche le message d'erreur et on stoppe le script
	if (strlen ($message) > strlen ($msg_erreur)) {
	   echo  $message; die ();
	}
	 
	// sinon c'est ok => on continue
	foreach($_POST as $index => $valeur) {
	  $$index = stripslashes (trim ($valeur));
	}
	
	//Préparation de l'entête du mail:
	$mail_entete  = "MIME-Version: 1.0\r\n";
	$mail_entete .= "From: GrindHouse Leather"
				 ."<grindhouseleather.noreply@ghl.com>\r\n";
	/*$mail_entete .= 'Reply-To: '.$_POST['email']."\r\n";*/
	$mail_entete .= 'Content-Type: text/plain; charset="UTF-8"';
	$mail_entete .= "\r\nContent-Transfer-Encoding: 8bit\r\n";
	$mail_entete .= 'X-Mailer:PHP/' . phpversion ()."\r\n";
	 
	// préparation du corps du mail

	$mail_corps = "GrindHouse Leather - Bonjour \n";
	$mail_corps .= " - Sujet : $sujet\n";
	$mail_corps .= " - Message : $mess\n";

		// envoi du mail
	if (mail (MAIL_DESTINATAIRE,MAIL_SUJET,$mail_corps,$mail_entete)) {
	  //Le mail est bien expédié
	  echo  $msg_ok;
	} else {
	  //Le mail n'a pas été expédié
	  echo  "Une erreur est survenue lors de l'envoi du formulaire par email";
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