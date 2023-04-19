<?php
require_once 'Plat.class.php';
class PlatBD extends Plat
{

    private $_db; //recevra $cnx de l'index
    private $_array = array(); //retourner le resultset

    public function __construct($cnx)
    {
        $this->_db = $cnx;
    }

    public function getAllPlats(){
        try{
            $query = "select * from plat";
            $res = $this->_db->prepare($query);
            $res->execute();
            while($data = $res->fetch()){
                $_array[] = new Plat($data);
            }
            if(empty($_array)){
                return null;
            }
            else{
                return $_array;
            }


        }catch(PDOException $e){
            print "Echec requête : ".$e->getMessage();
        }


    }
    public function getPlatById($id){
        try{
            $query="select * from plat where id_plat = :id";
            $res = $this->_db->prepare($query);
            $res->bindValue(':id',$id);
            $res->execute();
            $data = $res->fetch();
            return $data;
        }catch(PDOException $e){
            print "Echec ".$e->getMessage();
        }
    }
    public function getIngredientById($id){
        try{
            $query="select nom_ingredient from platId_ingredient where id_plat = :id";
            $res = $this->_db->prepare($query);
            $res->bindValue(':id',$id);
            $res->execute();
            while($data = $res->fetch()){
                $_array[] = new Ingredient($data);
            }
            if(empty($_array)){
                return null;
            }
            else{
                return $_array;
            }
        }catch(PDOException $e){
            print "Echec ".$e->getMessage();
        }
    }
    // Fonction pour ajouter un plat au panier
    function ajouterPlatAuPanier($plat) {
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = array();
        }

        $_SESSION['panier'][] = $plat;
    }

// Fonction pour retirer un plat du panier
    function retirerPlatDuPanier($id_plat) {
        if (isset($_SESSION['panier'])) {
            for ($i = 0; $i < count($_SESSION['panier']); $i++) {
                if ($_SESSION['panier'][$i]->id_plat == $id_plat) {
                    unset($_SESSION['panier'][$i]);
                    $_SESSION['panier'] = array_values($_SESSION['panier']);
                    break;
                }
            }
        }
    }

// Fonction pour vider le panier
    function viderPanier() {
        if (isset($_SESSION['panier'])) {
            unset($_SESSION['panier']);
        }
    }

// Fonction pour calculer le total du panier
    function getTotalPanier() {
        $total = 0;
        if (isset($_SESSION['panier'])) {
            foreach ($_SESSION['panier'] as $plat) {
                $total += $plat->prix;
            }
        }
        return $total;
    }

}


