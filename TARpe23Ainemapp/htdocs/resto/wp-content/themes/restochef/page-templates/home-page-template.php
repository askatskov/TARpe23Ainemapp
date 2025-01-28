<?php
/**
 * Template Name: Homepage Page Template
 * Template Post Type: post, page, product
 * Displays the Page Template provided via the theme.
 *
 * @package    Restochef
 * @since      Restochef 1.0.0
 */
get_header();

get_template_part('template-parts/front-page/time-bar');
get_template_part('template-parts/front-page/about-section');
?>
    <?php 
    $tevern_homepage_content = get_the_content();
    if (!empty($tevern_homepage_content)) { ?>
    	<div class="restochef-our-specialties theme-block">
    	  <div class="wrapper">
    			<?php the_content(); ?>
    		</div>
    	</div>
    <?php } ?>
<?php 
get_template_part('template-parts/front-page/categories-section');
get_template_part('template-parts/front-page/featured-food');
get_template_part('template-parts/front-page/video-cta-section');
get_template_part('template-parts/front-page/featured-logo');
get_template_part('template-parts/front-page/contact-section');
get_template_part('template-parts/front-page/featured-image-gallery');

get_footer();
