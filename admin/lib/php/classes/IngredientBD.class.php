<?php
class IngredientBD extends Ingredient
{

    private $_db; //recevra $cnx de l'index
    private $_array = array(); //retourner le resultset

    public function __construct($cnx)
    {
        $this->_db = $cnx;
    }

    public function getAllIngredient(){
        try{
            $query = "select * from ingredient";
            $res = $this->_db->prepare($query);
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
            print "Echec requête : ".$e->getMessage();
        }


    }
    public function updateIngredient($champ, $id, $valeur)
    {
        try {
            $query = "update ingredient set $champ ='$valeur' where id_ingredient='$id'";
            $res = $this->_db->prepare($query);
            $res->execute();

        } catch (PDOException $e) {
            print "Echec " . $e->getMessage();
        }
    }
    public function getIngredientById($id){
        try{
            $query="select * from ingredient where id_ingredient = :id";
            $res = $this->_db->prepare($query);
            $res->bindValue(':id',$id);
            $res->execute();
            $data = $res->fetch();
            return $data;
        }catch(PDOException $e){
            print "Echec ".$e->getMessage();
        }
    }
    public function deleteIngredient($id)
    {
        try {
            $query = "delete from ingredient where id_ingredient = :id";
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
    public function addIngredient($champ, $valeur){
        try {
            //insérer ingrédient aux champs vides et récupérer l'id --> procédure embarquée
            $query = "INSERT INTO ingredient (nom_ingredient) VALUES ('temporaire')";
            $res = $this->_db->prepare($query);
            $res->execute();
            //récupérer l'id de l'ingrédient inséré
            $ingredient_id = $this->_db->lastInsertId();
            //faire un update avec le champ et la valeur reçue
            $query = "UPDATE ingredient SET $champ = :valeur WHERE id_ingredient = :id";
            $res = $this->_db->prepare($query);
            $res->bindParam(':valeur', $valeur);
            $res->bindParam(':id', $ingredient_id);
            $res->execute();
        } catch (PDOException $e) {
            print "Echec " . $e->getMessage();
        }
    }




}

