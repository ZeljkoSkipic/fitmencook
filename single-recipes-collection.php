<?php

/**
 * Template Name: Collection
 * Template Post Type: recipes
 */

get_header();

$featured_image_switch = get_field('featured_image_switch');

$categories = get_the_terms( $post->ID, 'recipe-category' );
$author_id = $post->post_author;

$video = get_field('video');

$see_full = get_field('see_full', 'option');
$meal_counter = 1;

?>

<div class="fmc_single_recipe fmc_container spacing_2">
	<div class="fmc_sr_main">
		<div class="fmc_recipe_hero spacing_0_3">
			<!-- Top Wrap -->
			<div class="fmc_recipe_top_wrap">
				<div class="fmc_recipe_top_left">
					<?php if ( function_exists('yoast_breadcrumb') ) {
					yoast_breadcrumb( '<div class="fmc_breadcrumbs spacing_0_2">','</div>' );
					} ?>
					<div class="fmc_categories">
						<?php if ( ! empty( $categories ) ) {
							echo get_the_term_list( $post->ID, 'recipe-category', '<div class="fmc_grid_cat">', '', '</div>');
						} ?>
					</div>
				</div>
				<div class="fmc_top_author">
					<?php echo get_avatar( $author_id ); ?>
					<h5 class="fmc_autor_top_name">
						<span>Author:</span>
						<?php echo wpautop( get_the_author_meta( 'display_name', $author_id ) ); ?>
					</h5>
				</div>
			</div>
			<!-- Recipe Title -->
			<h1 class="fmc_title_1 title_spacing_3">
				<?php the_title(); ?>
			</h1>

			<!-- Featured Image -->
			<?php get_template_part('template-parts/recipe/featured-image'); ?>

			<?php get_template_part('template-parts/last-updated'); ?>

			<?php get_template_part('template-parts/recipe/recipe-email'); ?>

			<!-- WP Content -->

			<?php
			$content = apply_filters( 'the_content', get_the_content() );
			if( $content ) :
			?>
			<div class="spacing_0_2 fmc_recipe_the_content fmc_ad_container">
				<?php echo $content; ?>
			</div>
			<?php endif; ?>
		</div>
		<div class="fmc_sr_recipe_content">
			<!-- Video -->
            <?php if ($video) : ?>
                <div class="video-wrap">
                    <div class="fmc_video">
                        <?php echo $video; ?>
						<div class="video-hide">
							<svg class="hide-icon" width="20px" height="20px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg">
								<path d="M876.8 156.8c0-9.6-3.2-16-9.6-22.4-6.4-6.4-12.8-9.6-22.4-9.6-9.6 0-16 3.2-22.4 9.6L736 220.8c-64-32-137.6-51.2-224-60.8-160 16-288 73.6-377.6 176C44.8 438.4 0 496 0 512s48 73.6 134.4 176c22.4 25.6 44.8 48 73.6 67.2l-86.4 89.6c-6.4 6.4-9.6 12.8-9.6 22.4 0 9.6 3.2 16 9.6 22.4 6.4 6.4 12.8 9.6 22.4 9.6 9.6 0 16-3.2 22.4-9.6l704-710.4c3.2-6.4 6.4-12.8 6.4-22.4Zm-646.4 528c-76.8-70.4-128-128-153.6-172.8 28.8-48 80-105.6 153.6-172.8C304 272 400 230.4 512 224c64 3.2 124.8 19.2 176 44.8l-54.4 54.4C598.4 300.8 560 288 512 288c-64 0-115.2 22.4-160 64s-64 96-64 160c0 48 12.8 89.6 35.2 124.8L256 707.2c-9.6-6.4-19.2-16-25.6-22.4Zm140.8-96c-12.8-22.4-19.2-48-19.2-76.8 0-44.8 16-83.2 48-112 32-28.8 67.2-48 112-48 28.8 0 54.4 6.4 73.6 19.2L371.2 588.8ZM889.599 336c-12.8-16-28.8-28.8-41.6-41.6l-48 48c73.6 67.2 124.8 124.8 150.4 169.6-28.8 48-80 105.6-153.6 172.8-73.6 67.2-172.8 108.8-284.8 115.2-51.2-3.2-99.2-12.8-140.8-28.8l-48 48c57.6 22.4 118.4 38.4 188.8 44.8 160-16 288-73.6 377.6-176C979.199 585.6 1024 528 1024 512s-48.001-73.6-134.401-176Z" fill="#000000" />
								<path d="M511.998 672c-12.8 0-25.6-3.2-38.4-6.4l-51.2 51.2c28.8 12.8 57.6 19.2 89.6 19.2 64 0 115.2-22.4 160-64 41.6-41.6 64-96 64-160 0-32-6.4-64-19.2-89.6l-51.2 51.2c3.2 12.8 6.4 25.6 6.4 38.4 0 44.8-16 83.2-48 112-32 28.8-67.2 48-112 48Z" fill="#000000" />
							</svg>
							<p class="hide-text"><?php esc_html_e('Hide', 'fitmencook'); ?></p>
						</div>
                    </div>
                </div>
            <?php endif; ?>
			<div id="fmc_recipe_content"></div>
            <?php

            if (have_rows('existing_recipe')) : // Existing Recipes

                // Loop through rows.
                while (have_rows('existing_recipe')) : the_row();
                    $recipes = get_sub_field('recipe');
					$description = get_sub_field('description');
                    if ($recipes) : ?>
                        <?php foreach ($recipes as $post) :
                            // Setup this post for WP functions (variable must be named $post).
                            setup_postdata($post); ?>

                            <div class="fmc_mp_recipe">
                                <div class="fmc_mpr_top">
                                    <span class="recipe_no"><?php echo __('Recipe', 'fitmencook') . ' ' . $meal_counter; ?></span>
                                    <a href="<?php the_permalink(); ?>">
                                        <h2 class="fmc_mpr_title fmc_title_3"><?php the_title(); ?></h2>
                                    </a>
                                </div>
                                <?php the_post_thumbnail(); ?>
								<div class="fmc_cr_description">
									<?php echo $description; ?>
								</div>
                                <a class="fmc_mpr_rm" href="<?php the_permalink(); ?>"><?php echo $see_full; ?></a>
                            </div>
                        <?php endforeach; ?>
                        <?php
                        // Reset the global post object so that the rest of the page works correctly.
                        wp_reset_postdata(); ?>
            <?php endif;
                    $meal_counter++;
                endwhile;

            endif; ?>

            <?php if (have_rows('custom_recipe')) : // Custom Recipes

                // Loop through rows.
                while (have_rows('custom_recipe')) : the_row();

                    $recipe_title = get_sub_field('recipe_title');
					$recipe_image = get_sub_field('recipe_image');
					$recipe_description = get_sub_field('recipe_description');
					$recipe_link = get_sub_field('recipe_link');
					if( $recipe_link ):
						$link_url = $recipe_link['url'];
						$link_title = $recipe_link['title'];
						$link_target = $recipe_link['target'] ? $recipe_link['target'] : '_self';
					endif;

					?>

                    <div class="fmc_mp_recipe">
                        <div class="fmc_mpr_top">
                            <span class="recipe_no"><?php echo __('Recipe', 'fitmencook') . ' ' . $meal_counter; ?></span>
							<?php if( $recipe_link ): ?>
								<a href="<?php echo esc_url( $link_url ); ?>" ?>
								<?php endif; ?>
                            <h2 class="fmc_mpr_title fmc_title_3">
								<?php echo $recipe_title; ?>
							</h2>
							<?php if( $recipe_link ): ?>
								</a>
							<?php endif; ?>
                        </div>
						<?php
							$size = 'full'; // (thumbnail, medium, large, full or custom size)
							if( $recipe_image ) {
								echo wp_get_attachment_image( $recipe_image, $size, "", array ('class' => 'attachment-post-thumbnail' ) );
							} ?>
						<div class="fmc_cr_description spacing_3_0">
							<?php echo $recipe_description; ?>
						</div>
						<?php
						if( $recipe_link ):
							?>
							<a class="fmc_mpr_rm" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo $see_full; ?></a>
						<?php endif; ?>
                    </div>
            <?php
                    $meal_counter++;
                endwhile;

            endif; ?>
			<div class="fmc_conclusion spacing_0_2">
				<?php echo wp_kses_post( get_field('conclusion') ); ?>
			</div>
            <!-- Comments -->
            <div class="fmc_comments spacing_3_1">
                <?php
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif; ?>
            </div>
        </div>
	</div>

	<div class="fmc_sr_sidebar">
		<div class="fmc_recipe_details">
		<h4 class="fmc_rs_title fmc_times_title">Share</h4>

			<!-- Share -->
			<div class="fmc_share fmc_recipe_share spacing_3_0">

<!-- 				<div class="fmc_print"><a title="Print" href="<?php echo get_the_permalink()."?print=true"; ?>"><span class="fmc_icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M128 0C92.7 0 64 28.7 64 64v96h64V64H354.7L384 93.3V160h64V93.3c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0H128zM384 352v32 64H128V384 368 352H384zm64 32h32c17.7 0 32-14.3 32-32V256c0-35.3-28.7-64-64-64H64c-35.3 0-64 28.7-64 64v96c0 17.7 14.3 32 32 32H64v64c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V384zm-16-88c-13.3 0-24-10.7-24-24s10.7-24 24-24s24 10.7 24 24s-10.7 24-24 24z"/></svg></span></a></div>
 -->
				<div class="fmc_fb"><a title="Share to Facebook" href="http://www.facebook.com/sharer.php?u=<?php echo  get_permalink() ?>"><span class="fmc_icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#101828" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg></span></a></div>

				<div class="fmc_pin"><a title="Pin" href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink($post->ID)); ?>"></a><span class="fmc_icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M204 6.5C101.4 6.5 0 74.9 0 185.6 0 256 39.6 296 63.6 296c9.9 0 15.6-27.6 15.6-35.4 0-9.3-23.7-29.1-23.7-67.8 0-80.4 61.2-137.4 140.4-137.4 68.1 0 118.5 38.7 118.5 109.8 0 53.1-21.3 152.7-90.3 152.7-24.9 0-46.2-18-46.2-43.8 0-37.8 26.4-74.4 26.4-113.4 0-66.2-93.9-54.2-93.9 25.8 0 16.8 2.1 35.4 9.6 50.7-13.8 59.4-42 147.9-42 209.1 0 18.9 2.7 37.5 4.5 56.4 3.4 3.8 1.7 3.4 6.9 1.5 50.4-69 48.6-82.5 71.4-172.8 12.3 23.4 44.1 36 69.3 36 106.2 0 153.9-103.5 153.9-196.8C384 71.3 298.2 6.5 204 6.5z"/></svg></span></div>

				<div class="fmc_x"><a title="Tweet" href="http://twitter.com/share?text=<?php echo get_the_title(); ?>&url=<?php echo get_permalink(); ?>"><span class="fmc_icon"><svg width="20" height="20" viewBox="0 0 300 300" version="1.1" xmlns="http://www.w3.org/2000/svg">
				<path d="M178.57 127.15 290.27 0h-26.46l-97.03 110.38L89.34 0H0l117.13 166.93L0 300.25h26.46l102.4-116.59 81.8 116.59h89.34M36.01 19.54H76.66l187.13 262.13h-40.66"/>
				</svg></span></a></div>

				<div class="fmc_email"><a title="Email" href="mailto:?subject=<?php echo get_the_title(); ?>&body=<?php echo get_the_title() . ' ' . get_permalink(); ?>"><span class="fmc_icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M64 112c-8.8 0-16 7.2-16 16v22.1L220.5 291.7c20.7 17 50.4 17 71.1 0L464 150.1V128c0-8.8-7.2-16-16-16H64zM48 212.2V384c0 8.8 7.2 16 16 16H448c8.8 0 16-7.2 16-16V212.2L322 328.8c-38.4 31.5-93.7 31.5-132 0L48 212.2zM0 128C0 92.7 28.7 64 64 64H448c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128z"/></svg></span></a></div>

			</div>

			<!-- Jump to recipe -->
			<div class="jtr_wrap">
				<a class="fmc_jtr" href="#fmc_recipe_content"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M19.5949 21.6112L18.4942 13.3557H18.5249C18.8481 13.3557 19.1101 13.0937 19.1101 12.7704V0.870088C19.1101 0.664449 19.0026 0.474666 18.8269 0.368794C18.6512 0.262823 18.4331 0.256569 18.2518 0.352298C15.9697 1.55649 14.541 3.92419 14.541 6.50531V11.5231C14.541 12.5351 15.3617 13.3556 16.3737 13.3556H16.5125L15.4118 21.6112C15.3318 22.2137 15.5154 22.8225 15.9155 23.2798C16.3164 23.7373 16.8954 24 17.5034 24C18.1113 24 18.6903 23.7373 19.0913 23.2798C19.4914 22.8226 19.6749 22.2138 19.5949 21.6112Z" fill="#FF885C"/>
			<path d="M10.4242 0C9.98016 0 9.62083 0.359326 9.62083 0.803301V5.29072H8.81748V0.803301C8.81748 0.359326 8.45816 0 8.01413 0C7.57011 0 7.21083 0.359326 7.21083 0.803301V5.29072H6.40748V0.803301C6.40743 0.359326 6.04811 0 5.60413 0C5.16006 0 4.80078 0.359326 4.80078 0.803301V5.29072V6.02508V8.05384C4.80078 9.24552 5.76648 10.2112 6.95817 10.2112H7.13623L5.87009 21.6049C5.80263 22.2144 5.99793 22.824 6.40664 23.2814C6.8162 23.7388 7.40066 24 8.01418 24C8.6277 24 9.21212 23.7388 9.62172 23.2814C10.0305 22.824 10.2258 22.2144 10.1583 21.6049L8.89209 10.2113H9.0702C10.2618 10.2113 11.2276 9.24557 11.2276 8.05389V6.02513V5.29077V0.803301C11.2275 0.359326 10.8682 0 10.4242 0Z" fill="#FF885C"/>
			</svg>
			Jump to Recipe</a>
			</div>

		</div>

		<div class="atm-ad-slot" data-slot-type="rail-ad"></div>

	</div>
</div>

<!-- Author -->
<?php get_template_part('template-parts/author'); ?>

<!-- Related Recipes -->
<?php get_template_part('template-parts/recipe/related-recipes'); ?>

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

<?php get_footer();
