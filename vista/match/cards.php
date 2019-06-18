<?php
    foreach ($usrPool as $i => $pareja) {
        
?>
<div class="card" id="card-id-<?= $i ?>">

    <div class="image" id="profile-image" style="background-image: url('<?= $pareja->getImagen() ?>');"></div>
    
    <a href="#" onclick="info('<?= $i ?>')" class="info-link">
        <div class="info-img-container">
            <div class="image-container">
                <img src="assets/img/info.png" width="35px" height="35px">
            </div>
        </div>
    </a>

    <div class="info" id="info">
        <h3 class="name"><?= $pareja->getNombre() ?></h3>
        <p  class="edad"><?= $pareja->getEdad() ?></p>
    </div>

    <div class="biografia" style="padding-left: 30px; padding-right: 30px;">
        <?php
        if (($pareja->getEducacion() != null) || ($pareja->getTrabajo() != null)) {
            if ($pareja->getEducacion() != null) {
                ?>
                <div class="educacion">
                    <img src="assets/img/education.png" width="15px" height="15px">
                    <p><?= $pareja->getEducacion() ?></p>
                </div>
                <?php
            }

            if ($primerUser->getTrabajo() != null) {
                ?>
                <div class="trabajo">
                    <img src="assets/img/work.png" width="14px" height="14px">
                    <p><?= $pareja->getTrabajo() ?></p>
                </div>
                <?php
            }
            
        }
        ?>
        
        <p class="test"><?= $pareja->getBio(); ?></p>
    </div>

    <div class="buttons-container">
        <a class="dislike" onclick="dislike(this)" href="#" id="dislike">
            <img src="assets/svg/dislike.svg">
        </a>
        <a class="like" onclick="like('<?= $pareja->getUsuario() ?>', this)" href="#" id="like">
            <img src="assets/svg/like.svg">
        </a>
    </div>
</div>
<?php
    }
?>