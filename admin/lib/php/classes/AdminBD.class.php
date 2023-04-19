<?php

class AdminBD extends Admin {

    private $_db; //recevra $cnx de l'index
    private $_array = array(); //retourner le resultset

    public function __construct($cnx){
        $this->_db = $cnx;
    }

    public function isAdmin($login, $password){
        try{
            $query = "select verifier_connexion(:login,:password) as retour";
            $res = $this->_db->prepare($query);
            $res->bindValue(':login',$login);
            $res->bindValue(':password',$password);
            $res->execute();
            //$data = $res->fetch();
            //$data = $res->fetchColumn(0);
            //var_dump($data);
            //var_dump($data);
            return $res->fetchColumn(0);
        }catch(PDOException $e){
            print "<br>Echec : ".$e->getMessage();
        }
    }

    public function getAdmin($login,$password){
        try{
            $query = "select * from admin where login=:login and password = :password";
            $res = $this->_db->prepare($query);
            $res->bindValue(':login',$login);
            $res->bindValue(':password',$password);
            $res->execute();
            $data = $res->fetch();
            if(!empty($data)){
                $_array[] = new Admin($data);
               // var_dump($_array);
                return $_array;
            }
            else{
                return null;
            }

        }catch(PDOException $e){
            print "<br>Echec : ".$e->getMessage();
        }
    }

}