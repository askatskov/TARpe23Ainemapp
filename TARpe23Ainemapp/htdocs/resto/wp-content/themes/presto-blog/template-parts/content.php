<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Presto_Blog
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); presto_blog_microdata( 'article' ); ?>>
	<?php presto_blog_post_thumbnail(); ?>
	<header class="entry-header">
		<?php 
			presto_blog_category();
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );		
        
		    if ( 'post' === get_post_type() ){ ?>
                <div class="entry-meta">
                    <?php presto_blog_posted_on(); ?>
                </div><!-- .entry-meta -->
                <?php 
            } 
        ?>
	</header><!-- .entry-header -->
</article><!-- ##post -->