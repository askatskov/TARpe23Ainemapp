<?php

/* Theme Widget sidebars. */
require get_template_directory() . '/inc/widgets/widgets.php';
require get_template_directory() . '/inc/widgets/widget-base/widgetbase.php';

require get_template_directory() . '/inc/widgets/recent-widget.php';
require get_template_directory() . '/inc/widgets/social-widget.php';
require get_template_directory() . '/inc/widgets/author-widget.php';
require get_template_directory() . '/inc/widgets/newsletter-widget.php';
require get_template_directory() . '/inc/widgets/tab-widget.php';
require get_template_directory() . '/inc/widgets/cta-widget.php';

/* Register site widgets */
if ( ! function_exists( 'restochef_widgets' ) ) :
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function restochef_widgets() {
        register_widget( 'Restochef_Recent_Posts' );
        register_widget( 'Restochef_Social_Menu' );
        register_widget( 'Restochef_Author_Info' );
        register_widget( 'Restochef_Mailchimp_Form' );
        register_widget( 'Restochef_Call_To_Action' );
        register_widget( 'Restochef_Tab_Posts' );
    }
endif;
add_action( 'widgets_init', 'restochef_widgets' );