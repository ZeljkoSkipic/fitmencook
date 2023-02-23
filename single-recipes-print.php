<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>"
type="text/css" media="screen, print" />


<?php $prep_time = get_field('prep_time');
$cook_time = get_field('cook_time');
$total_time = get_field('total_time');

$l_prep_time = get_field('l_prep_time', 'option');
$l_cook_time = get_field('l_cook_time', 'option');
$l_total_time = get_field('l_total_time', 'option');

$minute = get_field('minute_single', 'option');
$minutes = get_field('minute_plural', 'option');

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
				<?php the_post_thumbnail(); ?>
			</div>
			<div class="fmc_pt_hero_right">
				<h1><?php the_title(); ?></h1>
				<strong>Categories</strong>: <?php the_category(); ?>
				<div class="fmc_recipe_times">
			<?php if($prep_time) { ?>
				<div class="fmc_prep"><strong><?php echo $l_prep_time ?>: </strong><span><?php echo $prep_time?> <?php echo $minutes ?></span></div>
			<?php } ?>
			<?php if($cook_time) { ?>
				<div class="fmc_cook"><strong><?php echo $l_cook_time ?>: </strong><span><?php echo $cook_time ?> <?php echo $minutes ?></span></div>
			<?php } ?>
			<?php if($total_time) { ?>
				<div class="fmc_total"><strong><?php echo $l_total_time ?>: </strong><span><?php echo $total_time ?> <?php echo $minutes ?></span></div>
			<?php } ?>
		</div>
			</div>
		</div>
		<div class="fmc_pt_main">
			<div class="fmc_pt_ingredients">
				<h4><?php the_field('ingredients_title'); ?></h4>
				<?php the_field('ingredients'); ?>
			</div>
			<h4><?php the_field('steps_title'); ?></h4>
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
