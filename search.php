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
<?php echo do_shortcode('[wpdreams_asp_settings id=2 element="div"]'); ?>
	<main id="primary" class="site-main">
		<div class="fmc_search_hero spacing_1">
			<div class="fmc_container">
			<h1 class="fmc_main_title title_spacing_2">
			<?php
			/* translators: %s: search query. */
			printf( esc_html__( 'Search Results for: %s', 'fmc' ), '<span>' . get_search_query() . '</span>' );
			?>
		</h1>
				<?php echo do_shortcode('[wpdreams_ajaxsearchpro id=2]'); ?>
			</div>
		</div>


		<?php if ( have_posts() ) : ?>

			<header class="page-header">

			</header><!-- .page-header -->
			<div class="fmc_recipe_grid spacing_1">
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


		<?php else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

			</div>
			</div>
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
