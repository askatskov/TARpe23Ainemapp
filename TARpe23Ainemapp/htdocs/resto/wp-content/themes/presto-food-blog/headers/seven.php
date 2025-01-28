<header id="masthead" class="site-header layout-seven" itemtype="https://schema.org/WPHeader" itemscope="">
    <div class="top-header">
        <div class="container">
            <div class="header-left">
                <?php presto_blog_header_social(); ?>
            </div>
            <div class="header-center">
                <?php presto_blog_site_branding(); ?>
            </div>
            <div class="header-right">
                <?php 
                    presto_blog_header_search();
                    if( presto_blog_is_woocommerce_activated() ){
                        presto_blog_header_woo_user();
                        presto_blog_header_woo_cart();
                    }
                    presto_blog_header_button();
                ?>
            </div>				
        </div>
    </div><!-- .top-header -->
    <div class="mid-header">
        <div class="container">
            <?php presto_blog_main_navigation(); ?>
        </div>
    </div>
</header><!-- #masthead -->
<?php 

presto_blog_mobile_header();