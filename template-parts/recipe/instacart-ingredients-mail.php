<?php
$recipeID = isset($args['recipeID']) ? $args['recipeID'] : get_the_ID();
?>


<?php

if (have_rows('ing_group', $recipeID)) : ?>

	<?php while (have_rows('ing_group', $recipeID)) : the_row(); ?>
		<?php $ing_title = get_sub_field('ing_g_title'); ?>
		<?php if ($ing_title) { ?>
			<h2><?php echo $ing_title; ?></h2>
		<?php } ?>
		<ul>
			<?php while (have_rows('ingredients_instacart', $recipeID)) : the_row(); ?>

				<?php
				$ingredient = get_sub_field('ingredient');
				$ingredient_link = get_sub_field('ingredient_link');
				$note = get_sub_field('note');
				$substitution = get_sub_field('substitution');
				$optional = get_sub_field('optional');

				$note_switch = get_sub_field('add_note');
				$sub_switch = get_sub_field('substitution');
				?>
				<li>

					<?php if ($ingredient_link) { ?>
						<a href="<?php echo $ingredient_link; ?>" target="_blank">
						<?php } ?>
						<?php if ($optional) { ?>
							<em>
							<?php } ?>
							<?php echo $ingredient; ?>
							<?php if ($optional) { ?>
								*</em>
						<?php } ?>
						<?php if ($ingredient_link) { ?>
						</a>
					<?php } ?>

					<?php if ($note || $substitution) : ?>
						<ul>
							<?php if ($substitution && $sub_switch) { ?>
								<li class="sub"><strong>Sub:</strong> <?php echo $substitution; ?></li>
							<?php } ?>
							<?php if ($note && $note_switch) { ?>
								<li class="note"><strong>Note:</strong> <?php echo $note; ?></li>
							<?php } ?>
						</ul>
					<?php endif; ?>
				</li>
			<?php endwhile; ?>
		</ul>

	<?php endwhile; ?>

<?php endif; ?>
