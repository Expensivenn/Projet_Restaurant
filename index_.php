<?php
//INDEX PUBLIC

session_start(); //pour utiliser les variables de session
include ('./admin/lib/php/admin_liste_include.php');
?>

<!doctype html>
<html>
<head>
    <title>Restaurant</title>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="./lib/css/style.css"/>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src ="./admin/lib/js/fonction_jquery.js"></script>
</head>
<body>
<div id="wrapper">
    <header id="header">
        <div class="d-flex align-items-center bg-danger">
            <div class="flex-shrink-0">
                <img id="imageLogo"src="./lib/image/logo2.png" class="rounded float-start" alt="logo">
            </div>
            <div class="flex-grow-1 ms-3">
                <h2>RESTAURANT</h2>
            </div>
            <h5 class="ms-auto"><a id="lien" href ="index_.php?page=login.php">Connexion</a></h5>
        </div>
    </header>
    <nav id="nav">
        <?php
        if (file_exists('./lib/php/menu_public.php')) {
            include('./lib/php/menu_public.php');
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