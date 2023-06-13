<?php

if (isset($_GET['editer_ajouter'])) {
    //traitement à prévoir, par langage serveur
}

?>
<h2>Gestion des plats</h2>
<div class="container">
    <form method="get" action="<?php print $_SERVER['PHP_SELF'];?>">
        <div id="inBD"></div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nom_plat" class="form-label">Intitulé :</label>
                    <input type="text" class="form-control" id="nom_plat" name="nom_plat">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="type_plat" class="form-label">Type :</label>
                    <select class="form-select" id="type_plat" name="type_plat">
                        <option selected>Type de plat</option>
                        <option value="1">Entrée</option>
                        <option value="2">Plat</option>
                        <option value="3">Dessert</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="prix_plat" class="form-label">Prix :</label>
                    <input type="text" class="form-control" id="prix_plat" name="prix_plat">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="photo_plat" class="form-label">Image :</label>
                    <input type="text" class="form-control" id="photo_plat" name="photo_plat">
                </div>
            </div>
        </div>

        <div class="row">
            <?php
            $ig = new IngredientBD($cnx); //$cnx est fourni par l'index
            $ingredients = $ig->getAllIngredient();
            $n = count($ingredients);
            ?>
            <?php
            for ($i = 0; $i < $n; $i++) {
                ?>
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="<?php print $ingredients[$i]->id_ingredient ?>" name="<?php print $ingredients[$i]->id_ingredient ?>" id="<?php print $ingredients[$i]->id_ingredient ?>">
                        <label class="form-check-label" for="<?php print $ingredients[$i]->id_ingredient ?>">
                            <?php echo $ingredients[$i]->nom_ingredient ?>
                        </label>
                    </div>
                </div>
            <?php }?>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <button type="submit" class="btn btn-primary" id="editer_ajouter" name="editer">Enregistrer</button>
            </div>
        </div>
    </form>
</div>
<?php
$pl = new PlatBD($cnx); //$cnx est fourni par l'index
$plats = $pl->getAllPlats();
$n = count($plats);

if (isset($_GET['submit'])) {
    //Traitement si js indispo
}
?>

<div class="container">
    <div class="col">
        <table class="table .table-stripped" id="tab">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nom</th>
            </tr>
            </thead>
            <tbody class="table-group-divider">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="get">

                <?php
                for ($i = 0; $i < $n; $i++) {
                    ?>
                    <tr>
                        <td id="id_plat"><?php echo $plats[$i]->id_plat ?></td>
                        <td contenteditable="false" name="nom_ingredient" id="table_plat"><?php echo $plats[$i]->nom_plat ?></td>
                        <td><img src="./images/delete.jpg" alt="deletePlat" id="<?php print $plats[$i]->id_plat ?>" class="deletePlat" ></td>
                    </tr>
                    <?php
                }
                ?>
            </form>
            <input type="submit" name="submit" id="submitIg" value="Envoyer">
            </tbody>
        </table>
    </div>

</div>



