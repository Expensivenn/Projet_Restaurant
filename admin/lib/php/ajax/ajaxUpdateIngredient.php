<?php
    header('Content-Type: application/json');
    //chemin d'accès depuis le fichier ajax php
    require '../dbPgConnect.php';
    require '../classes/Connexion.class.php';
    require '../classes/Ingredient.class.php';
    require '../classes/IngredientBD.class.php';

    // Connexion à la base de données
    $cnx = Connexion::getInstance($dsn,$user,$pass);
    try{
        $ig = new IngredientBD($cnx);
        $rep = $ig->updateIngredient($_GET['champ'],$_GET['id'],$_GET['nouveau']);
    }catch(PDOException $e){
        print $e->getMessage();
}

