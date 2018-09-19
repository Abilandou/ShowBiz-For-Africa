jQuery(document).ready(function ($) {

    jQuery('div#related_posts .post-article').matchHeight({ byRow: true });

	//
	// Owl Carousel
	$('#eblog_lite_main_slider').owlCarousel({
		loop:true,
		margin:0,
		dots : false,
		nav: true,
		navText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
		autoplay : true,
		responsive:{
			0:{
				items:1
			},
			992:{
				items:2
			},
		}
	});
	
    
});
