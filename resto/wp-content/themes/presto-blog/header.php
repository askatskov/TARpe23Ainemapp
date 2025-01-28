<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Presto_Blog
 */
    /**
     * Doctype Hook
     * 
     * @hooked presto_blog_doctype
    */
    do_action( 'presto_blog_doctype' );
?>
<head <?php presto_blog_microdata( 'head' ); ?>>
	<?php 
    /**
     * Before wp_head
     * 
     * @hooked presto_blog_head
    */
    do_action( 'presto_blog_before_wp_head' );
    
    wp_head(); ?>
</head>

<body <?php body_class(); presto_blog_microdata( 'body' ); ?>>
<?php
    wp_body_open();
    
    /**
     * Before Header
     * 
     * @hooked presto_blog_page_start - 20 
    */
    do_action( 'presto_blog_before_header' );

	/**
     * Header
     * 
     * @hooked presto_blog_header - 20     
    */
    do_action( 'presto_blog_header' );
    
	/**
     * After header
     * 
     * @hooked presto_blog_banner                - 15
     * @hooked presto_blog_home_featured_section - 20
     * @hooked presto_blog_ad_after_header       - 25
     */
    do_action( 'presto_blog_after_header' );

    /**
     * Content Start
     * 
     * @hooked presto_blog_content_start - 15
     */
    do_action( 'presto_blog_content_start' );