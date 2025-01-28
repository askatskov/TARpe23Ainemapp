<?php
/**
 * Header One
 * 
 * @package Presto_Blog
 */

$ed_social        = get_theme_mod( 'ed_social_links', false );
$ed_header_search = get_theme_mod( 'ed_header_search', false );
$ed_header_btn    = get_theme_mod( 'ed_header_btn', false ); ?>

<header id="masthead" class="site-header layout-one hide-element" <?php presto_blog_microdata( 'header' ); ?>>
    <?php if( $ed_social || $ed_header_search || $ed_header_btn ){ ?>
        <div class="top-header">
            <div class="container">
                <?php 
                    presto_blog_header_social(); 
                    if( $ed_header_search || $ed_header_btn ){ ?>			
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
                        <?php 
                    } 
                ?>
            </div>
        </div><!-- .top-header -->
    <?php } ?>
	<div class="mid-header">
		<div class="container">
			<?php 
                presto_blog_main_navigation(); 
                presto_blog_site_branding();
                presto_blog_secondary_navigation();
            ?>
		</div>
	</div><!-- .mid-header-->
</header><!-- #masthead -->

<?php presto_blog_mobile_header();