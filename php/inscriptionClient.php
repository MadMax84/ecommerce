<?php

include_once '../include/functions.php';
include_once 'client.php';

if (isset($_POST["bouton_envoi"])) {
    $pseudo = htmlspecialchars($_POST["pseudo"]);
    $email = htmlspecialchars($_POST["email"]);
    $psw = htmlspecialchars($_POST["psw"]);
    $v_psw = htmlspecialchars($_POST["v_psw"]);
    $prenom = htmlspecialchars($_POST["prenom"]);
    $nom = htmlspecialchars($_POST["nom"]);
    $date = htmlspecialchars($_POST["naissance"]);
    $sexe = htmlspecialchars($_POST["sexe"]);
    $tel = htmlspecialchars($_POST["tel"]);
    $num_rue = htmlspecialchars($_POST["num_rue"]);
    $adresse = htmlspecialchars($_POST["adresse"]);
    $cp = htmlspecialchars($_POST["cp"]);
    $ville = htmlspecialchars($_POST["ville"]);
    $num_rue_liv = htmlspecialchars($_POST["num_rue_liv"]);
    $adresse_liv = htmlspecialchars($_POST["adresse_liv"]);
    $cp_liv = htmlspecialchars($_POST["cp_liv"]);
    $ville_liv = htmlspecialchars($_POST["ville_liv"]);
    $pays = htmlspecialchars($_POST["pays"]);
        
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
    if (!verifTel($tel)) {
        $erreur.="<p>- Le numéro de téléphone n'est pas correct.</p>";
        $bon = false;
    }
    if (!verifAdresse($adresse)) {
        $erreur.="<p>- L'adresse n'est pas correcte.</p>";
        $bon = false;
    }
    if (!verifCP($cp)) {
        $erreur.="<p>- Le code postal n'est pas correcte.</p>";
        $bon = false;
    }
    if (!verifAdresse($ville)) {
        $erreur.="<p>- La ville n'est pas correcte.</p>";
        $bon = false;
    }
    if (!verifAdresse($adresse_liv)) {
        $erreur.="<p>- L'adresse n'est pas correcte.</p>";
        $bon = false;
    }
    if (!verifCP($cp_liv)) {
        $erreur.="<p>- La ville n'est pas correcte.</p>";
        $bon = false;
    }
    if (!verifAdresse($ville_liv)) {
        $erreur.="<p>- La ville n'est pas correcte.</p>";
        $bon = false;
    }
    if (!verifAdresse($pays)) {
        $erreur.="<p>- L'adresse n'est pas correcte.</p>";
        $bon = false;
    }
    if (!$bon) {
        $erreur.="</div>";
        header("Location: ../moncompte.php?succes=$erreur");
    } else {
        enregistrerClient($bdd, $pseudo, md5($psw), $email, $nom, $prenom, $date, $sexe, $tel,
                          $num_rue, $adresse, $cp, $ville, 
                          $num_rue_liv, $adresse_liv, $cp_liv, $ville_liv, $pays);
        header("Location: ../index.php?succes=true");
    }
} else {
    header("Location: ../index.php");
}
?>
