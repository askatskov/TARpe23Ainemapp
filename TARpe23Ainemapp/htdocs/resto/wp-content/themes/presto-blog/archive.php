<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Presto_Blog
 */

get_header(); ?>

    <main id="main" class="site-main">
		<?php
			if ( have_posts() ) :

				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					* Include the Post-Type-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Type name) and that will be used instead.
					*/
					get_template_part( 'template-parts/content', get_post_type() );

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