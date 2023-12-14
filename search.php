<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package fitmencook
 */

get_header();

$ex_cats = get_field('exclude_recipe_categories', 'option');

?>
	<main id="primary" class="site-main">
		<div class="fmc_search_hero spacing_1">
			<div class="fmc_container">
			<h1 class=" search_title title_spacing_2">
			<?php
			$search_title = get_field('search_resutls_title', 'option');
			/* translators: %s: search query. */
			echo $search_title;?> <span>  <?php echo get_search_query(); ?></span>
		</h1>
				<?php echo do_shortcode('[wpdreams_ajaxsearchpro id=1]'); ?>
			</div>
		</div>

		<div class="fmc_container spacing_1">
		<h2 class="fmc_title_2 title_spacing_2_0 fmc_toggle_trigger"><?php the_field('category-track-title', 'option'); ?><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#344054" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></h2>
		<div class="fmc_toggle_content">
		<div class="fmc_search_cats">
			<?php // Get the taxonomy's terms
			$terms = get_terms(
				array(
					'taxonomy'   => 'recipe-category',
					'hide_empty' => true,
					'exclude' => esc_html ( $ex_cats )
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
		</div>


		<?php if ( have_posts() ) : ?>

			<header class="page-header">

			</header><!-- .page-header -->
			<div class="fmc_recipe_grid spacing_0_1">
			<div class="fmc_container">
			<div class="fmc_rg_inner">
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile; ?>
			</div>
			<div class="spacing_3_1 blog_pagination_wrap">
			<?php fmc_pagination(); ?>
			</div>


		<?php else : ?>

			<div class="fmc_no_results fmc_container">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/no-results.png" alt="no results">
				<h4><?php the_field('no_results_title', 'option'); ?></h4>
				<p><?php the_field('no_results_text', 'option'); ?></p>
			</div>

		<?php endif; ?>

			</div>
			</div>
	</main><!-- #main -->

<?php
get_footer();
