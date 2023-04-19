<?php


// Vérifier si le panier existe dans la session
if (!isset($_SESSION['panier']) || empty($_SESSION['panier'])) {
    echo "Votre panier est vide.";
    // Afficher un message approprié si le panier est vide
} else {
    // Afficher le contenu du panier
    echo "<h1>Votre panier</h1>";
    echo "<table>";
    echo "<tr><th>ID</th><th>Nom</th><th>Prix</th><th>Action</th></tr>";

    $total = 0; // Variable pour stocker le total du panier

    // Parcourir les éléments du panier
    foreach ($_SESSION['panier'] as $plat) {
        echo "<tr>";
        echo "<td>".$plat['id_plat']."</td>";
        echo "<td>".$plat['nom_plat']."</td>";
        echo "<td>".$plat['prix']." €</td>";
        echo "<td><a href='./index_.php?page=supprimer_panier.php?id_plat=".$plat['id_plat']."'>Supprimer</a></td>"; // Lien pour supprimer le plat du panier
        echo "</tr>";

        $total += $plat['prix']; // Ajouter le prix du plat au total
    }

    echo "</table>";

    // Afficher le total du panier
    echo "<p>Total : ".$total." €</p>";
}
?>

