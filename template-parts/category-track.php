<div class="fmc_category_track spacing_1">
	<div class="fmc_container">
		<h2 class="fmc_title_2 title_spacing_2"><?php the_field('category-track-title', 'option'); ?></h2>
		<div class="fmc_ct_inner carousel-home">
			<?php $categories = get_field('categories', 'option') ?>
			<?php foreach($categories as $category) {
			$icon = get_field('category_icon', $category); ?>
			<figure class="carousel-cell">
				<?php echo '<a href="' . get_category_link($category->term_id) . '">'; ?>
					<img src="<?php echo $icon; ?>" alt="">
					<figcaption>
					<?php echo $category->name; ?>
					</figcaption>
				</a>
			</figure>
		<?php } ?>
		</div>
	</div>
</div>
