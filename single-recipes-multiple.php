<?php

/**
 * Template Name: Multiple
 * Template Post Type: recipes
 */

get_header();

$video = get_field('video');
$gallery = get_field('gallery');

$times_title = get_field('times_title', 'option');

$l_prep_time = get_field('l_prep_time', 'option');
$l_cook_time = get_field('l_cook_time', 'option');
$l_total_time = get_field('l_total_time', 'option');

$minutes = get_field('minutes', 'option');
$see_full = get_field('see_full', 'option');

$l_calories = get_field('l_calories', 'option');
$l_protein = get_field('l_protein', 'option');
$l_fat = get_field('l_fat', 'option');
$l_carbs = get_field('l_carbs', 'option');
$l_sodium = get_field('l_sodium', 'option');
$l_fiber = get_field('l_fiber', 'option');
$l_sugar = get_field('l_sugar', 'option');

$nosi = get_field('number_of_servings_ing', 'option');
$l_serving_size = get_field('l_serving_size', 'option');

$meal_counter = 1;
$calculations = meal_plan_calculations();

?>

<div class="fmc_single_recipe fmc_container spacing_2">
    <div class="fmc_sr_main">
        <div class="fmc_recipe_hero spacing_0_3">
            <?php if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<div class="fmc_breadcrumbs spacing_0_2">', '</div>');
            } ?>
            <!-- Meal Plan Title -->
            <h1 class="fmc_title_1 title_spacing_3">
                <?php the_title(); ?>
            </h1>

			<?php get_template_part('template-parts/last-updated'); ?>

            <!-- WP Content -->
            <div class="spacing_0_2 fmc_recipe_the_content fmc_ad_container">
                <?php the_content(); ?>
            </div>

            <!-- Gallery -->
            <?php get_template_part('template-parts/recipe/gallery'); ?>
        </div>
        <div class="fmc_sr_recipe_content" id="fmc_recipe_content">
            <!-- Video -->
            <?php if ($video) : ?>
                <div class="video-wrap">
                    <div class="fmc_video">
                        <?php echo $video; ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php

            if (have_rows('existing_recipe')) : // Existing Recipes

                // Loop through rows.
                while (have_rows('existing_recipe')) : the_row();
                    $include_steps = get_sub_field('include_steps');
                    $recipes = get_sub_field('recipe');

                    if ($recipes) : ?>
                        <?php foreach ($recipes as $post) :
                            // Setup this post for WP functions (variable must be named $post).
                            setup_postdata($post);

                            $prep_hours = get_field('prep_hours');
							$prep_time = get_field('prep_time');
							$cook_hours = get_field('cook_hours');
							$cook_time = get_field('cook_time');
							$total_time = get_field('total_time');
							$total_hours = get_field('total_hours');
                            $calories = get_field('calories');
							$servings_number = get_field('number_of_servings');
							$serving_size = get_field('serving_size');
                        ?>

                            <div class="fmc_mp_recipe">
                                <div class="fmc_mpr_top">
                                    <span class="recipe_no"><?php echo __('Recipe', 'fitmencook') . ' ' . $meal_counter; ?></span>
                                    <a href="<?php the_permalink(); ?>">
                                        <h2 class="fmc_mpr_title fmc_title_3"><?php the_title(); ?></h2>
                                    </a>
                                </div>
                                <div class="fmc_recipe_times">
								<?php if($prep_time) { ?>
									<div class="fmc_time_wrap fmc_prep">
										<span class="fmc_time"><?php echo $l_prep_time ?></span>
										</span>
										<span class="fmc_amount">
										<?php if($prep_hours) { ?>
											<?php echo $prep_hours ?>h
										<?php } ?>
										<?php echo $prep_time?><?php echo $minutes ?></span>
									</div>
								<?php } ?>
								<?php if($cook_time) { ?>
									<div class="fmc_time_wrap fmc_cook">
										<span class="fmc_time"><?php echo $l_cook_time ?></span>
										<span class="fmc_amount">
										<?php if($cook_hours) { ?>
											<?php echo $cook_hours ?>h
										<?php } ?>
										<?php echo $cook_time ?><?php echo $minutes ?></span>
									</div>
								<?php } ?>
								<?php if($total_time) { ?>
									<div class="fmc_time_wrap fmc_total">
										<span class="fmc_time"><?php echo $l_total_time ?></span>
										<span class="fmc_amount">
										<?php if($total_hours) { ?>
											<?php echo $total_hours ?>h
										<?php } ?>
										<?php echo $total_time ?><?php echo $minutes ?></span></div>
								<?php } ?>

                                    <?php if ($calories) : ?>

                                        <div class="fmc_cals">
                                            <?php echo $calories . __('cal', 'fitmencook'); ?>
                                        </div>

                                    <?php endif; ?>
                                </div>
                                <?php the_post_thumbnail(); ?>
								<?php
								$ingredients_title = get_field('ingredients_title');
								if($ingredients_title) : ?>
                                <h4 class="fmc_mpr_subtitle"><?php echo $ingredients_title ?></h4>
								<?php endif; ?>
								<?php if($servings_number) { ?>
								<div class="fmc_ing_servings"><?php echo $servings_number ?> <?php echo $nosi; ?></div>
								<?php } ?>
								<?php if($serving_size) { ?>
								<div class="fmc_ing_servings_size"><?php echo $l_serving_size; ?>:<span><?php echo $serving_size ?></span></div>
								<?php } ?>

								<!-- Ingredients -->

								<?php // Instacart Ingredients

								if( get_field('ingredients_switch') ) { ?>
								<div class="fmc_ingredients">
									<?php

									if( have_rows('ing_group') ): ?>

										<?php while( have_rows('ing_group') ) : the_row(); ?>
										<?php $ing_title = get_sub_field('ing_g_title'); ?>
										<?php if( $ing_title ) { ?>
											<strong><?php echo $ing_title; ?></strong>
										<?php } ?>
										<ul>
										<?php while( have_rows('ingredients_instacart') ) : the_row(); ?>

											<?php
											$ingredient = get_sub_field('ingredient');
											$ingredient_link = get_sub_field('ingredient_link');
											$note = get_sub_field('note');
											$substitution = get_sub_field('substitution');
											?>
											<li>

											<?php if( $ingredient_link ) { ?>
												<a href="<?php echo $ingredient_link; ?>" target="_blank">
											<?php } ?>
											<?php echo $ingredient; ?>
											<?php if( $ingredient_link ) { ?>
												</a>
											<?php } ?>



											<?php if( $note || $substitution ) : ?>
												<ul>
													<?php if( $note ) { ?>
													<li><?php echo $note; ?></li>
													<?php } ?>
													<?php if( $substitution ) { ?>
													<li><?php echo $substitution; ?></li>
													<?php } ?>
												</ul>
											<?php endif; ?>
										</li>
										<?php endwhile; ?>
										</ul>

										<?php endwhile; ?>

									<?php endif; ?>
								</div>
								<script>
								(function (d, s, id) { var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) { return; } js = d.createElement(s); js.id = id; js.src = "https://widgets.instacart.com/widget-bundle.js"; js.async = true; fjs.parentNode.insertBefore(js, fjs); })(document, "script", "standard-instacart-widget-v1");
								</script>

								<div id="shop-with-instacart-v1"></div>

								<?php } else { ?>

                                <div class="text_2 fmc_mpr_content fmc_mpr_ing"><?php the_field('ingredients'); ?></div>

								<? } ?>
                                <?php if ($include_steps) : ?>
                                    <h4 class="fmc_mpr_subtitle"><?php the_field('steps_title'); ?></h4>
                                    <div class="text_2 fmc_mpr_content fmc_mpr_steps">
                                        <div class="fmc_recipe_steps">
                                            <div class="fmc_steps">
                                                <?php
                                                // Check rows existexists.
                                                if (have_rows('steps')) :
                                                    $item = 1;
                                                    // Loop through rows.
                                                    while (have_rows('steps')) : the_row();

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
                    $meal_counter++;
                endwhile;

            endif; ?>

            <?php dynamic_sidebar('ad7'); ?>

            <?php if (have_rows('custom_recipe')) : // Custom Recipes

                // Loop through rows.
                while (have_rows('custom_recipe')) : the_row();

                    $recipe_title = get_sub_field('recipe_title');

                    $cr_prep_hours = get_sub_field('cr_prep_hours');
					$cr_prep_time = get_sub_field('cr_prep_time');
                    $cr_cook_hours = get_sub_field('cr_cook_hours');
					$cr_cook_time = get_sub_field('cr_cook_time');
                    $cr_total_hours = get_sub_field('cr_total_hours');
					$cr_total_time = get_sub_field('cr_total_time');

                    $cr_calories = get_sub_field('cr_calories');
                    $cr_protein = get_sub_field('cr_protein');
                    $cr_fat = get_sub_field('cr_fat');
                    $cr_carbs = get_sub_field('cr_carbs');
                    $cr_sodium = get_sub_field('cr_sodium');
                    $cr_fiber = get_sub_field('cr_fiber');
                    $cr_sugar = get_sub_field('cr_sugar'); ?>

                    <div class="fmc_mp_recipe">
                        <div class="fmc_mpr_top">
                            <span class="recipe_no"><?php echo __('Recipe', 'fitmencook') . ' ' . $meal_counter; ?></span>
                            <h2 class="fmc_mpr_title fmc_title_3"><?php echo $recipe_title; ?></h2>
                        </div>
                        <div class="fmc_recipe_times">
							<?php if(!empty($cr_prep_time || $cr_prep_hours)): ?>
								<div class="fmc_time_wrap fmc_prep">
									<span class="fmc_time"><?php echo $l_prep_time; ?></span>
									<span class="fmc_amount">
										<?php if($cr_prep_hours) { ?>
											<?php echo $cr_prep_hours ?>h
										<?php } ?>
										<?php echo $cr_prep_time; ?><?php echo $minutes ?>
									</span>
								</div>
							<?php endif; ?>

							<?php if(!empty($cr_cook_time || $cr_cook_hours)): ?>
								<div class="fmc_time_wrap fmc_cook">
									<span class="fmc_time"><?php echo $l_cook_time; ?></span>
									<span class="fmc_amount">
										<?php if($cr_cook_hours) { ?>
											<?php echo $cr_cook_hours ?>h
										<?php } ?>
										<?php echo $cr_cook_time; ?><?php echo $minutes ?>
									</span>
								</div>
							<?php endif; ?>

							<?php if(!empty($cr_total_time || $cr_total_hours)): ?>
								<div class="fmc_time_wrap fmc_total">
									<span class="fmc_time"><?php echo $l_total_time; ?></span>
									<span class="fmc_amount">
										<?php if($cr_total_hours) { ?>
											<?php echo $cr_total_hours ?>h
										<?php } ?>
										<?php echo $cr_total_time; ?><?php echo $minutes ?>
									</span>
								</div>
							<?php endif; ?>

                            <div class="fmc_cals">
                                <?php if ($cr_calories) { ?>
                                    <?php echo $cr_calories ?>cal
                                <?php } ?>
                            </div>
                        </div>
						<?php
						$custom_ingredients = get_sub_field('custom_ingredients');
						$custom_nos = get_sub_field('number_of_servings');
						$custom_ss = get_sub_field('serving_size');
						if($custom_ingredients): ?>
                        <h4 class="fmc_mpr_subtitle"><?php the_sub_field('ingredients_title'); ?></h4>
						<?php if($custom_nos) { ?>
						<div class="fmc_ing_servings"><?php echo $custom_nos ?> <?php echo $nosi; ?></div>
						<?php } ?>
						<?php if($custom_ss) { ?>
						<div class="fmc_ing_servings_size"><?php echo $l_serving_size; ?>:<span><?php echo $custom_ss ?></span></div>
						<?php } ?>

						<?php // Instacart Ingredients

						if( get_sub_field('ingredients_switch') ) { ?>
						<div class="fmc_ingredients">
							<?php

							if( have_rows('ing_group') ): ?>

								<?php while( have_rows('ing_group') ) : the_row(); ?>
								<?php $ing_title = get_sub_field('ing_g_title'); ?>
								<?php if( $ing_title ) { ?>
									<strong><?php echo $ing_title; ?></strong>
								<?php } ?>
								<ul>
								<?php while( have_rows('ingredients_instacart') ) : the_row(); ?>

									<?php
									$ingredient = get_sub_field('ingredient');
									$ingredient_link = get_sub_field('ingredient_link');
									$note = get_sub_field('note');
									$substitution = get_sub_field('substitution');
									?>
									<li>

									<?php if( $ingredient_link ) { ?>
										<a href="<?php echo $ingredient_link; ?>" target="_blank">
									<?php } ?>
									<?php echo $ingredient; ?>
									<?php if( $ingredient_link ) { ?>
										</a>
									<?php } ?>



									<?php if( $note || $substitution ) : ?>
										<ul>
											<?php if( $note ) { ?>
											<li><?php echo $note; ?></li>
											<?php } ?>
											<?php if( $substitution ) { ?>
											<li><?php echo $substitution; ?></li>
											<?php } ?>
										</ul>
									<?php endif; ?>
								</li>
								<?php endwhile; ?>
								</ul>

								<?php endwhile; ?>

							<?php endif; ?>
						</div>
						<script>
						(function (d, s, id) { var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) { return; } js = d.createElement(s); js.id = id; js.src = "https://widgets.instacart.com/widget-bundle.js"; js.async = true; fjs.parentNode.insertBefore(js, fjs); })(document, "script", "standard-instacart-widget-v1");
						</script>

						<div id="shop-with-instacart-v1"></div>

						<?php } // End Instacart ingredients
						else { ?>
                        <div class="text_2 fmc_mpr_content fmc_mpr_ing"><?php echo $custom_ingredients ?></div>
						<?php }  ?>
						<?php endif; ?>
						<?php
						$steps_title = get_sub_field('steps_title');
						// Check rows existexists.
						if (have_rows('cr_steps')) : ?>
						<h4 class="fmc_mpr_subtitle"><?php echo $steps_title; ?></h4>
                        <div class="text_2 fmc_mpr_content fmc_mpr_steps">
                            <div class="fmc_recipe_steps">
                                <div class="fmc_steps">
                                        <?php $item = 1;
                                        // Loop through rows.
                                        while (have_rows('cr_steps')) : the_row();

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

                                        endwhile; ?>
										</div>
										</div>
									</div>
                                   <?php  endif; ?>

                        <!-- Macros -->
                        <div class="fmc_macros">
                            <h4 class="fmc_rs_title fmc_macros_title"><?php echo $macros_title; ?></h4>
							<?php if ($cr_calories) { ?>
                                <div class="fmc_macro"><?php echo $l_calories ?><span><?php echo $cr_calories ?>cal</span></div>
                            <?php } ?>
                            <?php if ($cr_protein) { ?>
                                <div class="fmc_macro"><?php echo $l_protein ?><span><?php echo $cr_protein ?>g</span></div>
                            <?php } ?>
                            <?php if ($cr_fat) { ?>
                                <div class="fmc_macro"><?php echo $l_fat ?><span><?php echo $cr_fat ?>g</span></div>
                            <?php } ?>
                            <?php if ($cr_carbs) { ?>
                                <div class="fmc_macro"><?php echo $l_carbs ?><span><?php echo $cr_carbs ?>g</span></div>
                            <?php } ?>
                            <?php if ($cr_sodium) { ?>
                                <div class="fmc_macro"><?php echo $l_sodium ?><span><?php echo $cr_sodium ?>mg</span></div>
                            <?php } ?>
                            <?php if ($cr_fiber) { ?>
                                <div class="fmc_macro"><?php echo $l_fiber ?><span><?php echo $cr_fiber ?>g</span></div>
                            <?php } ?>
                            <?php if ($cr_sugar) { ?>
                                <div class="fmc_macro"><?php echo $l_sugar ?><span><?php echo $cr_sugar ?>g</span></div>
                            <?php } ?>
                        </div>
                    </div>

            <?php
                    $meal_counter++;
                endwhile;

            endif; ?>

            <?php dynamic_sidebar('ad8'); ?>

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
            <div class="fmc_sidebar_rating">
                <?php echo get_avarage_rating(get_the_ID(), 'sidebar'); ?>
            </div>

            <h4 class="fmc_rs_title fmc_times_title"><?php echo $times_title; ?></h4>

			<?php if ($calculations['total_times']) : ?>

                <div class="fmc_recipe_times">

                    <?php
                    foreach ($calculations['total_times'] as $single_time) :

                    ?>
                        <?php if($single_time['hours'] || $single_time['min']): ?>

                        <div class="fmc_prep">
                            <span class="fmc_time"><?php echo $single_time['label']; ?></span>

                            <?php if($single_time['hours']): ?>

                            <span class="fmc_amount"><?php echo $single_time['hours']; ?></span>

                            <?php endif; ?>

                            <?php if($single_time['min']): ?>
                            <span class="fmc_amount"><?php echo $single_time['min']; ?></span>

                            <?php endif; ?>

                        </div>

                        <?php endif; ?>

                    <?php

                    endforeach;
                    ?>

                </div>

            <?php endif; ?>

            <!-- Macros -->
            <?php
            if ($calculations['totals']) : $count_calculations = 1; ?>
                <div class="fmc_macros">
                    <?php foreach ($calculations['totals'] as $label => $total) : if($total === 0) continue; ?>
                        <div class="fmc_macro<?php if($count_calculations === 1) echo ' calories'; ?>"> <?php echo __('Total', 'fitmenCook') . ' ' . $label . ':' ?> <span class="fmc_total_number"> <?php echo $total; ?></span></div>
                    <?php $count_calculations++; endforeach; ?>
                </div>
            <?php endif;
            ?>

            <!-- Share -->
            <div class="fmc_share fmc_recipe_share spacing_3_0">

               <!--  <div class="fmc_print"><a title="Print" href="<?php echo get_the_permalink() . "?print=true"; ?>"><span class="fmc_icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path d="M128 0C92.7 0 64 28.7 64 64v96h64V64H354.7L384 93.3V160h64V93.3c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0H128zM384 352v32 64H128V384 368 352H384zm64 32h32c17.7 0 32-14.3 32-32V256c0-35.3-28.7-64-64-64H64c-35.3 0-64 28.7-64 64v96c0 17.7 14.3 32 32 32H64v64c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V384zm-16-88c-13.3 0-24-10.7-24-24s10.7-24 24-24s24 10.7 24 24s-10.7 24-24 24z" />
                            </svg></span></a></div> -->

                <div class="fmc_fb"><a title="Share to Facebook" href="http://www.facebook.com/sharer.php?u=<?php echo  get_permalink() ?>"><span class="fmc_icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#101828" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                            </svg></span></a>
				</div>

                <div class="fmc_pin"><a title="Pin" href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink($post->ID)); ?>"></a><span class="fmc_icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                            <path d="M204 6.5C101.4 6.5 0 74.9 0 185.6 0 256 39.6 296 63.6 296c9.9 0 15.6-27.6 15.6-35.4 0-9.3-23.7-29.1-23.7-67.8 0-80.4 61.2-137.4 140.4-137.4 68.1 0 118.5 38.7 118.5 109.8 0 53.1-21.3 152.7-90.3 152.7-24.9 0-46.2-18-46.2-43.8 0-37.8 26.4-74.4 26.4-113.4 0-66.2-93.9-54.2-93.9 25.8 0 16.8 2.1 35.4 9.6 50.7-13.8 59.4-42 147.9-42 209.1 0 18.9 2.7 37.5 4.5 56.4 3.4 3.8 1.7 3.4 6.9 1.5 50.4-69 48.6-82.5 71.4-172.8 12.3 23.4 44.1 36 69.3 36 106.2 0 153.9-103.5 153.9-196.8C384 71.3 298.2 6.5 204 6.5z" />
                        </svg></span></div>

						<div class="fmc_x"><a title="Tweet" href="http://twitter.com/share?text=<?php echo get_the_title(); ?>&url=<?php echo get_permalink(); ?>"><span class="fmc_icon"><svg width="20" height="20" viewBox="0 0 300 300" version="1.1" xmlns="http://www.w3.org/2000/svg">
  <path d="M178.57 127.15 290.27 0h-26.46l-97.03 110.38L89.34 0H0l117.13 166.93L0 300.25h26.46l102.4-116.59 81.8 116.59h89.34M36.01 19.54H76.66l187.13 262.13h-40.66"/>
</svg></span></a></div>

                <div class="fmc_email"><a title="Email" href="mailto:?subject=<?php echo get_the_title(); ?>&body=<?php echo get_the_title() . ' ' . get_permalink(); ?>"><span class="fmc_icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path d="M64 112c-8.8 0-16 7.2-16 16v22.1L220.5 291.7c20.7 17 50.4 17 71.1 0L464 150.1V128c0-8.8-7.2-16-16-16H64zM48 212.2V384c0 8.8 7.2 16 16 16H448c8.8 0 16-7.2 16-16V212.2L322 328.8c-38.4 31.5-93.7 31.5-132 0L48 212.2zM0 128C0 92.7 28.7 64 64 64H448c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128z" />
                            </svg></span></a></div>

            </div>
			<!-- Jump to recipe -->
		<div class="jtr_wrap">
			<a class="fmc_jtr" href="#fmc_recipe_content"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M19.5949 21.6112L18.4942 13.3557H18.5249C18.8481 13.3557 19.1101 13.0937 19.1101 12.7704V0.870088C19.1101 0.664449 19.0026 0.474666 18.8269 0.368794C18.6512 0.262823 18.4331 0.256569 18.2518 0.352298C15.9697 1.55649 14.541 3.92419 14.541 6.50531V11.5231C14.541 12.5351 15.3617 13.3556 16.3737 13.3556H16.5125L15.4118 21.6112C15.3318 22.2137 15.5154 22.8225 15.9155 23.2798C16.3164 23.7373 16.8954 24 17.5034 24C18.1113 24 18.6903 23.7373 19.0913 23.2798C19.4914 22.8226 19.6749 22.2138 19.5949 21.6112Z" fill="#FF885C"/>
			<path d="M10.4242 0C9.98016 0 9.62083 0.359326 9.62083 0.803301V5.29072H8.81748V0.803301C8.81748 0.359326 8.45816 0 8.01413 0C7.57011 0 7.21083 0.359326 7.21083 0.803301V5.29072H6.40748V0.803301C6.40743 0.359326 6.04811 0 5.60413 0C5.16006 0 4.80078 0.359326 4.80078 0.803301V5.29072V6.02508V8.05384C4.80078 9.24552 5.76648 10.2112 6.95817 10.2112H7.13623L5.87009 21.6049C5.80263 22.2144 5.99793 22.824 6.40664 23.2814C6.8162 23.7388 7.40066 24 8.01418 24C8.6277 24 9.21212 23.7388 9.62172 23.2814C10.0305 22.824 10.2258 22.2144 10.1583 21.6049L8.89209 10.2113H9.0702C10.2618 10.2113 11.2276 9.24557 11.2276 8.05389V6.02513V5.29077V0.803301C11.2275 0.359326 10.8682 0 10.4242 0Z" fill="#FF885C"/>
			</svg>Jump to Recipe</a>
		</div>
        </div>

		<div class="atm-ad-slot" data-slot-type="rail-ad"></div>

    </div>

</div>

<!-- Author -->
<?php get_template_part('template-parts/author'); ?>

<!-- Related -->
<?php if (is_singular('meal-plans')) {
	get_template_part('template-parts/related-meal-plans');
} ?>
<?php if (is_singular('multiple-recipes')) {
	get_template_part('template-parts/related-multiple-recipes');
} ?>

<script type="text/javascript">
    (function() {
        window.PinIt = window.PinIt || {
            loaded: false
        };
        if (window.PinIt.loaded) return;
        window.PinIt.loaded = true;

        function async_load() {
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
