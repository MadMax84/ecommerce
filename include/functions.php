<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=grindhouse', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'));
} catch (Exception $e) {
    die('erreur :' . $e->getMessage());
}

function requete($sql, $data = array()){
    $req = $bdd->prepare($sql);
    $req=execute($data);
    return $req->fetchAll(PDO::FETCH_OBJ);
}
?>