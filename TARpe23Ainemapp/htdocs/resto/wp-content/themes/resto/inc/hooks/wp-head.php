<?php
if( ! function_exists( 'resto_wp_head' ) ) :
    /**
     * resto wp_head hook
     *
     * @since  resto 1.0.0
     */
    function resto_wp_head(){
        global $resto_customizer_all_values;
        global $resto_google_fonts;
        $resto_background_color = get_background_color();
        $resto_footer_background_color = $resto_customizer_all_values['resto-footer-background-color'];
        $resto_bredcrumb_background_color = $resto_customizer_all_values['resto-bredcrumb-background-color'];
        $resto_site_identity_color_option = $resto_customizer_all_values['resto-site-identity-color'];
        $resto_menu_color = $resto_customizer_all_values['resto-menu-color'];
        $resto_primary_color = $resto_customizer_all_values['resto-primary-color'];
        $resto_primary_hover_color = $resto_customizer_all_values['resto-primary-hover-color'];
        $resto_banner_text_color = $resto_customizer_all_values['resto-banner-text-color'];
        $resto_title_color = $resto_customizer_all_values['resto-title-color'];
        $resto_body_text_color = $resto_customizer_all_values['resto-body-text-color'];
        $resto_link_color = $resto_customizer_all_values['resto-link-color'];
        $resto_button_backgorund_color = $resto_customizer_all_values['resto-button-backgorund-color'];
        $resto_button_text_color = $resto_customizer_all_values['resto-button-text-color'];
       

       /*font settings*/
       $resto_font_family_Primary = $resto_google_fonts[$resto_customizer_all_values['resto-font-family-Primary']];
       $resto_font_family_site_identity = $resto_google_fonts[$resto_customizer_all_values['resto-font-family-site-identity']];
       $resto_font_family_heading = $resto_google_fonts[$resto_customizer_all_values['resto-font-family-heading']];
       $resto_font_family_title = $resto_google_fonts[$resto_customizer_all_values['resto-font-family-title']];
       
		/*inner banner image*/
        $resto_banner_image = $resto_customizer_all_values['resto-default-banner-image'];
        ?>
        <style type="text/css">
        /*=====COLOR OPTION=====*/

        /*Color*/
        /*----------------------------------*/
        /*background color*/ 
	        <?php 
	        if( !empty($resto_background_color) ){
	        ?>
	          html,body {
	            background-color: #<?php echo esc_attr( $resto_background_color );?>;
	          }
	        <?php
	        } 
	        
	        /*resto footer background color*/
	        if( !empty($resto_footer_background_color) ){
	        ?>  
	            .wrap-footer {
	              background-color: <?php echo esc_attr( $resto_footer_background_color );?>;
	            }

	        <?php
	        }

	        /*resto bredcrumb background color*/
	        if( !empty($resto_bredcrumb_background_color) ){
	        ?>  
	           	.wrap-breadcrumb {
	              background-color: <?php echo esc_attr( $resto_bredcrumb_background_color );?>;
	            }

	        <?php
	        }

	        /*resto site identity color option*/
	        if( !empty($resto_site_identity_color_option) ){
	        ?>  
	            .site-header .wrapper-site-identity .site-title a,
            	.site-header .wrapper-site-identity .site-description {
	              color: <?php echo esc_attr( $resto_site_identity_color_option );?>;
	            }

	        <?php
	        }

	        /*resto menu color*/
	        if( !empty($resto_menu_color) ){
	        ?>  
	            @media screen and (min-width: 1200px){
		           .main-navigation ul li > a,
		           .main-navigation ul li > a:visited {
	                	color: <?php echo esc_attr( $resto_menu_color );?>;
	               }
	            }

	        <?php
	        }

	        /*resto primary color*/
	        if( !empty($resto_primary_color) ){
	        ?>  
		        .widget_calendar tbody a,
		        .widget_calendar tbody a:visited,
		        .evision-back-to-top, .evision-back-to-top:focus,
		        .evision-back-to-top:visited,
		        .widget .search-form .search-submit,
		        .widget .search-form .search-submit:focus,
		        .widget .search-form .search-submit:hover,
		        .wrapper-portfolio .da-thumbs li a div.content, .wrapper-portfolio .da-thumbs li a:visited div.content {
		           background-color: <?php echo esc_attr( $resto_primary_color );?>;
		        }

	            .widget .widgettitle,
	            .widget .widget-title,
	            .wrapper-about{
	              border-color: <?php echo esc_attr( $resto_primary_color );?>;
	            }

	            .alt-title span, 
	            .alt-title .page-links a, 
	            .page-links .alt-title a{
	            	color: <?php echo esc_attr( $resto_primary_color );?>;
	            }

	        <?php
	        }

	        /*resto primary hover color*/
	        if( !empty($resto_primary_hover_color) ){
	        ?>  
	            a:hover,
	            a:focus,
	            a:active,
	            h1 a:hover,
	            h1 a:focus,
	            h1 a:active,
	            h2 a:hover,
	            h2 a:focus,
	            h2 a:active,
	            h3 a:hover,
	            h3 a:focus,
	            h3 a:active,
	            h4 a:hover,
	            h4 a:focus,
	            h4 a:active,
	            h5 a:hover,
	            h5 a:focus,
	            h5 a:active,
	            h6 a:hover,
	            h6 a:focus,
	            h6 a:active,
	            .site-header .wrapper-site-identity .site-title a:hover,
	            .site-header .wrapper-site-identity .site-title a:focus,
	            .site-header .wrapper-site-identity .site-title a:active,
	            .contact-widget ul li a:hover,
	            .contact-widget ul li a:focus,
	            .contact-widget ul li a:active,
	            .contact-widget ul li a:hover i,
	            .contact-widget ul li a:focus i,
	            .contact-widget ul li a:active i,
	            .site-title a:hover,
	            .site-title a:focus,
	            .site-title a:active,
	            .wrapper-slider .slide-item .banner-title a:hover, 
	            .wrapper-slider .slide-item .banner-title a:focus, 
	            .wrapper-slider .slide-item .banner-title a:active, 
	            .wrapper-slider .slide-item .banner-title a:visited:hover,
	            .wrapper-slider .slide-item .banner-title a:visited:focus, 
	            .wrapper-slider .slide-item .banner-title a:visited:active,
	            .banner-title.alt-title span:hover,
	            .banner-title.alt-title span:focus,
	            .banner-title.alt-title span:active,
	            .banner-title.alt-title .page-links a:hover,
	            .banner-title.alt-title .page-links a:focus,
	            .banner-title.alt-title .page-links a:active,
	            .page-links .alt-title a:hover,
	            .page-links .alt-title a:focus,
	            .page-links .alt-title a:active,
	            .posted-on a:hover,
	            .posted-on a:focus,
	            .posted-on a:active,
	            .cat-links a:hover,
	            .cat-links a:focus,
	            .cat-links a:active,
	            .tags-links a:hover,
	            .tags-links a:focus,
	            .tags-links a:active,
	            .author a:hover,
	            .author a:focus,
	            .author a:active,
	            .comments-link a:hover,
	            .comments-link a:focus,
	            .comments-link a,
	            .edit-link a:hover,
	            .edit-link a:focus,
	            .edit-link a:active,
	            .nav-links .nav-previous a:hover,
	            .nav-links .nav-previous a:focus,
	            .nav-links .nav-previous a:active,
	            .nav-links .nav-next a:hover,
	            .nav-links .nav-next a:focus,
	            .nav-links .nav-next a:active,
	            .search-form .search-submit:hover,
	            .search-form .search-submit:focus,
	            .search-form .search-submit:active,
	            .widget li a:hover,
	            .widget li a:focus,
	            .widget li a:active,
	            .site-footer .site-info a:hover,
	            .site-footer .site-info a:focus,
	            .site-footer .site-info a:active{
	                color: <?php echo esc_attr( $resto_primary_hover_color );?>;
	              }

	              @media screen and (min-width: 1200px){
	                  .main-navigation a:hover, 
	                  .main-navigation a:focus, 
	                  .main-navigation a:active,
	                  .main-navigation a:visited:hover,
	                  .main-navigation a:visited:focus,
	                  .main-navigation a:visited:active,
	                  .main-navigation ul li a:hover,
	                  .main-navigation ul li a:focus,
	                  .main-navigation ul li a:active {
	                    color: <?php echo esc_attr( $resto_primary_hover_color );?>;
	                }
	              }

	              .wrapper-slider .controls #slide-prev i:hover, 
	              .wrapper-slider .controls #slide-prev i:focus, 
	              .wrapper-slider .controls #slide-prev i:active, 
	              .wrapper-slider .controls #slide-prev i:visited:hover, 
	              .wrapper-slider .controls #slide-prev i:visited:focus, 
	              .wrapper-slider .controls #slide-prev i:visited:active, 
	              .wrapper-slider .controls #slide-next i:hover, 
	              .wrapper-slider .controls #slide-next i:focus, 
	              .wrapper-slider .controls #slide-next i:active, 
	              .wrapper-slider .controls #slide-next i:visited:hover, 
	              .wrapper-slider .controls #slide-next i:visited:focus, 
	              .wrapper-slider .controls #slide-next i:visited:active
	              .wrapper-slider .slide-pager span:hover,
	              .widget_calendar tbody a:hover,
	              .widget_calendar tbody a:focus,
	              .widget_calendar tbody a:active,
	              .evision-back-to-top:hover,
	              .evision-back-to-top:focus,
	              .evision-back-to-top:active{
	                background-color:<?php echo esc_attr( $resto_primary_hover_color );?>;
	              }

	              .nav-links .nav-previous a:hover,
	              .nav-links .nav-previous a:focus,
	              .nav-links .nav-previous a:active,
	              .nav-links .nav-next a:hover,
	              .nav-links .nav-next a:focus,
	              .nav-links .nav-next a:active,
	              .comment-list .reply a:hover,
	              .comment-list .reply a:focus,
	              .comment-list .reply a:active{
	               border-color: <?php echo esc_attr( $resto_primary_hover_color );?>;
	              
	             }

	        <?php
	        }

	        /*resto banner text color*/
	        if( !empty($resto_banner_text_color) ){
	        ?>  
	            .wrapper-slider .slide-item .banner-title a,
	            .wrapper-slider .slide-item,
	            .page-inner-title .taxonomy-description,
	            .page-inner-title .entry-header .entry-title,
	            .wrap-breadcrumb,
	            .wrap-breadcrumb a,
	            .page-inner-title,
	            .page-inner-title .page-title,
	            .main-navigation ul ul a,
	            .main-navigation ul ul a:visited,
	            .bannerbg h2,
	            .wrapper-services .thumb-holder a i, 
	            .wrapper-services .thumb-holder a i:visited,
	            .bannerbg .content-area .content-text,
	            .bannerbg .content-area h2 a {
	               color: <?php echo esc_attr( $resto_banner_text_color );?>;
	            }

	            @media screen and (max-width: 1199px){
	            .main-navigation ul li a,
	            .main-navigation ul li a:visited {
	                color: <?php echo esc_attr( $resto_banner_text_color );?>;
	                }
	            }

	        <?php
	        }

	        /*resto title color*/
	        if( !empty($resto_title_color) ){
	        ?>  
	            h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, .entry-title a,
	            .widget .widgettitle, .widget .widget-title{
	               color: <?php echo esc_attr( $resto_title_color );?>;
	            }

	        <?php
	        }

	        /*resto body text color*/
	        if( !empty($resto_body_text_color) ){
	        ?>  
	            body, button, input, select, textarea {
	              color: <?php echo esc_attr( $resto_body_text_color );?>;
	            }

	        <?php
	        }

	        /*resto link color*/
	        if( !empty($resto_link_color) ){
	        ?>  

	            .contact-widget ul li a,
	            .contact-widget ul li a i,
	            .posted-on a,
	            .cat-links a,
	            .tags-links a,
	            .author a,
	            .comments-link a,
	            .edit-link a,
	            .nav-links .nav-previous a,
	            .nav-links .nav-next a,
	            .search-form .search-submit,
	            .contact-widget ul li a:active,
	            .contact-widget ul li a:active i,
	            .posted-on a:active,
	            .cat-links a:active,
	            .tags-links a:active,
	            .author a:active,
	            .comments-link a:active,
	            .edit-link a:active,
	            .nav-links .nav-previous a:active,
	            .nav-links .nav-next a:active,
	            .search-form .search-submit:active,
	            .widget li a:active{
	            	color: <?php echo esc_attr( $resto_link_color );?>;
	            }

	        <?php
	        }

	        /*resto button backgorund color*/
	        if( !empty($resto_button_backgorund_color) ){
	        ?>  

	            .button,
	            button,
	            html input[type="button"],
	            input[type="button"],
	            input[type="reset"],
	            input[type="submit"],
	            .button:visited,
	            button:visited,
	            html input[type="button"]:visited,
	            input[type="button"]:visited,
	            input[type="reset"]:visited,
	            input[type="submit"]:visited,
	            .search-form .search-submit,
	            .search-form .search-submit:visited,
	            .button:hover,
	            input[type="button"]:hover,
	            input[type="reset"]:hover,
	            input[type="submit"]:hover,
	            button:focus
	            input[type="button"]:focus,
	            input[type="reset"]:focus,
	            input[type="submit"]:focus,
	            button:active,
	            input[type="button"]:active,
	            input[type="reset"]:active,
	            input[type="submit"]:active,
	            .site-header .header-btn .button:hover{
	               background-color: <?php echo esc_attr( $resto_button_backgorund_color );?>;
	            }

	        <?php
	        }

	        /*resto button text color*/
	        if( !empty($resto_button_text_color) ){
	        ?>  
	            .button, button, html input[type="button"], input[type="button"], input[type="reset"], input[type="submit"], .button:visited, button:visited, html input[type="button"]:visited, input[type="button"]:visited, input[type="reset"]:visited, input[type="submit"]:visited  {
	              		color: <?php echo esc_attr( $resto_button_text_color );?>;
	            }

	        <?php
	        }

	        /*end of color options*/

	        /*=====FONT FAMILY OPTION=====*/
	        /*----------------------------------*/
	        /*resto font family Primary*/
	        if( !empty($resto_font_family_Primary) ){
	        ?> 
	            body,
                button,
                input,
                select,
                textarea,
                pre,
                code,
                kbd,
                tt,
                samp,
                var,
                .form-allowed-tags code,
                .wrapper-slider .slide-item .slider-title a {
	             	font-family: "<?php echo esc_attr( $resto_font_family_Primary ); ?>";
	            }
	        <?php
	        } 

	        /*resto font family site identity*/
	        if( !empty($resto_font_family_site_identity) ){
	        ?> 
	            .site-header .wrapper-site-identity .site-title a,
	            .site-header .wrapper-site-identity .site-description {
	             	font-family: "<?php echo esc_attr( $resto_font_family_site_identity ); ?>";
	            }
	        <?php
	        } 

	        /*resto font family heading*/
	        if( !empty($resto_font_family_heading) ){
	        ?> 
	            h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {
	             	font-family: "<?php echo esc_attr( $resto_font_family_heading ); ?>";
	            }
	        <?php
	        } 

	        /*resto font family section title*/
	        if( !empty($resto_font_family_title) ){
	        ?> 
	            .title-section h2 {
	             	font-family: "<?php echo esc_attr( $resto_font_family_title ); ?>";
	            }
	        <?php
	        } 

	        /* Banner Image */
	        if( !empty( $resto_banner_image ) ){
	        ?>
	        	.page-inner-title {
	         		background-image: url(<?php echo esc_url($resto_banner_image);?>);
	        	}
	        <?php
	        }
	        // Bail if not WP 4.7.
	        if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
	          $resto_custom_css = $resto_customizer_all_values['resto-custom-css']; 
	          $resto_custom_css_output = ''; 
	          if ( ! empty( $resto_custom_css ) ) { 
	              $resto_custom_css_output .= esc_textarea( $resto_custom_css ) ; 
	          } 
	         echo $resto_custom_css_output;/*escaping done above*/ 
	        } else {
	          $resto_customizer_saved_values = resto_get_all_options();
	          $resto_custom_css = $resto_customizer_all_values['resto-custom-css'];
	          // Bail if there is no Custom CSS.
	              if (!empty($resto_custom_css)) {
	                  $core_css = wp_get_custom_css();
	                  $return = wp_update_custom_css_post( $core_css . $resto_custom_css );
	                  if ( ! is_wp_error( $return ) ) {
	                  // Remove from theme.
	                  $options = esc_textarea($resto_customizer_all_values['resto-custom-css']);
	                  echo $options;
	                  }
	              }
	          $resto_custom_css = '';
	          $resto_customizer_saved_values['resto-custom-css'] = $resto_customizer_defaults['resto-custom-css'];
	          /*resetting fields*/
	          resto_reset_options( $resto_customizer_saved_values );
	        }
	        ?>
        </style>
    <?php
    }
endif;
add_action( 'wp_head', 'resto_wp_head' );