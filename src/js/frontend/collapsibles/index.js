/**
 * WordPress dependencies
 */
import domReady from '@wordpress/dom-ready';

/**
 * Internal dependencies
 */
import Collapsibles from './collapsibles';

domReady( () => {
	new Collapsibles();
} );
