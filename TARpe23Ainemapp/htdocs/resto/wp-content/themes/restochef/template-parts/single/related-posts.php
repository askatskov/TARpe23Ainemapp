<?php
global $post;
$post_id = $post->ID;

$related_posts_text = restochef_get_option('related_posts_text');
$no_of_related_posts = absint(restochef_get_option('no_of_related_posts'));
$order = esc_attr(restochef_get_option('related_posts_order'));
$orderby = esc_attr(restochef_get_option('related_posts_orderby'));

// Covert id to ID to make it work with query
if( 'id' == $orderby ){
    $orderby = 'ID';
}

$category_ids = array();
$categories = get_the_category($post_id);

if(!empty($categories)) :
    foreach($categories as $cat):
        $category_ids[] = $cat->term_id;
    endforeach;
endif;

if( !empty($category_ids) ):

    $related_posts_args = array(
        'category__in' => $category_ids,
        'post_type' => 'post',
        'post__not_in' => array($post_id),
        'posts_per_page' => $no_of_related_posts,
        'ignore_sticky_posts' => 1,
        'orderby' => $orderby,
        'order' => $order,
    );

    $related_posts_query = new WP_Query($related_posts_args);

    if( $related_posts_query->have_posts() ):
        ?>
        <div class="single-related-posts-area theme-single-post-component">
            <header class="component-header single-component-header">
                <h2 class="single-component-title">
                    <?php echo esc_html($related_posts_text);?>
                </h2>
            </header>
            <div class="component-content single-component-content">
                <?php while($related_posts_query->have_posts()):$related_posts_query->the_post();?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('theme-article-post theme-single-component-article'); ?>>
                        <?php if (has_post_thumbnail()): ?>
                            <div class="entry-image">
                                <figure class="featured-media featured-media-small">
                                    <a href="<?php the_permalink() ?>">
                                        <?php
                                        the_post_thumbnail('medium_large', array(
                                            'alt' => the_title_attribute(array(
                                                'echo' => false,
                                            )),
                                        ));
                                        ?>
                                    </a>
                                    <?php if (restochef_get_option('show_lightbox_image')) { ?>
                                        <a href="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" class="featured-media-fullscreen" data-glightbox="">
                                            <?php restochef_theme_svg('fullscreen'); ?>
                                        </a>
                                    <?php } ?>
                                </figure>
                            </div>
                        <?php endif; ?>
                        <div class="entry-details">
                            <h3 class="entry-title font-size-small">
                                <a href="<?php the_permalink() ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            <div class="post-date">
                                <?php echo esc_html(get_the_date()); ?>
                            </div>
                        </div>
                    </article>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>

        <?php

    endif;

endif;