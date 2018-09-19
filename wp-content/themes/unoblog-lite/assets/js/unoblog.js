jQuery(document).ready(function($) {

	"use strict";
	
	// Search
	
	$('#top-search a').on('click', function ( e ) {
		e.preventDefault();
    	$('.show-search').slideToggle('fast');
    });
	
	// Scroll to top
	
	$('.to-top').click(function(){
		$('html, body').animate({scrollTop : 0},800);
		return false;
	});
	
	
	// Menu
	$('#navigation .menu').slicknav({
		prependTo:'.menu-mobile',
		label:''
	});

	
	
});
