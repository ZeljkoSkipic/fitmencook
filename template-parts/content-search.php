<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fitmencook
 */

?>

<div class="fmc_recipe">
	<figure>
		<?php the_post_thumbnail('thumbnail'); ?>
	</figure>
	<h3>
		<a href="<?php the_permalink(); ?>">
		<?php the_title(); ?>
		</a>
	</h3>
	<span class="calories"><?php the_field('calories'); ?> <?php the_field('l_calories', 'option'); ?></span>
	<div class="details_1">
		<div class="carbs"><?php the_field('l_carbs', 'option'); ?><span><?php the_field('carbs'); ?></span></div>
		<div class="fat"><?php the_field('l_fat', 'option'); ?><span><?php the_field('fat'); ?></span></div>
		<div class="protein"><?php the_field('l_protein', 'option'); ?><span><?php the_field('protein'); ?></span></div>
	</div>
	<div class="details_2">
		<div class="time"><?php the_field('l_prep_time'); ?><span><?php the_field('prep_time'); ?></span></div>
		<div class="portion"><?php the_field('l_total_time'); ?><span><?php the_field('total_time'); ?></span></div>
	</div>
</div>
