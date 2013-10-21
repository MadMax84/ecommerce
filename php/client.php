<?php

/**
 * Verifie la correspondance entre les 2 mots de passe
 * @param type $psw 1er mot de passe
 * @param type $v_psw 2eme mot de passe
 * @return boolean true si vrai false sinon
 */
function verifCorresMotDePasse($psw, $v_psw) {
    if ($psw == $v_psw)
        return true;
    return false;
}

/**
 * Vérifie que le pseudo n'est pas déjà utilisé
 * @param type $bdd base de données
 * @param type $pseudo pseudo du client
 */
function verifUnicitePseudo($bdd, $pseudo) {
    try {
        echo $pseudo;
        $Req = $bdd->prepare("SELECT pseudo FROM clients WHERE pseudo LIKE ?");
        $Req->execute(array($pseudo));
    } catch (Exception $e) { //interception de l'erreur
        die('<div style="font-weight:bold; color:red">Erreur : ' . $e->getMessage() . '</div>');
    }
    if ($Req->rowCount() == 0) {
        $var = true;
    } elseif ($Req->rowCount() == 1) {
        while ($res = $Req->fetch(PDO::FETCH_NUM)) {
            $_id = $res[0];
            if ($_id == $id) {
                $var = true;
            }
            else
                $var = false;
        }
    }
    else {
        $var = false;
    }

    return $var;
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
        $Req = $bdd->prepare("INSERT INTO clients (ID_client,pseudo,password,email) VALUES('',?,?,?)");
        $Req->execute(array($pseudo, $psw, $email));
    } catch (Exception $e) { //interception de l'erreur
        die('<div style="font-weight:bold; color:red">Erreur : ' . $e->getMessage() . '</div>');
    }
}

/**
 * Vérifie que la correspondance pseudo/mot de passe
 * @param type $bdd base de données
 * @param type $pseudo pseudo du client
 * @param type $psw mot de passe du client
 * @return type 
 */
function verifConnexion($bdd, $pseudo, $psw) {
    try {
        $Req = $bdd->prepare("SELECT * FROM clients WHERE pseudo LIKE ? AND password LIKE ?");
        $Req->execute(array($pseudo, $psw));
    } catch (Exception $e) {
        die('<div style="font-weight:bold; color:red">Erreur : ' . $e->getMessage() . '</div>');
    }
    $var = $Req->rowCount() == 1 ? true : false;
    return $var;
}

?>
