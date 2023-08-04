<?php

get_header();

$featured_image = get_field('featured_post_image', 'option');
$size = 'full';
$i = 1;
global $wp_query;
$post_per_page_count = $wp_query->post_count;
$blog_posts_delimetar = get_field('after_which_post_number_to_show_add', 'option');

?>

<div class="fmc_archive_wrap">
	<div class="fmc_container spacing_2_0">
		<?php if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb( '<div class="fmc_breadcrumbs spacing_0_3">','</div>' );
		} ?>
		<h1 class="fmc_title_2 title_spacing_3"><?php single_cat_title(); ?></h1>

	<?php
	$featured_post = get_field('featured_post', 'option');
	if( $featured_post ):
	foreach( $featured_post as $post ):
		// Setup this post for WP functions (variable must be named $post).
		setup_postdata($post);
		$categories = get_the_category();
		?>
	<div class="fmc_featured_post">
		<div class="fmc_featured_left">
			<?php
			if($featured_image) {
				if( $featured_image ) {
					echo wp_get_attachment_image( $featured_image, $size );
				}
			} else {
				the_post_thumbnail('large');
			}  ?>
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
	</div>
	<?php endforeach; ?>
	<?php
	// Reset the global post object so that the rest of the page works correctly.
	wp_reset_postdata(); ?>
	<?php endif; ?>
	<div class="atm-ad-slot" data-slot-type="middleboard-ad"></div>
	<h2 class="fmc_title_2 title_spacing_2"><?php the_field('blog_title', 'option'); ?></h2>
	</div>

	<div class="fmc_archive_inner fmc_container">
		<div class="fmc_blog_archive_main">
            <div class="fmc_post_sidebar">
                <?php  ?>
            </div>
			<?php  while ( have_posts() ) : the_post();
			$categories = get_the_category();

            if($post_per_page_count >= 4 && $i === 1) echo "<div class='first-posts-container'>"; elseif($post_per_page_count > 4 && $i === ($blog_posts_delimetar + 1)) echo "<div class='rest-of-posts-container'>";
            $i++;
			?>
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

                <?php

                if($post_per_page_count >= 4 && $i === ($blog_posts_delimetar + 1)) {
                    echo "</div>";
                    dynamic_sidebar( 'blog_archive_sidebar' );
                }
                elseif($post_per_page_count > 4 && $i === ($post_per_page_count + 1)) {
                    echo "</div>";
                }


                ?>

			<?php endwhile;
			?>
			<div class="fmc_pagination_wrap spacing_3_1">
				<?php fmc_pagination(); ?>
			</div>
		</div>

		<?php get_template_part('template-parts/blog-sidebar'); ?>
	</div>
</div>

<?php get_template_part('template-parts/app'); ?>

<?php get_footer();
