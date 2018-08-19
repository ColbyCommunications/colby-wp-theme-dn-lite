<?php
/**
 * Functions for use throughout the theme
 *
 * @package colby/darenorthward
 */

namespace Colby\DareNorthward\Functions;

use Colby\DareNorthward\Dare_Northward;
use Colby\DareNorthward\Nav_Menu;

/**
 * Gets the URL of the single post header image.
 *
 * @return string URL or empty string.
 */
function get_single_post_header_image_url() {
	static $single_post_header_image_url;

	if ( null === $single_post_header_image_url ) {
		$single_post_header_image_url = '';

		/**
		 * Filters whether to render the header image on a page.
		 *
		 * @var bool Default true.
		 * @var WP_Post The current post object.
		 */
		if ( false !== apply_filters( darenorthward_hook( 'singular_do_header_image' ), true, get_post() ) ) {
			$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'hero' );

			if ( is_array( $image ) && isset( $image[0] ) ) {
				$single_post_header_image_url = strval( $image[0] );
			}
		}
	}

	return $single_post_header_image_url;
}

/**
 * Returns whether the current post has a header image.
 *
 * @return boolean
 */
function has_single_post_header_image() {
	return ! ! get_single_post_header_image_url();
}

/**
 * Renders the header image for a single post.
 *
 * @return void
 */
function the_single_post_header_image() {
	header_image(
		[
			'image-url' => get_single_post_header_image_url(),
			'title'     => get_the_title(),
			'subhead'   => get_post_meta( get_the_id(), 'subhead', true ) ?: '',
		]
	);
}

/**
 * Echoes a header image
 *
 * @param array $settings Settings array.
 * @return void
 */
function header_image( $settings ) {
	$image_url = isset( $settings['image-url'] ) ? $settings['image-url'] : '';

	if ( empty( $image_url ) ) {
		return;
	}

	$title   = isset( $settings['title'] ) ? $settings['title'] : '';
	$subhead = isset( $settings['subhead'] ) ? $settings['subhead'] : '';

	include locate_template( 'templates/partials/header-image.php' );
}

/**
 * Gets a header image attached to a term.
 *
 * @param int $term_id A term ID.
 * @return false|array An array of image data or false on failure.
 */
function get_term_header_image( $term_id = null ) {
	static $header_image;

	if ( empty( $term_id ) ) {
		$term_id = get_queried_object_id();
	}

	if ( null === $header_image ) {
		$header_image      = false;
		$featured_image_id = get_term_meta( $term_id, 'image', true );
		if ( $featured_image_id ) {
			$header_image = wp_get_attachment_image_src( $featured_image_id, 'hero' );
		}
	}

	return $header_image;
}

/**
 * Undocumented function
 *
 * @param int $term_id A term ID.
 * @return boolean
 */
function has_term_header_image( $term_id = null ) {
	if ( ! is_archive() ) {
		return false;
	}

	if ( empty( $term_id ) ) {
		$term_id = get_queried_object_id();
	}

	return false !== get_term_header_image( $term_id );
}

/**
 * Echoes the header image for term.
 *
 * @return void
 */
function the_term_header_image() {
	$queried_object = get_queried_object();

	if ( ! is_a( $queried_object, '\WP_Term' ) ) {
		return;
	}

	$featured_image = get_term_header_image();

	return header_image(
		[
			'img-url' => $featured_image[0],
			'title'   => $queried_object->name,
			'subhead' => $queried_object->description,
		]
	);
}

/**
 * Filters a CSS class attribute.
 *
 * @param string $filter_id The filter ID.
 * @param array  $default Passed-in classes.
 */
function filter_css_class( $filter_id, $default = [] ) {
	if ( is_string( $default ) ) {
		$default = explode( ' ', $default );
	}

	if ( ! is_array( $default ) ) {
		$default = [];
	}

	$classes = apply_filters( Dare_Northward::FILTER_PREFIX . $filter_id, $default );

	if ( empty( $classes ) ) {
		return;
	}

	if ( is_array( $classes ) ) {
		$classes = implode( ' ', $classes );
	}

	$classes = esc_attr( $classes );

	echo wp_kses_post( " class=\"$classes\"" );

}

/**
 * Appends the theme filter prefix to a string.
 *
 * @param string $hook_name Any string.
 * @return string The modified string.
 */
function darenorthward_hook( string $hook_name ) : string {
	return Dare_Northward::FILTER_PREFIX . $hook_name;
}

/**
 * Provides the URL to a frontend asset.
 *
 * @param string $filename A file name with a %s tag to be replaced with the text domain.
 *                         Passing additional args will override this default behavior and
 *                         use sprintf to apply args after the first to the first.
 * @return string URL.
 */
function darenorthward_asset_url( string $filename = '' ) {
	$args = func_get_args();

	if ( 1 < count( $args ) ) {
		$file = call_user_func_array( 'sprintf', $args );
	} else {
		$file = sprintf( $filename, Dare_Northward::TEXT_DOMAIN );
	}

	return sprintf(
		'%sdist/%s',
		trailingslashit( get_template_directory_uri() ),
		$file
	);
}

/**
 * Returns a version string for a file.
 *
 * @param string $filename A filename.
 * @return string Version string.
 */
function darenorthward_file_version( string $filename ) {
	return filemtime( locate_template( sprintf( $filename, Dare_Northward::TEXT_DOMAIN ) ) );
}

/**
 * Echoes a featured image for a post in an archive.
 *
 * @return void
 */
function the_archive_post_thumbnail() {
	static $did_first_item;

	if ( null === $did_first_item ) {
		$did_first_item = true;
	}

	if ( ! has_post_thumbnail() ) {
		return;
	}

	$size = true === $did_first_item ? 'mini-featured' : 'big-thumbnail';

	include locate_template( 'templates/partials/archive-post-thumbnail.php' );
}

/**
 * Echoes the footer nav.
 *
 * @return void
 */
function footer_nav() {
	get_template_part( 'templates/partials/footer-nav' );
}

/**
 * Echoes the nav menu.
 *
 * @return void
 */
function nav_menu() {
	Nav_Menu::get_instance()->the_menu();
}

/**
 * Echoes the address in the footer.
 *
 * @todo Handle this better with options.
 * @return void
 */
function footer_address() {

	$html = '
		<span>4300 Mayflower Hill</span>
		<span>Waterville, ME 04901</span>
		<span>207-859-4300</span>
		<span><a style="color:white" href="mailto:darenorthward@colby.edu">darenorthward@colby.edu</a></span>';

	/**
	 * Filters the footer address HTML.
	 *
	 * @param $html Default HTML.
	 */
	$footer_html = apply_filters( darenorthward_hook( 'footer_address' ), $html );

	echo wp_kses_post( '<div class="footer-address">' . $footer_html . '</div>' );
}

/**
 * Echoes the SVG clip path used for stylistic purposes.
 *
 * @return void
 */
function clip_path_svg() {
	locate_template( 'templates/partials/clip-path.svg', true );
}

/**
 * Echoes the header nav.
 *
 * @return void
 */
function header_nav() {
	get_template_part( 'templates/partials/header-nav' );
}
