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
	<div class="fmc_container fmc_macros">
		<div class="fmc_macro"><div class="fmc_macro_inner"><?php echo $calories['label'] ?><span><?php echo $calories['value'] ?></span></div></div>
		<div class="fmc_macro"><div class="fmc_macro_inner"><?php echo $protein['label'] ?><span><?php echo $protein['value'] ?></span></div></div>
		<div class="fmc_macro"><div class="fmc_macro_inner"><?php echo $fat['label'] ?><span><?php echo $fat['value'] ?></span></div></div>
		<div class="fmc_macro"><div class="fmc_macro_inner"><?php echo $carbs['label'] ?><span><?php echo $carbs['value'] ?></span></div></div>
		<div class="fmc_macro"><div class="fmc_macro_inner"><?php echo $sodium['label'] ?><span><?php echo $sodium['value'] ?></span></div></div>
		<div class="fmc_macro"><div class="fmc_macro_inner"><?php echo $fiber['label'] ?><span><?php echo $fiber['value'] ?></span></div></div>
		<div class="fmc_macro"><div class="fmc_macro_inner"><?php echo $sugar['label'] ?><span><?php echo $sugar['value'] ?></span></div></div>
	</div>

	<div class="fmc_container fmc_recipe_main">
		<div class="fmc_recipe_main_left">
			<div class="fmc_ingredients">
				<h6 class="fmc_ing_title">Natural Nut Butter</h6>
				<div class="fmc_ing_content">1/2 cup (must have oil)</div>
			</div>
		</div>
	</div>
	<?php get_template_part('template-parts/homepage/newsletter'); ?>
	<div class="fmc_container">
		<div class="fmc_chef">
			<h3 class="fmc_chef_title">
				About the Chef
			</h3>
			<div class="fmc_chef_content">
			My name is Kevin. My life changed when I realized that healthy living is truly a lifelong journey, mainly won by having a well-balanced diet and enjoying adequate exercise. By experimenting in the kitchen and openly sharing my meals, I learned that healthy eating is hardly boring and that by making a few adjustments, I could design a diet that could help me achieve my personal fitness goals. Our bodies are built in the kitchen and sculpted in the gym.
			</div>
			<div class="fmc_chef_share">
				<div class="fmc_fb"><a href="#">Facebook</a></div>
				<div class="fmc_tw"><a href="#">Tweeter</a></div>
				<div class="fmc_email"><a href="#">Email</a></div>
				<div class="fmc_link"><a href="#">Copy Link</a></div>
			</div>
		</div>

	</div>
	<div class="fmc_container fmc_comments">
		<?php
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif; ?>
	</div>
	<?php get_template_part('template-parts/homepage/featured-recipes'); ?>

</div>

<?php get_footer(); ?>
