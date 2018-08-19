<?php
/**
 * Single post template
 *
 * @package colby/darenorthward
 */

use function Colby\Darenorthward\Functions\{
	the_single_post_header_image,
	has_single_post_header_image
};

get_header();

?>

<?php if ( have_posts() ) : ?>

	<?php the_post(); ?>

	<article <?php post_class( [ 'single', has_single_post_header_image() ? '' : 'no-featured-image' ] ); ?>>

		<?php if ( has_single_post_header_image() ) : ?>
			<?php the_single_post_header_image(); ?>
		<?php endif; ?>

		<div class="post--inner">

			<div class="post-content">

				<div class="post-content__header">
					<?php if ( ! has_single_post_header_image() ) : ?>
						<h1>
							<?php the_title(); ?>
						</h1>
					<?php endif; ?>
				</div>

				<div class="post-content__post">
					<?php the_content(); ?>
				</div>

				<div class="post__date">
					<?php the_date(); ?>
				</div>
			</div>

		</div>

	</article>

	<?php
endif;

get_footer();
