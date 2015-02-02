<?php
$metaTITLE['fr'] = 'E-Mastering';
$metaTITLE['en'] = 'E-Mastering';
$bodyClass = 'e-mastering';

include '../includes/header.php';
?>
<div class="right-box" id="e-mastering-box">
	<div class="right-box-top"></div>
    <div class="right-box-content">
    	<?php if($_conf['translation']['lang'] == 'en'){ ?>
            <h2>File Upload</h2>
            <p>You can securely upload your files here:</p>
            <a id="webcargo" href="https://www.webcargo.net/request/index/id/4330987/dp/06C23dgxEpz7UXqRBH" target="_blank">Upload</a>      
        <?php } else { ?>
            <h2>Transfert de Fichier</h2>
            <p>Vous pouvez nous transf&eacute;rer vos fichiers de fa&ccedil;on s&eacute;curitaire:</p>
            <a id="webcargo" href="https://www.webcargo.net/request/index/id/4330987/dp/06C23dgxEpz7UXqRBH" target="_blank">Transf&eacute;rer</a>
        <?php } ?>
    </div>
    <div class="right-box-bottom"></div>
</div>

<?php
include '../includes/footer.php';
?>