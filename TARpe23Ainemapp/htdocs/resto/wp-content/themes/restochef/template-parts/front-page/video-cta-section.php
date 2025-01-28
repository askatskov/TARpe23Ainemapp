<?php
/**
 * Displays Video CTA Section
 *
 * @package Restochef
 */
$enable_video_cta_section = restochef_get_option('enable_video_cta_section');
$video_cta_post_title = restochef_get_option('video_cta_post_title');
$video_cta_post_sub_title = restochef_get_option('video_cta_post_sub_title');
$upload_video_image_1 = restochef_get_option('upload_video_image_1');
$video_url_link = restochef_get_option('video_url_link');
$video_cta_button_text = restochef_get_option('video_cta_button_text');
$video_cta_button_url = restochef_get_option('video_cta_button_url');

if ($enable_video_cta_section) {
    ?>

    <section class="restochef-video-cta theme-block">
        <div class="video-cta-image image-size-large adjust-image-size">
          <?php if ($upload_video_image_1) { ?>
            <img src="<?php echo esc_url($upload_video_image_1); ?>">
          <?php
          }
          ?>
        </div>

        <div class="cta-content-container">
          <div class="video-cta-content">
              <h2 class="font-size-large mb-24">
                  <?php echo esc_html($video_cta_post_title); ?>
              </h2>
  
              <p class="m-0 mb-24">
                  <?php echo esc_html($video_cta_post_sub_title); ?>
              </p>
  
              <div class="video-cta-button-group">
                <a href="<?php echo esc_url($video_cta_button_url); ?>" class="theme-primary-btn"> <?php echo esc_html($video_cta_button_text); ?> </a>
                
                <button class="restochef-video-btn">
                  <?php restochef_theme_svg('play'); ?>
                </button>
              </div>
  
          </div>      
        </div>


        <div class="video-cta-popup">
          <div class="video-popup-overlay"></div>
          <div class="video-popup-content">
            <iframe src="<?php echo esc_url( $video_url_link ); ?>"></iframe>
            <?php restochef_theme_svg('cross'); ?>
          </div>
        </div>
    </section>


<?php }