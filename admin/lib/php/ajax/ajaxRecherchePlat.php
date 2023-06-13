<?php

header('Content-Type: application/json');
//chemin d'accès depuis le fichier ajax php
require '../dbPgConnect.php';
require '../classes/Connexion.class.php';
require '../classes/Plat.class.php';
require '../classes/PlatBD.class.php';

$cnx = Connexion::getInstance($dsn, $user, $pass);
$plat = new PlatBD($cnx);
$data = $plat->getPlatByNom($_GET['nom_plat']);
if (!empty($data)) {
    echo json_encode($data);
} else {
    echo json_encode(0); // Renvoyer un tableau vide si aucun plat n'est trouvé
}
