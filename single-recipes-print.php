<head>
<link rel="stylesheet" href="/wp-content/themes/fitmencook/main.css"
type="text/css" media="screen, print" />
<meta name="robots" content="noindex">
</head>

<?php
$prep_hours = get_field('prep_hours');
$prep_time = get_field('prep_time');
$cook_hours = get_field('cook_hours');
$cook_time = get_field('cook_time');
$total_time = get_field('total_time');
$total_hours = get_field('total_hours');

$l_prep_time = get_field('l_prep_time', 'option');
$l_cook_time = get_field('l_cook_time', 'option');
$l_total_time = get_field('l_total_time', 'option');

$minutes = get_field('minutes', 'option');

$ingredients = get_field('ingredients');

$calories = get_field('calories');
$protein = get_field('protein');
$fat = get_field('fat');
$carbs = get_field('carbs');
$sodium = get_field('sodium');
$fiber = get_field('fiber');
$sugar = get_field('sugar');

$l_calories = get_field('l_calories', 'option');
$l_protein = get_field('l_protein', 'option');
$l_fat = get_field('l_fat', 'option');
$l_carbs = get_field('l_carbs', 'option');
$l_sodium = get_field('l_sodium', 'option');
$l_fiber = get_field('l_fiber', 'option');
$l_sugar = get_field('l_sugar', 'option');


?>

<div class="fmc_print_template">
	<div class="fmc_pt_btns">
		<a onclick="history.back();" class="fmc_btn">Go Back</a>
		<a onclick="window.print();" class="fmc_btn">Print</a>
	</div>
	<div class="fmc_pt_inner">
		<div class="fmc_pt_hero">
			<div class="fmc_pt_hero_left">
				<?php the_custom_logo(); ?>
			</div>
			<div class="fmc_pt_hero_right">
				<h1><?php the_title(); ?></h1>
				<div class="fmc_recipe_times">
			<?php if($prep_time) { ?>
				<div class="fmc_prep"><strong><?php echo $l_prep_time ?>: </strong>
					<?php if($prep_hours) { ?>
						<span>
							<?php echo $prep_hours ?>h
						</span>
					<?php } ?>
				<span><?php echo $prep_time?> <?php echo $minutes ?></span></div>
			<?php } ?>
			<?php if($cook_time) { ?>
				<div class="fmc_cook"><strong><?php echo $l_cook_time ?>: </strong>
					<?php if($cook_hours) { ?>
						<span>
							<?php echo $cook_hours ?>h
						</span>
					<?php } ?>
				<span><?php echo $cook_time ?> <?php echo $minutes ?></span></div>
			<?php } ?>
			<?php if($total_time) { ?>
				<div class="fmc_total"><strong><?php echo $l_total_time ?>: </strong>
				<?php if($total_hours) { ?>
						<span>
							<?php echo $total_hours ?>h
						</span>
					<?php } ?>
				<span><?php echo $total_time ?> <?php echo $minutes ?></span></div>
			<?php } ?>
		</div>
			</div>
		</div>
		<div class="fmc_pt_main">
			<div class="fmc_ingredients">

				<?php // Instacart Ingredients

				if( get_field('ingredients_switch') ) { ?>
				<h4><?php the_field('ingredients_title'); ?></h4>
				<?php get_template_part('template-parts/recipe/instacart-ingredients'); ?>

				<?php } else {

				if( $ingredients ) { ?>
				<h4><?php the_field('ingredients_title'); ?></h4>
				<div class="fmc_recipe_ingredients spacing_0_3" id="fmc_gtr">

					<div class="fmc_ingredients">
						<?php echo $ingredients; ?>
					</div>
				</div>
				<?php }
				} ?>
			</div>

			<?php
			// Check rows existexists.
			if( have_rows('steps') ): ?>
				<h4><?php the_field('steps_title'); ?></h4>
				<?php $item = 1;
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


<!-- Multiple -->

<?php

$meal_counter = 1;

$noss = get_field('number_of_servings_sidebar', 'option');
$servings_number = get_field('number_of_servings');
$serving_size = get_field('serving_size');
$l_serving_size = get_field('l_serving_size', 'option');

$nos_single = get_field('number_of_servings_ing_single', 'option');
$nosi = get_field('number_of_servings_ing', 'option');

?>

<div class="fmc_print_template">
<div class="fmc_pt_inner">
<div class="fmc_pt_main">
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
							$servings_number = get_field('number_of_servings');
							$serving_size = get_field('serving_size');
                        ?>

                            <div class="fmc_mp_recipe">
                                <div class="fmc_mpr_top">
                                    <span class="recipe_no"><?php echo __('Recipe', 'fitmencook') . ' ' . $meal_counter; ?></span>
                                    <h2 class="fmc_mpr_title fmc_title_3"><?php the_title(); ?></h2>
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
                                </div>
								<div class="fmc_ingredients">
								<?php
								$ingredients_title = get_field('ingredients_title');
								if($ingredients_title) : ?>
                                <h4 class="fmc_mpr_subtitle"><?php echo $ingredients_title ?></h4>
								<?php endif; ?>
								<?php if($servings_number) { ?>
									<div class="fmc_ing_servings"><?php echo $servings_number ?>
										<?php if($servings_number == 1) {
											echo $nos_single;
										} else {
											echo $nosi;
										} ?>
									</div>
								<?php } ?>
								<?php if($serving_size) { ?>
								<div class="fmc_ing_servings_size"><?php echo $l_serving_size; ?>:<span><?php echo $serving_size ?></span></div>
								<?php } ?>

								<!-- Ingredients -->

								<?php // Instacart Ingredients

								if( get_field('ingredients_switch') ) { ?>

								<?php get_template_part('template-parts/recipe/instacart-ingredients'); ?>

								<?php } else { ?>

                                <div class="text_2 fmc_mpr_content fmc_mpr_ing"><?php the_field('ingredients'); ?></div>
								</div>
								<?php } ?>
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

	$cr_prep_hours = get_sub_field('cr_prep_hours');
	$cr_prep_time = get_sub_field('cr_prep_time');
	$cr_cook_hours = get_sub_field('cr_cook_hours');
	$cr_cook_time = get_sub_field('cr_cook_time');
	$cr_total_hours = get_sub_field('cr_total_hours');
	$cr_total_time = get_sub_field('cr_total_time');
?>

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

		</div>
		<?php
		$custom_ingredients = get_sub_field('custom_ingredients');
		$custom_nos = get_sub_field('number_of_servings');
		$custom_ss = get_sub_field('serving_size'); ?>
		<h4 class="fmc_mpr_subtitle"><?php the_sub_field('ingredients_title'); ?></h4>
		<?php if($custom_nos) { ?>
			<div class="fmc_ing_servings"><?php echo $custom_nos ?>
				<?php if($custom_nos == 1) {
					echo $nos_single;
				} else {
					echo $nosi;
				} ?>
			</div>
		<?php } ?>
		<?php if($custom_ss) { ?>
		<div class="fmc_ing_servings_size"><?php echo $l_serving_size; ?>:<span><?php echo $custom_ss ?></span></div>
		<?php } ?>

		<?php // Instacart Ingredients

		if( get_sub_field('ingredients_switch') ) { ?>

		<?php get_template_part('template-parts/recipe/instacart-ingredients'); ?>


		<?php } // End Instacart ingredients
		else { ?>
		<div class="text_2 fmc_mpr_content fmc_mpr_ing"><?php echo $custom_ingredients ?></div>
		<?php }  ?>
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

	</div>

<?php
	$meal_counter++;
endwhile;

endif; ?>

</div>
</div>
</div>
