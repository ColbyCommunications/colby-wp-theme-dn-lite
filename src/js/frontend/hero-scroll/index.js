/**
 * WordPress dependencies
 */
import domReady from '@wordpress/dom-ready';

let HEADER_OBSERVER;
let HEADER_IMAGE;

const setClass = ( isIntersecting ) => {
	if ( isIntersecting ) {
		document.body.classList.remove( 'post-scroll' );
	} else {
		document.body.classList.add( 'post-scroll' );
	}
};

const maybeChangePostScrollClass = ( entries ) => {
	try {
		const entry = entries[ 0 ];
		setClass( entry.isIntersecting );
	} catch ( e ) {
		document.body.classList.add( 'post-scroll' );
	}
};

const init = () => {
	try {
		HEADER_IMAGE = document.querySelector( '.header-image__content > div' );
		HEADER_OBSERVER = new global.IntersectionObserver(
			maybeChangePostScrollClass
		);
		HEADER_OBSERVER.observe( HEADER_IMAGE );
	} catch ( e ) {
		document.body.classList.add( 'post-scroll' );
	}
};

const maybeStart = () => {
	if ( 'IntersectionObserver' in global ) {
		init();
	} else {
		document.body.classList.add( 'post-scroll' );
	}
};

domReady( maybeStart );
