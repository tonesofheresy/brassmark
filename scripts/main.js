	// JavaScript Document

$(window).bind("load", function() {
	
	$('#header').attr('style', 'visibility: visible');
	
	$('#rotating').anythingSlider({
	   autoPlay            	: true, 
	   width               	: 968,
	   height              	: 253,
	   buildArrows         	: false,
	   startStopped        	: false,
	   buildNavigation     	: false,
	   enablePlay          	: false,
	   delay               	: 4000,
	   animationTime       	: 1300,
	   pauseOnHover			: false,
	   easing				: "easeInOutExpo"
	});	

	
});