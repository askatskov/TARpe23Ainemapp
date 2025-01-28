<?php
if ( ! function_exists( 'resto_home_service_array' ) ) :
    /**
     * Service Section array creation
     *
     * @since resto 1.0.0
     *
     * @param string $from_service
     * @return array
     */
    function resto_home_service_array( $from_service ){
        global $resto_customizer_all_values;
        $resto_home_service_number = absint($resto_customizer_all_values['resto-home-service-number']);
        $resto_home_service_single_words = absint($resto_customizer_all_values['resto-home-service-single-words']);
        $resto_home_service_contents_array = array();

        $resto_home_service_contents_array[1]['resto-home-service-title'] = __('PIZZA', 'resto');
        $resto_home_service_contents_array[1]['resto-home-service-content'] = __("Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum 1500.", 'resto');
        $resto_home_service_contents_array[1]['resto-home-service-link'] = '#';
        $resto_home_service_contents_array[1]['resto-home-service-page-icon'] = 'fa-cutlery';
        $resto_home_service_contents_array[1]['resto-home-service-page-image'] = get_template_directory_uri()."/assets/img/service-icon.png";

        $resto_icons_array = array('resto-home-service-page-icon');
        $resto_home_service_page = array('resto-home-service-pages-ids');

        $resto_icons_arrays = evision_customizer_get_repeated_all_value(6 , $resto_icons_array);

        if ( 'from-category' ==  $from_service ){
            $resto_home_service_category = absint($resto_customizer_all_values['resto-home-service-category']);
            if( 0 != $resto_home_service_category ){
                $resto_home_service_args =    array(
                    'post_type' => 'post',
                    'cat' => $resto_home_service_category,
                    'posts_per_page' => $resto_home_service_number
                );
            }
        }else {
                $resto_home_service_posts = evision_customizer_get_repeated_all_value(6 , $resto_home_service_page);
                $resto_home_service_posts_ids = array();
                if( null != $resto_home_service_posts ) {
                    foreach( $resto_home_service_posts as $resto_home_service_post ) {
                        if( 0 != $resto_home_service_post['resto-home-service-pages-ids'] ){
                            $resto_home_service_posts_ids[] = $resto_home_service_post['resto-home-service-pages-ids'];
                        }
                    }
                    if( !empty( $resto_home_service_posts_ids )){
                        $resto_home_service_args =    array(
                            'post_type' => 'page',
                            'post__in' => $resto_home_service_posts_ids,
                            'posts_per_page' => $resto_home_service_number,
                            'orderby' => 'post__in'
                        );
                    }
                }
            }
        // the query
        if( !empty( $resto_home_service_args )){

            $resto_home_service_contents_array = array(); /*again empty array*/
            $resto_home_service_post_query = new WP_Query( $resto_home_service_args );
            if ( $resto_home_service_post_query->have_posts() ) :
                $i = 1;
                while ( $resto_home_service_post_query->have_posts() ) : $resto_home_service_post_query->the_post();
                    $resto_home_service_contents_array[$i]['resto-home-service-title'] = get_the_title();
                    if (has_excerpt()) {
                        $resto_home_service_contents_array[$i]['resto-home-service-content'] = get_the_excerpt();
                    }
                    else {
                        $resto_home_service_contents_array[$i]['resto-home-service-content'] = resto_words_count( $resto_home_service_single_words ,get_the_content());
                    }
                    $resto_home_service_contents_array[$i]['resto-home-service-link'] = get_permalink();
                    if(isset( $resto_icons_arrays[$i] )){
                        $resto_home_service_contents_array[$i]['resto-home-service-page-icon'] = $resto_icons_arrays[$i]['resto-home-service-page-icon'];
                    }
                    else{
                        $resto_home_service_contents_array[$i]['resto-home-service-page-icon'] = 'fa-cutlery';
                    }

                    $url ='';
                    if(has_post_thumbnail()){
                        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'resto-blog-post' );
                        $url = $thumb['0'];
                    }
                    else{
                      $url = NULL;
                    }
                    $resto_home_service_contents_array[$i]['resto-home-service-page-image'] = $url;

                    $i++;
                endwhile;
                wp_reset_postdata();
            endif;
        }
        return $resto_home_service_contents_array;
    }
endif;

if ( ! function_exists( 'resto_home_service' ) ) :
    /**
     * Service Section
     *
     * @since resto 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function resto_home_service() {
        global $resto_customizer_all_values;
        if( 1 != $resto_customizer_all_values['resto-home-service-enable'] ){
            return null;
        }
        $resto_home_service_selection_options = $resto_customizer_all_values['resto-home-service-selection'];
        $resto_home_service_bg_image = $resto_customizer_all_values['resto-home-service-background-image'];
        $resto_service_arrays = resto_home_service_array( $resto_home_service_selection_options );
        if( is_array( $resto_service_arrays )){
            $resto_home_service_number = absint($resto_customizer_all_values['resto-home-service-number']);
            $resto_home_service_title = $resto_customizer_all_values['resto-home-service-title'];
            $resto_home_service_enable_thumbnail = $resto_customizer_all_values['resto-home-service-thumbnail-enable'];
            $resto_home_service_enable_button_text = $resto_customizer_all_values['resto-home-service-button-enable'];
            $resto_home_service_button_text = $resto_customizer_all_values['resto-home-service-button-text'];
            $resto_home_service_button_link = $resto_customizer_all_values['resto-home-service-button-link'];
            ?>

            <section class="wrapper wrapper-services movebg bannerbg" style="background-image: url(<?php echo (esc_url($resto_home_service_bg_image))?>">
                <div class="thumb-overlay"></div>
                <div class="container services-content">
                    <div class="container overhidden">
                        <div class="row">
                            <div class="col-md-12">
                                <header class="title-section evision-animate slideInDown" data-wow-delay="0s" style="visibility: visible; animation-delay: 0s; animation-name: slideInDown;">
                                    <?php if(!empty( $resto_home_service_title ) ){ ?>
                                        <h2><?php echo esc_html(  $resto_home_service_title); ?></h2>
                                    <?php } ?>
                                </header>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <?php if ($resto_home_service_enable_thumbnail == 1){
                                $resto_service_thumb = 'thumb-option';
                            } 
                            else{
                                $resto_service_thumb = '';
                            } ?>
                            <?php
                            $i = 1;
                            $data_delay = 0;
                            foreach( $resto_service_arrays as $resto_service_array ){
                                if( $resto_home_service_number < $i){
                                    break;
                                }
                                ?>
                            <div class="col-xs-12 col-sm-4 col-md-4 item">
                                <div class="thumb-holder">
                                    <a href="<?php echo esc_url( $resto_service_array['resto-home-service-link'] );?>">
                                        <?php if ($resto_home_service_enable_thumbnail == 1) { ?>
                                            <img src="<?php echo esc_url($resto_service_array['resto-home-service-page-image']); ?>" alt="<?php echo esc_html( $resto_service_array['resto-home-service-title'] );?>">
                                        <?php } else { ?>
                                            <i class="fa <?php echo esc_attr( $resto_service_array['resto-home-service-page-icon'] ); ?>" aria-hidden="true"></i>
                                        <?php } ?>
                                    <a/>
                                </div>
                                <div class="content-area">
                                    <div class="content-inner">
                                        <h2>
                                            <a href="<?php echo esc_url( $resto_service_array['resto-home-service-link'] );?>"><?php echo esc_html( $resto_service_array['resto-home-service-title'] );?>
                                            </a>
                                        </h2>
                                        <div class="content-text">
                                            <?php echo wp_kses_post( $resto_service_array['resto-home-service-content'] );?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php 
                            }
                            ?>
                        </div>
                        <div class="clear"></div>
                        <?php
                        if( !empty( $resto_home_service_button_link ) && !empty( $resto_home_service_button_text ) ){
                            ?>
                            <div class="container btn-container">
                                <div class="btn-holder">
                                    <a class="button button-outline" href="<?php echo esc_url( $resto_home_service_button_link );?>">
                                        <?php echo esc_html( $resto_home_service_button_text );?>
                                    </a>
                                </div>
                            </div>
                            <?php
                        } ?>
                    </div>
                </div>
            </section><!-- service section -->
            <?php
        }
    }
endif;
add_action( 'resto_action_front_page', 'resto_home_service', 30 );
