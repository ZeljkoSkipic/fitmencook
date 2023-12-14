<?php

/**
 * Template Name: How To
 * Template Post Type: page
 */

get_header();
$query_args_posts = array(
	'post_type' 		=> 'post',
	'post_status' 		=> 'publish',
	'order' 			=> 'ASC',
	'category_name' 	=> 'how-to',
	'posts_per_page'	=> -1
);
$how_to_posts = new WP_Query($query_args_posts);

$query_args_recipes = array(
	'post_type' 		=> 'recipes',
	'post_status' 		=> 'publish',
	'order' 			=> 'ASC',
	'posts_per_page'	=> -1,
	'tax_query' => array(
		array(
			'taxonomy' => 'recipe-category',
			'field' => 'slug',
			'terms' => ['how-to'],
		),
	),

);

$how_to_recipes = new WP_Query($query_args_recipes);

?>

<main id="primary" class="site-main how-to-page">

<?php


$featured_hero_image = get_field('featured_hero_image');
$size = 'full';

$box_type = get_field('box_type');

?>

<div class="fmc_container spacing_1_3">
<div class="fmc_featured_post">

	<?php if( $box_type == 'recipe'):
		$hide_macros = get_field('hide_macros');
		$featured_recipe = get_field('featured_recipe');
	?>


		<?php foreach( $featured_recipe as $post ):

			// Setup this post for WP functions (variable must be named $post).
			setup_postdata($post);
			if(get_page_template_slug($post) === 'single-recipes-multiple.php')  $calculations = meal_plan_calculations(true);
			?>

			<div class="fmc_featured_left">
				<a href="<?php the_permalink(); ?>">
					<?php
					if ($featured_hero_image) {
						if ($featured_hero_image) {
							echo wp_get_attachment_image($featured_hero_image, $size);
						}
					} else {
						the_post_thumbnail('large');
					}  ?>
				</a>
			</div>

			<div class="fmc_featured_right">
				<span class="fmc_featured_prefix"><?php the_field('featured_prefix', 'option'); ?></span>

				<a href="<?php the_permalink(); ?>"><h2 class="fmc_title_1"><?php the_title(); ?></h2></a>

				<div class="fmc_featured_rating">
					<?php echo get_avarage_rating(get_the_ID(), 'sidebar'); ?>
				</div>

			<?php if(!$hide_macros && !isset($calculations)) { ?>
			<div class="fmc_featured_macros">
			<div class="rg_macro calories">
				<span class="rg_m_title">Cal</span>
				<span class="rg_m_amount"><?php the_field( 'calories' ); ?></span>
			</div>
			<div class="rg_macro">
				<span class="rg_m_title"><?php the_field( 'l_protein', 'option' ); ?></span>
				<span class="rg_m_amount"><?php the_field( 'protein' ); ?>g</span>
			</div>
			<div class="rg_macro">
				<span class="rg_m_title"><?php the_field( 'l_fat', 'option' ); ?></span>
				<span class="rg_m_amount"><?php the_field( 'fat' ); ?>g</span>
			</div>
			<div class="rg_macro">
				<span class="rg_m_title"><?php the_field( 'l_carbs', 'option' ); ?></span>
				<span class="rg_m_amount"><?php the_field( 'carbs' ); ?>g</span>
			</div>


			</div>

			<?php } else if (!$hide_macros && isset($calculations)) {
			if ($calculations['totals']) : $count_calculations = 1;
			$index_arr = array("Calories","Protein","Fats","Carbs");
			ksort_arr($calculations['totals'], $index_arr);
			?>
				<div class="fmc_featured_macros">
					<?php foreach ($calculations['totals'] as $label => $total) : if($total === 0) continue; ?>
						<div class="rg_macro <?php if($count_calculations === 1) echo ' calories'; ?>"> <span class="rg_m_title"><?php echo $label; ?></span> <span class="rg_m_amount"> <?php echo $total; ?></span></div>
					<?php $count_calculations++; endforeach; ?>
				</div>
			<?php endif;
			}?>
			</div>
			<?php endforeach; ?>
			<?php
			// Reset the global post object so that the rest of the page works correctly.
			wp_reset_postdata(); ?>

	<?php endif; ?>

	<?php
	$featured_post = get_field('featured_post');
	if( $box_type == 'post'): ?>
		<?php foreach( $featured_post as $post ):

			// Setup this post for WP functions (variable must be named $post).
			setup_postdata($post);
			$categories = get_the_category();
			?>
			<div class="fmc_featured_left">
				<a href="<?php the_permalink(); ?>">
					<?php
					if ($featured_hero_image) {
						if ($featured_hero_image) {
							echo wp_get_attachment_image($featured_hero_image, $size);
						}
					} else {
						the_post_thumbnail('large');
					}  ?>
				</a>
			</div>
			<div class="fmc_featured_right">
				<div class="fmc_grid_meta">
					<span class="fmc_grid_cat">
						<?php if ( ! empty( $categories ) ) {
							echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
						} ?>
					</span>
				</div>
				<a href="<?php the_permalink(); ?>"><h2 class="fmc_title_1"><?php the_title(); ?></h2></a>
				<div class="fmc_featured_text">
					<?php the_field('featured_post_text', 'option'); ?>
				</div>
			</div>
		<?php endforeach; ?>
		<?php
		// Reset the global post object so that the rest of the page works correctly.
		wp_reset_postdata(); ?>
	<?php endif; // Post box End ?>
	</div>
</div>


	<div class="fmc_container how-to-page_inner spacing_0_1">

	<h2 class="fmc_title_2 title_spacing_2">How To Posts</h2>
		<div class="how-to-grid how-to_posts">
			<?php
			if ($how_to_posts->have_posts()) {
				while ($how_to_posts->have_posts()) {
					$how_to_posts->the_post();
					$categories = get_the_category();
			?>
					<div class="fmc_post">
						<figure class="fmc_grid_figure">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail('medium'); ?>
							</a>
						</figure>
						<span class="fmc_grid_cat">
							<?php if (!empty($categories)) {
								echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a>';
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
				wp_reset_postdata();
			} else {
				?>
				<p class="no-posts"><?php esc_html_e('There are currently no posts.', 'fitmencook'); ?></p>
			<?php
			} ?>
		</div>

		<h2 class="fmc_title_2 title_spacing_2">How To Recipes</h2>

		<div class="how-to-grid how-to_recipes">
			<?php
			if ($how_to_recipes->have_posts()) {
				while ($how_to_recipes->have_posts()) {
					$how_to_recipes->the_post();
					get_template_part('template-parts/recipe/recipe', 'grid');
				}
				wp_reset_postdata();
			} else {
			?>
				<p class="no-posts"><?php esc_html_e('There are currently no recipes.', 'fitmencook'); ?></p>
			<?php
			} ?>
		</div>
	</div>
</main><!-- #main -->

<?php
get_footer();
