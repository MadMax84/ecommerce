<?php require "include/header.php"; ?>
<?php require "include/functions.php";?>

<div id="conteneur">
    <div id="contain">
    	<?php if (!isset($_SESSION['login'])) { ?>
            <form action="php/inscriptionClient.php" method="post">
            	<table id="inscriptionForm">
                	<thead>
                    	<tr><th colspan="2"><h3>Inscription GrindHouse Leather</h3></th></tr>
                    	<tr><th colspan="2" class="greyright">Informations générales : </th></tr>
                    </thead>
                    <tbody>
                    	<tr><td width="40%"><label for="pseudo">Pseudo</label></td><td><input name="pseudo" type="text" class="formulaire_inscription" id="login" required/></td></tr>
                        <tr><td><label for="email">E-mail</label></td><td><input name="email" type="email" class="formulaire_inscription" id="email" required/></td></tr>
                        <tr><td><label for="psw">Mot de passe</label></td><td><input name="psw" type="password" class="formulaire_inscription" id="psw" required/></td></tr>
                        <tr><td><label for="v_psw">Confirmation du mot de passe</label></td><td><input name="v_psw" type="password" class="formulaire_inscription" id="v_psw" required/></td></tr>
                        <tr><td><label for="nom">Nom</label></td><td><input name="nom" type="text" class="formulaire_inscription" id="nom" required/></td></tr>
                        <tr><td><label for="prenom">Prenom</label></td><td><input name="prenom" type="text" class="formulaire_inscription" id="prenom" required/></td></tr>
                        <tr><td><label for="naissance">Date de naissance</label></td><td><input name="naissance" type="date" class="formulaire_inscription" id="naissance" required/></td></tr>
                        <tr><td><label for="sexe">Civilité</label></td><td><input name="sexe" type="radio" value="Mr" id="sexe"/> Mr
                    												   <input name="sexe" type="radio" value="Mlle"/> Mlle
                                                                       <input name="sexe" type="radio" value="Mme"/> Mme</td></tr>
                        <tr><td><label for="tel">Téléphone</label></td><td><input name="tel" type="tel" class="formulaire_inscription" id="tel" required/></td></tr>
                        <tr><td><label for="pays">Pays</label></td><td><input name="pays" type="text" class="formulaire_inscription" id="pays" required/></td></tr>
                    </tbody>
                	<thead>
                    	<th colspan="2" class="greyright">Adresse de facturation :</th>
                    </thead>
                    <tbody>
                    	<tr><td><label for="num_rue">Numéro de rue</label></td><td><input name="num_rue" type="text" class="formulaire_inscription" id="num_rue"/></td></tr>
                        <tr><td><label for="adresse">Adresse</label></td><td><input name="adresse" type="text" class="formulaire_inscription" id="adresse" required/></td></tr>
                        <tr><td><label for="cp">Code postal</label></td><td><input name="cp" type="text" class="formulaire_inscription" id="cp" required/></td></tr>
                        <tr><td><label for="ville">Ville</label></td><td><input name="ville" type="text" class="formulaire_inscription" id="ville" required/></td></tr>
                    </tbody>
                	<thead>
                    	<th colspan="2" class="greyright">Adresse de livraison :</th>
                    </thead>
                    <tbody>
                    	<tr><td><label for="num_rue_liv">Numéro de rue</label></td><td><input name="num_rue_liv" type="text" class="formulaire_inscription" id="num_rue_liv"/></td></tr>
                        <tr><td><label for="adresse_liv">Adresse</label></td><td><input name="adresse_liv" type="text" class="formulaire_inscription" id="adresse_liv" required/></td></tr>
                        <tr><td><label for="cp_liv">Code postal</label></td><td><input name="cp_liv" type="text" class="formulaire_inscription" id="cp_liv" required/></td></tr>
                        <tr><td><label for="ville_liv">Ville</label></td><td><input name="ville_liv" type="text" class="formulaire_inscription" id="ville_liv" required/></td></tr>
                    </tbody>
					<tfoot>
                    	<th class="greyright" colspan="2"><input name="bouton_envoi" type="submit" class="btn-compte" id="se_connecter"/></th>
                    </tfoot>
                </table>
            </form>
        <?php
        } else {
            echo '<section id="espace_membre">
                Bienvenue! ' . $_SESSION['login'] . '
            </section>';
        }
        ?>
    </div>
</div>

<?php require "include/footer.php"; ?>
<?php require "include/formContact.php";?>