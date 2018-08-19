/**
 * WordPress dependendies
 */
import { render } from '@wordpress/element';

/**
 * Internal dependencies
 */
import Collapsible from './collapsible';

class Collapsibles {
	static initCollapsible( collapsible ) {
		const drawer = collapsible.querySelector( '[data-collapsible-drawer]' );
		const trigger = collapsible.querySelector( '[data-collapsible-trigger]' );
		const collapsed = collapsible.classList.contains( 'collapsed' );

		if ( ! ( drawer && trigger ) ) {
			return;
		}

		render(
			<Collapsible
				drawerHTML={ drawer.innerHTML.replace( / data-src="/g, ' src=' ) }
				triggerHTML={ trigger.innerHTML.replace( / data-src="/g, ' src=' ) }
				triggerElement={ trigger.nodeName.toLowerCase() }
				collapsed={ collapsed }
				root={ collapsible }
			/>,
			collapsible,
			() => {
				collapsible.style.visibility = 'visible';
			}
		);
	}

	constructor() {
		this.collapsibles = document.querySelectorAll( '[data-collapsible]' );
		this.init.bind( this )();
	}

	init() {
		if ( this.collapsibles ) {
			this.run.bind( this )();
		}
	}

	run() {
		[ ...this.collapsibles ].forEach( Collapsibles.initCollapsible );
	}
}

export default Collapsibles;
