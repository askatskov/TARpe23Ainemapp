<?php
/**
 * Actions Hooks
 *
 * @package Presto_Blog
 */

if( ! function_exists( 'presto_blog_doctype' ) ) :
/**
 * Doctype Declaration
*/
function presto_blog_doctype(){ ?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
    <?php
}
endif;
add_action( 'presto_blog_doctype', 'presto_blog_doctype' );

if( ! function_exists( 'presto_blog_head' ) ) :
/**
 * Before wp_head 
*/
function presto_blog_head(){ ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php
}
endif;
add_action( 'presto_blog_before_wp_head', 'presto_blog_head' );

if( ! function_exists( 'presto_blog_page_start' ) ) :
/**
 * Page Start
*/
function presto_blog_page_start(){ ?>
    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content (Press Enter)', 'presto-blog' ); ?></a>
    <?php
}
endif;
add_action( 'presto_blog_before_header', 'presto_blog_page_start', 20 );

if( ! function_exists( 'presto_blog_header' ) ) :
/**
 * Header Start
*/
function presto_blog_header(){ 
    get_template_part( 'headers/one' );    
}
endif;
add_action( 'presto_blog_header', 'presto_blog_header', 20 );

if ( ! function_exists( 'presto_blog_banner' ) ) :
/**
 * Displays HomePage Banner
 */
function presto_blog_banner(){
	$ed_banner             = get_theme_mod( 'ed_banner_section', 'no_banner' );
	$banner_subtitle       = get_theme_mod( 'banner_subtitle', __( 'Free Blogging Course','presto-blog' ) );
	$banner_title          = get_theme_mod( 'banner_title', __( 'Are you Ready to Start a Profitable Blog?','presto-blog' ) );
	$banner_link_one_label = get_theme_mod( 'banner_link_one_label', __( 'Get Started','presto-blog' ) );
	$banner_link_one_url   = get_theme_mod( 'banner_link_one_url','#' );
	$banner_link_two_label = get_theme_mod( 'banner_link_two_label', __( 'Learn More','presto-blog' ) );
	$banner_link_two_url   = get_theme_mod( 'banner_link_two_url','#' );
	if( is_front_page() ){
		if( has_custom_header() && $ed_banner == 'static_banner' ){ ?>
            <div id="banner_section" class="site-banner layout-one banner-static">
                <div class="banner-items">
                    <div class="banner-item">
                        <?php 
                            the_custom_header_markup();
                            
                            if( $ed_banner == 'static_banner' && ( $banner_subtitle || $banner_title || ( $banner_link_one_label && $banner_link_one_url )  || ( $banner_link_two_label && $banner_link_two_url ) ) ){ ?>
                                <div class="item-content">
                                    <div class="container">
                                        <div class="item-content-inner">
                                            <?php 
                                                if( $banner_subtitle ){ ?>
                                                    <span class="sub-title"><?php echo esc_html( $banner_subtitle ); ?></span>
                                                    <?php 
                                                }
                                                if( $banner_title ){ ?>
                                                    <h2 class="item-title"><?php echo esc_html( $banner_title ); ?></h2>
                                                    <?php 
                                                }
                                                
                                                if( ( $banner_link_one_label && $banner_link_one_url ) || ( $banner_link_two_label && $banner_link_two_url ) ){ ?>
                                                    <div class="banner-desc-wrap">
                                                        <div class="btn-wrap">
                                                            <?php 
                                                                if( $banner_link_one_label && $banner_link_one_url ) { ?>
                                                                    <a href="<?php echo esc_url( $banner_link_one_url ); ?>" class="btn"><?php echo esc_html( $banner_link_one_label ); ?></a>
                                                                    <?php 
                                                                }
                                                                if( $banner_link_two_label && $banner_link_two_url ) { ?>
                                                                    <a href="<?php echo esc_url( $banner_link_two_url ); ?>" class="btn btn-outlined"><?php echo esc_html( $banner_link_two_label ); ?></a>
                                                                    <?php 
                                                                } 
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <?php 
                                                }       
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                            }
                        ?>
                    </div>
                </div>
            </div><!-- .site-banner -->
		    <?php 
		}
	}
}
endif;
add_action( 'presto_blog_after_header', 'presto_blog_banner', 15 );

if ( ! function_exists( 'presto_blog_home_featured_section' ) ) :
/**
 * Displays HomePage Featured section
 */
function presto_blog_home_featured_section(){
    $ed_featured_section = get_theme_mod( 'ed_featured_section', false );
    $home_featured_post  = get_theme_mod( 'home_featured_post' );

    if( is_front_page() && $ed_featured_section && $home_featured_post ){
        $args = array(
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true,
            'orderby'             => 'post__in',
            'post_type'           => 'post',
            'post__in'            => $home_featured_post,
            'posts_per_page'      => -1
        );

        $qry  = new WP_Query( $args );
        if( $qry->have_posts() ){ ?>
            <div id="featured_section" class="featured-section">
                <div class="container">
                    <div class="section-grid swiper-container">
                        <div class="section-col-holder swiper-wrapper">
                            <?php  
                                while ( $qry->have_posts() ) { 
                                    $qry->the_post(); ?>
                                    <div class="section-col swiper-slide">
                                        <a href="<?php the_permalink(); ?>">
                                            <figure class="section-img">
                                                <?php 
                                                    if( has_post_thumbnail() ){ 
                                                        the_post_thumbnail( 'presto-blog-featured-home-posts', array( 'itemprop' => 'image' ) );
                                                    }else{ 
                                                        presto_blog_get_fallback_svg( 'presto-blog-featured-home-posts' );
                                                    }
                                                ?>
                                            </figure>
                                            <div class="section-col-content">
                                                <?php the_title( '<h2 class="section-title">', '</h2>' ); ?>
                                            </div>
                                        </a>
                                    </div>
                                    <?php 
                                } 
                            ?>
                        </div>
                    </div>
                </div>
            </div><!-- .featured-section -->
            <?php
        }
        wp_reset_postdata();
    }    
}
add_action( 'presto_blog_after_header', 'presto_blog_home_featured_section', 20 );
endif;

if( ! function_exists( 'presto_blog_ad_after_header' ) ) :
/**
 * Widget Area After header
 */
function presto_blog_ad_after_header(){
    if( is_active_sidebar( 'after-header' ) && is_home() ){
        echo '<div class="after-header-ad-widget">';
        dynamic_sidebar( 'after-header' );
        echo '</div>';
    }
}
endif;
add_action( 'presto_blog_after_header', 'presto_blog_ad_after_header', 25 );

if( ! function_exists( 'presto_blog_content_start' ) ) :
/**
 * Content Start
 */
function presto_blog_content_start(){ ?>
    <div id="content" class="site-content">
		<?php 
            presto_blog_breadcrumb();            
            presto_blog_content_header(); 
        ?>
		<div class="container">
			<div id="primary" class="content-area">
    <?php
}
endif;
add_action( 'presto_blog_content_start', 'presto_blog_content_start', 15 );

if( ! function_exists( 'presto_blog_pagination' ) ) :
/**
 * Presto Pagination
*/
function presto_blog_pagination(){
    if( is_single() ){
        $next_post = get_next_post();
        $prev_post = get_previous_post();
        if( $prev_post || $next_post ){?>            
            <nav class="navigation pagination" role="navigation">
                <h2 class="screen-reader-text"><?php esc_html_e( 'Post Navigation', 'presto-blog' ); ?></h2>
                <div class="nav-links">
                    <?php 
                        if( $prev_post ){ ?>
                            <div class="nav-previous">
                                <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" rel="prev">
                                    <span class="nav-text"><?php esc_html_e( 'Previous Article','presto-blog' ); ?></span>
                                    <div class="nav-title-wrap">
                                        <figure>
                                            <?php
                                                $prev_img = get_post_thumbnail_id( $prev_post->ID );
                                                if( $prev_img ){
                                                    $prev_url = wp_get_attachment_image_url( $prev_img, 'full' );
                                                    echo '<img src="' . esc_url( $prev_url ) . '" alt="' . the_title_attribute( 'echo=0' ) . '">';                                        
                                                }else{
                                                    presto_blog_get_fallback_svg( 'full' );
                                                }
                                            ?>
                                        </figure>
                                        <h3 class="nav-title"><?php echo esc_html( get_the_title( $prev_post->ID ) ); ?></h3>
                                    </div>
                                </a>
                            </div>
                            <?php 
                        } 
                        
                        if( $next_post ){ ?>
                            <div class="nav-next">
                                <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" rel="next">
                                <span class="nav-text"><?php esc_html_e( 'Next Article','presto-blog' ); ?></span>
                                <div class="nav-title-wrap">
                                    <figure>
                                        <?php
                                        $next_img = get_post_thumbnail_id( $next_post->ID );
                                        if( $next_img ){
                                            $next_url = wp_get_attachment_image_url( $next_img, 'full' );
                                            echo '<img src="' . esc_url( $next_url ) . '" alt="' . the_title_attribute( 'echo=0' ) . '">';                                        
                                        }else{
                                            presto_blog_get_fallback_svg( 'full' );
                                        }
                                        ?>
                                    </figure>
                                    <h3 class="nav-title"><?php echo esc_html( get_the_title( $next_post->ID ) ); ?></h3>
                                </div>
                                </a>
                            </div>
                            <?php 
                        } 
                    ?>
                </div>
            </nav>        
            <?php
        }
    }else{
        the_posts_pagination( array(
            'prev_text'          => presto_blog_svg_collection( 'pagination-prev' ),
            'next_text'          => presto_blog_svg_collection( 'pagination-next' ),
            'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'presto-blog' ) . ' </span>',
        ) );
    }
}
endif;
add_action( 'presto_blog_after_content_single', 'presto_blog_pagination', 15 );
add_action( 'presto_blog_after_posts', 'presto_blog_pagination', 15 );

if( ! function_exists( 'presto_blog_author_block' ) ) :
/**
 * Presto Author Block
*/
function presto_blog_author_block(){
    if( get_the_author_meta( 'description' ) ){ ?>
        <div class="author-block">
            <div class="author-header">
                <figure class="author-img"><?php echo get_avatar( get_the_author_meta( 'ID' ), 95 ); ?></figure>
                <div class="title-wrap">
                    <span class="sub-title"><?php esc_html_e( 'WRITTEN BY', 'presto-blog' ); ?></span>
                    <h3 class="author-name"><?php echo esc_html( get_the_author_meta( 'display_name' ) ); ?></h3>
                </div>
            </div>
            <div class="author-content-wrap">
                <div class="author-info">
                    <?php echo wpautop( wp_kses_post( get_the_author_meta( 'description' ) ) ); ?>
                </div>
            </div>
        </div><!-- .author-block -->
        <?php 
    }
}
endif;
add_action( 'presto_blog_after_content_single', 'presto_blog_author_block', 20 );

if( ! function_exists( 'presto_blog_content_end' ) ) :
/**
 * Content End
 */
function presto_blog_content_end(){ ?>
            </div><!-- #primary -->
	        <?php get_sidebar(); ?>
	    </div><!-- .container -->
        <?php if( presto_blog_is_woocommerce_activated() && is_singular( 'product' ) ) do_action( 'presto_blog_after_woo_container' ); ?>		
    </div><!-- #content -->
    <?php
}
endif;
add_action( 'presto_blog_content_end', 'presto_blog_content_end', 15 );

if( ! function_exists( 'presto_blog_related_posts' ) ) :
/**
 * Presto Related Posts
*/
function presto_blog_related_posts(){    
    if( is_singular( 'post' ) ){
        global $post;
        $args = array(
            'post_type'           => 'post',
            'posts_status'        => 'publish',
            'ignore_sticky_posts' => true,
            'post__not_in'        => array( $post->ID ),
            'orderby'             => 'rand',
            'posts_per_page'      => 3,
        );
        
        $ed_related_post     = get_theme_mod( 'ed_related_post', true );
        $related_post_title  = get_theme_mod( 'related_post_title',__(  'You Might Also Like', 'presto-blog' ) );
        $related_tax         = get_theme_mod( 'related_taxonomy', 'cat' );
        
        if( $related_tax == 'cat' ){
            $cats = get_the_category( $post->ID );        
            if( $cats ){
                $c = array();
                foreach( $cats as $cat ){
                    $c[] = $cat->term_id; 
                }
                $args['category__in'] = $c;
            }
        }elseif( $related_tax == 'tag' ){
            $tags = get_the_tags( $post->ID );
            if( $tags ){
                $t = array();
                foreach( $tags as $tag ){
                    $t[] = $tag->term_id;
                }
                $args['tag__in'] = $t;  
            }
        }
        $qry = new WP_Query( $args );
        
        if( $ed_related_post && $qry->have_posts() ){ ?>   
            <div class="related-posts normal-corner">
                <div class="container">
                    <?php if( $related_post_title ){ ?>
                        <h2 class="related-title">
                            <?php echo esc_html( $related_post_title ); ?>
                        </h2>
                    <?php } ?>
                    <div class="related-post-wrap">
                        <?php while( $qry->have_posts() ){ $qry->the_post(); ?>
                            <article class="post">
                                <figure class="post-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php
                                            if( has_post_thumbnail() ){
                                                the_post_thumbnail( 'full', array( 'itemprop' => 'image' ) );
                                            }else{ 
                                                presto_blog_get_fallback_svg( 'presto-blog-full' );
                                            }
                                        ?>
                                    </a>
                                </figure>
                                <header class="entry-header">
                                    <?php presto_blog_category(); ?>
                                    <h3 class="entry-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h3>
                                    <div class="entry-meta">
                                        <?php presto_blog_posted_on(); ?>
                                    </div>
                                </header><!-- .entry-header -->
                            </article>
                        <?php } ?>
                    </div>
                </div>
            </div><!-- .related-posts -->
            <?php
            wp_reset_postdata();
        }
    }
}
endif;
add_action( 'presto_blog_after_single_container','presto_blog_related_posts',10 );

if( ! function_exists( 'presto_blog_comments' ) ) :
/**
 * Presto Pagination
*/
function presto_blog_comments(){
    if( presto_blog_is_woocommerce_activated() && is_product() ) return;
    
    // If comments are open or we have at least one comment, load up the comment template.
    if ( is_singular() && ( comments_open() || get_comments_number() ) ) :
        comments_template();
    endif;
}
endif;
add_action( 'presto_blog_after_single_container','presto_blog_comments',20 );

if( ! function_exists( 'presto_blog_ad_before_footer' ) ) :
/**
 * Widget Area Before Footer
 */
function presto_blog_ad_before_footer(){
    if( is_active_sidebar( 'before-footer' ) && is_home() ){
        echo '<div class="before-footer-ad-widget">';
        dynamic_sidebar( 'before-footer' );
        echo '</div>';
    }
}
endif;
add_action( 'presto_blog_before_footer', 'presto_blog_ad_before_footer', 20 );

if( ! function_exists( 'presto_blog_newsletter' ) ) :
/**
 * Presto Newsletter
*/
function presto_blog_newsletter(){
    $ed_newsletter_section = get_theme_mod( 'ed_newsletter_section', false );
    $newsletter_shortcode  = get_theme_mod( 'newsletter_shortcode' );
    if( $ed_newsletter_section && $newsletter_shortcode ){ ?>
        <div class="newsletter-section">
            <?php if( $newsletter_shortcode ) echo do_shortcode( wp_kses_post( $newsletter_shortcode ) ); ?>
        </div>
        <?php 
    }
}
endif;
add_action( 'presto_blog_before_footer', 'presto_blog_newsletter', 25 );

if( ! function_exists( 'presto_blog_instagram' ) ) :
/**
 * Presto Instagram
*/
function presto_blog_instagram(){
    $ed_instagram_section       = get_theme_mod( 'ed_instagram_section', false );
    $instagram_title            = get_theme_mod( 'instagram_title',__( 'I\'m on instagram', 'presto-blog' ) );
    $instagram_shortcode        = get_theme_mod( 'instagram_shortcode' );
    if( $ed_instagram_section && $instagram_title && $instagram_shortcode ){ ?>
        <div class="instagram-section">
            <?php if( $instagram_title ) echo '<h2 class="section-title">' . esc_html( $instagram_title ). '</h2>'; ?>
            <?php if( $instagram_shortcode ) echo do_shortcode( wp_kses_post( $instagram_shortcode ) ); ?>
        </div>
        <?php 
    }
}
endif;
add_action( 'presto_blog_before_footer', 'presto_blog_instagram', 30 );

if( ! function_exists( 'presto_blog_footer_start' ) ) :
/**
 * Footer Start
 */
function presto_blog_footer_start(){ ?>
    <footer id="colophon" class="site-footer" <?php presto_blog_microdata( 'footer' ); ?>>
    <?php
}
endif;
add_action( 'presto_blog_footer', 'presto_blog_footer_start', 15 );

if( ! function_exists( 'presto_blog_footer_top' ) ) :
/**
 * Footer Top
*/
function presto_blog_footer_top(){
    $footer_sidebars = array( 'footer-one', 'footer-two', 'footer-three', 'footer-four' );
    $active_sidebars = array();
    $sidebar_count   = 0;

    foreach ( $footer_sidebars as $sidebar ) {
        if( is_active_sidebar( $sidebar ) ){
            array_push( $active_sidebars, $sidebar );
            $sidebar_count++ ;
        }
    }

    if( $active_sidebars ){ ?>
        <div class="top-footer">
    		<div class="container">
    			<div class="footer-grid column-<?php echo esc_attr( $sidebar_count ); ?>">
                <?php foreach( $active_sidebars as $active ){ ?>
    				<div class="col">
    				   <?php dynamic_sidebar( $active ); ?>	
    				</div>
                <?php } ?>
                </div>
    		</div>
    	</div>
        <?php 
    }
}
endif;
add_action( 'presto_blog_footer', 'presto_blog_footer_top', 20 );

if( ! function_exists( 'presto_blog_footer_bottom' ) ) :
/**
 * Footer Bottom
 */
function presto_blog_footer_bottom(){ ?>
    <div class="bottom-footer">
        <div class="container">
            <div class="copyright">
                <?php
                    presto_blog_get_footer_copyright();
                    presto_blog_author_link();
                    presto_blog_wp_link();
                    the_privacy_policy_link();
                ?>    
            </div>
            <?php presto_blog_get_footer_social(); ?>
        </div>
    </div><!-- .bottom-footer -->
    <?php
}
endif;
add_action( 'presto_blog_footer', 'presto_blog_footer_bottom', 25 );

if( ! function_exists( 'presto_blog_scrolltotop' ) ) :
/**
 * Scroll Up to Top
*/
function presto_blog_scrolltotop(){ ?>
    <button class="goto-top">
        <?php echo presto_blog_svg_collection( 'gototop' ); ?>
    </button>
    <?php
}
endif;
add_action( 'presto_blog_footer', 'presto_blog_scrolltotop', 30 );

if( ! function_exists( 'presto_blog_footer_end' ) ) :
/**
 * Footer End
 */
function presto_blog_footer_end(){ ?>
    </footer><!-- .site-footer -->
    <?php
}
endif;
add_action( 'presto_blog_footer', 'presto_blog_footer_end', 35 );

if( ! function_exists( 'presto_blog_page_end' ) ) :
/**
 * Page End
*/
function presto_blog_page_end(){ ?>
    </div><!-- #page -->
    <?php
}
endif;
add_action( 'presto_blog_after_footer', 'presto_blog_page_end', 15 );