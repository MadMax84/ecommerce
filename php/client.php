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

function verifTel($tel) {
    $bon = true;
    if (preg_match("#^[0-9]{10}$#", $tel)) {
        $bon = TRUE;
    }
    return $bon;
}

function verifCP($cp) {
    $bon = true;
    if (preg_match("#^[0-9]{5}$#", $cp)) {
        $bon = TRUE;
    }
    return $bon;
}

function verifAdresse($adresse) {
    $bon = true;
    if (preg_match("#^[A-Za-z]{1,}$#", $adresse)) {
        $bon = TRUE;
    }
    return $bon;
}

/**
 * Enregistre le membre dans la base de données
 * @param type $bdd base de données
 * @param type $pseudo pseudo du client
 * @param type $psw mot de passe du client 
 * @param type $email email du client
 */
function enregistrerClient($bdd, $pseudo, $psw, $email, $nom, $prenom, $date, $sexe, $tel, $num_rue, $adresse, $cp, $ville, $num_rue_liv, $adresse_liv, $cp_liv, $ville_liv, $pays) {
    try {
        $Req = $bdd->prepare("INSERT INTO clients (ID_client,pseudo,password,email,nom,prenom,date_naissance,civilite,telephone,
                                                   num_facturation,adresse_facturation,cp_facturation,ville_facturation,
                                                   num_livraison,adresse_livraison,cp_livraison,ville_livraison,pays) 
                              VALUES('',?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $Req->execute(array($pseudo, $psw, $email, $nom, $prenom, $date, $sexe, $tel,
            $num_rue, $adresse, $cp, $ville,
            $num_rue_liv, $adresse_liv, $cp_liv, $ville_liv, $pays));
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

function verifConnexionAdmin($bdd, $pseudo, $psw) {
    try {
        $Req = $bdd->prepare("SELECT * FROM admin WHERE login LIKE ? AND password LIKE ?");
        $Req->execute(array($pseudo, $psw));
    } catch (Exception $e) {
        die('<div style="font-weight:bold; color:red">Erreur : ' . $e->getMessage() . '</div>');
    }
    $var = $Req->rowCount() == 1 ? true : false;
    return $var;
}

?>
