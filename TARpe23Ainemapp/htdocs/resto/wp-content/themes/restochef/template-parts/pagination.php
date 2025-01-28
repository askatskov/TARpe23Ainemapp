<div class="restochef-nav-pagination">
    <?php

    $pagination_type = restochef_get_option( 'pagination_type' );

    if( 'ajax_load_on_click' == $pagination_type || 'ajax_load_on_scroll' == $pagination_type ):

        restochef_ajax_pagination($pagination_type);

    elseif ('numeric' == $pagination_type):

        $prev_text = sprintf(
            '%s <span class="nav-prev-text">%s</span>',
            '<span aria-hidden="true">&larr;</span>',
            __( 'Previous', 'restochef' )
        );
        $next_text = sprintf(
            '<span class="nav-next-text">%s</span> %s',
            __( 'Next', 'restochef' ),
            '<span aria-hidden="true">&rarr;</span>'
        );
        $posts_pagination = get_the_posts_pagination(
            array(
                'mid_size'  => 1,
                'prev_text' => $prev_text,
                'next_text' => $next_text,
            )
        );
        // If we're not outputting the previous page link, prepend a placeholder with `visibility: hidden` to take its place.
        if ( strpos( $posts_pagination, 'prev page-numbers' ) === false ) :
            $posts_pagination = str_replace( '<div class="nav-links">', '<div class="nav-links"><span class="prev page-numbers placeholder" aria-hidden="true">' . $prev_text . '</span>', $posts_pagination );
        endif;

        // If we're not outputting the next page link, append a placeholder with `visibility: hidden` to take its place.
        if ( strpos( $posts_pagination, 'next page-numbers' ) === false ) :
            $posts_pagination = str_replace( '</div>', '<span class="next page-numbers placeholder" aria-hidden="true">' . $next_text . '</span></div>', $posts_pagination );
        endif;

        if ( $posts_pagination ) :
            echo $posts_pagination; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- already escaped during generation.
        endif;

    else:
    // Default Pagination
    $prev_text = sprintf(
            '%s <span class="nav-prev-text title">%s</span>',
            '<span class="arrow" aria-hidden="true">&larr;</span>',
            __( 'Older Posts', 'restochef' )
        );
        $next_text = sprintf(
            '%s <span class="nav-next-text title">%s</span>',
            '<span class="arrow" aria-hidden="true">&rarr;</span>',
            __( 'Newer Posts', 'restochef' )
        );
        the_posts_navigation(array(
            'prev_text' => $prev_text,
            'next_text' => $next_text,
        ));

    endif; 
    ?>
</div>