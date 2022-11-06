<?php if( have_rows('featured_products') ): ?>
<div class="fmc_home_featured_products spacing_2_1">
	<div class="fmc_container">
	<h3 class="fmc_top_title">New Collection</h3>
	<h3 class="fmc_main_title">Featured Products</h3>
		<div class="fmc_home_fp_inner spacing_0_1">
		<?php while( have_rows('featured_products') ) : the_row();
			// Load sub field value.
			$image = get_sub_field('product_image');
			$size = 'full'; // (thumbnail, medium, large, full or custom size)
			$product_title = get_sub_field('product_title');
			$price = get_sub_field('price');
			$link = get_sub_field('link'); ?>

				<div class="fmc_product">
					<figure>
						<?php echo wp_get_attachment_image( $image, $size ); ?>
					</figure>
					<h3><?php echo $product_title ?></h3>
					<span>($<?php echo $price ?>)</span>
					<a class="bn_btn" href="<?php echo $link ?>">Buy Now</a>
				</div>
				<?php endwhile; ?>

		</div>
		<a class="fmc_btn" href="#">View All</a>
	</div>
</div>
<?php endif;
