jQuery(document).ready(function ($) {

// Woo mini cart

const cartWrapper = $(".woo-mini-cart");
const updaterl = theme.ajaxUrl;

const cartInit = () => {
  // Init update

  updateCartData();

  $(document.body).on("added_to_cart", function () {
    updateCartData();
  });

  $(document.body).on("removed_from_cart", function () {
    updateCartData();
  });

  $(document.body).on("updated_cart_totals", function () {
    updateCartData();
  });

  $(document.body).on("wc_cart_emptied", function () {
    updateCartData();
  });
};

const updateCartData = () => {
  cartWrapper.find(".loader").show();

  $.ajax({
    type: "GET",
    url: updaterl,
    data: {
      action: "woo_minicart_update",
      nonce: theme.nonce,
    },
    success: function (response) {
      if (response.success) {
        // Update cart content
        if (
          typeof response.data.content !== "undefined" &&
          response.data.content
        ) {
          cartWrapper
            .find(".woo-mini-cart__content")
            .html(response.data.content);
        }

        // Update cart count

        if (typeof response.data.count !== "undefined") {
          cartWrapper.find(".woo-mini-cart__count").html(response.data.count);
        }
      }
    },
    complete: function () {
      cartWrapper.find(".loader").hide();
    },
  });
};

// Init Cart

cartInit();ini

});
