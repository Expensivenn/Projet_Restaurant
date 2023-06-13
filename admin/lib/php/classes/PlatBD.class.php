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
    public function getIngredientById($id)
    {
        try {
            $query = "select nom_ingredient from platId_ingredient where id_plat = :id";
            $res = $this->_db->prepare($query);
            $res->bindValue(':id', $id);
            $res->execute();
            while ($data = $res->fetch()) {
                $_array[] = new Ingredient($data);
            }
            if (empty($_array)) {
                return null;
            } else {
                return $_array;
            }
        } catch (PDOException $e) {
            print "Echec " . $e->getMessage();
        }
    }
    public function getIds($id){
        try {
            $query = "SELECT id_ingredient FROM compsition WHERE id_plat = :id";
            $res = $this->_db->prepare($query);
            $res->bindValue(':id', $id);
            $res->execute();
            $_array = array(); // Initialisation de l'array
            while ($data = $res->fetch()) {
                $_array[] = $data['id_ingredient']; // Ajout de chaque ID dans l'array
            }
            if (empty($_array)) {
                return null;
            } else {
                return $_array;
            }
        } catch (PDOException $e) {
            print "Echec " . $e->getMessage();
        }
    }

    public function addPlat($nom, $prix, $photo, $type)
        {
            try {
                $query = "INSERT INTO plat (nom_plat, prix, photo_plat, id_type) VALUES (:nom, :prix, :photo, :type)";
                $res = $this->_db->prepare($query);
                $res->bindParam(':nom', $nom);
                $res->bindParam(':prix', $prix);
                $res->bindParam(':photo', $photo);
                $res->bindParam(':type', $type);
                $res->execute();

                // Récupérer l'ID du plat inséré
                $platId = $this->_db->lastInsertId();

                return $platId;
            } catch (PDOException $e) {
                print "Echec " . $e->getMessage();
            }
        }
    public function updatePlat($nom, $prix, $photo, $type, $id)
    {
        try {
            $query = "UPDATE  plat SET (nom_plat, prix, photo_plat, id_type) = (:nom, :prix, :photo, :type) WHERE id_plat = :id";
            $res = $this->_db->prepare($query);
            $res->bindParam(':nom', $nom);
            $res->bindParam(':prix', $prix);
            $res->bindParam(':photo', $photo);
            $res->bindParam(':type', $type);
            $res->bindParam(':id', $id);
            $res->execute();
        } catch (PDOException $e) {
            print "Echec " . $e->getMessage();
        }
    }
        public function insertIntoComposition($values){
            $cnt = count($values);
            for ($i = 1; $i < $cnt;$i++){
                try {
                    $query = "INSERT INTO compsition (id_plat,id_ingredient) VALUES (:plat ,:ig)";
                    $res = $this->_db->prepare($query);
                    $res->bindParam(':plat', $values[0]);
                    $res->bindParam(':ig', $values[$i]);
                    $res->execute();
                } catch (PDOException $e) {
                    print "Echec " . $e->getMessage();
                }
            }
        }
    public function getPlatByNom($nom)
    {
        try {
            $query = "select * from plat where nom_plat = :nom";
            $res = $this->_db->prepare($query);
            $res->bindValue(':nom',$nom);
            $res->execute();
            $data = $res->fetchAll();
            if (!empty($data)) {
                return $data;
            } else {
                return [];
            }

        } catch (PDOException $e) {
            print "Echec de la requête " . $e->getMessage();
        }
    }
    public function deleteCompo($id){
        try {
            $query = "DELETE  FROM compsition where id_plat = :id";
            $res = $this->_db->prepare($query);
            $res->bindParam(':id',$id);
            $res->execute();
        }
        catch (PDOException $e){
            print "Echec de la requête " . $e->getMessage();
        }
    }
    public function deletePlat($id)
    {
        $this->deleteCompo($id);
        try {
            $query = "delete from plat where id_plat = :id";
            $res = $this->_db->prepare($query);
            $res->bindValue(':id', $id);
            $res->execute();
        } catch (PDOException $e) {
            print "Echec " . $e->getMessage();
            if (strpos($e, 'FOREIGN KEY violation') !== false) {
                // Affichage d'un message personnalisé pour la violation de clé étrangère
                echo "Erreur : La mise à jour ou la suppression de l'ingrédient est impossible car il est encore référencé dans la table 'composition'.";
            } else {
                // Affichage d'un message générique pour d'autres types d'erreurs
                echo "Une erreur s'est produite : " . $e;
            }
        }
    }




}


