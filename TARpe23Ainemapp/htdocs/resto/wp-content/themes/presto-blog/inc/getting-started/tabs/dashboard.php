<?php 
/**
 * Quick Customizer Links
 *
 * @package Presto_Blog 
*/

$customizer_settings = [
    'image' => [
        'icon'       => 'icon-st-image',
        'title'      => __( 'Set Your Logo', 'presto-blog' ),
        'buttonlink' => admin_url( 'customize.php?autofocus[control]=custom_logo' ),
    ],
    'header' => [
        'icon'       => 'icon-st-header',
        'title'      => __( 'Header Options', 'presto-blog' ),
        'buttonlink' => admin_url( 'customize.php?autofocus[section]=header_settings' ),
    ],
    'footer' => [
        'icon'       => 'icon-st-footer',
        'title'      => __( 'Footer Options', 'presto-blog' ),
        'buttonlink' => admin_url( 'customize.php?autofocus[section]=footer_settings' ),
    ],
    'sidebar' => [
        'icon'       => 'icon-st-sidebar',
        'title'      => __( 'Sidebar Layouts', 'presto-blog' ),
        'buttonlink' => admin_url( 'customize.php?autofocus[section]=sidebar_layouts' ),
    ],
    'color' => [
        'icon'       => 'icon-st-color',
        'title'      => __( 'Color Options', 'presto-blog' ),
        'buttonlink' => admin_url( 'customize.php?autofocus[section]=colors' ),
    ],
    'logo' => [
        'icon'       => 'icon-st-logo',
        'title'      => __( 'View Pro', 'presto-blog' ),
        'buttonlink' => 'https://sublimetheme.com/theme/presto/',
    ],
]; ?>

<div id="gs-dashboard" class="st-gs-tab-content fade active show">
    <h2 class="st-gs-tab-title"><?php esc_html_e( 'Easily Navigate to our Awesome Customizer Settings.','presto-blog' ); ?></h2>
    <div class="st-gs-grid">        
        <?php 
            if( $customizer_settings ){
                foreach( $customizer_settings as $k => $customizer_single ){ ?>
                    <div class="st-gs-col<?php if( $k == 'logo' ) echo esc_attr( ' pro-option' ); ?>">
                        <a href="<?php echo esc_url( $customizer_single['buttonlink'] ); ?>"<?php if( $k == 'logo' ) echo ' target="_blank"'; ?>>
                            <div class="st-gs-col-img">
                                <span class="<?php echo esc_attr( $customizer_single['icon'] ); ?>"></span>
                                <?php if( $k == 'logo' ) echo '<span class="st-gs-tag">' . esc_html__( 'Pro', 'presto-blog' ) . '</span>'; ?>
                            </div>
                            <div class="st-gs-col-content">
                                <h4 class="st-gs-col-title"><?php echo esc_html( $customizer_single['title'] ); ?></h4>
                                <span class="st-gs-link">
                                    <?php 
                                        if( $k == 'logo' ){
                                            esc_html_e( 'Learn More','presto-blog' );
                                        }else{
                                            esc_html_e( 'Go to option','presto-blog' );
                                        }
                                    ?>
                                </span>
                            </div>
                        </a>
                    </div>
                    <?php 
                }
            }
        ?>
    </div>
</div><!-- #gs-dashboard -->