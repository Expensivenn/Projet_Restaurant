
<?php
//INDEX admin

session_start(); //pour utiliser les variables de session
include ('./lib/php/admin_liste_include.php');
?>

<!doctype html>
<html>
<head>
    <title>Arborescence</title>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>


    <link rel="stylesheet" type="text/css" href="./lib/css/custom.css"/>
    <script src="./lib/js/fonction_jquery.js"></script>
</head>
<body>
<div id="wrapper">
    <header id="header">
        <header id="header">
            <div class="d-flex align-items-center bg-danger">
                <div class="flex-shrink-0">
                    <img id="imageLogo"src="./images/logo2.png" class="rounded float-start" alt="logo">
                </div>
                <div class="flex-grow-1 ms-3">
                    <h2>RESTAURANT</h2>
                </div>
                <h5 class="ms-auto"><a id="lien" href="index_.php?page=disconnect.php">Deconnexion Admin</a></h5>

            </div>
        </header>

    </header>
    <nav id="nav">
        <?php
        if (file_exists('./lib/php/menu_admin.php')) {
            include('./lib/php/menu_admin.php');
        }
        ?>
    </nav>
    <section id="main">
        <?php
        if (!isset($_SESSION['page'])) {
            $_SESSION['page'] = "accueil.php";
        }
        if (isset($_GET['page'])) {
            $_SESSION['page'] = $_GET['page'];
        }
        $path = './pages/' . $_SESSION['page'];
        //print "<br>$path";
        if (file_exists($path)) {
            include($path);
        } else {
            // include('./pages/page404.php');
        }

        ?>
    </section>
</div>
</body>
<footer id="footer"></footer>
</html>