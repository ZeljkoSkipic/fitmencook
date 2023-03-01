<?php

/**
 * Template part for displaying a content product
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fitmencook
 */

$title = get_the_title();
$image = get_the_post_thumbnail(get_the_ID(), 'large');
$categories = get_the_terms(get_the_ID(), 'product_cat');
$product = wc_get_product(get_the_ID());

?>

<div class="fmc_product">

    <?php if ($image) : ?>

        <figure class="fmc_grid_figure">
            <?php echo $image; ?>
        </figure>

    <?php endif; ?>


    <div class="fmc_grid_meta">

        <?php if ($categories && isset($categories[0])) : ?>

            <span class="fmc_grid_cat">
                <?php echo $categories[0]->name; ?>
            </span>

        <?php endif; ?>

    </div>

    <?php if ($title) : ?>

        <h3 class="fmc_grid_title"><?php echo $title; ?></h3>

    <?php endif; ?>

    <div class="fmc_product_grid_bottom">
        <?php
        echo  $product->get_price_html();
        ?>
        <a class="fmc_btn" href="<?php the_permalink(); ?>"> <?php esc_html_e('Buy Now', 'fitmenCook') ?></a>
    </div>
</div>