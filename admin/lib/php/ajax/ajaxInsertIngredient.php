<?php
header('Content-Type: application/json');
//chemin d'accès depuis le fichier ajax php
require '../dbPgConnect.php';
require '../classes/Connexion.class.php';
require '../classes/Ingredient.class.php';
require '../classes/IngredientBD.class.php';

$cnx = Connexion::getInstance($dsn,$user,$pass);
$ig = new IngredientBD($cnx);
$data[] = $ig->addIngredient($_GET['champ'],$_GET['nouveau']);
print json_encode($data);