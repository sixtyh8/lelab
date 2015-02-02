<?php
	$bodyClass = 'succursales';
	$bodyTitle = 'Succursales';
	include 'includes/header.php';
	include 'config/db_connection.php';
?>
<script type="text/javascript">
function resetVilles(){
	document.getElementById('select-villes').options[0].selected = 'selected';
	document.getElementById('search').submit();
}
</script>
<div id="top">
	<h2>Succursales</h2>
    <?php 
		dbConnect();
		
		if(isset($_GET['region']) && $_GET['region'] != 'null') $r = intval($_GET['region']);
		if(isset($_GET['ville']) && $_GET['ville'] != 'null') $v = intval($_GET['ville']);
		
		$regions = mysql_query("SELECT * FROM t_regions ORDER BY R_NAME ASC");
		
		if(isset($r)) $cities = mysql_query("SELECT * FROM t_cities WHERE C_REGION_FK=$r ORDER BY C_NAME ASC");
		else $cities = mysql_query("SELECT * FROM t_cities ORDER BY C_NAME ASC");
	?>
    <form id="search" action="" method="get">
    	<fieldset>
    	<label for="region">Recherche par r&eacute;gion</label>
        <select name="region" onchange="resetVilles();">
        	<option value="null">- R&eacute;gion -</option>
            <?php
			while($region = mysql_fetch_assoc($regions)){
				echo '<option value="'.$region['R_ID'].'"';
				if(isset($r) && $r == $region['R_ID']) echo ' selected="selected"';
				echo '>'.htmlentities($region['R_NAME']).'</option>'."\n";
			}
			?>
        </select>
        </fieldset>
        <fieldset>
    	<label for="ville">Recherche par ville</label>
        <select name="ville" id="select-villes" onchange="document.getElementById('search').submit();">
        	<option value="null">- Ville -</option>
        	<?php
			while($city = mysql_fetch_assoc($cities)){
				echo '<option value="'.$city['C_ID'].'"';
				if(isset($v) && $v == $city['C_ID']) echo ' selected="selected"';
				echo '>'.htmlentities($city['C_NAME']).'</option>'."\n";
			}
			?>
        </select>
        </fieldset>
        <a onclick="document.getElementById('search').submit();" class="submit"><span>Trouver</span></a>
    </form>
</div>

</div>

<div id="middle">
	<?php
		$regionName = 'Toutes les régions';
		if(isset($r)) {
			$rname = mysql_fetch_assoc(mysql_query("SELECT R_NAME FROM t_regions WHERE R_ID=$r"));
			$regionName = $rname['R_NAME'];
		}
	?>
	<h2><?php echo htmlentities($regionName); ?></h2>
<?php
	$req = "SELECT * FROM t_succursales, t_cities WHERE S_CITY_FK=C_ID";
	if(isset($r)) $req = "SELECT S_ID, S_NAME, S_ADDRESS, S_ZIP, S_MAP, S_PHONE, S_IMAGE, C_NAME FROM t_succursales, t_cities WHERE S_CITY_FK=C_ID AND C_REGION_FK=$r";
	if(isset($v)) $req = "SELECT * FROM t_succursales, t_cities WHERE S_CITY_FK=$v AND S_CITY_FK=C_ID";
	
	$res = mysql_query($req);
	
	while($succursale = mysql_fetch_assoc($res)){
		echo '<div class="succursale-box">'."\n";
		echo '<p class="succursale-address">'."\n";
		echo '<strong>'.htmlentities($succursale['S_NAME']).'</strong><br/>'."\n";
		echo htmlentities($succursale['S_ADDRESS']).'<br/>'."\n";
		echo htmlentities($succursale['C_NAME']).' (Qc)<br/>'."\n";
		echo $succursale['S_ZIP'].'&nbsp;'."\n";
		echo '</p>'."\n";
		echo '<p class="succursale-phone">'.$succursale['S_PHONE'].'</p>'."\n";
		if($succursale['S_MAP'] != '') echo '<a href="'.$succursale['S_MAP'].'" target="_blank">';
		echo '<img width="327" height="221" class="succursale-map" src="'.$_conf['path']['base_url'].'img/succursales/maps/'.$succursale['S_IMAGE'].'" alt="carte" />'."\n";
		if($succursale['S_MAP'] != '') echo '</a>';
		echo '</div>'."\n";
	}
?>
</div>

<div id="bottom">

</div>
<?php
	include 'includes/footer.php';
?>