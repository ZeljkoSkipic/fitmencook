<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package fitmencook
 */

get_header();
?>

	<main id="primary" class="site-main spacing_0_1">
		<div class="fmc_post_hero spacing_2_3">
			<div class="fmc_container">
				<?php if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb( '<div class="fmc_breadcrumbs spacing_0_2">','</div>' );
				} ?>

				<!-- Categories -->
				<div class="fmc_categories">
					<?php the_category(); ?>
				</div>
				<h1 class="fmc_title_1 title_spacing_2">
					<?php the_title(); ?>
				</h1>
				<figure>
					<?php the_post_thumbnail( 'fmc-post-featured' ); ?>
			</figure>
			</div>
		</div>
		<div class="fmc_container fmc_post_main spacing_3_1">
			<div class="fmc_share fmc_post_share">
				<div class="fmc_print"><a title="Print" href="<?php echo get_the_permalink()."?print=true"; ?>"><span class="fmc_icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M128 0C92.7 0 64 28.7 64 64v96h64V64H354.7L384 93.3V160h64V93.3c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0H128zM384 352v32 64H128V384 368 352H384zm64 32h32c17.7 0 32-14.3 32-32V256c0-35.3-28.7-64-64-64H64c-35.3 0-64 28.7-64 64v96c0 17.7 14.3 32 32 32H64v64c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V384zm-16-88c-13.3 0-24-10.7-24-24s10.7-24 24-24s24 10.7 24 24s-10.7 24-24 24z"/></svg></span></a></div>

				<div class="fmc_email"><a title="Email" href="#"><span class="fmc_icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M64 112c-8.8 0-16 7.2-16 16v22.1L220.5 291.7c20.7 17 50.4 17 71.1 0L464 150.1V128c0-8.8-7.2-16-16-16H64zM48 212.2V384c0 8.8 7.2 16 16 16H448c8.8 0 16-7.2 16-16V212.2L322 328.8c-38.4 31.5-93.7 31.5-132 0L48 212.2zM0 128C0 92.7 28.7 64 64 64H448c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128z"/></svg></span></a></div>

				<div class="fmc_fb"><a href="#"><span class="fmc_icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M352 224c53 0 96-43 96-96s-43-96-96-96s-96 43-96 96c0 4 .2 8 .7 11.9l-94.1 47C145.4 170.2 121.9 160 96 160c-53 0-96 43-96 96s43 96 96 96c25.9 0 49.4-10.2 66.6-26.9l94.1 47c-.5 3.9-.7 7.8-.7 11.9c0 53 43 96 96 96s96-43 96-96s-43-96-96-96c-25.9 0-49.4 10.2-66.6 26.9l-94.1-47c.5-3.9 .7-7.8 .7-11.9s-.2-8-.7-11.9l94.1-47C302.6 213.8 326.1 224 352 224z"/></svg></span></a></div>

				<div class="fmc_pin"><?php $pinterestimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?><a title="Pin This" href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink($post->ID)); ?>&media=<?php echo $pinterestimage[0]; ?>&description=<?php the_title(); ?>" class="pin-it-button" count-layout="vertical"><span class="fmc_icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M204 6.5C101.4 6.5 0 74.9 0 185.6 0 256 39.6 296 63.6 296c9.9 0 15.6-27.6 15.6-35.4 0-9.3-23.7-29.1-23.7-67.8 0-80.4 61.2-137.4 140.4-137.4 68.1 0 118.5 38.7 118.5 109.8 0 53.1-21.3 152.7-90.3 152.7-24.9 0-46.2-18-46.2-43.8 0-37.8 26.4-74.4 26.4-113.4 0-66.2-93.9-54.2-93.9 25.8 0 16.8 2.1 35.4 9.6 50.7-13.8 59.4-42 147.9-42 209.1 0 18.9 2.7 37.5 4.5 56.4 3.4 3.8 1.7 3.4 6.9 1.5 50.4-69 48.6-82.5 71.4-172.8 12.3 23.4 44.1 36 69.3 36 106.2 0 153.9-103.5 153.9-196.8C384 71.3 298.2 6.5 204 6.5z"/></svg></span></a></div>
			</div>
			<div class="fmc_post_content">
				<?php
				while ( have_posts() ) :
					the_post();

					the_content(); ?>

				<?php endwhile; // End of the loop.
				?>
			</div>
			<div class="fmc_post_sidebar">
				<?php dynamic_sidebar( 'blog_sidebar' ); ?>
			</div>
		</div>
	<?php get_template_part('template-parts/author'); ?>

	<?php get_template_part('template-parts/newsletter'); ?>

	<div class="fmc_latest_blog fmc_related_blogs spacing_2_1">
		<div class="fmc_container">
			<span class="fmc_title_prefix"><?php the_field('rb_prefix', 'option') ?></span>
			<h3 class="fmc_title_2 title_spacing_1"><?php the_field('rb_title', 'option') ?></h3>
			<div class="fmc_latest_blog_inner">
			<?php

				$args = array(
					'category__in'   => wp_get_post_categories( $post->ID ),
					'posts_per_page'   => 3,
					'post__not_in'   => array( $post->ID ),
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
								<div class="fmc_post_meta">
									<div class="fmc_pm_right">
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
	</main><!-- #main -->


<?php
get_sidebar();
get_footer();
