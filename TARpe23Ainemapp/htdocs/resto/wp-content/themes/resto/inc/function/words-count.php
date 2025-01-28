<?php
/**
* Returns word count of the sentences.
*
* @since @since resto 1.0.0
*/
if ( ! function_exists( 'resto_words_count' ) ) :
	function resto_words_count( $length = 25, $resto_content = null ) {
		$length = absint( $length );
		$source_content = preg_replace( '`\[[^\]]*\]`', '', $resto_content );
		$trimmed_content = wp_trim_words( $source_content, $length, '...' );
		return $trimmed_content;
	}
endif;