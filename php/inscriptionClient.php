<?php
include_once ("./connectionBDD/connection.php");
include_once ("./client.php");

if(isset($_POST["bouton_envoi"]))
{
    $pseudo =  htmlspecialchars($_POST["pseudo"]);
    $email = htmlspecialchars($_POST["email"]);
    $psw = htmlspecialchars($_POST["psw"]);
    $v_psw = htmlspecialchars($_POST["v_psw"]);
    /*
    if(!verifCorresMotDePasse($psw, $v_psw)){
        
    }*/
    
    enregistrerClient($bdd, $pseudo, sha1($psw), $email);
    header("Location: ../index.php?succes=true");
}
?>
