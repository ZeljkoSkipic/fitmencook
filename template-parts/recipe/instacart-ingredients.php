<?php
$note_icon = get_field('note_icon', 'option');
$sub_icon = get_field('sub_icon', 'option'); ?>

<div class="fmc_ingredients">
	<?php
	if (have_rows('ing_group')) : ?>

		<?php while (have_rows('ing_group')) : the_row(); ?>
			<?php $ing_title = get_sub_field('ing_g_title'); ?>
			<?php if (get_sub_field('add_separator')) { ?>
				<hr>
			<?php } ?>
			<?php if ($ing_title) { ?>
				<strong><?php echo $ing_title; ?></strong>
			<?php } ?>
			<ul>
				<?php while (have_rows('ingredients_instacart')) : the_row(); ?>

					<?php
					$ingredient = get_sub_field('ingredient');
					$ingredient_link = get_sub_field('ingredient_link');
					$note = get_sub_field('note');
					$substitution = get_sub_field('substitution');
					$optional = get_sub_field('optional');
					$added_product = get_sub_field('add_product');
					$product = get_sub_field('product');
					$note_switch = get_sub_field('add_note');
					$sub_switch = get_sub_field('add_substitution');
					if($added_product) {
					$recipe_page = get_posts([
						'post_type' => 'page',
						'meta_query' => array(
							'relation' => 'AND',
							array(
								'key' => 'connected_product',
								'value' => '"' . $product->ID . '"',
								'compare' => 'LIKE'
							),
							array(
								'key'   => '_wp_page_template',
            					'value' => 'prod-ing.php'
							)
						),
					]);
				}
					?>
					<li>

						<?php if ($ingredient_link) { ?>
							<a href="<?php echo $ingredient_link; ?>" target="_blank">
							<?php } ?>
							<?php if ($optional) { ?>
								<em>
								<?php } ?>
								<?php if ($added_product && $product && $recipe_page && isset($recipe_page[0])) { ?>
									<a href="<?php echo get_the_permalink($recipe_page[0]); ?>">
									<?php } ?>
									<?php echo $ingredient; ?>
									<?php if ($added_product && $product) { ?>
									</a>
								<?php } ?>
								<?php if ($optional) { ?>
									*</em>
							<?php } ?>
							<?php if ($ingredient_link) { ?>
							</a>
						<?php } ?>

						<?php if ($added_product && $product) { ?>
							<a data-quantity="1" data-product-id="<?php echo $product->ID ?>" class="ingredient-add-to-cart"><?php esc_html_e('Add to cart', 'fitmencook'); ?></a>
						<?php } ?>

						<?php if ($note || $substitution) : ?>
							<ul>
								<?php if ($substitution && $sub_switch) { ?>
									<li class="sub"><img src="<?php echo $sub_icon ?>"><?php echo $substitution; ?></li>
								<?php } ?>
								<?php if ($note && $note_switch) { ?>
									<li class="note"><img src="<?php echo $note_icon ?>"><?php echo $note; ?></li>
								<?php } ?>
							</ul>
						<?php endif; ?>
					</li>
				<?php endwhile; ?>
			</ul>

		<?php endwhile; ?>

	<?php endif; ?>
</div>
