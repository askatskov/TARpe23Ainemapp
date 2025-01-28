<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Restochef
 */

$enabled_post_meta = array();
$archive_style = restochef_get_option('archive_style');
switch ($archive_style) {
    case 'archive_style_1':
        $enabled_post_meta = restochef_get_option('archive_post_meta_1');
    break;
    case 'archive_style_2':
        $enabled_post_meta = restochef_get_option('archive_post_meta_2');
    break;
    case 'archive_style_3':
        $enabled_post_meta = restochef_get_option('archive_post_meta_3');
    break;
    case 'archive_style_4':
        $enabled_post_meta = restochef_get_option('archive_post_meta_4');
    break;
    
    default:
        // code...
        break;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('mb-24'); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title font-size-big"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php
			restochef_posted_on();
			restochef_posted_by();
			?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php restochef_post_thumbnail(); ?>
	<?PHP if ( absint(restochef_get_option( 'excerpt_length' )) != '0'){ ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	<?php } ?>

	<footer class="entry-footer">
		<?php restochef_entry_footer($enabled_post_meta); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
