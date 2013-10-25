<?php

require '../include/header.php';

if (isset($_GET['id'])) {
    $req = $bdd->prepare('SELECT ID_produit FROM produits WHERE ID_produit=:id');
    $req->execute(array('id' => $_GET['id']));
    $req->fetchAll(PDO::FETCH_OBJ);
    var_dump($req);
    if (empty($req)) {
        die('Ce produit n\'existe pas');
    }
    $panier->add($req[0]->id);
    die('le produit a bien été ajouté à votre panier');
} else {
    die('vous n\'avez pas sélectionné de produit à ajouter au panier');
}
?>
