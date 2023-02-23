<div class="fmc_home_featured_recipes spacing_2_0">
	<div class="fmc_container">
		<h3 class="fmc_title_1 title_spacing_2"><?php the_field('fr_title') ?></h3>
	</div>
	<div class="fmc_recipe_grid spacing_0_1">
		<div class="fmc_container">
			<div class="fmc_rg_inner spacing_0_1">

			<?php
				// latest recipes query
				// args
				$args = array(
					'posts_per_page'   => 4,
					'post_type'     => 'recipes',
					'meta_query'    => array(
						'relation'      => 'AND'
					)
				);


				// query
				$the_query = new WP_Query( $args ); ?>

				<?php if( $the_query->have_posts() ): ?>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<div class="fmc_recipe">
							<figure class="fmc_grid_figure">
								<?php the_post_thumbnail('thumbnail'); ?>
							</figure>
							<div class="fmc_recipe_content">
								<div class="fmc_grid_meta">
									<span class="fmc_grid_cat">
										<?php the_category(); ?>
									</span>
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
									<span>5.0</span>
									</div>
								</div>
								<h3 class="fmc_grid_title">
									<a href="<?php the_permalink(); ?>">
									<?php the_title(); ?>
									</a>
								</h3>
								<div class="fmc_recipe_grid_macros">
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
									<div class="rg_macro calories">
										<span class="rg_m_title"><?php the_field('l_calories', 'option'); ?></span>
										<span class="rg_m_amount"><?php the_field('calories'); ?>cal</span>
									</div>
								</div>
							</div>
						</div>
					<?php endwhile; ?>
				<?php endif; ?>

				<?php wp_reset_query();   // Restore global post data stomped by the_post(). ?>

			</div>
			<a class="fmc_btn_2" href="/recipes"><span class="btn_text">View All</span><span class="btn_icon"><svg width="12" height="10" viewBox="0 0 12 10" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd" clip-rule="evenodd" d="M6.29289 0.292893C6.68342 -0.097631 7.31658 -0.0976311 7.70711 0.292893L11.7071 4.29289C12.0976 4.68342 12.0976 5.31658 11.7071 5.70711L7.70711 9.70711C7.31658 10.0976 6.68342 10.0976 6.29289 9.70711C5.90237 9.31658 5.90237 8.68342 6.29289 8.29289L8.58579 6L1 6C0.447716 6 -2.41411e-08 5.55228 0 5C2.41411e-08 4.44772 0.447716 4 1 4H8.58579L6.29289 1.70711C5.90237 1.31658 5.90237 0.683418 6.29289 0.292893Z" fill="#98A2B3"/>
				</svg>
				</span>
			</a>
		</div>
	</div>

	<?php dynamic_sidebar( 'ad1' ); ?>

	<?php get_template_part('template-parts/category-track'); ?>


</div>
