<?php

$calories = get_field_object('calories');
$protein = get_field_object('protein');
$fat = get_field_object('fat');
$carbs = get_field_object('carbs');
$sodium = get_field_object('sodium');
$fiber = get_field_object('fiber');
$sugar = get_field_object('sugar'); ?>


<div class="fmc_container fmc_macros">
	<div class="fmc_macro"><div class="fmc_macro_inner"><?php echo $calories['label'] ?><span><?php echo $calories['value'] ?></span></div></div>
	<div class="fmc_macro"><div class="fmc_macro_inner"><?php echo $protein['label'] ?><span><?php echo $protein['value'] ?></span></div></div>
	<div class="fmc_macro"><div class="fmc_macro_inner"><?php echo $fat['label'] ?><span><?php echo $fat['value'] ?></span></div></div>
	<div class="fmc_macro"><div class="fmc_macro_inner"><?php echo $carbs['label'] ?><span><?php echo $carbs['value'] ?></span></div></div>
	<div class="fmc_macro"><div class="fmc_macro_inner"><?php echo $sodium['label'] ?><span><?php echo $sodium['value'] ?></span></div></div>
	<div class="fmc_macro"><div class="fmc_macro_inner"><?php echo $fiber['label'] ?><span><?php echo $fiber['value'] ?></span></div></div>
	<div class="fmc_macro"><div class="fmc_macro_inner"><?php echo $sugar['label'] ?><span><?php echo $sugar['value'] ?></span></div></div>
</div>
