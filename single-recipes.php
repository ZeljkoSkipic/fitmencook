<?php get_header();

$prep_time = get_field_object('prep_time');
$cook_time = get_field_object('cook_time');
$total_time = get_field_object('total_time');

$calories = get_field_object('calories');
$protein = get_field_object('protein');
$fat = get_field_object('fat');
$carbs = get_field_object('carbs');
$sodium = get_field_object('sodium');
$fiber = get_field_object('fiber');
$sugar = get_field_object('sugar');


?>

<div class="fmc_recipe">
	<div class="fmc_recipe_hero">
		<div class="fmc_container">
			<h1 class="fmc_recipe_title">
				<?php the_title(); ?>
			</h1>
			<div class="fmc_categories">
				<?php the_category(); ?>
			</div>
			<div class="fmc_recipe_times">
				<?php if($prep_time['value']) { ?>
					<div class="fmc_prep"><?php echo $prep_time['label'] ?>: <span><?php echo $prep_time['value'] ?> Minutes</span></div>
				<? } ?>
				<?php if($cook_time['value']) { ?>
					<div class="fmc_cook"><?php echo $cook_time['label'] ?>: <span><?php echo $cook_time['value'] ?> Minutes</span></div>
				<? } ?>
				<?php if($total_time['value']) { ?>
					<div class="fmc_total"><?php echo $total_time['label'] ?>: <span><?php echo $total_time['value'] ?> Minutes</span></div>
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
