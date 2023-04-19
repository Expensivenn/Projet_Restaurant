<?php
$ig = new IngredientBD($cnx); //$cnx est fourni par l'index
$ingredients = $ig->getAllIngredient();
$n = count($ingredients);
//var_dump($fleur);
?>


<div class="container px-4 py-5" id="featured-3">
    <h2 class="pb-2 border-bottom">Columns with icons</h2>

    <div class="row g-4 py-5 row-cols-lg-3">
        <?php
        for ($i = 0; $i < $n; $i++) {
            ?>
            <div class="feature col">
                <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
                    <svg class="bi" width="1em" height="1em">
                        <use xlink:href="#collection"/>
                    </svg>
                </div>
                <h3 class="fs-2"><?php echo $ingredients[$i]->nom_ingredient ?></h3>
                <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence
                    and
                    probably just keep going until we run out of words.</p>
                <a href="#" class="icon-link d-inline-flex align-items-center">
                    Call to action
                    <svg class="bi" width="1em" height="1em">
                        <use xlink:href="#chevron-right"/>
                    </svg>
                </a>
            </div>
            <?php
        }
        ?>
    </div>

</div>
