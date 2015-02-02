// JavaScript Document

var offset = 920;
var speed = 800;
var slide = 1;
var slideWay = 'right';
var timer;
var timeInterval = 8000;
var sliding = false;
$(window).load(function(){	$('.loader').fadeOut('fast',function(){		$('#slider').fadeIn();	});	});$('#slider').hide();
init();

function init(){
	$('.list').hide();
	
	$('#s' + slide).show();
	
	$('.cover, #slider-prev, #slider-next').mouseover(function(){
		stopSlider();
		$(this).children('.title').show();				
	});
	$('.cover, #slider-prev, #slider-next').mouseout(function(){
		fastStartSlider();
		$(this).children('.title').hide();				
	});
	
	startSlider();
}

function startSlide(way){
	sliding = true;
	stopSlider();
	if(way == undefined) way = slideWay;
	slideWay = way;
	
	if(slideWay == undefined) alert('error');
	
	$('#slider-prev, #slider-next').hide();
	$('#slider-prev, #slider-next').fadeIn(speed*2);
	var next = '';
	if(slideWay == 'left'){
		$('#s'+slide).animate({"left" : "-="+offset+"px"}, speed, function(){sliding = false;});
		
		if(slide == maxSlide) next = $('#s1');
		else next = $('#s'+(slide + 1));
		
		next.show();
		next.css('left', offset + 'px');
		next.animate({"left" : "-="+offset+"px"}, speed);
		
		if(slide == maxSlide) slide = 1;
		else slide++;
	}
	else{
		$('#s'+slide).animate({"left" : "+="+offset+"px"}, speed, function(){sliding = false;});
		
		if(slide == 1) next = $('#s' + maxSlide);
		else next = $('#s'+(slide - 1));
		
		next.show();
		next.css('left', '-' + offset + 'px');
		next.animate({"left" : "+="+offset+"px"}, speed);
		
		if(slide == 1) slide = maxSlide;
		else slide--;
	}
	startSlider();
}

function startSlider(){
	clearInterval(timer);
	timer = setInterval('startSlide()', timeInterval);	
}

function fastStartSlider(){
	if(!sliding){
		clearInterval(timer);
		timer = setInterval('startSlide()', 2000);	
	}
}

function stopSlider(){
	clearInterval(timer);
}