<?php

get_header();

?>

<div class="fmc_archive_wrap">
	<div class="fmc_container spacing_2_0">
		<?php if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb( '<div class="fmc_breadcrumbs spacing_0_3">','</div>' );
		} ?>
		<h1 class="fmc_title_2 title_spacing_3"><?php single_cat_title(); ?></h1>
	</div>
<div class="fmc_archive_inner fmc_container">
	<div class="fmc_blog_archive_main">
		<?php while ( have_posts() ) : the_post();
		$categories = get_the_category();
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

		<?php endwhile;
		?>
		<div class="fmc_pagination_wrap spacing_3_1">
			<?php fmc_pagination(); ?>
		</div>
	</div>

	<div class="fmc_post_sidebar">
		<?php dynamic_sidebar( 'blog_sidebar' ); ?>
	</div>
</div>
</div>

<?php get_template_part('template-parts/app'); ?>

<?php get_footer();
