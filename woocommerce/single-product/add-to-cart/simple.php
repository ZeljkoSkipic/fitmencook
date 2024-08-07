<?php

/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined('ABSPATH') || exit;

global $product;

if (!$product->is_purchasable()) {
    return;
}

 // WPCS: XSS ok.



$product_price = number_format((float)$product->get_price(), 2, '.', '');

if ($product->is_in_stock()) : ?>

    <?php do_action('woocommerce_before_add_to_cart_form'); ?>

    <form class="cart" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>" method="post" enctype='multipart/form-data'>
        <?php do_action('woocommerce_before_add_to_cart_button'); ?>

        <?php
        do_action('woocommerce_before_add_to_cart_quantity');

        ?>

        <div class="fmc_product_quantity-wrapper">
            <p class="fmc_product_quantity_label"><?php esc_html_e('Qty', 'fitmenCook'); ?></p>
            <div class="fmc_product_quantity">

                <?php
                woocommerce_quantity_input(
                    array(
                        'min_value'   => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
                        'max_value'   => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
                        'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
                    )
                );

                echo wc_get_stock_html($product);

                ?>

            </div>
        </div>

        <?php
        do_action('woocommerce_after_add_to_cart_quantity');
        ?>

        <div class="fmc_product_price">
            <div class="fmc_product_unit_price-wrapper">
                <p class="fmc_product_unit_price_label"><?php esc_html_e('Unit price', 'fitmenCook'); ?></p>
                <p data-unit-price="<?php echo $product_price; ?>" class="fmc_product_unit_price"> <?php if($product->is_on_sale()): ?> <span class="fmc_product_old_price"><?php echo  get_woocommerce_currency_symbol() . number_format((float)$product->get_regular_price(), 2, '.', ''); ?></span> <?php   endif; ?> <?php echo  get_woocommerce_currency_symbol() . $product_price; ?></p>
            </div>
            <div class="fmc_product_unit_total-wrapper">
                <p class="fmc_product_unit_total_label"><?php esc_html_e('Total price', 'fitmenCook'); ?></p>
                <p class="fmc_product_unit_total"> <?php echo get_woocommerce_currency_symbol(); ?><span class="fmc_product_unit_total-js"><?php echo $product_price; ?></span></p>
            </div>
        </div>

        <button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" class="fmc_btn single_add_to_cart_button button alt<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>"><?php echo esc_html($product->single_add_to_cart_text()); ?></button>

        <?php do_action('woocommerce_after_add_to_cart_button'); ?>
    </form>

    <?php do_action('woocommerce_after_add_to_cart_form');

	else: ?>

	<div class="product_out_of_stock">
		This product is out of stock
	</div>



<?php endif;
?>
