<?php
header('Content-Type: application/json');
//chemin d'accès depuis le fichier ajax php
require '../dbPgConnect.php';
require '../classes/Connexion.class.php';
require '../classes/Plat.class.php';
require '../classes/PlatBD.class.php';
$cnx = Connexion::getInstance($dsn,$user,$pass);

$pl = new PlatBD($cnx);
$data[] = $pl->deleteCompo($_GET['id']);
print json_encode($data);
