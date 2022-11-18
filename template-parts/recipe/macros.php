<?php

$prep_time = get_field('prep_time');
$cook_time = get_field('cook_time');
$total_time = get_field('total_time');

$l_prep_time = get_field('l_prep_time', 'option');
$l_cook_time = get_field('l_cook_time', 'option');
$l_total_time = get_field('l_total_time', 'option');

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


<div class="fmc_container fmc_macros">
	<div class="fmc_macro"><div class="fmc_macro_inner"><?php echo $l_calories ?><span><?php echo $calories ?></span></div></div>
	<div class="fmc_macro"><div class="fmc_macro_inner"><?php echo $l_protein ?><span><?php echo $protein ?></span></div></div>
	<div class="fmc_macro"><div class="fmc_macro_inner"><?php echo $l_fat ?><span><?php echo $fat ?></span></div></div>
	<div class="fmc_macro"><div class="fmc_macro_inner"><?php echo $l_carbs ?><span><?php echo $carbs ?></span></div></div>
	<div class="fmc_macro"><div class="fmc_macro_inner"><?php echo $l_sodium ?><span><?php echo $sodium ?></span></div></div>
	<div class="fmc_macro"><div class="fmc_macro_inner"><?php echo $l_fiber ?><span><?php echo $fiber ?></span></div></div>
	<div class="fmc_macro"><div class="fmc_macro_inner"><?php echo $l_sugar ?><span><?php echo $sugar?></span></div></div>
</div>
