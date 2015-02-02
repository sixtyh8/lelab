<?php

$metaTITLE['fr'] = 'Accueil';
$metaTITLE['en'] = 'Home';
$bodyClass = 'home';

include 'includes/header.php';
?>

<!-- <script language="javascript" type="text/javascript" src="http://www.onbile.com/redirection/jtzh7q8o803jjd9kvqmyx96wvbqz771hl74bg95mkjlokeqcy1"></script> -->

<div class="full-box">
	<div class="full-box-top"></div>
    <div class="full-box-content no-background no-minheight" style="padding-bottom:40px;">
    <?php if($_conf['translation']['lang'] == 'en'){ ?>
    
    	<!-- DÉBUT ANGLAIS -->
    
    	<h2>Welcome to Le Lab Mastering Montreal</h2>
        <p>Le Lab Mastering has become what it is today through its devotion to music, artists and producers alike. Founded through decades of experience and an unconditional passion for audio, our team of engineers has an understanding of music that reaches far beyond just the technical aspects of mastering. Keeping the quality of your music as our focus, we will make sure it leaves our studio in its best presentation possible.</p>
        <p>Incorporating a precise and truly transparent monitoring design, we provide an environment unlike any other facility. The neutral sonic landscape of our room presents your mixes in the clearest detail, allowing us to hear your music without added artefacts. Coupled with state of the art equipment and a top quality analog and digital signal path, we have the tools at our disposal to take your music exactly where it needs to be.</p>
        
        <!-- FIN ANGLAIS -->
        
    <?php } else { ?>
    	<!-- DÉBUT FRANÇAIS -->
        
        <h2>Bienvenue au studio Le Lab Mastering Montreal</h2>
        <p>Le Lab Mastering est le r&eacute;sultat d'une d&eacute;votion pour la musique, les artistes et les producteurs.  Des dizaines d'ann&eacute;es d'exp&eacute;rience cumul&eacute;es ainsi qu'une passion inconditionnelle pour l'audio constituent l'&eacute;nergie motrice de notre &eacute;quipe qui participe bien au-del&agrave; de la technicit&eacute; du mastering.  Notre mission est de s'assurer que votre musique se d&eacute;voile sous son meilleur jour tout en maintenant son caract&egrave;re distinctif.</p>
        <p>Avec un syst&egrave;me d'&eacute;coute d'une pr&eacute;cision et d'une transparence in&eacute;gal&eacute;es dans un environnement unique, nos installations r&eacute;v&egrave;lent les moindres d&eacute;tails de vos productions avec une clart&eacute; sans artifices. Notre &eacute;quipement analogique et num&eacute;rique &agrave; la fine pointe se joint &agrave; notre expertise pour finaliser le cheminement de vos cr&eacute;ations.</p>


        <!-- FIN FRANÇAIS -->
    <?php } ?>
    </div>
    <div class="full-box-bottom"></div>
</div>

<?php
include 'includes/footer.php';
?>