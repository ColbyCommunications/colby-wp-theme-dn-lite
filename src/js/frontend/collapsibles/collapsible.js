/**
 * External dependencies
 */
import AnimateHeight from 'react-animate-height';

/**
 * WordPress dependencies
 */
import { Component } from '@wordpress/element';

class Collapsible extends Component {
	constructor( props ) {
		super( props );

		this.state = {
			collapsed: props.collapsed,
		};

		this.uncollapse = this.uncollapse.bind( this );
	}

	componentDidMount() {
		this.props.root.style.visibility = 'visible';
		this.props.root.classList.remove( 'collapsed' );
	}

	uncollapse() {
		this.setState( { collapsed: ! this.state.collapsed } );
	}

	render() {
		const TriggerElement = this.props.triggerElement;
		return (
			<div className={ `collapsible${ this.state.collapsed ? ' collapsed' : '' }` }>
				<TriggerElement
					dangerouslySetInnerHTML={ { __html: this.props.triggerHTML } }
					className="collapsible-trigger"
					role="button"
					tabIndex="0"
					onClick={ this.uncollapse }
					onKeyDown={ ( event ) => {
						if ( event.keyCode === 13 ) {
							this.uncollapse();
						}
					} }
				/>
				<AnimateHeight
					height={ this.state.collapsed ? 0 : ' auto' }
					duration={ 500 }
				>
					<div
						className="collapsible-drawer"
						dangerouslySetInnerHTML={ { __html: this.props.drawerHTML } }
					/>
				</AnimateHeight>
			</div>
		);
	}
}

Collapsible.defaultProps = {
	collapsed: true,
	triggerElement: 'H3',
};

export default Collapsible;
