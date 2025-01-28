<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Restochef
 */

get_header();
// Add a main container in case if sidebar is present
$class = '';
$page_layout = restochef_get_page_layout();

global $post;
$restochef_page_layout = esc_html( get_post_meta( $post->ID, 'restochef_page_layout', true ) );
$restochef_header_overlay = esc_html( get_post_meta( $post->ID, 'restochef_header_overlay', true ) );
echo $restochef_header_overlay;
$featured_image = "";
if (has_post_thumbnail($post->ID)) {
    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large');
    $featured_image = isset($featured_image[0]) ? $featured_image[0] : '';
}

if ($restochef_page_layout == "layout-2") { ?>

    <div class="single-featured-banner <?php if($restochef_header_overlay == 'enable-overlay'){ echo "has-single-banner-overlay";} ?>">
        <div class="featured-banner-media">
            <div class="data-bg image-size-large data-bg-fixed" data-background="<?php echo esc_url($featured_image); ?>"></div>
        </div>
        <?php $display_read_time_in = restochef_get_option('display_read_time_in');
        if (in_array('single-page', $display_read_time_in)) {
            restochef_read_time();
        } ?>
        <div class="featured-banner-content">
            <div class="wrapper">
                <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title font-size-large">', '</h1>' ); ?>
                </header><!-- .entry-header -->
            </div>
        </div>
    </div>

<?php } ?>
    <main id="site-content" role="main">
        <div class="wrapper">
            <div id="primary" class="content-area theme-sticky-component">
                <?php
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
                ?>
            </div><!-- #primary -->
        </div>
    </main>
<?php
get_footer();