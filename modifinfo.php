<?php require "include/header.php"; ?>
<?php require "include/functions.php";?>

<div id="conteneur">
    <div id="contain">
    	<?php 
			if (!isset($_SESSION['login'])) { 
				echo '';
		 	} 
			else {
            echo '<div id="espace_membre"><h4>Bienvenue '.$_SESSION['login'].' !</h4></div>';
			$clients = $bdd->query('SELECT * FROM clients WHERE pseudo = "'.$_SESSION['login'].'"');
			foreach($clients as $client);
			?>
                <form action="" method="post">
                    <table id="inscriptionForm">
                        <thead>
                            <tr><th colspan="2"><h3>Modification de vos informations personnelles</h3></th></tr>
                            <tr><th colspan="2" class="greyright">Informations générales : </th></tr>
                        </thead>
                        <tbody>
                            <tr><td width="40%"><label for="pseudo">Pseudo</label></td><td><input name="pseudo" type="text" id="login" value="<?php echo $client['pseudo'];?>" required/></td></tr>
                            <tr><td><label for="email">E-mail</label></td><td><input name="email" type="email" id="email" value="<?php echo $client['email'];?>" required/></td></tr>
                            <tr><td><label for="psw">Mot de passe</label></td><td><input name="psw" type="password" id="psw" required/></td></tr>
                            <tr><td><label for="v_psw">Confirmation du mot de passe</label></td><td><input name="v_psw" type="password" id="v_psw" required/></td></tr>
                            <tr><td><label for="nom">Nom</label></td><td><input name="nom" type="text" id="nom" value="<?php echo $client['nom'];?>" required/></td></tr>
                            <tr><td><label for="prenom">Prenom</label></td><td><input name="prenom" type="text" id="prenom" value="<?php echo $client['prenom'];?>" required/></td></tr>
                            <tr><td><label for="naissance">Date de naissance</label></td><td><input name="naissance" type="text" id="naissance" placeholder="jj/mm/aaaa"value="<?php echo $client['date_naissance'];?>" required/></td></tr>
                            <tr>
                            	<td><label for="sexe">Civilité</label></td>
                            	<td>
                                	<?php
										if($client['civilite'] == "Mr") {
											echo '<input name="sexe" type="radio" value="Mr" id="sexe" checked="checked"/> Mr
                                    			  <input name="sexe" type="radio" value="Mlle"/> Mlle
                                   				  <input name="sexe" type="radio" value="Mme"/> Mme';
										}
										if($client['civilite'] == "Mlle") {
											echo '<input name="sexe" type="radio" value="Mr" id="sexe"/> Mr
                                    			  <input name="sexe" type="radio" value="Mlle" checked="checked"/> Mlle
                                   				  <input name="sexe" type="radio" value="Mme"/> Mme';
										}
										if($client['civilite'] == "Mme") {
											echo '<input name="sexe" type="radio" value="Mr" id="sexe"/> Mr
                                    			  <input name="sexe" type="radio" value="Mlle"/> Mlle
                                   				  <input name="sexe" type="radio" value="Mme" checked="checked"/> Mme';
										}
									?>
                                </td>
                            </tr>
                            <tr><td><label for="tel">Téléphone</label></td><td><input name="tel" type="tel" id="tel" value="<?php echo $client['telephone'];?>" required/></td></tr>
                            <tr><td><label for="pays">Pays</label></td><td><input name="pays" type="text" id="pays" value="<?php echo $client['pays'];?>" required/></td></tr>
                        </tbody>
                        <thead>
                            <th colspan="2" class="greyright">Adresse de facturation :</th>
                        </thead>
                        <tbody>
                            <tr><td><label for="num_rue">Numéro de rue</label></td><td><input name="num_rue" type="text" id="num_rue" value="<?php echo $client['num_facturation'];?>" required/></td></tr>
                            <tr><td><label for="adresse">Adresse</label></td><td><input name="adresse" type="text" id="adresse" value="<?php echo $client['adresse_facturation'];?>" required/></td></tr>
                            <tr><td><label for="cp">Code postal</label></td><td><input name="cp" type="text" id="cp" value="<?php echo $client['cp_facturation'];?>" required/></td></tr>
                            <tr><td><label for="ville">Ville</label></td><td><input name="ville" type="text" id="ville" value="<?php echo $client['ville_facturation'];?>" required/></td></tr>
                        </tbody>
                        <thead>
                            <th colspan="2" class="greyright">Adresse de livraison :</th>
                        </thead>
                        <tbody>
                            <tr><td><label for="num_rue_liv">Numéro de rue</label></td><td><input name="num_rue_liv" type="text" id="num_rue_liv" value="<?php echo $client['num_livraison'];?>" required/></td></tr>
                            <tr><td><label for="adresse_liv">Adresse</label></td><td><input name="adresse_liv" type="text" id="adresse_liv" value="<?php echo $client['adresse_livraison'];?>" required/></td></tr>
                            <tr><td><label for="cp_liv">Code postal</label></td><td><input name="cp_liv" type="text" id="cp_liv" value="<?php echo $client['cp_livraison'];?>" required/></td></tr>
                            <tr><td><label for="ville_liv">Ville</label></td><td><input name="ville_liv" type="text" id="ville_liv" value="<?php echo $client['ville_livraison'];?>" required/></td></tr>
                        </tbody>
                        <tfoot>
                            <th class="greyright" colspan="2"><input name="bouton_envoi" type="submit" class="btn-compte" id="se_connecter"/></th>
                        </tfoot>
                    </table>
                </form>
        <?php
        }
        ?>
        
        <?php
/*			if(isset($_POST['pseudo']) && isset($_POST['email'])) && isset($_POST['psw'])) && isset($_POST['nom'])) && isset($_POST['prenom'])) && isset($_POST['naissance'])) && isset($_POST['sexe'])) && isset($_POST['tel'])) && isset($_POST['pays'])) && isset($_POST['num_rue'])) && isset($_POST['adresse'])) && isset($_POST['cp'])) && isset($_POST['ville'])) && isset($_POST['pseudo'])) && isset($_POST['pseudo'])) && isset($_POST['pseudo'])) && isset($_POST['pseudo'])) {
			
			}*/
		?>
        
        <?php
			if(isset($_GET['success'])) {
				if($_GET['success'] == "false") {
					echo '<div class="alert alert-error">Erreur lors de la connexion. Merci de vérifier votre Pseudonyme ou votre Mot de Passe.</div>';
				}
			}
		?>
    </div>
</div>

<?php require "include/footer.php"; ?>
<?php require "include/formContact.php";?>