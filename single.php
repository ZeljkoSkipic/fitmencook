<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package fitmencook
 */

get_header();
$author_id = $post->post_author;
?>

	<main id="primary" class="site-main spacing_0_1">
		<div class="fmc_post_hero spacing_2_3">
			<div class="fmc_container">
				<div class="fmc_post_hero_top">
					<div class="fmc_post_hero_left">
						<?php if ( function_exists('yoast_breadcrumb') ) {
						yoast_breadcrumb( '<div class="fmc_breadcrumbs spacing_0_2">','</div>' );
						} ?>

						<!-- Categories -->
						<div class="fmc_categories">
							<?php the_category(); ?>
						</div>
					</div>
					<div class="fmc_post_hero_right">
						<?php get_template_part('template-parts/last-updated'); ?>
						<div class="fmc_top_author">
							<?php echo get_avatar( $author_id ); ?>
							<h5 class="fmc_autor_top_name">
								<span>Author:</span>
								<?php echo wpautop( get_the_author_meta( 'display_name', $author_id ) ); ?>
							</h5>
						</div>
					</div>
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

				<div class="fmc_fb"><a title="Share to Facebook" href="http://www.facebook.com/sharer.php?u=<?php echo  get_permalink() ?>"><span class="fmc_icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#101828" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg></span></a></div>

				<div class="fmc_pin"><a title="Pin" href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink($post->ID)); ?>"></a><span class="fmc_icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M204 6.5C101.4 6.5 0 74.9 0 185.6 0 256 39.6 296 63.6 296c9.9 0 15.6-27.6 15.6-35.4 0-9.3-23.7-29.1-23.7-67.8 0-80.4 61.2-137.4 140.4-137.4 68.1 0 118.5 38.7 118.5 109.8 0 53.1-21.3 152.7-90.3 152.7-24.9 0-46.2-18-46.2-43.8 0-37.8 26.4-74.4 26.4-113.4 0-66.2-93.9-54.2-93.9 25.8 0 16.8 2.1 35.4 9.6 50.7-13.8 59.4-42 147.9-42 209.1 0 18.9 2.7 37.5 4.5 56.4 3.4 3.8 1.7 3.4 6.9 1.5 50.4-69 48.6-82.5 71.4-172.8 12.3 23.4 44.1 36 69.3 36 106.2 0 153.9-103.5 153.9-196.8C384 71.3 298.2 6.5 204 6.5z"/></svg></span></div>

				<div class="fmc_twitter"><a title="Tweet" href="http://twitter.com/share?text=<?php echo get_the_title(); ?>&url=<?php echo get_permalink(); ?>"><span class="fmc_icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#101828" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg></span></a></div>

				<div class="fmc_email"><a title="Email" href="mailto:?subject=<?php echo get_the_title(); ?>&body=<?php echo get_the_title() . ' ' . get_permalink(); ?>"><span class="fmc_icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M64 112c-8.8 0-16 7.2-16 16v22.1L220.5 291.7c20.7 17 50.4 17 71.1 0L464 150.1V128c0-8.8-7.2-16-16-16H64zM48 212.2V384c0 8.8 7.2 16 16 16H448c8.8 0 16-7.2 16-16V212.2L322 328.8c-38.4 31.5-93.7 31.5-132 0L48 212.2zM0 128C0 92.7 28.7 64 64 64H448c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128z"/></svg></span></a></div>

			</div>
			<div class="fmc_sp_post_content fmc_ad_container">
				<?php
				while ( have_posts() ) :
					the_post();

					the_content(); ?>

				<?php endwhile; // End of the loop.
				?>
			<div class="fmc_author">
				<figure class="fmc_author_img">
				<?php echo get_avatar( get_the_author_meta( 'ID', 9 ) ); ?>
				</figure>
				<div class="fmc_author_inner">
					<h3 class="fmc_author_prefix"><?php the_field('author_prefix', 'option'); ?></h3>
					<h4 class="title_spacing_3">
						<?php the_field('author_title', 'option'); ?>
					</h4>
					<div class="fmc_author_content">

					<em>
						<?php echo wpautop( get_the_author_meta( 'description', '9' ) ); ?>
					</em>
					</div>
					<div class="fmc_chef_share">
						<div class="fmc_youtube"><a href="<?php the_field('youtube', 'option'); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"/></svg></a></div>
						<div class="fmc_tw"><a href="<?php the_field('twitter', 'option'); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"/></svg></a></div>
						<div class="fmc_fb"><a href="<?php the_field('facebook', 'option'); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"/></svg></a></div>
						<div class="fmc_instagram"><a href="<?php the_field('instagram', 'option'); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg></a></div>
					</div>
				</div>
			</div>

			</div>
			<?php get_template_part('template-parts/blog-sidebar'); ?>
		</div>


	<?php get_template_part('template-parts/newsletter'); ?>

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

		<div class="fmc_latest_blog fmc_related_blogs spacing_2_1">
			<div class="fmc_container">
				<span class="fmc_title_prefix"><?php the_field('rb_prefix', 'option') ?></span>
				<h3 class="fmc_title_2 title_spacing_1"><?php the_field('rb_title', 'option') ?></h3>
				<div class="fmc_latest_blog_inner">
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
				</div>
			</div>
		</div>
		<?php endif; ?>

		<?php wp_reset_query();   // Restore global post data stomped by the_post(). ?>


	</main><!-- #main -->

<script type="text/javascript">
(function() {
    window.PinIt = window.PinIt || { loaded:false };
    if (window.PinIt.loaded) return;
    window.PinIt.loaded = true;
    function async_load(){
        var s = document.createElement("script");
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://assets.pinterest.com/js/pinit.js";
        var x = document.getElementsByTagName("script")[0];
        x.parentNode.insertBefore(s, x);
    }
    if (window.attachEvent)
        window.attachEvent("onload", async_load);
    else
        window.addEventListener("load", async_load, false);
})();
</script>
<?php
get_footer();
