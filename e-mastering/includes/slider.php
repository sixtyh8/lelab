<script type="text/javascript">
		<?php
		
		// Read JSON file
		$string = utf8_encode(file_get_contents("credits.json", FILE_USE_INCLUDE_PATH));
		$covers = json_decode($string, true);
		
		shuffle($covers);
		
		$slide = 1;
		$index = 1;
		$var1 = count($covers)-1;
		$var2 = $var1-4;
		
		$slides = "";
		$slides .= "<ul class='list'>";	
		$slidesData = array();
		foreach($covers as $key => $cover) {
			$slides .= '<li class="cover"><span class="title">'.$cover['album'].'<br /><span class="artist">'.$cover['artist'].'</span><br /><span class="year">'.$cover['year'].'</span></span><img class="lazy" src="../img/grey.gif" data-original="'.$_conf['path']['base_url'].'img/credits/'.$cover['image'].'" width="155" height="155" /></li>';
		}
		$slides .= "</ul>";
		?>

		$(function(){

			$('img.lazy').each(function(){
				var src = $(this).attr('data-original');
				$(this).attr("src", src).stop(true,true).hide().fadeIn();
			});

			$("#slider-lists ul").carouFredSel({
				items: {
					visible: 5,
					minimum: 5
				},
				scroll: {
					fx: "crossfade",
					duration: 1000,
					pauseOnHover: true
				},
				auto: 6000,
				next: {
					button: "#slider-next",
					key: "right"
				},
				prev: {
					button: "#slider-prev",
					key: "left"
				}
			});

		});
		</script>
<div class="containerSlider" style="height: 189px;width:916px;text-align:center;border: 2px solid #333;background-color: black;margin-bottom:22px;">
<div id="slider" style="">
    <div id="slider-lists">
    <?php
   		echo $slides;
	?>
    </div>
    
    <a href="#" id="slider-prev" class="unslider-arrow prev"><img src="<?php echo $_conf['path']['base_url']; ?>img/slider-prev.png" alt="" /></a>
    <a href="#" id="slider-next" class="unslider-arrow next"><img src="<?php echo $_conf['path']['base_url']; ?>img/slider-next.png" alt="" /></a>
</div>
</div>