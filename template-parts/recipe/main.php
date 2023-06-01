<?php

$ingredients = get_field('ingredients');

$nosi = get_field('number_of_servings_ing', 'option');
$servings_number = get_field('number_of_servings');

$serving_size = get_field('serving_size');
$l_serving_size = get_field('l_serving_size', 'option');


if( $ingredients ) { ?>

<div class="fmc_recipe_ingredients spacing_0_3" id="fmc_gtr">
	<h4 class="fmc_title_3 title_spacing_3"><?php the_field('ingredients_title'); ?></h4>
	<?php if($servings_number) { ?>
	<div class="fmc_ing_servings"><?php echo $servings_number ?> <?php echo $nosi; ?></div>
	<?php } ?>
	<?php if($serving_size) { ?>
	<div class="fmc_ing_servings_size"><?php echo $l_serving_size; ?>:<span><?php echo $serving_size ?></span></div>
	<?php } ?>
	<div class="fmc_ingredients">
		<?php echo $ingredients; ?>
	</div>
</div>
<?php }
dynamic_sidebar( 'ad3' ); ?>

<?php
// Check rows existexists.
if( have_rows('steps') ): ?>
<div class="fmc_recipe_steps">
	<h4 class="fmc_title_3 title_spacing_3"><?php the_field('steps_title'); ?></h4>
	<div class="fmc_steps">
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
	endwhile; ?>
	</div>
</div>

<?php endif; ?>


<?php dynamic_sidebar( 'ad4' ); ?>
