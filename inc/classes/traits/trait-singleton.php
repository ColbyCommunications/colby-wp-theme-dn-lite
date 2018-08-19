<?php
/**
 * Trait for a class to be used as a singleton instance.
 *
 * @since 1.0.0
 * @package colby/darenorthward;
 */

namespace Colby\DareNorthward\Traits;

/**
 * Trait Singleton
 *
 * @codeCoverageIgnore
 * @since 1.0.0
 * @package colby/darenorthward
 */
trait Singleton {

	/**
	 * An instance of the object to prevent duplication.
	 *
	 * @since 1.0.0
	 * @var   object|null Instance of object.
	 */
	protected static $instance = null;

	/**
	 * Object constructor. Intentionally empty and protected.
	 *
	 * @since 1.0.0
	 */
	protected function __construct() {
	}

	/**
	 * Prevent the object from being cloned.
	 *
	 * @since 1.0.0
	 */
	final protected function __clone() {
	}

	/**
	 * Grabs an instance of the Person object.
	 *
	 * @since  1.0.0
	 * @return object
	 */
	final public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
			if ( method_exists( self::$instance, 'init' ) ) {
				self::$instance->init();
			}
		}

		return self::$instance;
	}

	/**
	 * Allows deletion of the singleton for unit testing.
	 */
	public function _delete() {
		self::$instance = null;
	}
}
