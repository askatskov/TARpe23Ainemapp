<?php
/**
 * Default customizer values.
 *
 * @package Restochef
 */
if ( ! function_exists( 'restochef_get_default_customizer_values' ) ) :
	/**
	 * Get default customizer values.
	 *
	 * @since 1.0.0
	 *
	 * @return array Default customizer values.
	 */
	function restochef_get_default_customizer_values() {

		$defaults = array();

        $defaults['header_dark_logo']          = '';

        // header image section
        $defaults['header_banner_title']                    = '';
        $defaults['header_banner_sub_title']                = '';
        $defaults['header_banner_button_label']             = esc_html__('Book A Table', 'restochef');
        
		//Site title options
        $defaults['hide_title'] = false;
		$defaults['hide_tagline'] = false;
		$defaults['site_title_text_size'] = 42;
        $defaults['site_tagline_text_size'] = 16;


        $defaults['header_button_label'] = esc_html__('Order Online', 'restochef');

        // General options
		$defaults['show_lightbox_image'] = false;
        $defaults['enable_cursor_dot_outline'] = false;
        
        $defaults['show_preloader'] = false;
        $defaults['preloader_style'] = 'theme-preloader-spinner-1';
        $defaults['show_progressbar']           = false;
        $defaults['progressbar_position']       = 'top';
        $defaults['progressbar_color']          = '#f7775e';

        // header full timebar
        $defaults['enable_time_bar_section'] = true;
        $defaults['enable_time_bar_fullwidth'] = false;
        $defaults['time_bar_title_1'] = esc_html__('Breakfast', 'restochef');
        $defaults['time_bar_content_1'] = esc_html__('7:30am – 9am (last order)', 'restochef');
        $defaults['time_bar_title_2'] = esc_html__('Lunch', 'restochef');
        $defaults['time_bar_content_2'] = esc_html__('12pm – 2:30pm (last order)', 'restochef');
        $defaults['time_bar_title_3'] = esc_html__('Dinner', 'restochef');
        $defaults['time_bar_content_3'] = esc_html__('6pm – 10:30pm (last order)', 'restochef');
        $defaults['time_bar_button_text'] = esc_html__('Check Our Menu', 'restochef');
 
        // header full aboutpage
        $defaults['enable_about_section'] = false;
        $defaults['about_post_title'] = esc_html__('About US', 'restochef');
        $defaults['about_section_button_text'] = esc_html__('Read Our Story', 'restochef');

        // header full page add
        $defaults['ed_header_ad'] = false;
        $defaults['ed_header_type'] = 'welcome-banner-default';
        $defaults['advertisement_section_title'] = esc_html__('Welcome Message', 'restochef');

        // Header
        $defaults['header_bg_color'] = '#ffffff';
        $defaults['header_style'] = 'header_style_1';
        
        $defaults['enable_search_on_header'] = true;
        $defaults['header_search_btn_style'] = 'style_1';
        $defaults['enable_mini_cart_header'] = true;
        $defaults['enable_woo_my_account'] = true;
        $defaults['enable_sticky_menu'] = true;

        // Dark Mode.
        $defaults['enable_dark_mode']          = true;
        $defaults['enable_dark_mode_switcher'] = true;
        $defaults['dark_mode_primary_color']    = '#fc8019';
        $defaults['dark_mode_bg_color']        = '#292929';
        $defaults['dark_mode_text_color']        = '#ffffff';

        //featured_menu
        $defaults['enable_featured_menu_section']          = true;
        $defaults['select_featured_menu_option_cat']          = '';
        $defaults['featured_menu_section_title']          = esc_html__('Featured Recipes Todays', 'restochef');


        // shop page
        $defaults['enable_shop_section']          = true;
        $defaults['shop_post_title'] = __('Shop Now', 'restochef');
        $defaults['shop_post_description'] = '';
        $defaults['shop_number_of_column'] = 4;
        $defaults['shop_number_of_product'] = 4;
        $defaults['shop_select_product_from'] = 'recent-products';
        $defaults['select_product_category'] = '';
        $defaults['shop_post_button_text'] = __('Shop Now', 'restochef');

        // Front Page
		$defaults['front_page_enable_sidebar'] = false;
		$defaults['hide_front_page_sidebar_mobile'] = false;
		$defaults['front_page_layout'] = 'right-sidebar';

        // Front Page category
        $defaults['enable_category_section'] = false;
        $defaults['enable_image_fix_option'] = true;
        $defaults['category_section_title'] = __('Featured Menu Section', 'restochef');
        $defaults['category_section_content'] = '';

        // Front Page CTA 
        $defaults['enable_video_cta_section'] = false;
        $defaults['video_cta_post_title'] = '';
        $defaults['video_cta_post_sub_title'] = '';
        $defaults['upload_video_image_1'] = '';
        $defaults['video_cta_button_text'] = __('View More', 'restochef');

        // Front Page Gallery Section
        $defaults['enable_image_gallery_section'] = false;
        $defaults['image_gallery_title'] = __('Follow US', 'restochef');
        $defaults['image_gallery_sub_title'] = '';
        
        // Front Page logo Section
        $defaults['enable_logo_section'] = false;

        // front page contact sectiion
        $defaults['enable_contact_section'] = false;
        $defaults['select_contact_page'] = '';

        // front page banner sectiion
        $defaults['enable_banner_section'] = true;
        $defaults['enable_banner_overlay'] = false;
        $defaults['number_of_slider_post'] = '4';
        $defaults['slider_post_content_alignment'] = 'text-left';
        $defaults['banner_section_cat'] = '';
        $defaults['enable_banner_cat_meta'] = true;
        $defaults['enable_banner_post_description'] = false;
        $defaults['enable_banner_author_meta'] = true;
        $defaults['enable_banner_date_meta'] = true;

        // archive options
        $defaults['global_sidebar_layout'] = 'right-sidebar';
        $defaults['hide_global_sidebar_mobile'] = false;
        $defaults['excerpt_length'] = 25;
        $defaults['enable_excerpt_read_more'] = true;
        $defaults['excerpt_read_more'] = __('[...]', 'restochef');


        // Single options
        $defaults['single_sidebar_layout'] = 'right-sidebar';
        $defaults['hide_single_sidebar_mobile'] = false;
        $defaults['single_post_meta'] = array('author', 'date', 'comment', 'category', 'tags');
        
        $defaults['show_author_info'] = true;
        $defaults['show_sticky_article_navigation'] = true;

        $defaults['show_related_posts'] = true;
        $defaults['related_posts_text'] = __('You May Also Like', 'restochef');
        $defaults['no_of_related_posts'] = 3;
        $defaults['related_posts_orderby'] = 'date';
        $defaults['related_posts_order'] = 'desc';
        $defaults['author_posts_orderby'] = 'date';
        $defaults['author_posts_order'] = 'desc';

        $defaults['show_author_posts'] = true;
        $defaults['author_posts_text'] = __('More From Author', 'restochef');
        $defaults['no_of_author_posts'] = 3;

        // Archive
        $defaults['archive_style'] = 'archive_style_1';
        $defaults['archive_post_meta_1'] = array('author', 'date', 'comment', 'category','tags');
        $defaults['archive_post_meta_2'] = array('author', 'date', 'category');
        $defaults['archive_post_meta_3'] = array('author', 'date', 'category');
        $defaults['archive_post_meta_4'] = array('category');

        // pagination
        $defaults['pagination_type'] = 'default';

        // readtime option
        $defaults['enable_read_time_option'] = true;
        $defaults['display_read_time_in'] =array('home-page','single-page','archive-page');
        $defaults['words_per_minute'] = 200;

        // footer related post
        $defaults['enable_footer_recommended_post_section'] = true;
        $defaults['footer_recommended_post_title'] = esc_html__( 'You May Also Like:', 'restochef' );
        $defaults['enable_category_meta'] = true;
        $defaults['enable_post_excerpt'] = false;
        $defaults['enable_date_meta'] = true;
        $defaults['enable_author_meta'] = true;
        $defaults['select_cat_for_footer_recommended_post'] = '';

        /*Footer*/
        $defaults['enable_copyright'] = true;
        $defaults['footer_bg_color'] = '#000';
        $defaults['footer_column_layout'] = 'footer_layout_2';
        $defaults['enable_footer_sticky'] = false;
        $defaults['copyright_text'] = esc_html__( 'Copyright &copy;', 'restochef' );
        $defaults['copyright_date_format'] = 'Y';
        $defaults['enable_footer_credit'] = true;
        $defaults['enable_footer_nav'] = true;
        $defaults['enable_footer_social_nav'] = true;
        $defaults['enable_scroll_to_top'] = true;


		$defaults = apply_filters( 'restochef_default_customizer_values', $defaults );
		return $defaults;
	}
endif;