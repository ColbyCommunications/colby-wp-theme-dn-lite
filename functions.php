<?php
/**
 * Theme entry point
 *
 * @package colby/darenorthward
 */

if ( ! file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	return;
}

require_once 'vendor/autoload.php';
require_once 'inc/functions.php';

Colby\DareNorthward\Dare_Northward::get_instance();
