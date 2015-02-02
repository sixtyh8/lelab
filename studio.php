<?php
$metaTITLE['fr'] = 'Studio';
$metaTITLE['en'] = 'Studio';
$bodyClass = 'studio';

include 'includes/header.php';
?>

<div class="full-box">
	<div class="full-box-top"></div>
    	<div class="full-box-content">
    <?php if($_conf['translation']['lang'] == 'en'){ ?>
    
    	<!-- DÉBUT ANGLAIS -->
    
		<h2>Equipment</h2>
        <div class="column">
        	<h4>Monitor</h4>
            <ul>
            	
            	<li>Focal Grande Utopia EM</li>
        		<li>Focal Sub Utopia Be</li>
				<li>Focal SM8</li>
				<li>YBA Passion 1000</li>
				<li>Sennheiser Orpheus</li>
				<li>Sennheiser HD-600</li>
				<li>Sennheiser HD-650</li>
				<li>Sennheiser HD-700</li>
                <li>Sennheiser HD-800</li>
                <li>Beats Studio</li>
				<li>Grado RS-1</li>
				<li>Grace m906</li>
            </ul>
        </div>
        <div class="column">
        	<h4>Furniture</h4>
            <ul>
                <li>Sterling Modular</li>
                <li>Solidtech</li>
                <li>Herman Miller</li>
                <li>HAG</li>
            </ul>
            <h4>Transport</h4>
            <ul>
                <li>Ampex ATR-102</li>
                <li>Studer A807</li>
                <li>Oracle Delphi MK VI</li>
                <li>Tascam DV-RA1000</li>
                <li>Tascam DA-45HR</li>
            </ul>
        </div>
        <div class="column">
        	<h4>Analog Processor</h4>
            <ul>
                <li>Manley Labs</li>
                <li>Thermionic Culture</li>
                <li>George Massenburg Labs</li>
                <li>Shadow Hills</li>
                <li>Millenia Media</li>
                <li>D.W. Fearn</li>
                <li>Dangerous Music</li>
			</ul>

        	<h4>Room</h4>
            <ul>
                <li>20 Hz Control Room</li> 
                <li>design by Tom Hidley</li>
                <li>NEST thermostat</li>
            </ul>
        </div>


        <div class="column">
        	<h4>Digital Processor</h4>
			<ul>
                <li>TC  6000 (mastering)</li>
                <li>Weiss EQ1-DYN-LP</li>
                <li>Weiss DS1-MK3</li>
                <li>Z-sys z-CL6</li>
            </ul>
            
        	<h4>Power</h4>
            <ul>
                <li>Isolated Transformer</li>
                <li>Isolated Ground</li>
                <li>Current Technology Power Siftor</li>
                <li>Pure/AV PF-31</li>
            </ul>
        </div>
        <div class="column">
        	<h4>Converter</h4>
            <ul>
                <li>Lavry Gold AD-122 96 MK III</li>
                <li>DAD AX24</li>
            </ul>
            <h4>Daw</h4>
            <ul>
                <li>Samplitude pro X</li>
                <li>Protools v8 HD</li>
                <li>Sonoris DDP creator pro</li>
                <li>Izotope RX 3 Advanced</li>
            </ul>
        </div>
        
    <!-- FIN ANGLAIS -->
    
    <?php } else { ?>
    <!-- DÉBUT FRANÇAIS -->
    
    <h2>&Eacute;quipement</h2>
        <div class="column">
        	<h4>Moniteur</h4>
            <ul>
            	
            	<li>Focal Grande Utopia EM</li>
        		<li>Focal Sub Utopia Be</li>
				<li>Focal SM8</li>
				<li>YBA Passion 1000</li>
				<li>Sennheiser Orpheus</li>
				<li>Sennheiser HD-600</li>
				<li>Sennheiser HD-650</li>
				<li>Sennheiser HD-700</li>
                <li>Sennheiser HD-800</li>
                <li>Beats Studio</li>
				<li>Grado RS-1</li>
				<li>Grace m906</li>
            </ul>
        </div>
        <div class="column">
        	<h4>Meuble</h4>
            <ul>
                <li>Sterling Modular</li>
                <li>Solidtech</li>
                <li>Herman Miller</li>
                <li>HAG</li>
            </ul>
            <h4>Transport</h4>
            <ul>
                <li>Ampex ATR-102</li>
                <li>Studer A807</li>
                <li>Oracle Delphi MK VI</li>
                <li>Tascam DV-RA1000</li>
                <li>Tascam DA-45HR</li>
            </ul>
        </div>
        <div class="column">
        	<h4>Processeur Analogue</h4>
            <ul>
                <li>Manley Labs</li>
                <li>Thermionic Culture</li>
                <li>George Massenburg Labs</li>
                <li>Shadow Hills</li>
                <li>Millenia Media</li>
                <li>D.W. Fearn</li>
                <li>Dangerous Music</li>
			</ul>
            <h4>Room</h4>
            <ul>
                <li>20 Hz Control Room</li> 
                <li>design by Tom Hidley</li>
                <li>NEST thermostat</li>
            </ul>
 	
        </div>


        <div class="column">
        	<h4>Processeur num&eacute;rique</h4>
			<ul>
                <li>TC  6000 (mastering)</li>
                <li>Z-sys z-CL6</li>
                <li>Weiss EQ1-LP</li>
                <li>Weiss DS1-MK3</li>
            </ul>
            <h4>Alimentation</h4>
            <ul>
                <li>Isolated Transformer</li>
                <li>Isolated Ground</li>
                <li>Current Technology Power Siftor</li>
                <li>Pure/AV PF-31</li>
            </ul>
        </div>
        <div class="column">
        	<h4>ConvertisseurS</h4>
            <ul>
                <li>Lavry Gold AD-122 96 MK III</li>
                <li>DAD AX24</li>
            </ul>
            <h4>Daw</h4>
            <ul>
				<li>Samplitude pro X</li>
                <li>Protools v8 HD</li>
                <li>Sonoris DDP creator pro</li>
                <li>Izotope RX 3 Advanced</li>
            </ul>
        </div>
    
    <!-- FIN FRANÇAIS -->
    <?php } ?>
    </div>
    <div class="full-box-bottom"></div>
</div>

<?php
include 'includes/footer.php';
?>