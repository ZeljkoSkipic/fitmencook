<?php
/**
 * Template Name: Search
 * Template Post Type: page
 */

get_header();
?>
	<main id="primary" class="site-main">
		<div class="fmc_search_hero spacing_1">
			<div class="fmc_container">
			<h1 class="search_title title_spacing_2">
			<?php the_field('search_page_title', 'option'); ?>
			</h1>
				<?php echo do_shortcode('[wpdreams_ajaxsearchpro id=1]'); ?>
			</div>
		</div>
		<div class="fmc_container spacing_1">
		<h2 class="fmc_title_2 title_spacing_2"><?php the_field('category-track-title', 'option'); ?></h2>
		<div class="fmc_search_cats">
			<?php // Get the taxonomy's terms
			$terms = get_terms(
				array(
					'taxonomy'   => 'recipe-category',
					'hide_empty' => true,
					'exclude' => '59'
				)
			);

			// Check if any term exists
			if ( ! empty( $terms ) && is_array( $terms ) ) :
				// Run a loop and print them all

				foreach ( $terms as $term ) : ?>
				<figure>
				<?php
				$cat_icon = get_field('category_icon', $term);
				$size = 'full'; ?>
				<a href="<?php echo esc_url( get_term_link( $term ) ) ?>">
					<?php if( $cat_icon ) {
						echo wp_get_attachment_image( $cat_icon, $size, "", array( "class" => "cat_icon" ) );
					} ?>
					<figcaption><?php echo $term->name; ?></figcaption>
				</a>
				</figure>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
		</div>
		<?php get_template_part('template-parts/app'); ?>
	</main><!-- #main -->

<?php
get_footer();
