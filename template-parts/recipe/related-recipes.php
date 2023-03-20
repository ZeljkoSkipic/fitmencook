<div class="fmc_recipe_grid fmc_related_recipes spacing_1">
		<div class="fmc_container">
			<span class="fmc_title_prefix"><?php the_field('related_prefix', 'option'); ?></span>
			<h2 class="fmc_title_2 title_spacing_1"><?php the_field('related_title', 'option'); ?></h2>
			<div class="fmc_rg_inner spacing_0_1">
			<?php
				// latest recipes query
				// args
                $current_recipe_terms = get_the_terms(get_the_ID(), 'recipe-category');

                if($current_recipe_terms && is_array($current_recipe_terms)) {
                    $current_recipe_terms = array_map(function($term) {
                        return $term->term_id;
                    },$current_recipe_terms);
                }
				$args = array(
					'posts_per_page'   => 4,
					'post_type'     => 'recipes',
					'tax_query' => array(
                        array(
                            'taxonomy' => 'recipe-category',
                            'field'    => 'term_id',
                            'terms'    => $current_recipe_terms,
                        ),
                    ),
                    'post__not_in' => array(get_the_ID())
				);

				// query
				$the_query = new WP_Query( $args ); ?>

				<?php if( $the_query->have_posts() ): ?>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

					<?php get_template_part('template-parts/recipe/recipe-grid'); ?>

					<?php endwhile; ?>
				<?php endif; ?>

				<?php wp_reset_query();   // Restore global post data stomped by the_post(). ?>

			</div>
		</div>
	</div>
