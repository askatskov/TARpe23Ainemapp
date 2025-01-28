<?php
/**
 * Displays About Section
 *
 * @package Restochef
 */
$enable_about_section = restochef_get_option('enable_about_section');
$about_post_title = restochef_get_option('about_post_title');
$about_section_button_text = restochef_get_option('about_section_button_text');
$about_section_button_url = restochef_get_option('about_section_button_url');
$select_about_page = get_theme_mod('select_about_page');
$about_page_query = new WP_Query(array('posts_per_page' => 1,
        'post_type' => 'page',
        'page_id' => $select_about_page,)
);
if ($enable_about_section) {
    ?>


<section class="restochef-about-us theme-block">
    <div class="wrapper">
        <?php if ($about_page_query->have_posts()):
            while ($about_page_query->have_posts()): $about_page_query->the_post();

                ?>
                <div class="about-us-container">
                    <?php
                    if (has_post_thumbnail()) {
                        ?>
                        <div class="image-size-large image-size-fill">
                            <?php
                            the_post_thumbnail('large', array(
                                'alt' => the_title_attribute(array(
                                    'echo' => false,
                                )),
                            ));
                            ?>
                        </div>
                        <?php
                    }
                    ?>

                    <div class="about-us-content">
                        <?php if (!empty($about_post_title)) { ?>
                            <h2 class="font-size-xlarge fw-semi-bold mb-24 mb-sm-16">
                                <?php echo esc_html($about_post_title); ?>
                            </h2>
                        <?php } ?>
                        <h3 class="font-size-medium fw-regular font-family-general mb-24 mb-sm-16">
                            <?php the_title(); ?>
                        </h3>
                        <?php
                        if (has_excerpt()) {
                            the_excerpt();
                        } else {
                            echo '<p>';
                            echo esc_html(wp_trim_words(get_the_content(), 80, '...'));
                            echo '</p>';
                        } ?>
                        <?php if (!empty($about_section_button_text)) { ?>
                            <a href="<?php echo esc_url($about_section_button_url); ?>" class="theme-primary-btn"> <?php echo esc_html($about_section_button_text); ?> </a>
                        <?php } ?>
                    </div>
                </div>
            <?php
            endwhile;
            wp_reset_postdata();
        endif; ?>
    </div>
</section>
<?php }