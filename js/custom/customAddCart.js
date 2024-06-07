jQuery(document).ready(function ($) {
  $(".ingredient-add-to-cart").click(function (e) {
    e.preventDefault();
    const button = $(e.currentTarget);

    const data = {
      product_id: button.data("product-id"),
      quantity: button.data("quantity"),
    };

    $.ajax({
      type: "POST",
      url: wc_add_to_cart_params.wc_ajax_url
        .toString()
        .replace("%%endpoint%%", "add_to_cart"),
      data: data,
      dataType: "json",
      beforeSend: function (xhr) {},
      complete: function (res) {},
      success: function (res) {
        $(document.body).trigger("added_to_cart", [
          res.fragments,
          res.cart_hash,
        ]);
        const viewCartButton = $("<a> </a>");
        viewCartButton.attr("href", theme.cartUrl);
        viewCartButton.addClass("ingredient-add-to-cart-view-cart");
        viewCartButton.text("View Cart");
        button.replaceWith(viewCartButton);
      },
    });
  });
});
