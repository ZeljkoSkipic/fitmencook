<?php

use function SafeSvg\Blocks\setup;

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

		<div class="fmc_category_description"><?php echo $intro_text; ?></div>

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
					'paged'				=> get_query_var('paged') ? absint(get_query_var('paged')) : 1
				]);
			}
			
			
			if (isset($connected_recipes_ids) && $connected_recipes_ids && $connected_recipes_query->have_posts()) :
				while ($connected_recipes_query->have_posts()) :
					$connected_recipes_query->the_post();
					$permalink = get_permalink(get_the_ID());
					$title = get_the_title(get_the_ID());
					$conneceted_recipe_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
					$categories = get_the_terms(get_the_ID(), 'recipe-category');
					$template_slug = get_page_template_slug(get_the_ID());
					$avg_rating = get_avarage_rating(get_the_ID(), "", true);
			?>

					<div class="fmc_recipe">
						<figure class="fmc_grid_figure">
							<a href="<?php echo $permalink; ?>">
								<img src="<?php echo $conneceted_recipe_image; ?>" alt="<?php echo $permalink; ?>">
							</a>
						</figure>
						<div class="fmc_recipe_content">
							<div class="fmc_grid_meta">
								<span class="fmc_grid_cat">
									<?php if (!empty($categories)) {
										echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a>';
									} ?>
								</span>
								<?php if ($avg_rating) : ?>

									<div class="meta_rating">
										<svg xmlns="http://www.w3.org/2000/svg" width="12" height="11" viewBox="0 0 12 11" fill="none">
											<g clip-path="url(#clip0_274_15268)">
												<path d="M11.6809 3.93099L7.99193 3.41399L6.33893 0.180985C6.30168 0.125088 6.2512 0.0792546 6.19197 0.0475543C6.13275 0.015854 6.06661 -0.000732422 5.99943 -0.000732422C5.93226 -0.000732422 5.86612 0.015854 5.8069 0.0475543C5.74767 0.0792546 5.69719 0.125088 5.65993 0.180985L4.00693 3.41399L0.317934 3.93099C0.252402 3.93503 0.189479 3.95814 0.136897 3.99745C0.0843146 4.03677 0.0443632 4.09059 0.0219509 4.15231C-0.000461312 4.21402 -0.0043581 4.28094 0.0107393 4.34484C0.0258368 4.40873 0.0592708 4.46683 0.106934 4.51199L2.78693 7.03399L2.15393 10.599C2.14748 10.6664 2.15966 10.7343 2.18913 10.7952C2.2186 10.8562 2.26423 10.9079 2.32106 10.9447C2.37789 10.9816 2.44374 11.0021 2.51143 11.0041C2.57911 11.0061 2.64605 10.9894 2.70493 10.956L5.99993 9.28098L9.29493 10.953C9.35382 10.9864 9.42075 11.0031 9.48844 11.0011C9.55613 10.9991 9.62198 10.9786 9.67881 10.9417C9.73564 10.9049 9.78127 10.8532 9.81074 10.7922C9.84021 10.7313 9.85238 10.6634 9.84593 10.596L9.21293 7.03399L11.8929 4.51199C11.9402 4.46664 11.9732 4.40856 11.988 4.3448C12.0029 4.28104 11.9989 4.21435 11.9765 4.15282C11.9542 4.09129 11.9144 4.03757 11.8621 3.99819C11.8098 3.95881 11.7472 3.93546 11.6819 3.93099H11.6809Z" fill="#FFC107"></path>
											</g>
											<defs>
												<clipPath id="clip0_274_15268">
													<rect width="12" height="11" fill="white"></rect>
												</clipPath>
											</defs>
										</svg>
										<span><?php echo $avg_rating; ?></span>
									</div>

								<?php endif; ?>
							</div>
							<h3 class="fmc_grid_title">
								<a href="<?php echo $permalink; ?>">
									<?php echo $title; ?>
								</a>
							</h3>

							<?php
							if ($template_slug !== 'single-recipes-collection.php') :
								$carbs_title = get_field('l_carbs', 'option');
								$fat_title = get_field('l_fat', 'option');
								$protein_title = get_field('l_protein', 'option');
								$calories_title = get_field('l_calories', 'option');
								if ($template_slug === 'single-recipes-multiple.php') :
									$calculations = meal_plan_calculations();

							?>
									<div class="fmc_recipe_grid_macros">
										<div class="rg_macro calories">
											<span class="rg_m_title"><?php echo $calories_title;  ?></span>
											<span class="rg_m_amount"><?php if ($calculations['totals'] && isset($calculations['totals'][$calories_title])) echo $calculations['totals'][$calories_title];  ?></span>
										</div>
										<div class="rg_macro carbs">
											<span class="rg_m_title"><?php echo $carbs_title;  ?></span>
											<span class="rg_m_amount"><?php if ($calculations['totals'] && isset($calculations['totals'][$carbs_title])) echo $calculations['totals'][$carbs_title];  ?></span>
										</div>
										<div class="rg_macro fat">
											<span class="rg_m_title"><?php echo $fat_title;  ?></span>
											<span class="rg_m_amount"><?php if ($calculations['totals'] && isset($calculations['totals'][$fat_title])) echo $calculations['totals'][$fat_title];  ?></span>
										</div>
										<div class="rg_macro protein">
											<span class="rg_m_title"><?php echo $protein_title; ?></span>
											<span class="rg_m_amount"><?php if ($calculations['totals'] && isset($calculations['totals'][$protein_title])) echo $calculations['totals'][$protein_title];  ?></span>
										</div>
									</div>

								<?php

								else :

								?>

									<div class="fmc_recipe_grid_macros">
										<div class="rg_macro calories">
											<span class="rg_m_title"><?php echo $calories_title; ?></span>
											<span class="rg_m_amount"><?php the_field('calories', get_the_ID()); ?>cal</span>
										</div>
										<div class="rg_macro carbs">
											<span class="rg_m_title"><?php echo $carbs_title; ?></span>
											<span class="rg_m_amount"><?php the_field('carbs', get_the_ID()); ?>g</span>
										</div>
										<div class="rg_macro fat">
											<span class="rg_m_title"><?php echo $fat_title; ?></span>
											<span class="rg_m_amount"><?php the_field('fat', get_the_ID()); ?>g</span>
										</div>
										<div class="rg_macro protein">
											<span class="rg_m_title"><?php echo $protein_title; ?></span>
											<span class="rg_m_amount"><?php the_field('protein', get_the_ID()); ?>g</span>
										</div>
									</div>
								<?php endif; ?>
							<?php endif; ?>

						</div>
					</div>
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