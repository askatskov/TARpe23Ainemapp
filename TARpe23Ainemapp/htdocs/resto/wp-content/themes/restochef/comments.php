<?php
/**
 * The template for displaying Comments.
 *
 * @package Restochef
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
} ?>

    <div id="comments" class="single-comments-area theme-single-post-component  <?php if ( ! have_comments() ) { echo 'no-comments'; } ?>">
        <div class="comments-area-title">
            <h3 class="comments-title">
                <?php
                if ( have_comments() ) :
                    printf(
                        _n(
                            '<span class="comment-number total">1</span> Comment',
                            '<span class="comment-number total">%1$s</span>Comments',
                            get_comments_number(),
                            'restochef'
                        ),
                        number_format_i18n( get_comments_number() )
                    );
                else:
                    _e( '<span class="comment-number total">+</span> There are no comments', 'restochef' );
                endif;
                ?>
            </h3>
            <?php echo '<a class="comments_add-comment" href="#reply-title">' . __( 'Add yours', 'restochef' ) . '</a>'; ?>
        </div>
        <?php
        // You can start editing here -- including this comment!
        if ( have_comments() ) :
            if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
                <nav role="navigation" id="comment-nav-above" class="site-navigation comment-navigation">
                    <h3 class="assistive-text"><?php _e( 'Comment navigation', 'restochef' ); ?></h3>

                    <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'restochef' ) ); ?></div>
                    <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'restochef' ) ); ?></div>
                </nav><!-- #comment-nav-before .site-navigation .comment-navigation -->
            <?php endif; // check for comment navigation ?>

            <ol class="commentlist">
                <?php
                /* Loop through and list the comments. Tell wp_list_comments()
                 * to use restochef_comment() to format the comments.
                 * If you want to overload this in a child theme then you can
                 * define restochef_comment() and that will be used instead.
                 * See restochef_comment() in inc/template-tags.php for more.
                 */
                wp_list_comments( array( 'callback' => 'restochef_comments', 'short_ping' => true ) ); ?>
            </ol><!-- .commentlist -->

            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
            <nav role="navigation" id="comment-nav-below" class="site-navigation comment-navigation">
                <h3 class="assistive-text"><?php _e( 'Comment navigation', 'restochef' ); ?></h3>

                <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'restochef' ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'restochef' ) ); ?></div>
            </nav><!-- #comment-nav-below .site-navigation .comment-navigation -->
        <?php endif; // check for comment navigation ?>


        <?php endif; // have_comments() ?>

    </div><!-- #comments .single-comments-area -->
<?php
// If comments are closed and there are comments, let's leave a little note, shall we?
if ( ! comments_open() && post_type_supports( get_post_type(), 'comments' ) && ! is_page() ) :
    ?>
    <p class="nocomments"><?php _e( 'Comments are closed.', 'restochef' ); ?></p>
<?php endif;

if ( is_user_logged_in() ) {
    $current_user  = wp_get_current_user();
    $comments_args = array(
        // change the title of send button=
        'title_reply'          => __( '<span class="comment-number total">+</span> Leave a Comment', 'restochef' ),
        // remove "Text or HTML to be displayed after the set of comment fields"
        'comment_notes_before' => '',
        'comment_notes_after'  => '',
        'id_submit'            => 'comment-submit',
        'label_submit'         => __( 'Submit', 'restochef' ),
        // redefine your own textarea (the comment body)
        'comment_field'        => '<p class="comment-form-comment"><label for="comment" class="show-on-ie8">' . __( 'Comment', 'restochef' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . __( 'Your thoughts..', 'restochef' ) . '"></textarea></p>'
    );
} else {
    $comments_args = array(
        // change the title of send button
        'title_reply'          => __( '<span class="comment-number total">+</span> Leave a Comment', 'restochef' ),
        // remove "Text or HTML to be displayed after the set of comment fields"
        'comment_notes_before' => '',
        'comment_notes_after'  => '',
        'id_submit'            => 'comment-submit',
        'label_submit'         => __( 'Submit', 'restochef' ),
        // redefine your own textarea (the comment body)
        'comment_field'        => '<p class="comment-form-comment"><label for="comment" class="show-on-ie8">' . __( 'Comment', 'restochef' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . __( 'Your thoughts..', 'restochef' ) . '"></textarea></p>'
    );
}

//if we have no comments than we don't a second title, one is enough
if ( ! have_comments() ) {
    $comments_args['title_reply'] = '';
}

comment_form( $comments_args );
