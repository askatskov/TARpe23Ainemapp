<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Presto_Blog
 */

get_header();
?>
	<main id="main" class="site-main">
		<?php
			if ( have_posts() ) :

				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content' );

				endwhile;

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
		?>
	</main><!-- #main -->
	
    <?php
    /**
     * @hooked presto_blog_pagination - 15
    */
    do_action( 'presto_blog_after_posts' );
    
get_footer();