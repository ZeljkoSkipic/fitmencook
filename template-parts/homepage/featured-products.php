<?php
$size = 'medium'; // (thumbnail, medium, large, full or custom size)
if( have_rows('featured_products') ): ?>
<div class="fmc_home_products spacing_2_1">
	<div class="fmc_container">
		<h3 class="fmc_title_2 title_spacing_2"><?php the_field('fp_title') ?></h3>
		<div class="fmc_home_p_inner">

		<?php // Existing Products
			$existing_featured_products = get_field('existing_featured_products');
			if( $existing_featured_products ): ?>
				<?php foreach( $existing_featured_products as $post ):

					// Setup this post for WP functions (variable must be named $post).
					setup_postdata($post);
					$product = wc_get_product(get_the_ID());
					?>
					<div class="fmc_product">
					<figure class="fmc_grid_figure">
						<?php the_post_thumbnail( $size ); ?>
					</figure>
					<h3 class="fmc_grid_title"><?php the_title(); ?></h3>
					<div class="fmc_product_grid_bottom">
						<span><?php echo  $product->get_price_html(); ?></span>
						<a class="fmc_btn" href="?add-to-cart=<?php the_ID(); ?>">Buy Now</a>
					</div>
				</div>
				<?php endforeach; ?>
				<?php
				// Reset the global post object so that the rest of the page works correctly.
				wp_reset_postdata(); ?>
			<?php endif; ?>

		<?php while( have_rows('featured_products') ) : the_row(); // Custom Products
			// Load sub field value.
			$image = get_sub_field('product_image');
			$product_title = get_sub_field('product_title');
			$price = get_sub_field('price');
			$link = get_sub_field('link'); ?>

				<div class="fmc_product">
					<figure class="fmc_grid_figure">
						<?php echo wp_get_attachment_image( $image, $size ); ?>
					</figure>
					<div class="fmc_grid_meta">
					</div>
					<h3 class="fmc_grid_title"><?php echo $product_title ?></h3>
					<div class="fmc_product_grid_bottom">
						<?php if($price) { ?>
							<span>$<?php echo $price ?></span>
						<?php } ?>
						<?php
						if( $link ):
							$link_url = $link['url'];
							$link_title = $link['title'];
							$link_target = $link['target'] ? $link['target'] : '_self';
							?>
							<a class="fmc_btn" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
						<?php endif; ?>
					</div>
				</div>
				<?php endwhile; ?>

		</div>
			<?php
			$shop_link = get_field('view_all_link_and_text');
			if( $shop_link ):
				$shop_link_url = $shop_link['url'];
				$shop_link_title = $shop_link['title'];
				$shop_link_target = $shop_link['target'] ? $shop_link['target'] : '_self';
				?>
				<a class="fmc_btn_2" href="<?php echo esc_url( $shop_link_url ); ?>" target="<?php echo esc_attr( $shop_link_target ); ?>"><span class="btn_text"><?php echo esc_html( $shop_link_title ); ?></span><span class="btn_icon"><svg width="12" height="10" viewBox="0 0 12 10" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M6.29289 0.292893C6.68342 -0.097631 7.31658 -0.0976311 7.70711 0.292893L11.7071 4.29289C12.0976 4.68342 12.0976 5.31658 11.7071 5.70711L7.70711 9.70711C7.31658 10.0976 6.68342 10.0976 6.29289 9.70711C5.90237 9.31658 5.90237 8.68342 6.29289 8.29289L8.58579 6L1 6C0.447716 6 -2.41411e-08 5.55228 0 5C2.41411e-08 4.44772 0.447716 4 1 4H8.58579L6.29289 1.70711C5.90237 1.31658 5.90237 0.683418 6.29289 0.292893Z" fill="#98A2B3"/>
					</svg>
					</span>
				</a>
			<?php endif; ?>
	</div>
</div>
<?php endif;
