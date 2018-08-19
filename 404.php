<?php
/**
 * 404.php
 *
 * @package colby/darenorthward
 */

get_header();

?>

<div class="four-oh-four">
	<article>
		<header>
			<h1><?php esc_html_e( 'No posts found' ); ?></h1>
		</header>
	</article>
</div>

<?php

get_footer();
