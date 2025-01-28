<?php
/**
 * Displays Featured Menu Section
 *
 * @package Restochef
 */
$enable_featured_menu_section = restochef_get_option('enable_featured_menu_section');
$featured_menu_section_title = restochef_get_option('featured_menu_section_title');
$select_featured_menu_option_cat = restochef_get_option( 'select_featured_menu_option_cat' );
if ($enable_featured_menu_section){
?>
<section class="restochef-featured-block theme-block">
    <div class="wrapper">
        <div class="column-row">
            <div class="column column-12">
              <?php if ($featured_menu_section_title) { ?>
                <div class="restochef-section-header text-center">
                    <h2 class="font-size-large fw-bold">
                  <?php echo esc_html($featured_menu_section_title) ?>
                      </h2>
                  </div>

              <?php } ?>
                    
                <div class="restochef-section-body">
                    <div class="column-row">
                      <?php $menu_post_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 3, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($select_featured_menu_option_cat)));
                          if( $menu_post_query->have_posts() ):
                              while ($menu_post_query->have_posts()): $menu_post_query->the_post();
                                  ?>
                                <div class="column column-4 column-md-6 column-sm-12">
                                    <article class="theme-news-article mb-md-24 mb-sm-24 text-center">
                                        <?php
                                        if (has_post_thumbnail()) {
                                            ?>
                                            <div class="theme-article-image image-size-big adjust-image-size mb-16">
                                                <?php
                                                the_post_thumbnail('medium_large', array(
                                                    'alt' => the_title_attribute(array(
                                                        'echo' => false,
                                                    )),
                                                ));
                                                ?>
                                            </div>
                                            <?php
                                        }
                                        ?>

                                        <?php the_title( '<h2 class="entry-title font-size-medium"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
                          
                                    </article>
                                </div>

                                <?php
                            endwhile;
                        wp_reset_postdata();
                        endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php }