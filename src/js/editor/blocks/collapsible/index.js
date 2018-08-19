/**
 * External dependencies
 */
import classnames from 'classnames';

/**
 * WordPress dependencies
 */
import { registerBlockType } from '@wordpress/blocks';
import { decodeEntities } from '@wordpress/html-entities';
import { RichText, InnerBlocks } from '@wordpress/editor';
import { __ } from '@wordpress/i18n';

registerBlockType( 'colby/darenorthward-collapsible', {
	title: 'Collapsible Section',

	category: 'layout',

	attributes: {
		collapsed: {
			type: 'boolean',
		},
		title: {
			type: 'string',
		},
	},

	edit( { attributes, setAttributes } ) {
		const { title, collapsed } = attributes;

		return (
			<div
				data-collapsible
				className={ classnames( 'collapsible', collapsed ? 'collapsed' : '' ) }
			>
				<RichText
					data-collapsible-trigger
					className="collapsible-trigger"
					tagName="div"
					role="button"
					placeholder={ __( 'Text' ) }
					value={ decodeEntities( title ) }
					onChange={ ( value ) => {
						setAttributes( {
							title: value,
						} );
					} }
					inlineToolbar
				/>
				<div data-collapsible-drawer className="collapsible-drawer">
					<InnerBlocks />
				</div>
			</div>
		);
	},

	save( { attributes } ) {
		const { title, collapsed } = attributes;

		return (
			<div
				data-collapsible
				className={ classnames( 'collapsible', collapsed ? 'collapsed' : '' ) }
				style={ { visibility: 'hidden' } }
			>
				<RichText.Content
					data-collapsible-trigger
					className="collapsible-trigger"
					tagName="div"
					role="button"
					value={ decodeEntities( title ) }
				/>
				<div data-collapsible-drawer className="collapsible-drawer">
					<InnerBlocks.Content />
				</div>
			</div>
		);
	},
} );
