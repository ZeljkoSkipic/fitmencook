"use strict";

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }
function _iterableToArrayLimit(arr, i) { var _i = arr == null ? null : typeof Symbol !== "undefined" && arr[Symbol.iterator] || arr["@@iterator"]; if (_i == null) return; var _arr = []; var _n = true; var _d = false; var _s, _e; try { for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }
function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }
jQuery(document).ready(function ($) {
  // 1st carousel, main
  $('.carousel-main').flickity({
    prevNextButtons: false,
    pageDots: false
  });
  // 2nd carousel, navigation
  $('.carousel-nav').flickity({
    asNavFor: '.carousel-main',
    contain: true,
    pageDots: false
  });

  // Logo slider block

  /* $('.fmc_logo_slider').flickity({
  	// options
  	wrapAround: true,
  	contain: true,
  	pageDots: false,
    });
   */

  // Mobile navigation toggle

  $(".fmc_mm_trigger").click(function () {
    $(".fmc_header").slideToggle();
    $('.fmc_mobile_header').toggleClass('fmc_nav_open');
  });

  // Mobile navigation submenu

  $(".fmc_header ul > li a").click(function () {
    $(this).toggleClass('sub-open');
    $(this).siblings('.sub-menu').slideToggle();
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

  // Category Carousel

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
});
var observer = new IntersectionObserver(function (_ref) {
  var _ref2 = _slicedToArray(_ref, 1),
    e = _ref2[0];
  return e.target.toggleAttribute('stuck', e.intersectionRatio < 1);
}, {
  threshold: [1]
});

//   observer.observe(document.querySelector('.fmc_mobile_header'));