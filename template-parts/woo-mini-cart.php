<?php
$cart_count = WC()->cart->get_cart_contents_count();
?>

<div class="woo-mini-cart cart">
    <div class="loader"></div>
    <div class="woo-mini-cart__info">
        <span class="woo-mini-cart__count"><?php echo $cart_count; ?></span>
        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1.5 1.5H3.16667L3.5 3.16667M4.83333 9.83333H13.1667L16.5 3.16667H3.5M4.83333 9.83333L3.5 3.16667M4.83333 9.83333L2.92259 11.7441C2.39762 12.269 2.76942 13.1667 3.51184 13.1667H13.1667M13.1667 13.1667C12.2462 13.1667 11.5 13.9129 11.5 14.8333C11.5 15.7538 12.2462 16.5 13.1667 16.5C14.0871 16.5 14.8333 15.7538 14.8333 14.8333C14.8333 13.9129 14.0871 13.1667 13.1667 13.1667ZM6.5 14.8333C6.5 15.7538 5.75381 16.5 4.83333 16.5C3.91286 16.5 3.16667 15.7538 3.16667 14.8333C3.16667 13.9129 3.91286 13.1667 4.83333 13.1667C5.75381 13.1667 6.5 13.9129 6.5 14.8333Z" stroke="#344054" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </div>
    <div class="woo-mini-cart__content">
        <?php woocommerce_mini_cart(); ?>
    </div>
</div>
