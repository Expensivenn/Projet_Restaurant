<?php

if(file_exists('./lib/php/dbPgConnect.php')){
    //on est dans la partie admin
    require './lib/php/dbPgConnect.php';
    require './lib/php/classes/Autoloader.class.php';
} else if (file_exists('admin/lib/php/dbPgConnect.php')){
    //on est dans la partie publique
    require './admin/lib/php/dbPgConnect.php';
    require './admin/lib/php/classes/Autoloader.class.php';
}
Autoloader::register();
$cnx = Connexion::getInstance($dsn,$user,$pass);