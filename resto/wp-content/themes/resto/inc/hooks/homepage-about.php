<?php

if ( ! function_exists( 'resto_home_about_section' ) ) :
    /**
     * About section
     *
     * @since resto 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function resto_home_about_section() {
        global $resto_customizer_all_values;
        if( 1 != $resto_customizer_all_values['resto-about-enable'] ){
            return null;
        }
        $resto_home_about_single_words = absint( $resto_customizer_all_values['resto-home-about-single-words'] );
        $resto_home_about_posts = absint($resto_customizer_all_values['resto-about-page']);
        $resto_home_about_enable_button = $resto_customizer_all_values['resto-about-button-enable'];
        $resto_home_about_button = esc_html($resto_customizer_all_values['resto-home-about-button-text'] );
        $resto_home_about_button_link = esc_url($resto_customizer_all_values['resto-home-about-button-link'] );

    ?>
    <?php
    if( !empty( $resto_home_about_posts )){
        $resto_feature_slider_args =    array(
            'post_type' => 'page',
            'p' => $resto_home_about_posts,
            'posts_per_page' => 1

        );
        $resto_fature_section_post_query = new WP_Query( $resto_feature_slider_args );
        if ( $resto_fature_section_post_query->have_posts() ) :
        while ( $resto_fature_section_post_query->have_posts() ) : $resto_fature_section_post_query->the_post();
        if(has_post_thumbnail()){
            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
        }
        else{
            $thumb[0] = get_template_directory_uri() .'/assets/img/about.jpg';
        }
        ?>
            <section class="wrapper wrapper-about shape-bg">
                <div class="shape-bg-inner">
                    <div class="container overhidden">
                        <div class="row">
                            <div class="col-md-12">
                                <header class="title-section alt-title diff-title evision-animate slideInDown" data-wow-delay="0s" style="visibility: visible; animation-delay: 0s; animation-name: slideInDown;">
                                    <h2><?php echo esc_html(get_the_title()); ?></h2>
                                </header>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-4 col-md-4">
                                <a href="<?php 
                                        if (empty($resto_home_about_button_link)) {
                                        the_permalink();
                                    }
                                    else{
                                        echo esc_url($resto_home_about_button_link);
                                    } ?>">
                                    <div class="thumb-holder"><img src="<?php echo esc_url($thumb[0]); ?>" alt="about"></div>
                                </a>
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-8">
                                <div class="content-area">
                                    <div class="content-inner">
                                        <div class="content-text">
                                            <?php echo wp_kses_post(resto_words_count( $resto_home_about_single_words ,get_the_content())); ?>
                                        </div>
                                        <?php if (1 == $resto_home_about_enable_button) { ?>
                                            <div class="btn-holder">
                                                <a href="<?php 
                                                        if (empty($resto_home_about_button_link)) {
                                                        the_permalink();
                                                    }
                                                    else{
                                                        echo esc_url($resto_home_about_button_link);
                                                    } ?>" class="button button-outline">
                                                    <?php echo esc_html($resto_home_about_button);?>
                                                </a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php
            endwhile;
        endif;
    }
    if( empty( $resto_home_about_posts )){ ?>
        <section class="wrapper wrapper-about shape-bg">
            <div class="shape-bg-inner">
                <div class="container overhidden">
                    <div class="row">
                        <div class="col-md-12">
                            <header class="title-section alt-title diff-title evision-animate slideInDown" data-wow-delay="0s" style="visibility: visible; animation-delay: 0s; animation-name: slideInDown;">
                                <h2><?php echo esc_html__('Welcome to RESTRO', 'resto' ); ?></h2>
                            </header>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <a href="#">
                                <div class="thumb-holder"><img src="<?php echo get_template_directory_uri();?>/assets/img/about.jpg" alt="about"></div>
                            </a>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-8">
                            <div class="content-area">
                                <div class="content-inner">
                                    <div class="content-text"> <?php echo esc_html__('Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit. esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. <br>
                                    Ut enim ad minim veniam, quis nostrud exercitation ullamco', 'resto' ); ?> 
                                    <div class="btn-holder">
                                        <a class="button button-outline" href="#"><?php echo esc_html__('view our menu', 'resto' ); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php 
    }
}
endif;
add_action( 'resto_action_front_page', 'resto_home_about_section', 10 );