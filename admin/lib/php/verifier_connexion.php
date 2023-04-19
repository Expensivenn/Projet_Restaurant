<?php
if(!isset($_SESSION['admin'])){
   print "<br>Accès reservé aux admin";
    print '<meta http-equiv="refresh": content="0;url=../index_.php">';
}
