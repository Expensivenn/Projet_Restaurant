<?php

header('Content-Type: application/json');
//chemin d'accès depuis le fichier ajax php
require '../dbPgConnect.php';
require '../classes/Connexion.class.php';
require '../classes/Plat.class.php';
require '../classes/PlatBD.class.php';

$cnx = Connexion::getInstance($dsn, $user, $pass);
$plat = new PlatBD($cnx);
$checkboxValues = array_map('intval', $_GET['checkboxValues']);

// Utilisez les valeurs des cases à cocher dans votre requête ou votre logique métier
$data = $plat->insertIntoComposition($checkboxValues);
print json_encode($data);
