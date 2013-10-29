<?php require "include/header.php"; ?>
<?php require "include/functions.php";?>

<div id="conteneur">
    <div id="contain">
    	<?php if (!isset($_SESSION['login'])) { ?>
        <table class="table">
        	<tr><td colspan="2"><b>IDENTIFIEZ-VOUS OU CREEZ UN COMPTE</b></td></tr>
            <tr><td width="50%"><b>CREER UN COMPTE CLIENT</b></td><td><b>ACCEDER A SON COMPTE</b></td></tr>
            <tr>
            	<td>En créant un compte sur notre boutique, vous pouvez passer vos commandes plus rapidement, enregistrer votre adresse de facturation et de livraison, consulter et suivre vos commandes, et plein d'autres choses encore.</td>
				<td>Si vous avez déjà un compte, veuillez vous identifier.</td>
            </tr>
            <tr>
            	<td></td>
                <td class="center">
                    <form action="php/login.php" method="post">
                        <label for="login">Pseudonyme :</label><input name="login" type="text" id="login"/>
                        <label for="psw">Mot de passe :</label><input name="psw" type="password" id="psw"/>
            	</td>
            </tr>
            <tfoot class="greyright">
            	<th><a href="inscription.php"><input type="button" class="btn-compte" value="Pas encore inscrit ?"/></a></th>
                <th><input name="connexion" type="submit" class="btn-compte" id="se_connecter" value="Se connecter"/></th>
            </tfoot>
            		</form>
        </table>
        <?php
        } else {
            echo '<div id="espace_membre"><h4>Bienvenue '.$_SESSION['login'].' !</h4></div>';
			echo '<div id="gestion_membre">
					<table class="table center">
						<thead>
							<tr class="grey"><th>Mes informations</th><th>Mes commandes</th></tr>
						</thead>
						<tbody>
							<tr>
								<td width="50%"><a href="modifinfo.php"><input type="button" class="btn-compte" value="Modifier mes informations"/></a></td>
								<td><a href=""><input type="button" class="btn-compte" value="Voir et valider mes commandes"/></a></td>
							</tr>
						</tbody>
					</table>
				  </div>';
        }
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