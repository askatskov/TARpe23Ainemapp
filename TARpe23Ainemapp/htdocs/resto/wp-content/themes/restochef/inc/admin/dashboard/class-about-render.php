<?php
/**
 * Theme Dashboard
 *
 * @package Restochef
 */

/**
 * Theme Dashboard class.
 */
class Restochef_Theme_Dashboard
{

    /**
     * The slug name to refer to this menu by.
     *
     * @var string $menu_slug The menu slug.
     */
    public $menu_slug = 'theme-dashboard';

    /**
     * The pro_status of theme.
     *
     * @var string $pro_status The pro_status.
     */
    public $pro_status = false;

    /**
     * The settings of page.
     *
     * @var array $settings The settings.
     */
    public $settings = array(
        'tabs' => array(),
        'demo_link' => 'https://live-demo.themeinwp.net/restochef',
        'insights_link_1' => 'https://www.themeinwp.com/wordpress-web-hosting/',
        'insights_link_2' => 'https://www.themeinwp.com/reviews/wp-rocket-review/',
        'insights_link_3' => 'https://www.themeinwp.com/collections/best-wordpress-speed-optimization-plugins/',
    );


    /**
     * Constructor.
     */
    public function __construct()
    {
        $self = $this;

        if (!function_exists('get_plugin_data')) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php';
        }

        add_filter('woocommerce_enable_setup_wizard', '__return_false');

        add_action('init', array($this, 'set_settings'));

        add_action('init', function () use ($self) {
            add_action('admin_menu', array($self, 'add_menu_page'));
        });

        add_action('admin_notices', array($this, 'notice'));

        add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'), 5);
        add_action('admin_enqueue_scripts', array($this, 'notice_enqueue_scripts'), 5);

        add_action('wp_ajax_restochef_dismissed_handler', array($this, 'dismissed_handler'));
        add_action('switch_theme', array($this, 'reset_notices'));
        add_action('after_switch_theme', array($this, 'reset_notices'));

        if( isset( $_GET['page'] ) && $_GET['page'] == 'theme-dashboard' ){

            add_action('in_admin_header', array( $this,'restochef_hide_all_admin_notice' ),1000 );

        }
    }


    public function restochef_hide_all_admin_notice(){

        remove_all_actions('admin_notices');
        remove_all_actions('all_admin_notices');

    }

    /**
     * Add menu page
     */
    public function add_menu_page()
    {
        add_submenu_page('themes.php', esc_html__('Restochef Dashboard', 'restochef'), esc_html__('Theme Dashboard', 'restochef'), 'manage_options', $this->menu_slug, array($this, 'html_carcase'), 1);
    }

    /**
     * This function will register scripts and styles for admin dashboard.
     *
     * @param string $page Current page.
     */
    public function admin_enqueue_scripts($page)
    {
        wp_enqueue_script('restochef', get_template_directory_uri() . '/inc/admin/dashboard/js/scripts.js', array('jquery'), filemtime(get_template_directory() . '/inc/admin/dashboard/js/scripts.js'), true);

        wp_localize_script('restochef', 'restochef_localize', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('nonce'),
            'upload_image'   =>  esc_html__('Choose Image','restochef'),
            'use_image'   =>  esc_html__('Select','restochef'),
            'active' => esc_html__('Active','restochef'),
            'deactivate' => esc_html__('Deactivate','restochef'),
            'failed_message' => esc_html__('Something went wrong, contact support.', 'restochef'),
        ));

        // Styles.
        wp_enqueue_style('restochef', get_template_directory_uri() . '/inc/admin/dashboard/css/style.css', array(), filemtime(get_template_directory() . '/inc/admin/dashboard/css/style.css'));

        // Add RTL support.
        wp_style_add_data('restochef', 'rtl', 'replace');
    }

    /**
     * Settings
     *
     * @param array $settings The settings.
     */
    public function set_settings($settings)
    {
        $this->settings = apply_filters('thd_register_settings', $this->settings);

        if (isset($this->settings['pro_status'])) {
            $this->pro_status = $this->settings['pro_status'];
        }
    }

    /**
     * Is visible
     *
     * @param array $data The data.
     */
    public function is_visible($data)
    {

        $status = isset($data['visible']) ? $data['visible'] : array();

        if (in_array('free', $status, true) && !$this->pro_status) {
            return true;
        }
        if (in_array('pro', $status, true) && $this->pro_status) {
            return true;
        }
    }

    /**
     * Get plugin status.
     *
     * @param string $plugin_path Plugin path.
     */
    public function get_plugin_status($plugin_path)
    {
        if (!current_user_can('install_plugins')) {
            return;
        }

        if (!file_exists(WP_PLUGIN_DIR . '/' . $plugin_path)) {
            return 'not_installed';
        } elseif (in_array($plugin_path, (array)get_option('active_plugins', array()), true) || is_plugin_active_for_network($plugin_path)) {
            return 'active';
        } else {
            return 'inactive';
        }
    }

    /**
     * Html Features
     *
     * @param array $data The data.
     */
    public function html_features($data)
    {
        if (!$data) {
            return;
        }
        ?>
        <div class="dashboard-tab-features">
            <?php
            foreach ($data as $feature) {

                $feature_status = 'feature-item-active';

                if (isset($feature['type']) && 'pro' === $feature['type']) {
                    $feature_status = $this->pro_status ? $feature_status : 'feature-item-inactive';
                }
                ?>
                <div class="dashboard-feature-item <?php echo esc_attr($feature_status); ?>">

                    <?php if (isset($feature['text']) && $feature['text']) : ?>
                        <div class="feature-help-icon"></div>
                        <div class="feature-help-info"><?php echo $feature['text']; ?></div>
                    <?php endif; ?>


                    <div class="dashboard-feature-row">
                        <?php if (isset($feature['name']) && $feature['name']) { ?>
                            <div class="dashboard-feature-item-name">
                                <?php echo esc_html($feature['name']); ?>
                            </div>
                        <?php } ?>

                        <?php
                        if (isset($feature['type']) && $feature['type']) {

                            $badge = 'theme-dashboard-badge';

                            switch ($feature['type']) {
                                case 'free':
                                    $badge .= ' theme-badge-primary';
                                    break;
                                case 'pro':
                                    $badge .= ' theme-badge-secondary';
                                    break;
                            }
                            ?>
                            <div class="theme-feature-badge <?php echo esc_html($badge); ?>">
                                <?php echo esc_html($feature['type']); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="dashboard-feature-row dashboard-feature-row-bottom">
                        <?php
                        if (isset($feature['activate_uri']) && $feature['activate_uri']) {

                            $activate_uri = $feature['activate_uri'];

                            if (isset($feature['type']) && 'pro' === $feature['type']) {
                                $activate_uri = $this->pro_status ? '?page=theme-dashboard' . $activate_uri : 'javascript:void(0);';
                            }
                            ?>
                            <?php if (!Restochef_Modules::is_module_active($feature['slug'])) : ?>
                                <a href="<?php echo esc_attr($activate_uri); ?>=1" class="dashboard-feature-item-customize">
                                    <?php esc_html_e('Activate', 'restochef'); ?>
                                </a>
                            <?php else : ?>
                                <a href="<?php echo esc_attr($activate_uri); ?>=0" class="dashboard-feature-item-customize">
                                    <?php esc_html_e('Deactivate', 'restochef'); ?>
                                </a>
                                <?php if ($feature['link']) : ?>
                                    <a class="dashboard-feature-item-customize dashboard-feature-item-proceed"
                                       href="<?php echo esc_url($feature['link']); ?>"><?php echo esc_html($feature['link_label']); ?></a>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php
                        } elseif (isset($feature['customize_uri']) && $feature['customize_uri']) {

                            $customize_uri = $feature['customize_uri'];

                            if (isset($feature['type']) && 'pro' === $feature['type']) {
                                $customize_uri = $this->pro_status ? $customize_uri : 'javascript:void(0);';
                            }
                            ?>
                            <a href="<?php echo esc_attr($customize_uri); ?>" class="dashboard-feature-item-customize"
                               target="_blank">
                                <?php esc_html_e('Customize', 'restochef'); ?>
                            </a>
                        <?php } ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }

    /**
     * Theme Dashboard: Plugin Suggestion
     */
    public function html_performance()
    {
        ?>
        <div class="suggested-enhancement">
            <div class="suggested-enhancement-item suggested-enhancement-item-full">
                <div class="suggested-enhancement-panel">
                    <div class="suggested-enhancement-thumbnail">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/inc/admin/dashboard/images/wordpress-hosting.png'); ?>">
                    </div>
                    <div class="suggested-enhancement-content">
                        <div class="suggested-enhancement-title">
                            <?php esc_html_e('Fastest WordPress Hosts', 'restochef'); ?>
                        </div>

                        <div class="suggested-enhancement-description">
                            <?php esc_html_e('A slow host can really put a drag on your site’s performance, even an optimized one. Make sure you get a host that won’t hold you back by reading our review, complete with real speed tests, of the fastest WordPress hosts. ', 'restochef'); ?>
                        </div>

                        <a class="suggested-enhancement-link" href="<?php echo esc_url($this->settings['insights_link_1']); ?>" target="_blank">
                            <?php esc_html_e('Read more', 'restochef'); ?>
                        </a>
                    </div>
                </div>
            </div>


            <div class="suggested-enhancement-item suggested-enhancement-item-half">
                <div class="suggested-enhancement-panel">
                    <div class="suggested-enhancement-thumbnail">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/inc/admin/dashboard/images/wp-rocket-insights.png'); ?>">
                    </div>
                    <div class="suggested-enhancement-content">
                        <div class="suggested-enhancement-title">
                            <?php esc_html_e('WP Rocket Review', 'restochef'); ?>
                        </div>

                        <div class="suggested-enhancement-description">
                            <?php esc_html_e('Every site that is serious about speed (and should be pretty much all sites these days) needs a caching plugin and WP Rocket is our pick of the bunch. Get the lowdown on why we recommend it n our data-backed review: ', 'restochef'); ?>
                        </div>

                        <a class="suggested-enhancement-link" href="<?php echo esc_url($this->settings['insights_link_2']); ?>" target="_blank">
                            <?php esc_html_e('Read more', 'restochef'); ?>
                        </a>
                    </div>
                </div>
            </div>

            <div class="suggested-enhancement-item suggested-enhancement-item-half">
                <div class="suggested-enhancement-panel">
                    <div class="suggested-enhancement-thumbnail">
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/inc/admin/dashboard/images/wordpress-speed-plugins.png'); ?>">
                    </div>
                    <div class="suggested-enhancement-content">
                        <div class="suggested-enhancement-title">
                            <?php esc_html_e('Best WordPress Speed Optimization Plugins', 'restochef'); ?>
                        </div>

                        <div class="suggested-enhancement-description">
                            <?php esc_html_e('We run through the top 10 WordPress performance plugins to keep your site running fast. Goes beyond just caching plugins (though those are on there too!). A must-read for all WordPress site owners.', 'restochef'); ?>
                        </div>

                        <a class="suggested-enhancement-link" href="<?php echo esc_url($this->settings['insights_link_3']); ?>" target="_blank">
                            <?php esc_html_e('Read more', 'restochef'); ?>
                        </a>
                    </div>
                </div>
            </div>

        </div>
        <?php
    }

    /**
     * Theme Notice: Hero Notice
     *
     * @param string $location The location.
     */
    public function html_hero($location = null)
    {
        global $pagenow;

        $screen = get_current_screen();
        ?>
        <div class="dashboard-hero-panel">
            <div class="hero-panel-content">
                <div class="hero-panel-subtitle">
                    <?php esc_html_e('Hello, ', 'restochef'); ?>

                    <?php
                    $current_user = wp_get_current_user();

                    echo esc_html($current_user->display_name);
                    ?>
                </div>

                <div class="hero-panel-title">
                    <?php echo wp_kses_post($this->settings['hero_title']); ?>

                    <?php if ($this->pro_status) { ?>
                        <span class="theme-dashboard-badge theme-badge-secondary">pro</span>
                    <?php } else { ?>
                        <span class="theme-dashboard-badge theme-badge-primary">free</span>
                    <?php } ?>
                </div>

                <?php if ('themes' === $location) { ?>
                    <?php if (isset($this->settings['hero_themes_desc']) && $this->settings['hero_themes_desc']) { ?>
                        <div class="hero-panel-description">
                            <?php echo wp_kses_post($this->settings['hero_themes_desc']); ?>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <?php if (isset($this->settings['hero_desc']) && $this->settings['hero_desc']) { ?>
                        <div class="hero-panel-description">
                            <?php echo wp_kses_post($this->settings['hero_desc']); ?>
                        </div>
                    <?php } ?>
                <?php } ?>

                <div class="theme-admin-button-wrap theme-admin-button-group">
                    <?php
                    $target = 'redirect';
                    ?>

                    <?php if ('themes.php' === $pagenow && 'themes' === $screen->base) { ?>
                        <a href="<?php echo esc_url(add_query_arg('page', $this->menu_slug, admin_url('themes.php'))); ?>" class="button theme-admin-button admin-button-primary">
                            <span class="dashicons dashicons-dashboard"></span>
                            <span><?php esc_html_e('Theme Dashboard', 'restochef'); ?></span>
                        </a>
                    <?php } ?>

                    <a href="<?php echo esc_url($this->settings['demo_link']); ?>" class="button theme-admin-button admin-button-secondary" target="_blank">
                        <span class="dashicons dashicons-welcome-view-site"></span>
                        <span><?php esc_html_e('View Live Demo', 'restochef'); ?></span>
                    </a>

                    <a href="<?php echo esc_url($this->settings['documentation_link']); ?>" class="button theme-admin-button admin-button-secondary" target="_blank">
                        <span class="dashicons dashicons-media-document"></span>
                        <span><?php esc_html_e('Theme Documentation', 'restochef'); ?></span>
                    </a>
                </div>

            </div>

            <?php if (isset($this->settings['hero_image']) && $this->settings['hero_image']) { ?>
                <div class="hero-panel-image">
                    <img src="<?php echo esc_url($this->settings['hero_image']); ?>">
                </div>
            <?php } ?>
        </div>
        <?php
    }

    /**
     * Theme Dashboard: Top Area
     */
    public function html_carcase()
    {
        ?>
        <div class="theme-admin-dashboard">
            <header class="theme-dashboard-masthead">
                <div class="dashboard-wrapper">
                    <div class="dashboard-header-panel">
                        <div class="dashboard-masthead-item dashboard-masthead-left">
                            <a href="<?php echo esc_url('https://themeinwp.com/'); ?>" class="theme-author-logo" target="_blank">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/inc/admin/dashboard/images/restochef-logo.png'); ?>" alt="<?php esc_attr_e('ThemeinWP', 'restochef'); ?>">
                            </a>
                        </div>

                        <div class="dashboard-masthead-item dashboard-masthead-right">
                            <a href="<?php echo esc_url($this->settings['documentation_link']); ?>" class="button theme-button-small theme-admin-button admin-button-secondary" target="_blank">
                                <span><?php esc_html_e('Documentation', 'restochef'); ?></span>
                                <span class="dashicons dashicons-external"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <div class="theme-dashboard-content">
                <div class="dashboard-wrapper">

                    <?php $this->html_hero(); ?>

                    <div class="dashboard-hero-main">
                        <div class="dashboard-hero-main-content">
                            <?php if ($this->settings['tabs']) { ?>
                                <div class="theme-dashboard-panel dashboard-panel-general">
                                    <div class="dashboard-panel-head dashboard-panel-tabs">
                                        <?php
                                        $counter = 0;
                                        foreach ($this->settings['tabs'] as $tab) {
                                            $counter++;
                                            if (!$this->is_visible($tab)) {
                                                continue;
                                            }
                                            ?>
                                            <div class="dashboard-panel-tab <?php echo esc_attr(1 === $counter ? 'dashboard-panel-tab-active' : null); ?>">
                                                <h3 class="dashboard-panel-title">
                                                    <a href="#tab-content"><?php echo esc_html($tab['name']); ?></a>
                                                </h3>
                                            </div>
                                        <?php } ?>
                                    </div>

                                    <div class="dashboard-panel-content dashboard-panel-content-tabs">
                                        <?php
                                        $counter = 0;
                                        foreach ($this->settings['tabs'] as $tab) {
                                            $counter++;
                                            if (!$this->is_visible($tab)) {
                                                continue;
                                            }
                                            ?>
                                            <div class="dashboard-panel-tab <?php echo esc_attr(1 === $counter ? 'dashboard-panel-tab-active' : null); ?>">
                                                <?php
                                                switch ($tab['type']) {
                                                    case 'features':
                                                        $this->html_features($tab['data']);
                                                        break;
                                                    case 'performance':
                                                        $this->html_performance();
                                                        break;
                                                    case 'html':
                                                        call_user_func('printf', '%s', $tab['data']);
                                                        break;
                                                }
                                                ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>


                        </div>

                        <div class="dashboard-hero-main-sidebar">
                            <?php if (!$this->pro_status) { ?>
                                <div class="theme-dashboard-panel dashboard-panel-promo">
                                    <div class="dashboard-panel-inner">
                                        <div class="theme-admin-title">
                                            <?php echo wp_kses_post($this->settings['promo_title']); ?>
                                        </div>

                                        <?php if (isset($this->settings['promo_desc']) && $this->settings['promo_desc']) { ?>
                                            <p class="theme-admin-description"><?php echo wp_kses_post($this->settings['promo_desc']); ?></p>
                                        <?php } ?>

                                        <div class="theme-admin-button-wrap">
                                            <a href="<?php echo esc_url($this->settings['promo_link']); ?>" class="button theme-admin-button admin-button-primary" target="_blank">
                                                <span class="dashicons dashicons-thumbs-up"></span>
                                                <span><?php echo wp_kses_post($this->settings['promo_button']); ?></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                            <div class="theme-dashboard-panel dashboard-panel-review">
                                <div class="dashboard-panel-head">
                                    <h3 class="dashboard-panel-title"><?php esc_html_e('Review', 'restochef'); ?></h3>
                                </div>
                                <div class="dashboard-panel-content">
                                    <div class="dashboard-reviews-stars">
                                        <span class="dashicons dashicons-star-filled"></span>
                                        <span class="dashicons dashicons-star-filled"></span>
                                        <span class="dashicons dashicons-star-filled"></span>
                                        <span class="dashicons dashicons-star-filled"></span>
                                        <span class="dashicons dashicons-star-filled"></span>
                                    </div>

                                    <div class="theme-admin-description"><?php esc_html_e('It makes us happy to hear from our users. We would appreciate a review.', 'restochef'); ?></div>

                                    <div class="theme-admin-button-wrap">
                                        <a href="<?php echo esc_url($this->settings['review_link']); ?>"
                                           class="theme-admin-button button" target="_blank">
                                            <?php esc_html_e('Submit a Review', 'restochef'); ?>
                                        </a>
                                    </div>

                                    <div class="theme-admin-separator"></div>

                                    <div class="theme-admin-title"><?php esc_html_e('Have an idea or feedback?', 'restochef'); ?></div>

                                    <div class="theme-admin-description">
                                        <?php esc_html_e('If you have any suggestions or comments about our WordPress theme, please let us know. We value your feedback and strive to continuously improve our product.', 'restochef'); ?>
                                    </div>

                                    <a href="<?php echo esc_url($this->settings['suggest_idea_link']); ?>" class="theme-feature-request" target="_blank">
                                        <?php esc_html_e('Suggest an Idea', 'restochef'); ?>
                                    </a>
                                </div>
                            </div>

                            <div class="theme-dashboard-panel dashboard-panel-changelog">
                                <div class="dashboard-panel-head">
                                    <h3 class="dashboard-panel-title">
                                        <?php esc_html_e('Changelog', 'restochef'); ?>
                                    </h3>

                                    <?php if ($this->settings['changelog_version']) { ?>
                                        <div class="theme-current-version"><?php echo esc_html($this->settings['changelog_version']); ?></div>
                                    <?php } ?>
                                </div>
                                <div class="dashboard-panel-content">
                                    <div class="theme-admin-description"><?php esc_html_e('The theme changelog provides a brief history of updates and modifications made to the theme. Keep informed with the changes and improvements that have been made over time.', 'restochef'); ?></div>

                                    <a href="<?php echo esc_url($this->settings['changelog_link']); ?>"
                                       class="theme-changelog-info" target="_blank">
                                        <?php esc_html_e('See the Changelog', 'restochef'); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="theme-dashboard-footer">
                <div class="dashboard-wrapper">
                    <div class="dashboard-footer-panel">
                        <div class="theme-dashboard-panel dashboard-panel-support">
                            <div class="dashboard-panel-head">
                                <h3 class="dashboard-panel-title"><?php esc_html_e('Support', 'restochef'); ?></h3>

                                <?php if ($this->pro_status) { ?>
                                    <div class="theme-dashboard-badge theme-badge-primary"><?php esc_html_e('Priority Status', 'restochef'); ?></div>
                                <?php } ?>
                            </div>
                            <div class="dashboard-panel-content">
                                <div class="theme-dashboard-subpanel">
                                    <div class="theme-admin-title">
                                        <?php echo wp_kses_post(__('Need help? We\'re here for you!', 'restochef')); ?>
                                    </div>

                                    <div class="theme-admin-description"><?php esc_html_e('Do you have a question or have you encountered a bug? You can receive assistance from our amicable support team whenever you require it.', 'restochef'); ?></div>

                                    <div class="theme-admin-button-wrap">
                                        <a href="<?php echo esc_url($this->settings['support_link']); ?>"
                                           class="button theme-admin-button admin-button-secondary" target="_blank">
                                            <?php esc_html_e('Get Support', 'restochef'); ?>
                                        </a>
                                    </div>
                                </div>

                                <?php if (!$this->pro_status) { ?>
                                    <div class="theme-dashboard-subpanel dashboard-subpanel-bg">
                                        <div class="theme-admin-title">
                                            <?php echo wp_kses_post(__('Upgrade to priority support', 'restochef')); ?>

                                            <div class="theme-dashboard-badge theme-badge-secondary"><?php esc_html_e('pro', 'restochef'); ?></div>
                                        </div>

                                        <div class="theme-admin-description">
                                            <?php esc_html_e('Receive support via email with a prompt initial response time of 1-2 hours for all priority requests.', 'restochef'); ?>
                                        </div>

                                        <div class="theme-admin-button-wrap">
                                            <a href="<?php echo esc_url($this->settings['support_pro_link']); ?>"
                                               class="button theme-admin-button admin-button-primary" target="_blank">
                                                <?php esc_html_e('Get Priority Support', 'restochef'); ?>
                                            </a>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="theme-dashboard-panel dashboard-panel-community">
                            <div class="dashboard-panel-head">
                                <h3 class="dashboard-panel-title"><?php esc_html_e('Community', 'restochef'); ?></h3>
                            </div>
                            <div class="dashboard-panel-content">
                                <div class="theme-admin-title">
                                    <?php echo wp_kses_post(__('Join Our Community', 'restochef')); ?>
                                </div>

                                <div class="theme-admin-description"><?php esc_html_e('Engage with the community: talk about products, ask for help or offer assistance to the community.', 'restochef'); ?></div>

                                <div class="theme-admin-button-wrap">
                                    <a href="<?php echo esc_url($this->settings['community_link']); ?>"
                                       class="button theme-admin-button admin-button-tertairyx" target="_blank">
                                        <?php esc_html_e('Join Now', 'restochef'); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    /**
     * Theme Notice
     */
    public function notice()
    {
        global $pagenow;

        $screen = get_current_screen();

        if ('themes.php' === $pagenow) {
            $transient_name = sprintf('%s_hero_notice', get_template());

            if (!get_transient($transient_name)) {
                if (isset($_GET['page']) && $_GET['page'] == 'theme-dashboard') {
                    return;
                }
                ?>
                <div class="notice notice-success restochef-primary-notice theme-admin-dashboard theme-admin-dashboard-notice is-dismissible" data-notice="<?php echo esc_attr($transient_name); ?>">
                    <button type="button" class="notice-dismiss"></button>
                    <?php $this->html_hero('themes'); ?>
                </div>
                <?php
            }
        }
    }

    /**
     * Purified from the database information about notification.
     */
    public function reset_notices()
    {
        delete_transient(sprintf('%s_hero_notice', get_template()));
    }

    /**
     * Dismissed handler
     */
    public function dismissed_handler()
    {
        wp_verify_nonce(null);

        if (isset($_POST['notice'])) { // Input var ok; sanitization ok.

            set_transient(sanitize_text_field(wp_unslash($_POST['notice'])), true, 0); // Input var ok.
        }
    }

    /**
     * Notice Enqunue Scripts
     *
     * @param string $page Current page.
     */
    public function notice_enqueue_scripts($page)
    {
        wp_enqueue_script('jquery');

        ob_start();
        ?>
        <script>
            jQuery(function ($) {
                $(document).on('click', '.restochef-primary-notice .notice-dismiss', function () {
                    jQuery.post('ajax_url', {
                        action: 'restochef_dismissed_handler',
                        notice: $(this).closest('.restochef-primary-notice').data('notice'),
                    });
                    $('.theme-admin-dashboard-notice').hide();
                });
            });
        </script>
        <?php
        $script = str_replace('ajax_url', admin_url('admin-ajax.php'), ob_get_clean());

        wp_add_inline_script('jquery', str_replace(array('<script>', '</script>'), '', $script));
    }
}

new Restochef_Theme_Dashboard();
