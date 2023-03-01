<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

use function WPML\FP\Strings\remove;

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
	<div class="fmc_product_wrap spacing_2 fmc_container">
		<div class="fmc_product_left">
		<?php if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb( '<div class="fmc_breadcrumbs spacing_0_2">','</div>' );
		} ?>
		<div class="fmc_product_main spacing_0_1">
			<?php
			/**
			 * Hook: woocommerce_before_single_product_summary.
			 *
			 * @hooked woocommerce_show_product_sale_flash - 10
			 * @hooked woocommerce_show_product_images - 20
			 */
			do_action( 'woocommerce_before_single_product_summary' );
			?>

			<div class="summary entry-summary">
				<?php
				/**
				 * Hook: woocommerce_single_product_summary.
				 *
				 * @hooked woocommerce_template_single_title - 5
				 * @hooked woocommerce_template_single_rating - 10
				 * @hooked woocommerce_template_single_price - 10
				 * @hooked woocommerce_template_single_excerpt - 20
				 * @hooked woocommerce_template_single_add_to_cart - 30
				 * @hooked woocommerce_template_single_meta - 40
				 * @hooked woocommerce_template_single_sharing - 50
				 * @hooked WC_Structured_Data::generate_product_data() - 60
				 */
                remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
                remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
				do_action( 'woocommerce_single_product_summary' );
				?>
			</div>
		</div>
		<div class="fmc_product_why spacing_3_1">
			<div class="fmc_product_why_inner">
			<?php

			// Check rows existexists.
			if( have_rows('why_choose_fmc') ):

				// Loop through rows.
				while( have_rows('why_choose_fmc') ) : the_row();

					// Load sub field value.
					$icon = get_sub_field('icon');
					$size = 'full';
					$title = get_sub_field('title');
					$text = get_sub_field('text'); ?>
					<div class="fmc_product_why_ib">
					<?php
						if( $icon ) {
							echo wp_get_attachment_image( $icon, $size );
						} ?>
						<h4 class="spacing_3_0"><?php echo $title; ?></h4>
						<div><?php echo $text; ?></div>
					</div>

				<?php // End loop.
				endwhile;

			endif; ?>
			</div>
		</div>
		<?php
		/**
		 * Hook: woocommerce_after_single_product_summary.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
		?>
		</div>
		<div class="fmc_product_right">
			<div class="fmc_product_buy">
			    <h4 class="fmc_bp_title"><?php the_field('rtb', 'option'); ?></h4>
                <?php do_action('woo_add_to_cart_sidebar'); ?>
			</div>
		</div>
	</div>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
