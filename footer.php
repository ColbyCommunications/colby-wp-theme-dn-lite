<?php
/**
 * Footer.php
 *
 * @package colby/darenorthward
 */

use function Colby\DareNorthward\Functions\{
	footer_nav,
	footer_address,
	nav_menu,
	clip_path_svg,
	header_nav
};

?>
</main>
</div>

<footer class="footer" tabindex="-1">

	<?php footer_nav(); ?>
	<?php footer_address(); ?>

</footer>

<?php

header_nav();
clip_path_svg();
wp_footer();
