<?php
require __DIR__ . '/../vendor/autoload.php';
require '../admin/lib/php/dbPgConnect.php';
require '../admin/lib/php/classes/Connexion.class.php';
require '../admin/lib/php/classes/Plat.class.php';
require '../admin/lib/php/classes/PlatBD.class.php';
require '../admin/lib/php/classes/Ingredient.class.php';

$cnx = Connexion::getInstance($dsn, $user, $pass);
$pl = new PlatBD($cnx);
$plats = $pl->getAllPlats();
$c = count($plats);

// Configuration de Mpdf
$mpdfConfig = [
    'default_font' => 'helvetica', // Changer la police par défaut en Helvetica
    'mode' => 'utf-8',
    'margin_top' => 20,
    'margin_bottom' => 20,
    'margin_left' => 15,
    'margin_right' => 15,
    'border_color' => 'FF0000', // Couleur de la bordure : rouge
    'border_width' => 3, // Largeur de la bordure : 3mm
];

$mpdf = new \Mpdf\Mpdf($mpdfConfig);

$mpdf->SetTitle("Menu du restaurant");

$mpdf->WriteHTML('<h1>Menu du restaurant</h1>');
$mpdf->WriteHTML('<hr>');

foreach ($plats as $plat) {
    $mpdf->WriteHTML('<h3>' . $plat->nom_plat . '</h3>');
    $ingredients = $pl->getIngredientById($plat->id_plat);
    $ingredientNames = array();
    foreach ($ingredients as $ingredient) {
        $ingredientNames[] = $ingredient->nom_ingredient;
    }
    $ingredientList = implode(', ', $ingredientNames);
    $mpdf->WriteHTML('<p>Ingrédients : ' . $ingredientList . '</p>');
    $mpdf->WriteHTML('<p>Prix : ' . $plat->prix . ' €</p>');
    $mpdf->WriteHTML('<hr>');
}

$mpdf->Output();
