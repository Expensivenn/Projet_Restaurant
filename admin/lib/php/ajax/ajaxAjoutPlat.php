<?php
header('Content-Type: application/json');
//chemin d'accès depuis le fichier ajax php
require '../dbPgConnect.php';
require '../classes/Connexion.class.php';
require '../classes/Plat.class.php';
require '../classes/PlatBD.class.php';

$cnx = Connexion::getInstance($dsn,$user,$pass);
$plat = new PlatBD($cnx);
$data = $plat->addPlat($_GET['nom_plat'],$_GET['prix_plat'],$_GET['photo_plat'],$_GET['type_plat']);
print json_encode($data);
