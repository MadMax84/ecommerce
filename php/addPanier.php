<?php

require '../include/_header.php';


if (isset($_GET['id'])) {
    $produit = $req->requete('SELECT ID_produit FROM produits WHERE ID_produit=:id', array('id' => $_GET['id']));
    var_dump($produit);

    if (empty($req)) {
        die('Ce produit n\'existe pas');
    }
    $panier->add($req[0]->id);
    die('le produit a bien été ajouté à votre panier');
} else {
    die('vous n\'avez pas sélectionné de produit à ajouter au panier');
}
?>
