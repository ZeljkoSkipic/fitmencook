<div class="fmc_featured_recipes spacing_2">
		<div class="fmc_container">
			<div class="fmc_fr_inner spacing_0_1">
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
							<figure>
								<?php the_post_thumbnail('thumbnail'); ?>
							</figure>
							<a href="<?php the_permalink(); ?>">
								<h3><?php the_title(); ?></h3>
							</a>
							<span class="calories"><?php the_field('calories'); ?> Calories</span>
							<div class="details_1">
								<div class="carbs">Carbs<span><?php the_field('carbs'); ?></span></div>
								<div class="fat">Fat<span><?php the_field('fat'); ?></span></div>
								<div class="protein">Protein<span><?php the_field('protein'); ?></span></div>
							</div>
							<div class="details_2">
								<div class="time">Prep Time<span><?php the_field('prep_time'); ?></span></div>
								<div class="portion">Total Time<span><?php the_field('total_time'); ?></span></div>
							</div>
						</div>
					<?php endwhile; ?>
				<?php endif; ?>

				<?php wp_reset_query();   // Restore global post data stomped by the_post(). ?>

			</div>
			<a class="fmc_btn" href="#">View All</a>
		</div>
	</div>
