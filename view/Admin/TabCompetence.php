<?php
  require_once('../../inc/init.inc.php'); ob_start();
  require_once('../../inc/adminHeader.inc.php');
  
  $r = execute_requete("SELECT * FROM competence"); 
  // debug($r);
?>

    <div id="content-wrapper">

      <div class="container-fluid">


        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Competences</div>
          <div class="card-body">
            <div class="table-responsive">
              <button type="button" class="btn btn-warning" ><a href="?op=new" style="color:white;">Ajouter competence</a></button><br>
            
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <?php
                        // Suppression des competences :

                            if(isset($_GET['op']) && $_GET['op'] == 'delete'){ // si il y a une 'action' dans l'URL et que c'est égale à 'suppression'

                              execute_requete("DELETE FROM competence WHERE id_competence='$_GET[id_competence]'");

                               header('location:TabCompetence.php');

                            }
                          for ($i = 0; $i < $r->columnCount(); $i++) {
                            // debug($r);
                            $colonne = $r->getColumnMeta($i); 
                        ?>

                        <th><?=$colonne['name'];?></th>
                        
                        <?php } ?>

                        <th colspan="2" style="text-align: center;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php while ($competences = $r->fetch(PDO::FETCH_ASSOC)) { ?>
                      <tr>
                        <?php foreach($competences as $indice => $co) : ?>
                          <td><?php echo $co; ?></td>
                        <?php endforeach;?>
                          <td>
                            <button type="button" class="btn btn-warning">
                              <a href="?op=delete&id_competence=<?php echo $competences['id_competence']?>" style="color:white;">
                                Delete
                              </a>
                          </button>
                          </td>
                          <td>
                            <button type="button" class="btn btn-warning">
                              <a href="?op=update&id_competence=<?php echo $competences['id_competence']?>" style="color:white;">
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

                  if(isset($_GET['op']) && $_GET['op'] == 'update') {

                    execute_requete("UPDATE competence SET nom='$_POST[nom]',level='$_POST[level]' WHERE id_competence='$_GET[id_competence]'");
              
                    header('location:TabCompetence.php');
              
                  }else{

                    execute_requete("INSERT INTO competence(nom, level) VALUES('$_POST[nom]','$_POST[level]')");

                    header('location:TabCompetence.php');

                  }
              }

              if( isset($_GET['op']) && $_GET['op'] == 'update'){
                $r = execute_requete("SELECT * FROM competence WHERE id_competence='$_GET[id_competence]'");

                $competences =$r->fetch(PDO::FETCH_ASSOC);
              }

              
              $nom = (isset($competences['nom'])) ? $competences['nom'] :'';
              $level = (isset($competences['level'])) ? $competences['level'] :'';
                ?>

                </tbody>
              </table>
            </div>
          </div>
          <?php if(isset($_GET['op']) && ($_GET['op'] == 'update' || $_GET['op'] == 'new' )) : 
            
            if(isset($_GET['id_competence'])){ // si l'id_competences est présent dans l'URL
              $r = execute_requete("SELECT * FROM competence WHERE id_competence='$_GET[id_competence]'");
      
              $competences_actuel = $r->fetch(PDO::FETCH_ASSOC);
              debug($competences_actuel);
          }
            ?>
          <form method="post">

    <label for="nom">nom</label><br>
    <input type="text" name="nom" id="nom" class="form-control" value="<?=$nom?>"><br><br>

     <label for="level">level</label><br>
    <input type="text" name="level" id="level" class="form-control" value="<?=$level?>"><br><br>

    <input type="submit" class="btn btn-secondary" value="s'inscrire">

</form>

<?php endif ?>
        </div>

      </div>
      <!-- /.container-fluid -->
<?php require_once('../../inc/adminFooter.inc.php'); ?>
