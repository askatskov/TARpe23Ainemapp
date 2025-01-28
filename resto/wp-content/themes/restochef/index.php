<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Restochef
 */

get_header();
/*Set the query var to use proper template file */
$archive_style = restochef_get_option('archive_style');
if (empty($archive_style)) {
    $archive_style = 'archive_style_1';
}
set_query_var('archive_style', $archive_style);

// Add a main container in case if sidebar is present
$class = '';
$page_layout = restochef_get_page_layout();
 ?>
    <main id="site-content" role="main">
        <div class="wrapper">
            <div id="primary" class="content-area theme-sticky-component">

                <?php
                if (have_posts()) :

                    if (is_home() && !is_front_page()) :
                        ?>
                        <header>
                            <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                        </header>
                    <?php
                    endif;

                    echo '<div class="restochef-article-wrapper restochef-' . esc_attr($archive_style) . '">';
                    /* Start the Loop */
                    while (have_posts()) :
                        the_post();

                        /*
                         * Include the Post-Type-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                         */
                        get_template_part('template-parts/content', 'archive');

                    endwhile;

                    echo '</div><!-- .restochef-article-wrapper -->';

                    get_template_part('template-parts/pagination');

                else :

                    get_template_part('template-parts/content', 'none');

                endif;
                ?>

            </div>
            <?php
            if ('no-sidebar' != $page_layout) {
                get_sidebar();
            }
            ?>
        </div>
    </main>
<?php

get_footer();
