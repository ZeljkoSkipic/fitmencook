<?php
function schema_piece( $pieces, $context ) {

    require_once get_template_directory() . '/includes/yoast/be_product_review.php';
	require_once get_template_directory() . '/includes/yoast/be_product_ingredients.php';

	$pieces[] = new BE_Product_Review( $context );
	$pieces[] = new BE_Product_Ingredients ( $context );

	return $pieces;
}

add_filter( 'wpseo_schema_graph_pieces', 'schema_piece', 20, 2 );
add_filter( 'yoast_seo_development_mode', '__return_true' );
