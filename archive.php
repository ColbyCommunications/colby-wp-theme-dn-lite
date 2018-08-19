<?php
/**
 * Archive template
 *
 * @package colby/darenorthward
 */

use function Colby\Darenorthward\Functions\the_term_header_image;
use function Colby\Darenorthward\Functions\has_term_header_image;
use function Colby\Darenorthward\Functions\the_archive_post_thumbnail;

get_header();

$queried_object = is_archive() ? get_queried_object() : (object) [
	'name' => get_bloginfo(),
	'slug' => 'home',
];

?>
<div class="archive <?php echo esc_attr( has_term_header_image() ? 'no-featured-image' : 'has-featured-image' ); ?> archive--<?php echo esc_attr( $queried_object->slug ); ?>">
	<div class="archive__inner">
		<?php if ( has_term_header_image() ) : ?>

			<?php the_term_header_image(); ?>

		<?php else : ?>

			<div class="archive-header">
				<h1 class="smudge-title smudge-title--blue">
					<?php echo wp_kses_post( $queried_object->name ); ?>
				</h1>
			</div>

		<?php endif; ?>

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : ?>

				<?php the_post(); ?>

				<article <?php post_class( 'post' ); ?>>
					<div class="post--inner">
						<?php the_archive_post_thumbnail(); ?>

						<div class="post-content">
							<div class="post-content__header">
								<h1>
									<a href="<?php the_permalink(); ?>">
										<?php the_title(); ?>
									</a>
								</h1>
							</div>

							<div class="post-content__post">
								<?php the_excerpt(); ?>
							</div>

							<div class="post-content__more">
								<a href="<?php the_permalink(); ?>">
									<?php esc_html_e( 'More' ); ?>
								</a>
							<div class="post__date">
								<?php the_date(); ?>
							</div>
						</div>
					</div>
				</article>


			<?php endwhile; ?>

			<nav class="archive__nav-links">
				<?php posts_nav_link( '&nbsp;' ); ?>
			</nav>

		<?php else : ?>

			<article class="post">
				<div class="post--inner">
					<div class="post-content">
						<?php esc_html_e( 'No posts found' ); ?>
					</div>
				</div>
			</article>

		<?php endif; ?>

	</div>

</div>
<?php


get_footer();
