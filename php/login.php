<?php

include_once './../include/functions.php';
include_once './client.php';

if (isset($_POST["connexion"])) {
    $pseudo = htmlspecialchars($_POST["login"]);
    $psw = htmlspecialchars($_POST["psw"]);
    //echo("$pseudo, $psw " . sha1($psw) . "!");

    if (verifConnexion($bdd, $pseudo, sha1($psw))) {
        session_start();
        $_SESSION["login"] = $pseudo;
        header("Location: ../index.php?succes=true");
        echo 'Bienvenue ' . $pseudo;
    }
    else
        header("Location: ../index.php?succes=false");
        echo "Identifiant inconnu ou mauvais mot de passe";
}
?>
