<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Presto_Blog
 */

$sidebar = presto_blog_sidebar();

if ( ! $sidebar ){
	return;
}

?>

<aside id="secondary" class="widget-area" <?php presto_blog_microdata( 'sidebar' ); ?>>
	<?php dynamic_sidebar( $sidebar ); ?>
</aside><!-- #secondary -->
