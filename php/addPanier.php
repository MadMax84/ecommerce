<?php
require '../include/functions.php';
require './panier.php';

if(isset($_GET['id'])){
    $req = $bdd->prepare('SELECT ID_produit FROM produits WHERE ID_produit=:id');
    $req->execute(array('id' => $_GET['id']));
    $req->fetchAll(PDO::FETCH_OBJ);
    var_dump($req);
    if(empty($req)){
        die('Ce produit n\'existe pas');
    }
} else {
    die('vous n\'avez pas sélectionné de produit à ajouter au panier');
}

?>
