<?php

include_once '../include/functions.php';
include_once './client.php';

if (isset($_POST["connexion"])) {
    $pseudo = htmlspecialchars($_POST["login"]);
    $psw = htmlspecialchars($_POST["psw"]);

    if (verifConnexion($bdd, $pseudo, sha1($psw)) /*|| verifConnexionAdmin($bdd, $pseudo, sha1($psw))*/) {
        session_start();
        $_SESSION['id'] = $id_client;
        $_SESSION['login'] = $pseudo;
        header("Location: ../index.php?succes=true");
    }
    else
        header("Location: ../index.php?succes=false");
}
?>
