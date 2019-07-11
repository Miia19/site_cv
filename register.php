<?php require_once('inc/init.inc.php');?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin - Register</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

<?php

if($_POST){ // Si on clique sur le bouton 'submit'

    debug( $_POST );

    //Déclaration d'un variable :
    $erreur = '';

    if(strlen($_POST['username'])<=3 || strlen($_POST['username'])>=20){//Si le pseudo est inférieur ou égal à 3 OU qu'il est supérieur ou égal à 20

        $erreur .= '<div class="alert alert-danger" role="alert">Erreur taille pseudo</div>';

    }

    // Test si le pseudo est disponible, si le pseudo renvoie au moins 1 résultat, c'est que le pseudo est déjà attribué

    $r = execute_requete("SELECT * FROM membre WHERE username = '$_POST[username]'");

    if($r->rowCount() >=1){

        $erreur .= '<div class="alert alert-danger" role="alert">Pseudo indisponible</div>';
    }


    // Boucle sur les saisies afin de les passer dans la fonction addslaches()
    foreach ($_POST as $key => $value) {
        $_POST[$key] = addslashes($value);
    }

    // Cryptage du mot de passe :
    $_POST['password'] = password_hash($_POST['password'],PASSWORD_DEFAULT);

    if( empty($erreur)){ // si ma variable $erreur est vide

        execute_requete("INSERT INTO membre(username, password, prenom, nom, email) VALUES('$_POST[username]','$_POST[password]', '$_POST[prenom]', '$_POST[nom]', '$_POST[email]')");

        echo '<div class="alert alert-success role="alert">Inscription validée !<a href="'.URL.'connexion.php">Cliquez ici pour vous connecter</a></div>';
}
// Affichage des erreurs :
$content .=$erreur;



}

//----------------------------------------------------------------------------//
?>

<?=$content?>


  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Register an Account</div>
      <div class="card-body">
        <form method="post">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="username" name="username" class="form-control" placeholder="First name" required="required" autofocus="autofocus">
                  <label for="username">Pseudo</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Last name" required="required">
                  <label for="prenom">prenom</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="nom" name="nom"class="form-control" placeholder="Last name" required="required">
                  <label for="nom">nom</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required="required">
              <label for="email">Email address</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="required">
                  <label for="password">Password</label>
                </div>
              </div>
            </div>
          </div>
          <input type="submit" class="btn btn-secondary" value="s'inscrire">
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
