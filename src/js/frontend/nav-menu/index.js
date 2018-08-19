/**
 * WordPress dependencies
 */
import domReady from '@wordpress/dom-ready';
import { ESCAPE } from '@wordpress/keycodes';

const run = ( toggler, menu ) => {
	toggler.addEventListener( 'click', () => {
		toggler.classList.toggle( 'active' );
		menu.classList.toggle( 'active' );
	} );

	window.addEventListener( 'keydown', ( event ) => {
		if ( toggler.classList.contains( 'active' ) && event.keyCode === ESCAPE ) {
			toggler.classList.remove( 'active' );
			menu.classList.remove( 'active' );
		}
	} );
};

const handleMenuVisibility = () => {
	const toggler = document.querySelector( '[data-site-menu-toggler]' );
	const menu = document.querySelector( '[data-site-menu]' );

	if ( toggler && menu ) {
		run( toggler, menu );
	}
};

domReady( handleMenuVisibility );
