<?php

class panier {

    public function constructeur() {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = array();
        }
    }

    public function add($idProduit) {
        if (isset($_SESSION['panier'][$idProduit])) {
            $_SESSION['panier'][$idProduit]++;
        } else {
            $_SESSION['panier'][$idProduit] = 1;
        }
    }
    
    public function delete($idProduit){
        unset($_SESSION['panier'][$idProduit]);
    }

}

?>
