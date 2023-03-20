<?php

$prep_time = get_field('prep_time');
$cook_time = get_field('cook_time');
$total_time = get_field('total_time');

$l_prep_time = get_field('l_prep_time', 'option');
$l_cook_time = get_field('l_cook_time', 'option');
$l_total_time = get_field('l_total_time', 'option');

$macros_title = get_field('macros_title', 'option');
$noss = get_field('number_of_servings_sidebar', 'option');
$servings_number = get_field('number_of_servings');
$serving_size = get_field('serving_size');
$l_serving_size = get_field('l_serving_size', 'option');


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


<div class="fmc_macros">
	<?php if($servings_number) { ?>
	<div class="fmc_macro fmc_nos"><?php echo $noss; ?><span><?php echo $servings_number ?></span></div>
	<?php } ?>
	<?php if($serving_size) { ?>
	<div class="fmc_macro fmc_ss"><?php echo $l_serving_size; ?>:<span><?php echo $serving_size ?></span></div>
	<?php } ?>
	<h4 class="fmc_rs_title fmc_macros_title"><?php echo $macros_title; ?></h4>
	<?php if($calories) { ?>
		<div class="fmc_macro fmc_macro_cals"><?php echo $l_calories ?><span><?php echo $calories ?>cal</span></div>
	<?php } ?>
	<?php if($protein) { ?>
		<div class="fmc_macro"><?php echo $l_protein ?><span><?php echo $protein ?>g</span></div>
	<?php } ?>
	<?php if($fat) { ?>
		<div class="fmc_macro"><?php echo $l_fat ?><span><?php echo $fat ?>g</span></div>
	<?php } ?>
	<?php if($carbs) { ?>
		<div class="fmc_macro"><?php echo $l_carbs ?><span><?php echo $carbs ?>g</span></div>
	<?php } ?>
	<?php if($sodium) { ?>
		<div class="fmc_macro"><?php echo $l_sodium ?><span><?php echo $sodium ?>mg</span></div>
	<?php } ?>
	<?php if($fiber) { ?>
		<div class="fmc_macro"><?php echo $l_fiber ?><span><?php echo $fiber ?>g</span></div>
	<?php } ?>
	<?php if($sugar) { ?>
		<div class="fmc_macro"><?php echo $l_sugar ?><span><?php echo $sugar?>g</span></div>
	<?php } ?>
</div>
