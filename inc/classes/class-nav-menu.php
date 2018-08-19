<?php
/**
 * Theme setup and config.
 *
 * @package colby/darenorthward
 */

namespace Colby\DareNorthward;

use Colby\DareNorthward\Traits\Singleton;

/**
 * Handles the main nav menu
 */
class Nav_Menu {

	use Singleton;

	const MENU_NAME = 'Site Menu';

	/**
	 * Nav items, requested when needed
	 *
	 * @var null|array
	 */
	private $items;

	/**
	 * Sets up class.
	 *
	 * @return void
	 */
	protected function init() {
		$this->items = wp_get_nav_menu_items( self::MENU_NAME ) ?: [];
	}

	/**
	 * Assigns child nav items to their parent items.
	 *
	 * @param array $items The wp_nav_menu items.
	 * @return array The filtered array.
	 */
	protected function assign_child_nav_items_to_parents( array $items ) {

		foreach ( $items as $item ) {
			$item->children = array_filter(
				$items, function( $menu_item ) use ( $item ) {
					return intval( $menu_item->menu_item_parent ) === intval( $item->ID );
				}
			);
		}

		$filtered_items = array_filter(
			$items, function( $item ) {
				return intval( $item->menu_item_parent ) === 0;
			}
		);

		return $filtered_items;

	}

	/**
	 * Echoes the menu.
	 *
	 * @return void
	 */
	public function the_menu() {

		$menu_items = $this->assign_child_nav_items_to_parents( $this->items );

		include locate_template( 'templates/partials/nav-menu.php' );
	}

}
