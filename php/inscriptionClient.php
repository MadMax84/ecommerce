<?php

include_once '../include/functions.php';
include_once 'client.php';

if (isset($_POST["bouton_envoi"])) {
    $pseudo = htmlspecialchars($_POST["pseudo"]);
    $email = htmlspecialchars($_POST["email"]);
    $psw = htmlspecialchars($_POST["psw"]);
    $v_psw = htmlspecialchars($_POST["v_psw"]);
    $bon = true;
    $erreur = "<div class=err_enregistrement>";

    if (!verifCorresMotDePasse($psw, $v_psw)) {
        $erreur.="<p>- Les mots de passe doivent être identiques. </p>";
        $bon = false;
    }
    if (!verifUnicitePseudo($bdd, $pseudo)) {
        $erreur.="<p>- Le pseudo choisit est déjà prit.</p>";
        $bon = false;
    }
    if (!$bon) {
        $erreur.="</div>";
        header("Location: ../moncompte.php?succes=$erreur");
    } else {
        enregistrerClient($bdd, $pseudo, sha1($psw), $email);
        header("Location: ../index.php?succes=true");
    }
} else {
    header("Location: ../index.php");
}
?>
