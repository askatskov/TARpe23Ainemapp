( function( $ ) {
	$(document).ready(function() {

		$(".ovrly-menu").click( function() {
			 $(".ovrly").css("height", "100%");
		})

		$(".ovrly-menu-closebtn").click( function() {
			 $(".ovrly").css("height", "0");
		})
			
	});
} )( jQuery );