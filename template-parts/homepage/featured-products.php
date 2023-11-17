<?php
$size = 'medium'; // (thumbnail, medium, large, full or custom size)
$show_products = [];
$args = [
	'post_type'			=> 'product',
	'posts_per_page'	=> -1

];

$pinned_products = get_field('pinned_products');
$pinned_custom_products = [];
$custom_products_formated = [];

// if pinned products exists make query to exclude pinned products

if ($pinned_products) {
	$pinned_products_ids = array_map(function ($pinned_product) {
		return $pinned_product->ID;
	}, (array) $pinned_products);

	if ($pinned_products) $args['post__not_in'] = $pinned_products_ids;
}

$products = get_posts($args);
$custom_products = get_field('featured_products');

// Separate pinned custom products and regular custom products

if ($custom_products) {
	foreach ($custom_products as $custom_product) {
		if ($custom_product['pin'] === true) {
			$pinned_custom_products[] = $custom_product;
		} else {
			$custom_products_formated[] = $custom_product;
		}
	}
}

// Add pinned products to show list

if ($pinned_products) {
	foreach ($pinned_products as $pinned_product) {
		if (count($show_products) < 4) {
			$show_products[] = $pinned_product;
		}
	}
}

// Add custom products to show list

if ($pinned_custom_products) {
	foreach ($pinned_custom_products as $pinned_custom_product) {
		if (count($show_products) < 4) {
			$show_products[] = $pinned_custom_product;
		}
	}
}


// If there is no 4 pinned products, complete with a difference to make a total of 4 (the difference is chosen at random)

$all_products = array_merge($products, $custom_products_formated);

if ($all_products && count($show_products) < 4) {
	$random_products_keys = array_rand($all_products, 4 - count($show_products));

	if ($random_products_keys) {
		foreach ($random_products_keys as $random_product_key) {
			if (count($show_products) < 4) {
				$show_products[] = $all_products[$random_product_key];
			}
		}
	}
}


if ($show_products) : ?>
	<div class="fmc_home_products spacing_2_1">
		<div class="fmc_container">
			<h3 class="fmc_title_2 title_spacing_2"><?php the_field('fp_title') ?></h3>
			<div class="fmc_home_p_inner">

				<?php foreach ($show_products as $show_product) :

					if (is_object($show_product)) :

						$post = $show_product;
						setup_postdata($post);
						$product = wc_get_product(get_the_ID());
				?>
						<div class="fmc_product">
							<figure class="fmc_grid_figure">
								<?php the_post_thumbnail($size); ?>
							</figure>
							<h3 class="fmc_grid_title"><?php the_title(); ?></h3>
							<div class="fmc_product_grid_bottom">
								<span><?php echo  $product->get_price_html(); ?></span>
								<a class="fmc_btn" href="<?php the_permalink(); ?>">Buy Now</a>
							</div>
						</div>
					<?php
					else :

						$image = $show_product['product_image'];
						$product_title = $show_product['product_title'];
						$price = $show_product['price'];
						$link = $show_product['link']; ?>

						<div class="fmc_product">
							<figure class="fmc_grid_figure">
								<?php echo wp_get_attachment_image($image, $size); ?>
							</figure>
							<div class="fmc_grid_meta">
							</div>
							<h3 class="fmc_grid_title"><?php echo $product_title ?></h3>
							<div class="fmc_product_grid_bottom">
								<?php if ($price) { ?>
									<span>$<?php echo $price ?></span>
								<?php } ?>
								<?php
								if ($link) :
									$link_url = $link['url'];
									$link_title = $link['title'];
									$link_target = $link['target'] ? $link['target'] : '_self';
								?>
									<a class="fmc_btn" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
								<?php endif; ?>
							</div>
						</div>
				<?php
					endif;
				endforeach;

				wp_reset_postdata(); ?>

			</div>
			<?php
			$shop_link = get_field('view_all_link_and_text');
			if ($shop_link) :
				$shop_link_url = $shop_link['url'];
				$shop_link_title = $shop_link['title'];
				$shop_link_target = $shop_link['target'] ? $shop_link['target'] : '_self';
			?>
				<a class="fmc_btn_2" href="<?php echo esc_url($shop_link_url); ?>" target="<?php echo esc_attr($shop_link_target); ?>"><span class="btn_text"><?php echo esc_html($shop_link_title); ?></span><span class="btn_icon"><svg width="12" height="10" viewBox="0 0 12 10" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M6.29289 0.292893C6.68342 -0.097631 7.31658 -0.0976311 7.70711 0.292893L11.7071 4.29289C12.0976 4.68342 12.0976 5.31658 11.7071 5.70711L7.70711 9.70711C7.31658 10.0976 6.68342 10.0976 6.29289 9.70711C5.90237 9.31658 5.90237 8.68342 6.29289 8.29289L8.58579 6L1 6C0.447716 6 -2.41411e-08 5.55228 0 5C2.41411e-08 4.44772 0.447716 4 1 4H8.58579L6.29289 1.70711C5.90237 1.31658 5.90237 0.683418 6.29289 0.292893Z" fill="#98A2B3" />
						</svg>
					</span>
				</a>
			<?php endif; ?>
		</div>
	</div>
<?php endif;
