<?php
include_once './connectionBDD/connection.php';
include_once './client.php';

if(isset($_POST["connexion"])){
    $pseudo = htmlspecialchars($_POST["login"]);
    $mdp = htmlspecialchars($_POST["pass"]);
    echo("$pseudo, $mdp " . sha1($mdp) . "!");
    
    if(verifConnexion($bdd, $pseudo, sha1($mdp))){
        session_start();
        $_SESSION["login"] = $pseudo;
        echo "congrat vous êtes connecté!";
    }
    else
        echo "vous vous etes planté";
}
?>
