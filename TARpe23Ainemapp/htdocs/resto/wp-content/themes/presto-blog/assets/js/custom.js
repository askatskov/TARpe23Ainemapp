var adminHeight = jQuery('#wpadminbar').outerHeight();
jQuery(document).ready(function($){

	$('.header-search .search-toggle').on( 'click', function(e) {
		e.stopPropagation();
		$(this).siblings('.header-search-wrap').fadeIn();
	});

	$('.header-search-wrap .close').on( 'click', function(e) {
		e.stopPropagation();
		$(this).parents('.header-search-wrap').fadeOut();
	});

	$(window).on('keyup', function(e) {
		if(e.key == 'Escape') {
			$('.header-search .header-search-wrap').fadeOut();
		} 
	});

	$('.popular-search-cat ul li a').on( 'click', function() {
		$(this).parents('li').siblings('li').removeClass('active');
		$(this).parents('li').addClass('active');
	});

	$('.menu-item-has-children').find('> a').after('<button class="submenu-toggle"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="var(--st-heading-color)" d="M441.9 167.3l-19.8-19.8c-4.7-4.7-12.3-4.7-17 0L224 328.2 42.9 147.5c-4.7-4.7-12.3-4.7-17 0L6.1 167.3c-4.7 4.7-4.7 12.3 0 17l209.4 209.4c4.7 4.7 12.3 4.7 17 0l209.4-209.4c4.7-4.7 4.7-12.3 0-17z"></path></svg></button>');

	$('.mbl-header-utilities .toggle-button').on( 'click', function() {
		$(this).siblings('.mbl-primary-menu-list').animate({
			'width': 'toggle',
		});
	});

	$('.mbl-header-utilities .close').on( 'click', function() {
		$(this).parents('.mbl-primary-menu-list').animate({
			'width': 'toggle',
		});
	});

	$('.submenu-toggle').on( 'click', function() {
		$(this).toggleClass('active');
		$(this).siblings('.sub-menu').stop(true, false, true).slideToggle();
	});

	//go to top
	$(window).on( 'scroll', function() {
		if($(this).scrollTop() > 100) {
			$('.goto-top').addClass('active');
		} else {
			$('.goto-top').removeClass('active');
		}
	});

	$('.goto-top').on( 'click', function() {
		$('body, html').animate({
			scrollTop: 0,
		}, 700);
	});

	//custom input type number for woocommerce
	jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
    jQuery('.quantity').each(function() {
      var spinner = jQuery(this),
        input = spinner.find('input[type="number"]'),
        btnUp = spinner.find('.quantity-up'),
        btnDown = spinner.find('.quantity-down'),
        min = input.attr('min'),
        max = input.attr('max');

      btnUp.click(function() {
        var oldValue = parseFloat(input.val());
        var newVal = oldValue + 1;
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
      });

      btnDown.click(function() {
        var oldValue = parseFloat(input.val());
        if (oldValue <= min) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue - 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
      });

    });

	//for add focus on menu item
	$('.menu li').find('> a').on('focus', function() {
		$(this).parents('li').addClass('focus');
	}).on( 'blur', function() {
		$(this).parents('li').removeClass('focus');
	});

}); //document close

//gutenberg full width and wide layout
jQuery(window).on('load resize', function() {

	//insert secondary menu item inside main navigation
	jQuery('.mobile-header .secondary-navigation ul.menu > li').insertAfter('.mobile-header ul.menu:not(.secondary-menu) > li:last-child').addClass('secondary-item');
    
    var windowRightSide = jQuery(window).width();
    var subMenuPosition;

    jQuery('.menu .sub-menu').each(function () {
        subMenuPosition = jQuery(this).offset().left + jQuery(this).width();
        if (subMenuPosition >= windowRightSide) {
            jQuery(this).addClass('push-left');
        } else {
            jQuery(this).removeClass('push-left');
        }
    });

	var winHeight = jQuery(window).outerHeight();
	var headerActuallHeight;
	if(jQuery(window).width() > 1024) {
		var headerActuallHeight = jQuery('#masthead').outerHeight();
	} else {
		var headerActuallHeight = jQuery('#mblheader').outerHeight();
	}
	var remHeight = parseInt(winHeight) - parseInt(headerActuallHeight);
	jQuery('.hs-static-banner.static-banner-layout-one .site-banner .wp-custom-header').css('padding-top', remHeight);

    //for gutenberg blocks
    var winWidth = jQuery('#content').outerWidth();
    var containerWidth = jQuery('.site-content > .container').width();
    var contentWidth = jQuery('.site-main article .entry-content').width();
    var CareaWidth = jQuery('.fullwidth-centered .content-area').width();
    var winContainerSum = (parseInt(containerWidth) - parseInt(winWidth)) / 2;
	var winContainerSum1 = (parseInt(contentWidth) - parseInt(winWidth)) / 2;
	var winContainerSum3 = (parseInt(CareaWidth) - parseInt(winWidth)) / 2;
	
    //for align wide
    var containerHalfW = (parseInt(contentWidth) - parseInt(containerWidth)) / 2;
	
    //for single page
	jQuery('.full-width:not(.single-post) .entry-content .alignfull, .single-post.full-width .entry-content:first-child .alignfull').css({
		'width': winWidth,
		'max-width': winWidth,
		'margin-left': winContainerSum,
	});
	
	jQuery('.fullwidth-centered:not(.single-post) .entry-content .alignfull').css({
		'width': winWidth,
		'max-width': winWidth,
		'margin-left': winContainerSum3,
	});

	jQuery('.fullwidth-centered:not(.single-post) .entry-content .alignwide').css({
		'width': containerWidth,
		'max-width': containerWidth,
		'margin-left': containerHalfW,
	});
	
	jQuery('.single-post.fullwidth-centered .entry-content:first-child .alignfull').css({
		'width': winWidth,
		'max-width': winWidth,
		'margin-left': winContainerSum1,
	});
	
	
	jQuery('.single-post.full-width .floating-metas + .entry-content .alignfull, .single-post.fullwidth-centered .floating-metas + .entry-content .alignfull').css({
		'width': winWidth,
		'max-width': winWidth,
		'margin-left': winContainerSum1,
	});

	jQuery('.fullwidth-centered .floating-metas +.entry-content .alignwide').css({
		'width': containerWidth,
		'max-width': containerWidth,
		'margin-left': containerHalfW,
	});
});

var headerHeight;
jQuery(window).on('load resize scroll', function() {
    headerHeight = jQuery('.site-header').outerHeight() + 20;
    
    if(jQuery('body').hasClass('single-post')) {
        var mainOffset = jQuery('.single-post .site-main').offset().top;
        var contentHeight = jQuery('.single-post .site-main .content-wrap').outerHeight();
        if(jQuery(window).scrollTop() > mainOffset && jQuery(window).scrollTop() < contentHeight) {
            jQuery('.single .site-main .nav-links > div').fadeIn();
        } else if(jQuery(window).scrollTop() > contentHeight) {
            jQuery('.single .site-main .nav-links > div').fadeOut();
        } else {
            jQuery('.single .site-main .nav-links > div').fadeOut();
        }
    }
});