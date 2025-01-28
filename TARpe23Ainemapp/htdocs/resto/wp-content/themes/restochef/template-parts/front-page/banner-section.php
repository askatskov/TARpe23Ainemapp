<?php
/**
 * Displays Banner Section
 *
 * @package Restochef
 */
$is_banner_section = restochef_get_option('enable_banner_section');
$enable_banner_overlay = restochef_get_option('enable_banner_overlay');
$banner_section_cat = restochef_get_option( 'banner_section_cat' );
$number_of_slider_post = restochef_get_option( 'number_of_slider_post' );
$enable_banner_cat_meta = restochef_get_option( 'enable_banner_cat_meta' );
$enable_banner_author_meta = restochef_get_option( 'enable_banner_author_meta' );
$enable_banner_date_meta = restochef_get_option( 'enable_banner_date_meta' );
$enable_banner_post_description = restochef_get_option( 'enable_banner_post_description' );
$slider_post_content_alignment = restochef_get_option( 'slider_post_content_alignment' );
$featured_image = "";
$banner_overlay_class = '';
if ($enable_banner_overlay) {
    $banner_overlay_class = 'data-bg-overlay';
}
if ($is_banner_section){
?>

<section class="site-banner-section theme-block">
      <div class="wrapper">
        <div class="column-row">
          <div class="column column-12">
            <div class="theme-banner-slider swiper-container">
            <div class="swiper-wrapper">
              <?php $banner_post_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => absint($number_of_slider_post), 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($banner_section_cat)));
                  if( $banner_post_query->have_posts() ):
                      while ($banner_post_query->have_posts()): $banner_post_query->the_post();
                          ?>
                          <div class="swiper-slide">
                                      <div class="justify-content-center <?php echo $slider_post_content_alignment; ?>">
                                          <div class="slider-content-container">
                                              <div class="slider-content">
                                                  <?php if ($enable_banner_cat_meta) { ?>
                                                      <div class="entry-categories">
                                                          <?php the_category(' '); ?>
                                                      </div><!-- .entry-categories -->
                                                  <?php } ?>
      
                                                  <?php the_title( '<h2 class="entry-title font-size-xlarge"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

                                                  <div>
                                                      <?php if ($enable_banner_date_meta) { restochef_posted_on(); } ?>
                                                      <?php if ($enable_banner_author_meta) { restochef_posted_by();} ?>
                                                  </div>

                                                  <?php if ($enable_banner_post_description) { ?>
                                                      <div class="hidden-xs-screen">
                                                          <?php
                                                          if (has_excerpt()) {
                                                              the_excerpt();
                                                          } else {
                                                              $read_more_link = '<a href="' . get_permalink() . '" class="theme-primary-btn primary-btn-with-arrow">' . esc_html__('Discover more', 'restochef') . restochef_get_theme_svg('arrow-right') . '</a>';
                                                              echo '<p>';
                                                              $content = wp_trim_words(get_the_content(), 30, '');
                                                              echo $content . ' ' . $read_more_link;
                                                              echo '</p>';
                                                          }
                                                          ?>

                                                      </div>
                                                  <?php } ?>

                                              </div>

                                              <?php
                                              if (has_post_thumbnail()) {
                                                  ?>
                                                  <div class="slider-image">
                                                      <?php
                                                      the_post_thumbnail('large', array(
                                                          'alt' => the_title_attribute(array(
                                                              'echo' => false,
                                                          )),
                                                      ));
                                                      ?>
                                                  </div>
                                                  <?php
                                              }
                                              ?>

                                          </div>
                                      </div>
                          </div>
      
                          <?php
                      endwhile;
                  wp_reset_postdata();
                  endif; ?>
              </div>
      
              <!-- Control -->
      
              <div class="theme-swiper-control swiper-control">
                  <div class="swiper-pagination theme-swiper-pagination"></div>
              </div>
          </div>
        </div>
      </div>

    </div>
</section>
<?php }