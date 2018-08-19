<?php
/**
 * Theme setup and config.
 *
 * @package colby/darenorthward
 */

namespace Colby\DareNorthward;

use Colby\DareNorthward\Traits\Singleton;
use function Colby\DareNorthward\Functions\darenorthward_hook;

/**
 * Media-related hooks
 */
class Media {

	use Singleton;

	/**
	 * Adds hook callbacks.
	 *
	 * @return void
	 */
	protected function init() {
		add_action( 'after_setup_theme', [ $this, 'register_image_sizes' ] );
		add_filter( darenorthward_hook( 'singular_do_header_image' ), [ $this, 'maybe_disable_header_image' ], 10, 2 );
		add_filter( 'image_size_names_choose', 'add_image_sizes_to_chooser' );
		add_filter( 'img_caption_shortcode', [ $this, 'filter_img_caption' ], 10, 3 );

	}

	/**
	 * Adds image sizes.
	 *
	 * @return void
	 */
	public function register_image_sizes() {
		foreach ( $this->get_image_sizes() as $image_size_args ) {
			call_user_func_array( 'add_image_size', $image_size_args );
		}
	}

	/**
	 * Disable the header image for posts in certain categories.
	 *
	 * @param boolean  $bool Wether the image is currently disabled.
	 * @param \WP_Post $post The current post.
	 * @return boolean True or false.
	 */
	public function maybe_disable_header_image( bool $bool, \WP_Post $post ) : bool {
		if ( in_category( [ 'events', 'news' ], $post ) ) {
			return false;
		}

		return $bool;
	}

	/**
	 * Adds custom image sizes to the size select in the admin.
	 *
	 * @param array $sizes Unfiltered size data.
	 * @return array
	 */
	public function add_image_sizes_to_chooser( $sizes ) {
		foreach ( $this->get_image_sizes() as $key => $args ) {
			$sizes[ $args[0] ] = $key;
		}

		return $sizes;
	}

	/**
	 * Provides custom image sizes registered in the theme.
	 *
	 * @return array
	 */
	public function get_image_sizes() {
		return [
			'Hero'           => [
				'hero',
				1600,
				900,
				true,
			],
			'Big Thumbnail'  => [
				'big-thumbnail',
				400,
				400,
				true,
			],
			'Huge Thumbnail' => [
				'huge-thumbnail',
				800,
				800,
				true,
			],
			'Medium Hero'    => [
				'medium-hero',
				1600,
				600,
				true,
			],
			'Mini Featured'  => [
				'mini-featured',
				500,
				400,
				true,
			],
		];

	}

	/**
	 * Filters image caption HTML.
	 *
	 * @param string $output Unfiltered output.
	 * @param array  $attr Image caption shortcode attributes.
	 * @param string $content Post content.
	 * @return string Fitlered output.
	 */
	public function filter_img_caption( $output, $attr, $content ) {
		$atts = shortcode_atts(
			[
				'id'      => '',
				'align'   => 'alignnone',
				'width'   => '',
				'caption' => '',
				'class'   => '',
			], $attr, 'caption'
		);

		$atts['width'] = (int) $atts['width'];
		if ( $atts['width'] < 1 || empty( $atts['caption'] ) ) {
			return $content;
		}

		if ( ! empty( $atts['id'] ) ) {
			$atts['id'] = 'id="' . esc_attr( sanitize_html_class( $atts['id'] ) ) . '" ';
		}

		$class = trim( 'wp-caption ' . $atts['align'] . ' ' . $atts['class'] );
		$width = 10 + $atts['width'];

		$caption_width = apply_filters( 'img_caption_shortcode_width', $width, $atts, $content );

		$style = '';
		if ( $caption_width ) {
			$style = 'style="max-width: ' . (int) $caption_width . 'px" ';
		}

		$html = '<div ' . $atts['id'] . $style . 'class="' . esc_attr( $class ) . '">'
		. do_shortcode( $content ) . '<div class="wp-caption-text">' . "<div><span>{$atts['caption']}</span></div>" . '</div></div>';

		return $html;
	}
}
