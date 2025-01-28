<?php
/**
 * Displays the site header.
 *
 * @package Restochef
 */


$header_style = restochef_get_option('header_style');

$header_template = str_replace('header_', '', $header_style);
$header_template = str_replace('_', '-', $header_template);
?>
    <?php
    get_template_part('template-parts/header/styles/' . $header_template);
    ?>

<?php get_template_part('template-parts/header/components/header-offcanvas-widget'); ?>
<?php get_template_part('template-parts/header/components/header-offcanvas'); ?>
<?php get_template_part('template-parts/header/components/header-search'); ?>

<?php
if ((is_home() || is_front_page()) && !is_paged()) {
    get_template_part('template-parts/front-page/banner-section');
}
?>
