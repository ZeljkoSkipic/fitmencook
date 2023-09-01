<?php

$ingredients = get_field('ingredients');

$categories = get_the_terms( $post->ID, 'recipe-category' );

$nos_single = get_field('number_of_servings_ing_single', 'option');
$nosi = get_field('number_of_servings_ing', 'option');
$servings_number = get_field('number_of_servings');

$serving_size = get_field('serving_size');
$l_serving_size = get_field('l_serving_size', 'option'); ?>

<?php if( $ingredients || have_rows('ing_group') ) : ?>

<div class="fmc_recipe_ingredients spacing_0_3" id="fmc_gtr">

		<div class="atm-ad-slot" data-slot-type="incontent-ad"></div> <!-- AD -->

		<h2 class="fmc_title_1 spacing_1_3">
			<?php the_title(); ?>
		</h2>

	<h4 class="fmc_title_3 title_spacing_3"><?php the_field('ingredients_title'); ?></h4>

	<?php if($servings_number) { ?>
	<div class="fmc_ing_servings"><?php echo $servings_number ?>
		<?php if($servings_number == 1) {
			echo $nos_single;
		} else {
			echo $nosi;
		}
		?></div>
	<?php } ?>
	<?php if($serving_size) { ?>
	<div class="fmc_ing_servings_size"><?php echo $l_serving_size; ?>:<span><?php echo $serving_size ?></span></div>
	<?php } ?>


	<?php // Instacart Ingredients

	if( get_field('ingredients_switch') ) { ?>
	<?php get_template_part('template-parts/recipe/instacart-ingredients'); ?>
	<script>
	(function (d, s, id) { var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) { return; } js = d.createElement(s); js.id = id; js.src = "https://widgets.instacart.com/widget-bundle.js"; js.async = true; fjs.parentNode.insertBefore(js, fjs); })(document, "script", "standard-instacart-widget-v1");
	</script>

	<div id="shop-with-instacart-v1"></div>

	<?php } else {

 	if( $ingredients ) { ?>

	<div class="fmc_recipe_ingredients spacing_0_3" id="fmc_gtr">

		<div class="fmc_ingredients">
			<?php echo $ingredients; ?>
		</div>
	</div>
	<?php }
	} ?>



</div>

<?php endif; ?>

<?php get_template_part('template-parts/recipe/tools'); ?>


<!-- Recipe Sponsor Image -->

<?php
	if ($categories) : ?>
		<div class="fmc_sponsor_images">
			<?php foreach ($categories as $cat) : ?>
				<?php $sponsor_image = get_field('recipe_sponsor_image', $cat);
				if ($sponsor_image) : ?>
					<div class="fmc_sponsor_image">
					<?php $cat_image_link = get_field('category_image_link', $cat);
					if( $cat_image_link ):
						$cat_image_link_url = $cat_image_link['url'];
						$cat_image_link_target = $cat_image_link['target'] ? $cat_image_link['target'] : '_self'; ?>
							<a href="<?php echo esc_url( $cat_image_link_url ); ?>" target="<?php echo esc_attr( $cat_image_link_target ); ?>">
						<?php endif; ?>
							<?php echo wp_get_attachment_image($sponsor_image, 'full'); ?>
							<?php if( $cat_image_link ): ?>
								</a>
							<?php endif; ?>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>

		</div>
	<?php endif; ?>

<?php dynamic_sidebar( 'ad3' ); ?>

<?php
// Check rows existexists.
if( have_rows('steps') ): ?>
<div class="fmc_recipe_steps">
	<h4 class="fmc_title_3 spacing_1_3"><?php the_field('steps_title'); ?></h4>
	<div class="fmc_steps">
	<?php $item = 1;
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
	endwhile; ?>
	</div>
</div>

<?php endif; ?>


<?php dynamic_sidebar( 'ad4' ); ?>
