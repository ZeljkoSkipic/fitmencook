<div class="fmc_latest_blog spacing_2_1">
		<div class="fmc_container">
			<h3 class="fmc_top_title"><?php the_field('lb_prefix') ?></h3>
			<h3 class="fmc_main_title title_spacing_2"><?php the_field('lb_title') ?></h3>
			<div class="fmc_latest_blog_inner spacing_0_1">
			<?php
				// latest recipes query
				// args
				$args = array(
					'posts_per_page'   => 3,
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
					?>
						<div class="fmc_post">
							<figure class="featured_img">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail('medium'); ?>
							</a>
							</figure>
							<span class="cat">
								<?php if ( ! empty( $categories ) ) {
									echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
								} ?>
							</span>
							<div class="fmc_post_content">
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<figure class="author_img">
									<?php echo get_avatar( get_the_author_meta( 'ID' ), 45 ); ?>
								</figure>
								<span class="author_name">by <?php echo get_the_author_meta('display_name', $author_id); ?></span>
								<span class="post_date"><?php the_date(); ?></span>
							</div>
						</div>
					<?php endwhile; ?>
				<?php endif; ?>

				<?php wp_reset_query();   // Restore global post data stomped by the_post(). ?>

			</div>
		</div>
	</div>
