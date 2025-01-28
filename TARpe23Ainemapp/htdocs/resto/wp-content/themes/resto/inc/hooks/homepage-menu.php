<?php

if ( ! function_exists( 'resto_home_menu_section' ) ) :
    /**
     * menu section
     *
     * @since resto 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function resto_home_menu_section() {
        global $resto_customizer_all_values;
        if( 1 != $resto_customizer_all_values['resto-menu-enable'] ){
            return null;
        }
        $resto_home_menu_number = absint( $resto_customizer_all_values['resto-menu-number'] );
        $resto_home_menu_title = esc_html( $resto_customizer_all_values['resto-menu-title'] );
        $resto_home_menu_single_words = absint( $resto_customizer_all_values['resto-home-menu-single-words'] );
        $resto_home_menu_posts = absint($resto_customizer_all_values['resto-menu-category']);
        $resto_home_menu_enable_price = $resto_customizer_all_values['resto-menu-price-enable'];
        $resto_home_menu_enable_button = $resto_customizer_all_values['resto-menu-button-enable'];
        $resto_home_menu_button = esc_html($resto_customizer_all_values['resto-home-menu-button-text'] );
        $resto_home_menu_button_link = esc_url($resto_customizer_all_values['resto-home-menu-button-link'] );
        $resto_feature_nova_menu_args = array();
        if( !empty( $resto_home_menu_posts )){
            $resto_feature_nova_menu_args =    array(
                'post_type' => 'nova_menu_item',
                'posts_per_page' => $resto_home_menu_number,
                'tax_query' => array(
                        array(
                            'taxonomy' => 'nova_menu',
                            'field'    => 'term_id',
                            'terms'    => $resto_home_menu_posts,
                        ),
                    ),
            );
        }
        $resto_fature_section_post_query = new WP_Query( $resto_feature_nova_menu_args );
        if ( $resto_fature_section_post_query->have_posts() ) :

            ?>
                <section class="wrapper wrapper-portfolio">
                    <div class="container overhidden">
                        <div class="row">
                            <div class="col-md-12">
                                <header class="title-section alt-title diff-title evision-animate slideInDown" data-wow-delay="0s" style="visibility: visible; animation-delay: 0s; animation-name: slideInDown;">
                                    <h2><?php echo (esc_html($resto_home_menu_title )) ?></h2>
                                </header>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <ul id="da-thumbs" class="row da-thumbs">
                            <?php 
                            while ( $resto_fature_section_post_query->have_posts() ) : $resto_fature_section_post_query->the_post();
                                if(has_post_thumbnail()){
                                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'resto-home-menu' );
                                }
                                else{
                                    $thumb[0] = get_template_directory_uri() .'/assets/img/menu-01.png';
                                }
                                // Price.
                                $price = '';
                                $price = get_post_meta( get_the_ID(), 'nova_price', true );
                                ?>
                                <li class="col-xs-6 col-sm-3 col-md-3 pad0lr">
                                    <a href="<?php the_permalink()?>">
                                        <img src="<?php echo esc_url($thumb[0]); ?>" />
                                        <div class="content">
                                            <div class="content-inner">
                                                <h3><?php the_title(); ?></h3>
                                                <?php 
                                                if (has_excerpt()) {
                                                    $resto_menu_content = get_the_excerpt();
                                                }
                                                else {
                                                    $resto_menu_content = resto_words_count( $resto_home_menu_single_words ,get_the_content());
                                                } ?>
                                                <div class="par"><?php echo (wp_kses_post($resto_menu_content )); ?></div>
                                                <?php if ($resto_home_menu_enable_price == 1){ ?>
                                                    <div class="price"><?php echo esc_html($price);?></div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                    <div class="clear"></div>
                    <?php if ($resto_home_menu_enable_button == 1) {?>
                        <div class="container btn-container">
                            <div class="btn-holder">
                                <a class="button button-outline" href="<?php echo (esc_url($resto_home_menu_button_link )); ?>"><?php echo (esc_html($resto_home_menu_button)); ?></a>
                            </div>
                        </div>
                    <?php } ?>
                </section>
        <?php endif; 
        if( empty( $resto_home_menu_posts )){ ?>
            <section class="wrapper wrapper-portfolio">
                <div class="container overhidden">
                    <div class="row">
                        <div class="col-md-12">
                            <header class="title-section alt-title diff-title evision-animate slideInDown" data-wow-delay="0s" style="visibility: visible; animation-delay: 0s; animation-name: slideInDown;">
                                <h2><?php echo esc_html__('Our delicious menu','resto' ); ?></h2>
                            </header>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <ul id="da-thumbs" class="row da-thumbs">
                        <section class="menu-items">
                            <li class="col-xs-6 col-sm-3 col-md-3 pad0lr">
                                <a href="#">
                                    <img src="<?php echo get_template_directory_uri();?>/assets/img/menu-01.png" />
                                    <div class="content">
                                        <div class="content-inner">
                                            <h3><?php echo esc_html__('Grill Meat','resto' ); ?></h3>
                                            <div class="par"><?php echo esc_html__('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','resto' ); ?></div>
                                            <div class="price"><?php echo esc_html__('$12.30','resto' ); ?></div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </section>
                    </ul>
                </div>
                <div class="clear"></div>
                <div class="container btn-container">
                    <div class="btn-holder">
                        <a class="button button-outline" href="#"><?php echo esc_html__('view our menu','resto' ); ?></a>
                    </div>
                </div>
            </section>
        <?php } 
    }
endif;

add_action( 'resto_action_front_page', 'resto_home_menu_section', 20 );