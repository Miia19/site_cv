<?php
  require_once('../../inc/init.inc.php'); ob_start();
  require_once('../../inc/adminHeader.inc.php');
  $r = execute_requete("SELECT * FROM experiences"); 
  // debug($r);
?>


    <div id="content-wrapper">

      <div class="container-fluid">


        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Experiences</div>
          <div class="card-body">
            <div class="table-responsive">
              <button type="button" class="btn btn-warning" ><a href="?exp=new" style="color:white;">Ajouter Experience</a></button><br>
            
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <?php
                        // Suppression des experiences :

                            if(isset($_GET['exp']) && $_GET['exp'] == 'delete'){ // si il y a une 'action' dans l'URL et que c'est égale à 'suppression'

                              execute_requete("DELETE FROM experiences WHERE id_experiences='$_GET[id_experiences]'");

                               header('location:TabExperience.php');

                            }
                          for ($i = 0; $i < $r->columnCount(); $i++) {
                            // debug($r);
                            $colonne = $r->getColumnMeta($i); 
                        ?>
                        <th><?=$colonne['name']; 
                        // debug($colonne);?></th>
                        <?php } ?>
                        <th colspan="2" style="text-align: center;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php while ($experiences = $r->fetch(PDO::FETCH_ASSOC)) { ?>
                      <tr>
                        <?php foreach($experiences as $indice => $co) : ?>
                          <td><?php echo $co; ?></td>
                        <?php endforeach;?>
                          <td>
                            <button type="button" class="btn btn-warning">
                              <a href="?exp=delete&id_experiences=<?php echo $experiences['id_experiences']?>" style="color:white;">
                                Delete
                              </a>
                          </button>
                          </td>
                          <td>
                            <button type="button" class="btn btn-warning">
                              <a href="?exp=update&id_experiences=<?php echo $experiences['id_experiences']?>" style="color:white;">
                                    Edite
                              </a>
                            </button>
                          </td>
                        
                      </tr>
                <?php } 

                if(!empty($_POST)){ // si le formulaire à été validé et qu'il y a des infos dedans

                  foreach ($_POST as $key => $value) {
                      $_POST[$key] = htmlentities(addslashes($value));
                   }

                  if(isset($_GET['exp']) && $_GET['exp'] == 'update') {

                    execute_requete("UPDATE experiences SET nomEntreprise='$_POST[nomEntreprise]',date='$_POST[date]',poste='$_POST[poste]',ville='$_POST[ville]', description='$_POST[description]' WHERE id_experiences='$_GET[id_experiences]'");
              
                    header('location:TabExperience.php');
              
                  }else{

                    execute_requete("INSERT INTO experiences(nomEntreprise, date, poste, ville, description) VALUES('$_POST[nomEntreprise]','$_POST[date]','$_POST[poste]','$_POST[ville]','$_POST[description]')");

                    header('location:TabExperience.php');

                  }
              }

              if( isset($_GET['exp']) && $_GET['exp'] == 'update'){
                $r = execute_requete("SELECT * FROM experiences WHERE id_experiences='$_GET[id_experiences]'");

                $experiences =$r->fetch(PDO::FETCH_ASSOC);
              }

              
              $nomEntreprise = (isset($experiences['nomEntreprise'])) ? $experiences['nomEntreprise'] :'';
              $date = (isset($experiences['date'])) ? $experiences['date'] :'';
              $poste = (isset($experiences['poste'])) ? $experiences['poste'] :'';
              $ville = (isset($experiences['ville'])) ? $experiences['ville'] :'';
              $description = (isset($experiences['description'])) ? $experiences['description'] :'';
                ?>

                </tbody>
              </table>
            </div>
          </div>
          <?php if(isset($_GET['exp']) && ($_GET['exp'] == 'update' || $_GET['exp'] == 'new' )) : 
            
            if(isset($_GET['id_experiences'])){ // si l'id_experiences est présent dans l'URL
              $r = execute_requete("SELECT * FROM experiences WHERE id_experiences='$_GET[id_experiences]'");
      
              $experiences_actuel = $r->fetch(PDO::FETCH_ASSOC);
              debug($experiences_actuel);
          }
            ?>
          <form method="post">

    <label for="nomEntreprise">nomEntreprise</label><br>
    <input type="text" name="nomEntreprise" id="nomEntreprise" class="form-control" value="<?=$nomEntreprise?>"><br><br>

     <label for="date">date</label><br>
    <input type="text" name="date" id="date" class="form-control" value="<?=$date?>"><br><br>

    <label for="poste">poste</label><br>
    <input type="text" name="poste" id="poste" class="form-control" value="<?=$poste?>"><br><br>

    <label for="ville">ville</label><br>
    <input type="text" name="ville" id="ville" class="form-control" value="<?=$ville?>"><br><br>

    <label for="description">description</label><br>
    <textarea name="description" id="description" cols="30" rows="10" value="<?=$description?>"></textarea><br><br>

    <input type="submit" class="btn btn-secondary" value="s'inscrire">

</form>

<?php endif ?>
        </div>

      </div>
      <!-- /.container-fluid -->
<?php require_once('../../inc/adminFooter.inc.php'); ?>