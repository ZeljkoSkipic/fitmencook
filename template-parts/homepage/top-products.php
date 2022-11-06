<?php

if( have_rows('top_products') ): ?>
	<div class="fmc_home_top_products">
	<div class="fmc_home_tp_inner">
    <?php while( have_rows('top_products') ) : the_row();

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
</div>
<?php endif;
