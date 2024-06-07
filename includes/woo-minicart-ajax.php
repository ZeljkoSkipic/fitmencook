<?php

add_action('wp_ajax_woo_minicart_update', 'woo_minicart_update');
add_action('wp_ajax_nopriv_woo_minicart_update', 'woo_minicart_update');

function woo_minicart_update()
{
    if(! wp_verify_nonce( $_REQUEST['nonce'], 'nonce-security' )) {
        die();
    }

    else {
        $response = [];
        $response['count'] = WC()->cart->get_cart_contents_count();
        ob_start();
        woocommerce_mini_cart();
        $response['content'] = ob_get_clean();
        wp_send_json_success($response);
    }

    die();
    
}
