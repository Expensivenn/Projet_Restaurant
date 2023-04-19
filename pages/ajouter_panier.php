<?php
include ('../admin/lib/php/admin_liste_include.php');
require_once '../admin/lib/php/classes/PlatBD.class.php';
session_start();

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ajouter_panier'])) {
    // Récupérer les informations du plat depuis le formulaire
    $id_plat = $_POST['id_plat']; // ID du plat à ajouter
    $pl = new PlatBD($cnx);
    // Vous pouvez récupérer d'autres informations du plat ici (nom, photo, prix, etc.)

    // Créer un objet Plat avec les informations récupérées
    $plat = $pl->getPlatById($id_plat); // Remplacer avec les variables appropriées

    // Ajouter le plat au panier
    $pl->ajouterPlatAuPanier($plat); // Appeler la fonction d'ajout du panier

    // Rediriger vers la page précédente ou vers une autre page
    // en affichant un message de succès
    header('Location: index_.php?page=plats.php');
    exit();
}
?>
