<?php

header('Content-Type: application/json');
//chemin d'accès depuis le fichier ajax php
require '../dbPgConnect.php';
require '../classes/Connexion.class.php';
require '../classes/Plat.class.php';
require '../classes/PlatBD.class.php';

// Connexion à la base de données
$cnx = Connexion::getInstance($dsn, $user, $pass);
try {
    $pl = new PlatBD($cnx);
    $rep = $pl->updatePlat($_GET['nom_plat'], $_GET['prix_plat'], $_GET['photo_plat'], $_GET['type_plat'], $_GET['id']);

    // Crée une structure de réponse JSON
    $response = array(
        'success' => true,
        'message' => 'Modification effectuée',
        'data' => $rep // Ajoutez ici les données que vous souhaitez renvoyer dans la réponse JSON
    );

    // Convertit la structure en JSON
    $jsonResponse = json_encode($response);

    // Envoie la réponse JSON
    echo $jsonResponse;
} catch (PDOException $e) {
    // En cas d'erreur, renvoie une réponse JSON avec un message d'erreur
    $response = array(
        'success' => false,
        'message' => 'Erreur lors de la modification: ' . $e->getMessage()
    );

    // Convertit la structure en JSON
    $jsonResponse = json_encode($response);

    // Envoie la réponse JSON
    echo $jsonResponse;
}

