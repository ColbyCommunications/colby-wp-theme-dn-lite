<?php
/**
 * Template Name: Extra Wide
 *
 * @package colby/darenorthward
 */

add_filter(
	'post_class', function( $classes ) {
		if ( ! is_array( $classes ) ) {
			$classes = [];
		}

		$classes[] = 'extra-wide';

		return $classes;
	}
);

locate_template( 'single.php', true );
