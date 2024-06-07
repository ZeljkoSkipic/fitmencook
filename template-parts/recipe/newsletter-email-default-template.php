<?php
$recipeID = isset($args['recipeID']) ? $args['recipeID'] : "";
$prep_hours = get_field('prep_hours', $recipeID);
$prep_time = get_field('prep_time', $recipeID);
$cook_hours = get_field('cook_hours', $recipeID);
$cook_time = get_field('cook_time', $recipeID);
$total_time = get_field('total_time', $recipeID);
$total_hours = get_field('total_hours', $recipeID);
$l_prep_time = get_field('l_prep_time', 'option');
$l_cook_time = get_field('l_cook_time', 'option');
$l_total_time = get_field('l_total_time', 'option');
$minutes = get_field('minutes', 'option');
$ingredients = get_field('ingredients', $recipeID);
$calories = get_field('calories', $recipeID);
$protein = get_field('protein', $recipeID);
$fat = get_field('fat', $recipeID);
$carbs = get_field('carbs', $recipeID);
$sodium = get_field('sodium', $recipeID);
$fiber = get_field('fiber', $recipeID);
$sugar = get_field('sugar', $recipeID);
$l_calories = get_field('l_calories', 'option');
$l_protein = get_field('l_protein', 'option');
$l_fat = get_field('l_fat', 'option');
$l_carbs = get_field('l_carbs', 'option');
$l_sodium = get_field('l_sodium', 'option');
$l_fiber = get_field('l_fiber', 'option');
$l_sugar = get_field('l_sugar', 'option');
$feature_image = get_the_post_thumbnail( $recipeID, 'large');
$instacart_switch = get_field('ingredients_switch', $recipeID);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php echo get_the_title($recipeID); ?></title>
	<style>
		img {
			width: 100%;
			height: auto;
			object-fit: contain;
		}
		.site_logo {
			width: 80px;
		}
	</style>
</head>

<body>
	<table style="width:100%;"><tr><td style="padding: 4px 16px; border-radius: 4px; text-align: center; background: #FF885C; width: 100%"><h1 style="font-size: 22px; letter-spacing: .5px; color: #fff; margin: 0;">Fitmencook: <?php echo get_the_title($recipeID) ?></h1></td></tr></table>
	<table style="width: 100%;"><tr><td style="display: block; max-width: 650px; margin-left: auto; margin-right:auto; padding: 24px; background-color: #fafafa; border-radius: 0 0 16px 16px;">
		<table>

			<?php if($feature_image): ?>

			<tr>
				<?php echo $feature_image; ?>
			</tr>



			<?php endif; ?>

			<tr>
				<td style="width: 150px; display: inline-flex;"><img class="site_logo" width="80" src="https://fitmencook.com/wp-content/uploads/2024/01/fitmencook-logo.png"></td>
				<td style="width: 200px; display: inline-flex;">

					<table>
						<?php if ($prep_time) : ?>

							<tr>
								<td>
									<strong><?php echo $l_prep_time ?>: </strong>
								</td>
								<td>
									<?php if ($prep_hours) { ?>
										<span>
											<?php echo $prep_hours ?>h
										</span>
									<?php } ?>
									<span><?php echo $prep_time ?> <?php echo $minutes ?></span>
								</td>
							</tr>

						<?php endif; ?>

						<?php if ($cook_time) : ?>

							<tr>
								<td>
									<strong><?php echo $l_cook_time ?>: </strong>
								</td>
								<td>
									<?php if ($cook_hours) { ?>
										<span>
											<?php echo $cook_hours ?>h
										</span>
									<?php } ?>
									<span><?php echo $cook_time ?> <?php echo $minutes ?></span>

								</td>
							</tr>

						<?php endif; ?>

						<?php if ($total_time) : ?>

							<tr>
								<td>
									<strong><?php echo $l_total_time ?>: </strong>
								</td>
								<td>
									<?php if ($total_hours) { ?>
										<span>
											<?php echo $total_hours ?>h
										</span>
									<?php } ?>
									<span><?php echo $total_time ?> <?php echo $minutes ?></span>
								</td>
							</tr>

						<?php endif; ?>

					</table>
				</td>
			</tr>
			</table>

			<table>
			<tr>
				<td>

					<?php // Instacart Ingredients

					if (get_field('ingredients_switch', $recipeID)) { ?>
						<h2><?php the_field('ingredients_title', $recipeID); ?></h2>

						<?php if($instacart_switch) : ?>
							<a style="margin-bottom: 8px; background: rgb(0, 61, 41); padding: 8px 24px; text-decoration: none; color: #fff;  border-radius: 4px; font-weight: 500; font-size: 18px; display: inline-flex;" href="<?php echo get_the_permalink($recipeID) . '#shop-with-instacart-v1' ?>">Buy ingredients via Instacart</a>
						<?php endif; ?>

						<?php get_template_part('template-parts/recipe/instacart-ingredients-mail', null, [
							'recipeID' => $recipeID
						]); ?>

						<?php } else {

						if ($ingredients) { ?>
							<h2><?php the_field('ingredients_title', $recipeID); ?></h2>
							<table>
								<tr>
									<td>
										<?php echo $ingredients; ?>
									</td>
								</tr>
							</table>
					<?php }
					} ?>

				</td>
			</tr>

			<tr>
				<td>
					<?php
					// Check rows existexists.
					if (have_rows('steps', $recipeID)) : ?>
						<h2><?php the_field('steps_title', $recipeID); ?></h2>
						<?php $item = 1;
						// Loop through rows.
						while (have_rows('steps', $recipeID)) : the_row();

							// Load sub field value.
							$step = get_sub_field('step'); ?>
							<table>
								<tr>
									<td>
										<h3 style="margin-top: 0; margin-bottom: -5px;">
											Step <?php echo $item; ?>
										</h3>
									</td>
								</tr>
								<tr>
									<td>
										<?php echo $step; ?>
									</td>
								</tr>
							</table>

					<?php // End loop.
							$item++;
						endwhile;
					endif; ?>
				</td>
			</tr>
		</table>
	</td></tr></table>
	<table style="text-align:center; width: 100%; padding-top: 24px;"><tr><td>
		<a style="margin-bottom: 8px; background: #FF885C; padding: 8px 24px; text-decoration: none; color: #fff;  border-radius: 4px; font-weight: 500; font-size: 18px; display: inline-flex; margin-right: 12px;" href="https://fitmencook.com/recipes">More Recipes</a>
		<?php if($instacart_switch) : ?>
			<a style="margin-bottom: 8px; background: rgb(0, 61, 41); padding: 8px 24px; text-decoration: none; color: #fff;  border-radius: 4px; font-weight: 500; font-size: 18px; display: inline-flex;" href="<?php echo get_the_permalink($recipeID) . '#shop-with-instacart-v1' ?>">Buy ingredients via Instacart</a>
		<?php endif; ?>
	</td></tr></table>
</body>
</html>
