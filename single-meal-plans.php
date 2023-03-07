<?php get_header();

$video = get_field('video');
$gallery = get_field('gallery');

$times_title = get_field('times_title', 'option');

$l_prep_time = get_field('l_prep_time', 'option');
$l_cook_time = get_field('l_cook_time', 'option');
$l_total_time = get_field('l_total_time', 'option');

$minutes = get_field('minutes', 'option');
$see_full = get_field('see_full', 'option');

?>

<div class="fmc_single_recipe fmc_container spacing_2">
	<div class="fmc_sr_main">
		<div class="fmc_recipe_hero spacing_0_3">
			<?php if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb( '<div class="fmc_breadcrumbs spacing_0_2">','</div>' );
			} ?>

			<!-- Meal Plan Title -->
			<h1 class="fmc_title_1 title_spacing_3">
				<?php the_title(); ?>
			</h1>

			<!-- WP Content -->
			<div class="spacing_0_2 fmc_recipe_the_content">
				<?php the_content(); ?>
			</div>

			<!-- Gallery -->
			<?php get_template_part('template-parts/recipe/gallery'); ?>
		</div>
		<div class="fmc_sr_recipe_content">
			<!-- Video -->
			<?php if($video): ?>
				<div class="video-wrap">
					<div class="fmc_video">
						<?php echo $video; ?>
					</div>
				</div>
			<?php endif; ?>

			<?php

			if( have_rows('existing_recipe') ): // Existing Recipes

				// Loop through rows.
				while( have_rows('existing_recipe') ) : the_row();
					$include_steps = get_sub_field('include_steps');
					$recipes = get_sub_field('recipe');
					if( $recipes ): ?>
						<?php foreach( $recipes as $post ):
							// Setup this post for WP functions (variable must be named $post).
							setup_postdata($post);

							$prep_time = get_field('prep_time');
							$cook_time = get_field('cook_time');
							$total_time = get_field('total_time'); ?>

							<div class="fmc_mp_recipe">
								<div class="fmc_mpr_top">
									<span class="recipe_no">Meal 1</span>
									<a href="<?php the_permalink(); ?>"><h2 class="fmc_mpr_title fmc_title_3"><?php the_title(); ?></h2></a>
								</div>
								<div class="fmc_recipe_times">
									<div class="fmc_time_wrap fmc_prep">
										<span class="fmc_time"><?php echo $l_prep_time; ?></span>
										<span class="fmc_amount"><?php echo $prep_time; ?><?php echo $minutes ?></span>
									</div>
									<div class="fmc_time_wrap fmc_cook">
										<span class="fmc_time"><?php echo $l_cook_time; ?></span>
										<span class="fmc_amount"><?php echo $cook_time; ?><?php echo $minutes ?></span>
									</div>
									<div class="fmc_time_wrap fmc_total">
										<span class="fmc_time"><?php echo $l_total_time; ?></span>
										<span class="fmc_amount"><?php echo $total_time; ?><?php echo $minutes ?></span>
									</div>
									<div class="fmc_cals">
										260cal
									</div>
								</div>
								<?php the_post_thumbnail(); ?>
								<h4 class="fmc_mpr_subtitle"><?php the_field('ingredients_title'); ?></h4>
								<div class="text_2 fmc_mpr_content fmc_mpr_ing"><?php the_field('ingredients'); ?></div>
								<?php if( $include_steps ) : ?>
								<h4 class="fmc_mpr_subtitle"><?php the_field('steps_title'); ?></h4>
								<div class="text_2 fmc_mpr_content fmc_mpr_steps">
								<div class="fmc_recipe_steps">
									<div class="fmc_steps">
										<?php
										// Check rows existexists.
										if( have_rows('steps') ):
											$item = 1;
											// Loop through rows.
											while( have_rows('steps') ) : the_row();

												// Load sub field value.
												$step = get_sub_field('step'); ?>

												<div class="fmc_sr_step spacing_0_2">
													<h5 class="fmc_step_title spacing_0_3">
														Step <?php echo $item; ?>
													</h5>
													<div class="fmc_step_content">
														<?php echo $step; ?>
													</div>
												</div>


											<?php // End loop.
											$item++;
											endwhile;

										endif; ?>
									</div>
								</div>
								</div>
								<?php endif; ?>
								<!-- Macros -->
								<?php get_template_part('template-parts/recipe/macros'); ?>
								<a class="fmc_mpr_rm" href="<?php the_permalink(); ?>"><?php echo $see_full; ?></a>
							</div>
						<?php endforeach; ?>
						<?php
						// Reset the global post object so that the rest of the page works correctly.
						wp_reset_postdata(); ?>
					<?php endif;

				endwhile;

			endif; ?>

			<?php dynamic_sidebar( 'ad7' ); ?>

			<?php if( have_rows('custom_recipe') ): // Custom Recipes

			// Loop through rows.
			while( have_rows('custom_recipe') ) : the_row();
			$recipe_title = get_sub_field('recipe_title');

			$cr_prep_time = get_sub_field('cr_prep_time');
			$cr_cook_time = get_sub_field('cr_cook_time');
			$cr_total_time = get_sub_field('cr_total_time');

			$l_calories = get_field('l_calories', 'option');
			$l_protein = get_field('l_protein', 'option');
			$l_fat = get_field('l_fat', 'option');
			$l_carbs = get_field('l_carbs', 'option');
			$l_sodium = get_field('l_sodium', 'option');
			$l_fiber = get_field('l_fiber', 'option');
			$l_sugar = get_field('l_sugar', 'option');

			$cr_calories = get_sub_field('cr_calories');
			$cr_protein = get_sub_field('cr_protein');
			$cr_fat = get_sub_field('cr_fat');
			$cr_carbs = get_sub_field('cr_carbs');
			$cr_sodium = get_sub_field('cr_sodium');
			$cr_fiber = get_sub_field('cr_fiber');
			$cr_sugar = get_sub_field('cr_sugar'); ?>

				<div class="fmc_mp_recipe">
					<div class="fmc_mpr_top">
						<span class="recipe_no">Meal 1</span>
						<h2 class="fmc_mpr_title fmc_title_3"><?php echo $recipe_title; ?></h2>
					</div>
					<div class="fmc_recipe_times">
						<div class="fmc_time_wrap fmc_prep">
							<span class="fmc_time"><?php echo $l_prep_time; ?></span>
							<span class="fmc_amount"><?php echo $cr_prep_time; ?><?php echo $minutes ?></span>
						</div>
						<div class="fmc_time_wrap fmc_cook">
							<span class="fmc_time"><?php echo $l_cook_time; ?></span>
							<span class="fmc_amount"><?php echo $cr_cook_time; ?><?php echo $minutes ?></span>
						</div>
						<div class="fmc_time_wrap fmc_total">
							<span class="fmc_time"><?php echo $l_total_time; ?></span>
							<span class="fmc_amount"><?php echo $cr_total_time; ?><?php echo $minutes ?></span>
						</div>
						<div class="fmc_cals">
							<?php if($cr_calories) { ?>
								<?php echo $cr_calories ?>cal
							<?php } ?>
						</div>
					</div>
					<?php the_post_thumbnail(); ?>
					<h4 class="fmc_mpr_subtitle"><?php the_field('ingredients_title'); ?></h4>
					<div class="text_2 fmc_mpr_content fmc_mpr_ing"><?php the_field('ingredients'); ?></div>
					<h4 class="fmc_mpr_subtitle"><?php the_field('steps_title'); ?></h4>
					<div class="text_2 fmc_mpr_content fmc_mpr_steps">
					<div class="fmc_recipe_steps">
						<div class="fmc_steps">
							<?php
							// Check rows existexists.
							if( have_rows('cr_steps') ):
								$item = 1;
								// Loop through rows.
								while( have_rows('cr_steps') ) : the_row();

									// Load sub field value.
									$step = get_sub_field('cr_step'); ?>

									<div class="fmc_sr_step spacing_0_2">
										<h5 class="fmc_step_title spacing_0_3">
											Step <?php echo $item; ?>
										</h5>
										<div class="fmc_step_content">
											<?php echo $step; ?>
										</div>
									</div>


								<?php // End loop.
								$item++;
								endwhile;

							endif; ?>
						</div>
					</div>
					</div>
					<!-- Macros -->
					<div class="fmc_macros">
						<h4 class="fmc_rs_title fmc_macros_title"><?php echo $macros_title; ?></h4>
						<?php if($cr_protein) { ?>
							<div class="fmc_macro"><?php echo $l_protein ?><span><?php echo $cr_protein ?>g</span></div>
						<?php } ?>
						<?php if($cr_fat) { ?>
							<div class="fmc_macro"><?php echo $l_fat ?><span><?php echo $cr_fat ?>g</span></div>
						<?php } ?>
						<?php if($cr_carbs) { ?>
							<div class="fmc_macro"><?php echo $l_carbs ?><span><?php echo $cr_carbs ?>g</span></div>
						<?php } ?>
						<?php if($cr_sodium) { ?>
							<div class="fmc_macro"><?php echo $l_sodium ?><span><?php echo $cr_sodium ?>g</span></div>
						<?php } ?>
						<?php if($cr_fiber) { ?>
							<div class="fmc_macro"><?php echo $l_fiber ?><span><?php echo $cr_fiber ?>g</span></div>
						<?php } ?>
						<?php if($cr_sugar) { ?>
							<div class="fmc_macro"><?php echo $l_sugar ?><span><?php echo $cr_sugar?>g</span></div>
						<?php } ?>
					</div>
				</div>

			<?php endwhile;

			endif; ?>

			<?php dynamic_sidebar( 'ad8' ); ?>

			<!-- Comments -->
			<div class="fmc_comments spacing_3_1">
				<?php
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif; ?>
			</div>
		</div>

	</div>

	<div class="fmc_sr_sidebar">
		<div class="fmc_recipe_details">
			<div class="fmc_sidebar_rating">
            <?php echo get_avarage_rating(get_the_ID(), 'sidebar'); ?>
			</div>
			<!-- Macros -->
			<div class="fmc_mp_totals">
				<div class="fmc_total">Total Calories <span class="fmc_total_number fmc_total_cal">1234</span></div>
			</div>
			<!-- Share -->
			<div class="fmc_share fmc_recipe_share spacing_3_0">

<!-- 				<div class="fmc_go"><a title="Go To Recipe" href="#fmc_gtr"><span class="fmc_icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M416 0C400 0 288 32 288 176V288c0 35.3 28.7 64 64 64h32V480c0 17.7 14.3 32 32 32s32-14.3 32-32V352 240 32c0-17.7-14.3-32-32-32zM64 16C64 7.8 57.9 1 49.7 .1S34.2 4.6 32.4 12.5L2.1 148.8C.7 155.1 0 161.5 0 167.9c0 45.9 35.1 83.6 80 87.7V480c0 17.7 14.3 32 32 32s32-14.3 32-32V255.6c44.9-4.1 80-41.8 80-87.7c0-6.4-.7-12.8-2.1-19.1L191.6 12.5c-1.8-8-9.3-13.3-17.4-12.4S160 7.8 160 16V150.2c0 5.4-4.4 9.8-9.8 9.8c-5.1 0-9.3-3.9-9.8-9L127.9 14.6C127.2 6.3 120.3 0 112 0s-15.2 6.3-15.9 14.6L83.7 151c-.5 5.1-4.7 9-9.8 9c-5.4 0-9.8-4.4-9.8-9.8V16zm48.3 152l-.3 0-.3 0 .3-.7 .3 .7z"/></svg></span></a></div>
 -->
				<div class="fmc_print"><a title="Print" href="<?php echo get_the_permalink()."?print=true"; ?>"><span class="fmc_icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M128 0C92.7 0 64 28.7 64 64v96h64V64H354.7L384 93.3V160h64V93.3c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0H128zM384 352v32 64H128V384 368 352H384zm64 32h32c17.7 0 32-14.3 32-32V256c0-35.3-28.7-64-64-64H64c-35.3 0-64 28.7-64 64v96c0 17.7 14.3 32 32 32H64v64c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V384zm-16-88c-13.3 0-24-10.7-24-24s10.7-24 24-24s24 10.7 24 24s-10.7 24-24 24z"/></svg></span></a></div>

				<div class="fmc_fb"><a title="Share to Facebook" href="http://www.facebook.com/sharer.php?u=<?php echo  get_permalink() ?>"><span class="fmc_icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#101828" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg></span></a></div>

				<div class="fmc_pin"><a title="Pin" href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink($post->ID)); ?>"></a><span class="fmc_icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M204 6.5C101.4 6.5 0 74.9 0 185.6 0 256 39.6 296 63.6 296c9.9 0 15.6-27.6 15.6-35.4 0-9.3-23.7-29.1-23.7-67.8 0-80.4 61.2-137.4 140.4-137.4 68.1 0 118.5 38.7 118.5 109.8 0 53.1-21.3 152.7-90.3 152.7-24.9 0-46.2-18-46.2-43.8 0-37.8 26.4-74.4 26.4-113.4 0-66.2-93.9-54.2-93.9 25.8 0 16.8 2.1 35.4 9.6 50.7-13.8 59.4-42 147.9-42 209.1 0 18.9 2.7 37.5 4.5 56.4 3.4 3.8 1.7 3.4 6.9 1.5 50.4-69 48.6-82.5 71.4-172.8 12.3 23.4 44.1 36 69.3 36 106.2 0 153.9-103.5 153.9-196.8C384 71.3 298.2 6.5 204 6.5z"/></svg></span></div>

				<div class="fmc_twitter"><a title="Tweet" href="http://twitter.com/share?text=<?php echo get_the_title(); ?>&url=<?php echo get_permalink(); ?>"><span class="fmc_icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#101828" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg></span></a></div>

				<div class="fmc_email"><a title="Email" href="mailto:?subject=<?php echo get_the_title(); ?>&body=<?php echo get_the_title() . ' ' . get_permalink(); ?>"><span class="fmc_icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M64 112c-8.8 0-16 7.2-16 16v22.1L220.5 291.7c20.7 17 50.4 17 71.1 0L464 150.1V128c0-8.8-7.2-16-16-16H64zM48 212.2V384c0 8.8 7.2 16 16 16H448c8.8 0 16-7.2 16-16V212.2L322 328.8c-38.4 31.5-93.7 31.5-132 0L48 212.2zM0 128C0 92.7 28.7 64 64 64H448c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128z"/></svg></span></a></div>

			</div>
		</div>

		<?php dynamic_sidebar( 'ad5' ); ?>

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
