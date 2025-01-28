<?php
global $post;
$post_id = $post->ID;

$author_id = get_the_author_meta('ID');
$author_url = get_author_posts_url($author_id);
$author_name = get_the_author_meta('display_name');

$author_site = get_the_author_meta('url');
$author_desc = get_the_author_meta('description');

?>
<div class="single-author-info-area theme-single-post-component">
    <div class="single-author-info-wrapper">
        <div class="author-image">
            <a href="<?php echo esc_url($author_url); ?>" title="<?php echo esc_attr(get_the_author()); ?>">
                <?php echo get_avatar(get_the_author_meta('ID'), 500); ?>
            </a>
        </div>

        <div class="author-details">

            <?php do_action('restochef_author_detail_start'); ?>

            <a href="<?php echo esc_url($author_url); ?>" title="<?php echo esc_attr(get_the_author()); ?>"
               class="author-name">
                <?php the_author(); ?>
            </a>

            <?php if ($author_site): ?>
                <a href="<?php echo esc_url($author_site); ?>" target="_blank" class="author-site color-accent">
                    <?php echo esc_html($author_site); ?>
                </a>
            <?php endif; ?>

            <?php if ($author_desc): ?>
                <div class="author-desc">
                    <?php echo wpautop($author_desc); ?>
                </div>
            <?php endif; ?>

            <?php do_action('restochef_author_detail_end'); ?>

        </div>
    </div>
</div>