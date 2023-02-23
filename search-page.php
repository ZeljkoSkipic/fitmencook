<?php
/**
 * Template Name: Search
 * Template Post Type: page
 */

get_header();
?>
<?php echo do_shortcode('[wpdreams_asp_settings id=1 element="div"]'); ?>
	<main id="primary" class="site-main">
		<div class="fmc_search_hero spacing_1">
			<div class="fmc_container">
			<h1 class="fmc_main_title title_spacing_2">
			<?php the_field('search_page_title', 'option'); ?>
		</h1>
				<?php echo do_shortcode('[wpdreams_ajaxsearchpro id=1]'); ?>
			</div>
		</div>
		<div class="spacing_1"></div>
		<?php get_template_part('template-parts/app'); ?>
	</main><!-- #main -->

<?php
get_footer();
