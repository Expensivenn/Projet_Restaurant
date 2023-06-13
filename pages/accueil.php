<!-- Inclure les fichiers CSS et JavaScript de Bootstrap -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<style>
    /* Styles pour le cadre de l'histoire du restaurant */
    #histoire {
        background-color: lightgray;
        padding: 20px;
        margin: 20px;
    }

    /* Styles pour le conteneur du carousel */
    #carouselExampleIndicators {
        width: 500px;
        margin-right: 20px;
    }

    /* Styles pour le cadre des photos de plats */
    #plats {
        margin-top: 150px;
    }

    .carousel-item img {
        width: 100%;
        height: auto;
    }
</style>

<div class="container md">
    <div class="row">
        <div class="col-md-4">
            <div id="histoire">
                <h2>Bienvenue chez Take Away Food !</h2>
                <p>Nous sommes ravis de vous accueillir sur notre site. Chez Take Away Food, nous sommes passionnés par la cuisine et nous sommes heureux de vous proposer une expérience culinaire unique, même lorsque vous êtes chez vous.</p>
                <p>Découvrez notre concept de plats à emporter qui vous permet de profiter de nos délicieux plats dans le confort de votre foyer. Que vous soyez pressé, que vous souhaitiez organiser un repas entre amis ou que vous préfériez simplement déguster un bon repas sans avoir à cuisiner, notre service de plats à emporter est la solution idéale pour vous.</p>
                <p>Explorez notre menu en ligne pour découvrir nos spécialités et nos plats phares. Laissez-vous tenter par nos créations culinaires uniques et faites l'expérience d'un repas savoureux à emporter.</p>
            </div>
        </div>
        <div class="col-md-8">
            <div id="plats">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="./lib/image/pate2.png" alt="Plat 1">
                        </div>
                        <div class="carousel-item">
                            <img src="./lib/image/steak2.png" alt="Plat 2">
                        </div>
                        <div class="carousel-item">
                            <img src="./lib/image/omelette.png" alt="Plat 3">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Précédent</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Suivant</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
