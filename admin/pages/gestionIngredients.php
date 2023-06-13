<?php
$ig = new IngredientBD($cnx); //$cnx est fourni par l'index
$ingredients = $ig->getAllIngredient();
$n = count($ingredients);
//var_dump($fleur);
if (isset($_GET['submit'])) {
    //Traitement si js indispo
}
?>
<div class="container">
    <div class="col">
        <p><input type="text" id="filtrer" placeholder="Filter"></p>
        <p id="ajouter_ingredient" class="txtGras txtItalic red">Nouvel ingredient</p>
        <div id="nouveau_td"></div>
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
                        <td id="id_ingredient"><?php print $ingredients[$i]->id_ingredient ?></td>
                        <td contenteditable="true" name="nom_ingredient" id="<?php print $ingredients[$i]->id_ingredient ?>"><?php echo $ingredients[$i]->nom_ingredient ?></td>
                        <td><img src="./images/delete.jpg" alt="delete" id="<?php print $ingredients[$i]->id_ingredient ?>" class="delete" ></td>
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

