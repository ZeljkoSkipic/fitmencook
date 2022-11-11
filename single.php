<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package fitmencook
 */

get_header();
?>

	<main id="primary" class="site-main">
		<div class="fmc_post_hero">
			<div class="fmc_container">
				<h1><?php the_title(); ?></h1>
				<div class="fmc_post_cats">
					<?php the_category( ' ' ); ?>
				</div>
			</div>
			<div class="fmc_post_hero_track">
				<div>
					<?php
					$prev_post = get_previous_post();
					if ( ! empty( $prev_post ) ): ?>
						<a href="<?php echo get_permalink( $prev_post->ID ); ?>">
							<?php
							$prev_thumb = get_the_post_thumbnail( $prev_post->ID );
							echo $prev_thumb; ?>
							<figcaption><?php echo apply_filters( 'the_title', $prev_post->post_title ); ?></figcaption>
						</a>
					<?php endif; ?>
				</div>
				<div>
					<?php the_post_thumbnail(); ?>
					<figcaption><?php the_title(); ?></figcaption>
				</div>
				<div></div>
			</div>

		</div>
		<div class="fmc_container">
		<?php
		while ( have_posts() ) :
			the_post();

			the_content();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
	</div>
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
