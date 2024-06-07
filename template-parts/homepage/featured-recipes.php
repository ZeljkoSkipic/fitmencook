<div class="fmc_home_featured_recipes spacing_2_0" id="recipes">
	<div class="fmc_container">
		<h3 class="fmc_title_1 title_spacing_2"><?php echo wp_kses_post( get_field('fr_title') ); ?></h3>
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
					<?php
                    while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<?php get_template_part('template-parts/recipe/recipe-grid'); ?>
					<?php endwhile; ?>
				<?php endif; ?>

				<?php wp_reset_query();   // Restore global post data stomped by the_post(). ?>

			</div>
			<a class="fmc_btn_2" href="<?php echo get_post_type_archive_link( 'recipes' ); ?>"><span class="btn_text">View All</span><span class="btn_icon"><svg width="12" height="10" viewBox="0 0 12 10" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd" clip-rule="evenodd" d="M6.29289 0.292893C6.68342 -0.097631 7.31658 -0.0976311 7.70711 0.292893L11.7071 4.29289C12.0976 4.68342 12.0976 5.31658 11.7071 5.70711L7.70711 9.70711C7.31658 10.0976 6.68342 10.0976 6.29289 9.70711C5.90237 9.31658 5.90237 8.68342 6.29289 8.29289L8.58579 6L1 6C0.447716 6 -2.41411e-08 5.55228 0 5C2.41411e-08 4.44772 0.447716 4 1 4H8.58579L6.29289 1.70711C5.90237 1.31658 5.90237 0.683418 6.29289 0.292893Z" fill="#98A2B3"/>
				</svg>
				</span>
			</a>
		</div>
	</div>

	<div class="fmc_container">
		<?php get_template_part('template-parts/category-track'); ?>
	</div>

</div>
