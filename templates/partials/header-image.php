<?php
/**
 * Template for a header image
 *
 * @package colby/darenorthward
 */

if ( isset( $title ) && isset( $subhead ) && isset( $image_url ) ) :

	?>

<aside class="header-image">
	<div class="header-image__content" style="background-image: url('<?php echo esc_url( $image_url ); ?>');">
		<div>
			<h1><?php echo wp_kses_post( $title ); ?></h1>
			<p><?php echo wp_kses_post( $subhead ); ?></p>
		</div>
	</div>
</aside>

	<?php
endif;
