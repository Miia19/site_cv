
<?php require_once('inc/header.inc.php');?>
    <div class="section" id="formation">
        <div class="container cc-formation">
        <div class="h4 text-center mb-4 title">
        <a ></a><h2 class="section-heading text-uppercase bg-warning">formation</h2></div>
            <?php foreach ($formations as $form) : ?>
            <div class="card">
            <div class="row">
                <div class="col-md-3 bg-warning" data-aos="fade-right" data-aos-offset="50" data-aos-duration="500">
                <div class="card-body cc-formation-header">
                    <p><?php echo $form->date;?></p>
                    <div class="h5">
                        <?php echo $form->nomFormation;?>
                    </div>
                </div>
                </div>
                <div class="col-md-9" data-aos="fade-left" data-aos-offset="50" data-aos-duration="500">
                <div class="card-body bg-light">
                    <div class="h5"><?php echo $form->poste;?></div>
                    <p><?php echo $form->description;?></p>
                </div>
                </div>
            </div>
            </div>
            <?php endforeach;?>
        </div>
    </div> 
    <br>
    <br>



<?php require_once('inc/footer.inc.php');?>

