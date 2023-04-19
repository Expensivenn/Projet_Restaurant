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

}

