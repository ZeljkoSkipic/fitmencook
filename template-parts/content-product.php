<?php

/**
 * Template part for displaying a content product
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fitmencook
 */

$title = get_the_title();
$image = get_the_post_thumbnail(get_the_ID(), 'medium');
$categories = get_the_terms(get_the_ID(), 'product_cat');
$product = wc_get_product(get_the_ID());
$is_in_stock = $product->is_in_stock();

?>

<div class="fmc_product">

    <?php if ($image) : ?>

        <figure class="fmc_grid_figure">
			<a href="<?php the_permalink(); ?>">
				<?php echo $image; ?>
			</a>
        </figure>

    <?php endif; ?>


    <div class="fmc_grid_meta">

        <?php if ($categories && isset($categories[0])) : ?>

            <span class="fmc_grid_cat">
                <a href="<?php echo get_term_link($categories[0]); ?>"><?php echo $categories[0]->name; ?></a>
            </span>

        <?php endif; ?>

    </div>

    <?php if ($title) : ?>

        <h3 class="fmc_grid_title"><a href="<?php the_permalink(); ?>"><?php echo $title; ?></a></h3>

    <?php endif; ?>

    <div class="fmc_product_grid_bottom">
        <span>
        <?php
         if($product->is_on_sale()): ?> <span class="fmc_product_old_price"><?php echo  get_woocommerce_currency_symbol() . number_format((float)$product->get_regular_price(), 2, '.', ''); ?></span> <?php endif; ?>
         <?php
        echo  $product->get_price_html();
        ?>
        </span>
        <a class="fmc_btn <?php if(!$is_in_stock) echo 'out-of-stock'; ?>" href="<?php the_permalink(); ?>"> <?php $is_in_stock ?  esc_html_e('Buy Now', 'fitmenCook') : esc_html_e('View More', 'fitmenCook')  ?></a>
    </div>
</div>
