// On Document Load
jQuery(window).load(function(){
    //site loader
    jQuery('#wraploader').hide();
});

// On Document Ready
jQuery(document).ready(function ($) {
  
    // Full Navigation
    $('#menu-toggle').click(function(){
      $('.site-header-menu').css({'transform':'scale(1)','borderRadius':'0'});
    });

    $('#menu-toggle-close').click(function(){
      $('.site-header-menu').css({'transform':'scale(0)','borderRadius':'100%'});
    });

    // hoverdir
    jQuery(' #da-thumbs section > li ').each( function() { 
      $(this).hoverdir();
    });

    /*wow jQuery*/
    wow = new WOW({
        boxClass: 'evision-animate'
      }
    )

    wow.init();

    // slick jQuery 
    jQuery('.carousel-group').slick({
      autoplay: true,
      autoplaySpeed: 3000,
      dots: true,
      slidesToShow: 4,
      slidesToScroll: 1,
      lazyLoad: 'ondemand',
      responsive: [
         {
           breakpoint: 1024,
           settings: {
             slidesToShow: 3,
             slidesToScroll: 3,
             infinite: true,
             dots: true
           }
         },
         {
           breakpoint: 768,
           settings: {
             slidesToShow: 2,
             slidesToScroll: 2
           }
         },
         {
           breakpoint: 481,
           settings: {
             slidesToShow: 1,
             slidesToScroll: 1
           }
         }
         // You can unslick at a given breakpoint now by adding:
         // settings: "unslick"
         // instead of a settings object
       ]
    });

    // back to top animation

    $('#gotop').click(function(){
      $('body').animate({scrollTop: '0px'},1000);
    });

    // header fix
    $(window).scroll(function() {
      
      var fixedBackgroundColor = 'rgba(0,0,0,0.7)',
          scrollTopPosition    = $('body').scrollTop(),
          selectedHeader       = $('.wrapper-site-identity'),
          defaultHeaderCss     = {
                                   'backgroundColor' : 'transparent'
                                 },
          selectedHeaderHidden = $(selectedHeader).find('.site-description');

      selectedHeader.css( defaultHeaderCss);
      selectedHeaderHidden.show();

      if( scrollTopPosition > 5 ){
        defaultHeaderCss.backgroundColor = fixedBackgroundColor;
        selectedHeaderHidden.display = 'none';

        selectedHeader.css( defaultHeaderCss );
        selectedHeaderHidden.hide();
      }
      

      // back to top button visible on scroll
      if( scrollTopPosition > 240 ) {
        $('#gotop').css({'bottom': 25});
      } else {
        $('#gotop').css({'bottom': -100});
      }
    });
});