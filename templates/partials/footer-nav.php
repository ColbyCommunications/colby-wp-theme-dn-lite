<?php
/**
 * Template for the footer nav
 *
 * @package colby/darenorthward
 */

use function Colby\DareNorthward\Functions\nav_menu;

?>

<nav class="footer-nav">

	<a href="https://www.colby.edu/" class="nav__logo-container">
		<?php locate_template( 'assets/svg/colby-logo.svg', true ); ?>
	</a>

	<div class="socialIcons">
		<a href="https://www.facebook.com/colbycollege/">
			<?php locate_template( 'assets/svg/facebook.svg', true ); ?>
		</a>
		<a href="https://twitter.com/ColbyCollege">
			<?php locate_template( 'assets/svg/twitter.svg', true ); ?>
		</a>
		<a href="https://www.instagram.com/colbycollege/?hl=en">
			<?php locate_template( 'assets/svg/instagram.svg', true ); ?>
		</a>
		<a href="mailto:darenorthward@colby.edu">
			<?php locate_template( 'assets/svg/email.svg', true ); ?>
		</a>
	</div>

</nav>
