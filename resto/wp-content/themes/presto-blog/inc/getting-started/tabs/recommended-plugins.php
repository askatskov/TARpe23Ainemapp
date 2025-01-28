<?php 
$free_plugins = array(
    'regenerate-thumbnails' => array(
        'plugin_name'        => __( 'Regenerate Thumbnails','presto-blog' ),
        'slug'               => 'regenerate-thumbnails',
        'filename'           => 'regenerate-thumbnails/regenerate-thumbnails.php',
    ),    
    'instagram-feed' => array(
        'plugin_name'        => __( 'Smash Balloon Social Photo Feed','presto-blog' ),
        'slug'               => 'instagram-feed',
        'filename'           => 'instagram-feed/instagram-feed.php',
        'settings-link'      => admin_url( 'admin.php?page=sb-instagram-feed' ),
        'settings-link-text' => __( 'Settings','presto-blog' ),
    ),   
    'blossomthemes-email-newsletter' => array(
        'plugin_name'        => __( 'BlossomThemes Email Newsletter','presto-blog' ),
        'slug'               => 'blossomthemes-email-newsletter',
        'filename'           => 'blossomthemes-email-newsletter/blossomthemes-email-newsletter.php',
        'settings-link'      => admin_url( 'edit.php?post_type=subscribe-form' ),
        'settings-link-text' => __( 'Settings','presto-blog' ),
    ),
);
?>
<div id="gs-recommended-plugins" class="st-gs-tab-content fade">
    <div class="st-gs-grid">
    	<?php
    		foreach( $free_plugins as $slug => $plugin ){
    			$info     = presto_blog_call_plugin_api( $plugin['slug'] );
    			$icon_url = presto_blog_check_for_icon( $info->icons ); 
    			$plugin_active_status = '';
                if ( is_plugin_active( $plugin['filename'] ) ) {
                    $plugin_active_status = ' active';
                } ?>    
    			<div class="st-gs-col">
    				<div class="st-gs-col-img">
    					<img src="<?php echo esc_url( $icon_url ); ?>" />
                        <h4 class="st-gs-col-title" title="<?php echo esc_attr( $info->name ); ?>"><?php echo esc_html( $info->name ); ?></h4>
                    </div>
    				<div class="st-gs-col-content clearfix">
                        <div class="button-wrap <?php echo esc_attr( $plugin_active_status ); ?>" id="gs-<?php echo esc_attr( $slug ); ?>" data-slug="gs-<?php echo esc_attr( $slug ); ?>">
    					   <div class="gs-recommended-plugin">
    					   	<?php 
	    					   	if ( ! is_plugin_active( $plugin['filename'] ) ) {
	    					   		if ( file_exists( WP_CONTENT_DIR . '/plugins/' . $plugin['filename'] ) ) {
	    					   			//activate if there is file on the wp-content/plugins ?>
	    					   			<a class="activate-now button button-primary st-gs-btn-transparent" data-slug="<?php echo esc_attr( $slug ); ?>" href="#" aria-label="<?php echo esc_attr( $plugin['plugin_name'] ); ?>" data-init="<?php echo esc_attr( $plugin['filename'] ); ?>" data-settings-link="<?php if( isset( $plugin['settings-link'] ) ) echo esc_url( $plugin['settings-link'] ); ?>" data-settings-link-text="<?php if( isset( $plugin['settings-link-text'] ) ) echo esc_attr( $plugin['settings-link-text'] ); ?>"><?php esc_html_e( 'Activate', 'presto-blog' ); ?></a>
	    					   		    <?php 
                                    }else{ //install if there are not any plugins which are listed on wp-content/plugins ?>	
	    					   			<a class="install-now button st-gs-btn-transparent " data-slug="<?php echo esc_attr( $slug ); ?>" href="#" aria-label="<?php echo esc_attr( $plugin['plugin_name'] ); ?>" data-init="<?php echo esc_attr( $plugin['filename'] ); ?>" data-settings-link="<?php if( isset( $plugin['settings-link'] ) ) echo esc_url( $plugin['settings-link'] ); ?>" data-settings-link-text="<?php if( isset( $plugin['settings-link-text'] ) ) echo esc_attr( $plugin['settings-link-text'] ); ?>"><?php esc_html_e( 'Install and Activate', 'presto-blog' ); ?></a>
	    					   		    <?php 
                                    }
	    					   	}else{ ?>
									<a href="#" class="deactivate-now button st-gs-btn-transparent" data-init="<?php echo esc_attr( $plugin['filename'] ); ?>" aria-label="<?php echo esc_attr( $plugin['plugin_name'] ); ?>" data-settings-link="<?php if( isset( $plugin['settings-link'] ) ) echo esc_url( $plugin['settings-link'] ); ?>" data-settings-link-text="<?php if( isset( $plugin['settings-link-text'] ) ) echo esc_attr( $plugin['settings-link-text'] ); ?>"><?php esc_html_e( 'Deactivate', 'presto-blog' ); ?></a>
                                    <?php
                                    if ( isset( $plugin['settings-link'] ) ) { ?>
                                        <a class="gs-recommended-plugin-links button st-gs-btn-transparent" data-slug="<?php echo esc_attr( $slug ); ?>" href="<?php if( isset( $plugin['settings-link'] ) ) echo esc_url( $plugin['settings-link'] ); ?>"><?php if( isset( $plugin['settings-link-text'] ) ) echo esc_attr( $plugin['settings-link-text'] ); ?></a>  
                                        <?php 
                                    }   
                                }
    					   	?>
    					   </div>
                        </div>
    				</div>
    			</div>
    			<?php
    		} 
        ?>
    </div>
</div><!-- #gs-recommended-plugins -->