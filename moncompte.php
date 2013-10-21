<?php require "include/functions.php"; ?>
<?php require "include/header.php"; ?>

<section id="conteneur">
    <section id="contain">
        <section id="newclient">
            <form action="php/inscriptionClient.php" method="post">
                <label for="pseudo">Pseudo</label>
                <input name="pseudo" type="text" class="formulaire_connexion" id="login"/>
                <label for="email">E-mail</label>
                <input name="email" type="email" class="formulaire_connexion" id="email"/>
                <label for="psw">Mot de passe</label>
                <input name="psw" type="password" class="formulaire_connexion" id="psw"/>
                <label for="v_psw">Confirmation du mot de passe</label>
                <input name="v_psw" type="password" class="formulaire_connexion" id="v_psw"/>
                <label for="prenom">Prenom</label>
                <input name="prenom" type="text" class="formulaire_connexion" id="prenom"/>
                <label for="nom">Nom</label>
                <input name="nom" type="text" class="formulaire_connexion" id="nom"/>
                <input name="bouton_envoi" type="submit" class="formulaire_connexion" id="se_connecter"/>
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
    </section>
</section>

<?php require "include/footer.php"; ?>
<?php require "include/formContact.php"; ?>