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
		<div class="fmc_container">
		<?php get_template_part('template-parts/category-track'); ?>
		</div>
		<?php get_template_part('template-parts/app'); ?>
	</main><!-- #main -->

<?php
get_footer();
