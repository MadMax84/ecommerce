<?php

header('Content-Type: text/html; charset=utf-8');
session_start();
include_once ("./php/connectionBDD/connection.php");
?>

<div class="form_inscription">
    <h1>Formulaire d'inscription</h1>
    <form action='./php/inscriptionClient.php' method='post'>
        <label for="pseudo">Pseudo</label>
            <input name="pseudo" type="text" class="formulaire_connexion" id="login"/><br />
        <label for="email">E-mail</label>
            <input name="email" type="email" class="formulaire_connexion" id="email"/><br />
        <label for="psw">Mot de passe</label>
            <input name="psw" type="password" class="formulaire_connexion" id="psw"/><br />
        <label for="v_psw">Confirmation du mot de passe</label>
            <input name="v_psw" type="password" class="formulaire_connexion" id="v_psw"/><br />
        <label for="nom">Prenom</label>
            <input name="prenom" type="text" class="formulaire_connexion" id="prenom"/><br />
        <label for="nom">Nom</label>
            <input name="nom" type="text" class="formulaire_connexion" id="nom"/><br />
            <input id="se_connecter" name="bouton_envoi" type="submit" class="formulaire_connexion"/><br />
    </form>
</div>
