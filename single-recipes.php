<?php get_header();

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

$minutes = get_field('minutes', 'option');

$l_calories = get_field('l_calories', 'option');
$l_protein = get_field('l_protein', 'option');
$l_fat = get_field('l_fat', 'option');
$l_carbs = get_field('l_carbs', 'option');
$l_sodium = get_field('l_sodium', 'option');
$l_fiber = get_field('l_fiber', 'option');
$l_sugar = get_field('l_sugar', 'option');

?>

<div class="fmc_single_recipe">
	<div class="fmc_recipe_hero">
		<div class="fmc_container">
			<h1 class="fmc_recipe_title">
				<?php the_title(); ?>
			</h1>
			<div class="fmc_categories">
				<?php the_category(); ?>
			</div>
			<div class="fmc_recipe_times">
				<?php if($prep_time) { ?>
					<div class="fmc_prep"><?php echo $l_prep_time ?>: <span><?php echo $prep_time?> <?php echo $minutes ?></span></div>
				<? } ?>
				<?php if($cook_time['value']) { ?>
					<div class="fmc_cook"><?php echo $l_cook_time ?>: <span><?php echo $cook_time ?> <?php echo $minutes ?></span></div>
				<? } ?>
				<?php if($total_time['value']) { ?>
					<div class="fmc_total"><?php echo $l_total_time ?>: <span><?php echo $total_time ?> <?php echo $minutes ?></span></div>
				<? } ?>
			</div>
			<div class="fmc_recipe_share">
				<div class="fmc_fb"><a href="#">Facebook</a></div>
				<div class="fmc_tw"><a href="#">Tweeter</a></div>
				<div class="fmc_email"><a href="#">Email</a></div>
				<div class="fmc_link"><a href="#">Copy Link</a></div>
			</div>

			<?php get_template_part('template-parts/recipe/gallery'); ?>
		</div>
	</div>

	<?php get_template_part('template-parts/recipe/macros'); ?>

	<?php get_template_part('template-parts/recipe/main'); ?>

	<?php get_template_part('template-parts/newsletter'); ?>

	<?php get_template_part('template-parts/recipe/author'); ?>

	<div class="fmc_container fmc_comments spacing_1">
		<?php
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif; ?>
	</div>
	<?php get_template_part('template-parts/recipe/related-recipes'); ?>

</div>

<?php get_footer(); ?>
