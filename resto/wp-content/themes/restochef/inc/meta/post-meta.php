<?php
/**
* Sidebar Metabox.
*
* @package Restochef
*/
if( !function_exists( 'restochef_sanitize_sidebar_option_meta' ) ) :

    // Sidebar Option Sanitize.
    function restochef_sanitize_sidebar_option_meta( $input ){

        $metabox_options = array( 'global-sidebar','left-sidebar','right-sidebar','no-sidebar' );
        if( in_array( $input,$metabox_options ) ){

            return $input;

        }else{

            return '';

        }
    }

endif;

if( !function_exists('restochef_sanitize_meta_pagination') ):

    /** Sanitize Enable Disable Checkbox **/
    function restochef_sanitize_meta_pagination( $input ) {

        $valid_keys = array('global-layout','no-navigation','norma-navigation','ajax-next-post-load');
        if ( in_array( $input , $valid_keys ) ) {
            return $input;
        }
        return '';

    }

endif;

if( !function_exists( 'restochef_sanitize_post_layout_option_meta' ) ) :

    // Sidebar Option Sanitize.
    function restochef_sanitize_post_layout_option_meta( $input ){

        $metabox_options = array( 'global-layout','layout-1','layout-2' );
        if( in_array( $input,$metabox_options ) ){

            return $input;

        }else{

            return '';

        }

    }

endif;


if( !function_exists( 'restochef_sanitize_header_overlay_option_meta' ) ) :

    // Sidebar Option Sanitize.
    function restochef_sanitize_header_overlay_option_meta( $input ){

        $metabox_options = array( 'global-layout','enable-overlay' );
        if( in_array( $input,$metabox_options ) ){

            return $input;

        }else{

            return '';

        }

    }

endif;

add_action( 'add_meta_boxes', 'restochef_metabox' );

if( ! function_exists( 'restochef_metabox' ) ):


    function  restochef_metabox() {
        
        add_meta_box(
            'theme-custom-metabox',
            esc_html__( 'Layout Settings', 'restochef' ),
            'restochef_post_metafield_callback',
            'post', 
            'normal', 
            'high'
        );
        add_meta_box(
            'theme-custom-metabox',
            esc_html__( 'Layout Settings', 'restochef' ),
            'restochef_post_metafield_callback',
            'page',
            'normal', 
            'high'
        ); 
    }

endif;

$restochef_page_layout_options = array(
    'layout-1' => esc_html__( 'Simple Layout', 'restochef' ),
    'layout-2' => esc_html__( 'Banner Layout', 'restochef' ),
);

$restochef_post_sidebar_fields = array(
    'global-sidebar' => array(
                    'id'        => 'post-global-sidebar',
                    'value' => 'global-sidebar',
                    'label' => esc_html__( 'Global sidebar', 'restochef' ),
                ),
    'right-sidebar' => array(
                    'id'        => 'post-left-sidebar',
                    'value' => 'right-sidebar',
                    'label' => esc_html__( 'Right sidebar', 'restochef' ),
                ),
    'left-sidebar' => array(
                    'id'        => 'post-right-sidebar',
                    'value'     => 'left-sidebar',
                    'label'     => esc_html__( 'Left sidebar', 'restochef' ),
                ),
    'no-sidebar' => array(
                    'id'        => 'post-no-sidebar',
                    'value'     => 'no-sidebar',
                    'label'     => esc_html__( 'No sidebar', 'restochef' ),
                ),
);

$restochef_post_layout_options = array(
    'layout-1' => esc_html__( 'Simple Layout', 'restochef' ),
    'layout-2' => esc_html__( 'Banner Layout', 'restochef' ),
);

$restochef_header_overlay_options = array(
    'global-layout' => esc_html__( 'Global Layout', 'restochef' ),
    'enable-overlay' => esc_html__( 'Enable Header Overlay', 'restochef' ),
);


/**
 * Callback function for post option.
*/
if( ! function_exists( 'restochef_post_metafield_callback' ) ):
    
    function restochef_post_metafield_callback() {
        global $post, $restochef_post_sidebar_fields, $restochef_post_layout_options,  $restochef_page_layout_options, $restochef_header_overlay_options;
        $post_type = get_post_type($post->ID);
        wp_nonce_field( basename( __FILE__ ), 'restochef_post_meta_nonce' ); ?>
        
        <div class="metabox-main-block">

            <div class="metabox-navbar">
                <ul>

                    <li>
                        <a id="metabox-navbar-appearance"  class="metabox-navbar-active" href="javascript:void(0)">

                            <?php esc_html_e('Appearance Settings', 'restochef'); ?>

                        </a>
                    </li>

                    <?php if ($post_type != 'page') { ?>
                        <li>
                            <a id="metabox-navbar-general" href="javascript:void(0)">

                                <?php esc_html_e('General Settings', 'restochef'); ?>

                            </a>
                        </li>
                    <?php } ?>


                    <?php if( $post_type == 'post' && class_exists('Booster_Extension_Class') ): ?>
                        <li>
                            <a id="twp-tab-booster" href="javascript:void(0)">

                                <?php esc_html_e('Booster Extension Settings', 'restochef'); ?>

                            </a>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>

            <div class="twp-tab-content">

                <div id="metabox-navbar-general-content" class="metabox-content-wrap">

                    <div class="metabox-opt-panel">

                        <h3 class="meta-opt-title"><?php esc_html_e('Sidebar Layout','restochef'); ?></h3>

                        <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                            <?php
                            $restochef_post_sidebar = esc_html( get_post_meta( $post->ID, 'restochef_post_sidebar_option', true ) ); 
                            if( $restochef_post_sidebar == '' ){ $restochef_post_sidebar = 'global-sidebar'; }

                            foreach ( $restochef_post_sidebar_fields as $restochef_post_sidebar_field) { ?>

                                <label class="description">

                                    <input type="radio" name="restochef_post_sidebar_option" value="<?php echo esc_attr( $restochef_post_sidebar_field['value'] ); ?>" <?php if( $restochef_post_sidebar_field['value'] == $restochef_post_sidebar ){ echo "checked='checked'";} if( empty( $restochef_post_sidebar ) && $restochef_post_sidebar_field['value']=='right-sidebar' ){ echo "checked='checked'"; } ?>/>&nbsp;<?php echo esc_html( $restochef_post_sidebar_field['label'] ); ?>

                                </label>

                            <?php } ?>

                        </div>

                    </div>

                </div>


                <div id="metabox-navbar-appearance-content" class="metabox-content-wrap metabox-content-wrap-active">

                    <?php if( $post_type == 'page' ): ?>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Banner Layout','restochef'); ?></h3>

                            <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                                <?php
                                $restochef_page_layout = esc_html( get_post_meta( $post->ID, 'restochef_page_layout', true ) ); 
                                if( $restochef_page_layout == '' ){ $restochef_page_layout = 'layout-1'; }

                                foreach ( $restochef_page_layout_options as $key => $restochef_page_layout_option) { ?>

                                    <label class="description">
                                        <input type="radio" name="restochef_page_layout" value="<?php echo esc_attr( $key ); ?>" <?php if( $key == $restochef_page_layout ){ echo "checked='checked'";} ?>/>&nbsp;<?php echo esc_html( $restochef_page_layout_option ); ?>
                                    </label>

                                <?php } ?>

                            </div>

                        </div>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Header Overlay','restochef'); ?></h3>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                <?php
                                $restochef_ed_header_overlay = esc_attr( get_post_meta( $post->ID, 'restochef_ed_header_overlay', true ) ); ?>

                                <input type="checkbox" id="restochef-header-overlay" name="restochef_ed_header_overlay" value="1" <?php if( $restochef_ed_header_overlay ){ echo "checked='checked'";} ?>/>

                                <label for="restochef-header-overlay"><?php esc_html_e( 'Enable Header Overlay','restochef' ); ?></label>

                            </div>

                        </div>

                    <?php endif; ?>

                    <?php if( $post_type == 'post' ): ?>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Header Title Layout','restochef'); ?></h3>

                            <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                                <?php
                                $restochef_post_layout = esc_html( get_post_meta( $post->ID, 'restochef_post_layout', true ) ); 

                                foreach ( $restochef_post_layout_options as $key => $restochef_post_layout_option) { ?>

                                    <label class="description">
                                        <input type="radio" name="restochef_post_layout" value="<?php echo esc_attr( $key ); ?>" <?php if( $key == $restochef_post_layout ){ echo "checked='checked'";} ?>/>&nbsp;<?php echo esc_html( $restochef_post_layout_option ); ?>
                                    </label>

                                <?php } ?>

                            </div>

                        </div>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Header Overlay','restochef'); ?></h3>

                            <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                                <?php
                                $restochef_header_overlay = esc_html( get_post_meta( $post->ID, 'restochef_header_overlay', true ) ); 
                                if( $restochef_header_overlay == '' ){ $restochef_header_overlay = 'global-layout'; }

                                foreach ( $restochef_header_overlay_options as $key => $restochef_header_overlay_option) { ?>

                                    <label class="description">
                                        <input type="radio" name="restochef_header_overlay" value="<?php echo esc_attr( $key ); ?>" <?php if( $key == $restochef_header_overlay ){ echo "checked='checked'";} ?>/>&nbsp;<?php echo esc_html( $restochef_header_overlay_option ); ?>
                                    </label>

                                <?php } ?>

                            </div>

                        </div>

                    <?php endif; ?>


                </div>

                <?php if( $post_type == 'post' && class_exists('Booster_Extension_Class') ):

                    
                    $restochef_ed_post_views = esc_html( get_post_meta( $post->ID, 'restochef_ed_post_views', true ) );
                    $restochef_ed_post_read_time = esc_html( get_post_meta( $post->ID, 'restochef_ed_post_read_time', true ) );
                    $restochef_ed_post_like_dislike = esc_html( get_post_meta( $post->ID, 'restochef_ed_post_like_dislike', true ) );
                    $restochef_ed_post_author_box = esc_html( get_post_meta( $post->ID, 'restochef_ed_post_author_box', true ) );
                    $restochef_ed_post_social_share = esc_html( get_post_meta( $post->ID, 'restochef_ed_post_social_share', true ) );
                    $restochef_ed_post_reaction = esc_html( get_post_meta( $post->ID, 'restochef_ed_post_reaction', true ) );
                    $restochef_ed_post_rating = esc_html( get_post_meta( $post->ID, 'restochef_ed_post_rating', true ) );
                    ?>

                    <div id="twp-tab-booster-content" class="metabox-content-wrap">

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Booster Extension Plugin Content','restochef'); ?></h3>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="restochef-ed-post-views" name="restochef_ed_post_views" value="1" <?php if( $restochef_ed_post_views ){ echo "checked='checked'";} ?>/>
                                    <label for="restochef-ed-post-views"><?php esc_html_e( 'Disable Post Views','restochef' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="restochef-ed-post-read-time" name="restochef_ed_post_read_time" value="1" <?php if( $restochef_ed_post_read_time ){ echo "checked='checked'";} ?>/>
                                    <label for="restochef-ed-post-read-time"><?php esc_html_e( 'Disable Post Read Time','restochef' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="restochef-ed-post-like-dislike" name="restochef_ed_post_like_dislike" value="1" <?php if( $restochef_ed_post_like_dislike ){ echo "checked='checked'";} ?>/>
                                    <label for="restochef-ed-post-like-dislike"><?php esc_html_e( 'Disable Post Like Dislike','restochef' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="restochef-ed-post-author-box" name="restochef_ed_post_author_box" value="1" <?php if( $restochef_ed_post_author_box ){ echo "checked='checked'";} ?>/>
                                    <label for="restochef-ed-post-author-box"><?php esc_html_e( 'Disable Post Author Box','restochef' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="restochef-ed-post-social-share" name="restochef_ed_post_social_share" value="1" <?php if( $restochef_ed_post_social_share ){ echo "checked='checked'";} ?>/>
                                    <label for="restochef-ed-post-social-share"><?php esc_html_e( 'Disable Post Social Share','restochef' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="restochef-ed-post-reaction" name="restochef_ed_post_reaction" value="1" <?php if( $restochef_ed_post_reaction ){ echo "checked='checked'";} ?>/>
                                    <label for="restochef-ed-post-reaction"><?php esc_html_e( 'Disable Post Reaction','restochef' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="restochef-ed-post-rating" name="restochef_ed_post_rating" value="1" <?php if( $restochef_ed_post_rating ){ echo "checked='checked'";} ?>/>
                                    <label for="restochef-ed-post-rating"><?php esc_html_e( 'Disable Post Rating','restochef' ); ?></label>

                            </div>

                        </div>

                    </div>

                <?php endif; ?>
                
            </div>

        </div>  
            
    <?php }
endif;

// Save metabox value.
add_action( 'save_post', 'restochef_save_post_meta' );

if( ! function_exists( 'restochef_save_post_meta' ) ):

    function restochef_save_post_meta( $post_id ) {

        global $post, $restochef_post_sidebar_fields, $restochef_post_layout_options, $restochef_header_overlay_options,  $restochef_page_layout_options;

        if ( !isset( $_POST[ 'restochef_post_meta_nonce' ] ) || !wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['restochef_post_meta_nonce'] ) ), basename( __FILE__ ) ) ){

            return;

        }

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){

            return;

        }
            
        if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {  

            if ( !current_user_can( 'edit_page', $post_id ) ){  

                return $post_id;

            }

        }elseif( !current_user_can( 'edit_post', $post_id ) ) {

            return $post_id;

        }


        foreach ( $restochef_post_sidebar_fields as $restochef_post_sidebar_field ) {  
            

                $old = esc_html( get_post_meta( $post_id, 'restochef_post_sidebar_option', true ) ); 
                $new = isset( $_POST['restochef_post_sidebar_option'] ) ? restochef_sanitize_sidebar_option_meta( wp_unslash( $_POST['restochef_post_sidebar_option'] ) ) : '';

                if ( $new && $new != $old ){

                    update_post_meta ( $post_id, 'restochef_post_sidebar_option', $new );

                }elseif( '' == $new && $old ) {

                    delete_post_meta( $post_id,'restochef_post_sidebar_option', $old );

                }

            
        }

        $twp_disable_ajax_load_next_post_old = esc_html( get_post_meta( $post_id, 'twp_disable_ajax_load_next_post', true ) ); 
        $twp_disable_ajax_load_next_post_new = isset( $_POST['twp_disable_ajax_load_next_post'] ) ? restochef_sanitize_meta_pagination( wp_unslash( $_POST['twp_disable_ajax_load_next_post'] ) ) : '';

        if( $twp_disable_ajax_load_next_post_new && $twp_disable_ajax_load_next_post_new != $twp_disable_ajax_load_next_post_old ){

            update_post_meta ( $post_id, 'twp_disable_ajax_load_next_post', $twp_disable_ajax_load_next_post_new );

        }elseif( '' == $twp_disable_ajax_load_next_post_new && $twp_disable_ajax_load_next_post_old ) {

            delete_post_meta( $post_id,'twp_disable_ajax_load_next_post', $twp_disable_ajax_load_next_post_old );

        }


        foreach ( $restochef_post_layout_options as $restochef_post_layout_option ) {  
            
            $restochef_post_layout_old = esc_html( get_post_meta( $post_id, 'restochef_post_layout', true ) ); 
            $restochef_post_layout_new = isset( $_POST['restochef_post_layout'] ) ? restochef_sanitize_post_layout_option_meta( wp_unslash( $_POST['restochef_post_layout'] ) ) : '';

            if ( $restochef_post_layout_new && $restochef_post_layout_new != $restochef_post_layout_old ){

                update_post_meta ( $post_id, 'restochef_post_layout', $restochef_post_layout_new );

            }elseif( '' == $restochef_post_layout_new && $restochef_post_layout_old ) {

                delete_post_meta( $post_id,'restochef_post_layout', $restochef_post_layout_old );

            }
            
        }



        foreach ( $restochef_header_overlay_options as $restochef_header_overlay_option ) {  
            
            $restochef_header_overlay_old = esc_html( get_post_meta( $post_id, 'restochef_header_overlay', true ) ); 
            $restochef_header_overlay_new = isset( $_POST['restochef_header_overlay'] ) ? restochef_sanitize_header_overlay_option_meta( wp_unslash( $_POST['restochef_header_overlay'] ) ) : '';

            if ( $restochef_header_overlay_new && $restochef_header_overlay_new != $restochef_header_overlay_old ){

                update_post_meta ( $post_id, 'restochef_header_overlay', $restochef_header_overlay_new );

            }elseif( '' == $restochef_header_overlay_new && $restochef_header_overlay_old ) {

                delete_post_meta( $post_id,'restochef_header_overlay', $restochef_header_overlay_old );

            }
            
        }


        $restochef_ed_post_views_old = esc_html( get_post_meta( $post_id, 'restochef_ed_post_views', true ) ); 
        $restochef_ed_post_views_new = isset( $_POST['restochef_ed_post_views'] ) ? absint( wp_unslash( $_POST['restochef_ed_post_views'] ) ) : '';

        if ( $restochef_ed_post_views_new && $restochef_ed_post_views_new != $restochef_ed_post_views_old ){

            update_post_meta ( $post_id, 'restochef_ed_post_views', $restochef_ed_post_views_new );

        }elseif( '' == $restochef_ed_post_views_new && $restochef_ed_post_views_old ) {

            delete_post_meta( $post_id,'restochef_ed_post_views', $restochef_ed_post_views_old );

        }



        $restochef_ed_post_read_time_old = esc_html( get_post_meta( $post_id, 'restochef_ed_post_read_time', true ) ); 
        $restochef_ed_post_read_time_new = isset( $_POST['restochef_ed_post_read_time'] ) ? absint( wp_unslash( $_POST['restochef_ed_post_read_time'] ) ) : '';

        if ( $restochef_ed_post_read_time_new && $restochef_ed_post_read_time_new != $restochef_ed_post_read_time_old ){

            update_post_meta ( $post_id, 'restochef_ed_post_read_time', $restochef_ed_post_read_time_new );

        }elseif( '' == $restochef_ed_post_read_time_new && $restochef_ed_post_read_time_old ) {

            delete_post_meta( $post_id,'restochef_ed_post_read_time', $restochef_ed_post_read_time_old );

        }



        $restochef_ed_post_like_dislike_old = esc_html( get_post_meta( $post_id, 'restochef_ed_post_like_dislike', true ) ); 
        $restochef_ed_post_like_dislike_new = isset( $_POST['restochef_ed_post_like_dislike'] ) ? absint( wp_unslash( $_POST['restochef_ed_post_like_dislike'] ) ) : '';

        if ( $restochef_ed_post_like_dislike_new && $restochef_ed_post_like_dislike_new != $restochef_ed_post_like_dislike_old ){

            update_post_meta ( $post_id, 'restochef_ed_post_like_dislike', $restochef_ed_post_like_dislike_new );

        }elseif( '' == $restochef_ed_post_like_dislike_new && $restochef_ed_post_like_dislike_old ) {

            delete_post_meta( $post_id,'restochef_ed_post_like_dislike', $restochef_ed_post_like_dislike_old );

        }



        $restochef_ed_post_author_box_old = esc_html( get_post_meta( $post_id, 'restochef_ed_post_author_box', true ) ); 
        $restochef_ed_post_author_box_new = isset( $_POST['restochef_ed_post_author_box'] ) ? absint( wp_unslash( $_POST['restochef_ed_post_author_box'] ) ) : '';

        if ( $restochef_ed_post_author_box_new && $restochef_ed_post_author_box_new != $restochef_ed_post_author_box_old ){

            update_post_meta ( $post_id, 'restochef_ed_post_author_box', $restochef_ed_post_author_box_new );

        }elseif( '' == $restochef_ed_post_author_box_new && $restochef_ed_post_author_box_old ) {

            delete_post_meta( $post_id,'restochef_ed_post_author_box', $restochef_ed_post_author_box_old );

        }



        $restochef_ed_post_social_share_old = esc_html( get_post_meta( $post_id, 'restochef_ed_post_social_share', true ) ); 
        $restochef_ed_post_social_share_new = isset( $_POST['restochef_ed_post_social_share'] ) ? absint( wp_unslash( $_POST['restochef_ed_post_social_share'] ) ) : '';

        if ( $restochef_ed_post_social_share_new && $restochef_ed_post_social_share_new != $restochef_ed_post_social_share_old ){

            update_post_meta ( $post_id, 'restochef_ed_post_social_share', $restochef_ed_post_social_share_new );

        }elseif( '' == $restochef_ed_post_social_share_new && $restochef_ed_post_social_share_old ) {

            delete_post_meta( $post_id,'restochef_ed_post_social_share', $restochef_ed_post_social_share_old );

        }



        $restochef_ed_post_reaction_old = esc_html( get_post_meta( $post_id, 'restochef_ed_post_reaction', true ) ); 
        $restochef_ed_post_reaction_new = isset( $_POST['restochef_ed_post_reaction'] ) ? absint( wp_unslash( $_POST['restochef_ed_post_reaction'] ) ) : '';

        if ( $restochef_ed_post_reaction_new && $restochef_ed_post_reaction_new != $restochef_ed_post_reaction_old ){

            update_post_meta ( $post_id, 'restochef_ed_post_reaction', $restochef_ed_post_reaction_new );

        }elseif( '' == $restochef_ed_post_reaction_new && $restochef_ed_post_reaction_old ) {

            delete_post_meta( $post_id,'restochef_ed_post_reaction', $restochef_ed_post_reaction_old );

        }



        $restochef_ed_post_rating_old = esc_html( get_post_meta( $post_id, 'restochef_ed_post_rating', true ) ); 
        $restochef_ed_post_rating_new = isset( $_POST['restochef_ed_post_rating'] ) ? absint( wp_unslash( $_POST['restochef_ed_post_rating'] ) ) : '';

        if ( $restochef_ed_post_rating_new && $restochef_ed_post_rating_new != $restochef_ed_post_rating_old ){

            update_post_meta ( $post_id, 'restochef_ed_post_rating', $restochef_ed_post_rating_new );

        }elseif( '' == $restochef_ed_post_rating_new && $restochef_ed_post_rating_old ) {

            delete_post_meta( $post_id,'restochef_ed_post_rating', $restochef_ed_post_rating_old );

        }

        foreach ( $restochef_page_layout_options as $restochef_post_layout_option ) {  
        
            $restochef_page_layout_old = sanitize_text_field( get_post_meta( $post_id, 'restochef_page_layout', true ) ); 
            $restochef_page_layout_new = isset( $_POST['restochef_page_layout'] ) ? restochef_sanitize_post_layout_option_meta( wp_unslash( $_POST['restochef_page_layout'] ) ) : '';

            if ( $restochef_page_layout_new && $restochef_page_layout_new != $restochef_page_layout_old ){

                update_post_meta ( $post_id, 'restochef_page_layout', $restochef_page_layout_new );

            }elseif( '' == $restochef_page_layout_new && $restochef_page_layout_old ) {

                delete_post_meta( $post_id,'restochef_page_layout', $restochef_page_layout_old );

            }
            
        }

        $restochef_ed_header_overlay_old = absint( get_post_meta( $post_id, 'restochef_ed_header_overlay', true ) ); 
        $restochef_ed_header_overlay_new = isset( $_POST['restochef_ed_header_overlay'] ) ? absint( wp_unslash( $_POST['restochef_ed_header_overlay'] ) ) : '';

        if ( $restochef_ed_header_overlay_new && $restochef_ed_header_overlay_new != $restochef_ed_header_overlay_old ){

            update_post_meta ( $post_id, 'restochef_ed_header_overlay', $restochef_ed_header_overlay_new );

        }elseif( '' == $restochef_ed_header_overlay_new && $restochef_ed_header_overlay_old ) {

            delete_post_meta( $post_id,'restochef_ed_header_overlay', $restochef_ed_header_overlay_old );

        }

    }

endif;   