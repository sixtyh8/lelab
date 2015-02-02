<div id="footer">
	<div class="full-box">
        <div class="full-box-top"></div>
        <div class="full-box-content no-background no-minheight">
        	<ul id="social-networks">
            	<li><strong> <?php echo $_conf['translation']['lang'] == 'en' ? 'Follow us on' : 'Suivez-nous sur'; ?></strong></li>
            	<li><a href="http://www.facebook.com/profile.php?id=100001874943692" target="_blank"><img src="<?php echo $_conf['path']['base_url']; ?>img/facebook-icon.png" alt="Facebook" /></a></li>
    			<li><a href="http://twitter.com/#!/LeLabMastering" target="_blank"><img src="<?php echo $_conf['path']['base_url']; ?>img/twitter-icon.png" alt="Twitter" /></a></li>
    			<li><a href="http://www.youtube.com/lelabmastering" target="_blank"><img src="<?php echo $_conf['path']['base_url']; ?>img/youtube-icon.png" alt="YouTube" /></a></li>
            </ul>
        </div>
        <div class="full-box-bottom"></div>
    </div>

	<div id="footer-container">
	<ul id="footer-menu">
        <li><a href="<?php echo $_conf['path']['base_url'].$_conf['translation']['lang'].'/'; ?>" <?php if($bodyClass == 'home') echo 'class="selected"'?>><?php echo MAIN_MENU_HOME; ?></a></li>
        <li><a href="<?php echo $_conf['path']['base_url'].$_conf['translation']['lang'].'/'; ?>studio" <?php if($bodyClass == 'studio') echo 'class="selected"'?>><?php echo MAIN_MENU_STUDIO; ?></a></li>
        <li><a href="<?php echo $_conf['path']['base_url'].$_conf['translation']['lang'].'/'; ?>engineers" <?php if($bodyClass == 'engineers') echo 'class="selected"'?>><?php echo MAIN_MENU_ENGINEERS; ?></a></li>
        <li><a href="<?php echo $_conf['path']['base_url'].$_conf['translation']['lang'].'/'; ?>mastering" <?php if($bodyClass == 'mastering') echo 'class="selected"'?>><?php echo MAIN_MENU_MASTERING; ?></a></li>
        <li><a href="/album-credits.php" <?php if($bodyClass == 'credits') echo 'class="selected"'?>>Credits</a></li>
        <li><a href="<?php echo $_conf['path']['base_url'].$_conf['translation']['lang'].'/'; ?>contact" <?php if($bodyClass == 'contact') echo 'class="selected"'?>><?php echo MAIN_MENU_CONTACT; ?></a></li>
    </ul>
    <a href="<?php echo $_conf['path']['base_url'].$_conf['translation']['lang'].'/'; ?>" id="footer-logo"><img src="<?php echo $_conf['path']['base_url']; ?>img/footer-logo.png" alt="Lab Mastering" title="Lab Mastering" /></a>
    </div>
</div>
<div id="legal"><?php echo LEGAL_TEXT; ?></div>
</div>
</div>

<div id="myModal" class="reveal-modal">
    <?php if($_conf['translation']['lang'] == 'en'){ ?>
        <h2>Mastered for iTunes</h2>
        <p><b>Le Lab Mastering</b> was one the first Mastering studio to work with Apple on workflow and practices for mastering audio especially for encoded music.</p>
        <p>With their Mastered for iTunes (MFiT),  Apple has released a new generation of AAC encoding tools that accept hi-resolution PCM sources.</p>
        <a class="close-reveal-modal">&#215;</a>
    <?php } else { ?>
        <h2>Mastered for iTunes</h2>
        <p>Le Lab Mastering est l’un des premier studio de mastering à travailler avec Apple sur les procédés et les pratiques de mastering spécifiquement pour la musique compressés.</p>
        <p>Avec leur "Mastered for iTunes" (MFIT), Apple a sorti une nouvelle génération d'outils d'encodage AAC qui acceptent les sources "PCM" haute-résolution.</p>
        <a class="close-reveal-modal">&#215;</a>
    <?php } ?>
</div>

</body>
</html>