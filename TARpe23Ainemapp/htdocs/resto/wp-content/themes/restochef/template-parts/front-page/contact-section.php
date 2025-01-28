<?php
/**
 * Displays Contact Section
 *
 * @package Restochef
 */
$enable_contact_section = restochef_get_option('enable_contact_section');
$select_contact_page = get_theme_mod('select_contact_page');
$contact_page_query = new WP_Query(array('posts_per_page' => 1,
        'post_type' => 'page',
        'page_id' => $select_contact_page,)
);
if ($enable_contact_section) {
    ?>
    <?php if ($contact_page_query->have_posts()):
        while ($contact_page_query->have_posts()): $contact_page_query->the_post(); ?>
            <section class="restochef-contact-us theme-block">
              <div class="wrapper">
                <div class="column-row">
                    <?php the_content(); ?>
                </div>
              </div>
            </section>
        <?php
        endwhile;
        wp_reset_postdata();
    endif; 
}