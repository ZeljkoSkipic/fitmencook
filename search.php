<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package fitmencook
 */

get_header();
?>

	<main id="primary" class="site-main">
		<div class="fmc_search_hero">
			<div class="fmc_container">
			<h1 class="fmc_main_title title_spacing_2">
			<?php
			/* translators: %s: search query. */
			printf( esc_html__( 'Search Results for: %s', 'fmc' ), '<span>' . get_search_query() . '</span>' );
			?>
		</h1>
				<?php echo do_shortcode('[wpdreams_ajaxsearchpro id=1]'); ?>
				<?php echo do_shortcode('[wpdreams_asp_settings id=1 element="div"]'); ?>
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
			<?php the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

			</div>
			</div>
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
