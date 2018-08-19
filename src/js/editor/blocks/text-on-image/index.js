/**
 * WordPress dependencies
 */
import { registerBlockType } from '@wordpress/blocks';
import { Fragment } from '@wordpress/element';
import {
	MediaPlaceholder,
	RichText,
	BlockControls,
	MediaUpload,
	InspectorControls,
} from '@wordpress/editor';
import {
	Toolbar,
	IconButton,
	TextControl,
	PanelBody,
} from '@wordpress/components';
import { __ } from '@wordpress/i18n';

registerBlockType( 'colby/darenorthward-text-on-image', {
	title: 'Text on Image',

	category: 'layout',

	attributes: {
		url: {
			type: 'string',
		},
		text: {
			type: 'string',
		},
		link: {
			type: 'string',
		},
		id: {
			type: 'number',
		},
	},

	edit( { attributes, setAttributes } ) {
		const { url, text, link, id } = attributes;

		const onSelectImage = ( media ) => {
			if ( ! media || ! media.url ) {
				setAttributes( { url: undefined, id: undefined } );
				return;
			}
			setAttributes( { url: media.url, id: media.id } );
		};

		const controls = (
			<Fragment>
				<BlockControls>
					<Toolbar>
						<MediaUpload
							onSelect={ onSelectImage }
							type="image"
							value={ id }
							render={ ( { open } ) => (
								<IconButton
									className="components-toolbar__control"
									label={ __( 'Edit image' ) }
									icon="edit"
									onClick={ open }
								/>
							) }
						/>
					</Toolbar>
				</BlockControls>
				<InspectorControls>
					<PanelBody title={ __( 'Cover Image Settings' ) }>
						<TextControl
							type="url"
							label={ __( 'Link' ) }
							value={ link }
							placeholder={ __( 'Enter a URL' ) }
							onChange={ ( value ) => {
								setAttributes( { link: value } );
							} }
						/>
					</PanelBody>
				</InspectorControls>
			</Fragment>
		);

		if ( ! url ) {
			return (
				<Fragment>
					{ controls }
					<MediaPlaceholder
						labels={ {
							title: __( 'Image text' ),
							name: __( 'an image' ),
						} }
						onSelect={ onSelectImage }
						accept="image/*"
						type="image"
					/>
				</Fragment>
			);
		}

		const WrapperElement = link ? 'a' : 'div';

		const style = {};
		if ( url ) {
			style.backgroundImage = `url('${ url }')`;
		}

		return (
			<Fragment>
				{ controls }
				<WrapperElement className="text-on-image">
					<div style={ style } className="text-on-image__inner">
						<RichText
							tagName="div"
							placeholder={ __( 'Text' ) }
							value={ text }
							onChange={ ( value ) => {
								setAttributes( {
									text: value,
								} );
							} }
							inlineToolbar
						/>
					</div>
				</WrapperElement>
			</Fragment>
		);
	},

	save( { attributes } ) {
		const { url, text, link } = attributes;

		const WrapperElement = link ? 'a' : 'div';
		const props = {};
		if ( link ) {
			props.href = link;
		}

		const style = {};
		if ( url ) {
			style.backgroundImage = `url('${ url }')`;
		}

		return (
			<WrapperElement className="text-on-image" { ...props }>
				<div className="text-on-image__inner" style={ style }>
					{ text &&
						text.length > 0 && <RichText.Content tagName="div" value={ text } /> }
				</div>
			</WrapperElement>
		);
	},
} );
