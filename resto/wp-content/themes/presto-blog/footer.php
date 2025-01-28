<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Presto_Blog
 */

    /**
     * Content End
     * 
     * @hooked presto_blog_content_end - 15
     */
    do_action( 'presto_blog_content_end' );

    /**
     * @hooked presto_blog_related_posts- 10
     * @hooked presto_blog_comments- 20
    */
    do_action( 'presto_blog_after_single_container' );    

    /**
     * Before Footer
     * 
     * @hooked presto_blog_ad_before_footer     - 20
     * @hooked presto_blog_newsletter           - 25
     * @hooked presto_blog_instagram            - 30
     */
    do_action( 'presto_blog_before_footer' );
    
    /**
     * @hooked presto_blog_footer_start  - 15
     * @hooked presto_blog_footer_top    - 20 
     * @hooked presto_blog_footer_bottom - 25
     * @hooked presto_blog_scrolltotop   - 30
     * @hooked presto_blog_footer_end    - 35 
     */
    do_action( 'presto_blog_footer' );
    
    /**
     * After Footer
     * 
     * @hooked presto_blog_page_end - 15
    */
    do_action( 'presto_blog_after_footer' );
    
    wp_footer(); ?>

</body>
</html>