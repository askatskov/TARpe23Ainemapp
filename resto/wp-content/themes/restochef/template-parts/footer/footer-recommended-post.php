<?php
/**
 * Displays recommended post on footer.
 *
 * @package Restochef
 */
if ( class_exists( 'WooCommerce' ) ) {
    // Check if the current page is related to WooCommerce
    if ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() || is_product() ) {
        return;
    } 
}
$enable_category_meta = restochef_get_option('enable_category_meta');
$enable_date_meta = restochef_get_option('enable_date_meta');
$enable_post_excerpt = restochef_get_option('enable_post_excerpt');
$enable_author_meta = restochef_get_option('enable_author_meta');
$footer_recommended_post_title = restochef_get_option('footer_recommended_post_title');
$select_cat_for_footer_recommended_post = restochef_get_option('select_cat_for_footer_recommended_post');
?>
<section class="site-section site-section-big site-recommendation-section">
    <div class="wrapper">
        <div class="column-row">
             <div class="column column-4 column-md-12 column-sm-12">
                <h2 class="site-recommendation-title font-size-large mb-24">
                    <?php echo esc_html($footer_recommended_post_title); ?>
                </h2>
             </div>

             <div class="column column-8 column-md-12 column-sm-12">
              <div class="site-recommendation-carousel swiper">
                <div class="swiper-wrapper">
                  <?php $footer_recommended_post_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 6, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($select_cat_for_footer_recommended_post)));
                  if ($footer_recommended_post_query->have_posts()):
                  while ($footer_recommended_post_query->have_posts()): $footer_recommended_post_query->the_post();
                      ?>
                      <div class="swiper-slide">
                        <article id="post-<?php the_ID(); ?>" <?php post_class('theme-article-post theme-recommended-post'); ?>>
      
                            <?php if (has_post_thumbnail()):?>
                                <div class="entry-image mb-16">
                                    <figure class="featured-media featured-media-medium">
                                        <a href="<?php the_permalink() ?>">
                                            <?php
                                            the_post_thumbnail('medium_large', array(
                                                'alt' => the_title_attribute(array(
                                                    'echo' => false,
                                                )),
                                            ));
                                            ?>
                                        </a>
                                        <?php if (restochef_get_option('show_lightbox_image')) { ?>
                                            <a href="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" class="featured-media-fullscreen" data-glightbox="">
                                                <?php restochef_theme_svg('fullscreen'); ?>
                                            </a>
                                        <?php } ?>
                                    </figure>
                                </div>
                            <?php endif; ?>
                            <?php if ($enable_category_meta) { ?>
                                <div class="entry-categories">
                                    <?php the_category(' '); ?>
                                </div><!-- .entry-categories -->
                            <?php } ?>
      
                            <header class="entry-header">
                                <?php the_title( '<h3 class="entry-title font-size-medium mb-8"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
                            </header>
                            <?php if ($enable_post_excerpt) { ?>
                                <div class="entry-content">
                                    <?php the_excerpt(); ?>
                                </div>
                            <?php } ?>
                            <?php if ($enable_date_meta) {  restochef_posted_on(); } ?>
                            <?php if ($enable_author_meta) { restochef_posted_by(); } ?>
                        </article>
                      </div>
                  <?php
                  endwhile;
                  wp_reset_postdata();
                  ?>
                </div>

                <div class="swiper-pagination"></div>
              </div>
             </div>
        </div>

    </div>
</section>
<?php endif; ?>
        