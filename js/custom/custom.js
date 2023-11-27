function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
function _iterableToArrayLimit(arr, i) { var _i = null == arr ? null : "undefined" != typeof Symbol && arr[Symbol.iterator] || arr["@@iterator"]; if (null != _i) { var _s, _e, _x, _r, _arr = [], _n = !0, _d = !1; try { if (_x = (_i = _i.call(arr)).next, 0 === i) { if (Object(_i) !== _i) return; _n = !1; } else for (; !(_n = (_s = _x.call(_i)).done) && (_arr.push(_s.value), _arr.length !== i); _n = !0); } catch (err) { _d = !0, _e = err; } finally { try { if (!_n && null != _i.return && (_r = _i.return(), Object(_r) !== _r)) return; } finally { if (_d) throw _e; } } return _arr; } }
function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }
jQuery(document).ready(function ($) {
  // 1st carousel, main
  $('.carousel-main').flickity({
    prevNextButtons: true,
    pageDots: false,
    adaptiveHeight: true
  });
  // 2nd carousel, navigation
  $('.carousel-nav').flickity({
    asNavFor: '.carousel-main',
    contain: true,
    pageDots: false,
    prevNextButtons: false
  });

  // Search Toggle
  $(".fmc_toggle_trigger").click(function () {
    $(".fmc_toggle_content").slideToggle();
    $(this).toggleClass('fmc_toggle_open');
  });

  // Nav Search Toggle
  $(".search_icon").click(function () {
    $(".fmc_search_container .asp_w_container").slideToggle();
    $(this).toggleClass('fmc_search_open');
  });

  // Full Nav Search Toggle
  $(".search_icon2, .fmc_full_screen_close").click(function () {
    $(".fmc_full_screen_search").fadeToggle();
  });

  // Mobile navigation toggle

  $(".fmc_mm_trigger").click(function () {
    $(".fmc_header").slideToggle();
    $('.fmc_mobile_header').toggleClass('fmc_nav_open');
  });

  // Mobile Menu Behaviour
  $(".fmc_header ul li.menu-item-has-children > a").after("<span class='fmc_submenu_acitvator'></span>");
  $(".fmc_submenu_acitvator").click(function () {
    $(this).toggleClass("sub-open").siblings(".sub-menu").slideToggle();
  });

  // Category Carousel

  $('.carousel-home').flickity({
    // options
    pageDots: false,
    cellAlign: 'left',
    watchCSS: true,
    wrapAround: true,
    prevNextButtons: false
  });

  // Category Logos

  $('.carousel-logos').flickity({
    // options
    pageDots: false,
    cellAlign: 'left',
    watchCSS: true,
    wrapAround: true,
    prevNextButtons: false
  });

  // Recipe Video
  (function ($) {
    var $window = $(window);
    var $videoWrap = $('.video-wrap');
    var $video = $('.fmc_video');
    if ($videoWrap.length && $video.length) {
      var videoHeight = $video.outerHeight();
      $window.on('scroll', function () {
        var windowScrollTop = $window.scrollTop();
        var videoBottom = videoHeight + $videoWrap.offset().top;
        if (windowScrollTop > videoBottom) {
          $videoWrap.height(videoHeight);
          $video.addClass('stuck');
        } else {
          $videoWrap.height('auto');
          $video.removeClass('stuck');
        }
      });
    }
  })(jQuery);

  // Count single product price on quantity change

  var quantity = $('.quantity .qty');
  var unitPrice = $('.fmc_product_unit_price');
  var totalPrice = $('.fmc_product_unit_total-js');
  var countProductPrice = function countProductPrice(e) {
    var currentValue = $(e.currentTarget).val();
    var unitPriceValue = unitPrice.data('unit-price');
    var total = parseFloat(currentValue * unitPriceValue).toFixed(2);
    totalPrice.html(total);
  };
  quantity.on('change', countProductPrice);

  // Validate comment form

  if ($.validator !== undefined) {
    var commentForm = $('#commentform');
    $.validator.addMethod("valueNotEquals", function (value, element, arg) {
      console.log(value);
      return arg !== value;
    }, "Value must not equal arg.");
    commentForm.validate({
      rules: {
        author: 'required',
        email: {
          required: true,
          email: true
        },
        comment: 'required',
        rateRecipe: {
          valueNotEquals: "0"
        }
      },
      messages: {
        rateRecipe: {
          valueNotEquals: "Please select a rating."
        }
      },
      errorPlacement: function errorPlacement(error, element) {
        if (element.attr("name") == "rateRecipe" || element.attr("name") == "rateRecipe") {
          error.insertAfter(".recipe_rate-wrapper");
        } else {
          error.insertAfter(element);
        }
      },
      ignore: []
    });
  }

  // Show rating if checkbox is checked

  const ratingCheckbox = $('#use-rating')
  const rating = $('.recipe_rate-wrapper')

  rating.hide()
  const ratingSelect = $('#recipe-rate')
  const ratingNameAttr = ratingSelect.attr('name')
  ratingSelect.attr('name', '')


  ratingCheckbox.on('change', function () {
    if ($(this).prop('checked') === true) {
      rating.show()
      ratingSelect.attr('name', ratingNameAttr)
    }

    else {
      rating.hide()
      ratingSelect.attr('name', '')
      const recipeValidationError = $('#recipe-rate-error')
      if (recipeValidationError.length) recipeValidationError.remove()

    }
  })

  // Open Reviews tab on single product when review is posted

  var hash = window.location.hash;
  var tabReviews = $('a[href=#tab-reviews]');
  if (hash != '' && $('.product').length) {
    tabReviews.parent().addClass('active');
    setTimeout(function () {
      tabReviews.next().attr('style', '');
    }, 500);
  }
  (function ($) {
    var plus = '.plus';
    var minus = '.minus';
    var body = $('body');
    function increseQty() {
      var val = parseInt($(this).prev('input').val());
      var max = parseInt($(this).prev('input').attr('max'));
      if (val < max || !max) {
        $(this).prev('input').val(val + 1).trigger('change');
      }
    }
    function decreseQty() {
      var val = parseInt($(this).next('input').val());
      if (val > 1) {
        $(this).next('input').val(val - 1).trigger('change');
      }
    }
    body.on('click', minus, decreseQty);
    body.on('click', plus, increseQty);
  })(jQuery);

  // Delete rating for reply

  var reply = $('.reply');
  reply.on('click', function () {
    $(this).parent().next().find('#recipe-rate').remove();
    $(this).parent().next().find('.recipe-rate-label').remove();
    $(this).parent().next().find('.rateit').remove();
  });

  // Replace Multiple Recipe text
  $(".fmc_recipe_grid_macros .rg_m_amount").text(function () {
    return $(this).text().replace("cal", "");
  });
  $(".rg_macro.calories .rg_m_title").text(function () {
    return $(this).text().replace("Calories", "Cal");
  });
});
var observer = new IntersectionObserver(function (_ref) {
  var _ref2 = _slicedToArray(_ref, 1),
    e = _ref2[0];
  return e.target.toggleAttribute('stuck', e.intersectionRatio < 1);
}, {
  threshold: [1]
});
