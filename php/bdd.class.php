<?php

/**
 * Description of bdd
 *
 * @author Lionel
 */
class bdd {

    private $hote = 'localhost';
    private $user = 'root';
    private $password = '';
    private $nom = 'grindhouse';
    private $bdd;

    public function constructeur($hote = null, $user = null, $password = null, $nom = null) {
        if ($hote != null) {
            $this->hote = $hote;
            $this->user = $user;
            $this->password = $password;
            $this->nom = $nom;
        }
        try {
            $this->bdd = new PDO('mysql:host=' . $this->hote . ';dbname=' . $this->nom, $this->user, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8', PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        } catch (PDOException $e) {
            die('erreur :' . $e->getMessage());
        }
    }

    public function requete($sql, $data = array()) {
        $req = $this->bdd->prepare($sql);
        $req = execute($data);
        return $req->fetchAll(PDO::FETCH_OBJ);
    }

}

?>
