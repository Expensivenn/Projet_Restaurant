<?php
$pl = new PlatBD($cnx); //$cnx est fourni par l'index
$plats = $pl->getAllPlats();

$n = count($plats);
?>

<div class="container px-4 py-5" id="featured-3">
    <h2 class="pb-2 border-bottom">Notre menu</h2>

    <!-- Partie 1: Entrée -->
    <h3 class="text-danger text-decoration-underline">Entrées</h3>
    <div class="row g-4 py-5 row-cols-lg-3">
        <?php
        for ($i = 0; $i < $n; $i++) {
            if ($plats[$i]->id_type == 1) { // Vérifie si le plat est de type Entrée
                ?>
                <div class="feature col">
                    <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
                        <img src="./lib/image/<?php echo $plats[$i]->photo_plat;?>" style="height: 250px; width: 250px;"/>
                    </div>
                    <h3 class="fs-2"><?php echo $plats[$i]->nom_plat ?></h3>
                    <?php
                    $ingredients = $pl->getIngredientById($plats[$i]->id_plat);
                    $n2 = count($ingredients) ;
                    ?>
                    <p>
                    <h5>Ingredients :</h5>
                    <?php
                    for ($j = 0; $j < $n2; $j++) {
                        if($j < ($n2 - 1)){
                            print $ingredients[$j]->nom_ingredient.", ";
                        }
                        else{
                            print $ingredients[$j]->nom_ingredient.".";
                        }
                    }
                    ?>

                    </p>
                    <!-- Formulaire pour ajouter un plat au panier -->
                    <form method="post" action="./pages/ajouter_panier.php">
                        <!-- Champ caché pour transmettre l'ID du plat -->
                        <input type="hidden" name="id_plat" value=<?php $plats[$i]->id_plat?>>


                        <!-- Bouton pour ajouter au panier -->
                        <input type="submit" name="ajouter_panier" value="Ajouter au panier">
                    </form>

                </div>
                <?php
            }
        }
        ?>
    </div>

    <!-- Partie 2: Plat principal -->
    <h3 class="text-danger text-decoration-underline">Plats</h3>
    <div class="row g-4 py-5 row-cols-lg-3">
        <?php
        for ($i = 0; $i < $n; $i++) {
            if ($plats[$i]->id_type == 2) { // Vérifie si le plat est de type Plat principal
                ?>
                <div class="feature col">
                    <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
                        <img src="./lib/image/<?php echo $plats[$i]->photo_plat;?>" style="height: 250px; width: 250px;"/>
                    </div>
                    <h3 class="fs-2"><?php echo $plats[$i]->nom_plat ?></h3>
                    <?php
                    $ingredients = $pl->getIngredientById($plats[$i]->id_plat);
                    $n2 = count($ingredients) ;
                    ?>
                    <p>
                    <h5>Ingredients :</h5>
                    <?php
                    for ($j = 0; $j < $n2; $j++) {
                        if($j < ($n2 - 1)){
                            print $ingredients[$j]->nom_ingredient.", ";
                        }
                        else{
                            print $ingredients[$j]->nom_ingredient.".";
                        }
                    }
                    ?>

                    </p>
                    <!-- Formulaire pour ajouter un plat au panier -->
                    <form method="post" action="./pages/ajouter_panier.php">
                        <!-- Champ caché pour transmettre l'ID du plat -->
                        <input type="hidden" name="id_plat" value=<?php $plats[$i]->id_plat?>>


                        <!-- Bouton pour ajouter au panier -->
                        <input type="submit" name="ajouter_panier" value="Ajouter au panier">
                    </form>

                </div>
                <?php
            }
        }
        ?>
    </div>

    <!-- Partie 3: Dessert -->
    <h3 class="text-danger text-decoration-underline">Desserts</h3>
    <div class="row g-4 py-5 row-cols-lg-3">
        <?php
        for ($i = 0; $i < $n; $i++) {
            if ($plats[$i]->id_type == 3) { // Vérifie si le plat est de type Dessert
                ?>
                <div class="feature col">
                    <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
                        <img src="./lib/image/<?php echo $plats[$i]->photo_plat;?>" style="height: 250px; width: 250px;"/>
                    </div>
                    <h3 class="fs-2"><?php echo $plats[$i]->nom_plat ?></h3>
                    <?php
                    $ingredients = $pl->getIngredientById($plats[$i]->id_plat);
                    $n2 = count($ingredients) ;
                    ?>
                    <p>
                    <h5>Ingredients :</h5>
                    <?php
                    for ($j = 0; $j < $n2; $j++) {
                        if($j < ($n2 - 1)){
                            print $ingredients[$j]->nom_ingredient.", ";
                        }
                        else{
                            print $ingredients[$j]->nom_ingredient.".";
                        }
                    }
                    ?>

                    </p>
                    <!-- Formulaire pour ajouter un plat au panier -->
                    <form method="post" action="./pages/ajouter_panier.php">
                        <!-- Champ caché pour transmettre l'ID du plat -->
                        <input type="hidden" name="id_plat" value=<?php $plats[$i]->id_plat?>>


                        <!-- Bouton pour ajouter au panier -->
                        <input type="submit" name="ajouter_panier" value="Ajouter au panier">
                    </form>

                </div>
                <?php
            }
        }
        ?>
    </div>
</div>

