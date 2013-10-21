<?php
include_once './connectionBDD/connection.php';
include_once './client.php';

if(isset($_POST["connexion"])){
    $pseudo = htmlspecialchars($_POST["login"]);
    $psw = htmlspecialchars($_POST["psw"]);
    //echo("$pseudo, $psw " . sha1($psw) . "!");
    
    if(verifConnexion($bdd, $pseudo, sha1($psw))){
        session_start();
        $_SESSION["login"] = $pseudo;
        echo "congrat vous etes connecte!";
    }
    else
        echo "vous vous etes plante";
}
?>
