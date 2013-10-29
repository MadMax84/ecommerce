<?php
require 'functions.php';

session_start();
if (isset($_GET['deco'])) {
    session_destroy();
    header('Location: ./index.php');
}
?><!DOCTYPE html>
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

                    <?php
                    if (!isset($_SESSION['login']) || $_SESSION['login'] == '') {
                        echo '';
                    } else {
                        echo '<li><i class="icon-off"></i> <a href="?deco">Se déconnecter</a></li>';
                    }
                    ?>
                </ul>
            </section>
            <section id="panier" class="hidden-phone">
                <section id="imgPanier"></section>
                <a href="panier.php">Mon Panier</a>
            </section>
        </header>