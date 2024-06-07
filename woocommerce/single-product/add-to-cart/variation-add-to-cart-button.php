<?php

/**
 * Single variation cart button
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined('ABSPATH') || exit;

global $product;

$product_price = number_format((float)$product->get_price(), 2, '.', '');

?>
<div class="woocommerce-variation-add-to-cart variations_button">
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



    <button type="submit" class="single_add_to_cart_button button alt<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>"><?php echo esc_html($product->single_add_to_cart_text()); ?></button>

    <?php do_action('woocommerce_after_add_to_cart_button'); ?>

    <input type="hidden" name="add-to-cart" value="<?php echo absint($product->get_id()); ?>" />
    <input type="hidden" name="product_id" value="<?php echo absint($product->get_id()); ?>" />
    <input type="hidden" name="variation_id" class="variation_id" value="0" />
</div>
