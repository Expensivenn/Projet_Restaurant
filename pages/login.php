<?php
    if(isset($_POST['submit'])){
        $admin = new AdminBD($cnx); //$cnx est dans l'index
        $adm = $admin->isAdmin($_POST['login'],$_POST['password']);
        if($adm == 1){
            $_SESSION['admin'] = 1;
            print '<meta http-equiv="refresh": content="0;url=./admin/index_.php?page=accueil.php">';
        }
        else{
            print "acces réservé";
        }
    }


?>
<form action ="<?php print $_SERVER['PHP_SELF'];?> "method="post">
  <div class="mb-3">
    <label for="login" class="form-label">Email address</label>
    <input type="text" class="form-control" id="login" name="login">

  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" name ="password" id="password">
  </div>

  <button type="submit" id="submit" name="submit" class="btn btn-primary">Envoyer</button>
</form>