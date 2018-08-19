<?php
/**
 * Template for a post thumbail in an archive listing
 *
 * @package colby/darenorthward
 */

if ( isset( $size ) ) :
	?>

<div class="post-thumbnail-container">
	<a href="<?php the_permalink(); ?>">
		<?php the_post_thumbnail( $size ); ?>
	</a>
</div>

<?php endif; ?>
