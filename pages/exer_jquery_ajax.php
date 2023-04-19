<?php
$ig = new IngredientBD($cnx);
$ingredients = $ig->getAllIngredient();
$nbr = count($ingredients);
?>
<form method="get" action="<?php print $_SERVER['PHP_SELF'];?>">

    <select name="choix_ingredient" id="choix_ingredient">
        <option value="">Par nom</option>
        <?php
        for($i=0;$i<$nbr;$i++){
            ?>
            <option value="<?php print $ingredients[$i]->id_ingredient;?>"><?php print $ingredients[$i]->nom_ingredient;?></option>
            <?php
        }
        ?>
    </select>&nbsp;&nbsp;
    <input type="submit" name="submit" id="submit" value="Description" class="btn btn-success">
</form>


<p>&nbsp;</p>
<div class="card mb-3" style="max-width: 540px;" id="description_ingredient">
    <p>Illustration</p>
    <div class="row g-0">
        <div class="col-md-6" id="image_ingredient">

        </div>
        <div class="col-md-6">
            <div class="card-body">
                <p class="card-text" id="detail_ingredient"></p>
            </div>
        </div>
    </div>
</div>

