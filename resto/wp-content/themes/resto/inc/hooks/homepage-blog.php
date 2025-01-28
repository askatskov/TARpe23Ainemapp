<?php
if ( ! function_exists( 'resto_home_blog' ) ) :
    /**
     * Blog Section
     *
     * @since resto Pro 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function resto_home_blog() {
        global $resto_customizer_all_values;
        $resto_home_blog_title = $resto_customizer_all_values['resto-blog-title'];
        $resto_home_blog_button_text = $resto_customizer_all_values['resto-blog-button-text'];
        $resto_home_blog_single_button_text = $resto_customizer_all_values['resto-blog-single-button-text'];
        $resto_home_blog_enable_button = $resto_customizer_all_values['resto-blog-enable-button'];
        $resto_home_blog_button_link = $resto_customizer_all_values['resto-home-blog-button-link'];
        $resto_home_blog_single_words_sticky = absint( $resto_customizer_all_values['resto-blog-sticky-excerpt-number'] );
        $resto_home_blog_single_words = absint( $resto_customizer_all_values['resto-blog-excerpt-number'] );
        $resto_home_blog_numbers = absint( $resto_customizer_all_values['resto-blog-number'] );
        $resto_home_blog_category = $resto_customizer_all_values['resto-blog-category'];
        $resto_home_blog_number = 1;
        $resto_sticky = get_option( 'sticky_posts' );
        if( 1 != $resto_customizer_all_values['resto-blog-enable'] ){
            return null;
        }
        ?>

        <section class="wrapper wrapper-blog">
            <div class="blog-content">
                <div class="container overhidden">
                    <div class="row">
                        <div class="col-md-12">
                            <header class="title-section evision-animate slideInDown" data-wow-delay="0s" style="visibility: visible; animation-delay: 0s; animation-name: slideInDown;">
                                <h2><?php echo esc_html( $resto_home_blog_title );?></h2>
                            </header>
                        </div>
                    </div>
                </div>
                <!-- sticky post -->
                <?php

                $stick_post_id = array();
                if ( !empty($resto_sticky) ) {
                    $resto_home_blog_stiky_args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 1,
                        'post__in' => $resto_sticky,
                    );
                    $resto_home_blog_sticky_post_query = new WP_Query($resto_home_blog_stiky_args);
                    if ($resto_home_blog_sticky_post_query->have_posts()) :
                        $data_delay = 0;
                        while ($resto_home_blog_sticky_post_query->have_posts()) : $resto_home_blog_sticky_post_query->the_post();
                            if(has_post_thumbnail()){
                                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'resto-sticky-post' );
                                $url = $thumb['0'];
                            }
                            else{
                                $url = get_template_directory_uri().'/assets/img/no-image.jpg';
                            }

                        ?>
                        <div class="container stickypost">
                            <div class="thumb-holder" style="background-image: url(<?php echo esc_url( $url ); ?>)" alt="blog")>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-8 col-md-7 content-outer">
                                        <div class="content-area">
                                            <div class="content-inner">
                                                <h2><a href="<?php the_permalink();?>"> <?php the_title_attribute(); ?></a></h2>
                                                <div class="publish">
                                                    <span>
                                                        <?php
                                                        $archive_day   = get_the_time('d');
                                                        ?>
                                                        <a href="<?php echo get_day_link('', '', $archive_day); ?>"><i class="fa fa-calendar"></i> <?php echo get_the_date('M j, Y');?></a>
                                                    </span>
                                                    <span>
                                                        <a href="<?php the_permalink(); ?>">
                                                            <i class="fa fa-comment"></i>
                                                            <?php
                                                                $commentscount = get_comments_number();
                                                                if($commentscount == 1): $commenttext = ''; endif;
                                                                if($commentscount > 1 || $commentscount == 0): $commenttext = ''; endif;
                                                                echo $commentscount.' '.$commenttext;
                                                            ?>
                                                        </a>
                                                    </span>
                                                </div>
                                                <div class="content-text">
                                                    <?php
                                                    if ( has_excerpt() ) {
                                                        the_excerpt();
                                                    } else {
                                                        $content_blog = get_the_content();
                                                        echo resto_words_count( $resto_home_blog_single_words_sticky, $content_blog );
                                                    }
                                                    ?>
                                                </div>
                                                <div class="btn-holder">
                                                    <a class="button button-outline button-outline-small" href="<?php the_permalink(); ?>"><?php echo esc_html($resto_home_blog_single_button_text ); ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php break;
                        endwhile; 
                        wp_reset_postdata();
                    endif;
                    ?>
                <?php } 
                else { 
                    $resto_home_blog_not_stiky_args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 1,
                        'cat'           => $resto_home_blog_category,
                    );
                    $resto_home_blog_not_sticky_post_query = new WP_Query($resto_home_blog_not_stiky_args);
                    if ($resto_home_blog_not_sticky_post_query->have_posts()) :
                        $data_delay = 0;
                        while ($resto_home_blog_not_sticky_post_query->have_posts()) : $resto_home_blog_not_sticky_post_query->the_post();
                        $stick_post_id[] = get_the_ID();
                            if(has_post_thumbnail()){
                                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'resto-sticky-post' );
                                $url = $thumb['0'];
                            }
                            else{
                                $url = get_template_directory_uri().'/assets/img/no-image.jpg';
                            }
                    ?>
                        <div class="container stickypost">
                            <div class="thumb-holder" style="background-image: url(<?php echo esc_url( $url ); ?>)" alt="blog")> 
                                <div class="row">
                                    <div class="col-xs-12 col-sm-8 col-md-7 content-outer">
                                        <div class="content-area">
                                            <div class="content-inner">
                                                <h2><a href="<?php the_permalink();?>"> <?php the_title_attribute(); ?></a></h2>
                                                <div class="publish">
                                                    <span>
                                                        <?php
                                                        $archive_day   = get_the_time('d');
                                                        ?>
                                                        <a href="<?php echo get_day_link('', '', $archive_day); ?>"><i class="fa fa-calendar"></i> <?php echo get_the_date('M j, Y');?></a>
                                                    </span>
                                                    <span>
                                                        <a href="<?php the_permalink(); ?>">
                                                            <i class="fa fa-comment"></i>
                                                            <?php
                                                                $commentscount = get_comments_number();
                                                                if($commentscount == 1): $commenttext = ''; endif;
                                                                if($commentscount > 1 || $commentscount == 0): $commenttext = ''; endif;
                                                                echo $commentscount.' '.$commenttext;
                                                            ?>
                                                        </a>
                                                    </span>
                                                </div>
                                                <div class="content-text">
                                                    <?php
                                                    if ( has_excerpt() ) {
                                                        the_excerpt();
                                                    } else {
                                                        $content_blog = get_the_content();
                                                        echo resto_words_count( $resto_home_blog_single_words_sticky, $content_blog );
                                                    }
                                                    ?>
                                                </div>
                                                <div class="btn-holder">
                                                    <a class="button button-outline button-outline-small" href="<?php the_permalink(); ?>"><?php echo esc_html($resto_home_blog_single_button_text ); ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php break;
                        endwhile;  wp_reset_postdata();
                    endif;
                    } ?>
                <!-- normal scrolling post -->
                <div class="container">
                    <div class="carousel-group">
                            <?php
                                $resto_home_sticky = get_option( 'sticky_posts' );
                                $resto_home_blog_args = array(
                                    'post_type' => 'post',
                                    'posts_per_page' => absint( $resto_home_blog_numbers ),
                                    'cat'           => $resto_home_blog_category,
                                    'post__not_in' => get_option( 'sticky_posts' ),
                                    'ignore_sticky_posts' => true,
                                );

                                if(  empty( get_option( 'sticky_posts' ) ) ) {
                                    $resto_home_blog_args['post__not_in'] = $stick_post_id;
                                }
                                $resto_home_about_post_query = new WP_Query($resto_home_blog_args);
                                if ($resto_home_about_post_query->have_posts()) :
                                    $data_delay = 0;
                                while ($resto_home_about_post_query->have_posts()) : $resto_home_about_post_query->the_post();
                                    if(has_post_thumbnail()){
                                        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'resto-blog-post' );
                                        $url = $thumb['0'];
                                    }
                                    else{
                                        $url = get_template_directory_uri().'/assets/img/no-image.jpg';
                                    } ?>
                                    <div class="carousel-item singlethumb col-xs-12 col-sm-4 col-md-3 padlr8">
                                        <div class="thumb-holder">
                                            <a href="<?php the_permalink();?>">
                                                <img src="<?php echo esc_url( $url ); ?>" alt="activities">
                                            </a>
                                        </div>
                                        <div class="content-area">
                                            <h3>
                                                <a href="<?php the_permalink();?>">
                                                    <?php the_title_attribute(); ?>
                                                </a>
                                            </h3>
                                            <div class="content-text">
                                                <?php
                                                if ( has_excerpt() ) {
                                                    the_excerpt();
                                                } else {
                                                    $content_blog = get_the_content();
                                                    echo resto_words_count( $resto_home_blog_single_words, $content_blog );
                                                }
                                                ?>
                                            </div>
                                            <div class="btn-holder">
                                                <a class="button button-outline button-outline-small" href="<?php the_permalink();?>"><?php echo esc_html($resto_home_blog_single_button_text ); ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php wp_reset_postdata(); ?>
                                <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
                <?php if ($resto_home_blog_enable_button == 1) {?>
                    <div class="container btn-container">
                        <div class="btn-holder">
                            <a class="button button-outline" href="<?php echo (esc_url($resto_home_blog_button_link )); ?>"><?php echo (esc_html($resto_home_blog_button_text)); ?></a>
                        </div>
                    </div>
                <?php } ?>
        </section>
        <?php
    }
endif;
add_action( 'resto_action_front_page', 'resto_home_blog', 40 );