<?php
/**
 * Displays header site branding
 *
 * @package Restochef
 */

$blog_info    = get_bloginfo( 'name' );
$description  = get_bloginfo( 'description', 'display' );

$hide_title = restochef_get_option('hide_title');
$hide_tagline = restochef_get_option('hide_tagline');

$header_dark_logo = get_theme_mod( 'header_dark_logo' );
$dark_class = '';
if ($header_dark_logo){
    $dark_class = 'has-dark-logo';
}

$header_class = $hide_title ? 'screen-reader-text' : 'site-title';
?>
<div class="site-branding <?php echo $dark_class; ?>">
    <?php if (has_custom_logo()) : ?>
        <div class="site-logo site-logo-default">
            <?php the_custom_logo(); ?>
        </div>
    <?php endif; ?>

    <?php if ($header_dark_logo) : ?>
        <div class="site-logo site-logo-dark">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="custom-logo-link">
                <img src="<?php echo esc_url($header_dark_logo); ?>" class="custom-logo">
            </a>
        </div>
    <?php endif; ?>

    <?php if (is_front_page() && is_home() && $blog_info) : ?>
        <h1 class="<?php echo esc_attr($header_class); ?>">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html($blog_info); ?></a>
        </h1>
    <?php else : ?>
        <div class="<?php echo esc_attr($header_class); ?>">
            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
        </div>
    <?php endif; ?>
    <?php if ($description && !$hide_tagline) : ?>
        <div class="site-description">
            <span><?php echo $description; ?></span>
        </div>
    <?php endif; ?>
</div><!-- .site-branding -->