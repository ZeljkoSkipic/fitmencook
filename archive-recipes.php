<?php

get_header();

$featured_image = get_field('featured_recipe_image', 'option');
$size = 'full'
?>
<div class="fmc_archive_wrap fmc_container spacing_2">
	<?php if (function_exists('yoast_breadcrumb')) {
		yoast_breadcrumb('<div class="fmc_breadcrumbs spacing_0_2">', '</div>');
	} ?>
	<?php
	$featured_posts = get_field('featured_recipe', 'option');
	if ($featured_posts) :
		foreach ($featured_posts as $feature_post) :
			// Setup this post for WP functions (variable must be named $post).
			global $post;
			$post = $feature_post;
			setup_postdata($post);
			$categories = get_the_terms($post->ID, 'recipe-category');
			$calculations = meal_plan_calculations(true);
			$template_slug = get_page_template_slug();



	?>
			<div class="fmc_featured_post fmc_featured_recipe">
				<div class="fmc_featured_left">
					<a href="<?php the_permalink(); ?>">
						<?php
						if ($featured_image) {
							if ($featured_image) {
								echo wp_get_attachment_image($featured_image, $size);
							}
						} else {
							the_post_thumbnail('large');
						}  ?>
					</a>
				</div>
				<div class="fmc_featured_right">
					<span class="fmc_featured_prefix"><?php the_field('featured_prefix', 'option'); ?></span>
					<div class="fmc_grid_meta">
						<span class="fmc_grid_cat">
							<?php if (!empty($categories)) {
								echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a>';
							} ?>
						</span>
					</div>
					<a href="<?php the_permalink(); ?>">
						<h2 class="fmc_title_1"><?php the_title(); ?></h2>
					</a>
					<div class="fmc_featured_rating">
						<?php echo get_avarage_rating(get_the_ID(), 'sidebar'); ?>
					</div>


					<?php if ($template_slug === 'single-recipes-multiple.php') : ?>

						<div class="fmc_featured_macros">
							<?php
							if ($calculations['totals']) : $calculations_count = 1; ?>
								<?php foreach ($calculations['totals'] as $label => $total) : if ($total === 0) continue; ?>
									<div class="rg_macro <?php if ($calculations_count === 1) echo "calories"; ?>">
										<span class="rg_m_title"><?php if ($calculations_count === 1) echo "Cal";
																	else echo $label; ?></span>
										<span class="rg_m_amount"><?php echo $total;  ?></span>
									</div>
								<?php $calculations_count++;
								endforeach; ?>
							<?php endif;
							?>

						</div>

						<?php if ($calculations['total_times']) : ?>

							<div class="fmc_featured_prep">

								<?php
								foreach ($calculations['total_times'] as $single_time) :

								?>
									<?php if ($single_time['hours'] || $single_time['min']) : ?>

										<div class="fmc_f_time_container">
											<span class="fmc_time"><?php echo $single_time['label']; ?></span>

											<?php if ($single_time['hours']) : ?>

												<span class="fmc_amount"><?php echo $single_time['hours']; ?></span>

											<?php endif; ?>

											<?php if ($single_time['min']) : ?>
												<span class="fmc_amount"><?php echo $single_time['min']; ?></span>

											<?php endif; ?>

										</div>

									<?php endif; ?>

								<?php

								endforeach;
								?>

							</div>

						<?php endif; ?>

					<?php else : ?>

						<div class="fmc_featured_macros">
							<div class="rg_macro calories">
								<span class="rg_m_title">Cal</span>
								<span class="rg_m_amount"><?php the_field('calories'); ?></span>
							</div>
							<div class="rg_macro carbs">
								<span class="rg_m_title"><?php the_field('l_carbs', 'option'); ?></span>
								<span class="rg_m_amount"><?php the_field('carbs'); ?>g</span>
							</div>
							<div class="rg_macro fat">
								<span class="rg_m_title"><?php the_field('l_fat', 'option'); ?></span>
								<span class="rg_m_amount"><?php the_field('fat'); ?>g</span>
							</div>
							<div class="rg_macro protein">
								<span class="rg_m_title"><?php the_field('l_protein', 'option'); ?></span>
								<span class="rg_m_amount"><?php the_field('protein'); ?>g</span>
							</div>
						</div>
						<div class="fmc_featured_prep">
							<div class="fmc_f_time_container">
								<span class="fmc_time"><?php the_field('l_prep_time', 'option'); ?>:</span>
								<span class="fmc_amount"><?php if (get_field('prep_hours')) {
																the_field('prep_hours'); ?>h <?php } ?> <?php the_field('prep_time'); ?><?php the_field('minutes', 'option'); ?></span>
							</div>
							<div class="fmc_f_time_container">
								<span class="fmc_time"><?php the_field('l_cook_time', 'option'); ?>:</span>
								<span class="fmc_amount"><?php if (get_field('cook_hours')) {
																the_field('cook_hours'); ?>h <?php } ?> <?php the_field('cook_time'); ?><?php the_field('minutes', 'option'); ?></span>
							</div>
							<div class="fmc_f_time_container">
								<span class="fmc_time"><?php the_field('l_total_time', 'option'); ?>:</span>
								<span class="fmc_amount"><?php if (get_field('total_hours')) {
																the_field('total_hours'); ?>h <?php } ?> <?php the_field('total_time'); ?><?php the_field('minutes', 'option'); ?></span>
							</div>
						</div>

					<?php endif; ?>

				</div>
			</div>
		<?php endforeach; ?>
		<?php
		// Reset the global post object so that the rest of the page works correctly.
		wp_reset_postdata(); ?>
	<?php endif; ?>

	<?php dynamic_sidebar('ad6'); ?>

	<?php get_template_part('template-parts/category-track'); ?>

	<div class="fmc_recipe_grid fmc_archive_main">
		<div class="fmc_archive_inner fmc_rg_inner">

			<?php while (have_posts()) : the_post();	?>

				<?php get_template_part('template-parts/recipe/recipe-grid'); ?>

			<?php endwhile;	?>

		</div>
		<div class="spacing_3_1">
			<?php fmc_pagination(); ?>
		</div>
	</div>
	<div class="fmc_archive_sidebar">
		<div class="fmc_arch_cats">
			<h3 class="fmc_sidebar_title"><?php the_field('all_categories_title', 'option'); ?></h3>
			<?php // Get the taxonomy's terms
			$terms = get_terms(
				array(
					'taxonomy'   => 'recipe-category',
					'hide_empty' => true,
					'show_count' => true

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

		<?php dynamic_sidebar('ad5'); ?>

	</div>
</div>
<?php get_footer();
