<?php
/**
 * Theme setup and config.
 *
 * @package colby/darenorthward
 */

namespace Colby\DareNorthward;

use Colby\DareNorthward\Traits\Singleton;
use function Colby\DareNorthward\Functions\darenorthward_asset_url;
use function Colby\DareNorthward\Functions\darenorthward_file_version;

/**
 * Theme setup
 */
class Dare_Northward {

	use Singleton;

	/**
	 * Vendor prefix for use in namespacing.
	 *
	 * @var string
	 */
	const VENDOR = 'colby';

	/**
	 * Theme text domain.
	 *
	 * @var string
	 */
	const TEXT_DOMAIN = 'darenorthward';

	/**
	 * Prefix to add to filters and other field names.
	 *
	 * @var string
	 */
	const FILTER_PREFIX = self::VENDOR . '__' . self::TEXT_DOMAIN . '__';

	/**
	 * Setup.
	 *
	 * @return void
	 */
	protected function init() {
		add_action( 'after_setup_theme', [ $this, 'add_opt_in_features' ] );
		add_action( 'init', [ $this, 'register_blocks' ] );
		add_action( 'init', [ $this, 'register_assets' ] );
		add_action( 'enqueue_block_assets', [ $this, 'enqueue_block_assets' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_assets' ] );

		Media::get_instance();
		Query::get_instance();
	}

	/**
	 * Enables features.
	 *
	 * @return void
	 */
	public function add_opt_in_features() {
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_post_type_support( 'page', 'excerpt' );
	}

	/**
	 * Registers assets.
	 *
	 * @return void
	 */
	public function register_assets() {
		wp_register_style(
			self::TEXT_DOMAIN,
			darenorthward_asset_url( '%s.css' ),
			[],
			darenorthward_file_version( '%s.css' )
		);

		wp_register_script(
			self::TEXT_DOMAIN,
			darenorthward_asset_url( '%s.js' ),
			[],
			darenorthward_file_version( '%s.js' ),
			true
		);

		wp_register_style(
			sprintf( '%s-frontend', self::TEXT_DOMAIN ),
			darenorthward_asset_url( '%s-frontend.css' ),
			[],
			darenorthward_file_version( '%s-frontend.css' )
		);

		wp_register_script(
			sprintf( '%s-frontend', self::TEXT_DOMAIN ),
			darenorthward_asset_url( '%s-frontend.js' ),
			[
				'wp-element',
				'wp-dom-ready',
				'wp-keycodes',
			],
			darenorthward_file_version( '%s-frontend.js' ),
			true
		);

		wp_register_style(
			sprintf( '%s-editor', self::TEXT_DOMAIN ),
			darenorthward_asset_url( '%s-editor.css' ),
			[],
			darenorthward_file_version( '%s-editor.css' )
		);

		wp_register_script(
			sprintf( '%s-editor', self::TEXT_DOMAIN ),
			darenorthward_asset_url( '%s-editor.js' ),
			[],
			darenorthward_file_version( '%s-editor.js' ),
			true
		);
	}

	/**
	 * Enqueues assets for both the editor and the front end.
	 *
	 * @return void
	 */
	public function enqueue_block_assets() {
		wp_enqueue_style( self::TEXT_DOMAIN );
	}

	/**
	 * Enqueues frontend-only assets.
	 *
	 * @return void
	 */
	public function enqueue_assets() {
		wp_enqueue_script( sprintf( '%s-frontend', self::TEXT_DOMAIN ) );
	}

	/**
	 * Registers editor blocks.
	 *
	 * @return void
	 */
	public function register_blocks() {
		if ( ! function_exists( 'register_block_type' ) ) {
			return;
		}

		register_block_type(
			sprintf( '%s/%s-text-on-image', self::VENDOR, self::TEXT_DOMAIN ),
			[
				'editor_script' => sprintf( '%s-editor', self::TEXT_DOMAIN ),
				'editor_style'  => sprintf( '%s-editor', self::TEXT_DOMAIN ),
			]
		);

		register_block_type(
			sprintf( '%s/%s-collapsible', self::VENDOR, self::TEXT_DOMAIN ),
			[
				'editor_script' => sprintf( '%s-editor', self::TEXT_DOMAIN ),
				'editor_style'  => sprintf( '%s-editor', self::TEXT_DOMAIN ),
			]
		);
	}
}
