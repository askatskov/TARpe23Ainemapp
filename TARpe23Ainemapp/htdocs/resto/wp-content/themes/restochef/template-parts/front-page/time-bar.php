<?php
/**
 * Displays Time Bar Section
 *
 * @package Restochef
 */
$enable_time_bar_section = restochef_get_option('enable_time_bar_section');
$enable_time_bar_fullwidth = restochef_get_option('enable_time_bar_fullwidth');
$time_bar_title_1 = restochef_get_option('time_bar_title_1');
$time_bar_content_1 = restochef_get_option('time_bar_content_1');
$time_bar_title_2 = restochef_get_option('time_bar_title_2');
$time_bar_content_2 = restochef_get_option('time_bar_content_2');
$time_bar_title_3 = restochef_get_option('time_bar_title_3');
$time_bar_content_3 = restochef_get_option('time_bar_content_3');
$time_bar_button_text = restochef_get_option('time_bar_button_text');
$time_bar_button_url = restochef_get_option('time_bar_button_url');

if ($enable_time_bar_section) {
    ?>
    <div class="restochef-timetable theme-block <?php if ($enable_time_bar_fullwidth) { echo "timebar-full-width"; }?>">
        <?php if ($time_bar_title_1) { ?>
          <div class="time-table-item">
            <h2 class="font-size-medium mb-8">
              <?php echo esc_html($time_bar_title_1); ?>
            </h2>
            <span> <?php echo esc_html($time_bar_content_1); ?></span>
          </div>
        <?php } ?>
        <?php if ($time_bar_title_2) { ?>

      <div class="time-table-item">
        <h2 class="font-size-medium mb-8">
                        <?php echo esc_html($time_bar_title_2); ?>
        </h2>
            <span> <?php echo esc_html($time_bar_content_2); ?></span>
      </div>
        <?php } ?>
        <?php if ($time_bar_title_3) { ?>


      <div class="time-table-item">
        <h2 class="font-size-medium mb-8">
          <?php echo esc_html($time_bar_title_3); ?>
        </h2>
            <span> <?php echo esc_html($time_bar_content_3); ?></span>
      </div>
        <?php } ?>
        <?php if ($time_bar_button_text) { ?>

      <a href="<?php echo esc_url($time_bar_button_url); ?>"><?php echo esc_html($time_bar_button_text); ?> </a>
        <?php } ?>

    </div>
<?php }