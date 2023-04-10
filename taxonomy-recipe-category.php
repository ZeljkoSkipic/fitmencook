<?php

get_header(); ?>
<div class="fmc_archive_wrap fmc_container spacing_2">
	<div class="fmc_recipe_grid fmc_archive_main">
		<?php if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb( '<div class="fmc_breadcrumbs spacing_0_2">','</div>' );
		} ?>
		<h1 class="fmc_title_2 title_spacing_3"><?php single_cat_title(); ?></h1>
		<div class="fmc_archive_inner fmc_rg_inner">

		<?php while ( have_posts() ) : the_post();
			$avg_rating = get_avarage_rating (get_the_ID(), "" , true);
			$categories = get_the_terms( $post->ID, 'recipe-category' );
		?>

			<div class="fmc_recipe">
				<figure class="fmc_grid_figure">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail('medium'); ?>
				</a>
				</figure>
				<div class="fmc_recipe_content">
					<div class="fmc_grid_meta">
						<span class="fmc_grid_cat">
						<?php if ( ! empty( $categories ) ) {
							echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
						} ?>
						</span>
						<?php if($avg_rating): ?>

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
						<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
						</a>
					</h3>
					<div class="fmc_recipe_grid_macros">
						<div class="rg_macro calories">
							<span class="rg_m_title"><?php the_field('l_calories', 'option'); ?></span>
							<span class="rg_m_amount"><?php the_field('calories'); ?>cal</span>
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
				</div>
			</div>

		<?php endwhile;
		?>

		</div>
		<div class="spacing_3_1 blog_pagination_wrap">
			<?php fmc_pagination(); ?>
		</div>
	</div>
	<div class="fmc_archive_sidebar">
		<div class="fmc_arch_cats">
		<h3 class="fmc_sidebar_title"><?php the_field( 'all_categories_title', 'option' ); ?></h3>
		<?php // Get the taxonomy's terms
			$terms = get_terms(
				array(
					'taxonomy'   => 'recipe-category',
					'hide_empty' => true,
					'show_count' => true

				)
			);

			// Check if any term exists
			if ( ! empty( $terms ) && is_array( $terms ) ) {
				// Run a loop and print them all
				foreach ( $terms as $term ) { ?>
					<a class="sidebar-category" href="<?php echo esc_url( get_term_link( $term ) ) ?>">
						<?php echo $term->name; ?>
						<span>(<?php echo $term->count; ?>)</span>
					</a><?php
				}
			} ?>
		</div>
	</div>
</div>
<?php get_footer();
