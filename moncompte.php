<?php require "include/functions.php"; ?>
<?php require "include/header.php"; ?>

<section id="conteneur">
    <section id="contain">
        <?php if (!isset($_SESSION['login'])) { ?>
            <section id="newclient">
                <form action="php/inscriptionClient.php" method="post">
                    <label for="pseudo">Pseudo</label>
                    <input name="pseudo" type="text" class="formulaire_inscription" id="login" required/>
                    <label for="email">E-mail</label>
                    <input name="email" type="email" class="formulaire_inscription" id="email" required/>
                    <label for="psw">Mot de passe</label>
                    <input name="psw" type="password" class="formulaire_inscription" id="psw" required/>
                    <label for="v_psw">Confirmation du mot de passe</label>
                    <input name="v_psw" type="password" class="formulaire_inscription" id="v_psw" required/>
                    <label for="prenom">Prenom</label>
                    <input name="prenom" type="text" class="formulaire_inscription" id="prenom" required/>
                    <label for="nom">Nom</label>
                    <input name="nom" type="text" class="formulaire_inscription" id="nom" required/>
                    <label for="naissance">Date de naissance</label>
                    <input name="naissance" type="date" class="formulaire_inscription" id="naissance" required/>
                    <label for="sexe">Sexe</label>
                    <input name="sexe" type="radio" value="Homme" id="sexe"/> Homme
                    <input name="sexe" type="radio" value="Femme"/> Femme
                    <label for="tel">Tel</label>
                    <input name="tel" type="tel" class="formulaire_inscription" id="tel" required/>

                    <label>Adresse de facturation</label>
                    <label for="num_rue">Numéro de rue</label>
                    <input name="num_rue" type="text" class="formulaire_inscription" id="num_rue"/>
                    <label for="adresse">Adresse</label>
                    <input name="adresse" type="text" class="formulaire_inscription" id="adresse" required/>
                    <label for="cp">Code postal</label>
                    <input name="cp" type="text" class="formulaire_inscription" id="cp" required/>
                    <label for="ville">Ville</label>
                    <input name="ville" type="text" class="formulaire_inscription" id="ville" required/>

                    <label>Adresse de livraison</label>
                    <label for="num_rue_liv">Numéro de rue</label>
                    <input name="num_rue_liv" type="text" class="formulaire_inscription" id="num_rue_liv"/>
                    <label for="adresse_liv">Adresse</label>
                    <input name="adresse_liv" type="text" class="formulaire_inscription" id="adresse_liv" required/>
                    <label for="cp_liv">Code postal</label>
                    <input name="cp_liv" type="text" class="formulaire_inscription" id="cp_liv" required/>
                    <label for="ville_liv">Ville</label>
                    <input name="ville_liv" type="text" class="formulaire_inscription" id="ville_liv" required/>
                    <label for="pays">Pays</label>
                    <input name="pays" type="text" class="formulaire_inscription" id="pays" required/>
                    <input name="bouton_envoi" type="submit" class="formulaire_inscription" id="se_connecter"/>
                </form>
            </section>

            <section id="loginclient">
                <form action="php/login.php" method="post">
                    <label for="login">Login</label>
                    <input name="login" type="text" class="login" id="login"/>
                    <label for="psw">Mot de passe</label>
                    <input name="psw" type="password" class="login" id="psw"/>
                    <input name="connexion" type="submit" class="login" id="se_connecter"/>
                </form>
                <a href="./moncompte.php">Pas encore inscrit?</a>
            </section>
        <?php } else { ?>
            <section id="espace_membre">
                Bienvenue!
            </section>

            <?php
        }
        ?>
    </section>
</section>

<?php require "include/footer.php"; ?>
<?php require "include/formContact.php"; ?>