<?php
/**
 * resto Custom Metabox
 *
 * @package resto
 */
$resto_post_types = array(
    'post',
    'page'
);

add_action('add_meta_boxes', 'resto_add_layout_metabox');
function resto_add_layout_metabox() {
    global $post;
    $frontpage_id = get_option('page_on_front');
    if( $post->ID == $frontpage_id ){
        return;
    }

    global $resto_post_types;
    foreach ( $resto_post_types as $post_type ) {
        add_meta_box(
            'resto_layout_options', // $id
            __( 'Layout options', 'resto' ), // $title
            'resto_layout_options_callback', // $callback
            $post_type, // $page
            'normal', // $context
            'high'// $priority
        );
    }

}
/* resto sidebar layout */
$resto_default_layout_options = array(
    'left-sidebar' => array(
        'value'     => 'left-sidebar',
        'thumbnail' => get_template_directory_uri() . '/inc/images/left-sidebar.png'
    ),
    'right-sidebar' => array(
        'value' => 'right-sidebar',
        'thumbnail' => get_template_directory_uri() . '/inc/images/right-sidebar.png'
    ),
    'no-sidebar' => array(
        'value'     => 'no-sidebar',
        'thumbnail' => get_template_directory_uri() . '/inc/images/no-sidebar.png'
    )
);
/* resto featured layout */
$resto_single_post_image_align_options = array(
    'full' => array(
        'value' => 'full',
        'label' => __( 'Full', 'resto' )
    ),
    'right' => array(
        'value' => 'right',
        'label' => __( 'Right ', 'resto' ),
    ),
    'left' => array(
        'value'     => 'left',
        'label' => __( 'Left', 'resto' ),
    ),
    'no-image' => array(
        'value'     => 'no-image',
        'label' => __( 'No Image', 'resto' )
    )
);

function resto_layout_options_callback() {

    global $post , $resto_default_layout_options, $resto_single_post_image_align_options;
    $resto_customizer_saved_values = resto_get_all_options(1);

    /*resto-single-post-image-align*/
    $resto_single_post_image_align = $resto_customizer_saved_values['resto-single-post-image-align'];

    /*resto default layout*/
    $resto_single_sidebar_layout = $resto_customizer_saved_values['resto-default-layout'];

    wp_nonce_field( basename( __FILE__ ), 'resto_layout_options_nonce' );
    ?>
    <style>
        .hide-radio{
            position: relative;
            margin-bottom: 6px;
        }

        .hide-radio img, .hide-radio label{
            display: block;
        }

        .hide-radio input[type="radio"]{
            position: absolute;
            left: 50%;
            top: 50%;
            opacity: 0;
        }

        .hide-radio input[type=radio] + label {
            border: 3px solid #F1F1F1;
        }

        .hide-radio input[type=radio]:checked + label {
            border: 3px solid #CCC;
        }
    </style>
    <table class="form-table page-meta-box">
        <!--Image alignment-->
        <tr>
            <td colspan="4"><em class="f13"><?php _e( 'Choose Sidebar Template', 'resto' ); ?></em></td>
        </tr>
        <tr>
            <td>
                <?php
                $resto_single_sidebar_layout_meta = get_post_meta( $post->ID, 'resto-default-layout', true );
                if( false != $resto_single_sidebar_layout_meta ){
                   $resto_single_sidebar_layout = $resto_single_sidebar_layout_meta;
                }
                foreach ($resto_default_layout_options as $field) {
                    ?>
                    <div class="hide-radio radio-image-wrapper" style="float:left; margin-right:30px;">
                        <input id="<?php echo esc_attr( $field['value'] ); ?>" type="radio" name="resto-default-layout"
                               value="<?php echo esc_attr( $field['value'] ); ?>"
                            <?php checked( $field['value'], $resto_single_sidebar_layout ); ?>/>
                        <label class="description" for="<?php echo esc_attr( $field['value'] ); ?>">
                            <img src="<?php echo esc_url( $field['thumbnail'] ); ?>" />
                        </label>
                    </div>
                <?php } // end foreach
                ?>
                <div class="clear"></div>
            </td>
        </tr>
        <tr>
            <td><em class="f13"><?php _e( 'You can set up the sidebar content', 'resto' ); ?> <a href="<?php echo esc_url( admin_url('/widgets.php') ); ?>"><?php _e( 'here', 'resto' ); ?></a></em></td>
        </tr>
        <!--Image alignment-->
        <tr>
            <td colspan="4"><?php _e( 'Featured Image Alignment', 'resto' ); ?></td>
        </tr>
        <tr>
            <td>
                <?php
                $resto_single_post_image_align_meta = get_post_meta( $post->ID, 'resto-single-post-image-align', true );
                if( false != $resto_single_post_image_align_meta ){
                    $resto_single_post_image_align = $resto_single_post_image_align_meta;
                }
                foreach ($resto_single_post_image_align_options as $field) {
                    ?>
                    <input id="<?php echo esc_attr( $field['value'] ); ?>" type="radio" name="resto-single-post-image-align" value="<?php echo esc_attr( $field['value'] ); ?>" <?php checked( $field['value'], $resto_single_post_image_align ); ?>/>
                    <label class="description" for="<?php echo esc_attr( $field['value'] ); ?>">
                        <?php echo esc_html( $field['label'] ); ?>
                    </label>
                <?php } // end foreach
                ?>
                <div class="clear"></div>
            </td>
        </tr>
    </table>

<?php }

/**
 * save the custom metabox data
 * @hooked to save_post hook
 */
function resto_save_sidebar_layout( $post_id ) {
    global $post;
    // Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'resto_layout_options_nonce' ] ) || !wp_verify_nonce( $_POST[ 'resto_layout_options_nonce' ], basename( __FILE__ ) ) ) {
        return;
    }

    // Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( !current_user_can( 'edit_page', $post_id ) ) {
        return $post_id;
    }
    
    if(isset($_POST['resto-default-layout'])){
        $old = get_post_meta( $post_id, 'resto-default-layout', true);
        $new = sanitize_text_field($_POST['resto-default-layout']);
        if ($new && $new != $old) {
            update_post_meta($post_id, 'resto-default-layout', $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id,'resto-default-layout', $old);
        }
    }

    /*image align*/
    if(isset($_POST['resto-single-post-image-align'])){
        $old = get_post_meta( $post_id, 'resto-single-post-image-align', true);
        $new = sanitize_text_field($_POST['resto-single-post-image-align']);
        if ($new && $new != $old) {
            update_post_meta($post_id, 'resto-single-post-image-align', $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id,'resto-single-post-image-align', $old);
        }
    }
}
add_action('save_post', 'resto_save_sidebar_layout');
