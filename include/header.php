<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>GrindHouse Leather - Accueil</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/bootstrap-responsive.css">
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/bootstrap.js" type="text/javascript"></script>
    </head>
    <body>

        <header>
            <section id="nameSite"><a href="index.php">GrindHouse Leather</a></section>
            <section id="menu">
                <ul>
                    <li><i class="icon-user"></i> <a href="moncompte.php">Mon Compte</a></li>
                    <li><i class="icon-th-list"></i> <a href="catalogues.php">Catalogues</a></li>
                    <li><i class="icon-tags"></i> <a href="nouveautes.php">Nouveautés</a></li>
                    <li><i class="icon-envelope"></i> <a href="#formContact" role="button" data-toggle="modal">Contactez-nous</a></li>
                </ul>
            </section>
            <?php if (!isset($_SESSION['login'])) { ?>
                <section id="login">
                    <form action="php/login.php" method="post">
                        <label for="login">Login</label>
                        <input name="login" type="text" class="login" id="login"/>
                        <label for="psw">Mot de passe</label>
                        <input name="psw" type="password" class="login" id="psw"/>
                        <input name="connexion" type="submit" class="login" id="se_connecter"/>
                    </form>
                    <a href="./moncompte.php">Pas encore inscrit?</a>
                <?php } else { ?>
                    <a href="../php/deconnexion.php">Deconnexion</a>
                    <?php
                }
                ?>
            </section>
            <section id="panier">
                <section id="imgPanier"></section>
                <a href="">Mon Panier</a>
            </section>
        </header>