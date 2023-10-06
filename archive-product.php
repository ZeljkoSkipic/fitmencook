<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

get_header('shop');

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */

 $product_categories = $terms = get_terms( 'product_cat', array(
    'hide_empty' => false,
));

if($product_categories && is_array($product_categories)) {
    $product_categories = array_filter($product_categories, function($category) {
        return $category->slug !== "uncategorized";
    });
}

global $wp_query;
$query_var = get_query_var('product_cat', "-1");
?>
<div class="fmc_container spacing_2_0">
    <header class="woocommerce-products-header">
        <?php if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<div class="fmc_breadcrumbs spacing_0_2">', '</div>');
        } ?>
        <div class="fmc_product_archive_header spacing_0_2">
            <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
                <h1 class="fmc_title_2 woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
            <?php endif; ?>

            <?php if($product_categories): ?>

            <div class="fmc_product_cats">
                <a <?php if($query_var == -1 ) echo "class='current'"; ?> href="<?php echo get_permalink( wc_get_page_id( 'shop' )); ?>"><?php esc_html_e('All products', 'fitmenCook'); ?></a>

                <?php
                foreach($product_categories as $product_cat) {
                    ?>
                         <a <?php if($query_var === $product_cat->slug ) echo "class='current'"; ?> href="<?php echo get_term_link($product_cat); ?>"><?php echo $product_cat->name; ?></a>
                    <?php
                }
                ?>

            </div>

            <?php endif; ?>

        </div>
    </header>
    <?php
    if (woocommerce_product_loop()) {

        woocommerce_product_loop_start();

        if (wc_get_loop_prop('total')) {
            while (have_posts()) {
                the_post();

                /**
                 * Hook: woocommerce_shop_loop.
                 */
                do_action('woocommerce_shop_loop');
                get_template_part('template-parts/content', 'product');
            }
        }

        woocommerce_product_loop_end();

        /**
         * Hook: woocommerce_after_shop_loop.
         *
         * @hooked woocommerce_pagination - 10
         */
        do_action('woocommerce_after_shop_loop');
    } else {
        /**
         * Hook: woocommerce_no_products_found.
         *
         * @hooked wc_no_products_found - 10
         */
        do_action('woocommerce_no_products_found');
    } ?>
</div>

<?php /**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action('woocommerce_after_main_content');

get_footer('shop');
