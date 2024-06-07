<?php

$prep_time = get_field('prep_time');
$cook_time = get_field('cook_time');
$total_time = get_field('total_time');

$l_prep_time = get_field('l_prep_time', 'option');
$l_cook_time = get_field('l_cook_time', 'option');
$l_total_time = get_field('l_total_time', 'option');

$macros_title = get_field('macros_title', 'option');

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

<table>
<tr>
	<h4><?php echo $macros_title; ?></h4>
</tr>
</table>
<table style="width: 100%; margin-bottom: 32px">

	<tr>
		<?php if ($calories) : ?>
			<td style="width: 14%">
				<?php echo $l_calories; ?>
			</td>

		<?php endif; ?>

		<?php if ($protein) : ?>

			<td style="width: 14%">
				<?php echo $l_protein; ?>
			</td>

		<?php endif; ?>

		<?php if ($fat) : ?>

			<td style="width: 14%">
				<?php echo $l_fat; ?>
			</td>

		<?php endif; ?>

		<?php if ($carbs) : ?>

			<td style="width: 14%">
				<?php echo $l_carbs; ?>
			</td>

		<?php endif; ?>

		<?php if ($sodium) : ?>

			<td style="width: 14%">
				<?php echo $l_sodium; ?>
			</td>

		<?php endif; ?>

		<?php if ($fiber) : ?>

			<td style="width: 14%">
				<?php echo $l_fiber; ?>
			</td>

		<?php endif; ?>

		<?php if ($sugar) : ?>

			<td style="width: 14%">
				<?php echo $l_sugar; ?>
			</td>

		<?php endif; ?>

	</tr>
	<tr>
		<?php if ($calories) : ?>
			<td style="width: 14%">
				<?php echo $calories; ?>cal
			</td>

		<?php endif; ?>

		<?php if ($protein) : ?>

			<td style="width: 14%">
				<?php echo $protein; ?>g
			</td>

		<?php endif; ?>

		<?php if ($fat) : ?>

			<td style="width: 14%">
				<?php echo $fat; ?>g
			</td>

		<?php endif; ?>

		<?php if ($carbs) : ?>

			<td style="width: 14%">
				<?php echo $carbs; ?>g
			</td>

		<?php endif; ?>

		<?php if ($sodium) : ?>

			<td style="width: 14%">
				<?php echo $sodium; ?>mg
			</td>

		<?php endif; ?>

		<?php if ($fiber) : ?>

			<td style="width: 14%">
				<?php echo $fiber; ?>g
			</td>

		<?php endif; ?>

		<?php if ($sugar) : ?>

			<td style="width: 14%">
				<?php echo $sugar; ?>g
			</td>

		<?php endif; ?>
	</tr>
</table>
