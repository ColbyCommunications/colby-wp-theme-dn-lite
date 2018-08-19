<?php
/**
 * Footer.php
 *
 * @package colby/darenorthward
 */

use function Colby\DareNorthward\Functions\footer_nav;
use function Colby\DareNorthward\Functions\footer_address;
use function Colby\DareNorthward\Functions\nav_menu;
use function Colby\DareNorthward\Functions\clip_path_svg;
use function Colby\DareNorthward\Functions\header_nav;

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
