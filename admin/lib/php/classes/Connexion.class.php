<?php
class Connexion {
    private static $_instance = null;

    public static function getInstance($dsn,$user,$pass){
        // :: pour accéder à une méthode ou variable statique
        if(!self::$_instance){ //self : l'objet Connexion lui-même
            try{
                self::$_instance = new PDO($dsn,$user,$pass);
                //print "<br>connecté";
            }catch(PDOException $e){
                print "Echec : ".$e->getMessage();
            }

        }
        return self::$_instance;
    }
}