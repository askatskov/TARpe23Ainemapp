<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Restochef
 */

get_header();

global $wp_query;

$archive_title = sprintf(
    '%1$s %2$s',
    '<span class="color-accent">' . __('Search:', 'restochef') . '</span>',
    '&ldquo;' . get_search_query() . '&rdquo;'
);

if ($wp_query->found_posts) {
    $archive_subtitle = sprintf(
    /* translators: %s: Number of search results. */
        _n(
            '%s result for your search.',
            '%s results for your search.',
            $wp_query->found_posts,
            'restochef'
        ),
        number_format_i18n($wp_query->found_posts)
    );
} else {
    $archive_subtitle = __('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'restochef');
}
?>
    <main id="site-content" role="main">
        <div class="wrapper">
            <div id="primary" class="content-area theme-sticky-component">

                <?php if (have_posts()) : ?>

                    <header class="page-header">
                        <h1 class="page-title">
                            <?php
                            /* translators: %s: search query. */
                            printf(esc_html__('Search Results for: %s', 'restochef'), '<span>' . get_search_query() . '</span>');
                            ?>
                        </h1>
                    </header><!-- .page-header -->

                    <?php

                    echo '<div class="restochef-article-wrapper">';
                    /* Start the Loop */
                    while (have_posts()) :
                        the_post();

                        /**
                         * Run the loop for the search to output the results.
                         * If you want to overload this in a child theme then include a file
                         * called content-search.php and that will be used instead.
                         */
                        get_template_part('template-parts/content', 'search');

                    endwhile;

                    echo '</div><!-- .restochef-article-wrapper -->';

                    get_template_part('template-parts/pagination');

                else :

                    ?>
                    <header class="page-header">
                        <div class="archive-header-content-wrap">
                            <h1 class="archive-title">
                                <?php echo wp_kses_post($archive_title); ?>
                            </h1>
                            <div class="archive-subtitle"><?php echo wp_kses_post(wpautop($archive_subtitle)); ?></div>
                        </div>
                    </header><!-- .page-header -->

                    <div class="no-search-results-form">
                        <?php
                        get_search_form(
                            array(
                                'aria_label' => __('search again', 'restochef'),
                            )
                        );
                        ?>
                    </div><!-- .no-search-results -->

                <?php

                endif;
                ?>


            </div>

            <?php
            $page_layout = restochef_get_page_layout();
            if ('no-sidebar' != $page_layout):
                get_sidebar();
            endif;
            ?>
        </div>
    </main>

<?php
get_footer();
