<?php
/**
 * Template Name: How To
 * Template Post Type: page
*/

get_header();

?>

	<main id="primary" class="site-main how-to-page">
		<div class="fmc_container how-to-page_inner spacing_1">

			<div class="how-to-grid  how-to_posts">
				<?php $query_args = array(
					'post_type' => 'post',
					'post_status' => 'publish',
					'order' => 'ASC',
					'cat' => 'how-to',
				);

				// The Query
				$the_query = new WP_Query( $query_args );

				// The Loop
				if ( $the_query->have_posts() ) {
					while ( $the_query->have_posts() ) {
						$categories = get_the_category();
						$the_query->the_post(); ?>
						<div class="fmc_post">
						<figure class="fmc_grid_figure">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail('medium'); ?>
						</a>
						</figure>
						<span class="fmc_grid_cat">
							<?php if ( ! empty( $categories ) ) {
								echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
							} ?>
						</span>
						<div class="fmc_post_content">
							<h3 class="fmc_grid_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<div class="fmc_post_meta">
								<div class="fmc_pm_right">
									<span class="post_date"><?php the_date(); ?></span>
								</div>
							</div>
						</div>
					</div>
					<?php }
					/* Restore original Post Data */
					wp_reset_postdata();
				} else {
					// no posts found
				} ?>
			</div>



		</div>
	</main><!-- #main -->

<?php
get_footer();
