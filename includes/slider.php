<script type="text/javascript">
		<?php
		// require $_SERVER['DOCUMENT_ROOT']."/api/plugins/medoo.php";

		$string = file_get_contents("http://api.lelabmastering.com/credits");
		$string = utf8_encode($string);

		// $file = $_SERVER['DOCUMENT_ROOT']."/api/credits.json";

		// Read JSON file
		// $string = utf8_encode(file_get_contents($file, FILE_USE_INCLUDE_PATH));
		$covers = json_decode($string, true);

		// $database = new medoo(array(
		// 	'database_type' => 'sqlite',
		// 	'database_file' => $_SERVER['DOCUMENT_ROOT'].'/api/data/lelab.db'
		// ));

		// $covers = $database->select('credits', 
		// 	array(
		// 		'[>]credit_images' => array('image' => 'id'),
		// 		'[>]trophies' => array('trophy' => 'trophy_id')
		// 	),
		// 	'*'
		// );

		shuffle($covers);

		$slide = 1;
		$index = 1;
		$var1 = count($covers)-1;
		$var2 = $var1-4;

		$slides = "";
		$slides .= "<ul class='list'>";
		$slidesData = array();
		
		// Loop through each cover
		foreach($covers as $key => $cover) {

			$slides .= '<li class="cover"><span class="title">'.$cover['album_name'].'<br /><span class="artist">'.$cover['artist_name'].'</span><br /><span class="year">'.$cover['year'].'</span></span>';

			if($cover['trophy_name']){
				$slides .= '<div class="award"><i class="fa fa-trophy"></i> '. $cover['trophy_name'] .' - '. $cover['trophy_year'] .'</div>';
			};

			$slides .= '<img class="lazy" src="/img/grey.gif" data-original="/cdn/images/credits/'.$cover['thumb_name'].'" width="155" height="155" /></li>';
		}

		$slides .= "</ul>";
		?>

		$(function(){

			// $('img.lazy').each(function(){
			// 	var src = $(this).attr('data-original');
			// 	$(this).attr("src", src).stop(true,true).hide().fadeIn();
			// });

			var $replaceSrc = function() { 
			    var $this = $("#slider-lists ul");

			    var items = $this.triggerHandler("currentVisible");
			    
			    items.each(function(){
			    	var src = $(this).children('img').attr('data-original');
			    	$(this).children('.award').show();
			    	$(this).children('img').attr("src", src).stop(true,true).hide().fadeIn();
			    });
			};

			$("#slider-lists ul").carouFredSel({
				items: {
					visible: 5,
					minimum: 5
				},
				scroll: {
					fx: "crossfade",
					duration: 1000,
					pauseOnHover: true,
					onAfter: $replaceSrc
				},
				onCreate: $replaceSrc,
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