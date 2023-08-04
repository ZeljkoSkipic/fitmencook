<div class="fmc_post_sidebar">
	<h3 class="spacing_0_3"><?php the_field('editors_choice_title', 'option'); ?></h3>
	<div class="fmc_blog_sidebar_grid">
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

	$the_query = new WP_Query( $args ); ?>
	<?php if( $the_query->have_posts() ): ?>
		<?php while ( $the_query->have_posts() ) : $the_query->the_post();
		$categories = get_the_category();
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
				</div>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>

	<?php wp_reset_query();   // Restore global post data stomped by the_post(). ?>
	</div>
	<h3 class="spacing_0_3"><?php the_field('latest_blogs_title', 'option'); ?></h3>

	<div class="fmc_blog_sidebar_grid">
		<?php
		$editors_choice = get_field('editors_choice', 'option');
		if( $editors_choice ): ?>
			<?php foreach( $editors_choice as $post ):
				$categories = get_the_category();
				// Setup this post for WP functions (variable must be named $post).
				setup_postdata($post); ?>
				<div class="fmc_post">
					<figure class="fmc_grid_figure">
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail('thumbnail'); ?>
					</a>
					</figure>
					<div class="fmc_post_content">
						<span class="fmc_grid_cat">
							<?php if ( ! empty( $categories ) ) {
								echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
							} ?>
						</span>
						<h3 class="fmc_grid_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					</div>
				</div>
			<?php endforeach; ?>
			<?php
			// Reset the global post object so that the rest of the page works correctly.
			wp_reset_postdata(); ?>
		<?php endif; ?>
	</div>
	<div class="fmc_top_cats spacing_2_0">
		<div class="fmc_tc_inner">
		<h3 class="spacing_0_3"><?php the_field('top_categories_title', 'option'); ?></h3>
			<?php $top_categories = get_field('top_categories', 'option') ?>
			<?php foreach($top_categories as $category) {
			?>
			<?php echo '<a href="' . get_category_link($category->term_id) . '">'; ?>
				<?php echo $category->name; ?>
				<span>(<?php $cat_count = get_category($category->term_id);
				echo $cat_count->count; ?>)</span>
			</a>
		<?php } ?>
		</div>
</div>

<div class="atm-ad-slot" data-slot-type="rail-ad"></div> <!-- Single Blog Post AD -->

</div>
