var adminHeight;

jQuery(window).on('load resize', function() {
	adminHeight = jQuery('#wpadminbar').outerHeight();
	var winHeight = jQuery(window).outerHeight();
	var headerActuallHeight;
	if(jQuery(window).width() > 1024) {
		var headerActuallHeight = jQuery('#masthead').outerHeight();
	} else {
		var headerActuallHeight = jQuery('#mblheader').outerHeight();
	}
	var remHeight = parseInt(winHeight) - parseInt(headerActuallHeight);
	jQuery('.hs-static-newsletter-banner:not(.header-layout-two):not(.header-layout-six) .site-banner .wp-custom-header').css('padding-top', remHeight);    
});