<div class="fmc_category_track spacing_1">
	<div class="fmc_container">
		<h2 class="fmc_title_2 title_spacing_2"><?php the_field('category-track-title', 'option'); ?></h2>
		<div class="fmc_ct_inner carousel-home">
			<?php $categories = get_field('recipe_categories', 'option') ?>
			<?php foreach($categories as $category) {
			$icon = get_field('category_icon', $category);
			$size = 'full';
			?>
			<figure class="carousel-cell">
				<?php echo '<a href="' . get_category_link($category->term_id) . '">'; ?>
				<?php if( $icon ) {
					echo wp_get_attachment_image( $icon, $size );
				} ?>
					<figcaption>
					<?php echo $category->name; ?>
					</figcaption>
				</a>
			</figure>
		<?php } ?>
		</div>
	</div>
</div>
