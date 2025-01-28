<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Restochef
 */

get_header();
?>
    <section class="site-section site-error-section">
        <div class="error-section-content">
            <h1 class="page-title">
                <?php esc_html_e('404', 'restochef'); ?>
            </h1>
            <div class="error-section-description">
                <p><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'restochef'); ?></p>
                <a href="<?php echo esc_url(home_url()); ?>"><?php esc_html_e('Return Home', 'restochef'); ?></a>
            </div>
        </div>
    </section>
<?php
get_footer();
