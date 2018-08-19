<?php
/**
 * Theme setup and config.
 *
 * @package colby/darenorthward
 */

namespace Colby\DareNorthward;

use Colby\DareNorthward\Traits\Singleton;

/**
 * Query-related hooks
 */
class Query {

	use Singleton;

	/**
	 * Adds hook callbacks.
	 *
	 * @return void
	 */
	protected function init() {
		add_action( 'pre_get_posts', [ $this, 'modify_archive_query' ] );
	}

	/**
	 * Modifies the main query for archive pages
	 *
	 * @param \WP_Query $query The query object.
	 * @return void
	 */
	public function modify_archive_query( $query ) {
		if ( is_admin() ) {
			return;
		}

		if ( ! $query->is_main_query() ) {
			return;
		}

		if ( ! is_archive() && ! is_home() && ! is_front_page() ) {
			return;
		}

		$query->set( 'posts_per_page', 9 );
	}

}
