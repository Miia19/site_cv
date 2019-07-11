<?php require_once('inc/header.inc.php');?>
  
<br>
<br>
<div class="section" id="competence">
<div class="container cc-competence">
    <div class="h4 text-center mb-4 title">
        <a ></a><h2 class="section-heading text-uppercase bg-warning">Competence</h2></div>
        <br>
        <div class="card  bg-light" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
        <div class="card-body">
            <div class="row">
                <?php foreach ($competences as $co) : ?>

            <div class="col-md-6">
                <div class="progress-container progress-dark "><span class="progress-badge">
                    <a href="comp.php?op=show&id=<?php echo $co->id_competence; ?>" class="text-dark">
                        <?php echo $co->nom;?>
                        </a></span>
                <div class="progress">
                    <div class="progress-bar progress-bar-warning niveau bg-warning" data-aos="progress-full" data-aos-offset="10" data-aos-duration="2000" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo htmlentities($co->level);?>%;"></div>
                </div>
                </div>
            </div>
                <?php endforeach;?>

            </div>
        </div>
    </div>
</div>
<br>
<br>