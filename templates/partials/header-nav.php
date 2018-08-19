<?php
/**
 * Template for the nav menu in the header
 *
 * @package colby/darenorthward
 */

use function Colby\DareNorthward\Functions\nav_menu; ?>

<nav class="nav">

	<div class="nav__logos">

		<a href="http://www.colby.edu/" class="nav__logo-container">
			<?php locate_template( 'assets/svg/colby-logo.svg', true, false ); ?>
		</a>
		<a href="<?php bloginfo( 'url' ); ?>" class="nav__dn-logo-container">
			<?php locate_template( 'assets/svg/dn-logo-primary-white.svg', true, false ); ?>
		</a>

	</div>

	<div class="nav__menus">

		<?php nav_menu(); ?>
		<a class="give-button" href="/giving/"><?php esc_html_e( 'Give', 'darenorthward' ); ?></a>
		<button role="button" data-site-menu-toggler class="hamburger-icon-container">
			<?php locate_template( 'assets/svg/menu-icon.svg', true, false ); ?>
		</button>

	</div>

</nav>
