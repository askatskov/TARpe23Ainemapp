<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Adds Restochef_Author_Info widget.
 */
class Restochef_Author_Info extends WP_Widget {

    public $social_networks;

    /**
     * Sets up a new widget instance.
     *
     * @since 1.0.0
     */
    function __construct() {
        parent::__construct(
            'restochef_author_info_widget',
            esc_html__( 'Restochef: Author Info', 'restochef' ),
            array( 'description' => esc_html__( 'Displays author short info.', 'restochef' ), )
        );

        $this->social_networks = apply_filters( 'restochef_author_widget_social_networks', array(
                'facebook', 
                'twitter',
                'linkedin',
                'instagram',
                'pinterest',
                'youtube',
                'tiktok',
                'twitch',
                'vk',
                'whatsapp',
                'amazon',
                'codepen',
                'dropbox',
                'flickr',
                'vimeo',
                'spotify',
                'github',
                'reddit',
                'skype',
                'soundcloud',
        ));
    }

    /**
     * Outputs the content for the current widget instance.
     *
     * @since 1.0.0
     *
     * @param array $args  Display arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        if ( $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base ) ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        $style = $instance['style'];
        $style .= $instance['image_border_radius'] ? ' has-round-image': '';

        do_action( 'restochef_before_author_info');
        ?>
        <div class="theme-author-widget <?php echo esc_attr($style);?>">
            <?php
            if($instance['author_img']){
                ?>
                <div class="author-image">
                    <?php echo wp_get_attachment_image( absint($instance['author_img']), 'medium_large', "", array( "class" => "img-responsive" ) );  ?>
                </div>
                <?php
            }
            ?>
            <div class="author-details">
                <?php
                if($instance['author_name']){
                    ?>
                    <h3 class="author-name"><?php echo esc_html($instance['author_name']); ?></h3>
                    <?php
                }
                ?>
                <div class="author-social">
                    <?php
                    $social_networks = $this->social_networks;
                    if(!empty($social_networks) && is_array($social_networks)){
                        foreach($social_networks as $network){
                            if(!empty($instance[$network])){
                                $svg = Restochef_SVG_Icons::get_theme_svg_name( $instance[$network] );
                                if($svg){
                                    ?>
                                    <a href="<?php echo esc_url($instance[$network]); ?>" target="_blank">
                                        <?php echo $svg;?>
                                    </a>
                                    <?php
                                }
                            }
                        }
                    }
                    ?>
                </div>
                <div class="author-desc">
                    <?php
                    if($instance['author_desc']){
                        echo wpautop(wp_kses_post($instance['author_desc']));
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php

        do_action( 'restochef_after_author_info');

        echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @since 1.0.0
     *
     * @param array $instance Previously saved values from database.
     *
     * @return void
     */
    public function form( $instance ) {
        $title = !empty($instance['title']) ? $instance['title'] : '';
        $author_name = !empty($instance['author_name']) ? $instance['author_name'] : '';
        $author_desc = !empty($instance['author_desc']) ? $instance['author_desc'] : '';
        $author_img = !empty($instance['author_img']) ? $instance['author_img'] : '';
        $enable_image_border_radius = !empty($instance['image_border_radius']) ? (bool) $instance['image_border_radius'] : false;
        $style = !empty($instance['style']) ? $instance['style'] : 'style_1';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                <?php esc_attr_e('Title:', 'restochef'); ?>
            </label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('author_name')); ?>">
                <?php esc_attr_e('Author Name:', 'restochef'); ?>
            </label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('author_name')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('author_name')); ?>" type="text"
                   value="<?php echo esc_attr($author_name); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('author_desc')); ?>">
                <?php esc_attr_e('Short Description:', 'restochef'); ?>
            </label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('author_desc')); ?>"
                      name="<?php echo esc_attr($this->get_field_name('author_desc')); ?>" rows="10"><?php echo esc_textarea($author_desc);?></textarea>
        </p>
        <div>
            <label for="<?php echo esc_attr( $this->get_field_id( 'author_img' ) ); ?>">
                <?php esc_attr_e('Author Image:', 'restochef'); ?>
            </label>
            <?php
            $remove_button_style = ($author_img) ? 'display:inline-block' : 'display:none;';?>
            <div class="image-field">
                <div class="image-preview">
                    <?php
                    if ( ! empty( $author_img ) ) {
                        $image_attributes = wp_get_attachment_image_src( $author_img );
                        if($image_attributes){
                            ?>
                            <img src="<?php echo esc_url( $image_attributes[0] ); ?>" />
                            <?php
                        }
                    }
                    ?>
                </div>
                <p>
                    <input type="hidden" class="img" name="<?php echo esc_attr( $this->get_field_name( 'author_img' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'author_img' ) ); ?>" value="<?php echo esc_attr( $author_img ); ?>" />
                    <button type="button" class="upload_image_button button" data-uploader-title-txt="<?php esc_attr_e( 'Use Image', 'restochef' ); ?>" data-uploader-btn-txt="<?php esc_attr_e( 'Choose an Image', 'restochef' ); ?>">
                        <?php _e( 'Upload/Add image', 'restochef' ); ?>
                    </button>
                    <button type="button" class="remove_image_button button" style="<?php echo esc_attr($remove_button_style);?>"><?php _e( 'Remove image', 'restochef' ); ?></button>
                </p>
            </div>
        </div>
        <div>
            <p>
                <input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'image_border_radius' ) ) ?>" name="<?php echo esc_attr( $this->get_field_name( 'image_border_radius' ) ); ?>" value="1" <?php checked( $enable_image_border_radius, 1 ); ?>>
                <label for="<?php echo esc_attr($this->get_field_id('image_border_radius')); ?>">
                    <?php _e('Enable Imaged Border Radius', 'restochef'); ?>
                </label>
            </p>
        </div>
        <div>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'style' ) ); ?>">
                    <span class="field-label"><?php _e('Style', 'restochef'); ?></span>
                </label>
                <select id="<?php echo esc_attr( $this->get_field_id( 'style' ) ); ?>" name="<?php echo esc_attr($this->get_field_name('style')); ?>" class="widefat">
                    <option value="style_1" <?php selected('style_1', $style);?>><?php _e('Style 1', 'restochef'); ?></option>
                    <option value="style_2" <?php selected('style_2', $style);?>><?php _e('Style 2', 'restochef'); ?></option>
                    <option value="style_3" <?php selected('style_3', $style);?>><?php _e('Style 3', 'restochef'); ?></option>
                </select>
            </p>
        </div>
        <?php
        $social_networks = $this->social_networks;
        if(!empty($social_networks) && is_array($social_networks)){
            foreach ($social_networks as $network){
                $social_link = !empty($instance[$network]) ? $instance[$network] : '';
                ?>
                <p class="restochef-social-link">
                    <label for="<?php echo esc_attr($this->get_field_id($network)); ?>">
                        <?php echo esc_html(ucfirst($network)); ?>
                    </label>
                    <input class="widefat" id="<?php echo esc_attr($this->get_field_id($network)); ?>"
                           name="<?php echo esc_attr($this->get_field_name($network)); ?>" type="text"
                           value="<?php echo esc_url($social_link); ?>">
                </p>
                <?php
            }
        }
        ?>
        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @since 1.0.0
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();

        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        $instance['author_name'] = (!empty($new_instance['author_name'])) ? sanitize_text_field($new_instance['author_name']) : '';
        $instance['author_desc'] = (!empty($new_instance['author_desc'])) ? wp_kses_post($new_instance['author_desc']) : '';
        $instance['author_img'] = (!empty($new_instance['author_img'])) ? absint($new_instance['author_img']) : '';
        $instance['image_border_radius'] = (!empty($new_instance['image_border_radius'])) ? 1 : 0;
        $instance['style'] = (!empty($new_instance['style'])) ? sanitize_text_field($new_instance['style']) : 'style_1';


        $social_networks = $this->social_networks;
        if(!empty($social_networks) && is_array($social_networks)){
            foreach($social_networks as $network){
                $instance[$network] = (!empty($new_instance[$network])) ? esc_url_raw($new_instance[$network]) : '';
            }
        }

        return $instance;
    }

}