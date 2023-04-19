<?php
class Autoloader {

    static function register(){
        //méthode prédéfinie de chargement des classes dès le mot new rencontré
        spl_autoload_register(array(__CLASS__,'autoload'));
    }

    static function autoload($class){
        require $class.".class.php";
    }
}