<?php
if (!defined('ABSPATH')) {
    exit;
}

class Restochef_Call_To_Action extends Restochef_Widget_Base
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->widget_cssclass = 'restochef-widget-cta';
        $this->widget_description = __("Adds Call to action section", 'restochef');
        $this->widget_id = 'restochef_call_to_action';
        $this->widget_name = __('Restochef: Call To Action', 'restochef');
        $this->settings = array(
            'title' => array(
                'type' => 'text',
                'label' => __('CTA Title', 'restochef'),
            ),
            'title_text' => array(
                'type' => 'text',
                'label' => __('CTA Subtitle', 'restochef'),
            ),
            'desc' => array(
                'type' => 'textarea',
                'label' => __('CTA Description', 'restochef'),
                'rows' => 10,
            ),
            'bg_image' => array(
                'type' => 'image',
                'label' => __('Background Image', 'restochef'),
            ),
            'btn_text' => array(
                'type' => 'text',
                'label' => __('Button Text', 'restochef'),
            ),
            'btn_link' => array(
                'type' => 'url',
                'label' => __('Link to url', 'restochef'),
                'desc' => __('Enter a proper url with http: OR https:', 'restochef'),
            ),
            'link_target' => array(
                'type' => 'checkbox',
                'label' => __('Open Link in new Tab', 'restochef'),
                'std' => true,
            ),
            'msg' => array(
                'type' => 'message',
                'label' => __('Additonal Settings', 'restochef'),
            ),
            'height' => array(
                'type' => 'number',
                'step' => 20,
                'min' => 300,
                'max' => 700,
                'std' => 500,
                'label' => __('Height: Between 300px and 700px (Default 500px)', 'restochef'),
            ),
            'bg_color_option' => array(
                'type' => 'color',
                'label' => __('Background Color', 'restochef'),
                'std' => '#000000',
            ),
            'text_color_option' => array(
                'type' => 'color',
                'label' => __('Text Color', 'restochef'),
                'std' => '#ffffff',
            ),
            'text_align' => array(
                'type' => 'select',
                'label' => __('Text Alignment', 'restochef'),
                'options' => array(
                    'left' => __('Left Align', 'restochef'),
                    'center' => __('Center Align', 'restochef'),
                    'right' => __('Right Align', 'restochef'),
                ),
                'std' => 'left',
            ),
            'enable_fixed_bg' => array(
                'type' => 'checkbox',
                'label' => __('Enable Fixed Background Image', 'restochef'),
                'std' => true,
            ),
            'bg_overlay_color' => array(
                'type' => 'color',
                'label' => __('Overlay Background Color', 'restochef'),
                'std' => '#000000',
            ),
            'overlay_opacity' => array(
                'type' => 'number',
                'step' => 10,
                'min' => 0,
                'max' => 100,
                'std' => 50,
                'label' => __('Overlay Opacity (Default 50%)', 'restochef'),
            ),
        );
        parent::__construct();
    }


    /**
     * Output widget.
     *
     * @param array $args
     * @param array $instance
     * @see WP_Widget
     *
     */
    public function widget($args, $instance)
    {
        ob_start();
        echo $args['before_widget'];
        do_action('restochef_before_cta');
        $bg_color_option = "";
        if (isset($instance['bg_color_option'])) {
            $bg_color_option = $instance['bg_color_option'];
        }

        $style_text = 'color:' . $instance['text_color_option'] . ';';
        $style_text .= 'background-color:' . $bg_color_option . ';';
        $style_text .= 'min-height:' . $instance['height'] . 'px;';
        $style_text .= 'text-align:' . $instance['text_align'] . ';';
        $style = 'background-color:' . $instance['bg_overlay_color'] . ';';
        $style .= 'opacity:' . ($instance['overlay_opacity'] / 100) . ';';
        ?>
        <div class="restochef-cta-widget restochef-cover-block <?php echo ($instance['enable_fixed_bg']) ? 'restochef-bg-image restochef-bg-attachment-fixed' : ''; ?>"
             style="<?php echo esc_attr($style_text); ?>">
            <span aria-hidden="true" class="restochef-block-overlay" style="<?php echo esc_attr($style); ?>"></span>
            <?php echo wp_get_attachment_image($instance['bg_image'], 'full'); ?>
            <div class="wrapper restochef-cta-inner-wrapper restochef-block-inner-wrapper">
                <div class="column-row">
                    <div class="column column-8 column-sm-12">
                        <?php if ($instance['title']) : ?>
                            <h2 class="entry-title entry-title-large">
                                <?php echo esc_html($instance['title']); ?>
                            </h2>
                        <?php endif; ?>
                        <?php if ($instance['title_text']) : ?>
                            <h3 class="entry-title entry-title-big">
                                <?php echo esc_html($instance['title_text']); ?>
                            </h3>
                        <?php endif; ?>
                        <?php if ($instance['desc']) : ?>
                            <div class="entry-content entry-content-big">
                                <?php echo wpautop(wp_kses_post($instance['desc'])); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($instance['btn_text']) : ?>
                            <footer class="entry-footer">
                                <a href="<?php echo ($instance['btn_link']) ? esc_url($instance['btn_link']) : ''; ?>"
                                   target="<?php echo ($instance['link_target']) ? "_blank" : '_self'; ?>"
                                   class="theme-button theme-button-big">
                                    <?php echo esc_html(($instance['btn_text'])); ?>
                                </a>
                            </footer>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        do_action('restochef_after_cta');
        echo $args['after_widget'];
        echo ob_get_clean();
    }
}