<?php 
    $ed_shop_section = restochef_get_option( 'enable_shop_section' );
    $section_title   = restochef_get_option( 'shop_post_title' );
    $section_content = restochef_get_option( 'shop_post_description' );
    $product_type    = restochef_get_option( 'shop_select_product_from' );
    $custom_product  = restochef_get_option( 'select_product_category' );
    $button_lbl      = restochef_get_option( 'shop_post_button_text' );
    $button_link     = restochef_get_option( 'shop_post_button_url' );
    $shop_number_of_column  = restochef_get_option( 'shop_number_of_column' );
    $shop_number_of_product = restochef_get_option( 'shop_number_of_product' );
    if( $ed_shop_section ){
        
        $args = array(
            'post_type'       => 'product',
            'posts_per_page'  => $shop_number_of_product,
            'post_status'     => 'publish'
        );
        if( $product_type == 'custom' ){
            $args = '';
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => $shop_number_of_product,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field' => 'slug',
                        'terms' => $custom_product,
                    ),
                ),
            );
        }elseif( $product_type == 'popular-products' ){
            $args['meta_key'] = 'total_sales';
            $args['order_by'] = 'meta_value_num';
        }elseif( $product_type == 'sale-products' ){
            $args['meta_query'] = WC()->query->get_meta_query();
            $args['post__in']   = array_merge(array(0), wc_get_product_ids_on_sale());
        }else{
            $args['orderby']     = 'date';
            $args['order']       = 'DESC';
        }
        $qry = new WP_Query( $args );
        
        if( $qry->have_posts() || $section_title || $section_content ){ ?>
            <section class="site-section site-product-section">
                <?php if( $section_title || $section_content ){ ?>
                    <header class="section-header site-section-header">
                        <div class="wrapper">
                            <?php
                                if( $section_title ) echo '<h2 class="font-size-big">' . esc_html( $section_title ) . '</h2>';
                                if( $section_content ) echo '<div class="site-section-subtitle">' . wp_kses_post( wpautop( $section_content ) ) . '</div>';
                            ?>
                        </div>
                    </header>
                <?php }
                if( $qry->have_posts() ){ ?>
                    <div class="wrapper">
                        <ul class="woocommerce product-section-grid product-grid-<?php echo absint($shop_number_of_column);?>">
                            <?php while( $qry->have_posts() ){
                                $qry->the_post();
                                global $product;
                                $stock = get_post_meta( get_the_ID(), '_stock_status', true );
                                ?>
                                <li <?php wc_product_class('theme-product-item', $product); ?>>
                                    <div class="theme-product-image">

                                        <a href="<?php the_permalink(); ?>" rel="bookmark">
                                            <?php
                                            if (has_post_thumbnail()) {
                                                the_post_thumbnail('medium_large');
                                            } else {
                                                restochef_theme_svg('restochef-shop'); //fallback
                                            }
                                            ?>
                                        </a>
                                        <?php
                                        $stock = get_post_meta(get_the_ID(), '_stock_status', true);
                                        if ($stock == 'outofstock') {
                                            echo '<span class="outofstock-label">' . esc_html__('Sold Out', 'restochef') . '</span>';
                                        } else {
                                            woocommerce_show_product_sale_flash();
                                        }
                                        ?>
                                        <?php woocommerce_template_loop_add_to_cart(); ?>
                                    </div>
                                    <div class="product-detail">
                                        <?php
                                        woocommerce_template_single_rating();
                                        the_title('<h2 class="woocommerce-loop-product__title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>');
                                        woocommerce_template_single_price();
                                        ?>
                                    </div>
                                </li>
                            <?php } wp_reset_postdata(); ?>
                        </ul>
                        <?php if( $button_lbl && $button_link ) { ?>
                            <div class="button-wrap">
                                <a href="<?php echo esc_url( $button_link ); ?>" class="btn-readmore"><?php echo esc_html( $button_lbl ); ?></a>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </section>
        <?php
        }
    }









