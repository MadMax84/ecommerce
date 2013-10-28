<?php

require '../include/functions.php';
require '../include/_header.php';

if (isset($_GET['id_produit'])) {
    $req = $bdd->prepare('SELECT ID_produit FROM produits WHERE ID_produit=:id', array('id' => $_GET['id_produit']));
    $req->execute(array('id' => $_GET['id_produit']));
    $produit = $req->fetchAll(PDO::FETCH_OBJ);
    var_dump($produit);

    if (empty($produit)) {
        die('Ce produit n\'existe pas');
    }
    $panier->add($produit[0]->ID_produit);
    die('le produit a bien ete ajoute a votre panier, <a href = "../catalogues.php">retourner sur le catalogue</a>');
} else {
    die('vous n\'avez pas selectionne de produit a ajouter au panier');
}
?>
