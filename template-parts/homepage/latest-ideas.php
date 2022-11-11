<div class="fmc_home_ideas spacing_1_2">
	<div class="fmc_container">
		<h3 class="fmc_top_title"><?php the_field('li_prefix') ?></h3>
		<h3 class="fmc_main_title title_spacing_2"><?php the_field('li_title') ?></h3>
		<div class="fmc_home_ideas_inner spacing_0_1">
		<?php
			// latest recipes query
			// args
			$args = array(
				'posts_per_page'   => 3,
				'post_type'     => 'recipes',
				'category_name'	=> 'ideas',
				'meta_query'    => array(
					'relation'      => 'AND'
				)
			);

			// query
			$the_query = new WP_Query( $args ); ?>
			<?php if( $the_query->have_posts() ): ?>
				<?php while ( $the_query->have_posts() ) : $the_query->the_post();
				$categories = get_the_category();
				?>
					<div class="fmc_home_idea">
						<div class="fmc_hi_left">
							<span class="date"><?php the_date(); ?></span>
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<div>
								<?php echo wp_trim_words( get_the_content(), 40, '...' ); ?>
								Most of the recipes do not have the content in the main field,
								nor the excerpt. What should we do?
							</div>
						</div>
						<div class="fmc_hi_right">
							<figure class="featured_img">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail('thumbnail'); ?>
								</a>
							</figure>
						</div>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>

			<?php wp_reset_query();   // Restore global post data stomped by the_post(). ?>

		</div>
	</div>
</div>
