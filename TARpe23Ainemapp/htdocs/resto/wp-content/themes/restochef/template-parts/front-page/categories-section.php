<?php
/**
 * Displays Category Section
 *
 * @package Restochef
 */
$enable_category_section = restochef_get_option('enable_category_section');
$enable_image_fix_option = restochef_get_option('enable_image_fix_option');
$category_section_title = restochef_get_option('category_section_title');
$category_section_content = restochef_get_option('category_section_content');
$category_section_bg_image = restochef_get_option('category_section_bg_image');
if ($enable_category_section) {
    ?>
    <div class="restochef-featured-menu<?php if($category_section_bg_image){ echo " data-bg ";} ?><?php if($enable_image_fix_option){ echo " data-bg-fixed ";} ?> theme-block" data-background= "<?php echo esc_url($category_section_bg_image); ?>">
      <div class="wrapper">
        <div class="restochef-section-header text-center">
            <?php if ($category_section_title) { ?>
                <h2 class="font-size-xlarge fw-semi-bold m-0 mb-16">
                  <?php echo esc_html($category_section_title); ?>
                </h2>
            <?php } ?>
            <?php if ($category_section_content) { ?>
                <p>
                  <?php echo esc_html($category_section_content); ?>
                </p>
            <?php } ?>
        </div>

        <div class="restochef-section-body">

            <?php
            for ($x = 1; $x <= 6; $x++) {
                $c_category = get_theme_mod('select_featured_cat_' . $x);
                if ($c_category) {
                    $cat_obj = get_category_by_slug($c_category);
                    $cat_name = isset($cat_obj->name) ? $cat_obj->name : '';
                    $cat_id = isset($cat_obj->term_id) ? $cat_obj->term_id : '';
                    $cat_link = get_category_link($cat_id);
                    $twp_term_description = category_description($cat_id);
                    $twp_term_image = get_term_meta($cat_id, 'twp-term-featured-image', true); ?>

                    <div class="our-menu-item">
                        <?php if (!empty($twp_term_image)) { ?>
                            <img src="<?php echo esc_url($twp_term_image); ?>">
                        <?php } ?>
                      <?php
                      if ($cat_name) { ?>
                          <h2 class="font-size-medium mb-16">
                              <a href="<?php echo esc_url($cat_link); ?>" class="btn-readmore">
                                  <span><?php echo esc_html($cat_name); ?></span>
                              </a>
                          </h2>
                      <?php } ?>
                        <?php if ($twp_term_description) {
                            echo wp_kses_post($twp_term_description);
                        } ?>
                    </div>
                    <?php
                }
            } ?>

        </div>
      </div>
    </div>
<?php }