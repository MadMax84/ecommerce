<?php

function verifCorresMotDePasse($psw, $v_psw){
    if($psw == $v_psw)
        return true;
    return false;
}

/**
 * Enregistre le membre dans la base de données
 * @param type $bdd base de données
 * @param type $pseudo pseudo du client
 * @param type $psw mot de passe du client 
 * @param type $email email du client
 */
function enregistrerClient($bdd, $pseudo, $psw, $email) {
    try {
        $Req = $bdd->prepare("INSERT INTO client (idClient,pseudo,mdp,mail) VALUES('',?,?,?)");
        $Req->execute(array($pseudo, $psw, $email));
    } catch (Exception $e) { //interception de l'erreur
        die('<div style="font-weight:bold; color:red">Erreur : ' . $e->getMessage() . '</div>');
    }
}

?>