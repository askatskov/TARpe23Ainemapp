<?php
if ( ! function_exists( 'resto_footer_start' ) ) :
    /**
     * Footer content
     *
     * @since Resto 1.0.0
     *
     * @param null
     * @return false | void
     *
     */
    function resto_footer_start() { ?>
        </div><!-- #content -->
        <footer class="wrapper wrap-footer">
            <!-- wrap top footer -->

            <section class="wrapper wrap-top-footer">
                <div class="container">
                    <?php global $resto_customizer_all_values; 
                    if ($resto_customizer_all_values['resto-footer-logo-image-enable'] == 1) { ?>
                        <h2 class="footer-logo">
                            <?php global $resto_customizer_all_values;
                                $resto_footer_logo = $resto_customizer_all_values['resto-footer-logo-image'];
                            ?>
                            <?php if (  is_front_page() && !is_home() ) { ?>
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                                    <img src="<?php echo esc_url($resto_footer_logo); ?>" width="240">
                                </a>
                            <?php } ?>
                        </h2>
                    <?php } ?>
                    <div class="social-widget evision-social-section social-icon-only top-tooltip">
                        <?php
                            wp_nav_menu( array( 'theme_location' => 'social', 'link_before' => '<span>',
                                'link_after'=>'</span>' , 'menu_id' => 'primary-menu','fallback_cb' => false, ) );
                        ?>
                    </div>
                </div>  
            </section>
   <?php  }
endif;
add_action( 'resto_action_after_content', 'resto_footer_start', 10 );

if ( ! function_exists( 'resto_before_footer' ) ) :
    /**
     * Footer content
     *
     * @since Resto 1.0.0
     *
     * @param null
     * @return false | void
     *
     */
    function resto_before_footer() {
        global $resto_customizer_all_values;
        $resto_footer_widgets_number = $resto_customizer_all_values['resto-footer-sidebar-number'];
        if( $resto_footer_widgets_number <= 0 ){
            return false;
        }
        if( !is_active_sidebar( 'footer-col-one' ) && !is_active_sidebar( 'footer-col-two' ) && !is_active_sidebar( 'footer-col-three' ) && !is_active_sidebar( 'footer-col-four' )){
            return false;
        }
        if( 1 == $resto_footer_widgets_number ){
                $col = 'col-md-12';
            }
        elseif( 2 == $resto_footer_widgets_number ){
            $col = 'col-md-6';
        }
        elseif( 3 == $resto_footer_widgets_number ){
            $col = 'col-md-4';
        }
        elseif( 4 == $resto_footer_widgets_number ){
            $col = 'col-md-3';
        }
        else{
            $col = 'col-md-3';
        }
        ?>
        <!-- *****************************************
             Footer before section
    ****************************************** -->
    <section class="wrapper footer-widget">
		<div class="container">
			<div class="row">
                <?php if( is_active_sidebar( 'footer-col-one' ) && $resto_footer_widgets_number > 0 ) : ?>
                    <div class="col-xs-12 col-sm-6 <?php echo esc_attr( $col );?>">
                        <?php dynamic_sidebar( 'footer-col-one' ); ?>
                    </div>
                <?php endif; ?>
                <?php if( is_active_sidebar( 'footer-col-two' ) && $resto_footer_widgets_number > 1 ) : ?>
                    <div class="col-xs-12 col-sm-6 <?php echo esc_attr( $col );?>">
                        <?php dynamic_sidebar( 'footer-col-two' ); ?>
                    </div>
                <?php endif; ?>
                <?php if( is_active_sidebar( 'footer-col-three' ) && $resto_footer_widgets_number > 2 ) : ?>
                    <div class="col-xs-12 col-sm-6 <?php echo esc_attr( $col );?>">
                        <?php dynamic_sidebar( 'footer-col-three' ); ?>
                    </div>
                <?php endif; ?>
                <?php if( is_active_sidebar( 'footer-col-four' ) && $resto_footer_widgets_number > 3 ) : ?>
                    <div class="col-xs-12 col-sm-6 <?php echo esc_attr( $col );?>">
                        <?php dynamic_sidebar( 'footer-col-four' ); ?>
                    </div>
                <?php endif; ?>
			</div>
			</div>
		</div>
	</section>
        <!-- *****************************************
                 Footer before section ends
        ****************************************** -->
    <?php
    }
endif;
add_action( 'resto_action_before_footer', 'resto_before_footer', 10 );

if ( ! function_exists( 'resto_footer' ) ) :
    /**
     * Footer content
     *
     * @since Resto 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function resto_footer() {
        global $resto_customizer_all_values;
        ?>
            <!-- footer site info -->
            <section id="colophon" class="wrapper site-footer" role="contentinfo">
                <div class="container site-info">
                    <?php
                    if(isset($resto_customizer_all_values['resto-copyright-text'])){
                        echo wp_kses_post( $resto_customizer_all_values['resto-copyright-text'] );
                    }
                    ?>
                    <?php
                     if( 1 == $resto_customizer_all_values['resto-enable-theme-name']){
                        ?>
                    <span class="sep"> | </span>
                    <?php printf( esc_html__( 'Theme: %1$s by %2$s', 'resto' ), 'Resto', '<a href="http://evisionthemes.com/" target = "_blank" rel="designer">eVisionThemes </a>' ); ?>
                    <?php
                    }
                    ?>
                </div><!-- .site-info -->
            </section><!-- #colophon -->
        </footer>
        <!-- *****************************************
                 Footer section ends
        ****************************************** -->
    <?php
    }
endif;
add_action( 'resto_action_footer', 'resto_footer', 10 );

if ( ! function_exists( 'resto_page_end' ) ) :
    /**
     * Page end
     *
     * @since Resto 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function resto_page_end() {
        global $resto_customizer_all_values;
        if( isset( $resto_customizer_all_values['resto-enable-back-to-top'] )  && 1 == $resto_customizer_all_values['resto-enable-back-to-top']) {
        ?>
            <a id="gotop" class="evision-back-to-top" href="#page"><i class="fa fa-angle-up"></i></a>
        <?php
        }
        ?>
        </div><!-- #page -->
    <?php
    }
endif;
add_action( 'resto_action_after_footer', 'resto_page_end', 10 );