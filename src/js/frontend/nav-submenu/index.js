/**
 * WordPress dependencies
 */
import domReady from '@wordpress/dom-ready';

const start = () => {
	[ ...document.querySelectorAll( 'button.site-menu__link' ) ].forEach( ( button ) => {
		const submenu = button.parentElement.querySelector( '.submenu' );

		if ( ! submenu ) {
			return;
		}

		button.addEventListener( 'click', () => {
			submenu.classList.toggle( 'active' );
		} );
	} );
};

domReady( start );
