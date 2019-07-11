<?php require_once('inc/header.inc.php');?>


    
    <div class="section" id="experience">
    <div class="container cc-experience">
    <div class="h4 text-center mb-4 title">
        <a ></a><h2 class="section-heading text-uppercase bg-warning">Experience</h2></div>
    <div class="row">
            <?php foreach ($experiences as $ex) : ?>
        <div class="col-md-4">
            <div class="card mb-4 box-shadow bg-light" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $ex->nomEntreprise;?></h5>
                    <p class="card-text"><?php echo $ex->date;?></p>
                    <p class="card-text"><?php echo $ex->poste;?></p>
                    <p class="card-text"><?php echo $ex->ville;?></p>
                    <p class="card-text"><?php echo $ex->description;?></p>
                    
            </div>
            </div>
        </div>
        
        <?php endforeach;?>
    </div>
    </div>
    </div>
    </div>
