<?php
/**
 * Displays Image Gallery Section
 *
 * @package Restochef
 */
$enable_image_gallery_section = restochef_get_option('enable_image_gallery_section');
$image_gallery_title = restochef_get_option('image_gallery_title');
$image_gallery_sub_title = restochef_get_option('image_gallery_sub_title');

if ($enable_image_gallery_section) {
    ?>
    <section class="restochef-social-images theme-block">
        <div class="wrapper">
            <div class="column-row">
                <div class="column column-12">
                    <div class="restochef-section-header text-center">
                        <h2 class="font-size-large mb-8">
                          <?php echo esc_html($image_gallery_title); ?>
                        </h2>

                        <p class = "m-0">
                          <?php echo wp_kses_post($image_gallery_sub_title); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="social-images-container">
          <?php for ($i=1; $i <= 6 ; $i++) {
            $upload_image_gallery = restochef_get_option('upload_image_gallery_'.$i);
            $upload_image_gallery_link = restochef_get_option('upload_image_gallery_link_'.$i);
            if (!empty($upload_image_gallery)) { ?>
             <div class="image-size-small adjust-image-size">
                 <a href="<?php echo esc_url($upload_image_gallery_link); ?>" target="_blank">
                     <img src="<?php echo esc_url($upload_image_gallery); ?>">
                 </a>
             </div>
           <?php } 
          } ?>
        </div>
    </section>

<?php }