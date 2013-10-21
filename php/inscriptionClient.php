<?php

include_once ("./connectionBDD/connection.php");
include_once ("./client.php");

if (isset($_POST["bouton_envoi"])) {
    $pseudo = htmlspecialchars($_POST["pseudo"]);
    $email = htmlspecialchars($_POST["email"]);
    $psw = htmlspecialchars($_POST["psw"]);
    $v_psw = htmlspecialchars($_POST["v_psw"]);
    $bon = true;

    if (!verifCorresMotDePasse($psw, $v_psw)) {
        echo "<p>- Les mots de passe doivent être identiques. </p>";
        $bon = false;
    }
    if (!verifUnicitePseudo($bdd, $pseudo)) {
        echo "<p>- Le pseudo choisit est déjà prit.</p>";
        $bon = false;
    }
    if (!$bon) {
        header("Location: ../index.php?succes=false");
    } else {
        enregistrerClient($bdd, $pseudo, sha1($psw), $email);
        header("Location: ../index.php?succes=true");
    }
}
?>
