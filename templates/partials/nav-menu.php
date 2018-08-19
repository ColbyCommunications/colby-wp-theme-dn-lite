<?php
/**
 * Template for the main site nav menu
 *
 * @package colby/darenorthward
 */

if ( isset( $menu_items ) ) :
	?>

<div data-site-menu class="site-menu">

	<?php foreach ( $menu_items as $index => $item ) : ?>

		<div class="site-menu__item <?php echo esc_attr( ! empty( $item->children ) ? 'has-children' : '' ); ?>">

		<<?php echo esc_attr( empty( $item->children ) ? 'a' : 'button' ); ?>
			class="site-menu__link
			<?php echo esc_attr( implode( ' ', $item->classes ) ); ?>"
			href="<?php echo esc_url( $item->url ); ?>">

			<?php echo wp_kses_post( $item->title ); ?>

			<?php if ( $item->children ) : ?>

				<span class="child-menu-icon">&blacktriangledown;</span>
			<?php endif; ?>

		</<?php echo esc_attr( empty( $item->children ) ? 'a' : 'button' ); ?>>

		<?php if ( ! empty( $item->children ) ) : ?>
			<div class="submenu">

				<?php foreach ( $item->children as $child ) : ?>
					<a href="<?php echo esc_url( $child->url ); ?>">
						<?php echo wp_kses_post( $child->title ); ?>
					</a>
				<?php endforeach; ?>

			</div>
		<?php endif; ?>

		</div>
	<?php endforeach; ?>

</div>
	<?php
endif;
