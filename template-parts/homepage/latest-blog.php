<div class="fmc_latest_blog spacing_2_0">
		<div class="fmc_container">
<!-- 			<h2 class="fmc_title_2 title_spacing_2"><?php // the_field('lb_title') ?></h2>
 -->			<div class="fmc_latest_blog_inner spacing_0_1">
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
								<!-- <div class="fmc_grid_text text_1">
									<?php // echo wp_trim_words( get_the_content(), 25 ); ?>
								</div> -->
								<div class="fmc_post_meta">
									<div class="fmc_pm_left">
								<!-- 	<figure class="author_img">
										<?php // echo get_avatar( get_the_author_meta( 'ID' ), 45 ); ?>
									</figure> -->
									</div>
									<div class="fmc_pm_right">
<!-- 										<span class="author_name"><?php // echo get_the_author_meta('display_name', $author_id); ?></span>
 -->										<span class="post_date"><?php the_date(); ?></span>
									</div>
								</div>
							</div>
						</div>
					<?php endwhile; ?>
				<?php endif; ?>

				<?php wp_reset_query();   // Restore global post data stomped by the_post(). ?>

			</div>
			<div class="btn_wrap">
				<a class="fmc_btn_2" href="<?php echo get_post_type_archive_link( 'post' ); ?>"><span class="btn_text">Explore our latest blogs</span><span class="btn_icon"><svg width="12" height="10" viewBox="0 0 12 10" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M6.29289 0.292893C6.68342 -0.097631 7.31658 -0.0976311 7.70711 0.292893L11.7071 4.29289C12.0976 4.68342 12.0976 5.31658 11.7071 5.70711L7.70711 9.70711C7.31658 10.0976 6.68342 10.0976 6.29289 9.70711C5.90237 9.31658 5.90237 8.68342 6.29289 8.29289L8.58579 6L1 6C0.447716 6 -2.41411e-08 5.55228 0 5C2.41411e-08 4.44772 0.447716 4 1 4H8.58579L6.29289 1.70711C5.90237 1.31658 5.90237 0.683418 6.29289 0.292893Z" fill="#98A2B3"></path>
					</svg>
					</span>
				</a>
			</div>
		</div>
	</div>
