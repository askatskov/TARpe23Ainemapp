<?php
/**
 * Displays Logo Section
 *
 * @package Restochef
 */
$enable_logo_section = restochef_get_option('enable_logo_section');
if ($enable_logo_section) {
    ?>
    <section class="restochef-featured-on theme-block">
        <div class="wrapper">
            <div class="featured-on-container swiper">
                <div class="swiper-wrapper">
                    <?php for ($i=1; $i <= 7 ; $i++) {
                      $upload_image = restochef_get_option('upload_image_'.$i);
                      $upload_image_link = restochef_get_option('upload_image_link_'.$i);
                      if (!empty($upload_image)) { ?>
                       <div class="swiper-slide">
                           <div class="feature-on-image">
                               <a href="<?php echo esc_url($upload_image_link); ?>" target="_blank">
                                   <img src="<?php echo esc_url($upload_image); ?>">
                               </a>
                           </div>
                       </div>
                     <?php } 
                    } ?>
                </div>

                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
<?php }