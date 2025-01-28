<?php
if ( ! function_exists( 'resto_featured_slider_array' ) ) :
    /**
     * Featured Slider array creation
     *
     * @since resto 1.0.0
     *
     * @param string $from_slider
     * @return array
     */
    function resto_featured_slider_array( $from_slider ){
        global $resto_customizer_all_values;
        $resto_feature_slider_number = absint( $resto_customizer_all_values['resto-feature-slider-number'] );
        $resto_feature_slider_single_words = absint( $resto_customizer_all_values['resto-fs-single-words'] );
        $resto_feature_slider_contents_array[0]['resto-fs-title'] = __('Welcome to resto','resto');
        $resto_feature_slider_contents_array[0]['resto-fs-content'] = __("Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",'resto');
        $resto_feature_slider_contents_array[0]['resto-fs-link'] = '#';
        $resto_feature_slider_contents_array[0]['resto-fs-image'] = get_template_directory_uri()."/assets/img/banner.jpg";
        $repeated_page = array('resto-feature-slider-pages-ids');
        $resto_feature_slider_args = array();

        if ( 'from-category' ==  $from_slider ){
            $resto_fs_category = absint($resto_customizer_all_values['resto-featured-slider-category']);
            if( 0 != $resto_fs_category ){
                $resto_feature_slider_args =    array(
                    'post_type' => 'post',
                    'cat' => $resto_fs_category,
                    'ignore_sticky_posts' => true
                );
            }
        }
        else{
            $resto_feature_slider_posts = evision_customizer_get_repeated_all_value(3 , $repeated_page);
            $resto_feature_slider_posts_ids = array();
            if( null != $resto_feature_slider_posts ) {
                foreach( $resto_feature_slider_posts as $resto_feature_slider_post ) {
                    if( 0 != $resto_feature_slider_post['resto-feature-slider-pages-ids'] ){
                        $resto_feature_section_posts_ids[] = $resto_feature_slider_post['resto-feature-slider-pages-ids'];
                    }
                }

                if( !empty( $resto_feature_section_posts_ids )){
                    $resto_feature_slider_args =    array(
                        'post_type' => 'page',
                        'post__in' => $resto_feature_section_posts_ids,
                        'posts_per_page' => $resto_feature_slider_number,
                        'orderby' => 'post__in'
                    );
                }

            }
        }
        if( !empty( $resto_feature_slider_args )){
            // the query
            $resto_fature_section_post_query = new WP_Query( $resto_feature_slider_args );

            if ( $resto_fature_section_post_query->have_posts() ) :
                $i = 0;
                while ( $resto_fature_section_post_query->have_posts() ) : $resto_fature_section_post_query->the_post();
                    $url ='';
                    if(has_post_thumbnail()){
                        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'resto-main-slider' );
                        $url = $thumb['0'];
                    }
                    $resto_feature_slider_contents_array[$i]['resto-fs-title'] = get_the_title();
                    if (has_excerpt()) {
                        $resto_feature_slider_contents_array[$i]['resto-fs-content'] = get_the_excerpt();
                    }
                    else {
                        $resto_feature_slider_contents_array[$i]['resto-fs-content'] = resto_words_count( $resto_feature_slider_single_words ,get_the_content());
                    }
                    $resto_feature_slider_contents_array[$i]['resto-fs-link'] = get_permalink();
                    $resto_feature_slider_contents_array[$i]['resto-fs-image'] = $url;
                    $i++;
                endwhile;
                wp_reset_postdata();
            endif;
        }
        return $resto_feature_slider_contents_array;
    }
endif;

if ( ! function_exists( 'resto_main_slider' ) ) :
/**
 * Main Slider
 *
 * @since Resto 1.0.0
 *
 * @param null
 * @return null
 *
 */
function resto_main_slider() {
    global $resto_customizer_all_values;

    if( 1 != $resto_customizer_all_values['resto-feature-slider-enable'] ){
        return null;
    }
    $resto_feature_slider_selection_options = $resto_customizer_all_values['resto-feature-slider-selection'];
    $resto_slider_arrays = resto_featured_slider_array( $resto_feature_slider_selection_options );

    if( is_array( $resto_slider_arrays )){
    $resto_feature_slider_number = absint( $resto_customizer_all_values['resto-feature-slider-number'] );
    $resto_feature_slider_mode = $resto_customizer_all_values['resto-fs-slider-mode'];
    $resto_feature_slider_time = $resto_customizer_all_values['resto-fs-slider-time'];
    $resto_feature_slider_pause_time = $resto_customizer_all_values['resto-fs-slider-pause-time'];
    $resto_feature_slider_enable_control = $resto_customizer_all_values['resto-fs-enable-arrow'];
    $resto_feature_slider_enable_pagers = $resto_customizer_all_values['resto-fs-enable-pager'];
    $resto_feature_enable_autoplay = $resto_customizer_all_values['resto-fs-enable-autoplay'];
    $resto_feature_enable_title = $resto_customizer_all_values['resto-fs-enable-title'];
    $resto_feature_enable_caption = $resto_customizer_all_values['resto-fs-enable-caption'];
    $resto_feature_enable_button = $resto_customizer_all_values['resto-fs-enable-button'];
    $resto_feature_button_text = $resto_customizer_all_values['resto-fs-button-text'];

?>
<div class="wrapper wrapper-slider">
    <?php if( 1 == $resto_feature_slider_enable_control){ ?>
        <div class="controls">
            <a href="#" id="slide-prev"><i class="fa fa-angle-left"></i></a> 
            <a href="#" id="slide-next"><i class="fa fa-angle-right"></i></a>
        </div>
    <?php }  ?>
        <div class="cycle-slideshow"
        data-cycle-swipe=true
        data-cycle-swipe-fx=scrollHorz
        data-cycle-fx=<?php echo esc_attr( $resto_feature_slider_mode);?>
        data-cycle-manual-speed="<?php echo (esc_attr( $resto_feature_slider_time)* 1000)?>"
        data-cycle-carousel-fluid=true
        data-cycle-carousel-visible=1
        data-cycle-pause-on-hover="true"
        data-cycle-auto-height=container
        data-cycle-slides="> div"
        data-cycle-prev="#slide-prev"
        data-cycle-next="#slide-next"
        <?php if( 1 == $resto_feature_slider_enable_pagers){ ?>
            data-cycle-pager="#slide-pager"
        <?php }  ?>
        <?php if( 1 != $resto_feature_enable_autoplay){ ?>
            data-cycle-timeout=0
        <?php }  ?>
        <?php if(1 == $resto_feature_enable_autoplay){ ?>
            data-cycle-timeout=<?php echo (esc_attr( $resto_feature_slider_pause_time)* 1000)?>
        <?php }  ?>
        >
            <?php
            $i = 1;
            foreach( $resto_slider_arrays as $resto_slider_array ){
                if( $resto_feature_slider_number < $i){
                    break;
                }
                if(empty($resto_slider_array['resto-fs-image'])){
                    $resto_feature_slider_image = get_template_directory_uri().'/assets/img/banner.jpg';
                }
                else{
                    $resto_feature_slider_image =$resto_slider_array['resto-fs-image'];
                }
                ?>
                    <div class="slide-item" style="background-image: url('<?php echo esc_url( $resto_feature_slider_image )?>');">
                        <div class="thumb-overlay main-slider-overlay"></div>
                        <div class="container">
                            <?php if ((1 == $resto_feature_enable_title) || (1 == $resto_feature_enable_caption)){?>
                                <div class="row">
                                    <div class="col-xs-10 col-sm-10 col-md-8 col-xs-offset-1 col-sm-offset-1 banner-content">
                                        <div class="banner-content-inner">
                                            <h2 class="banner-title alt-title">
                                                <?php if( 1 == $resto_feature_enable_title) { ?>
                                                <a href="<?php echo esc_url( $resto_slider_array['resto-fs-link'] );?>"><?php echo esc_html( $resto_slider_array['resto-fs-title'] );?>
                                                </a>
                                                <?php } ?>
                                            </h2>
                                                <?php if( 1 == $resto_feature_enable_caption){ ?>
                                                    <div class="text-content">
                                                        <?php echo wp_kses_post( $resto_slider_array['resto-fs-content'] ); ?>
                                                    </div>
                                                <?php } 
                                                if ( 1 == $resto_feature_enable_button){ ?>
                                                    <div class="btn-holder">
                                                        <a href="<?php echo esc_url( $resto_slider_array['resto-fs-link'] );?>" class="button">
                                                            <?php echo esc_html( $resto_customizer_all_values['resto-fs-button-text'] );?>
                                                        </a>
                                                    </div>
                                                <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php
            $i++;
            }
            ?>
        </div>
    <div class="cycle-pager" id="slide-pager"></div>
</div>
<?php } 
}
endif;
add_action( 'resto_action_main_slider', 'resto_main_slider', 10 );