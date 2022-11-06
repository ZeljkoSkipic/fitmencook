<div class="fmc_home_featured_recipes">
	<div class="fmc_container">
		<h3 class="fmc_top_title">New Collection</h3>
		<h3 class="fmc_main_title">Featured Products</h3>
	</div>
	<?php
	$terms = get_field('categories');
	if( $terms ): ?>
	<div class="fmc_category_track">
	<div class="fmc_ct_inner">
		<?php foreach( $terms as $term ): ?>
		<a href="<?php echo esc_url( get_term_link( $term ) ); ?>">
		<figure>
			<img src=" <?php the_field('category_icon', $term); ?>" alt="<?php echo esc_html( $term->name ); ?>">
			<figcaption>
				<?php echo esc_html( $term->name ); ?>
			</figcaption>
		</figure>
		</a>
		<?php endforeach; ?>
		<?php
		$cat_link = get_field('view_all_button');
		if( $cat_link ):
			$link_url = $cat_link['url'];
			$link_title = $cat_link['title'];
			$link_target = $cat_link['target'] ? $cat_link['target'] : '_self';
			?>
		<a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
		<figure>
		<?php if( get_field('view_all_icon') ): ?>
			<img src="<?php the_field('view_all_icon'); ?>" alt="<?php echo esc_html( $link_title ); ?>">
		<?php endif; ?>
			<figcaption>
				<?php echo esc_html( $link_title ); ?>
			</figcaption>
		</figure>
		</a>
		<?php endif; ?>
		</div>
	</div>
	<div class="fmc_home_recipes spacing_2">
		<div class="fmc_container">
			<div class="fmc_hr_inner spacing_0_1">
			<?php endif; ?>

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
</div>
