<?php


// Check rows existexists.
if( have_rows('additional_recipe') ):

$l_prep_time = get_field('l_prep_time', 'option');
$l_cook_time = get_field('l_cook_time', 'option');
$l_total_time = get_field('l_total_time', 'option');

$minutes = get_field('minute_plural', 'option');

$l_calories = get_field('l_calories', 'option');
$l_protein = get_field('l_protein', 'option');
$l_fat = get_field('l_fat', 'option');
$l_carbs = get_field('l_carbs', 'option');
$l_sodium = get_field('l_sodium', 'option');
$l_fiber = get_field('l_fiber', 'option');
$l_sugar = get_field('l_sugar', 'option');

// Loop through rows.
while( have_rows('additional_recipe') ) : the_row();

$prep_time = get_sub_field('prep_time');
$cook_time = get_sub_field('cook_time');
$total_time = get_sub_field('total_time');

$calories = get_sub_field('calories');
$protein = get_sub_field('protein');
$fat = get_sub_field('fat');
$carbs = get_sub_field('carbs');
$sodium = get_sub_field('sodium');
$fiber = get_sub_field('fiber');
$sugar = get_sub_field('sugar');


?>

	<div class="fmc_recipe_hero fmc_additional_recipe_hero">
		<div class="fmc_container">
			<h1 class="fmc_pt_title">
				<?php the_sub_field('title'); ?>
			</h1>
			<div class="fmc_recipe_times">
				<?php if($prep_time) { ?>
					<div class="fmc_prep"><span class="fmc_icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M232 120C232 106.7 242.7 96 256 96C269.3 96 280 106.7 280 120V243.2L365.3 300C376.3 307.4 379.3 322.3 371.1 333.3C364.6 344.3 349.7 347.3 338.7 339.1L242.7 275.1C236 271.5 232 264 232 255.1L232 120zM256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0zM48 256C48 370.9 141.1 464 256 464C370.9 464 464 370.9 464 256C464 141.1 370.9 48 256 48C141.1 48 48 141.1 48 256z"/></svg></span><?php echo $l_prep_time ?>: <span><?php echo $prep_time?> <?php echo $minutes ?></span></div>
				<?php } ?>
				<?php if($cook_time) { ?>
					<div class="fmc_cook"><?php echo $l_cook_time ?>: <span><?php echo $cook_time ?> <?php echo $minutes ?></span></div>
				<?php } ?>
				<?php if($total_time) { ?>
					<div class="fmc_total"><?php echo $l_total_time ?>: <span><?php echo $total_time ?> <?php echo $minutes ?></span></div>
				<?php } ?>
			</div>
		</div>
	</div>

	<div class="fmc_container fmc_macros" id="fmc_gtr">
		<div class="fmc_macro"><div class="fmc_macro_inner"><?php echo $l_calories ?><span><?php echo $calories ?></span></div></div>
		<div class="fmc_macro"><div class="fmc_macro_inner"><?php echo $l_protein ?><span><?php echo $protein ?></span></div></div>
		<div class="fmc_macro"><div class="fmc_macro_inner"><?php echo $l_fat ?><span><?php echo $fat ?></span></div></div>
		<div class="fmc_macro"><div class="fmc_macro_inner"><?php echo $l_carbs ?><span><?php echo $carbs ?></span></div></div>
		<div class="fmc_macro"><div class="fmc_macro_inner"><?php echo $l_sodium ?><span><?php echo $sodium ?></span></div></div>
		<div class="fmc_macro"><div class="fmc_macro_inner"><?php echo $l_fiber ?><span><?php echo $fiber ?></span></div></div>
		<div class="fmc_macro"><div class="fmc_macro_inner"><?php echo $l_sugar ?><span><?php echo $sugar?></span></div></div>
	</div>

	<div class="fmc_container fmc_recipe_main">
	<div class="fmc_recipe_main_ingredients">
		<h4 class="fmc_main_title title_spacing_2"><?php the_sub_field('ingredients_title'); ?></h4>
		<div class="fmc_ingredients">
			<?php the_sub_field('ingredients'); ?>
		</div>
	</div>
	<div class="fmc_recipe_main_steps">
	<h4 class="fmc_main_title title_spacing_2"><?php the_sub_field('steps_title'); ?></h4>
		<div class="fmc_steps">
			<?php the_sub_field('steps'); ?>
		</div>
	</div>
</div>
<div class="fmc_container spacing_2 fmc_additional_macro">
		<?php the_sub_field('additional_macro_information'); ?>
	</div>
<?php
// End loop.
endwhile;

endif;
