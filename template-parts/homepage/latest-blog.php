<div class="fmc_latest_blog spacing_2_0">
		<div class="fmc_container">
			<h2 class="fmc_title_2 title_spacing_2"><?php the_field('lb_title') ?></h2>
			<div class="fmc_latest_blog_inner spacing_0_1">
			<?php
				// latest recipes query
				// args
				$args = array(
					'posts_per_page'   => 4,
					'post_type'     => 'post',
					'meta_query'    => array(
						'relation'      => 'AND'
					)
				);

				// query
				$the_query = new WP_Query( $args ); ?>
				<?php if( $the_query->have_posts() ): ?>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post();
					$categories = get_the_category();
					$author_id = $post->post_author;
					?>
						<div class="fmc_post">
							<figure class="fmc_grid_figure">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail('medium'); ?>
							</a>
							</figure>
							<div class="fmc_post_content">
								<span class="fmc_grid_cat">
									<?php if ( ! empty( $categories ) ) {
										echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
									} ?>
								</span>
								<h3 class="fmc_grid_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<div class="fmc_grid_text text_1">
									<?php echo wp_trim_words( get_the_content(), 25 ); ?>
								</div>
								<div class="fmc_post_meta">
									<div class="fmc_pm_left">
									<figure class="author_img">
										<?php echo get_avatar( get_the_author_meta( 'ID' ), 45 ); ?>
									</figure>
									</div>
									<div class="fmc_pm_right">
										<span class="author_name"><?php echo get_the_author_meta('display_name', $author_id); ?></span>
										<span class="post_date"><?php the_date(); ?></span>
									</div>
								</div>
							</div>
						</div>
					<?php endwhile; ?>
				<?php endif; ?>

				<?php wp_reset_query();   // Restore global post data stomped by the_post(). ?>

			</div>
		</div>
	</div>
