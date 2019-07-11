<?php
       ob_start();
?>
 <?php require_once('inc/init.inc.php');?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin - Login</title>

  <!-- Custom fonts for this template-->
  <link href="<?php URL; ?>public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="<?php URL; ?>public/css/sb-admin.css" rel="stylesheet">

</head>

<body>

<?php

// Deconnection
if(isset($_GET['action']) && $_GET['action'] == 'deconnexion'){

    // si il y a une 'action' dans l'URL et que celle-ci est égale à 'deconnexion', alors on détruit la session
    // header('location:http://localhost/FormationPierrefitte/site_CV_PHP/index.php/');

    session_destroy();
    header('location:index.php');
    exit();


}

?>

<?php
if(userConnect()){// si l'internaute est connecté redirection vers le profil
    
    header('location:login.php');
    exit();
}

?>

<?php

if($_POST){// si on a cliquez sur le bouton submit

    $r = execute_requete("SELECT * FROM membre WHERE username = '$_POST[username]'");
    // si il y a une correspondance d'un username dans la table 'member', $r renverra '1' ligne de résultat

    if($r->rowCount() >=1){

        $membre = $r->fetch(PDO::FETCH_ASSOC);
        debug($membre);

        //Vérification de mon mot de passe : si le mot de passe est correct, on renseigne des informations dans notre fichier de session

        if(password_verify($_POST['password'], $membre['password'])){

            $_SESSION['membre']['id_membre'] = $membre['id_membre'];
            $_SESSION['membre']['username'] = $membre['username'];
            $_SESSION['membre']['password'] = $membre['password'];
            $_SESSION['membre']['prenom'] = $membre['prenom'];
            $_SESSION['membre']['nom'] = $membre['nom'];
            $_SESSION['membre']['email'] = $membre['email'];
            $_SESSION['membre']['roles'] = $membre['roles'];

            $content .= '<div class="alert alert-success" role="alert">Connexion OK</div>';

            // Redirection vers la page index :
            header('location:view/Admin/admin.php');
             ob_end_flush();

        }
        else{
            $content .= '<div class="alert alert-danger" role="alert">Erreur mot de passe</div>';

        }


    }

    else{
            $content .= '<div class="alert alert-danger" role="alert">Erreur pseudo</div>';

        }



}

//---------------------------------------------------------------//
?>

<?=$content?>

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form method="post">
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="username" name="username" class="form-control" placeholder="username" required="required" autofocus="autofocus">
              <label for="username">pseudo</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="required">
              <label for="password">Password</label>
            </div>
          </div>
          <input type="submit" class="btn btn-secondary" value="Login">
        </form>
      </div>
    </div>
  </div>

   <!-- Bootstrap core JavaScript  -->
  <script src="public/vendor/jquery/jquery.min.js"></script>
  <script src="public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript -->
  <script src="public/vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
