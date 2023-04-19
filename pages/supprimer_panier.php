<?php
session_start();

// Vérifier si l'ID du plat est transmis dans l'URL
if(isset($_GET['id_plat']) && !empty($_GET['id_plat'])) {
    $id_plat = $_GET['id_plat'];

    // Parcourir les éléments du panier dans la session
    foreach ($_SESSION['panier'] as $key => $plat) {
        // Si l'ID du plat correspond à celui à supprimer
        if ($plat['id_plat'] == $id_plat) {
            // Supprimer l'élément du panier
            unset($_SESSION['panier'][$key]);
            // Rediriger vers la page du panier mise à jour
            header("Location: panier.php");
            exit();
        }
    }
}

// Rediriger vers la page du panier si l'ID du plat n'est pas transmis
header("Location: panier.php");
exit();
?>
