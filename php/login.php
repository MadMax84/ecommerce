<?php

include_once './../include/functions.php';
include_once './client.php';

if (isset($_POST["connexion"])) {
    $pseudo = htmlspecialchars($_POST["login"]);
    $psw = htmlspecialchars($_POST["psw"]);

    if (verifConnexion($bdd, $pseudo, sha1($psw))) {
        session_start();
        $_SESSION['login'] = $pseudo;
        header("Location: ../moncompte.php?succes=true");
    }
    else
        header("Location: ../index.php?succes=false");
}
?>
