<?php
if( ! function_exists( 'resto_single_post_image_align' ) ) :
    /**
     * resto default layout function
     *
     * @since  resto 1.0.0
     *
     * @param int
     * @return string
     */
    function resto_single_post_image_align( $post_id = null ){
        global $resto_customizer_all_values,$post;
        if( null == $post_id && isset ( $post->ID ) ){
            $post_id = $post->ID;
        }
        $resto_single_post_image_align = $resto_customizer_all_values['resto-single-post-image-align'];
        $resto_single_post_image_align_meta = get_post_meta( $post_id, 'resto-single-post-image-align', true );

        if( false != $resto_single_post_image_align_meta ) {
            $resto_single_post_image_align = $resto_single_post_image_align_meta;
        }
        return $resto_single_post_image_align;
    }
endif;