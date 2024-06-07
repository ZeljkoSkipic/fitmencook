<?php
/**
 * Template Name: Prod/Ing
 * Template Post Type: page
 */

 // For the content on this page, the Block 'Intro' is used

 get_header();
?>

	<main id="primary" class="site-main">

	<?php

$icon = get_field('icon');
$custom_title = get_field('custom_title');
$intro_text = get_field('intro_text');
$video = get_field('video');
$image_banner = get_field('image_banner');
$size = 'full';

$image_link = get_field('image_link');
if ($image_link) :
	$image_link_url = $image_link['url'];
	$image_link_target = $image_link['target'] ? $image_link['target'] : '_self';
endif;
$ex_cats = get_field('exclude_recipe_categories', 'option');

?>

<div class="fmc_archive_wrap fmc_container spacing_2">
	<div class="fmc_recipe_grid fmc_archive_main">
		<?php if (function_exists('yoast_breadcrumb')) {
			yoast_breadcrumb('<div class="fmc_breadcrumbs spacing_0_2">', '</div>');
		} ?>
		<div class="fmc_cat_title_wrap title_spacing_3">
			<?php
			if ($icon) {
				echo wp_get_attachment_image($icon, $size, "", array("class" => "icon"));
			} ?>
			<h1 class="fmc_title_2">
				<?php if ($custom_title) {
					echo $custom_title;
				} else {
					the_title();
				} ?>
			</h1>
		</div>
		<?php if($intro_text) { ?>
		<div class="fmc_category_description"><?php echo $intro_text; ?></div>
		<?php } ?>
		<?php if ($video) { ?>
			<div class="cat_sponsor_video_wrap">
				<?php echo $video; ?>
			</div>
		<?php } ?>

		<div class="cat_sponsor_img_wrap">
			<?php if ($image_link) : ?>
				<a href="<?php echo esc_url($image_link_url); ?>" target="<?php echo esc_attr($image_link_target); ?>">
				<?php endif; ?>
				<?php
				if ($image_banner) {
					echo wp_get_attachment_image($image_banner, $size, "", array("class" => "image_banner"));
				} ?>
				<?php if ($image_link) : ?>
				</a>
			<?php endif; ?>
		</div>
		<?php $separator = get_field('separator');

		if ($separator) : ?>
			<hr class="cat_sponsor_sep">
		<?php endif; ?>

		<div class="fmc_archive_inner fmc_rg_inner">

			<?php
			$connected_recipes = get_field('recipes') ?? [];
			if($connected_recipes) {
				$connected_recipes_ids = array_map(function ($connected_recipe) {
					return $connected_recipe->ID;
				}, (array) $connected_recipes);
			}

			if(isset($connected_recipes_ids) && $connected_recipes_ids) {
				$connected_recipes_query = new WP_Query([
					'post__in' 			=> $connected_recipes_ids,
					'orderby' 			=> 'post__in',
					'post_type'			=> 'recipes',
					'post_status'		=> 'publish',
					'paged'				=> get_query_var('paged') ? absint(get_query_var('paged')) : 1,
				]);
			}


			if (isset($connected_recipes_ids) && $connected_recipes_ids && $connected_recipes_query->have_posts()) :
				while ($connected_recipes_query->have_posts()) :
					$connected_recipes_query->the_post();
					get_template_part('template-parts/recipe/recipe', 'item');
			?>

					
			<?php endwhile;

			endif;

			wp_reset_query();
			?>

		</div>
		<?php if (isset($connected_recipes_ids) && $connected_recipes_ids): ?>

		<div class="spacing_3_1 blog_pagination_wrap">
			<?php fmc_pagination($connected_recipes_query); ?>
		</div>

		<?php endif; ?>

	</div>
	<div class="fmc_archive_sidebar">
		<div class="fmc_arch_cats">
			<h3 class="fmc_sidebar_title"><?php the_field('all_categories_title', 'option'); ?></h3>
			<?php // Get the taxonomy's terms
			$terms = get_terms(
				array(
					'taxonomy'   => 'recipe-category',
					'hide_empty' => true,
					'show_count' => true,
					'exclude'    => esc_html($ex_cats)
				)
			);

			// Check if any term exists
			if (!empty($terms) && is_array($terms)) {
				// Run a loop and print them all
				foreach ($terms as $term) { ?>
					<a class="sidebar-category" href="<?php echo esc_url(get_term_link($term)) ?>">
						<?php echo $term->name; ?>
						<span>(<?php echo $term->count; ?>)</span>
					</a><?php
					}
				} ?>
		</div>
	</div>
</div>

	</main><!-- #main -->

<?php
get_footer();
